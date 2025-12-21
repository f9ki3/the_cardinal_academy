<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: uniforms.php?status=error&nav_drop=true');
    exit;
}

$id = (int) $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("
    SELECT grade_level, gender, classification, type, size, price
    FROM uniforms
    WHERE id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: uniforms.php?status=notfound&nav_drop=true');
    exit;
}

$row = $result->fetch_assoc();

/* ---------- SAFE DEFAULTS (CRITICAL FIX) ---------- */
$grade_level    = $row['grade_level']    ?? '';
$gender         = $row['gender']         ?? '';
$classification = $row['classification'] ?? '';
$type           = $row['type']           ?? '';
$size           = $row['size']           ?? '';
$price          = $row['price']          ?? 0;

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $grade_level    = trim($_POST['grade_level'] ?? '');
    $gender         = trim($_POST['gender'] ?? '');
    $classification = trim($_POST['classification'] ?? '');
    $type           = trim($_POST['type'] ?? '');
    $size           = trim($_POST['size'] ?? '');
    $price          = (float) ($_POST['price'] ?? 0);

    if (
        $grade_level === '' ||
        $gender === '' ||
        $classification === '' ||
        $type === '' ||
        $size === '' ||
        $price <= 0
    ) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $update = $conn->prepare("
            UPDATE uniforms
            SET grade_level = ?, gender = ?, classification = ?, type = ?, size = ?, price = ?
            WHERE id = ?
        ");
        $update->bind_param(
            "sssssdi",
            $grade_level,
            $gender,
            $classification,
            $type,
            $size,
            $price,
            $id
        );

        if ($update->execute()) {
            header('Location: uniforms.php?status=updated&nav_drop=true');
            exit;
        } else {
            $error = "Failed to update uniform.";
        }
    }
}

function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Uniform</title>
  <?php include 'header.php'; ?>
</head>
<body>

<div class="d-flex flex-row bg-light">
<?php include 'navigation.php'; ?>

<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
<div class="bg-white rounded p-4">

<h4>Update Uniform</h4>

<?php if ($error): ?>
  <div class="alert alert-danger">
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<form method="post" style="max-width:600px">

<!-- Grade Level -->
<div class="mb-3">
<label class="form-label">Grade Level</label>
<select name="grade_level" class="form-select" required>
<?php
$grades = ["Nursery to Kinder","Grade 1 to 6","Grade 7 to 10","Grade 11 to 12"];
foreach ($grades as $g):
?>
<option value="<?= $g ?>" <?= isSelected($g,$grade_level) ?>><?= $g ?></option>
<?php endforeach; ?>
</select>
</div>

<!-- Gender -->
<div class="mb-3">
<label class="form-label">Gender</label>
<select name="gender" class="form-select" required>
<option value="Male" <?= isSelected("Male",$gender) ?>>Male</option>
<option value="Female" <?= isSelected("Female",$gender) ?>>Female</option>
<!-- <option value="Unisex" <?= isSelected("Unisex",$gender) ?>>Unisex</option> -->
</select>
</div>

<!-- Classification -->
<div class="mb-3">
<label class="form-label">Classification</label>
<select name="classification" class="form-select" required>
<option value="Top" <?= isSelected("Top",$classification) ?>>Top</option>
<option value="Bottom" <?= isSelected("Bottom",$classification) ?>>Bottom</option>
<option value="Accessories" <?= isSelected("Accessories",$classification) ?>>Accessories</option>
</select>
</div>

<!-- Type -->
<div class="mb-3">
<label class="form-label">Type</label>
<input type="text" name="type" class="form-control" required
value="<?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>">
</div>

<!-- Size -->
<div class="mb-3">
<label class="form-label">Size</label>
<select name="size" class="form-select" required>
<?php
$sizes = ["N/A","XS","S","M","L","XL","2XL","3XL"];
foreach ($sizes as $s):
?>
<option value="<?= $s ?>" <?= isSelected($s,$size) ?>><?= $s ?></option>
<?php endforeach; ?>
</select>
</div>

<!-- Price -->
<div class="mb-3">
<label class="form-label">Price</label>
<input type="number" step="0.01" name="price" class="form-control" required
value="<?= htmlspecialchars((string)$price, ENT_QUOTES, 'UTF-8') ?>">
</div>

<button class="btn bg-main text-light">Update</button>
<a href="uniforms.php?nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>

</form>

</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
