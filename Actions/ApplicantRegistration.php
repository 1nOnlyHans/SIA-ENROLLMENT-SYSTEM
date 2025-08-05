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
$status = '';
$errors = [];
$inputs = [];

$commonFields = [
    'applicant_type',
    'sy',
    'semester',
    'desired_course',
    'firstname',
    'lastname',
    'gender',
    'nationality',
    'dob',
    'address',
    'email',
    'mobile_no',
    'shs_school',
    'year_graduated',
    'strand'
];
$transfereeExtraFields = ['transferee_yr_level', 'transferee_prv_school', 'transferee_prv_course'];

$optionalFields = ['middlename', 'suffix'];

$fieldTypes = [
    'applicant_type' => 'string',
    'transferee_yr_level' => 'string',
    'sy' => 'string',
    'semester' => 'string',
    'desired_course' => 'string',
    'firstname' => 'name',
    'middlename' => 'name',
    'lastname' => 'name',
    'suffix' => 'name',
    'gender' => 'string',
    'nationality' => 'string',
    'dob' => 'string',
    'address' => 'string',
    'email' => 'email',
    'mobile_no' => 'mobile',
    'transferee_prv_school' => 'string',
    'transferee_prv_course' => 'string',
    'shs_school' => 'string',
    'year_graduated' => 'year',
    'strand' => 'string'
];

$fields = array_merge($commonFields, $optionalFields, $transfereeExtraFields);

foreach ($fieldTypes as $field => $type) {
    $inputs[$field] = $sanitize->sanitize($field, '', $type);
}

//JSON
$file = "../json/registration.json";
$current_data = file_get_contents($file);

switch ($step) {
    case 1:
        if (in_array($inputs['applicant_type'], ['Freshmen', 'Transferee'])) {
            if ($inputs['applicant_type'] === "Freshmen") {
                $requiredFields = $commonFields;
            } else {
                $requiredFields = array_merge($commonFields, $transfereeExtraFields);
            }

            $errors = $applicant->checkRequiredFields(array_values($requiredFields), $inputs);

            if (!empty(trim($inputs['dob']))) {
                if (!$applicant->checkAgeValidity($inputs['dob'])) {
                    array_push($errors, 'The applicant must be at least 17 years old');
                }
            }
        } else {
            $errors[] = "Invalid applicant Type";
        }

        $status = count($errors) > 0 ? 'error' : 'success';
        $message = "";

        if (count($errors) > 0) {
            $message = "Fill out the required fields";
            if (count($errors) === 1) {
                if (in_array('The applicant must be at least 17 years old', $errors)) {
                    $message = 'The applicant must be at least 17 years old';
                }
            }
        } else {
            $message = "";
        }

        $response = [
            "status" => $status,
            "message" => $message,
            "errors" => $errors,
            "data" => $inputs
        ];

        break;
    case 2:
        $response = [
            "status" => "success",
            "message" => "Step success",
            "errors" => $errors,
        ];
        break;
    case 3:
        $isApplicantExists = $applicant->checkIfAlreadySubmitted($inputs['firstname'], $inputs['lastname'], $inputs['email']);

        if ($isApplicantExists['status'] === "success") {
            $response = [
                "status" => "error",
                "message" => "You already submitted",
                "errors" => [
                    "Applicant already exists"
                ]
            ];
        } else {
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
        }

        break;
    case 5:
        // REFACTOR
        $action = $applicant->submitApplication(
            $inputs['applicant_type'],
            $inputs['desired_course'],
            $inputs['firstname'],
            $inputs['middlename'],
            $inputs['lastname'],
            $inputs['suffix'],
            $inputs['address'],
            $inputs['email'],
            $inputs['mobile_no'],
            $inputs['gender'],
            $inputs['nationality'],
            $inputs['dob'],
            $inputs['transferee_yr_level'],
            $inputs['transferee_prv_school'],
            $inputs['transferee_prv_course'],
            $inputs['shs_school'],
            $inputs['year_graduated'],
            $inputs['strand'],
            $inputs['sy'],
            $inputs['semester'],
        );
        $target = $inputs['email'];
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
