<?php
// Lightweight header updater endpoint used by core/head.php
// Returns a small HTML snippet, avoids fatal errors if DB/session not available

header('Content-Type: text/html; charset=utf-8');

// Try to include session and DB, but do not hard fail
$login = null;
$username = '';
$balanceVnd = null;

try {
    require_once __DIR__ . '/../../core/connect.php'; // $conn (PDO)
    require_once __DIR__ . '/../../core/set.php';     // sets $_login, $_username, $_coin
    if (isset($_login) && $_login === 'on') {
        $login = 'on';
        $username = isset($_username) ? $_username : '';
        $balanceVnd = isset($_coin) ? (int)$_coin : null;
    }
} catch (Throwable $e) {
    // Swallow to avoid 500s
}

// Render a tiny, safe snippet
if ($login === 'on') {
    $fmt = function($n) {
        if (!is_numeric($n)) return '0';
        return number_format((int)$n);
    };
    echo '<div class="alert alert-success py-1 px-2" style="display:inline-block;margin:0">';
    echo 'Xin chào, <b>' . htmlspecialchars($username ?: 'User') . '</b>'; 
    if ($balanceVnd !== null) {
        echo ' • Số dư: <b>' . $fmt($balanceVnd) . ' VND</b>';
    }
    echo '</div>';
} else {
    echo '<div class="text-muted" style="font-size:12px">Chào mừng đến DragonBall — hãy đăng nhập để xem thông tin tài khoản.</div>';
}
