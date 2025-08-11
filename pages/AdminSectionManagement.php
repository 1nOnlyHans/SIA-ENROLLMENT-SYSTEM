<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-content-center">
                    <h2>Section and Schedule Management</h2>
                    <!-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddSection">
                        + New Section
                    </button> -->
                </div>
            </div>
        </div>

        <form method="post" id="sectionScheduleForm">
            <!-- Section Info Card -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="course_id" class="form-label">Course</label>
                                <select name="course_id" id="course_id" class="form-control find_subj" required>
                                    <option value="" selected> --Select Course--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="school_year" class="form-label">School Year</label>
                                <select name="school_year" id="school_year" class="form-control">
                                    <option value="" selected> --Select School Year-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="year_lvl" class="form-label">Year Level</label>
                                <select name="year_lvl" id="year_lvl" class="form-control find_subj" required>
                                    <option value="" selected>--Select Year level--</option>
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                                    <option value="3">3rd</option>
                                    <option value="4">4th</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="semester" id="semester" class="form-control find_subj" required>
                                    <option value="" selected>--Select Semester--</option>
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="section_code" class="form-label">Section Name</label>
                                <input type="text" name="section_code" id="section_code" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="section_type" class="form-label">Section Type</label>
                                <select name="section_type" id="section_type" class="form-control" required>
                                    <option value="" selected> --Select Section--</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subjects & Schedule Card -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Type</th>
                                <th>Instructor</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody id="subjects-tbl">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" id="createSecNSched" class="btn btn-primary" disabled>
                    Save Section & Schedule
                </button>
            </div>

        </form>
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

        const fetchSchoolYears = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/AcademicSettings.php?actionType=GetAllSchoolYear",
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.id).text(data.SY)
                        return option;
                    });
                    const select = $('#school_year');
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }
        const fetchSubjects = () => {

            const course_id = $('#course_id').val();
            const school_year = $('#school_year').val();
            const year_lvl = $('#year_lvl').val();
            const semester = $('#semester').val();

            $.ajax({
                method: "POST",
                url: "../Actions/Curriculum.php?actionType=GetSubjectsByCourseAndLevel",
                data: {
                    course_id: course_id,
                    school_year: school_year,
                    year_lvl: year_lvl,
                    semester: semester
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    const container = $('#subjects-tbl');
                    console.log(response);
                    if (response.status === "success") {
                        const subjects = response.data.map((subject) => {
                            let type = subject.type.split(',');
                            let cell = type.map((type) => `
                                <tr>
                                    <td>${subject.subject_code}</td>
                                    <td>${subject.subject_name}</td>
                                    <td>${type}</td>
                                    <td>
                                        <input type="hidden" name="subject_id[]" id="subject_id" value="${subject.subject_id}">
                                        <input type="hidden" name="subject_type[]" id="subject_type" value="${type}">
                                        <input type="text" name="instructor[]" class="form-control" placeholder="Instructor" required>
                                    </td>
                                    <td>
                                        <select name="day[${subject.subject_id}][${type}][]" class="form-select day" multiple required>
                                            <option value=""> --Select Day--</option>
                                            <option value="M">M</option>
                                            <option value="T">T</option>
                                            <option value="W">W</option>
                                            <option value="TH">TH</option>
                                            <option value="F">F</option>
                                            <option value="S">S</option>
                                            <option value="SU">SU</option>
                                        </select>
                                    </td>
                                    <td><input type="time" name="start_time[]" class="form-control" required></td>
                                    <td><input type="time" name="end_time[]" class="form-control" required></td>
                                    <td><input type="text" name="room[]" class="form-control" placeholder="Room" required></td>
                                </tr>
                            `).join("");
                            return cell;
                        });
                        container.empty();
                        container.append(subjects.join(""));
                        $('#createSecNSched').prop('disabled', false);
                        $('.day').select2({
                            width: '100px'
                        });
                    } else {
                        container.empty();
                        $('#createSecNSched').prop('disabled', true);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
        //==================================================
        $('.find_subj').on('input', function() {
            if ($(this).val() !== "") {
                fetchSubjects();
            }
        });

        $('#sectionScheduleForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/Section.php?actionType=Test",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status === "success") {
                        $('#sectionScheduleForm')[0].reset();
                        fetchSubjects();
                        Swal.fire({
                            icon: "success",
                            title: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: response.message
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            })
            console.log("TEST");
        });

        fetchAvailableCourse();
        fetchSchoolYears();
    });
</script>