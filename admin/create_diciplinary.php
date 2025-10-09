<?php
include 'session_login.php';
include '../db_connection.php';

// Enable MySQLi error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$student_number = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($student_number)) {

    // 1️⃣ Get student_id from users table using student_number
    $stmtStudent = $conn->prepare("SELECT user_id AS student_id FROM users WHERE student_number = ?");
    $stmtStudent->bind_param("s", $student_number);
    $stmtStudent->execute();
    $resultStudent = $stmtStudent->get_result();
    $studentRow = $resultStudent->fetch_assoc();
    $stmtStudent->close();

    if (!$studentRow) {
        die("No student found with student number: $student_number");
    }

    $student_id = $studentRow['student_id']; // ✅ Correct user_id to insert

    // 2️⃣ Collect form data safely
    $incident_date = trim($_POST['incident_date'] ?? '');
    $incident_location = trim($_POST['incident_location'] ?? '');
    $incident_description = trim($_POST['incident_description'] ?? '');
    $violation_type = trim($_POST['violation_type'] ?? '');
    $disciplinary_action = trim($_POST['disciplinary_action'] ?? '');
    $witnesses = trim($_POST['witnesses'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    // 3️⃣ Generate a unique disciplinary_id
    $disciplinary_id = 'DISC-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // 4️⃣ Insert disciplinary record
    $stmt = $conn->prepare("
        INSERT INTO student_disciplinary_records 
        (disciplinary_id, student_id, incident_date, incident_location, incident_description, violation_type, disciplinary_action, witnesses, remarks, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
        "sssssssss",
        $disciplinary_id,
        $student_number,
        $incident_date,
        $incident_location,
        $incident_description,
        $violation_type,
        $disciplinary_action,
        $witnesses,
        $remarks
    );

    $stmt->execute();
    $stmt->close();

    // 5️⃣ Get parent_id(s) from parent_link
    $parentQuery = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
    $parentQuery->bind_param("s", $student_id); // Use string if parent_id is CHAR/UUID
    $parentQuery->execute();
    $parentResult = $parentQuery->get_result();

    while ($parent = $parentResult->fetch_assoc()) {
        $parent_id = $parent['parent_id'];

        // Update parent notification count
        $updateStmt = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
        $updateStmt->bind_param("s", $parent_id);
        $updateStmt->execute();
        $updateStmt->close();

        // Insert notification log
        $message = "New disciplinary record added for student number $student_number";
        $link = "view_disciplinary_detail.php?disciplinary_id=" . urlencode($disciplinary_id) . "&student_id=" . urlencode($student_number);
        $created_at = date("Y-m-d H:i:s");

        $logStmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
        $logStmt->bind_param("ssss", $parent_id, $message, $link, $created_at);
        $logStmt->execute();
        $logStmt->close();
    }

    $parentQuery->close();

    // 6️⃣ Redirect after success
    header("Location: view_student_diciplinary.php?status=1&student_id=" . urlencode($student_number));
    exit;
}
?>
