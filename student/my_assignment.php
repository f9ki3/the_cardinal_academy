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
    .rounded-circle:hover { background-color: rgb(240, 249, 255) !important; }
    .tabs { display: flex; gap: 30px; padding: 5px; }
    .tab { padding: 8px 0; cursor: pointer; position: relative; }
    .tab p { margin: 0; font-weight: 500; color: #555; }
    .tab.active p { color: #000; }
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
                <h4>My Assignments</h4>
              </div>
            </div>

            <!-- Search Input -->
            <div class="row g-3">
              <div class="col-12">
                <div class="row align-items-center mb-4">
                  <div class="col-12 col-md-10">
                    <div class="input-group w-50">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search assignment title...">
                      <button class="btn border" type="button" onclick="filterAssignments()">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Assignment List -->
                <div class="row g-3 mb-3" id="assignmentList">
                  <?php
                    $user_id = $_SESSION['user_id'];
                    $query = '
                        SELECT assignments.*, courses.course_name
                        FROM assignments
                        INNER JOIN course_students 
                            ON course_students.course_id = assignments.course_id
                        INNER JOIN courses 
                            ON courses.id = course_students.course_id
                        WHERE course_students.student_id = ?
                        ORDER BY assignments.due_date DESC
                    ';
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($assignment = $result->fetch_assoc()) {
                            $assignment_id = $assignment['assignment_id'];
                            $title = htmlspecialchars($assignment['title']);
                            $status = $assignment['accept'];
                            $course_name = htmlspecialchars($assignment['course_name']);
                            $course_id = $assignment['course_id'];
                            $instructions = htmlspecialchars($assignment['instructions']);
                            $points = htmlspecialchars($assignment['points']);
                            $due_date = date('Y-m-d h:i A', strtotime($assignment['due_date']));

                            // Limit instructions to 80 characters
                            $instructions_display = strlen($instructions) > 80 ? substr($instructions, 0, 100) . '...' : $instructions;

                            echo '<div class="col-12 col-md-6 col-lg-4 mb-4 assignment-card">
                                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                        <div class="card-body pt-3 d-flex flex-column">
                                            <p class="small mb-1 text-muted">' . $course_name . '</p>
                                            <h5 class="fw-bolder assignment-title">' . $title . '</h5>
                                            <p class="small mb-1 text-muted" title="' . $instructions . '">Instructions: ' . $instructions_display . '</p>

                                            <div class="d-flex justify-content-start flex-wrap">
                                                <p class="small mb-0 me-3 d-flex align-items-center text-muted">
                                                    <i class="bi bi-patch-check me-2"></i>Points: ' . $points . '
                                                </p>
                                                <p class="small mb-0 d-flex align-items-center text-muted">
                                                    <i class="bi bi-calendar-check me-2"></i>Due Date: ' . $due_date . '
                                                </p>
                                            </div>

                                            <hr>

                                            <div class="mt-auto d-flex justify-content-between align-items-center flex-wrap">
                                                <!-- View Button -->
                                                <a href="view_assignment.php?id=' . $assignment_id . '&course_id=' . $course_id . '" 
                                                  class="btn btn-sm border rounded-circle d-flex align-items-center justify-content-center" 
                                                  style="width: 46px; height: 46px;" 
                                                  title="View Assignment">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <!-- Status Badge -->
                                                <span class="badge text-secondary mb-2">' . ($status == 1 ? 'Closed' : 'Open') . '</span>
                                            </div>
                                        </div>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo '<div class="col-12"><p>No assignments posted for this user in the enrolled courses.</p></div>';
                    }
                    $stmt->close();
                    ?>

                </div>

                <!-- No Results Message -->
                <div id="noResults" class="d-none">
                  <div class="d-flex flex-column justify-content-center align-items-center py-4">
                      <img src="../static/images/art7.svg" alt="No records" style="max-width: 300px; opacity: 70%">
                      <p class="text-center mt-5 text-muted mb-3">No assignment found.</p>
                  </div>
                </div>

                <!-- Search Script -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                  function filterAssignments() {
                    let input = document.getElementById("searchInput").value.toLowerCase();
                    let cards = document.querySelectorAll("#assignmentList .assignment-card");
                    let visibleCount = 0;

                    cards.forEach(card => {
                      let title = card.querySelector(".assignment-title").textContent.toLowerCase();
                      if (title.includes(input)) {
                        card.style.display = "";
                        visibleCount++;
                      } else {
                        card.style.display = "none";
                      }
                    });

                    // Show/hide "No results"
                    document.getElementById("noResults").classList.toggle("d-none", visibleCount > 0);
                  }

                  // Live search as typing
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
