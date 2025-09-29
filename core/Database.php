<?php
/**
 * Centralized PDO Database connection manager
 */
class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            // Load configuration
            $configFile = __DIR__ . '/db_config.php';
            if (!file_exists($configFile)) {
                throw new RuntimeException('Database config not found: ' . $configFile);
            }
            require $configFile; // provides $ip_sv, $port, $dbname_sv, $user_sv, $pass_sv

            // Environment overrides (e.g., docker-compose)
            $host = getenv('DB_HOST') ?: ($ip_sv ?? 'localhost');
            $db   = getenv('DB_NAME') ?: ($dbname_sv ?? '');
            $user = getenv('DB_USER') ?: ($user_sv ?? '');
            $pass = getenv('DB_PASS') ?: ($pass_sv ?? '');
            $portEnv = getenv('DB_PORT');
            $portCfg = isset($port) ? (string)$port : null;
            $portUse = $portEnv ?: ($portCfg ?: '3306');

            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $portUse, $db);

            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                $message = sprintf(
                    'Không thể kết nối CSDL. Host=%s Port=%s DB=%s. Lỗi: %s',
                    $host,
                    $portUse,
                    $db,
                    $e->getMessage()
                );
                // Ghi log chi tiết phục vụ debug (không ghi mật khẩu)
                error_log('[DB_CONN_ERROR] DSN=' . $dsn . ' USER=' . $user . ' ERROR=' . $e->getMessage());
                throw new RuntimeException($message);
            }
        }

        return self::$instance;
    }
}
