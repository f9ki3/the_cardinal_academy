<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = $_SESSION['user_id'];

    // Collect inputs
    $course_id   = intval($_POST['course_id'] ?? 0);
    $course_name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $day         = $_POST['day'] ?? '';
    $start_time  = $_POST['start_time'] ?? '';
    $end_time    = $_POST['end_time'] ?? '';
    $section     = trim($_POST['section'] ?? '');
    $subject     = trim($_POST['subject'] ?? '');
    $room        = trim($_POST['room'] ?? '');
    $action      = $_POST['action'] ?? 'update'; // update / archive / unarchive

    // Validation
    $errors = [];
    if (!$course_id) $errors[] = "Invalid course ID.";
    if ($action === 'update') {
        if (!$course_name) $errors[] = "Course Name is required.";
        if (!$day) $errors[] = "Day is required.";
        if (!$start_time || !$end_time) $errors[] = "Start and End Time are required.";
        if ($start_time >= $end_time) $errors[] = "Start Time must be earlier than End Time.";
        if (!$section) $errors[] = "Section is required.";
        if (!$subject) $errors[] = "Subject is required.";
        if (!$room) $errors[] = "Room is required.";
    }

    if ($errors) {
        foreach ($errors as $err) echo "<p style='color:red;'>$err</p>";
        exit;
    }

    // Handle status changes
    if ($action === 'archive') {
        $stmt = $conn->prepare("UPDATE courses SET status='inactive' WHERE id=? AND teacher_id=?");
        $stmt->bind_param("ii", $course_id, $teacher_id);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php?success=archived");
        exit;
    } elseif ($action === 'unarchive') {
        $stmt = $conn->prepare("UPDATE courses SET status='active' WHERE id=? AND teacher_id=?");
        $stmt->bind_param("ii", $course_id, $teacher_id);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php?success=unarchived");
        exit;
    }

    // Handle cover photo upload (for update action)
    $cover_photo_path = null;
    $stmt = $conn->prepare("SELECT cover_photo FROM courses WHERE id=? AND teacher_id=?");
    $stmt->bind_param("ii", $course_id, $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cover_photo_path = $result->fetch_assoc()['cover_photo'] ?? null;
    $stmt->close();

    if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../static/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $tmp_name = $_FILES['cover_photo']['tmp_name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $tmp_name);
        finfo_close($finfo);

        $mime_map = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/svg+xml' => 'svg'
        ];

        if (!isset($mime_map[$mime_type])) {
            echo "<p style='color:red;'>Invalid file type for cover photo.</p>";
            exit;
        } else {
            $ext = $mime_map[$mime_type];
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $target_file = $upload_dir . $filename;

            if (move_uploaded_file($tmp_name, $target_file)) {
                $cover_photo_path = $filename;
            } else {
                echo "<p style='color:red;'>Failed to upload cover photo.</p>";
                exit;
            }
        }
    }

    // Update course details in database
    $sql = "UPDATE courses SET 
                course_name = ?, description = ?, day = ?, start_time = ?, end_time = ?, 
                section = ?, subject = ?, room = ?, cover_photo = ?
            WHERE id = ? AND teacher_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssii",
        $course_name,
        $description,
        $day,
        $start_time,
        $end_time,
        $section,
        $subject,
        $room,
        $cover_photo_path,
        $course_id,
        $teacher_id
    );

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=updated");
        exit;
    } else {
        echo "<p style='color:red;'>Failed to update course: " . $stmt->error . "</p>";
    }

} else {
    echo "<p>Invalid request.</p>";
}
?>
