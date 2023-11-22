<?php

if (isset($_POST['submit_produto'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $estado = $_POST['estado'];
    $stock = $_POST['stock'];
    $destaques = $_POST['destaques'];
    $novidade = $_POST['novidade'];
    $especificacoes = $_POST['especificacoes'];

    if ($estado > 1 && $novidade == 1) {
        $novidade = 0;
        echo "<script type='text/javascript'>
            Swal.fire(
                'Verificação',
                'Não é possível colocar o produto como novidade e usado!',
                'error'
            );
        </script>";
    } else {
        $insere = "INSERT INTO produtos (nome, preco, stock, descricao, id, estado, destaques, novidade, especificacoes) VALUES ('$nome', '$preco', '$stock', '$descricao', '{$_SESSION['id']}', '$estado', '$destaques', '$novidade', '$especificacoes')";
        $result = mysqli_query($ligax, $insere);

      
        if ($result == 1) {
            echo "<script type='text/javascript'>
                toastr.options = {
                    'closeButton': true,
                    'debug': false,
                    'newestOnTop': true,
                    'progressBar': true,
                    'positionClass': 'toast-bottom-right',
                    'preventDuplicates': true,
                    'onclick': null,
                    'showDuration': '1200',
                    'hideDuration': '3000',
                    'timeOut': '3000',
                    'extendedTimeOut': '1000',
                    'showEasing': 'swing',
                    'hideEasing': 'linear',
                    'showMethod': 'show',
                    'hideMethod': 'fadeOut'
                };
                toastr['success']('Produto criado com sucesso');
            </script>";

            $file_id = mysqli_insert_id($ligax);

            if (isset($_POST['cod_categoria'])) {
                foreach ($_POST['cod_categoria'] as $value) {
                    $insere1 = "INSERT INTO produto_categoria (cod_produto, cod_categoria) VALUES ('$file_id', '$value')";
                    $result1 = mysqli_query($ligax, $insere1);
                }
            }

            if (isset($_POST['cod_marca'])) {
                foreach ($_POST['cod_marca'] as $value) {
                    $insere1 = "INSERT INTO produto_marca (cod_produto, cod_marca) VALUES ('$file_id', '$value')";
                    $result1 = mysqli_query($ligax, $insere1);
                }
            }

            if ($_FILES['foto1']['error'] == 0) {
                $file_name = $_FILES['foto1']['name'];
                $file_type = $_FILES['foto1']['type'];
                $file_size = $_FILES['foto1']['size'];
                $file_tmp = $_FILES['foto1']['tmp_name'];
                $data = base64_encode(file_get_contents($file_tmp));
                $query = "UPDATE produtos SET image1_name='$file_name', image1_type='$file_type', image1_size='$file_size', image1_data='$data' WHERE cod_produto='$file_id'";
                $result_up = mysqli_query($ligax, $query);
            }

            if ($_FILES['foto2']['error'] == 0) {
                $file_name = $_FILES['foto2']['name'];
                $file_type = $_FILES['foto2']['type'];
                $file_size = $_FILES['foto2']['size'];
                $file_tmp = $_FILES['foto2']['tmp_name'];
                $data = base64_encode(file_get_contents($file_tmp));
                $query = "UPDATE produtos SET image2_name='$file_name', image2_type='$file_type', image2_size='$file_size', image2_data='$data' WHERE cod_produto='$file_id'";
                $result_up = mysqli_query($ligax, $query);
            }

            if ($_FILES['foto3']['error'] == 0) {
                $file_name = $_FILES['foto3']['name'];
                $file_type = $_FILES['foto3']['type'];
                $file_size = $_FILES['foto3']['size'];
                $file_tmp = $_FILES['foto3']['tmp_name'];
                $data = base64_encode(file_get_contents($file_tmp));
                $query = "UPDATE produtos SET image3_name='$file_name', image3_type='$file_type', image3_size='$file_size', image3_data='$data' WHERE cod_produto='$file_id'";
                $result_up = mysqli_query($ligax, $query);
            }

            if ($_FILES['foto4']['error'] == 0) {
                $file_name = $_FILES['foto4']['name'];
                $file_type = $_FILES['foto4']['type'];
                $file_size = $_FILES['foto4']['size'];
                $file_tmp = $_FILES['foto4']['tmp_name'];
                $data = base64_encode(file_get_contents($file_tmp));
                $query = "UPDATE produtos SET image4_name='$file_name', image4_type='$file_type', image4_size='$file_size', image4_data='$data' WHERE cod_produto='$file_id'";
                $result_up = mysqli_query($ligax, $query);
            }
        }
            
    }
}
?>


<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Criar Produtos</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
<i class="fa fa-minus"></i></button>
<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
<i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body">
 <table class="table lms_table_active">
                  <form method="POST" action="" enctype="multipart/form-data">
                   <!-- Tab panes -->
            <div class="tab-content mb30" style="background-color: transparent !important;padding:0">
             <!-- TAB 1 -->
              <div class="tab-pane active" id="tab1" style="background-color: transparent !important;">


                <div style="float:left;width:70%;">
                  <div style="background-color: #fff;padding:20px">
                        
                        <div class="row">
                          <div class="col-sm-12">
                             

                               <div style="float:left;width: calc(100% - 130px )">
                                    
                                    <label class="control-label">Nome do Produto: </label>
                                    <input formfield="titulo" langmanager="true" formtype="input" style="font-size:16px" class="text-input2 required form-control" type="text" id="nome" name="nome" value="" aria-required="true" required>


                              </div>
                         </div>
                      </div>
                      <br>
                      

                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Descrição curta: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="descricao" contenteditable="true" aria-required="true" required name="descricao"></textarea>

                                  
                              </div>
                         </div>

                        <br><br>
                         <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Informações do Produto: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize:none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="especificacoes" contenteditable="true" aria-required="true" required ></textarea>
                             <script type="text/javascript">
                                 CKEDITOR.replace('especificacoes');
                             </script>
                              </div>
                         </div>




                   </div>
    
                   <div style="background-color: #fff;padding:20px">
    <div class="row stockContainer" style="display: block">
        <div class="volumetricoContainerMain col-sm-3">
            <div class="volumetricoContainerMainSub" style="float:left;">
                <label class="control-label">Preço:</label>
                <input formfield="peso" langmanager="true" fieldlock="true" formtype="input" class="text-input required form-control" type="text" id="preco" name="preco" value="0" aria-required="true">
                <br>
                <div style="position: absolute;right: -370px;top: 1px;">
                    <label class="control-label">Stock:</label>
                    <input class="text-input required form-control" type="number" name="stock" value="0">
                </div>
            </div>
        </div>
    </div>
</div>

                     <br><br><br>
                     <div style="padding: 20px;">
                     <img src='#' height="75" width="75" onclick="triggerclick1()" id="profiledisplay1" >
              <input class="btn btn-warning"  type="file" name="foto1" onchange="displayimage1(this)" id="foto1" style="display: none;"/>
            
            
              <img src='#' height="75" width="75" onclick="triggerclick2()" id="profiledisplay2" >
              <input class="btn btn-warning"  type="file" name="foto2" onchange="displayimage2(this)" id="foto2" style="display: none;"/>
            
              <img src='#' height="75" width="75" onclick="triggerclick3()" id="profiledisplay3" >
              <input class="btn btn-warning"  type="file" name="foto3" onchange="displayimage3(this)" id="foto3" style="display: none;"/>
            
              <img src='#' height="75" width="75" onclick="triggerclick4()" id="profiledisplay4" >
              <input class="btn btn-warning"  type="file" name="foto4" onchange="displayimage4(this)" id="foto4" style="display: none;"/>

              
            </div>
                </div>




                <div style="float:right;width:28%;">
                  <!-- lado direito -->
                  <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                    <label><b>Estado:</b></label> 
                                                   <br>
              <select name="estado">
              <option value="1">S/Novo</option>
              <option value="2">A/Com pouco uso</option>
              <option value="3">B/Bem conservado</option>
              <option value="4">C/Usado</option>
              <option value="5">D/Desgastado</option>
              <option value="6">F/Mau Estado</option>
              </select>
                                              </div>
                                             
                            </div>
                          </div>
                        
                      
                              
                                 <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                               <div style="float:left;margin-top:2px">
    <div class="weasy_ui_switch">
        <input type="hidden" name="destaques" value="0">
        <input class="tgl tgl-flat" name="destaques" type="checkbox" value="1">
        <label class="tgl-btn" for="destaques"></label>
    </div>
</div>

                                             <div style="float:left;margin-left:8px;margin-top:1px">
                                                  <label for="destaques" style="font-size:14px;font-weight: 700 !important">Destaques</label>
                                              </div>
                            </div>
                          </div>
                                  <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                   <div class="weasy_ui_switch"> <input type="hidden" name="novidade" value="0">
        <input class="tgl tgl-flat" name="novidade" type="checkbox" value="1"><label class="tgl-btn" for="novidade"></label></div>
                                              </div>
                                             <div style="float:left;margin-left:8px;margin-top:1px">
                                                  <label for="novidade" style="font-size:14px;font-weight: 700 !important">Novidade</label>
                                              </div>
                            </div>
                          </div>



                        



                  </div>
                    <br>
                   <div style="background-color: #fff;padding:20px">

                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group" style="position: relative;margin-bottom:0">
                              <label class="control-label" style="font-weight: 700">Categorias <span class="asterisk">*</span>
                                  <a class="" target="_blank" style="float: right;font-weight: 400;font-size:11px;text-decoration: underline;" href="index.php?page=criar_categorias">Adicionar</a>
                                  
                              </label>
                             
                            
        <?php
        $query="select * from categorias where estado=1 order by nome_categoria ";
        $result=mysqli_query($ligax,$query);
        if($result) { 
        while($registo=mysqli_fetch_assoc($result)){
        $nome_categoria=$registo['nome_categoria'];
        $cod_categoria=$registo['cod_categoria']; ?> 

<br>
<input type="checkbox" name="cod_categoria[]" onclick="uncheckOtherCheckboxes(this)" value="<?php echo $cod_categoria; ?>">
        <label><h5><?php echo $nome_categoria; ?></h5></label>
        <?php } }
        ?>
                             </div>
                            

                          </div>
                      </div>
                   

                      <br>
                      


                  </div>
 <br>
                   <div style="background-color: #fff;padding:20px">

                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group" style="position: relative;margin-bottom:0">
                              <label class="control-label" style="font-weight: 700">Marcas <span class="asterisk">*</span>
                                  <a class="" target="_blank" style="float: right;font-weight: 400;font-size:11px;text-decoration: underline;" href="index.php?page=criar_marcas">Adicionar</a>
                                  
                              </label>
                             
                            
        <?php
        $query="select * from marcas where estado=1 order by nome_marca ";

        $result=mysqli_query($ligax,$query);
        if($result) { 
        while($registo=mysqli_fetch_assoc($result)){
        $nome_marca=$registo['nome_marca'];
        $cod_marca=$registo['cod_marca']; ?> 

<br>
<input type="checkbox" name="cod_marca[]" onclick="uncheckOtherCheckboxes1(this)" value="<?php echo $cod_marca; ?>">
        <label><h5><?php echo $nome_marca; ?></h5></label>
        <?php } }
        ?>
                             </div>
                            

                          </div>
                      </div>
                   

                      <br>
                      


                  </div>
                   <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                    <input type="submit" name="submit_produto"class="btn btn-primary" style="" value="Guardar Produto"><br><br>
                    
                    
                            </div>
                          </div>

             </form>
              <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br>
                </table>

    
</div>


</div>

</section>

</div>
<script>
            function triggerclick1(){
                document.querySelector('#foto1').click();
            }
            function displayimage1(e){
                if (e.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e){
                        document.querySelector('#profiledisplay1').setAttribute('src',e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
       function triggerclick2(){
                document.querySelector('#foto2').click();
            }
            function displayimage2(e){
                if (e.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e){
                        document.querySelector('#profiledisplay2').setAttribute('src',e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
       function triggerclick3(){
                document.querySelector('#foto3').click();
            }
            function displayimage3(e){
                if (e.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e){
                        document.querySelector('#profiledisplay3').setAttribute('src',e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
       function triggerclick4(){
                document.querySelector('#foto4').click();
            }
            function displayimage4(e){
                if (e.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e){
                        document.querySelector('#profiledisplay4').setAttribute('src',e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
        </script>
 <script>
    function uncheckOtherCheckboxes(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_categoria[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }

     function uncheckOtherCheckboxes1(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_marca[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }
  </script>
   