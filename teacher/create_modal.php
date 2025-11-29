<!-- Modal (Create Course) -->
<div class="modal fade" id="createCourseModal" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="createCourseModalLabel">Create New Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form action="save_course.php" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <!-- Left Column -->
            <div class="col-12 col-md-6">
              <div class="mb-3">
                <label for="courseName" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="courseName" name="course_name" placeholder="Enter course name" required>
              </div> 

              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Brief course description"></textarea>
              </div>

              <div class="mb-3">
                <label for="courseDay" class="form-label">Day</label>
                <select class="form-select" id="courseDay" name="day" required>
                  <option selected disabled>Choose a day</option>
                  <option>Everyday</option>
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
                  <option>Saturday</option>
                  <option>Sunday</option>
                </select>
              </div>

              <div class="row g-2 mb-3">
                <div class="col">
                  <label for="startTime" class="form-label">Start Time</label>
                  <input type="time" class="form-control" id="startTime" name="start_time" required>
                </div>
                <div class="col">
                  <label for="endTime" class="form-label">End Time</label>
                  <input type="time" class="form-control" id="endTime" name="end_time" required>
                </div>
              </div>

            </div>

            <!-- Right Column -->
            <div class="col-12 col-md-6">
              <div class="mb-3">
                <label for="grade_level" class="form-label">Grade Level</label>
                <select class="form-control" id="grade_level" name="grade_level" required>
                    <option value="" disabled selected>Select grade level</option>
                    <option value="Nursery">Nursery</option>
                    <option value="Kinder 1">Kinder 1</option>
                    <option value="Kinder 2">Kinder 2</option>
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>

              
              <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" placeholder="e.g. Section A, BSIT-2C" required>
              </div>

              <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="e.g. Mathematics, Science" required>
              </div>

              <div class="mb-3">
                <label for="room" class="form-label">Room</label>
                <input type="text" class="form-control" id="room" name="room" placeholder="e.g. Room 101, Lab 3" required>
              </div>

              <div class="mb-3">
                <label for="coverPhoto" class="form-label">Cover Photo</label>
                <input class="form-control" type="file" id="coverPhoto" name="cover_photo" accept="image/*">
                <small class="text-muted">Optional. Recommended size: 800x400px</small>
              </div>
            </div>
          </div>

          <div class=" mt-3">
            <button type="submit" class="btn btn-danger rounded-4 px-4">
              <i class="bi bi-check-circle me-2"></i> Save Course
            </button>
            <button type="submit" class="btn btn-outline-danger rounded-4 px-4 " data-bs-dismiss="modal" aria-label="Close">
               Cancel
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
