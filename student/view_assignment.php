<?php 
include 'session_login.php';
include '../db_connection.php';

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$assignment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$student_id = $_SESSION['user_id'] ?? null;

// Fetch assignment details
$stmt = $conn->prepare("
    SELECT a.assignment_id, a.title, a.instructions, a.accept, a.points, a.due_date, a.due_time, 
           a.teacher_id, a.course_id, a.attachment, a.created_at,
           c.course_name
    FROM assignments a
    JOIN courses c ON a.course_id = c.id
    WHERE a.assignment_id = ? AND a.course_id = ?
");
$stmt->bind_param("ii", $assignment_id, $course_id);
$stmt->execute();
$result = $stmt->get_result();
$assignment = $result->fetch_assoc();

// Fetch student submission if exists
$submission = null;
if ($student_id) {
    $stmt2 = $conn->prepare("
        SELECT submission_id, student_id, assignment_id, submission_date, 
               file_path, file_url, grade, feedback
        FROM assignment_submissions
        WHERE assignment_id = ? AND student_id = ?
        LIMIT 1
    ");
    $stmt2->bind_param("ii", $assignment_id, $student_id);
    $stmt2->execute();
    $submission = $stmt2->get_result()->fetch_assoc();
}
$isClosed = (int)$assignment['accept'] === 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Turn in Assignment</title>
<?php include 'header.php'; ?>
<style>
    .rounded-circle:hover { background-color: rgb(240, 249, 255) !important; }
    .turn-in-btn { background-color: rgb(218, 64, 64); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    .turn-in-btn:hover { background-color: rgb(168, 54, 54); }
    .submission-box { box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px; border-radius: 15px; background-color: #fff; }
    .list-group-item:hover { background-color: #f8f9fa; }
</style>
</head>
<body>
<div class="d-flex flex-row bg-light">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
  <div class="row submission-box g-3">
    <!-- Assignment Details -->
    <div class="col-12 col-md-7">
      <?php if ($assignment): ?>
        <h3 class="fw-bolder"><?= htmlspecialchars($assignment['course_name']) ?> - <?= htmlspecialchars($assignment['title']) ?></h3>
        <p class="p-0 m-0 text-muted">Created: <?= date("F d, Y, h:i A", strtotime($assignment['created_at'])) ?></p>
        <div class="d-flex justify-content-between m-0 p-0">
          <p class="text-muted">Due: <?= date("F d, Y h:i A", strtotime($assignment['due_date'].' '.$assignment['due_time'])) ?></p>
          <p class="text-muted">Points: <?= htmlspecialchars($assignment['points']) ?></p>
        </div>
        <hr>
        <h5>Instructions:</h5>
        <p class="text-muted"><?= nl2br(htmlspecialchars($assignment['instructions'])) ?></p>
        <h5>Attachment:</h5>
        <?php if (!empty($assignment['attachment'])): 
        // If you have multiple attachments stored as JSON array
        $attachments = json_decode($assignment['attachment'], true);
        if (!$attachments) $attachments = [$assignment['attachment']]; // fallback to single
        ?>
        <div class="row g-3">
            <?php foreach($attachments as $file): 
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $icon = "bi-file-earmark";
                if(in_array($ext, ["png","jpg","jpeg"])) $icon = "bi-file-earmark-image text-warning";
                if($ext === "pdf") $icon = "bi-file-earmark-pdf text-danger";
                if(in_array($ext, ["doc","docx"])) $icon = "bi-file-earmark-word text-primary";
                if(in_array($ext, ["ppt","pptx"])) $icon = "bi-file-earmark-ppt text-warning";
                if(in_array($ext, ["xls","xlsx"])) $icon = "bi-file-earmark-excel text-success";
            ?>
            <div class="col-md-6">
                <a href="download_file.php?file=<?= urlencode($file) ?>" target="_blank" 
                  class="d-flex bg-white align-items-center border rounded-4 p-3 text-decoration-none text-dark hover-shadow">
                    <i class="bi <?= $icon ?> fs-3 me-3"></i>
                    <span class="text-truncate" style="max-width:200px;" title="<?= htmlspecialchars(basename($file)) ?>">
                        <?= htmlspecialchars(basename($file)) ?>
                    </span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p class="text-muted">No attachment available.</p>
        <?php endif; ?>

      <?php else: ?>
        <p class="text-danger">Assignment not found.</p>
      <?php endif; ?>
    </div>

    <!-- Submission Section -->
    <div class="col-12 col-md-5">
      <div class="pb-4">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-3 mt-3">Your Work:</h5>
          <?php if($isClosed): ?>
            <p class="text-danger mb-0">Submission Closed</p>
          <?php endif; ?>
        </div>

        <?php if ($submission): ?>
          <!-- Show submitted assignment -->
          <p><strong>Submitted on:</strong> <?= date("F d, Y h:i A", strtotime($submission['submission_date'])) ?></p>
          <?php if (!empty($submission['file_path'])): 
            $files = json_decode($submission['file_path'], true);
          ?>
            <h6>Files:</h6>
            <ul class="list-group mb-3">
              <?php foreach($files as $file): 
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $icon = "bi-file-earmark text-secondary";
                if(in_array($ext, ["png","jpg","jpeg"])) $icon="bi-file-earmark-image text-warning";
                if($ext==="pdf") $icon="bi-file-earmark-pdf text-danger";
                if(in_array($ext, ["doc","docx"])) $icon="bi-file-earmark-word text-primary";
                if(in_array($ext, ["ppt","pptx"])) $icon="bi-file-earmark-ppt text-warning";
                if(in_array($ext, ["xls","xlsx"])) $icon="bi-file-earmark-excel text-success";
                $filename = htmlspecialchars(basename($file));
              ?>
                <li class="list-group-item d-flex align-items-center" style="cursor:pointer;"
                    onclick="window.open('../static/uploads/<?= htmlspecialchars($file) ?>', '_blank')">
                  <i class="bi <?= $icon ?> me-2"></i>
                  <?= $filename ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if (!empty($submission['file_url'])): ?>
            <p><strong>URL:</strong> <a href="<?= htmlspecialchars($submission['file_url']) ?>" target="_blank"><?= htmlspecialchars($submission['file_url']) ?></a></p>
          <?php endif; ?>

          <p><strong>Grade:</strong> <?= $submission['grade'] ?? "Not graded yet" ?></p>
          <p><strong>Feedback:</strong> <?= !empty($submission['feedback']) ? nl2br(htmlspecialchars($submission['feedback'])) : "No feedback yet" ?></p>

          <!-- Unsubmit button if open -->
          <form action="unsubmit_assignment.php" method="POST" class="mt-3">
            <input type="hidden" name="assignment_id" value="<?= $assignment_id ?>" />
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="submission_id" value="<?= $submission['submission_id'] ?>" />
            <button type="submit" class="btn btn-outline-danger w-100" <?= $isClosed ? "disabled" : "" ?>>Unsubmit</button>
          </form>

        <?php else: ?>
          <!-- Submission form -->
          <form action="submit_assignment.php" method="POST" enctype="multipart/form-data" class="mt-3" id="submissionForm">
            <input type="hidden" name="assignment_id" value="<?= $assignment_id ?>" />
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />

            <div class="mb-3">
              <label for="submissionType" class="form-label text-muted">Submission Type</label>
              <select id="submissionType" name="submissionType" class="form-select" onchange="toggleSubmissionInput()" <?= $isClosed ? "disabled" : "" ?>>
                <option value="file">Attachment</option>
                <option value="url">URL</option>
              </select>
            </div>

            <div id="fileInputGroup" class="mb-3">
              <label for="fileInput" class="form-label">Upload Files</label>
              <input type="file" class="form-control" id="fileInput" name="fileInput[]" multiple <?= $isClosed ? "disabled" : "" ?>>
              <div id="filePreview" class="list-group mt-3" style="display:none; max-height:200px; overflow-y:auto;"></div>
            </div>

            <div id="urlInputGroup" class="mb-3 d-none">
              <label for="urlInput" class="form-label text-muted">Assignment URL</label>
              <input type="url" class="form-control" id="urlInput" name="urlInput" placeholder="https://example.com/your-work" <?= $isClosed ? "disabled" : "" ?>>
            </div>

            <button type="submit" class="btn btn-danger w-100" <?= $isClosed ? "disabled" : "" ?>>Turn In</button>
          </form>
          <script>
            document.getElementById("submissionForm").addEventListener("submit", function(e){
              const type = document.getElementById("submissionType").value;
              
              if(type === "file"){
                  const files = document.getElementById("fileInput").files;
                  if(!files || files.length === 0){
                      alert("Please select at least one file to submit.");
                      e.preventDefault(); // stop form submission
                      return false;
                  }
              } else if(type === "url"){
                  const url = document.getElementById("urlInput").value.trim();
                  if(url === ""){
                      alert("Please enter a URL for your submission.");
                      e.preventDefault(); // stop form submission
                      return false;
                  }
              }
          });

          </script>

        <?php endif; ?>
      </div>
    </div>


  </div>
</div>

</div>
</div>

<?php include 'footer.php'; ?>
<script>
// Toggle file/url input
function toggleSubmissionInput() {
  const type = document.getElementById("submissionType").value;
  document.getElementById("fileInputGroup").classList.toggle("d-none", type!=="file");
  document.getElementById("urlInputGroup").classList.toggle("d-none", type==="file");
}
document.addEventListener("DOMContentLoaded", toggleSubmissionInput);

// File preview & remove
let selectedFiles = [];
function syncFiles(){
  const dataTransfer = new DataTransfer();
  selectedFiles.forEach(f => dataTransfer.items.add(f));
  document.getElementById("fileInput").files = dataTransfer.files;
}
function renderPreview(){
  const preview = document.getElementById("filePreview");
  preview.innerHTML = "";
  if(selectedFiles.length>0){
      preview.style.display="block";
      selectedFiles.forEach((file,index)=>{
          let ext = file.name.split('.').pop().toLowerCase();
          let icon="bi-file-earmark";
          if(["png","jpg","jpeg"].includes(ext)) icon="bi-file-earmark-image text-warning";
          if(["pdf"].includes(ext)) icon="bi-file-earmark-pdf text-danger";
          if(["doc","docx"].includes(ext)) icon="bi-file-earmark-word text-primary";
          if(["ppt","pptx"].includes(ext)) icon="bi-file-earmark-ppt text-warning";
          if(["xls","xlsx"].includes(ext)) icon="bi-file-earmark-excel text-success";

          const item = document.createElement("div");
          item.className="list-group-item d-flex align-items-center justify-content-between";
          item.innerHTML = `<div class="d-flex align-items-center flex-grow-1">
                                <i class="bi ${icon} fs-5 me-2"></i>
                                <span class="text-truncate flex-grow-1" style="max-width:250px;" title="${file.name}">${file.name}</span>
                            </div>
                            <button type="button" class="btn btn-sm text-muted ms-2" onclick="removeFile(${index})"><i class="bi bi-trash"></i></button>`;
          preview.appendChild(item);
      });
  } else { preview.style.display="none"; }
}
function removeFile(index){
  selectedFiles.splice(index,1);
  syncFiles();
  renderPreview();
}
document.getElementById("fileInput").addEventListener("change",function(){
  selectedFiles = Array.from(this.files);
  syncFiles();
  renderPreview();
});
</script>
</body>
</html>
