CREATE DATABASE `sistema_de_perguntas` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

CREATE TABLE usuarios(
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(100),
email VARCHAR(100),
senha VARCHAR(200) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE perguntas(
id INT NOT NULL AUTO_INCREMENT,
pergunta VARCHAR(1000) NOT NULL,
id_usuario INT NOT NULL,
alternativa_correta VARCHAR(100) NOT NULL,
alternativa_errada1 VARCHAR(100) NOT NULL,
alternativa_errada2 VARCHAR(100),
alternativa_errada3 VARCHAR(100),
alternativa_errada4 VARCHAR(100),
dificuldade VARCHAR(10),
PRIMARY KEY (id),
CONSTRAINT fk_pessoa_pergunta FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);