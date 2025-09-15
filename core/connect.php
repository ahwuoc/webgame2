<?php
require_once __DIR__ . '/Database.php';

// GMT +7
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Centralized PDO connection
$conn = Database::getConnection();
?>
