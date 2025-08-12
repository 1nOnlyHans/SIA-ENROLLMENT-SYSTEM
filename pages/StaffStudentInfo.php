<?php
include "../includes/header.php";
include "../includes/StaffNavbar.php";
include "../class/Dbh.php";
?>

<div class="d-flex">
    <?php include "../includes/StaffSidebar.php"; ?>

    <div class="flex-grow-1 p-4" style="background-color: #e6e6e6; min-height: calc(100vh - 56px);">
        <div class="card p-4">
            <h4 class="mb-4">Student Information</h4>

            <?php
            $student = null;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $conn = (new Dbh())->Connect();
                $stmt = $conn->prepare(
                    "SELECT a.*, c.course_code 
                     FROM applicants a
                     LEFT JOIN courses c ON a.desired_course = c.id
                     WHERE a.id = ?"
                );
                $stmt->execute([$id]);
                $student = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>

            <?php if ($student): ?>
                <p><strong>Name:</strong> <?= htmlspecialchars($student['firstname'] . " " . $student['lastname']) ?></p>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Course:</strong> <?= htmlspecialchars($student['course_code']) ?>
                    </div>
                </div>
                <p><strong>Section:</strong> <?= !empty($student['section']) ? htmlspecialchars($student['section']) : "Not Assigned" ?></p>

                <a href="StaffSelectSection.php?id=<?= urlencode($student['id']) ?>" class="btn btn-success mb-2 w-25">Assign Section</a><br>
                <a href="#" class="btn btn-success w-25">Print Form</a>
            <?php else: ?>
                <div class="alert alert-danger">Student not found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
