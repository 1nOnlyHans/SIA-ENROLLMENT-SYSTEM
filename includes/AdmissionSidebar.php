<?php
include "../includes/lib.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: sans-serif;
        background: url('../assets/newbgyellowblue.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 240px;
        background-color: rgba(8, 64, 136, 1);
        color: white;
        padding-top: 70px;
        z-index: 1000;
        transition: transform 0.3s ease;
        transform: translateX(0);
    }

    .sidebar-collapsed {
        transform: translateX(-100%);
    }

    .logo {
        position: absolute;
        top: 0;
        min-height: 60px;
        width: 100%;
        padding-left: 30px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .logo h3 {
        font-weight: 300;
        color: #ffc107;
        text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;
    }

    .sidebar ul {
        list-style: none;
        margin-top: 40px;
        padding: 0 20px;
    }

    .sidebar li {
        margin: 20px 0;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sidebar li.active {
        background-color: rgba(255, 193, 7, 0.8);
        color: black;
        font-weight: bold;
        box-shadow: inset 4px 0 0 #ffc107;
    }

    .sidebar li.active i {
        color: black !important;
    }

    .sidebar li:hover {
        background-color: rgba(255, 243, 205, 0.8);
        transform: translateX(5px);
        box-shadow: 2px 2px 10px rgba(39, 132, 255, 0.4);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
    }

    .sidebar a i {
        margin-right: 8px;
    }
</style>
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <img src="../assets/ncst-logo.png" alt="Logo" style="max-height: 50px; margin-right: 10px;">
            <h3>Admission</h3>
        </div>
        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
        <ul>
            <a href="admission.php?" onclick="closeSidebarOnMobile()">
                <li class="<?= ($currentPage == 'requirements.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-briefcase text-warning"></i> Requirements
                </li>
            </a>
            <a href="collegereg.php" onclick="closeSidebarOnMobile()">
                <li class="<?= ($currentPage == 'collegereg.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-file text-warning"></i> College
                </li>
            </a>
        </ul>
    </aside>
</body>
</html>