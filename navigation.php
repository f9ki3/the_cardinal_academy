<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .navbar {
      background-color: #b72029;
    }

    .navbar .navbar-nav .nav-link {
      color: #fff !important;
    }

    .navbar .navbar-nav .nav-link:hover {
      text-decoration: underline;
      color: #fff !important;
    }

    .navbar-brand {
      color: #fff !important;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .navbar-brand img {
      height: 40px;
      width: auto;
      object-fit: contain;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar sticky-top navbar-expand-lg px-4">
    <a class="navbar-brand fw-bold text-white" href="index.php">
      <img src="static/uploads/logo.png" alt="TCA Logo">
      <h5 class="mt-2 mb-0">The Cardinal Academy</h5>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav align-items-center me-2">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#facilities">Facilities</a></li>
        <li class="nav-item"><a class="nav-link" href="#organization">Organization</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
      <a  href="login.php" class="btn text-light ms-2" style="background-color: #da3030; box-shadow: 0 4px 8px rgba(0,0,0,0.3);">
        Log In
  </a>
    </div>
  </nav>

  <!-- Bootstrap JS (Must be placed at the end of body) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
