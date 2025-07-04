
<?php
$breadcrumbs = $breadcrumbs ?? []; // ✅ Prevent warning
?>

<style>
  .sub-navbar {
    background-color: #da3030;
    padding-top: 2px;
    padding-bottom: 2px;
    min-height: 20px;
  }

  /* Remove Bootstrap's default slash separator */
  .breadcrumb-item + .breadcrumb-item::before {
    content: none !important;
  }

  /* Breadcrumb links */
  .breadcrumb a {
    font-weight: bold;
    font-family: 'Segoe UI', sans-serif;
    text-decoration: none;
    color: #f8f9fa !important;
    font-size: 0.875rem;
    line-height: 1.2;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-right: 6px; /* space after link */
  }

 

  /* Breadcrumb icon styling */
  .breadcrumb .bi-chevron-left {
    font-weight: bold;
    font-size: 1rem;
    margin-right: 6px; /* space after icon */
    color: #fff;
  }

  /* Optional: Last breadcrumb (active) */
  .breadcrumb-item.active {
    font-weight: bold;
    font-family: 'Segoe UI', sans-serif;
  
  }

  /* Shared breadcrumb style */
  /* .breadcrumb a, */
  .breadcrumb-item.active {
    font-weight: bold;
    font-family: 'Segoe UI', sans-serif;
    font-size: 0.875rem;
    line-height: 1.2;
    color: #f8f9fa !important;
    text-decoration: none;
  }

  .breadcrumb a:hover {
    text-decoration: underline;
  }

  /* Icon style */
  .breadcrumb .bi-chevron-double-left {
    font-weight: bold;
    font-size: 0.7rem;
    margin-right:-4px;
    color: #fff;
  }
</style>

<?php if (empty($hideSubNav)): ?>
  <nav class="navbar sub-navbar px-4" aria-label="breadcrumb">
    <div class="container-fluid justify-content-end">
      <ol class="breadcrumb mb-0">
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
          <?php if (!empty($crumb['url']) && $index !== array_key_last($breadcrumbs)): ?>
            <li class="breadcrumb-item d-flex align-items-center">
              <a href="<?= htmlspecialchars($crumb['url']) ?>"><?= htmlspecialchars($crumb['label']) ?></a>
              <i class="bi bi-chevron-double-left text-white"></i>
            </li>
          <?php else: ?>
            <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
              <?= htmlspecialchars($crumb['label']) ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ol>
    </div>
  </nav>
<?php endif; ?>

