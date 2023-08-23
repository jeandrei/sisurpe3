<?php
    class Fuserformacao {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

        // Registra a formacao na tabela f_user_formacao 
        public function register($data){  

            $this->db->query('SELECT * FROM f_user_formacao WHERE userId = :userId');
            $this->db->bind(':userId',$data['userId']);
            $result = $this->db->resultSet();            
            //verifico se já tem cadastro, se não tem registro se tem atualizo            
            if($this->db->rowCount() > 0){
            //update
            $sql = 'UPDATE f_user_formacao SET maiorEscolaridade = :maiorEscolaridade, tipoEnsinoMedio = :tipoEnsinoMedio WHERE userId = :userId';
            } else {
            //insert
            $sql = 'INSERT INTO f_user_formacao (userId, maiorEscolaridade,tipoEnsinoMedio) VALUES (:userId, :maiorEscolaridade,:tipoEnsinoMedio)';
            }
            
            $this->db->query($sql);
            // Bind values
            $this->db->bind(':userId',$data['userId']);
            $this->db->bind(':maiorEscolaridade',$data['maiorEscolaridade']);
            $this->db->bind(':tipoEnsinoMedio',$data['tipoEnsinoMedio']);
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // RETORNA TODAS AS ESCOLAS DO USUÁRIO NA TABELA f_user_escola
        public function getEscolasUser($user_id) {          
          $this->db->query('SELECT escola.id as escolaId, escola.nome as escolaNome, f_user_escola.escolaId as fuEscolaId FROM escola, f_user_escola WHERE escola.id = f_user_escola.escolaId AND f_user_escola.userId = :userId');            

          $this->db->bind(':userId',$user_id);

          $result = $this->db->resultSet();

          // Check row
          if($this->db->rowCount() > 0){
              return $result;
          } else {
              return false;
          }
      }

      // Deleta um registro da tabela f_user_escola
      public function delete($_escolaId,$_userId){         
        $this->db->query('DELETE FROM f_user_escola WHERE escolaId = :escolaId AND userId = :userId');
        $this->db->bind(':escolaId', $_escolaId);
        $this->db->bind(':userId', $_userId);
        $row = $this->db->execute();        
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }         

        // Update Escola
        public function update($data){             
            
            $this->db->query('UPDATE escola SET nome = :nome, bairro_id = :bairro_id, logradouro = :logradouro, numero = :numero, emAtividade = :emAtividade WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':nome',$data['nome']);            
            $this->db->bind(':bairro_id',$data['bairro_id']);
            $this->db->bind(':logradouro',$data['logradouro']);
            $this->db->bind(':numero',$data['numero']);
            $this->db->bind(':emAtividade',$data['emAtividade']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

         

         // RETORNA O NOME DE UMA ESCOLA A PARTIR DE UM ID
         public function getNomeEscola($id) {
            $this->db->query("SELECT nome FROM escola WHERE id = :id");
            $this->db->bind(':id', $id);    
            $row = $this->db->single();           

            if($this->db->rowCount() > 0){
                return $row->nome;
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