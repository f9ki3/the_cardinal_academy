<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Your Future Awaits</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Merriweather', serif;
      background-color: #f5f0f0;
      color: white;
      padding: 1.5rem;
    }

    header, footer {
      background-color: #b22222;
      border-radius: 12px;
      text-align: center;
      padding: 1rem 2rem;
      box-shadow: 0 2px 6px rgba(178, 34, 34, 0.5);
    }

    header h1 {
      font-size: 2rem;
      font-weight: 700;
      margin: 0;
    }

    .image-wrapper {
      overflow: hidden;
      aspect-ratio: 16 / 9;
    }

    .image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease;
    }

    .image-wrapper img:hover {
      transform: scale(1.03);
    }

    footer {
      font-size: 0.9rem;
      margin-top: 2rem;
    }

    /* Remove rounding for smooth edge-to-edge connection */
    .image-wrapper {
      border-radius: 0;
      box-shadow: none;
    }

    /* Remove outer padding for flush edge */
    .image-grid {
      padding-left: 0;
      padding-right: 0;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="mb-4">
    <h1>Your Future Awaits</h1>
  </header>

  <!-- Main Image Grid -->
  <main class="container-fluid px-0">
    <div class="row g-0 image-grid">
      <div class="col-12 col-md-4">
        <div class="image-wrapper">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a9814756-0069-46b8-b64d-95a20b423097.png" 
               alt="Classroom with students attentively learning in desks" class="img-fluid" tabindex="0">
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="image-wrapper">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5c7f3d7d-c153-45ce-a641-1ec77dec7ced.png" 
               alt="Teacher explaining to a classroom of engaged students" class="img-fluid" tabindex="0">
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="image-wrapper">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a50dfc3b-d48c-4ef8-a507-26f78b198ac4.png" 
               alt="Students listening attentively in a well-lit classroom" class="img-fluid" tabindex="0">
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="mt-5">
    &copy; 2025 The Cardinal Academy. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Optional keyboard interaction
    const images = document.querySelectorAll('.image-wrapper img');
    images.forEach(img => {
      img.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          img.classList.toggle('zoom');
          e.preventDefault();
        }
      });
    });
  </script>
</body>
</html>
