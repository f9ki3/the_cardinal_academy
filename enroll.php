<?php
  $hideHome = true;
  $pageTitle = 'Services';
  $breadcrumbs = [
    ['label' => 'Home', 'url' => 'index.php'],
    ['label' => 'Enroll']
  ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Cardinal Academy – Registration</title>
  <?php include 'header.php'; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manufacturing+Consent&family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
  <style>
    .enroll-title {
        font-family: "PT Sans Narrow", sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 1.8rem;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 1rem;
      }

    /* ---------- circle & title ---------- */
    .circle-wrapper       { position: relative; width: 250px; height: 250px; margin: 0 auto 1rem; }
    .circle-img-container { width: 100%; height: 100%; border-radius: 50%; background:#dc3545;
                            display:flex; align-items:center; justify-content:center; overflow:hidden; }
    .circle-img-container img { width:100%; height:auto; }
    .circle-text-svg text { fill:#fff; font-size:0.82rem; font-weight:600; letter-spacing:1px; }
  </style>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div>
    <h4 class="text-center"><strong>Step 1</strong>: </h4>
    <p class="text-center mb-4">
      Choose your child's upcoming grade level to proceed with the enrollment process. Click on an option below.
    </p>

    <div class="row text-center">

      <!-- ------------- Primary ------------- -->
      <div class="col-md-4 mb-4">
       <div class="shadow p-3 rounded rounded-4">
         <a href="primary.php" class="text-decoration-none text-dark">
          <div class="circle-wrapper">
            <!-- red circle with image -->
            <div class="circle-img-container">
              <img src="static/images/rm3.png" alt="Primary">
            </div>
            <!-- curved text -->
            <svg viewBox="0 0 250 250" class="circle-text-svg position-absolute top-0 start-0" width="250" height="250">
              <defs>
                <!-- radius = 110 px so the text hugs the edge; needs unique id per circle -->
                <path id="textPath-primary" d="M125 125 m-110 0 a110 110 0 1 1 220 0 a110 110 0 1 1 -220 0" />
              </defs>
              <text>
                <textPath href="#textPath-primary" startOffset="50%" text-anchor="middle">
                  Nursery&nbsp;to&nbsp;Grade&nbsp;6
                </textPath>
              </text>
            </svg>
          </div>
          <h2 class="enroll-title">Primary</h2>
          <p class="text-muted">
            For students entering from Nursery up to Grade 6. This includes early childhood education and the foundational elementary years to prepare students academically and socially.
          </p>

        </a>
       </div>
      </div>

      <!-- ------------- Junior High ------------- -->
      <div class="col-md-4 mb-4">
         <div class="shadow p-3 rounded rounded-4">
            <a href="junior.php" class="text-decoration-none text-dark">
          <div class="circle-wrapper">
            <div class="circle-img-container">
              <img src="static/images/rm2.png" alt="Junior High">
            </div>
            <svg viewBox="0 0 250 250" class="circle-text-svg position-absolute top-0 start-0" width="250" height="250">
              <defs>
                <path id="textPath-junior" d="M125 125 m-110 0 a110 110 0 1 1 220 0 a110 110 0 1 1 -220 0" />
              </defs>
              <text>
                <textPath href="#textPath-junior" startOffset="50%" text-anchor="middle">
                  Grade&nbsp;7&nbsp;to&nbsp;Grade&nbsp;10
                </textPath>
              </text>
            </svg>
          </div>
          <h2 class="enroll-title">Junior High</h2>
          <p class="text-muted">
            For students progressing to Grades 7 to 10. This level builds on core subjects while developing critical thinking, collaboration, and independence in preparation for senior high.
          </p>

        </a>
        </div>
      </div>

      <!-- ------------- Senior High ------------- -->
      <div class="col-md-4 mb-4">
        <div class="shadow p-3 rounded rounded-4">
        <a href="senior.php" class="text-decoration-none text-dark">
          <div class="circle-wrapper">
            <div class="circle-img-container">
              <img src="static/images/rm1.png" alt="Senior High">
            </div>
            <svg viewBox="0 0 250 250" class="circle-text-svg position-absolute top-0 start-0" width="250" height="250">
              <defs>
                <path id="textPath-senior" d="M125 125 m-110 0 a110 110 0 1 1 220 0 a110 110 0 1 1 -220 0" />
              </defs>
              <text>
                <textPath href="#textPath-senior" startOffset="50%" text-anchor="middle">
                  Grade&nbsp;11&nbsp;to&nbsp;Grade&nbsp;12
                </textPath>
              </text>
            </svg>
          </div>
          <h2 class="enroll-title">Senior High</h2>
            <p class="text-muted">
              For students entering Grades 11 and 12. This level offers academic and technical-vocational tracks to prepare learners for college, employment, or entrepreneurship.
            </p>

        </a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
