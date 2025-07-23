<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements</title>
    <?php
    include "../includes/lib.php";
    ?>
    <link rel="stylesheet" href="../css/admission.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body style="background-image: url(../assets/bg.jpg);">
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
    </button>
    <!--sidebar-->
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/ncst-logo.png" alt="" height="40px" width="40px">
            <h3>NCST Registration</h3>
        </div>
        <ul>
            <a href="admission.php">
                <li><i class="fa-solid fa-house" style="color: #ffffff;"></i>Requirements</li>
            </a>
            <a href="collegereg.php">
                <li><i class="fa-solid fa-file" style="color: #ffffff;"></i>College</li>
            </a>
        </ul>
    </aside>
    <!--sidebar-->
    <!--main content/body-->
    <div class="main-content">
        <div class="navbar">
            <a href="index.php#about">
                <h4>About</h4>
            </a>
        </div>
        <div class="content">
            <!--card-->
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h3 class="title-content">Enrollment Requirements</h3>
                        <h4 class="title-content">College Freshmen</h4>
                    </div>
                    <div class="card-desc">
                        <p>If you are incoming freshmen, the following documents are required for admission.</p>
                        <ul>
                            <li>Properly accomplished admission form</li>
                            <li>Four (4) 2×2 recent, identical color pictures in white background with name tag.</li>
                            <li>Five (5) 1×1 recent, identical color pictures in white background with name tag.</li>
                            <li>Submit original and photocopied Form 138 / Report Card</li>
                            <li>Submit original Good Moral Character certificate with dry seal and Photocopied</li>
                            <li>If married, two (2) photocopies of marriage certificate duly signed by a priest / minister.</li>
                            <li>1pc. Long Brown Envelope</li>
                        </ul>
                        <p>The NCST Admissions Office is open from Monday to Saturday 8am to 5pm.</p>
                        <p>For more details regarding admissions, please call us at (046) 416-627</p>
                    </div>
                    <div class="card-button">
                        <button class="rturn-btn" onclick="window.location.href='index.php'">Go back to NCST main page</button>

                    </div>
                </div>
            </div>
            <!--card-->
        </div>
    </div>
    <!--main content/body-->
    <script src="../js/admission.js"></script>
</body>

</html>