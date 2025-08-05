<?php
require "Dbh.php";
class AcademicSettings extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    public function getActiveSchoolYear()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM school_year WHERE status = :status LIMIT 1");
            $stmt->execute(['status' => 'Active']);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Active school year fetched successfully",
                "data" => $data
            ];
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getActiveSemesterForActiveSy()
    {
        try {
            $schoolYearResult = $this->getActiveSchoolYear();
            if ($schoolYearResult["status"] !== "success" || empty($schoolYearResult["data"])) {
                return [
                    "status" => "error",
                    "message" => "No active school year found."
                ];
            }

            $syId = $schoolYearResult["data"]["id"];

            $stmt = $this->db->prepare("SELECT * FROM semesters WHERE status = :status AND SY = :SY LIMIT 1");
            $stmt->execute(['status' => 'Active', 'SY' => $syId]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Active semester fetched successfully",
                "data" => $data
            ];
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getActiveAcademicPeriod()
    {
        $syResult = $this->getActiveSchoolYear();
        $semResult = $this->getActiveSemesterForActiveSy();

        if ($syResult["status"] !== "success" || $semResult["status"] !== "success") {
            return [
                "status" => "error",
                "message" => "Failed to fetch academic period",
                "school_year" => $syResult,
                "semester" => $semResult
            ];
        }

        return [
            "status" => "success",
            "message" => "Active academic period fetched successfully",
            "school_year" => $syResult["data"],
            "semester" => $semResult["data"]
        ];
    }
}
