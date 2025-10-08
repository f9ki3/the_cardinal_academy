<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Start Attendance</title>
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

    <style>
    @media print {
      .print-hide {
        display: none !important;
        visibility: hidden !important;
      }
      .bg-light {
        background-color: white !important;
      }
      .bg-white {
        background-color: white !important;
        padding: 0 !important;
      }
      .tabs, .att {
        display: none !important;
      }
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
                <?php $date = isset($_GET['date']) ? $_GET['date'] : ''; ?>
                <h3 class="mb-4">Student Attendance as of <?php echo $date; ?></h3>
              </div>
              <div class="row mb-3">
                <div class="col-12 border-bottom col-md-12">
                  <h4 class="att">Attendance</h4>
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
                    <!-- <div class="tab">
                        <a href="student.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Grade Sheet</a>
                    </div> -->
                    <div class="tab">
                        <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                    </div>
                </div>


                <!-- Tabs Content -->
                <div class="col-12 col-md-12 p-4 bg-white rounded-4">
                  <!-- Attendance Header Row -->
                    <div class="row align-items-center mb-4 print-hide">
                      <div class="col-12 col-md-10">
                        <h4>Attendance as of <?php echo $date; ?></h4>
                      </div>
                      <div class="col-12 d-flex g-2 col-md-2 mt-2 mt-md-0">
                        <a href="attendance.php?id=<?php echo $course_id; ?>" class="btn me-2 w-100 btn-outline-danger rounded-4" role="button">
                          <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <a href="#" 
                          class="btn w-100 btn-outline-danger rounded-4" 
                          role="button" 
                          onclick="window.print(); return false;">
                          <i class="bi bi-printer"></i> Print
                        </a>

                      </div>
                    </div>



                  <?php if (isset($_GET['message'])): ?>
                        <?php
                            $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
                            // Use alertType from URL or fallback to 'info'
                            $alertType = isset($_GET['alertType']) ? htmlspecialchars($_GET['alertType'], ENT_QUOTES, 'UTF-8') : 'info';
                        ?>
                        <div class="alert alert-<?= $alertType ?> alert-dismissible fade show mt-3" role="alert">
                            <?= $message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>




                  <div class="table-responsive">
                    <?php
                        date_default_timezone_set('Asia/Manila');

                        // Get course ID
                        $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                        

                        // Fetch today's attendance for the course
                        $stmt = $conn->prepare("SELECT first_name, last_name, rfid, time_in FROM attendance WHERE course_id = ? AND date = ? ORDER BY time_in ASC");
                        $stmt->bind_param("is", $course_id, $date); // Bind parameters correctly
                        $stmt->execute();
                        $result = $stmt->get_result();

                        ?>

                        <!-- Bootstrap Table -->
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">First name</th>
                                    <th scope="col" class="text-muted">Last name</th>
                                    <th scope="col" class="text-muted">RFID</th>
                                    <th scope="col" class="text-muted">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="text-muted"><?= htmlspecialchars($row['first_name']) ?></td>
                                            <td class="text-muted"><?= htmlspecialchars($row['last_name']) ?></td>
                                            <td class="text-muted"><?= htmlspecialchars($row['rfid']) ?></td>
                                            <td class="text-muted">
                                                <?php
                                                    $time_in_12hr = date('h:i A', strtotime($row['time_in']));
                                                    echo $time_in_12hr;
                                                ?>
                                            </td>
                                        </tr>

                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No attendance recorded for today.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <?php
                        $stmt->close();
                        $conn->close();
                        ?>


                  </div>
                </div>
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
