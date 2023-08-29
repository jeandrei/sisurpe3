<?php
    class Fusercursosuperiores extends Controller{
        public function __construct(){

            if((!isLoggedIn())){ 
              flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
              redirect('users/login');
              die();
            }
            $this->escolaModel = $this->model('Escola');         
            $this->fuserescolaModel = $this->model('Fuserescolaano');
            $this->fuserformacoesModel = $this->model('Fuserformacao');
            $this->fareacursoModel = $this->model('Fareacurso');
            $this->fnivelcursoModel = $this->model('Fnivelcurso');
            $this->fcursossupModel = $this->model('Fcursossuperior');
            $this->fusercursossupModel = $this->model('Fusercursosuperior');
            $this->municipioModel = $this->model('Municipio');
            $this->regiaoModel = $this->model('Regiao');
            $this->estadoModel = $this->model('Estado');           
        }

        public function index() {  
          //se o usuário ainda não adicionou nenhuma escola, faço essa verificação para evitar passar para próxima etapa pelo link sem ter adicionado uma escola
          if(!$this->fuserformacoesModel->getUserFormacoesById($_SESSION[DB_NAME . '_user_id'])){
            flash('message', 'Você deve adicionar sua formação para informar os dados de curso superior!', 'error'); 
            redirect('fuserformacoes/index');
            die();
          }      
            
            
          $data['init'] = [
              'areasCurso' => $this->fareacursoModel->getAreasCurso(),
              'nivelCurso' => $this->fnivelcursoModel->getNivelCurso(),
              'cursosSuperiores' => $this->fcursossupModel->getCursosSup(),
              'tiposInstituicoes' => getTipoInstituicoes(),
              'userId' => $_SESSION[DB_NAME . '_user_id'],
              'titulo' => 'Curso superior',
              'regioes' => $this->regiaoModel->getRegioes(),
              'regiaoId' => html($_POST['regiaoId']),
              'estados' => $this->estadoModel->getEstadosRegiaoById($_POST['regiaoId']),
              'estadoId' => html($_POST['estadoId']),
              'estado' => $this->estadoModel->getEstadoById($_POST['estadoId']),
              'municipioId' => html($_POST['municipioId']),
              'municipio' => $this->municipioModel->getMunicipioById($_POST['municipioId']),
              'municipios' => $this->municipioModel->getMunicipiosEstadoById($_POST['estadoId'])
          ];
          
          if($userCursosSup = $this->fusercursossupModel->getCursosUser($_SESSION[DB_NAME . '_user_id'])){
            foreach($userCursosSup as $row) {
              $data['userCursosSup'][] = [
                'ucsId' => $row->ucsId,
                'areaId' => $row->areaId,
                'area' => $this->fareacursoModel->getAreaById($row->areaId)->area,
                'nivelId' => $row->nivelId,
                'nivel' => $this->fnivelcursoModel->getNivelById($row->nivelId)->nivel,
                'cursoId' => $row->cursoId,
                'curso' => $this->fcursossupModel->getCursoById($row->cursoId)->curso,
                'tipoInstituicao' => $row->tipoInstituicao,
                'instituicaoEnsino' => $row->instituicaoEnsino,
                'municipioInstituicao' => $this->municipioModel->getMunicipioById($row->municipioId)->nomeMunicipio
              ];
            };
          }
                    
                   
          $this->view('fusercursosuperiores/index',$data);         
          
        }

        public function add(){           
           
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ 

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    


                //init data
                unset($data);
                
                $data['init'] = [
                  'areaId' => trim($_POST['areaId']),
                  'nivelId' => trim($_POST['nivelId']),
                  'cursoId' => trim($_POST['cursoId']),
                  'userId' => $_SESSION[DB_NAME . '_user_id'],
                  'titulo' => 'Curso superior',
                  'regioes' => $this->regiaoModel->getRegioes(),
                  'regiaoId' => html($_POST['regiaoId']),
                  'estados' => $this->estadoModel->getEstadosRegiaoById($_POST['regiaoId']),
                  'estadoId' => html($_POST['estadoId']),
                  'estado' => $this->estadoModel->getEstadoById($_POST['estadoId']),
                  'municipioId' => html($_POST['municipioId']),
                  'municipio' => $this->municipioModel->getMunicipioById($_POST['municipioId']),
                  'municipios' => $this->municipioModel->getMunicipiosEstadoById($_POST['estadoId']),
                  'tipoInstituicao' => trim($_POST['tipoInstituicao']),
                  'instituicaoEnsino' => trim($_POST['instituicaoEnsino']),
                  'areasCurso' => $this->fareacursoModel->getAreasCurso(),
                  'nivelCurso' => $this->fnivelcursoModel->getNivelCurso(),
                  'cursosSuperiores' => $this->fcursossupModel->getCursosSup(),
                  'userCursosSup' => $this->fusercursossupModel->getCursosUser($_SESSION[DB_NAME . '_user_id']),
                  'tiposInstituicoes' => getTipoInstituicoes()                  
              ];  
                                  
                
                // Valida areaId
                if(empty($data['init']['areaId']) || ($data['init']['areaId'] == 'null')){
                    $data['init']['areaId_err'] = 'Por favor informe a área do curso.';
                }  

                // Valida nivelId
                if(empty($data['init']['nivelId']) || ($data['init']['nivelId'] == 'null')){
                  $data['init']['nivelId_err'] = 'Por favor informe o nível do curso.';
                } 

                // Valida cursoId
                if(empty($data['init']['cursoId']) || ($data['init']['cursoId'] == 'null')){
                  $data['init']['cursoId_err'] = 'Por favor informe o curso.';
                }  

                // Valida regiaoId
                if(empty($data['init']['regiaoId']) || ($data['init']['regiaoId'] == 'null')){
                  $data['init']['regiaoId_err'] = 'Por favor informe a região da instituição de ensino.';
                }  
                
                  // Valida estadoId
                  if(empty($data['init']['estadoId']) || ($data['init']['estadoId'] == 'null')){
                  $data['init']['estadoId_err'] = 'Por favor informe o estado da instituição de ensino.';
                } 

                // Valida municipioId
                if(empty($data['init']['municipioId']) || ($data['init']['municipioId'] == 'null')){
                  $data['init']['municipioId_err'] = 'Por favor informe o município da instituição de ensino.';
                } 

                // Valida tipoInstituicao
                if(empty($data['init']['tipoInstituicao']) || ($data['init']['tipoInstituicao'] == 'null')){
                    $data['init']['tipoInstituicao_err'] = 'Por favor informe tipo da instituição.';
                } 

                // Valida nstituicaoEnsino
                if(empty($data['init']['instituicaoEnsino']) || ($data['init']['instituicaoEnsino'] == '')){
                  $data['init']['instituicaoEnsino_err'] = 'Por favor informe a instituição de ensino.';
                } 
                               
                
                 /**
                * Faz o upload do arquivo do input id=file_post 
                * Utilizando a função upload_file que está no arquivo helpers/functions
                * Se tiver erro vai retornar o erro em $file['error'];
                */            
               
                if(!empty($_FILES['file_post']['name'])){                  
                  $file = $this->fusercursossupModel->upload('file_post'); 
                  if(empty($file['erro'])){
                    $data['init']['file_post_data'] = $file['data'];
                    $data['init']['file_post_name'] = $file['nome'];
                    $data['init']['file_post_type'] = $file['tipo'];
                    $data['init']['file_post_err'] = '';
                  }  else {
                    $data['init']['file_post_err'] = $file['message'];
                  }  
                }                              
               
                
                // Make sure errors are empty
                if(                    
                    empty($data['init']['areaId_err'])&&
                    empty($data['init']['nivelId_err'])&&
                    empty($data['init']['cursoId_err'])&&
                    empty($data['init']['tipoInstituicao_err'])&&
                    empty($data['init']['regiaoId_err'])&&
                    empty($data['init']['estadoId_err'])&&
                    empty($data['init']['municipioId_err'])&&
                    empty($data['init']['instituicaoEnsino_err']) && 
                    empty($data['init']['file_post_err'])
                  ){
                        // Register maiorEscolaridade
                        try {                            
                            if($this->fusercursossupModel->register($data['init'])){
                                flash('message', 'Curso superior registrado com sucesso!','success');                        
                                redirect('fusercursosuperiores/index');
                            } else {                                
                                throw new Exception('Ops! Algo deu errado ao tentar gravar os dados! Tente novamente.');
                            } 

                        } catch (Exception $e) {
                            $erro = 'Erro: '.  $e->getMessage(); 
                            flash('message', $erro,'error');                       
                            redirect('fusercursosuperiores/add');        
                        }  
                    } else {
                      // Load the view with errors
                        $this->view('fusercursosuperiores/add', $data);
                    }               

            
            } else {
              if(!$this->fuserformacoesModel->getUserFormacoesById($_SESSION[DB_NAME . '_user_id'])){
                flash('message', 'Você deve adicionar sua formação para informar os dados de curso superior!', 'error'); 
                redirect('fuserformacoes/index');
                die();
              }   
                
              $data['init'] = [
                  'areasCurso' => $this->fareacursoModel->getAreasCurso(),
                  'nivelCurso' => $this->fnivelcursoModel->getNivelCurso(),
                  'tiposInstituicoes' => getTipoInstituicoes(),
                  'userId' => $_SESSION[DB_NAME . '_user_id'],
                  'titulo' => 'Curso superior',
                  'regioes' => $this->regiaoModel->getRegioes()
              ];
              $this->view('fusercursosuperiores/add',$data);
            }
        }


        public function delete($_ucsId){          
          try {
            if($this->fusercursossupModel->delete($_ucsId)){           
                flash('message', 'Curso removido com sucesso!','success');                     
                redirect('fusercursosuperiores/index');
            } else {                        
                throw new Exception('Ops! Algo deu errado ao tentar excluir o curso!');
            }
          } catch (Exception $e) {                   
            $erro = 'Erro: '.  $e->getMessage();                      
            flash('message', $erro,'error');
            redirect('fusercursosuperiores/index');
          }
        }
    
}   
?>