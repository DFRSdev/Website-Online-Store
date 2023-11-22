 	
<header class="header header-2 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                   

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                
                                
                                <ul>
                                    <li><br><br></li>
                                    <li>Bem-vindo(/a) de novo,  <?php echo $_SESSION['name'];?></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->

                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo.webp" alt="Logo"  width="130" height="50">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="" method="GET">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="pesquisa" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="pesquisa_produtos" id="pesquisa" placeholder="Escreve aqui o que procuras..." value="<?php if(isset($_GET['pesquisa_produtos'])){echo $_GET['pesquisa_produtos'];} ?>" >
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                         
                        <div class="account">
                        <a href="index.php?page=dashboard_utilizador" title="Minha Conta">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <p>Conta</p>
                                 
                        </a>   
                        </div><!-- End .compare-dropdown -->
                        
 
                      

                          <div class="wishlist">
                            
                               
                                    
                               
                                            
                                                    <ul class="menu sf-arrows">
                                                        <li>
                                                            <a href="admin/index.php" title="Painel Admin">
                                <div class="icon">
                                    <i class="icon-user"></i>

                                </div>
                                <p>A<span style="text-transform:lowercase;">dmin</span></p>
                                 
                                                           

                                                        </li>

                                                        </ul><!-- End .menu -->
                                              
                                           
                               
                            
                        </div><!-- End .compare-dropdown -->

                       
                        
                     <?php 
                      
                        
                   
                    if (isset($_SESSION["id"])) {
    $selecionamento = "SELECT * FROM carrinho WHERE (cc_id = '" . $_SESSION["id"] . "' OR cc_sessionid = '" . session_id() . "')";
    $result = mysqli_query($ligax, $selecionamento);
    $qua = mysqli_num_rows($result);
} else {
     $selecionamento = "SELECT * FROM carrinho WHERE cc_sessionid = '".session_id()."'";
    $result = mysqli_query($ligax, $selecionamento);
       $qua = mysqli_num_rows($result);
}

                     ?>
                        
                        
                        
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count"><?php echo $qua ?></span>
                                </div>
                                <p>Carrinho</p>
                            </a>
  
                            <div class="dropdown-menu dropdown-menu-right">
                                
                                <div class="dropdown-cart-products">
                                      <?php
                        
                        $preco1=0;
                         while($registo1=mysqli_fetch_assoc($result)){
                      $cc_cod_produto=$registo1['cc_cod_produto'];
                      $cc_quantidade=$registo1['cc_quantidade'];
                        $select_produto="select nome,preco from produtos where cod_produto=$cc_cod_produto";
                        $result1=mysqli_query($ligax,$select_produto);
                        $registo2=mysqli_fetch_assoc($result1);
                        $nome=$registo2['nome'];
                        $preco=$registo2['preco'];
                        ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="product.html"><?php echo $nome?></a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty"><?php echo $cc_quantidade;?></span>
                                                x €<?php echo $preco?>
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="admin/showfile_fotoproduto.php?cod_produto=<?php echo $cc_cod_produto?>" alt="product">
                                            </a>
                                        </figure>
                                        
                                       
                                        <form method="POST">
                                             <input type="hidden" name="cod_produto" value="<?php echo $cc_cod_produto;?>">
                                        <button type="submit" class="btn-remove" name="remove_product_carrinho" title="Remove Product"><i class="icon-close"></i></button></form>
                                    </div><!-- End .product -->
                                    <?php $preco1+=$preco*$cc_quantidade;?>
 <?php } ?>
                                   
                                   
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>
                                    
                                    <span class="cart-total-price">€<?php echo $preco1; ?></span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="index.php?page=carrinho" class="btn btn-primary">Ver Carrinho</a>
                                    <a href="checkout.html" class="btn btn-outline-primary-2"><span>Comprar</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
			
            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                         <div class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Categorias">
                                Categorias
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
                                        
                                                              <?php
                                                                      $select_categorias="select nome_categoria,cod_categoria from categorias where estado=1 LIMIT 9";
                                            $result4=mysqli_query($ligax,$select_categorias);

                                                             while($registo4=mysqli_fetch_assoc($result4)){
                                                                  $nome_categoria=$registo4['nome_categoria'];
                                                                   $cod_categoria=$registo4['cod_categoria'];
                                        ?>
                                               
                                        <li class="item-lead"><a href="index.php?pesquisa_produtos=&cod_categoria%5B%5D=<?php echo $cod_categoria; ?>"><?php echo $nome_categoria ?></a></li>
                                        
                                     <?php } ?>
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <nav class="main-nav">
                            
                            <ul class="menu sf-arrows">
                                
                               
                                <li class="megamenu-container">
                                    
                                    
                                    <a href="index.php" class="sf-with">Home</a>

                                    
                                </li>
                             <li>
                                    <a href="index.php?pesquisa_produtos=" class="sf-with-ul">Loja</a>

                                    <div class="megamenu megamenu-md">
                                        <div class="row no-gutters">
                                            <div class="col-md-8">
                                                <div class="menu-col">
                                                    <div class="row">
   <div class="col-md-6">
    <?php
    $select_marcas = "select * from marcas";
    $result = mysqli_query($ligax, $select_marcas);
    $count = 0;
    ?>

