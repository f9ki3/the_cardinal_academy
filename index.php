<?php include 'session_login.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <title>AcadeSys</title>

</head>
<style>
    .carousel-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .carousel-img {
        height: 45vh;
      }
    }

    #not{
      border: none;
      width: 100%;
      min-height: 28vh;
    }

    #organization {
      min-height: 50vh;
    }
    #about {
      min-height: 80vh;
    }

    footer iframe {
      height: 120px;
    }
    
  </style>
<?php include 'navigation.php'; ?>

<body class="bg-light">
 <section id="home">
    <div id="enrollCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="static/images/PIC1.jpg" class="carousel-img" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="static/images/PIC2.jpg" class="carousel-img" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="static/images/PIC3.jpg" class="carousel-img" alt="Slide 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#enrollCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#enrollCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>

  <!-- 2nd Section -->
  <section id="nothing" class="bg-white py-5">
    <div class="container">
      <?php include '2ndSection.php'; ?>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class=" py-5">
    <div class="container">
      <?php include '3rdSection.php'; ?>
    </div>
  </section>

 <section class="section1 py-5" >
  <div class="container">
    <h1 class="text-center">Your Future Awaits</h1>
    <?php include 'not.php'; ?>
  </div>
</section>


  <!-- Facilities Section -->
  <section id="facilities" class="bg-white py-5">
    <div class="container">
      <?php include '5thSection.php'; ?>
    </div>
  </section>
  



  <!-- Organization Section -->
 

  <!-- Footer -->
  <footer class="bg-dark text-white mt-4">
    <?php include 'footer1.php'; ?>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
