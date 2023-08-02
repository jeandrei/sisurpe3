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

    public function update($data){        
        $sql = 'UPDATE coleta SET ';
        switch ($data['act']) {
            case 'kitInverno':
                $sql .= 'kit_inverno = :kit_inverno';
                break;
            case 'kitVerao':
                $sql .= 'kit_verao = :kit_verao';
                break;
            case 'tamCalcado':
                $sql .= 'tam_calcado = :tam_calcado';
                break;
            case 'transporte1':
                $sql .= 'transporte1 = :transporte1';
                break;
            case 'transporte2':
                $sql .= 'transporte2 = :transporte2';
                break;
            case 'transporte3':
                $sql .= 'transporte3 = :transporte3';
                break;            
        }
        $sql .= ' WHERE id = :id';
        //echo $sql;
        //die();
        $this->db->query($sql);
        //bind
        switch ($data['act']) {
            case 'kitInverno':
                $this->db->bind(':kit_inverno',$data['val']);
                break;
            case 'kitVerao':
                $this->db->bind(':kit_verao',$data['val']);
                break;
            case 'tamCalcado':
                $this->db->bind(':tam_calcado',$data['val']);
                break;
            case 'transporte1':
                $this->db->bind(':transporte1',$data['val']);
                break;
            case 'transporte2':
                $this->db->bind(':transporte2',$data['val']);
                break;
            case 'transporte3':
                $this->db->bind(':transporte3',$data['val']);
                break;            
        }
        $this->db->bind(':id',$data['id']); 
      
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>