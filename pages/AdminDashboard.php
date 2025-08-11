<?php
include "../includes/AdminSidebar.php";
?>

<div class="container-fluid">
    <div class="page-inner py-4">
        <h2 class="fw-bold mb-4">Admin Dashboard</h2>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-graduate fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title mb-1">Enrolled Students</h5>
                                <h3 class="mb-0">1,250</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-book fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title mb-1">Subjects Offered</h5>
                                <h3 class="mb-0">85</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title mb-1">Applicants</h5>
                                <h3 class="mb-0">320</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 text-white bg-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-chalkboard-teacher fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title mb-1">Instructors</h5>
                                <h3 class="mb-0">42</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white fw-bold">Enrollment Trends</div>
                    <div class="card-body">
                        <canvas id="enrollmentChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white fw-bold">Quick Actions</div>
                    <div class="card-body">
                        <a href="manage_students.php" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-user-plus me-2"></i> Manage Students
                        </a>
                        <a href="manage_subjects.php" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-book me-2"></i> Manage Subjects
                        </a>
                        <a href="manage_sections.php" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-layer-group me-2"></i> Manage Sections
                        </a>
                        <a href="manage_instructors.php" class="btn btn-danger w-100">
                            <i class="fas fa-chalkboard-teacher me-2"></i> Manage Instructors
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>