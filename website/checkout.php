<link rel="stylesheet" type="text/css" href="https://pcdiga.com/_next/static/css/ab1f8cebf80f6a99568e.css">
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
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Loja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Carrinho de Compras</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            			<div class="checkout-discount">
            				<form action="#">
        						<input type="text" class="form-control" required="" id="checkout-discount-input">
            					<label for="checkout-discount-input" class="text-truncate">Tem um cupão? <span>Clique aqui para inserir</span></label>
            				</form>
            			</div><!-- End .checkout-discount -->
            			<br><br>
            			<form action="#">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			
		                				<h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Dados de faturação</h1>
		                	
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

	            						<div class="z-1 base-container py-5 bg-background pb-28 flex-grow">
  <main>
    <div class="lg:grid lg:grid-cols-checkout gap-x-10 pt-1 pb-10 md:py-5">
      <div class="items-start">
        <div style="width:185%;">
          <div class="flex items-center justify-center p-5 mb-6 text-center rounded bg-background-off md:py-8">
            <p>Por favor, escolhe aqui se pretendes receber a tua encomenda numa morada à tua escolha ou se pretendes levantar a mesma numa das lojas PCDIGA.</p>
          </div>
          <ul class="grid gap-6 mb-12 md:grid-cols-2 wrapper_cols_1">
            <li class="bg-background-off rounded flex-grow flex justify-start items-center p-5 md:py-11 md:px-8 shadow-md">
            	<div class="div-wrapper">
              <input type="radio" id="shipToAddress" name="shipTo" class="flex-shrink-0" onclick="mostrarDiv('div1')">
          </div>
              <label for="shipToAddress" class="flex items-center font-bold cursor-pointer md:text-lg" style="font-size:16px;">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mx-3 text-primary md:mx-5">
                  <path d="M25 15V25H33.3333V18.3333L30 15H25Z" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linejoin="round"></path>
                  <rect x="6.66663" y="10" width="18.3333" height="15" stroke="var(--color-primary)" stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round"></rect>
                  <circle cx="11.6667" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
                  <circle cx="28.3333" cy="28.3333" r="3.33333" stroke="var(--color-primary)" stroke-width="3.33333"></circle>
                </svg><div class="div-content">Desejo receber a encomenda numa morada </div></label>
            </li>
            <li class="bg-background-off rounded flex-grow flex justify-start items-center p-5 md:py-11 md:px-8 ">
              <input type="radio" id="shipToStore" name="shipTo" class="flex-shrink-0 " onclick="mostrarDiv('div2')">
              <label for="shipToStore" class="font-bold md:text-lg cursor-pointer flex items-center" style="font-size:16px;">
                <svg width="28" height="28" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary mx-3 md:mx-5 flex-shrink-0 ">
                  <path d="M25.6666 31.6676H2.33329C1.41282 31.6676 0.666626 30.9214 0.666626 30.0009V13.9292C0.692445 13.5208 0.866025 13.1357 1.15496 12.8459L12.8216 1.17924C13.1342 0.866279 13.5584 0.69043 14.0008 0.69043C14.4431 0.69043 14.8673 0.866279 15.18 1.17924L26.8466 12.8459C27.1595 13.158 27.3347 13.5823 27.3333 14.0242V30.0009C27.3333 30.9214 26.5871 31.6676 25.6666 31.6676ZM14 4.71424L3.99996 14.7142V28.3342H24V14.7142L14 4.71424ZM11.5 25.9326L6.98996 21.4326L9.33329 19.0692L11.5 21.2226L18.6666 14.0692L21.02 16.4292L11.5 25.9309V25.9326Z" fill="currentColor"></path>
                </svg>
                <div class="flex flex-col">
                  <span class=""><div class="div-content">Desejo levantar a encomenda em loja</div></span>
                </div>
              </label>
            </li>
          </ul>
        </div>
        <div class="pb-6 hidden" id="div1">
          <h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl" style="font-size:20px;">Onde devemos entregar a encomenda?</h1>
          <br>
          <div class="px-4 py-6 mb-10 rounded bg-background-off md:p-6" style="width: 185%;">
            <ul class="mb-6 grid tablet:grid-cols-2 xl:grid-cols-3 gap-6">
              <li class="flex flex-col justify-between transition p-5 rounded-r3 border-2 bg-background-off filter border-primary ">
                <div class="flex items-start justify-between">
                  <div class="flex flex-col text-sm break-words max-w-198" style="font-size:14px;">
                    <span>Dário Soares</span>
                    <br>
                    <span>Rua de Sermonde n445</span>
                    <br>
                    <span>4415-115</span>
                    <br>
                    <span>PT</span>
                    <br>
                    <span>T:919792186</span>
                    <br>
                    <span>NIF:262792710</span>
                    <br>
                  </div>
                  <span class="bg-primary text-white w-5 h-5 rounded-2xl flex items-center justify-center">
                    <svg width="1em" height="1em" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-xs flex-shrink-0">
                      <path d="M6.50957 14.3356L0.52832 8.35438L2.2369 6.6458L6.51138 10.9154L6.50957 10.9173L16.7623 0.664551L18.4709 2.37313L8.21815 12.6271L6.51078 14.3344L6.50957 14.3356Z" fill="currentColor"></path>
                    </svg>
                  </span>
                  <input class="hidden flex-shrink-0" type="radio" id="address0" name="addresses" checked="">
                </div>
                <div class="flex items-center justify-end pt-4">
                  <button class="my-account-icons-hover rounded-full p-2">
                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-xl text-primary">
                      <path d="M4.41999 20.5787C4.13948 20.5782 3.87206 20.4599 3.68299 20.2527C3.49044 20.0471 3.39476 19.7692 3.41999 19.4887L3.66499 16.7947L14.983 5.48066L18.52 9.01666L7.20499 20.3297L4.51099 20.5747C4.47999 20.5777 4.44899 20.5787 4.41999 20.5787ZM19.226 8.30966L15.69 4.77366L17.811 2.65266C17.9986 2.46488 18.2531 2.35938 18.5185 2.35938C18.7839 2.35938 19.0384 2.46488 19.226 2.65266L21.347 4.77366C21.5348 4.96123 21.6403 5.21575 21.6403 5.48116C21.6403 5.74657 21.5348 6.00109 21.347 6.18866L19.227 8.30866L19.226 8.30966Z" fill="currentColor"></path>
                    </svg>
                  </button>
                </div>
              </li>
            </ul>
            <button data-testid="button-component" class="with-tab ">
              <span class="flex items-center  text-sm underline text-primary font-bold gap-x-1" style="font-size:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 22H4C2.89543 22 2 21.1046 2 20V8H4V20H16V22ZM20 18H8C6.89543 18 6 17.1046 6 16V4C6 2.89543 6.89543 2 8 2H20C21.1046 2 22 2.89543 22 4V16C22 17.1046 21.1046 18 20 18ZM8 4V16H20V4H8ZM15 14H13V11H10V9H13V6H15V9H18V11H15V14Z" fill="currentColor"></path>
                </svg>Adicionar novos Dados de Entrega </span>
            </button>
          </div>
        </div>

        <div class="pb-6 hidden" id="div2">dkwaodkawodwaidjwaodjwaidjw</div>
        
        <div class="pb-6">
          <h1 class="page_title font-bold relative pl-2.5 text-lg md:text-xl">Método de Envio</h1>
        </div>
        <ul class="shipping_methods_wrapper">
          <li class="flex items-center justify-between bg-background-off rounded mb-6 p-5 md:px-8">
            <div class="flex items-center">
              <input type="radio" id="shipping_method_6" name="shipMethods" class="flex-shrink-0 cursor-pointer">
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
            <span class="hidden md:block">0,00&nbsp;€</span>
          </li>
        </ul>
        <button data-testid="button-component" class="with-tab bg-gray-back rounded-r3 float-left mt-4 h-12 md:w-36 w-full hidden lg:flex items-center justify-center">
          <span class="flex items-center  text-sm text-black font-bold gap-x-1">
            <svg width="16" height="14" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.249 3.625l2.323-2.266L5.302.125.801 4.5l4.501 4.375 1.27-1.234-2.323-2.266h14.558v-1.75H4.249z" fill="currentColor"></path>
            </svg>CARRINHO </span>
        </button>
        <button data-testid="button-component" class="with-tab bg-primary rounded-r3 float-right mt-4 h-12 md:w-36 w-full hidden lg:flex items-center justify-center" form="new_address_form" type="submit">
          <span class="flex items-center flex-row-reverse text-sm text-white font-bold gap-x-1">
            <svg width="16" height="14" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.8587 4.59808L10.122 6.34158L11.0711 7.29074L14.437 3.92491L11.0711 0.559082L10.122 1.50825L11.8587 3.25175H0.973633V4.59808H11.8587Z" fill="currentColor"></path>
            </svg>SEGUINTE </span>
        </button>
      </div>
      <div>
        <button data-testid="button-component" class="with-tab bg-gray-back rounded-r3 float-left mt-4 h-12 lg:w-36 w-full flex lg:hidden items-center justify-center">
          <span class="flex items-center  text-sm text-black font-bold gap-x-1">
            <svg width="16" height="14" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.249 3.625l2.323-2.266L5.302.125.801 4.5l4.501 4.375 1.27-1.234-2.323-2.266h14.558v-1.75H4.249z" fill="currentColor"></path>
            </svg>CARRINHO </span>
        </button>
        <button data-testid="button-component" class="with-tab bg-primary rounded-r3 float-right mt-4 h-12 lg:w-36 w-full flex lg:hidden items-center justify-center" form="new_address_form" type="submit">
          <span class="flex items-center flex-row-reverse text-sm text-white font-bold gap-x-1">
            <svg width="16" height="14" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.8587 4.59808L10.122 6.34158L11.0711 7.29074L14.437 3.92491L11.0711 0.559082L10.122 1.50825L11.8587 3.25175H0.973633V4.59808H11.8587Z" fill="currentColor"></path>
            </svg>SEGUINTE </span>
        </button>
      </div>
    </div>
  </main>
</div>

		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Total do Carrinho</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">

	                							<td><?php echo $total_quantidade1;?> <?php echo $nome ?></td>
	                							<td>€<?php echo $preco_total_produto1; ?></td>
	                						</tr><!-- End .summary-subtotal -->
	                						
	                						
	                						<tr class="summary-shipping-estimate">
	                							<td>Iva (23%)  <?php echo round($preco_total_produto1/1.23,2); ?></td>
	                							<td>&nbsp;</td>
	                						</tr><!-- End .summary-shipping-estimate -->

	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>€<?php echo $preco_total_produto1 ?></td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->

	                				<a href="index.php?page=checkout" class="btn btn-outline-primary-2 btn-order btn-block">Proceder para Pagamento</a>
	                			</div><!-- End .summary -->

	                			
	                		

	                		</aside><!-- End .col-lg-3 -->

		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main>
          <script>
    function mostrarDiv(divId) {
      // Esconder todas as divs
      var divs = document.querySelectorAll('.hidden');
      for (var i = 0; i < divs.length; i++) {
        divs[i].style.display = 'none';
      }

      // Mostrar a div selecionada
      var div = document.getElementById(divId);
      if (div) {
        div.style.display = 'block';
      }
    }
  </script>