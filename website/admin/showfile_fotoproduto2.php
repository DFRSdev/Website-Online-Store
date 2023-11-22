<?php
include ('../ligacao.php');



if(isset($_GET['cod_produto'])){


$query="select image2_type,image2_name,image2_size,image2_data from produtos where cod_produto='".$_GET['cod_produto']."'"; 
$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["image2_type"];
$nome_img=$row["image2_name"];
$tamanho_img=$row["image2_size"];
$dados_img=base64_decode($row["image2_data"]);

header("Content-type:$tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
}

