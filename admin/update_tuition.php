<?php 
include 'session_login.php'; 
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: tuition.php?status=error');
    exit;
}

$id = (int)$_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM tuition_fees WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: tuition.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_level = trim($_POST['grade_level']);
    $tuition_fee = floatval($_POST['tuition_fee']);
    $miscellaneous = floatval($_POST['miscellaneous']);
    $total = $tuition_fee + $miscellaneous;

    // Basic validation (add more if needed)
    if ($grade_level === '' || $tuition_fee < 0 || $miscellaneous < 0) {
        $error = "Please fill all fields correctly.";
    } else {
        $update_stmt = $conn->prepare("UPDATE tuition_fees SET grade_level = ?, tuition_fee = ?, miscellaneous = ?, total = ? WHERE id = ?");
        $update_stmt->bind_param("sdddi", $grade_level, $tuition_fee, $miscellaneous, $total, $id);

        if ($update_stmt->execute()) {
            header('Location: tuition.php?status=success');
            exit;
        } else {
            $error = "Failed to update tuition fee.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Tuition Fees</title>
  <?php include 'header.php' ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
                <h3>Update Tuition Fee for <?= htmlspecialchars($row['grade_level']) ?></h3>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="post" class="mt-3" style="max-width: 500px;">
                    <div class="mb-3">
                    <label for="grade_level" class="form-label">Grade Level</label>
                    <input type="text" id="grade_level" name="grade_level" class="form-control" value="<?= htmlspecialchars($row['grade_level']) ?>" required />
                    </div>
                    <div class="mb-3">
                    <label for="tuition_fee" class="form-label">Tuition Fee</label>
                    <input type="number" step="0.01" min="0" id="tuition_fee" name="tuition_fee" class="form-control" value="<?= htmlspecialchars($row['tuition_fee']) ?>" required />
                    </div>
                    <div class="mb-3">
                    <label for="miscellaneous" class="form-label">Miscellaneous</label>
                    <input type="number" step="0.01" min="0" id="miscellaneous" name="miscellaneous" class="form-control" value="<?= htmlspecialchars($row['miscellaneous']) ?>" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="tuition.php" class="btn btn-secondary ms-2">Cancel</a>
                </form>
                </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

