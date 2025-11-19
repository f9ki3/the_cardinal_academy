<?php
// Hostinger remote MySQL connection
$host = 'srv596.hstgr.io';       // Hostname provided by Hostinger
$db   = 'u429904263_tca';        // Your database name
$user = 'u429904263_tca';        // Your database username
$pass = 'UsKA?M[7';              // Your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: force UTF-8
$conn->set_charset("utf8");

?>
