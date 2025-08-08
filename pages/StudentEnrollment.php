<?php
include "../includes/StudentNavbar.php";
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center fw-bold">Pre Enrollment</h1>
            <div class="">
                <label for="section" class="form-label">Sections</label>
                <select name="section" id="section" class="form-select">
                    <option value="" selected> -Select Section-- </option>
                    <option value="M1">11M1</option>
                    <option value="M2">11M2</option>
                    <option value="M3">11M3</option>
                    <option value="M4">11M4</option>
                    <option value="A1">11A1</option>
                    <option value="A2">11A2</option>
                    <option value="A3">11A3</option>
                    <option value="A4">11A4</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Units</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Section</th>
                        <th>Room</th>
                        <th>Instructor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CS101</td>
                        <td>Introduction to Computing</td>
                        <td>3</td>
                        <td>Lec</td>
                        <td>Mon, Wed</td>
                        <td>08:00 AM</td>
                        <td>09:30 AM</td>
                        <td>BSIT-1A</td>
                        <td>Room 101</td>
                        <td>Mr. Santos</td>
                    </tr>
                    <tr>
                        <td>MATH110</td>
                        <td>Discrete Mathematics</td>
                        <td>3</td>
                        <td>Lec</td>
                        <td>Tue, Thu</td>
                        <td>10:00 AM</td>
                        <td>11:30 AM</td>
                        <td>BSIT-1A</td>
                        <td>Room 204</td>
                        <td>Ms. Reyes</td>
                    </tr>
                    <tr>
                        <td>CS102L</td>
                        <td>Computer Programming Lab</td>
                        <td>1</td>
                        <td>Lab</td>
                        <td>Fri</td>
                        <td>01:00 PM</td>
                        <td>03:00 PM</td>
                        <td>BSIT-1A</td>
                        <td>Lab 3</td>
                        <td>Engr. Dela Cruz</td>
                    </tr>
                    <tr>
                        <td>ENG101</td>
                        <td>Purposive Communication</td>
                        <td>3</td>
                        <td>Lec</td>
                        <td>Mon, Wed</td>
                        <td>01:00 PM</td>
                        <td>02:30 PM</td>
                        <td>BSIT-1A</td>
                        <td>Room 102</td>
                        <td>Prof. Garcia</td>
                    </tr>
                    <tr>
                        <td>PE101</td>
                        <td>Physical Education 1</td>
                        <td>2</td>
                        <td>Lec</td>
                        <td>Sat</td>
                        <td>08:00 AM</td>
                        <td>10:00 AM</td>
                        <td>BSIT-1A</td>
                        <td>Gym</td>
                        <td>Coach Mendoza</td>
                    </tr>
                </tbody>
            </table>

            <div class="py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-primary">Enroll to this section</button>
            </div>
        </div>
    </div>
</div>

<?php
include "../includes/footer.php";
?>