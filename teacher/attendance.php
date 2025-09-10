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
                  <h4>Attendance</h4>
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
                        <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                    </div>
                </div>


                <!-- Tabs Content -->
                  <div class="p-0">

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                      <h5>Attendance for Course ID: <?= $course_id ?></h5>
                      <button id="startAttendanceBtn" class="btn btn-danger rounded-4">Start Attendance</button>
                    </div>

                    <div id="attendanceSection" style="display:none;">
                      <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Hardcoded attendance data (could be fetched from DB in real app)
                          $students = [
                            ['id' => 'S001', 'name' => 'Alice Johnson', 'status' => 'Absent'],
                            ['id' => 'S002', 'name' => 'Bob Smith', 'status' => 'Absent'],
                            ['id' => 'S003', 'name' => 'Charlie Lee', 'status' => 'Absent'],
                            ['id' => 'S004', 'name' => 'Dana White', 'status' => 'Absent'],
                            ['id' => 'S005', 'name' => 'Eve Martin', 'status' => 'Absent'],
                          ];

                          foreach ($students as $index => $student) :
                          ?>
                            <tr>
                              <td><?= $index + 1 ?></td>
                              <td><?= htmlspecialchars($student['name']) ?></td>
                              <td><?= htmlspecialchars($student['id']) ?></td>
                              <td class="attendance-status text-center" style="cursor:pointer;" data-status="Absent">Absent</td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>

                  </div>

                  <script>
                  // Show attendance table on start button click
                  document.getElementById('startAttendanceBtn').addEventListener('click', () => {
                    document.getElementById('attendanceSection').style.display = 'block';
                    // Disable start button to prevent multiple clicks
                    document.getElementById('startAttendanceBtn').disabled = true;
                  });

                  // Toggle attendance status on click (Absent <-> Present)
                  document.addEventListener('click', function(e) {
                    if(e.target.classList.contains('attendance-status')) {
                      const cell = e.target;
                      const currentStatus = cell.getAttribute('data-status');
                      const newStatus = currentStatus === 'Absent' ? 'Present' : 'Absent';
                      cell.setAttribute('data-status', newStatus);
                      cell.textContent = newStatus;

                      // Update color to visually distinguish status
                      if (newStatus === 'Present') {
                        cell.classList.remove('text-danger');
                        cell.classList.add('text-success');
                      } else {
                        cell.classList.remove('text-success');
                        cell.classList.add('text-danger');
                      }
                    }
                  });

                  // Initially mark all statuses as red (Absent)
                  window.addEventListener('DOMContentLoaded', () => {
                    document.querySelectorAll('.attendance-status').forEach(cell => {
                      cell.classList.add('text-danger');
                    });
                  });
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
