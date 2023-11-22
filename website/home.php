
     
       




    <div class="page-wrapper">
        
<style type="text/css">
  .intro-slide .btn-primary {
    color: #fff;
    background-color: transparent;
    border-color: #fff;
}
</style>
        <main class="main">
                 <div class="intro-slider-container">
               <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
                    <div class="intro-slide" style="background-image: url(assets/images/firstfoto.webp);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle">Telemóveis/Computadores</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">Encontre o que<br>Combina consigo.</h1><!-- End .intro-title -->

                            <a href="index.php?pesquisa_produtos=" class="btn btn-primary">
                                <span>Compre agora</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url(assets/images/capas.webp);">
                        <div class="container intro-content" >
                            <h3 class="intro-subtitle" >Capas e Películas</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">Capa Livro <br>Plástico <br><span class="text-primary">Desde <sup>€</sup>15,99</span></h1><!-- End .intro-title -->

                            <a href="index.php?pesquisa_produtos=" class="btn btn-primary">
                                <span>Compre agora</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url(assets/images/reparacao.webp);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle">Reparações</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">
                                Fazemos Reparações A <br>Todo O Nível.<br>
                               
                            </h1><!-- End .intro-title -->

                            <a href="index.php?pesquisa_produtos=" class="btn btn-primary">
                                <span>Faça agora a sua</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->
                     <div class="intro-slide" style="background-image: url(assets/images/recondicionados.webp);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle">Telemóveis Usados</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">
                                Fazemos Venda  <br>De Telemóveis Usados.<br>
                                
                            </h1><!-- End .intro-title -->

                            <a href="index.php?pesquisa_produtos=" class="btn btn-primary">
                                <span>Compre agora</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .owl-carousel owl-simple -->

                <span class="slider-loader text-white"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->


            <div class="brands-border owl-carousel owl-simple" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": false,
                    "margin": 0,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":2
                        },
                        "420": {
                            "items":3
                        },
                        "600": {
                            "items":4
                        },
                        "900": {
                            "items":5
                        },
                        "1024": {
                            "items":6
                        },
                        "1360": {
                            "items":7
                        }
                    }
                }'>
               <?php 
               $select_marcas="select cod_marca from marcas";

               $result=mysqli_query($ligax,$select_marcas);
               while ($registo9=mysqli_fetch_assoc($result)) {
                   $cod_marca=$registo9['cod_marca'];
               

               ?>
                <a href="index.php?pesquisa_produtos&cod_marca%5B%5D=<?php echo $cod_marca; ?>" class="brand">
                    <img src="admin/showfile_fotomarca.php?cod_marca=<?php echo $cod_marca; ?>" alt="Nome da Marca">
                </a>
            <?php } ?>
            </div><!-- End .owl-carousel -->

            <div class="mb-3 mb-lg-5"></div><!-- End .mb-3 mb-lg-5 -->

            <div class="banner-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-5">
                            <div class="banner banner-large banner-overlay banner-overlay-light">
                                <a href="#">
                                    <img src="assets\images\topgama.webp" alt="Banner" width="75%">
                                </a>

                                <div class="banner-content banner-content-top">
                                    <h4 class="banner-subtitle">Apple</h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title">IPHONE Topo de Gama</h3><!-- End .banner-title -->
                                    <div class="banner-text">desde €350.99</div><!-- End .banner-text -->
                                    <a href="index.php?pesquisa_produtos=iphone" class="btn btn-outline-gray banner-link">Compre agora<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-5 -->

                        <div class="col-md-6 col-lg-3">
                            <div class="banner banner-overlay">
                                <a href="#">
                                    <img src="assets/images/demos/demo-2/banners/banner-2.webp" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-bottom">
                                    <h4 class="banner-subtitle text-grey">Promoção</h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white">Telemóveis <br>Usados</h3><!-- End .banner-title -->
                                    <div class="banner-text text-white">desde 99.00€</div><!-- End .banner-text -->
                                    <a href="index.php?pesquisa_produtos=" class="btn btn-outline-white banner-link">Descubra agora<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-3 -->

                        <div class="col-md-6 col-lg-4">
                            <div class="banner banner-overlay">
                                <a href="index.php?pesquisa_produtos=">
                                    <img src="assets/images/demos/demo-2/banners/banner-3.webp" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-top">
                                    <h4 class="banner-subtitle text-grey">Preço Imbatível</h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white">Películas <br>HidroGel e Vidro</h3><!-- End .banner-title -->
                                    <a href="index.php?pesquisa_produtos=pelicula" class="btn btn-outline-white banner-link">Descubre agora<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->

                            <div class="banner banner-overlay banner-overlay-light">
                                <a href="#">
                                    <img src="assets/images/demos/demo-2/banners/banner-4.webp" alt="Banner">
                                </a>

                                 <div class="banner-content banner-content-top">
                                    <h4 class="banner-subtitle text-grey">Preço Imbatível</h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white">Capas para todos<br>os telemóveis</h3><!-- End .banner-title -->
                                    <a href="index.php?pesquisa_produtos=capa" class="btn btn-outline-white banner-link">Descubre agora<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banner-group -->

            <div class="mb-3"></div><!-- End .mb-6 -->

            <div class="container">
                <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="products-featured-link" data-toggle="tab" href="#products-featured-tab" role="tab" aria-controls="products-featured-tab" aria-selected="true">Destaques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="products-top-link" data-toggle="tab" href="#products-top-tab" role="tab" aria-controls="products-top-tab" aria-selected="false">Novidades</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="container-fluid">
                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    },
                                    "1600": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                            

                                    <?php
            $select_tipo="select preco,nome,cod_produto from produtos where destaques=1";
             $result=mysqli_query($ligax,$select_tipo);
           
                  
              
            while($registo=mysqli_fetch_assoc($result)){
                 $cod_produto=$registo['cod_produto'];
                  $preco=$registo['preco'];
                  $nome=$registo['nome'];

                  ?>


                  <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $cod_produto?>">
                                        <img src="admin\showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" class="product-image">
                                        <img src="admin\showfile_fotoproduto2.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="index.php?acao=favoritar&cod_produto=<?php echo $cod_produto ?>" class="btn-product-icon btn-wishlist" ><span>Favoritos</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="index.php?page=detalhes_produto&cod_produto=<?php echo $cod_produto?>"><?php echo $nome?></a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        €<?php echo $preco ?>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <form method="POST">
                                        <input type="hidden" name="cod_produto" value="<?php echo $cod_produto; ?>">
                                    <button type="submit" class="btn-product btn-cart" name="adicionar_produto"><span>adicionar ao carrinho</span></button></form>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->


                  <?php
                  }
              
              
           ?>

                            

                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane p-0 fade" id="products-top-tab" role="tabpanel" aria-labelledby="products-sale-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    },
                                    "1600": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>

                                       <?php
            $select_tipo="select preco,nome,cod_produto from produtos where novidade=1";
             $result=mysqli_query($ligax,$select_tipo);
           
                  
              
            while($registo=mysqli_fetch_assoc($result)){
                 $cod_produto=$registo['cod_produto'];
                  $preco=$registo['preco'];
                  $nome=$registo['nome'];

                  ?>
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $cod_produto?>">
                                        <img src="admin\showfile_fotoproduto.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" class="product-image">
                                        <img src="admin\showfile_fotoproduto2.php?cod_produto=<?php echo $cod_produto ?>" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="index.php?acao=favoritar&cod_produto=<?php echo $cod_produto ?>" class="btn-product-icon btn-wishlist"><span>Favoritos</span></a>
                                    </div><!-- End .product-action-vertical -->

                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="index.php?page=detalhes_produto&cod_produto=<?php echo $cod_produto?>"><?php echo $nome?></a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        249.90€
                                    </div><!-- End .product-price -->

                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <form method="POST">
                                    <input type="hidden" name="cod_produto" value="<?php echo $cod_produto; ?>">
                                    <button type="submit" class="btn-product btn-cart" name="adicionar_produto"><span>adicionar ao carrinho</span></button></form>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
<?php } ?>
                            
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane p-0 fade" id="products-top-tab" role="tabpanel" aria-labelledby="products-top-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    },
                                    "1600": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                           

                          
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .container-fluid -->

            <div class="mb-5"></div><!-- End .mb-5 -->
