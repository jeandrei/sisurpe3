<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>

<!-- FLASH MESSAGE -->
<?php flash('message'); ?>

<!-- TÍTULO -->
<div class="row">
    <div class="col-12 text-center">
        <h3><?php echo $data['init']['titulo']; ?></h3>
    </div>    
</div>

<!-- FORMULÁRIO -->
<form id="frmUserCursoSuperior" action="<?php echo URLROOT.'/fusercursosuperiores/add'?>" method="POST" novalidate enctype="multipart/form-data">    
    
    <!-- grup de dados 1 -->
    <fieldset class="bg-light p-2">
        
        <!-- PRIMEIRA LINHA -->
        <div class="row mb-3">
            
            <!--areaId-->
            <div class="col-12"> 
                <label for="areaId">
                    <b class="obrigatorio">*</b> Área do curso: 
                </label> 
                <select
                    name="areaId"
                    id="areaId"
                    class="form-control <?php echo (!empty($data['init']['areaId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione</option>
                    <?php foreach($data['init']['areasCurso'] as $row) : ?> 
                            <option value="<?php htmlout($row->areaId); ?>"
                            <?php echo $data['init']['areaId'] == $row->areaId ? 'selected':'';?>
                            >
                                <?php htmlout($row->area);?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['areaId_err']; ?>
                </span>
            </div>
            <!--areaId-->

        </div>
        <!-- PRIMEIRA LINHA --> 

        <!-- SEGUNDA LINHA -->
        <div class="row mb-3">
            
            <!--nivelId-->
            <div class="col-12"> 
                <label for="nivelId">
                    <b class="obrigatorio">*</b> Nível: 
                </label> 
                <select
                    name="nivelId"
                    id="nivelId"
                    class="form-control <?php echo (!empty($data['init']['nivelId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione</option>
                    <?php foreach($data['init']['nivelCurso'] as $row) : ?> 
                            <option value="<?php htmlout($row->nivelId); ?>"
                            <?php echo $data['init']['nivelId'] == $row->nivelId ? 'selected':'';?>
                            >
                                <?php htmlout($row->nivel);?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['nivelId_err']; ?>
                </span>
            </div>
            <!--nivelId-->

        </div>
        <!-- SEGUNDA LINHA -->

        <!-- TERCEIRA LINHA -->
        <div class="row mb-3">
            
            <!--cursoId-->
            <div class="col-12"> 
                <label for="cursoId">
                    <b class="obrigatorio">*</b> Curso: 
                </label> 
                <select
                    name="cursoId"
                    id="cursoId"
                    class="form-control <?php echo (!empty($data['init']['cursoId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione</option>
                    <?php foreach($data['init']['cursosSuperiores'] as $row) : ?> 
                            <option value="<?php htmlout($row->cursoId); ?>"
                            <?php echo $data['init']['cursoId'] == $row->cursoId ? 'selected':'';?>
                            >
                                <?php htmlout($row->curso);?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['cursoId_err']; ?>
                </span>
            </div>
            <!--cursoId-->

        </div>
        <!-- TERCEIRA LINHA -->

        <!-- QUARTA LINHA -->
        <div class="row mb-3">
            
            <!--tipoInstituicao-->
            <div class="col-12"> 
                <label for="tipoInstituicao">
                    <b class="obrigatorio">*</b> Tipo da instiuição: 
                </label> 
                <select
                    name="tipoInstituicao"
                    id="tipoInstituicao"
                    class="form-control <?php echo (!empty($data['init']['tipoInstituicao_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione</option>
                    <?php foreach($data['init']['tiposInstituicoes'] as $row) : ?> 
                            <option value="<?php htmlout($row); ?>"
                            <?php echo $data['init']['tipoInstituicao'] == $row ? 'selected':'';?>
                            >
                                <?php htmlout($row);?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['tipoInstituicao_err']; ?>
                </span>
            </div>
            <!--tipoInstituicao-->

        </div>
         <!-- QUARTA LINHA -->
    </fieldset>
    <!-- fim do grup de dados 1 --> 

    <!-- grup de dados 2 -->
    <fieldset class="bg-light p-2 mt-3">
         <!-- QUINTA LINHA -->
        <div class="row mb-3">
            
            <!--	instituicaoEnsino-->
            <div class="col-12"> 
                <label for="instituicaoEnsino">
                    <b class="obrigatorio">*</b> Instituição de Ensino Nome: 
                </label> 
                <input 
                    type="text" 
                    name="instituicaoEnsino" 
                    id="instituicaoEnsino" 
                    class="form-control <?php echo (!empty($data['init']['instituicaoEnsino_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php htmlout($data['init']['instituicaoEnsino']);?>"
                    onkeydown="upperCaseF(this)"                    
                >
                <span class="text-danger">
                    <?php echo $data['init']['instituicaoEnsino_err']; ?>
                </span>
            </div>
            <!--	instituicaoEnsino-->

        </div>
        <!-- QUINTA LINHA -->

        <!-- SEXTA LINHA -->
        <div class="row mb-3">
         <!--regiaoId-->
         <div class="col-12">
                <label for="regiaoId">
                    <b class="obrigatorio">*</b> Instituição de Ensino Região: 
                </label>
                <select
                    name="regiaoId"
                    id="regiaoId"
                    class="form-control <?php echo (!empty($data['init']['regiaoId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione a Região</option>
                    <?php foreach($data['init']['regioes'] as $regiao) : ?>
                    <option 
                        value="<?php htmlout($regiao->id); ?>"
                        <?php echo ($data['init']['regiaoId']) == $regiao->id ? 'selected' : '';?>
                    >
                    <?php htmlout($regiao->regiao); ?>
                    </option>
                    <?php endforeach; ?>  
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['regiaoId_err']; ?>
                </span>
            </div>
            <!--regiaoId-->
        </div>
         <!-- SEXTA LINHA -->

        <!-- SETIMA LINHA -->
        <div class="row mb-3">
            <!--estadoId-->
            <div class="col-12"> 
                <label for="estadoId">
                    <b class="obrigatorio">*</b> Instituição de Ensino Estado: 
                </label>
                <select
                    name="estadoId"
                    id="estadoId"
                    class="form-control <?php echo (!empty($data['init']['estadoId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione a Região</option>
                    <?php foreach($data['init']['estados'] as $estado) : ?> 
                            <option value="<?php echo $estado->id; ?>"
                            <?php echo $data['init']['estadoId'] == $estado->id ? 'selected':'';?>
                            >
                                <?php echo $estado->estado;?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['estadoId_err']; ?>
                </span>
            </div>
            <!--estadoId-->
        </div>

        <!-- OITAVA LINHA -->
        <div class="row mb-3">
            <!--municipioId-->
            <div class="col-12"> 
                <label for="municipioId">
                    <b class="obrigatorio">*</b> Instituição de Ensino Município: 
                </label> 
                <select
                    name="municipioId"
                    id="municipioId"
                    class="form-control <?php echo (!empty($data['init']['municipioId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione a Região</option>
                    <?php foreach($data['init']['municipios'] as $municipio) : ?> 
                            <option value="<?php echo $municipio->id; ?>"
                            <?php echo $data['init']['municipioId'] == $municipio->id ? 'selected':'';?>
                            >
                                <?php echo $municipio->nomeMunicipio;?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['init']['municipioId_err']; ?>
                </span>
            </div>
            <!--municipioId-->
        </div>
        <!-- OITAVA LINHA -->
    </fieldset>
    <!-- fim do grup de dados 2 --> 

    <fieldset>
    <!-- NONA LINHA -->
       <!-- Adicionar arquivo-->
        <div class="row" style="margin:5px;">  
            <!-- Mensagem -->    
            <div class="alert alert-warning mt-2" role="alert">
                Arquivos permitidos com extenção <strong>jpg, png e pdf</strong>, e no máximo com <strong>20 MB</strong>. <b>Dica:</b> Se estiver utilizano o celular para bater uma foto do seu diploma, diminua a resolução da foto para não exceder o tamanho máximo permitido.
            </div>
            <!-- Input file -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="file_post">Upload</label>
                <input 
                    type="file" 
                    class="form-control" 
                    id="file_post"
                    name="file_post"                
                ><!-- A função fileValidation está no arquivo main.js-->                   
            </div><!--onchange="return fileValidation('file_post','file_post_err');" -->
            <!-- Span para caso tenha erros -->
            <span id="file_post_err" name="file_post_err" class="text-danger">
                <?php echo $data['init']['file_post_err']; ?>
            </span>
        </div><!-- row -->            
        <!-- Fim Adicionar arquivo -->                 
    <!-- NONA LINHA -->                   
    </fieldset>   
         
    

    <!-- BOTÕES -->
    <div class="form-group mt-3 mb-3">           
        <button type="submit" id="btnSalvar" name="btnSalvar" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Salvar</button> 

        <a href="<?php echo URLROOT; ?>/fusercursosuperiores/index" class="btn bg-warning"><i class="fa-solid fa-backward"></i> Voltar</a>
            
    </div>   
    <!-- BOTÕES -->

