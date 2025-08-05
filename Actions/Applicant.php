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
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
        break;
}

echo json_encode($response);
