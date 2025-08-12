<?php
include "../includes/header.php";
include "../includes/RegistrarNavbar.php";
?>

<div class="d-flex">
    <?php include "../includes/sidebar.php"; ?>

    <main class="flex-grow-1 p-4 bg-light" style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-4">
                    <label for="name" class="form-label fw-semibold fs-6">Search Student by Name</label>
                    <select name="name" id="name" class="form-select"></select>
                </div>
            </div>

            <section class="mb-5 p-4 bg-white shadow-sm rounded">
                <h3 class="mb-4 text-primary fw-bold border-bottom pb-2">Student Information</h3>
                <input type="hidden" name="applicant_id" id="applicant_id" class="form-control">
                <div class="row gy-3">
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label d-flex align-items-center mb-1">
                            <span class="fw-semibold me-3" style="min-width: 110px;">Full Name:</span>
                            <input type="text" class="form-control flex-grow-1" id="student_name" readonly>
                        </label>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label d-flex align-items-center mb-1">
                            <span class="fw-semibold me-3" style="min-width: 110px;">Year Level:</span>
                            <input type="text" class="form-control flex-grow-1" id="student_year_level" readonly>
                        </label>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label d-flex align-items-center mb-1">
                            <span class="fw-semibold me-3" style="min-width: 110px;">Course:</span>
                            <input type="text" class="form-control flex-grow-1" id="student_course" readonly>
                        </label>
                    </div>
                </div>
            </section>

            <section class="mb-5 p-4 bg-white shadow-sm rounded">
                <div class="row g-3 mb-3">
                    <div class="col-md-6 col-lg-4">
                        <select name="course" id="course" class="form-select" disabled>
                            <option value="">-- Select Course --</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-8">
                        <select name="subjects" id="subjects" class="form-select" multiple disabled>

                        </select>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Credited Subjects</h5>
                    </div>
                    <div class="card-body p-3">
                        <div style="max-height: 220px; overflow-y: auto;">
                            <table class="table table-bordered table-striped mb-0 align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Status</th>
                                        <th>Code</th>
                                        <th>Equivalent</th>
                                        <th>Units</th>
                                    </tr>
                                </thead>
                                <tbody id="creditedSubjects"></tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-dark d-none" id="creditBtn">Credit Subject</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
