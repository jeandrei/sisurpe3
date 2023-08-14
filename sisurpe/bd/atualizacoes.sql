ALTER TABLE inscricoes CHANGE livro localEvento VARCHAR(255);

ALTER TABLE inscricoes CHANGE folha periodo VARCHAR(50);

ALTER TABLE inscricoes ADD COLUMN horario time;

ALTER TABLE escola MODIFY numero INT(11) NULL;

ALTER TABLE escola ADD COLUMN emAtividade int(1) DEFAULT 1;

CREATE TABLE `turma` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `escolaId` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `coleta` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `turmaId` int(11) NOT NULL,
  `turno` varchar(255) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `kit_inverno` varchar(50) DEFAULT NULL,
  `kit_verao` varchar(50) DEFAULT NULL,  
  `tam_calcado` varchar(50) DEFAULT NULL,
  `transporte1` varchar(50) DEFAULT NULL,  
  `transporte2` varchar(50) DEFAULT NULL,  
  `transporte3` varchar(50) DEFAULT NULL   
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Tabela que vai liberar usuário para fazer uma determinada coleta */
CREATE TABLE `usere_scola_coleta` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `escolaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL   
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;


