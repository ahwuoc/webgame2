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
// Bảng player không có cột 'dameBoss'. Dùng 'PointBoss' và alias về dameBoss để tương thích frontend
$query = "SELECT name, PointBoss AS dameBoss FROM player ORDER BY PointBoss DESC LIMIT 10";

$stmt = $conn->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Chuyển đổi kết quả thành JSON và trả về
header('Content-Type: application/json');
echo json_encode($data);
?>
