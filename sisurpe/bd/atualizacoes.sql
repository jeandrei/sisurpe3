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
CREATE TABLE `users_formacao` (
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
*/
CREATE TABLE `user_formacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `userId` int(11) NOT NULL,
  `cursoSuperiorId` int(11) NOT NULL, 
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
Tabela apenas com cadastro de cursos superiores
*/
CREATE TABLE `curso_superior` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `cursoSuperior` varchar(100) DEFAULT NULL
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
21 - posConcluida pode selecionar mais de um
  Especialização
  Mestrado
  Doutorado
  Não tem pós-graduação concluída
*/
CREATE TABLE `user_formacao_pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `formacaoId` int(11) NOT NULL,   
  `posConcluida` varchar(50) DEFAULT NULL 
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
22 - Outros cursos específicos (Formação continuada com no mínimo 80 horas) - obrigatório selecionar ao menos um
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
CREATE TABLE `user_formacao_outros_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  `formacaoId` int(11) NOT NULL,   
  `curso` varchar(50) DEFAULT NULL 
) auto_increment=0,
ENGINE=InnoDB DEFAULT CHARSET=utf8;



