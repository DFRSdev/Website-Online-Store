<?php
include('../ligacao.php');

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Fatura</title>
     
      <!-- Favicons -->
      <link href="../assets/images/logo.webp" rel="icon">
      <link href="../assets/images/logo.webp" rel="apple-touch-icon">
      <!-- Fontawesome -->
      <script src="assets/js/2bdbf9d3bf.js"></script>
      <!-- Vendor CSS Files -->
      <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Template Main CSS File -->
      <link href="assets/css/style.css" rel="stylesheet">
   </head>

   <?php
if(isset($_GET['cod_encomenda'])){
$select = "SELECT * FROM encomenda WHERE cod_encomenda='" . $_GET['cod_encomenda'] . "'";

$result = mysqli_query($ligax, $select);

if ($result && mysqli_num_rows($result) > 0) {
  $registo = mysqli_fetch_assoc($result);
  $id = $registo['id'];
  $data_encomenda = $registo['data_encomenda'];
  $total_encomenda = $registo['total_encomenda'];
  $cod_morada = $registo['cod_morada'];
  $cod_fatura = $registo['cod_fatura'];
  if(isset($cod_fatura)){
  $select_dados="select * from morada where cod_morada='".$cod_morada."'";
  
  $result2=mysqli_query($ligax,$select_dados);
  $registo2=mysqli_fetch_assoc($result2);
  $nif=$registo2['nif'];
  $morada=$registo2['morada'];
  $localidade=$registo2['localidade'];
  $cod_postal=$registo2['cod_postal'];
  $nome=$registo2['nome'];
$select_dados_encomenda="select * from item_encomenda where cod_encomenda='".$_GET['cod_encomenda']."'";
$result_dados=mysqli_query($ligax,$select_dados_encomenda);

$numero_itens=mysqli_num_rows($result_dados);

}else {echo '<script>location.href="../404.php";</script>';}
}else {echo '<script>location.href="../404.php";</script>';}
}else {echo '<script>location.href="../404.php";</script>';}

?>
   <body class="bg-light" onload="window.print();">
      <body data-new-gr-c-s-check-loaded="14.995.0" data-gr-ext-installed="">
         <!-- Container --> 
         <div class="container-fluid Billig-container shadow-sm">
            <!-- Header -->
            <header>
               <div class="row align-items-center">
                  <div class="col-7 text-start mb-3 mb-sm-0">
                     <img id="logo" src="../assets/images/logo.webp" style="witdh:175%">
                  </div>
                  <div class="col-5 text-end">
                     <h4 class="mb-0 text-uppercase">FATURA</h4>
                     <p class="mb-0">COD ENCOMENDA - <?php echo $_GET['cod_encomenda'];?></p>
                  </div>
               </div>
               <hr>
            </header>
            <!-- Main Content -->
            <main>
               <div class="row">
                  <div class="col-6"><strong>Data:</strong> 05/12/2021</div>
                  <div class="col-6 text-end "> <strong>Fatura nº:</strong> <?php echo $cod_fatura;?></div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-6  ">
                     <strong>Exmo.(s) Sr.(a)</strong>
                     <address>
                        <?php echo $nome; ?><br>
                        <?php echo $morada; ?> <br>
                        <?php echo $cod_postal; ?> - <?php echo $localidade; ?><br>
                         NIF: PT<?php echo $nif; ?><br><br><br><br>Total de Artigos - <?php echo $numero_itens; ?>
                     </address>
                  </div>
                  <div class="col-6 text-end">
                     <strong>Faturado por:</strong>
                     <address>
                        Miguel Angelo Brandão Unipessoal Lda<br>
                        Capital Social 5.000,00 EUR Matricula<br>
                        Rua do Valado, 18, São Paio de Oleiros, Portugal<br>

                     </address>
                  </div>
               </div>
               <div class="card">
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <table class="table mb-0">
                           <thead>
                           <tr>
                              <td class="col-3 border-0"><strong>Artigo</strong></td>
                              <td class="col-4 border-0"><strong>Descrição</strong></td>
                              <td class="col-2 border-0"><strong>QTY</strong></td>
                              <td class="col-1 border-0 text-end"><strong>€/UNID</strong></td>
                              <td class="col-2 text-end border-0"><strong>Total</strong></td>
                           </tr>
                        </thead>
                           <tbody>
                                <?php 
 while($registo3=mysqli_fetch_assoc($result_dados)){
      $cod_produto=$registo3['cod_produto'];
      $quantidade=$registo3['quantidade'];
      $preco_venda=$registo3['preco_venda'];

      $select_nome="select nome from produtos where cod_produto='".$cod_produto."'";
      $result6=mysqli_query($ligax,$select_nome);
      $registo4=mysqli_fetch_assoc($result6);
      $nome=$registo4['nome'];
   ?>
                              <tr>
                                 <td class="col-3"><?php echo $cod_produto; ?></td>
                                 <td class="col-4 text-1"><?php echo $nome; ?></td>
                                 <td class="col-2"><?php echo $quantidade; ?></td>
                                 <td class="col-1 text-end"><?php echo $preco_venda; ?></td>
                                 <td class="col-2 text-end">€<?php echo $preco_venda*$quantidade;?></td>
                              </tr>
                             <?php } ?>
                              <tr>
                                 <td colspan="4" class="bg-light-2 text-end"><strong>Sub Total:</strong></td>
                                 <td class="bg-light-2 text-end">€<?php echo round($total_encomenda / 1.23, 2); ?></td>
                              </tr>
                              <tr>
                                 <td colspan="4" class="bg-light-2 text-end"><strong>Iva:</strong></td>
                                 <td class="bg-light-2 text-end">€<?php echo $total_encomenda - round($total_encomenda / 1.23, 2); ?></td>
                              </tr>
                              <tr>
                                 <td colspan="4" class="bg-light-2 text-end border-0"><strong>Total:</strong></td>
                                 <td class="bg-light-2 text-end border-0">€<?php echo $total_encomenda; ?></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </main>
           
         </div>
   </body>
   </html>

