<?php

class Department extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }


    public function createDepartment($name, $code, $description)
    {
        // Add logic to insert a new department into the database
        $departmentExists = $this->getDepartmentByCode($code);

        if ($departmentExists['status'] === "success") {
            return [
                "status" => "error",
                "message" => "Department is already exists"
            ];
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO departments (department_name, department_code, department_description) VALUES (:name, :code, :description)");
            $stmt->execute([
                'name' => $name,
                'code' => $code,
                'description' => $description,
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Department created successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to create department."
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
    public function getAllDepartments()
    {
        // Add logic to fetch all departments from the database
        try {
            $stmt = $this->db->prepare("SELECT * FROM departments");
            $stmt->execute();
            $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                "status" => "success",
                "message" => "Departments fetched successfully.",
                "data" => $departments
            ];
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // READ - Get a single department by ID
    public function getDepartmentById($id)
    {
        // Add logic to fetch a department using its ID
        try {
            $stmt = $this->db->prepare("SELECT * FROM departments WHERE id =:id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Department found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Department not found."
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
    public function getDepartmentByCode($code)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM departments WHERE department_code =:department_code");
            $stmt->execute(['department_code' => $code]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    "status" => "success",
                    "message" => "Department found.",
                    "data" => $row
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Department not found."
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
    public function updateDepartment($id, $name, $code, $description, $status)
    {
        // Add logic to update the department with given ID
        $findDepartment = $this->getDepartmentByCode($code);

        if ($findDepartment['status'] === "error") {
            return [
                "status" => "error",
                "message" => "Invalid Department"
            ];
        }

        try {
            $stmt = $this->db->prepare("UPDATE departments SET department_name =:deparment_name, department_code =:department_code, department_description = :department_description, status = :status WHERE id = id");
            $stmt->execute([
                'department_name' => $name,
                'department_code' => $code,
                'department_description' => $description,
                'status' => $status,
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Department updated successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "No changes made or department not found."
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "404",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // DELETE
    public function deleteDepartment($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM departments WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Department deleted successfully."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Department not found or already deleted."
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
