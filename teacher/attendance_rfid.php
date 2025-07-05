<?php
include 'session_login.php';
include '../db_connection.php';

// Set Philippine Standard Time
date_default_timezone_set('Asia/Manila');

/* ➊ Helper: push one JSON‑like line to the Arduino’s serial port */
function sendToArduinoSerial(string $phone, string $msg, string $port = '/dev/tty.usbmodem14101', int $baud = 9600): string
{
    // Set baud rate for macOS
    exec("stty -f {$port} {$baud}", $out, $status);
    if ($status !== 0) {
        return "❌ Failed to configure serial port: {$port}";
    }

    // Open serial port in read+write mode
    $fp = @fopen($port, 'w+');
    if (!$fp) {
        return "❌ Failed to open serial port: {$port}";
    }

    // Format expected by Arduino
    $payload = sprintf('{phone:"%s", message:"%s"}' . "\r\n", $phone, addslashes($msg));
    fwrite($fp, $payload);
    fflush($fp);            // Ensure buffer is flushed
    usleep(100000);         // Wait briefly (100ms)

    // Read response for up to 10 seconds
    $response = '';
    $start = microtime(true);
    stream_set_blocking($fp, true); // Block until data available
    while ((microtime(true) - $start) < 10) {
        $line = fgets($fp);
        if ($line !== false) {
            $response .= $line;
        }
    }

    fclose($fp);

    return trim($response) ?: "⚠️ No response from Arduino.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rfid      = trim($_POST['rfid_code']);
    $type      = $_POST['attendance_type'];               // 'time_in' | 'time_out'
    $teacher_id = $_POST['teacher_id'] ?? null;

    if ($rfid !== '' && in_array($type, ['time_in', 'time_out'], true)) {

        /* ➋  Look‑up student & guardian contact */
        $query = "
            SELECT 
                enroll_form.guardian_contact,
                users.user_id            AS student_id,
                CONCAT(users.first_name, ' ', users.last_name) AS fullname
            FROM users
            JOIN enroll_form ON users.enroll_id = enroll_form.id
            WHERE users.rfid = ?
        ";
        $stmt = $conn->prepare($query) or die('Prepare failed: ' . $conn->error);
        $stmt->bind_param("s", $rfid);                    // ‘s’ in case RFID is alphanumeric
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            $student_id = (int)$row['student_id'];
            $fullname   = $row['fullname'];

            /* ➌  Convert 09xxxxxxxxx → +639xxxxxxxxx */
            $contact = preg_replace('/^0/', '+63', $row['guardian_contact']);

            $today = date('Y-m-d');
            $now   = date('H:i:s');

            /* ➍  Build a one‑liner SMS message */
            $sms_message = sprintf(
                'TCA Alert: %s %s on %s at %s.',
                $fullname,
                $type === 'time_in' ? 'timed‑IN' : 'timed‑OUT',
                date('M j, Y'),       // e.g., Jul 5, 2025
                date('g:i A')         // e.g., 3:42 PM
            );

            /* ===== TIME‑IN FLOW ===== */
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
                        /* ➎  Push SMS payload to Arduino */
                        sendToArduinoSerial($contact, $sms_message);
                    } else {
                        $alert = "⚠️ Failed to record Time In.";
                    }
                }

            /* ===== TIME‑OUT FLOW ===== */
            } else { /* time_out */

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
                        /* ➎  Push SMS payload */
                        sendToArduinoSerial($contact, $sms_message);
                    } else {
                        $alert = "⚠️ Failed to update Time Out.";
                    }
                } else {
                    $alert = "⚠️ No Time In found or already Timed Out for <strong>$fullname</strong> today.";
                }
            }

            /* ➏  Wrap alert HTML once, append guardian number */
            $message = "
                <div class='alert alert-info alert-dismissible fade show' role='alert'>
                    {$alert}<br>📞 Guardian Contact: <strong>{$contact}</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            header('Location: attendance.php?message=' . urlencode($message));
            exit;

        } else {
            /* RFID not found */
            $err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ❌ RFID not recognized. Student not found.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            header('Location: attendance.php?message=' . urlencode($err));
            exit;
        }
    } else {
        /* Missing or invalid POST fields */
        $err = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    ⚠️ Missing or invalid data. Please check the form.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        header('Location: attendance.php?message=' . urlencode($err));
        exit;
    }
} else {
    /* Not POST */
    $err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                ❌ Invalid request method.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    header('Location: attendance.php?message=' . urlencode($err));
    exit;
}
?>
