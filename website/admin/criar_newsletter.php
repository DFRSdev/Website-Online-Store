<?php
if(isset($_POST['submit_newsletter'])){
    
    $assunto=$_POST['assunto'];

    
    
      
    
    
    
    $insere="INSERT INTO tipo_newsletter
      (assunto) VALUES ('".$assunto."')";


      $result=mysqli_query($ligax,$insere);
      $id_newsletter=mysqli_insert_id($ligax);
    
      if($result==1){ ?>
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

                        toastr["success"]("Newsletter criada com sucesso")


      </script>

      <?php
    
      
    


      if($_FILES['ficheiro']['error']==0){
                               $file_name=$_FILES['ficheiro']['name'];
                               $file_type=$_FILES['ficheiro']['type'];
                               $file_size=$_FILES['ficheiro']['size'];
                               $file_tmp=$_FILES['ficheiro']['tmp_name'];

                           
     $data=base64_encode(file_get_contents($file_tmp));

     
                               $query="update tipo_newsletter set ficheiro_nome='".$file_name."',ficheiro_tipo='".$file_type."',
                               ficheiro_tamanho='".$file_size."',ficheiro_dados='".$data."' where id_newsletter='".$id_newsletter."' ";
                               //echo $query;
                               $result_up=mysqli_query($ligax,$query);
         }
                       
    
                     
    if($_FILES['mensagem']['error']==0){
                               $file_name=$_FILES['mensagem']['name'];
                               $file_type=$_FILES['mensagem']['type'];
                               $file_size=$_FILES['mensagem']['size'];
                               $file_tmp=$_FILES['mensagem']['tmp_name'];
                               $data=base64_encode(file_get_contents($file_tmp));
                               $query="update tipo_newsletter set mensagem_nome='".$file_name."',mensagem_tipo='".$file_type."',
                               mensagem_tamanho='".$file_size."',mensagem_dados='".$data."' where id_newsletter='".$_GET['id_newsletter']."'";
                               $result_up=mysqli_query($ligax,$query);
         }   
      
      
      } else {
        echo "<p>Dados não inseridos!</p>";
        
      }
    
    }

  ?>

<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Criar Newsletter</h3>
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
                                    
                                    <label class="control-label">Assuto: </label>
                                    <input formfield="titulo" langmanager="true" formtype="input" style="font-size:16px" class="text-input2 required form-control" type="text" id="nome" name="assunto" value="" aria-required="true" required>


                              </div>
                         </div>
                      </div>
                      <br>
                      

                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Corpo da Mensagem: </label>
                                  

                               <br><input type="file" name="mensagem">

                                  
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
                                                                                                 <label>Ficheiro Newsletter</label>
                                                 <input type="file" name="ficheiro">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
               

               <br>
<div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                              <input type="submit" name="submit_newsletter" class="btn btn-primary"  value="Guardar Categoria">
</div>
                          </div>
             </form>
                </table>
              
    
</div>


</div>

</section>

</div>
