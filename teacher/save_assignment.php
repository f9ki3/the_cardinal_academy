<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);
    $points = intval($_POST['points']);
    $due_date = $_POST['due_date'];
    $due_time = $_POST['due_time'];
    
    // Retrieve course_id and teacher_id (from hidden fields)
    $course_id = intval($_POST['course_id']);
    $teacher_id = intval($_POST['teacher_id']);

    // Basic validation for required fields
    if (empty($title) || empty($instructions) || empty($points) || empty($due_date) || empty($due_time)) {
        header("Location: assignment.php?id={$course_id}&status=0"); // 0 = error
        exit();
    }

    // Optionally handle file upload
    $attachment = NULL;
    if (isset($_FILES['assignment_file']) && $_FILES['assignment_file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../static/uploads/';
        $uploadFile = $uploadDir . basename($_FILES['assignment_file']['name']);

        if ($_FILES['assignment_file']['size'] > 10485760) { 
            header("Location: assignment.php?id={$course_id}&status=filesize");
            exit();
        }

        $allowedTypes = ['pdf', 'docx', 'pptx', 'txt', 'jpg', 'png'];
        $fileExtension = pathinfo($uploadFile, PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedTypes)) {
            header("Location: assignment.php?id={$course_id}&status=invalidfile");
            exit();
        }

        if (move_uploaded_file($_FILES['assignment_file']['tmp_name'], $uploadFile)) {
            $attachment = $uploadFile;
        } else {
            header("Location: assignment.php?id={$course_id}&status=uploadfail");
            exit();
        }
    }

    // Insert the assignment into the database
    $sql = "INSERT INTO assignments (course_id, teacher_id, title, instructions, points, due_date, due_time, attachment)
            VALUES ('$course_id', '$teacher_id', '$title', '$instructions', $points, '$due_date', '$due_time', '$attachment')";

    if (mysqli_query($conn, $sql)) {
        // ✅ Redirect with success status
        header("Location: assignment.php?id={$course_id}&status=1");
        exit();
    } else {
        header("Location: assignment.php?id={$course_id}&status=error");
        exit();
    }

    mysqli_close($conn);
}
?>
