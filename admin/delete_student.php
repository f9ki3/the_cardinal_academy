<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? '';

    if (!empty($user_id)) {
        // First, optionally get the profile path to delete the file
        $stmt_select = $conn->prepare("SELECT profile FROM users WHERE user_id = ? AND acc_type = 'student'");
        $stmt_select->bind_param("i", $user_id);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $profile = '';
        if ($row = $result->fetch_assoc()) {
            $profile = $row['profile'];
        }
        $stmt_select->close();

        // Delete the student record
        $stmt_delete = $conn->prepare("DELETE FROM users WHERE user_id = ? AND acc_type = 'student'");
        $stmt_delete->bind_param("i", $user_id);

        if ($stmt_delete->execute()) {
            // Optionally delete the profile image if it's not the default
            if ($profile && $profile !== 'uploads/dummy.jpg' && file_exists("../static/" . $profile)) {
                unlink("../static/" . $profile);
            }

            // Redirect back to student list with success message
            header("Location: students.php?status=deleted");
            exit;
        } else {
            echo "<div class='alert alert-danger text-center mt-5'>Error deleting student: " . htmlspecialchars($stmt_delete->error) . "</div>";
        }

        $stmt_delete->close();
    } else {
        echo "<div class='alert alert-warning text-center mt-5'>Invalid student ID.</div>";
    }

    $conn->close();
} else {
    header("Location: students.php");
    exit;
}
?>
