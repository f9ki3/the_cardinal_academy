<!-- Modal (Join Class) -->
<div class="modal fade" id="joinCourses" tabindex="-1" aria-labelledby="joinCoursesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      
      <div class="modal-header bg-light">
        <h5 class="modal-title fw-bold" id="joinCoursesModalLabel">Join Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form action="save_assignment.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="joinCode" class="form-label">Class Join Code</label>
            <div class="input-group">
              <input type="text" class="form-control" id="joinCode" name="join_code" placeholder="Enter 8-digit number" required maxlength="8">
              <button class="btn border" type="button" id="copyJoinCodeBtn">
                <i class="bi bi-clipboard"></i> Copy
              </button>
            </div>
            <div class="form-text mt-3">Enter the 8-digit number provided by your teacher to join the class.</div>
          </div>

          <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-danger rounded-4 px-4 me-2">
              <i class="bi bi-check-circle me-2"></i> Join Class
            </button>
            <button type="button" class="btn btn-outline-danger rounded-4 px-4" data-bs-dismiss="modal">
              Cancel
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
document.getElementById('copyJoinCodeBtn').addEventListener('click', function() {
    const input = document.getElementById('joinCode');
    input.select();
    input.setSelectionRange(0, 99999); // for mobile
    navigator.clipboard.writeText(input.value).then(() => {
        // Optional: show tooltip or alert
        alert('Join code copied: ' + input.value);
    }).catch(err => console.error('Failed to copy: ', err));
});
</script>
