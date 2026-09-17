<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    $sql = "INSERT INTO alunos (nome, email, curso) VALUES (?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nome, $email, $curso])) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Aluno</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <h3 class="mb-4">Cadastrar Novo Evento</h3>
            
            <form method="POST" action="">
                <div class="inputs">
                    <label class="form-label" for="nome">Nome do Eventi</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="inputs">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="inputs">
                    <label class="form-label">Curso</label>
                    <input type="text" name="curso" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Salvar Cadastro</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>