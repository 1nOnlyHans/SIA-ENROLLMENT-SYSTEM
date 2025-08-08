<?php
include "../includes/CashierNavbar.php";
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Payment ID</th>
                        <th>Student ID</th>
                        <th>Type</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>1001-5</td>
                        <td>2023-12345</td>
                        <td>Tuition Fee</td>
                        <td>Cash</td>
                        <td>August 7, 2025 5:25PM</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-danger">
                                    Print
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include "../includes/footer.php";
?>