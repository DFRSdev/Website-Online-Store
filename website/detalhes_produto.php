<?php
  $query="select * from produtos where cod_produto='".$_GET['cod_produto']."'";
                      $result=mysqli_query($ligax,$query);
                      $registo=mysqli_fetch_assoc($result);
                      $nome=$registo['nome'];
                      $cod_produto=$registo['cod_produto'];
                      $descricao=$registo['descricao'];
                    
                      
                      $preco=$registo['preco'];
                      
                      $stock=$registo['stock'];
                      $estado=$registo['estado'];
                     
                      $novidade=$registo['novidade'];
                      $destaques=$registo['destaques'];
                      $especificacoes=$registo['especificacoes'];


?>

                                    <?php
                                    $comentario = "SELECT * FROM comentarios where cod_produto='".$_GET['cod_produto']."'";
                                    $result6=mysqli_query($ligax,$comentario);
                                    $n6=mysqli_num_rows($result6);


                                    ?>

<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?pesquisa_produtos=''">Produtos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $nome ?></li>
                    </ol>

                    
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <figure class="product-main-image">
                                            <img id="mainImage" src="showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" data-zoom-image="showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" alt="product image">

                                           
                                        </figure><!-- End .product-main-image -->

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                                <a class="product-gallery-item" href="#" data-image="admin/showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" data-zoom-image="admin/showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>">
                                                <img src="admin/showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" alt="product side" onclick="changeImage('admin/showfile_fotoproduto.php?cod_produto=<?php echo $_GET['cod_produto']; ?>')">
                                            </a>
                                            <a class="product-gallery-item" href="#" data-image="admin/showfile_fotoproduto2.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" data-zoom-image="admin/showfile_fotoproduto2.php?cod_produto=<?php echo $_GET['cod_produto']; ?>">
                                                <img src="admin/showfile_fotoproduto2.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" alt="product side" onclick="changeImage('admin/showfile_fotoproduto2.php?cod_produto=<?php echo $_GET['cod_produto']; ?>')">
                                            </a>

                                            <a class="product-gallery-item" href="#" data-image="admin/showfile_fotoproduto3.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" data-zoom-image="admin/showfile_fotoproduto3.php?cod_produto=<?php echo $_GET['cod_produto']; ?>">
                                                <img src="admin/showfile_fotoproduto3.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" onerror="this.src=''" onclick="changeImage('admin/showfile_fotoproduto3.php?cod_produto=<?php echo $_GET['cod_produto']; ?>')">
                                            </a>

                                            <a class="product-gallery-item" href="#" data-image="admin/showfile_fotoproduto4.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" data-zoom-image="admin/showfile_fotoproduto4.php?cod_produto=<?php echo $_GET['cod_produto']; ?>">
                                                <img src="admin/showfile_fotoproduto4.php?cod_produto=<?php echo $_GET['cod_produto']; ?>" onerror="this.src='';" onclick="changeImage('admin/showfile_fotoproduto4.php?cod_produto=<?php echo $_GET['cod_produto']; ?>')">
                                            </a>

                                        </div><!-- End .product-image-gallery -->
                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->
                            <script type="text/javascript">
                                function changeImage(imageUrl) {
                                  var mainImage = document.getElementById('mainImage');
                                  mainImage.src = imageUrl;
                                }

                            </script>
                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title"><?php echo $nome;?></h1><!-- End .product-title -->
                                    <?php


                                    $select_review = "SELECT avaliacao_comentario FROM comentarios WHERE cod_produto='" . $_GET['cod_produto'] . "'";
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
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: <?php echo $media; ?>%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( <?php echo $n6;?> Avaliações )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        <?php echo $preco?> €
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p><?php echo $descricao;?></p>
                                    </div><!-- End .product-content -->


<br><br>
<form action="" method="POST">
                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="text" id="qty" class="form-control" value="1" name="prod_quant" required="" >
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->
                                    
<br><br>
                                    <div class="product-details-action">
                                        <input type="hidden" name="cod_produto" value="<?php echo $_GET['cod_produto'];?>">
                                        <button class="btn btn-outline-primary-2" name="adicionar_produto"><i class="icon-shopping-cart"></i><span>Adicionar ao carrinho</span></button>
                                        <div class="details-action-wrapper">
                                            <a href="index.php?detalhes_produto=<?php echo $_GET['cod_produto']?>&acao=favoritar&cod_produto=<?php echo $_GET['cod_produto'] ?>" class="btn btn-outline-primary-2"><i class="icon-heart"></i><span>Favoritar</span></a>
                                           
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->
</form>

