<?php
include 'session_login.php';
include '../db_connection.php';

// Fetch students linked to this parent
$parent_id = $_SESSION['user_id'] ?? 0;
$students = [];

if ($parent_id) {
    $query = "
        SELECT 
            pl.*, 
            u.user_id,
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

        // Fetch grades for this student
        $gradeQuery = "
            SELECT 
                c.id AS course_id,
                c.course_name,
                c.subject,
                cs.q1,
                cs.q2,
                cs.q3,
                cs.q4,
                CONCAT(u.first_name, ' ', u.last_name) AS teacher_name
            FROM course_students cs
            INNER JOIN courses c ON cs.course_id = c.id
            LEFT JOIN users u ON c.teacher_id = u.user_id
            WHERE cs.student_id = ? AND cs.status = 'pending'
            ORDER BY c.course_name ASC
        ";
        $gradeStmt = $conn->prepare($gradeQuery);
        $gradeStmt->bind_param("i", $student_id);
        $gradeStmt->execute();
        $gradeResult = $gradeStmt->get_result();

        $grades = [];
        $totalFinal = 0;
        $subjectCount = 0;

        while ($gradeRow = $gradeResult->fetch_assoc()) {
            $q1 = (float)$gradeRow['q1'];
            $q2 = (float)$gradeRow['q2'];
            $q3 = (float)$gradeRow['q3'];
            $q4 = (float)$gradeRow['q4'];
            
            $gradesEntered = 0;
            $totalGrade = 0;
            
            if ($q1 > 0) { $totalGrade += $q1; $gradesEntered++; }
            if ($q2 > 0) { $totalGrade += $q2; $gradesEntered++; }
            if ($q3 > 0) { $totalGrade += $q3; $gradesEntered++; }
            if ($q4 > 0) { $totalGrade += $q4; $gradesEntered++; }
            
            $finalGrade = $gradesEntered > 0 ? $totalGrade / $gradesEntered : 0;
            $status = $finalGrade >= 75 ? 'Passed' : ($finalGrade > 0 ? 'Failed' : 'Pending');
            
            $gradeRow['final_grade'] = round($finalGrade, 2);
            $gradeRow['status'] = $status;
            
            $grades[] = $gradeRow;
            
            if ($finalGrade > 0) {
                $totalFinal += $finalGrade;
                $subjectCount++;
            }
        }

        $row['grades'] = $grades;
        $row['gwa'] = $subjectCount > 0 ? round($totalFinal / $subjectCount, 2) : 0;
        $row['subject_count'] = count($grades);

        $students[] = $row;
        $gradeStmt->close();
    }
    $stmt->close();
}
$conn->close();

// Helper functions
function getGradeLetter($grade) {
    if ($grade >= 90) return 'A';
    if ($grade >= 85) return 'B+';
    if ($grade >= 80) return 'B';
    if ($grade >= 75) return 'C';
    if ($grade > 0) return 'F';
    return '-';
}

