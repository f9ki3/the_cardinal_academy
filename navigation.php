<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sticky Combined Navbar</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
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
          <?php if (empty($hideHome)): ?>
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="enroll.php">Enroll</a></li>
          <?php endif; ?>
        </ul>
        <?php if (empty($hideLogInButton)): ?>
          <a href="login.php" class="btn text-light ms-2" style="background-color: #da3030; box-shadow: 0 4px 8px rgba(0,0,0,0.3);">
            Log In
          </a>
        <?php endif; ?>
      </div>
    </nav>

    <!-- Sub Navbar -->
    <?php
    include 'breadcrumb_nav.php'; 
    ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
