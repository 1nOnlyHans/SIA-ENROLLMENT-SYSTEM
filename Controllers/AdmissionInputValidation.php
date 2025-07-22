<?php
require "../Helpers/InputValidator.php";
require "../Models/Applicant.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $step = isset($_POST['currentStep']) ? (int)$_POST['currentStep'] : 0;
    $step1_required = ['desired_course'];
    $step2_required = [
        'firstname',
        'lastname',
        'birthdate',
        'gender',
        'civil_status',
        'nationality',
        'place_of_birth',
        'religion',
        'primary_school',
        'primary_year_graduated',
        'secondary_school',
        'secondary_year_graduated',
        'tertiary_school',
        'tertiary_year_graduated',
        'course_graduated',
        'father_firstname',
        'father_lastname',
        'father_address',
        'father_phoneNumber',
        'mother_firstname',
        'mother_lastname',
        'mother_address',
        'mother_phone',
        'guardian_firstname',
        'guardian_lastname',
        'guardian_address',
        'guardian_phone',
        'guardian_relationship',
        'address',
        'zip_code',
        'mobile_no'
    ];

    $all_fields = array_merge(
        ['desired_course'], // step 1
        [
            'firstname',
            'middlename',
            'lastname',
            'suffix',
            'birthdate',
            'gender',
            'civil_status',
            'nationality',
            'place_of_birth',
            'religion',
            'primary_school',
            'primary_year_graduated',
            'secondary_school',
            'secondary_year_graduated',
            'tertiary_school',
            'tertiary_year_graduated',
            'course_graduated',
            'father_firstname',
            'father_middle_name',
            'father_lastname',
            'father_address',
            'father_phoneNumber',
            'father_occupation',
            'father_deceased',
            'mother_firstname',
            'mother_middlename',
            'mother_lastname',
            'mother_address',
            'mother_phone',
            'mother_deceased',
            'guardian_firstname',
            'guardian_middlename',
            'guardian_lastname',
            'guardian_address',
            'guardian_phone',
            'guardian_occupation',
            'guardian_relationship',
            'address',
            'zip_code',
            'mobile_no'
        ]
    );

    $inputs = [];

    $sanitze = new InputValidator();

    foreach ($all_fields as $field) {
        $inputs[$field] = $sanitze->sanitize($field,'',true);
    }

    $errors = [];

    switch ($step) {
        case 1:
            foreach ($step1_required as $field) {
                if (empty($inputs[$field])) {
                    $errors[] = ucfirst(str_replace("_", " ", $field)) . " is required";
                }
            }
            echo json_encode(["errors" => $errors]);
            break;
        case 2:
            foreach ($step2_required as $field) {
                if (empty($inputs[$field])) {
                    $errors[] = ucfirst(str_replace("_", " ", $field)) . " is required";
                }
            }
            if (count($errors) > 0) {
                echo json_encode(["errors" => $errors]);
            } else {
                echo json_encode([
                    "errors" => $errors,
                    "datas" => $inputs
                ]);
            }
            break;
        case 3:
            echo json_encode([
                "errors" => [],
                "datas" => $inputs
            ]);
            break;
        default:
            echo json_encode([
                "errors" => [
                    "Invalid Step"
                ],
            ]);
            break;
    }
}
