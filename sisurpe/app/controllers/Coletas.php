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
                $tamanhosInvero = imptamanhounif($row->kit_inverno);
                $tamanhosVerao = imptamanhounif($row->kit_verao);
                $tamanhosCalcado = imptamanhounif($row->tam_calcado);
                $transporte1 = imptlinhastransporte($row->transporte1);
                $transporte2 = imptlinhastransporte($row->transporte2);
                $transporte3 = imptlinhastransporte($row->transporte3);
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
                                <label for='kitInverno'>Kit Inverno</label>  
                                <select
                                    class='form-control'
                                    name='kitInverno_$row->id'
                                    id='kitInverno_$row->id'          
                                    placeholder='Tamanho do Kit de Inverno'
                                    onChange='atualiza(this.id,this.value,$row->id)'
                                >
                                    <option value='null'>Selecione o Tamanho</option>
                                    $tamanhosInvero
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='kitVerao'>Kit Verão</label>  
                                <select
                                    class='form-control'
                                    name='kitVerao_$row->id'
                                    id='kitVerao_$row->id'          
                                    placeholder='Tamanho do Kit de Verão'
                                    onChange='atualiza(this.id,this.value,$row->id)'
                                >
                                    <option value='null'>Selecione o Tamanho</option>
                                    $tamanhosVerao
                                </select>                  
                                </div>
                                <div class='form-group col-md-2'>
                                <label for='tamCalcado'>Tamanho do Calçado</label>  
                                <select
                                    class='form-control'
                                    name='tamCalcado_$row->id'
                                    id='tamCalcado_$row->id'          
                                    placeholder='Tamanho do Calçado'
                                    onChange='atualiza(this.id,this.value,$row->id)'
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
                                    onChange='atualiza(this.id,this.value,$row->id)'
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
                                    onChange='atualiza(this.id,this.value,$row->id)'
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
                                    onChange='atualiza(this.id,this.value,$row->id)'
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


        public function update(){  
            $data=[
                'id' => $_POST['id'],
                'val' => $_POST['val'],
                'act' => $_POST['act']
            ];
            $error=false;

            if(empty($data['id'])){
                $error = true;
            }
            if(empty($data['val'])){
                $error = true;
            }
            if(empty($data['act'])){
                $error = true;
            } 

            if(
                $error === false
              )
            {                
                try{
                   
                    if($this->coletaModel->update($data)){                       
                        $json_ret = array(                                            
                                'class'=>'success', 
                                'message'=>'Dados atualizados com sucesso!',
                                'error'=>false
                        );                     
                        
                        echo json_encode($json_ret); 
                    } else {
                        throw new Exception('Erro ao gravar os dados');
                    }    
                } catch (Exception $e) {
                    //echo $e;
                    $json_ret = array(
                            'class'=>'error', 
                            'message'=>'Erro ao gravar os dados',
                            'error'=>true
                            );                     
                    echo json_encode($json_ret); 
                }
            }   else {
                $json_ret = array(
                    'class'=>'error', 
                    'message'=>'Erro ao tentar gravar os dados',
                    'error'=>true
                );
                echo json_encode($json_ret);
            }

            
        }
        
    }
?>