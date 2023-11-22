<?php
include ('../ligacao.php');




                    if(isset($_POST['cod_produto'])){
                    $delete="delete from produtos where cod_produto='".$_GET['cod_produto']."'";
                    $result=mysqli_query($ligax,$delete);
                    }
                    
?>

