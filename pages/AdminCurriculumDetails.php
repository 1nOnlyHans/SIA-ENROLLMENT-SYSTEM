<?php
include "../includes/AdminSidebar.php";
?>

<div class="container">
    <div class="page-inner">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Units</th>
                    <th>Pre Requisite</th>
                </tr>
            </thead>
            <tbody id="container">
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        let urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('curriculum_id');

        const fetchCurriculumData = async () => {
            try {
                const response = await $.ajax({
                    method: "POST",
                    url: "../Actions/Curriculum.php?actionType=GetCurriculum",
                    data: {
                        curriculum_id: id
                    },
                    dataType: "json"
                });
                console.log(response);
                if (response.status === "success") {
                    const container = $('#container');
                    container.empty();
                    const subjects = response.data.map((subject) => `
                        <tr>
                            <td>${subject.year_lvl}</td>
                            <td>${subject.semester}</td>
                            <td>${subject.subject_code}</td>
                            <td>${subject.subject_name}</td>
                            <td>${subject.type}</td>
                            <td>${subject.total_units}</td>
                            <td>${subject.pre_requisite}</td>
                        </tr>
                    `).join("");

                    container.append(subjects);
                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchCurriculumData();
    });
</script>