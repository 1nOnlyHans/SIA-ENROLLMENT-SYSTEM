<?php
require "../Helpers/InputValidator.php";
require "../Models/Course.php";

$sanitize = new InputValidator();
$actionType = $sanitize->sanitize('actionType', '', false);

$action = new Course();
$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case 'CreateCourse':
        if ($requestMethod === "POST") {
            $department_id = $sanitize->sanitize('department_id');
            $course_code = $sanitize->sanitize('course_code');
            $course_name = $sanitize->sanitize('course_name', '', true);
            $course_description = $sanitize->sanitize('course_description', '', true);
            $response = $action->createCourse($department_id, $course_code, $course_name, $course_description);
        }
        break;
    case 'GetCourseByDepartment':
        if ($requestMethod === "POST") {
            $department_id = $sanitize->sanitize('department_id');
            $response = $action->getCourseByDepartment($department_id);
        }
    case 'GetCourseById':
        if ($requestMethod === "POST") {
            $course_id = $sanitize->sanitize('course_id');
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
            $course_id = $sanitize -> sanitize('course_id');
            $department_id = $sanitize->sanitize('department_id');
            $course_code = $sanitize->sanitize('course_code');
            $course_name = $sanitize->sanitize('course_name', '', true);
            $course_description = $sanitize->sanitize('course_description', '', true);
            $response = $action->updateCourse($course_id,$department_id, $course_code, $course_name, $course_description);
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
}

echo json_encode($response);
