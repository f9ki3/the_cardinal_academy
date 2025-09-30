<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    // Local settings
    $host = 'localhost';
    $db   = 'tca1';
    $user = 'root';
    $pass = '';
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
