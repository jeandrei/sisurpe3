<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>

<!-- FLASH MESSAGE -->
<?php flash('message'); ?>

<!-- TÍTULO -->
<div class="row text-center">
    <h1><?php echo $data['init']['titulo']; ?></h1>
</div>


<!-- FORMULÁRIO -->
<form id="frmColeta" action="<?php echo URLROOT; ?>/coletas/index" method="GET" novalidate enctype="multipart/form-data">

 <!-- linha -->
  <div class="row mt-2 col-md-8 mx-auto">  
    <!-- coluna -->  
    <div class="col-md-8">

        <!-- ESCOLA -->
        <label for="escolaId">
            <b class="obrigatorio">*</b> Escola: 
        </label>
        <select
            name="escolaId"
            id="escolaId"
            class="form-control <?php echo (!empty($data['escolaId_err'])) ? 'is-invalid' : ''; ?>"
        >
            <option value="null">Selecione a Escola</option>
            <?php foreach($data['escolas'] as $row) : ?>
            <option 
                value="<?php htmlout($row->id); ?>"
                <?php echo ($data['escolaId']) == $row->id ? 'selected' : '';?>
            >
            <?php htmlout($row->nome); ?>
            </option>
            <?php endforeach; ?>  
        </select>
        <span class="text-danger">
            <?php echo $data['escolaId_err']; ?>
        </span>
        <!-- ESCOLA -->

        <!-- TURMA -->
        <label for="turmaId">
            <b class="obrigatorio">*</b> Turma: 
        </label>
        <select
            name="turmaId"
            id="turmaId"
            class="form-control <?php echo (!empty($data['turmaId_err'])) ? 'is-invalid' : ''; ?>"
        >
            <option value="null">Selecione a Escola</option>              
        </select>
        <span class="text-danger">
            <?php echo $data['turmaId_err']; ?>
        </span>
        <!-- TURMA -->


    </div>
    <!-- coluna --> 
    
    

     
      

  </div>
 <!-- linha -->


  <!-- ÚLTIMA LINHA DOS BOTÕES-->
  <div class="row mt-2">
    <div class="col-md-6 align-self-end mt-2" style="padding-left:5;"> 
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i> Gravar</button>
    </div>
  </div> 
<!-- ÚLTIMA LINHA DOS BOTÕES-->
</form>

<div id='result'>

</div>




<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>


<!-- SELECT DINÂMICO -->
<script>
    $(document).ready(function(){

              
        if($("#escolaId").val() !== 'null'){
          selectTurma();
        }         
       
        //CARREGA AS TURMAS
        $('#escolaId').change(function(){
          selectTurma();                     
            $('#turmaId').load('<?php echo URLROOT; ?>/turmas/turmasEscola/'+$('#escolaId').val());
        });
        

        //CARREGA OS ALUNOS
        $('#turmaId').change(function(){                           
            $('#result').load('<?php echo URLROOT; ?>/coletas/coletaTurma/'+$('#turmaId').val());
        });
        
    });
   

   function selectTurma(){
       document.getElementById('turmaId')[0].innerHTML = '<option value="null">Selecione a Escola</option>';       
   }

   function atualizaKitInverno(val,id){
    console.log('O valor atualizaKitInverno: ' + val + ' E o id é: ' + id);
   }

   function atualizaKitVerao(val,id){
    console.log('O valor atualizaKitVerao: ' + val + ' E o id é: ' + id);
   }

   function atualizaCalcado(val,id){
    console.log('O valor atualizaCalcado: ' + val + ' E o id é: ' + id);
   }

   function atualizaTransporte1(val,id){
    console.log('O valor atualizaTransporte1: ' + val + ' E o id é: ' + id);
   }

   function atualizaTransporte2(val,id){
    console.log('O valor atualizaTransporte2: ' + val + ' E o id é: ' + id);
   }

   function atualizaTransporte3(val,id){
    console.log('O valor atualizaTransporte3: ' + val + ' E o id é: ' + id);
   }

</script>
<!-- SELECT DINÂMICO -->