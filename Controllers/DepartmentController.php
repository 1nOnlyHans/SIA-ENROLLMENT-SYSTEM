<?php

require "../Helpers/InputValidator.php";
require "../Models/Department.php";

$sanitize = new InputValidator();
$actionType = $sanitize -> sanitize('actionType','',false);

$action = new Department();
$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case 'CreateDepartment':
        if ($requestMethod === "POST") {
            $department_name = $sanitize->sanitize('department_name','',true);
            $department_code = $sanitize->sanitize('department_code','',true);
            $department_description = $sanitize->sanitize('department_description','',true);
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
            $id = $sanitize->sanitize('department_id');
            $response = $action->getDepartmentById($id);
        }
        break;
    case 'UpdateDepartment':
        if ($requestMethod === "POST") {
            $id = $sanitize->sanitize('department_id');
            $code = $sanitize->sanitize('department_code');
            $name = $sanitize->sanitize('department_name','',true);
            $description = $sanitize->sanitize('department_description','',true);
            $response = $action->updateDepartment($id,$name,$code,$description);
        }
        break;
    case 'ArchiveDepartment':
        if($requestMethod === "POST"){
            $id = $sanitize->sanitize('department_id');
            $response = $action -> archiveDepartment($id);
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
}

echo json_encode($response);
