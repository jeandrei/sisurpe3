<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>


<!-- FLASH MESSAGE -->
<?php flash('message'); ?>

<!-- TÍTULO -->
<div class="row">
    <div class="col-12 text-center">
        <h3><?php echo $data['titulo']; ?></h3>
    </div>    
</div>



<!-- FORMULÁRIO -->
<form id="frmUserCursoSuperior" action="<?php echo URLROOT.'/fuserformacoes/add'?>" method="POST" novalidate enctype="multipart/form-data">    
    
    <!-- grup de dados 1 -->
    <fieldset class="bg-light p-2">
        
        <!-- PRIMEIRA LINHA -->
        <div class="row">
            
            <!--areaId-->
            <div class="col-12"> 
                <label for="areaId">
                    <b class="obrigatorio">*</b> Área do curso: 
                </label> 
                <select
                    name="areaId"
                    id="areaId"
                    class="form-control <?php echo (!empty($data['areaId_err'])) ? 'is-invalid' : ''; ?>"
                >
                    <option value="null">Selecione</option>
                    <?php foreach($data['areasCurso'] as $row) : ?> 
                            <option value="<?php htmlout($row->areaId); ?>"
                            <?php echo $data['areaId'] == $row->areaId ? 'selected':'';?>
                            >
                                <?php htmlout($row->area);?>
                            </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?php echo $data['areaId_err']; ?>
                </span>
            </div>
            <!--areaId-->

        </div>
        <!-- PRIMEIRA LINHA --> 

    </fieldset>
    <!-- fim do grup de dados 1 -->    

    
    
</form>

<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>