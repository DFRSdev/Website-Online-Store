<?php

if (isset($_POST['apagar_produto'])) {

    $produtos_a_remover = $_POST['apagar_produto'];

    foreach ($produtos_a_remover as $produto) {

        if(isset($_SESSION['id'])){
            $remove_product_carrinho = "DELETE FROM carrinho WHERE cc_cod_produto = '" . $produto . "' AND cc_id = '".$_SESSION['id']."'";
        }else{
              $remove_product_carrinho = "DELETE FROM carrinho WHERE cc_cod_produto = '" . $produto . "' AND cc_sessionid = '".session_id()."'";
        }
    

    $result2 = mysqli_query($ligax, $remove_product_carrinho);
    }
    ?>
    <script>location.href="index.php?page=carrinho";</script>
    <?php
    
}

// Alterar quantidade de produto a encomendar

if (isset($_POST["submit_update"])) {
    foreach ($_POST['prod_quant'] as $index => $value) {
        $cod = $_POST['cod_produto'][$index];

        if ($value > 0) {
            if (isset($_SESSION['id'])) {
                $acresc = "UPDATE carrinho SET cc_quantidade = $value 
                           WHERE cc_id = '" . $_SESSION['id'] . "'  
                           AND cc_cod_produto = $cod;";
            } else {
                $acresc = "UPDATE carrinho SET cc_quantidade = $value 
                           WHERE cc_sessionid = '" . session_id() . "' 
                           AND cc_cod_produto = $cod;";
            }
            mysqli_query($ligax, $acresc) || die(mysqli_error($ligax));
        } else {
            $del = "DELETE FROM carrinho 
                    WHERE (cc_id = '" . $_SESSION['id'] . "' OR cc_sessionid = '" . session_id() . "') 
                    AND cc_cod_produto = $cod;";
            mysqli_query($ligax, $del) || die(mysqli_error($ligax));
        }
    }
}

?>
<div class="page-wrapper">
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Carrinho<span></span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="">Loja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrinho de Compras</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <?php
                                if (isset($_SESSION["id"])) {
                                    $selecionamento = "SELECT * FROM carrinho WHERE (cc_id = '" . $_SESSION["id"] . "' OR cc_sessionid = '" . session_id() . "')";
                                    $result = mysqli_query($ligax, $selecionamento);
                                } else {
                                    $selecionamento = "SELECT * FROM carrinho WHERE cc_sessionid = '" . session_id() . "'";
                                    $result = mysqli_query($ligax, $selecionamento);
                                }
                                ?>
                                <form action="" method="POST">
                                   <tbody>
    <?php
    $preco_total_produto1 = 0;
    $total_quantidade1 = 0;
    while ($registo = mysqli_fetch_assoc($result)) {
        $cc_cod_produto = $registo['cc_cod_produto'];
        $cc_quantidade = $registo['cc_quantidade'];
        $select_produto = "SELECT nome, preco, stock FROM produtos WHERE cod_produto=$cc_cod_produto";
        $result1 = mysqli_query($ligax, $select_produto);
        $registo1 = mysqli_fetch_assoc($result1);
        $nome = $registo1['nome'];
        $preco = $registo1['preco'];
        $stock = $registo1['stock'];

        // Limit the quantity based on stock
        $max_quantity = min($cc_quantidade, $stock);
    ?>

        <tr>
            <td class="product-col">
                <div class="product">
                    <figure class="product-media">
                        <a href="#">
                            <img src="admin/showfile_fotoproduto.php?cod_produto=<?php echo $cc_cod_produto ?>" alt="Product image">
                        </a>
                    </figure>
                    <h3 class="product-title">
                        <a href="#"><?php echo $nome ?></a>
                    </h3><!-- End .product-title -->
                </div><!-- End .product -->
            </td>
            <td class="price-col">€<?php echo $preco ?></td>
            <td class="quantity-col">
                <div class="cart-product-quantity">
                    <input type="number" id="myInput" name="prod_quant[]" class="form-control" value="<?php echo $max_quantity ?>" min="1" max="<?php echo $stock ?>" required="">
                    <input type="hidden" name="cod_produto[]" value="<?php echo $cc_cod_produto; ?>">
                </div><!-- End .cart-product-quantity -->
            </td>
            <?php $preco_total_produto = $preco * $max_quantity ?>
            <td class="total-col"><?php echo $preco_total_produto ?></td>
            <td class="remove-col">
                <button class="btn-remove" name="apagar_produto[]" title="Remover Produto" value="<?php echo $cc_cod_produto; ?>">
                    <i class="icon-close"></i>
                </button>
            </td>
        </tr>

    <?php
        $total_quantidade = $max_quantity;
        $preco_total_produto1 += $preco_total_produto;
        $total_quantidade1 += $total_quantidade;
    }
    ?>
</tbody>

                            </table><!-- End .table table-wishlist -->
                            <div class="cart-bottom">
                                <div class="cart-discount"></div><!-- End .cart-discount -->
                                <p align="left">
                                    <a href="index.php?pesquisa_produtos=" class="btn btn-outline-dark-2 btn-block mb-3"><span>Continuar a comprar</span><i class="icon-refresh"></i></a>
                                </p>
                                <button class="btn btn-outline-dark-2" name="submit_update"><span>Atualizar Carrinho</span><i class="icon-refresh"></i></button>
                            </div><!-- End .cart-bottom -->
                        </div><!-- End .col-lg-9 -->
                        </form>

                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Total do Carrinho</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td><?php echo $total_quantidade1; ?> Produto</td>
                                            <td>€<?php echo round($preco_total_produto1 / 1.23, 2); ?></td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr class="summary-shipping-estimate">
                                            <td>Iva (23%):</td>
                                            <td>€<?php echo $preco_total_produto1 - round($preco_total_produto1 / 1.23, 2); ?></td>
                                        </tr><!-- End .summary-shipping-estimate -->
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>€<?php echo $preco_total_produto1 ?></td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <a href="index.php?page=checkout_entrega" class="btn btn-outline-primary-2 btn-order btn-block">Proceder para Checkout</a>
                            </div><!-- End .summary -->

                            <div class="summary summary-cart">
                                <h3 class="summary-title">Tens um código de desconto?</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-shipping-estimate">
                                            <td style="font-size: 14px;">Insere-o no passo 2 do checkout, antes da confirmação da encomenda.</td>
                                            <td>&nbsp;</td>
                                        </tr><!-- End .summary-shipping-estimate -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                            </div>
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
    </div><!-- End .page-wrapper -->
</form>
