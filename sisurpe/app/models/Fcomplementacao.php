<?php
    class Fcomplementacao {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

        

         // RETORNA TODAS AS COMPLEMENTAÇÕES CADASTRADAS
         public function getComplementacoes() {
            $this->db->query("SELECT * FROM f_complementacao_pedagogica ORDER BY complementacao ASC");
            $result = $this->db->resultSet(); 
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            } 
        }
       

        

        // RETORNA TODAS AS ESCOLAS
        public function getEscolas() {
            $this->db->query('SELECT * FROM escola ORDER BY nome ASC');            

            $result = $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        } 
     
         // Busca etapa por id
         public function getEscolaByid($id){
            $this->db->query('SELECT * FROM escola WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }
        } 
                

         // Deleta escola por id
         public function delete($id){            
            
            $this->db->query('DELETE FROM escola WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            $row = $this->db->execute();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }         

              
        public function atualizaSituacao($id,$situacao){            
            
            
            if($situacao == 'true')          {
                $sql = 'UPDATE escola SET emAtividade = 1 WHERE id = :id';
            } else {
                $sql = 'UPDATE escola SET emAtividade = 0 WHERE id = :id';
            }
                     
            $this->db->query($sql);

            // Bind values
            $this->db->bind(':id',$id);      

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }



    }//etapa
    
?>