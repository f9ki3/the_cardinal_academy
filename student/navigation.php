<?php
include '../db_connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$full_name = htmlspecialchars($user['first_name'] . ', ' . $user['last_name']);
$profile_image = !empty($user['profile']) ? '../static/uploads/' . htmlspecialchars($user['profile']) : '../static/uploads/dummy.jpg';
?>

<div id="nav_side" 
     class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" 
     style="min-height: 100vh; width: 260px; background: #fff; box-shadow: 2px 0 6px rgba(0,0,0,0.05);">

    <!-- Profile Section -->
    <div class="profile-pic mb-3 w-100 text-center">
        <img 
            src="<?= htmlspecialchars($profile_image) ?>" 
            alt="Profile" 
            class="rounded-circle shadow-sm img-fluid d-block mx-auto" 
            style="width: 90px; height: 90px; object-fit: cover;"
        >
        <h6 class="mt-2 fw-semibold text-dark mb-0"><?= htmlspecialchars($full_name) ?></h6>
        <small class="text-muted">Student</small>
    </div>

    <hr class="text-muted">

    <!-- Scrollable nav -->
    <div class="flex-grow-1 overflow-auto" style="max-height: calc(100vh - 200px);">
        <ul class="nav flex-column gap-1">

            <li class="nav-item">
                <a href="dashboard.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3" href="dashboard.php">
                    <i class="bi bi-house me-2"></i> <span>Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="profile.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3" href="dashboard.php">
                    <i class="bi bi-person me-2"></i> <span>Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="calendar.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3" href="#">
                    <i class="bi bi-calendar3 me-2"></i> <span>Calendar</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="announcement.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3" href="#">
                    <i class="bi bi-megaphone me-2"></i> <span>Announcement</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="my_assignment.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3" href="#">
                    <i class="bi bi-archive me-2"></i> <span>Assignments</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="announcements.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3">
                    <i class="bi bi-megaphone me-2"></i> <span>Announcements</span>
                </a>
            </li> -->

            <!-- Collapsible Teaching Menu -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center px-3 py-2 rounded-3" 
                data-bs-toggle="collapse" href="#teachingMenu" role="button" 
                aria-expanded="false" aria-controls="teachingMenu">
                    <i class="bi bi-calendar-check me-2"></i> <span>My Classes</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
              <div class="collapse" id="teachingMenu">
                    <ul class="nav flex-column small ps-0">
                        <?php
                        // Fetch student's enrolled courses
                        $student_id = $_SESSION['user_id'];

                        $stmt = $conn->prepare("
                            SELECT c.id, c.course_name, c.subject, cs.joined_at 
                            FROM course_students cs
                            JOIN courses c ON cs.course_id = c.id
                            WHERE cs.student_id = ?
                        ");
                        $stmt->bind_param("i", $student_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Define the color palette
                        $colors = [
                            '#ffb6c1', // light pink
                            '#90ee90', // light green
                            '#add8e6', // light blue
                            '#ffdab9', // light orange
                            '#f08080', // light red
                        ];

                        if ($result->num_rows > 0) {
                            $i = 0; // index to alternate colors
                            while ($course = $result->fetch_assoc()) {
                                $firstLetter = strtoupper(substr($course['subject'], 0, 1));
                                $bgColor = $colors[$i % count($colors)]; // alternate color

                                echo '<li class="nav-item">
                                        <a class="nav-link px-3 d-flex align-items-center py-2" 
                                        href="course.php?id=' . $course['id'] . '" style="padding-left:0;">
                                            <span class="rounded-circle text-white d-inline-flex align-items-center justify-content-center me-2" 
                                                style="width:24px; height:24px; font-size:0.8rem; background-color:' . $bgColor . ';">
                                                ' . $firstLetter . '
                                            </span>
                                            ' . htmlspecialchars($course['course_name']) . '
                                        </a>
                                    </li>';

                                $i++;
                            }
                        } else {
                            echo '<li class="nav-item">
                                    <span class="nav-link text-muted py-2">No courses enrolled</span>
                                </li>';
                        }

                        $stmt->close();
                        ?>
                    </ul>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const collapseEl = document.getElementById('teachingMenu');

                        // Restore state from localStorage
                        const savedState = localStorage.getItem('teachingMenuCollapsed');
                        if (savedState === 'true') {
                            collapseEl.classList.remove('show'); // collapsed
                        } else if (savedState === 'false') {
                            collapseEl.classList.add('show'); // expanded
                        }

                        // Listen for Bootstrap collapse events
                        collapseEl.addEventListener('shown.bs.collapse', () => {
                            localStorage.setItem('teachingMenuCollapsed', 'false'); // open
                        });
                        collapseEl.addEventListener('hidden.bs.collapse', () => {
                            localStorage.setItem('teachingMenuCollapsed', 'true'); // closed
                        });
                    });
                    </script>
                </div>


            </li>

        </ul>
    </div>

    <!-- Logout at bottom -->
    <div class="mt-auto pt-3 border-top">
        <a class="nav-link d-flex align-items-center px-3 py-2 rounded-3 text-danger fw-semibold" href="logout.php">
            <i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span>
        </a>
    </div>
</div>

<!-- Styles -->
<style>
    #nav_side .nav-link {
        color: #333 !important;
        font-size: 0.95rem;
        transition: all 0.25s ease-in-out;
    }
    #nav_side .nav-link i {
        font-size: 1.1rem;
        transition: inherit;
    }
    #nav_side .nav-link:hover {
        background: #f1f5ff;
        color: #0d6efd !important;
        font-weight: 600;
    }
    #nav_side .nav-link:hover i {
        color: #0d6efd !important;
    }
    #nav_side .nav-link.active {
        background: #e7f1ff;
        color: #0d6efd !important;
        font-weight: 700;
    }
    #nav_side .collapse .nav-link {
        font-size: 0.9rem;
        color: #555 !important;
    }
    #nav_side .collapse .nav-link:hover {
        background: #f8f9fa;
        color: #0d6efd !important;
    }
</style>

