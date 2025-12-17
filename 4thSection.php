<style>
  :root {
    --gallery-height: 250px;
    --gap: 20px;
    --duration: 40s;
  }

  .image-gallery {
    overflow: hidden;
    width: 100%;
    position: relative;
    padding: 20px 0;
    background: transparent;
    /* This creates the smooth fade effect on the left and right sides */
    mask-image: linear-gradient(
      to right,
      transparent,
      black 15%,
      black 85%,
      transparent
    );
    -webkit-mask-image: linear-gradient(
      to right,
      transparent,
      black 15%,
      black 85%,
      transparent
    );
  }

  .image-gallery-track {
    display: flex;
    width: max-content;
    animation: scroll-left var(--duration) linear infinite;
  }

  /* Pause animation on hover so users can look at a specific photo */
  .image-gallery:hover .image-gallery-track {
    animation-play-state: paused;
  }

  .gallery-card {
    position: relative;
    height: var(--gallery-height);
    margin-right: var(--gap);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
    cursor: pointer;
    flex-shrink: 0;
  }

  .gallery-card img {
    height: 100%;
    width: auto;
    object-fit: cover;
    display: block;
  }

  /* Hover effect: Scale up and deepen shadow */
  .gallery-card:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    z-index: 10;
  }

  /* Modern caption overlay (Optional) */
  .gallery-card::after {
    content: attr(data-caption);
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 20px 10px 10px;
    font-size: 0.9rem;
    font-family: sans-serif;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .gallery-card:hover::after {
    opacity: 1;
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(0);
    }
    100% {
      /* Moves exactly half the width of the track (Set 1 + Set 2) */
      transform: translateX(-50%);
    }
  }
</style>

<div class="image-gallery">
  <div class="image-gallery-track">
    <div class="gallery-card" data-caption="Senior High Classroom">
      <img src="static/images/Classroom Senior High.jpg" alt="Senior High">
    </div>
    <div class="gallery-card" data-caption="School Event">
      <img src="static/images/Sample event 2.jpg" alt="Event">
    </div>
    <div class="gallery-card" data-caption="High School Classroom">
      <img src="static/images/Classroom High School.jpg" alt="High School">
    </div>
    <div class="gallery-card" data-caption="Student Life">
      <img src="static/images/jann.jpg" alt="Student">
    </div>

    <div class="gallery-card" data-caption="Senior High Classroom">
      <img src="static/images/Classroom Senior High.jpg" alt="Senior High">
    </div>
    <div class="gallery-card" data-caption="School Event">
      <img src="static/images/Sample event 2.jpg" alt="Event">
    </div>
    <div class="gallery-card" data-caption="High School Classroom">
      <img src="static/images/Classroom High School.jpg" alt="High School">
    </div>
    <div class="gallery-card" data-caption="Student Life">
      <img src="static/images/jann.jpg" alt="Student">
    </div>
  </div>
</div>