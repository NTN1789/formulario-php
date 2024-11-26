<?php
require_once __DIR__ . '/../models/User.php';

class AuthService {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register($nome, $email, $celular, $senha) {
        $existingUser = $this->userModel->getByEmail($email);
        if ($existingUser) {
            return ["error" => "Email já registrado."];
        }

        if ($this->userModel->create($nome, $email, $celular, $senha)) {
            return ["message" => "Conta criada com sucesso!"];
        } else {
            return ["error" => "Erro ao criar conta."];
        }
    }

    public function login($email, $senha) {
        $user = $this->userModel->getByEmail($email);

        if ($user && password_verify($senha, $user['senha'])) {
            return ["message" => "Login bem-sucedido!", "user" => $user];
        } else {
            return ["error" => "Credenciais inválidas."];
        }
    }
}
?>
