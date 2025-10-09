<?php include 'session_login.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>

  <?php include 'header.php'; ?>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
  <div class="d-flex">
    <!-- Sidebar -->
    <?php include 'navigation.php'; ?>

    <!-- Main Content -->
    <div class="flex-grow-1">
      <?php include 'nav_top.php'; ?>

      <div class="container py-4">
        <!-- Your main dashboard content here -->
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
