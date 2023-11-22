<?php
if(isset($_POST['submit_ordem_reparacao'])){
    
    
    $data_pedido=$_POST['data_pedido'];
    $data_entrega=$_POST['data_entrega'];
    $nome=$_POST['cliente'];
    $equipamento=$_POST['equipamento'];
    $descricao_problema=$_POST['descricao_problema'];
    $observacoes=$_POST['observacoes'];
    $servico_efetuado=$_POST['servico_efetuado'];
    $n_serie=$_POST['n_serie'];
    $telefone=$_POST['telefone'];
    $orcamento=$_POST['orcamento'];
    $estado=$_POST['estado'];
    $anomalia=$_POST['anomalia'];
    $garantia=$_POST['garantia'];
    $telefone_emprestimo=$_POST['telefone_emprestimo'];

    
    $insere="INSERT INTO `ordem_reparacao` (`data_pedido`, `data_entrega`, `cliente`, `equipamento`, `descricao_problema`, `observacoes`, `servico_efetuado`, `n_serie`, `telefone`, `valor_orcamento`, `estado`, `anomalia`, `telefone_emprestimo`,`tecnico`,`fornecedor`,`garantia`) VALUES ('".$data_pedido."', NULL, '".$nome."', '".$equipamento."', '".$descricao_problema."', '".$observacoes."', '".$servico_efetuado."', '".$n_serie."', '".$telefone."', '".$orcamento."', '".$estado."', '".$anomalia."', '".$telefone_emprestimo."',NULL,NULL,'".$garantia."')";
    
 
    
     $cod_reparacao=mysqli_insert_id($ligax);
    $result=mysqli_query($ligax,$insere);
     
    
      
    
    
   


      
     
    
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

                        toastr["success"]("Ordem de reparação criada com sucesso")


      </script>

      <?php
      } else {
        echo "<p>Dados não inseridos!</p>";
        
      }
    
    }

  ?>

<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Nova Ordem de Reparação</h3>
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
                                  <label class="control-label">Data do Pedido: </label>
                                  

                             <br><input type="date" name="data_pedido" value="<?php echo date('Y-m-d'); ?>">

                                  
                              </div>
                         </div>
                      <div class="row" style="position:relative;top:-51px;left: 200px;">
                              <div class="col-sm-12">
                                  <label class="control-label">Data de Entrega: </label>
                                  

                             <br><input type="date" name="data_entrega" >

                                  
                              </div>
                         </div>

                         

                      
<div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Cliente: </label>
                                  

                             <br><input type="text" name="cliente" class="text-input2 required form-control" >

                                  
                              </div>
                         </div>
                         <br>
                          <div class="row" >
                              <div class="col-sm-12">
                                  <label class="control-label">Equipamento: </label>
                                  

                             <br><input type="text" name="equipamento" class="text-input2 required form-control" style="width: 230px;">

                                  
                              </div>
                         </div>
                         <br>
                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Descrição do Problema: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize: none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="descricao_problema" contenteditable="true" aria-required="true"></textarea>

                                  
                              </div>
                         </div>
                         <br>
                         <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Observações: </label>
                                  

                             <br><input type="text" name="observacoes" class="text-input2 required form-control">

                                  
                              </div>
                         </div>
                         <br>
 <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Serviço Efetuado: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize: none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="servico_efetuado" contenteditable="true" aria-required="true" ></textarea>

                                  
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
                                                                                                 <label>Nº de Série</label><br>
                                                 <input type="text" name="n_serie" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
               <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Telefone:</label><br>
                                                 <input type="number" name="telefone" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>

                                <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Valor do Orçamento:</label><br>
                                                 <input type="text" name="orcamento" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>

                    <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Estado:</label><br>
                                                 <select name="estado">
                                                    <option value="1. Em Reparação">1. Em Reparação</option>
                                                    <option value="2. Reparação Fechada">2. Reparação Fechada</option>
                                                    <option value="3. Entregue do Cliente">3. Entregue do Cliente</option>
                                                    
                                                </select>
            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
                  
                   <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Garantia:</label><br>
                                               <select name="garantia">
                                                  
                                                   
                                                   <option value="Com Garantia" >Com Garantia</option>
                                                     <option value="Sem Garantia">Sem Garantia</option>
                                                 
                                                  </select>

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>


               <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Anomalia:</label><br>
                                                 <input type="text" name="anomalia" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>

                  <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Telefone de Empréstimo:</label><br>
                                                 <input type="text" name="telefone_emprestimo" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>


<div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                              <input type="submit" name="submit_ordem_reparacao" class="btn btn-primary"  value="Guardar">
</div>
                          </div>
             </form>
                </table>
              
    
</div>


</div>

</section>

</div>
