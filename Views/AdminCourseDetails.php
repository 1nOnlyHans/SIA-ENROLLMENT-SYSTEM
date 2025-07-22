<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="container-fluid">
            <h2 class="mb-4" id="title"></h2>
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Course Details</span>
                    <button class="btn btn-light btn-sm" id="editBtn">Edit</button>
                </div>
                <div class="card-body">
                    <div id="details-container">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Department:</label>
                            <p class="form-control-plaintext" id="view-department-name"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Code:</label>
                            <p class="form-control-plaintext" id="view-course-code"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Name:</label>
                            <p class="form-control-plaintext" id="view-course-name"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Description:</label>
                            <p class="form-control-plaintext" id="view-course-description"></p>
                        </div>
                    </div>

                    <div class="d-none" id="edit-form-container">
                        <form method="post" id="edit-course-form">
                            <input type="hidden" name="actionType" value="UpdateCourse">
                            <input type="hidden" name="course_id" id="course_id">
                            <div class="mb-3">
                                <label for="department_id" class="form-label fw-bold">Department:</label>
                                <select name="department_id" id="department_id" class="form-select"></select>
                            </div>
                            <div class="mb-3">
                                <label for="course_code" class="form-label fw-bold">Course Code:</label>
                                <input type="text" name="course_code" id="course_code" class="form-control" placeholder="Enter Course Code" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_name" class="form-label fw-bold">Course Name:</label>
                                <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Enter Course Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_description" class="form-label fw-bold">Course Description:</label>
                                <textarea name="course_description" id="course_description" class="form-control" placeholder="Enter Course Description" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
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
        const id = urlParams.get('course_id');

        const fetchDepartments = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Controllers/DepartmentController.php?actionType=GetAllDepartments",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    const select = $('#department_id');
                    let options = response.data.map((item) => {
                        let option = $('<option></option>').val(item.id).text(item.department_name);
                        return option;
                    });
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        const setValue = (data) => {
            $('#view-department-name').text(data.department_name);
            $('#view-course-code').text(data.course_code);
            $('#view-course-name').text(data.course_name);
            $('#view-course-description').text(data.course_description);
            $('#course_id').val(data.id);
            $('#department_id').val(data.department_id);
            $('#course_code').val(data.course_code);
            $('#course_name').val(data.course_name);
            $('#course_description').val(data.course_description);
        }

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

        const fetchCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Controllers/CourseController.php",
                    data: {
                        actionType: "GetCourseById",
                        course_id: id
                    },
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    setValue(response.data);
                    fetchDepartments();
                }
            } catch (error) {
                console.log(error);
            }
        };

        fetchCourse();

        $('#edit-course-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "../Controllers/CourseController.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        fetchCourse();
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
    });
</script>