<?php
require "Dbh.php";
require "../Helpers/InputValidator.php";

class User extends Dbh
{
    private $db;
    private $inputValidator;
    public function __construct()
    {
        $this->db = $this->Connect();
        $this->inputValidator = new InputValidator();
    }

    public function isUsernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username =:username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($username, $password, $role = 'Applicant')
    {
        $inputs = [$username];

        if (empty($username) || empty($password) || empty($role)) {
            return ['status' => 'error', 'message' => 'Fill out the required fields'];
        }

        if ($this->inputValidator->hasSpecialCharacter($inputs)) {
            return ['status' => 'error', 'message' => 'your username or full name cannot have special characters'];
        }

        if ($this->isUsernameExists($username)) {
            return ['status' => 'error', 'message' => 'Username is already exists'];
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO users (username,password) VALUES (:username,:password)");

            if ($stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)])) {
                return ['status' => 'success', 'message' => 'Registered Successfully'];
            } else {
                return ['status' => 'error', 'message' => 'Register Failed'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database Error: ' . $e->getMessage()];
        }
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username =:username");
            $stmt->execute(['username' => $username]);
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['current_user'] = $row;
                    return ['status' => 'success', 'message' => 'Login Successfully', 'role' => $_SESSION['current_user']['role']];
                } else {
                    return ['status' => 'error', 'message' => 'Invalid Credentials'];
                }
            } else {
                return ['status' => 'error', 'message' => 'Invalid Account'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database Error: ' . $e->getMessage()];
        }
    }
}
