<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
  /* Scoped Styles for Legacy Section */
  .legacy-section {
    background-color: #fcfbf9; /* Warm off-white background */
    color: #1f1f1f;
    font-family: 'Inter', sans-serif;
    padding: 5rem 0;
    overflow-x: hidden;
  }

  .legacy-section .font-display {
    font-family: 'Playfair Display', serif;
  }

  .legacy-section .kicker {
    font-family: 'Inter', sans-serif;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #b62e34; /* Cardinal Red */
    margin-bottom: 1rem;
    display: block;
  }

  .legacy-section .display-title {
    font-weight: 700;
    font-size: 3rem;
    line-height: 1.1;
    margin-bottom: 0.5rem;
    color: #000;
  }

  .legacy-section .subtitle {
    font-style: italic;
    color: #666;
    font-size: 1.25rem;
    margin-bottom: 3rem;
  }

  .legacy-section .divider {
    width: 60px;
    height: 3px;
    background-color: #b62e34;
    margin: 0 auto 2rem auto;
  }

  /* Text Column Styling */
  .narrative-text {
    padding: 0 1rem;
  }
  
  .narrative-text h2 {
    font-size: 2.25rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
  }

  .narrative-text p {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #444;
  }

  /* Image Styling */
  .legacy-img-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    transition: transform 0.4s ease;
  }

  .legacy-img-wrapper:hover {
    transform: translateY(-5px);
  }

  .legacy-img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
  }

  /* Desktop Vertical Offset for Visual Interest */
  @media (min-width: 992px) {
    .offset-up { margin-top: -3rem; }
    .offset-down { margin-top: 3rem; }
  }
</style>

<section class="legacy-section">
  <div class="container">
    
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8 font-display">
        <span class="kicker">Est. Tradition & Excellence</span>
        <h1 class="display-title">Tracing the Legacy</h1>
        <div class="divider"></div>
        <p class="subtitle">The History and Growth of The Cardinal Academy, Inc.</p>
      </div>
    </div>

    <div class="row align-items-center gx-5 gy-5">
      
      <div class="col-lg-3 col-md-6 order-2 order-lg-1">
        <figure class="legacy-img-wrapper offset-down">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0feb84da-1af7-471d-901a-e5901527503e.png"
            alt="Campus Aerial Left"
            class="legacy-img"
          />
        </figure>
      </div>

      <div class="col-lg-6 order-1 order-lg-2 text-center narrative-text">
        <h2 class="font-display">The Cardinal</h2>
        <p>
          The word <strong style="color: #b62e34;">CARDINAL</strong> means “prime, chief, principal,” or etymologically, <em>cardo</em>—translated as a hinge, meaning that upon which others depend. 
        </p>
        <p>
          A hinge serves not only as a pivotal point but as a connector and a bridge. From its name alone, The Cardinal Academy, Inc.’s mission, vision, and philosophy may be derived: to be the foundation upon which future leaders are built.
        </p>
      </div>

      <div class="col-lg-3 col-md-6 order-3 order-lg-3">
        <figure class="legacy-img-wrapper offset-up">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/64f76556-6343-428a-a8cd-31cb4b43c36a.png"
            alt="Campus Aerial Right"
            class="legacy-img"
          />
        </figure>
      </div>

    </div>
  </div>
</section>