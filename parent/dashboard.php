<?php include 'session_login.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'?>
</head>
<style>
  .chat-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #007bff;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      color: white;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      cursor: pointer;
    }
    .chat-icon:hover {
      background-color: #0056b3;
    }
</style>
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
            <h2 class="fw-bold">Welcome, Parent</h2>
            <p class="text-muted">—let's have an awesome year!</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
  <div class="chat-icon" title="Message Support">
    💬
  </div>

<?php include 'footer.php'?>
</body>
</html>
