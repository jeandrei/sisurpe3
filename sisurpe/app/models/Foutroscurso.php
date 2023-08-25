<?php
    class Foutroscurso {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }
        
        public function getOutrosCursos(){            
            $this->db->query('SELECT foc.cursoId as cursoId, foc.curso as curso FROM f_outros_cursos foc');           
            $results = $this->db->resultSet();  
            if($this->db->rowCount() > 0){
                return $results;
            } else {
                return false;
            }  
        }        
    }
    
?>