<?php
    class Fareacurso {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

       
        public function getAreasCurso(){
          $this->db->query('SELECT fac.areaId as areaId, fac.area as area FROM f_areas_curso fac');           
            $result = $this->db->resultSet();
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        }


    }//area
    
?>