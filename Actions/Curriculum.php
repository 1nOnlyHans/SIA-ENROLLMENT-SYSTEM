<?php
require "../Helpers/InputHandler.php";
require "../class/Curriculum.php";

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$action = new Curriculum();
$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case 'CreateCurriculum':
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $curriculum_name = InputHandler::sanitize_string($_POST['curriculum_name'] ?? '');
            $sy = InputHandler::sanitize_int($_POST['sy'] ?? '');
            $subjects = $_POST['subject_id'] ?? [];
            $response = $action->createCourseCurriculum($course_id, $curriculum_name, $sy, $subjects);
        }
        break;
    case 'GetAllCurriculum':
        if ($requestMethod === "GET") {
            $response = $action->getAllCurriculums();
        }
        break;
    case 'GetCurriculum':
        if ($requestMethod === "POST") {
            $curriculum_id = InputHandler::sanitize_int($_POST['curriculum_id'] ?? '');
            $response = $action->getCurriculum($curriculum_id);
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
}

echo json_encode($response);
