<?php
require "Dbh.php";
class Course extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }


    public function createCourse($department_id, $code, $name, $description)
    {

        $courseExists = $this->getCourseByCode($code);

        if ($courseExists['status'] === "success") {
            return [
                "status" => "error",
                "message" => "Course already exists"
            ];
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO courses (department_id,course_code,course_name,course_description) VALUES (:department_id,:code,:name,:description)");
            $stmt->execute([
                'department_id' => $department_id,
                'code' => $code,
                'name' => $name,
                'description' => $description
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Course created successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to create course."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // READ
    public function getAllCourses()
    {

        try {
            $stmt = $this->db->prepare("SELECT departments.department_code, departments.department_name,courses.* FROM courses INNER JOIN departments ON departments.id = courses.department_id");
            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Courses fetched successfully.",
                "data" => $courses
            ];
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function getCourseByDepartment($department_id)
    {

        try {
            $stmt = $this->db->prepare("SELECT * FROM courses WHERE department_id = :department_id");
            $stmt->execute(['department_id' => $department_id]);
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Courses fetched successfully.",
                "data" => $courses
            ];
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }
    // READ - 
    public function getCourseById($id)
    {

        try {
            $stmt = $this->db->prepare("SELECT departments.department_code, departments.department_name,courses.* FROM courses INNER JOIN departments ON departments.id = courses.department_id WHERE courses.id =:id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Course found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Course not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }


    public function getCourseByCode($code)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM courses WHERE course_code =:course_code");
            $stmt->execute(['course_code' => $code]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Course found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Course not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function checkIfCourseCodeExists($id, $code)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM courses WHERE course_code =:course_code AND id != :id");
            $stmt->execute(['course_code' => $code, 'id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Course found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Course not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function updateCourse($id, $department_id, $course_code, $course_name, $course_description)
    {

        $findCourse = $this->getCourseById($id);
        $checkIfCourseCodeExists = $this->checkIfCourseCodeExists($id, $course_code);

        if ($findCourse['status'] === "error") {
            return [
                "status" => "error",
                "message" => "Invalid Course"
            ];
        }

        if ($checkIfCourseCodeExists['status'] === "success") {
            return [
                "status" => "error",
                "message" => "Update failed: The course code is already in use. Please choose a different code."
            ];
        }

        try {
            $stmt = $this->db->prepare("UPDATE courses SET department_id = :department_id, course_code = :course_code,course_name =:course_name, course_description = :course_description WHERE id = :id");
            $stmt->execute([
                'department_id' => $department_id,
                'course_code' => $course_code,
                'course_name' => $course_name,
                'course_description' => $course_description,
                'id' => $id
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Course updated successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "No changes made or course not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // DELETE // Instead of deleting just update the status 
    public function deleteCourse($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM courses WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Course deleted successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Course not found or already deleted."
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
