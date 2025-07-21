<?php

class Admission
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function savePersonalInformation(
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
    ) {
        $stmt = $this->db->prepare("INSERT INTO applicants (first_name,middle_name,last_name,suffix,birthdate,gender,civil_status,nationality,place_of_birth,religion) VALUES (:first_name,:middle_name,:last_name,:suffix,:birthdate,:gender,:civil_status,:nationality,:place_of_birth,:religion)");
        $stmt->execute([
            'first_name' => $firstname,
            'middle_name' => $middlename,
            'last_name' => $lastname,
            'suffix' => $suffix,
            'birthdate' => $birthdate,
            'gender' => $gender,
            'civil_status' => $civil_status,
            'nationality' => $nationality,
            'place_of_birth' => $place_of_birth,
            'religion' => $religion
        ]);

        return $this->db->lastInsertId();
    }

    public function address($applicantID,$address,$zip_code,$mobile_no){
        $stmt = $this -> db -> prepare("INSERT INTO applicant_addresses (applicant_id,address,zip_code,mobile_no) VALUES (:applicant_id,:address,:zip_code,:mobile_no)");
        $stmt -> execute([
            'applicant_id' => $applicantID,
            'address' => $address,
            'zip_code' => $zip_code,
            'mobile_no' => $mobile_no
        ]);

        return $stmt -> rowCount() > 0;
    }

    public function saveEducationalInformation(
        $applicantID,
        $primary_school,
        $primary_year_graduated,
        $secondary_school,
        $secondary_year_graduated,
        $tertiary_school,
        $tertiary_year_graduated,
        $course_graduated
    ) {
        $stmt = $this->db->prepare("INSERT INTO applicant_educational_background (applicant_id, primary_school, primary_year_graduated, secondary_school, secondary_year_graduated, tertiary_school, tertiary_year_graduated, course_graduated) VALUES (:applicant_id, :primary_school, :primary_year_graduated, :secondary_school, :secondary_year_graduated, :tertiary_school, :tertiary_year_graduated, :course_graduated)");

        $stmt->execute([
            'applicant_id' => $applicantID,
            'primary_school' => $primary_school,
            'primary_year_graduated' => $primary_year_graduated,
            'secondary_school' => $secondary_school,
            'secondary_year_graduated' => $secondary_year_graduated,
            'tertiary_school' => $tertiary_school,
            'tertiary_year_graduated' => $tertiary_year_graduated,
            'course_graduated' => $course_graduated
        ]);

        return $stmt->rowCount() > 0;
    }

    public function saveParentGuardianInformation(
        $applicantID,
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
        $stmt = $this->db->prepare("
        INSERT INTO applicant_parent_guardian_information (
            applicant_id,
            father_firstname,
            father_middle_name,
            father_lastname,
            father_address,
            father_phone,
            father_occupation,
            father_deceased,
            mother_firstname,
            mother_middlename,
            mother_lastname,
            mother_address,
            mother_phone,
            guardian_firstname,
            guardian_middlename,
            guardian_lastname,
            guardian_address,
            guardian_phone,
            guardian_occupation,
            guardian_relationship
        ) VALUES (
            :applicant_id,
            :father_firstname,
            :father_middle_name,
            :father_lastname,
            :father_address,
            :father_phone,
            :father_occupation,
            :father_deceased,
            :mother_firstname,
            :mother_middlename,
            :mother_lastname,
            :mother_address,
            :mother_phone,
            :guardian_firstname,
            :guardian_middlename,
            :guardian_lastname,
            :guardian_address,
            :guardian_phone,
            :guardian_occupation,
            :guardian_relationship
        )
    ");

        $stmt->execute([
            'applicant_id' => $applicantID,
            'father_firstname' => $father_firstname,
            'father_middle_name' => $father_middle_name,
            'father_lastname' => $father_lastname,
            'father_address' => $father_address,
            'father_phone' => $father_phoneNumber,
            'father_occupation' => $father_occupation,
            'father_deceased' => $father_deceased,
            'mother_firstname' => $mother_firstname,
            'mother_middlename' => $mother_middlename,
            'mother_lastname' => $mother_lastname,
            'mother_address' => $mother_address,
            'mother_phone' => $mother_phone,
            'guardian_firstname' => $guardian_firstname,
            'guardian_middlename' => $guardian_middlename,
            'guardian_lastname' => $guardian_lastname,
            'guardian_address' => $guardian_address,
            'guardian_phone' => $guardian_phone,
            'guardian_occupation' => $guardian_occupation,
            'guardian_relationship' => $guardian_relationship
        ]);
        
        return $stmt -> rowCount() > 0;
    }
}
