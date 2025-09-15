<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm các tệp cần thiết
include '../../DHKD/Connections.php';
include '../../DHKD/Session.php';
include '../../DHKD/Configs.php';

// Câu truy vấn để lấy dữ liệu
$query = "SELECT player.*, account.tongnap
            FROM player 
            INNER JOIN account ON player.account_id = account.id                       
            ORDER BY account.tongnap DESC 
            LIMIT 100";


$stmt = $conn->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Chuyển đổi kết quả thành JSON và trả về
header('Content-Type: application/json');
echo json_encode($data);
?>
