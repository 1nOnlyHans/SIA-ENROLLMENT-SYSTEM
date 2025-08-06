<div class="modal fade" id="AddSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="create-subject-form">
                    <!-- <input type="hidden" name="actionType" id="actionType" class="form-control" value="CreateSubject"> -->
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value="" disabled selected> --Select Subject Course--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject_code" class="form-label">Subject Code</label>
                        <input type="text" name="subject_code" id="subject_code" class="form-control" placeholder="Enter Subject Code" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Subject Title</label>
                        <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="Enter Subject Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="pre_requisite" class="form-label">Pre Requisite</label>
                        <select name="pre_requisite" id="pre_requisite" class="form-select">
                            <option value="" disabled selected> --Select Subject Pre-Requisite --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="units" class="form-label">Type</label>
                        <select name="type[]" id="type" class="form-select" multiple required>
                            <option value="" disabled selected> --Select Subject Course--</option>
                            <option value="Lab">Laboratory</option>
                            <option value="Lec">Lecture</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lab_units" class="form-label">Number of Laboratory Units</label>
                        <input type="number" name="lab_units" id="lab_units" class="form-control units" placeholder="ex. 3" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="lec_units" class="form-label">Number of Lecture Units</label>
                        <input type="number" name="lec_units" id="lec_units" class="form-control units" placeholder="ex. 3" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="year_lvl" class="form-label">Year Level</label>
                        <select name="year_lvl" id="year_lvl" class="form-select" required>
                            <option value="" disabled selected> --Select Year Level--</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select name="semester" id="semester" class="form-select" required>
                            <option value="" disabled selected> --Select Semester--</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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

        const fetchAllSubjectByCourse = async () => {
            var course_id = $('#course_id').val();
            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Actions/Subject.php?actionType=GetAllSubjectByCourse",
                    data: {
                        course_id: course_id
                    },
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.subject_code).text(data.subject_name)
                        return option;
                    });
                    const select = $('#pre_requisite');
                    select.empty();
                    select.append('<option value="" disabled selected> -- Select Subject Pre-Requisite --</option>');
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        $('#course_id').on('change', function() {
            fetchAllSubjectByCourse();
        });

        $('#type').on('change', function() {
            const selectedVal = $(this).val();
            if (selectedVal && selectedVal.includes("Lab")) {
                $('#lab_units').removeAttr('disabled');
            } else {
                $('#lab_units').val('');
                $('#lab_units').prop('disabled', true);
                $('#lab_units').prop('required', true);
            }

            if (selectedVal && selectedVal.includes("Lec")) {
                $('#lec_units').removeAttr('disabled');
            } else {
                $('#lec_units').val('');
                $('#lec_units').prop('disabled', true);
                $('#lec_units').prop('required', true);
            }
        });
    });
</script>