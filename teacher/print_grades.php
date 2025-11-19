<?php
// ================================
// print_grades.php - Printable Grades Table with Courses
// ================================
include 'session_login.php';
include '../db_connection.php';

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch course info
$course = null;
if ($course_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result_course = $stmt->get_result();
        if ($result_course && $result_course->num_rows > 0) {
            $course = $result_course->fetch_assoc();
        }
        $stmt->close();
    }
}

// Fetch students & grades
$students = [];
if ($course_id > 0) {
    $stmt = $conn->prepare("
        SELECT 
            u.user_id, u.student_number, u.first_name, u.last_name,
            cs.q1, cs.q2, cs.q3, cs.q4
        FROM course_students cs
        INNER JOIN users u ON cs.student_id = u.user_id
        WHERE cs.course_id = ?
    ");
    if ($stmt) {
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result_students = $stmt->get_result();
        while ($row = $result_students->fetch_assoc()) {
            $students[] = $row;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Printable Grades</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    padding: 20px;
    flex-direction: column;
    align-items: center;
}

.print-page {
    background: #fff;
    width: 8.5in;     
    min-height: 11in;
    padding: 40px;
    border: 2px solid #000;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    box-sizing: border-box;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.header .logo-left,
.header .logo-right { width: 20%; }
.header .logo-left img,
.header .logo-right img { height: 80px; width: auto; }
.header .school-info { width: 55%; text-align: center; }
.header .school-info h2 { margin: 0; font-size: 1.5rem; }
.header .school-info small { display: block; font-size: 0.9rem; }

.course-info p { margin: 0; font-size: 0.95rem; }

h3 { text-align: center; margin: 10px 0; }

.table-excel {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.table-excel th, .table-excel td {
    border: 1px solid #000;
    padding: 6px 10px;
    text-align: center;
    font-size: 0.9rem;
}
.table-excel th { background-color: #f4f4f4; font-weight: 600; }
.table-excel tr:nth-child(odd) { background-color: #ffffff; }
.table-excel tr:nth-child(even) { background-color: #f9f9f9; }

@media print {
    body { background: none; padding: 0; display: block !important; }
    .print-page { box-shadow: none; border: none !important; margin: 0 !important; }
    .no-print { display: none; }
}
</style>
</head>
<body>

<div class="print-page">
    <div class="header">
        <div class="logo-left">
            <img src="../static/uploads/logo.png" alt="Left Logo">
        </div>
        <div class="school-info">
            <h2>The Cardinal Academy, Inc.</h2>
            <small>Sullera Street in Pandayan, Meycauayan, Bulacan</small>
            <small>Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
            <h3 class="fw-bolder">Student Grades</h3>
        </div>
        <div class="logo-right">
            <!-- Optional second logo -->
        </div>
    </div>

    <hr>

    <?php if($course): ?>
    <div class="row course-info mb-3">
        <div class="col-6 text-start">
            <p>Course: <?= htmlspecialchars($course['course_name'].' - '.$course['subject']) ?></p>
            <p>Time: <?= htmlspecialchars($course['start_time'].' - '.$course['end_time']) ?></p>
            <p>Day: <?= htmlspecialchars($course['day']) ?></p>
        </div>
        <div class="col-6 text-start">
            <p>Subject: <?= htmlspecialchars($course['subject']) ?></p>
            <p>Section: <?= htmlspecialchars($course['section']) ?></p>
            <p>Room: <?= htmlspecialchars($course['room']) ?></p>
        </div>
    </div>
    <?php endif; ?>

    <table class="table-excel">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Student</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['student_number']) ?></td>
                        <td><?= htmlspecialchars($student['first_name'].' '.$student['last_name']) ?></td>
                        <?php for ($i=1; $i<=4; $i++): ?>
                            <td><?= htmlspecialchars($student['q'.$i]) ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No students enrolled in this course.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
</div>

<div class="mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary rounded rounded-4">Print</button>
</div>

</body>
</html>