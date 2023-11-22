<?php 




use PHPMailer\PHPMailer\PHPMailer;


 if(isset($_POST["faturar"])){

    $consulta="select * from carrinho where (cc_id like '".$_SESSION['id']."' or cc_sessionid like '".session_id()."');";
    $resultado=mysqli_query($ligax,$consulta);
     if($re=mysqli_fetch_assoc($resultado)!=0){
                //É atualizada a encomenda com os dados da faturação



                 $insere="update encomenda set cod_fatura='".$_POST['cod_fatura']."' where cod_encomenda='".$_POST['cod_encomenda']."'";
                     mysqli_query($ligax,$insere) || die(mysqli_error($ligax));

                  $select_stock="select * from item_encomenda where cod_encomenda='".$_POST['cod_encomenda']."';";
                   $res=mysqli_query($ligax,$select_stock);

                     if($res){
                //É atualizado a quantidade de cada produto que foi encomendado
                    while($registo = mysqli_fetch_assoc($res)) {
                        $cod=$registo['cod_produto'];
                        $s="select * from produtos where cod_produto=$cod;";
                        $rp=mysqli_query($ligax,$s);
                        $ri = mysqli_fetch_assoc($rp);
                        $qp=$ri['stock'];
                        $quant_encp=$registo['quantidade'];
                        $s="update produtos set stock=$qp-$quant_encp where cod_produto=$cod";
                        
                        mysqli_query($ligax,$s);
                        $consulta_produto="SELECT stock from produtos where cod_produto=$cod";
                                    $result_produto=mysqli_query($ligax, $consulta_produto);
                                    $registo_produto=mysqli_fetch_assoc($result_produto);
                                    $stock=$registo_produto['stock'];

                                    if($stock<=0){
                                        $disponibilidade="UPDATE produtos set estado=0 where cod_produto=$cod";
                                        $result_disponibilidade=mysqli_query($ligax, $disponibilidade);
                                    }
                    }
                   
                }
                //São eliminados os produtos do carrinho
                if(isset($_SESSION['id'])){
                   $delete="delete from carrinho where cc_id like '".$_SESSION['id']."' or cc_sessionid like '".session_id()."'"; 
               }else{
                $delete="delete from carrinho where cc_sessionid like '".session_id()."'";
                }

                
                mysqli_query($ligax,$delete) || die(mysqli_error($ligax));
                $consulta_total="select sum(preco_venda*quantidade) as total from item_encomenda where cod_encomenda='".$_POST['cod_encomenda']."';";
                $calc_tot=mysqli_query($ligax,$consulta_total);
               
                if($registo = mysqli_fetch_assoc($calc_tot)) {
                    if($_POST['preco_total_produto1']>100){
                    $consulta="update encomenda set total_encomenda='".($registo['total']+4.9)."' where cod_encomenda='".$_POST['cod_encomenda']."'";
                    }else{
                        $consulta="update encomenda set total_encomenda='".$registo['total']."' where cod_encomenda='".$_POST['cod_encomenda']."'";
                    }
                    mysqli_query($ligax,$consulta);
                }

              




    $mail = new PHPMailer(true);

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.sapo.pt';
    $mail->SMTPAuth = true;
    $mail->Username = 'miguelalextelemoveiscomunicacoes@sapo.pt';
    $mail->Password = 'MiguelAlexPorto2023';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel & Alex');
    $mail->addAddress($_SESSION['email']);
    $mail->isHTML(true); 
    // Email content
    $mail->Subject = 'Encomenda realizada com sucesso';
    $mail->Body = "<table style='border-collapse: separate; width: 100%; background: rgb(255, 255, 255); border-radius: 8px;'>
              <tbody><tr>
                <td style='font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 30px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; width: 100%;'>
                    <tbody><tr>
                      <td style='font-size: 14px; vertical-align: top;'>
                          <div style='text-align: center; margin-bottom: 20px; width: 100%; padding-top: 30px; padding-bottom: 30px;'><img width='240' height='auto' src='https://i.ibb.co/qksSz6m/logo.webp' alt='Teya' title='Teya' role='presentation'>
</div>
                        <h1 style='font-size: 20px; font-weight: 600; margin: 0px 0px 15px; '>
                            Deseja verificar a sua fatura?</h1><b> Clique no botão abaixo!</b>
                        
                        <p style='font-size: 16px; font-weight: normal; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>  </p><p style='color: rgb(21, 21, 21);'>Ao clicar no botão abaixo irá ser redirecionado para uma página onde pode verificar as suas encomendas! Vá, de seguida, para a parte onde diz: 'Encomendas'.</p>

          
<a style='transition: all 0.3s ease 0s; border-radius: 8px; background: rgb(1, 74, 122); font-weight: 600; border: none; cursor: pointer; display: block; font-size: 1em; line-height: 1.86875rem; padding: 0.575rem 1.15rem; font-family: Roboto-Medium, sans-serif; text-align: center; text-decoration: none; color:white;' href='http://localhost/pap/index.php?page=dashboard_utilizador'>
Verifique a sua encomenda</a>

<p style='color: rgb(51, 51, 51);'>
Ao continuar confirmo que li e concordo com os <a style='color: rgb(1, 74, 122); font-weight: 600; border-radius: 8px; background-color: transparent;' href='http://localhost/pap/termoscondicoes.pdf'>termos e condições</a> que regem meu uso dos serviços da Miguel Alex Telemóveis Comunicações .
</p>

<p style='color: rgb(21, 21, 21);'></p>
                        <hr style='width: 85%; margin: 24px auto; border: 1px solid rgb(224, 224, 224);'>
                        <p style='font-size: 14px; color: rgb(102, 102, 102);'>Estamos aqui para o ajudar. Se tiver alguma dúvida ou precisar de mais informações, contacte-nos através do nosso <a style='color: rgb(1, 74, 122); background-color: transparent; font-weight: 600; border-radius: 8px;' href='http://localhost/pap/index.php?page=contact'>centro de ajuda.</a>.<br><br>Atenciosamente,<br>Equipa Miguel & Alex. </p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>";



    // Send the email
    if ($mail->send()) {
       ?>

          <script>
                           Swal.fire({
    title: 'Encomenda',
    html: 'Encomenda realizada com sucesso!<br>Foi enviado um email com a fatura!',
    icon: 'success'
  });
setTimeout(() => {
    location.href = "index.php";
  }, 5000);

                            </script>
       <?php
    } 




               
            } else {
                 ?>
                            <script>
               
                 Swal.fire({
    title: 'Carrinho',
    text: 'Insira produtos no seu carrinho!',
    icon: 'warning'
  });

     setTimeout(() => {
    location.href = "index.php?pesquisa_produtos=";
  }, 3000);
   
                            </script>
                            <?php
            }
        }
    


