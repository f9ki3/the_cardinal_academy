<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <style>
    .rounded-circle:hover{
      background-color:rgb(240, 249, 255) !important;
    }
  </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div>
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-5">
                  <h4>View Class</h4>
                </div>

                
              </div>

              <!-- Courses Grid -->
              <div class="row g-3">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-3" id="classTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="stream-tab" data-bs-toggle="tab" data-bs-target="#stream" type="button" role="tab" aria-controls="stream" aria-selected="true">Stream</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab" aria-controls="attendance" aria-selected="false">Attendance</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="people-tab" data-bs-toggle="tab" data-bs-target="#people" type="button" role="tab" aria-controls="people" aria-selected="false">People</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="assignment-tab" data-bs-toggle="tab" data-bs-target="#assignment" type="button" role="tab" aria-controls="assignment" aria-selected="false">Assignment</button>
                </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="classTabsContent">
                <div class="tab-pane rounded fade show active" id="stream" role="tabpanel" aria-labelledby="stream-tab">
                    <p class="text-muted">Stream content goes here...</p>
                </div>
                <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                    <p class="text-muted">Attendance content goes here...</p>
                </div>
                <div class="tab-pane fade" id="people" role="tabpanel" aria-labelledby="people-tab">
                    <p class="text-muted">People content goes here...</p>
                </div>
                <div class="tab-pane fade" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">
                    <p class="text-muted">Assignment content goes here...</p>
                </div>
                </div>

              </div>

            </div> <!-- end inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
