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
CREATE TABLE `user_scola_coleta` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `escolaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL   
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
Tabela que vai armazenar a escola que o usuário trabalha no corrente ano
Tem que ser atualizada todos os anos
*/
CREATE TABLE `f_user_escola_ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `escolaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `ano` VARCHAR(4)
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
/* trygger addYear adiciona o ano atual na tabela  f_user_escola_ano.ano*/
CREATE TRIGGER addYear
BEFORE INSERT ON f_user_escola_ano
    FOR EACH ROW SET NEW.ano = YEAR(NOW());




CREATE TABLE `f_user_escola` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `escolaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

delimiter 

CREATE TRIGGER teste AFTER INSERT ON f_user_escola
FOR EACH ROW
  BEGIN
      INSERT INTO f_user_ano (userId,ano) VALUES (1,'2023');
  END


delimiter ;

/*funcionando
DROP TRIGGER IF EXISTS `addYear`;
CREATE TRIGGER `addYear` AFTER INSERT ON `f_user_escola`
 FOR EACH ROW 
 INSERT INTO `f_user_ano`(`userId`, `ano`) VALUES (NEW.userId,YEAR(NOW()));
*/


/* adiciona na tabela f_user_ano o id do usuário e o ano caso ainda não tenha o registro na tabela, fiz isso para ficar mais fácil de contar o número de professores no ano corrente */
DROP TRIGGER IF EXISTS `addYear`;
DELIMITER $$
CREATE TRIGGER `addYear` AFTER INSERT ON `f_user_escola`
FOR EACH ROW
BEGIN
IF NOT EXISTS (SELECT * FROM `f_user_ano` WHERE `userId` = NEW.userId AND `ano` = YEAR(NOW())) THEN
    INSERT INTO `f_user_ano`(`userId`, `ano`) VALUES (NEW.userId,YEAR(NOW()));
END IF;
END $$
DELIMITER ;



/*Quando o usuário cadastra os dados do servidor, ele seleciona a escola daquele ano, qundo salva na tabela f_user_escola a trigger addYear é acionada e adiciona o usuário e o ano na tabela f_user_ano, assim eu sei quais os usuários estão trabalhando no ano corrente*/
CREATE TABLE `f_user_ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,
  `ano` VARCHAR(4)
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
f_areas_curso
Tabela que vai armazenar as áreas de curso como 
Educação
Artes e humanidades
Ciências sociais, jornalismo e informação
Negócios, administração e direito
Ciências naturais, matemática e estatística
Computação e tecnologias da informação e Comunicação (TIC)
Engenharia, produção e construção
Agricultura, silvicultura, pesca e veterinária
Saúde e bem-estar
Serviços
*/
CREATE TABLE `f_areas_curso` (
  `areaId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `area` varchar(250) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `f_areas_curso`(`area`) VALUES ('Educação');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Artes e humanidades');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Ciências sociais, jornalismo e informação');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Negócios, administração e direito');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Ciências naturais, matemática e estatística');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Computação e tecnologias da informação e Comunicação (TIC)');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Engenharia, produção e construção');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Agricultura, silvicultura, pesca e veterinária');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Saúde e bem-estar');
INSERT INTO `f_areas_curso`(`area`) VALUES ('Serviços');

