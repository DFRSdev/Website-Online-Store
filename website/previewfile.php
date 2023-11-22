<?php 
include ('ligacao.php');


if (isset($_GET['id_newsletter'])) {


$query="select ficheiro_nome,ficheiro_tipo,ficheiro_tamanho,ficheiro_dados from tipo_newsletter where id_newsletter='".$_GET['id_newsletter']."'"; 
$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$ficheiro_tipo=$row["ficheiro_tipo"];
$ficheiro_nome=$row["ficheiro_nome"];
$ficheiro_tamanho=$row["ficheiro_tamanho"];
$ficheiro_dados=base64_decode($row["ficheiro_dados"]);

header("Content-type:$tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
?>
<embed src="<?php echo $echo $ficheiro_dados; ?>" style="width: 100%;height: 100%;"></embed>
<?php
}


