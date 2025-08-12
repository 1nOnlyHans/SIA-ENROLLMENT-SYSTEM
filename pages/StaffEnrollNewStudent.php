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
                                    <a href="StaffStudentInfo.php?id=${data.id}" class="btn btn-primary">Enroll</a>
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