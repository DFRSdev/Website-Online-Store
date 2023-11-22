

 <footer class="footer footer-2">
            <div class="icon-boxes-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Portes Grátis</h3><!-- End .icon-box-title -->
                                    <p>Encomendas acima de 40€</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Devoluções</h3><!-- End .icon-box-title -->
                                    <p>Durante 15 dias</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Subscreva-se na Newsletter</h3><!-- End .icon-box-title -->
                                    
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Suporte 24/7</h3><!-- End .icon-box-title -->
                                    
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .icon-boxes-container -->



                        <?php
if (!isset($_SESSION['perfil'])) {
    ?>
        	<div class="footer-newsletter bg-image" style="background-image: url(assets/images/slide1.webp)">
        		<div class="container">
        			<div class="heading text-center">
                        <h3 class="title">Subscreva a Newsletter</h3><!-- End .title -->
                        <p class="title-desc">e receba <span>um cupom de 10€</span> na primeira compra</p><!-- End .title-desc -->
                    </div><!-- End .heading -->

                    <div class="row">
                    	<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
						
           
    <form method="POST">
        <div class="input-group">
            <input type="email" name="nl_email" class="form-control" placeholder="Insira o seu Endereço de Email" aria-label="Email Adress" aria-describedby="newsletter-btn" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="subscribe" id="newsletter-btn"><span>Subscrever</span><i class="icon-long-arrow-right"></i></button>
            </div><!-- .End .input-group-append -->
        </div><!-- .End .input-group -->
    </form>

        </div><!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-newsletter bg-image -->
    <?php
} else {
    ?>
    <form method="POST">
        <?php
        /* Verificar se está subscrito */
        $subscricao = "SELECT subscricao FROM newsletter WHERE email='" . $_SESSION['email'] . "'";

        $result = mysqli_query($ligax, $subscricao);
        $n = mysqli_num_rows($result);
        if ($n > 0) {
            $registo = mysqli_fetch_assoc($result);
            $subscricao = $registo['subscricao'];
            if ($subscricao == 1) {
                ?>
              <script type="text/javascript">
                   
              </script>
                <?php
            } else {
                ?>
                <div class="footer-newsletter bg-image" style="background-image: url(assets/images/slide1.webp)">
                <div class="container">
                    <div class="heading text-center">
                        <h3 class="title">Subscreva a Newsletter</h3><!-- End .title -->
                        <p class="title-desc">e receba <span>um cupom de 10€</span> na primeira compra</p><!-- End .title-desc -->
                    </div><!-- End .heading -->

                    <div class="row">
                        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        
           
    <form method="POST">
        <div class="input-group">
            <input type="email" name="nl_email" class="form-control" placeholder="Insira o seu Endereço de Email" aria-label="Email Adress" aria-describedby="newsletter-btn" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="subscribe" id="newsletter-btn"><span>Subscrever</span><i class="icon-long-arrow-right"></i></button>
            </div><!-- .End .input-group-append -->
        </div><!-- .End .input-group -->
    </form>

        </div><!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-newsletter bg-image -->
                <?php
            }
        } else {
            ?>
           <div class="footer-newsletter bg-image" style="background-image: url(assets/images/slide1.webp)">
                <div class="container">
                    <div class="heading text-center">
                        <h3 class="title">Subscreva a Newsletter</h3><!-- End .title -->
                        <p class="title-desc">e receba <span>um cupom de 10€</span> na primeira compra</p><!-- End .title-desc -->
                    </div><!-- End .heading -->

                    <div class="row">
                        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        
           
    <form method="POST">
        <div class="input-group">
            <input type="email" name="nl_email" class="form-control" placeholder="Insira o seu Endereço de Email" aria-label="Email Adress" aria-describedby="newsletter-btn" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="subscribe" id="newsletter-btn"><span>Subscrever</span><i class="icon-long-arrow-right"></i></button>
            </div><!-- .End .input-group-append -->
        </div><!-- .End .input-group -->
    </form>

        </div><!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-newsletter bg-image -->
            <?php
        }
        ?>
    </form>
    <?php
}

