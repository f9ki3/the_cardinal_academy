<?php
include 'session_login.php';
include '../db_connection.php';

// Get passed date and teacher_id
$date = $_GET['date'] ?? '';
$teacher_id = $_GET['teacher_id'] ?? '';

// Prepare and execute query with WHERE clause
$sql = "SELECT 
            attendance.id,
            attendance.date,
            attendance.time_in,
            attendance.time_out,
            attendance.teacher_id,
            attendance.student_id,
            CONCAT(users.first_name, ' ', users.last_name) AS fullname
        FROM attendance
        INNER JOIN users ON attendance.student_id = users.user_id
        WHERE attendance.date = ? AND attendance.teacher_id = ?
        ORDER BY attendance.time_in ASC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $date, $teacher_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Handle error
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
</head>
<body style="background-white">
<div class="d-flex flex-row">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-4">
            <div class="row mb-3">
              <div class="col-md-11">
                <h4 class="d-print-none">Attendance Records</h4>
              </div>

              <div class="col-12 d-print-none col-md-1">
                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                    <i class="bi bi-printer w-100 me-1"></i> Print
                </button>
              </div>
            </div>

             <div class="d-none d-print-flex justify-content-center">
                <div class="d-flex align-items-center mb-4">
                  <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
                  <div>
                    <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
                    <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan </small>
                    <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
                  </div>
                </div>
              </div>
              

              <div class="d-none d-print-flex justify-content-center">
               <h3>Attendance Records</h3>
              </div>

            <?php if (isset($_GET['message'])): ?>
              <?= $_GET['message'] ?>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table" >
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Student</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><p class="text-muted  mb-0"><?= htmlspecialchars($row['date']) ?></p></td>
                        <td><p class="text-muted  mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                        <td>
                          <p class="text-muted  mb-0">
                            <?= $row['time_in'] ? date('h:i:s A', strtotime($row['time_in'])) : '<span class="text-muted">--</span>' ?>
                          </p>
                        </td>
                        <td>
                          <p class="text-muted  mb-0">
                            <?= $row['time_out'] ? date('h:i:s A', strtotime($row['time_out'])) : '<span class="text-muted">--</span>' ?>
                          </p>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4">
                        <div class="d-flex flex-column justify-content-center align-items-center py-4">
                          <p class="text-center text-muted mb-3">No attendance records found.</p>
                          <img src="../static/images/art7.svg" alt="No records" style="max-width: 300px; opacity: 70%">
                        </div>
                      </td>
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

<script src="sendToArduino.js"></script>
