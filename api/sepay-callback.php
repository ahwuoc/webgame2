<?php
// SePay callback endpoint
// CORS and content headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../core/connect.php'; // provides $conn (PDO)

try {
    // Read JSON body
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
        exit;
    }

    // Required fields
    $required_fields = ['id', 'gateway', 'transactionDate', 'accountNumber', 'content', 'transferType', 'transferAmount'];
    foreach ($required_fields as $field) {
        if (!isset($data[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Missing required field: $field"]);
            exit;
        }
    }

    // Only process inbound transactions
    if (strtolower($data['transferType']) !== 'in') {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Transaction type not supported']);
        exit;
    }

    // Extract fields
    $sepay_id         = (string)$data['id'];
    $gateway          = (string)$data['gateway'];
    $transaction_date = (string)$data['transactionDate'];
    $account_number   = (string)$data['accountNumber'];
    $content          = (string)$data['content'];
    $transfer_amount  = (int)$data['transferAmount'];
    $accumulated      = isset($data['accumulated']) ? (int)$data['accumulated'] : 0;
    $reference_code   = isset($data['referenceCode']) ? (string)$data['referenceCode'] : '';
    $description      = isset($data['description']) ? (string)$data['description'] : '';

    // Ensure non-negative amounts
    if ($transfer_amount <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid transfer amount']);
        exit;
    }

    // Check duplicate sepay_id
    $check_sql = 'SELECT id FROM sepay_transactions WHERE sepay_id = ? LIMIT 1';
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->execute([$sepay_id]);

    if ($check_stmt->fetchColumn()) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Transaction already processed']);
        exit;
    }

    // Parse account id from content: expects NAPCK<ID>
    $account_id = null;
    $matched_pattern = '';
    if (preg_match('/NAPCK(\d+)/i', $content, $matches)) {
        $account_id = (int)$matches[1];
        $matched_pattern = $matches[0];
    }

    error_log("SePay Callback Debug: Content='$content', AccountID=" . ($account_id ?? 'null') . ", Pattern='$matched_pattern'");

    if (!$account_id) {
        // Save as pending for manual reconciliation
        $insert_pending_sql = "INSERT INTO sepay_transactions (
            sepay_id, gateway, transaction_date, account_number,
            content, transfer_type, transfer_amount, accumulated,
            reference_code, description, account_id, username,
            status, created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 'UNKNOWN', 'pending', NOW())";

        $insert_pending_stmt = $conn->prepare($insert_pending_sql);
        $insert_pending_stmt->execute([
            $sepay_id, $gateway, $transaction_date, $account_number,
            $content, $data['transferType'], $transfer_amount, $accumulated,
            $reference_code, $description
        ]);

        error_log("SePay Callback: Saved pending transaction ID $sepay_id - No account ID found in content: '$content'");

        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Transaction saved as pending - no account ID found',
            'debug' => [
                'content' => $content,
                'sepay_id' => $sepay_id,
                'amount' => $transfer_amount
            ]
        ]);
        exit;
    }

    // Fetch user by account id
    $user_sql = 'SELECT id, username, vnd FROM account WHERE id = ? LIMIT 1';
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->execute([$account_id]);
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Account ID not found']);
        exit;
    }

    // Begin transaction
    $conn->beginTransaction();

    try {
        // Insert transaction first
        $insert_sql = "INSERT INTO sepay_transactions (
            sepay_id, gateway, transaction_date, account_number,
            content, transfer_type, transfer_amount, accumulated,
            reference_code, description, account_id, username,
            status, created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'completed', NOW())";

        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->execute([
            $sepay_id, $gateway, $transaction_date, $account_number,
            $content, $data['transferType'], $transfer_amount, $accumulated,
            $reference_code, $description, $account_id, $user['username']
        ]);

        // Update balance
        $update_sql = 'UPDATE account SET vnd = vnd + ?, tongnap = tongnap + ? WHERE id = ?';
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->execute([$transfer_amount, $transfer_amount, $account_id]);

        $conn->commit();

        error_log("SePay Callback Success: Account ID $account_id (Username: {$user['username']}) received $transfer_amount VND from content: '$content'");

        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Transaction processed successfully',
            'data' => [
                'account_id' => $account_id,
                'username' => $user['username'],
                'amount' => $transfer_amount,
                'new_balance' => (int)$user['vnd'] + (int)$transfer_amount,
                'matched_pattern' => $matched_pattern,
                'content' => $content
            ]
        ]);
    } catch (Exception $e) {
        $conn->rollBack();
        error_log('SePay Callback Error: ' . $e->getMessage() . " - Transaction ID: $sepay_id, Account ID: $account_id");
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Transaction processing failed',
            'error' => $e->getMessage(),
            'debug' => [
                'sepay_id' => $sepay_id,
                'account_id' => $account_id,
                'amount' => $transfer_amount
            ]
        ]);
    }
} catch (Exception $e) {
    error_log('SePay Callback Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error',
        'error' => $e->getMessage()
    ]);
}
