<?php 
    class Coletas extends Controller{
        public function __construct(){            
            $this->coletaModel = $this->model('Coleta');
            $this->escolaModel = $this->model('Escola');
        }

         /* Mostra os municípios que o cliente atende */
         public function index(){             
           
            unset($data);
                $data = [
                    'titulo'    => 'Coleta de Dados',
                    'escolas' => $this->escolaModel->getEscolas()
                ];
                $this->view('coletas/index', $data);            
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
                    <div class='faq'>
                        <div class='row p-3 mb-2 bg-secondary text-white row_$row->id'>
                            <div class='col-2 mt-2';>
                            <i class='fa-solid fa-square-check fa-lg' style='color: #0ae657;'></i>
                            </div> 
                            <div class='col-10'>
                                <b>$row->nome</b>
                            </div>
                        </div>
                        <div class='row mb-2'>   
                            <div class='col-12 col-lg-2'>
                              <button class='faq-toggle'>Expandir</button>
                            </div>
                            <div class='col-12 col-lg-6'><b>Nascimento:</b> $nascimento</div>
                            <div class='col-12 col-lg-4'><b>Sexo:</b> $row->sexo</div>
                        </div>
                        <div class='row p-3 mb-2 bg-light text-dark detail'>
                            <div class='col'>                            
                                <div class='form-row'>                                  
                                    <div class='form-group col-md-2'>
                                    <label for='kitInverno'>Kit Inverno</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='kitInverno_$row->id'
                                        id='kitInverno_$row->id'          
                                        placeholder='Tamanho do Kit de Inverno'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                    >
                                        <option value='null'>Selecione o Tamanho</option>
                                        $tamanhosInvero
                                    </select>                  
                                    </div>
                                    <div class='form-group col-md-2'>
                                    <label for='kitVerao'>Kit Verão</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='kitVerao_$row->id'
                                        id='kitVerao_$row->id'          
                                        placeholder='Tamanho do Kit de Verão'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                    >
                                        <option value='null'>Selecione o Tamanho</option>
                                        $tamanhosVerao
                                    </select>                  
                                    </div>
                                    <div class='form-group col-md-2'>
                                    <label for='tamCalcado'>Tamanho do Calçado</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='tamCalcado_$row->id'
                                        id='tamCalcado_$row->id'          
                                        placeholder='Tamanho do Calçado'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                    >
                                        <option value='null'>Selecione o Tamanho</option>
                                        $tamanhosCalcado
                                    </select>                  
                                    </div>
                                    <div class='form-group col-md-2'>
                                    <label for='transporte1'>Transporte Escolar 1</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='transporte1_$row->id'
                                        id='transporte1_$row->id'          
                                        placeholder='Linha que o aluno utiliza'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                    >
                                        <option value='null'>Selecione a Linha</option>
                                        $transporte1
                                    </select>                  
                                    </div>
                                    <div class='form-group col-md-2'>
                                    <label for='transporte2'>Transporte Escolar 2</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='transporte2_$row->id'
                                        id='transporte2_$row->id'          
                                        placeholder='Linha que o aluno utiliza'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                        >
                                        <option value='null'>Selecione a Linha</option>
                                        $transporte2
                                    </select>                  
                                    </div>
                                    <div class='form-group col-md-2'>
                                    <label for='transporte1'>Transporte Escolar 3</label>  
                                    <select
                                        class='form-control class_$row->id'
                                        name='transporte3_$row->id'
                                        id='transporte3_$row->id'          
                                        placeholder='Linha que o aluno utiliza'
                                        onChange='atualiza(this.id,this.value,$row->id),checkAllFilled($row->id)'
                                        >
                                        <option value='null'>Selecione a Linha</option>
                                        $transporte3
                                    </select>                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>              
                    <script>
                    checkAllFilled($row->id);
                        toggles  = document.querySelectorAll('.faq-toggle')
                        toggles.forEach((toggle)=> {
                        toggle.addEventListener('click', () => {
                            console.log(toggle.parentNode.parentNode.parentNode);
                            toggle.parentNode.parentNode.parentNode.classList.toggle('active')
                        })
                    })
                    </script>
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