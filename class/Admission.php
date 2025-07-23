<?php

class Admission
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveApplicantInformations($desired_course, $firstname, $middlename, $lastname, $suffix, $gender, $nationality, $dob, $address, $email, $shs_school, $year_graduated, $course_strand)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO applicants (desired_course,firstname,middlename,lastname,suffix,address,email,gender,nationality,dob,shs_school,year_graduated,course_strand) VALUES (:desired_course,:firstname,:middlename,:lastname,:suffix,:address,:email,:gender,:nationality,:dob,:shs_school,:year_graduated,:course_strand)");
            $stmt->execute([
                'desired_course' => $desired_course,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname,
                'suffix' => $suffix,
                'gender' => $gender,
                'nationality' => $nationality,
                'dob' => $dob,
                'address' => $address,
                'email' => $email,
                'shs_school' => $shs_school,
                'year_graduated' => $year_graduated,
                'course_strand' => $course_strand,
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
