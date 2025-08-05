<div class="modal fade" id="AddCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="create-course-form">
                    <input type="hidden" name="actionType" id="actionType" class="form-control" value="CreateCourse">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Select Department</label>
                        <select name="department_id" id="department_id" class="form-select" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="course_code">Code</label>
                        <input type="text" name="course_code" id="course_code" class="form-control" placeholder="Enter Course Code" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_name">Name</label>
                        <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Enter Course Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_description">Description</label>
                        <textarea type="text" name="course_description" id="course_description" class="form-control" placeholder="Enter Course Description" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const fetchDepartments = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/DepartmentController.php?actionType=GetAllDepartments",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    const select = $('#department_id');
                    let options = response.data.map((item) => {
                        let option = $('<option></option>').val(item.id).text(item.department_name);
                        return option;
                    });
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }
        fetchDepartments();
    });
</script>