<ul>
<?php while ($registo3 = mysqli_fetch_assoc($result)) {
    $cod_marca = $registo3['cod_marca'];
    $nome_marca = $registo3['nome_marca'];
    $count++;
    
    if ($count > 2) {
        echo '</ul></div><div class="col-md-6"><ul>';
        $count = 1;
    }
    ?>
    <li><a href="index.php?pesquisa_produtos&cod_marca%5B%5D=<?php echo $cod_marca; ?>"><?php echo $nome_marca; ?></a></li>
<?php } ?>
</ul>
</div><!-- End .col-md-6 -->


                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-8 -->

                                            <div class="col-md-4">
                                                <div class="banner banner-overlay">
                                                    <a href="category.html" class="banner banner-menu">
                                                        <img src="assets/images/menu/banner-1.webp" alt="Banner">

                                                        <div class="banner-content banner-content-top">
                                                            <div class="banner-title text-white">Última <br>Chance<br><span></span></div><!-- End .banner-title -->
                                                        </div><!-- End .banner-content -->
                                                    </a>
                                                </div><!-- End .banner banner-overlay -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-md -->
                                </li>
                                <li>
                                    <a href="comingsoon.php" class="sf-with">Reparações</a>

                                
                                </li>
                               
                      
                                
                                
                                          <li>
                                    <a href="index.php?page=contact" class="sf-with">Contactos</a>

                                    
                                       
                                       
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-center -->

                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i><p>Promoções<span class="highlight">&nbsp;até 30%</span></p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
           

        </header><!-- End .header -->
         <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
              
            
            <form action="" method="GET" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="pesquisa_produtos" id="mobile-search"  value="<?php if(isset($_GET['pesquisa_produtos'])){echo $_GET['pesquisa_produtos'];} ?>"  placeholder="Escreve aqui o que procuras..." required="">
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categorias</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="index.php">Home</a>

                              
                            </li>
                            <li>
                                <a href="index.php?pesquisa_produtos=">Loja<span class="mmenu-btn"></span></a>
                                <ul>
                                    <?php $select_marcas="select * from marcas";
                                            $result=mysqli_query($ligax,$select_marcas);

                                            while($registo3=mysqli_fetch_assoc($result)){
                                                $cod_marca=$registo3['cod_marca'];
                                                $nome_marca=$registo3['nome_marca'];
                                                ?>
                                    <li><a href="index.php?pesquisa_produtos&cod_marca%5B%5D=<?php echo $cod_marca; ?>"><?php echo $nome_marca; ?></a></li>
                                   

                                <?php } ?>
                                </ul>
                            </li>
                            <li>
                                <a href="comingsoon.php" class="sf-with-ul">Reparações</a>
                              
                            </li>
                        
                            
                            <li>
                                <a href="index.php?page=contact">Contactos</a>
                              
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">

                                                           <?php
                                                                      $select_categorias="select nome_categoria,cod_categoria from categorias where estado=1 LIMIT 9";
                                            $result4=mysqli_query($ligax,$select_categorias);

                                                             while($registo4=mysqli_fetch_assoc($result4)){
                                                                  $nome_categoria=$registo4['nome_categoria'];
                                                                   $cod_categoria=$registo4['cod_categoria'];
                                        ?>
                                               
                                        <li class="item-lead"><a class="mobile-cats-lead"href="index.php?pesquisa_produtos=&cod_categoria%5B%5D=<?php echo $cod_categoria; ?>"><?php echo $nome_categoria ?></a></li>
                                        
                                     <?php } ?>
                           
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div>
		      <?php
                                        if(isset($_POST['remove_product_carrinho'])){
                                        $remove_product_carrinho="delete from carrinho where cc_cod_produto='".$_POST['cod_produto']."'´AND (cc_id = '".$_SESSION['id']."' OR cc_sessionid = '".session_id()."')";
                                     
                                         $result2=mysqli_query($ligax,$remove_product_carrinho);
                                         
                                         ?>
                                         <script>
                                             location.href="index.php";
                                         </script>
                                         
                                         <?php
                                        }
                                        ?>
