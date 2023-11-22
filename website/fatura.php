<?php
include('ligacao.php');
header('Content-Type: text/html; charset=utf-8');

?>

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="assets/css/style_fatura.css">
   <title>ㅤ</title>
</head>

 

<?php

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

}else {echo '<script>location.href="404.php";</script>';}
}else {echo '<script>location.href="404.php";</script>';}


?>

<body onload="window.print();"><div class="pc pc1 w0 h0"> 
   <img class="bi x0 y0 w1 h1" alt="" src="https://i.ibb.co/sjB6y3G/transferir-1.jpg"/>
 
   <div class="t m0 x2 h3 y2 ff1 fs1 fc0 sc0 ls0 wsd">FATURA <span class="_ _0"> </span><?php echo $_GET['cod_encomenda'];?></div>
   <div class="t m0 x3 h4 y3 ff1 fs2 fc0 sc0 ls0 wsd">Miguel Angelo Brandão Unipessoal Lda</div>
   <div class="t m0 x3 h4 y4 ff2 fs2 fc0 sc0 ls0 wsd">Contribuinte Nº 507082907 Cons. Reg. Com. Aveiro </div>
   <div class="t m0 x3 h4 y5 ff2 fs2 fc0 sc0 ls0 wsd">Capital Social 5.000,00 EUR Matricula</div>
   <div class="t m0 x3 h4 y6 ff1 fs2 fc0 sc0 ls0 wsd">Rua do Valado, 18, São Paio de Oleiros, Portugal </div>
   <div class="t m0 x3 h4 y7 ff1 fs2 fc0 sc0 ls0 wsd">4535-997 - São Paio de Oleiros </div>
   <div class="t m0 x3 h4 y8 ff1 fs2 fc0 sc0 ls0 wsd">miguelalextelemoveiscomunicacoes.com </div>
   <div class="t m0 x3 h4 y9 ff1 fs2 fc0 sc0 ls0 wsd">Telefone: 916865282 </div>
   <div class="t m0 x3 h4 ya ff1 fs2 fc0 sc0 ls0 wsd">Email: miguelalextelemoveiscomunicacoes@sapo.pt </div>
   <div class="t m0 x3 h4 yb ff1 fs2 fc0 sc0 ls0 wsd"> </div>
   <div class="t m0 x4 h4 yc ff1 fs2 fc0 sc0 ls0 wsd">Exmo.(s) Sr.(a)</div>
   <div class="t m0 x4 h4 yd ff1 fs2 fc0 sc0 ls0 wsd"><?php echo $nome; ?></div>
   <div class="t m0 x4 h4 ye ff1 fs2 fc0 sc0 ls0 wsd"><?php echo $morada; ?> </div>
   <div class="t m0 x4 h4 yf ff1 fs2 fc0 sc0 ls0 wsd"><?php echo $cod_postal; ?> - <?php echo $localidade; ?></div>
   <div class="t m0 x5 h4 y10 ff1 fs2 fc0 sc0 ls0 ws0">PT<?php echo $nif; ?><span class="_ _1"></span>NIF:</div>
   <div class="t m0 x6 h5 y11 ff2 fs3 fc0 sc0 ls0 wsd"><?php echo $numero_itens; ?><span class="_ _2"></span>Total de Artigos</div>
   <div class="t m0 x7 h6 y12 ff1 fs4 fc0 sc0 ls0 wsd">QUADRO RESUMO DO IVA</div>
   <div class="t m0 x8 h6 y13 ff1 fs4 fc0 sc0 ls0 ws1">TAXA<span class="_"> </span><span class="ws2 v1">INCIDENCIA<span class="_"> </span></span><span class="wsd">TOTAL IVA<span class="_ _3"> </span><span class="v1">MOTIVO ISENCAO</span></span></div>
   <div class="t m0 x8 h4 y14 ff2 fs2 fc0 sc0 ls0 ws3">23.00<span class="_"> </span>30,00<span class="_ _4"> </span><?php echo $total_encomenda - round($total_encomenda / 1.23, 2); ?></div>
   <div class="t m0 x9 h7 y15 ff2 fs5 fc0 sc0 ls0 wsd"> <span class="ff1 fs4"> </span>    </div>


   <div class="t m0 xc h9 y1c ff1 fs4 fc0 sc0 ls0 ws5">MERCADORIAS/SERVIÇOS<span class="_"> </span><span class="v0"><?php echo round($total_encomenda / 1.23, 2); ?></span></div>
   <div class="t m0 xc h6 y1d ff1 fs4 fc0 sc0 ls0 wsd">DESCONTOS COMERCIAIS<span class="_ _9"> </span>0,00</div>
   <div class="t m0 xc h6 y1e ff1 fs4 fc0 sc0 ls0 wsd">CUSTOS DE ENVIO<span class="_ _a"> </span><?php if($total_encomenda<100) echo '3.90'; else echo '0,00';?></div>
   <div class="t m0 xc h6 y1f ff1 fs4 fc0 sc0 ls0 ws6">IVA<span class="_"> </span><?php echo $total_encomenda - round($total_encomenda / 1.23, 2); ?></div>
   <div class="t m0 xc h6 y20 ff1 fc0 sc0 ls0" style="    font-size: 64px;">TOTAL(EUR)<span class="_ _ _9"> </span><?php echo $total_encomenda; ?>€</div>


   <div class="t m0 x10 hd y29 ff1 fs2 fc0 sc0 ls0 wsd">REFERENCIA <span class="_ _b"> </span><span class="v0">MODO PAGAMENTO <span class="_ _c"> </span><span class="v0">COND.PAGAMENTO<span class="_ _d"> </span>Nº CLIENTE<span class="_ _e"> </span>VENCIMENTO<span class="_ _f"> </span>DATA</span></span></div>
   <div class="t m0 x11 h4 y2a ff2 fs2 fc0 sc0 ls0 wsd">cod - <?php echo $_GET['cod_encomenda']; ?>ㅤ<span class="_ _10"> </span>CARTÃO<span class="_ _11"> </span>Pronto pagamento<span class="_ _12"> </span>ㅤㅤㅤ<?php echo $id; ?>ㅤㅤ<span class="_ _13"> </span><?php echo $data_encomenda; ?><span class="_ _14"> </span><?php echo $data_encomenda; ?></div>
   <div class="t m0 x3 he y2b ff1 fs2 fc0 sc0 ls0 wsd">ARTIGO <span class="_ _15"> </span><span class="ws7 v1">DESCRICAO<span class="_"> </span></span><span class="ws8 v0">QT.<span class="_"> </span><span class="ff4 v0">€<span class="ff1 ws9">/UNID.<span class="_"> </span></span></span><span class="wsa">IVA<span class="_"> </span>TOTAL</span></span></div>

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
   <div class="t m0 x3 h4 y2c ff2 fs2 fc0 sc0 ls0 wsb">ㅤ<?php echo $cod_produto; ?><span class="_"> </span><span class="wsd v1">ㅤㅤ<?php echo $nome; ?></span></div>
   
   <div class="t m0 x13 h4 y2f ff2 fs2 fc0 sc0 ls0 wsc"><?php echo $quantidade; ?><span class="_ _16"> </span><?php echo $preco_venda; ?><span class="_ _17"> </span>23<span class="_"> </span><?php echo $preco_venda*$quantidade; ?></div>
   <?php } ?>
   
</div>
</body>

