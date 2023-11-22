<?php
include ('../ligacao.php');



if(isset($_GET['cod_produto'])){


$query="select image3_type,image3_name,image3_size,image3_data from produtos where cod_produto='".$_GET['cod_produto']."'"; 
$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["image3_type"];
$nome_img=$row["image3_name"];
$tamanho_img=$row["image3_size"];
$dados_img=base64_decode($row["image3_data"]);

header("Content-type:$tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
}

