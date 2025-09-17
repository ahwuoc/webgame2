<?php
#Duong Huynh Khanh Dang
include '../core/connect.php';
include '../core/cauhinh.php';
include '../DHKD/Session.php';

// Kiểm tra đăng nhập - nếu chưa đăng nhập thì chuyển về trang đăng nhập
if ($_Login !== "on" || $_Users === null) {
    header("Location: /dang-nhap.php");
    exit();
}

// Lấy thông tin user
$_id = $_Id;
$_username = $_Users;

include '../core/head.php';
?>
    <div class="ant-col ant-col-xs-24 ant-col-sm-24 ant-col-md-24">
        <div class="page-layout-body">
            <!-- load view -->
            <div class="ant-row">
                <div class="ant-col ant-col-24 home_page_bodyTitleList__UdhN_">📊 Lịch sử nạp tiền</div>
            </div>
            <div class="ant-col ant-col-24">
                <div class="ant-list ant-list-split">
                    <div class="ant-spin-nested-loading">
                        <div class="ant-spin-container">
                            <ul class="ant-list-items">
                                
                                <div class="container pt-5 pb-5">
                                    <div class="row">
                                        <div class="col-lg-10 offset-lg-1">
                                            
                                            <!-- Tiêu đề trang -->
                                            <div class="text-center mb-4">
                                                <h4>🏦 Lịch sử chuyển khoản ngân hàng</h4>
                                            </div>
                                            
                                            <!-- Bảng lịch sử chuyển khoản ngân hàng -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Tài khoản</th>
                                                                    <th>Số tiền</th>
                                                                    <th>Ngân hàng</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Thời gian</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // Lấy lịch sử từ bảng mbbank_log
                                                                $stmt = $conn->prepare("SELECT * FROM mbbank_log WHERE name = :username ORDER BY date DESC LIMIT 20");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $banking_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                
                                                                if (count($banking_history) > 0) {
                                                                    $count = 1;
                                                                    foreach ($banking_history as $row) {
                                                                        echo '<tr>
                                                                            <td>' . $count . '</td>
                                                                            <td>' . htmlspecialchars($row['name']) . '</td>
                                                                            <td>' . number_format($row['amount']) . ' VNĐ</td>
                                                                            <td>' . htmlspecialchars($row['bankName']) . '</td>
                                                                            <td><span class="badge bg-success">Thành công</span></td>
                                                                            <td>' . date('d/m/Y H:i:s', strtotime($row['date'])) . '</td>
                                                                        </tr>';
                                                                        $count++;
                                                                    }
                                                                } else {
                                                                    echo '<tr><td colspan="6" class="text-center text-muted">Chưa có lịch sử chuyển khoản ngân hàng</td></tr>';
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Thống kê tổng quan -->
                                            <div class="row mt-4">
                                                <div class="col-md-6">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">💰 Tổng nạp</h5>
                                                            <h3 class="text-success">
                                                                <?php
                                                                $stmt = $conn->prepare("SELECT SUM(amount) as total FROM mbbank_log WHERE name = :username");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $total_banking = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
                                                                echo number_format($total_banking) . ' VNĐ';
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">📊 Số giao dịch</h5>
                                                            <h3 class="text-info">
                                                                <?php
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM mbbank_log WHERE name = :username");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $count_banking = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                echo $count_banking;
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Nút quay lại -->
                                            <div class="text-center mt-4">
                                                <a href="/Pages/nap-qr.php" class="btn btn-primary">
                                                    ← Quay lại nạp tiền
                                                </a>
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


<?php include '../core/footer.php'; ?>
</body>
</html>
