<?php
session_start();

// Redirect if not logged in or not an admin
if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}else if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'parent') {
    header("Location: parent/dashboard.php");
    exit();
}else if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'student') {
    header("Location: student/dashboard.php");
    exit();
}else if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'teacher') {
    header("Location: teacher/dashboard.php");
    exit();
}
?>
