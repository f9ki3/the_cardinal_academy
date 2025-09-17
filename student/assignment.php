<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Post Assignment</title>
  <?php include 'header.php'; ?>
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
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="container my-4">
            <div class="row mb-3">
              <div class="col-12 border-bottom col-md-12">
                <?php 
                  $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                  $course_name = '';

                  // JOIN assignments with course to get course_name
                  $query = "
                    SELECT 
                      assignments.*, 
                      courses.course_name 
                    FROM assignments 
                    JOIN courses ON assignments.course_id = courses.id 
                    WHERE assignments.course_id = '$course_id' 
                    ORDER BY due_date DESC
                  ";
                  $result = mysqli_query($conn, $query);

                  $assignments = [];

                  if (mysqli_num_rows($result) > 0) {
                      $first_row = mysqli_fetch_assoc($result);
                      $course_name = $first_row['course_name'];
                      $assignments[] = $first_row;

                      while ($row = mysqli_fetch_assoc($result)) {
                          $assignments[] = $row;
                      }
                  }
                ?>

                <!-- Show course name -->
                <h4>Assignments - <?= htmlspecialchars($course_name) ?></h4>
              </div>
            </div>

            <!-- Course Tabs -->
            <div class="row g-3">
              <div class="tabs d-flex">
                <div class="tab">
                  <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                </div>
                <div class="tab">
                  <a href="attendance.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Attendance</a>
                </div>
                <div class="tab active">
                  <a href="assignment.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Assignment</a>
                </div>
                <div class="tab">
                    <a href="document.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Files and Documents</a>
                </div>
              </div>

              <!-- Post Assignment Form -->
              <div class="col-12">
                <div class="row align-items-center mb-4">
                  <div class="col-12 col-md-10">
                    <div class="input-group w-50">
                      <input type="text" id="searchDateInput" class="form-control" placeholder="Search assignment here...">
                      <button class="btn border" type="button" onclick="filterTable()">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Assignment List -->
                <div class="row g-3 mb-3">
                  <?php
                    if (count($assignments) > 0) {
                      foreach ($assignments as $assignment) {
                        $assignment_id = $assignment['assignment_id'];
                        $title = $assignment['title'];
                        $instructions = $assignment['instructions'];
                        $course_name = $assignment['course_name'];
                        $points = $assignment['points'];
                        $due_date = date("Y-m-d H:i A", strtotime($assignment['due_date']));
                        $accept = $assignment['accept'];

                        $iconClass = $accept == 1 ? 'bi-check-circle' : 'bi-x-circle';
                        $action = $accept == 1 ? 'reject' : 'accept';
                        $tooltip = $accept == 1 ? 'Accepted' : 'Not Accepted';

                        echo "<div class='col-12 col-md-6 col-lg-4'>
                                <div class='card h-100 shadow-sm border-0 rounded-4 overflow-hidden'>
                                  <div class='card-body pt-3 d-flex flex-column'>
                                    <p class='small mb-1 text-muted'>$course_name</p>
                                    <h5 class='fw-bolder'>$title</h5>
                                    <p class='small mb-1 text-muted'>Instructions: $instructions</p>
                                    
                                    <div class='d-flex justify-content-start'>
                                      <p class='small mb-0 d-flex align-items-center text-muted'>
                                        <i class='bi bi-patch-check me-2'></i>Points: $points
                                      </p>
                                      <p class='small ms-3 mb-0 d-flex align-items-center text-muted'>
                                        <i class='bi bi-calendar-check me-2'></i>Due Date: $due_date
                                      </p>
                                    </div>

                                    <hr>

                                    <div class='mt-auto d-flex gap-2 justify-content-start'>
                                        <!-- View Button -->
                                        <a href='view_assignment.php?id=$assignment_id' class='btn btn-sm border rounded-circle d-flex align-items-center justify-content-center' 
                                          style='width: 46px; height: 46px;' title='View Assignment'>
                                          <i class='bi bi-eye'></i>
                                        </a>
                                    </div>
                                  </div>
                                </div>
                              </div>";
                      }
                    } else {
                      echo "<div class='col-12'><p>No assignments posted for this course.</p></div>";
                    }
                  ?>
                </div>

                <!-- AJAX Script -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        // Handle toggle click
                        $('.toggle-accept').on('click', function (e) {
                            e.preventDefault();

                            var button = $(this);
                            var assignment_id = button.data('id');
                            var action = button.data('action');

                            // Confirm action
                            var confirmationMessage = action === 'accept' ? "Do you want to accept this assignment?" : "Do you want to reject this assignment?";
                            
                            if (confirm(confirmationMessage)) {
                                $.ajax({
                                    url: 'update_accept.php',
                                    type: 'GET',
                                    data: { id: assignment_id, action: action },
                                    success: function(response) {
                                        var data = JSON.parse(response);
                                        if (data.success) {
                                            var newAction = data.accept == 1 ? 'reject' : 'accept';
                                            var newIcon = data.accept == 1 ? 'bi-check-circle' : 'bi-x-circle';
                                            var newTooltip = data.accept == 1 ? 'Accepted' : 'Not Accepted';

                                            button.find('i').removeClass().addClass('bi ' + newIcon);
                                            button.data('action', newAction);
                                            button.attr('title', newTooltip);
                                        } else {
                                            alert('Error updating accept status.');
                                        }
                                    }
                                });
                            }
                        });
                    });
                </script>

              </div>
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
