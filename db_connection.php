<?php
$host = 'localhost';        // usually localhost
$db   = 'tca';              // your actual DB name
$user = 'root';             // your MySQL username
$pass = '';                 // your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
