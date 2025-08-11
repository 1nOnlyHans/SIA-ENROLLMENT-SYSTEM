<div class="modal fade" id="ApplicantDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel">Applicant Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="alert"></div>
                <form id="applicant-reg-form">
                    <div class="row g-3">
                        <!-- Personal Information -->
                        <input type="hidden" name="applicant_id" id="applicant_id" class="form-control">
                        <h5 class="bg-dark text-white p-3 text-center">Personal Information</h5>
                        <div class="col-md-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control no-numbers" placeholder="Enter your Firstname" required>
                        </div>
                        <div class="col-md-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" name="middlename" id="middlename" class="form-control no-numbers" placeholder="Enter your Middlename">
                        </div>
                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control no-numbers" placeholder="Enter your Lastname" required>
                        </div>
                        <div class="col-md-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control no-numbers" placeholder="Enter your Suffix">
                        </div>

                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="" selected disabled> -- Select Gender --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                        <div class="col-md-4">
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

                        <div class="col-md-12">
                            <label for="address" class="form-label">Complete Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="(Blk/Lot/Subdi/Ph/Barangay/City)" required>
                        </div>

                        <!-- Contact -->
                        <h5 class="mt-4 bg-dark text-white p-3 text-center">Contact Information</h5>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile_no" class="form-label">Mobile No</label>
                            <input type="text" name="mobile_no" id="mobile_no" class="form-control no-letters" maxlength="11" placeholder="09XXXXXXXXX" required>
                        </div>

                        <!-- Education -->
                        <h5 class="mt-4 bg-dark text-white p-3 text-center">Educational Background</h5>
                        <div class="col-md-4">
                            <label for="shs_school" class="form-label">Shs School</label>
                            <select name="shs_school" id="shs_school" class="form-select" required>
                                <option value="" disabled selected> -- Select School --</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="strand" class="form-label">Strand</label>
                            <select name="strand" id="strand" class="form-select" required>
                                <option value="" disabled selected> -- Select Strand --</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="year_graduated" class="form-label">Year Graduated</label>
                            <input type="text" name="year_graduated" id="year_graduated" class="form-control no-letters" maxlength="4" required>
                        </div>

                        <!-- Application -->
                        <h5 class="mt-4 bg-dark text-white p-3 text-center">Application Details</h5>
                        <div class="col-md-6">
                            <label for="applicant_type" class="form-label">Type of applicant</label>
                            <select name="applicant_type" id="applicant_type" class="form-select" required>
                                <option value="" selected disabled> --Select Course-- </option>
                                <option value="Freshmen">Freshmen</option>
                                <option value="Transferee">Transferee</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Desired Course</label>
                            <select name="desired_course" id="desired_course" class="form-select">
                                <option value="" selected> --Select Desired Course-- </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sy" class="form-label">School Year</label>
                            <select name="sy" id="sy" class="form-select" required>
                                <option value="" selected disabled> --Select School Year-- </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="semester" class="form-label">Semester</label>
                            <select name="semester" id="semester" class="form-select" required>
                                <option value="" selected disabled> --Select Semester-- </option>
                            </select>
                        </div>

                        <!-- Transferee Fields -->
                        <div class="mt-4 row d-none" id="transferee_dtl_container">
                            <h5 class="bg-dark text-white p-3 text-center">Transferee Data</h5>
                            <div class="col-md-4">
                                <label class="form-label">Previous School</label>
                                <input type="text" class="form-control transferee_inputs" name="transferee_prv_school" id="transferee_prv_school">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Previous Course</label>
                                <input type="text" class="form-control transferee_inputs" name="transferee_prv_course" id="transferee_prv_course">
                            </div>
                            <div class="col-md-4">
                                <label for="transferee_yr_level" class="form-label">Year Level (Transferee)</label>
                                <select name="transferee_yr_level" id="transferee_yr_level" class="form-select transferee_inputs" required>
                                    <option value="" selected disabled> --Select Year Level-- </option>
                                    <option value="1st">First Year</option>
                                    <option value="2nd">Second Year</option>
                                    <option value="3rd">Third Year</option>
                                    <option value="4th">Fourth Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center align-content-center">
                <button type="button" class="btn btn-warning" id="updateApplicant">Update</button>
                <button type="button" class="btn btn-danger" id="reject">Reject</button>
                <button type="button" class="btn btn-primary" id="eval">Proceed to Evaluation</button>
                <!-- <button type="button" class="btn btn-primary" id="credit">Proceed to Subject Crediting</button> -->
            </div>
        </div>
    </div>
</div>