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
                <!-- Header and Search -->
                <div class="row mb-3">
                    <div class="col-12 col-md-5">
                        <h4>My Classes</h4>
                    </div>

                    <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <!-- Search Form -->
                        <form method="GET" action="" class="flex-grow-1">
                            <div class="input-group">
                                <input 
                                    class="form-control rounded rounded-4" 
                                    type="text" 
                                    name="search" 
                                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                                    placeholder="Search by course name or subject"
                                >
                                <button type="submit" class="btn border ms-2 rounded rounded-4" style="background-color: white;">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                            </div>
                        </form>

                        <!-- Create Course Button -->
                        <button type="button" class="btn bg-danger text-light rounded rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#joinCourses">
                            + Join Class
                        </button>
                        <?php include 'join_course.php'?>
                    </div>
                </div>
                <?php
                    if (isset($_GET['status'])) {
                        switch ($_GET['status']) {
                            case 'joined_success':
                                echo "<div class='alert alert-success alert-dismissible fade show rounded-4' role='alert'>
                                        Successfully joined the course!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                break;
                            case 'already_joined':
                                echo "<div class='alert alert-warning alert-dismissible fade show rounded-4' role='alert'>
                                        You are already enrolled in this course.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                break;
                            case 'invalid_code':
                                echo "<div class='alert alert-danger alert-dismissible fade show rounded-4' role='alert'>
                                        Invalid join code. Please try again.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                break;
                            case 'join_failed':
                                echo "<div class='alert alert-danger alert-dismissible fade show rounded-4' role='alert'>
                                        Failed to join the course. Try again later.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                break;
                            case 'empty_code':
                                echo "<div class='alert alert-warning alert-dismissible fade show rounded-4' role='alert'>
                                        Please enter a join code.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                break;
                        }
                    }
                    ?>



                <!-- Courses Grid -->
             <div class="row g-3">
                    <?php
                    $student_id = $_SESSION['user_id'];
                    $search = trim($_GET['search'] ?? '');

                    // Base query with join to course_students
                    $query = "SELECT c.* 
                            FROM courses c
                            INNER JOIN course_students cs ON c.id = cs.course_id
                            WHERE cs.student_id = ?";

                    // Add search condition
                    if ($search) {
                        $query .= " AND (c.course_name LIKE ? OR c.subject LIKE ?)";
                    }

                    // Add ordering: latest first (by id or created_at)
                    $query .= " ORDER BY c.id DESC"; // use c.created_at DESC if you have timestamp

                    // Prepare statement
                    if ($search) {
                        $search_param = "%$search%";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("iss", $student_id, $search_param, $search_param);
                    } else {
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $student_id);
                    }


                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($course = $result->fetch_assoc()) {
                            $cover = $course['cover_photo'] ? "../static/uploads/" . $course['cover_photo'] : "../static/images/Classroom High School.jpg";
                            ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                    <!-- Top Image with overlay -->
                                    <a href="course.php?id=<?= $course['id'] ?>" class="text-decoration-none">
                                        <div class="position-relative" style="height: 150px; overflow: hidden;">
                                            <img src="<?= $cover ?>" alt="Course" class="w-100 h-100" style="object-fit: cover;">
                                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
                                            <div class="position-absolute bottom-0 start-0 p-3 text-light">
                                                <h5 class="mb-1 fw-bolder"><?= htmlspecialchars($course['course_name']) ?></h5>
                                                <p class="small mb-1"><?= htmlspecialchars($course['description']) ?></p>
                                                <p class="small mb-0">
                                                    <i class="bi bi-calendar-event me-1"></i> <?= htmlspecialchars($course['day']) ?>
                                                    <span class="ms-2">
                                                        <i class="bi bi-clock me-1"></i> <?= date("h:i A", strtotime($course['start_time'])) ?> - <?= date("h:i A", strtotime($course['end_time'])) ?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Card Buttons -->
                                    <div class="card-body d-flex flex-column">
                                        <div class="mt-auto d-flex gap-2 justify-content-start">
                                            <a href="course.php?id=<?= $course['id'] ?>" class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Course Details">
                                                <i class="bi bi-journal-bookmark"></i>
                                            </a>
                                            <a href="attendance.php?id=<?= $course['id'] ?>" class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Attendance">
                                                <i class="bi bi-clipboard-check"></i>
                                            </a>
                                            <a href="assignment.php?id=<?= $course['id'] ?>" class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Assignments">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="d-flex flex-column justify-content-center align-items-center py-4">
                                <img src="../static/images/art7.svg" alt="No records" style="max-width: 300px; opacity: 70%">
                                <p class="text-center mt-5 text-muted mb-3">No class or course found.</p>
                            </div>';
                    }

                    $stmt->close();
                    ?>
                </div>

                <!-- End Courses Grid -->

            </div> <!-- End inner container -->
        </div>
    </div>
</div>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
