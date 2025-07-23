<?php include "../includes/AdminSidebar.php"; ?>

<div class="container py-4">
    <div class="page-inner">
        <h2 class="mb-4" id="title"></h2>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Department Details</span>
                <button class="btn btn-light btn-sm" id="editBtn">Edit</button>
            </div>
            <div class="card-body">
                <div id="details-container">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name:</label>
                        <p class="form-control-plaintext" id="view-department-name"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Code:</label>
                        <p class="form-control-plaintext" id="view-department-code"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description:</label>
                        <p class="form-control-plaintext" id="view-department-description"></p>
                    </div>
                </div>

                <div class="d-none" id="edit-form-container">
                    <form method="post" id="edit-department-form">
                        <input type="hidden" name="actionType" value="UpdateDepartment">
                        <input type="hidden" name="department_id" id="department_id">
                        <div class="mb-3">
                            <label for="department_name" class="form-label fw-bold">Name:</label>
                            <input type="text" name="department_name" id="department_name" class="form-control" placeholder="Enter Department Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="department_code" class="form-label fw-bold">Code:</label>
                            <input type="text" name="department_code" id="department_code" class="form-control" placeholder="Enter Department Code" required>
                        </div>
                        <div class="mb-3">
                            <label for="department_description" class="form-label fw-bold">Description:</label>
                            <textarea name="department_description" id="department_description" class="form-control" placeholder="Enter Department Description" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                Archive Department
            </div>
            <div class="card-body">
                <p>Archiving this department will disable its access and visibility in the system.</p>
                <button class="btn btn-danger" id="archiveBtn">Archive</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('department_id');

        const setValue = (department_id, department_name, department_code, department_description) => {
            $('#title').text(department_name + " " + "Details");
            $('#view-department-name').text(department_name);
            $('#view-department-code').text(department_code);
            $('#view-department-description').text(department_description);
            $('#department_id').val(department_id);
            $('#department_name').val(department_name);
            $('#department_code').val(department_code);
            $('#department_description').val(department_description);
        };

        const toggleEditForm = () => {
            $('#details-container').hide();
            $('#edit-form-container').removeClass('d-none');
        };

        const toggleReadMode = () => {
            $('#details-container').show();
            $('#edit-form-container').addClass('d-none');
        };

        $('#editBtn').on('click', function() {
            toggleEditForm();
        });

        $('#cancelBtn').on('click', function() {
            toggleReadMode();
        });

        const fetchDepartment = async () => {
            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Actions/DepartmentController.php",
                    data: {
                        actionType: "GetDepartmentById",
                        department_id: id
                    },
                    dataType: "json"
                });

                if (response.status === "success") {
                    setValue(id, response.data.department_name, response.data.department_code, response.data.department_description);
                }
            } catch (error) {
                console.log(error);
            }
        };

        fetchDepartment();

        $('#edit-department-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "../Actions/DepartmentController.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        fetchDepartment();
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

        $('#archiveBtn').on('click', function() {
            $.ajax({
                method: "POST",
                url: "../Actions/DepartmentController.php",
                data: {
                    actionType: "ArchiveDepartment",
                    department_id: id,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        fetchDepartment();
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