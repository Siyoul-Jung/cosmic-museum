<?php
/**
 * DB Connection: Secure Environment Bridge
 * This file uses environment variables provided by Railway.
 * It also looks for a local bridge file created at runtime (ignored by Git).
 */

// Load runtime bridge created by start.sh if it exists (NOT committed to Git)
if (file_exists(__DIR__ . '/db_bridge.php')) {
    include __DIR__ . '/db_bridge.php';
}

// --- ULTIMATE CONNECTION ENGINE: Aggressive Environment Detection ---
$env_stats = [];

/**
 * Higher-order search for DB config
 * Searches through multiple candidate keys and returns the first hit.
 */
function search_db_env($keys, $default, &$stats) {
    foreach ($keys as $key) {
        $val = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if (!empty($val) && trim($val) !== '') {
            $stats[$key] = 'FOUND';
            return trim($val);
        }
        $stats[$key] = 'MISSING';
    }
    return $default;
}

// 1. Check for Full URL First (Most Reliable on Railway)
$mysql_url = search_db_env(['MYSQL_URL', 'DATABASE_URL', 'JAWSDB_URL', 'CLEARDB_DATABASE_URL'], '', $env_stats);

if (!empty($mysql_url)) {
    // 🛡️ PRESTIGE REGEX PARSING (Handles mysql:// and mariadb://)
    if (preg_match('/^(mysql|mariadb):\/\/([^:]+):([^@]+)@([^:\/]+)(?::(\d+))?\/(.+)$/', $mysql_url, $matches)) {
        $user = $matches[2];
        $pass = $matches[3];
        $host = $matches[4];
        $port = !empty($matches[5]) ? $matches[5] : '3306';
        $db   = $matches[6];
        $env_stats['PARSING'] = 'Regex Success (MariaDB)';
    } else {
        $url = parse_url($mysql_url);
        $host = $url['host'] ?? '';
        $db   = !empty($url['path']) ? substr($url['path'], 1) : 'cosmic_museum';
        $user = $url['user'] ?? 'root';
        $pass = $url['pass'] ?? ''; 
        $port = $url['port'] ?? '3306';
    }
    
    if (empty($pass)) {
        $pass = search_db_env(['MYSQLPASSWORD', 'DB_PASS'], '', $env_stats);
    }
} else {
    // ... Existing individual search ...
    $host = search_db_env(['DB_PUBLIC_HOST', 'MYSQLHOST_PUBLIC', 'MYSQL_HOST', 'MYSQLHOST', 'DB_HOST', 'localhost'], 'db', $env_stats);
    $db   = search_db_env(['MYSQLDATABASE', 'DB_NAME', 'MYSQL_DATABASE'], 'cosmic_museum', $env_stats);
    $user = search_db_env(['MYSQLUSER', 'DB_USER', 'DB_USERNAME'], 'root', $env_stats);
    $pass = search_db_env(['MYSQLPASSWORD', 'DB_PASS', 'DB_PASSWORD', 'MYSQL_PASSWORD'], '', $env_stats);
    $port = search_db_env(['MYSQLPORT', 'DB_PORT', 'MYSQL_PORT'], '3306', $env_stats);
}

// --- PRODUCTION CONNECTION ENGINE ---
$charset = 'utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_TIMEOUT => 5,
];

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // 🏛️ Prestige Error Display
    header("HTTP/1.1 503 Content Alignment Required");
    include_once 'error_page.php'; // Or a simple message
    exit("🌌 Cosmic Museum is currently aligning its stars. Please check back shortly.");
}
?>
?>