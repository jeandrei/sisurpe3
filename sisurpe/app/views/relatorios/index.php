<?php require APPROOT . '/views/inc/header.php';?>

<?php flash('message'); ?>


<!-- ADD NEW -->
<div class="row mb-3">
    <div class="col-md-12 text-center">
        <h1><?php echo $data['init']['titulo']; ?></h1>
    </div>  
</div>

<div class="row mb-3">
    <div class="col-md-12 text-center">
        <a href="<?php echo URLROOT; ?>/relatorios/selectEscola">Relatório de uniforme por escola</a>
    </div>  
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>