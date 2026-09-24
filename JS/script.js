// ============================================================
// Academic — script.js
// Validação dos formulários (Bootstrap) + modal de exclusão + animações
// Incluir DEPOIS do bootstrap.bundle.min.js
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    // ---------- Validação dos formulários (criar.php / editar.php) ----------
    // Usa o padrão de validação nativa do Bootstrap: qualquer form com a
    // classe "needs-validation" passa a exibir os campos inválidos ao enviar.
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // ---------- Exclusão de evento com modal (em vez do confirm() nativo) ----------
    var modalEl = document.getElementById('modalExcluir');

    if (modalEl) {
        var bsModal = new bootstrap.Modal(modalEl);
        var linkConfirmar = document.getElementById('linkConfirmarExclusao');
        var nomeEventoSpan = document.getElementById('nomeEventoExcluir');

        // Cada botão "Excluir" da tabela abre o modal já com o nome do evento
        document.querySelectorAll('.btn-excluir-evento').forEach(function (botao) {
            botao.addEventListener('click', function () {
                var id = this.dataset.id;
                var nome = this.dataset.nome;

                nomeEventoSpan.textContent = nome;
                linkConfirmar.href = 'PHP/excluir.php?id=' + id;
                bsModal.show();
            });
        });

        // Ao confirmar no modal, anima a linha saindo antes de redirecionar
        linkConfirmar.addEventListener('click', function (event) {
            var url = new URL(this.href, window.location.origin);
            var id = url.searchParams.get('id');
            var linha = document.querySelector('tr[data-evento-id="' + id + '"]');

            if (linha) {
                event.preventDefault();
                linha.classList.add('row-removing');

                var destino = this.href;
                setTimeout(function () {
                    window.location.href = destino;
                }, 280);
            }
        });
    }
});