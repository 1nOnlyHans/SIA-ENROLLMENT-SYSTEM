<?php
require "Dbh.php";

class Evaluation extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    public function evaluate($applicant_id, $evaluator_id, $status, $remarks, $remarks_note)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO evaluations (applicant_id,evaluator_id,status,remarks,remarks_note) VALUES (:applicant_id,:evaluator_id,:status,:remarks,:remarks_note)");
            $stmt->execute(['applicant_id' => $applicant_id, 'evaluator_id' => $evaluator_id, 'status' => $status, 'remarks' => $remarks, 'remarks_note' => $remarks_note]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Evaluation created",
                    "id" => $this->db->lastInsertId()
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to created Evaluation"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function saveEvaluationDocuments($evaluation_id, $documents)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO evaluation_documents (evaluation_id,document_type_id,status) VALUES (:evaluation_id,:document_type_id,:status)");
            foreach ($documents as $docs) {
                $stmt->execute(['evaluation_id' => $evaluation_id, 'document_type_id' => $docs['document_type_id'], 'status' => $docs['status']]);
            }
            if ($stmt->rowCount() > 0) {
                return ['status' => 'success', 'message' => 'Documents saved'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to save documents'];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function getRequiredDocuments($applicantType)
    {
        $default = "All";
        try {
            $stmt = $this->db->prepare("SELECT * 
            FROM documents_type
            WHERE required_for = :applicant_type 
            OR required_for = :default");
            $stmt->execute(['applicant_type' => $applicantType, 'default' => $default]);
            $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "data" => $documents
            ];
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function markApplicantAsEvaluated($applicant_id)
    {
        $status = "Evaluated";
        try {
            $stmt = $this->db->prepare("UPDATE applicants SET status = :status WHERE id = :id");
            $stmt->execute(['status' => $status, 'id' => $applicant_id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Applicant Status Updated"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to update applicant status"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function findEvaluationByApplicantId($applicant_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM evaluations WHERE applicant_id = :applicant_id");
            $stmt->execute(['applicant_id' => $applicant_id]);
            $evaluation = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($evaluation) {
                return [
                    "status" => "success",
                    "data" => $evaluation
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "No evaluation found for this applicant"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function saveCreditedSubject($applicant_id, $subject_id, $evaluation_id, $status)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO applicant_credited_subjects (applicant_id, subject_id, evaluation_id, credit_status) VALUES (:applicant_id, :subject_id, :evaluation_id, :status)");
            $stmt->execute([
                'applicant_id' => $applicant_id,
                'subject_id' => $subject_id,
                'evaluation_id' => $evaluation_id,
                'status' => $status
            ]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Credited subject saved"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to save credited subject"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }

    public function getCreditedSubjectsByApplicantId($applicant_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT 
            s.subject_code,
            s.subject_name,
            s.total_units,
            cr.*,
            ap.firstname,
            ap.middlename,
            ap.lastname,
            ap.desired_course,
            c.course_code
            FROM applicant_credited_subjects cr
            INNER JOIN subjects s ON s.id = cr.subject_id
            INNER JOIN applicants ap ON ap.id = cr.applicant_id
            INNER JOIN courses c ON c.id = ap.desired_course
            WHERE cr.applicant_id = :applicant_id");
            $stmt->execute(['applicant_id' => $applicant_id]);
            $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "data" => $subjects
            ];
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database error: " . $e->getMessage()
            ];
        }
    }
}