if(isset($_POST['atualizar_fatura'])){

                       $atualizar="update faturas set nif='".$_POST['nif']."', morada='".$_POST['morada']."', telemovel='".$_POST['telemovel']."', cod_postal='".$_POST['cod_postal']."', nome='".$_POST['nome']."',empresa='".$_POST['empresa']."' where cod_fatura='".$_POST['cod_fatura']."'";
               
                       $result=mysqli_query($ligax,$atualizar);

                       if($result){

  ?>
        <script type="text/javascript">
            Swal.fire(
              'Morada',
              'A sua morada foi atualizada com sucesso!',
              'success'
            )
        </script>

        <?php
}
}

if(isset($_POST['adicionar_morada'])){

if(isset($_POST['empresa'])){
$insere="insert faturas (id,nif,morada,localidade,telemovel,cod_postal,empresa) values
                    
                    ('".$_SESSION['id']."','".$_POST['nif']."','".$_POST['morada']."','".$_POST['localidade']."','".$_POST['telemovel']."','".$_POST['cod_postal']."','".$_POST['empresa']."');";
 }else{
    $insere="insert faturas (id,nif,morada,localidade,telemovel,cod_postal,nome) values
                    
                    ('".$_SESSION['id']."','".$_POST['nif']."','".$_POST['morada']."','".$_POST['localidade']."','".$_POST['telemovel']."','".$_POST['cod_postal']."','".$_POST['nome']."');";
 }
   


                  
$result=mysqli_query($ligax,$insere);
if($result){

  ?>
        <script type="text/javascript">
            Swal.fire(
              'Morada',
              'Foi adicionada a sua morada com sucesso!',
              'success'
            )
        </script>

        <?php
}
}





?>

<link rel="stylesheet" type="text/css" href="assets/css/checkout.css">
<style>
   