</form>

<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
    const btnSalvar = document.querySelector('#btnSalvar');

    btnSalvar.addEventListener("click",() => {
    loadingBtn('btnSalvar');  
    });
</script>

<!-- SELECT DINÂMICO -->
<script>
    $(document).ready(function(){

         /*     
         if($("#regiaoId").val() !== 'null'){            
            selectEstado();
        } 

        if($("#estadoId").val() !== 'null'){
             selectMunicipio(); 
        }*/
       
       //CARREGA OS ESTADOS
       $('#regiaoId').change(function(){          
          selectEstado();                      
          $('#estadoId').load('<?php echo URLROOT; ?>/estados/estadosRegiao/'+$('#regiaoId').val());
       });

       //CARREGA OS MUNICÍPIOS
       $('#estadoId').change(function(){ 
          selectMunicipio();
          $('#municipioId').load('<?php echo URLROOT; ?>/municipios/municipiosEstado/'+$('#estadoId').val());
       });
       
   });
   

   function selectRegiao(){
       document.getElementById('regiaoId').innerHTML = '<option value="null">Selecione a Região</option>';
       document.getElementById('estadoId').innerHTML = '<option value="null">Selecione a Região</option>';
       document.getElementById('municipioId').innerHTML = '<option value="null">Selecione a Região</option>';
   }

   function selectEstado(){ 
        document.getElementById('estadoId').innerHTML = '<option value="null">Selecione o Estado</option>';
        document.getElementById('municipioId').innerHTML = '<option value="null">Selecione o Estado</option>';
   }

   function selectMunicipio(){        
       document.getElementById('municipioId').innerHTML = '<option value="null">Selecione o Municipio</option>';
   }   

</script>
<!-- SELECT DINÂMICO -->