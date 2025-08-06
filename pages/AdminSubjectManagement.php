<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <h2>List of Subjects</h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddSubject">+ New Subject</button>
                <table class="table table-responsive table-bordered table-striped" id="subject-tbl">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Course</th>
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

<?php
include "../includes/AddSubjectModal.php";
?>

<script>
    $(document).ready(function() {


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
                                data: "course_code",
                                class: "text-center"
                            },
                            {
                                data: "subject_code",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    let subject_name = data.subject_name.length > 25 ? data.subject_name.slice(0, 25) + '...' : data.subject_name;
                                    return subject_name;
                                }
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    return data.pre_requisite === '' ? 'N/A' : data.pre_requisite;
                                }
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
                                render: function(data, type, row) {
                                    return `
                                        <div class="d-flex justify-content-center align-content-center">
                                            <a class="btn btn-dark" href="AdminSubjectDetails.php?page=${data.subject_name} Details&subject_id=${data.id}"">View</a>
                                        </div>
                                    `;
                                }
                            }
                        ],
                        rowGroup: {
                            dataSrc: ['course_code']
                        },
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
                                title: "List of Departments",
                                text: "Print",
                                className: "btn btn-dark me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: "csv",
                                title: "List of Departments",
                                text: "CSV",
                                className: "btn btn-dark me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: "pdf",
                                title: "List of Departments",
                                text: "PDF",
                                className: "btn btn-dark me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            }
                        ]
                    });
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchSubjects();

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
    });
</script>