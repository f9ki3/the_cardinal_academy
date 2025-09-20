<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Turn in Assignment</title>
  <?php include 'header.php'; ?>
  <style>
    .rounded-circle:hover {
      background-color: rgb(240, 249, 255) !important;
    }
    .tabs {
      display: flex;
      gap: 30px;
      padding: 5px;
    }
    .tab {
      padding: 8px 0;
      cursor: pointer;
      position: relative;
    }
    .tab p {
      margin: 0;
      font-weight: 500;
      color: #555;
    }
    .tab.active p {
      color: #000;
    }
    .tab.active::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 3px;
      background: rgb(218, 64, 64);
      border-radius: 2px;
    }
    .turn-in-btn {
      background-color: rgb(218, 64, 64);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .turn-in-btn:hover {
      background-color: rgb(168, 54, 54);
    }
    .file-input {
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div style="height: 100vh;" class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="container my-4">

            <!-- Assignment Details -->
            <div class="row g-3">
              <?php 
                $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
                $assignment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
              ?>

              <div class="col-12 col-md-7">

                <h1><?php $course_name = 'Science 1'; echo $course_name; ?></h1>
                <p>Created Date: September 30, 2025, 11:59 PM</p>
                <div class="mb-3 d-flex justify-content-between">
                    <p class="mb-1">Points: 100</p>
                    <p class="mb-1">Due Date: September 30, 2025, 11:59 PM</p>
                </div>
                <hr>
                
                <h5>Instructions:</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque euismod augue non nisi pretium, nec cursus nisl varius.</p>
                
                <h5>Attachment:</h5>
                <p>Download the assignment files or instructions if available.</p>
                <a href="download_file.php?file=assignment_file.pdf" class="btn btn-link">Download Attachment</a>
              </div>

              <div class="col-12 col-md-5">
                <div class="shadow rounded rounded-4 p-4">
                    <h5 class="mb-3">Your Work:</h5>
                    <!-- Points, Due Date & Time -->
                    <form action="submit_assignment.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="assignment_id" value="<?= $assignment_id ?>" />
                        <input type="hidden" name="course_id" value="<?= $course_id ?>" />

                        <div class="mb-3">
                        <label class="text-muted" for="fileInput" class="form-label">Upload Your Assignment</label>
                        <input type="file" class="form-control file-input" id="fileInput" name="fileInput" required>
                        </div>

                        <button type="submit" class="turn-in-btn w-100">Turn In</button>
                    </form>
                </div>
              </div>

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
