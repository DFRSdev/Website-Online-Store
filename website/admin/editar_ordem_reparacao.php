
<?php
if(isset($_POST['editar_ordem_reparacao'])){
    
    
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
    $telefone_emprestimo=$_POST['telefone_emprestimo'];
    $tecnico=$_POST['tecnico'];
    $fornecedor=$_POST['fornecedor'];
    $garantia=$_POST['garantia'];

    if($data_entrega==""){
        $atualizar="update ordem_reparacao set data_pedido='".$data_pedido."',  data_entrega=NULL, cliente='".$nome."', equipamento='".$equipamento."', descricao_problema='".$descricao_problema."', observacoes='".$observacoes."', servico_efetuado='".$servico_efetuado."', n_serie='".$n_serie."', telefone='".$telefone."', valor_orcamento='".$orcamento."', estado='".$estado."', anomalia='".$anomalia."', telefone_emprestimo='".$telefone_emprestimo."', tecnico='".$tecnico."',fornecedor='".$fornecedor."',garantia='".$garantia."' where cod_reparacao='".$_GET['cod_reparacao']."'";
      
        
        
    }else{
    
    $atualizar="update ordem_reparacao set data_pedido='".$data_pedido."',  data_entrega='".$data_entrega."', cliente='".$nome."', equipamento='".$equipamento."', descricao_problema='".$descricao_problema."', observacoes='".$observacoes."', servico_efetuado='".$servico_efetuado."', n_serie='".$n_serie."', telefone='".$telefone."', valor_orcamento='".$orcamento."', estado='3. Entregue ao Cliente', anomalia='".$anomalia."', telefone_emprestimo='".$telefone_emprestimo."', tecnico='".$tecnico."',fornecedor='".$fornecedor."',garantia='".$garantia."' where cod_reparacao='".$_GET['cod_reparacao']."'";
   
   
    }
    
    
                                             $result=mysqli_query($ligax,$atualizar);
   
     
    
      
    
    
   


      
     
    
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

                        toastr["success"]("Ordem de reparação editada com sucesso")


      </script>

      <?php
      } else {
        echo "<p>Dados não inseridos!</p>";
        
      }
    
    }

  
  

      $query="select * from ordem_reparacao where cod_reparacao='".$_GET['cod_reparacao']."'";
                      $result=mysqli_query($ligax,$query);
                      $registo=mysqli_fetch_assoc($result);
                  
          
                     $data_pedido=$registo['data_pedido'];
    $data_entrega=$registo['data_entrega'];
    $nome=$registo['cliente'];
    $equipamento=$registo['equipamento'];
    $descricao_problema=$registo['descricao_problema'];
    $observacoes=$registo['observacoes'];
    $servico_efetuado=$registo['servico_efetuado'];
    $n_serie=$registo['n_serie'];
    $telefone=$registo['telefone'];
    $orcamento=$registo['valor_orcamento'];
    $estado=$registo['estado'];
    $anomalia=$registo['anomalia'];
    $telefone_emprestimo=$registo['telefone_emprestimo'];
    $fornecedor=$registo['fornecedor'];
    $tecnico=$registo['tecnico'];
    $garantia=$registo['garantia'];

  ?>
<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Editar Ordem de Reparação</h3>
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
                                  

                             <br><input type="date" name="data_pedido" value="<?php echo $data_pedido ?>">

                                  
                              </div>
                         </div>
                      <div class="row" style="position:relative;top:-51px;left: 200px;">
                              <div class="col-sm-12">
                                  <label class="control-label">Data de Entrega: </label>
                                  

                             <br><input type="date" name="data_entrega" value="<?php echo $data_entrega ?>">

                                  
                              </div>
                         </div>

                         

                      
