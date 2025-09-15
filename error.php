<?php
// Simple unified error page. Works even if routing fails.
// It will send the appropriate HTTP status and show a friendly message.

// Try to keep previously-set status code; default to 500.
$status = http_response_code();
if ($status < 400 || $status === false) {
    $status = 500;
}
http_response_code($status);

// Basic logging (optional): write to PHP error log
error_log("ErrorDocument handled with status $status for URI: " . ($_SERVER['REQUEST_URI'] ?? '')); 

?><!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lỗi hệ thống (<?php echo htmlspecialchars((string)$status, ENT_QUOTES, 'UTF-8'); ?>)</title>
  <style>
    html,body{height:100%;margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial,sans-serif;background:#fff8f0;color:#1b1b1b}
    .wrap{min-height:100%;display:flex;align-items:center;justify-content:center;padding:24px}
    .card{max-width:720px;width:100%;background:#fff;border:1px solid #f2d5bd;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,.06);padding:28px}
    h1{margin:0 0 8px;font-size:22px}
    .status{display:inline-block;background:#ffe8cc;color:#8a4b08;border:1px solid #f2d5bd;border-radius:999px;padding:4px 10px;font-size:12px;margin-bottom:12px}
    .muted{color:#555;font-size:14px;line-height:1.6}
    .tips{margin-top:16px;font-size:14px}
    code{background:#f6f8fa;border-radius:6px;padding:2px 6px}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <div class="status">HTTP <?php echo (int)$status; ?></div>
      <h1>Xin lỗi, đã xảy ra lỗi.</h1>
      <p class="muted">Máy chủ gặp sự cố trong khi xử lý yêu cầu của bạn. Vui lòng thử lại sau ít phút.</p>
      <div class="tips">
        <p>Nếu bạn là quản trị viên, hãy kiểm tra:</p>
        <ul>
          <li>Nhật ký lỗi PHP/Apache (error log)</li>
          <li>Cấu hình <code>.htaccess</code> và các module Apache (mod_rewrite, mod_headers)</li>
          <li>Kết nối cơ sở dữ liệu và biến môi trường</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
