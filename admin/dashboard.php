<?php include 'session_login.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'?>
</head>
<body>
<div class="d-flex flex-row" style="background-color: white;">
  <!-- Sidebar -->
  <?php include 'navigation.php'?>

  <!-- Main Content -->
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'?>

    <div class="container my-4">
      <!-- Main content goes here -->
      <div class="row g-4">
        <div class="col-12">
          <div class="card p-3">
            <h2 class="fw-bold">Welcome to AcadeSys</h2>
            <p class="text-muted">—let's have an awesome year!</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include'footer.php'?>
</body>
</html>
