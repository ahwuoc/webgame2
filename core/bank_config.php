<?php
/**
 * Bank Configuration
 * Cấu hình thông tin ngân hàng cho thanh toán QR Code
 */

// Thông tin ngân hàng
if (!defined('BANK_NAME')) define('BANK_NAME', 'Ngân hàng TMCP Công thương Việt Nam');
if (!defined('BANK_CODE')) define('BANK_CODE', 'ICB');
if (!defined('BANK_BIN')) define('BANK_BIN', '970415');
if (!defined('BANK_SHORT_NAME')) define('BANK_SHORT_NAME', 'VietinBank');
if (!defined('BANK_ACCOUNT_NUMBER')) define('BANK_ACCOUNT_NUMBER', '109622666168');
if (!defined('BANK_ACCOUNT_NAME')) define('BANK_ACCOUNT_NAME', 'NGUYEN VAN THAO');
if (!defined('BANK_SUPPORTED')) define('BANK_SUPPORTED', true);

// Cấu hình QR Code
define('QR_TEMPLATE', 'compact');
define('QR_DOWNLOAD', '1');

// Thông tin bổ sung
define('BANK_PHONE', '109622666168');
define('BANK_QR_IMAGE', 'img/qrmomo.png');

// Cấu hình thanh toán
define('PAYMENT_MIN_AMOUNT', 10000);  // Số tiền tối thiểu
define('PAYMENT_MAX_AMOUNT', 50000000); // Số tiền tối đa
define('PAYMENT_EXPIRY_HOURS', 24);   // Thời gian hết hạn (giờ)

// Mã thanh toán prefix
define('PAYMENT_CODE_PREFIX', 'NAPCK');
?>
