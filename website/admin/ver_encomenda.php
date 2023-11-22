
<?php

if(isset($_POST['editar_encomenda'])){

        if($_POST['estado']==1){
$atualizar = "UPDATE encomenda SET estado = '".$_POST['estado']."', data_processo = NOW() WHERE cod_encomenda = '".$_GET['cod_encomenda']."'";
        }elseif ($_POST['estado']==3 || $_POST['estado']==2) {
            $atualizar = "UPDATE encomenda SET estado = '".$_POST['estado']."', data_entrega = NOW() WHERE cod_encomenda = '".$_GET['cod_encomenda']."'";

        }elseif($_POST['estado']==0){
             $atualizar = "UPDATE encomenda SET estado = '".$_POST['estado']."' WHERE cod_encomenda = '".$_GET['cod_encomenda']."'";
        }elseif($_POST['estado']==4){
             $atualizar = "UPDATE encomenda SET estado = '".$_POST['estado']."' WHERE cod_encomenda = '".$_GET['cod_encomenda']."'";
        }

        $resul=mysqli_query($ligax,$atualizar);
        if($resul){
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
                  "timeOut": "3500",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "fadeOut"
              }

            toastr["success"]("Estado da encomenda editado com sucesso") 
            </script>
            <?php
        }
}


$query="select * from encomenda where cod_encomenda='".$_GET['cod_encomenda']."'";
                      $result=mysqli_query($ligax,$query);
                      $registo=mysqli_fetch_assoc($result);
                      $modo_entrega=$registo['modo_entrega'];
                      $total_encomenda=$registo['total_encomenda'];
                      $cod_fatura=$registo['cod_fatura'];
                      $cod_morada=$registo['cod_morada'];
                      $data_encomenda=$registo['data_encomenda'];
                      $data_processo=$registo['data_processo'];
                      $data_entrega=$registo['data_entrega'];
                      $estado=$registo['estado'];
                      $id=$registo['id']; //id do utilizador que fez a encomenda

                      if($modo_entrega==1){
                      $select_info_entrega="select * from morada where cod_morada='".$cod_morada."'";
             
                      $result4=mysqli_query($ligax,$select_info_entrega);
                      $registo4=mysqli_fetch_assoc($result4);
                      $morada=$registo4['morada'];
                      $localidade=$registo4['localidade'];
                      $cod_postal=$registo4['cod_postal'];
                        
                    }
                       $select_info_fatura="select nome,empresa,telemovel,nif from faturas where cod_fatura='".$cod_fatura."'";
                    $result3= mysqli_query($ligax, $select_info_fatura);
                    $registo1=mysqli_fetch_assoc($result3);
                    $nome=$registo1['nome'];
                    $empresa=$registo1['empresa'];
                    $telemovel=$registo1['telemovel'];
                    $nif=$registo1['nif'];


                      
                                   
                     
                    ?> 
