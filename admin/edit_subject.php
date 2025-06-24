<?php 
include 'session_login.php'; 
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: subjects.php?status=error');
    exit;
}

$id = (int)$_GET['id'];

// Fetch existing subject
$stmt = $conn->prepare("SELECT * FROM subjects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: subjects.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_code = trim($_POST['subject_code']);
    $description = trim($_POST['description']);
    $grade_level = trim($_POST['grade_level']);
    $hours = intval($_POST['hours']);

    if ($subject_code === '' || $description === '' || $grade_level === '' || $hours <= 0) {
        $error = "Please fill all fields correctly.";
    } else {
        $update_stmt = $conn->prepare("UPDATE subjects SET subject_code = ?, description = ?, grade_level = ?, hours = ? WHERE id = ?");
        $update_stmt->bind_param("sssii", $subject_code, $description, $grade_level, $hours, $id);

        if ($update_stmt->execute()) {
            header('Location: subjects.php?status=updated');
            exit;
        } else {
            $error = "Failed to update subject.";
        }
    }
}

// To retain grade_level selection
function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Subject</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <h4>Edit Subject - <?= htmlspecialchars($row['subject_code']) ?></h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                <div class="mb-3">
                  <label for="subject_code" class="form-label">Subject Code</label>
                  <input type="text" id="subject_code" name="subject_code" class="form-control" required value="<?= htmlspecialchars($row['subject_code']) ?>" />
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" id="description" name="description" class="form-control" required value="<?= htmlspecialchars($row['description']) ?>" />
                </div>

                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <option value="">Select grade level</option>
                    <?php
                    $grades = [
                      "Nursery", "Kinder Garten", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6",
                      "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"
                    ];
                    foreach ($grades as $grade) {
                        echo '<option value="' . $grade . '" ' . isSelected($grade, $row['grade_level']) . '>' . $grade . '</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="hours" class="form-label">Hours</label>
                  <input type="number" id="hours" name="hours" class="form-control" min="1" required value="<?= htmlspecialchars($row['hours']) ?>" />
                </div>

                <button type="submit" class="btn bg-main text-light">Update</button>
                <a href="subject_unit.php?nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>
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
