<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

$student = [];
$grades = [];
$gwa = 0;
$user_id = null;

if (!empty($student_id)) {

    /* ---------------------------------------
        1. GET user_id from users table
           WHERE student_number = student_id
    ----------------------------------------*/
    $sqlUser = "SELECT user_id FROM users WHERE student_number = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("s", $student_id);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    $userRow = $resultUser->fetch_assoc();
    $stmtUser->close();

    if ($userRow) {
        $user_id = $userRow['user_id'];  // << USE THIS in course_students
    } else {
        die("User not found for this student number.");
    }


    /* --------------------------
        2. FETCH STUDENT INFORMATION
    ---------------------------*/
    $query = "SELECT * FROM student_information WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();


    /* --------------------------
        3. FETCH SUBJECT GRADES
        JOIN courses + course_students
    ---------------------------*/
    $sql = "
        SELECT 
            courses.course_name,
            cs.q1,
            cs.q2,
            cs.q3,
            cs.q4
        FROM course_students cs
        JOIN courses ON cs.course_id = courses.id
        WHERE cs.student_id = ?
    ";

    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $total_average = 0;
    $subject_count = 0;

    while ($row = $result2->fetch_assoc()) {

        $final = ($row['q1'] + $row['q2'] + $row['q3'] + $row['q4']) / 4;

        if ($final >= 96)      { $avg = 1.00; }
        elseif ($final >= 90) { $avg = 1.25; }
        elseif ($final >= 85) { $avg = 1.50; }
        elseif ($final >= 80) { $avg = 1.75; }
        else                  { $avg = 2.00; }

        $row['final_grade'] = number_format($final, 2);
        $row['average'] = number_format($avg, 2);

        $grades[] = $row;

        $total_average += $avg;
        $subject_count++;
    }
    $stmt2->close();


    /* --------------------------
        4. COMPUTE GWA
    ---------------------------*/
    if ($subject_count > 0) {
        $gwa = number_format($total_average / $subject_count, 2);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Grades Records</title>
<?php include 'header.php'; ?>

<style>
body{background:#F7F7F7;font-family:'Segoe UI';}
.record-section{background:#FFF;padding:2rem;border-radius:1rem;margin-bottom:2rem;box-shadow:0 4px 10px rgba(0,0,0,0.08);}
.record-item label{font-weight:600;font-size:0.875rem;color:#6C757D;}
.record-item .data{font-size:0.95rem;font-weight:500;}
.table th{font-weight:600;}
</style>

</head>
<body>
<div class="d-flex flex-row">

<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container pt-3">

    <!-- Student Details -->
    <div class="record-section">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-10">
                <h5 class="fw-bolder">Student Details</h5>
            </div>
            <div class="col-12 col-md-2">
                <button disabled class="btn rounded rounded-4 btn-sm border">
                    <i class="bi bi-check-circle me-1"></i> Approve
                </button>
                <button class="btn rounded rounded-4 btn-sm border">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 record-item">
                <label>Student Number</label>
                <div class="data"><?= htmlspecialchars($student['student_number'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Full Name</label>
                <div class="data">
                    <?= htmlspecialchars(($student['firstname'] ?? '') . ' ' . ($student['middlename'] ?? '') . ' ' . ($student['lastname'] ?? '')) ?>
                </div>
            </div>

            <div class="col-md-4 record-item">
                <label>Email</label>
                <div class="data"><?= htmlspecialchars($student['email'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Phone</label>
                <div class="data"><?= htmlspecialchars($student['phone'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Gender</label>
                <div class="data"><?= htmlspecialchars($student['gender'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Birth Date</label>
                <div class="data"><?= htmlspecialchars($student['birthday'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Address</label>
                <div class="data"><?= htmlspecialchars($student['residential_address'] ?? '-') ?></div>
            </div>
        </div>

        <hr>
        <table class="table  table-sm table-striped align-middle">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Final Grade</th>
                    <th>Average</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($grades) > 0): ?>
                    <?php foreach ($grades as $g): ?>
                        <tr>
                            <td><?= htmlspecialchars($g['course_name']) ?></td>
                            <td><?= $g['q1'] ?></td>
                            <td><?= $g['q2'] ?></td>
                            <td><?= $g['q3'] ?></td>
                            <td><?= $g['q4'] ?></td>
                            <td class="fw-bold"><?= $g['final_grade'] ?></td>
                            <td class="fw-bold"><?= $g['average'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted">No grade records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- GWA -->
        <div class="mt-2">
            <label class="fw-bold">General Weighted Average (GWA):</label>
            <span class="fw-bold fs-5"><?= $gwa ?></span>
        </div>

    </div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
