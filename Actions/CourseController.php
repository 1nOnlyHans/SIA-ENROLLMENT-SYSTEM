<?php
require "../Helpers/InputHandler.php";
require "../class/Course.php";

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$action = new Course();
$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];
// Refactor
switch ($actionType) {
    case 'CreateCourse':
        if ($requestMethod === "POST") {
            $department_id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $course_code = InputHandler::sanitize_string(strtoupper($_POST['course_code'] ?? ''));
            $course_name = InputHandler::sanitize_name($_POST['course_name'] ?? '');
            $course_description = InputHandler::sanitize_string($_POST['course_description'] ?? '');
            $response = $action->createCourse($department_id, $course_code, $course_name, $course_description);
        }
        break;
    case 'GetCourseByDepartment':
        if ($requestMethod === "POST") {
            $department_id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $response = $action->getCourseByDepartment($department_id);
        }
    case 'GetCourseById':
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $response = $action->getCourseById($course_id);
        }
        break;
    case 'GetAllCourse':
        if ($requestMethod === "GET") {
            $response = $action->getAllCourses();
        }
        break;
    case 'UpdateCourse':
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $department_id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $course_code =  InputHandler::sanitize_string(strtoupper($_POST['course_code'] ?? ''));
            $course_name = InputHandler::sanitize_name($_POST['course_name'] ?? '');
            $course_description = InputHandler::sanitize_string($_POST['course_description'] ?? '');
            $response = $action->updateCourse($course_id, $department_id, $course_code, $course_name, $course_description);
        }
        break;
    case 'ArchiveCourse':
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $response = $action->archiveCourse($course_id);
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
}

echo json_encode($response);
