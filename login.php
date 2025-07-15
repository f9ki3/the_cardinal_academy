<?php 
include 'session_login.php';

$hideHome = true;
$hideEnroll = true;
$hideContact = true;
$hideLogInButton = true;
?>

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
            <?php if (isset($_GET['status'])): ?>
              <?php if ($_GET['status'] == 1): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
                  <div>
                    <strong>Authentication Failed:</strong>
                    <p class="mb-0">The email, username, or password you entered is incorrect. Please try again.</p>
                  </div>
                  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php elseif ($_GET['status'] == 2): ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-start" role="alert">
                  <div>
                    <strong>You have successfully logged out.</strong>
                  </div>
                  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
            <?php endif; ?>

            <div class="mb-3">
              <label for="username" class="form-label">Username or Email</label>
              <input type="text" name="username" id="username" class="form-control" required />
            </div>
           <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required />
                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                  <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </span>
              </div>
            </div>

            <script>
              const togglePassword = document.getElementById('togglePassword');
              const passwordInput = document.getElementById('password');
              const toggleIcon = document.getElementById('toggleIcon');

              togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');
              });
            </script>
            <button type="submit" class="btn btn-danger text-light w-100 mb-3">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
