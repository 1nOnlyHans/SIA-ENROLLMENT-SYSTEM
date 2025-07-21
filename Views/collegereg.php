<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College registration</title>
    <?php
        include "../includes/lib.php";
    ?>
    <link rel="stylesheet" href="../css/admission.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body style="background-image: url(../assets/bg.jpg);">
    <!--hamburgerBtn-->
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
    <!--/sidebar-->
    <!--main content/body-->
    <div class="main-content">
        <div class="navbar">
            <a href="index.php#about">
                <h4>About</h4>
            </a>
        </div>
        <!--form-->
        <?php
            include "../includes/AdmissionForm.php"
        ?>
    
</body>
</html>