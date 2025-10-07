<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acc_type = mysqli_real_escape_string($conn, $_POST['acc_type']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO announcements (acc_type, message, date) VALUES ('$acc_type', '$message', '$date')";

    if (mysqli_query($conn, $sql)) {
        header("Location: announcement.php?status=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
