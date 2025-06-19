<style>
  .image-gallery {
    overflow: hidden;
    width: 100%;
    position: relative;
    padding: 10px 0;
  }

  .image-gallery-track {
    display: flex;
    width: max-content;
    animation: scroll-right 30s linear infinite;
  }

  .image-gallery img {
    height: 200px;
    margin-right: 20px;
    flex-shrink: 0;
  }

  @keyframes scroll-right {
    0% {
      transform: translateX(-30%);
    }
    100% {
      transform: translateX(0%);
    }
  }
</style>

<div class="image-gallery">
  <div class="image-gallery-track">
    <img src="static/images/Classroom Senior High.jpg" alt="Senior High Classroom">
    <img src="static/images/Sample event 2.jpg" alt="Event">
    <img src="static/images/Classroom High School.jpg" alt="High School Classroom">
    <!-- Duplicate for loop effect -->
    <img src="static/images/Classroom Senior High.jpg" alt="Senior High Classroom">
    <img src="static/images/Sample event 2.jpg" alt="Event">
    <img src="static/images/Classroom High School.jpg" alt="High School Classroom">
  </div>
</div>
