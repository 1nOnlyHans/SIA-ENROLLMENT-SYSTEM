<?php
require_once "../class/Applicant.php";
require_once "../Helpers/InputValidator.php";

$sanitize = new InputValidator();
$applicant = new Applicant();

$step = $sanitize->sanitize('step');

$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

$other_fields = ['middlename', 'suffix'];

$required_fields = [
    'desired_course',
    'firstname',
    'lastname',
    'gender',
    'nationality',
    'dob',
    'address',
    'email',
    'shs_school',
    'year_graduated',
    'course_strand'
];

$all_fields = array_merge($other_fields, $required_fields);

$inputs = [];
$errors = [];
$status = 'success';

foreach ($all_fields as $field) {
    $inputs[$field] = $sanitize->sanitize($field, '', true);
}

switch ($step) {
    case 1:
        foreach ($required_fields as $field) {
            if (empty($inputs[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' ' . 'is required';
            }
        }

        if (count($errors) > 0) {
            $status = 'error';
        }

        $response = [
            "status" => $status,
            "errors" => $errors,
            "data" => $inputs
        ];

        break;
    case 2:
        $response = [
            "status" => "success",
            "errors" => $errors,
        ];
        break;
    case 3:
        $file = "../json/registration.json";
        $current_data = file_get_contents($file);
        $data = json_decode($current_data, true);
        $data_to_insert = $inputs;
        $data[] = $data_to_insert;
        $final_data = json_encode($data, JSON_PRETTY_PRINT);
        if (file_exists($file)) {
            if (file_put_contents($file, $final_data)) {
                $response = [
                    "status" => "success",
                    "message" => "Data append successfully",
                    "errors" => []
                ];
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Data append failed",
                    "errors" => []
                ];
            }
        }
        break;
    case 5:
        // REFACTOR
        $action = $applicant->submitApplication(
            $inputs['desired_course'],
            $inputs['firstname'],
            $inputs['middlename'],
            $inputs['lastname'],
            $inputs['suffix'],
            $inputs['gender'],
            $inputs['nationality'],
            $inputs['dob'],
            $inputs['address'],
            $inputs['email'],
            $inputs['shs_school'],
            $inputs['year_graduated'],
            $inputs['course_strand']
        );
        $target = $inputs['email'];
        $file = "../json/registration.json";
        $current_data = file_get_contents($file);
        $data = json_decode($current_data, true);

        if (!is_array($data)) {
            $data = [];
        }

        $data = array_filter($data, function ($entry) use ($target) {
            return $entry['email'] !== $target;
        });

        $data = array_values($data);

        $final_data = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents($file, $final_data)) {
            $response = [
                $action,
                "errors" => [],
                "message" => "User removed successfully."
            ];
        } else {
            $response = [
                "status" => "error",
                "message" => "Failed to write to JSON file. Check file permissions.",
            ];
        }

        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action"
        ];
}

echo json_encode($response);
