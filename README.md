# 🎓 Academic — Gerenciamento de Eventos Escolares

O **Academic** é um site para a secretaria ou coordenação de uma escola/faculdade organizar os **eventos e palestras acadêmicas** do período letivo: quem vai palestrar, em que dia, horário, sala/auditório e quantas vagas ainda restam.

A ideia é simples: em vez de controlar tudo em planilha, a instituição tem uma página central onde consulta, cadastra, corrige e remove eventos.

---

## 🏫 O tema: eventos escolares

Um evento acadêmico, aqui, é qualquer palestra, semana temática, workshop ou seminário promovido pela escola. Para cada um, o sistema guarda:

- **Nome do evento** — ex: *"Semana de Tecnologia"*
- **Palestrante** — quem vai apresentar
- **Data** e **Horário**
- **Local** — auditório, sala, laboratório
- **Vagas disponíveis** — quantos alunos ainda podem se inscrever

Isso cobre o fluxo básico de uma coordenação: cadastrar o evento assim que é aprovado, ajustar detalhes (mudou o palestrante, mudou a sala) e remover o que foi cancelado.

---

## 🗂️ As páginas do site

### 1. Página inicial — `index.php`

<img width="1343" height="640" alt="image" src="https://github.com/user-attachments/assets/dd3ea986-2223-4d15-8de5-ebf601c5853b" />


É a **agenda de eventos**: uma tabela com todos os eventos cadastrados, mostrando nome, palestrante, data, horário, local e vagas disponíveis (em um selo verde, fácil de bater o olho). É por aqui que a coordenação acompanha tudo de uma vez, e é o ponto de partida para editar ou excluir um evento, ou cadastrar um novo pelo botão **"+ Novo Evento"**.

### 2. Cadastrar evento — `PHP/criar.php`

<img width="1344" height="767" alt="image" src="https://github.com/user-attachments/assets/74623ce3-689e-44eb-97d5-cacde5c4e3ae" />


Formulário para lançar um evento novo assim que ele é confirmado: nome, palestrante, data, horário, local e número de vagas. Ao salvar, volta direto para a agenda, já mostrando o evento recém-criado no topo da lista.

### 3. Editar evento — `PHP/editar.php`

<img width="1344" height="767" alt="image" src="https://github.com/user-attachments/assets/672901e3-02f9-4a64-b709-0622bad0f889" />


Abre o mesmo formulário, já preenchido com os dados atuais do evento (acessado pelo link "Editar" na agenda). Serve para corrigir qualquer detalhe — trocou o palestrante, mudou de sala, atualizou o número de vagas — sem precisar recriar o cadastro do zero.

### 4. Excluir evento — `PHP/excluir.php`

<img width="1343" height="638" alt="image" src="https://github.com/user-attachments/assets/c6b9ee9e-cf11-41ce-ae9d-4e8f74245cea" />


Não tem tela própria: é acionado pelo botão "Excluir" na agenda, que primeiro pede confirmação ("Tem certeza que deseja excluir este evento?") antes de remover o registro definitivamente do banco.

---

## 🚀 Como rodar (XAMPP)

1. Copie a pasta `Gerenciamento_eventos-escolares` para dentro de `htdocs`.
2. Ligue o Apache e o MySQL no painel do XAMPP.
3. No phpMyAdmin, importe `academic.sql` — cria o banco `academic`, a tabela `eventos` e já deixa 3 eventos de exemplo cadastrados.
4. Acesse `http://localhost/Gerenciamento_eventos-escolares/` no navegador.

Se o usuário/senha do seu MySQL não forem `root` / *(vazio)*, ajuste em `PHP/conexao.php`.

---

## 📁 Estrutura

```
Gerenciamento_eventos-escolares/
├── index.php          # Agenda de eventos (listagem)
├── academic.sql        # Cria o banco e a tabela `eventos`
├── PHP/
│   ├── conexao.php    # Conexão com o banco (PDO)
│   ├── criar.php      # Página de cadastro de evento
│   ├── editar.php     # Página de edição de evento
│   └── excluir.php    # Remove um evento
└── CSS/
    └── index.css       # Visual do site
```

---

## 🗺️ Ideias para continuar evoluindo

- [ ] Impedir vagas negativas e cadastro com data no passado
- [ ] Avisar se dois eventos forem marcados no mesmo local e horário
- [ ] Tela de inscrição de alunos, descontando vaga automaticamente a cada inscrição
- [ ] Filtro na agenda por data ou palestrante
