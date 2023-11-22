	
	
<?php

if(isset($_POST['atualizar_estado_encomenda'])){
    $atualizar="UPDATE encomenda SET estado='4' WHERE cod_encomenda='" . $_POST['cod_encomenda'] . "'";
    $result = mysqli_query($ligax, $atualizar);
   
         if($result){

  ?>
        <script type="text/javascript">
            Swal.fire(
              'Encomenda',
              'Cancelou a sua encomenda com sucesso',
              'success'
            )
        </script>

        <?php
}
}


if(isset($_POST['atualizar_morada_entrega'])){

                       $atualizar="update morada set nif='".$_POST['nif']."', morada='".$_POST['morada']."', telemovel='".$_POST['telemovel']."', cod_postal='".$_POST['cod_postal']."', nome='".$_POST['nome']."' where cod_morada='".$_POST['cod_morada']."'";
               
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


if(isset($_POST['atualizar_morada_faturacao'])){

						if($_POST['empresa']){

                       $atualizar="update faturas set nif='".$_POST['nif']."', morada='".$_POST['morada']."', telemovel='".$_POST['telemovel']."', cod_postal='".$_POST['cod_postal']."', empresa='".$_POST['empresa']."' where cod_fatura='".$_POST['cod_fatura']."'";
                        }else{
                        	  $atualizar="update faturas set nif='".$_POST['nif']."', morada='".$_POST['morada']."', telemovel='".$_POST['telemovel']."', cod_postal='".$_POST['cod_postal']."', nome='".$_POST['nome']."' where cod_fatura='".$_POST['cod_fatura']."'";
                        }
             
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

if(isset($_POST['adicionar_morada_faturas'])){

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

if(isset($_POST['adicionar_morada'])){


   $insere="insert morada (id,nif,morada,localidade,telemovel,cod_postal,nome) values
                    
                    ('".$_SESSION['id']."','".$_POST['nif']."','".$_POST['morada']."','".$_POST['localidade']."','".$_POST['telemovel']."','".$_POST['cod_postal']."','".$_POST['nome']."');";

                  
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
	

    if(isset($_POST['submit_confirmar_dados'])){
   $flag=false;
   $flag_email=false;
   $flag_pass=false;
   $name=$_POST['name'];
  
   $email=$_POST['email'];
   $pass=$_POST['pass'];


   $pass=md5($pass);
   
   $query="select pass from users where id='".$_SESSION['id']."'";
   $result=mysqli_query($ligax,$query);
   $registo=mysqli_fetch_assoc($result);
   $passdBD=$registo['pass'];
     if(($passdBD!=$pass)){
		 $flag=true;
		 $flag_pass=true;
	 }
   
   $query="select id from users where email='".$email."';";
   $result=mysqli_query($ligax,$query);
   $n=mysqli_num_rows($result);
   
   if($n>0){
	   $registo=mysqli_fetch_assoc($result);
	   $idBD=$registo['id'];
	   if($idBD!=$_SESSION['id']){
		   $flag=true;
		   $flag=true;
	   }
   }
   
   if($flag==true){
	    if($flag_pass==true){?>
		<script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("A palavra passe inserida está incorreta!");
		</script>
		<?php }
   }else{
	   if($flag_email==true) {?>
	   <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("O email atribuído está associado a outra conta!");
	   </script>
	   
	     <?php
		 
	   }else{
		   
		   $atualizar="update users set name='".$name."', email='".$email."' where id='".$_SESSION['id']."'";
		   $result=mysqli_query($ligax,$atualizar);

		   if($result==1){
		   		
	//NEWSLETTER



   if(isset($_POST['newsletter'])) { //está checked

   	 $subscricao="select subscricao from newsletter where email='".$_SESSION['email']."'";
   $result=mysqli_query($ligax,$subscricao);
   $n=mysqli_num_rows($result);
   if($n>0){
   $registo=mysqli_fetch_assoc($result);
	$subscricao=$registo['subscricao'];
   	if($subscricao==0) { $query="update newsletter set subscricao=1 where email='".$_SESSION['email']."'";  $result1=mysqli_query($ligax,$query);}
   	if($subscricao==1) { } //está subscrito

   }else{
   	
   	$query="insert into newsletter (email, subscricao) values ('".$_SESSION['email']."','1')";
   	 $result1=mysqli_query($ligax,$query);
   }


   } else { //não está checked
$subscricao="select subscricao from newsletter where email='".$_SESSION['email']."'";
   $result=mysqli_query($ligax,$subscricao);
   $n=mysqli_num_rows($result);
   if($n>0){
   $registo=mysqli_fetch_assoc($result);
	$subscricao=$registo['subscricao'];
   	if($subscricao==1) { $query="update newsletter set subscricao=0 where email='".$_SESSION['email']."'";  $result1=mysqli_query($ligax,$query);}
   	if($subscricao==0) { } // não está subscrito

   }
}

			   if($_FILES['foto']['error']==0){
				   $file_name=$_FILES['foto']['name'];
				   $file_type=$_FILES['foto']['type'];
				   $file_size=$_FILES['foto']['size'];
				   $file_tmp=$_FILES['foto']['tmp_name'];
				   $data=base64_encode(file_get_contents($file_tmp));
				   $query="update users set foto_nome='".$file_name."',foto_tipo='".$file_type."',
				   foto_tamanho='".$file_size."',foto_dados='".$data."' where id='".$_SESSION['id']."'";
				   $result_up=mysqli_query($ligax,$query);
			   }
			   ?>
			   <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["success"]("Edição de perfil realizada com sucesso");
			   </script>
			   
			   <?php
		   }else{ ?>
		     <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("Não foi possível inserir os dados!");
			 </script>
		   <?php }
	   }
	}
}			   
				   
	?>
	
	<?php
		
	if(isset($_POST['submit_alterar_pass'])){
		
		$flag=false;
		$flag_email=false;
		$flag_pass=false;
		$pass=$_POST['pass'];
		$pass = md5($pass);
		$pass_nova =$_POST['passnova'];
		$conf_pass_nova =$_POST['confpassnova'];
		
		//comparar as passes
		 if($pass_nova!=$conf_pass_nova){
			   ?>

			   <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["warning"]("Palavras passes não são iguais");
			   </script>
			  <?php
		   } else {
		
		
		$pass_nova = md5($pass_nova);
		
		
		$query="select pass from users where id='".$_SESSION['id']."'";
		$result= mysqli_query($ligax,$query);
		$registo=mysqli_fetch_assoc($result);
		$passbd=$registo['pass'];
			if(($passbd!=$pass)){
				$flag=true;
				$flag_pass=true;
			}
			
		
		
	if($flag==true){
		if($flag_pass==true) { ?>
		<script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("Palavra passe antiga está incorreta!");
	
		</script>
		<?php
		}
		
 } else {
		   
		   $atualizar="update users set pass='".$pass_nova."' where id='".$_SESSION['id']."'";
		 //echo $atualizar;
		   $result=mysqli_query($ligax,$atualizar);
		   
		  if($result=1){
			   ?>
			   <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["success"]("Palavra passe alterada com sucesso!");
			   </script>
			   <?php
		   }else{ ?>
		     <script>
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
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("Não foi possível inserir os dados!");
			 </script>
		   <?php }
	   }
	}
	}	   
	



	$query="select * from users where id='".$_SESSION['id']."'";
	$result=mysqli_query($ligax,$query);
	$registo=mysqli_fetch_assoc($result);
	$name=$registo['name'];
	
	$id=$registo['id'];
	
	$email=$registo['email'];
	
?>	
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

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Minha Conta<span></span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-1.php">Casa</a></li>
                        <li class="breadcrumb-item"><a href="#">Loja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Minha Conta</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="dashboard">
	                <div class="container">
	                	<div class="row">
	                		<aside class="col-md-4 col-lg-3">
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Encomendas</a>
								    </li>
								    
								    <li class="nav-item">
								        <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Moradas</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#editar-perfil" role="tab" aria-controls="tab-account" aria-selected="false">Editar Perfil</a>
								    </li>
								    <li class="nav-item">
									<li class="nav-item">
								        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#editar-pass" role="tab" aria-controls="tab-account" aria-selected="false">Editar Password</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" href="logout.php">Log Out</a>
								    </li>
								</ul>
	                		</aside><!-- End .col-lg-3 -->

	                		<div class="col-md-8 col-lg-9">
	                			<div class="tab-content">
								    <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
								    	<p>Olá <span class="font-weight-normal text-dark"><?php echo $_SESSION['name']; ?></span> (Não é a sua <span class="font-weight-normal text-dark">Conta</span>? <a href="logout.php">Log out</a>) 
								    	<br>
								    	A partir do painel de controlo da sua conta, pode ver as suas <a href="#tab-orders" class="tab-trigger-link link-underline">encomendas recentes</a>, gerir as suas <a href="#tab-address" class="tab-trigger-link">moradas de envio e faturação</a> e <a href="#editar-perfil" class="tab-trigger-link">editar os detalhes da conta</a>.</p>
								    </div><!-- .End .tab-pane -->

								    <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                        
                                        <?php
                                        $select_encomenda="select * from encomenda where id='".$_SESSION['id']."'";
                                        $resultado=mysqli_query($ligax,$select_encomenda);
                                        if(mysqli_num_rows($resultado) > 0){
                                            while($registo2=mysqli_fetch_assoc($resultado)){
                                            $cod_encomenda=$registo2['cod_encomenda'];
                                            $data_encomenda=$registo2['data_encomenda'];
                                            $modo_entrega=$registo2['modo_entrega'];
                                            $estado=$registo2['estado'];
                                        
                                            ?>

                                            <div class="row">
                                              <div class="col-lg-6">
                                                <div class="card card-dashboard">
                                                  <div class="card-body">
                                                    <div style="float:right">
<a  target="_blank" href="fatura/fatura.php?cod_encomenda=<?php echo $cod_encomenda; ?>">Fatura<i class="fa fa-file-pdf"></i></a></div>
                                                    <h3 class="card-title">Encomenda - <?php echo $cod_encomenda; ?> </h3>

                                                    <!-- End .card-title -->
                                                    <br>
                                                    <p><b>Modo de Entrega:</b> <?php if($modo_entrega==0){ echo 'Levantamento em Loja'; } else { echo 'Envio para endereço.'; } ?>
                                                    </p>
                                                     <p><b>Estado da Encomenda:</b> <?php if($estado==0){ echo 'Encomenda por processar.'; } elseif($estado==1) { echo 'Encomenda em processamento.'; }elseif($estado==2){echo 'Encomenda pronta para recolha em loja.';}elseif($estado==3){echo 'Encomenda entregue.';}elseif($estado==4){echo 'Encomenda cancelada.';} ?> </p>
                                                    <p><?php if ($estado == 0) { ?>
  <form method="POST">
    <input type="hidden" name="cod_encomenda" value="<?php echo $cod_encomenda; ?>">
    <button class="btn btn-outline-primary-2" name="atualizar_estado_encomenda">Cancelar Encomenda <i class="fa fa-trash"></i></button>
  </form>
<?php } ?></p>
 <?php echo $data_encomenda; ?>
                                                    

                                                  </div>
                                                    </div>
                                              </div>
                                            </div>

                                                  <!-- End .card-body -->
                                              <?php } }else{ ?>
                                                    <p>Ainda não foi feita uma encomenda.</p>
                                        <a href="index.php?pesquisa_produtos=" class="btn btn-outline-primary-2"><span>ENCOMENDE AGORA</span><i class="icon-long-arrow-right"></i></a>
                                              <?php } ?>
                                              
                                          
								    	
								    </div><!-- .End .tab-pane -->

								   

								    <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
								    	<p>Por defeito, serão utilizados os seguintes endereços na página de checkout.</p>

								    	<div class="row">
								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
	<?php
	$select_morada = "SELECT * FROM faturas WHERE id='" . $_SESSION['id'] . "' LIMIT 1";
	$result = mysqli_query($ligax, $select_morada);

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
	<div class="card-body">
		<h3 class="card-title">Morada de Faturação</h3><!-- End .card-title -->
		<p>
			<?php if(isset($empresa)) echo $empresa; else echo $nome; ?><br>
			PT: <?php echo $nif; ?><br>
			<?php echo $morada; ?><br>
			<?php echo $telemovel; ?><br>
			<?php echo $localidade; ?><br>
			<a href="#fatura-modal<?php echo $count; ?>" data-toggle="modal">Editar <i class="icon-edit"></i></a>
		</p>
	</div><!-- End .card-body -->
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
                                        	<input type="hidden" name="cod_fatura" value="<?php echo $cod_fatura; ?>">
                                            <center>
                                            <div class="grid grid-cols-2 col-start-1 col-end-3 max-w-sm form-group" style="grid-template-columns: repeat(2,minmax(0,1fr));max-width: 24rem;display: grid;">
                                                  <div class="flex items-center">
                                                    <input type="radio" id="private" name="addressType" value="private"  onclick="mostrarDiv(['div1'])">
                                                    <label for="private" class="font-semibold pl-6 cursor-pointer">Particular</label>
                                                  </div>
                                                  <div class="flex items-center">
                                                    <input type="radio" id="enterprise" name="addressType" value="enterprise" onclick="mostrarDiv(['div2'])">
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

                                            <div class="form-group-container" style="display: flex;column-gap: 3rem;">
                                                <div class="form-group" style="width: 9rem;">
                                                    <label for="indicativo<?php echo $count; ?>">Indicativo</label>
                                                    <input type="text" class="form-control" id="indicativo<?php echo $count; ?>" name="indicativo" value="<?php if (isset($indicativo)) echo $indicativo;else {echo '+351';} ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telemovel<?php echo $count; ?>">Telemóvel *</label>
                                                    <input type="number" class="form-control" id="telemovel<?php echo $count; ?>" name="telemovel" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" value="<?php if (isset($telemovel)) echo $telemovel; ?>" required>
                                                </div>
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group">
                                                <label for="nif<?php echo $count; ?>">NIF *</label>
                                                <input type="text" class="form-control" id="nif<?php echo $count; ?>" name="nif" value="<?php if (isset($nif)) echo $nif; ?>" pattern="^[A-Za-z0-9]*\d+[A-Za-z0-9]*$">
                                            </div>
                                            </div>

                                            <div id="div2" class="hidden">
                                           
                                            <div class="form-group ">
                                                <label for="nome<?php echo $count; ?>">Empresa *</label>
                                                <input type="text" class="form-control " id="empresa<?php echo $count; ?>" name="empresa" value="<?php if (isset($empresa)) echo $empresa; ?>" required>
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
                                                <div class="form-group" style="width: 9rem;">
                                                    <label for="indicativo<?php echo $count; ?>">Indicativo*</label>
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
                                                <button type="submit" name="atualizar_morada_faturacao" class="btn btn-outline-primary-2">
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
	<?php
	    }
	} else {
	?>
	<div class="card-body">
		<h3 class="card-title">Morada de Faturação</h3><!-- End .card-title -->
		<p>Ainda não definiu este tipo de endereço.<br>
			<a href="#fatura-modal" data-toggle="modal">Criar <i class="icon-edit"></i></a>
		</p>
	</div><!-- End .card-body -->

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
                <form action="" method="POST">
                  <center>
                                             <div class="grid grid-cols-2 col-start-1 col-end-3 max-w-sm form-group" style="grid-template-columns: repeat(2,minmax(0,1fr));max-width: 24rem;display: grid;">
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
                                          <div id="div3" class="hidden">
                                            <div class="form-group" >
                                                <label for="nome">Nome *</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['name']; ?>" required>
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
  <div class="form-group" style="width: 9rem;">
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
                                            </div>

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
  <div class="form-group" style="width: 9rem;">
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
                                            </div>
                                            <br>
                                            <br>

                  <br>
                  <br>
                  <div class="form-footer">
                    <button type="submit" name="adicionar_morada_faturas" class="btn btn-outline-primary-2">
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

      

	<?php
	}
	?>
</div><!-- End .card-dashboard -->

								    		</div><!-- End .col-lg-6 -->

								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
                                                    <?php
    $select_morada = "SELECT * FROM morada WHERE id='" . $_SESSION['id'] . "' LIMIT 1";
    $result = mysqli_query($ligax, $select_morada);

    if (mysqli_num_rows($result) > 0) {
        $count = 0; // Initialize counter
        while ($registo = mysqli_fetch_assoc($result)) {
            $cod_morada = $registo['cod_morada'];
            $nif = $registo['nif'];
            $localidade = $registo['localidade'];
            $telemovel = $registo['telemovel'];
            $cod_postal = $registo['cod_postal'];
            $nome = $registo['nome'];
            $morada = $registo['morada'];
            
            $count++; // Increment counter
    ?>
								    				<div class="card-body">
								    					<h3 class="card-title">Morada de Entrega</h3><!-- End .card-title -->

													<p>
			<?php echo $nome; ?><br>
			PT: <?php echo $nif; ?><br>
			<?php echo $morada; ?><br>
			<?php echo $telemovel; ?><br>
			<?php echo $localidade; ?><br>
			<a href="#morada-modal<?php echo $count; ?>" data-toggle="modal">Editar <i class="icon-edit"></i></a>
		</p>
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
	   <!-- modal -->

       
       <div class="modal fade" id="morada-modal<?php echo $count; ?>" tabindex="-1" role="dialog" aria-hidden="true">

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
                                        <a class="nav-link active" id="morada-tab" data-toggle="tab" href="#morada" role="tab" aria-controls="morada" aria-selected="true">Dados de Entrega</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-content-5">
                                    <div class="tab-pane fade show active" id="morada" role="tabpanel" aria-labelledby="morada-tab">
                                        <form action="" method="POST">
                                          
                                            <div class="form-group">
                                                <label for="nome<?php echo $count; ?>">Nome *</label>
                                                <input type="text" class="form-control" id="nome<?php echo $count; ?>" name="nome" value="<?php echo $nome; ?>" required>
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
                                                <div class="form-group" style="width: 9rem;">
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
	<?php
	    }
	} else {
	?>
	<div class="card-body">
		<h3 class="card-title">Morada de Entrega</h3><!-- End .card-title -->
		<p>Ainda não definiu este tipo de endereço.<br>
			<a href="#morada-modal" data-toggle="modal" >Criar <i class="icon-edit"></i></a>
		</p>
	</div><!-- End .card-body -->

    <div class="modal fade" id="morada-modal" tabindex="-1" role="dialog" aria-hidden="true">
 
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
                <a class="nav-link active" id="morada-tab" data-toggle="tab" href="#morada" role="tab" aria-controls="morada" aria-selected="true">Dados de Entrega</a>
              </li>
            </ul>
            <div class="tab-content" id="tab-content-5">
              <div class="tab-pane fade show active" id="morada" role="tabpanel" aria-labelledby="morada-tab">
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="nome1">Nome *</label>
                    <input type="text" class="form-control" id="nome1" name="nome" value="<?php echo $_SESSION['name']; ?>" required >
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
  <div class="form-group" style="width: 9rem;">
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
                  <div class="form-footer">
                    <button type="submit" name="adicionar_morada" class="btn btn-outline-primary-2">
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

	<?php
	}
	?>
								    				</div><!-- End .card-body -->
								    			</div><!-- End .card-dashboard -->
								    		</div><!-- End .col-lg-6 -->
								    	</div><!-- End .row -->
								    </div><!-- .End .tab-pane -->
									

									<?php
									$query="select * from users where id='".$_SESSION["id"]."'";
									$result=mysqli_query($ligax,$query);
									$registo=mysqli_fetch_assoc($result);
									$name=$registo['name'];
									$email=$registo['email'];
									
									
									$password=$registo['pass'];
									?>

								    <div class="tab-pane fade" id="editar-perfil" role="tabpanel" aria-labelledby="tab-account-link">
								    	<form action="" method="POST" enctype="multipart/form-data">
			                				<div class="row">
			                				<div class="col-lg-6">
                          <div class="card card-dashboard">
                            <div class="card-body">
                              <h3 class="card-title">Foto</h3><!-- End .card-title -->

                            <img src="showfile_fotoperfil.php?id=<?php echo $id;?>" width="60%"><br>

                           
                           </p>
                            </div><!-- End .card-body -->
                          </div><!-- End .card-dashboard -->
                        </div><!-- End .col-lg-6 -->


											   <div class="col-lg-6">
                          <div class="card card-dashboard">
                            <div class="card-body">
                              <h3 class="card-title">Perfil</h3><!-- End .card-title -->
 <label>Nome:</label>
                             <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>">
<br>
                           
                              <label>Endereço de Email:</label>
                          <input type="email" class="form-control" name="email"  id="email" value="<?php echo $email ?>" required="required"><br>
                       
                            <label>Foto de Perfil:</label>
                      <br>
                           
                            <input type="file" class="form-input" name="foto" id="foto"><br>
                            <br>
                  
                            <div class="custom-control custom-checkbox">
                    <?php 
                      /* Verificar se ta subscrito */
                         $subscricao="select subscricao from newsletter where email='".$_SESSION['email']."'";
                         $result=mysqli_query($ligax,$subscricao);
                         $n=mysqli_num_rows($result);
                         if($n>0){
                         $registo=mysqli_fetch_assoc($result);
                        $subscricao=$registo['subscricao'];
                              if($subscricao==1){ ?>
                                                <input type="checkbox" class="custom-control-input" name="newsletter" value="1" id="signin-remember" checked="checked">
                              <?php } 
                              else{
                                ?>
                              <input type="checkbox" class="custom-control-input" name="newsletter" value="0" id="signin-remember">
                            <?php }
                         }                            ?>
                              
                                                <label class="custom-control-label" for="signin-remember">Subscrito na Newsletter</label>
                                            </div><!-- End .custom-checkbox -->
                      
                      

                              <button type="submit" name="submit_confirmar_dados" href="#verify-modal" data-toggle="modal" class="btn btn-outline-primary-2">
                                <span>Salvar Alterações</span>
                              <i class="icon-long-arrow-right"></i>
                              </button>
                                
                           
                           </p>
                            </div><!-- End .card-body -->
                          </div><!-- End .card-dashboard -->
                        </div><!-- End .col-lg-6 -->
											<br>



										
			                				</div>

		            					</div>
		                			
					 <div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls=" in" aria-selected="true">Verificar Sessão</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                               
                                        <div class="form-group">
                                            <label for="singin-password">Palavra Passe *</label>
                                            <input type="password" class="form-control" id="singin-password" name="pass" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" name="submit_confirmar_dados" class="btn btn-outline-primary-2">
                                                <span>Verificar </span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            
                                        </div><!-- End .form-footer -->
                                    
                                  
                             

                                 
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->
  
                            </form>
											
											
<br><br>
										
											
											
									
									
									

									
									 <div class="tab-pane fade" id="editar-pass" role="tabpanel" aria-labelledby="tab-account-link">
								    	<form action="" method="POST">
			                				<div class="form-group">
			                					
											</div><!-- End .row -->

		            				  		<label>Palavra Passe Atual</label>
		            						<input type="password" class="form-control" placeholder="Password antiga" name="pass" id="" required="required">

		            						<label>Nova Palavra Passe</label>
		            						<input type="password" class="form-control" placeholder="Nova password" name="passnova" id="" required="required">

		            						<label>Confirmar Nova Palavra Passe</label>
		            						<input type="password" class="form-control" placeholder="Confirmar a nova password" name="confpassnova" id="" required="required">

		                					<button type="submit" name="submit_alterar_pass" class="btn btn-outline-primary-2">
			                					<span>Salvar Alterações  </span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>
                              </form>
								    </div><!-- .End .tab-pane -->
							
	                		</div><!-- End .col-lg-9 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div><!-- End .page-content -->
	</main><!-- End .main -->


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