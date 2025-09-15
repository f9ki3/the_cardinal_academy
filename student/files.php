<div class="tab-pane rounded fade show active" id="stream" role="tabpanel" aria-labelledby="stream-tab">
<?php
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);

    // Fetch posts with attachments only
    $stmt = $conn->prepare("
        SELECT id, attachment
        FROM posts
        WHERE course_id = ?
        AND attachment IS NOT NULL
        AND attachment <> '[]'
        ORDER BY created_at DESC
    ");
    if (!$stmt) {
        echo '<p class="text-danger">SQL Error (post attachments): ' . htmlspecialchars($conn->error) . '</p>';
    } else {
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $posts = $stmt->get_result();

        function getFileIcon($filename) {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            switch ($ext) {
                case 'pdf': return 'bi bi-file-earmark-pdf text-danger';
                case 'doc': case 'docx': return 'bi bi-file-earmark-word text-primary';
                case 'xls': case 'xlsx': case 'csv': return 'bi bi-file-earmark-excel text-success';
                case 'ppt': case 'pptx': return 'bi bi-file-earmark-ppt text-warning';
                case 'zip': case 'rar': return 'bi bi-file-earmark-zip text-secondary';
                case 'jpg': case 'jpeg': case 'png': case 'gif': return 'bi bi-file-earmark-image text-info';
                default: return 'bi bi-file-earmark';
            }
        }

        if ($posts && $posts->num_rows > 0) {
            echo '<div class="list-group mb-3">';
            while ($post = $posts->fetch_assoc()) {
                $attachments = json_decode($post['attachment'], true);
                if (is_array($attachments) && count($attachments) > 0) {
                    foreach ($attachments as $file) {
                        $file = trim($file);
                        if ($file === '') continue;
                        $icon = getFileIcon($file);
                        echo '<a href="../static/uploads/' . htmlspecialchars($file) . '" 
                                 download 
                                 class="list-group-item list-group-item-action d-flex align-items-center">';
                        echo '  <i class="' . $icon . ' me-3" style="font-size:1.5rem;"></i>';
                        echo '  <span>' . htmlspecialchars($file) . '</span>';
                        echo '</a>';
                    }
                }
            }
            echo '</div>';
        } else {
            echo '<p class="text-center text-muted">No attachments found for this course.</p>';
        }

        $stmt->close();
    }
} else {
    echo '<p class="text-muted">No course selected.</p>';
}
?>
</div>
