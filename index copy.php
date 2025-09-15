<?php
require_once 'core/connect.php';
require_once 'core/set.php';
require_once 'core/cauhinh.php';
include_once 'core/head.php';


?>
					<div class="ant-col ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
                        <div class="page-layout-body">
                            <!-- load view -->
                            <div class="ant-row">
								<div class="dragonball-title">
									Bảng Thông Tin
								</div>
							</div>
								<div class="ant-col ant-col-24">
									<div class="ant-list ant-list-split">
										<div class="ant-spin-nested-loading">
										<div class="ant-spin-container">
											<ul class="ant-list-items">
                                            <div id="data_news">
											<li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/16.php"> SỰ KIỆN HÈ 2025 – KHÁM PHÁ BIỂN XANH, SĂN QUÀ CỰC ĐÃ!
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 1/06/2025</div>
													</div>
												</div>
                                            </li>
                                            <li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/15.php">TÍNH NĂNG MỚI: ĐỆ TỬ MỚI
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 30/05/2025</div>
													</div>
												</div>
                                            </li>
											<li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/17.php">GIFTCODE
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 1/06/2025</div>
													</div>
												</div>
                                            </li>
                                            <li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/9.php">Hướng Dẫn Mở Thành Viên
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 21/02/2025</div>
													</div>
												</div>
                                            </li>
											<li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/12.php">Hướng Dẫn Kiếm Vàng Ngọc
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 21/02/2025</div>
													</div>
												</div>
                                            </li>
											<li class="ant-list-item home_page_listItem__GD_iE">
												<img src="public/images/avataradm.gif" class="home_page_listItemAvatar__cXjbm" />
													<div class="ant-list-item-meta home_page_listItemTitle__YB3V5">
														<div class="ant-list-item-meta-content">
															<h4 class="ant-list-item-meta-title">
																<a href="/news/13.php">Các Cơ Chế Tổng Hợp
																	<img src="image/new.gif" alt="New" />
																</a>
															</h4>
														<div class="ant-list-item-meta-description">Đăng bởi: <b style="color: red;">ADMIN</b> - Ngày: 21/02/2025</div>
													</div>
												</div>
                                            </li>		
                                        </div>
									<div id="paging" class="d-flex justify-content-end align-items-center flex-wrap">
								</div>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--</div>-->

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
        }
		
		@keyframes glow {
  0% { box-shadow: 0 0 5px #ff9800; }
  50% { box-shadow: 0 0 15px #ff9800; }
  100% { box-shadow: 0 0 5px #ff9800; }
}

.home_page_listItemAvatar__cXjbm {
    width: 64px;
    height: 64px;
    margin-right: 16px;
    border-radius: 50%;
    border: 2px solid #ffa726;
    background-color: white;
    box-shadow: 0 0 12px #ffb74d, 0 0 6px #ffa726;
    transition: box-shadow 0.3s ease;
    animation: glow 2.5s infinite ease-in-out;
}

.home_page_listItem__GD_iE:hover .home_page_listItemAvatar__cXjbm {
    box-shadow: 0 0 16px #ff9800, 0 0 8px #fb8c00;
}

.home_page_listItem__GD_iE:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(255, 167, 38, 0.5);
}

.home_page_listItem__GD_iE {
    display: flex;
    align-items: center;
    border-radius: 12px;
    background: linear-gradient(to right, #07f3f7, #ffe4b5); /* màu nền vàng sáng nổi hơn */
    border: 1px solid #ffcc80; /* viền mỏng hơn */
    padding: 16px 24px;
    margin: 16px 20px; /* căn gần mép trái/phải nhưng không sát */
    box-shadow: 0 4px 12px rgba(255, 167, 38, 0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-sizing: border-box;
}


.home_page_listItemTitle__YB3V5 {
    flex: 1;
    background-color: rgba(255, 255, 255, 0.65);
    padding: 8px 12px;
    border-radius: 10px;
    border-left: 4px solid #ffa726;
    box-shadow: inset 0 0 6px rgba(255, 171, 0, 0.2);
}

.ant-list-item-meta-title a {
    color: #e65100;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    transition: color 0.2s;
}

.ant-list-item-meta-title a:hover {
    color: #bf360c;
    text-decoration: underline;
}

.ant-list-item-meta-description {
    margin-top: 4px;
    color: #5d4037;
    font-size: 14px;
}
    </style>
</head>
<body>
<iframe src="/core/music.php" style="display: none;" allow="autoplay"></iframe>

<!--<div class="content-banner-slide">-->
<!--    <div class="slider">-->
<!--        <div class="row position-relative">-->
<!--            <div class="col-12 slider_in">-->
<!--                <div class="swiper-container mySwiper slider_detail swiper-container-horizontal">-->
<!--                    <div class="swiper-wrapper">-->
<!--                        <div class="swiper-slide">-->
<!--                            <a href="javascript:void(0)">-->
<!--                                <img src="https://ngocrongiron.com/frontend/images/game/traidat_banner.png" alt="traidat_banner" class="img-fluid swiper-lazy w-100 loading_lazy" data-ignore="true">-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="swiper-slide">-->
<!--                            <a href="javascript:void(0)">-->
<!--                                <img src="https://ngocrongiron.com/frontend/images/game/namec_banner.png" alt="namec_banner" class="img-fluid swiper-lazy w-100 loading_lazy" data-ignore="true">-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="swiper-slide">-->
<!--                            <a href="javascript:void(0)">-->
<!--                                <img src="https://ngocrongiron.com/frontend/images/game/saiyan_banner.png" alt="saiyan_banner" class="img-fluid swiper-lazy w-100 loading_lazy" data-ignore="true">-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img class="swiper-button-prev" src="/an_remake/images/logo/mui_ten_2.png" alt="Previous">-->
<!--                    <img class="swiper-button-next" src="/an_remake/images/logo/mui_ten_1.png" alt="Next">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mySwiper = new Swiper('.mySwiper', {
            loop: true,
            centeredSlides: true,
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
            },
        });
    });
</script>
<script>
function showCharacters(id) {
    // Ẩn hết
    const containers = document.querySelectorAll('.character-container');
    containers.forEach(c => c.style.display = 'none');

    // Hiện container theo id
    const selected = document.getElementById(id);
    if (selected) {
        selected.style.display = 'flex';
    }
}
</script>
</body>
</html>
<div class="page-layout-body" style="margin-top: 16px;">
    <div class="col">
        <div class="ant-row">
			<div class="dragonball-title">
				Giới thiệu NRO <?= GAME_NAME ?>
			</div>
		</div>
       <!-- Hành tinh xoay + Nhân vật -->
<!-- Container cho từng hành tinh -->
<div class="planet-container mt-3">
    <div class="planet" onclick="showCharacters('earth')">
        <img src="image/earth.png" alt="Earth">
    </div>
    <div class="planet" onclick="showCharacters('namek')">
        <img src="image/namek.png" alt="Namek">
    </div>
    <div class="planet" onclick="showCharacters('saiyan')">
        <img src="image/saiyan.png" alt="Saiyan">
    </div>
</div>

<!-- Nhân vật từng hành tinh -->
<div id="earth" class="character-container">
    <div class="character-box"><img src="image/gohan.webp" alt="Gohan">
		<div class="char-name">Gohan</div>
	</div>
    <div class="character-box"><img src="image/krillin.png" alt="Krillin">
		<div class="char-name">Krillin</div>
	</div>
    <div class="character-box"><img src="image/yamcha.png" alt="Yamcha">
		<div class="char-name">Yamcha</div>
	</div>
</div>

<div id="namek" class="character-container">
    <div class="character-box"><img src="image/piccolo.png" alt="Piccolo">
		<div class="char-name">Piccolo</div>
	</div>
    <div class="character-box"><img src="image/kami.png" alt="Kami">
		<div class="char-name">Kami</div>
	</div>
    <div class="character-box"><img src="image/dende.webp" alt="Dende">
		<div class="char-name">Dende</div>
	</div>
</div>

<div id="saiyan" class="character-container">
    <div class="character-box"><img src="image/vegeta.webp" alt="Vegeta">
		<div class="char-name">Vegeta</div>
	</div>
    <div class="character-box"><img src="image/goku.png" alt="Goku">
		<div class="char-name">Goku</div>
	</div>
    <div class="character-box"><img src="image/raditz.webp" alt="Raditz">
		<div class="char-name">Raditz</div>
	</div>
</div>
<div class="planet-info">
    <h5>🌍 Hành Tinh Trái Đất (Earth)
        <img src="image/hot.gif" alt="Hot" class="icon-hot">
    </h5>
    <ul>
        <li><strong>Gohan:</strong> Con trai của Goku, thông minh, mạnh mẽ và là niềm hy vọng của Trái Đất trong nhiều trận chiến.</li>
        <li><strong>Krillin:</strong> Chiến binh quả cảm, người bạn thân thiết luôn sát cánh bên Goku từ những ngày đầu.</li>
        <li><strong>Yamcha:</strong> Cựu sơn tặc với kỹ năng sói hoang độc đáo, luôn hết mình vì chính nghĩa.</li>
    </ul>

    <h5>🟢 Hành Tinh Namek
        <img src="image/hot.gif" alt="Hot" class="icon-hot">
    </h5>
    <ul>
        <li><strong>Piccolo:</strong> Namekian mạnh mẽ, ban đầu là đối thủ của Goku nhưng sau này trở thành đồng minh trung thành.</li>
        <li><strong>Kami:</strong> Thần Trái Đất nguyên bản, đại diện cho trí tuệ và sự điềm tĩnh.</li>
        <li><strong>Dende:</strong> Truyền nhân của Kami, có khả năng hồi phục tuyệt vời và là Thần Trái Đất hiện tại.</li>
    </ul>

    <h5>🔴 Hành Tinh Saiyan
        <img src="image/hot.gif" alt="Hot" class="icon-hot">
    </h5>
    <ul>
        <li><strong>Goku:</strong> Chiến binh Saiyan mạnh nhất, mang trong mình tinh thần không bao giờ bỏ cuộc.</li>
        <li><strong>Vegeta:</strong> Hoàng tử của người Saiyan, kiêu hãnh, mạnh mẽ và luôn khao khát vượt qua Goku.</li>
        <li><strong>Raditz:</strong> Anh trai của Goku, tàn nhẫn nhưng mở đầu cho hành trình Saiyan trên Trái Đất.</li>
    </ul>
</div>
    </div>
	</div>
	</div>
    <div class="page-layout-body" style="margin-top: 16px;">
    <div class="col">
        <div class="ant-row">
            <div class="dragonball-title">
                Sơ Lược Về Game
            </div>
        </div>

        <!-- Thêm khung ảnh ở đây -->
        <div class="game-image-gallery">
    <!-- Nhóm ảnh Cơ bản -->
    <div class="image-group">
        <h5 class="group-title">🔹 Kỹ năng Cơ bản</h5>
        <div class="image-row">
            <img src="image/gif_maphongba.gif" alt="Cơ bản 1">
            <img src="image/gif_gif_Saiyain.gif" alt="Cơ bản 2">
            <img src="image/gif_supber_kame.gif" alt="Cơ bản 3">
        </div>
    </div>

    <!-- Nhóm ảnh VIP -->
    <div class="image-group">
        <h5 class="group-title">🔸 Kỹ năng VIP</h5>
        <div class="image-row">
            <img src="image/gif_maphongba_VIP.gif" alt="VIP 1">
            <img src="image/gif_gif_Saiyain_VIP.gif" alt="VIP 2">
            <img src="image/gif_supber_kame_VIP.gif" alt="VIP 3">
        </div>
		</div>
	</div>
    </div>
	<div class="game-intro">
		<p><?= GAME_NAME ?> &ndash; game nhập vai trực tuyến với cốt truyện v&agrave; nh&acirc;n vật dựa tr&ecirc;n bộ truyện tranh nổi tiếng Nhật Bản Dragon Ball đ&atilde; từng l&agrave;m say l&ograve;ng bao nhi&ecirc;u thế hệ độc giả Việt Nam. Bạn sẽ chọn tiếp nhận h&agrave;nh tinh n&agrave;o, Tr&aacute;i Đất, Namếc hay Xayda? Cuộc h&agrave;nh tr&igrave;nh t&igrave;m kiếm ngọc rồng v&agrave; chống lại thế lực hung &aacute;c sẽ do bạn quyết định, vận mệnh lu&ocirc;n nằm trong tay người được chọn.</p>
		<p>C&ugrave;ng với sự hướng dẫn của c&aacute;c bậc tiền bối v&agrave; sự nỗ lực của bản th&acirc;n, bạn c&oacute; thể đạt đến sức mạnh vượt trội trở th&agrave;nh những chiến binh si&ecirc;u hạng. Ngo&agrave;i ra, bạn sẽ kh&ocirc;ng phải chiến đấu đơn độc khi xung quanh bạn l&agrave; bạn b&egrave; v&agrave; những chiến binh c&ugrave;ng ch&iacute; hướng, c&ugrave;ng hỗ trợ lẫn nhau đối đầu với c&aacute;c thế lực hắc &aacute;m.</p>
		<p><?= GAME_NAME ?>&agrave; tr&ograve; chơi trực tuyến đa nền tảng. Bạn c&oacute; thể chơi được tr&ecirc;n mọi nền tảng từ m&aacute;y t&iacute;nh PC Windows, iPhone, c&aacute;c d&ograve;ng m&aacute;y chạy hệ điều h&agrave;nh Android, Windows Phone đến c&aacute;c cả bản Java chạy tr&ecirc;n S40, S60 cũ của Nokia. Với chất lượng cao v&agrave; tốc độ mượt m&agrave; tr&ecirc;n c&aacute;c loại đường truyền mạng ADSL, 3G, GPRS.</p>
		<p>Tr&ograve; chơi th&iacute;ch hợp với mọi lứa tuổi. Điều khiển trực tiếp nh&acirc;n vật rất dễ d&agrave;ng tr&ecirc;n m&agrave;n h&igrave;nh cảm ứng. Khi chơi tr&ecirc;n PC bạn chỉ cần d&ugrave;ng chuột, hoặc linh hoạt điều khiển nh&acirc;n vật với b&agrave;n ph&iacute;m cứng điện thoại Nokia S40, S60.</p>
	</div>
</div>

<script>
    function show_background() {
        $("#waiting_handle").removeClass("d-none");
    }
    function hide_background() {
        $("#waiting_handle").addClass("d-none");
    }
    $(document).ready(function() {
        // $("#modal_main").modal('show');
        $("#show_form_login").click(function() {
            $('#form_login').modal('show');
            $("#login_form_detail").removeClass("d-none");
            $("#register_form_detail").addClass("d-none");
        });
        $("#show_form_register").click(function() {
            $('#form_login').modal('show');
            $("#login_form_detail").addClass("d-none");
            $("#register_form_detail").removeClass("d-none");
        });
        $(".ant-input-suffix").click(function() {
            $(this).siblings().prop("type", $(this).siblings().attr("type") == "text" ? "password" : "text");
        });
        $("#register_now").click(function() {
            $("#login_form_detail").addClass("d-none");
            $("#register_form_detail").removeClass("d-none");
        });
        $("#login_now").click(function() {
            $("#login_form_detail").removeClass("d-none");
            $("#register_form_detail").addClass("d-none");
        });
        $("#username, #password").keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                login();
            }
        });
        $("#submit_login").click(function() {
            login();
        })
        $("#username_register, #password_register").keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                register();
            }
        });
        $("#submit_register").click(function() {
            register();
        })
        // $("#register_now, #register").click(function() {
        //     $("#modal_login").modal("hide");
        //     $("#modal_register").modal("show");
        // })
        // $("#login_now2").click(function() {
        //     $("#modal_login").modal("show");
        //     $("#modal_register").modal("hide");
        // })
        $("#btn_login").click(function() {
            $("#btn_login").text("Đang đăng nhập");
            $("#btn_login").prop('disabled', true);
            const username = $("#username_login").val();
            const password = $("#password_login").val();
            if (!username || !password) {
                $("#error_login").text("Tài khoản hoặc mật khẩu không được bỏ trống");
                $("#error_login").removeClass("d-none");
                $("#btn_login").text("Đăng nhập");
                $("#btn_login").prop('disabled', false);
                return;
            } else {
                $("#error_login").addClass("d-none");
                // $("form_login").submit();
            }
            $.ajax({
                url: 'http://nroreal.me/ajax_login',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                }
            }).done(function(data) {
                if (data == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: "Đăng nhập thành công",
                    });
                } else {
                    $("#error_login").removeClass("d-none");
                    $("#error_login").text(data);
                    $("#btn_login").text("Đăng nhập");
                    $("#btn_login").prop('disabled', false);
                }
            });
        })
        $("#btn_register").click(function() {
            $("#btn_register").text("Đang đăng ký");
            $("#btn_register").prop('disabled', true);
            // $("#success_register").addClass("d-none");
            const username = $("#username_register").val();
            const password = $("#password_register").val();
            const confirm_password = $("#confirm_password").val();
            if (!username || !password || !confirm_password) {
                $("#error_register").text("Tài khoản mật khẩu không được bỏ trống");
                $("#error_register").removeClass("d-none");
                $("#btn_register").text("Đăng ký");
                $("#btn_register").prop('disabled', false);
                return;
            }
            if (username.length < 6 || password.length < 6) {
                $("#error_register").text("Tài khoản, mật khẩu có độ dài từ 6 kí tự");
                $("#error_register").removeClass("d-none");
                $("#btn_register").text("Đăng ký");
                $("#btn_register").prop('disabled', false);
                return;
            }
            if (password != confirm_password) {
                $("#error_register").text("Mật khẩu xác nhận không trùng khớp");
                $("#error_register").removeClass("d-none");
                $("#btn_register").text("Đăng ký");
                $("#btn_register").prop('disabled', false);
                return;
            }
            $("#error_register").addClass("d-none");
            $.ajax({
                url: 'http://nroreal.me/ajax_register',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    confirm_password: confirm_password
                }
            }).done(function(data) {
                if (data == "success") {
                    $("#error_register").addClass("d-none");
                    $("#username_register").val("");
                    $("#password_register").val("");
                    $("#confirm_password").val("");
                    Swal.fire({
                        icon: 'success',
                        title: "Đăng ký tài khoản thành công",
                    });
                } else {
                    $("#error_register").removeClass("d-none");
                    $("#error_register").text(data);
                }
                $("#btn_register").text("Đăng ký");
                $("#btn_register").prop('disabled', false);
            });
        })
                    })
    function login() {
        Notiflix.Loading.hourglass();
        $("#submit_login").text("Đang thực hiện");
        $("#submit_login").prop('disabled', true);
        const username = $("#username").val();
        const password = $("#password").val();
        if (!username || !password) {
            Swal.fire({
                icon: 'error',
                title: 'Điền đầy đủ tài khoản và mật khẩu',
            })
            $("#submit_login").text("Đăng nhập");
            $("#submit_login").prop('disabled', false);
            Notiflix.Loading.remove();
            return;
        }
        $.ajax({
            url: 'http://nroreal.me/login',
            type: 'POST',
            data: {
                username: username,
                password: password
            }
        }).done(function(data) {
            Notiflix.Loading.remove();
            if (data == "success") {
            } else {
                Swal.fire({
                    icon: 'error',
                    title: data,
                });
            }
            $("#submit_login").text("Đăng nhập");
            $("#submit_login").prop('disabled', false);
        });
    }
    function register() {
        Notiflix.Loading.hourglass();
        $("#submit_register").text("Đang thực hiện");
        $("#submit_register").prop('disabled', true);
        const username = $("#username_register").val();
        const password = $("#password_register").val();
        const confirm_password = $("#confirm_password").val();
        if (!username || !password || !confirm_password) {
            Swal.fire({
                icon: 'error',
                title: "Điền đầy đủ tài khoản và mật khẩu",
            });
            $("#submit_register").text("Đăng ký");
            $("#submit_register").prop('disabled', false);
            Notiflix.Loading.remove();
            return;
        }
        if (username.length < 6 || password.length < 6) {
            Swal.fire({
                icon: 'error',
                title: "Độ dài tài khoản và mật khẩu ít nhất 6 kí tự",
            });
            $("#submit_register").text("Đăng ký");
            $("#submit_register").prop('disabled', false);
            Notiflix.Loading.remove();
            return;
        }
        if (password != confirm_password) {
            Swal.fire({
                icon: 'error',
                title: "Mật khẩu không trùng khớp",
            });
            $("#submit_register").text("Đăng ký");
            $("#submit_register").prop('disabled', false);
            Notiflix.Loading.remove();
            return;
        }
        $.ajax({
            url: 'http://nroreal.me/register',
            type: 'POST',
            data: {
                username: username,
                password: password,
                confirm_password: confirm_password
            }
        }).done(function(data) {
            Notiflix.Loading.remove();
            if (data == "success") {
                $("#username_register").val("");
                $("#password_register").val("");
                $("#confirm_password").val("");
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng ký thành công',
                })
                Notiflix.Loading.hourglass();
                $.ajax({
                    url: 'http://nroreal.me/login',
                    type: 'POST',
                    data: {
                        username: username,
                        password: password
                    }
                }).done(function(data) {
                    Notiflix.Loading.remove();
                    if (data == "success") {
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data,
                        });
                    }
                    $("#submit_login").text("Đăng nhập");
                    $("#submit_login").prop('disabled', false);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: data,
                });
            }
            $("#submit_register").text("Đăng ký");
            $("#submit_register").prop('disabled', false);
        });
    }
</script>
<?php
include_once('core/footer.php');
?>