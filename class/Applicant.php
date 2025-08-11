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

    public function getAllPendingApplicants()
    {
        $status = "Pending";
        try {
            $stmt = $this->db->prepare("SELECT c.course_code,a.* FROM applicants a INNER JOIN courses c ON c.id = a.desired_course WHERE a.status =:status");
            $stmt->execute(['status' => $status]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getAllEvaluated()
    {
        $status = "Pass";
        try {
            $stmt = $this->db->prepare("SELECT 
                    courses.course_code,
                    applicants.*,
                    evaluations.*
                    FROM evaluations
                    INNER JOIN applicants ON applicants.id = evaluations.applicant_id
                    INNER JOIN courses ON courses.id = applicants.desired_course
                    WHERE evaluations.status = :status
                    ");
            $stmt->execute(['status' => $status]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function updateApplicantForm($applicant_id, $applicant_type, $desired_course, $firstname, $middlename, $lastname, $suffix, $address, $email, $mobile_no, $gender, $nationality, $dob, $transferee_yr_level, $transferee_prv_school, $transferee_prv_course, $shs_school, $year_graduated, $strand, $sy, $semester)
    {
        try {
            $stmt = $this->db->prepare("UPDATE applicants SET applicant_type = :applicant_type, desired_course = :desired_course, firstname = :firstname, middlename = :middlename, lastname = :lastname, suffix = :suffix, address = :address, email = :email, mobile_no = :mobile_no, gender = :gender, nationality = :nationality, dob = :dob, transferee_yr_level = :transferee_yr_level, transferee_prv_school = :transferee_prv_school, transferee_prv_course = :transferee_prv_course, shs_school = :shs_school, year_graduated = :year_graduated, strand = :strand, sy = :sy, semester = :semester WHERE id =:id");
            $stmt->execute([
                'applicant_type' => $applicant_type,
                'desired_course' => $desired_course,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname,
                'suffix' => $suffix,
                'address' => $address,
                'email' => $email,
                'mobile_no' => $mobile_no,
                'gender' => $gender,
                'nationality' => $nationality,
                'dob' => $dob,
                'transferee_yr_level' => $transferee_yr_level,
                'transferee_prv_school' => $transferee_prv_school,
                'transferee_prv_course' => $transferee_prv_course,
                'shs_school' => $shs_school,
                'year_graduated' => $year_graduated,
                'strand' => $strand,
                'sy' => $sy,
                'semester' => $semester,
                'id' => $applicant_id
            ]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Applicant's information updated"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to update applicant information"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getSubjectCreditingApplicants()
    {
        try {
            $stmt = $this->db->prepare("SELECT e.id,a.* FROM evaluations e INNER JOIN applicants a ON a.id = e.applicant_id WHERE a.applicant_type = 'Transferee' AND a.status = 'Evaluated' AND e.status = 'Pass'");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getApplicantById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT c.course_code, a.* FROM applicants a INNER JOIN courses c ON c.id = a.desired_course WHERE a.id = :id");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Applicant found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Applicant not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }
}
