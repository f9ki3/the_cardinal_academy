<?php
include '../db_connection.php'; // Ensure this sets up $conn

$show_terms_modal = false;
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($user_id > 0 && isset($conn)) {
    $stmt = $conn->prepare("SELECT agree FROM users WHERE user_id = ? AND agree = 0");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $show_terms_modal = true; // User has not agreed
    }

    // Debug (remove this after testing)
    echo "<!-- Debug: user_id = $user_id | show_terms_modal = " . ($show_terms_modal ? 'true' : 'false') . " -->";

    $stmt->close();
}

if (isset($conn)) {
    $conn->close();
}
?>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="termsModalLabel">Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>By using this system, you agree to the following terms and conditions:</p>
        <ul>
          <li>You must provide accurate and truthful information at all times.</li>
          <li>Any misuse or unauthorized activity may result in account suspension.</li>
          <li>The school or platform reserves the right to update these terms anytime.</li>
          <li>All activities may be monitored for compliance and security.</li>
        </ul>
        <p>Click <strong>Agree</strong> to continue using this platform.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Disagree</button>
        <button type="button" class="btn btn-success" id="agreeBtn">Agree</button>
      </div>
    </div>
  </div>
</div>

<?php if ($show_terms_modal): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  console.log("Modal should show now."); // Debug
  var myModal = new bootstrap.Modal(document.getElementById('termsModal'));
  myModal.show();
});
</script>
<?php else: ?>
<script>console.log("Modal not shown: agree != 0 or no user found.");</script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const agreeBtn = document.getElementById('agreeBtn');
  agreeBtn.addEventListener('click', function() {
    fetch('update_agree.php?id=<?php echo $user_id; ?>')
      .then(response => response.text())
      .then(data => {
        alert(data);
        location.reload();
      })
      .catch(error => console.error('Error:', error));
  });
});
</script>
