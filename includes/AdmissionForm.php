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
                            <div class="step-title">Program Selection</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-title">Personal Information</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-title">Validate details</div>
                        </div>
                        <div class="step" data-step="4">
                            <div class="step-number">4</div>
                            <div class="step-title">Finish</div>
                        </div>
                    </div> <!-- .step-indicator -->
                    <div class="alert alert-danger d-none bg-danger text-white" id="errorContainer"></div>

                    <form method="post" enctype="multipart/form-data" id="admission-form">
                        <!-- Step1 -->
                        <!-- Program Selection -->
                        <input type="hidden" name="currentStep" id="currentStep" class="form-control">
                        <div class="program-selection container mb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <h3 class="text-center mb-3">Select Course</h3>
                                    <select name="desired_course" id="desired_course" class="form-select">
                                        <option selected disabled>-- Select Desired Course --</option>
                                        <!-- Add more courses here -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <!-- Personal Informations -->
                        <div class="step2 d-none">
                            <div class="personal-info">
                                <h1>Personal Information</h1>
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for="firstname">Firstname <span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="middlename">Middlename</label>
                                        <input type="text" name="middlename" id="middlename" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="lastname">Lastname <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="suffix">Suffix</label>
                                        <input type="text" name="suffix" id="suffix" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="address">Complete Address<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="zip_code">Zip Code <span class="text-danger">*</span></label>
                                        <input type="text" name="zip_code" id="zip_code" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="mobile_no">Mobile No <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-select"
                                            required>
                                            <option selected> --Select-- </option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="civil_status">Civil Status <span class="text-danger">*</span></label>
                                        <select name="civil_status" id="civil_status" class="form-select"
                                            required>
                                            <option selected> --Select--</option>
                                            <option value="Married">Married</option>
                                            <option value="Seperated">Seperated</option>
                                            <option value="Single">Single</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="nationality">Nationality <span class="text-danger">*</span></label>
                                        <select name="nationality" id="nationality" class="form-select"
                                            required>
                                            <option selected disabled>--Select--</option>
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
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="birthdate">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="place_of_birth">Place of Birth <span class="text-danger">*</span></label>
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="religion">Religion <span class="text-danger">*</span></label>
                                        <select name="religion" id="religion" class="form-select"
                                            required>
                                            <option selected disabled>--Select--</option>
                                            <option value="Roman Catholic">Roman Catholic</option>
                                            <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                                            <option value="Christian (Born Again)">Christian (Born Again)</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Judaism">Judaism</option>
                                            <option value="Atheist">Atheist</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Educational Informations -->
                            <div class="educational-info">
                                <h1>Educational Information</h1>
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <label for="primary_school">Primary School <span class="text-danger">*</span></label>
                                        <input type="text" name="primary_school" id="primary_school" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="primary_year_graduated">Year Graduated <span class="text-danger">*</span></label>
                                        <input type="text" name="primary_year_graduated" id="primary_year_graduated" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="secondary_school">Secondary School <span class="text-danger">*</span></label>
                                        <input type="text" name="secondary_school" id="secondary_school" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="secondary_year_graduated">Year Graduated <span class="text-danger">*</span></label>
                                        <input type="text" name="secondary_year_graduated" id="secondary_year_graduated" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="tertiary_school">Tertiary School <span class="text-danger">*</span></label>
                                        <input type="text" name="tertiary_school" id="tertiary_school" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="tertiary_year_graduated">Year Graduated <span class="text-danger">*</span></label>
                                        <input type="text" name="tertiary_year_graduated" id="tertiary_year_graduated" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="course_graduated">Course/Strand Graduated <span class="text-danger">*</span></label>
                                        <input type="text" name="course_graduated" id="course_graduated" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="parent-guardian-info">
                                <h2 class="mb-3">Parent/Guardian Information</h2>

                                <!-- Father Information -->
                                <h4>Father's Information</h4>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="father_firstname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="father_firstname" id="father_firstname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="father_middle_name">Middle Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="father_middle_name" id="father_middle_name">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="father_lastname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="father_lastname" id="father_lastname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="father_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="father_address" id="father_address"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="father_phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="father_phoneNumber" id="father_phoneNumber"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="father_occupation">Occupation </label>
                                        <input type="text" class="form-control" name="father_occupation" id="father_occupation">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="father_deceased">Deceased?</label>
                                        <select class="form-select" name="father_deceased" id="father_deceased">
                                            <option selected disabled>--Select--</option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Mother Information -->
                                <h4 class="mt-4">Mother's Information</h4>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="mother_firstname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mother_firstname" id="mother_firstname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mother_middlename">Middle Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mother_middlename" id="mother_middlename">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mother_lastname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mother_lastname" id="mother_lastname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="mother_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mother_address" id="mother_address"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="mother_phone">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mother_phone" id="mother_phone"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="mother_deceased">Deceased?</label>
                                        <select class="form-select" name="mother_deceased" id="mother_deceased">
                                            <option selected disabled>--Select--</option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Guardian Information -->
                                <h4 class="mt-4">Guardian's Information</h4>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="guardian_firstname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="guardian_firstname" id="guardian_firstname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="guardian_middlename">Middle Name </label>
                                        <input type="text" class="form-control" name="guardian_middlename" id="guardian_middlename">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="guardian_lastname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="guardian_lastname" id="guardian_lastname"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="guardian_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="guardian_address" id="guardian_address"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="guardian_phone">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="guardian_phone" id="guardian_phone"
                                            required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="guardian_occupation">Occupation</label>
                                        <input type="text" class="form-control" name="guardian_occupation" id="guardian_occupation">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="guardian_relationship">Relationship <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="guardian_relationship" id="guardian_relationship"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div class="step3">
                        </div>

                        <!-- Step 4 -->
                        <div class="step4 d-none">
                            <div class="d-flex flex-column">
                                <h1 class="text-center">Submit application</h1>
                                <p class="text-center">By clicking the submit button you will proceed to online admission</p>
                            </div>
                        </div>

                        <div class="step5 d-none">
                            <div class="d-flex flex-column">
                                <h1 class="text-center">Your Online Registration has been recorded</h1>
                                <p class="text-center">Follow our school guidelines for your next step</p>
                                <p class="text-center">Proceed to campus for evaluation</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <div class="justify-content-between">
                                <button type="button" class="btn btn-secondary" id="backbtn" disabled>Back</button>
                                <button type="button" class="btn btn-primary" id="nextbtn">Next</button>
                                <button type="submit" class="btn btn-primary d-none" id="submitbtn">Submit</button>
                                <a href="admission.php" class="btn btn-primary d-none" id="donebtn">Done</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        let step = 1;
        let stepProgress = $('.step');
        let currentStep = $('#currentStep');
        currentStep.val(step)

        const fetchAllCourse = async () => {
            try {
                const response = await $.ajax({
                    method: "GET",
                    url: "../Controllers/CourseController.php?actionType=GetAllCourse",
                    dataType: "json",
                });
                console.log(response);
                if (response.status === "success") {
                    const select = $('#desired_course');
                    let options = response.data.map((item) => {
                        let option = $('<option></option>').val(item.id).text(item.course_name);
                        return option;
                    });
                    select.append(options);
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchAllCourse();

        const highlightStep = (currentStep) => {
            stepProgress.removeClass('active');
            $('.step[data-step="' + (currentStep - 1) + '"]').addClass('completed');
            $('.step[data-step="' + currentStep + '"]').addClass('active');
        }

        const currentProgress = (currentStep) => {
            if (step === 1) {
                if ($('.program-selection').hasClass('d-none')) {
                    $('.program-selection').removeClass('d-none');
                }
                $('#backbtn').prop('disabled', true);
                $('.step2').addClass('d-none');
                $('.progress-line-completed').css('width', '0%');
            } else if (step === 2) {
                $('#backbtn').prop('disabled', false);
                $('.program-selection').addClass('d-none');
                $('.step2').removeClass('d-none');
                $('.progress-line-completed').css('width', '12%')
                $('.step3').addClass('d-none');
            } else if (step === 3) {
                $('.step3').removeClass('d-none');
                $('.step2').addClass('d-none');
                $('.step4').addClass('d-none');
                $('#nextbtn').removeClass('d-none');
                $('#submitbtn').addClass('d-none');
                $('.progress-line-completed').css('width', '37%')
            } else if (step === 4) {
                $('.step3').addClass('d-none');
                $('.step4').removeClass('d-none');
                $('#submitbtn').removeClass('d-none');
                $('#nextbtn').addClass('d-none');
                $('#donebtn').addClass('d-none');
                $('.progress-line-completed').css('width', '63%')
            } else if (step === 5) {
                $('.step4').addClass('d-none');
                $('.step5').removeClass('d-none');
                $('#backbtn').addClass('d-none');
                $('#submitbtn').addClass('d-none');
                $('#donebtn').removeClass('d-none');
                $('.progress-line-completed').css('width', '100%')
            }
        }

        $('#backbtn').on('click', function() {
            step--;
            currentStep.val(step);
            highlightStep(step);
            currentProgress(step);
        });

        $('#nextbtn').on('click', function() {
            var formData = $('#admission-form').serialize();
            $.ajax({
                method: "post",
                url: "../Controllers/AdmissionInputValidation.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let errorContainer = $('#errorContainer');
                    if (response.errors && response.errors.length > 0) {
                        $('#backbtn').prop('disabled', true);
                        errorContainer.removeClass('d-none');
                        // Create bullet list
                        // let errorList = '<ul>';
                        // response.errors.forEach(function(error) {
                        //     errorList += `<li>${error}</li>`;
                        // });
                        // errorList += '</ul>';
                        const error = `
                                Fill Out the Required Fields
                            `;

                        // Update container HTML
                        errorContainer.html(error);
                    } else {
                        step++;
                        currentStep.val(step);
                        highlightStep(step);
                        currentProgress(step);
                        if (!errorContainer.hasClass('d-none')) {
                            errorContainer.addClass('d-none');
                        }
                        $('#backbtn').prop('disabled', false);

                        if (step === 3) {
                            const data = response.datas
                            const dataContainer = $('.step3');
                            dataContainer.empty();
                            const details = `
                            <h3>Program Selected</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Desired Course:</strong></td>
                                    <td>${data.desired_course}</td>
                                </tr>
                            </table>

                            <h3>Personal Information</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Firstname:</strong></td>
                                    <td>${data.firstname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Middlename:</strong></td>
                                    <td>${data.middlename}</td>
                                </tr>
                                <tr>
                                    <td><strong>Lastname:</strong></td>
                                    <td>${data.lastname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gender:</strong></td>
                                    <td>${data.gender}</td>
                                </tr>
                                <tr>
                                    <td><strong>Birthdate:</strong></td>
                                    <td>${data.birthdate}</td>
                                </tr>
                                <tr>
                                    <td><strong>Place of Birth:</strong></td>
                                    <td>${data.place_of_birth}</td>
                                </tr>
                                <tr>
                                    <td><strong>Civil Status:</strong></td>
                                    <td>${data.civil_status}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nationality:</strong></td>
                                    <td>${data.nationality}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>${data.address}</td>
                                </tr>
                                <tr>
                                    <td><strong>Zip Code:</strong></td>
                                    <td>${data.zip_code}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile No:</strong></td>
                                    <td>${data.mobile_no}</td>
                                </tr>
                            </table>
                            <h3>Educational Information</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Primary School:</strong></td>
                                    <td>${data.primary_school}</td>
                                </tr>
                                <tr>
                                    <td><strong>Year Graduated:</strong></td>
                                    <td>${data.primary_year_graduated}</td>
                                </tr>
                                <tr>
                                    <td><strong>Secondary School:</strong></td>
                                    <td>${data.secondary_school}</td>
                                </tr>
                                <tr>
                                    <td><strong>Year Graduated:</strong></td>
                                    <td>${data.secondary_year_graduated}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tertiary School:</strong></td>
                                    <td>${data.tertiary_school}</td>
                                </tr>
                                <tr>
                                    <td><strong>Year Graduated:</strong></td>
                                    <td>${data.tertiary_year_graduated}</td>
                                </tr>
                                <tr>
                                    <td><strong>Course/Strand:</strong></td>
                                    <td>${data.course_graduated}</td>
                                </tr>
                            </table>
                            <h3>Parent/Guardian Information</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Father's Firstname:</strong></td>
                                    <td>${data.father_firstname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Middlename:</strong></td>
                                    <td>${data.father_middle_name}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Lastname:</strong></td>
                                    <td>${data.father_lastname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Address:</strong></td>
                                    <td>${data.father_address}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Contact No:</strong></td>
                                    <td>${data.father_phoneNumber}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Occupation:</strong></td>
                                    <td>${data.father_occupation}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father Deceased?:</strong></td>
                                    <td>${data.father_deceased}</td>
                                </tr>

                                <tr>
                                    <td><strong>Mother's Firstname:</strong></td>
                                    <td>${data.mother_firstname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother's Middlename:</strong></td>
                                    <td>${data.mother_middlename}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother's Lastname:</strong></td>
                                    <td>${data.mother_lastname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother's Address:</strong></td>
                                    <td>${data.mother_address}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother's Contact No:</strong></td>
                                    <td>${data.mother_phone}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother Deceased?:</strong></td>
                                    <td>${data.mother_deceased}</td>
                                </tr>

                                <tr>
                                    <td><strong>Guardian's Firstname:</strong></td>
                                    <td>${data.guardian_firstname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian's Middlename:</strong></td>
                                    <td>${data.guardian_middlename}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian's Lastname:</strong></td>
                                    <td>${data.guardian_lastname}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian's Address:</strong></td>
                                    <td>${data.guardian_address}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian's Contact No:</strong></td>
                                    <td>${data.guardian_phone}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian's Occupation:</strong></td>
                                    <td>${data.guardian_occupation}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guardian Relationship:</strong></td>
                                    <td>${data.guardian_relationship}</td>
                                </tr>
                            </table>
                        `;

                            dataContainer.append(details);
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
            });
        });

        $('#admission-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: "post",
                url: "../Controllers/Admission.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status === "success") {
                        step++;
                        currentStep.val(step);
                        highlightStep(step);
                        currentProgress(step);
                        Swal.fire({
                            icon: `${response.status}`,
                            title: 'Success',
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: `${response.status}`,
                            title: 'Failed',
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