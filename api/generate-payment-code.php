<?php
/**
 * API Generate Payment Code
 * Tạo mã thanh toán cho QR Code
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../core/db_config.php';
require_once '../core/set.php';
require_once '../core/bank_config.php';

// Kiểm tra đăng nhập
if ($_login !== "on" || $_user === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Bạn cần đăng nhập để thực hiện thao tác này!'
    ]);
    exit();
}

// Kiểm tra method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Method không được hỗ trợ!'
    ]);
    exit();
}

try {
    // Lấy dữ liệu từ request
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        $input = $_POST;
    }
    
    $amount = intval($input['amount'] ?? 0);
    $account_id = $input['account_id'] ?? $_user;
    
    // Validate dữ liệu
    if ($amount < PAYMENT_MIN_AMOUNT) {
        echo json_encode([
            'success' => false,
            'message' => 'Số tiền tối thiểu là ' . number_format(PAYMENT_MIN_AMOUNT) . ' VNĐ!'
        ]);
        exit();
    }
    
    if ($amount > PAYMENT_MAX_AMOUNT) {
        echo json_encode([
            'success' => false,
            'message' => 'Số tiền tối đa là ' . number_format(PAYMENT_MAX_AMOUNT) . ' VNĐ!'
        ]);
        exit();
    }
    
    // Tạo mã thanh toán
    $payment_code = PAYMENT_CODE_PREFIX . $account_id . '_' . time();
    
    // Lưu vào database (tùy chọn)
    try {
        $stmt = $conn->prepare("INSERT INTO payment_logs (account_id, amount, payment_code, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$account_id, $amount, $payment_code, 'pending']);
    } catch (PDOException $e) {
        // Nếu bảng không tồn tại, bỏ qua
        error_log("Payment log table not found: " . $e->getMessage());
    }
    
    echo json_encode([
        'success' => true,
        'payment_code' => $payment_code,
        'amount' => $amount,
        'account_id' => $account_id,
        'expires_at' => date('Y-m-d H:i:s', time() + (PAYMENT_EXPIRY_HOURS * 3600))
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
    ]);
}
?>
