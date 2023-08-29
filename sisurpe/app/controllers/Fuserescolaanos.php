<?php 
    class Fuserescolaanos extends Controller{

        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            if((!isLoggedIn())){ 
              flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
              redirect('users/login');
              die();
            }
            $this->userModel = $this->model('User');
            $this->escolaModel = $this->model('Escola');
            $this->fuserescolaModel = $this->model('Fuserescolaano');
        }

        public function index(){    
              $data['init'] = [
                  'titulo' => 'Atualização dos dados do servidor para o ano de ',
                  'ano' => date("Y")
              ];
              $data['user'] = $this->userModel->getUserById($_SESSION[DB_NAME . '_user_id']);
              $data['escolas'] = $this->escolaModel->getEscolas();              
              $data['userEscolas'] = $this->fuserescolaModel->getEscolasUser($_SESSION[DB_NAME . '_user_id']);

              $this->view('users/userescola', $data);
              
      }


      public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'escolaId' => html($_POST['escolaId']),
            'userId' => $this->userModel->getUserById($_SESSION[DB_NAME . '_user_id'])->id
          ];

          if($data['escolaId'] == 'null'){
            $data['escolaId_err'] = 'Por favor selecione uma escola.';
          }


          if(
            empty($data['escolaId_err'])             
          ) 
          {
              try {                               
                if($this->fuserescolaModel->getUserEscolaAno($_SESSION[DB_NAME . '_user_id'],$data['escolaId'],date("Y"))){
                  throw new Exception('Ops! Escola já cadastrada!');
                }

                if($lastId = $this->fuserescolaModel->register($data)){                       
                    $data['lastId'] = $lastId;                       
                    flash('message', 'Cadastro realizado com sucesso!','success');                     
                    redirect('fuserescolaanos/index');
                } else {                        
                    throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                }
              } catch (Exception $e) {                   
                $erro = 'Erro: '.  $e->getMessage();                      
                flash('message', $erro,'error');
                $data['init'] = [
                  'titulo' => 'Atualização dos dados do servidor para o ano de ',
                  'ano' => date("Y")
                ];
                $data['user'] = $this->userModel->getUserById($_SESSION[DB_NAME . '_user_id']);
                $data['escolas'] = $this->escolaModel->getEscolas();              
                $data['userEscolas'] = $this->fuserescolaModel->getEscolasUser($_SESSION[DB_NAME . '_user_id']);
                $this->view('users/userescola',$data);
              } 
          } else {
            //Validação falhou
            $data['init'] = [
              'titulo' => 'Atualização dos dados do servidor para o ano de ',
              'ano' => date("Y")
            ];
            $data['user'] = $this->userModel->getUserById($_SESSION[DB_NAME . '_user_id']);
            $data['escolas'] = $this->escolaModel->getEscolas();              
            $data['userEscolas'] = $this->fuserescolaModel->getEscolasUser($_SESSION[DB_NAME . '_user_id']);
            flash('message', 'Erro ao efetuar o cadastro, verifique os dados informados!','error');                     
            $this->view('users/userescola', $data);
          }
        }
      }

      public function delete($_escolaId){
        try {
          if($this->fuserescolaModel->delete($_escolaId,$_SESSION[DB_NAME . '_user_id'])){           
              flash('message', 'Escola removida com sucesso!','success');                     
              redirect('fuserescolaanos/index');
          } else {                        
              throw new Exception('Ops! Algo deu errado ao tentar excluir a escola!');
          }
        } catch (Exception $e) {                   
          $erro = 'Erro: '.  $e->getMessage();                      
          flash('message', $erro,'error');
          redirect('fuserescolaanos/index');
        }
      }
}   
?>