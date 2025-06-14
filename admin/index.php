<?php include 'session.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'?>
  <style>
    @media (max-width: 576px) {
  .login-card {
    box-shadow: none !important;
    border: none !important;
  }
}

  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4 login-card shadow rounded-4" style="width: 100%; max-width: 400px;">
    <div class="d-flex justify-content-center mb-3">
      <img src="../static/uploads/logo.png" alt="Logo" style="width: 100px; height: 100px;">
    </div>
    <h3 class="text-center mb-4">Welcome to Acadesys</h3>
    <form action="login_process.php" method="POST">
      <?php if (isset($_GET['status']) && $_GET['status'] == 1): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
          <div>
            <strong>Authentication Failed:</strong>
            <p class="mb-0">The email, username, or password you entered is incorrect. Please try again.</p>
          </div>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>



      <div class="mb-3">
        <label for="username" class="form-label">Username or Email</label>
        <input type="text" name="username" id="username" class="form-control" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required />
      </div>
      <button type="submit" class="btn bg-main text-light w-100 mb-3">Login</button>
    </form>
  </div>
</div>



<?php include 'footer.php'?>
</body>
</html>
