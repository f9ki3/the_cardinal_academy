<?php
session_start();

// Redirect if not logged in or not an admin
if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}
?>
