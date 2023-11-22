<?php
include ('../ligacao.php');



if (isset($_GET['id'])) {


$query="select foto_nome,foto_tipo,foto_tamanho,foto_dados from users where id='".$_GET['id']."'"; 
$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["foto_tipo"];
$nome_img=$row["foto_nome"];
$tamanho_img=$row["foto_tamanho"];
$dados_img=base64_decode($row["foto_dados"]);

header("Content-type:$tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
}

