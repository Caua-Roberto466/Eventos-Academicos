<?php
require_once 'conexao.php';

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara o DELETE
    $sql = "DELETE FROM eventos WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Executa passando o ID. Se houver sucesso, o registro é removido para sempre.
    $stmt->execute([$id]);
}

// Independentemente de sucesso ou erro, redireciona o usuário de volta para a lista
header('Location: ../index.php');
exit;
?>
