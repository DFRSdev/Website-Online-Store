<?php 

 if(isset($_POST["encomendar"])){
    if(isset($_POST['modo_entrega'])){
    $consulta="select * from carrinho where (cc_id like '".$_SESSION['id']."' or cc_sessionid like '".session_id()."');";
    $resultado=mysqli_query($ligax,$consulta);
     if($re=mysqli_fetch_assoc($resultado)!=0){
                //É criado o registo da encomenda na tabela encomenda

                if($_POST['modo_entrega']=="1"){
                $insere="insert into encomenda (data_encomenda,id,modo_entrega,cod_morada) values (NOW(),'".$_SESSION["id"]."','".$_POST['modo_entrega']."','".$_POST['cod_morada']."')";
                }else{
                     $insere="insert into encomenda (data_encomenda,id,modo_entrega) values (NOW(),'".$_SESSION["id"]."','".$_POST['modo_entrega']."')";
                }
                mysqli_query($ligax,$insere) || die(mysqli_error($ligax));
                 $order_id=mysqli_insert_id($ligax); //ultimo registo inserido
                 

                  //São inseridos na tabela encomenda_produto os produtos que se encontram no carrinho
                $insere="insert into item_encomenda (cod_encomenda,cod_produto,quantidade, preco_venda) Select $order_id, carrinho.cc_cod_produto, carrinho.cc_quantidade, produtos.preco from carrinho, produtos where carrinho.cc_cod_produto like produtos.cod_produto and carrinho.cc_sessionid like '".session_id()."';";
               
                 mysqli_query($ligax,$insere) || die(mysqli_error($ligax));

             
                 ?>
                            <script>
                           Swal.fire({
    title: 'Encomenda',
    html: 'Irá ser redirecionado para a página de faturação<br>Para completar a sua encomenda.',
    icon: 'success'
  });

  setTimeout(() => {
    location.href = "index.php?page=checkout_faturacao";
  }, 2000);
                            </script>
                            <?php
               
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
        }else{
             ?>
        <script type="text/javascript">
            Swal.fire(
              'Checkout',
              'Selecione pelo menos uma das opções abaixo.',
              'warning'
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


if (isset($_POST['cod_morada'])) {
    $codMorada = $_POST['cod_morada'];

    // Faça o processamento necessário com o valor de $codMor
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
                        <li class="breadcrumb-item active" aria-current="page">Checkout - Entrega</li>
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
            <p>Por favor, escolhe aqui se pretendes receber a tua encomenda numa morada à tua escolha ou se pretendes levantar a mesma na nossa loja física.</p>
          </div>
          <ul class="grid gap-6 mb-12 md:grid-cols-2 wrapper_cols_1" ><div class="div-wrapper"><div class="div-content">
            <li class="bg-background-off rounded flex-grow flex justify-start items-center p-5 md:py-11 md:px-8 shadow-md summary" style="float:left;width: 75%;">
            	
              <input type="radio" name="modo_entrega" value="1" class="flex-shrink-0" onclick="mostrarDiv(['div1', 'div3', 'div9']);" >



              <label for="shipToAddress" class="flex items-center font-bold cursor-pointer md:text-lg" style="font-size:16px;">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mx-3 text-primary md:mx-5">
                  <path d="M25 15V25H33.3333V18.3333L30 15H25Z" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linejoin="round"></path>
                  <rect x="6.66663" y="10" width="18.3333" height="15" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round"></rect>
                  <circle cx="11.6667" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
                  <circle cx="28.3333" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
                </svg>Desejo receber a encomenda numa morada </label>
            </li></div></div>
           
            <div class="div-wrapper"><div class="div-content">
            <li class="bg-background-off rounded flex-grow flex justify-start items-center p-5 md:py-11 md:px-8 shadow-md summary" style="float:left;width: 75%;">
              <input type="radio" name="modo_entrega" value="0" class="flex-shrink-0" onclick="mostrarDiv(['div2']); handleRadioClick.call(this);">
              <label for="shipToStore" class="flex items-center font-bold cursor-pointer md:text-lg" style="font-size:16px;">
                <svg width="28" height="28" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary mx-3 md:mx-5 flex-shrink-0 ">
                  <path d="M25.6666 31.6676H2.33329C1.41282 31.6676 0.666626 30.9214 0.666626 30.0009V13.9292C0.692445 13.5208 0.866025 13.1357 1.15496 12.8459L12.8216 1.17924C13.1342 0.866279 13.5584 0.69043 14.0008 0.69043C14.4431 0.69043 14.8673 0.866279 15.18 1.17924L26.8466 12.8459C27.1595 13.158 27.3347 13.5823 27.3333 14.0242V30.0009C27.3333 30.9214 26.5871 31.6676 25.6666 31.6676ZM14 4.71424L3.99996 14.7142V28.3342H24V14.7142L14 4.71424ZM11.5 25.9326L6.98996 21.4326L9.33329 19.0692L11.5 21.2226L18.6666 14.0692L21.02 16.4292L11.5 25.9309V25.9326Z" fill="currentColor"></path>
                </svg>
                
                  <span class="">Desejo levantar a encomenda em loja</span>
                
              </label>
            </li></div></div>
          </ul>
        </div>
        <div class="pb-6 hidden" id="div1">
          <h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Onde devemos entregar a encomenda?</h1>
          <br>
          <div class="px-4 py-6 mb-10 rounded bg-background-off md:p-6" style="width: 155%;">
            <ul class="mb-6 grid tablet:grid-cols-2 xl:grid-cols-3 gap-6">
              



<?php
$select_morada = "SELECT * FROM morada WHERE id='" . $_SESSION['id'] . "'";
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

        <li class="flex flex-col justify-between transition p-5 rounded-r3 border-2 bg-background-off filter border-border-color cursor-pointer hover:shadow-md" >


 
            <div class="flex items-start justify-between">
                <div class="flex flex-col text-sm break-words max-w-198" style="font-size:14px;">

                    <span><?php echo $nome; ?></span>
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
           
  <input type="radio" name="cod_morada" class="morada-input" value="<?php echo $cod_morada; ?>" required>
 

                
                
            </div>
            <div class="flex items-center justify-between pt-4">
               
                <a href="#morada-modal<?php echo $count; ?>" data-toggle="modal" class="my-account-icons-hover rounded-full p-2">
                     <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-xl text-primary"> <path d="M4.41999 20.5787C4.13948 20.5782 3.87206 20.4599 3.68299 20.2527C3.49044 20.0471 3.39476 19.7692 3.41999 19.4887L3.66499 16.7947L14.983 5.48066L18.52 9.01666L7.20499 20.3297L4.51099 20.5747C4.47999 20.5777 4.44899 20.5787 4.41999 20.5787ZM19.226 8.30966L15.69 4.77366L17.811 2.65266C17.9986 2.46488 18.2531 2.35938 18.5185 2.35938C18.7839 2.35938 19.0384 2.46488 19.226 2.65266L21.347 4.77366C21.5348 4.96123 21.6403 5.21575 21.6403 5.48116C21.6403 5.74657 21.5348 6.00109 21.347 6.18866L19.227 8.30866L19.226 8.30966Z" fill="currentColor"></path></svg>
                </a>
            </div>
         
        </li>


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
    echo 'Não possuí uma morada associada à sua conta.';
} ?>

            </ul>
            <a href="#morada-modal" data-toggle="modal" data-testid="button-component" class="with-tab ">
              <span class="flex items-center  text-sm underline text-primary font-bold gap-x-1" style="font-size:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 22H4C2.89543 22 2 21.1046 2 20V8H4V20H16V22ZM20 18H8C6.89543 18 6 17.1046 6 16V4C6 2.89543 6.89543 2 8 2H20C21.1046 2 22 2.89543 22 4V16C22 17.1046 21.1046 18 20 18ZM8 4V16H20V4H8ZM15 14H13V11H10V9H13V6H15V9H18V11H15V14Z" fill="currentColor"></path>
                </svg>Adicionar novos Dados de Entrega </span>
            </a>
          </div>
        </div>
        <!-- modal -->
        
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

      


        <div class="pb-6 hidden" id="div2"><h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Abaixo pode verificar onde se encontra a nossa loja física</h1><br><iframe width="710" height="344" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=710&amp;height=344&amp;hl=en&amp;q=Miguel%20E%20Alex%20Telem%C3%B3veis%20E%20Comunica%C3%A7%C3%B5es%20S%C3%A3o%20Paio%20de%20Oleiros+(Miguel%20E%20Alex%20Telem%C3%B3veis%20E%20Comunica%C3%A7%C3%B5es)&amp;t=&amp;z=19&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href='https://maps-generator.com/'></a>
</div>
       
   
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
                           
                                           
                                
                             <tr class="summary-shipping-estimate ">
  <td>Transportadora:</td>

    <?php
    if ($preco_total_produto1 > 100) {
      echo '<td>€0.00</td>';
    } else {
      echo '<td>€4.90</td>';
    }
    ?>
  
</tr><!-- End .summary-shipping-estimate -->

                             
                             

	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>€<?php if($preco_total_produto1>100) echo $preco_total_produto1; else{echo $preco_total_produto1+4.9;} ?></td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->
                                    
	                				<button name="encomendar" class="btn btn-outline-primary-2 btn-order btn-block">Proceder para Faturação</button>
	                			</div><!-- End .summary -->
<div id="div3" class="hidden">
	                			
	                		<br><br><br><br><h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Método de Envio</h1><br>

                      <ul class="shipping_methods_wrapper">

                        <?php if($preco_total_produto1>100){ ?>
  <li class="flex items-center justify-between bg-background-off rounded mb-6 p-5 md:px-8 shadow-md summary">
    <div class="flex items-center">
      <input type="radio" id="shipping_method_6" name="shipMethods" class="flex-shrink-0 cursor-pointer morada-input" required>
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mx-3 text-primary md:mx-5">
        <path d="M25 15V25H33.3333V18.3333L30 15H25Z" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linejoin="round"></path>
        <rect x="6.66663" y="10" width="18.3333" height="15" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round"></rect>
        <circle cx="11.6667" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
        <circle cx="28.3333" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
      </svg>
      <label class="cursor-pointer" for="shipping_method_6">
        <p class="font-bold">Envio grátis</p>
        <small class="font-13 text-gray-medium2">Envio por CTT Expresso ou Logic, consoante tipo e volume de encomenda.</small>
      </label>
    </div>
    <span class=" md:block">0,00&nbsp;€</span>
  </li>
<?php }else{ ?>
<li class="flex items-center justify-between bg-background-off rounded mb-6 p-5 md:px-8 shadow-md summary">
  <div class="flex items-center">
    <input type="radio" id="shipping_method_6" name="shipMethods" class="flex-shrink-0 cursor-pointer morada-input" required>
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mx-3 text-primary md:mx-5">
      <path d="M25 15V25H33.3333V18.3333L30 15H25Z" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linejoin="round"></path>
      <rect x="6.66663" y="10" width="18.3333" height="15" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round"></rect>
      <circle cx="11.6667" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
      <circle cx="28.3333" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
    </svg>
    <label class="cursor-pointer" for="shipping_method_6">
      <p class="font-bold">Transportadora</p>
      <small class="font-13 text-gray-medium2">Envio por CTT Expresso ou Logic, consoante tipo e volume de encomenda.</small>
    </label>
  </div>
  <span class=" md:block">4,90&nbsp;€</span>
</li>
<?php } ?>
</ul> 
</div>
	                		</aside><!-- End .col-lg-3 -->

		                	</div><!-- End .row -->
            				                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->

        </main>
    </form>
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