.hidden {
      display: none;
    }
    .div-wrapper {
      display: inline-block;
      cursor: pointer;
      margin-right: 10px;
    }


.div-content {
      padding: 10px;
   
      border-radius: 5px;
    }
  </style>
  <form action="" method="POST">
<main class="main"  style="background-color: white;">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Loja</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav" style="background-color: white;">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Loja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout - Faturação</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content" >
            	<div class="checkout">
	                <div class="container">
            			
            			<br><br>
            			
		                	<div class="row" >
		                		<div class="col-lg-9" >
		                			
		                				
		                	
		                				 <?php
									  $selecionamento = "SELECT * FROM carrinho WHERE (cc_id = '" . $_SESSION["id"] . "' OR cc_sessionid = '" . session_id() . "')";
    $result = mysqli_query($ligax, $selecionamento);

									    $preco_total_produto1 = 0;
									    $total_quantidade1 = 0;
				         while($registo=mysqli_fetch_assoc($result)){
                      $cc_cod_produto=$registo['cc_cod_produto'];
                      $cc_quantidade=$registo['cc_quantidade'];
                        $select_produto="select nome,preco from produtos where cod_produto=$cc_cod_produto";
                        $result1=mysqli_query($ligax,$select_produto);
                        $registo1=mysqli_fetch_assoc($result1);
                        $nome=$registo1['nome'];
                        $preco=$registo1['preco'];
									 
						$preco_total_produto=$preco*$cc_quantidade;		 
 $total_quantidade=$cc_quantidade;
								$preco_total_produto1+=$preco_total_produto;

										$total_quantidade1+=$total_quantidade;

										}
									 ?>

	            						<div class="z-1 base-container py-5 bg-background pb-28 flex-grow " style="background-color: white;">

  <main>
    <div class="lg:grid lg:grid-cols-checkout gap-x-10 pt-1 pb-10 md:py-5">
      <div class="items-start">
        <div style="width:155%;" style="display:flex;justify-content: center;align-items: center;" >
          <div class="flex items-center justify-center p-5 mb-6 text-center rounded bg-background-off md:py-8 shadow-md summary">
            <p>Por favor, escolhe aqui os teus dados de faturação e forma de pagamento para avançares para a confirmação da tua encomenda.</p>
          </div>
         
        </div>
        <div class="pb-6">
          <h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Dados de Faturação</h1>
          <br>
          <div class="px-4 py-6 mb-10 rounded bg-background-off md:p-6" style="width: 155%;">
            <ul class="mb-6 grid tablet:grid-cols-2 xl:grid-cols-3 gap-6">
              



<?php
$select_morada = "SELECT * FROM faturas WHERE id='" . $_SESSION['id'] . "'";
$result = mysqli_query($ligax, $select_morada);

$select_cod_encomenda = "SELECT cod_encomenda FROM encomenda WHERE id = '" . $_SESSION['id'] . "' AND cod_encomenda = (SELECT MAX(cod_encomenda) FROM encomenda)";

$result1 = mysqli_query($ligax, $select_cod_encomenda);
$registo1 = mysqli_fetch_assoc($result1);
$cod_encomenda = $registo1['cod_encomenda'];