<?php

                                    $select_produto_do_dia="select * from produtos where produto_do_semana='1'";
                                    $result_dia=mysqli_query($ligax, $select_produto_do_dia);
                                    $registo19=mysqli_fetch_assoc($result_dia);

                                    if(mysqli_num_rows($result_dia) > 0){
                                    ?>
            <div class="bg-light deal-container pt-5 pb-3 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="deal">
                                <div class="deal-content">
                                    <h4>Stock Limitado</h4>
                                    <h2>Produto do Semana</h2>

                                    <h3 class="product-title"><a href="index.php?page=detalhes_produto&cod_produto=<?php echo $registo19['cod_produto']; ?>"><?php echo $registo19['nome'];?></a></h3><!-- End .product-title -->

                                    <div class="product-price">
                                        <span class="new-price"><?php echo $registo19['preco'];?>€</span>
                                       
                                    </div><!-- End .product-price -->

                                    <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $registo19['cod_produto']; ?>" class="btn btn-primary">
                                        <span>Compre Agora</span><i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .deal-content -->
                                <div class="deal-image"> 

                                  <center>
                                    <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $registo19['cod_produto']; ?>">
                                        <img src="showfile_fotoproduto.php?cod_produto=<?php echo $registo19['cod_produto'];?>" width="389" height="650" alt="">
                                    </a>
                                  </center>
                                </div><!-- End .deal-image -->
                            </div><!-- End .deal -->
                        </div><!-- End .col-lg-9 -->
<?php
$select_melhor_escolha="SELECT cod_produto, COUNT(*) AS total FROM item_encomenda GROUP BY cod_produto ORDER BY total DESC LIMIT 1;
";
$result_melhor_escolha=mysqli_query($ligax,$select_melhor_escolha);
$registo10=mysqli_fetch_assoc($result_melhor_escolha);

$select_produto="select * from produtos where cod_produto='".$registo10['cod_produto']."'";
$result_2=mysqli_query($ligax,$select_produto);
$registo2=mysqli_fetch_assoc($result_2);

?>
                        <div class="col-lg-3">

                            <div class="banner banner-overlay banner-overlay-light text-center d-none d-lg-block">

                                <a href="">
                                 
                                    <img src="showfile_fotoproduto.php?cod_produto=<?php echo $registo2['cod_produto']; ?>" style="position:relative;top:190px;" alt="Banner">
                                  
                                </a>

                                <div class="banner-content banner-content-top banner-content-center">
                                    <h4 class="banner-subtitle">A Melhor Escolha</h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title"><?php echo $registo2['nome']; ?></h3><!-- End .banner-title -->
                                    <div class="banner-text text-primary"><?php echo $registo2['preco'];?>€</div><!-- End .banner-text -->
                                    <a href="index.php?page=detalhes_produto&cod_produto=<?php echo $registo2['cod_produto'];?>" class="btn btn-outline-gray banner-link">Compre Agora<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .bg-light -->
        <?php } ?>

          

            <div class="container">
               
                
                    
                </div><!-- End .tab-content -->
            </div><!-- End .container -->


        </main><!-- End .main -->

       
    </div><!-- End .page-wrapper -->
 

                                <?php

 

    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%&*()_+="; // $si contem os símbolos
        $password="";
        
        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($ma);
        }
    
        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($mi);
        }
    
        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($nu);
        }
    
        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($si);
        }
    
        // retorna a password embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($password),0,$tamanho);
    }

   if(isset($_POST["submit_recuperar"])){

    $email=$_POST["email_recuperar"]; 
    $procura="select * from users where email='".$email."' ;";
    $result=mysqli_query($ligax,$procura);
    $nregistos=mysqli_num_rows($result);
    $registo=mysqli_fetch_assoc($result);

    if($nregistos == 0){ ?>
     <script>  toastr.options = {
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

                        toastr["error"]("Conta não registada")</script>    
    <?php } else if($nregistos==1){
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

                        toastr["success"]("Enviado recuperação de password para o seu email");
    </script>
<?php

    //  Este email existe na base de dados!";
    $email=$registo["email"]; //guarda email para quem será enviado o formulário
    
    // Função Gerar Senha       
    $password=gerar_senha(10, true, true, true, true);

    //altera o registo com a nova password
    $sql="UPDATE users SET pass='".md5($password)."' where email='".$email."';";
    $result=mysqli_query($ligax,$sql);

//Envio de mensagem para o email do contacto a confirmar a receção dos dados:

    $mensagem_1 = new Mensagem1();

    $mensagem_1->__set('para' , $email); //email do contacto
    $mensagem_1->__set('assunto' , utf8_decode("Recuperacao de Password"));
    $mensagem_1->__set('mensagem' , "<font size=3>Olá {$email},<br>Solicitou a requisição da sua password.<br><br>
    A sua nova password é <b>$password</b> 
    <br>
    Por favor, não responda a este email. A sua única função é informar.<br><br>
    Atenciosamente, Equipa Miguel & Alex</font>");

    if(!$mensagem_1->mensagemValida()){
            echo "Mensagem não é válida";
    }

   $mail_1 = new PHPMailer(true);

   try {
         $mail_1->isHTML(true);                                  // Set email format to HTML
        $mail_1->SMTPDebug = false;                      // Enable verbose debug output
        $mail_1->isSMTP();                                            // Send using SMTP
        $mail_1->Host       = 'smtp.sapo.pt';                    // Set the SMTP server to send through
        $mail_1->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail_1->Username   = 'miguelalextelemoveiscomunicacoes@sapo.pt';                     // SMTP username
        $mail_1->Password   = 'MiguelAlexPorto2023';                               // SMTP password
        $mail_1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail_1->Port       = 587;                                    // TCP port to connect to

        $mail_1->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', utf8_decode('Miguel e Alex Telemóveis e Comunicações'));
        $mail_1->addAddress($mensagem_1->__get('para'));     // Add a recipient

        $headers_1 = "MIME-Version: 1.1/r/n";
        $headers_1 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
        $headers_1 .= "From: Catchy Store/r/n"; //Devem personalizar com o nome do vosso projeto
        $headers_1 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
      
       
        $mail_1->Subject = $mensagem_1->__get('assunto');
        $mail_1->Body    = $mensagem_1->__get('mensagem');;
        $mail_1->AltBody = 'É necessario utilizar um cliente que suport HTML para ter acesso total ao conteúdo dessa mensagem';

        $mail_1->send();
        $mensagem_1->status['codigo_status'] = 1;
        $mensagem_1->status['descricao_status'] = 'E-Mail enviado com secesso!<br> Vá até à sua caixa de correio eletrónico!';

    } catch (Exception $e_1) {

        $mensagem_1->status['codigo_status'] = 2;
        $mensagem_1->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail_1->ErrorInfo;

    //alguma lógica que armazene o erro para posterior análise por parte do programador
    }

}
}
 
?>
  
    

   