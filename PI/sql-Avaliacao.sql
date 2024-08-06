SET SQL_SAFE_UPDATES = 1;

CREATE DATABASE login;
drop database login;
USE login;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('PROFESSOR', 'ALUNO') NOT NULL
);

select * from usuario;

-- Criação do banco de dados
CREATE DATABASE avaliacao;
drop database avaliacao;
USE avaliacao;

-- Criação da tabela com a coluna 'turma' na segunda posição
CREATE TABLE avaliacoes (
    nome VARCHAR(255),
    turma VARCHAR(20),
    docente_presenca VARCHAR(50),
    docente_pontualidade VARCHAR(50),
    docente_comunicacao VARCHAR(50),
    docente_dominio VARCHAR(50),
    docente_interesse VARCHAR(50),
    docente_interacao VARCHAR(50),
    docente_avaliacao VARCHAR(50),
    curso_needs VARCHAR(50),
    curso_temas VARCHAR(50),
    curso_carga VARCHAR(50),
    curso_relacao VARCHAR(50),
    material_suficiente VARCHAR(50),
    instalacoes_satisfatorias VARCHAR(50),
    coordenacao_presente VARCHAR(50),
    aluno_presenca VARCHAR(50),
    aluno_pontualidade VARCHAR(50),
    aluno_motivacao VARCHAR(50),
    aluno_participacao VARCHAR(50),
    aluno_aproveitamento VARCHAR(50),
    aluno_capacidade VARCHAR(50),
    comentarios TEXT,
    curso_origem VARCHAR(50)
);

-- Verificar a estrutura da tabela
DESCRIBE avaliacoes;
select * from avaliacoes;
