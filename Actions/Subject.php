<?php
require "../class/Subject.php";
require "../Helpers/InputHandler.php";

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$action = new Subject();
$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];


switch ($actionType) {
    case "CreateSubject":
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $subject_code = InputHandler::sanitize_string($_POST['subject_code'] ?? '');
            $subject_name = InputHandler::sanitize_name($_POST['subject_name'] ?? '');
            $pre_requisite = InputHandler::sanitize_string($_POST['pre_requisite'] ?? '');
            $units = InputHandler::sanitize_int($_POST['units'] ?? '');
            $type = $_POST['type'] ?? [];
            // foreach ($type as $t) {
            //     $t = InputHandler::sanitize_string($t);
            //     return $t;
            // }
            $year_lvl = InputHandler::sanitize_string($_POST['year_lvl'] ?? '');;
            $semester = InputHandler::sanitize_int($_POST['semester'] ?? '');;

            $response = $action->createSubject($course_id, $subject_code, $subject_name, $pre_requisite, $units, $type, $year_lvl, $semester);
        }

        break;
    case "GetAllSubjectByCourse":
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $response = $action->getAllSubjects($course_id);
        }
        break;
    case "GetAllSubjects":
        if ($requestMethod === "GET") {
            $response = $action->getAllSubjects();
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
