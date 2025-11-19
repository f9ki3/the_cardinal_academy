<?php
// ================================
// grades.php - Editable Grades (Excel style)
// ================================
include 'session_login.php';
include '../db_connection.php';

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

// Get logged-in teacher info
$full_name = 'User Name';
$email = 'user@example.com';
if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_user = $stmt->get_result();
        if ($result_user && $result_user->num_rows > 0) {
            $user = $result_user->fetch_assoc();
            $full_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
            $email = htmlspecialchars($user['email']);
        }
        $stmt->close();
    }
}

// Fetch students & grades
$students = [];
if ($course_id > 0) {
    $stmt = $conn->prepare("
        SELECT 
            u.user_id, u.student_number, u.first_name, u.last_name, u.profile,
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Grades List</title>
<?php include 'header.php'; ?>
<style>
/* Tabs */
.tabs { display: flex; gap: 30px; padding: 5px; }
.tab { padding: 8px 0; cursor: pointer; position: relative; }
.tab p, .tab a { margin: 0; font-weight: 500; color: #555; text-decoration: none; }
.tab.active p, .tab.active a { color: #000; }
.tab.active::after {
    content: ""; position: absolute; bottom: -2px; left: 0;
    width: 100%; height: 3px; background: rgb(218, 64, 64); border-radius: 2px;
}

/* Excel-style table */
/* Excel-style table */
.table-excel {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.table-excel th, .table-excel td {
    border: 1px solid #ccc;
    padding: 8px 12px;
    text-align: center;
}
.table-excel th {
    background-color: #f4f4f4;
    font-weight: 600;
}
/* Stripe effect */
.table-excel tr:nth-child(odd) {
    background-color: #ffffff; /* white stripe */
}
.table-excel tr:nth-child(even) {
    background-color: #f9f9f9; /* light gray stripe */
}
.table-excel input.grade-input {
    width: 100%;
    border: none;
    text-align: center;
    font-size: 0.95rem;
    background-color: transparent;
    outline: none;
}


/* Rounded profile */
.rounded-circle:hover { background-color: rgb(240, 249, 255) !important; }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".grade-input").on('change', function(){
        let studentId = $(this).data('student');
        let field = $(this).data('field');
        let value = $(this).val();

        $.ajax({
            url: 'update_grade.php',
            type: 'POST',
            data: { student_id: studentId, field: field, value: value, course_id: <?= $course_id ?> },
            success: function(response){
                if(!response.success){
                    alert('Update failed: ' + response.message);
                }
            },
            error: function(){
                alert('An error occurred.');
            }
        });
    });
});
</script>
</head>
<body>
<div class="d-flex flex-row bg-light">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
    <div class="row mb-3 border-bottom">
        <div class="col-12"><h4>Students List</h4></div>
    </div>

    <!-- Tabs -->
    <div class="tabs mb-4">
        <?php
        $tabs = ['Stream'=>'course.php','Attendance'=>'attendance.php','Assignment'=>'assignment.php',
                 'Students'=>'student.php','Grades'=>'grades.php','Settings'=>'settings.php'];
        foreach($tabs as $name=>$url){
            $active = ($name==='Grades')?'active':'';
            echo "<div class='tab {$active}'><a href='{$url}?id={$course_id}'>{$name}</a></div>";
        }
        ?>
    </div>

    <!-- User Banner -->
    <div class="rounded-4 p-4 text-white mb-4" style="
        background-image: url('../static/images/Front gate.jpg'); background-size: cover;
        background-position: center; position: relative; min-height: 150px;">
        <div style="position: absolute; top:0; left:0; right:0; bottom:0; background-color: rgba(0,0,0,0.5); border-radius:1rem;"></div>
        <div class="row position-relative" style="z-index:1;">
            <div class="col-12 col-md-10"><h1 class="fw-bolder"><?= $full_name ?></h1><p><?= $email ?></p></div>
            <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mt-2 mt-md-0">
                <button onclick="window.print()" class="btn btn-danger rounded-4">Print Grades</button>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <table class="table-excel mb-4">
        <thead>
            <tr>
                <th class="text-start">Student Number</th>
                <th class="text-start">Student</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($students)): ?>
                <?php foreach($students as $student): 
                    $profilePath = !empty($student['profile']) ? '../static/uploads/'.$student['profile'] : '../static/uploads/dummy.jpg';
                ?>
                <tr>
                    <td style="text-align: left; width: 15%">
                        <span><?= htmlspecialchars($student['student_number']) ?></span>
                    </td>

                    <td style="text-align: left; width: 20%">
                        <span><?= htmlspecialchars($student['first_name'].' '.$student['last_name']) ?></span>
                    </td>

                    <?php for($i=1;$i<=4;$i++): ?>
                      <td>
                          <input type="text" 
                                class="grade-input" 
                                value="<?= htmlspecialchars($student['q'.$i]) ?>" 
                                data-student="<?= $student['user_id'] ?>" 
                                data-field="q<?= $i ?>"
                                maxlength="3" 
                                pattern="\d{1,3}" 
                                oninput="
                                    this.value = this.value.replace(/[^0-9]/g,''); 
                                    if(this.value > 100) this.value = 100;
                                "
                                onkeydown="return event.keyCode !== 38 && event.keyCode !== 40;">
                      </td>
                      <?php endfor; ?>

                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-secondary py-3">
                        No students enrolled in this course.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
