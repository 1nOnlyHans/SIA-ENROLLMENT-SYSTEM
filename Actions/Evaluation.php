<?php
session_start();
require_once "../Helpers/InputHandler.php";
require_once "../class/Evaluation.php";

$db = new Dbh();
$conn = $db->Connect();

$evaluation = new Evaluation();

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);


$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case "Evaluation":
        if ($requestMethod === "POST") {
            $applicant_id = InputHandler::sanitize_int($_POST['applicant_id_eval'] ?? '');
            $evaluator_id = InputHandler::sanitize_int($_SESSION['current_user']['id']);
            $status = InputHandler::sanitize_string($_POST['evalResult'] ?? '');
            $remarks = InputHandler::sanitize_string($_POST['evalRemarks'] ?? '');
            $remarks_note = InputHandler::sanitize_string($_POST['evalRemarksNote']);
            $response = [$applicant_id, $evaluator_id, $status, $remarks, $remarks_note];
            $evaluate = $evaluation->evaluate($applicant_id, $evaluator_id, $status, $remarks, $remarks_note);
            if ($evaluate['status'] === "success") {
                $evaluation->markApplicantAsEvaluated($applicant_id);
                $response = [
                    "status" => "success",
                    "message" => "Evaluation information saved",
                    "evaluation_id" => $evaluate['id']
                ];
            } else {
                $response = $evaluate;
            }
        }
        break;
    case "SaveEvaluationDocuments":
        if ($requestMethod === "POST") {
            $evaluation_id = InputHandler::sanitize_int($_POST['evaluation_id'] ?? '');
            $documents = $_POST['documents'] ?? [];
            $response = $evaluation->saveEvaluationDocuments($evaluation_id, $documents);
        }
        break;
    case "GetRequiredDocuments":
        if ($requestMethod === "POST") {
            $applicantType = InputHandler::sanitize_string($data['applicantType'] ?? '');
            $response = $evaluation->getRequiredDocuments($applicantType);
        }
        break;
    case "SaveCreditedSubject":
        if ($requestMethod === "POST") {
            $applicant_id = InputHandler::sanitize_int($_POST['applicant_id'] ?? '');
            $credited_subjects = $_POST['credited_subjects'] ?? [];
            $findEvalId = $evaluation->findEvaluationByApplicantId($applicant_id);
            if ($findEvalId['status'] === "success") {
                $evaluation_id = $findEvalId['data']['id'];
                foreach ($credited_subjects as $subject) {
                    $checkIfCredited = $evaluation->checkIfAlreadyCredited($applicant_id, $subject, $evaluation_id);
                    if ($checkIfCredited['status'] === "error") {
                        $response = [
                            "status" => "error",
                            "message" => "Subject already credited"
                        ];
                        break;
                    }

                    $saveCredit = $evaluation->saveCreditedSubject($applicant_id, $subject, $evaluation_id, $status = 'Credited');
                    if ($saveCredit['status'] !== "success") {
                        $response = $saveCredit;
                        break;
                    }
                }
                $response = [
                    "status" => "success",
                    "message" => "Credited subjects saved successfully"
                ];
            } else {
                $response = $findEvalId;
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
