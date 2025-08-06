<?php

class Admission
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveApplicantInformations($applicant_type, $desired_course, $firstname, $middlename, $lastname, $suffix, $address, $email, $mobile_no, $gender, $nationality, $dob, $transferee_yr_level, $transferee_prv_school, $transferee_prv_course, $shs_school, $year_graduated, $strand, $sy, $semester)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO applicants (applicant_type,desired_course,firstname,middlename,lastname,suffix,address,email,mobile_no,gender,nationality,dob,transferee_yr_level,transferee_prv_school,transferee_prv_course,shs_school,year_graduated,strand,sy,semester) VALUES (
                :applicant_type,
                :desired_course,
                :firstname,
                :middlename,
                :lastname,
                :suffix,
                :address,
                :email,
                :mobile_no,
                :gender,
                :nationality,
                :dob,
                :transferee_yr_level,
                :transferee_prv_school,
                :transferee_prv_course,
                :shs_school,
                :year_graduated,
                :strand,
                :sy,
                :semester)");
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
                'semester' => $semester
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkIfAlreadySubmitted($firstname, $lastname, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM applicants WHERE (firstname = :firstname AND lastname = :lastname) OR email = :email");
            $stmt->execute(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
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