<?php
#Duong Huynh Khanh Dang
include '../core/connect.php';
include '../core/cauhinh.php';
include '../core/bank_config.php';
include '../DHKD/Session.php';

// Kiểm tra đăng nhập - nếu chưa đăng nhập thì chuyển về trang đăng nhập
if ($_Login !== "on" || $_Users === null) {
    header("Location: /dang-nhap.php");
    exit();
}

// Lấy thông tin user
$_id = $_Id;

include '../core/head.php';
?>
    <div class="ant-col ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
        <div class="page-layout-body">
            <!-- load view -->
            <div class="ant-row">
                <div class="ant-col ant-col-24 home_page_bodyTitleList__UdhN_">💳 Nạp Tiền Game</div>
            </div>
            <div class="ant-col ant-col-24">
                <div class="ant-list ant-list-split">
                    <div class="ant-spin-nested-loading">
                        <div class="ant-spin-container">
                            <ul class="ant-list-items">
                                
                                <div class="container pt-5 pb-5">
                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="alert alert-info">
                                                <strong>Thông tin ngân hàng:</strong><br>
                                                Ngân hàng: <?= BANK_NAME ?><br>
                                                Số tài khoản: <?= BANK_ACCOUNT_NUMBER ?><br>
                                                Tên tài khoản: <?= BANK_ACCOUNT_NAME ?>
                                            </div>
                                            
                                            <h4>Thông tin thanh toán</h4>
                                            <form id="payment-form">
                                                <div class="form-group">
                                                    <label><span class="text-danger">*</span> Số tiền (VNĐ):</label>
                                                    <input type="number" id="amount" class="form-control" placeholder="Nhập số tiền" value="100000" min="<?= PAYMENT_MIN_AMOUNT ?>" max="<?= PAYMENT_MAX_AMOUNT ?>" step="1000">
                                                    <small class="form-text text-muted">Tối thiểu: <?= number_format(PAYMENT_MIN_AMOUNT) ?> VNĐ - Tối đa: <?= number_format(PAYMENT_MAX_AMOUNT) ?> VNĐ</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account ID:</label>
                                                    <input type="text" id="accountId" class="form-control" value="<?= $_id ?>" readonly>
                                                    <small class="form-text text-muted">Account ID của bạn</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mã thanh toán:</label>
                                                    <input type="text" id="paymentCode" class="form-control" value="NAPCK<?= $_id ?>" readonly>
                                                </div>
                                            </form>
                                            
                                            <div id="qr-payment-section" style="margin-top: 30px;">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>📱 Thanh toán bằng QR Code</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="bank-info">
                                                                    <p><strong>Ngân hàng:</strong> <span id="qr-bank-name"><?= BANK_NAME ?></span></p>
                                                                    <p><strong>Số tài khoản:</strong> <span id="qr-account-number"><?= BANK_ACCOUNT_NUMBER ?></span></p>
                                                                    <p><strong>Tên tài khoản:</strong> <span id="qr-account-name"><?= BANK_ACCOUNT_NAME ?></span></p>
                                                                    <p><strong>Số tiền:</strong> <span id="qr-amount">100,000 VNĐ</span></p>
                                                                    <p><strong>Mã thanh toán:</strong> <span id="qr-payment-code">NAPCK<?= $_id ?></span></p>
                                                                    <p><strong>Thời gian hết hạn:</strong> <span id="qr-expires">24 giờ</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <img id="qr-code-image" src="https://qr.sepay.vn/img?acc=<?= BANK_ACCOUNT_NUMBER ?>&bank=<?= BANK_CODE ?>&amount=100000&des=NAPCK<?= $_id ?>&template=<?= QR_TEMPLATE ?>&download=<?= QR_DOWNLOAD ?>" alt="QR Code" style="max-width: 250px; height: auto; border: 2px solid #ddd; border-radius: 10px; padding: 10px;">
                                                                <div class="mt-3">
                                                                    <button type="button" class="btn btn-success btn-sm" onclick="downloadQRCode()">📥 Tải QR Code</button>
                                                                    <button type="button" class="btn btn-info btn-sm" onclick="copyPaymentInfo()">📋 Copy thông tin</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h6>📋 Hướng dẫn thanh toán:</h6>
                                                            <ol>
                                                                <li>Mở ứng dụng ngân hàng trên điện thoại</li>
                                                                <li>Quét mã QR hoặc chuyển khoản theo thông tin trên</li>
                                                                <li>Nhập đúng nội dung chuyển khoản: <strong>NAPCK + <?= $_id ?></strong></li>
                                                                <li>Chờ hệ thống xác nhận (1-5 phút)</li>
                                                                <li>Kiểm tra tài khoản game sau khi thanh toán</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateQRCode() {
            var amount = document.getElementById('amount').value;
            var accountId = document.getElementById('accountId').value;
            
            if (!amount || amount <= 0) {
                alert('Vui lòng nhập số tiền hợp lệ!');
                return;
            }
            
            // Show loading
            var button = document.querySelector('button[onclick="generateQRCode()"]');
            var originalText = button.textContent;
            button.textContent = 'Đang tạo...';
            button.disabled = true;
            
            // Call API to generate payment code
            fetch('../api/generate-payment-code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: amount,
                    account_id: accountId || null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update payment code field
                    document.getElementById('paymentCode').value = data.payment_code;
                    
                    // Update QR section
                    document.getElementById('qr-amount').textContent = formatMoney(amount);
                    document.getElementById('qr-payment-code').textContent = data.payment_code;
                    document.getElementById('qr-expires').textContent = '24 giờ';
                    
                    // Generate QR code URL
                    var qrUrl = 'https://qr.sepay.vn/img?' + 
                        'acc=' + encodeURIComponent('<?= BANK_ACCOUNT_NUMBER ?>') +
                        '&bank=' + encodeURIComponent('<?= BANK_CODE ?>') +
                        '&amount=' + encodeURIComponent(amount) +
                        '&des=' + encodeURIComponent(data.payment_code) +
                        '&template=' + encodeURIComponent('<?= QR_TEMPLATE ?>') +
                        '&download=' + encodeURIComponent('<?= QR_DOWNLOAD ?>');
                    
                    // Update QR code image
                    document.getElementById('qr-code-image').src = qrUrl;
                    
                    // Show QR payment section
                    document.getElementById('qr-payment-section').style.display = 'block';
                    
                    // Scroll to QR section
                    document.getElementById('qr-payment-section').scrollIntoView({ 
                        behavior: 'smooth' 
                    });
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi tạo mã thanh toán!');
            })
            .finally(() => {
                // Restore button
                button.textContent = originalText;
                button.disabled = false;
            });
        }
        
        function formatMoney(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }
        
        function downloadQRCode() {
            var qrImage = document.getElementById('qr-code-image');
            var link = document.createElement('a');
            link.href = qrImage.src;
            link.download = 'qr-code-payment.png';
            link.click();
        }
        
        function copyPaymentInfo() {
            var bankInfo = 'Ngân hàng: ' + document.getElementById('qr-bank-name').textContent + '\n' +
                          'Số tài khoản: ' + document.getElementById('qr-account-number').textContent + '\n' +
                          'Tên tài khoản: ' + document.getElementById('qr-account-name').textContent + '\n' +
                          'Số tiền: ' + document.getElementById('qr-amount').textContent + '\n' +
                          'Nội dung: ' + document.getElementById('qr-payment-code').textContent;
            
            navigator.clipboard.writeText(bankInfo).then(function() {
                alert('✅ Đã copy thông tin thanh toán!');
            }).catch(function() {
                // Fallback for older browsers
                var textArea = document.createElement('textarea');
                textArea.value = bankInfo;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert('✅ Đã copy thông tin thanh toán!');
            });
        }
        
        // Auto-generate QR code when page loads and update when amount changes
        document.addEventListener('DOMContentLoaded', function() {
            var amountInput = document.getElementById('amount');
            
            // Generate default QR code on page load
            generateDefaultQRCode();
            
            // Update QR code when amount changes
            amountInput.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                }
                generateDefaultQRCode();
            });
            
            // Ngăn nhập số âm khi paste
            amountInput.addEventListener('paste', function(e) {
                setTimeout(function() {
                    if (amountInput.value < 0) {
                        amountInput.value = 0;
                    }
                    generateDefaultQRCode();
                }, 10);
            });
        });
        
        function generateDefaultQRCode() {
            var amount = document.getElementById('amount').value || '100000';
            var accountId = document.getElementById('accountId').value; // Luôn có giá trị từ PHP
            var paymentCode = document.getElementById('paymentCode').value; // Mã thanh toán đã cố định
            
            // Update QR section
            document.getElementById('qr-amount').textContent = formatMoney(amount);
            document.getElementById('qr-expires').textContent = '24 giờ';
            
            // Generate QR code URL
            var qrUrl = 'https://qr.sepay.vn/img?' + 
                'acc=' + encodeURIComponent('<?= BANK_ACCOUNT_NUMBER ?>') +
                '&bank=' + encodeURIComponent('<?= BANK_CODE ?>') +
                '&amount=' + encodeURIComponent(amount) +
                '&des=' + encodeURIComponent(paymentCode) +
                '&template=' + encodeURIComponent('<?= QR_TEMPLATE ?>') +
                '&download=' + encodeURIComponent('<?= QR_DOWNLOAD ?>');
            
            // Update QR code image
            document.getElementById('qr-code-image').src = qrUrl;
        }
    </script>
<?php include '../core/footer.php'; ?>
</body>
</html>
