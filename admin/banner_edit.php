<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Ensure table exists
mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS announcement (
        id INT AUTO_INCREMENT PRIMARY KEY,
        heading TEXT NOT NULL,
        paragraph TEXT NOT NULL,
        visible TINYINT(1) DEFAULT 0
    )
");

// Handle Add or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $paragraph = mysqli_real_escape_string($conn, $_POST['paragraph']);

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        mysqli_query($conn, "UPDATE announcement SET heading='$heading', paragraph='$paragraph' WHERE id=$id");
    } else {
        mysqli_query($conn, "INSERT INTO announcement (heading, paragraph) VALUES ('$heading', '$paragraph')");
    }

    header("Location: banner_edit.php?success=1&nav_drop=true");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM announcement WHERE id = $id");
    header("Location: banner_edit.php?deleted=1&nav_drop=true");
    exit;
}

// Handle Visibility Toggle
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $res = mysqli_query($conn, "SELECT visible FROM announcement WHERE id = $id");
    if ($row = mysqli_fetch_assoc($res)) {
        $newVisibility = $row['visible'] ? 0 : 1;
        mysqli_query($conn, "UPDATE announcement SET visible = $newVisibility WHERE id = $id");
    }
    header("Location: banner_edit.php?toggled=1&nav_drop=true");
    exit;
}

// Fetch data for editing
$editData = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM announcement WHERE id = $editId");
    if ($res && mysqli_num_rows($res) > 0) {
        $editData = mysqli_fetch_assoc($res);
    }
}

// Fetch all announcements
$announcements = mysqli_query($conn, "SELECT * FROM announcement ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Announcements</title>
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
            <h4 class="mb-3"><?= $editData ? 'Edit Announcement' : 'Add Announcement' ?></h4>

            <?php if (isset($_GET['success'])): ?>
              <div class="alert alert-success">✅ Announcement saved successfully!</div>
            <?php elseif (isset($_GET['deleted'])): ?>
              <div class="alert alert-warning">🗑️ Announcement deleted successfully!</div>
            <?php elseif (isset($_GET['toggled'])): ?>
              <div class="alert alert-info">🔁 Visibility toggled.</div>
            <?php endif; ?>

            <form method="POST">
              <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
              <?php endif; ?>

              <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" name="heading" class="form-control rounded rounded-4" required value="<?= htmlspecialchars($editData['heading'] ?? '') ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Paragraph</label>
                <textarea name="paragraph" class="form-control rounded rounded-4" rows="4" required><?= htmlspecialchars($editData['paragraph'] ?? '') ?></textarea>
              </div>

              <button type="submit" class="btn btn-<?= $editData ? 'primary' : 'success' ?> rounded rounded-4 px-4">
                <?= $editData ? 'Update' : 'Add' ?>
              </button>

              <?php if ($editData): ?>
                <a href="banner_edit.php" class="btn btn-secondary ms-2">Cancel</a>
              <?php endif; ?>
            </form>
          </div>
        </div>

        <div class="col-12">
          <div class="rounded p-4 bg-white mt-4">
            <h4 class="mb-3">All Announcements</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <!-- Removed ID column header -->
                  <th>Heading</th>
                  <th>Visible</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($announcements)): ?>
                  <tr>
                    <!-- Removed ID column data -->
                    <td><?= htmlspecialchars($row['heading']) ?></td>
                    <td><?= $row['visible'] ? 'Yes' : 'No' ?></td>
                    <td>
                      <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                      <a href="?toggle=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">
                        <?= $row['visible'] ? 'Hide' : 'Show' ?>
                      </a>
                      <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this announcement?')">Delete</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
                <?php if (mysqli_num_rows($announcements) === 0): ?>
                  <tr><td colspan="3" class="text-center">No announcements found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script>
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