/*
f_nivel_curso
Tabela que vai armazenar os níveis de curso
Bacharelado
Licenciatura
Sequencial
Tecnológico
*/
CREATE TABLE `f_nivel_curso` (
  `nivelId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `nivel` varchar(250) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `f_nivel_curso`(`nivel`) VALUES ('Bacharelado');
INSERT INTO `f_nivel_curso`(`nivel`) VALUES ('Licenciatura');
INSERT INTO `f_nivel_curso`(`nivel`) VALUES ('Sequencial');
INSERT INTO `f_nivel_curso`(`nivel`) VALUES ('Tecnológico');

/*
f_curso_superior
Tabela que vai armazenar os cursos superiores
Educação infantil formação de professor - Licenciatura
Educação do campo formação de professor - Licenciatura
Educação especial formação de professor - Licenciatura
Educação indígena formação de pforessor - Licenciatura
Formação pedagógica de professor para a educação básica - Licenciatura
Pedagogia - Licenciatura
Artes formação de professor - Licenciatura
Artes visuais formação de professor - Licenciatura
Biologia fomação de professor - Licenciatura
Ciências agrárias formação de professor - Licenciatura
Ciências naturais formação de professor - Licenciatura
Ciências sociais formação de professor - Licenciatura
Cinema e audiovisual formação de professor - Licenciatura
Computação formação de professor - Licenciatura
Dança formação de professor - Licenciatura
Economia doméstica formação de professor - Licenciatura
Educação do campo em áreas de conhecimento da educação básica formação de professor - Licenciatura
Educação física formação de professor - Licenciatura
Educação indígena em áreas de conhecimento da educação básica formação de professor - Licenciatura
*/
CREATE TABLE `f_curso_superior` (
  `cursoId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `curso` varchar(250) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação infantil formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação do campo formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação especial formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação indígena formação de pforessor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Formação pedagógica de professor para a educação básica - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Pedagogia - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Artes formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Artes visuais formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Biologia fomação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Ciências agrárias formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Ciências naturais formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Ciências sociais formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Cinema e audiovisual formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Computação formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Dança formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Economia doméstica formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação do campo em áreas de conhecimento da educação básica formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação física formação de professor - Licenciatura');
INSERT INTO `f_curso_superior`(`curso`) VALUES ('Educação indígena em áreas de conhecimento da educação básica formação de professor - Licenciatura');

/*
f_pos
Tabela que vai armazenar os tipos de pos
Não tem pós-graduação concluida
Especialização
Mestrado
Doutorado
*/
CREATE TABLE `f_pos` (
  `posId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `pos` varchar(50) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `f_pos`(`pos`) VALUES ('Não tem pós-graduação concluida');
INSERT INTO `f_pos`(`pos`) VALUES ('Especialização');
INSERT INTO `f_pos`(`pos`) VALUES ('Mestrado');
INSERT INTO `f_pos`(`pos`) VALUES ('Doutorado');


/* formação do usuário 
19 - maiorEscolaridade:
  Não Concluiu o ensino fundamental
  Ensino Fundamental
  Ensino Médio
  Ensino Superior
19a - tipoEnsinoMedio
  Formação geral
  Modalidade Normal(magistério)
  Curso técnico
  Magistério indígena - modalidade normal
*/
CREATE TABLE `f_user_formacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,
  `maiorEscolaridade` varchar(50) DEFAULT NULL,
  `tipoEnsinoMedio` varchar(50) DEFAULT NULL  
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
19 - Curso superior
  areaCurso
    Educação
    Artes e humanidades
    Ciências sociais, jornalismo e informação
    Negócios, administração e direito
    Ciências naturais, matemática e estatística
    Computação e Tecologias da informação e Comunicação (TIC)
    Engenharia, produção e construção
    Agricultura, produção e construção
    Saúde e bem-estar
    Serviços
  nivelAcademico
    Bacharelado
    Licenciatura
    Sequencial
    Tecnológico
Tabela que armazena os cursos superiores do usuário
*/
CREATE TABLE `f_user_curso_superior` (
  `ucsId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,
  `areaId` int(11) NOT NULL,
  `nivelId` int(11) NOT NULL,
  `cursoId` int(11) NOT NULL,
  `tipoInstituicao` varchar(50)  NOT NULL,
  `instituicaoEnsino` varchar(50)  NOT NULL,
  `municipioId` int(11) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
21 - posConcluida pode selecionar mais de um
  Especialização
  Mestrado
  Doutorado
  Não tem pós-graduação concluída
*/
CREATE TABLE `f_user_pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,   
  `posId` varchar(50) DEFAULT NULL 
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
f_outros_cursos
Tabela para armazenar os outros cursos
Creche (0 a 3 anos)
Pré-escola (4 e 5 anos)
Anos Iniciais do ensino fundamental
Anos finais do ensino fundamental
Ensino médio
Educação de jovens e adultos
Educação especial
Educação indígena
Educação do campo
Educação ambiental
Educação em direitos humanos
Gênero e diversidade sexual
Direitos da criança e adolecente
Educação para as relações étnico-raciais e história e cultura afro-brasileira e africana
Gestão escolar
Outros
Nenhum
*/
CREATE TABLE `f_outros_cursos` (
  `cursoId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `curso` varchar(250) DEFAULT NULL 
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Nenhum');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Outros');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Creche (0 a 3 anos)');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Pré-escola (4 e 5 anos)');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Anos Iniciais do ensino fundamental');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Anos finais do ensino fundamental');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Ensino médio');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação de jovens e adultos');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação especial');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação indígena');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação do campo');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação ambiental');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação em direitos humanos');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Gênero e diversidade sexual');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Direitos da criança e adolecente');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Educação para as relações étnico-raciais e história e cultura afro-brasileira e africana');
INSERT INTO `f_outros_cursos`(`curso`) VALUES ('Gestão escolar');


/*vem da tabela f_outros_cursos*/
CREATE TABLE `f_user_outros_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,   
  `cursoId` int(11) NOT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;



