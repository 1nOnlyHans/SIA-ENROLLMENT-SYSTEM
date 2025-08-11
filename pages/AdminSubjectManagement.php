<?php include "../includes/AdminSidebar.php"; ?>

<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-content-center">
                    <h2>List of Subjects</h2>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddSubject">
                        + New Subject
                    </button>
                </div>
                <table class="table table-responsive table-bordered table-striped" id="subject-tbl">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Subject Code</th>
                            <th class="text-center">Subject Name</th>
                            <th class="text-center">Pre Requisite</th>
                            <th class="text-center">Total Units</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Year Level</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="container"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/AddSubjectModal.php"; ?>

<script>
    $(document).ready(function() {

        /** =========================
         *  Fetch Subjects for Table
         *  ========================= */
        const fetchSubjects = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/Subject.php?actionType=GetAllSubjects",
                    dataType: "json",
                });

                console.log(response);

                if (response.status === "success") {
                    $('#subject-tbl').DataTable({
                        data: response.data,
                        columns: [{
                                data: "subject_code",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: (data) => {
                                    return data.subject_name.length > 25 ?
                                        data.subject_name.slice(0, 25) + '...' :
                                        data.subject_name;
                                }
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: (data) => data.pre_requisite === '' ? 'N/A' : data.pre_requisite
                            },
                            {
                                data: "total_units",
                                class: "text-center"
                            },
                            {
                                data: "type",
                                class: "text-center"
                            },
                            {
                                data: "year_lvl",
                                class: "text-center"
                            },
                            {
                                data: "semester",
                                class: "text-center"
                            },
                            {
                                data: "added_at",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: (data) => `
                                <div class="d-flex justify-content-center align-content-center">
                                    <a class="btn btn-dark" href="AdminSubjectDetails.php?page=${data.subject_name} Details&subject_id=${data.id}">View</a>
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
                            title: "",
                            text: "<i class='fa-solid fa-print'></i> Print",
                            className: "btn btn-danger me-3 mb-3 fw-bold",
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        }, ]
                    });
                }
            } catch (error) {
                console.log(error);
            }
        };

        /** =========================
         *  Fetch All Subjects for Prerequisite Select
         *  ========================= */
        const fetchAllSubjects = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/Subject.php?actionType=GetAllSubjects",
                    dataType: "json"
                });

                console.log(response);

                if (response.status === "success") {
                    const select = $('#pre_requisite');
                    select.empty();

                    let options = response.data.map((data) => {
                        return $('<option></option>')
                            .val(data.subject_code)
                            .text(data.subject_name);
                    });

                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        };

        /** =========================
         *  Event: Subject Type Change
         *  ========================= */
        $('#type').on('change', function() {
            const selectedVal = $(this).val();

            // Lab Units
            if (selectedVal && selectedVal.includes("Lab")) {
                $('#lab_units').removeAttr('disabled');
            } else {
                $('#lab_units').val('').prop('disabled', true).prop('required', true);
            }

            // Lec Units
            if (selectedVal && selectedVal.includes("Lec")) {
                $('#lec_units').removeAttr('disabled');
            } else {
                $('#lec_units').val('').prop('disabled', true).prop('required', true);
            }
        });

        /** =========================
         *  Select2 Initialization
         *  ========================= */
        $('#pre_requisite').select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--large",
            selectionCssClass: "select2--large",
            dropdownCssClass: "select2--large",
            width: "resolve"
        });

        /** =========================
         *  Restrict Units Input
         *  ========================= */
        $('.units').on('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 3);
        });

        /** =========================
         *  Form Submit: Create Subject
         *  ========================= */
        $('#create-subject-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "../Actions/Subject.php?actionType=CreateSubject",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    if (response.status === "success") {
                        fetchSubjects();
                        fetchAllSubjects();
                        $('#create-subject-form')[0].reset();

                        let Modal = bootstrap.Modal.getInstance(document.getElementById('AddSubject'));
                        Modal.hide();

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

        /** =========================
         *  Initial Fetch Calls
         *  ========================= */
        fetchSubjects();
        fetchAllSubjects();

    });
</script>