<?php
session_start();
require '../Models/User.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $sanitize = new InputValidator();

    $actionType = $sanitize -> sanitize('actionType');

    switch ($actionType) {
        case 'Login':
            $action = new User();
            $username = $sanitize->sanitize('username');
            $password = $sanitize->sanitize('password');
            echo json_encode($action->login($username, $password));
            break;
        case 'Logout':
            session_unset();
            session_destroy();
            echo json_encode([
                "status" => "success",
                "message" => "Logout Successfully"
            ]);
            break;
        default:
            echo json_encode([
                "status" => "404",
                "message" => "Invalid Action Type"
            ]);
    }

    
}

