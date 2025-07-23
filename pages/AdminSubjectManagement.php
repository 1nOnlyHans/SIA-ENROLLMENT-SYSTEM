<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <h2>List of Subjects</h2>
                <button type="button" class="btn btn-primary mb-3">+ New Course</button>
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Subject Name</th>
                            <th>Subject Description</th>
                            <th>Year Level</th>
                            <th>Pre Requisite</th>
                            <th>Semester</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="container"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>