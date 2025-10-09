<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acc_type = mysqli_real_escape_string($conn, $_POST['acc_type']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date = date("Y-m-d H:i:s");

    // 1️⃣ Insert the announcement
    $sql = "INSERT INTO announcements (acc_type, message, date) VALUES ('$acc_type', '$message', '$date')";
    if (mysqli_query($conn, $sql)) {

        // 2️⃣ Determine which users to notify
        if ($acc_type === 'all') {
            // Public announcement → notify parent, student, teacher
            $user_filter = "acc_type IN ('parent','student','teacher')";
        } else {
            // Notify only users with matching acc_type
            $user_filter = "acc_type = '$acc_type'";
        }

        // 3️⃣ Update notifications count
        $update_sql = "UPDATE users SET notification = notification + 1 WHERE $user_filter";
        mysqli_query($conn, $update_sql);

        // 4️⃣ Prepare formatted notification message (limit to 50 chars)
        $short_message = mb_substr($message, 0, 50);
        $notif_message = "AcadeSys posted new public announcement: $short_message";

        // 5️⃣ Insert notifications for all affected users in a single query
        $notif_sql = "
            INSERT INTO notifications (user_id, message, link, created_at)
            SELECT user_id, '$notif_message', 'announcement.php', '$date'
            FROM users
            WHERE $user_filter
        ";
        mysqli_query($conn, $notif_sql);

        header("Location: announcement.php?status=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
