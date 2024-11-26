<?php
require_once __DIR__ . '/../services/AuthService.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function register($data) {
        return $this->authService->register($data['nome'], $data['email'], $data['celular'], $data['senha']);
    }

    public function login($data) {
        return $this->authService->login($data['email'], $data['senha']);
    }
}
?>
