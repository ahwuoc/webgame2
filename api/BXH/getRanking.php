<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm các tệp cần thiết
include __DIR__ . '/../../DHKD/Connections.php';
include __DIR__ . '/../../DHKD/Session.php';
include __DIR__ . '/../../DHKD/Configs.php';

// Câu truy vấn để lấy dữ liệu
$query = "SELECT player.*, account.tongnap,
            CAST(JSON_UNQUOTE(JSON_EXTRACT(data_point, '$[1]')) AS SIGNED) AS sucmanh, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(pet, '$[1]')), ',', 2), ',', -1) AS detu
            FROM player 
            INNER JOIN account ON player.account_id = account.id                       
            ORDER BY sucmanh DESC 
            LIMIT 100";

$stmt = $conn->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Chuyển đổi kết quả thành JSON và trả về
header('Content-Type: application/json');
echo json_encode($data);
?>
