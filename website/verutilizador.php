<?php include("ligacao.php"); ?>

<?php
if(isset($_POST['atualizar'])){

$perfil=$_POST['perfil_util'];

											$estado=$_POST['estado'];
											$atualizar="UPDATE users set perfil='".$perfil."', estado='".$estado."' where id='".$_GET['id']."'";
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

                        toastr["success"]("Edição realizada com sucesso")

											  	</script>
											  	<?php
										   }else{ 
										   	?>
										   	<script>
											alert("Variavel de perfil nao atualizada.");
											</script>
											<?php
										   }
										}   
										?> 
 

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="author" content="M_Adnan">

    <script src="assets/js/jquery-3.6.1.js"></script>
                              <script src="assets/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/toastr.min.css">
      <script src="assets/js/toastr.js"></script>

<link rel="stylesheet" href="assets/css/bootstrap.min1.css">


<script src="assets/js/6d44596129.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/style1.css">

<!-- FontsOnline -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

</head>


<!-- Page Wrapper -->
<div id="wrap"> 

  <?php
  $consulta="SELECT * FROM users where id='".$_GET['id']."'";
 $result=mysqli_query($ligax,$consulta);
   if($result){
	 $n=mysqli_num_rows($result);
	 if($n>0) {
  ?>
  <!-- Content -->
  <main class="cd-main-content">
    <div id="content">
      <div class="resume">
        <div class="container"> 
          
          <!-- TOP HEAD -->
          <div class="top-head">
            <div class="row">
              <div class="col-sm-6">
                <h4>Detalhes da Conta </h4>
               </div>
            </div>
          </div>
              <!-- NAV LINKS END -->
          <?php
		  
		  while($registo=mysqli_fetch_assoc($result)){
	$id=$registo['id'];
	$name=$registo['name'];
	$email=$registo['email'];
	$perfil=$registo['perfil'];
	$estado=$registo['estado'];
	$morada=$registo['morada'];
	$cod_postal=$registo['cod_postal'];
	$telemovel=$registo['telemovel'];
	$localidade=$registo['localidade'];
	$pais=$registo['pais'];
	$nif=$registo['nif'];
	
	
	
	?>
          <!-- Resume -->
          <div class="row"> 
            
            <!-- Sidebar -->
            <div class="col-md-4">
              <div class="side-bar"> 
                
                <!-- Professional Details -->
                <h5 class="tittle">Foto</h5>
				<center>
                <img src="showfile_fotoperfil.php?id=<?php echo $id;?>" class="img-responsive" width="56%" alt="">
                </center>
               
              </div>
            </div>
            
            <!-- MAIN CONTENT -->
            <div class="col-md-8"> 
              
              <div class="tab-content"> 
                
                <!-- ABOUT ME -->
                <div role="tabpanel" class="tab-pane fade in active" id="about-me">
                  <div class="inside-sec"> 
                    <!-- BIO AND SKILLS -->
                    <h5 class="tittle">Perfil</h5>
                    
                    <!-- Blog -->
                    <section class="about-me padding-top-10"> 
                      <form action="" method="POST" enctype="multipart/form-data">
                      <!-- Personal Info -->
                      <ul class="personal-info">
                        <li>
                          <p> <span> Nome</span> <?php echo $name;?> </p>
                        </li>
                       
						
                        <li>
                          <p> <span> Localidade</span> <?php echo $localidade;?>  </p>
                        </li>
						
                        <li>
						   <p> <span> Morada</span> <?php echo $morada;?>  </p>
                        </li>
						<br><br>
                        <li>
						<p> <span> Código Postal</span> <?php echo $cod_postal;?>  </p>
                        
                        </li>
                        <li>
                          <p> <span> País</span> <?php echo $pais;?>  </p>
                        </li>
						<br><br>
                        <li>
                          <p> <span> Telemóvel</span> (+351) <?php echo $telemovel;?>  </p>
                        </li>
                        <li>
						  <p> <span> NIF </span> <?php echo $nif;?>  </p>
                        </li>
						<br><br>
                        <li>
                          <p> <span> E-mail</span> <a href="#."> <?php echo $email?> </a> </p>
                        </li>
                        <li>
						<p> <span>Perfil</span>
						 <?php 
                                if($perfil==3){ ?>
								<select id="selecao" name="perfil_util" class="form-control" >
                                            <option value="3" selected disabled >Fundador</option> 
								</select>
						<?php			
                                } else { ?>
										 
							<select id="selecao" name="perfil_util" class="form-control">
								<option value="0" <?php if($perfil==0) echo "selected" ?>>Não autenticado</option> 
                                <option value="1" <?php if($perfil==1) echo "selected" ?>>Cliente</option> 
                                <option value="2" <?php if($perfil==2) echo "selected" ?>>Admin</option> 
                                <option value="4" <?php if($perfil==4) echo "selected" ?>>Banido</option> 
						  
							</select>
						<?php
										
                                  
                                  }
											?>
                            </p> 
                        </li>
						<li>
							<p> <span> Estado</span> 
							<select id="selecao" name="estado" class="form-control">
								<option value="1" <?php if($estado==1) echo "selected" ?>>Ativo</option> 
                <option value="0" <?php if($estado==0) echo "selected" ?>>Inativo</option> 
                               
							</select>
						  </p> 
						  
						  <br><br>
						  </li>
						  
						<style type="text/css">
					
}

						</style>
						
						
						 <button name="atualizar" >Atualizar<a type="submit" class="button" name="atualizar" onclick="return onclick()" value="Ola"></a></button>						
					
                      
					  </ul>
                      
                     
                      
                    </form>
                    </section>
					<?php
	 }
	 }
	 
   }
				
					  ?>
					  
                  </div>
				 
                </div>
              
              </div>
            </div>
			
          </div>
		  <br><br><br>
			 <a href="listarutilizadores.php"><font style="font-size: 20px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</font></a>
        </div>
      </div>
    </div>
  </main>
  <!-- End Content --> 
  

  
</div>
<!-- End Page Wrapper --> 

