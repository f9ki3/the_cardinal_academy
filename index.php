<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AcadeSys</title>
  <?php include 'header.php'; ?>
</head>

<?php include 'navigation.php'; ?>
<body>
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="static/images/Topview.jpg" class="d-block w-100" alt="Front Gate" />
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
          <h1 class="text-white">Welcome to The Cardinal Academy</h1>
          <p class="text-white">Empowering students with knowledge, values, and skills for the future.</p>
          <a href="enroll.php" class="btn bg-main text-light rounded btn-lg rounded-4 btn-lg">Enroll Now</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="static/images/basketball2.webp" class="d-block w-100" alt="Top View" />
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
          <h1 class="text-white">World-Class Facilities</h1>
          <p class="text-white">Explore our state-of-the-art sports and academic spaces.</p>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="static/images/Up View.jpg" class="d-block w-100" alt="Up View" />
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
          <h1 class="text-white">Join Us Today</h1>
          <p class="text-white">Your future begins here.</p>
        </div>
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container text-muted mb-5" id="about">
  <div class="row pb-5 mt-5">

   <div class="col-12 col-md-3"></div>
   <div class="col-12 col-md-6 text-center">
     <h1>The Cardinal Academy</h1>
     <p class="text-center">The Cardinal Academy (The Cardinal School) is a premier educational institution located in Sullera Pandayan, Bulacan. Our mission is to provide a nurturing and stimulating environment where students can develop academically, emotionally, and socially to reach their full potential. </p>
   </div>
   <div class="col-12 col-md-3"></div>
  </div>
 <style>
.image-gallery {
  overflow: hidden;
  width: 100%;
  position: relative;
}

.image-gallery-track {
  display: flex;
  width: fit-content;
  animation: scroll-left-right 10s linear infinite;
}

.image-gallery img {
  height: 200px;
  margin-right: 20px;
  flex-shrink: 0;
}

@keyframes scroll-left-right {
  0% {
    transform: translateX(-50%);
  }
  100% {
    transform: translateX(0%);
  }
}
</style>

<div class="image-gallery">
  <div class="image-gallery-track">
    <!-- Duplicate set -->
    <img src="static/images/Classroom Senior High.jpg" alt="Senior High Classroom">
    <img src="static/images/Sample event 2.jpg" alt="Event">
    <img src="static/images/Classroom High School.jpg" alt="High School Classroom">
    <img src="static/images/Classroom Senior High.jpg" alt="Senior High Classroom">
    <img src="static/images/Sample event 2.jpg" alt="Event">
    <img src="static/images/Classroom High School.jpg" alt="High School Classroom">
  </div>
</div>

 <div class="row mt-5">
    <div class="col-12 col-md-6">
         <div class="text-muted">
            <h2>Mission</h2>
            <p style="text-align: justify">Our mission at The Cardinal Academy is to cultivate a learning environment where students are inspired to achieve academic excellence, develop strong character, and become responsible global citizens through innovative education and community engagement.</p>
        </div>

    </div>
    <div class="col-12 col-md-6">
        <div class="text-muted">
            <h2>Vision</h2>
            <p style="text-align: justify">We envision The Cardinal Academy as a premier institution that empowers future leaders by fostering curiosity, creativity, and a passion for lifelong learning in a supportive and inclusive setting.</p>
        </div>
    </div>
 </div>
</div>

  <?php include 'footer.php'; ?>
</body>
</html>
