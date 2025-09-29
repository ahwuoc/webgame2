<?php
#Duong Huynh Khanh Dang

require_once __DIR__ . '/../core/db_config.php';

$databaseConfig = [
    'ip' => DB_HOST,
    'dbname' => DB_NAME,
    'user' => DB_USER,
    'pass' => DB_PASS
];

// Set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');

function getDatabaseConnection($connConfig)
{
    try {
        $port = defined('DB_PORT') ? DB_PORT : '3306';
        $dsn = "mysql:host={$connConfig['ip']};port={$port};dbname={$connConfig['dbname']};charset=utf8mb4";
        $conn = new PDO($dsn, $connConfig['user'], $connConfig['pass']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Handle the exception in a more graceful way
        die("Connection failed: " . $e->getMessage());
    }
}

$conn = getDatabaseConnection($databaseConfig);
?>
