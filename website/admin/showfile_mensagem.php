<?php
include('../ligacao.php');

if(isset($_GET['id_newsletter'])) {
    $id_newsletter = $_GET['id_newsletter'];
    
    $query = "SELECT mensagem_tipo, mensagem_nome, mensagem_tamanho, mensagem_dados FROM tipo_newsletter WHERE id_newsletter='$id_newsletter'";
    $result = mysqli_query($ligax, $query);
    $row = mysqli_fetch_array($result);
    
    $tipo_img = $row["mensagem_tipo"];
    $nome_img = $row["mensagem_nome"];
    $tamanho_img = $row["mensagem_tamanho"];
    $dados_img = base64_decode($row["mensagem_dados"]);
    
    header("Content-type: $tipo_img");
    header("Content-length: $tamanho_img");
    header("Content-Disposition: inline; filename=$nome_img");
    header("Content-Description: PHP Generated Data");
    
    ob_clean();
    echo $dados_img;
}
?>
