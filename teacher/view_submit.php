<!-- Modal (View/Edit Submission) -->
<div class="modal fade" id="editSubmissionModal" tabindex="-1" aria-labelledby="editSubmissionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editSubmissionModalLabel">View Submission</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="grade_submit.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="submission_id" id="submissionId">
          
          <div class="row g-3">
            <!-- Left Column: Read-Only Info -->
            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Full Name</label>
                <p class="form-control-plaintext" id="modalFullName"></p>
              </div>
            </div>

            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Submission Date</label>
                <p class="form-control-plaintext" id="modalSubmissionDate"></p>
              </div>
            </div>

            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Email</label>
                <p class="form-control-plaintext" id="modalEmail"></p>
              </div>
            </div>

            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Attachment URL</label>
                <p class="form-control-plaintext" id="modalAttachmentURL"></p>
              </div>
            </div>


            <!-- Right Column: Editable Fields -->
            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Grade</label>
                <input type="number" class="form-control" id="modalGrade" name="grade" min="0" max="100" required>
              </div>
              <div >
                <label class="form-label fw-semibold">Feedback</label>
                <textarea class="form-control" id="modalFeedback" name="feedback" rows="6" placeholder="Write feedback here" required></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div >
                <label class="form-label fw-semibold">Attachment File</label>
                <p class="form-control-plaintext" id="modalAttachmentFile"></p>
              </div>
            </div>
          </div>

          <div class="mt-3 d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-danger rounded-4 px-4">
              <i class="bi bi-check-circle me-2"></i> Save
            </button>
            <button type="button" class="btn btn-outline-danger rounded-4 px-4" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const submissionRows = document.querySelectorAll(".submission-row");
  const editModal = new bootstrap.Modal(document.getElementById("editSubmissionModal"));

  submissionRows.forEach(row => {
    row.addEventListener("click", () => {
      // Set submission ID and other read-only info
      document.getElementById("submissionId").value = row.dataset.submissionId || '';
      document.getElementById("modalFullName").textContent = row.dataset.fullname || '';
      document.getElementById("modalEmail").textContent = row.dataset.email || '';
      document.getElementById("modalSubmissionDate").textContent = row.dataset.submission_date || '';

      // Attachment File(s)
      const fileContainer = document.getElementById("modalAttachmentFile");
      const filePathData = row.dataset.filePath;

      fileContainer.innerHTML = ''; // clear previous content

      if (filePathData) {
        let files = [];
        try {
          files = JSON.parse(filePathData); // Parse JSON array
        } catch (e) {
          files = [filePathData]; // fallback for single string
        }

        if (files.length > 0) {
          const listGroup = document.createElement('ul');
          listGroup.className = 'list-group list-group-flush';
          files.forEach(file => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex align-items-center';
            listItem.style.padding = '0.25rem 0.75rem';
            listItem.innerHTML = `
              <i class="fas fa-paperclip me-2"></i>
              <a href="../uploads/${file}" target="_blank" class="text-truncate" style="max-width: calc(100% - 24px); display:inline-block;">${file}</a>
            `;
            listGroup.appendChild(listItem);
          });
          fileContainer.appendChild(listGroup);
        } else {
          fileContainer.textContent = "No file";
        }
      } else {
        fileContainer.textContent = "No file";
      }

      // Attachment URL
      const fileUrl = row.dataset.fileUrl;
      const urlDiv = document.getElementById("modalAttachmentURL");
      if (fileUrl) {
        urlDiv.innerHTML = `<a href="${fileUrl}" target="_blank" class="text-truncate">${fileUrl}</a>`;
      } else {
        urlDiv.textContent = "No URL";
      }

      // Editable fields
      document.getElementById("modalGrade").value = row.dataset.grade || '';
      document.getElementById("modalFeedback").value = row.dataset.feedback || '';

      editModal.show();
    });
  });
});
</script>

