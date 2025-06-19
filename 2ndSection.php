<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Cardinal Academy</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .quote {
      font-style: italic;
      font-size: 1.1rem;
    }

    .cta {
      background-color: #c0392b;
      color: white;
      padding: 10px 24px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .cta:hover {
      background-color: #a93226;
      color: white;
    }

    iframe {
      border: none;
      width: 100%;
      height: 100%;
    }

    @media (max-width: 576px) {
      h1 {
        font-size: 1.5rem;
      }
      .quote {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body class="bg-light py-4">

  <div class="container bg-white shadow rounded p-4">
    <div class="row g-4 align-items-center flex-column-reverse flex-md-row">
      
     <div class="col-md-6">
        <video class="w-100 rounded" controls autoplay muted playsinline>
          <source src="static/images/tca_video.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
      <!-- Text Content -->
      <div class="col-md-6 text-center">
        <h1 class="fw-bold mb-3">"Be part of TCA family"</h1>
        <blockquote class="quote mb-4">
          Experience a nurturing community where learning goes beyond the classroom, every student is valued, and growth is guided with heart and excellence. Your journey starts here—come home to TCA!
        </blockquote>
        <div class="text-center">
          <a href="enroll.php" class="cta">Enroll Now!</a>
        </div>
      </div>

      <!-- Video -->
      
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
