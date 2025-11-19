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
    .rounded-circle:hover{
      background-color:rgb(240, 249, 255) !important;
    }
  </style>
    <style>
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

    /* underline only active tab */
    .tab.active p {
    color: #000; /* active text color */
    }

    .tab.active::after {
    content: "";
    position: absolute;
    bottom: -2px;  /* sits on base line */
    left: 0;
    width: 100%;
    height: 3px;
    background:rgb(218, 64, 64); /* your active color (green) */
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
          <div>
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 border-bottom col-md-12">
                  <h4>Attendance Records</h4>
                </div>

                
              </div>

              <!-- Courses Grid -->
              <div class="row g-3">
                <?php $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>
                <div class="tabs d-flex">
                    <div class="tab ">
                        <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                    </div>
                    <div class="tab active">
                        <a href="attendance.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Attendance</a>
                    </div>
                    <div class="tab">
                        <a href="assignment.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Assignment</a>
                    </div>
                    <div class="tab">
                        <a href="student.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Students</a>
                    </div>
                    <div class="tab">
                        <a href="grades.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Grades</a>
                    </div>
                    <div class="tab">
                        <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                    </div>
                </div>


                <!-- Tabs Content -->
                <?php
                  $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                  // Fetch distinct attendance dates for the course
                  $stmt = $conn->prepare("SELECT date, COUNT(*) as count FROM attendance WHERE course_id = ? GROUP BY date ORDER BY date DESC");
                  $stmt->bind_param("i", $course_id);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  // $excluded_date = '2025-09-15'; // example date to exclude
                  // $stmt = $conn->prepare("SELECT date, COUNT(*) as count FROM attendance WHERE course_id = ? AND date <> ? GROUP BY date ORDER BY date DESC");
                  // $stmt->bind_param("is", $course_id, $excluded_date);
                  // $stmt->execute();
                  // $result = $stmt->get_result();

                  ?>
    
                  <div class="col-12 col-md-12 p-4 bg-white rounded-4">
                    <div class="row align-items-center mb-4">
                      <div class="col-12 col-md-10">
                        <div class="input-group w-50">
                          <input type="text" id="searchDateInput" class="form-control" placeholder="Search date here...">
                          <button class="btn border" type="button" onclick="filterTable()">
                            <i class="bi bi-search"></i>
                          </button>
                        </div>
                      </div>
                      <div class="col-12 col-md-2 mt-2 mt-md-0">
                        <a href="start_attendance.php?id=<?= $course_id ?>" class="btn btn-danger rounded rounded-4 w-100">
                          <i class="bi bi-play-circle me-2"></i> Start
                        </a>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-hover" id="attendanceTable">
                        <thead>
                          <tr>
                            <th scope="col" class="text-muted">Date</th>
                            <th scope="col" class="text-muted">Present</th>
                            <th scope="col" class="text-muted" style="width: 120px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                              <tr class="text-muted" style="cursor:pointer" onclick="window.location.href='view_attendance.php?id=<?= $course_id ?>&date=<?= $row['date'] ?>'">
                                <td class="text-muted"><?= htmlspecialchars($row['date']) ?></td>
                                <td class="text-muted"><?= intval($row['count']) ?></td>
                                <td>
                                  <button class="btn rounded rounded-circle btn-border btn-sm text-muted" 
                                          style="color: inherit;" 
                                          onclick="event.stopPropagation(); deleteAttendance('<?= $row['date'] ?>');" 
                                          title="Delete">
                                    <i class="bi bi-trash text-muted" style="color: inherit;"></i>
                                  </button>
                                </td>
                              </tr>
                            <?php endwhile; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="3" class="text-center text-muted">No attendance records found.</td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <script>
                  // Simple filter function to filter attendance by date in the table
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

                  // Dummy delete function - you need to implement actual deletion logic with AJAX or form submission
                  function deleteAttendance(date) {
                    if (confirm(`Are you sure you want to delete attendance for ${date}?`)) {
                      // You can implement AJAX here or redirect to delete script
                      // Example: window.location.href = `delete_attendance.php?course_id=<?= $course_id ?>&date=${date}`;
                      alert('Delete function is not implemented yet.');
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
</div>

<?php include 'footer.php'; ?>
</body>
</html>
