<?php 
    class Coletas extends Controller{
        public function __construct(){            
            $this->coletaModel = $this->model('Coleta');
            $this->escolaModel = $this->model('Escola');
        }

         /* Mostra os municípios que o cliente atende */
         public function index(){             
           
            if($_SERVER['REQUEST_METHOD'] == 'POST'){  
                        
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                unset($data);
                $data = [
                    'titulo' => 'Adicionar novo Atendimento',
                    'userId' => $_SESSION[SE.'user_id'],
                    'regioes' => $this->regiaoModel->getRegioes(),
                    
                    'regiaoId' => html($_POST['regiaoId']),

                    'estados' => $this->estadoModel->getEstadosRegiaoById($_POST['regiaoId']),
                                        
                    'estadoId' => html($_POST['estadoId']),
                    'estado' => $this->estadoModel->getEstadoById($_POST['estadoId']),
                    
                    'municipioId' => html($_POST['municipioId']),
                    'municipio' => $this->municipioModel->getMunicipioById($_POST['municipioId']),
                    
                    'municipios' => $this->municipioModel->getMunicipiosEstadoById($_POST['estadoId']),
                    'atendimentos' => $this->atendimentoModel->getAtendimentos()
                ];
                    
                //valida regiaoId  
                $data['regiaoId_err'] = 
                validate($data['regiaoId'], 
                    $options = [
                        'obrigatorio'=>true,
                        'tipo'=>'select'                  
                    ]                    
                );  
                
                //valida estadoId               
                $data['estadoId_err'] = 
                validate($data['estadoId'], 
                    $options = [
                        'obrigatorio'=>true,
                        'tipo'=>'select'                   
                    ]                    
                );  

                //valida municipioId                
                $data['municipioId_err'] = 
                validate($data['municipioId'], 
                    $options = [
                        'obrigatorio'=>true,
                        'tipo'=>'select'        
                    ]                    
                ); 
                                
                if(
                    empty($data['regiaoId_err'])&&
                    empty($data['estadoId_err'])&&
                    empty($data['municipioId_err'])           
                ){
                    //se o municipio já está adicionado ao atendimento emito erro  
                    if($this->atendimentoModel->getMunicipioAtendimentoById($data['municipioId'])){
                        flash('message', 'Atendimento já está cadastrado!','error'); 
                        $this->view('atendimentos/index',$data);   
                    } else {
                        try {
                            if($this->atendimentoModel->register($data)){                       
                                flash('message', 'Cadastro realizado com sucesso!','success'); 
                                $data['atendimentos'] = $this->atendimentoModel->getAtendimentos();
                                $this->view('atendimentos/index',$data);
                            } else {                        
                                throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                            }
    
                        } catch (Exception $e) {                   
                            $erro = 'Erro: '.  $e->getMessage();                      
                            flash('message', $erro,'error');
                            $this->view('atendimentos/index');
                        }            
                    }//else do if

                            
                } else {
                    //Validação falhou
                    flash('message', 'Erro ao efetuar o cadastro, verifique os dados informados!','error');                     
                    $this->view('atendimentos/index',$data);
                }                
                
            } else {
                //limpo o array $data
                unset($data);
                $data = [
                    'titulo'    => 'Coleta de Dados',
                    'escolas' => $this->escolaModel->getEscolas()
                ];
                $this->view('coletas/index', $data);
            }            
            
        }
        

        public function add(){
            $this->view('coletas/add');
        }

        public function edit(){            
            $this->view('coletas/edit');
        }
        
        
        public function coletaTurma($turmaId){
            $data = $this->coletaModel->coletaTurmaById($turmaId);
            $html = "";
            foreach($data as $row){
                $nascimento = formataData($row->nascimento);
                $tamanhosInvero = imptamanhounif($data['kit_inverno']);
                $tamanhosVerao = imptamanhounif($data['kit_verao']);
                $tamanhosCalcado = imptamanhounif($data['tam_calcado']);
                $transporte1 = imptlinhastransporte($data['transporte1']);
                $transporte2 = imptlinhastransporte($data['transporte2']);
                $transporte3 = imptlinhastransporte($data['transporte3']);
                $html .= "
                    <div class='row'>
                        <div class='col'>Nome: <b>$row->nome</b></div>
                    </div>
                    <div class='row'>                        
                        <div class='col'>Nascimento: $nascimento</div>
                        <div class='col'>Sexo: $row->sexo</div>
                    </div>
                    <div class='row'>
                        <div class='col'>                            
                            <div class='form-row'>  
                                <div class='form-group col-md-2'>
                                <label for='kit_inverno'>Kit Inverno</label>  
                                <select
                                    class='form-control'
                                    name='kit_inverno_$row->id'
                                    id='kit_inverno_$row->id'          
                                    placeholder='Tamanho do Kit de Inverno'
                                    onChange='atualizaKitInverno(this.value,$row->id)'
                                >
                                    <option value='null'>Selecione o Tamanho</option>
                                    $tamanhosInvero
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='kit_verao'>Kit Verão</label>  
                                <select
                                    class='form-control'
                                    name='kit_verao_$row->id'
                                    id='kit_verao_$row->id'          
                                    placeholder='Tamanho do Kit de Verão'
                                    onChange='atualizaKitVerao(this.value,$row->id)'
                                >
                                    <option value='null'>Selecione o Tamanho</option>
                                    $tamanhosVerao
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='tam_calcado'>Tamanho do Calçado</label>  
                                <select
                                    class='form-control'
                                    name='tam_calcado_$row->id'
                                    id='tam_calcado_$row->id'          
                                    placeholder='Tamanho do Calçado'
                                    onChange='atualizaCalcado(this.value,$row->id)'
                                >
                                    <option value='null'>Selecione o Tamanho</option>
                                    $tamanhosCalcado
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='transporte1'>Transporte Escolar 1</label>  
                                <select
                                    class='form-control'
                                    name='transporte1_$row->id'
                                    id='transporte1_$row->id'          
                                    placeholder='Linha que o aluno utiliza'
                                    onChange='atualizaTransporte1(this.value,$row->id)'
                                >
                                    <option value='null'>Selecione a Linha</option>
                                    $transporte1
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='transporte2'>Transporte Escolar 2</label>  
                                <select
                                    class='form-control'
                                    name='transporte2_$row->id'
                                    id='transporte2_$row->id'          
                                    placeholder='Linha que o aluno utiliza'
                                    onChange='atualizaTransporte2(this.value,$row->id)'
                                    >
                                    <option value='null'>Selecione a Linha</option>
                                    $transporte2
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='transporte1'>Transporte Escolar 3</label>  
                                <select
                                    class='form-control'
                                    name='transporte3_$row->id'
                                    id='transporte3_$row->id'          
                                    placeholder='Linha que o aluno utiliza'
                                    onChange='atualizaTransporte3(this.value,$row->id)'
                                    >
                                    <option value='null'>Selecione a Linha</option>
                                    $transporte3
                                </select>                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                ";
            }
            echo $html;
        }
    }
?>