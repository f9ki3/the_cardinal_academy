<?php
include 'session_login.php';
include '../db_connection.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rfid       = trim($_POST['rfid_code']);
    $type       = $_POST['attendance_type'];
    $teacher_id = $_POST['teacher_id'] ?? null;

    if ($rfid !== '' && in_array($type, ['time_in', 'time_out'], true)) {

        $query = "
            SELECT 
                enroll_form.guardian_contact,
                users.user_id AS student_id,
                CONCAT(users.first_name, ' ', users.last_name) AS fullname
            FROM users
            JOIN enroll_form ON users.enroll_id = enroll_form.id
            WHERE users.rfid = ?
        ";
        $stmt = $conn->prepare($query) or die('Prepare failed: ' . $conn->error);
        $stmt->bind_param("s", $rfid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            $student_id = (int)$row['student_id'];
            $fullname   = $row['fullname'];
            $contact    = preg_replace('/^0/', '+63', $row['guardian_contact']);

            $today = date('Y-m-d');
            $now   = date('H:i:s');

            $sms_message = sprintf(
                'TCA Alert: %s %s on %s at %s.',
                $fullname,
                $type === 'time_in' ? 'timed‑IN' : 'timed‑OUT',
                date('M j, Y'),
                date('g:i A')
            );

            if ($type === 'time_in') {
                $check = $conn->prepare("
                    SELECT id FROM attendance
                    WHERE student_id = ? AND date = ?
                ");
                $check->bind_param("is", $student_id, $today);
                $check->execute();
                $hasTimeIn = $check->get_result()->num_rows > 0;

                if ($hasTimeIn) {
                    $alert = "⚠️ Time In already recorded for <strong>$fullname</strong> today.";
                } else {
                    $ins = $conn->prepare("
                        INSERT INTO attendance (`date`,`time_in`,`teacher_id`,`student_id`)
                        VALUES (?,?,?,?)
                    ") or die('Insert prepare failed: ' . $conn->error);
                    $ins->bind_param("ssii", $today, $now, $teacher_id, $student_id);
                    $ins->execute();

                    if ($ins->affected_rows) {
                        $alert = "✅ Time In recorded for <strong>$fullname</strong> at $now.";
                    } else {
                        $alert = "⚠️ Failed to record Time In.";
                    }
                }

            } else { // time_out
                $check = $conn->prepare("
                    SELECT id FROM attendance
                    WHERE student_id = ? AND date = ? AND time_out IS NULL
                ");
                $check->bind_param("is", $student_id, $today);
                $check->execute();
                $rowOpen = $check->get_result()->fetch_assoc();

                if ($rowOpen) {
                    $upd = $conn->prepare("
                        UPDATE attendance
                        SET time_out = ?
                        WHERE id = ?
                    ") or die('Update prepare failed: ' . $conn->error);
                    $upd->bind_param("si", $now, $rowOpen['id']);
                    $upd->execute();

                    if ($upd->affected_rows) {
                        $alert = "✅ Time Out recorded for <strong>$fullname</strong> at $now.";
                    } else {
                        $alert = "⚠️ Failed to update Time Out.";
                    }
                } else {
                    $alert = "⚠️ No Time In found or already Timed Out for <strong>$fullname</strong> today.";
                }
            }

            $message = "
                <div class='alert alert-info alert-dismissible fade show' role='alert'>
                    {$alert}<br>📞 Guardian Contact: <strong>{$contact}</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            header('Location: attendance.php?message=' . urlencode($message) . '&sms_message=' . urlencode($sms_message) . '&phone=' . urlencode($contact));
            exit;

        } else {
            $err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ❌ RFID not recognized. Student not found.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            header('Location: attendance.php?message=' . urlencode($err));
            exit;
        }

    } else {
        $err = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    ⚠️ Missing or invalid data. Please check the form.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        header('Location: attendance.php?message=' . urlencode($err));
        exit;
    }

} else {
    $err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                ❌ Invalid request method.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    header('Location: attendance.php?message=' . urlencode($err));
    exit;
}
?>
