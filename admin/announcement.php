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
        <div class="col-12">
          <div class="rounded p-4 bg-white">
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

              <button type="submit" class="btn btn-success px-4 rounded-4">Submit</button>
            </form>
          </div>
        </div>

        <div class="col-12">
          <div class="rounded p-4 bg-white mt-4">
            <h4 class="mb-3">All Announcements</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Heading</th>
                  <th>Visible</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Parent-Teacher Meeting on July 22</td>
                  <td>Yes</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-secondary">Hide</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Delete this announcement?')">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>System Maintenance Scheduled</td>
                  <td>No</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-secondary">Show</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Delete this announcement?')">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>Family Day on August 3</td>
                  <td>Yes</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-secondary">Hide</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Delete this announcement?')">Delete</a>
                  </td>
                </tr>
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
