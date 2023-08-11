<?php 
    class Turmas extends Controller{
        public function __construct(){                  
            $this->turmaModel = $this->model('Turma');
        }
      
        
        //RETORNA O CÓDIGO HTML COM AS TURMAS DE UMA ESCOLA
        public function turmasEscola($escolaId){      
          /**
           * IMPORTANTE o echo dado aqui na função é retornado no arquivo index
           * no jquery load $('#estadoId').load(
           */

          //Pego os estados da região através do métdodo
          $data = $this->turmaModel->getTurmasEscolaById($escolaId);  
          
          //Se acaso vier null é pq o usuário selecionou a primeira opção novamente Selecione um ...
          if($escolaId == 'null'){
              die("<option value='null'>Selecione a Escola</option");
          }

          //O método getTurmasEscolaById retorna false se não tiver nenhum registro no bd
          //dessa forma se retornar falso imprimo sem turmas para esta escola
          if(!$data){
              die("<option value='null'>Sem turmas para esta escola</option>");
          }

         /**
          * Esse priemeiro option é para sempre adicionar no início do select, caso contário 
          * Ele vai sepmpre pegar o primeiro valor que tiver no option no caso a primeira escola
          */
          echo ("<option value='null'>Selecione a Turma</option>");

          //Faz o foreach para cada turma dentro do array $data
          //O que for dado echo vai ser retornado lá para o index no jquery $('#estadoId').load(
          foreach($data as $row){
              echo "<option value=".$row->id.">".$row->descricao."</option>";
          }
      }

    }
?>