if (mysqli_num_rows($result) > 0) {
    $count = 0; // Initialize counter
    while ($registo = mysqli_fetch_assoc($result)) {
        $cod_fatura = $registo['cod_fatura'];
        $nif = $registo['nif'];
        $localidade = $registo['localidade'];
        $telemovel = $registo['telemovel'];
        $cod_postal = $registo['cod_postal'];
        $nome = $registo['nome'];
        $morada = $registo['morada'];
        $empresa = $registo['empresa'];
        $count++; // Increment counter

        ?>

        <li class="flex flex-col justify-between transition p-5 rounded-r3 border-2 bg-background-off filter border-border-color cursor-pointer hover:shadow-md" >


 
            <div class="flex items-start justify-between">
                <div class="flex flex-col text-sm break-words max-w-198" style="font-size:14px;">

                    <span><?php if(isset($empresa)) echo $empresa; else echo $nome; ?></span>
                    <br>
                    <span><?php echo $morada; ?></span>
                    <br>
                    <span><?php echo $cod_postal; ?></span>
                    <br>
                    <span>T:<?php echo $telemovel; ?></span>
                    <br>
                    <span>NIF:<?php echo $nif; ?></span>
                    <br>
                </div>
<input type="hidden" name="cod_encomenda" value="<?php echo $cod_encomenda; ?>">
  <input type="radio" name="cod_fatura" class="morada-input" value="<?php echo $cod_fatura; ?>" required>
 

                
                
            </div>
            <div class="flex items-center justify-between pt-4">
               
                <a href="#fatura-modal<?php echo $count; ?>" data-toggle="modal" class="my-account-icons-hover rounded-full p-2">
                     <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-xl text-primary"> <path d="M4.41999 20.5787C4.13948 20.5782 3.87206 20.4599 3.68299 20.2527C3.49044 20.0471 3.39476 19.7692 3.41999 19.4887L3.66499 16.7947L14.983 5.48066L18.52 9.01666L7.20499 20.3297L4.51099 20.5747C4.47999 20.5777 4.44899 20.5787 4.41999 20.5787ZM19.226 8.30966L15.69 4.77366L17.811 2.65266C17.9986 2.46488 18.2531 2.35938 18.5185 2.35938C18.7839 2.35938 19.0384 2.46488 19.226 2.65266L21.347 4.77366C21.5348 4.96123 21.6403 5.21575 21.6403 5.48116C21.6403 5.74657 21.5348 6.00109 21.347 6.18866L19.227 8.30866L19.226 8.30966Z" fill="currentColor"></path></svg>
                </a>
            </div>
         
        </li>


        <!-- modal -->

        <div class="modal fade" id="fatura-modal<?php echo $count; ?>" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="icon-close"></i>
                            </span>
                        </button>
                        <div class="form-box">
                            <div class="form-tab">
                                <ul class="nav nav-pills nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="morada-tab" data-toggle="tab" href="#morada" role="tab" aria-controls="morada" aria-selected="true">Dados de Faturação</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-content-5">
                                    <div class="tab-pane fade show active" id="morada" role="tabpanel" aria-labelledby="morada-tab">
                                        <form action="" method="POST">
                                            <center>
                                            <div class="grid grid-cols-2 col-start-1 col-end-3 max-w-sm form-group">
                                                  <div class="flex items-center">
                                                    <input type="radio" id="private" name="addressType" value="private"  onclick="mostrarDiv(['div1']);toggleRequired1()">
                                                    <label for="private" class="font-semibold pl-6 cursor-pointer" >Particular</label>
                                                  </div>
                                                  <div class="flex items-center">
                                                    <input type="radio" id="enterprise" name="addressType" value="enterprise" onclick="mostrarDiv(['div2']);toggleRequired2()">
                                                    <label for="enterprise" class="font-semibold pl-6 cursor-pointer">Empresarial</label>
                                                  </div>
                                                </div>
                                          </center>
                                          <div id="div1" class="hidden">
                                            <div class="form-group" >
                                                <label for="nome<?php echo $count; ?>">Nome *</label>
                                                <input type="text" class="form-control" id="nome<?php echo $count; ?>" name="nome" value="<?php echo $_SESSION['name']; ?>" required>
                                            </div>
                                            
                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="input_morada<?php echo $count; ?>">Morada *</label>
                                                <input type="text" class="form-control" id="input_morada<?php echo $count; ?>" name="morada" placeholder="Indique aqui o nome da empresa (se aplicável), rua, travessa, largo, etc." required="" minlength="10" maxlength="60" pattern="^([\w\xc0-\u017e \s \xaa \xba , | / [ \] \\ \. \-]){5,60}?$" value="<?php if (isset($morada)) echo $morada; ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cod_postal<?php echo $count; ?>">Código Postal *</label>
                                                <input type="text" class="form-control" id="cod_postal<?php echo $count; ?>" name="cod_postal" value="<?php if (isset($cod_postal)) echo $cod_postal; ?>" required placeholder="0000-000" pattern=\d{4}-\d{3}>
                                            </div>

                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="localidade<?php echo $count; ?>">Localidade *</label>
                                                <input type="text" class="form-control" id="localidade<?php echo $count; ?>" name="localidade" value="<?php if (isset($localidade)) echo $localidade; ?>" required>
                                            </div>

                                            <div class="form-group-container" style="display: flex;column-gap: 2rem;">
                                                <div class="form-group" style="width: 7rem;">
                                                    <label for="indicativo<?php echo $count; ?>">Indicativo *</label>
                                                    <input type="text" class="form-control" id="indicativo<?php echo $count; ?>" name="indicativo" value="<?php if (isset($indicativo)) echo $indicativo;
                                                                                                                                    else {
                                                                                                                                        echo '+351';
                                                                                                                                    } ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telemovel<?php echo $count; ?>">Telemóvel *</label>
                                                    <input type="number" class="form-control" id="telemovel<?php echo $count; ?>" name="telemovel" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" value="<?php if (isset($telemovel)) echo $telemovel; ?>" required>
                                                </div>
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="nif<?php echo $count; ?>">NIF </label>
                                                <input type="text" class="form-control" id="nif<?php echo $count; ?>" name="nif" value="<?php if (isset($nif)) echo $nif; ?>" pattern="^[A-Za-z0-9]*\d+[A-Za-z0-9]*$">
                                            </div>
                                            </div>

                                            <div id="div2" class="hidden">
                                           
                                            <div class="form-group ">
                                                <label for="nome<?php echo $count; ?>">Empresa *</label>
                                                <input type="text" class="form-control" id="empresa<?php echo $count; ?>" name="empresa" value="<?php if (isset($empresa)) echo $empresa; ?>" required>
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="input_morada<?php echo $count; ?>">Morada *</label>
                                                <input type="text" class="form-control" id="input_morada<?php echo $count; ?>" name="morada" placeholder="Indique aqui o nome da empresa (se aplicável), rua, travessa, largo, etc." required="" minlength="10" maxlength="60" pattern="^([\w\xc0-\u017e \s \xaa \xba , | / [ \] \\ \. \-]){5,60}?$" value="<?php if (isset($morada)) echo $morada; ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cod_postal<?php echo $count; ?>">Código Postal *</label>
                                                <input type="text" class="form-control" id="cod_postal<?php echo $count; ?>" name="cod_postal" value="<?php if (isset($cod_postal)) echo $cod_postal; ?>" required placeholder="0000-000" pattern=\d{4}-\d{3}>
                                            </div>

                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="localidade<?php echo $count; ?>">Localidade *</label>
                                                <input type="text" class="form-control" id="localidade<?php echo $count; ?>" name="localidade" value="<?php if (isset($localidade)) echo $localidade; ?>" required>
                                            </div>

                                            <div class="form-group-container" style="display: flex;column-gap: 2rem;">
                                                <div class="form-group" style="width: 7rem;">
                                                    <label for="indicativo<?php echo $count; ?>">Indicativo *</label>
                                                    <input type="text" class="form-control" id="indicativo<?php echo $count; ?>" name="indicativo" value="<?php if (isset($indicativo)) echo $indicativo;
                                                                                                                                    else {
                                                                                                                                        echo '+351';
                                                                                                                                    } ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telemovel<?php echo $count; ?>">Telemóvel *</label>
                                                    <input type="number" class="form-control" id="telemovel<?php echo $count; ?>" name="telemovel" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" value="<?php if (isset($telemovel)) echo $telemovel; ?>" required>
                                                </div>
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="nif<?php echo $count; ?>">NIF *</label>
                                                <input type="text" class="form-control" id="nif<?php echo $count; ?>" name="nif" value="<?php if (isset($nif)) echo $nif; ?>" required pattern="^[A-Za-z0-9]*\d+[A-Za-z0-9]*$">
                                            </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-footer">
                                                <button type="submit" name="atualizar_morada" class="btn btn-outline-primary-2">
                                                    <span>Guardar </span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End .form-footer -->
                                </div>
                                <!-- .End .tab-pane -->
                            </div>
                            <!-- End .tab-content -->
                        </div>
                        <!-- End .form-tab -->
                    </div>
                    <!-- End .form-box -->
                </div>
                <!-- End .modal-body -->
            </div>
            <!-- End .modal-content -->
        </div>
        <!-- End .modal-dialog -->
<?php } } else {
    echo 'Não possuí uma morada de faturação associada à sua conta.';
} ?>

            </ul>
            <a href="#fatura-modal" data-toggle="modal" data-testid="button-component" class="with-tab ">
              <span class="flex items-center  text-sm underline text-primary font-bold gap-x-1" style="font-size:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 22H4C2.89543 22 2 21.1046 2 20V8H4V20H16V22ZM20 18H8C6.89543 18 6 17.1046 6 16V4C6 2.89543 6.89543 2 8 2H20C21.1046 2 22 2.89543 22 4V16C22 17.1046 21.1046 18 20 18ZM8 4V16H20V4H8ZM15 14H13V11H10V9H13V6H15V9H18V11H15V14Z" fill="currentColor"></path>
                </svg>Adicionar novos Dados de Faturação </span>
            </a>
          </div>
        </div>
        <!-- modal -->
        <div class="pb-6"><h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;"> Método de Pagamento</h1></div>
        <ul>
            <li class="flex flex-col justify-between transition p-5 rounded-r3 border-2 bg-background-off filter border-border-color cursor-pointer hover:shadow-md">
  <div class="flex items-center">
    <input type="radio" id="pagamento_cartao" name="pagamento_cartao" value="pagamento_cartao" onclick="mostrarDiv(['div7'])">
    <pre> </pre>
    <img src="https://www.cardfellow.com/blog/wp-content/uploads/2020/04/Mastercard-Visa-Limited-Acceptance-Programs_uvpqvf.png" style="width: 20%;">
  </div>

  <div id="div7" class="hidden">
      <div class="form-group">
        <br>
                    <label for="localidade">Nome no Cartão *</label>
                    <input type="text" class="form-control" id="nome_cartao" name="nome_cartao"  required>
                  </div>

                  <div class="form-group">
                    <label for="localidade">Número do Cartão *</label>
                   <input type="tel" maxlength="19" placeholder="1234 5678 9012 3456" aria-label="Número do cartão" class="form-control" id="numero_cartao" name="numero_cartao"  required>



                  </div>
  <div class="form-group-container" style="display: flex;column-gap: 2rem;">
                  <div class="form-group" >
  <label for="localidade">Data de Validade *</label>
  <input type="text" class="form-control" style="width: 20rem;" id="validade_cartao" pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" placeholder="MM/AA" name="validade_cartao"  required>
