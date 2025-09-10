<form id="createPostForm" action="save_post.php" method="POST" enctype="multipart/form-data">
    <div class="row g-3">
    <!-- Left Column -->
    <div class="col-12 col-md-12 p-4 bg-white rounded rounded-4">

        <div class="row">
          <div class="col-6">
            <div class="mb-3">
            <label for="postTitle" class="form-label">Post Title</label>
            <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required>
            </div>
          </div>
          <div class="col-6">
            <!-- Video Link -->
            <div class="mb-3">
            <label for="videoLink" class="form-label">Video Link (Optional)</label>
            <input type="url" class="form-control" id="videoLink" name="video_link" placeholder="Paste YouTube or video link">
            </div>
          </div>
        </div>

        <div class="mb-3">
        <label for="description" class="form-label">Content Description </label>
        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Write your content here."></textarea>
        </div>


        <input type="hidden" name="course_id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : 0; ?>">
        <input type="hidden" name="teacher_id" value="<?php echo isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0; ?>">


        <div class="mb-3">
        <label for="attachments" class="form-label">Attachments  (Optional)</label>
        <input class="form-control" type="file" id="attachments" name="attachments[]" multiple>
        <small class="text-muted">You can upload multiple files (PDF, images, docs, etc.)</small>

        <!-- Preview list with scroll -->
        <div style="max-height: 220px; overflow-y: auto;" class="border rounded mt-2">
            <ul id="fileList" class="list-group list-group-flush h-100">
            <li id="emptyState" class="list-group-item text-muted d-flex flex-column justify-content-center align-items-center h-100">
                <i class="bi bi-folder2-open mb-2" style="font-size: 3rem;"></i>
                <p class="mb-3">No attachments selected</p>
            </li>
            </ul>
        </div>


        <div class="mt-3">
        <button type="submit" class="btn btn-danger rounded-4 px-4">
            <i class="bi bi-check-circle me-2"></i> Create Post
        </button>
        <a href="course.php?id=<?php echo isset($_GET['id']) ? intval($_GET['id']) : 0; ?>" type="button" class="btn btn-outline-danger rounded-4 px-4">
            Cancel
        </a>
        </div>
    </div>

      </div>
    </div>
    </div>

    <!-- Action Buttons -->
</form>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Initialize CKEditor
  ClassicEditor
    .create(document.querySelector('#description'), {
      toolbar: ['heading','bold','italic','underline','bulletedList','numberedList','undo','redo'],
      heading: {
        options: [
          { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
          { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
          { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
          { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
        ]
      }
    })
    .then(editor => { window.descriptionEditor = editor; })
    .catch(error => { console.error(error); });

  // File attachment preview
  const attachments = document.getElementById("attachments");
  const fileList = document.getElementById("fileList");
  const emptyState = document.getElementById("emptyState");

  attachments.addEventListener("change", function () {
    fileList.innerHTML = "";
    if (this.files.length === 0) {
      fileList.innerHTML = `<li id="emptyState" class="list-group-item text-muted text-center">
          <i class="bi bi-folder2-open me-2"></i>No attachments selected
        </li>`;
      return;
    }
    [...this.files].forEach(file => {
      const li = document.createElement("li");
      li.className = "list-group-item d-flex align-items-center";
      li.innerHTML = `<i class="bi bi-file-earmark me-2"></i> ${file.name}`;
      fileList.appendChild(li);
    });
  });
});
</script>


