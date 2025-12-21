<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sectioning.php?status=error');
    exit;
}

$id = (int) $_GET['id'];

// Fetch existing section
$stmt = $conn->prepare("
    SELECT section_name, grade_level, strand, teacher_id, room, capacity, school_year
    FROM sections
    WHERE section_id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: sectioning.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

/* ---------- SAFE DEFAULTS (CRITICAL FIX) ---------- */
$section_name = $row['section_name'] ?? '';
$grade_level  = $row['grade_level'] ?? '';
$strand       = $row['strand'] ?? 'N/A';
$teacher_id   = (int) ($row['teacher_id'] ?? 0);
$room         = $row['room'] ?? '';
$capacity     = (int) ($row['capacity'] ?? 0);
$school_year  = $row['school_year'] ?? '';

$error = '';

// Fetch teachers
$teachers_result = mysqli_query(
    $conn,
    "SELECT user_id, CONCAT(first_name,' ',last_name) AS full_name
     FROM users WHERE acc_type = 'teacher'"
);

if (!$teachers_result) {
    die("Error fetching teachers: " . mysqli_error($conn));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $section_name = trim($_POST['section_name'] ?? '');
    $grade_level  = trim($_POST['grade_level'] ?? '');
    $strand       = trim($_POST['strand'] ?? 'N/A');
    $teacher_id   = (int) ($_POST['teacher_id'] ?? 0);
    $room         = trim($_POST['room'] ?? '');
    $capacity     = (int) ($_POST['capacity'] ?? 0);
    $school_year  = trim($_POST['school_year'] ?? '');

    if (
        $section_name === '' ||
        $grade_level === '' ||
        $teacher_id <= 0 ||
        $capacity <= 0 ||
        $school_year === ''
    ) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $update = $conn->prepare("
            UPDATE sections
            SET section_name = ?, grade_level = ?, strand = ?, teacher_id = ?, room = ?, capacity = ?, school_year = ?
            WHERE section_id = ?
        ");
        $update->bind_param(
            "sssisssi",
            $section_name,
            $grade_level,
            $strand,
            $teacher_id,
            $room,
            $capacity,
            $school_year,
            $id
        );

        if ($update->execute()) {
            header('Location: sectioning.php?status=updated&nav_drop=true');
            exit;
        } else {
            $error = "Failed to update section.";
        }
    }
}

// Helper
function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Section</title>
<?php include 'header.php'; ?>
</head>
<body>

<div class="d-flex flex-row bg-light">
<?php include 'navigation.php'; ?>

<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
<div class="bg-white rounded p-4">

<h4>
Edit Section –
<?= htmlspecialchars($section_name, ENT_QUOTES, 'UTF-8') ?>
</h4>

<?php if ($error): ?>
<div class="alert alert-danger">
<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
</div>
<?php endif; ?>

<form method="post" style="max-width:600px">

<!-- Section Name -->
<div class="mb-3">
<label class="form-label">Section Name</label>
<input type="text" name="section_name" class="form-control" required
value="<?= htmlspecialchars($section_name, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- Strand -->
<div class="mb-3">
<label class="form-label">Strand</label>
<select name="strand" class="form-select" required>
<?php
$strands = [
    'N/A',
    'GAS (General Academic Strand)',
    'HUMMS (Humanities and Social Sciences)',
    'STEM (Science, Technology, Engineering and Mathematics)',
    'ABM (Accountancy, Business and Management)',
    'TVL (Technical-Vocational-Livelihood)',
    'SPORTS',
    'ARTS and DESIGN'
];
foreach ($strands as $s):
?>
<option value="<?= $s ?>" <?= isSelected($s, $strand) ?>>
<?= htmlspecialchars($s, ENT_QUOTES, 'UTF-8') ?>
</option>
<?php endforeach; ?>
</select>
</div>

<!-- Grade Level -->
<div class="mb-3">
<label class="form-label">Grade Level</label>
<select name="grade_level" class="form-select" required>
<?php
$grades = ["Nursery","Kinder","Grade 1","Grade 2","Grade 3","Grade 4","Grade 5","Grade 6",
           "Grade 7","Grade 8","Grade 9","Grade 10","Grade 11","Grade 12"];
foreach ($grades as $g):
?>
<option value="<?= $g ?>" <?= isSelected($g, $grade_level) ?>><?= $g ?></option>
<?php endforeach; ?>
</select>
</div>

<!-- Teacher -->
<div class="mb-3">
<label class="form-label">Advisory Class</label>
<select name="teacher_id" class="form-select" required>
<option value="">Select teacher</option>
<?php
mysqli_data_seek($teachers_result, 0);
while ($t = mysqli_fetch_assoc($teachers_result)):
?>
<option value="<?= $t['user_id'] ?>" <?= $t['user_id'] == $teacher_id ? 'selected' : '' ?>>
<?= htmlspecialchars($t['full_name'], ENT_QUOTES, 'UTF-8') ?>
</option>
<?php endwhile; ?>
</select>
</div>

<!-- Room -->
<div class="mb-3">
<label class="form-label">Room</label>
<input type="text" name="room" class="form-control"
value="<?= htmlspecialchars($room, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- Capacity -->
<div class="mb-3">
<label class="form-label">Capacity</label>
<input type="number" name="capacity" class="form-control" min="1" required
value="<?= htmlspecialchars((string)$capacity, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- School Year -->
<div class="mb-3">
<label class="form-label">School Year</label>
<input type="text" name="school_year" class="form-control" required
value="<?= htmlspecialchars($school_year, ENT_QUOTES, 'UTF-8') ?>">
</div>

<button class="btn bg-main text-light">Update</button>
<a href="sectioning.php?nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>

</form>

</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
