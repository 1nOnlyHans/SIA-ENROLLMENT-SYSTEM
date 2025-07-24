<style>
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        position: relative;
    }

    .step {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dee2e6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        color: #495057;
        font-weight: bold;
    }

    .step.active .step-number {
        background-color: #0d6efd;
        color: white;
    }

    .step.completed .step-number {
        background-color: #198754;
        color: white;
    }

    .step-title {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .step.active .step-title {
        color: #0d6efd;
        font-weight: bold;
    }

    .step.completed .step-title {
        color: #198754;
    }

    .progress-line {
        position: absolute;
        height: 2px;
        background-color: #dee2e6;
        top: 20px;
        left: 0;
        right: 0;
        z-index: 1;
    }

    .progress-line-completed {
        height: 2px;
        background-color: #198754;
        transition: width 0.3s ease;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
        animation: fadeIn 0.5s forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-image {
        background-color: #f8f9fa;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 250px;
    }

    .form-image img {
        max-width: 100%;
        height: auto;
    }

    .btn-nav {
        min-width: 120px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Enrollment Registration</h2>
                </div>
                <div class="card-body p-4">
                    <!-- Step Indicator -->
                    <div class="step-indicator mb-5">
                        <div class="progress-line">
                            <div class="progress-line-completed" style="width: 0%;"></div>
                        </div>
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-title">Program Selection & Personal Information</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-title">Validate details</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-title">Finish</div>
                        </div>
                    </div> <!-- .step-indicator -->
                    <div class="alert alert-danger d-none bg-danger text-white" id="errorContainer"></div>
                    <!-- Reg Form -->
                    <form method="post" enctype="multipart/form-data" id="admission-form" class="needs-validation" novalidate>
                        <input type="hidden" name="step" id="step" class="form-control">
                        <div id="step1">
                            <h3>Course Selection</h3>
                            <div class="mb-3">
                                <label for="desired_course" class="form-label">Desired Course</label>
                                <select name="desired_course" id="desired_course" class="form-select" required>
                                    <option value="" selected disabled> --Select Course-- </option>
                                </select>
                            </div>
                            <h3>Personal Information</h3>
                            <div class="row">
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="middlename" class="form-label">Middlename</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control">
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <input type="text" name="suffix" id="suffix" class="form-control">
                                </div>

                                <div class="col-12 col-md-4 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="" selected disabled> -- Select Gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-select" required>
                                        <option value="" selected disabled> -- Select Nationality --</option>
                                        <option value="Filipino">Filipino</option>
                                        <option value="American">American</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Korean">Korean</option>
                                        <option value="Indian">Indian</option>
                                        <option value="British">British</option>
                                        <option value="Canadian">Canadian</option>
                                        <option value="Australian">Australian</option>
                                        <option value="German">German</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="address" class="form-label">Complete Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <h3>Educational Information</h3>
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="shs_school" class="form-label">Shs School</label>
                                    <input type="text" name="shs_school" id="shs_school" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="year_graduated" class="form-label">Year Graduated</label>
                                    <input type="text" name="year_graduated" id="year_graduated" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="course_strand" class="form-label">Course/Strand</label>
                                    <input type="text" name="course_strand" id="course_strand" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="d-none" id="step2"></div>
                        <!-- Step 3 -->
                        <div class="d-none" id="step3">
                            <div class="d-flex flex-column">
                                <h1 class="text-center">Submit application</h1>
                                <p class="text-center">By clicking the submit button your online application will be submitted</p>
                            </div>
                        </div>
                        <!-- Step 4 -->
                        <div class="d-none" id="step4">
                            <div class="d-flex flex-column">
                                <h1 class="text-center">Successfully Submitted</h1>
                                <p class="text-center">Your online applicated has been submitted you may proceed to next step of our admission</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-5 gap-3">
                            <button type="button" class="btn btn-secondary d-none" id="backbtn">Back</button>
                            <button type="submit" class="btn btn-primary" id="nextBtn">Next</button>
                            <a href="index.php" class="btn btn-primary d-none" id="doneBtn">Done</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Current Step Value
        let currentStep = 1;
        const stepProgress = $('.step');
        const step = $('#step');
        step.val(currentStep);

        // For Current Progress Highlighting
        const highlightStep = (currentStep) => {
            stepProgress.removeClass('active');
            $('.step[data-step="' + (currentStep - 1) + '"]').addClass('completed');
            $('.step[data-step="' + currentStep + '"]').addClass('active');
        }

        // For Displaying Data depending on the current step
        const currentProgress = (currentStep) => {
            if (currentStep === 1) {
                $('#step1').removeClass('d-none');
                $('#step2').addClass('d-none');
                $('#backbtn').addClass('d-none');
                $('.progress-line-completed').css('width', '0%');
            } else if (currentStep === 2) {
                $('#step1').addClass('d-none');
                $('#step2').removeClass('d-none');
                $('#step3').addClass('d-none');
                $('#backbtn').removeClass('d-none');
                $('.progress-line-completed').css('width', '18%');
            } else if (currentStep === 3) {
                $('#step2').addClass('d-none');
                $('#step3').removeClass('d-none');
                $('#step4').addClass('d-none');
                $('#nextBtn').text('Submit');
                $('.progress-line-completed').css('width', '50%');
            } else if (currentStep === 4) {
                $('#step3').addClass('d-none');
                $('#step4').removeClass('d-none');
                $('#backbtn').addClass('d-none');
                $('#nextBtn').addClass('d-none');
                $('#doneBtn').removeClass('d-none');
                $('.progress-line-completed').css('width', '100%');
            }
        }

        // Back Button
        $('#backbtn').on('click', function() {
            if (currentStep > 1) {
                currentStep--;
                step.val(currentStep);
                highlightStep(currentStep);
                currentProgress(currentStep);
            }
        });

        // For Displaying all the available course
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
                    const select = $('#desired_course');
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchAvailableCourse();

        // For Validating Details in Step 2
        const viewDetails = (desired_course, firstname, middlename, lastname, suffix, gender, nationality, dob, address, email, shs_school, year_graduated, course_strand) => `
            <h3>Program Selected</h3>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Desired Course:</strong></td>
                    <td>${$('#desired_course :selected').text()}</td>
                </tr>
            </table>

            <h3>Personal Information</h3>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Firstname:</strong></td>
                    <td>${firstname}</td>
                </tr>
                <tr>
                    <td><strong>Middlename:</strong></td>
                    <td>${middlename}</td>
                </tr>
                <tr>
                    <td><strong>Lastname:</strong></td>
                    <td>${lastname}</td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong></td>
                    <td>${gender}</td>
                </tr>
                <tr>
                    <td><strong>Suffix:</strong></td>
                    <td>${suffix}</td>
                </tr>
                <tr>
                    <td><strong>Nationality:</strong></td>
                    <td>${nationality}</td>
                </tr>
                <tr>
                    <td><strong>Birthdate:</strong></td>
                    <td>${dob}</td>
                </tr>
                <tr>
                    <td><strong>Address:</strong></td>
                    <td>${address}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>${email}</td>
                </tr>
            </table>
            <h3>Educational Information</h3>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Shs School:</strong></td>
                    <td>${shs_school}</td>
                </tr>
                <tr>
                    <td><strong>Year Graduated:</strong></td>
                    <td>${year_graduated}</td>
                </tr>
                <tr>
                    <td><strong>Course/Strand:</strong></td>
                    <td>${course_strand}</td>
                </tr>
            </table>
        `;

        // Bootstrap Form Validation
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();

        // Submitting the data in the backend
        $('#admission-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "post",
                url: "../Actions/ApplicantRegistration.php",
                data: formData,
                dataType: "json",
                success: function(response) {

                    console.log(response);
                    if (response.errors.length <= 0) {
                        if (currentStep < 5) {
                            currentStep++;
                            step.val(currentStep);
                        }
                    }
                    highlightStep(currentStep);
                    currentProgress(currentStep);
                    if (currentStep === 2) {
                        const detailsContainer = $('#step2');
                        detailsContainer.empty();
                        detailsContainer.append(viewDetails(response.data.desired_course, response.data.firstname, response.data.middlename, response.data.lastname, response.data.suffix, response.data.gender, response.data.nationality, response.data.dob, response.data.address, response.data.email, response.data.shs_school, response.data.year_graduated, response.data.course_strand));
                    }

                    if (currentStep === 4) {
                        if (response[0].status === "success") {
                            Swal.fire({
                                icon: `${response[0].status}`,
                                title: 'Success',
                                text: response[0].message
                            });
                        } else {
                            Swal.fire({
                                icon: `${response[0].status}`,
                                title: 'Failed',
                                text: response[0].message
                            });
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText)
                }
            });
        });
    });
</script>