<?php
$select="select cod_categoria from produto_categoria where cod_produto='".$_GET['cod_produto']."'";

$result1=mysqli_query($ligax,$select);
$registo1=mysqli_fetch_assoc($result1);
$cod_categoria1=$registo1['cod_categoria'];
$query="select * from categorias where cod_categoria='".$cod_categoria1."'";

 $result4=mysqli_query($ligax,$query);
$registo2=mysqli_fetch_assoc($result4);
$nome_categoria=$registo2['nome_categoria'];
?>
                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Categoria:</span>
                                            <a href="#"><?php echo $nome_categoria;?></a>
                                            
                                        </div><!-- End .product-cat -->

                                       
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Descrição</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Envio &amp; Devoluções</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Avaliações (<?php echo $n6;?>)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Informação do Produto</h3>
                                    <p>
                                        <?php echo $especificacoes; ?>




                                    </p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                           
                            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                                <div class="product-desc-content">
                                    <h3>Entregas &amp; Devoluções</h3>
                                    <p>Efectuamos entregas em mais de 100 países em todo o mundo. Para obter informações completas sobre as opções de entrega que oferecemos, consulte as nossas <a href="#">informações de entrega.</a><br>
                                    Esperamos que adore cada compra, mas se alguma vez precisar de devolver um artigo, pode fazê-lo no prazo de um mês após a recepção. Para mais informações sobre como efectuar uma devolução, consulte as nossas <a href="#">informações sobre devoluções.</a></p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->


                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div class="reviews">
                                   
                                     <p><span style="font-weight: 400;    font-size: 1.6rem;letter-spacing: -.01em;margin-bottom: 1.8rem;color: black;">Comentários (<?php echo $n6; ?>)</span> <?php if(isset($_SESSION['perfil'])){?><span class="asterisk">*</span>
                                  <sup><a href="#comentario-modal" data-toggle="modal"  style="font-size:12px;">Adicionar Comentário</a></sup><?php } ?></p>
                                  
                              </label>
                                    <br>
                                    <?php
                                    if($n6>0){

                                while($registo=mysqli_fetch_assoc($result6)){
                                    $titulo_comentario=$registo['titulo_comentario'];
                                    $texto_comentario=$registo['texto_comentario'];
                                    $avaliacao_comentario=$registo['avaliacao_comentario'];
                                    $id=$registo['id'];
                                    $data_comentario=$registo['data_comentario'];
                                    $cod_comentario=$registo['cod_comentario'];
                                    $select_nome="select name from users where id='".$id."'";
                                    $result5=mysqli_query($ligax,$select_nome);
                                    $registo_nome=mysqli_fetch_assoc($result5);
                                    $nome=$registo_nome['name'];
                                    ?>

                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#"><?php echo $nome; ?></a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <?php if($avaliacao_comentario==1){?>
                                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                    <?php }elseif($avaliacao_comentario==2){ ?>
                                                        <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                                                    <?php }elseif($avaliacao_comentario==3){ ?>
                                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                                    <?php }elseif($avaliacao_comentario==4){ ?>
                                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                    <?php }else{ ?>
                                                        <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                    <?php } ?>
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <?php 
                                                  $data_diff="SELECT TIMESTAMPDIFF(DAY, '".$data_comentario."',CURRENT_TIMESTAMP) AS diferenca_dias FROM comentarios where cod_comentario='".$cod_comentario."'";
                                                    
                                                    
                                                    $result3=mysqli_query($ligax,$data_diff);
                                                    $registo2=mysqli_fetch_assoc($result3);
                                                    $dias=$registo2['diferenca_dias'];

                                                    if($dias<1){echo ' <span class="review-date">Hoje</span>';}
                                                    elseif($dias==1){echo ' <span class="review-date">Ontem</span>';}
                                                    elseif($dias>1){
                                                ?>

                                                <span class="review-date"><?php echo $dias; ?> dias atrás</span>
                                            <?php } ?>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4><?php echo $titulo_comentario;?></h4>

                                                <div class="review-content">
                                                    <p><?php echo $texto_comentario; ?></p>
                                                </div><!-- End .review-content -->

                                                
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->

                                <?php }

                            }else{
                                    echo 'Ainda não existem opiniões sobre este produto';
                                }

                                ?>

                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main>

        