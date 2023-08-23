<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>

<!-- FLASH MESSAGE -->
<?php flash('message'); ?>

<!-- TÍTULO -->
<div class="row text-center">
    <h1><?php echo $data['titulo']; ?></h1>
</div>

<!-- FORMULÁRIO -->
<form id="frmUserFormacao" action="<?php echo URLROOT.'/fuserformacoes/add'?>" method="POST" novalidate enctype="multipart/form-data">    
    
    <!-- grup de dados 1 -->
    <fieldset class="bg-light p-2">
        
        <!-- PRIMEIRA LINHA -->
        <div class="row">
            
            <!--maiorEscolaridade-->        
            <div class="col-md-6">    
                <div class="mb-3">   
                    <label for="maiorEscolaridade">
                        <b class="obrigatorio">*</b>
                        Maior nível de escolaridade concluída: 
                    </label>
                    <select
                        name="maiorEscolaridade"
                        id="maiorEscolaridade"
                        class="form-control <?php echo (!empty($data['maiorEscolaridade_err'])) ? 'is-invalid' : ''; ?>"
                    >
                        <option value="null">Selecione</option>              
                        <option value="nao_concluiu">Não concluiu o ensino fundamental</option> 
                        <option value="e_fundamental">Ensino fundamental</option> 
                        <option value="e_superior">Ensino superior</option> 
                        <option value="e_medio">Ensino médio</option> 
                    </select>
                    <span class="text-danger">
                        <?php echo $data['maiorEscolaridade_err']; ?>
                    </span>
                </div>
            </div>
            <!--maiorEscolaridade--> 


            <!--tipoEnsinoMedio-->        
            <div class="col-md-6">    
                <div class="mb-3">   
                    <label for="turmaId">
                        <b class="obrigatorio">*</b>
                        Tipo de ensino médio cursado: 
                    </label>
                    <select
                        name="tipoEnsinoMedio"
                        id="tipoEnsinoMedio"
                        class="form-control <?php echo (!empty($data['tipoEnsinoMedio_err'])) ? 'is-invalid' : ''; ?>"
                    >
                        <option value="null">Selecione</option>              
                        <option value="geral">Formação geral</option> 
                        <option value="normal">Modalidade normal (magistério)</option> 
                        <option value="c_tecnico">Curso técnico</option> 
                        <option value="m_indigena">Magistério indígena - modalidade normal</option> 
                    </select>
                    <span class="text-danger">
                        <?php echo $data['tipoEnsinoMedio_err']; ?>
                    </span>
                </div>
            </div>
            <!--tipoEnsinoMedio--> 


        </div>
        <!-- PRIMEIRA LINHA --> 

    </fieldset>
    <!-- fim do grup de dados 1 -->    

    <!-- BOTÕES -->
    <div class="form-group mt-3 mb-3">           
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Salvar</button> 

        <a href="<?php echo URLROOT; ?>/municipios/edit/<?php echo $data['municipioId']; ?>" class="btn bg-warning"><i class="fa-solid fa-backward"></i> Voltar</a>
            
    </div>   
    <!-- BOTÕES -->
    
</form>

<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>