if (isset($_POST['subscribe'])) {
    $subscricao = "SELECT * FROM newsletter WHERE email='" . $_POST['nl_email'] . "'";
    $result = mysqli_query($ligax, $subscricao);
    $n = mysqli_num_rows($result);
    if ($n > 0) {
        $registo = mysqli_fetch_assoc($result);
        $subscricao = $registo['subscricao'];
        if ($subscricao == 0) {
            include("emailnewsletter.php");
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
                };

                toastr["success"]("Aceda ao email para confirmar a sua subscrição");
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                    Swal.fire(
              'Newsletter',
              'Esse email já está subscrito na newsletter!',
              'error'
            )
              </script>
            <?php
        }
        // Add your code here if subscricao == 1
    } else {
        $query = "INSERT INTO newsletter (email,subscricao) VALUES ('" . $_POST['nl_email'] . "','0')";
        $result1 = mysqli_query($ligax, $query);
        include("emailnewsletter.php");
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
            };

            toastr["success"]("Aceda ao email para confirmar a sua subscrição");
        </script>
        <?php
    }
}
?>
        	<div class="footer-middle">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-sm-12 col-lg-6">
	            			<div class="widget widget-about">
	            				<img src="assets/images/logo.webp" class="footer-logo" alt="Footer Logo" width="105" height="25">
	            				<p></p>
	            				
	            				<div class="widget-about-info">
	            					<div class="row">
	            						<div class="col-sm-6 col-md-4">
	            							<span class="widget-about-title">Alguma Dúvida ? Contacte</span>
	            							<a href="tel:916865282">+351 916 865 282</a>
	            							<br>
	            							<a href="tel:916051709">+351 916 051 709</a>
	            							<br>
	            							<a href="tel:913085115">+351 913 085 115</a>
                                            <sub>Custos: chamada para rede móvel nacional</sub><br><br>
	            								<a href="tel:220811596">+351 220 811 596</a>
                                                <sub>Custos: chamada para rede fixa nacional</sub>
	            						</div><!-- End .col-sm-6 -->
	            						
	            					</div><!-- End .row -->
	            				</div><!-- End .widget-about-info -->
	            			</div><!-- End .widget about-widget -->
	            		</div><!-- End .col-sm-12 col-lg-3 -->

	            		<div class="col-sm-4 col-lg-2">
	            			<div class="widget">
	            				<h4 class="widget-title">Informação</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
	            					<li><a href="index.php?page=sobre_nos">Sobre Nós</a></li>
	            					
	            					<li><a href="index.php?page=contact">Contactos</a></li>
	            					
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-4 col-lg-3 -->

	            		<div class="col-sm-4 col-lg-2">
	            			<div class="widget">
	            				<h4 class="widget-title">Serviço ao Cliente</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
									<li><a href="index.php?page=metodos-de-pagamento">Métodos de Pagamento</a></li>
	               					<li><a href="termoscondicoes.pdf" target="_blank">Termos e Condições</a></li>
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-4 col-lg-3 -->

	            		<div class="col-sm-4 col-lg-2">
	            			<div class="widget">
	            				<h4 class="widget-title">Minha Conta</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
	            				
	            					<li><a href="index.php?page=carrinho">Ver Carrinho</a></li>
	            					<li><a href="index.php?page=favoritos">Meus Favoritos</a></li>
	            					
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-64 col-lg-3 -->
	            	</div><!-- End .row -->
	            </div><!-- End .container -->
	        </div><!-- End .footer-middle -->

	        <div class="footer-bottom">
	        	<div class="container">
	        		<p class="footer-copyright">@2023 Miguel & Alex. Todos os direitos reservados.</p><!-- End .footer-copyright -->
	        		<ul class="footer-menu">
	        			<li><a href="termoscondicoes.pdf" target="_blank">Termos de uso</a></li>
	        			<li><a href="#">Politica de Privacidade</a></li>
	        		</ul><!-- End .footer-menu -->

	        		<div class="social-icons social-icons-color">
	        			<span class="social-label">Redes Sociais</span>
    					<a href="https://www.facebook.com/profile.php?id=100040334871969" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
    				
    					<a href="https://www.instagram.com/migueltelemoveis/" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
    					
    					
    				</div><!-- End .soial-icons -->
	        	</div><!-- End .container -->
	        </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->