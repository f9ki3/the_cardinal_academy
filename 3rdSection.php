<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cardinal Academy Legacy</title>

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto&display=swap" rel="stylesheet" />

  <style>
    :root {
      --color-cardinal-red: #b62e34;
      --color-bg: #f4eded;
      --font-primary: 'Playfair Display', serif;
      --font-secondary: 'Roboto', sans-serif;
    }

    body {
      background-color: var(--color-bg);
      font-family: var(--font-secondary);
      color: #333;
      margin: 0;
      padding: 0;
    }

    .header-title {
      font-family: var(--font-primary);
      color: var(--color-cardinal-red);
      font-size: 1.5rem;
    }

    .header-subtitle {
      font-style: italic;
      font-size: 1.125rem;
    }

    .cardinal-image {
      width: 20%;
      min-width: 200px;
      object-fit: cover;
      aspect-ratio: 4 / 3;
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .float-right {
      float: right;
      border-radius: 16px 0 0 16px;
    }

    .float-left {
      float: left;
      border-radius: 0 16px 16px 0;
    }

    .cardinal-text {
      font-size: 1rem;
      line-height: 1.6;
      max-width: 700px;
      margin: 0 auto;
      font-family: var(--font-secondary);
      color: #222;
      text-align: center;
      clear: both;
    }

    h2 {
      font-family: var(--font-primary);
      font-weight: 700;
      font-size: 4rem;
      color: #000;
      margin-top: 2rem;
      text-align: center;
    }

    .future-heading {
      font-family: var(--font-primary);
      font-size: 3rem;
      color: var(--color-cardinal-red);
      text-align: center;
    }

    @media (max-width: 768px) {
      .float-right,
      .float-left {
        float: none !important;
        display: block;
        margin: 1rem auto;
        border-radius: 16px;
        width: 100% !important;
      }
    }
  </style>
</head>
<body class="m-0 p-0">


  <!-- Tracing the Legacy Header -->
  <div class="w-100 py-4 px-0">
    <div class="text-center mb-4">
      <p class="header-title fs-1">Tracing the Legacy:</p>
      <p class="header-subtitle fs-3">The History and Growth of The Cardinal Academy, Inc.</p>
    </div>

    <!-- The Cardinal Section -->
    <div class="my-1">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/64f76556-6343-428a-a8cd-31cb4b43c36a.png"
        alt="Aerial view right side"
        class="cardinal-image float-right"
      />
      <div class="cardinal-text">
        <h2>The Cardinal</h2>
        <p class="fs-5 text">
          The word <strong style="color: var(--color-cardinal-red);">CARDINAL</strong> means “prime, chief, principal,” or etymologically, <em>cardo</em>—translated as hinge, meaning that which others depend upon. A hinge also serves as a connector or a bridge. From its name alone, The Cardinal Academy, Inc.’s mission, vision, and philosophy may be derived.
        </p>
      </div>
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0feb84da-1af7-471d-901a-e5901527503e.png"
        alt="Aerial view left side"
        class="cardinal-image float-left"
      />
    </div>

    <footer class="text-center py-5"></footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
