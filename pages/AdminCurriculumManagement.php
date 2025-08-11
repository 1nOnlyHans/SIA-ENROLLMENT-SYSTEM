<?php
include "../includes/AdminSidebar.php";
?>
<!-- 
    NAKAKAPAG ADD NG SAME CURRICULUM NAGIGING DOBLE
    WALA PANG UPDATE AND REMOVE
-->
<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-content-center">
                    <h1>Curriculum Management</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddCurriculum">+ New Curriculum</button>
                </div>
                <div class="mt-5">
                    <table class="table table-bordered table-striped" id="curriculum-tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Course</th>
                                <th class="text-center">Curriculum Title</th>
                                <th class="text-center">School Year</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../includes/AddCurriculumModal.php";
?>

<script>
    $(document).ready(function() {
        const fetchAllCurriculums = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/Curriculum.php?actionType=GetAllCurriculum",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    $('#curriculum-tbl').DataTable({
                        data: response.data,
                        columns: [{
                                data: "course_code",
                                class: "text-center"
                            },
                            {
                                data: "curriculum_name",
                                class: "text-center"
                            },
                            {
                                data: "SY",
                                class: "text-center"
                            },
                            {
                                data: "created_at",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    return `
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-dark" href="AdminCurriculumDetails.php?page=${data.curriculum_name} Details&curriculum_id=${data.id}"">View</a>
                                            </div>
                                        `;
                                }
                            },
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
        }

        fetchAllCurriculums();

        $('#create-curriculum-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/Curriculum.php?actionType=CreateCurriculum",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $('#create-curriculum-form')[0].reset();
                        $('#subject_id').val('').trigger('change');
                        fetchAllCurriculums();
                        let Modal = bootstrap.Modal.getInstance(document.getElementById('AddCurriculum'));
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
                    console.log(xhr.responseText)
                }
            });
        });
    });
</script>