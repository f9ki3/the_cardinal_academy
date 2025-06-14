<?php
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] === 'admin') {
    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}else if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] === 'teacher') {
    // Redirect to the dashboard
    header("Location: ../");
    exit();
}else if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] === 'parent') {
    // Redirect to the dashboard
    header("Location: ../");
    exit();
}else if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] === 'student') {
    // Redirect to the dashboard
    header("Location: ../");
    exit();
}

?>
