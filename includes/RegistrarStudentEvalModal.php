<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="evaluationModalLabel">Applicant Evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Applicant Info -->
                <div class="mb-3">
                    <p id="view_applicant_fullname_eval" class="mb-1"><strong>Name:</strong></p>
                    <p id="view_applicant_type_eval" class="mb-1"><strong>Applicant Type:</strong> </p>
                    <p id="view_applicant_course_eval" class="mb-0"><strong>Course Applied:</strong> </p>
                </div>

                <form method="post" id="eval-form">
                    <!-- Applicant Info -->
                    <div class="d-none">
                        <input type="text" name="applicant_id_eval" id="applicant_id_eval">
                        <input type="text" name="applicant_type_eval" id="applicant_type_eval">
                        <input type="text" name="applicant_course_eval" id="applicant_course_eval">
                    </div>

                    <!-- Documents -->
                    <div class="documents mb-3">
                        <h6 class="fw-bold">Documents</h6>
                        <div class="row g-2" id="documentsContainer">
                        </div>
                    </div>

                    <!-- Evaluation Form -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Evaluation Result</label>
                        <select id="evalResult" name="evalResult" class="form-select">
                            <option value=""> -- Select Result --</option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="evalRemarks" class="form-label fw-bold">Remarks</label>
                        <select name="evalRemarks" id="evalRemarks" class="form-select" required>
                            <option value="" selected> --Select Remarks-- </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="evalRemarksNote" class="form-label fw-bold">Remarks Note</label>
                        <textarea name="evalRemarksNote" id="evalRemarksNote" class="form-control">
                        </textarea>
                    </div>

                    <!-- For Transferee Option -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="creditingOption">
                        <label class="form-check-label" for="creditingOption">
                            Proceed to Subject Crediting (Transferees only)
                        </label>
                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="saveEvaluation">Save Evaluation</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const checkApplicantType = () => {
            if ($('#applicant_type') === "Transferee") {
                $('.transferee_docs').removeClass('d-none');
            } else {
                $('.transferee_docs').addClass('d-none');
            }
        }

        const passRemarks = [{
                value: "Complete Documents and Approved for Enrollment"
            },
            {
                value: "Minor documents are missing but approved for enrollment"
            }
        ];

        const failedRemarks = [{
                value: "Incomplete Documents - Enrollment Denied"
            },
            {
                value: "Invalid Document Submitted"
            },
            {
                value: "Did Not Meet Requirements"
            }
        ];

        $('#evalResult').on('change', function() {
            const evalRemarks = $('#evalRemarks');
            evalRemarks.empty();
            if ($(this).val() === "Pass") {
                passRemarks.forEach((item) => {
                    evalRemarks.append($('<option></option>').val(item.value).text(item.value));
                });
            } else {
                failedRemarks.forEach((item) => {
                    evalRemarks.append($('<option></option>').val(item.value).text(item.value));
                });
            }
        });


    });
</script>