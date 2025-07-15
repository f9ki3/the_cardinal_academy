<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
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
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-5">
                  <h4>Attendance Records</h4>
                </div>

                <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <form method="GET" action="" class="flex-grow-1">
                    <div class="input-group">
                      <input 
                        class="form-control rounded rounded-4" 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                        placeholder="Search Date (e.g. 2024-07-01)"
                      >
                      <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
                    </div>
                  </form>

                  <a href="attendance.php" class="btn bg-main text-light rounded rounded-4 px-4">
                    Add Attendance
                  </a>
                </div>
              </div>

              <?php
              // Get the search value
              $search = isset($_GET['search']) ? trim($_GET['search']) : '';

              // Prepare SQL
              if ($search !== '') {
                  $sql = "SELECT DISTINCT date, teacher_id FROM attendance WHERE date LIKE ? ORDER BY date DESC";
                  $stmt = mysqli_prepare($conn, $sql);
                  $search_param = "%$search%";
                  mysqli_stmt_bind_param($stmt, "s", $search_param);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
              } else {
                  $sql = "SELECT DISTINCT date, teacher_id FROM attendance ORDER BY date DESC";
                  $result = mysqli_query($conn, $sql);
              }

              ?>

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Teacher</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr 
                          class="clickable-row" 
                          data-date="<?= htmlspecialchars($row['date']) ?>" 
                          data-teacher-id="<?= htmlspecialchars($row['teacher_id']) ?>" 
                          style="cursor: pointer;"
                        >
                          <td class="align-middle text-muted"><?= htmlspecialchars($row['date']) ?></td>
                          <td class="align-middle">
                             <p><?= htmlspecialchars($full_name) ?></p>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="2">
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

            </div> <!-- inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Moved script here outside of loop -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
      row.addEventListener('click', function () {
        const date = this.getAttribute('data-date');
        const teacherId = this.getAttribute('data-teacher-id');
        window.location.href = `view_attendance.php?date=${encodeURIComponent(date)}&teacher_id=${encodeURIComponent(teacherId)}`;
      });
    });
  });
</script>

<?php include 'footer.php'; ?>
</body>
</html>
