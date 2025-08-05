<?php
include "../includes/AdminSidebar.php";
?>

<div class="container" id="print">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <h2>List of Courses</h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddCourse">+ New Course</button>
                <table class="table table-responsive table-bordered table-striped" id="course-tbl">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Course Department</th>
                            <th class="text-center">Course Code</th>
                            <th class="text-center">Course Name</th>
                            <th class="text-center">Course Description</th>
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
include "../includes/AddCourseModal.php";
?>
<script>
    $(document).ready(function() {
        const fetchAllCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/CourseController.php?actionType=GetAllCourse",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    $('#course-tbl').DataTable({
                        data: response.data,
                        columns: [{
                                data: "department_code",
                                class: "text-center"
                            },
                            {
                                data: "course_code",
                                class: "text-center"
                            },
                            {
                                data: "course_name",
                                class: "text-center"
                            },
                            {
                                data: "course_description",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    const formattedDate = new Date(data.created_at).toLocaleDateString("en-US", {
                                        year: "numeric",
                                        month: "long",
                                        day: "numeric",
                                    });
                                    return formattedDate;
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    return `
                                            <div class="d-flex justify-content-center align-content-center">
                                                <a class="btn btn-dark" href="AdminCourseDetails.php?page=${data.course_name} Details&course_id=${data.id}"">View</a>
                                            </div>
                                        `;
                                }
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
                                title: "List of Courses",
                                text: "Print",
                                className: "btn btn-primary me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend: "csv",
                                title: "List of Courses",
                                text: "CSV",
                                className: "btn btn-primary me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend: "pdf",
                                title: "List of Courses",
                                text: "PDF",
                                className: "btn btn-primary me-3 mb-3",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            }
                        ]
                    });
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchAllCourse();

        $('#create-course-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/CourseController.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        fetchAllCourse();
                        $('#create-course-form')[0].reset();
                        let Modal = bootstrap.Modal.getInstance(document.getElementById('AddCourse'));
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