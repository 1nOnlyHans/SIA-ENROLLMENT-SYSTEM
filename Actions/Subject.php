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
            $subject_code = InputHandler::sanitize_string(strtoupper($_POST['subject_code'] ?? ''));
            $subject_name = InputHandler::sanitize_name($_POST['subject_name'] ?? '', true);
            $pre_requisite = InputHandler::sanitize_string($_POST['pre_requisite'] ?? '');
            $lab_units = InputHandler::sanitize_int($_POST['lab_units'] ?? '');
            $lec_units = InputHandler::sanitize_int($_POST['lec_units'] ?? '');
            $units = $action->calculateTotalUnits($lab_units, $lec_units);
            $type = InputHandler::sanitize_stringArr($_POST['type'] ?? []);
            $subject_types = implode(',', $type);
            $year_lvl = InputHandler::sanitize_string($_POST['year_lvl'] ?? '');;
            $semester = InputHandler::sanitize_int($_POST['semester'] ?? '');;

            $response = $action->createSubject($course_id, $subject_code, $subject_name, $pre_requisite, $lab_units, $lec_units, $units, $subject_types, $year_lvl, $semester);
        }

        break;
    case "GetAllSubjectByCourse":
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $response = $action->getAllSubjectsByCourse($course_id);
        }
        break;
    case "GetAllSubjects":
        if ($requestMethod === "GET") {
            $response = $action->getAllSubjects();
        }
        break;
    case "GetSubjectById":
        if ($requestMethod === "POST") {
            $subject_id = InputHandler::sanitize_int($_POST['subject_id'] ?? '');
            $response = $action->getAllSubjectById($subject_id);
        }
        break;
    case "GetSubjectCoursePreRequisite":
        if ($requestMethod === "POST") {
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $subject_id = InputHandler::sanitize_int($_POST['subject_id'] ?? '');
            $response = $action->getSubjectPreRequisite($course_id, $subject_id);
        }
        break;
    case "UpdateSubject":
        if ($requestMethod === "POST") {
            $subject_id = InputHandler::sanitize_int($_POST['subject_id'] ?? '');
            $course_id = InputHandler::sanitize_int($_POST['course_id'] ?? '');
            $subject_code = InputHandler::sanitize_string(strtoupper($_POST['subject_code'] ?? ''));
            $subject_name = InputHandler::sanitize_name($_POST['subject_name'] ?? '', true);
            $pre_requisite = InputHandler::sanitize_string($_POST['pre_requisite'] ?? '');
            $lab_units = InputHandler::sanitize_int($_POST['lab_units'] ?? '');
            $lec_units = InputHandler::sanitize_int($_POST['lec_units'] ?? '');
            $units = $action->calculateTotalUnits($lab_units, $lec_units);
            $type = InputHandler::sanitize_stringArr($_POST['type'] ?? []);
            $subject_types = implode(',', $type);
            $year_lvl = InputHandler::sanitize_string($_POST['year_lvl'] ?? '');;
            $semester = InputHandler::sanitize_int($_POST['semester'] ?? '');;

            $response = $action->updateSubject($subject_id, $course_id, $subject_code, $subject_name, $pre_requisite, $lab_units, $lec_units, $units, $subject_types, $year_lvl, $semester);
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
