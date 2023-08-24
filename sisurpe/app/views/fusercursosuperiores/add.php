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

         <!-- QUINTA LINHA -->
        <div class="row mb-3">
            
            <!--	instituicaoEnsino-->
            <div class="col-12"> 
                <label for="instituicaoEnsino">
                    <b class="obrigatorio">*</b> Nome da Instituição de Ensino: 
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

    </fieldset>
    <!-- fim do grup de dados 1 -->      
    

    <!-- BOTÕES -->
    <div class="form-group mt-3 mb-3">           
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Salvar</button> 

        <a href="<?php echo URLROOT; ?>/fusercursosuperiores/index" class="btn bg-warning"><i class="fa-solid fa-backward"></i> Voltar</a>
            
    </div>   
    <!-- BOTÕES -->

</form>

<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>