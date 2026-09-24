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

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontes do tema (Playfair Display + Manrope) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Estilo próprio do Academic (mantém a paleta e a fonte elegante, por cima do Bootstrap) -->
    <link rel="stylesheet" href="CSS/custom.css">
</head>
<body>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 960px;">

            <header class="page-header mb-4 pb-3 animate-fade-in">
                <h2 class="mb-1">Academic</h2>
                <p class="text-muted mb-0">Gerenciamento de eventos acadêmicos e palestras</p>
            </header>

            <div class="card card-academic p-4 animate-fade-in">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Eventos Acadêmicos</h4>
                    <!-- Botão que leva para a página de criação -->
                    <a href="PHP/criar.php" class="btn btn-academic-primary">+ Novo Evento</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle table-academic mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Palestrante</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Local</th>
                                <th>Vagas</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($eventos)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted fst-italic py-4">Nenhum evento cadastrado ainda.</td>
                            </tr>
                            <?php else: ?>
                                <!-- Laço de repetição para exibir os dados recuperados do banco -->
                                <?php foreach ($eventos as $evento): ?>
                                <tr data-evento-id="<?= $evento['id'] ?>">
                                    <td><?= $evento['id'] ?></td>
                                    <td><?= htmlspecialchars($evento['nome']) // htmlspecialchars previne ataques XSS ?></td>
                                    <td><?= htmlspecialchars($evento['palestrante']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($evento['data_evento'])) ?></td>
                                    <td><?= substr(htmlspecialchars($evento['horario']), 0, 5) ?></td>
                                    <td><?= htmlspecialchars($evento['local']) ?></td>
                                    <td><span class="badge badge-vagas"><?= (int) $evento['vagas_disponiveis'] ?></span></td>
                                    <td class="text-center text-nowrap">
                                        <!-- Link passando o ID do evento via método GET na URL -->
                                        <a href="PHP/editar.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-editar-academic me-1">Editar</a>

                                        <!-- Agora abre o modal de confirmação em vez do confirm() nativo -->
                                        <button type="button"
                                                class="btn btn-sm btn-outline-academic-danger btn-excluir-evento"
                                                data-id="<?= $evento['id'] ?>"
                                                data-nome="<?= htmlspecialchars($evento['nome'], ENT_QUOTES) ?>">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação de exclusão (Bootstrap) -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir <strong id="nomeEventoExcluir"></strong>?
                    Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="linkConfirmarExclusao" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (necessário para o modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script próprio do Academic -->
    <script src="JS/script.js"></script>
</body>
</html>