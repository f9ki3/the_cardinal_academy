<?php
include 'session_login.php';
include '../db_connection.php';

// Fetch all records from the attendance table
$sql = "SELECT * FROM attendance ";

$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Admission</title>
  <?php include 'header.php' ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded pt-4 p-3 bg-white">
            <div class="row mb-3">

              <div class="col-md-8">
                <div id="liveTime" class=" fw-bold"></div>
                <p id="date">Date</p>
              </div>
              <div class="col-12 col-md-4">
               <form id="attendanceForm" method="POST" action="attendance_rfid.php">
                <input type="hidden" name="teacher_id" id="teacher_id" value="<?= $_SESSION['user_id'] ?>">
                    <div class="input-group">
                        <input 
                        type="text" 
                        name="rfid_code" 
                        id="rfid_code"
                        class="form-control" 
                        placeholder="Scan RFID or Enter ID" 
                        required
                        >
                        <select class="form-select" name="attendance_type" id="attendance_type" required>
                        <option value="time_in" selected>Time In</option>
                        <option value="time_out">Time Out</option>
                        </select>
                    </div>
                    </form>
              </div>
            </div>
            <?php if (isset($_GET['message'])): ?>
                <?= $_GET['message'] ?>
            <?php endif; ?>


            <?php
                // Fetch only today's attendance records and join with users table to get full name
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
                        WHERE attendance.date = CURDATE()
                        ORDER BY attendance.time_in ASC";

                $result = mysqli_query($conn, $sql);

                // Check for query errors
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }
                ?>

                <div class="table-responsive">
                <table class="table table-hover">
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
                            <td><p class="text-muted py-3 mb-0"><?= htmlspecialchars($row['date']) ?></p></td>
                            <td><p class="text-muted py-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                            <td>
                                <p class="text-muted py-3 mb-0">
                                    <?= $row['time_in'] ? date('h:i:s A', strtotime($row['time_in'])) : '<span class="text-muted">--</span>' ?>
                                </p>
                            </td>
                            <td>
                                <p class="text-muted py-3 mb-0">
                                    <?= $row['time_out'] ? date('h:i:s A', strtotime($row['time_out'])) : '<span class="text-muted">--</span>' ?>
                                </p>
                            </td>
                        </tr>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                        <td colspan="7" class="text-center text-muted">No attendance records found.</td>
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

<!-- Scripts -->
<script>
function updateClock() {
    const now = new Date();

    const timeString = now.toLocaleTimeString([], {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: true
    });

    const dateString = now.toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
    });

    const timeElement = document.getElementById('liveTime');
    if (timeElement) {
    timeElement.innerHTML = `<h1 class="fw-bold">${timeString}</h1>`;
    }

    const dateElement = document.getElementById('date');
    if (dateElement) {
    dateElement.textContent = dateString;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateClock();
    setInterval(updateClock, 1000);

    // Focus RFID input only when selection is made
    const select = document.getElementById('attendance_type');
    const rfidInput = document.getElementById('rfid_code');

    select.addEventListener('change', () => {
    if (select.value !== '') {
        rfidInput.focus();
    }
    });

    // Clickable row redirect
    document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', () => {
        const id = row.getAttribute('data-id');
        if (id) {
        window.location.href = `view_admission.php?id=${id}`;
        }
    });
    });
});
</script>
