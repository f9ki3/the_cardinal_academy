<?php
// Include session and database connection
include 'session_login.php';
include '../db_connection.php';

// Check if assignment_id and course_id are passed
if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['course_id'])) {
    $assignment_id = intval($_GET['id']);
    $course_id = intval($_GET['course_id']);

    // Delete the assignment from the database
    $query = "DELETE FROM assignments WHERE assignment_id = $assignment_id";
    
    if (mysqli_query($conn, $query)) {
        // ✅ Redirect with status=2 (deleted)
        header("Location: assignment.php?id={$course_id}&status=2");
        exit();
    } else {
        // Redirect with error status
        header("Location: assignment.php?id={$course_id}&status=error");
        exit();
    }
} else {
    // Invalid request
    header("Location: assignment.php?status=invalid");
    exit();
}

mysqli_close($conn);
?>
