<?php
require_once 'PHP/conexao.php';

$stmt = $pdo->query("SELECT * FROM eventos ORDER BY id");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
    <div class="container">
        <h2>Academic</h2>
        
        <div>
            <div class="header">
                <h4>Eventos Acadêmicos</h4>
                <a href="PHP/criar.php" class="btn-novo">Novo Evento</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Palestrante</th>
                        <th>Horário</th>
                        <th>Vagas</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= $evento['id'] ?></td>
                        <td><?= htmlspecialchars($evento['nome']) ?></td>
                        <td><?= htmlspecialchars($evento['palestrante']) ?></td>
                        <td><?= htmlspecialchars($evento['horario']) ?></td>
                        <td><?= htmlspecialchars($evento['vagas']) ?></td>
                        <td class="acoes">
                            <a href="editar.php?id=<?= $aluno['id'] ?>">Editar</a>
                            <button onclick="confirmarExclusao(<?= $aluno['id'] ?>)">Excluir</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmarExclusao(id) {
            if(confirm("Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.")) {
                window.location.href = "excluir.php?id=" + id;
            }
        }
    </script>
</body>
</html>