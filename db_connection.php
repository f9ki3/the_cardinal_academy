<?php
// ✅ Force PHP timezone (affects date() in PHP)
date_default_timezone_set('Asia/Manila');

// Hostinger remote MySQL connection
$host = 'srv596.hstgr.io';
$db   = 'u429904263_tca';
$user = 'u429904263_tca';
$pass = 'UsKA?M[7';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Force MySQL session timezone (affects NOW(), CURRENT_TIMESTAMP, TIMESTAMP columns)
$conn->query("SET time_zone = '+08:00'");

// Optional: force UTF-8
$conn->set_charset("utf8");
?>
