<!-- Join Student Modal -->
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createStudentModalLabel">Join Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Search input -->
                <div class="mb-3">
                    <label for="studentSearch" class="form-label">Search Student</label>
                    <input type="text" class="form-control" id="studentSearch" placeholder="Type student name or email...">
                </div>

                <!-- Student results -->
                <form action="join_student_save.php" method="POST" id="joinStudentForm">
                    <input type="hidden" name="course_id" value="<?= $course_id ?>">
                    <div id="studentResults" class="list-group" style="max-height: 300px; overflow-y: auto;">
                        <div class="text-muted py-2"></div>
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-danger rounded-4 px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger rounded-4 px-4">
                            <i class="bi bi-check-circle me-2"></i> Join Selected Students
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.getElementById('studentSearch').addEventListener('input', function() {
    const query = this.value.trim();
    const resultsContainer = document.getElementById('studentResults');

    if(query.length === 0){
        resultsContainer.innerHTML = '<div class="text-muted py-2"></div>';
        return;
    }

    fetch('search_students.php?q=' + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {
        resultsContainer.innerHTML = '';
        if(data.length > 0){
            data.forEach(student => {
                const item = document.createElement('div');
                item.classList.add('list-group-item', 'd-flex', 'align-items-center');
                item.innerHTML = `
                    <input class="form-check-input me-2" type="checkbox" name="student_ids[]" value="${student.user_id}">
                    <div>
                        <p class="mb-0 fw-semibold">${student.first_name} ${student.last_name}</p>
                        <small class="text-muted">${student.email}</small>
                    </div>
                `;
                resultsContainer.appendChild(item);
            });
        } else {
            resultsContainer.innerHTML = '<div class="text-muted py-2">No students found</div>';
        }
    })
    .catch(err => {
        console.error('Error:', err);
        resultsContainer.innerHTML = '<div class="text-danger py-2">Error loading students</div>';
    });
});
</script>
