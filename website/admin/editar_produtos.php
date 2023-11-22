 
<?php



if(isset($_POST['delete_produtos'])){

    $delete1="DELETE FROM produto_categoria where cod_produto='" . $_GET['cod_produto'] . "'";
    mysqli_query($ligax, $delete1);
    $delete1="DELETE FROM produto_marca where cod_produto='" . $_GET['cod_produto'] . "'";
    mysqli_query($ligax, $delete1);
    $delete = "DELETE FROM produtos WHERE cod_produto='" . $_GET['cod_produto'] . "'";
    $result = mysqli_query($ligax, $delete);
    ?>
    <script type="text/javascript">location.href="index.php?page=listar_produtos";</script>

    <?php
}

                   
                   
               
   
                   
if(isset($_POST['editarprodutos'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $stock = $_POST['stock'];
    $estado = $_POST['estado'];
    $especificacoes = $_POST['especificacoes'];
    $destaques = isset($_POST['destaques']) ? $_POST['destaques'] : 0;
    $novidade = isset($_POST['novidade']) ? $_POST['novidade'] : 0;
    $produto_do_semana = isset($_POST['produto_do_semana']) ? $_POST['produto_do_semana'] : 0;

    if ($estado > 1 && $novidade == 1) {
        ?>
        <script type="text/javascript">
            Swal.fire(
                'Verificação',
                'Não é possível colocar o produto como novidade e usado!',
                'error'
            ).then(function() {
                window.location.href = 'index.php?page=listar_produtos';
            });
        </script>
        <?php
        exit;
    }

if($produto_do_semana==1){
    $atualizar_produto_do_semana="UPDATE produtos set produto_do_semana='0'";
    mysqli_query($ligax,$atualizar_produto_do_semana);
}
                                      

                        $atualizar = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', stock='$stock', estado='$estado', especificacoes='$especificacoes', destaques='$destaques', novidade='$novidade', produto_do_semana='$produto_do_semana' WHERE cod_produto='" . $_GET['cod_produto'] . "'";
    $result = mysqli_query($ligax, $atualizar);
                      
                     
                       
                        if($result){
        if($_FILES['foto1']['error'] == 0){
            $file_name = $_FILES['foto1']['name'];
            $file_type = $_FILES['foto1']['type'];
            $file_size = $_FILES['foto1']['size'];
            $file_tmp = $_FILES['foto1']['tmp_name'];
            $data = base64_encode(file_get_contents($file_tmp));
            $query = "UPDATE produtos SET image1_name='$file_name', image1_type='$file_type', image1_size='$file_size', image1_data='$data' WHERE cod_produto='" . $_GET['cod_produto'] . "'";
            $result_up = mysqli_query($ligax, $query);
        }

        if($_FILES['foto2']['error'] == 0){
            $file_name = $_FILES['foto2']['name'];
            $file_type = $_FILES['foto2']['type'];
            $file_size = $_FILES['foto2']['size'];
            $file_tmp = $_FILES['foto2']['tmp_name'];
            $data = base64_encode(file_get_contents($file_tmp));
            $query = "UPDATE produtos SET image2_name='$file_name', image2_type='$file_type', image2_size='$file_size', image2_data='$data' WHERE cod_produto='" . $_GET['cod_produto'] . "'";
            $result_up = mysqli_query($ligax, $query);
        }
      
      if($_FILES['foto3']['error'] == 0){
            $file_name = $_FILES['foto3']['name'];
            $file_type = $_FILES['foto3']['type'];
            $file_size = $_FILES['foto3']['size'];
$file_tmp = $_FILES['foto3']['tmp_name'];
$data = base64_encode(file_get_contents($file_tmp));
$query = "UPDATE produtos SET image3_name='$file_name', image3_type='$file_type', image3_size='$file_size', image3_data='$data' WHERE cod_produto='" . $_GET['cod_produto'] . "'";
$result_up = mysqli_query($ligax, $query);
}
      
      
            //Insere a quarta imagem
      if($_FILES['foto4']['error']==0){
        $file_name=$_FILES['foto4']['name'];
        $file_type=$_FILES['foto4']['type'];
        $file_size=$_FILES['foto4']['size'];
        $file_tmp=$_FILES['foto4']['tmp_name'];
        $data=base64_encode(file_get_contents($file_tmp));
        $query="update produtos set image4_name='".$file_name."',image4_type='".$file_type."',
    image4_size='".$file_size."',image4_data='".$data."' where cod_produto='".$_GET['cod_produto']."'"; 
      $result_up=mysqli_query($ligax,$query);}
      
                       
                          ?>
                          <script type="text/javascript">

         toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": true,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-right",
                                  "preventDuplicates": true,
                                  "onclick": null,
                                  "showDuration": "1200",
                                  "hideDuration": "3000",
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["success"]("Produto editado com sucesso")


      </script>


                          <?php

                            if (isset($_POST['cod_categoria'])) {
        foreach ($_POST['cod_categoria'] as &$value) {
         
          $update_cat="update produto_categoria set cod_categoria='".$value."' where cod_produto='".$_GET['cod_produto']."'";
            
          $result1=mysqli_query($ligax,$update_cat);
        }
      }

             if (isset($_POST['cod_marca'])) {
        foreach ($_POST['cod_marca'] as &$value) {
         
          $update_cat="update produto_marca set cod_marca='".$value."' where cod_produto='".$_GET['cod_produto']."'";
            
          $result1=mysqli_query($ligax,$update_cat);
        }
      }
                       }else{ 
                        ?>
                        <script>
                      alert("Variavel de perfil nao atualizada.");
                      </script>
                      <?php
                       }
                    }


                      $query="select * from produtos where cod_produto='".$_GET['cod_produto']."'";
                      
                      $result=mysqli_query($ligax,$query);
                      $registo=mysqli_fetch_assoc($result);
                      $nome=$registo['nome'];
                      $cod_produto=$registo['cod_produto'];
                      $descricao=$registo['descricao'];
                    
                      
                      $preco=$registo['preco'];
                      
                      $stock=$registo['stock'];
                      $estado=$registo['estado'];
                     
                      $novidade=$registo['novidade'];

                      $produto_do_semana=$registo['produto_do_semana'];
                      $destaques=$registo['destaques'];
                      $especificacoes=$registo['especificacoes'];
                     
                    ?> 
<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Edição de Produto - <?php echo $nome?></h3>
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
                                    <input formfield="titulo" langmanager="true" formtype="input" style="font-size:16px" class="text-input2 required form-control" type="text" id="nome" name="nome" value="<?php echo $nome?>" aria-required="true" required>


                              </div>
                         </div>
                      </div>
                      <br>
                      

                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Descrição curta: </label>
                                  

                             <br><textarea style="min-height:70px;width: 100%;resize:none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="descricao" contenteditable="true" aria-required="true" required name="descricao"><?php echo $descricao?></textarea>
                              </div>
                         </div>
                         <br><br>
                         <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Informações do Produto: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize:none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="especificacoes" contenteditable="true" aria-required="true" required ><?php echo $especificacoes?></textarea>
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
                                    <label class="control-label">Preço:
                                    </label>
                                    <input formfield="peso" langmanager="true" fieldlock="true" formtype="input" class="text-input required form-control" type="text" id="preco" name="preco" value="<?php echo $preco?>" aria-required="true" required>    
                                    <br>
                                    <div style="position: absolute;right: -290px;top: 0px;">
                                    <label class="control-label">Stock:
                                    </label>
                                    <input formfield="peso" langmanager="true" fieldlock="true" formtype="input" class="text-input required form-control" type="number" id="preco" name="stock" value="<?php echo $stock?>" aria-required="true" align="right" required>   </div> 
                               </div>
                            </div>
                        </div>   
                                           
                        
                     </div>
                     <br><br><br>
                     <div style="padding: 20px;">
                     <img src='showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto;?>' height="75" width="75" onclick="triggerclick1()" id="profiledisplay1" >
              <input class="btn btn-warning"  type="file" name="foto1" onchange="displayimage1(this)" id="foto1" style="display: none;"/>
        
            
              <img src='showfile_fotoproduto2.php?cod_produto=<?php echo $cod_produto;?>' height="75" width="75" onclick="triggerclick2()" id="profiledisplay2" >
              <input class="btn btn-warning"  type="file" name="foto2" onchange="displayimage2(this)" id="foto2" style="display: none;"/>
            
              <img src='showfile_fotoproduto3.php?cod_produto=<?php echo $cod_produto;?>' height="75" width="75" onclick="triggerclick3()" id="profiledisplay3" >
              <input class="btn btn-warning"  type="file" name="foto3" onchange="displayimage3(this)" id="foto3" style="display: none;"/>
            
              <img src='showfile_fotoproduto4.php?cod_produto=<?php echo $cod_produto;?>' height="75" width="75" onclick="triggerclick4()" id="profiledisplay4" >
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
                <?php if($estado==1){ ?>
              <option value="1" selected>S/Novo</option>
            <?php }else{ ?>
              <option value="1" >S/Novo</option>
            <?php } ?>
              
              <?php if($estado==2){ ?>
              <option value="2" selected>A/Com pouco uso</option>
            <?php }else{ ?>
              <option value="2">A/Com pouco uso</option>
            <?php } ?>
              <?php if($estado==3){ ?>
              <option value="3" selected>B/Bem conservado</option>
            <?php }else{ ?>
              <option value="3">B/Bem conservado</option>
            <?php } ?>
              <?php if($estado==4){ ?>
               <option value="4" selected>C/Usado</option>
            <?php }else{ ?>
               <option value="4">C/Usado</option>
            <?php } ?>
              <?php if($estado==5){ ?>
              <option value="5" selected>D/Desgastado</option>
            <?php }else{ ?>
               <option value="5">D/Desgastado</option>
            <?php } ?>
              <?php if($estado==6){ ?>
              <option value="6" selected>E/Mau Estado</option>
            <?php }else{ ?>
              <option value="6">E/Mau Estado</option>
            <?php } ?>
              
             
              
              </select>
                                              </div>
                                             
                            </div>
                          </div>
                        
                      
                              
                                 <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                   <div class="weasy_ui_switch"><?php if($destaques==1){?><input class="tgl tgl-flat" name="destaques" type="checkbox"  value="1" 
                                                   checked><label class="tgl-btn" for="estado"><?php }else{?><input class="tgl tgl-flat" name="destaques" type="checkbox"  value="1"><?php }?></label></div>
                                              </div>
                                             <div style="float:left;margin-left:8px;margin-top:1px">
                                                  <label for="estado" style="font-size:14px;font-weight: 700 !important">Destaques</label>
                                              </div>
                            </div>
                          </div>

                                  <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                   <div class="weasy_ui_switch"><?php if($novidade==1){?><input class="tgl tgl-flat" name="novidade" type="checkbox"  value="1" checked><?php }else{?><input class="tgl tgl-flat" name="novidade" type="checkbox"  value="1"><?php }?><label class="tgl-btn" for="estado"></label></div>
                                              </div>
                                             <div style="float:left;margin-left:8px;margin-top:1px">
                                                  <label for="estado" style="font-size:14px;font-weight: 700 !important">Novidade</label>
                                              </div>
                            </div>
                          </div>


                               <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                   <div class="weasy_ui_switch"><?php if($produto_do_semana==1){?><input class="tgl tgl-flat" name="produto_do_semana" type="checkbox"  value="1" checked><?php }else{?><input class="tgl tgl-flat" name="produto_do_semana" type="checkbox"  value="1"><?php }?><label class="tgl-btn" for="estado1"></label></div>
                                              </div>
                                             <div style="float:left;margin-left:8px;margin-top:1px">
                                                  <label for="estado1" style="font-size:14px;font-weight: 700 !important">Produto da Semana</label>
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
                                  <a class="" target="_blank" style="float: right;font-weight: 400;font-size:11px;text-decoration: underline;" href="index.php?page=criar_categoria">Adicionar</a>
                                  
                              </label>
                             
                            
                        
        <?php
        $query="select * from categorias where estado=1 order by nome_categoria ";

        $result=mysqli_query($ligax,$query);
        if($result) { 
        while($registo=mysqli_fetch_assoc($result)){
        $nome_categoria=$registo['nome_categoria'];
        $cod_categoria=$registo['cod_categoria']; ?> 

<br>
<?php
$select="select cod_categoria from produto_categoria where cod_produto='".$cod_produto."'";
$result1=mysqli_query($ligax,$select);
$registo1=mysqli_fetch_assoc($result1);
$cod_categoria1=$registo1['cod_categoria']

?>



<input type="checkbox" name="cod_categoria[]" onclick="uncheckOtherCheckboxes1(this)" value="<?php echo $cod_categoria; ?>" <?php if($cod_categoria1==$cod_categoria){ ?>checked="checked" <?php } ?>>
        <label><h5><?php echo $nome_categoria; ?></h5></label>
        <?php 
     



      } 
    }
        ?>
                             </div>
                            

                          </div>
                      </div>
                   

                      <br>
                      


                  </div>

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
<?php
$select="select cod_marca from produto_marca where cod_produto='".$cod_produto."'";

$result1=mysqli_query($ligax,$select);
if(mysqli_num_rows($result1) > 0 ) {
$registo1=mysqli_fetch_assoc($result1);
$cod_marca1=$registo1['cod_marca'];
}
?>


<input type="checkbox" name="cod_marca[]" onclick="uncheckOtherCheckboxes(this)" value="<?php echo $cod_marca; ?>" <?php if(isset($cod_marca1)){if($cod_marca1==$cod_marca){ ?>checked="checked" <?php }} ?>>
        <label><h5><?php echo $nome_marca; ?></h5></label>
        <?php 
     



      } 
    }
        ?>
                             </div>
                            

                          </div>
                      </div>

                      <br>
                   
                     <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                    <input type="submit" name="editarprodutos"class="btn btn-primary" style="" value="Guardar Produto"><br><br>
                    
                     <input type="submit" name="delete_produtos" class="btn btn-primary" style="background-color:red;border-color:red;" value="Apagar Produto">           
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
        <script type="text/javascript">
             function uncheckOtherCheckboxes1(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_categoria[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }

      function uncheckOtherCheckboxes(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_marca[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }
        </script>