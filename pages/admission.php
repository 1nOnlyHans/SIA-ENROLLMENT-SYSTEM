<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NCST Enrollment Requirements</title>

    <?php
    include "../includes/lib.php";
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top px-4 bg-primary shadow">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="../assets/ncst-logo.png" alt="Logo" style="max-height: 50px; margin-right: 10px;">
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
                        <a href="admission.php" class="nav-link text-warning fw-bold">Requirements</a>
                    </li>
                    <li class="nav-item">
                        <a href="collegereg.php" class="nav-link text-white ">College</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card bg-white bg-opacity-75 rounded-4 shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h3 class="text-primary fw-bold">Enrollment Requirements</h3>
                            <h4 class="text-primary fw-bold">College Freshmen</h4>
                        </div>
                        <p>If you are incoming freshmen, the following documents are required for admission:</p>
                        <ul>
                            <li>Properly accomplished admission form</li>
                            <li>Four (4) 2×2 recent, identical color pictures in white background with name tag.</li>
                            <li>Five (5) 1×1 recent, identical color pictures in white background with name tag.</li>
                            <li>Submit original and photocopied Form 138 / Report Card</li>
                            <li>Submit original Good Moral Character certificate with dry seal and Photocopied</li>
                            <li>If married, two (2) photocopies of marriage certificate duly signed by a priest / minister.</li>
                            <li>1pc. Long Brown Envelope</li>
                            <li>TOR (if transferee)</li>
                        </ul>
                        <p>The NCST Admissions Office is open from Monday to Saturday 8am to 5pm.</p>
                        <p>For more details regarding admissions, please call us at (046) 416-627</p>

                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-warning fw-bold rounded-pill px-4 py-2">
                                <i class="fa fa-arrow-left me-2"></i> Back to NCST Main Page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>