<?php
require "Dbh.php";
class Subject extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    public function createSubject($course_id, $subject_code, $subject_name, $pre_requisite, $units, $type, $year_lvl, $semester)
    {
        try {
            $checkIfAlreadyExists = $this->checkIfSubjectAlreadyExists($course_id, $subject_code, $type, $year_lvl, $semester);

            if ($checkIfAlreadyExists['status'] === "duplicate") {
                return $checkIfAlreadyExists;
            }

            $this->db->beginTransaction();
            $subjectType = $type;

            foreach ($subjectType as $type) {
                $stmt = $this->db->prepare("INSERT INTO subjects (course_id,subject_code,subject_name,pre_requisite,units,type,year_lvl,semester) VALUES (:course_id,:subject_code,:subject_name,:pre_requisite,:units,:type,:year_lvl,:semester)");
                $isAdded = $stmt->execute(['course_id' => $course_id, 'subject_code' => $subject_code, 'subject_name' => $subject_name, 'pre_requisite' => $pre_requisite, 'units' => $units, 'type' => $type, 'year_lvl' => $year_lvl, 'semester' => $semester]);

                if (!$isAdded) {
                    $this->db->rollBack();
                    return [
                        "status" => "error",
                        "message" => "Failed to create subject"
                    ];
                    break;
                }
            }

            $this->db->commit();
            return [
                "status" => "success",
                "message" => "Subject created successfully"
            ];
        } catch (PDOException $e) {
            $this->db->rollBack();
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // public function getAllSubjectsByCourse($course_id)
    // {
    //     try {
    //         $stmt = $this->db->prepare("SELECT * FROM subjects WHERE course_id = :course_id");
    //         $stmt->execute(['course_id' => $course_id]);
    //         $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         if ($row) {
    //             return [
    //                 "status" => "success",
    //                 "message" => "Subjects found.",
    //                 "data" => $row
    //             ];
    //         } else {
    //             return [
    //                 "status" => "error",
    //                 "message" => "Subjects not found."
    //             ];
    //         }
    //     } catch (PDOException $e) {
    //         return [
    //             "status" => "error",
    //             "message" => "Database Error: " . $e->getMessage()
    //         ];
    //     }
    // }

    public function getAllSubjects()
    {
        try {
            $stmt = $this->db->prepare("SELECT c.course_code,s.*, GROUP_CONCAT(DISTINCT s.type ORDER BY s.type ASC SEPARATOR '/') as types FROM subjects s INNER JOIN courses c ON c.id = s.course_id GROUP by s.course_id, s.subject_code
            ");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Subjects found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Subjects not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function checkIfSubjectAlreadyExists($course_id, $subject_code, $type, $year_lvl, $semester)
    {
        try {
            $subjectType = $type;
            foreach ($subjectType as $type) {
                $stmt = $this->db->prepare("SELECT * FROM subjects WHERE course_id = :course_id AND subject_code = :subject_code AND type = :type AND year_lvl = :year_lvl AND semester = :semester");
                $stmt->execute([
                    'course_id' => $course_id,
                    'subject_code' => $subject_code,
                    'type' => $type,
                    'year_lvl' => $year_lvl,
                    'semester' => $semester
                ]);
                if ($stmt->rowCount() > 0) {
                    return [
                        "status" => "duplicate",
                        "message" => "Subject already exists with the same type (lecture or lab)."
                    ];
                    break;
                }
            }

            return [
                "status" => "success"
            ];
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function updateSubject($subject_id, $course_id, $subject_code, $subject_name, $pre_requisite, $units, $type, $year_lvl, $semester)
    {
        try {
            $stmt = $this->db->prepare("UPDATE subjects SET course_id = :course_id, subject_code = :subject_code, subject_name = :subject_name, pre_requisite = :pre_requisite, units = :units, type = :type,year_lvl = :year_lvl, semester = :semester WHERE subject_id = :subject_id");
            $stmt->execute(['course_id' => $course_id, 'subject_code' => $subject_code, 'subject_name' => $subject_name, 'pre_requisite' => $pre_requisite, 'units' => $units, 'type' => $type, 'year_lvl' => $year_lvl, 'semester' => $semester, 'subject_id' => $subject_id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Subject updated successfully",
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to update subject",
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function disableSubject($subject_id)
    {
        $status = "Inactive";

        try {
            $stmt = $this->db->prepare("UPDATE subjects SET status =:status WHERE subject_id = :subject_id");
            $stmt->execute(['status' => $status, 'subject_id' => $subject_id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Subject updated successfully",
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to update subject",
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
