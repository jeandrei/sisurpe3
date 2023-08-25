<?php
    class Fuseroutroscursos extends Controller{
        public function __construct(){

            if((!isLoggedIn())){ 
              flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
              redirect('users/login');
              die();
            }   
            $this->fuserposModel = $this->model('Fuserpo');
            $this->foutrosCursosModel = $this->model('Foutroscurso');
            $this->fuseroutrosCursosModel = $this->model('Fuseroutroscurso');
        }

        public function index() {    
          
          //se o usuário ainda não adicionou nenhuma escola, faço essa verificação para evitar passar para próxima etapa pelo link sem ter adicionado uma escola
          if(!$this->fuserposModel->getUserPos($_SESSION[DB_NAME . '_user_id'])){
            flash('message', 'Você deve adicionar um curso de pós graduação primeiro!', 'error'); 
            redirect('fuserpos/index');
            die();
          } 

          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                       
            if(empty($_POST['outros'])){
              $data['outros_err'] = 'Por favor informe ao menos uma opção, se não tem nenhum curso informe a opção Nenhum.';
            }  

            if(                    
              empty($data['outros_err'])
            ){
              try {
                if($this->fuseroutrosCursosModel->register($_POST['outros'],$_SESSION[DB_NAME . '_user_id'])){
                    flash('message', 'Pós registrada com sucesso!','success');                        
                    redirect('fuseroutroscursos/index');
                } else {                                
                    throw new Exception('Ops! Algo deu errado ao tentar gravar os dados! Tente novamente.');
                } 

              } catch (Exception $e) {
                  $erro = 'Erro: '.  $e->getMessage(); 
                  flash('message', $erro,'error');                       
                  redirect('fuseroutroscursos/index');        
              }  
            }else {   
              $data['outrosCursos'] = $this->foutrosCursosModel->getOutrosCursos();                                   
              $this->view('fuseroutroscursos/index', $data);
            } 
            
          } else {
                   
            $data['outrosCursos'] = $this->foutrosCursosModel->getOutrosCursos();
            $data['useroutrosCursos'] = $this->fuseroutrosCursosModel->getUserOutrosCursos($_SESSION[DB_NAME . '_user_id']);
            if($data['useroutrosCursos']){
              foreach($data['useroutrosCursos'] as $row){
                $data['useroutrosCursosId'][] = $row->cursoId;
              } 
            } else {
              $data['useroutrosCursosId'] = 'null';
            }
            $this->view('fuseroutroscursos/index',$data);
          }          
          
        }        
    
}   
?>