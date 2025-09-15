<?php
require_once __DIR__ . '/core/Database.php';
// Kết nối CSDL (PDO)
try {
    $conn = Database::getConnection();
} catch (RuntimeException $e) {
    die("Kết nối thất bại");
}

// Thông tin ngân hàng cá nhân để tạo mã QR
// $bank_info = [
//     'bank_id' => 'BIDV',                 // Mã ngân hàng: MB, VCB, BIDV, AGRIBANK...
//     'account_number' => '0904769973',  // Số tài khoản
//     'account_name' => 'NGUYEN CHI HUONG'   // Tên tài khoản (không dấu)
// ];
$userloginmbbank_config = 'User'; // Tài khoản đăng nhập Mbbank của bạn tại https://online.mbbank.com.vn
$passmbbank_config = 'Password'; // Mật khẩu đăng nhập Mbbank của bạn tại https://online.mbbank.com.vn
$deviceIdCommon_goc_config = 'DeviceId'; // Thay cái thông số mà bạn lấy được từ F12 vào đây
$stkmbbank_config = ''; // Số tài khoản Mbbank
$mbbank_name = ''; // Tên Tài khoản Mbbank
$_mbbank = 'Ngân Hàng Quân Đội | Mbbank'; // Ngân hàng quân đội Mbbank
//$_Token = ($conn->query("SELECT token FROM cpanel")->fetchColumn()) ?? '';

#Atm - ACB
$username = ''; // Tài khoản
$password = ''; // Mật khẩu
$account = ''; // Số tài khoản
$config = [
   'partner_id' => '50096368033',
   'partner_key' => 'e9e229f3198ee24fae44c39ae717d619',
   'accessKey' => 'd40b8ea4364f9cf12827982deb95999102d64644b068e5ab818f7e92c7854edd',
   'secretKey' => 'd27fff5963f46365a54ef2ac4ea41b9a812a236a6488afde8799fbd97c2c7e31',
   'partnerCode' => 'PAY2SEJABSQ83AU2EE17',
];
function CreateToken()
{
    return md5(uniqid(rand(), true));
}
// Token bảo mật để xử lý callback nếu có
// $your_secret_token = 'abc123xyz987';