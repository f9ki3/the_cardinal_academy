<?php
session_start();

// Do nothing if acc_type is not set
if (!isset($_SESSION['acc_type'])) {
    return;
}

// Redirect based on exact acc_type
if ($_SESSION['acc_type'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit();
} elseif ($_SESSION['acc_type'] === 'parent') {
    header("Location: parent/dashboard.php");
    exit();
} elseif ($_SESSION['acc_type'] === 'student') {
    header("Location: student/dashboard.php");
    exit();
} elseif ($_SESSION['acc_type'] === 'teacher') {
    header("Location: teacher/dashboard.php");
    exit();
}
?>
