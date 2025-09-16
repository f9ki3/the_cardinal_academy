<?php
// Include session and database connection
include 'session_login.php';
include '../db_connection.php';

// Check if assignment_id is passed
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $assignment_id = intval($_GET['id']);

    // Delete the assignment from the database
    $query = "DELETE FROM assignments WHERE assignment_id = $assignment_id";
    
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Assignment deleted successfully.</div>";
        // Redirect to the assignments list page (or wherever you want to go after deletion)
        header("Location: assignment.php?id=" . $_GET['course_id']);
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
}

mysqli_close($conn);
?>
