<?php
include 'db_connection.php';
$result = $mysqli->query("SELECT heading, paragraph, visible FROM announcement WHERE id = 1");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Announcement</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Keep your existing CSS here */
    .announcement-bar {
      background-color: #da3030;
      padding: 1.5rem;
      display: flex;
      align-items: center;
      border-radius: 6px;
      color: #fff;
      margin-bottom: 1.5rem;
    }
    .announcement-left {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-right: 1.5rem;
      text-align: center;
    }
    .announcement-icon {
      background-color: #fff;
      color: #da3030;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      font-size: 1.5rem;
      margin-bottom: 0.3rem;
    }
    .announcement-label {
      font-size: 0.875rem;
      font-weight: 600;
      text-transform: uppercase;
      color: #fff;
    }
    .announcement-divider {
      width: 1px;
      height: 60px;
      background-color: #ffffff;
      margin-right: 1.5rem;
    }
    .announcement-content h1 {
      font-size: 1.5rem;
      margin: 0 0 0.25rem 0;
      color: #fff;
    }
    .announcement-content p {
      margin: 0;
      font-size: 1rem;
      color: #f8f9fa;
    }
    @media (max-width: 768px) {
      .announcement-bar {
        flex-direction: column;
        align-items: flex-start;
      }
      .announcement-divider {
        display: none;
      }
      .announcement-left {
        flex-direction: row;
        margin-bottom: 1rem;
      }
      .announcement-label {
        margin-left: 0.5rem;
        text-align: left;
      }
    }
  </style>
</head>
<body>

<?php if ($row['visible']): ?>
  <div class="announcement-bar">
    <div class="announcement-left">
      <div class="announcement-icon">
        <i class="bi bi-megaphone-fill"></i>
      </div>
      <div class="announcement-label">Announcement</div>
    </div>

    <div class="announcement-divider"></div>

    <div class="announcement-content">
      <h1><?= htmlspecialchars($row['heading']) ?></h1>
      <p><?= htmlspecialchars($row['paragraph']) ?></p>
    </div>
  </div>
<?php endif; ?>

</body>
</html>
