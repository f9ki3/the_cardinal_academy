<div class="tab-pane rounded fade show active" id="stream" role="tabpanel" aria-labelledby="stream-tab">
<?php
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);
    $q = isset($_GET['q']) ? trim($_GET['q']) : '';

    // --- fetch course ---
    $stmt = $conn->prepare("
        SELECT course_name, subject, description, cover_photo, day, start_time, end_time, section, room
        FROM courses
        WHERE id = ?
    ");
    if (!$stmt) {
        echo '<p class="text-danger">SQL Error (course): ' . htmlspecialchars($conn->error) . '</p>';
    } else {
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($course = $result->fetch_assoc()) {
            $cover = !empty($course['cover_photo'])
                ? "../static/uploads/" . htmlspecialchars($course['cover_photo'])
                : "../static/images/Classroom High School.jpg";

            // --- course header / cover ---
            echo '
            <div class="card border-0 rounded-4 overflow-hidden mb-3">
              <div class="position-relative">
                <img src="' . $cover . '" class="w-100" alt="Course Cover" style="height:250px; object-fit:cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity:0.8;"></div>
                <div class="position-absolute bottom-0 start-0 w-100 text-white p-4">
                  <h1 class="mb-1">' . htmlspecialchars($course['course_name']) . '</h1>
                  <h6 class="fw-normal mb-2">' . htmlspecialchars($course['subject']) . ' • Section ' . htmlspecialchars($course['section']) . '</h6>';

            if (!empty($course['description'])) {
                echo '<div class="small text-light mb-2">' . $course['description'] . '</div>';
            }

            echo '
                  <div class="d-flex mb-3 flex-wrap small">
                    <span class="me-3"><i class="bi bi-calendar-event me-1"></i>' . htmlspecialchars($course['day']) . '</span>
                    <span class="me-3"><i class="bi bi-clock me-1"></i>' . date("h:i A", strtotime($course['start_time'])) . ' - ' . date("h:i A", strtotime($course['end_time'])) . '</span>
                    <span><i class="bi bi-door-open me-1"></i>Room ' . htmlspecialchars($course['room']) . '</span>
                  </div>
                </div>
              </div>

              

              <div class="p-3">
            ';

            // --- alerts ---
            $alert_message = '';
            $alert_type = '';

            if (isset($_GET['success'])) {
                switch ($_GET['success']) {
                    case '2':
                        $alert_message = 'The post has been removed.';
                        $alert_type = 'danger';
                        break;
                    case '1':
                        $alert_message = 'The class has been added.';
                        $alert_type = 'success';
                        break;
                }
            }

            if (!empty($alert_message)) {
                echo '<div class="alert alert-' . $alert_type . ' alert-dismissible mx-2 fade show rounded-4" role="alert">'
                    . $alert_message .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            // --- fetch posts ---
            if (!empty($q)) {
                $post_sql = "
                    SELECT id, title, description, video_link, attachment, teacher_id, created_at
                    FROM posts
                    WHERE course_id = ?
                    AND (title LIKE ? OR description LIKE ?)
                    ORDER BY created_at DESC
                ";
                $post_stmt = $conn->prepare($post_sql);
                if ($post_stmt) {
                    $like = "%" . $q . "%";
                    $post_stmt->bind_param("iss", $course_id, $like, $like);
                }
            } else {
                $post_sql = "
                    SELECT id, title, description, video_link, attachment, teacher_id, created_at
                    FROM posts
                    WHERE course_id = ?
                    ORDER BY created_at DESC
                ";
                $post_stmt = $conn->prepare($post_sql);
                if ($post_stmt) {
                    $post_stmt->bind_param("i", $course_id);
                }
            }

            if ($post_stmt) {
                $post_stmt->execute();
                $posts = $post_stmt->get_result();

                function getFileIcon($filename) {
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    switch ($ext) {
                        case 'pdf': return 'bi bi-file-earmark-pdf text-danger';
                        case 'doc': case 'docx': return 'bi bi-file-earmark-word text-primary';
                        case 'xls': case 'xlsx': case 'csv': return 'bi bi-file-earmark-excel text-success';
                        case 'ppt': case 'pptx': return 'bi bi-file-earmark-ppt text-warning';
                        case 'zip': case 'rar': return 'bi bi-file-earmark-zip text-secondary';
                        case 'jpg': case 'jpeg': case 'png': case 'gif': return 'bi bi-file-earmark-image text-info';
                        case 'mp4': case 'mov': return 'bi bi-file-earmark-play text-dark';
                        default: return 'bi bi-file-earmark';
                    }
                }

                if ($posts && $posts->num_rows > 0) {
                    while ($post = $posts->fetch_assoc()) {
                        echo '
                        <div class="card mb-3 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1 p-4 border">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="card-title fw-bolder mb-1">' . htmlspecialchars($post['title']) . '</h5>
                                            <div class="d-flex gap-2">
                                                 <a href="view_post.php?post_id=' . $post['id'] . '&id=' . $course_id . '" class="btn btn-sm rounded-circle border-0" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>';
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['teacher_id']) {
                            echo '
                                                <a href="delete_post.php?id=' . $post['id'] . '&course_id=' . $course_id . '" class="btn btn-sm rounded-circle border-0" onclick="return confirm(\'Delete this post?\')" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>';
                        }

                        echo '
                                            </div>
                                        </div>
                                        <p class="card-text small text-muted mb-1">' . date("M d, Y h:i A", strtotime($post['created_at'])) . '</p>
                                        <hr>
                                        <div class="card-text" style="max-width: 100vh; word-wrap: break-word;">' . $post['description'] . '</div>
                                        <div class="mt-2">';
                        // Video
                        if (!empty($post['video_link'])) {
                            $video_url = $post['video_link'];
                            $embed_url = $video_url;
                            if (preg_match('/youtu\.be\/([^\?&]+)/', $video_url, $matches)) {
                                $embed_url = "https://www.youtube.com/embed/" . $matches[1];
                            } elseif (preg_match('/v=([^\?&]+)/', $video_url, $matches)) {
                                $embed_url = "https://www.youtube.com/embed/" . $matches[1];
                            }
                            echo '<div class="ratio ratio-16x9 my-2">
                                    <iframe src="' . htmlspecialchars($embed_url) . '" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                                  </div>';
                        }

                        // Attachments
                        if (!empty($post['attachment'])) {
                            $attachments = json_decode($post['attachment'], true);
                            if (is_array($attachments) && count($attachments) > 0) {
                                echo '<div class="mb-2"><p class="fw-bold mb-1">Attachments:</p></div>';
                                echo '<div class="d-flex flex-wrap gap-2">';
                                foreach ($attachments as $file) {
                                    $file = trim($file);
                                    if ($file === '') continue;

                                    $icon = getFileIcon($file);
                                    echo '<div class="p-2 border rounded bg-light d-flex align-items-center" style="min-width:200px; max-width:250px;">
                                            <i class="' . $icon . ' me-2" style="font-size:1.5rem;"></i>
                                            <a href="../static/uploads/' . htmlspecialchars($file) . '" download class="text-muted text-decoration-none text-truncate" style="max-width:180px;">
                                                ' . htmlspecialchars($file) . '
                                            </a>
                                        </div>';
                                }
                                echo '</div>';
                            }
                        }


                        echo '</div></div></div></div>';
                    }
                } else {
                    echo '<div class="d-flex flex-column justify-content-center align-items-center py-4">';
                    if (!empty($q)) {
                        echo '<p class="text-center mt-5 text-muted mb-3">No posts found for "<b>' . htmlspecialchars($q) . '</b>"</p>';
                    } else {
                        echo '<p class="text-center mt-5 text-muted mb-3">No posts yet. Be the first to create one!</p>';
                    }
                    echo '<img src="../static/images/art7.svg" alt="No records" style="max-width:300px; opacity:70%"></div>';
                }

                $post_stmt->close();
            }

            echo '</div></div>'; // close course card
        } else {
            echo '<p class="text-muted">Course not found.</p>';
        }

        $stmt->close();
    }
} else {
    echo '<p class="text-muted">No course selected.</p>';
}
?>
</div>

