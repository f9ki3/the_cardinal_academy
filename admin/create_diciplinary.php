<?php
include 'session_login.php';
include '../db_connection.php';

// Enable MySQLi error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$student_number = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($student_number)) {

    // ✅ disciplinary_incharge (input might be disabled, fallback to session $full_name)
    $disciplinary_incharge = isset($_POST['disciplinary_incharge']) ? trim($_POST['disciplinary_incharge']) : '';
    if ($disciplinary_incharge === '' && isset($full_name)) {
        $disciplinary_incharge = $full_name;
    }

    // 1️⃣ Get numeric student user_id from users table using student_number
    $stmtStudent = $conn->prepare("SELECT user_id AS student_id FROM users WHERE student_number = ?");
    $stmtStudent->bind_param("s", $student_number);
    $stmtStudent->execute();
    $resultStudent = $stmtStudent->get_result();
    $studentRow = $resultStudent->fetch_assoc();
    $stmtStudent->close();

    if (!$studentRow) {
        die("No student found with student number: " . htmlspecialchars($student_number));
    }

    $student_id = $studentRow['student_id']; // ✅ Correct user_id to insert

    // 2️⃣ Collect form data safely
    $incident_date        = trim($_POST['incident_date'] ?? '');
    $incident_location    = trim($_POST['incident_location'] ?? '');
    $incident_description = trim($_POST['incident_description'] ?? '');
    $violation_type       = trim($_POST['violation_type'] ?? '');
    $disciplinary_action  = trim($_POST['disciplinary_action'] ?? '');
    $witnesses            = trim($_POST['witnesses'] ?? '');
    $remarks              = trim($_POST['remarks'] ?? '');

    // Basic required validation (optional but helpful)
    if ($incident_date === '' || $incident_location === '' || $incident_description === '' || $violation_type === '') {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit;
    }

    // 3️⃣ Generate a unique disciplinary_id (safer: loop until not exists)
    do {
        $disciplinary_id = 'DISC-' . str_pad((string)random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        $check = $conn->prepare("SELECT 1 FROM student_disciplinary_records WHERE disciplinary_id = ? LIMIT 1");
        $check->bind_param("s", $disciplinary_id);
        $check->execute();
        $exists = $check->get_result()->num_rows > 0;
        $check->close();
    } while ($exists);

    // 4️⃣ Insert disciplinary record (✅ use $student_id, not $student_number)
    $stmt = $conn->prepare("
        INSERT INTO student_disciplinary_records
        (disciplinary_id, student_id, incident_date, incident_location, incident_description, violation_type, disciplinary_action, witnesses, remarks, disciplinary_incharge, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    // If student_id is INT in DB, use "i". If your user_id is CHAR/UUID, change to "s".
    // Most of your code uses INT user_id, so we'll bind as "i".
    $stmt->bind_param(
        "sissssssss",
        $disciplinary_id,
        $student_id,
        $incident_date,
        $incident_location,
        $incident_description,
        $violation_type,
        $disciplinary_action,
        $witnesses,
        $remarks,
        $disciplinary_incharge
    );

    $stmt->execute();
    $stmt->close();

    // 5️⃣ Get parent_id(s) from parent_link (student_id is numeric)
    $parentQuery = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
    $parentQuery->bind_param("i", $student_id);
    $parentQuery->execute();
    $parentResult = $parentQuery->get_result();

    while ($parent = $parentResult->fetch_assoc()) {
        $parent_id = $parent['parent_id'];

        // ✅ Update parent notification count
        // If users.user_id is INT -> bind "i"; if CHAR/UUID -> bind "s"
        $updateStmt = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
        if (is_numeric($parent_id)) {
            $parent_id_int = (int)$parent_id;
            $updateStmt->bind_param("i", $parent_id_int);
        } else {
            $updateStmt->bind_param("s", $parent_id);
        }
        $updateStmt->execute();
        $updateStmt->close();

        // ✅ Insert notification log
        $message = "New disciplinary record added for student number $student_number";
        $link = "view_disciplinary_detail.php?disciplinary_id=" . urlencode($disciplinary_id) . "&student_id=" . urlencode($student_number);
        $created_at = date("Y-m-d H:i:s");

        $logStmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
        if (is_numeric($parent_id)) {
            $parent_id_int = (int)$parent_id;
            $logStmt->bind_param("isss", $parent_id_int, $message, $link, $created_at);
        } else {
            $logStmt->bind_param("ssss", $parent_id, $message, $link, $created_at);
        }
        $logStmt->execute();
        $logStmt->close();
    }

    $parentQuery->close();

    // 6️⃣ Redirect after success
    header("Location: view_student_diciplinary.php?status=1&student_id=" . urlencode($student_number));
    exit;
}
?>
