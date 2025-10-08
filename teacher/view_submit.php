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
            <!-- Left Column -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Full Name</label>
              <p class="form-control-plaintext" id="modalFullName"></p>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Submission Date</label>
              <p class="form-control-plaintext" id="modalSubmissionDate"></p>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Email</label>
              <p class="form-control-plaintext" id="modalEmail"></p>
            </div>

            <div class="col-md-6 d-flex flex-column">
              <label class="form-label fw-semibold">Attachment URL</label>
              <p class="form-control-plaintext flex-grow-1 text-truncate" id="modalAttachmentURL" style="max-width: 100%;"></p>
            </div>


            <!-- Right Column -->
            <div class="col-md-12">
              <label class="form-label fw-semibold">Grade</label>
              <input type="number" class="form-control" id="modalGrade" name="grade" min="0" max="<?= $assignment['points'] ?>" required>
              <label class="form-label fw-semibold mt-3">Feedback</label>
              <textarea class="form-control" id="modalFeedback" name="feedback" rows="6" placeholder="Write feedback here" required></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Attachment File</label>
              <p class="form-control-plaintext" id="modalAttachmentFile"></p>
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
  const gradeInput = document.getElementById("modalGrade");

  submissionRows.forEach(row => {
    row.addEventListener("click", () => {
      const getData = (attr) => row.dataset[attr] ?? '';

      // Set hidden input & read-only fields
      document.getElementById("submissionId").value = getData("submissionId");
      document.getElementById("modalFullName").textContent = getData("fullname");
      document.getElementById("modalEmail").textContent = getData("email");
      document.getElementById("modalSubmissionDate").textContent = getData("submission_date") 
          ? new Date(getData("submission_date")).toLocaleString() 
          : 'Not Submitted Yet';

      // === Attachment File(s) ===
      const fileContainer = document.getElementById("modalAttachmentFile");
      fileContainer.innerHTML = '';
      const filePathData = getData("filePath");
      if (filePathData) {
        let files = [];
        try { files = JSON.parse(filePathData); } catch { files = [filePathData]; }
        if (Array.isArray(files) && files.length > 0) {
          const listGroup = document.createElement("ul");
          listGroup.className = "list-group list-group-flush";
          files.forEach(file => {
            if (file) {
              const listItem = document.createElement("li");
              listItem.className = "list-group-item d-flex align-items-center";
              listItem.style.padding = "0.25rem 0.75rem";
              listItem.innerHTML = `<i class="fas fa-paperclip me-2"></i>
                <a href="../static/uploads/${file}" target="_blank" class="text-truncate" style="max-width: calc(100% - 24px); display:inline-block;">${file}</a>`;
              listGroup.appendChild(listItem);
            }
          });
          fileContainer.appendChild(listGroup);
        } else { fileContainer.textContent = "No file"; }
      } else { fileContainer.textContent = "No file"; }

      // === Attachment URL ===
      const fileUrl = getData("fileUrl");
      const urlDiv = document.getElementById("modalAttachmentURL");
      if (fileUrl) {
        const safeUrl = fileUrl.startsWith("http") ? fileUrl : "#";
        urlDiv.innerHTML = `<a href="${safeUrl}" target="_blank" class="text-truncate">${fileUrl}</a>`;
      } else { urlDiv.textContent = "No URL"; }

      // === Editable Fields ===
      const maxPoints = parseFloat(getData("maxPoints")) || 100;
      gradeInput.max = maxPoints;
      gradeInput.value = getData("grade");
      gradeInput.addEventListener("input", () => {
        if (parseFloat(gradeInput.value) > maxPoints) {
          gradeInput.value = maxPoints;
          alert(`Grade cannot exceed the maximum of ${maxPoints} points`);
        }
      });

      document.getElementById("modalFeedback").value = getData("feedback");

      editModal.show();
    });
  });
});

</script>
