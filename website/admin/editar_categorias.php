
<?php


if(isset($_POST['editarcategorias'])){

                      $nome_categoria=$_POST['nome_categoria'];
                      $descricao=$_POST['descricao'];
                    

                       $atualizar="update categorias set nome_categoria='".$nome_categoria."', descricao='".$descricao."', estado='".$_POST['estado']."' where cod_categoria='".$_GET['cod_categoria']."'";
               
                       $result=mysqli_query($ligax,$atualizar);
                       
                      if($_FILES['foto']['error']==0){
                               $file_name=$_FILES['foto']['name'];
                               $file_type=$_FILES['foto']['type'];
                               $file_size=$_FILES['foto']['size'];
                               $file_tmp=$_FILES['foto']['tmp_name'];
                           
$data=base64_encode(file_get_contents($file_tmp));
$query="update categorias set foto_nome='".$file_name."',foto_tipo='".$file_type."',
                               foto_tamanho='".$file_size."',foto_dados='".$data."'  where cod_categoria='".$_GET['cod_categoria']."' ";
                       $result=mysqli_query($ligax,$query);
                      }

                     
                      
                       
                                          
                        if($result=1){
                        if(isset($_POST['estado'])) { //está checked

     $select_estado="select estado from categorias where cod_categoria='".$_GET['cod_categoria']."'";
   $result=mysqli_query($ligax,$select_estado);
   $n=mysqli_num_rows($result);
   if($n>0){
   $registo=mysqli_fetch_assoc($result);
  $estado=$registo['estado'];
    if($estado==0) { $query="update categorias set estado=1 where cod_categoria='".$_GET['cod_categoria']."'";  $result1=mysqli_query($ligax,$query);}
    if($estado==1) { } //está subscrito

   }


   } else { //não está checked
 $select_estado="select estado from categorias where cod_categoria='".$_GET['cod_categoria']."'";
   $result=mysqli_query($ligax,$select_estado);
   $n=mysqli_num_rows($result);
   if($n>0){
   $registo=mysqli_fetch_assoc($result);
   $estado=$registo['estado'];
      if($estado==0) { $query="update categorias set estado=0 where cod_categoria='".$_GET['cod_categoria']."'";  $result1=mysqli_query($ligax,$query);}
      if($estado==1) { } //está subscrito

   }
}

                       
                          ?>
                          <script>
                            

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
                  "timeOut": "3500",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "fadeOut"
              }

            toastr["success"]("Categoria editada com sucesso") 
                          </script>
                          <?php
                       }else{ 
                        ?>
                        <script>
                      alert("Variavel de perfil nao atualizada.");
                      </script>
                      <?php
                       }
                    }

$query="select * from categorias where cod_categoria='".$_GET['cod_categoria']."'";
                      $result=mysqli_query($ligax,$query);
                      $registo=mysqli_fetch_assoc($result);
                      $nome_categoria=$registo['nome_categoria'];
                      $cod_categoria=$registo['cod_categoria'];
                      $descricao=$registo['descricao'];
                      $estado=$registo['estado'];                   
                     
                    ?> 
<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Editar Categorias</h3>
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
                                    
                                    <label class="control-label">Nome Categoria: </label>
                                    <input formfield="titulo" langmanager="true" formtype="input" style="font-size:16px" class="text-input2 required form-control" type="text" id="nome" name="nome_categoria" value="<?php echo $nome_categoria ?>" aria-required="true" required>


                              </div>
                         </div>
                      </div>
                      <br>
                      

                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Descricão curta: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize: none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="descricao" contenteditable="true" aria-required="true" required><?php echo $descricao ?></textarea>

                                  
                              </div>
                         </div>

                        




                   </div>
    
                   
                </div>




                <div style="float:right;width:28%;">
                  <!-- lado direito -->
                  <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Foto Categoria</label>
                                                 <input type="file" name="foto">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
                    <br>
               <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                            <p>Estado:</p>
                            
                              <?php if($estado==1){?>
                              <input type="checkbox" name="estado" class="btn btn-primary" value="1" checked="checked">
                              <?php }else{ ?>
                              <input type="checkbox" name="estado" class="btn btn-primary" value="0">
                            <?php } ?>
</div>  
                          </div>

               <br>
<div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                              <input type="submit" name="editarcategorias" class="btn btn-primary"  value="Guardar Categoria">
</div>
                          </div>
             </form>
                </table>
              
    
</div>


</div>

</section>

</div>
