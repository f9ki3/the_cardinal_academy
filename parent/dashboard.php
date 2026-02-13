<?php
include 'session_login.php';
include '../db_connection.php';

// 🧠 Fetch students linked to this parent
$parent_id = $_SESSION['user_id'] ?? 0;
$students = [];

if ($parent_id) {
    $query = "
        SELECT 
            pl.*, 
            u.student_number,
            u.first_name,
            u.last_name,
            u.birthdate,
            u.gender,
            u.phone_number,
            u.email
        FROM parent_link AS pl
        INNER JOIN users AS u ON pl.student_id = u.user_id
        WHERE pl.parent_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $row['full_name'] = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));

        // Fetch courses for this student
        $courseQuery = "
            SELECT 
                c.id AS course_id,
                c.course_name,
                COUNT(DISTINCT p.id) AS post_count,
                COUNT(DISTINCT asg.assignment_id) AS assignment_count,
                COUNT(DISTINCT sub.submission_id) AS submitted_assignment_count
            FROM course_students cs
            INNER JOIN courses c ON cs.course_id = c.id
            LEFT JOIN posts p ON p.course_id = c.id
            LEFT JOIN assignments asg ON asg.course_id = c.id
            LEFT JOIN assignment_submissions sub 
                ON sub.assignment_id = asg.assignment_id AND sub.student_id = cs.student_id
            WHERE cs.student_id = ?
            GROUP BY c.id, c.course_name
        ";
        $courseStmt = $conn->prepare($courseQuery);
        $courseStmt->bind_param("i", $student_id);
        $courseStmt->execute();
        $courseResult = $courseStmt->get_result();

        $courses = [];
        $totalAssignments = 0;
        $totalSubmitted = 0;
        $totalPosts = 0;

        while ($courseRow = $courseResult->fetch_assoc()) {
            $courses[] = $courseRow;
            $totalAssignments += (int)$courseRow['assignment_count'];
            $totalSubmitted += (int)$courseRow['submitted_assignment_count'];
            $totalPosts += (int)$courseRow['post_count'];
        }

        $row['courses'] = $courses;
        $row['total_assignments'] = $totalAssignments;
        $row['total_submitted'] = $totalSubmitted;
        $row['total_posts'] = $totalPosts;

        $students[] = $row;
        $courseStmt->close();
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Parent Dashboard | Student Overview</title>
<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .bg-accent-blue { background-color: #e8f2ff !important; }
</style>
</head>
<body>
<div class="d-flex">
    <?php include 'navigation.php'; ?>
    <div class="flex-grow-1">
        <?php include 'nav_top.php'; ?>

        <div class="container py-5">
            <?php
            $status = $_GET['status'] ?? 0;
            if ($status == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    Student account successfully linked.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } elseif ($status == 2) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Student account has been unlinked.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?>

            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                <!-- Student Card -->
                <div class="p-4 rounded-4 mb-4 position-relative bg-white shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Student Info -->
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <h4 class="fw-bold mb-3">
                                    <i class="fa-solid fa-graduation-cap me-2"></i>
                                    <?= htmlspecialchars($student['full_name'] ?: '-') ?>
                                </h4>
                                <div class="row g-3">
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Student ID:</span>
                                            <span>#<?= htmlspecialchars($student['student_number'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Birthday:</span>
                                            <span><?= !empty($student['birthdate']) ? date("F d, Y", strtotime($student['birthdate'])) : '-' ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Gender:</span>
                                            <span><?= htmlspecialchars($student['gender'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Phone:</span>
                                            <span><?= htmlspecialchars($student['phone_number'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Email:</span>
                                            <span><?= htmlspecialchars($student['email'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Overall Progress -->
                            <div class="col-lg-6 d-flex flex-column align-items-start align-items-lg-end">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-3">
                                    <h6 class="fw-semibold text-secondary mb-0">Overall Progress</h6>
                                    <button class="btn btn-sm btn-outline-primary" onclick="deleteStudent(<?= $student['student_id'] ?>)">
                                        <i class="bi bi-trash"></i> Unlink
                                    </button>
                                </div>

                                <div class="row w-100 g-2 mt-2 justify-content-center justify-content-lg-end">
                                    <div class="col-4">
                                        <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                                            <div class="fs-2 fw-bold"><?= $student['total_assignments'] ?? 0 ?></div>
                                            <div class="small">Posted Assignments</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                                            <div class="fs-2 fw-bold"><?= $student['total_submitted'] ?? 0 ?></div>
                                            <div class="small">Submitted Assignment</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                                            <div class="fs-2 fw-bold"><?= $student['total_posts'] ?? 0 ?></div>
                                            <div class="small">Posted Lesson</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-chart-line me-2"></i>Subjects Overview</h6>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-start">Subject</th>
                                        <th class="text-center">Assignments</th>
                                        <th class="text-center">Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($student['courses'] as $course): 
                                        $assignmentCount = $course['assignment_count'] ?? 0;
                                        $submittedCount = $course['submitted_assignment_count'] ?? 0;
                                        $progressPercent = $assignmentCount > 0 
                                            ? round(($submittedCount / $assignmentCount) * 100) 
                                            : 0;
                                    ?>
                                    <tr>
                                        <td class="text-start fw-semibold text-secondary"><?= htmlspecialchars($course['course_name'] ?? '-') ?></td>
                                        <td class="text-center text-secondary"><?= $assignmentCount ?></td>
                                        <td>
                                            <div class="mb-1 small fw-semibold text-secondary text-center">
                                                <?= $submittedCount ?> / <?= $assignmentCount ?> Submitted (<?= $progressPercent ?>%)
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $progressPercent ?>%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Student Linked Placeholder -->
                <div class="d-flex flex-column justify-content-center align-items-center mt-5 py-5">
                    <img style="opacity: 60%; max-width:200px;" src="../static/images/empty_student.svg" alt="No Student Linked" class="mb-4">
                    <h4 class="text-muted fw-bold">No Student Linked</h4>
                    <p class="text-muted text-center">You currently have no students linked to your account. Once a student is linked, their progress and courses will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function deleteStudent(studentId) {
    if (confirm("Are you sure you want to remove this student from your dashboard? This action cannot be undone.")) {
        window.location.href = `delete_student.php?id=${studentId}`;
    }
}
</script>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
