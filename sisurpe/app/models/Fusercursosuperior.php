<?php
    class Fusercursosuperior {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }


        public function getCursosUser($_userId){
            $this->db->query('SELECT fucs.ucsId,fucs.userId as userId, fucs.areaId as areaId, fucs.nivelId as nivelId, fucs.cursoId as cursoId, fucs.tipoInstituicao as tipoInstituicao, fucs.instituicaoEnsino as instituicaoEnsino, fucs.municipioId as municipioId  FROM f_user_curso_superior fucs ORDER BY fucs.instituicaoEnsino ASC');
            $result = $this->db->resultSet();
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        }

        // Registra um curso na tabela f_user_curso_superior
        public function register($data){  
            $sql = 'INSERT INTO f_user_curso_superior (userId, areaId,nivelId,	cursoId,tipoInstituicao,instituicaoEnsino,municipioId) VALUES (:userId, :areaId,:nivelId,:cursoId,:tipoInstituicao,:instituicaoEnsino,:municipioId)';           
            $this->db->query($sql);
            // Bind values
            $this->db->bind(':userId',$data['userId']);
            $this->db->bind(':areaId',$data['areaId']);
            $this->db->bind(':nivelId',$data['nivelId']);
            $this->db->bind(':cursoId',$data['cursoId']);
            $this->db->bind(':tipoInstituicao',$data['tipoInstituicao']);
            $this->db->bind(':instituicaoEnsino',$data['instituicaoEnsino']);
            $this->db->bind(':municipioId',$data['municipioId']);
            // Execute
            if($this->db->execute()){
                return $this->db->lastId;
            } else {
                return false;
            }
        }


        public function getUserFormacoesById($_userId){            
            $this->db->query('SELECT fuf.userId as userId, fuf.maiorEscolaridade as maiorEscolaridade, fuf.tipoEnsinoMedio as tipoEnsinoMedio FROM f_user_formacao fuf WHERE fuf.userId = :userId');
            $this->db->bind(':userId',$_userId);
            $row = $this->db->single();
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }
        }


        public function delete($_ucsId){
            $this->db->query('DELETE FROM f_user_curso_superior WHERE ucsId = :ucsId');
            $this->db->bind(':ucsId', $_ucsId);
            $row = $this->db->execute();
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }        
        }

        
    }
    
?>