</div>
<div class="form-group">
  <label for="cvv_cartao">CVC / CVV *</label>
  <input type="text" class="form-control" id="cvv_cartao" name="cvv_cartao" placeholder="3 digits" minlength="3" maxlength="3" required>
</div>

  </div>

</div>
</li>

        </ul>

<div class="modal fade" id="fatura-modal" tabindex="-1" role="dialog" aria-hidden="true">
 
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="icon-close"></i>
          </span>
        </button>
        <div class="form-box">
          <div class="form-tab">
            <ul class="nav nav-pills nav-fill" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="morada-tab" data-toggle="tab" href="#morada" role="tab" aria-controls="morada" aria-selected="true">Dados de Faturação</a>
              </li>
            </ul>
            <div class="tab-content" id="tab-content-5">
              <div class="tab-pane fade show active" id="morada" role="tabpanel" aria-labelledby="morada-tab">
               
                  <center>
                                            <div class="grid grid-cols-2 col-start-1 col-end-3 max-w-sm form-group">
                                                  <div class="flex items-center">
                                                    <input type="radio" id="private" name="addressType" value="private"  onclick="mostrarDiv(['div3'])">
                                                    <label for="private" class="font-semibold pl-6 cursor-pointer">Particular</label>
                                                  </div>
                                                  <div class="flex items-center">
                                                    <input type="radio" id="enterprise" name="addressType" value="enterprise" onclick="mostrarDiv(['div4'])">
                                                    <label for="enterprise" class="font-semibold pl-6 cursor-pointer">Empresarial</label>
                                                  </div>
                                                </div>
                                          </center>
                                            <form action="" method="POST">
                                          <div id="div3" class="hidden">
                                           
                                            <div class="form-group" >
                                                <label for="nome<?php echo $count; ?>">Nome *</label>
                                                <input type="text" class="form-control" id="nome<?php echo $count; ?>" name="nome" value="<?php echo $_SESSION['name']; ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                    <label for="input_morada">Morada *</label>
                    <input type="text" class="form-control" id="input_morada" name="morada" placeholder="Indique aqui o nome da empresa (se aplicável), rua, travessa, largo, etc." required="" minlength="10" maxlength="60" pattern="^([\w\xc0-\u017e \s \xaa \xba , | / [ \] \\ \. \-]){5,60}?$"  required>
                  </div>

                 <div class="form-group">
  <label for="cod_postal">Código Postal *</label>
  <input type="text" class="form-control" id="cod_postal" name="cod_postal"  required  placeholder="0000-000" pattern=\d{4}-\d{3}>
