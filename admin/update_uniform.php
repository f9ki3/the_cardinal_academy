<?php 
include 'session_login.php'; 
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: uniforms.php?status=error&nav_drop=true');
    exit;
}

$id = (int)$_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM uniforms WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: uniforms.php?status=notfound&nav_drop=true');
    exit;
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_level = trim($_POST['grade_level']);
    $gender = trim($_POST['gender']);
    $classification = trim($_POST['classification']);
    $type = trim($_POST['type']);
    $size = trim($_POST['size']);
    $price = floatval($_POST['price']);

    // Basic validation
    if ($grade_level === '' || $gender === '' || $classification === '' || $type === '' || $size === '' || $price <= 0) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $stmt = $conn->prepare("UPDATE uniforms 
                                SET grade_level = ?, gender = ?, classification = ?, type = ?, size = ?, price = ?
                                WHERE id = ?");
        $stmt->bind_param("sssssdi", $grade_level, $gender, $classification, $type, $size, $price, $id);

        if ($stmt->execute()) {
            header('Location: uniforms.php?status=updated&nav_drop=true');
            exit;
        } else {
            $error = "Failed to update uniform. " . $stmt->error;
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Update Uniform</title>
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
              <h4>Update Uniform</h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                
                <!-- Grade Level -->
                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <?php
                      $grades = ["Nursery to Kinder", "Grade 1 to 6", "Grade 7 to 10", "Grade 11 to 12"];
                      foreach ($grades as $grade) {
                          $selected = isSelected($grade, $row['grade_level']);
                          echo "<option value=\"$grade\" $selected>$grade</option>";
                      }
                    ?>
                  </select>
                </div>

                <!-- Gender -->
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select name="gender" id="gender" class="form-select" required>
                    <option value="Male" <?= isSelected("Male", $row['gender']) ?>>Male</option>
                    <option value="Female" <?= isSelected("Female", $row['gender']) ?>>Female</option>
                    <option value="Unisex" <?= isSelected("Unisex", $row['gender']) ?>>Unisex</option>
                  </select>
                </div>

                <!-- Classification -->
                <div class="mb-3">
                  <label for="classification" class="form-label">Classification</label>
                  <select name="classification" id="classification" class="form-select" required>
                    <option value="Top" <?= isSelected("Top", $row['classification']) ?>>Top</option>
                    <option value="Bottom" <?= isSelected("Bottom", $row['classification']) ?>>Bottom</option>
                    <option value="Accesories" <?= isSelected("Accesories", $row['classification']) ?>>Accesories</option>
                  </select>
                </div>

                <!-- Type -->
                <div class="mb-3">
                  <label for="type" class="form-label">Type</label>
                  <input type="text" id="type" name="type" class="form-control" required 
                         value="<?= htmlspecialchars($row['type']) ?>" />
                </div>

                <!-- Size -->
                <div class="mb-3">
                  <label for="size" class="form-label">Size</label>
                  <select id="size" name="size" class="form-control" required>
                      <?php 
                      $sizes = ["N/A","XS","S","M","L","XL","2XL","3XL"];
                      foreach ($sizes as $s): ?>
                          <option value="<?= $s ?>" <?= isSelected($s, $row['size']) ?>><?= $s ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>

                <!-- Price -->
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" step="0.01" id="price" name="price" class="form-control" required 
                         value="<?= htmlspecialchars($row['price']) ?>" />
                </div>

                <!-- Buttons -->
                <button type="submit" class="btn bg-main text-light">Update</button>
                <a href="uniforms.php?nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>
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
