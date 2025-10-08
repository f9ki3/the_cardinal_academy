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

                <h4>Assignments - <?= htmlspecialchars($course_name) ?></h4>
              </div>
            </div>

            <!-- Tabs -->
            <div class="row g-3">
              <div class="tabs d-flex">
                <div class="tab"><a href="course.php?id=<?= $course_id ?>" class="text-dark text-decoration-none">Stream</a></div>
                <div class="tab"><a href="attendance.php?id=<?= $course_id ?>" class="text-dark text-decoration-none">Attendance</a></div>
                <div class="tab active"><a href="assignment.php?id=<?= $course_id ?>" class="text-dark text-decoration-none">Assignment</a></div>
                <div class="tab"><a href="document.php?id=<?= $course_id ?>" class="text-dark text-decoration-none">Files and Documents</a></div>
              </div>

              <!-- Search -->
              <div class="col-12">
                <div class="row align-items-center mb-4">
                  <div class="col-12 col-md-10">
                    <div class="input-group w-50">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search assignment...">
                      <button class="btn border" type="button" onclick="filterAssignments()">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Assignment List -->
                <div class="row g-3 mb-3" id="assignmentList">
                  <?php
                    if (count($assignments) > 0) {
                      foreach ($assignments as $assignment) {
                        $assignment_id = $assignment['assignment_id'];
                        $title = htmlspecialchars($assignment['title']);
                        $instructions = htmlspecialchars($assignment['instructions']);
                        $course_name = htmlspecialchars($assignment['course_name']);
                        $points = $assignment['points'];
                        $due_date = date("Y-m-d H:i A", strtotime($assignment['due_date']));
                        $status = $assignment['accept'];

                        // Limit instructions to 100 characters
                        $short_instructions = strlen($instructions) > 100 ? substr($instructions, 0, 100) . "..." : $instructions;

                        echo "<div class='col-12 col-md-6 col-lg-4 mb-4 assignment-card'>
                                <div class='card h-100 shadow-sm border-0 rounded-4 overflow-hidden'>
                                  <div class='card-body pt-3 d-flex flex-column'>
                                    <p class='small mb-1 text-muted course-name'>$course_name</p>
                                    <h5 class='fw-bolder assignment-title'>$title</h5>
                                    <p class='small mb-2 text-muted instructions'>Instructions: $short_instructions</p>
                                    
                                    <div class='d-flex flex-wrap justify-content-start gap-3 mb-2'>
                                      <p class='small mb-0 d-flex align-items-center text-muted'>
                                        <i class='bi bi-patch-check me-2'></i>Points: $points
                                      </p>
                                      <p class='small mb-0 d-flex align-items-center text-muted'>
                                        <i class='bi bi-calendar-check me-2'></i>Due Date: $due_date
                                      </p>
                                    </div>

                                    <hr class='my-2'>

                                    <div class='mt-auto d-flex justify-content-between align-items-center'>
                                        <a href='view_assignment.php?id=$assignment_id&course_id=$course_id' 
                                          class='btn btn-sm border rounded-circle d-flex align-items-center justify-content-center' 
                                          style='width: 46px; height: 46px;' title='View Assignment'>
                                            <i class='bi bi-eye'></i>
                                        </a>
                                        <span class='badge text-secondary mb-2'>
                                            " . ($status == 1 ? "Closed" : "Open") . "
                                        </span>
                                    </div>
                                  </div>
                                </div>
                              </div>";
                      }
                    } else {
                      echo '<div class="d-flex flex-column justify-content-center align-items-center py-4">
                      <img src="../static/images/art7.svg" alt="No records" style="max-width: 300px; opacity: 70%">
                      <p class="text-center mt-5 text-muted mb-3">No assignment found.</p>
                  </div>';
                    }
                  ?>
                </div>

                <!-- No Results -->
                <div id="noResults" class="d-none">
                  <div class="d-flex flex-column justify-content-center align-items-center py-4">
                      <img src="../static/images/art7.svg" alt="No records" style="max-width: 300px; opacity: 70%">
                      <p class="text-center mt-5 text-muted mb-3">No assignment found.</p>
                  </div>
                </div>

                <!-- Search Script -->
                <script>
                  function filterAssignments() {
                    let input = document.getElementById("searchInput").value.toLowerCase();
                    let cards = document.querySelectorAll("#assignmentList .assignment-card");
                    let visibleCount = 0;

                    cards.forEach(card => {
                      let title = card.querySelector(".assignment-title").textContent.toLowerCase();
                      let instructions = card.querySelector(".instructions").textContent.toLowerCase();
                      let course = card.querySelector(".course-name").textContent.toLowerCase();

                      if (title.includes(input) || instructions.includes(input) || course.includes(input)) {
                        card.style.display = "";
                        visibleCount++;
                      } else {
                        card.style.display = "none";
                      }
                    });

                    document.getElementById("noResults").classList.toggle("d-none", visibleCount > 0);
                  }

                  document.getElementById("searchInput").addEventListener("keyup", filterAssignments);
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
