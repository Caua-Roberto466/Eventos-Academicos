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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/custom.css">
</head>
<body>
    <div class="container py-5">
        <div class="mx-auto animate-fade-in" style="max-width: 540px;">
            <a href="../index.php" class="text-muted text-decoration-none small d-inline-block mb-3">&larr; Voltar</a>

            <div class="card card-academic p-4">
                <h3 class="mb-1">Editar Evento</h3>
                <p class="text-muted mb-4"><?= htmlspecialchars($evento['nome']) ?></p>

                <form method="POST" action="" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Evento</label>
                        <!-- Imprimindo o valor atual dentro do atributo value -->
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($evento['nome']) ?>" required>
                        <div class="invalid-feedback">Informe o nome do evento.</div>
                    </div>

                    <div class="mb-3">
                        <label for="palestrante" class="form-label">Palestrante</label>
                        <input type="text" class="form-control" id="palestrante" name="palestrante" value="<?= htmlspecialchars($evento['palestrante']) ?>" required>
                        <div class="invalid-feedback">Informe o nome do palestrante.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_evento" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data_evento" name="data_evento" value="<?= htmlspecialchars($evento['data_evento']) ?>" required>
                            <div class="invalid-feedback">Escolha a data do evento.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="horario" class="form-label">Horário</label>
                            <input type="time" class="form-control" id="horario" name="horario" value="<?= htmlspecialchars(substr($evento['horario'], 0, 5)) ?>" required>
                            <div class="invalid-feedback">Escolha o horário.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="local" class="form-label">Local</label>
                        <input type="text" class="form-control" id="local" name="local" value="<?= htmlspecialchars($evento['local']) ?>" required>
                        <div class="invalid-feedback">Informe o local do evento.</div>
                    </div>

                    <div class="mb-4">
                        <label for="vagas_disponiveis" class="form-label">Vagas Disponíveis</label>
                        <input type="number" class="form-control" id="vagas_disponiveis" name="vagas_disponiveis" min="0" value="<?= htmlspecialchars($evento['vagas_disponiveis']) ?>" required>
                        <div class="invalid-feedback">Informe um número de vagas válido (0 ou mais).</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-academic-primary">Atualizar Dados</button>
                        <a href="../index.php" class="btn btn-cancelar-academic">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/script.js"></script>
</body>
</html>