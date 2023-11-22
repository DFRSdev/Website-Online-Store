

    <div class="page-wrapper">
      
<br><br>
        <main class="main">
           
           <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			
                            <div class="products mb-3">
                                <div class="row justify-content-center">
                            <?php
if (isset($_GET['pesquisa_produtos'])) {
    $pesquisa_produtos = $_GET['pesquisa_produtos'];

  
      $produtos = "SELECT produtos.cod_produto, produtos.preco, produtos.nome, produtos.stock, produtos.novidade, produtos.destaques, produtos.estado FROM produtos where produtos.nome LIKE '%$pesquisa_produtos%'";   
    
   

    if (isset($_GET['cod_categoria'])) {
        $categorias = $_GET['cod_categoria'];

        foreach ($categorias as $index => $value) {
            $produtos .= " AND produtos.cod_produto IN (SELECT cod_produto FROM produto_categoria WHERE cod_categoria='".$value."')";
        }
    }

    if (isset($_GET['cod_marca'])) {
        $marcas = $_GET['cod_marca'];

        foreach ($marcas as $index => $value) {
            $produtos .= " AND produtos.cod_produto IN (SELECT cod_produto FROM produto_marca WHERE cod_marca='".$value."')";
        }
    }

    if (isset($_GET['valor_minimo']) || isset($_GET['valor_maximo'])) {
        $valor_minimo = $_GET['valor_minimo'];
        $valor_maximo = $_GET['valor_maximo'];

        if ($valor_maximo === "") {
            $valor_maximo = 99999;
        }

        if ($valor_minimo === "") {
            $valor_minimo = 0;
        }

        $produtos .= " AND produtos.preco BETWEEN $valor_minimo AND $valor_maximo";
    }
} else {
    $produtos = "SELECT cod_produto, preco, nome, stock, novidade, destaques, estado FROM produtos";
}




                
                           
                            $result=mysqli_query($ligax,$produtos);
                           


                         


  
    //Colocar código da páginação
    //Paginação – Apenas listar 10 registos numa página
    $reg_pag=8; // Número de registos a apresentar por página

    if(isset($_GET['pag'])){
            //guarda a página em que o utilizador clicou
            $pag=$_GET['pag'];
        } 
        else {
            //ou mostra a 1.ª
            $pag=1;
        }

        //define a página anterior
    $pag_ant=$pag-1;
        //define a página seguinte
    $pag_seg=$pag+1;

        //calcula quantos registos já foram exibigos em páginas anteriores
    $reg_ini=($reg_pag*$pag)-$reg_pag;

        //calcula o n.º total de registos
    $num_reg=mysqli_num_rows($result);

        //Se temos menos de 10 registos (só dá para 1 página)
    if($num_reg <=$reg_pag) {
      $num_pag=1; 
    }

        //Se for multiplo de 10, dá conta certa
    else if (($num_reg % $reg_pag)==0) {
      $num_pag=$num_reg/$reg_pag; }

        //se não for multiplo de 10, dá mais 1 p+agina
    else {
      $num_pag=$num_reg/$reg_pag + 1; 
    }

    //Vai à base de dados selecionar os registos entre dois limites
    $produtos=$produtos." limit $reg_ini,$reg_pag";
    $result= mysqli_query($ligax, $produtos);

   if(mysqli_num_rows($result)>0){
                                while($registo=mysqli_fetch_assoc($result)){
                                    $cod_produto=$registo['cod_produto'];
                                    $preco=$registo['preco'];
                                    $nome=$registo['nome'];
                                    $stock=$registo['stock'];
                                    $novidade=$registo['novidade'];
                                    $destaques=$registo['destaques'];
                                    $estado=$registo['estado'];

           

                               
                            ?>

                            
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">

                                               <?php if ($novidade == 1): ?>
    <span class="product-label label-new">Novidades</span>
<?php endif; ?>

<?php if ($destaques == 1): ?>
    <span class="product-label label-top">Destaques</span>
<?php endif; ?>

<?php if ($stock == 0): ?>
    <span class="product-label label-out">Sem stock</span>
<?php elseif ($stock < 5): ?> 
    <span class="product-label" style="color: #fff; background-color: #ff7b00;">Poucas Unidades</span>
<?php endif; ?>

<?php if ($estado > 1): ?>
    <span class="product-label label-out">Usado</span>
<?php endif; ?>

                                                
                                                <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $cod_produto?>">
                                                    <img src="showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" class="product-image" >
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="index.php?pesquisa_produtos=<?php echo $_GET['pesquisa_produtos']?>&acao=favoritar&cod_produto=<?php echo $cod_produto ?>" class="btn-product-icon btn-wishlist btn-expandable"><span>Adicionar aos favoritos</span></a>
                                                    
                                                </div><!-- End .product-action-vertical -->
                                                
                                                <?php
                                                if($stock==0){
                                                    
                                                }
                                                else{
                                                    ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="cod_produto" value="<?php echo $cod_produto ?>">
                                                     <div class="product-action">
                                                         
                                                    <button class="btn-product btn-cart" name="adicionar_produto"><span>adicionar ao carrinho</span></button>
                                                </div><!-- End .product-action -->
                                                    </form>
                                                    <?php
                                                }
                                                ?>
    
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">

                                                    <?php 
                                                    $soma=0;
                                                    $consulta="select * from categorias, produtos, produto_categoria where produto_categoria.cod_produto='".$cod_produto."' and produtos.cod_produto=produto_categoria.cod_produto and categorias.cod_categoria=produto_categoria.cod_categoria";
                                                   
                                                     $result1=mysqli_query($ligax,$consulta);
                                                   $registonomecategoria=mysqli_fetch_assoc($result1);
                                                    $nomecategoria=$registonomecategoria['nome_categoria'];
                                                    $select_review = "SELECT avaliacao_comentario FROM comentarios WHERE cod_produto='" . $cod_produto . "'";
                                                    $result2 = mysqli_query($ligax, $select_review);
                                                    $soma = 0;

                                                    while ($registo_avaliacao = mysqli_fetch_assoc($result2)) {
                                                        $avaliacao_comentario = $registo_avaliacao['avaliacao_comentario'];
                                                        $soma += $avaliacao_comentario;
                                                    }

                                                    $num_rows = mysqli_num_rows($result2);
                                                    $media = 0;

                                                    if ($num_rows > 0) {
                                                        $media = $soma / $num_rows;
                                                    }

                                                    $media = ($media * 100) / 5;


                                    
                                                    
                                                    ?>
                                                    <a href="#"><?php echo $nomecategoria?></a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href=""><?php echo $nome ?></a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    <?php echo $preco ?> €
                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: <?php echo $media; ?>%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                    <span class="ratings-text">( <?php echo $num_rows; ?> Reviews )</span>
                                                </div><!-- End .rating-container -->

                                               
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

                                  
                                   <?php

                            }
                                }else{
                                    echo '<style>
.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-4{padding-left:1rem;padding-right:1rem}.gap-y-10{row-gap:2.5rem}.gap-x-12{column-gap:3rem}.justify-center{justify-content:center}.items-center{align-items:center}.flex-col{flex-direction:column}.flex{display:flex}.text-xl{font-size:1.25rem}.text-xl{line-height:1.75rem}.text-center{text-align:center}.gap-y-5{row-gap:1.25rem}.gap-x-3{column-gap:.75rem}.justify-center{justify-content:center}.items-center{align-items:center}.flex-col{flex-direction:column}..gap-x-3{-moz-column-gap:.75rem}.text-center{text-align:center}.font-black{font-weight:900}.text-2xl{font-size:1.5rem;line-height:2rem}.text-xl{line-height:1.75rem}.text-xl{font-size:1.25rem}.text-xl{line-height:1.75rem}.text-center{text-align:center}.gap-y-5{row-gap:1.25rem}.gap-x-3{column-gap:.75rem}.justify-center{justify-content:center}.items-center{align-items:center}.flex-col{flex-direction:column}.gap-x-3{-moz-column-gap:.75rem}.gap-3{gap:.75rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.px-5{padding-left:1.25rem;padding-right:1.25rem}.items-center{align-items:center}a{color:inherit;text-decoration:inherit}

</style>
<div class="py-10">
  <div class="flex flex-col items-center gap-y-10">
    <img alt="No Results Found" width="150px" height="150px" src="assets/images/noResults.webp">
    <div class="text-center">
      <p class="font-black text-2xl">UPS...</p><br>
      <h3>Não conseguimos encontrar o que procuras.</h3>
      <p>
        <span>Tenta novamente pesquisar por outras palavras. </span>.
      </p>
    </div>
  </div>
  <br>
  <h3 class="text-center" style="font-size: 1.25rem;">Poderá ser do seu interesse.</h3>
  <div class="flex flex-col md:flex-row gap-x-3 gap-y-5 justify-center items-center">
    <div class="flex gap-3 md:contents">
      <a class="btn btn-outline-primary-2" href="index.php?cod_marca%5B%5D=1&pesquisa_produtos=">iPhone</a>
      <a class="btn btn-outline-primary-2" href="index.php?cod_marca%5B%5D=2&pesquisa_produtos=">Samsung</a>
    </div>
    <div class="flex gap-3 md:contents">
      <a class="btn btn-outline-primary-2" href="index.php?cod_marca%5B%5D=11&pesquisa_produtos=">Xiaomi</a>
      <a class="btn btn-outline-primary-2" href="index.php?cod_marca%5B%5D=3&pesquisa_produtos=">Oppo</a>
    </div>
  </div>
</div>';
                                }
                            ?>
                                   
                                

                                 

                                </div><!-- End .row -->
                            </div><!-- End .products -->


                            


                			<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">

        <?php
        $pesquisa=$_GET['pesquisa_produtos'];
        if (($pag_ant) && ($pag > 1)) {
            echo "<li class='page-item '>
                    <a class='page-link page-link-prev' href='index.php?pesquisa_produtos=$pesquisa&pag=$pag_ant' aria-label='Previous' tabindex='-1' aria-disabled='true'>
                        <span aria-hidden='true'><i class='icon-long-arrow-left'></i></span>Anterior
                    </a>
                </li>";
        } else {
            echo "<li class='page-item disabled'>
                    <a class='page-link page-link-prev' href='index.php?pesquisa_produtos=$pesquisa&pag=$pag_ant' aria-label='Previous' tabindex='-1' aria-disabled='true'>
                        <span aria-hidden='true'><i class='icon-long-arrow-left'></i></span>Anterior
                    </a>
                </li>";
        }
        
        for ($i = 1; $i <= $num_pag; $i++) {
            if ($i != $pag) {
                echo "<li class='page-item'><a class='page-link' href='index.php?pesquisa_produtos=$pesquisa&pag=$i'>$i</a></li>";
            } else {
                echo "<li class='page-item active' aria-current='page'><a class='page-link' href='index.php?pesquisa_produtos=$pesquisa&pag=$i'>$i</a></li>";
            }
        }
        
        if ($pag + 1 <= $num_pag) {
            echo "<li class='page-item'>
                    <a class='page-link page-link-next' href='index.php?pesquisa_produtos=$pesquisa&pag=$pag_seg' aria-label='Next'>
                        Seguinte <span aria-hidden='true'><i class='icon-long-arrow-right'></i></span>
                    </a>
                </li>";
        }
        ?>
    </ul>
</nav>
</div><!-- End .col-lg-9 -->


                		<aside class="col-lg-3 order-lg-first">
                             <form method="GET" id="myForm"> 
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                            
                					<label>Filtros:</label>
                					<a href="index.php?pesquisa_produtos=<?php echo $_GET['pesquisa_produtos'];?>"  class="sidebar-filter-clear">Limpar Tudo</a>
                				</div><!-- End .widget widget-clean -->

                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Categoria
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
											    
											    <?php
											    $select_categorias="select cod_categoria,nome_categoria from categorias";
											     $result3=mysqli_query($ligax,$select_categorias);
											     
                                    while($registo=mysqli_fetch_assoc($result3)){
                                    $cod_categoria=$registo['cod_categoria'];
                                    $nome_categoria=$registo['nome_categoria'];
                                        $count_produto_categoria="select * from produto_categoria where cod_categoria='".$cod_categoria."'";
                                         $result5=mysqli_query($ligax,$count_produto_categoria);
                                         $count_cat=mysqli_num_rows($result5);
											    
											    ?>
												<div class="filter-item">
													<div class="custom-control custom-checkbox">

                                                          <input type="checkbox" class="custom-control-input" name="cod_categoria[]" value="<?php echo $cod_categoria; ?>" id="cat-<?php echo $cod_categoria; ?>" onclick="uncheckOtherCheckboxes(this)" <?php if (isset($_GET['cod_categoria']) && in_array($cod_categoria, $_GET['cod_categoria'])) echo 'checked'; ?>>
                                                          <label class="custom-control-label" for="cat-<?php echo $cod_categoria; ?>"><?php echo $nome_categoria?></label>
                                                        </div><!-- End .custom-checkbox -->

													<span class="item-count"><?php echo $count_cat ?></span>
												</div><!-- End .filter-item -->

												<?php } ?>
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                            Marca
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">
                                                
                                                <?php
                                                $select_marcas="select cod_marca,nome_marca from marcas";
                                                 $result3=mysqli_query($ligax,$select_marcas);
                                                 
                                    while($registo=mysqli_fetch_assoc($result3)){
                                    $cod_marca=$registo['cod_marca'];
                                    $nome_marca=$registo['nome_marca'];
                                        $count_produto_marca="select * from produto_marca where cod_marca='".$cod_marca."'";
                                         $result5=mysqli_query($ligax,$count_produto_marca);
                                         $count_mac=mysqli_num_rows($result5);
                                                
                                                ?>
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">

                                                          <input type="checkbox" class="custom-control-input" name="cod_marca[]" value="<?php echo $cod_marca; ?>" id="cat-<?php echo $cod_marca; ?>" onclick="uncheckOtherCheckboxes1(this)" <?php if (isset($_GET['cod_marca']) && in_array($cod_marca, $_GET['cod_marca'])) echo 'checked'; ?>>
                                                          <label class="custom-control-label" for="cat-<?php echo $cod_marca; ?>"><?php echo $nome_marca?></label>
                                                        </div><!-- End .custom-checkbox -->

                                                    <span class="item-count"><?php echo $count_mac ?></span>
                                                </div><!-- End .filter-item -->

                                                <?php } ?>
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Preço
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5">
										<div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
<div class="price-filter__content">
  <div  min="0" max="5000" step="1">
    <input type="hidden" name="pesquisa_produtos" value="">
    <input name="valor_minimo" type="number" placeholder="Min" autocomplete="" class="form-control" style="width:130px;" value="<?php if(isset($_GET['valor_minimo'])) echo $_GET['valor_minimo'];?>">
  </div>
  <span > - </span>
  <div min="0" max="5000" step="1">
  <input name="valor_maximo" type="number" placeholder="Max" autocomplete="" class="form-control" style="width:130px;" value="<?php if(isset($_GET['valor_maximo'])) echo $_GET['valor_maximo'];?>"> 
  </div>
 
 
</div>

                                                </div><!-- End .filter-price-text -->
                                                
                                               
                                                
                                            </div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                                
                			</div><!-- End .sidebar sidebar-shop --></form>
                		</aside><!-- End .col-lg-3 -->
                    
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div>
           
        </main><!-- End .main -->

       
    </div><!-- End .page-wrapper -->
     <script>
    function uncheckOtherCheckboxes(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_categoria[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }

     function uncheckOtherCheckboxes1(clickedCheckbox) {
      var checkboxes = document.getElementsByName('cod_marca[]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== clickedCheckbox) {
          checkboxes[i].checked = false;
        }
      }
    }

    
  </script>
   <script>
  document.addEventListener('DOMContentLoaded', function() {
    var filterForm = document.getElementById('myForm');
    var filterInputs = filterForm.querySelectorAll('input[name="cod_categoria[]"], input[name="cod_marca[]"], input[name="valor_minimo"], input[name="valor_maximo"]');
    
    for (var i = 0; i < filterInputs.length; i++) {
      filterInputs[i].addEventListener('change', function() {
        filterForm.submit();
      });
    }
  });
</script>
