<?php
  // ==========================================
  // PAGE CONFIGURATION & LOGIC
  // ==========================================
  
  // This variable is likely used inside 'navigation.php' to potentially hide the home link or change the nav style
  $hideHome = true;
  
  // Sets the title for the browser tab (though currently hardcoded in <title> tag below, this variable is good practice)
  $pageTitle = 'Services';
  
  // Define breadcrumb navigation links array
  // This allows for dynamic generation of the breadcrumb trail later in the HTML
  $breadcrumbs = [
      ['label' => 'Home', 'url' => 'index.php'],
      ['label' => 'Contact', 'url' => '#'] // Current page usually points to '#' or stays empty
  ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <title>The Cardinal Academy Inc.</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      /* CSS Variables for consistent color theming */
      --primary-red: #dc3545;  /* Bootstrap Danger color */
      --bg-color: #f8fafc;     /* Light grey/blue background */
      --text-dark: #1e293b;
      --text-muted: #6c757d;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-dark);
      -webkit-font-smoothing: antialiased; /* Makes fonts look sharper on Mac/iOS */
      overflow-x: hidden; /* Prevents horizontal scrollbars */
    }

    /* --- Hero Section (Image Header) --- */
    .hero-section {
      position: relative;
      width: 100%;
      height: 450px;
      overflow: hidden; /* Ensures image zoom doesn't break layout */
      margin-bottom: 2rem;
    }

    /* The main header image with animation */
    .hero-img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures image covers area without stretching */
      display: block;
      animation: subtleZoom 20s infinite alternate; /* Slowly zooms in and out */
    }

    /* Dark overlay to make text potentially readable if you add text over the image later */
    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3); /* 30% opacity black */
      z-index: 1;
    }

    /* Animation Keyframes for the hero image */
    @keyframes subtleZoom {
      from { transform: scale(1); }
      to { transform: scale(1.05); }
    }

    /* --- Breadcrumbs Customization --- */
    .breadcrumb-item a {
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
    }
    .breadcrumb-item.active {
      color: var(--primary-red);
      font-weight: 600;
    }

    /* --- Info Cards UI --- */
    .hover-card {
      background: #fff;
      border: 1px solid #eaeaea;
      border-radius: 16px;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smooth spring-like transition */
      height: 100%; /* Ensures all cards in a row are same height */
      position: relative;
      overflow: hidden;
    }

    /* The sliding red line animation on top of the card */
    .hover-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--primary-red);
      transform: scaleX(0); /* Initially hidden (width 0) */
      transition: transform 0.3s ease;
      transform-origin: left;
    }

    /* Hover State for Cards */
    .hover-card:hover {
      transform: translateY(-8px); /* Moves card up */
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08); /* Adds shadow */
      border-color: transparent;
    }

    /* Trigger the red line animation on hover */
    .hover-card:hover::before {
      transform: scaleX(1); /* Expands red line to full width */
    }

    /* Circular Icon Container */
    .icon-circle {
      width: 64px;
      height: 64px;
      background-color: #fff5f5; /* Very light red background */
      color: var(--primary-red);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    /* Styling for links inside the contact lists */
    .clean-link {
      text-decoration: none;
      color: inherit;
      transition: color 0.2s;
    }
    .clean-link:hover {
      color: var(--primary-red);
      text-decoration: underline;
    }
    
    /* Utility: Letter Spacing */
    .ls-2 { letter-spacing: 2px; }
  </style>
</head>
<body>

<?php include 'navigation.php'; ?>

<!-- <header class="hero-section">
  <div class="hero-overlay"></div>
  <img src="static/images/Front gate.jpg" class="hero-img" alt="Main gate of The Cardinal Academy Inc.">
</header> -->

<main class="container py-4">

  <nav aria-label="breadcrumb" class="mb-5">
    <ol class="breadcrumb">
      <?php foreach($breadcrumbs as $crumb): ?>
        <?php if(isset($crumb['url']) && $crumb['label'] !== 'Contact'): ?>
          <li class="breadcrumb-item"><a href="<?= $crumb['url'] ?>"><?= $crumb['label'] ?></a></li>
        <?php else: ?>
          <li class="breadcrumb-item active" aria-current="page"><?= $crumb['label'] ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ol>
  </nav>

  <header class="text-center mb-5" style="max-width: 700px; margin: 0 auto;">
    <h6 class="text-uppercase text-danger fw-bold small ls-2">Support & Connect</h6>
    <h1 class="fw-bold display-6 mb-3">Your Journey Starts Here</h1>
    <p class="text-muted">Empowering the next generation through excellence in education and strong community connection.</p>
  </header>

  <div class="row g-4 mb-5">

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-solid fa-map-location-dot"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Visit Campus</h3>
        <p class="text-muted small mb-3">A welcoming environment where young minds thrive.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li>
            <i class="fa-solid fa-location-arrow text-danger me-2"></i>
            <a href="https://maps.app.goo.gl/RE39p3J86kGWTGsx8" class="clean-link">Sullera St., Pandayan</a>
          </li>
          <li>
            <i class="fa-solid fa-city text-danger me-2"></i>
            City of Meycauayan, Bulacan
          </li>
          <li>
            <i class="fa-regular fa-clock text-danger me-2"></i>
            Mon - Fri: 8:00 AM - 5:00 PM
          </li>
        </ul>
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-brands fa-facebook-f"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Stay Connected</h3>
        <p class="text-muted small mb-3">Real-time updates, announcements, and highlights.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li>
            <i class="fa-solid fa-thumbs-up text-danger me-2"></i>
            <a href="https://www.facebook.com/thecardinalacademy1985" target="_blank" class="clean-link">Official Facebook Page</a>
          </li>
          <li>
            <i class="fa-solid fa-rss text-danger me-2"></i>
            Latest School News
          </li>
          <li>
            <i class="fa-solid fa-images text-danger me-2"></i>
            Event Galleries
          </li>
        </ul>
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-solid fa-headset"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Get in Touch</h3>
        <p class="text-muted small mb-3">Our dedicated team is ready to assist you.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li>
            <i class="fa-solid fa-phone text-danger me-2"></i>
            <a href="tel:09673342307" class="clean-link">0967 334 2307</a>
          </li>
          <li>
            <i class="fa-solid fa-envelope text-danger me-2"></i>
            <a href="mailto:tcainc.edu@gmail.com" class="clean-link">tcainc.edu@gmail.com</a>
          </li>
          <li>
            <i class="fa-solid fa-info-circle text-danger me-2"></i>
            Admissions Inquiries
          </li>
        </ul>
      </div>
    </div>

  </div>
</main>

<?php include 'footer1.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>