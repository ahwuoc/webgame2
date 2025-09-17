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
                                            
                                            <!-- Tabs để chuyển đổi giữa các loại lịch sử -->
                                            <ul class="nav nav-tabs mb-4" id="historyTabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="banking-tab" data-bs-toggle="tab" data-bs-target="#banking" type="button" role="tab">
                                                        🏦 Chuyển khoản ngân hàng
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="sepay-tab" data-bs-toggle="tab" data-bs-target="#sepay" type="button" role="tab">
                                                        💳 SePay
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab">
                                                        🛒 Đơn hàng
                                                    </button>
                                                </li>
                                            </ul>
                                            
                                            <!-- Tab content -->
                                            <div class="tab-content" id="historyTabsContent">
                                                
                                                <!-- Tab Chuyển khoản ngân hàng -->
                                                <div class="tab-pane fade show active" id="banking" role="tabpanel">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>🏦 Lịch sử chuyển khoản ngân hàng</h5>
                                                        </div>
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
                                                </div>
                                                
                                                <!-- Tab SePay -->
                                                <div class="tab-pane fade" id="sepay" role="tabpanel">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>💳 Lịch sử SePay</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tài khoản</th>
                                                                            <th>Số tiền</th>
                                                                            <th>Gateway</th>
                                                                            <th>Trạng thái</th>
                                                                            <th>Thời gian</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // Lấy lịch sử từ bảng sepay_transactions
                                                                        $stmt = $conn->prepare("SELECT * FROM sepay_transactions WHERE username = :username ORDER BY created_at DESC LIMIT 20");
                                                                        $stmt->bindParam(":username", $_username);
                                                                        $stmt->execute();
                                                                        $sepay_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                        
                                                                        if (count($sepay_history) > 0) {
                                                                            $count = 1;
                                                                            foreach ($sepay_history as $row) {
                                                                                $status_badge = '';
                                                                                switch ($row['status']) {
                                                                                    case 'completed':
                                                                                        $status_badge = '<span class="badge bg-success">Thành công</span>';
                                                                                        break;
                                                                                    case 'pending':
                                                                                        $status_badge = '<span class="badge bg-warning">Chờ xử lý</span>';
                                                                                        break;
                                                                                    case 'failed':
                                                                                        $status_badge = '<span class="badge bg-danger">Thất bại</span>';
                                                                                        break;
                                                                                    default:
                                                                                        $status_badge = '<span class="badge bg-secondary">' . $row['status'] . '</span>';
                                                                                }
                                                                                
                                                                                echo '<tr>
                                                                                    <td>' . $count . '</td>
                                                                                    <td>' . htmlspecialchars($row['username']) . '</td>
                                                                                    <td>' . number_format($row['transfer_amount']) . ' VNĐ</td>
                                                                                    <td>' . htmlspecialchars($row['gateway']) . '</td>
                                                                                    <td>' . $status_badge . '</td>
                                                                                    <td>' . date('d/m/Y H:i:s', strtotime($row['created_at'])) . '</td>
                                                                                </tr>';
                                                                                $count++;
                                                                            }
                                                                        } else {
                                                                            echo '<tr><td colspan="6" class="text-center text-muted">Chưa có lịch sử SePay</td></tr>';
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Tab Đơn hàng -->
                                                <div class="tab-pane fade" id="order" role="tabpanel">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>🛒 Lịch sử đơn hàng</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Mã đơn hàng</th>
                                                                            <th>Số tiền</th>
                                                                            <th>Loại</th>
                                                                            <th>Trạng thái</th>
                                                                            <th>Thời gian</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // Lấy lịch sử từ bảng order
                                                                        $stmt = $conn->prepare("SELECT * FROM `order` WHERE account_id = :account_id ORDER BY created_at DESC LIMIT 20");
                                                                        $stmt->bindParam(":account_id", $_id);
                                                                        $stmt->execute();
                                                                        $order_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                        
                                                                        if (count($order_history) > 0) {
                                                                            $count = 1;
                                                                            foreach ($order_history as $row) {
                                                                                $status_badge = '';
                                                                                switch ($row['status']) {
                                                                                    case 1:
                                                                                        $status_badge = '<span class="badge bg-success">Thành công</span>';
                                                                                        break;
                                                                                    case 0:
                                                                                        $status_badge = '<span class="badge bg-warning">Chờ xử lý</span>';
                                                                                        break;
                                                                                    case 2:
                                                                                        $status_badge = '<span class="badge bg-danger">Thất bại</span>';
                                                                                        break;
                                                                                    default:
                                                                                        $status_badge = '<span class="badge bg-secondary">' . $row['status'] . '</span>';
                                                                                }
                                                                                
                                                                                echo '<tr>
                                                                                    <td>' . $count . '</td>
                                                                                    <td>' . htmlspecialchars($row['orderId']) . '</td>
                                                                                    <td>' . number_format($row['amount']) . ' VNĐ</td>
                                                                                    <td>' . htmlspecialchars($row['orderType']) . '</td>
                                                                                    <td>' . $status_badge . '</td>
                                                                                    <td>' . date('d/m/Y H:i:s', strtotime($row['created_at'])) . '</td>
                                                                                </tr>';
                                                                                $count++;
                                                                            }
                                                                        } else {
                                                                            echo '<tr><td colspan="6" class="text-center text-muted">Chưa có lịch sử đơn hàng</td></tr>';
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
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
                                                                $stmt = $conn->prepare("SELECT SUM(amount) as total FROM mbbank_log WHERE name = :username");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $total_banking = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
                                                                
                                                                $stmt = $conn->prepare("SELECT SUM(transfer_amount) as total FROM sepay_transactions WHERE username = :username AND status = 'completed'");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $total_sepay = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
                                                                
                                                                $stmt = $conn->prepare("SELECT SUM(amount) as total FROM `order` WHERE account_id = :account_id AND status = 1");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $total_order = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
                                                                
                                                                $total_all = $total_banking + $total_sepay + $total_order;
                                                                echo number_format($total_all) . ' VNĐ';
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
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM mbbank_log WHERE name = :username");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $count_banking = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM sepay_transactions WHERE username = :username");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $count_sepay = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM `order` WHERE account_id = :account_id");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $count_order = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                
                                                                $total_count = $count_banking + $count_sepay + $count_order;
                                                                echo $total_count;
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <h5 class="card-title">🎯 Tỷ lệ thành công</h5>
                                                            <h3 class="text-warning">
                                                                <?php
                                                                $success_count = 0;
                                                                $total_transactions = 0;
                                                                
                                                                // Banking (tất cả đều thành công)
                                                                $success_count += $count_banking;
                                                                $total_transactions += $count_banking;
                                                                
                                                                // SePay
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM sepay_transactions WHERE username = :username AND status = 'completed'");
                                                                $stmt->bindParam(":username", $_username);
                                                                $stmt->execute();
                                                                $success_sepay = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                $success_count += $success_sepay;
                                                                $total_transactions += $count_sepay;
                                                                
                                                                // Order
                                                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM `order` WHERE account_id = :account_id AND status = 1");
                                                                $stmt->bindParam(":account_id", $_id);
                                                                $stmt->execute();
                                                                $success_order = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                                                                $success_count += $success_order;
                                                                $total_transactions += $count_order;
                                                                
                                                                if ($total_transactions > 0) {
                                                                    $success_rate = round(($success_count / $total_transactions) * 100, 1);
                                                                    echo $success_rate . '%';
                                                                } else {
                                                                    echo '0%';
                                                                }
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

    <script>
        // Bootstrap tabs functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tabs
            var triggerTabList = [].slice.call(document.querySelectorAll('#historyTabs button'));
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl);
                
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        });
    </script>

<?php include '../core/footer.php'; ?>
</body>
</html>
