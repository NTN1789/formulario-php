<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/UserController.php';

$authController = new AuthController();
$userController = new UserController();

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($_GET['action'] === 'register') {
        echo json_encode($authController->register($data));
    } elseif ($_GET['action'] === 'login') {
        echo json_encode($authController->login($data));
    }
} elseif ($method === 'GET' && $_GET['action'] === 'users') {
    echo json_encode($userController->getAllUsers());
} else {
    echo json_encode(["error" => "Rota ou método inválido."]);
}
?>
