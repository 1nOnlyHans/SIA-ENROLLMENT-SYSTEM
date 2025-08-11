<?php
include "../includes/header.php";
include "../includes/StaffNavbar.php";

?>

<div class="d-flex">
    <?php include "../includes/StaffSidebar.php"; ?>

    <div class="flex-grow-1 p-3">
        <div class="container-fluid">
            <h1>New Enrollees</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="applicant-tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Desired Course</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="enrollment-tab">
            <div class="card">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Student Enrollment</h2>
                </div>
                <div class="card-body">
                    <div class="applicant-info">
                        <p class="text-secondary fw-bold my-3">Student Details</p>
                        <hr class="mb-3">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Name: </label>
                                    <input type="text" class="form-control" id="name" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Type: </label>
                                    <input type="text" class="form-control" id="type" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Course: </label>
                                    <input type="text" class="form-control" id="course" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sections my-3">
                        <p class="text-secondary fw-bold my-3">Enrollment Details</p>
                        <hr class="mb-3">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Year Level: </label>
                                    <select name="year_level" id="year_level" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Section: </label>
                                    <select name="section" id="section" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-row align-items-center gap-3">
                                    <label for="fullname">Subjects: </label>
                                    <select name="subjects" id="subjects" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../includes/EnrollModal.php";
?>
<script>
    $(document).ready(function() {
        const fetchEvaluatedApplicants = async () => {
            try {
                const response = await fetch('../Actions/Applicant.php?actionType=GetAllEvaluated');
                const data = await response.json();
                console.log(data);

                $('#applicant-tbl').DataTable().clear().destroy();

                $('#applicant-tbl').DataTable({
                    data: data.data,
                    columns: [{
                            data: null,
                            class: "text-center",
                            render: (data) => `${data.firstname} ${data.lastname}`
                        },
                        {
                            data: "course_code",
                            class: "text-center"
                        },
                        {
                            data: null,
                            class: "text-center",
                            render: (data) => `
                                <div class="d-flex justify-content-center align-content-center">
                                    <button type="button" class="btn btn-dark" id="view"
                                        data-details='${JSON.stringify(data)}'>
                                        Enroll
                                    </button>
                                </div>
                            `
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
                        title: "Pending Applicants",
                        text: "Print",
                        className: "btn btn-danger me-3 mb-3",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }]
                });
            } catch (error) {
                console.log(error);
            }
        };

        fetchEvaluatedApplicants();
    });
</script>