<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Detalhes da Encomenda - Número <?php echo $_GET['cod_encomenda']; ?></h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
<i class="fa fa-minus"></i></button>
<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
<i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body">
 
                 
                   <!-- Tab panes -->
            <div class="tab-content mb30" style="background-color: transparent !important;padding:0">
             <!-- TAB 1 -->
              <div class="tab-pane active" id="tab1" style="background-color: transparent !important;">


                <div style="float:left;width:70%;">
                  <div style="background-color: #fff;padding:20px">
                        
                        <div class="row">
                          <div class="col-sm-12">
                             
                                <?php if($modo_entrega==1){ ?>
                               <div style="float:left;width: calc(100% - 130px )">
                                    
                                    <label class="control-label">Morada de Entrega: </label>
                                    <input style="font-size:16px" class="text-input2 required form-control" type="text"  value="<?php echo $morada; ?>" disabled>

<br>
                              </div>

                            <div style="display: flex;width:500px;float: left;margin-bottom: 10px;">
  <div style="width: 230px;margin-right:20px;">
    <label class="control-label">Localidade:</label>
    <input style="font-size: 16px" class="text-input2 required form-control" type="text" value="<?php echo $localidade; ?>" disabled>
  </div>

  <div style="width: 230px;">
    <label class="control-label">Código Postal:</label>
    <input style="font-size: 16px" class="text-input2 required form-control" type="text" value="<?php echo $cod_postal; ?>" disabled>
  </div>
</div>

                             
                             
                          <?php }else{ ?>
                             <div style="float:left;width: calc(100% - 130px )">
                                    
                                    
                                    <input style="font-size:16px" class="text-input2 required form-control" type="text"  value="Levantamento do produto em loja física" disabled>


                              </div>

                          <?php } ?>
                         </div>
                      </div>
                      <br>
                      

                       <div class="row">
                              <div class="col-sm-12">
                                  <label class="control-label">Detalhes da Encomenda: </label>
                     
                         <div style="width:50rem;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //detalhes da mesma encomenda
            $select_detalhes_encomenda = "select * from item_encomenda where cod_encomenda='" . $_GET['cod_encomenda'] . "'";
            $result2 = mysqli_query($ligax, $select_detalhes_encomenda);
            while ($registo2 = mysqli_fetch_assoc($result2)) {
                $cod_produto = $registo2['cod_produto'];
                $quantidade = $registo2['quantidade'];
                $preco_venda = $registo2['preco_venda'];
                $select="select nome from produtos where cod_produto='".$cod_produto."'";
                $result5=mysqli_query($ligax,$select);
                $registo4=mysqli_fetch_assoc($result5);
                $nome=$registo4['nome'];
            ?>
           <tr>
            <td class="product-col">
                <div style="display:flex;align-items:center;margin:0;padding-right:2rem;box-shadow: none;">
                    <figure class="product-media" style="max-width: 60px;flex-shrink: 0;margin-right: 2.8rem;">
                        <a href="#">
                            <img src="showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" style="max-width: 40px;">
                        </a>
                    </figure>
                    <h3 style="font-size: 1.6rem;color: #333;" >
                        <?php echo $nome ?>
                    </h3><!-- End .product-title -->
                </div><!-- End .product -->
            </td>
          
            <td class="quantity-col">
                <center>
                <h3 style="font-size: 1.6rem;color: #333;" >
               <?php echo $quantidade; ?>
           </center>
</h3>
            </td>
            <td>
           <center>
                <h3 style="font-size: 1.6rem;color: #333;" >
               <?php echo $preco_venda; ?>
           </center>
           </td>
        </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

                               
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
                                                                                                 <label>Dono da Encomenda</label>
                                                 <input type="text" value="<?php if(isset($empresa)) echo $empresa; else echo $nome; ?>" disabled>

            
                                              </div>
                                             
                            </div>
                          </div>
                          <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>NIF:</label>
                                                 <input type="text" value="<?php echo $nif; ?>" disabled>

            
                                              </div>
                                             
                            </div>
                          </div>
                          <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">
                                                                                              <div style="float:left;margin-top:2px">
                                                                                                 <label>Número de telemóvel:</label>
                                                 <input type="text" value="<?php echo $telemovel; ?>" disabled>

            
                                              </div>
                                             
                            </div>
                          </div>
<form method="POST">
                          <div style="padding:20px;border-bottom:1px solid #f3f3f3;overflow: hidden;">
                              <label class="control-label">Estado da Encomenda: </label>
                                    <br>
                                    <select name="estado">

                                        <option value="0" <?php if($estado==0){echo 'selected'; }?>>Encomenda por processar</option>
                                        <option value="1" <?php if($estado==1){echo 'selected'; }?>>Encomenda em processamento</option>
                                        <option value="2" <?php if($estado==2){echo 'selected'; }?>>Encomenda pronta para recolho em loja</option>
                                        <option value="3" <?php if($estado==3){echo 'selected'; }?>>Encomenda entregue</option>
                                        <option value="4" <?php if($estado==4){echo 'selected'; }?>>Encomenda cancelada</option>
                                    </select>
<br><br>
                           <div class="" style="border-bottom: 0px solid #f3f3f3;margin-bottom: 0px;overflow: hidden;position: relative;top:1px">

                                                                                              <div style="float:left;margin-top:2px">

                                                                                                  <input type="submit" name="editar_encomenda" class="btn btn-primary"  value="Atualizar Estado">

            
                                              </div>
                                             
                            </div>
                          </div>
                      </form>
                  </div>
                    
             

             
              
    
</div>


</div>

</section>

</div>
