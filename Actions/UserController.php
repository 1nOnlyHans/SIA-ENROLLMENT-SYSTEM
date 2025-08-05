<?php
session_start();
require '../class/User.php';
require "../Helpers/InputHandler.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

    switch ($actionType) {
        case 'Login':
            $action = new User();
            $username = InputHandler::sanitize_string($_POST['username']);
            $password = InputHandler::sanitize_string($_POST['password']);
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
