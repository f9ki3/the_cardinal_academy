<div class="tab-pane rounded fade rounded-4 show p-3 bg-white" id="stream" role="tabpanel" aria-labelledby="stream-tab">
<?php
if (isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    $q = isset($_GET['q']) ? trim($_GET['q']) : '';

    // --- fetch post ---
    if (!empty($q)) {
        $post_sql = "
            SELECT id, course_id, teacher_id, title, description, video_link, attachment, created_at
            FROM posts
            WHERE id = ?
            AND (title LIKE ? OR description LIKE ?)
            LIMIT 1
        ";
        $post_stmt = $conn->prepare($post_sql);
        if ($post_stmt) {
            $like = "%" . $q . "%";
            $post_stmt->bind_param("iss", $post_id, $like, $like);
        }
    } else {
        $post_sql = "
            SELECT id, course_id, teacher_id, title, description, video_link, attachment, created_at
            FROM posts
            WHERE id = ?
            LIMIT 1
        ";
        $post_stmt = $conn->prepare($post_sql);
        if ($post_stmt) {
            $post_stmt->bind_param("i", $post_id);
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
            $post = $posts->fetch_assoc();
            // --- display the post ---
            echo '<div class="mb-3 border-0">
                    <div>
                        <h5 class="card-title fw-bolder mb-1">' . htmlspecialchars($post['title']) . '</h5>
                        <p class="card-text small text-muted mb-1">' . date("M d, Y h:i A", strtotime($post['created_at'])) . '</p>
                        <hr>
                        <div class="card-text" style="max-width: 100%; word-wrap: break-word;">' . $post['description'] . '</div>
                        <div class="mt-2">';
            
            // --- Video ---
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

            // --- Attachments ---
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

            echo '</div></div></div>';
        } else {
            // --- BEAUTIFUL "Post Not Found" CARD ---
            echo '<div class="text-center my-5">
                    <div class="card mx-auto p-4" style="max-width: 500px; border-radius: 15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 50px; margin-bottom: 15px;"></i>
                        <h5 class="fw-bold text-danger mb-3">Post Not Found</h5>
                        <p class="text-muted mb-4">The post may have been removed by the teacher or does not exist.</p>
                        <a href="course.php?id=' . intval($course_id) . '" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-arrow-left-circle me-2"></i> Back to Stream
                        </a>
                    </div>
                  </div>';
        }

        $post_stmt->close();
    }
} else {
    echo '<p class="text-muted">No post selected.</p>';
}
?>
</div>
