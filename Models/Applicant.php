<?php
require "Dbh.php";
require "Admission.php";

class Applicant extends Dbh
{
    private $db;
    private $applicantID = null;
    private $Admission;

    public function __construct()
    {
        $this->db = $this->Connect();
        $this->Admission = new Admission($this->db);
    }

    public function submitOnlineAdmission(
        $firstname,
        $middlename,
        $lastname,
        $suffix,
        $birthdate,
        $gender,
        $civil_status,
        $nationality,
        $place_of_birth,
        $religion,
        $address,
        $zip_code,
        $mobile_no,
        $primary_school,
        $primary_year_graduated,
        $secondary_school,
        $secondary_year_graduated,
        $tertiary_school,
        $tertiary_year_graduated,
        $course_graduated,
        $father_firstname,
        $father_middle_name,
        $father_lastname,
        $father_address,
        $father_phoneNumber,
        $father_occupation,
        $father_deceased,
        $mother_firstname,
        $mother_middlename,
        $mother_lastname,
        $mother_address,
        $mother_phone,
        $guardian_firstname,
        $guardian_middlename,
        $guardian_lastname,
        $guardian_address,
        $guardian_phone,
        $guardian_occupation,
        $guardian_relationship
    ) {
        $this->db->beginTransaction();

        $isAlreadySubmitted = $this -> db -> prepare("SELECT * FROM applicants WHERE first_name =:firstname AND last_name =:lastname");
        $isAlreadySubmitted -> execute([
            'firstname' => $firstname,
            'lastname' => $lastname
        ]);

        if($isAlreadySubmitted -> rowCount() > 0){
            $this -> db -> rollBack();
            return [
                "status" => "error",
                "message" => "Applicant has already exists in our records contact our administrator for assistance"
            ];
        }

        $this->applicantID = $this->Admission->savePersonalInformation(
            $firstname,
            $middlename,
            $lastname,
            $suffix,
            $birthdate,
            $gender,
            $civil_status,
            $nationality,
            $place_of_birth,
            $religion
        );

        if ($this->applicantID !== null) {
            $address = $this->Admission->address(
                $this->applicantID,
                $address,
                $zip_code,
                $mobile_no
            );

            $education = $this->Admission->saveEducationalInformation(
                $this->applicantID,
                $primary_school,
                $primary_year_graduated,
                $secondary_school,
                $secondary_year_graduated,
                $tertiary_school,
                $tertiary_year_graduated,
                $course_graduated
            );

            $parentGuardian = $this->Admission->saveParentGuardianInformation(
                $this->applicantID,
                $father_firstname,
                $father_middle_name,
                $father_lastname,
                $father_address,
                $father_phoneNumber,
                $father_occupation,
                $father_deceased,
                $mother_firstname,
                $mother_middlename,
                $mother_lastname,
                $mother_address,
                $mother_phone,
                $guardian_firstname,
                $guardian_middlename,
                $guardian_lastname,
                $guardian_address,
                $guardian_phone,
                $guardian_occupation,
                $guardian_relationship
            );

            if ($address && $education && $parentGuardian) {
                $this->db->commit();
                return [
                    "status" => "success",
                    "message" => "your admission registration has been sent successfully"
                ];
            } else {
                $this->db->rollBack();
                return [
                    "status" => "error",
                    "message" => "Failed to admission"
                ];
            }
        } else {
            $this->db->rollBack();
            return [
                "status" => "error",
                "message" => "Error in submitting admission form"
            ];
        }
    }
}
