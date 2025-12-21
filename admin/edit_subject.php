<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: subject_unit.php?status=error');
    exit;
}

$id = (int) $_GET['id'];

// Fetch existing subject
$stmt = $conn->prepare("
    SELECT subject_code, description, grade_level, hours
    FROM subjects
    WHERE id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: subject_unit.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

/* ---------- SAFE DEFAULTS (CRITICAL FIX) ---------- */
$subject_code = $row['subject_code'] ?? '';
$description  = $row['description'] ?? '';
$grade_level  = $row['grade_level'] ?? '';
$hours        = (int) ($row['hours'] ?? 0);

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $subject_code = trim($_POST['subject_code'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $grade_level  = trim($_POST['grade_level'] ?? '');
    $hours        = (int) ($_POST['hours'] ?? 0);

    if (
        $subject_code === '' ||
        $description === '' ||
        $grade_level === '' ||
        $hours <= 0
    ) {
        $error = "Please fill all fields correctly.";
    } else {
        $update = $conn->prepare("
            UPDATE subjects
            SET subject_code = ?, description = ?, grade_level = ?, hours = ?
            WHERE id = ?
        ");
        $update->bind_param(
            "sssii",
            $subject_code,
            $description,
            $grade_level,
            $hours,
            $id
        );

        if ($update->execute()) {
            header('Location: subject_unit.php?status=updated');
            exit;
        } else {
            $error = "Failed to update subject.";
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
<title>Edit Subject</title>
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
Edit Subject –
<?= htmlspecialchars($subject_code, ENT_QUOTES, 'UTF-8') ?>
</h4>

<?php if ($error): ?>
<div class="alert alert-danger">
<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
</div>
<?php endif; ?>

<form method="post" style="max-width:600px">

<!-- Subject Code -->
<div class="mb-3">
<label class="form-label">Subject Code</label>
<input type="text" name="subject_code" class="form-control" required
value="<?= htmlspecialchars($subject_code, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- Description -->
<div class="mb-3">
<label class="form-label">Description</label>
<input type="text" name="description" class="form-control" required
value="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- Grade Level -->
<div class="mb-3">
<label class="form-label">Grade Level</label>
<select name="grade_level" class="form-select" required>
<option value="">Select grade level</option>
<?php
$grades = [
    "Nursery","Kinder Garten","Grade 1","Grade 2","Grade 3","Grade 4","Grade 5","Grade 6",
    "Grade 7","Grade 8","Grade 9","Grade 10","Grade 11","Grade 12"
];
foreach ($grades as $g):
?>
<option value="<?= $g ?>" <?= isSelected($g, $grade_level) ?>><?= $g ?></option>
<?php endforeach; ?>
</select>
</div>

<!-- Hours -->
<div class="mb-3">
<label class="form-label">Hours</label>
<input type="number" name="hours" class="form-control" min="1" required
value="<?= htmlspecialchars((string)$hours, ENT_QUOTES, 'UTF-8') ?>">
</div>

<button class="btn bg-main text-light">Update</button>
<a href="subject_unit.php" class="btn btn-secondary ms-2">Cancel</a>

</form>

</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
