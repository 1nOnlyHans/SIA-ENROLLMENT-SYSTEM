<?php
include "../includes/header.php";
include "../includes/RegistrarNavbar.php";
?>

<div class="d-flex">
    <?php include "../includes/sidebar.php"; ?>
    <div class="flex-grow-1 p-3">
        <div class="container">
            <h1 class="text-center">Applicants</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="applicant-tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Desired Course</th>
                                <th class="text-center">Date of submission</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../includes/RegistrarViewApplicantDetailsModal.php";
include "../includes/RegistrarStudentEvalModal.php";
?>

<script>
    $(document).ready(function() {

        /* =========================================================
           FETCH FUNCTIONS
        ========================================================= */

        // Fetch Pending Applicants
        // Make this an ajax
        const fetchPendingApplicants = async () => {
            try {
                const response = await fetch('../Actions/Applicant.php?actionType=GetAllPendingApplicants');
                const data = await response.json();
                console.log(data);

                $('#applicant-tbl').DataTable().clear().destroy();

                $('#applicant-tbl').DataTable({
                    data: data.data,
                    columns: [{
                            data: null,
                            class: "text-center",
                            render: (data) => `${data.firstname} ${data.lastname}`
                        },
                        {
                            data: "course_code",
                            class: "text-center"
                        },
                        {
                            data: null,
                            class: "text-center",
                            render: (data) => {
                                const formattedDate = new Date(data.register_at)
                                    .toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });
                                return formattedDate;
                            }
                        },
                        {
                            data: null,
                            class: "text-center",
                            render: (data) => `
                                <div class="d-flex justify-content-center align-content-center">
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" id="view"
                                        data-details='${JSON.stringify(data)}' 
                                        data-bs-target="#ApplicantDetailsModal">
                                        View
                                    </button>
                                </div>
                            `
                        }
                    ],
                    destroy: true,
                    responsive: true,
                    order: [],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    pageLength: 5,
                    paging: true,
                    dom: "Blfrtip",
                    buttons: [{
                        extend: "print",
                        title: "Pending Applicants",
                        text: "Print",
                        className: "btn btn-danger me-3 mb-3",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }]
                });
            } catch (error) {
                console.log(error);
            }
        };

        // Fetch Available Courses
        const fetchAvailableCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/CourseController.php?actionType=GetAllCourse",
                    dataType: "json"
                });

                if (response.status === "success") {
                    const select = $('#desired_course');
                    select.empty();
                    const options = response.data.map(data =>
                        $('<option></option>').val(data.id).text(data.course_name)
                    );
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        };

        // Fetch Senior High Schools
        const fetchShsSchools = async () => {
            try {
                const response = await fetch('../json/senior_high_schools.json', {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                });
                const data = await response.json();

                data.sort((a, b) =>
                    a["SCHOOL NAME"].toLowerCase().localeCompare(b["SCHOOL NAME"].toLowerCase())
                );

                const shs_school_selection = $('#shs_school');
                shs_school_selection.empty();

                const options = data.map(item =>
                    $('<option></option>').val(item["SCHOOL NAME"]).text(item["SCHOOL NAME"])
                );
                shs_school_selection.append(options);
            } catch (error) {
                console.log(error);
            }
        };

        // Fetch Available Strands
        const fetchAvailableStrands = async () => {
            try {
                const response = await fetch('../json/senior_high_schools.json', {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                });
                const data = await response.json();

                const strand = $('#strand');
                strand.empty();

                const selectedSchool = data.filter(strand =>
                    strand['SCHOOL NAME'] === $('#shs_school').val()
                );

                const availableStrands = selectedSchool
                    .flatMap(item => item['PROGRAM OFFERINGS'].split('|'))
                    .sort((a, b) => a.localeCompare(b));

                const options = availableStrands.map(item =>
                    $('<option></option>').val(item).text(item)
                );
                strand.append(options);
            } catch (error) {
                console.log(error);
            }
        };

        // Fetch Active School Year
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
                    school_year_selection.empty();

                    const option = $('<option></option>')
                        .val(response.data.id)
                        .text(response.data.SY);

                    school_year_selection.append(
                        response.data !== false ? option : $('<option></option>').val("").text("No Active School Year")
                    );
                }
            } catch (error) {
                console.log(error);
            }
        };

        // Fetch Active Semester
        const fetchActiveSemester = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/AcademicSettings.php?actionType=GetActiveSemester",
                    dataType: "json"
                });

                if (response.status === "success") {
                    const semester = $('#semester');
                    semester.empty();

                    const option = $('<option></option>')
                        .val(response.data.id)
                        .text(response.data.semester);
                    semester.append(option);
                }
            } catch (error) {
                console.log(error);
            }
        };

        const fetchRequiredDocuments = async (applicantType) => {
            console.log(applicantType);
            const postData = {
                applicantType: applicantType
            };
            try {
                const response = await fetch('../Actions/Evaluation.php?actionType=GetRequiredDocuments', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(postData)
                });
                const data = await response.json();
                console.log(data);
                if (data.status === "success") {
                    const container = $('#documentsContainer');
                    container.empty();
                    const docs = data.data.map((item) => `
                    <div class="col-12 col-md-4 mb-2">
                            <label class="fw-bold">${item.name}</label>
                            <input type="hidden" name="document_type_id[]" value="${item.id}">
                            <select class="form-select form-select-sm mt-1" name="status[]">
                                <option value="Present">Present</option>
                                <option value="Missing">Missing</option>
                                <option value="Invalid">Invalid</option>
                            </select>
                    </div>
                `).join("");
                    container.append(docs);
                }
            } catch (error) {
                console.log(error);
            }
        }

        /* =========================================================
            SET FORM VALUES
        ========    ================================================= */
        const decodeHtmlEntities = (string) => {
            return $('<textarea/>').html(string).text();
        }

        const setValues = (data) => {
            fetchAvailableCourse().then(() => {

                $('#ApplicantDetailsModal select[name="desired_course"]').val(data.desired_course).trigger('change');
            });

            fetchShsSchools().then(() => {
                let decodedSchool = decodeHtmlEntities(data.shs_school);
                $('#ApplicantDetailsModal select[name="shs_school"]').val(decodedSchool).trigger('change');
                fetchAvailableStrands().then(() => {
                    $('#ApplicantDetailsModal select[name="strand"]').val(data.strand).trigger('change');
                });
            });

            fetchActiveSchoolYear().then(() => {
                $('#ApplicantDetailsModal select[name="sy"]').val(data.sy).trigger('change');
            });

            fetchActiveSemester().then(() => {
                $('#ApplicantDetailsModal select[name="semester"]').val(data.semester).trigger('change');
            });

            $('#ApplicantDetailsModal input[name="applicant_id"]').val(data.id);
            $('#ApplicantDetailsModal input[name="firstname"]').val(data.firstname);
            $('#ApplicantDetailsModal input[name="middlename"]').val(data.middlename);
            $('#ApplicantDetailsModal input[name="lastname"]').val(data.lastname);
            $('#ApplicantDetailsModal input[name="suffix"]').val(data.suffix);
            $('#ApplicantDetailsModal select[name="gender"]').val(data.gender);
            $('#ApplicantDetailsModal input[name="dob"]').val(data.dob);
            $('#ApplicantDetailsModal select[name="nationality"]').val(data.nationality);
            $('#ApplicantDetailsModal input[name="address"]').val(data.address);
            $('#ApplicantDetailsModal input[name="email"]').val(data.email);
            $('#ApplicantDetailsModal input[name="mobile_no"]').val(data.mobile_no);
            $('#ApplicantDetailsModal select[name="shs_school"]').val(data.shs_school);
            $('#ApplicantDetailsModal input[name="year_graduated"]').val(data.year_graduated);
            $('#ApplicantDetailsModal select[name="applicant_type"]').val(data.applicant_type);
            $('#ApplicantDetailsModal input[name="transferee_prv_school"]').val(data.transferee_prv_school);
            $('#ApplicantDetailsModal input[name="transferee_prv_course"]').val(data.transferee_prv_course);
            $('#ApplicantDetailsModal select[name="transferee_yr_level"]').val(data.transferee_yr_level);
        };

        const setEvalValues = (id, name, type, course_id, course_name) => {
            $('#view_applicant_fullname_eval').html('<strong>Name:</strong> ' + name);
            $('#view_applicant_type_eval').html('<strong>Applicant Type:</strong> ' + type);
            $('#view_applicant_course_eval').html('<strong>Course Applied:</strong> ' + course_name);

            $('#evaluationModal input[name="applicant_id_eval"]').val(id);
            $('#evaluationModal input[name="applicant_type_eval"]').val(type);
            $('#evaluationModal input[name="applicant_course_eval"]').val(course_id);
        };

        /* =========================================================
           EVENT LISTENERS
        ========================================================= */
        $(document).on('click', '#view', function() {
            const data = JSON.parse($(this).attr('data-details'));
            const fullname = `${data.firstname} ${data.middlename} ${data.lastname}`;

            setValues(data);
            setEvalValues(data.id, fullname, data.applicant_type, data.desired_course, data.course_code);

            if (data.applicant_type === "Transferee") {
                $('#transferee_dtl_container').removeClass('d-none');
            } else {
                $('#transferee_dtl_container').addClass('d-none');
            }

            $('#alert').removeClass().text('');
        });

        $('#shs_school').on('change', fetchAvailableStrands);

        $('#applicant_type').on('change', function() {
            if ($(this).val() === "Transferee") {
                $('#transferee_dtl_container').removeClass('d-none');
            } else {
                $('#transferee_dtl_container').addClass('d-none');
                $('.transferee_inputs').val('');
            }
        });

        $('#updateApplicant').on('click', function() {
            const formData = $('#applicant-reg-form').serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/Applicant.php?actionType=UpdateApplicant",
                data: formData,
                dataType: "json",
                success: function(response) {
                    const alert = $('#alert');
                    if (response.status === "success") {
                        fetchPendingApplicants();

                        const fullname =
                            $('#ApplicantDetailsModal input[name="firstname"]').val() + " " +
                            $('#ApplicantDetailsModal input[name="middlename"]').val() + " " +
                            $('#ApplicantDetailsModal input[name="lastname"]').val();
                        const courseName = $('#ApplicantDetailsModal select[name="desired_course"] option:selected').text();

                        setEvalValues(
                            $('#ApplicantDetailsModal input[name="applicant_id"]').val(),
                            fullname,
                            $('#ApplicantDetailsModal select[name="applicant_type"]').val(),
                            $('#ApplicantDetailsModal select[name="desired_course"]').val(),
                            courseName
                        );

                        alert.addClass('alert alert-success bg-success text-white')
                            .removeClass('alert-danger bg-danger')
                            .text(response.message);
                    } else {
                        alert.addClass('alert alert-danger bg-danger text-white')
                            .removeClass('alert-success bg-success')
                            .text(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#eval-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/Evaluation.php?actionType=Evaluation",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        var documents = [];
                        $('#documentsContainer').find('div').each(function() {
                            const docId = $(this).find('input[name="document_type_id[]"]').val();
                            const status = $(this).find('select[name="status[]"]').val();
                            documents.push({
                                document_type_id: docId,
                                status: status
                            });
                        });

                        const payload = {
                            evaluation_id: response.evaluation_id,
                            documents: documents
                        };

                        $.ajax({
                            method: "POST",
                            url: "../Actions/Evaluation.php?actionType=SaveEvaluationDocuments",
                            data: payload,
                            dataType: "json",
                            success: function(response) {
                                if (response.status === "success") {
                                    fetchPendingApplicants();
                                    $('#eval-form')[0].reset();
                                    let Modal = bootstrap.Modal.getInstance(document.getElementById('evaluationModal'));
                                    Modal.hide();
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
            });
        });
        /* =========================================================
            
        ========================================================= */

        /* 
        =========================================================
            Modals
        ========================================================= 
        */
        const switchModal = (fromSelector, toSelector) => {
            const fromModalEl = document.querySelector(fromSelector);
            const toModalEl = document.querySelector(toSelector);

            const fromModal = bootstrap.Modal.getOrCreateInstance(fromModalEl);
            const toModal = bootstrap.Modal.getOrCreateInstance(toModalEl);

            fromModalEl.addEventListener('hidden.bs.modal', function onHidden() {
                toModal.show();
                fromModalEl.removeEventListener('hidden.bs.modal', onHidden);
            });

            fromModal.hide();
        }

        $('#eval').on('click', function() {
            switchModal('#ApplicantDetailsModal', '#evaluationModal');
            fetchRequiredDocuments($('#ApplicantDetailsModal select[name="applicant_type"]').val());
            if ($('#ApplicantDetailsModal select[name="applicant_type"]').val() === "Transferee") {
                $('#saveEvaluation').text('Proceed to Subject Crediting');
            } else {
                $('#saveEvaluation').text('Save Evaluation');
            }
        });

        /* =========================================================
            INITIAL LOAD
        ========================================================= */
        fetchPendingApplicants();
    });
</script>