<?php
// Inclui o arquivo de conexão para podermos usar a variável $pdo
require_once 'PHP/conexao.php';

// Busca (Read) todos os eventos cadastrados, do mais recente para o mais antigo
$stmt = $pdo->query("SELECT * FROM eventos ORDER BY id DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic - Eventos Acadêmicos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h2>Academic</h2>
            <p class="subtitle">Gerenciamento de eventos acadêmicos e palestras</p>
        </header>

        <div class="card">
            <div class="header">
                <h4>Eventos Acadêmicos</h4>
                <!-- Botão que leva para a página de criação -->
                <a href="PHP/criar.php" class="btn-novo">+ Novo Evento</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Palestrante</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Local</th>
                        <th>Vagas</th>
                        <th class="col-acoes">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($eventos)): ?>
                    <tr>
                        <td colspan="8" class="vazio">Nenhum evento cadastrado ainda.</td>
                    </tr>
                    <?php else: ?>
                        <!-- Laço de repetição para exibir os dados recuperados do banco -->
                        <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= $evento['id'] ?></td>
                            <td><?= htmlspecialchars($evento['nome']) // htmlspecialchars previne ataques XSS ?></td>
                            <td><?= htmlspecialchars($evento['palestrante']) ?></td>
                            <td><?= date('d/m/Y', strtotime($evento['data_evento'])) ?></td>
                            <td><?= substr(htmlspecialchars($evento['horario']), 0, 5) ?></td>
                            <td><?= htmlspecialchars($evento['local']) ?></td>
                            <td><span class="badge-vagas"><?= (int) $evento['vagas_disponiveis'] ?></span></td>
                            <td class="acoes">
                                <!-- Link passando o ID do evento via método GET na URL -->
                                <a href="PHP/editar.php?id=<?= $evento['id'] ?>" class="link-editar">Editar</a>

                                <!-- Botão de exclusão chamando a função JavaScript -->
                                <button onclick="confirmarExclusao(<?= $evento['id'] ?>)" class="btn-excluir">Excluir</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Customizado -->
    <script>
        // Função JS para confirmar a ação antes de deletar do banco
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.")) {
                // Se confirmar, redireciona para a página de exclusão passando o ID
                window.location.href = "PHP/excluir.php?id=" + id;
            }
        }
    </script>
</body>
</html>