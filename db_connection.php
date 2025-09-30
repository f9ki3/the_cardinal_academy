<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $host = 'srv596.hstgr.io';   // or '31.220.110.101'
    $db   = 'u429904263_tca';
    $user = 'u429904263_tca';
    $pass = 'UsKA?M[7';
} else {
    // Hostinger settings
    $host = 'localhost';
    $db   = 'u429904263_tca';
    $user = 'u429904263_tca';
    $pass = 'UsKA?M[7';
}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
