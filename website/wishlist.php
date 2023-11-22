<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Favoritos</h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Produtos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Favoritos</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="container">
					<table class="table table-wishlist table-mobile">
						<thead>
							<tr>
								<th>Produto</th>
								<th>Preço</th>
								<th>Estado do Estoque</th>
								<th></th>
								<th></th>
							</tr>
						</thead>

						<?php


    
       if(isset($_SESSION['id'])){
       		$select="select * from produtos,favoritos where produtos.cod_produto=favoritos.cod_produto AND (favoritos.id='".$_SESSION['id']."' or favoritos.session_id='".session_id()."')";
           
        }else{
                $select="select * from produtos,favoritos where produtos.cod_produto=favoritos.cod_produto AND (favoritos.id='".session_id()."' or favoritos.session_id='".session_id()."')";
            }
          
             $result=mysqli_query($ligax, $select);

             

             if($result){
             	$n=mysqli_num_rows($result);
             	if($n>0){

        

                      
?>
        <tbody> 			
<?php

while($registo=mysqli_fetch_assoc($result)){
  $cod_produto=$registo['cod_produto'];
  $nome=$registo['nome'];
  $preco=$registo['preco'];
  $stock=$registo['stock'];



?>



						<tr>
								<td class="product-col">
									<div class="product">
										<figure class="product-media">
											<a href="#">
												<img src="showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto;?>" alt="Product image">
											</a>
										</figure>
										
										<h3 class="product-title">
											<a href="#"><?php echo $nome;?></a>
										</h3><!-- End .product-title -->
									</div><!-- End .product -->
								</td>
								<td class="price-col"><?php echo $preco; ?>€</td>
								<td class="stock-col">

									<?php if($stock<1){ ?>
									<span class="out-of-stock">Fora de Stock</span>
								<?php }else{ ?>
									<span class="in-stock">Em Stock</span>
								<?php } ?>

								</td>
								<form method="POST" action="">
									 <input type="hidden" name="cod_produto" value="<?php echo $cod_produto ?>">
									 
								<td class="action-col">

									<?php if($stock<1){ ?>

										<button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
									<?php }else{ ?>
										
                                                       
										<button class="btn btn-block btn-outline-primary-2" name="adicionar_produto"><i class="icon-cart-plus"></i>Adicionar ao carrinho</button>

									
										<?php } ?>
									
								</td>
								<td class="remove-col"><button class="btn-remove" name="remover_favorito"><i class="icon-close"></i></button></td>
								    </form>
							</tr>     

                                                 
 <?php 

                 }
             }
         }
         
                     ?>
                             
						</tbody>
                                     
					</table><!-- End .table table-wishlist -->
	            	
            	</div><!-- End .container -->
            </div><!-- End .page-content -->
        </main>
     
    