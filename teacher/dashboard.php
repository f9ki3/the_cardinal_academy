<?php
include 'session_login.php';
include '../db_connection.php';
?>

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
                            <div class="row mb-3">
                                <div class="col-12 col-md-5">
                                    <h4>Teacher's Classes</h4>
                                </div>

                                <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
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

                                    <button type="button" class="btn bg-danger text-light rounded rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#createCourseModal">
                                        + Create Class
                                    </button>

                                    <?php include 'create_modal.php'; ?>
                                </div>
                            </div>


                            <?php
                                $alert_message = '';
                                $alert_type = '';

                                if (isset($_GET['success'])) {
                                    switch ($_GET['success']) {
                                        case 'archived':
                                            $alert_message = 'The class has been archived.';
                                            $alert_type = 'danger';
                                            break;
                                        case 'unarchived':
                                            $alert_message = 'The class has been successfully restored.';
                                            $alert_type = 'success';
                                            break;
                                        case '1':
                                            $alert_message = 'The class has been added.';
                                            $alert_type = 'success';
                                            break;
                                        case 'updated':
                                            $alert_message = 'The class has been updated.';
                                            $alert_type = 'success';
                                            break;
                                        case '5':
                                            $alert_message = 'The class has been deleted.';
                                            $alert_type = 'danger';
                                            break;
                                    }
                                }
                            ?>
                            
                            <?php if (!empty($alert_message)): ?>
                                <div class="alert alert-<?= $alert_type; ?> rounded rounded-4 alert-dismissible fade show" role="alert">
                                    <?= $alert_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="row g-3">
                                <?php
                                $teacher_id = $_SESSION['user_id'];
                                $search = trim($_GET['search'] ?? '');
                                $query = "SELECT * FROM courses WHERE teacher_id = ? AND status='active'";
                                $params = [$teacher_id];
                                $types = 'i';

                                if (!empty($search)) {
                                    $query .= " AND (course_name LIKE ? OR subject LIKE ?)";
                                    $search_param = "%$search%";
                                    $params[] = $search_param;
                                    $params[] = $search_param;
                                    $types .= 'ss';
                                }

                                $query .= " ORDER BY id DESC";

                                $stmt = $conn->prepare($query);
                                $stmt->bind_param($types, ...$params);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($course = $result->fetch_assoc()) {
                                        $cover = $course['cover_photo'] ? "../static/uploads/" . htmlspecialchars($course['cover_photo']) : "../static/uploads/default_cover.jpg";
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
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
                            </div> </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>