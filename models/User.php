<?php
require_once __DIR__ . '/../database/connection.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function create($nome, $email, $celular, $senha) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, celular, senha) VALUES (:nome, :email, :celular, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':senha', password_hash($senha, PASSWORD_BCRYPT)); 
        return $stmt->execute();
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
