<?php
include 'session_login.php';
include '../db_connection.php';

// Function to generate unique 8-digit joined_id
function generateUniqueJoinedId($conn) {
    do {
        $joined_id = mt_rand(10000000, 99999999); // 8-digit random number
        $stmt = $conn->prepare("SELECT COUNT(*) FROM courses WHERE joined_id = ?");
        $stmt->bind_param("i", $joined_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);
    return $joined_id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $teacher_id = $_SESSION['user_id'];

    // Collect inputs
    $course_name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $day = $_POST['day'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $grade_level = trim($_POST['grade_level'] ?? '');  // UPDATED
    $subject = trim($_POST['subject'] ?? '');
    $room = trim($_POST['room'] ?? '');

    // Validate inputs
    $errors = [];
    if (!$course_name) $errors[] = "Course Name is required.";
    if (!$day) $errors[] = "Day is required.";
    if (!$start_time || !$end_time) $errors[] = "Start and End Time are required.";
    if ($start_time >= $end_time) $errors[] = "Start Time must be earlier than End Time.";
    if (!$grade_level) $errors[] = "Grade Level is required."; // UPDATED
    if (!$subject) $errors[] = "Subject is required.";
    if (!$room) $errors[] = "Room is required.";

    // File upload
    $cover_photo_path = null;
    if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {

        $upload_dir = '../static/uploads/';
        $filename = time() . '_' . basename($_FILES['cover_photo']['name']);
        $target_file = $upload_dir . $filename;

        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg','jpeg','png','gif','svg'];

        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Invalid file type for cover photo.";
        } else {
            if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_file)) {
                $cover_photo_path = $filename;
            } else {
                $errors[] = "Failed to upload cover photo.";
            }
        }
    }

    if (count($errors) > 0) {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        exit;
    }

    // Generate course join code
    $joined_id = generateUniqueJoinedId($conn);

    // Insert into database
    $stmt = $conn->prepare("
        INSERT INTO courses 
        (joined_id, teacher_id, course_name, description, day, start_time, end_time, grade_level, subject, room, cover_photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "iisssssssss",
        $joined_id,
        $teacher_id,
        $course_name,
        $description,
        $day,
        $start_time,
        $end_time,
        $grade_level,  // UPDATED
        $subject,
        $room,
        $cover_photo_path
    );

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Failed to save course: " . $stmt->error . "</p>";
    }

} else {
    echo "<p>Invalid request.</p>";
}
?>
