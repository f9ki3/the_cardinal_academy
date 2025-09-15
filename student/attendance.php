<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <style>
    .rounded-circle:hover {
      background-color: rgb(240, 249, 255) !important;
    }

    .tabs {
      display: flex;
      gap: 30px;
      padding: 5px;
    }

    .tab {
      padding: 8px 0;
      cursor: pointer;
      position: relative;
    }

    .tab p {
      margin: 0;
      font-weight: 500;
      color: #555;
    }

    .tab.active p {
      color: #000;
    }

    .tab.active::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 3px;
      background: rgb(218, 64, 64);
      border-radius: 2px;
    }
  </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="container my-4">
            <div class="row mb-3">
              <div class="col-12 border-bottom col-md-12">
                <h4>My Attendance</h4>
              </div>
            </div>

            <div class="row g-3">
              <?php $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>
              <div class="tabs d-flex">
                <div class="tab">
                    <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                </div>
                <div class="tab active">
                    <a href="attendance.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Attendance</a>
                </div>
                <div class="tab">
                    <a href="assignment.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Assignment</a>
                </div>
                <div class="tab">
                    <a href="document.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Files and Documents</a>
                </div>
              </div>

              <?php
                    $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    $student_id = $_SESSION['user_id'];

                    // Fetch each attendance record
                    $stmt = $conn->prepare("
                        SELECT date, time_in
                        FROM attendance 
                        WHERE course_id = ? AND user_id = ? 
                        ORDER BY date DESC
                    ");

                    $stmt->bind_param("ii", $course_id, $student_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>

                    <div class="col-12 col-md-12 p-4 bg-white rounded-4">

                    <div class="table-responsive">
                        <table class="table" id="attendanceTable">
                        <thead>
                            <tr>
                            <th scope="col" class="text-muted">Date</th>
                            <th scope="col" class="text-muted">Time In</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                              <tr class="text-muted">
                                <td><p class="text-muted mb-0"><?= htmlspecialchars(date("Y-m-d", strtotime($row['date']))) ?></p></td>
                                <td><p class="text-muted mb-0"><?= htmlspecialchars(date("g:i A", strtotime($row['time_in']))) ?></p></td>
                              </tr>
                            <?php endwhile; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="2" class="text-center text-muted">No attendance records found.</td>
                            </tr>
                          <?php endif; ?>
                        </tbody>

                        </table>
                    </div>
                    </div>


              <script>
              function filterTable() {
                const input = document.getElementById("searchDateInput").value.toLowerCase();
                const table = document.getElementById("attendanceTable");
                const trs = table.tBodies[0].getElementsByTagName("tr");

                for (let i = 0; i < trs.length; i++) {
                  const dateCell = trs[i].getElementsByTagName("td")[0];
                  if (dateCell) {
                    const dateText = dateCell.textContent || dateCell.innerText;
                    trs[i].style.display = dateText.toLowerCase().indexOf(input) > -1 ? "" : "none";
                  }
                }
              }
              </script>

            </div>
          </div> <!-- end inner container -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
