<?php

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

    // READ - Get all departments
    public function getAllCourses()
    {
        // Add logic to fetch all departments from the database
        try {
            $stmt = $this->db->prepare("SELECT * FROM courses");
            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Departments fetched successfully.",
                "data" => $courses
            ];
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // READ - Get a single department by ID
    public function getCourseById($id)
    {
        // Add logic to fetch a department using its ID
        try {
            $stmt = $this->db->prepare("SELECT * FROM courses WHERE id =:id");
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

    // GET BY CODE
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

    // UPDATE
    public function updateCourse($id, $department_id, $name, $code, $description, $status)
    {
        // Add logic to update the department with given ID
        $findDepartment = $this->getCourseByCode($code);

        if ($findDepartment['status'] === "error") {
            return [
                "status" => "error",
                "message" => "Invalid Course"
            ];
        }

        try {
            $stmt = $this->db->prepare("UPDATE courses SET department_id = :department_id, course_code = :course_code,course_name =:course_name, course_description = :course_description, status = :status WHERE id = :id");
            $stmt->execute([
                'department_id' => $department_id,
                'course_code' => $code,
                'course_name' => $name,
                'course_description' => $description,
                'status' => $status,
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
