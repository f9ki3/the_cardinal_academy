<?php
  $hideHome = true;
  $pageTitle = 'Services';
  $breadcrumbs = [
  ['label' => 'Home', 'url' => 'index.php'],
  ['label' => 'Contact']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Cardinal Academy Inc.</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f4eaea;
      color: #111;
    }

    header img {
      width: 100%;  /* Make sure it fills the width of the container */
      max-height: 425px;  /* Limit the height of the image */
      object-fit: cover;  /* Ensure the image covers the space without distortion */
    }

    .section-title {
      text-align: center;
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 21px;
    }

    .card-custom {
  background: white;
  padding: 16px;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.07);
  min-height: 430px; /* slightly taller */
}
    .icon-wrapper {
      background-color: #e6e1e9;
      width: 60px;  /* Reduced icon size */
      height: 60px;
      border-radius: 50%;
      margin: 0 auto 16px auto;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 28px;  /* Reduced font size */
      color: #222;
    }

    .card-custom h3 {
      font-size: 1.25rem; /* Reduced heading size */
      margin-bottom: 16px;
    }

    .card-custom p {
      font-size: 0.9rem; /* Reduced text size */
      margin-bottom: 12px;
    }
    .nav-link{
      color:#da3030;
      

    }
    
  </style>
</head>
<body>

  <!-- Header -->
<?php include 'navigation.php'; ?>


<header>
  <img src="static/images/Front gate.jpg" class="img-fluid" alt="Main gate of The Cardinal Academy Inc.">
</header>

<!-- Main Section -->
<main class="container mt-4 mb-4">
  <h2 class="section-title">Support your child’s educational journey.</h2>

  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-custom text-center h-100">
        <div class="icon-wrapper">
          <i class="bi bi-house-door-fill"></i>
        </div>
        <h3 class="h5 fw-bold mb-3">Visit Us</h3>
        <p class="text-muted mb-4">
          Located in the heart of Meycauayan, The Cardinal Academy Inc. offers a welcoming environment where young minds are inspired to learn, grow, and thrive.
        </p>
        <a href="https://maps.app.goo.gl/RE39p3J86kGWTGsx8" class="d-block fw-bold text-decoration-none">
          Sullera St., Pandayan, City of Meycauayan, Bulacan 3020
        </a>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-custom text-center h-100">
        <div class="icon-wrapper">
          <i class="bi bi-facebook"></i>
        </div>
        <h3 class="h5 fw-bold mb-3">Check Us</h3>
        <p class="text-muted mb-4">
          Stay connected and informed through our official Facebook page, where The Cardinal Academy Inc. shares updates, announcements, and moments that shape our vibrant school community.
        </p>
        <a href="https://www.facebook.com/thecardinalacademy1985" target="_blank" class="d-block fw-bold text-decoration-none">
          The Cardinal Academy Inc.
        </a>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-custom text-center h-100">
        <div class="icon-wrapper">
          <i class="bi bi-envelope-fill"></i>
        </div>
        <h3 class="h5 fw-bold mb-3">Contact Us</h3>
        <p class="text-muted mb-3">
          Our dedicated team is always ready to assist you—connect with us for guidance, support, and answers to all your inquiries about your child’s educational journey.
        </p>
        <a href="tel:09673342307" class="d-block fw-bold text-decoration-none mb-2">09673342307</a>
        <a href="mailto:tcainc.edu@gmail.com" class="d-block fw-bold text-decoration-none">tcainc.edu@gmail.com</a>
      </div>
    </div>
  </div>
</main>


  <!-- Footer -->
  <?php 
  include 'footer1.php';
  ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
