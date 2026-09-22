-- Banco de dados do projeto Academic (Gerenciador de Eventos Acadêmicos/Palestras)
-- Importe este arquivo no phpMyAdmin (ou rode via linha de comando) antes de usar o site.

CREATE DATABASE IF NOT EXISTS academic CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE academic;

-- Estrutura da tabela `eventos`
CREATE TABLE IF NOT EXISTS eventos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  palestrante VARCHAR(150) NOT NULL,
  data_evento DATE NOT NULL,
  horario TIME NOT NULL,
  local VARCHAR(150) NOT NULL,
  vagas_disponiveis INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dados de exemplo
INSERT INTO eventos (nome, palestrante, data_evento, horario, local, vagas_disponiveis) VALUES
('Semana de Tecnologia', 'Dra. Ana Ribeiro', '2026-10-14', '14:00:00', 'Auditório Central', 60),
('Palestra sobre Inteligência Artificial', 'Prof. Carlos Menezes', '2026-10-20', '19:00:00', 'Sala 204 - Bloco B', 40),
('Workshop de Banco de Dados', 'Msc. Fernanda Alves', '2026-11-05', '09:30:00', 'Laboratório 3', 25);
