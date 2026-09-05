<?php
$host = "localhost";
$db = "academic";
$user = "root";
$pass = "";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se a conexão falhar, o bloco 'catch' captura o erro e interrompe o script (die)
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>