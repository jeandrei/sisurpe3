<?php
    class Fusercursosuperiores extends Controller{
        public function __construct(){

            if((!isLoggedIn())){ 
              flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
              redirect('users/login');
              die();
            }
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->escolaModel = $this->model('Escola');
            $this->bairroModel = $this->model('Bairro');
            $this->fuserescolaModel = $this->model('Fuserescolaano');
            $this->fuserformacoesModel = $this->model('Fuserformacao');
            $this->fareacursoModel = $this->model('Fareacurso');
            $this->fnivelcursoModel = $this->model('Fnivelcurso');
            $this->fcursossupModel = $this->model('Fcursossuperior');
            $this->fusercursossupModel = $this->model('Fusercursosuperior');
        }

        public function index() {  
          //se o usuário ainda não adicionou nenhuma escola, faço essa verificação para evitar passar para próxima etapa pelo link sem ter adicionado uma escola
          if(!$this->fuserformacoesModel->getUserFormacoesById($_SESSION[DB_NAME . '_user_id'])){
            flash('message', 'Você deve adicionar sua formação para informar os dados de curso superior!', 'error'); 
            redirect('fuserformacoes/index');
            die();
          }      
            
            
          $data = [
              'areasCurso' => $this->fareacursoModel->getAreasCurso(),
              'nivelCurso' => $this->fnivelcursoModel->getNivelCurso(),
              'cursosSuperiores' => $this->fcursossupModel->getCursosSup(),
              'userCursosSup' => $this->fusercursossupModel->getCursosUser($_SESSION[DB_NAME . '_user_id']),
              'userId' => $_SESSION[DB_NAME . '_user_id'],
              'titulo' => 'Curso superior'
          ];  
         
          $this->view('fusercursosuperiores/index',$data);         
          
        }

        public function add(){           
           
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ 

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    


                //init data
                unset($data);
                $data = [
                    'maiorEscolaridade' => trim($_POST['maiorEscolaridade']),
                    'tipoEnsinoMedio' => trim($_POST['tipoEnsinoMedio']),
                    'userId' => $_SESSION[DB_NAME . '_user_id'],
                    'titulo' => 'Formação do usuário'
                ];                
               
                   
                
                // Valida maiorEscolaridade
                if(empty($data['maiorEscolaridade']) || ($data['maiorEscolaridade'] == 'null')){
                    $data['maiorEscolaridade_err'] = 'Por favor informe o nível de escolaridade.';
                }  
                
                // Valida tipoEnsinoMedio
                if(empty($data['tipoEnsinoMedio']) || ($data['tipoEnsinoMedio'] == 'null')){
                    $data['tipoEnsinoMedio_err'] = 'Por favor informe tipo de ensino médio cursado.';
                } 
                               
                
                // Make sure errors are empty
                if(                    
                    empty($data['maiorEscolaridade_err'])&&
                    empty($data['tipoEnsinoMedio_err'])
                  ){
                        // Register maiorEscolaridade
                        try {

                            if($this->fuserformacoesModel->register($data)){
                                flash('message', 'Nível de escolaridade registrado com sucesso!','success');                        
                                redirect('fuserformacoes/index');
                            } else {                                
                                throw new Exception('Ops! Algo deu errado ao tentar gravar os dados! Tente novamente.');
                            } 

                        } catch (Exception $e) {
                            $erro = 'Erro: '.  $e->getMessage(); 
                            flash('message', $erro,'error');                       
                            redirect('fuserformacoes/index');        
                        }  
                    } else {
                      // Load the view with errors
                        if(!empty($data['erro'])){
                        flash('message', $data['erro'], 'error');
                        }                        
                        $this->view('fuserformacoes/index', $data);
                    }               

            
            } 
        }
    
}   
?>