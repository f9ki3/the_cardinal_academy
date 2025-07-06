<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Initialize DB fallback values
$heading = '';
$paragraph = '';
$visible = 0;

// Ensure the table exists
mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS announcement (
        id INT PRIMARY KEY,
        heading TEXT,
        paragraph TEXT,
        visible TINYINT(1) DEFAULT 0
    )
");

// Ensure a default row exists
$check = mysqli_query($conn, "SELECT id FROM announcement WHERE id = 1");
if ($check && mysqli_num_rows($check) === 0) {
    mysqli_query($conn, "INSERT INTO announcement (id, heading, paragraph, visible) VALUES (1, '', '', 0)");
}

// Handle AJAX toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle'])) {
    $visible = (int) $_POST['visible'];
    mysqli_query($conn, "UPDATE announcement SET visible = $visible WHERE id = 1");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['toggle'])) {
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $paragraph = mysqli_real_escape_string($conn, $_POST['paragraph']);
    mysqli_query($conn, "UPDATE announcement SET heading = '$heading', paragraph = '$paragraph' WHERE id = 1");
    header("Location: banner_edit.php?success=1&nav_drop=true");
    exit;
}

// Fetch current data
$result = mysqli_query($conn, "SELECT heading, paragraph, visible FROM announcement WHERE id = 1");
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $heading = $row['heading'];
    $paragraph = $row['paragraph'];
    $visible = $row['visible'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Announcement</title>
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
          <div class="rounded p-4 bg-white">
            <h4 class="mb-3">Edit Announcement</h4>

            <?php if (isset($_GET['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Announcement updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" name="heading" class="form-control rounded rounded-4" required value="<?= htmlspecialchars($heading) ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Paragraph</label>
                <textarea name="paragraph" class="form-control rounded rounded-4" rows="4" required><?= htmlspecialchars($paragraph) ?></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label">Show Announcement</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="visible" value="1" <?= $visible ? 'checked' : '' ?> onchange="toggleVisibility(this.value)">
                  <label class="form-check-label">Show</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="visible" value="0" <?= !$visible ? 'checked' : '' ?> onchange="toggleVisibility(this.value)">
                  <label class="form-check-label">Hide</label>
                </div>
              </div>

              <button type="submit" class="btn btn-primary rounded rounded-4 px-4">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- AJAX and nav_drop auto-expand -->
<script>
function toggleVisibility(value) {
  fetch('banner_edit.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `toggle=1&visible=${value}`
  }).then(response => {
    if (!response.ok) alert('Failed to update visibility');
  });
}

// Open Maintenance dropdown if nav_drop is in URL
document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get("nav_drop") === "true") {
    const dropdownMenu = document.getElementById("maintenanceMenu");
    const arrowIcon = document.getElementById("arrow-icon");
    if (dropdownMenu && arrowIcon) {
      dropdownMenu.style.display = "block";
      arrowIcon.textContent = "▲";
    }
  }
});
</script>
</body>
</html>
