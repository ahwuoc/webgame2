<?php
/**
 * Database Configuration
 * Centralized database configuration for the entire application
 */

// Database configuration with environment variable support
if (!defined('DB_HOST')) {
    define('DB_HOST', getenv('DB_HOST') ?: '14.225.219.221');
}
if (!defined('DB_USER')) {
    define('DB_USER', getenv('DB_USER') ?: 'dragonboy_user');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', getenv('DB_PASS') ?: 'dragonboy_pass');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', getenv('DB_NAME') ?: 'dragonboy');
}
if (!defined('DB_PORT')) {
    define('DB_PORT', getenv('DB_PORT') ?: '3306');
}

// Legacy variable names for backward compatibility
$ip_sv = DB_HOST;
$port = DB_PORT;
$user_sv = DB_USER;
$pass_sv = DB_PASS;
$dbname_sv = DB_NAME;

// Set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
