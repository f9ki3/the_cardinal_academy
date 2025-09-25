<?php 
include 'session_login.php'; 
include '../db_connection.php';

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
        $stmt = $conn->prepare("INSERT INTO uniforms (grade_level, gender, classification, type, size, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssd", $grade_level, $gender, $classification, $type, $size, $price);

        if ($stmt->execute()) {
            header('Location: uniforms.php?status=created&nav_drop=true');
            exit;
        } else {
            $error = "Failed to create uniform. " . $stmt->error;
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
  <title>Create New Uniform</title>
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
              <h4>Create New Uniform</h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                
                <!-- Grade Level -->
                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <option value="">Select grade level</option>
                    <?php
                      $grades = ["Nursery to Kinder", "Grade 1 to 6", "Grade 7 to 10", "Grade 11 to 12"];
                      foreach ($grades as $grade) {
                          $selected = isset($_POST['grade_level']) ? isSelected($grade, $_POST['grade_level']) : '';
                          echo "<option value=\"$grade\" $selected>$grade</option>";
                      }
                    ?>
                  </select>
                </div>

                <!-- Gender -->
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select name="gender" id="gender" class="form-select" required>
                    <option value="">Select gender</option>
                    <option value="Male" <?= isset($_POST['gender']) && $_POST['gender']=="Male" ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= isset($_POST['gender']) && $_POST['gender']=="Female" ? 'selected' : '' ?>>Female</option>
                    <option value="Unisex" <?= isset($_POST['gender']) && $_POST['gender']=="Unisex" ? 'selected' : '' ?>>Unisex</option>
                  </select>
                </div>

                <!-- Classification -->
                <div class="mb-3">
                  <label for="classification" class="form-label">Classification</label>
                  <select name="classification" id="classification" class="form-select" required>
                    <option value="">Select classification</option>
                    <option value="Top" <?= isset($_POST['classification']) && $_POST['classification']=="PE" ? 'selected' : '' ?>>Top</option>
                    <option value="Bottom" <?= isset($_POST['classification']) && $_POST['classification']=="Gala" ? 'selected' : '' ?>>Bottom</option>
                    <option value="Accesories" <?= isset($_POST['classification']) && $_POST['classification']=="Daily" ? 'selected' : '' ?>>Accesories</option>
                  </select>
                </div>

                <!-- Type -->
                <div class="mb-3">
                  <label for="type" class="form-label">Type</label>
                  <input type="text" id="type" name="type" class="form-control" required value="<?= htmlspecialchars($_POST['type'] ?? '') ?>" />
                </div>

                <!-- Size -->
                <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <select id="size" name="size" class="form-control" required>
                    <option value="">-- Select Size --</option>
                    <option value="N/A">N/A</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="2XL">2XL</option>
                    <option value="3XL">3XL</option>
                </select>
                </div>


                <!-- Price -->
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" step="0.01" id="price" name="price" class="form-control" required value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" />
                </div>

                <!-- Buttons -->
                <button type="submit" class="btn bg-main text-light">Create</button>
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
