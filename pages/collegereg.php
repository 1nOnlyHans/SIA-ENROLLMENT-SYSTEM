<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>College Registration</title>

    <?php
    include "../includes/lib.php";
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top px-4 bg-primary shadow">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="../assets//ncst-logo.png" alt="Logo" style="max-height: 50px; margin-right: 10px;">
                <h5 class="mb-0 text-warning fw-bold">NCST Admission</h5>
            </div>
            <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="admission.php" class="nav-link text-white">Requirements</a>
                    </li>
                    <li class="nav-item">
                        <a href="collegereg.php" class="nav-link text-warning fw-bold">College</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <?php
        include "../includes/AdmissionForm.php";
        ?>
    </div>


</body>

</html>