<script>
    $(document).ready(function() {
        $('#name').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        })

        const fetchStudents = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/Applicant.php?actionType=GetSubjectCreditingStudents",
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    const select = $('#name');
                    select.empty();
                    let options = response.data.map((data) => {
                        let option = $('<option></option>').val(data.id).text(data.firstname + ' ' + data.lastname);
                        return option;
                    });
                    select.append($('<option></option>').val('').text('Select Student'));
                    select.append(options);
                }
            } catch (error) {
                console.error("Error fetching students:", error);
            }
        }
        fetchStudents();

        const fetchAvailableCourse = () => {
            $.ajax({
                method: "GET",
                url: "../Actions/CourseController.php?actionType=GetAllCourse",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status === "success") {
                        const select = $('#course');
                        select.empty();
                        let options = response.data.map((data) => {
                            return $('<option></option>')
                                .val(data.id)
                                .text(data.course_name);
                        });
                        select.append($('<option></option>').val('').text('Select Course'));
                        select.append(options);
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching courses:", xhr.responseText);
                }
            });
        }
        fetchAvailableCourse();
        $('#course').prop('disabled', true);
        $('#subjects').prop('disabled', true);

        // When student name changes
        $("#name").on("change", function() {
            const studentId = $(this).val();

            if (studentId) {
                // Enable course selection when a student is selected
                $('#course').prop('disabled', false);

                $.ajax({
                    method: "GET",
                    url: `../Actions/Applicant.php?actionType=GetApplicantById&id=${studentId}`,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            $('#student_name').val(response.data.firstname + ' ' + response.data.lastname);
                            $('#student_year_level').val(response.data.transferee_yr_level);
                            $('#student_course').val(response.data.course_code);
                            $('#applicant_id').val(response.data.id);
                        } else {
                            console.error("Error fetching student info:", response.message);
                            // Also disable dependent inputs if error
                            $('#course').prop('disabled', true).val('');
                            $('#subjects').prop('disabled', true).val(null).trigger('change');
                        }
                    },
                    error: function() {
                        $('#course').prop('disabled', true).val('');
                        $('#subjects').prop('disabled', true).val(null).trigger('change');
                    }
                });
            } else {
                // No student selected: disable course and subjects and clear values
                $('#course').prop('disabled', true).val('');
                $('#subjects').prop('disabled', true).val(null).trigger('change');
                $('#student_name').val('');
                $('#student_year_level').val('');
                $('#student_course').val('');
            }
        });

        // When course changes
        $('#course').on('change', function() {
            const course_id = $(this).val();

            if (course_id) {
                // Enable subjects select when course is selected
                $('#subjects').prop('disabled', false);

                $.ajax({
                    method: "POST",
                    url: "../Actions/Subject.php?actionType=test",
                    data: {
                        course_id: course_id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            const select = $('#subjects');
                            select.empty();
                            let options = response.data.map(data => {
                                let optionData = JSON.stringify({
                                    subject_id: data.subject_id,
                                    subject_code: data.subject_code,
                                    subject_name: data.subject_name,
                                    units: data.total_units
                                });
                                return $('<option></option>').val(optionData).text(data.subject_name);
                            });

                            select.append(options);
                        } else {
                            console.error("Error fetching subjects:", response.message);
                            $('#subjects').prop('disabled', true).val(null).trigger('change');
                        }
                    },
                    error: function() {
                        $('#subjects').prop('disabled', true).val(null).trigger('change');
                    }
                });
            } else {
                // No course selected: disable subjects and clear them
                $('#subjects').prop('disabled', true).val(null).trigger('change');
            }
        });
        $('#subjects').on('change', function() {
            const selectedSubjects = $(this).val();
            const container = $('#creditedSubjects');
            container.empty();
            if (!selectedSubjects || selectedSubjects.length === 0) {
                $('#creditBtn').addClass('d-none');
                return;
            } else {
                $('#creditBtn').removeClass('d-none');
            }

            const credited = selectedSubjects.map(sub => {
                let subjectData = JSON.parse(sub);
                return $('<tr></tr>')
                    .append($('<td></td>').text('Credited'))
                    .append($('<td></td>').text(subjectData.subject_code))
                    .append($('<td></td>').text(subjectData.subject_name))
                    .append($('<td></td>').text(subjectData.units));
            });
            container.append(credited);
        });

        $('#creditBtn').on('click', function() {
            const applicantId = $('#applicant_id').val();
            const creditedSubjects = [];
            const selectedSubjects = $('#subjects').val();
            selectedSubjects.forEach(sub => {
                let subjectData = JSON.parse(sub);
                creditedSubjects.push(subjectData.subject_id);
            });

            if (creditedSubjects.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Subjects Selected',
                    text: 'Please select subjects to credit.'
                });
                return;
            } else {
                $.ajax({
                    method: "POST",
                    url: "../Actions/Evaluation.php?actionType=SaveCreditedSubject",
                    data: {
                        applicant_id: applicantId,
                        credited_subjects: creditedSubjects
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Subjects Credited',
                                text: response.message
                            });

                            //Print
                            setTimeout(() => {
                                window.location.href = "../GenerateCreditSubSlip.php?applicant_id=" + applicantId;
                            }, 2000);

                            // Reset all form values and UI here:
                            $('#name').val('').trigger('change'); // Reset student select2
                            $('#applicant_id').val('');
                            $('#student_name').val('');
                            $('#student_year_level').val('');
                            $('#student_course').val('');

                            $('#course').val('').prop('disabled', true);
                            $('#subjects').val('').trigger('change').prop('disabled', true);

                            $('#creditedSubjects').empty();
                            $('#creditBtn').addClass('d-none');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Error saving credited subjects:", xhr.responseText);
                    }
                });
            }

        });

        $('#subjects').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        });
    });
</script>