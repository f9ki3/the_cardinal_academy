<div class="rounded" id="stream" role="tabpanel" aria-labelledby="stream-tab">
   <!-- Teacher Info -->
    <div class="rounded-4 p-4 text-white" style="
        background-image: url('../static/images/Front gate.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
        min-height: 150px;
    ">
        <!-- Overlay to dim the image -->
        <div style="
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.5);
            border-radius: 1rem; /* matches rounded-4 */
        "></div>

        <div class="row position-relative" style="z-index: 1;">
            <div class="col-12 col-md-10">
                <h1>John Doe</h1>
                <p class="mb-0">Teacher</p>
                <p class="mb-0">johndoe@example.com</p>
            </div>
            <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mt-2 mt-md-0">
                <button data-bs-toggle="modal" data-bs-target="#createStudentModal" class="btn btn-danger rounded-4">Join Student</button>
            </div>

        </div>
    </div>


    <!-- Students List -->
    <h5 class="fw-bold mt-5 mb-3">Students</h5>
    <div class="list-group">
        <div class="list-group-item d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="alice.jpg" alt="Alice Smith" class="rounded-circle me-3" width="50" height="50">
                <div>
                    <p class="mb-0 fw-semibold">Alice Smith</p>
                    <small class="text-muted">alice@example.com | 09171234567</small>
                </div>
            </div>
            <button class="btn  btn-sm d-flex align-items-center">
                <i class="bi bi-trash me-1"></i> 
            </button>
        </div>

        <div class="list-group-item d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="bob.jpg" alt="Bob Johnson" class="rounded-circle me-3" width="50" height="50">
                <div>
                    <p class="mb-0 fw-semibold">Bob Johnson</p>
                    <small class="text-muted">bob@example.com | 09172345678</small>
                </div>
            </div>
            <button class="btn  btn-sm d-flex align-items-center">
                <i class="bi bi-trash me-1"></i> 
            </button>
        </div>

        <div class="list-group-item d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="carol.jpg" alt="Carol Lee" class="rounded-circle me-3" width="50" height="50">
                <div>
                    <p class="mb-0 fw-semibold">Carol Lee</p>
                    <small class="text-muted">carol@example.com | 09173456789</small>
                </div>
            </div>
            <button class="btn  btn-sm d-flex align-items-center">
                <i class="bi bi-trash me-1"></i> 
            </button>
        </div>
        <!-- Add more students here -->
    </div>
</div>



<?php include 'join_student_modal.php'?>