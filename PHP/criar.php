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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Evento</title>
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
                <h3 class="mb-1">Cadastrar Novo Evento</h3>
                <p class="text-muted mb-4">Preencha os dados da palestra ou evento</p>

                <!-- "needs-validation" + "novalidate" ativam a validação customizada do script.js -->
                <form method="POST" action="" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Evento</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                        <div class="invalid-feedback">Informe o nome do evento.</div>
                    </div>

                    <div class="mb-3">
                        <label for="palestrante" class="form-label">Palestrante</label>
                        <input type="text" class="form-control" id="palestrante" name="palestrante" required>
                        <div class="invalid-feedback">Informe o nome do palestrante.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_evento" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data_evento" name="data_evento" required>
                            <div class="invalid-feedback">Escolha a data do evento.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="horario" class="form-label">Horário</label>
                            <input type="time" class="form-control" id="horario" name="horario" required>
                            <div class="invalid-feedback">Escolha o horário.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="local" class="form-label">Local</label>
                        <input type="text" class="form-control" id="local" name="local" required>
                        <div class="invalid-feedback">Informe o local do evento.</div>
                    </div>

                    <div class="mb-4">
                        <label for="vagas_disponiveis" class="form-label">Vagas Disponíveis</label>
                        <input type="number" class="form-control" id="vagas_disponiveis" name="vagas_disponiveis" min="0" required>
                        <div class="invalid-feedback">Informe um número de vagas válido (0 ou mais).</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-academic-primary">Salvar Cadastro</button>
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