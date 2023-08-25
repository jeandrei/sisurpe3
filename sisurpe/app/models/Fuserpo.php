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

        
    }
    
?>