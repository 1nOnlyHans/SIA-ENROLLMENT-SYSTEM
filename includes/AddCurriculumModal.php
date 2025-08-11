<div class="modal fade" id="AddCurriculum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Curriculum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="create-curriculum-form">
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course</label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value=""> --Select Course-- </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="curriculum_name">Name</label>
                        <input type="text" name="curriculum_name" id="curriculum_name" class="form-control" placeholder="Enter Curriculum Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="sy" class="form-label">Select School Year</label>
                        <select name="sy" id="sy" class="form-select" required>
                            <option value="" selected> --Select School Year-- </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Select Subjects</label>
                        <select name="subject_id[]" id="subject_id" class="form-select" multiple required>
                            <option value=""> --Select Subjects-- </option>
                        </select>
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

        const fetchAllCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/CourseController.php?actionType=GetAllCourse",
                    dataType: "json"
                });
                if (response.status === "success") {

                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.id).text(data.course_name)
                        return option;
                    });
                    const select = $('#course_id');
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchAllCourse();

        const fetchActiveSchoolYear = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/AcademicSettings.php?actionType=GetActiveSchoolYear",
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    const school_year_selection = $('#sy');

                    let school_year_options = $('<option></option>').val(response.data.id).text(response.data.SY);

                    school_year_selection.append(response.data !== false ? school_year_options : $('<option></option>').val("").text("No Active School Year"));
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchActiveSchoolYear();

        const fetchAllSubjects = async () => {
            var course_id = $('#course_id').val();
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/Subject.php?actionType=GetAllSubjects",
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    const select = $('#subject_id');
                    select.empty();
                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.id).text(data.subject_code + ' ' + data.subject_name)
                        return option;
                    });
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        $('#subject_id').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        });

        fetchAllSubjects();
    });
</script>