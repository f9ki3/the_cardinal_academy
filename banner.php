<?php
$mysqli = new mysqli("localhost", "root", "", "tca");
$result = $mysqli->query("SELECT heading, paragraph, visible FROM announcement WHERE id = 1");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Announcement</title>

  <!-- Bootstrap & Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="m-0 p-0">

<?php if ($row['visible']): ?>
  <div>
    <div class="text-white rounded-0 p-4 d-flex flex-column flex-md-row align-items-start align-items-md-center w-100" style="background-color: #da3030;">

      <!-- Icon and Label -->
      <div class="d-flex flex-column align-items-center text-center me-md-4 mb-3 mb-md-0">
        <div class="bg-white text-danger rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
          <i class="bi bi-megaphone-fill fs-4"></i>
        </div>
        <div class="text-uppercase small fw-semibold mt-2">Announcement</div>
      </div>

      <!-- Divider -->
      <div class="d-none d-md-block border-start border-white" style="height: 60px; margin-right: 1.5rem;"></div>

      <!-- Text Content -->
      <div>
        <h1 class="fs-4 mb-1"><?= htmlspecialchars($row['heading']) ?></h1>
        <p class="mb-0"><?= htmlspecialchars($row['paragraph']) ?></p>
      </div>

    </div>
  </div>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
