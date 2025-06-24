<?php 
include 'session_login.php'; 
include '../db_connection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_code = trim($_POST['subject_code']);
    $description = trim($_POST['description']);
    $grade_level = trim($_POST['grade_level']);
    $hours = intval($_POST['hours']);

    // Basic validation
    if ($subject_code === '' || $description === '' || $grade_level === '' || $hours <= 0) {
        $error = "Please fill all fields correctly.";
    } else {
        $stmt = $conn->prepare("INSERT INTO subjects (subject_code, description, grade_level, hours) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $subject_code, $description, $grade_level, $hours);

        if ($stmt->execute()) {
            header('Location: subject_unit.php?status=created');
            exit;
        } else {
            $error = "Failed to create subject. " . $stmt->error;
        }
    }
}

// Preselect previously entered value
$selected_grade = $_POST['grade_level'] ?? '';
function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Subject</title>
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
              <h4>Create New Subject</h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                <div class="mb-3">
                  <label for="subject_code" class="form-label">Subject Code</label>
                  <input type="text" id="subject_code" name="subject_code" class="form-control" required value="<?= htmlspecialchars($_POST['subject_code'] ?? '') ?>" />
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" id="description" name="description" class="form-control" required value="<?= htmlspecialchars($_POST['description'] ?? '') ?>" />
                </div>

                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <option value="">Select grade level</option>
                    <option <?= isSelected("Nursery", $selected_grade) ?>>Nursery</option>
                    <option <?= isSelected("Kinder Garten", $selected_grade) ?>>Kinder Garten</option>
                    <option <?= isSelected("Grade 1", $selected_grade) ?>>Grade 1</option>
                    <option <?= isSelected("Grade 2", $selected_grade) ?>>Grade 2</option>
                    <option <?= isSelected("Grade 3", $selected_grade) ?>>Grade 3</option>
                    <option <?= isSelected("Grade 4", $selected_grade) ?>>Grade 4</option>
                    <option <?= isSelected("Grade 5", $selected_grade) ?>>Grade 5</option>
                    <option <?= isSelected("Grade 6", $selected_grade) ?>>Grade 6</option>
                    <option <?= isSelected("Grade 7", $selected_grade) ?>>Grade 7</option>
                    <option <?= isSelected("Grade 8", $selected_grade) ?>>Grade 8</option>
                    <option <?= isSelected("Grade 9", $selected_grade) ?>>Grade 9</option>
                    <option <?= isSelected("Grade 10", $selected_grade) ?>>Grade 10</option>
                    <option <?= isSelected("Grade 11", $selected_grade) ?>>Grade 11</option>
                    <option <?= isSelected("Grade 12", $selected_grade) ?>>Grade 12</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="hours" class="form-label">Hours</label>
                  <input type="number" id="hours" name="hours" class="form-control" min="1" required value="<?= htmlspecialchars($_POST['hours'] ?? '') ?>" />
                </div>

                <button type="submit" class="btn bg-main text-light">Create</button>
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
