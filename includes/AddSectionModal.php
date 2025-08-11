<div class="modal fade" id="AddSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="create-section-form">
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-control">
                            <option value="" selected> --Select Course--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year Level</label>
                        <select name="year_lvl" id="year_lvl" class="form-control">
                            <option value="" selected>
                                --Select Year level--
                            </option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="section_code" class="form-label">Section Code</label>
                        <input type="text" name="section_code" id="section_code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="section_type" class="form-label">Section Type</label>
                        <select name="section_type" id="section_type" class="form-control">
                            <option value="" selected> --Select Section--</option>
                            <option value="">Morning</option>
                            <option value="">Afternoon</option>
                            <option value="">Evening</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sched">Proceed to Schedule Creation</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const fetchAvailableCourse = async () => {
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

        fetchAvailableCourse();
    });
</script>