<?php
include "../includes/StudentNavbar.php";
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center fw-bold">Grades</h1>
            <div class="d-flex justify-content-center align-content-center gap-5">
                <div class="">
                    <select name="sy" id="sy" class="form-select">
                        <option value="" selected> --Select School Year-- </option>
                    </select>
                </div>
                <div class="">
                    <select name="semester" id="semester" class="form-select">
                        <option value="" selected> --Select Semester-- </option>
                    </select>
                </div>
            </div>
            <div class="container mt-5">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Total Units</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Pre-Finals</th>
                            <th>Finals</th>
                            <th>Final Grade</th>
                            <th>Points</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <!-- Dummy Data -->
                    <tbody class="text-center">
                        <tr>
                            <td>ENG101</td>
                            <td>English Communication 1</td>
                            <td>3</td>
                            <td>85</td>
                            <td>87</td>
                            <td>88</td>
                            <td>90</td>
                            <td>88</td>
                            <td>3.00</td>
                            <td>Passed</td>
                        </tr>
                        <tr>
                            <td>MATH102</td>
                            <td>College Algebra</td>
                            <td>3</td>
                            <td>78</td>
                            <td>80</td>
                            <td>82</td>
                            <td>85</td>
                            <td>81</td>
                            <td>2.50</td>
                            <td>Passed</td>
                        </tr>
                        <tr>
                            <td>CS103</td>
                            <td>Introduction to Programming</td>
                            <td>4</td>
                            <td>90</td>
                            <td>92</td>
                            <td>91</td>
                            <td>93</td>
                            <td>92</td>
                            <td>1.50</td>
                            <td>Passed</td>
                        </tr>
                        <tr>
                            <td>HIST104</td>
                            <td>Philippine History</td>
                            <td>2</td>
                            <td>83</td>
                            <td>84</td>
                            <td>85</td>
                            <td>87</td>
                            <td>85</td>
                            <td>2.00</td>
                            <td>Passed</td>
                        </tr>
                        <tr>
                            <td>PE105</td>
                            <td>Physical Education 1</td>
                            <td>2</td>
                            <td>95</td>
                            <td>94</td>
                            <td>93</td>
                            <td>96</td>
                            <td>95</td>
                            <td>1.00</td>
                            <td>Passed</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Functions
        // FetchSchoolYear onChange
        // FetchSYSemesters onChange
        // FetchGrades
    });
</script>
<?php
include "../includes/footer.php";
?>