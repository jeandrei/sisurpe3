<?php
    class Relatorios extends Controller{
        public function __construct(){
            // 1 Chama o model
          $this->relatorioModel = $this->model('Relatorio');
          $this->escolaModel = $this->model('Escola');
          $this->coletaModel = $this->model('Coleta');
          $this->turmaModel = $this->model('Turma');
        }

        public function index(){ 
          
            $data['init'] = [
              'titulo' => 'Relatórios',              
            ];

            $this->view('relatorios/index',$data);
        }


        public function selectEscola(){
          $data['init'] = [
            'titulo' => 'Selecione a escola',              
          ];
          $data['escolas'] = $this->escolaModel->getEscolas();
          $this->view('relatorios/selectEscola',$data);
        }

        public function uniformePorEscola(){
         
          //pego a escola
          $data['escola'] = $this->escolaModel->getEscolaById($_GET['escolaId']);
          //pego todas as turmas da escola
          $data['turmas'] = $this->turmaModel->getTurmasEscolaById($_GET['escolaId']);
          //debug($data['turmas']);
          
          //monto os dados para cada turma
          foreach($data['turmas'] as $row){
            //var_dump($row->descricao);
             $data['result'][] = [
              'turmaId' => $row->id,
              'turma' => $row->descricao,
              'coleta' => $this->coletaModel->getColetaByTurma($row->id),
              'kit_inverno' => $this->coletaModel->totais($row->id,'kit_inverno'),
              'kit_verao' => $this->coletaModel->totais($row->id,'kit_verao'),     
              'tam_calcado' => $this->coletaModel->totais($row->id,'tam_calcado'),
              'total' => $this->coletaModel->totaisEscola($_GET['escolaId'])
            ]; 
           
          }   
          
          $this->view('relatorios/coletaPorEscola',$data);
        }
      
}