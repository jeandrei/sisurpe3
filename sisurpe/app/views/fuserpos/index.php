<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>


<!-- FLASH MESSAGE -->
<?php flash('message'); ?>


<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Curso superior.</h4>
  <p>Abaixo são listados os cursos superiores já adicionados.</p>
  <p>Para adicionar um curso superior clique em <b>+ Adicionar</b>. 
  <hr>
  <p class="mb-0"><p>Após adicionar todos os seus cursos, clique em <b>Avançar</b>.
</div>

<form id="frmUserPos" action="<?php echo URLROOT.'/fuserpos/index'?>" method="POST" novalidate enctype="multipart/form-data"> 

  <?php if($data['pos']) : ?>
    <?php foreach($data['pos'] as $row) : ?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="pos[]" value="<?php echo $row->posId;?>" id="<?php echo $row->posId;?>">
        <label class="form-check-label" for="<?php echo $row->posId;?>">
          <?php echo $row->pos; ?>
        </label>
      </div>
    <?php endforeach;?>
    <span class="text-danger">
        <?php echo $data['pos_err']; ?>
    </span>
  <?php else: ?>
    Erro ao carregar as opções de pós graduação!
  <?php endif;?>

  <!-- BOTÕES -->
  <div class="form-group mt-3 mb-3"> 

      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Salvar</button> 

      <a href="<?php echo URLROOT; ?>/fusercursosuperiores/index" class="btn bg-warning"><i class="fa-solid fa-backward"></i> Voltar</a>
            
  </div>   
  <!-- BOTÕES -->

</form>


<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>