<?php
require_once "Dbh.php";
class Curriculum extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    public function createNewCurriculum($course_id, $curriculum_title, $sy)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO curriculum (course_id,curriculum_name,sy) VALUES (:course_id,:curriculum_name,:sy)");
            $stmt->execute(['course_id' => $course_id, 'curriculum_name' => $curriculum_title, 'sy' => $sy]);
            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Curriculum created successfully",
                    "id" => $this->db->lastInsertId()
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to create curriculum"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function createNewCurriculumSubjects($curriculum_id, $subject_id)
    {
        $curriculum_subjects = $subject_id;
        try {
            $stmt = $this->db->prepare("INSERT INTO curriculum_subjects (curriculum_id,subject_id) VALUES (:curriculum_id,:subject_id)");
            foreach ($curriculum_subjects as $subject) {
                $stmt->execute(['curriculum_id' => $curriculum_id, 'subject_id' => $subject]);
                if ($stmt->rowCount() <= 0) {
                    return [
                        "status" => "error",
                        "message" => "Failed to add subject in the curriculum"
                    ];
                }
            }

            return [
                "status" => "success",
                "message" => "Subject added to curriculum"
            ];
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function createCourseCurriculum($course_id, $curriculum_title, $sy, $subjects)
    {
        try {
            $this->db->beginTransaction();
            $insertCurriculum = $this->createNewCurriculum($course_id, $curriculum_title, $sy);
            if ($insertCurriculum['status'] === "error") {
                $this->db->rollBack();
                return $insertCurriculum;
            }

            $this->db->commit();
            $currId = $insertCurriculum['id'];

            if (isset($currId)) {
                $this->db->beginTransaction();
                $insertSubjects = $this->createNewCurriculumSubjects($currId, $subjects);
                if ($insertSubjects['status'] === "error") {
                    $this->db->rollBack();
                    return $insertSubjects;
                } else {
                    $this->db->commit();
                    return [
                        "status" => "success",
                        "message" => "Curriculum created"
                    ];
                }
            } else {
                $this->db->rollBack();
                return [
                    "status" => "error",
                    "message" => "Failed to create Curriculum"
                ];
            }
        } catch (PDOException $e) {
            $this->db->rollBack();
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getAllCurriculums()
    {
        try {
            $stmt = $this->db->prepare("SELECT courses.course_code,curriculum.*,school_year.SY FROM curriculum INNER JOIN courses ON courses.id = curriculum.course_id INNER JOIN school_year ON school_year.id = curriculum.sy");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Curriculums found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Curriculums not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getCurriculum($curriculum_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT curriculum.id as curriculum_id,curriculum.curriculum_name,curriculum.sy,curriculum.created_at as curriculum_created_at,subjects.id as subject_id,subjects.subject_code,subjects.subject_name,subjects.pre_requisite,subjects.lab_units,subjects.lec_units,subjects.total_units,subjects.type,subjects.year_lvl,subjects.semester,subjects.status FROM curriculum INNER JOIN curriculum_subjects ON curriculum_subjects.curriculum_id = curriculum.id INNER JOIN subjects ON curriculum_subjects.subject_id = subjects.id WHERE curriculum.id = :curriculum_id ORDER BY subjects.year_lvl ASC, subjects.semester ASC");
            $stmt->execute(['curriculum_id' => $curriculum_id]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Curriculums found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Curriculums not found."
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
