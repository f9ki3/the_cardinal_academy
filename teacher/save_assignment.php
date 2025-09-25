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
        echo "<div class='alert alert-danger'>All fields are required!</div>";
        exit();
    }

    // Optionally handle file upload
    $attachment = NULL;
    if (isset($_FILES['assignment_file']) && $_FILES['assignment_file']['error'] == UPLOAD_ERR_OK) {
        // Define the upload directory
        $uploadDir = '../static/uploads/'; // Ensure this directory is writable by the web server
        $uploadFile = $uploadDir . basename($_FILES['assignment_file']['name']);

        // Check file size (optional - maximum size of 10MB)
        if ($_FILES['assignment_file']['size'] > 10485760) { // 10MB in bytes
            echo "<div class='alert alert-danger'>File size exceeds the limit of 10MB.</div>";
            exit();
        }

        // Check file type (optional - allow only certain file types)
        $allowedTypes = ['pdf', 'docx', 'pptx', 'txt', 'jpg', 'png'];
        $fileExtension = pathinfo($uploadFile, PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid file type. Allowed types: PDF, DOCX, PPTX, TXT, JPG, PNG.</div>";
            exit();
        }

        // Move the uploaded file to the server's directory
        if (move_uploaded_file($_FILES['assignment_file']['tmp_name'], $uploadFile)) {
            $attachment = $uploadFile; // Store the file path in the database
        } else {
            echo "<div class='alert alert-danger'>File upload failed.</div>";
            exit();
        }
    }

    // Insert the assignment into the database
    $sql = "INSERT INTO assignments (course_id, teacher_id, title, instructions, points, due_date, due_time, attachment)
            VALUES ('$course_id', '$teacher_id', '$title', '$instructions', $points, '$due_date', '$due_time', '$attachment')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>Assignment saved successfully!</div>";
        // Optionally redirect to the assignment list page or show success message
        // header('Location: assignments_list.php'); // Uncomment this if needed
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }

    mysqli_close($conn);
}
?>