</div>


                  <!-- End .form-group -->
                  <div class="form-group">
                    <label for="localidade">Localidade *</label>
                    <input type="text" class="form-control" id="localidade" name="localidade"  required>
                  </div>

                 <div class="form-group-container" style="display: flex;column-gap: 2rem;">
  <div class="form-group" style="width: 7rem;">
    <label for="indicativo">Indicativo *</label>
    <input type="text" class="form-control" id="indicativo" name="indicativo" value="+351" required>
  </div>

  <div class="form-group">
    <label for="telemovel">Telemóvel *</label>
    <input type="number"  class="form-control" id="telemovel" name="telemovel" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}"  required >
  </div>
</div>
<!-- End .form-group -->
                  <div class="form-group">
                    <label for="nif">NIF *</label>
                    <input type="text" class="form-control" id="nif" name="nif"  required pattern="^[A-Za-z0-9]*\d+[A-Za-z0-9]*$">
                  </div>
    <br>
                                            <br>

                  <br>
                  <br>
                  <div class="form-footer">
                    <button type="submit" name="adicionar_morada" class="btn btn-outline-primary-2">
                      <span>Guardar </span>
                      <i class="icon-long-arrow-right"></i>
                    </button>
                  </div>
                


            
                                            </div>  </form>
 <form action="" method="POST">
                                            <div id="div4" class="hidden">
                                            
                                            <div class="form-group ">
                                                <label for="nome">Empresa *</label>
                                                <input type="text" class="form-control" id="empresa" name="empresa" value="<?php if (isset($empresa)) echo $empresa; ?>" required>
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group">
                    <label for="input_morada">Morada *</label>
                    <input type="text" class="form-control" id="input_morada" name="morada" placeholder="Indique aqui o nome da empresa (se aplicável), rua, travessa, largo, etc." required="" minlength="10" maxlength="60" pattern="^([\w\xc0-\u017e \s \xaa \xba , | / [ \] \\ \. \-]){5,60}?$"  required>
                  </div>

                 <div class="form-group">
  <label for="cod_postal">Código Postal *</label>
  <input type="text" class="form-control" id="cod_postal" name="cod_postal"  required  placeholder="0000-000" pattern=\d{4}-\d{3}>
