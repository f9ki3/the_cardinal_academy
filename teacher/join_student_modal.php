<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createStudentModalLabel">Join Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="studentSearch" class="form-label">Search Student</label>
                    <input type="text" class="form-control" id="studentSearch" placeholder="Type student name or email...">
                </div>

                <form action="join_student_save.php" method="POST" id="joinStudentForm">
                    <input type="hidden" name="course_id" value="<?= $course_id ?>">
                    <div id="studentResults" class="list-group" style="max-height: 300px; overflow-y: auto;">
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
    const studentSearchInput = document.getElementById('studentSearch');
    const studentResultsContainer = document.getElementById('studentResults');
    const createStudentModal = document.getElementById('createStudentModal');
    let allStudents = []; // Store the full list of students

    // Function to render students based on a filtered list
    const renderStudents = (studentsToRender) => {
        studentResultsContainer.innerHTML = ''; // Clear previous results
        if (studentsToRender.length > 0) {
            studentsToRender.forEach(student => {
                const item = document.createElement('label');
                item.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'justify-content-between', 'py-2');
                
                // Left side (Profile and info)
                const leftContent = document.createElement('div');
                leftContent.classList.add('d-flex', 'align-items-center', 'gap-3');
                
                const profileImage = document.createElement('img');
                const profilePicPath = student.profile_picture && student.profile_picture !== '' 
                    ? `../static/uploads/${student.profile_picture}` 
                    : `../static/uploads/dummy.jpg`;
                profileImage.src = profilePicPath;
                profileImage.alt = 'Profile';
                profileImage.classList.add('rounded-circle');
                profileImage.style.width = '40px';
                profileImage.style.height = '40px';
                profileImage.style.objectFit = 'cover';
                
                const info = document.createElement('div');
                info.innerHTML = `
                    <p class="mb-0 fw-semibold">${student.first_name} ${student.last_name}</p>
                    <small class="text-muted">${student.email}</small>
                `;

                leftContent.appendChild(profileImage);
                leftContent.appendChild(info);

                // Right side (Checkbox)
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'form-check-input';
                checkbox.name = 'student_ids[]';
                checkbox.value = student.user_id;

                item.appendChild(leftContent);
                item.appendChild(checkbox);

                studentResultsContainer.appendChild(item);
            });
        } else {
            studentResultsContainer.innerHTML = '<div class="text-muted py-2">No students found.</div>';
        }
    };

    // Event listener for when the modal is shown
    createStudentModal.addEventListener('shown.bs.modal', function() {
        // Fetch all students immediately when the modal opens
        fetch('search_students.php?q=') // Passing an empty query string to fetch all students
            .then(res => res.json())
            .then(data => {
                allStudents = data; // Store the full list
                renderStudents(allStudents); // Render all students initially
            })
            .catch(err => {
                console.error('Error:', err);
                studentResultsContainer.innerHTML = '<div class="text-danger py-2">Error loading students.</div>';
            });
    });

    // Event listener for the search input
    studentSearchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        
        // Client-side filtering
        const filteredStudents = allStudents.filter(student => {
            const fullName = `${student.first_name} ${student.last_name}`.toLowerCase();
            const email = student.email.toLowerCase();
            return fullName.includes(query) || email.includes(query);
        });

        renderStudents(filteredStudents);
    });
</script>