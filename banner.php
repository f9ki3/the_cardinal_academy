<?php

// $mysqli = new mysqli("localhost", "root", "", "tca");
// $result = $mysqli->query("SELECT heading, paragraph FROM announcement WHERE visible = 1 ORDER BY id DESC");
// $announcements = $result->fetch_all(MYSQLI_ASSOC);

$mysqli = new mysqli("localhost", "u429904263_tca", "UsKA?M[7", "u429904263_tca");
$result = $mysqli->query("SELECT heading, paragraph, visible FROM announcement WHERE id = 1");
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Announcements</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .carousel-text {
      transform: translateX(5px);
    }

    .carousel-control-prev,
    .carousel-control-next {
      opacity: 0;
      width: 100px;
      height: 100%;
      top: 0;
      bottom: 0;
    }

    .carousel:hover .carousel-control-prev,
    .carousel:hover .carousel-control-next {
      cursor: pointer;
    }

    .announcement-wrapper {
      background-color: #da3030;
      color: white;
      padding: 0.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .announcement-icon {
      width: 40px;
      height: 40px;
      background-color: white;
      color: #da3030;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .announcement-divider {
      border-left: 2px solid white;
      height: 30px;
      margin-right: 1rem;
    }
  </style>
</head>
<body class="m-0 p-0">

<?php if (count($announcements) > 0): ?>
  <div class="announcement-wrapper">

    <!-- Fixed Logo -->
    <div class="d-flex align-items-center">
      <div class="announcement-icon">
        <i class="bi bi-megaphone-fill fs-5"></i>
      </div>
    </div>

    <!-- Divider -->
    <div class="announcement-divider"></div>

    <!-- Carousel Content -->
    <div id="announcementCarousel" class="carousel slide w-100" data-bs-ride="carousel">
      <div class="carousel-inner">

        <?php foreach ($announcements as $index => $row): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="carousel-text">
              <strong><?= htmlspecialchars($row['heading']) ?></strong>
              <i class="bi bi-dot"></i>
              <span><?= htmlspecialchars($row['paragraph']) ?></span>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <!-- Invisible but clickable arrows -->
      <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev"></button>
      <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next"></button>
    </div>
  </div>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