function getGradeColorClass($grade) {
    if ($grade >= 90) return 'bg-success';
    if ($grade >= 85) return 'bg-primary';
    if ($grade >= 75) return 'bg-warning';
    if ($grade > 0) return 'bg-danger';
    return 'bg-secondary';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Grades | Parent Portal</title>
<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .bg-accent-blue { background-color: #e8f2ff !important; }
    .bg-accent-green { background-color: #ecfdf5 !important; }
    .bg-accent-red { background-color: #fef2f2 !important; }
    .bg-accent-yellow { background-color: #fffbeb !important; }
    
    .grade-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        color: white;
    }
    
    .text-success-dark { color: #16a34a !important; }
    .text-danger-dark { color: #dc2626 !important; }
</style>
</head>
<body>
<div class="d-flex">
    <?php include 'navigation.php'; ?>
    <div class="flex-grow-1">
        <?php include 'nav_top.php'; ?>

        <div class="container py-5">
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
                                            <span class="fw-semibold text-muted d-block">Email:</span>
                                            <span><?= htmlspecialchars($student['email'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="text-md-start">
                                            <span class="fw-semibold text-muted d-block">Subjects:</span>
                                            <span><?= $student['subject_count'] ?> enrolled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- GWA Summary -->
                            <div class="col-lg-6 d-flex flex-column align-items-start align-items-lg-end">
                                <h6 class="fw-semibold text-secondary mb-3">General Weighted Average</h6>
                                <div class="row w-100 g-2 justify-content-center justify-content-lg-end">
                                    <div class="col-4">
                                        <div class="text-center p-3 <?= $student['gwa'] >= 75 ? 'bg-accent-green text-success-dark' : ($student['gwa'] > 0 ? 'bg-accent-red text-danger-dark' : 'bg-accent-blue text-primary') ?> rounded">
                                            <div class="fs-2 fw-bold"><?= $student['gwa'] > 0 ? $student['gwa'] : '—' ?></div>
                                            <div class="small">Average</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-center p-3 bg-accent-green text-success-dark rounded">
                                            <div class="fs-2 fw-bold"><?= count(array_filter($student['grades'], fn($g) => $g['final_grade'] >= 75)) ?></div>
                                            <div class="small">Passed</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-center p-3 bg-accent-yellow text-warning rounded">
                                            <div class="fs-2 fw-bold"><?= count(array_filter($student['grades'], fn($g) => $g['final_grade'] == 0)) ?></div>
                                            <div class="small">Pending</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-chart-line me-2"></i>Grades Overview</h6>
                        
                        <?php if (!empty($student['grades'])): ?>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-start">Subject</th>
                                        <th class="text-center">Q1</th>
                                        <th class="text-center">Q2</th>
                                        <th class="text-center">Q3</th>
                                        <th class="text-center">Q4</th>
                                        <th class="text-center">Final</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($student['grades'] as $grade): ?>
                                    <tr>
                                        <td class="text-start">
                                            <span class="fw-semibold text-secondary"><?= htmlspecialchars($grade['course_name'] ?? '-') ?></span>
                                            <?php if (!empty($grade['teacher_name'])): ?>
                                            <br><small class="text-muted"><?= htmlspecialchars($grade['teacher_name']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-semibold <?= $grade['q1'] > 0 ? ($grade['q1'] >= 75 ? 'text-success-dark' : 'text-danger-dark') : 'text-muted' ?>">
                                                <?= $grade['q1'] > 0 ? $grade['q1'] : '—' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-semibold <?= $grade['q2'] > 0 ? ($grade['q2'] >= 75 ? 'text-success-dark' : 'text-danger-dark') : 'text-muted' ?>">
                                                <?= $grade['q2'] > 0 ? $grade['q2'] : '—' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-semibold <?= $grade['q3'] > 0 ? ($grade['q3'] >= 75 ? 'text-success-dark' : 'text-danger-dark') : 'text-muted' ?>">
                                                <?= $grade['q3'] > 0 ? $grade['q3'] : '—' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-semibold <?= $grade['q4'] > 0 ? ($grade['q4'] >= 75 ? 'text-success-dark' : 'text-danger-dark') : 'text-muted' ?>">
                                                <?= $grade['q4'] > 0 ? $grade['q4'] : '—' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold <?= $grade['final_grade'] >= 75 ? 'text-success-dark' : ($grade['final_grade'] > 0 ? 'text-danger-dark' : 'text-muted') ?>">
                                                <?= $grade['final_grade'] > 0 ? $grade['final_grade'] : '—' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($grade['status'] === 'Passed'): ?>
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Passed</span>
                                            <?php elseif ($grade['status'] === 'Failed'): ?>
                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Failed</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-journal-x text-muted" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-2 mb-0">No subjects enrolled yet.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Student Linked Placeholder -->
                <div class="d-flex flex-column justify-content-center align-items-center mt-5 py-5">
                    <img style="opacity: 60%; max-width:200px;" src="../static/images/empty_student.svg" alt="No Student Linked" class="mb-4">
                    <h4 class="text-muted fw-bold">No Student Linked</h4>
                    <p class="text-muted text-center">You currently have no students linked to your account. Once a student is linked, their grades will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
