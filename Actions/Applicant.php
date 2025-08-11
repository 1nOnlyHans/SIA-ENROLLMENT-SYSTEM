<?php

require "../class/Applicant.php";
require "../Helpers/InputHandler.php";

$action = new Applicant;

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case "GetAllApplicants":
        $response = $action->getAllApplicants();
        break;
    case "GetAllPendingApplicants":
        if ($requestMethod === "GET") {
            $response = $action->getAllPendingApplicants();
        }
        break;
    case "GetAllEvaluated":
        if ($requestMethod === "GET") {
            $response = $action->getAllEvaluated();
        }
        break;
    case "UpdateApplicant":
        if ($requestMethod === "POST") {
            $applicant_id = InputHandler::sanitize_int($_POST['applicant_id'] ?? '');
            $applicant_type = InputHandler::sanitize_string($_POST['applicant_type'] ?? '');
            $desired_course = InputHandler::sanitize_string($_POST['desired_course'] ?? '');
            $firstname = InputHandler::sanitize_string($_POST['firstname'] ?? '');
            $middlename = InputHandler::sanitize_string($_POST['middlename'] ?? '');
            $lastname = InputHandler::sanitize_string($_POST['lastname'] ?? '');
            $suffix = InputHandler::sanitize_string($_POST['suffix'] ?? '');
            $address = InputHandler::sanitize_string($_POST['address'] ?? '');
            $email = InputHandler::sanitize_email($_POST['email'] ?? '');
            $mobile_no = InputHandler::sanitize_mobile($_POST['mobile_no'] ?? '');
            $gender = InputHandler::sanitize_string($_POST['gender'] ?? '');
            $nationality = InputHandler::sanitize_string($_POST['nationality'] ?? '');
            $dob = InputHandler::sanitize_string($_POST['dob'] ?? '');
            $transferee_yr_level = InputHandler::sanitize_string($_POST['transferee_yr_level'] ?? '');
            $transferee_prv_school = InputHandler::sanitize_string($_POST['transferee_prv_school'] ?? '');
            $transferee_prv_course = InputHandler::sanitize_string($_POST['transferee_prv_course'] ?? '');
            $shs_school = InputHandler::sanitize_string($_POST['shs_school'] ?? '');
            $year_graduated = InputHandler::sanitize_string($_POST['year_graduated'] ?? '');
            $strand = InputHandler::sanitize_string($_POST['strand'] ?? '');
            $sy = InputHandler::sanitize_int($_POST['sy'] ?? '');
            $semester = InputHandler::sanitize_int($_POST['semester'] ?? '');

            $response = $action->updateApplicantForm($applicant_id, $applicant_type, $desired_course, $firstname, $middlename, $lastname, $suffix, $address, $email, $mobile_no, $gender, $nationality, $dob, $transferee_yr_level, $transferee_prv_school, $transferee_prv_course, $shs_school, $year_graduated, $strand, $sy, $semester);
        }
        break;
    case 'GetSubjectCreditingStudents':
        if ($requestMethod === "GET") {
            $response = $action->getSubjectCreditingApplicants();
        }
        break;
    case 'GetApplicantById':
        if ($requestMethod === "GET") {
            $applicant_id = InputHandler::sanitize_int($_GET['id'] ?? '');
            $response = $action->getApplicantById($applicant_id);
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
        break;
}

echo json_encode($response);
