<?php
require_once "Dbh.php";
require_once "Admission.php";

class Applicant extends Dbh
{
    private $db;
    private $admission;

    public function __construct()
    {
        $this->db = $this->Connect();
        $this->admission = new Admission($this->db);
    }

    public function submitApplication($applicant_type, $desired_course, $firstname, $middlename, $lastname, $suffix, $address, $email, $mobile_no, $gender, $nationality, $dob, $transferee_yr_level, $transferee_prv_school, $transferee_prv_course, $shs_school, $year_graduated, $strand, $sy, $semester)
    {
        try {
            $this->db->beginTransaction();
            $isApplicantExists = $this->admission->checkIfAlreadySubmitted($firstname, $lastname, $email);
            if ($isApplicantExists['status'] === "success") {
                return [
                    "status" => "error",
                    "message" => "Applicant already submitted"
                ];
            }

            $action = $this->admission->saveApplicantInformations($applicant_type, $desired_course, $firstname, $middlename, $lastname, $suffix, $address, $email, $mobile_no, $gender, $nationality, $dob, $transferee_yr_level, $transferee_prv_school, $transferee_prv_course, $shs_school, $year_graduated, $strand, $sy, $semester);

            if (!$action) {
                $this->db->rollBack();
                return [
                    "status" => "error",
                    "message" => "Failed to submit application"
                ];
            }

            $this->db->commit();

            return [
                "status" => "success",
                "message" => "Online Registration has been submitted"
            ];
        } catch (PDOException $e) {
            $this->db->rollBack();
            return ["status" => "error", "message" => "Database error: " . $e->getMessage()];
        }
    }

    public function checkRequiredFields($requiredFields, $inputs)
    {
        $errors = [];
        foreach ($requiredFields as $field) {
            if (!isset($inputs[$field]) || trim($inputs[$field]) === '') {
                array_push($errors, ucfirst(str_replace('_', ' ', $field)) . ' ' . 'is required');
            }
        }

        return $errors;
    }

    public function checkNameLength($firstname, $lastname)
    {
        return strlen($firstname) > 2 && strlen($lastname) > 2;
    }

    public function checkAgeValidity($dob)
    {
        try {
            $birthdate = new DateTime($dob);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;

            return $age >= 17;
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkIfAlreadySubmitted($firstname, $lastname, $email)
    {
        return $this->admission->checkIfAlreadySubmitted($firstname, $lastname, $email);
    }

    public function getAllApplicants()
    {
        try {
            $stmt = $this->db->prepare("SELECT applicant_type,firstname,lastname FROM applicants");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Applicants found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Applicants not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }
}
