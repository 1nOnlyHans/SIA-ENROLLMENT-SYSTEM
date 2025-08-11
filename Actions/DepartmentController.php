<?php

require_once "../class/Department.php";
require_once "../Helpers/InputHandler.php";
require_once "../class/Course.php";

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$action = new Department();
$course = new Course();
$db = new Dbh();
$conn = $db->Connect();

$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

//Refactor
switch ($actionType) {
    case 'CreateDepartment':
        if ($requestMethod === "POST") {
            $department_name = InputHandler::sanitize_name($_POST['department_name'] ?? '');
            $department_code = InputHandler::sanitize_string(strtoupper($_POST['department_code'] ?? ''));
            $department_description = InputHandler::sanitize_string($_POST['department_description'] ?? '');
            $response = $action->createDepartment($department_name, $department_code, $department_description);
        }
        break;
    case 'GetAllDepartments':
        if ($requestMethod === "GET") {
            $response = $action->getAllDepartments();
        }
        break;
    case 'GetDepartmentById':
        if ($requestMethod === "POST") {
            $id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $response = $action->getDepartmentById($id);
        }
        break;
    case 'UpdateDepartment':
        if ($requestMethod === "POST") {
            $id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $department_name = InputHandler::sanitize_name($_POST['department_name'] ?? '');
            $department_code = InputHandler::sanitize_string(strtoupper($_POST['department_code'] ?? ''));
            $department_description = InputHandler::sanitize_string($_POST['department_description'] ?? '');
            $response = $action->updateDepartment($id, $department_name, $department_code, $department_description);
        }
        break;
    case 'ArchiveDepartment':
        if ($requestMethod === "POST") {
            $id = InputHandler::sanitize_int($_POST['department_id'] ?? '');
            $conn->beginTransaction();
            $archiveDepartment = $action->archiveDepartment($id);
            if ($archiveDepartment['status'] === "success") {
                $archiveCourse = $course->archiveAllDepartmentCourse($id);
                if ($archiveCourse) {
                    $conn->commit();
                    $response = [
                        "status" => "success",
                        "message" => "Department and Course Archived"
                    ];
                } else {
                    $conn->rollBack();
                    $response = [
                        "status" => "error",
                        "message" => "Failed to archive all department courses"
                    ];
                }
            } else {
                $conn->rollBack();
                $response = [
                    "status" => "error",
                    "message" => "Failed to archive department"
                ];
            }
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
