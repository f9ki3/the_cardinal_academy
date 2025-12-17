<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<style>
  .hover-card {
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    height: 100%; /* Ensures all cards are same height */
    position: relative;
    overflow: hidden;
  }

  /* Red top accent line */
  .hover-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: #dc3545;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
  }

  .hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    border-color: transparent;
  }

  .hover-card:hover::before {
    transform: scaleX(1);
  }

  .icon-circle {
    width: 64px;
    height: 64px;
    background-color: #fff5f5; /* Very light red */
    color: #dc3545;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }
</style>

<section class="container py-5">

  <header class="text-center mb-5" style="max-width: 700px; margin: 0 auto;">
    <h6 class="text-uppercase text-danger fw-bold small ls-2">Academic Excellence</h6>
    <h1 class="fw-bold display-6 mb-3">Why Choose TCA?</h1>
    <p class="text-muted">A comprehensive learning environment designed to nurture potential and build future leaders.</p>
  </header>

  <div class="row g-4">

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Complete Education</h3>
        <p class="text-muted small mb-3">From early childhood to young adulthood.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li><i class="fa-solid fa-check text-danger me-2"></i>Preschool (Nursery & Kinder)</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i>Grade School</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i>Junior & Senior High School</li>
        </ul>
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-solid fa-layer-group"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Specialized Tracks</h3>
        <p class="text-muted small mb-3">Focused pathways for Senior High School.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li><i class="fa-solid fa-check text-danger me-2"></i><strong>Academic:</strong> ABM, GAS, HUMSS, STEM</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i><strong>TVL:</strong> EIM (NC II)</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i><strong>TVL:</strong> ICT - CSS (NC II)</li>
        </ul>
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-card p-4">
        <div class="icon-circle">
          <i class="fa-solid fa-award"></i>
        </div>
        <h3 class="h5 fw-bold text-dark">Quality Assurance</h3>
        <p class="text-muted small mb-3">Certified programs ensuring global standards.</p>
        <hr class="opacity-25 my-3">
        <ul class="list-unstyled small text-secondary mb-0 d-flex flex-column gap-2">
          <li><i class="fa-solid fa-check text-danger me-2"></i>PEAC Certified</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i>PRIME English Programs</li>
          <li><i class="fa-solid fa-check text-danger me-2"></i>PRIME Mathematics Programs</li>
        </ul>
      </div>
    </div>

  </div>
</section>