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

    public function submitApplication($desired_course, $firstname, $middlename, $lastname, $suffix, $gender, $nationality, $dob, $address, $email, $shs_school, $year_graduated, $course_strand)
    {
        $this->db->beginTransaction();

        $action = $this->admission->saveApplicantInformations($desired_course, $firstname, $middlename, $lastname, $suffix, $gender, $nationality, $dob, $address, $email, $shs_school, $year_graduated, $course_strand);

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
    }
}
