<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: tuition.php?status=error');
    exit;
}

$id = (int) $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT grade_level, tuition_fee, miscellaneous, total FROM tuition_fees WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: tuition.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

// Safe defaults (IMPORTANT for PHP 8.1+)
$grade_level    = $row['grade_level'] ?? '';
$tuition_fee    = $row['tuition_fee'] ?? 0;
$miscellaneous  = $row['miscellaneous'] ?? 0;

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $grade_level   = trim($_POST['grade_level'] ?? '');
    $tuition_fee   = (float) ($_POST['tuition_fee'] ?? 0);
    $miscellaneous = (float) ($_POST['miscellaneous'] ?? 0);
    $total         = $tuition_fee + $miscellaneous;

    if ($grade_level === '' || $tuition_fee < 0 || $miscellaneous < 0) {
        $error = "Please fill all fields correctly.";
    } else {
        $update_stmt = $conn->prepare("
            UPDATE tuition_fees
            SET grade_level = ?, tuition_fee = ?, miscellaneous = ?, total = ?
            WHERE id = ?
        ");
        $update_stmt->bind_param(
            "sdddi",
            $grade_level,
            $tuition_fee,
            $miscellaneous,
            $total,
            $id
        );

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
  <?php include 'header.php'; ?>
</head>
<body>

<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row">
        <div class="col-12">
          <div class="rounded p-4 bg-white">

            <h4>
              Update Tuition Fee for
              <?= htmlspecialchars($grade_level, ENT_QUOTES, 'UTF-8') ?>
            </h4>

            <?php if ($error): ?>
              <div class="alert alert-danger">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
              </div>
            <?php endif; ?>

            <form method="post" class="mt-3" style="max-width: 500px;">
              <div class="mb-3">
                <label class="form-label">Grade Level</label>
                <input
                  type="text"
                  name="grade_level"
                  class="form-control"
                  value="<?= htmlspecialchars($grade_level, ENT_QUOTES, 'UTF-8') ?>"
                  required
                />
              </div>

              <div class="mb-3">
                <label class="form-label">Tuition Fee</label>
                <input
                  type="number"
                  step="0.01"
                  min="0"
                  name="tuition_fee"
                  class="form-control"
                  value="<?= htmlspecialchars((string)$tuition_fee, ENT_QUOTES, 'UTF-8') ?>"
                  required
                />
              </div>

              <div class="mb-3">
                <label class="form-label">Miscellaneous</label>
                <input
                  type="number"
                  step="0.01"
                  min="0"
                  name="miscellaneous"
                  class="form-control"
                  value="<?= htmlspecialchars((string)$miscellaneous, ENT_QUOTES, 'UTF-8') ?>"
                  required
                />
              </div>

              <button type="submit" class="btn bg-main text-light">Update</button>
              <a href="tuition.php" class="btn btn-secondary ms-2">Cancel</a>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
