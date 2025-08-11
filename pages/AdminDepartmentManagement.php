<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-content-center">
                    <h2>List of Departments</h2>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddDepartment">+ New Department</button>
                </div>
                <table class="table table-responsive table-bordered table-striped" id="department-tbl">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Department Code</th>
                            <th class="text-center">Department Name</th>
                            <th class="text-center">Department Description</th>
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
include "../includes/AddDepartmentModal.php";
?>

<script>
    $(document).ready(function() {

        const fetchDepartments = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Actions/DepartmentController.php?actionType=GetAllDepartments",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    $('#department-tbl').DataTable({
                        data: response.data,
                        columns: [{
                                data: "department_code",
                                class: "text-center"
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    let department_name = data.department_name.length > 25 ? data.department_name.slice(0, 25) + '...' : data.department_name;
                                    return department_name;
                                }
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    let description = data.department_description.length > 40 ? data.department_description.slice(0, 25) + '...' : data.department_description;
                                    return description;
                                }
                            },
                            {
                                data: null,
                                class: "text-center",
                                render: function(data, type, row) {
                                    const formattedDate = new Date(data.added_at).toLocaleDateString("en-US", {
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
                                                <a class="btn btn-dark" href="AdminDepartmentDetails.php?page=${data.department_name} Details&department_id=${data.id}"">View</a>
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

        fetchDepartments();

        $('#create-department-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "../Actions/DepartmentController.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        fetchDepartments();
                        $('#create-department-form')[0].reset();
                        let Modal = bootstrap.Modal.getInstance(document.getElementById('AddDepartment'));
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