<!-- Modal (Create Post) -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="createPostModalLabel">Create New Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="createPostForm" action="save_post.php" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            
            <!-- Left Column -->
            <div class="col-12 col-md-6">
              <div class="mb-3">
                <label for="postTitle" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Content Description (optional)</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Brief post description"></textarea>
              </div>

              <!-- Video Link -->
              <div class="mb-3">
                <label for="videoLink" class="form-label">Video Link (optional)</label>
                <input type="url" class="form-control" id="videoLink" name="video_link" placeholder="Paste YouTube or video link">
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-12 col-md-6">
              <input type="hidden" name="course_id" value="<?php echo intval($_GET['id']); ?>">
              <input type="hidden" name="teacher_id" value="<?php echo $_SESSION['user_id']; ?>">

              <div class="mb-3">
                <label for="attachments" class="form-label">Attachments</label>
                <input class="form-control" type="file" id="attachments" name="attachments[]" multiple>
                <small class="text-muted">You can upload multiple files (PDF, images, docs, etc.)</small>

                <!-- Preview list with scroll -->
                <div style="max-height: 220px; overflow-y: auto;" class="border rounded mt-2 p-2">
                  <ul id="fileList" class="list-group list-group-flush h-100">
                    <li id="emptyState" class="list-group-item text-muted d-flex flex-column justify-content-center align-items-center h-100">
                      <i class="bi bi-folder2-open mb-2" style="font-size: 3rem;"></i>
                      No attachments selected
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="mt-3">
            <button type="submit" class="btn btn-danger rounded-4 px-4">
              <i class="bi bi-check-circle me-2"></i> Save Post
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


