<?php
function getConnection() {
    $host = "127.0.0.1";
    $port = "3306";
    $db = "formulario_db";
    $user = "root";
    $password = "teste";

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die(json_encode(["error" => "Erro no servidor: " . $e->getMessage()]));
    }
}
?>
