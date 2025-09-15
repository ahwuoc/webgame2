<?php
require_once __DIR__ . '/cauhinh.php';
require_once __DIR__ . '/set.php';
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/../DHKD/Configs.php'; // Include file cấu hình để sử dụng CONST
// Khởi động session sớm trước mọi output để tránh cảnh báo headers
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
try {
    // Truy vấn lấy cột logo và domain từ bảng adminpanel
    $query = "SELECT logo, domain FROM adminpanel";
    $statement = $conn->prepare($query);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $logo = $result['logo'];
    $domain = $result['domain'];
} catch (PDOException $e) {
    // Xử lý lỗi nếu có
    die("Error: " . $e->getMessage());
}

// Tạo URL trang chủ động (ưu tiên domain từ DB, fallback theo host hiện tại)
$scheme = (!empty($_SERVER['REQUEST_SCHEME']))
    ? $_SERVER['REQUEST_SCHEME']
    : ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
$hostFromServer = $_SERVER['HTTP_HOST'] ?? '';
if (!empty($domain)) {
    $siteUrl = $scheme . '://' . trim($domain, '/') . '/';
} elseif (!empty($hostFromServer)) {
    $siteUrl = $scheme . '://' . trim($hostFromServer, '/') . '/';
} else {
    $siteUrl = '/';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?= GAME_NAME ?></title>
	<link rel="canonical" href="<?= htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:title" content="<?= GAME_NAME ?>" />
    <meta property="og:description" content="Website chính thức của <?= GAME_NAME ?> – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!" />
    <meta property="og:image" content="" />
    <link rel="shortcut icon" href="<?= FAVICON_PATH ?>">
    <meta name="description" content="Website chính thức của <?= GAME_NAME ?> – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="keywords" content="ngoc rong mobile, game ngoc rong, game 7 vien ngoc rong, game bay vien ngoc rong">
    <link rel="stylesheet" href="/public/dist/css/style.css">
    <link rel="stylesheet" href="/public/dist/css/main.css" />
    <link rel="stylesheet" href="/public/dist/css/main2.css" />
    <link rel="stylesheet" href="/public/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/dist/css/all.min.css" />
    <link rel="stylesheet" href="/public/dist/css/sweetalert2.min.css" />
    <link rel="stylesheet" href="/public/dist/css/notiflix-3.2.6.min.css" />
    <!-- <script src="http://nroblue.fun/public/dist/js/bootstrap.min.js"></script> -->
    <script src="/public/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/dist/js/jquery-3.6.0.min.js"></script>
    <script src="/public/dist/js/sweetalert2.min.js"></script>
    <script src="/public/dist/js/notiflix-3.2.6.min.js"></script>  
</head>
<body>
	<iframe src="music.php" style="display: none;" allow="autoplay"></iframe>
    <section class="ant-layout page-layout-color body-bg">
	<div class="clouds">
	<div class="cloud"></div>
	<div class="cloud"></div>
	</div>
        <main class="ant-layout-content page-body page-layout-color">
            <div class="page-layout-content">
                <div class="ant-row ant-row-space-around">
                    <div class="ant-col page-layout-header ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
                        <div class="page-layout-header-content">
                            <a href="/">
                                <img src="<?= LOGO_PATH ?>" class="header-logo" alt="<?= LOGO_ALT ?>"
                                    style="display: block;margin-left: auto;margin-right: auto;max-height: <?= LOGO_MAX_HEIGHT ?>; auto;max-width: <?= LOGO_MAX_WIDTH ?>;">

                                <!-- style="max-height: 120px; max-width: 70%" / -->
                            </a>
                            <div>
                   <?php
    if ($_login === null) {
        ?>
        <div class="container color-main2 pb-2">
            <div class="text-center">
                <div class="row">
                    <div class="col pr-0">
					<a type="button" href="/" class="ant-btn ant-btn-default header-btn-login mt-3 me-2">
                                        <span>Trang Chủ</span>
                                    </a>
                   <a type="button" href="../Pages/login.php" class="ant-btn ant-btn-default header-btn-login mt-3 me-2">
                                        <span>Đăng Nhập</span>
                                    </a>
                    
                   <a type="button" href="../Pages/reg.php" class="ant-btn ant-btn-default header-btn-login mt-3 me-2">
                                        <span>Đăng Ký</span>
                                    </a>
                   <a type="button" href="../nap-qr" class="ant-btn ant-btn-default header-btn-login mt-3">
                                        <span>Nạp Tiền</span>
                                    </a>
                </div>
            </div>
        </div>
    <?php } else {
        if ($_admin == 1) { // Kiểm tra quyền truy cập
            ?>
            <div class="container color-main2 pb-2">
                <div class="text-center">
                    <div class="row">
                    </div>
                </div>
            </div>
            <div class="container color-main pt-3 pb-4">
                <div class="text-center">
                    <div id="header-update"></div>
                
<div class="row ant-space ant-space-horizontal ant-space-align-center space-header-menu d-flex justify-content-center" style="flex-wrap:wrap;margin-bottom:-10px">
<div class="ant-space-item col-36 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../admincp">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                <i class="fa fa-cog fa-spin fa-1x fa-fw"></i> <b>Cpanel</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../profile.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Profile</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../nap-qr">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /fanpage">
                                                            <b>Nạp Tiền</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
 <!--<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../cap-nhat-thong-tin.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Cập Nhật Profile</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div> -->
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../pass2.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Pass Cấp 2</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../Pages/logout.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Logout</b>
                                                        </button>
                                                    </a>
                                               </div>
                                            </div>
                    <script>
                        function updateRemainingTime() {
                            fetch('../api/cauhinh/api-head.php')
                                .then(response => response.text())
                                .then(data => {
                                    document.getElementById("header-update").innerHTML = data;
                                })
                                .catch(error => console.error(error));
                        }

                        setInterval(updateRemainingTime, 500); // Cập nhật mỗi giây (1000ms)
                    </script>
                                                        
                </div>
            </div>
          
            <?php
        } else { ?>
            <div class="container color-main2 pb-2">
                <div class="text-center">
                    <div class="row">
                    
                    </div>
                </div>
            </div>
            <div class="container color-main pt-3 pb-4">
                <div class="text-center">
                    <!-- Trong phần HTML-->
                    <div id="header-update"></div>

                    <script>
                        // Sử dụng JavaScript và AJAX để gửi yêu cầu đến máy chủ và cập nhật nội dung của vùng hiển thị kết quả
                        function updateRemainingTime() {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function () {
                                if (this.readyState === 4 && this.status === 200) {
                                    // Nhận phản hồi từ máy chủ và cập nhật nội dung của vùng hiển thị kết quả
                                    document.getElementById("header-update").innerHTML = this.responseText;
                                }
                            };
                            xhttp.open("GET", "../api/cauhinh/api-head.php", true); // Thay đổi đường dẫn đến tệp PHP xử lý
                            xhttp.send();
                        }

                        // Tự động cập nhật thời gian mỗi giây
                        setInterval(updateRemainingTime, 100);
                    </script>

                    <div class="row ant-space ant-space-horizontal ant-space-align-center space-header-menu d-flex justify-content-center" style="flex-wrap:wrap;margin-bottom:-10px">
						<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../profile.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Profile</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
 <!-- <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../cap-nhat-thong-tin.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Cập Nhật Profile</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div> -->
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../pass2.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Pass Cấp 2</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>                                         
<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../Pages/logout.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Logout</b>
                                                        </button>
                                                    </a>
                                               </div>
                                            </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-center">
                 </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
                            </div>
                            <div class="ant-col ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
                                <div class="ant-row ant-row-space-around ant-row-middle header-menu">
                                    <div class="ant-col ant-col-24">
                                        <div class="row ant-space ant-space-horizontal ant-space-align-center space-header-menu d-flex justify-content-center" style="flex-wrap:wrap;margin-bottom:-10px">
                                            <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../mo-thanh-vien.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Mở Thành Viên</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>                                      
                                          <!--  <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../nap-so-du.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Nạp CARD</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                             <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../nap-atm.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                            <b>Nạp Tiền</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../doi-thoi-vang.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item w-100 /recharge">
                                                            <b>Đổi Thỏi Vàng</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div> -->
                                            <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../doi-mat-khau.php">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /exchange">
                                                            <b>Đổi Mật Khẩu</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="../nap-qr">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /fanpage">
                                                            <b>Nạp Tiền</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            
											<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="<?= ZALO_MAIN_URL ?>">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /fanpage">
                                                            <b>BoxZalo Chính</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
											
                                            <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="https://zalo.me/g/wraaym774">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /fanpage">
                                                            <b>BoxZaloEvent</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
											
											<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="https://www.facebook.com/profile.php?id=61574968000795">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100 /fanpage">
                                                            <b>Fanpage</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                          <!--  <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                                <div>
                                                    <a href="https://t.me/+SPVbxFHdayNmOTRl">
                                                        <button type="button" class="ant-btn ant-btn-default header-menu-item w-100 /fanpage">
                                                            <b>Box Telegram</b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">-->
                                            <!--    <div>-->
                                            <!--        <a href="Link zalo">-->
                                            <!--            <button type="button" class="ant-btn ant-btn-default header-menu-item w-100 /fanpage">-->
                                            <!--                <b>BoxZalo SV3</b>-->
                                            <!--            </button>-->
                                            <!--        </a>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">-->
                                            <!--    <div>-->
                                            <!--        <a href="Link zalo">-->
                                            <!--            <button type="button" class="ant-btn ant-btn-default header-menu-item w-100 /fanpage">-->
                                            <!--                <b>BoxZalo SV4</b>-->
                                            <!--            </button>-->
                                            <!--        </a>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="marquee-container">
						<div class="marquee-wrapper">
							<div class="marquee-text">Chào Mừng Cư Dân Đến Với <?= GAME_NAME ?>. Hãy Tải Game Và Chiến Ngay Nào.</div>
						</div>
					</div>
                    <div class="ant-col ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
                        <div class="ant-row ant-row-space-around ant-row-middle header-menu">
                            <div class="ant-col ant-col-24">
                                <div class="row ant-space ant-space-horizontal ant-space-align-center space-header-menu d-flex justify-content-center" style="flex-wrap:wrap;margin-bottom:-10px">
                                    <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                        <div>
                                            <a href="<?= DOWNLOAD_ANDROID_URL ?>">
                                                <button style="height:45px" type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                    <img src="/public/images/0hrzmer.png" style="width:97px" />
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                        <div>
                                            <a href="<?= DOWNLOAD_WINDOWS_URL ?>">
                                                <button style="height:45px" type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                    <img src="/public/images/RAGk2Dn.png" style="width:97px" />
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                        <div>
                                            <a href="<?= DOWNLOAD_IOS_URL ?>">
                                                <button style="height:45px" type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                    <img src="/public/images/XnpBrRa.png" style="width:97px" />
                                                </button>
                                            </a>
                                        </div>
                                    </div>                                    
									<div class="ant-space-item col-6 col-md-3 col-lg-2" style="padding-bottom:10px">
                                        <div>
                                            <a href="../bang-xep-hang.php">
                                                <button style="height:45px" type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active w-100">
                                                    <b>Bảng Xếp Hạng</b>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="ant-space-item" style="padding-bottom:10px">
                                        <div>
                                            <a href="">
                                                <button style="height:45px" type="button" class="ant-btn ant-btn-default header-menu-item header-menu-item-active">
                                                    <img src="http://nroreal.me/public/images/qEPYtv1.png" style="width:97px" />
                                                </button>
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
