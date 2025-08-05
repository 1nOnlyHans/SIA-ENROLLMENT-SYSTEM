<?php
require "../class/AcademicSettings.php";
require "../Helpers/InputHandler.php";


$action = new AcademicSettings();

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$request_method = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case 'GetActiveAcademicPeriod':
        if ($request_method === "GET") {
            $response = $action->getActiveAcademicPeriod();
        }
        break;
    case 'GetActiveSchoolYear':
        if ($request_method === "GET") {
            $response = $action->getActiveSchoolYear();
        }
        break;
    case 'GetActiveSemester':
        if ($request_method === "GET") {
            $response = $action->getActiveSemesterForActiveSy();
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
}

echo json_encode($response);
