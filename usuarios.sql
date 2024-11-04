CREATE DATABASE circuito;

USE circuito;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_postagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    imagem VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL,
    grand_prix VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    winner VARCHAR(100) NOT NULL,
    car VARCHAR(100) NOT NULL,
    laps INT NOT NULL,
    time VARCHAR(20) NOT NULL
);

INSERT INTO usuarios (nome, email, senha, imagem) VALUES
('Samuca', 'samuca@email.com', 'senha1', NULL),
('Thatha', 'thatha@email.com', 'senha2', NULL);

INSERT INTO comentarios (usuario_id, comentario, imagem) VALUES
(1, 'Estou muito empolgado para a próxima corrida!', NULL),
(2, 'A nova temporada promete grandes emoções!', NULL);