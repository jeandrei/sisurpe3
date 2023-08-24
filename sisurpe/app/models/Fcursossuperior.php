<?php
    class Fcursossuperior {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

       
        public function getCursosSup(){
          $this->db->query('SELECT cs.cursoId as cursoId, cs.curso as curso FROM f_curso_superior cs');           
            $result = $this->db->resultSet();
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        }


    }//area
    
?>