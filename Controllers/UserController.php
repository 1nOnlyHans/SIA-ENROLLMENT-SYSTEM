<?php
require '../Models/User.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $actionType = htmlspecialchars(trim($_POST["action-type"]));

    switch ($actionType) {
        case 'Login':
            $action = new User();
            $username = htmlspecialchars(trim($_POST["username"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            echo json_encode($action->login($username, $password));
            break;
        default:
            echo json_encode([
                "status" => "404",
                "message" => "Invalid Action Type"
            ]);
    }
}
