<!-- Modal (Create Assignment) -->
<div class="modal fade" id="createAssignmentModal" tabindex="-1" aria-labelledby="createAssignmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="createAssignmentModalLabel">Create Assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form action="save_assignment.php" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <!-- Left Column -->
            <div class="col-12 col-md-6">
              <!-- Assignment Title -->
              <div class="mb-3">
                <label for="assignmentTitle" class="form-label">Assignment Title</label>
                <input type="text" class="form-control" id="assignmentTitle" name="title" placeholder="Enter assignment title" required>
              </div> 

              <?php
                // Get course ID from URL and teacher ID from session
                $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $teacher_id = $_SESSION['user_id'];
              ?>

              <!-- Hidden fields for course_id and teacher_id -->
              <input type="hidden" name="course_id" value="<?= $course_id ?>">
              <input type="hidden" name="teacher_id" value="<?= $teacher_id ?>">

              <!-- Instructions -->
              <div class="mb-3">
                <label for="instructions" class="form-label">Instructions</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="4" placeholder="Provide assignment instructions" required></textarea>
              </div>

              <!-- Points -->
              <div class="mb-3">
                <label for="points" class="form-label">Points</label>
                <input type="number" class="form-control" id="points" name="points" placeholder="Enter maximum points" required>
              </div>

            </div>

            <!-- Right Column -->
            <div class="col-12 col-md-6">
              <!-- Due Date -->
              <div class="mb-3">
                <label for="dueDate" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="dueDate" name="due_date" required>
              </div>

              <!-- Due Time -->
              <div class="mb-3">
                <label for="dueTime" class="form-label">Due Time</label>
                <input type="time" class="form-control" id="dueTime" name="due_time" required>
              </div>

              <!-- Upload Assignment Files (Optional) -->
              <div class="mb-3">
                <label for="assignmentFile" class="form-label">Assignment File (Optional)</label>
                <input class="form-control" type="file" id="assignmentFile" name="assignment_file" accept=".pdf,.docx,.pptx,.txt,.jpg,.png">
                <small class="text-muted">You can upload a file (optional). Maximum size: 10MB</small>
              </div>

            </div>
          </div>

          <div class="mt-3">
            <!-- Submit and Cancel Buttons -->
            <button type="submit" class="btn btn-danger rounded-4 px-4">
              <i class="bi bi-check-circle me-2"></i> Save Assignment
            </button>
            <button type="button" class="btn btn-outline-danger rounded-4 px-4" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
