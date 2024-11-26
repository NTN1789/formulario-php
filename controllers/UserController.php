<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function getAllUsers() {
        return $this->userModel->getAll();
    }
}
?>
