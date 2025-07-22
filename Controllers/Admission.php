<?php
require "../Helpers/InputValidator.php";

require '../Models/Applicant.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

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

    $action = new Applicant();

    echo json_encode(

        $action->submitOnlineAdmission(
            $inputs['firstname'],
            $inputs['middlename'],
            $inputs['lastname'],
            $inputs['suffix'],
            $inputs['birthdate'],
            $inputs['gender'],
            $inputs['civil_status'],
            $inputs['nationality'],
            $inputs['place_of_birth'],
            $inputs['religion'],
            $inputs['address'],
            $inputs['zip_code'],
            $inputs['mobile_no'],
            $inputs['primary_school'],
            $inputs['primary_year_graduated'],
            $inputs['secondary_school'],
            $inputs['secondary_year_graduated'],
            $inputs['tertiary_school'],
            $inputs['tertiary_year_graduated'],
            $inputs['course_graduated'],
            $inputs['father_firstname'],
            $inputs['father_middle_name'],
            $inputs['father_lastname'],
            $inputs['father_address'],
            $inputs['father_phoneNumber'],
            $inputs['father_occupation'],
            $inputs['father_deceased'],
            $inputs['mother_firstname'],
            $inputs['mother_middlename'],
            $inputs['mother_lastname'],
            $inputs['mother_address'],
            $inputs['mother_phone'],
            $inputs['guardian_firstname'],
            $inputs['guardian_middlename'],
            $inputs['guardian_lastname'],
            $inputs['guardian_address'],
            $inputs['guardian_phone'],
            $inputs['guardian_occupation'],
            $inputs['guardian_relationship'],
        )
    );
}
