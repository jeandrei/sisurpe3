<?php
class Coleta {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }

 

     //Retorna os alunos a serem coletados informações de uma turma
    public function coletaTurmaById($turmaId){
        $this->db->query('SELECT * FROM coleta WHERE turmaId = :turmaId ORDER BY nome ASC');
        $this->db->bind(':turmaId', $turmaId);
        $result = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }
    }  
}
?>