<div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Cliente: </label>
                                  

                             <br><input type="text" name="cliente" value="<?php echo $nome?>" class="text-input2 required form-control" >

                                  
                              </div>
                         </div>
                         <br>
                          <div class="row" >
                              <div class="col-sm-12">
                                  <label class="control-label">Equipamento: </label>
                                  

                             <br><input type="text" name="equipamento" value="<?php echo $equipamento?>"class="text-input2 required form-control" style="width: 230px;">

                                  
                              </div>
                         </div>
                         <br>
                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Descrição do Problema: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize: none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="descricao_problema" contenteditable="true" aria-required="true"><?php echo $descricao_problema?></textarea>

                                  
                              </div>
                         </div>
                         <br>
                         <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Observações: </label>
                                  

                             <br><input type="text" name="observacoes" value="<?php echo $observacoes?>"class="text-input2 required form-control">

                                  
                              </div>
                         </div>
                         <br>
 <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Serviço Efetuado: </label>
                                  

                             <br><textarea style="min-height:140px;width: 100%;resize: none;" formfield="descricaoSmall" langmanager="true" fieldlock="false" formtype="textarea" class="text-input required form-control wysihtml5-sandbox wysihtml5-editor" type="text" id="descricaoSmall" name="servico_efetuado" contenteditable="true" aria-required="true" ><?php echo $servico_efetuado?></textarea>

                                  
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
                                                 <input type="text" name="n_serie" value="<?php echo $n_serie?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
               <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Telefone:</label><br>
                                                 <input type="number" name="telefone" value="<?php echo $telefone?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>

                                <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Valor do Orçamento:</label><br>
                                                 <input type="text" name="orcamento" value="<?php echo $orcamento?>" class="text-input2 required form-control">

            
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
                                                   <?php if($garantia=="Com Garantia"){ ?>
                                                   <option value="Com Garantia" selected>Com Garantia</option>
                                                   <option value="Sem Garantia">Sem Garantia</option>
                                                   <?php }else{ ?>
                                                   <option value="Com Garantia" >Com Garantia</option>
                                                     <option value="Sem Garantia" selected>Sem Garantia</option>
                                                   <?php } ?>
                                                  </select>

            
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
                                                     <?php if($estado=="1. Em Reparação"){ ?>
                                                    <option value="1. Em Reparação" selected>1. Em Reparação</option>
                                                     <option value="2. Reparação Fechada">2. Reparação Fechada</option>
                                                     <option value="3. Entregue do Cliente">3. Entregue do Cliente</option>
                                                    <?php }elseif($estado=="2. Reparação Fechada"){ ?>
                                                     <option value="1. Em Reparação">1. Em Reparação</option>
                                                    <option value="2. Reparação Fechada"  selected>2. Reparação Fechada</option>
                                                    <option value="3. Entregue do Cliente">3. Entregue do Cliente</option>
                                                    <?php }else{ ?>
                                                     <option value="1. Em Reparação">1. Em Reparação</option>
                                                    <option value="2. Reparação Fechada">2. Reparação Fechada</option>
                                                    <option value="3. Entregue do Cliente"   selected>3. Entregue do Cliente</option><?php } ?>
                                                    
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
                                                 <input type="text" name="anomalia" value="<?php echo $anomalia?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
                   <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Técnico:</label><br>
                                                 <input type="text" name="tecnico" value="<?php echo $tecnico?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>
                   <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Fornecedor:</label><br>
                                                 <input type="text" name="fornecedor" value="<?php echo $fornecedor?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>

                  <div style="background-color: #fff;">
                    
                       <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Telefone de Empréstimo:</label><br>
                                                 <input type="text" name="telefone_emprestimo" value="<?php echo $telefone_emprestimo?>" class="text-input2 required form-control">

            
                                              </div>
                                             
                            </div>
                          </div>
                  </div>


<div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                              <input type="submit" name="editar_ordem_reparacao" class="btn btn-primary"  value="Guardar">
</div>
                          </div>
                          <div class="row no-print">
<div class="col-xs-12" style="position:relative;top:-55px;left:130px;">
<a href="fotocopia_reparacao.php?cod_reparacao=<?php echo $_GET['cod_reparacao']?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
</div>
</div>
             </form>
                </table>
              
    
</div>


</div>

</section>

</div>
