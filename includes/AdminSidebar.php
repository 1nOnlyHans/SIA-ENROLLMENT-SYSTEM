<?php
session_start();
include "../includes/sessionchecker.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo $_GET["page"]; ?></title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <?php
  require_once "lib.php";
  require_once "regQueue.php";
  ?>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header bg-primary">
          <p class="text-white h5 fw-bold">Enrollment System</p>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner bg-dark">
        <div class="sidebar-content">
          <ul class="nav nav-primary">
            <li class="nav-item">
              <a href="AdminDashboard.php?page=AdminDashboard">
                <i class="fa-solid fa-gauge"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminUserManagement.php?page=UserManagement">
                <i class="fa-solid fa-users-cog"></i>
                <p>User Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminCurriculumManagement.php?page=Curriculum Management">
                <i class="fa-solid fa-layer-group"></i>
                <p>Curriculum Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminDepartmentManagement.php?page=Department Management">
                <i class="fa-solid fa-building-columns"></i>
                <p>Department Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminCourseManagement.php?page=Course Management">
                <i class="fa-solid fa-book-open"></i>
                <p>Course Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminSubjectManagement.php?page=Subject Management">
                <i class="fa-solid fa-book"></i>
                <p>Subject Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminSectionManagement.php?page=Section Management">
                <i class="fa-solid fa-book"></i>
                <p>Section Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="AdminInstructorManagement.php?page=Instructor Management">
                <i class="fa-solid fa-person-chalkboard"></i>
                <p>Instructor Management</p>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header bg-primary">
            <a href="index.html" class="logo text-white">
              Admin Panel
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg bg-primary">
          <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false">
                  <div class="avatar-sm">
                    <!-- <img
                        src="public/uploads/profile-img/"
                        alt="..."
                        class="avatar-img rounded-circle"
                      /> -->
                  </div>
                  <span class="profile-username">
                    <span class="op-7 text-white">Hi,</span>
                    <span class="fw-bold text-white">
                      <?php
                      echo $_SESSION['current_user']['role'];
                      ?>
                    </span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn me-5">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="u-text text-white">
                          <h4>
                            <?php
                            echo $_SESSION['current_user']['role'];
                            ?>
                          </h4>
                          <p class="text-muted ">
                            <?php
                            echo $_SESSION['current_user']['role'];
                            ?>
                          </p>
                          <a
                            href="AdminViewProfile.php?page=Profile"
                            class="btn btn-xs btn-sm bg-primary text-white">View Profile</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <button type="button" class="dropdown-item" id="logoutBtn">Logout</button>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <script>
        $(document).ready(function() {
          $('#logoutBtn').on('click', function() {
            $.ajax({
              method: "POST",
              url: "../Actions/UserController.php",
              data: {
                actionType: "Logout"
              },
              dataType: "json",
              success: function(response) {
                console.log(response);
                if (response.status === "success") {
                  window.location.href = `Login.php`;
                }
              },
              error: function(xhr) {
                console.log(xhr.responseText);
              }
            });
          });
        });
      </script>