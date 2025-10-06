<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>
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
        <!-- Announcement Form -->
        <div class="col-12">
          <div class="rounded p-4 bg-white">
             <?php
                // Check if 'status' parameter exists in the URL
                if (isset($_GET['status'])) {
                    $status = $_GET['status'];

                    // Display Bootstrap alert based on the status
                    if ($status === 'success') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ✅ Added announcement successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    } elseif ($status === 'deleted') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                🗑️ Deleted announcement successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    } elseif ($status === 'error') {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ❌ Something went wrong. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                }
                ?>

            <h4 class="mb-3">Add Announcement</h4>
            <form method="POST" action="announcement_save.php">
              <div class="mb-3">
                <label for="acc_type" class="form-label">Account Type</label>
                <select name="acc_type" id="acc_type" class="form-control" required>
                  <option value="student">Student</option>
                  <option value="parent">Parent</option>
                  <option value="teacher">Teacher</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" name="message" id="message" rows="4" required></textarea>
              </div>

              <button type="submit" class="btn btn-danger px-4 rounded-4">Submit</button>
            </form>
          </div>
        </div>

        <!-- Announcements Table -->
        <div class="col-12">
          <div class="rounded p-4 bg-white">
            <h4 class="mb-3">All Announcements</h4>
            <table class="table">
              <thead>
                <tr>
                  <th width="15%">Date</th>
                  <th width="15%">Account Type</th>
                  <th width="50%">Message</th>
                  <th width="10%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM notification ORDER BY date DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                  while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                  <td><?= htmlspecialchars($row['date']) ?></td>
                  <td><?= htmlspecialchars(ucfirst($row['acc_type'])) ?></td>
                  <td><?= htmlspecialchars($row['message']) ?></td>
                  <td>
                    <a href="announcement_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm" onclick="return confirm('Delete this announcement?')"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                  <td colspan="5" class="text-center">No announcements found.</td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
