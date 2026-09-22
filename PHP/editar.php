<?php
require_once 'conexao.php';

// 1. Busca os dados atuais do evento com base no ID passado na URL
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o evento existe, se não, volta para a tela inicial
if (!$evento) {
    header('Location: ../index.php');
    exit;
}

// 2. Processa a atualização quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $palestrante = $_POST['palestrante'];
    $data_evento = $_POST['data_evento'];
    $horario = $_POST['horario'];
    $local = $_POST['local'];
    $vagas_disponiveis = $_POST['vagas_disponiveis'];

    // Query de UPDATE usando placeholders
    $sql = "UPDATE eventos SET nome = ?, palestrante = ?, data_evento = ?, horario = ?, local = ?, vagas_disponiveis = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Passa as variáveis + o $id no final
    if ($stmt->execute([$nome, $palestrante, $data_evento, $horario, $local, $vagas_disponiveis, $id])) {
        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
    <div class="container form-container">
        <a href="../index.php" class="voltar">&larr; Voltar</a>
        <h3>Editar Evento</h3>
        <p class="subtitle"><?= htmlspecialchars($evento['nome']) ?></p>

        <form method="POST" action="">
            <div class="inputs">
                <label for="nome">Nome do Evento</label>
                <!-- Imprimindo o valor atual dentro do atributo value -->
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($evento['nome']) ?>" required>
            </div>
            <div class="inputs">
                <label for="palestrante">Palestrante</label>
                <input type="text" id="palestrante" name="palestrante" value="<?= htmlspecialchars($evento['palestrante']) ?>" required>
            </div>
            <div class="inputs">
                <label for="data_evento">Data</label>
                <input type="date" id="data_evento" name="data_evento" value="<?= htmlspecialchars($evento['data_evento']) ?>" required>
            </div>
            <div class="inputs">
                <label for="horario">Horário</label>
                <input type="time" id="horario" name="horario" value="<?= htmlspecialchars(substr($evento['horario'], 0, 5)) ?>" required>
            </div>
            <div class="inputs">
                <label for="local">Local</label>
                <input type="text" id="local" name="local" value="<?= htmlspecialchars($evento['local']) ?>" required>
            </div>
            <div class="inputs">
                <label for="vagas_disponiveis">Vagas Disponíveis</label>
                <input type="number" id="vagas_disponiveis" name="vagas_disponiveis" min="0" value="<?= htmlspecialchars($evento['vagas_disponiveis']) ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-salvar">Atualizar Dados</button>
                <a href="../index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>