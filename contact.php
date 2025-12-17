<?php
  $hideHome = true;
  $pageTitle = 'Services';
  $breadcrumbs = [
      ['label' => 'Home', 'url' => 'index.php'],
      ['label' => 'Contact', 'url' => '#']
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
      /* Matching the red from your new UI snippet */
      --primary-red: #dc3545; 
      --bg-color: #f8fafc;
      --text-dark: #1e293b;
      --text-muted: #6c757d;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-dark);
      -webkit-font-smoothing: antialiased;
      overflow-x: hidden;
    }

    /* --- Hero Section (Full Width + Dimmer) --- */
    .hero-section {
      position: relative;
      width: 100%;
      height: 450px;
      overflow: hidden;
      margin-bottom: 2rem;
    }

    .hero-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      animation: subtleZoom 20s infinite alternate; 
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3); /* The dimmer */
      z-index: 1;
    }

    @keyframes subtleZoom {
      from { transform: scale(1); }
      to { transform: scale(1.05); }
    }

    /* --- Breadcrumbs --- */
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

    /* --- New Card UI Styles --- */
    .hover-card {
      background: #fff;
      border: 1px solid #eaeaea;
      border-radius: 16px;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      height: 100%; 
      position: relative;
      overflow: hidden;
    }

    /* Red top accent line */
    .hover-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--primary-red);
      transform: scaleX(0);
      transition: transform 0.3s ease;
      transform-origin: left;
    }

    .hover-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
      border-color: transparent;
    }

    .hover-card:hover::before {
      transform: scaleX(1);
    }

    .icon-circle {
      width: 64px;
      height: 64px;
      background-color: #fff5f5; /* Very light red */
      color: var(--primary-red);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    /* Helper for links inside the lists */
    .clean-link {
      text-decoration: none;
      color: inherit;
      transition: color 0.2s;
    }
    .clean-link:hover {
      color: var(--primary-red);
      text-decoration: underline;
    }
    
    /* Typography Helpers */
    .ls-2 { letter-spacing: 2px; }
  </style>
</head>
<body>

<?php include 'navigation.php'; ?>

<header class="hero-section">
  <div class="hero-overlay"></div>
  <img src="static/images/Front gate.jpg" class="hero-img" alt="Main gate of The Cardinal Academy Inc.">
</header>

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