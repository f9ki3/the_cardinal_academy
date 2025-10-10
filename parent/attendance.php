<?php
include 'session_login.php';
include '../db_connection.php';

// ✅ Set timezone to Philippine Standard Time
date_default_timezone_set('Asia/Manila');

// ✅ Get logged-in parent ID
$parent_id = $_SESSION['user_id'] ?? null;

// ✅ Alert messages handling
$alert_message = '';
$alert_type = '';

if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'archived':
            $alert_message = 'The class has been archived.';
            $alert_type = 'danger';
            break;
        case 'unarchived':
            $alert_message = 'The class has been successfully restored.';
            $alert_type = 'success';
            break;
        case '2':
            $alert_message = 'Password changed successfully.';
            $alert_type = 'success';
            break;
        case 'updated':
            $alert_message = 'The information has been updated.';
            $alert_type = 'success';
            break;
        case '5':
            $alert_message = 'The class has been deleted.';
            $alert_type = 'danger';
            break;
    }
}

// ✅ Fetch attendance data linked to this parent
$attendance_records = [];
if ($parent_id) {
    $query = "
        SELECT 
            a.date, 
            a.time_in, 
            a.rfid, 
            a.first_name, 
            a.last_name,
            c.course_name
        FROM attendance AS a
        LEFT JOIN courses AS c ON a.course_id = c.id
        WHERE a.parent_id = ?
        ORDER BY a.date DESC, a.time_in DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $attendance_records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance Records</title>
    <?php include 'header.php'; ?>
    <style>
        .rounded-circle:hover {
            background-color: rgb(240, 249, 255) !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex flex-row">
        <?php include 'navigation.php'; ?>

        <div class="content flex-grow-1">
            <?php include 'nav_top.php'; ?>

            <div class="container my-4">
                <div class="d-none mt-5 d-print-flex justify-content-center">
                    <div class="d-flex align-items-center mb-4">
                        <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
                        <div>
                            <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
                            <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan</small>
                            <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
                        </div>
                    </div>
                </div>

                <div class="d-none d-print-flex justify-content-center">
                    <h3>Attendance Records</h3>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                      <div class="container my-4">
                        <div class="d-flex att justify-content-between align-items-center mb-3">
                          <div>
                            <h4>Attendance Records</h4>
                            <p>Below are the attendance logs of your linked students.</p>
                          </div>
                          <div>
                            <button class="btn rounded-4 btn-danger" onclick="window.print();">
                              <i class="bi bi-printer me-1"></i> Print
                            </button>
                          </div>
                        </div>

                        <!-- ✅ Alert Message -->
                        <?php if (!empty($alert_message)): ?>
                            <div class="alert alert-<?= $alert_type; ?> rounded-4 alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($alert_message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- ✅ Attendance Table -->
                        <div class="table-responsive p-4 bg-white rounded-4 mt-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>RFID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Course</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($attendance_records)): ?>
                                        <?php foreach ($attendance_records as $row): ?>
                                            <tr>
                                                <td class="py-3 text-muted"><?= htmlspecialchars($row['date']); ?></td>
                                                <td class="py-3 text-muted"><?= date('h:i A', strtotime($row['time_in'])); ?></td>
                                                <td class="py-3 text-muted"><?= htmlspecialchars($row['rfid']); ?></td>
                                                <td class="py-3 text-muted"><?= htmlspecialchars($row['first_name']); ?></td>
                                                <td class="py-3 text-muted"><?= htmlspecialchars($row['last_name']); ?></td>
                                                <td class="py-3 text-muted"><?= htmlspecialchars($row['course_name'] ?? 'N/A'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No attendance records found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
