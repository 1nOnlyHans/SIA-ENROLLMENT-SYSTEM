<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="container-fluid">
            <h2 class="mb-4" id="title"></h2>
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Subject Details</span>
                    <button class="btn btn-light btn-sm" id="editBtn">Edit</button>
                </div>
                <div class="card-body">
                    <div id="details-container">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Course:</label>
                                <p class="form-control-plaintext" id="view-course-name"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Subject Code:</label>
                                <p class="form-control-plaintext" id="view-subject-code"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Subject Name:</label>
                                <p class="form-control-plaintext" id="view-subject-name"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Subject Pre Requisite:</label>
                                <p class="form-control-plaintext" id="view-subject-pre_requisite"></p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Lab Units:</label>
                                <p class="form-control-plaintext" id="view-subject-lab_units"></p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Lecture Units:</label>
                                <p class="form-control-plaintext" id="view-subject-lec_units"></p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Total Units:</label>
                                <p class="form-control-plaintext" id="view-subject-total_units"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Type:</label>
                                <p class="form-control-plaintext" id="view-subject-type"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Year Level:</label>
                                <p class="form-control-plaintext" id="view-subject-year_lvl"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Semester:</label>
                                <p class="form-control-plaintext" id="view-subject-semester"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status:</label>
                                <p class="form-control-plaintext" id="view-subject-status"></p>
                            </div>
                        </div>
                    </div>

                    <div class="d-none" id="edit-form-container">
                        <form method="post" id="edit-subject-form">
                            <input type="hidden" name="actionType" value="UpdateSubject">
                            <input type="hidden" name="subject_id" id="subject_id">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="course_id" class="form-label fw-bold">Course:</label>
                                    <select name="course_id" id="course_id" class="form-select" required></select>
                                </div>

                                <div class="col-md-6">
                                    <label for="subject_code" class="form-label fw-bold">Subject Code:</label>
                                    <input type="text" name="subject_code" id="subject_code" class="form-control" placeholder="Enter Subject Code" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="subject_name" class="form-label fw-bold">Subject Title</label>
                                    <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="Enter Subject Name" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="pre_requisite" class="form-label fw-bold">Subject Pre requisite:</label>
                                    <select name="pre_requisite[]" id="pre_requisite" class="form-select" multiple>
                                        <option value=""> --Select Pre-requisite --</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="type" class="form-label fw-bold">Subject Type:</label>
                                    <select name="type[]" id="type" class="form-select" multiple required>
                                        <option value=""> --Select Subject Type--</option>
                                        <option value="Lab">Laboratory</option>
                                        <option value="Lec">Lecture</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="lab_units" class="form-label">Number of Laboratory Units</label>
                                    <input type="number" name="lab_units" id="lab_units" class="form-control units" placeholder="ex. 3" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="lec_units" class="form-label">Number of Lecture Units</label>
                                    <input type="number" name="lec_units" id="lec_units" class="form-control units" placeholder="ex. 3" disabled>
                                </div>

                                <div class="col-mb-6">
                                    <label for="year_lvl" class="form-label">Year Level</label>
                                    <select name="year_lvl" id="year_lvl" class="form-select" required>
                                        <option value="" disabled selected> --Select Year Level--</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                    </select>
                                </div>

                                <div class="col-mb-6">
                                    <label for="semester" class="form-label">Semester</label>
                                    <select name="semester" id="semester" class="form-select" required>
                                        <option value="" disabled selected> --Select Semester--</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('subject_id');

        // ==============================
        // FETCH FUNCTIONS
        // ==============================

        const fetchAllCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/CourseController.php?actionType=GetAllCourse",
                    dataType: "json"
                });

                if (response.status === "success") {
                    const select = $('#course_id');
                    select.empty();

                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.id).text(data.course_name);
                        return option;
                    });

                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        };

        const fetchAllSubjectByCourse = async () => {
            var course_id = $('#course_id').val();

            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Actions/Subject.php?actionType=GetSubjectCoursePreRequisite",
                    data: {
                        course_id: course_id,
                        subject_id: id
                    },
                    dataType: "json"
                });

                console.log(response);

                if (response.status === "success") {
                    const select = $('#pre_requisite');
                    select.empty();
                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.subject_code).text(data.subject_name);
                        return option;
                    });

                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        };

        const fetchSubject = async () => {
            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Actions/Subject.php",
                    data: {
                        actionType: "GetSubjectById",
                        subject_id: id
                    },
                    dataType: "json"
                });

                console.log(response);

                if (response.status === "success") {
                    await fetchAllSubjectByCourse();
                    setValue(response.data);
                }
            } catch (error) {
                console.log(error);
            }
        };

        // ==============================
        // HELPERS
        // ==============================

        const setSelectedSubjectType = (type) => {
            const selectedType = type.split(',');
            return selectedType;
        };

        const setSelectedPre_requisites = (subject) => {
            const selectedSubject = subject.split(',');
            return selectedSubject;
        };

        const setValue = (data) => {
            const selectedType = setSelectedSubjectType(data.type);
            const selectedSubject = setSelectedPre_requisites(data.pre_requisite);

            $('#title').text(data.subject_name + " " + "(" + data.subject_code + ")");
            $('#subject_id').val(data.id);
            $('#view-course-name').text(data.course_name);
            $('#view-subject-code').text(data.subject_code);
            $('#view-subject-name').text(data.subject_name);
            $('#view-subject-pre_requisite').text(data.pre_requisite);
            $('#view-subject-lab_units').text(data.lab_units);
            $('#view-subject-lec_units').text(data.lec_units);
            $('#view-subject-total_units').text(data.total_units);
            $('#view-subject-type').text(data.type);
            $('#view-subject-year_lvl').text(data.year_lvl);
            $('#view-subject-semester').text(data.semester);
            $('#view-subject-status').text(data.status);

            $('#course_id').val(data.course_id);
            $('#subject_code').val(data.subject_code);
            $('#subject_name').val(data.subject_name);
            $('#pre_requisite').val(selectedSubject);
            $('#lab_units').val(Number(data.lab_units));
            $('#lec_units').val(Number(data.lec_units));
            $('#total_units').val(data.total_units);
            $('#type').val(selectedType);
            $('#year_lvl').val(data.year_lvl);
            $('#semester').val(data.semester);
            $('#status').val(data.status);

            toggleUnits();
        };

        const toggleUnits = (labVal, lecVal) => {
            const selectedVal = $('#type').val();

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
        };

        const toggleEditForm = () => {
            $('#details-container').hide();
            $('#edit-form-container').removeClass('d-none');
        };

        const toggleReadMode = () => {
            $('#details-container').show();
            $('#edit-form-container').addClass('d-none');
        };

        // ==============================
        // EVENT LISTENERS
        // ==============================

        $('#type').on('change', function() {
            toggleUnits();
        });

        $('#editBtn').on('click', function() {
            toggleEditForm();
        });

        $('#cancelBtn').on('click', function() {
            toggleReadMode();
        });

        $('#edit-subject-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "../Actions/Subject.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    if (response.status === "success") {
                        fetchSubject();
                        toggleReadMode();

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed",
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // ==============================
        // INIT
        // ==============================

        fetchAllCourse();
        fetchSubject();

        // ==============================
        // SELECT2
        // ==============================
        $('#pre_requisite').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        });

        $('#type').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        });
    });
</script>