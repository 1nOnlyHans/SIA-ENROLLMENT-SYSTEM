<?php 
include "../includes/header.php";
include "../includes/StaffNavbar.php";
?>

<div class="container-fluid">
    <div class="row">
        <?php include "../includes/StaffSidebar.php"; ?>
        <!-- Main Content Area -->
        <div class="col-md-10 d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
            <div class="content-box text-center p-5 border border-primary rounded" style="background-color: white;">
                <button id="newStudentBtn" class="btn btn-primary btn-lg me-3" style="background-color: #64b5f6; border: none;">
                    New Student
                </button>
                <button class="btn btn-warning btn-lg" style="background-color: #fbc02d; border: none; color: white;">
                    Old Student
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('newStudentBtn').addEventListener('click', function() {
        window.location.href = 'StaffEnrollNewStudent.php';
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
