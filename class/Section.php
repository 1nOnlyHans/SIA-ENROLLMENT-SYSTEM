<?php
require_once "Dbh.php";

class Section extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    // CREATE
    public function createSection($course_id, $year_level, $section, $type)
    {

        $sql = "INSERT INTO sections (course_id, year_level, section, type) 
            VALUES (:course_id, :year_level, :section, :type)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':course_id'  => $course_id,
            ':year_level' => $year_level,
            ':section'    => $section,
            ':type'       => $type
        ]);

        if ($stmt->rowCount() <= 0) {
            throw new Exception("Failed to create section");
        }

        return [
            "status"     => "success",
            "section_id" => $this->db->lastInsertId()
        ];
    }

    // READ ALL
    public function getAllSections()
    {
        try {
            $sql = "SELECT * FROM sections ORDER BY course_id, year_level, section";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // READ ONE
    public function getSectionById($id)
    {
        try {
            $sql = "SELECT * FROM sections WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // UPDATE
    public function updateSection($id, $course_id, $year_level, $section, $type)
    {
        try {
            $sql = "UPDATE sections 
                SET course_id = :course_id, 
                    year_level = :year_level, 
                    section = :section, 
                    type = :type 
                WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':course_id' => $course_id,
                ':year_level' => $year_level,
                ':section' => $section,
                ':type' => $type,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // DELETE
    public function deleteSection($id)
    {
        try {
            $sql = "DELETE FROM sections WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function checkSectionAndSchedule() {
        
    }
}