</div>


                  <!-- End .form-group -->
                  <div class="form-group">
                    <label for="localidade">Localidade *</label>
                    <input type="text" class="form-control" id="localidade" name="localidade"  required>
                  </div>

                 <div class="form-group-container" style="display: flex;column-gap: 2rem;">
  <div class="form-group" style="width: 7rem;">
    <label for="indicativo">Indicativo *</label>
    <input type="text" class="form-control" id="indicativo" name="indicativo" value="+351" required>
  </div>

  <div class="form-group">
    <label for="telemovel">Telemóvel *</label>
    <input type="number"  class="form-control" id="telemovel" name="telemovel" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}"  required >
  </div>
</div>
<!-- End .form-group -->
                  <div class="form-group">
                    <label for="nif">NIF *</label>
                    <input type="text" class="form-control" id="nif" name="nif"  required pattern="^[A-Za-z0-9]*\d+[A-Za-z0-9]*$">
                  </div>
                      <br>
                                            <br>

                  <br>
                  <br>
                  <div class="form-footer">
                    <button type="submit" name="adicionar_morada" class="btn btn-outline-primary-2">
                      <span>Guardar </span>
                      <i class="icon-long-arrow-right"></i>
                    </button>
                  </div>
                
             

                                            </div>
                                         </form>
              </div>
              <!-- End .form-footer -->
            </div>
            <!-- .End .tab-pane -->
          </div>
          <!-- End .tab-content -->
        </div>
        <!-- End .form-tab -->
      </div>
      <!-- End .form-box -->
    </div>
    <!-- End .modal-body -->
  </div>
  <!-- End .modal-content -->
</div>
<!-- End .modal-dialog -->

      


        
       
   
    </div>
  </main>
