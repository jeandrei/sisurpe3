<?php
    class Fnivelcurso {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

       
        public function getNivelCurso(){
          $this->db->query('SELECT nc.nivelId as nivelId, nc.nivel as nivel FROM f_nivel_curso nc');           
            $result = $this->db->resultSet();
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        }


    }//area
    
?>