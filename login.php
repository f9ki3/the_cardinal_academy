<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AcadeSys</title>
  <style>
    @media (max-width: 767.98px) {
      .login-image {
        display: none;
      }
    }
  </style>
  <?php include 'header.php'; ?>
</head>
<body>

  <?php include 'navigation.php'; ?>

  <div class="container-fluid">
    <div class="row min-vh-100 d-flex justify-content-center">
      <div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
        <div class="p-4 login-card w-100" style="max-width: 500px;">
          <div class="text-center mb-3">
            <img src="static/uploads/logo.png" alt="Logo" style="width: 100px; height: 100px;">
          </div>
          <h3 class="text-center mb-4">Welcome to AcadeSys</h3>
          <form action="login_process.php" method="POST">
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
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
