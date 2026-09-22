<?php
require_once 'conexao.php';

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados dos campos de input
    $nome = $_POST['nome'];
    $palestrante = $_POST['palestrante'];
    $data_evento = $_POST['data_evento'];
    $horario = $_POST['horario'];
    $local = $_POST['local'];
    $vagas_disponiveis = $_POST['vagas_disponiveis'];

    // Monta a query SQL com "placeholders" (?) para evitar SQL Injection
    $sql = "INSERT INTO eventos (nome, palestrante, data_evento, horario, local, vagas_disponiveis) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepara a query no banco
    $stmt = $pdo->prepare($sql);

    // Executa substituindo os '?' pelas variáveis na ordem correta
    if ($stmt->execute([$nome, $palestrante, $data_evento, $horario, $local, $vagas_disponiveis])) {
        // Se der certo, redireciona de volta para o index (que está uma pasta acima)
        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Evento</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
    <div class="container form-container">
        <a href="../index.php" class="voltar">&larr; Voltar</a>
        <h3>Cadastrar Novo Evento</h3>
        <p class="subtitle">Preencha os dados da palestra ou evento</p>

        <!-- Formulário enviando os dados para a própria página via POST -->
        <form method="POST" action="">
            <div class="inputs">
                <label for="nome">Nome do Evento</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="inputs">
                <label for="palestrante">Palestrante</label>
                <input type="text" id="palestrante" name="palestrante" required>
            </div>
            <div class="inputs">
                <label for="data_evento">Data</label>
                <input type="date" id="data_evento" name="data_evento" required>
            </div>
            <div class="inputs">
                <label for="horario">Horário</label>
                <input type="time" id="horario" name="horario" required>
            </div>
            <div class="inputs">
                <label for="local">Local</label>
                <input type="text" id="local" name="local" required>
            </div>
            <div class="inputs">
                <label for="vagas_disponiveis">Vagas Disponíveis</label>
                <input type="number" id="vagas_disponiveis" name="vagas_disponiveis" min="0" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-salvar">Salvar Cadastro</button>
                <a href="../index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>