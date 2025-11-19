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
                  <h4>Stream Class</h4>
                </div>

                
              </div>

              <!-- Courses Grid -->
              <div class="row g-3">
                <?php $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>
                <div class="tabs d-flex">
                    <div class="tab ">
                        <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                    </div>
                    <div class="tab">
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
                    <div class="tab active">
                        <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                    </div>
                </div>


                <!-- Tabs Content -->
                <div class="p-0" >
               <?php

                    // Get course ID if editing
                    $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    // Initialize variables
                    $course_name = $description = $day = $start_time = $end_time = "";
                    $section = $subject = $room = "";
                    $cover_photo = "";

                    if ($course_id > 0) {
                        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
                        $stmt->bind_param("i", $course_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($row = $result->fetch_assoc()) {
                            $course_name = $row['course_name'];
                            $description = $row['description'];
                            $status = $row['status'];
                            $joined_id = $row['joined_id'];
                            $day = $row['day'];
                            $start_time = $row['start_time'];
                            $end_time = $row['end_time'];
                            $section = $row['section'];
                            $subject = $row['subject'];
                            $room = $row['room'];
                            $cover_photo = $row['cover_photo'];
                        }
                    }
                    ?>

                   <form action="update_class.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="course_id" value="<?= htmlspecialchars($course_id) ?>">

                      <div class="row g-3">
                          <!-- Left Column -->
                          <div class="col-12 col-md-6">
                              <div class="mb-3">
                                  <label for="courseName" class="form-label">Course ID</label>
                                  <input type="text" class="form-control" id="courseName" name="course_name" placeholder="Enter course name" required value="<?= htmlspecialchars($course_name) ?>">
                              </div> 

                              <div class="mb-3">
                                    <label for="joinedId" class="form-label">Joined ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="joinedId" readonly 
                                            value="<?= htmlspecialchars($joined_id) ?>">
                                        <button class="btn border" type="button" id="copyBtn">
                                            <i class="bi bi-clipboard"></i> Copy
                                        </button>
                                    </div>
                                </div>

                                <script>
                                document.getElementById('copyBtn').addEventListener('click', function() {
                                    const input = document.getElementById('joinedId');
                                    input.select();
                                    input.setSelectionRange(0, 99999); // for mobile devices
                                    navigator.clipboard.writeText(input.value).then(() => {
                                        alert('Course ID copied: ' + input.value);
                                    }).catch(err => {
                                        console.error('Failed to copy: ', err);
                                    });
                                });
                                </script>   


                              <div class="mb-3">
                                  <label for="description" class="form-label">Description</label>
                                  <textarea class="form-control" id="description" name="description" rows="4" placeholder="Brief course description"><?= htmlspecialchars($description) ?></textarea>
                              </div>

                              <div class="mb-3">
                                  <label for="courseDay" class="form-label">Day</label>
                                  <select class="form-select" id="courseDay" name="day" required>
                                      <option disabled <?= $day=="" ? "selected" : "" ?>>Choose a day</option>
                                      <?php
                                      $days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday","Everyday"];
                                      foreach($days as $d){
                                          $selected = ($d == $day) ? "selected" : "";
                                          echo "<option value=\"$d\" $selected>$d</option>";
                                      }
                                      ?>
                                  </select>
                              </div>

                              <div class="row g-2 mb-3">
                                  <div class="col">
                                      <label for="startTime" class="form-label">Start Time</label>
                                      <input type="time" class="form-control" id="startTime" name="start_time" required value="<?= htmlspecialchars($start_time) ?>">
                                  </div>
                                  <div class="col">
                                      <label for="endTime" class="form-label">End Time</label>
                                      <input type="time" class="form-control" id="endTime" name="end_time" required value="<?= htmlspecialchars($end_time) ?>">
                                  </div>
                              </div>
                          </div>

                          <!-- Right Column -->
                          <div class="col-12 col-md-6">
                              <div class="mb-3">
                                  <label for="section" class="form-label">Section</label>
                                  <input type="text" class="form-control" id="section" name="section" placeholder="e.g. Section A, BSIT-2C" required value="<?= htmlspecialchars($section) ?>">
                              </div>

                              <div class="mb-3">
                                  <label for="subject" class="form-label">Subject</label>
                                  <input type="text" class="form-control" id="subject" name="subject" placeholder="e.g. Mathematics, Science" required value="<?= htmlspecialchars($subject) ?>">
                              </div>

                              <div class="mb-3">
                                  <label for="room" class="form-label">Room</label>
                                  <input type="text" class="form-control" id="room" name="room" placeholder="e.g. Room 101, Lab 3" required value="<?= htmlspecialchars($room) ?>">
                              </div>

                              <div class="mb-3">
                                  <label for="coverPhoto" class="form-label">Cover Photo</label>
                                  <input class="form-control" type="file" id="coverPhoto" name="cover_photo" accept="image/*">
                                  <?php if(!empty($cover_photo)): ?>
                                      <small class="text-muted d-block mt-1">Current: <?= htmlspecialchars($cover_photo) ?></small>
                                  <?php endif; ?>
                                  <small class="text-muted">Optional. Recommended size: 800x400px</small>
                              </div>
                          </div>
                      </div>

                      <div class="mt-3">
                          <!-- Update Button -->
                          <button type="submit" name="action" value="update" class="btn btn-outline-danger rounded-4 px-4">
                              <i class="bi bi-pencil-square me-2"></i> Update
                          </button>

                          <!-- Archive / Unarchive Button -->
                          <?php if($status == "active"): ?>
                              <button type="submit" name="action" value="archive" class="btn btn-outline-danger rounded-4 px-4">
                                  <i class="bi bi-archive me-2"></i> Archive
                              </button>
                          <?php else: ?>
                              <button type="submit" name="action" value="unarchive" class="btn btn-outline-danger rounded-4 px-4">
                                  <i class="bi bi-box-arrow-in-up me-2"></i> Unarchive
                              </button>
                          <?php endif; ?>

                          <!-- Delete Button -->
                          <button type="button" class="btn btn-outline-danger rounded-4 px-4" onclick="confirmDelete(<?= htmlspecialchars($course_id) ?>)">
                              <i class="bi bi-trash me-2"></i> Delete
                          </button>
                      </div>
                  </form>


                  <script>
                  function confirmDelete(courseId) {
                      if(confirm("Are you sure you want to delete this course?")) {
                          window.location.href = 'delete_class.php?id=' + courseId;
                      }
                  }
                  </script>


                
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
