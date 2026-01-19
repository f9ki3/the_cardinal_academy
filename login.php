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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AcadeSys</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons for eye icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Font Awesome (if needed, optional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* Responsive hiding of image */
    @media (max-width: 767.98px) {
      .login-image {
        display: none;
      }
    }

    .navbar-sticky-wrapper {
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    .main-navbar {
      background-color: #b72029;
    }

    .main-navbar .nav-link,
    .main-navbar .navbar-brand {
      color: #fff !important;
    }

    .main-navbar .nav-link:hover {
      text-decoration: underline;
    }

    .navbar-brand img {
      height: 40px;
      width: auto;
      object-fit: contain;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .sub-navbar .nav-link {
      color: #f8f9fa !important;
      font-size: 0.875rem;
      line-height: 1.2;
      padding-top: 4px;
      padding-bottom: 4px;
    }

    .sub-navbar .nav-link:hover {
      color: #fff !important;
    }

    .contact-btn {
      color: #000000;
      padding: 8px 16px;
      text-decoration: none;
    }

    .contact-btn .underline-text {
      text-decoration: none;
    }

    .contact-btn:hover .underline-text {
      text-decoration: underline;
    }

    .contact-btn .no-underline {
      text-decoration: none !important;
    }

    .contact-btn i {
      margin-left: 4px;
    }

    /* ======= LOGIN PAGE BACKGROUND ======= */
    body {
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
      z-index: 0;
      overflow-x: hidden;
    }

    /* Background image with blur */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-image: url('static/images/basketball2.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      filter: blur(8px);  /* Gaussian blur */
      z-index: -2;
      pointer-events: none;
    }

    /* Dim gradient overlay */
    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.3)); /* dark gradient */
      z-index: -1;
      pointer-events: none;
    }

    /* Add a semi-transparent background behind the login card */
    .login-card {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>

  <div class="navbar-sticky-wrapper">
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg main-navbar px-4">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <img src="static/uploads/logo.png" alt="TCA Logo" />
        <span class="ms-2">The Cardinal Academy</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
              aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarMain">
        <ul class="navbar-nav me-3 mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="enroll.php">Enroll</a></li>
        </ul>

        <a href="login.php" class="btn text-light ms-2" style="background-color: #da3030; box-shadow: 0 4px 8px rgba(0,0,0,0.3);">
          Log In
        </a>
      </div>
    </nav>
  </div>

  <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100" style="margin-top: 120px; margin-bottom: 120px;">
      <div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
        <div class="p-4 login-card w-100" style="max-width: 500px;">
          <div class="text-center mb-3">
            <img src="static/uploads/logo.png" alt="Logo" style="width: 100px; height: 100px;">
          </div>
          <h3 class="text-center mb-4">Welcome to AcadeSys</h3>
          <form action="login_process.php" method="POST"  class="p-3">
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

              <?php elseif ($_GET['status'] === 'unauthorized'): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
                  <div>
                    <strong>Unauthorized Login:</strong>
                    <p class="mb-0">Admin login is not allowed from this page.</p>
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

            <button type="submit" class="btn btn-danger text-light w-100 mb-3">
              <i class="bi bi-door-open me-2"></i> LOGIN
            </button>

            <a href="enroll.php" class="btn btn-outline-danger w-100 mb-3 text-center text-decoration-none">
              <i class="bi bi-pencil-square me-2"></i> ENROLL
            </a>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

</body>
</html>
