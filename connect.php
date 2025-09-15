<?php
require_once __DIR__ . '/core/Database.php';

$_domain = "http://127.0.0.1/";
//GMT +7
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Centralized PDO connection
$conn = Database::getConnection();
?>