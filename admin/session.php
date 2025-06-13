<?php
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] === 'admin') {
    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}
?>
