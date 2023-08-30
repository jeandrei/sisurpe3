<?php
    class Fuserpo {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

        public function getUserPos($_userId){            
            $this->db->query('SELECT fup.userId as userId, fup.posId as posId, fp.pos as pos FROM f_user_pos fup, f_pos fp WHERE fup.posId = fp.posId AND fup.userId = :userId');
            $this->db->bind(':userId', $_userId);           
            $results = $this->db->resultSet();  
            if($this->db->rowCount() > 0){
                return $results;
            } else {
                return false;
            }  
        }

        public function deleteAllPosUser($_userId){
            //se tem pos cadastrada
            if($this->getUserPos($_userId)){
                $this->db->query('DELETE FROM f_user_pos WHERE userId = :userId');
                $this->db->bind(':userId', $_userId);
                $row = $this->db->execute();
                if($this->db->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }   
            } else {
                return true;
            }
        }
         //Registra as pos do usuário
        public function register($data,$_userId){
            
            if(!$this->deleteAllPosUser($_userId)){
                return false;
            }

            $error = false;
            if($data){
                foreach($data as $row){
                    $this->db->query('
                                INSERT INTO f_user_pos SET                             
                                userId = :userId, 
                                posId = :posId
                                ');
                    $this->db->bind(':userId',$_userId);
                    $this->db->bind(':posId',$row); 
                    if(!$this->db->execute()){
                        $error = true;
                    }
                }
            }             
            if($error == true){
                return false;
            } else {
                return true;
            }
        }
        
        //Retorna o total de profissionais com uma especialização de uma escola
        public function getTotalEspecEscola($_escolaId,$_posId,$_ano){
            $this->db->query('SELECT COUNT(fup.userId) as total FROM f_user_pos fup, f_user_escola fue WHERE fup.userId = fue.userId AND fup.posId = :posId AND fue.escolaId = :escolaId AND fue.ano = :ano');
            $this->db->bind(':escolaId',$_escolaId);
            $this->db->bind(':posId',$_posId);
            $this->db->bind(':ano',$_ano);
            $row = $this->db->single();
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }
        }

        public function getUsersPos($_escolaId,$_ano){
            $this->db->query('SELECT u.name as nome, fp.pos as pos, e.nome as escola, fup.userId as userId, fup.posId as posId, fue.escolaId as escolaId, fue.ano as ano FROM users u, f_pos fp, escola e, f_user_pos fup, f_user_escola fue WHERE u.id = fup.userId AND fup.userId = fue.userId AND fp.posId = fup.posId AND e.id = fue.escolaId AND fue.escolaId = :escolaId AND fue.ano = :ano ORDER BY u.name, fp.pos ASC');
            $this->db->bind(':escolaId',$_escolaId);
            $this->db->bind(':ano',$_ano);
            $results = $this->db->resultSet();  
            if($this->db->rowCount() > 0){
                return $results;
            } else {
                return false;
            }
        }

        
    }
    
?>