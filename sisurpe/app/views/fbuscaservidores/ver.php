<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<?php //debug($data);?>
 

<div class="container">
    <!-- nome do servidor --> 
    <div class="row">
        <div class="col-md-12 mb-3 mt-3 p-3 bg-secondary text-white">
            <h4>Servidor: <?php echo $data['user']->name;?></h4>                
        </div>
    </div>
    <!-- nome do servidor --> 

    <!-- linha escolas -->
    <?php if($data['escolas']) : ?>
      <?php $count = 0;?>
      <div class="row">
        <div class="col-md-12">
          <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Escolas do servidor</legend>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Escola</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['escolas'] as $row) : ?>
                  <tr>
                    <?php $count++;?>
                    <th scope="row"><?php echo $count;?></th>
                    <td><?php echo $row->escolaNome;?></td>                    
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>          
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <fieldset class="form-group border p-3">
          <legend class="w-auto px-2">Escolas do servidor</legend>
          <p>Servidor sem escolas informadas</p>
      </fieldset>
    <?php endif;?>
    <!-- linha escolas -->

    <!-- linha formação -->
    <?php if($data['forarmacao']) : ?>      
      <div class="row">
        <div class="col-md-12">
          <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Formação do Servidor</legend>
            <p>Maior escolaridade:
              <b><?php echo getMaiorEscolaridade($data['forarmacao']->maiorEscolaridade);?></b>
            </p>
            <p>Tipo de ensino médio cursado:
            <b><?php echo getTipoEnsinoMedio($data['forarmacao']->tipoEnsinoMedio);?></b>
            </p>
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <fieldset class="form-group border p-3">
          <legend class="w-auto px-2">Formação do Servidor</legend>
          <p>Servidor sem formação informada</p>
      </fieldset>
    <?php endif;?>
    <!-- linha formação -->


    <!-- linha curso superior -->
    <?php if($data['fcursossup']) : ?>
      <?php $count = 0;?>
      <div class="row">
        <div class="col-md-12">
          <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Cursos Superiores</legend>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Curso</th> 
                  <th scope="col">Area</th>    
                  <th scope="col">Nível</th>   
                  <th scope="col">Instituição</th> 
                  <th scope="col">Tipo Inst.</th>  
                  <th scope="col">Município</th>                
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['fcursossup'] as $row) : ?>
                  <tr>
                    <?php $count++;?>
                    <th scope="row"><?php echo $count;?></th>
                    <td><?php echo $row['curso'];?></td>                    
                    <td><?php echo $row['area'];?></td>
                    <td><?php echo $row['nivel'];?></td>
                    <td><?php echo $row['instituicaoEnsino'];?></td>
                    <td><?php echo $row['tipoInstituicao'];?></td>
                    <td><?php echo $row['municipio'];?></td>  
                    <?php if($row['file']) : ?>
                      <td><a href="<?php echo URLROOT; ?>/fusercursosuperiores/download/<?php echo $row['ucsId'];?>"><i class="fa-solid fa-paperclip"></i></a></td>
                    <?php else: ?>
                      <td></td>
                    <?php endif; ?>                  
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>          
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <fieldset class="form-group border p-3">
          <legend class="w-auto px-2">Cursos Superiores</legend>
          <p>Servidor sem curso superior informado</p>
      </fieldset>
    <?php endif;?>
    <!-- linha curso superior -->

    <!-- linha especialização -->
    <?php if($data['fpos']) : ?>
      <?php $count = 0;?>
      <div class="row">
        <div class="col-md-12">
          <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Especialização do servidor</legend>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Especialização</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['fpos'] as $row) : ?>
                  <tr>
                    <?php $count++;?>
                    <th scope="row"><?php echo $count;?></th>
                    <td><?php echo $row->pos;?></td>                    
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>          
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <fieldset class="form-group border p-3">
          <legend class="w-auto px-2">Especialização do servidor</legend>
          <p>Servidor sem especialização informadas</p>
      </fieldset>
    <?php endif;?>
    <!-- linha especialização -->


    <!-- linha outros cursos 80 horas -->
    <?php if($data['foutroscur']) : ?>
      <?php $count = 0;?>
      <div class="row">
        <div class="col-md-12">
          <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Outros cursos do servidor</legend>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Curso</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['foutroscur'] as $row) : ?>
                  <tr>
                    <?php $count++;?>
                    <th scope="row"><?php echo $count;?></th>
                    <td><?php echo $row['curso'];?></td>                    
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>          
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <fieldset class="form-group border p-3">
          <legend class="w-auto px-2">Outros cursos do servidor</legend>
          <p>Servidor sem outros cursos informados</p>
      </fieldset>
    <?php endif;?>
     <!-- linha outros cursos 80 horas -->
       
</div>  

<?php require APPROOT . '/views/inc/footer.php'; ?>