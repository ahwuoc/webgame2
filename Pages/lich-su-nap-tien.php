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
                                                <h4>💰 Lịch sử nạp tiền</h4>
                                            </div>
                                            
                                            <!-- Bảng lịch sử nạp tiền -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Mã SePay</th>
                                                                    <th>Số tiền</th>
                                                                    <th>Cổng thanh toán</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Thời gian</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // Lấy lịch sử từ bảng sepay_transactions
                                                                $stmt = $conn->prepare("SELECT * FROM sepay_transactions WHERE account_id = :account_id ORDER BY id DESC LIMIT 20");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $recharge_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                
                                                                if (count($recharge_history) > 0) {
                                                                    $count = 1;
                                                                    foreach ($recharge_history as $row) {
                                                                        $status_badge = '';
                                                                        switch ($row['status']) {
                                                                            case 'completed':
                                                                                $status_badge = '<span class="badge bg-success">Thành công</span>';
                                                                                break;
                                                                            case 'failed':
                                                                                $status_badge = '<span class="badge bg-danger">Thất bại</span>';
                                                                                break;
                                                                            case 'pending':
                                                                                $status_badge = '<span class="badge bg-warning">Chờ duyệt</span>';
                                                                                break;
                                                                            default:
                                                                                $status_badge = '<span class="badge bg-secondary">Không xác định</span>';
                                                                        }
                                                                        
                                                                        echo '<tr>
                                                                            <td>' . $count . '</td>
                                                                            <td>' . htmlspecialchars($row['sepay_id']) . '</td>
                                                                            <td>' . number_format($row['transfer_amount']) . ' VNĐ</td>
                                                                            <td>' . htmlspecialchars($row['gateway']) . '</td>
                                                                            <td>' . $status_badge . '</td>
                                                                            <td>' . htmlspecialchars($row['created_at']) . '</td>
                                                                        </tr>';
                                                                        $count++;
                                                                    }
                                                                } else {
                                                                    echo '<tr><td colspan="6" class="text-center text-muted">Chưa có lịch sử nạp tiền</td></tr>';
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Thống kê tổng quan -->
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">💰 Tổng nạp</h5>
                                                            <h3 class="text-success">
                                                                <?php
                                                                $stmt = $conn->prepare("SELECT SUM(transfer_amount) as total FROM sepay_transactions WHERE account_id = :account_id AND status = 'completed'");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $total_recharge = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
                                                                echo number_format($total_recharge) . ' VNĐ';
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">📊 Số giao dịch</h5>
                                                            <h3 class="text-info">
                                                                <?php
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM sepay_transactions WHERE account_id = :account_id");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $count_recharge = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                echo $count_recharge;
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">✅ Thành công</h5>
                                                            <h3 class="text-success">
                                                                <?php
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM sepay_transactions WHERE account_id = :account_id AND status = 'completed'");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $success_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                echo $success_count;
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
