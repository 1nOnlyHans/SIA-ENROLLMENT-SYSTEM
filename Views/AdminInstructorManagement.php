<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-body">
                <h2>List of Instructors</h2>
                <button type="button" class="btn btn-primary mb-3">+ New Instructor</button>
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="container"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>