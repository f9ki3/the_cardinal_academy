<?php
include 'session_login.php';
include '../db_connection.php';

// Set Philippine Standard Time
date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rfid = trim($_POST['rfid_code']);
    $type = $_POST['attendance_type'];
    $teacher_id = $_POST['teacher_id'] ?? null;

    if (!empty($rfid) && in_array($type, ['time_in', 'time_out'])) {
        // 1. Find student by RFID
        $query = "SELECT user_id AS student_id, CONCAT(first_name, ' ', last_name) AS fullname FROM users WHERE rfid = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Prepare failed: " . $conn->error . "
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>");
        }
        $stmt->bind_param("i", $rfid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $student_id = $user['student_id'];
            $fullname = $user['fullname'];

            $current_date = date('Y-m-d');
            $current_time = date('H:i:s');

            if ($type === 'time_in') {
                // 2. Check if already has a time_in for today
                $check = $conn->prepare("SELECT id FROM attendance WHERE student_id = ? AND date = ?");
                $check->bind_param("is", $student_id, $current_date);
                $check->execute();
                $check_result = $check->get_result();

                if ($check_result->num_rows > 0) {
                    $message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    ⚠️ Time In already recorded for <strong>$fullname</strong> today.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                    header("Location: attendance.php?message=" . urlencode($message));
                    exit;
                } else {
                    // 3. Insert Time In
                    $insert = $conn->prepare("INSERT INTO attendance (`date`, `time_in`, `teacher_id`, `student_id`) VALUES (?, ?, ?, ?)");
                    if (!$insert) {
                        die("<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Insert prepare failed: " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                             </div>");
                    }

                    $insert->bind_param("ssii", $current_date, $current_time, $teacher_id, $student_id);
                    $insert->execute();

                    if ($insert->affected_rows > 0) {
                        $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        ✅ Time In recorded for <strong>$fullname</strong> at $current_time.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                        header("Location: attendance.php?message=" . urlencode($message));
                        exit;
                    } else {
                        $message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        ⚠️ Failed to record Time In.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                        header("Location: attendance.php?message=" . urlencode($message));
                        exit;
                    }
                }

            } elseif ($type === 'time_out') {
                // 4. Check if there's an open time_in with NULL time_out
                $check = $conn->prepare("SELECT id FROM attendance WHERE student_id = ? AND date = ? AND time_out IS NULL");
                $check->bind_param("is", $student_id, $current_date);
                $check->execute();
                $check_result = $check->get_result();

                if ($check_result->num_rows > 0) {
                    // 5. Update Time Out
                    $update = $conn->prepare("UPDATE attendance SET time_out = ? WHERE student_id = ? AND date = ? AND time_out IS NULL");
                    if (!$update) {
                        die("<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Update prepare failed: " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                             </div>");
                    }

                    $update->bind_param("sis", $current_time, $student_id, $current_date);
                    $update->execute();

                    if ($update->affected_rows > 0) {
                        $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        ✅ Time Out recorded for <strong>$fullname</strong> at $current_time.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                        header("Location: attendance.php?message=" . urlencode($message));
                        exit;
                    } else {
                        $message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        ⚠️ Failed to update Time Out.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                        header("Location: attendance.php?message=" . urlencode($message));
                        exit;
                    }
                } else {
                    $message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    ⚠️ No Time In found or already Timed Out for <strong>$fullname</strong> today.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                    header("Location: attendance.php?message=" . urlencode($message));
                    exit;
                }
            }

        } else {
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            ❌ RFID not recognized. Student not found.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            header("Location: attendance.php?message=" . urlencode($message));
            exit;
        }
    } else {
        $message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        ⚠️ Missing or invalid data. Please check the form.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        header("Location: attendance.php?message=" . urlencode($message));
        exit;
    }
} else {
    $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    ❌ Invalid request method.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    header("Location: attendance.php?message=" . urlencode($message));
    exit;
}
?>