</div>

		                		</div><!-- End .col-lg-9 -->

		                		<aside class="col-lg-3">
	                			<div class="summary summary-cart" >
	                				<h3 class="summary-title">Total do Carrinho</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">

	                							<td><?php echo $total_quantidade1;?> Produto</td>
	                							<td>€<?php echo round($preco_total_produto1/1.23,2); ?></td>
	                						</tr><!-- End .summary-subtotal -->
	                						
	                						
	                						<tr class="summary-shipping-estimate">
	                							<td>Iva (23%):</td>
	                							<td>€<?php echo $preco_total_produto1-round($preco_total_produto1/1.23,2); ?></td>
	                						</tr><!-- End .summary-shipping-estimate -->
                              <?php if($preco_total_produto1>100){ ?>
                                  <tr class="summary-subtotal">
                                <td>Transportadora:</td>
                                <td>€<?php echo '0.00' ?></td>
                              </tr><!-- End .summary-total -->
                               

                            <?php }else{?>
                                 <tr class="summary-subtotal">
                                <td>Transportadora:</td>
                                <td>€<?php echo '4.90' ?></td>
                              </tr><!-- End .summary-total -->

                            <?php } ?>
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>€<?php if($preco_total_produto1>100) echo $preco_total_produto1; else{echo $preco_total_produto1+4.9;} ?></td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->
                                    <input type="hidden" name="preco_total_produto1" value="<?php echo $preco_total_produto1; ?>">
	                				<button name="faturar" class="btn btn-outline-primary-2 btn-order btn-block">Proceder com a encomenda</button>
	                			</div><!-- End .summary -->

	                		</aside><!-- End .col-lg-3 -->

		                	</div><!-- End .row -->
            				                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->

        </main>
    </form>
 

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var codigoPostalInput = document.getElementById('cod_postal');
    
    codigoPostalInput.addEventListener('input', function() {
      var codigoPostal = this.value.trim();
      var isValid = /^\d{4}-\d{3}$/.test(codigoPostal);
      this.setCustomValidity(isValid ? '' : 'O código postal deve estar no formato 4000-000.');
    });
    
    codigoPostalInput.addEventListener('invalid', function() {
      this.setCustomValidity('O código postal deve estar no formato 4000-000.');
    });
  });
</script>


<script>
        function handleRadioClick() {
            var moradaInputs = document.getElementsByClassName('morada-input');
            
            if (this.checked) {
                for (var i = 0; i < moradaInputs.length; i++) {
                    moradaInputs[i].required = false;
                }
            } else {
                for (var i = 0; i < moradaInputs.length; i++) {
                    moradaInputs[i].required = true;
                }
            }
        }
    </script>

         <script>
   function mostrarDiv(divIds) {
  // Esconder todas as divs
  var divs = document.querySelectorAll('.hidden');
  divs.forEach(function(div) {
    div.style.display = 'none';
  });

  // Mostrar as divs selecionadas
  divIds.forEach(function(divId) {
    var div = document.getElementById(divId);
    if (div) {
      div.style.display = 'block';
    }
  });
}

  </script>
  <script>
  const inputNumeroCartao = document.getElementById('numero_cartao');
  
  inputNumeroCartao.addEventListener('input', function(event) {
    let value = event.target.value;
    
    // Remove todos os espaços em branco existentes
    value = value.replace(/\s/g, '');
    
    // Adiciona um espaço a cada 4 dígitos
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    
    // Atualiza o valor do campo de entrada
    event.target.value = value;
  });
</script>

<script type="text/javascript">
    // Obter o valor do campo de entrada
var validadeCartao = document.getElementById('validade_cartao').value;

// Obter a data atual
var dataAtual = new Date();

// Extrair o mês e o ano da data de validade
var partesValidade = validadeCartao.split('/');
var mesValidade = parseInt(partesValidade[0], 10);
var anoValidade = parseInt(partesValidade[1], 10);

// Adicionar 1 ao mês, pois os meses em JavaScript são indexados a partir de zero
mesValidade -= 1;

// Criar uma nova data com o mês e ano da validade
var dataValidade = new Date(anoValidade, mesValidade);

// Comparar a data atual com a data de validade
if (dataValidade < dataAtual) {
  // A data de validade já passou
  alert('A data de validade do cartão já expirou.');
  return false; // ou faça outra ação, como impedir o envio do formulário
}

// A data de validade é posterior à data atual
// Faça algo com os dados fornecidos, como enviar o formulário

</script>
