<?php
include('ligacao.php');

require "PHPMailer/src/Exception.php";
   require "PHPMailer/src/OAuth.php";
   require "PHPMailer/src/PHPMailer.php";
   require "PHPMailer/src/POP3.php";
   require "PHPMailer/src/SMTP.php";

    //Instanciando os sNamespaces
    use PHPMailer\PHPMailer\PHPMailer;
  

    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array(
            'codigo_status' => null,
            'descricao_status' => '',
        );
        
        public function __get($attr){
            return $this->$attr;
         }

         public function __set($attr, $value){
             $this->$attr = $value;
         }

         public function mensagemValida(){

                if( empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                    return false;
                }
                else return true;
         } 
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/style.css">
     <meta name="google-signin-client_id" content="25171088812-cqjr2u6uobh3fn672earbruln00k797a.apps.googleusercontent.com">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Miguel e Alex telemóveis e comunicações</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Miguel e Alex Telemóveis e Comunicações">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logo.webp">
    <link rel="icon" type="image/png" sizes="32x32" href="logo-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="logo-16x16.png">
    <link rel="manifest" href="assets/images/logo.webp">
    <link rel="mask-icon" href="assets/images/logo.webp" color="#666666">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.webp">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" defer>
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css" defer>
    <link rel="stylesheet" href="assets/css/skins/skin-demo-2.css" defer>
    <link rel="stylesheet" href="assets/css/demos/demo-2.css">
    <script src="assets/js/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="assets/css/sweetalert2.min.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>

                              <script src="assets/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/toastr.min.css">
      <script src="assets/js/toastr.js" async defer></script>
</head>
<body>
<style>img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{display:none;}</style>

 <?php
                                     
                                        
                                
   

                                        if(isset($_POST['remover_favorito'])){
                                        $remove_product_carrinho="delete from favoritos where cod_produto='".$_POST['cod_produto']."' AND (id = '".$_SESSION['id']."' OR session_id = '".session_id()."')";
                                      
                                     
                                         $result2=mysqli_query($ligax,$remove_product_carrinho);
                                         
                                         ?>
                                         <script type="text/javascript">
                                           location.href="index.php?page=favoritos";
                                       </script>
                                         <?php
                                        }
                                        

    
      if(isset($_POST["adicionar_produto"])){ 
        $cod_produto=$_POST['cod_produto'];
        if(isset($_POST['prod_quant'])){
            $prod_quant=$_POST['prod_quant'];
        }else{
            $prod_quant=1;
        }
        
            if(isset($_SESSION["id"])){ //cliente autenticado
                $consulta="select count(*) as existe from carrinho where
                (cc_id like '".$_SESSION["id"]."' or cc_sessionid like '".session_id()."')
                and cc_cod_produto=$cod_produto";
            } else { // ainda não efectuou login
            $consulta="select count(*) as existe from carrinho where cc_sessionid like '".session_id()."'
            and cc_cod_produto=$cod_produto";
            
            }
        
            $resultado=mysqli_query($ligax,$consulta); // vai procurar na tabela carrinho algum pedido daquele produto
        if($resultado) { 
            $nr=mysqli_fetch_assoc($resultado);

            if($nr["existe"]!=0){ // o produto já existe no carrinho, loga acrescenta a esse registo apenas a nova quantidade 


            if(isset($_SESSION["id"])){ //cliente autenticado
                $consulta_carrinho="select * from carrinho where
                (cc_id like '".$_SESSION["id"]."' or cc_sessionid like '".session_id()."')
                and cc_cod_produto=$cod_produto";

            } else { // ainda não efectuou login
            $consulta_carrinho="select cc_quantidade from carrinho where cc_sessionid like '".session_id()."'
            and cc_cod_produto=$cod_produto";
            
            }


            $query=mysqli_query($ligax,$consulta_carrinho);
              $registo=mysqli_fetch_assoc($query);
              if(isset($_POST['prod_quant'])){
              $prod_quant=$registo['cc_quantidade']+$_POST['prod_quant'];
            }else{
                $prod_quant=$registo['cc_quantidade']+1;
                
            }

               if(isset($_SESSION["id"])){ //cliente autenticado
                $update_quantidade="update carrinho set cc_quantidade='$prod_quant' where
                (cc_id like '".$_SESSION["id"]."' or cc_sessionid like '".session_id()."')
                and cc_cod_produto=$cod_produto";
            } else { // ainda não efectuou login
          $update_quantidade="update carrinho set cc_quantidade='$prod_quant' where
                cc_sessionid like '".session_id()."'
                and cc_cod_produto=$cod_produto";
            
            }
            
 $query2=mysqli_query($ligax,$update_quantidade);
              

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

                        toastr["success"]("Produto já adicionado ao carrinho. Adicionado mais <?php echo $_POST['prod_quant'];?> ao mesmo.")
                </script>
                <?php
            } else {  // o produto ainda não existe no carrinho
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

                        toastr["success"]("Produto adicionado ao carrinho")
                </script>

                 <?php
                 

                    if(isset($_SESSION['id'])){
                        $insere="insert carrinho (cc_sessionid,cc_id,cc_cod_produto,cc_quantidade,cc_data) values
                    
                    ('".session_id()."','".$_SESSION['id']."','".$cod_produto."',".$prod_quant.",NOW());";
                    }else{
                    $insere="insert carrinho (cc_sessionid,cc_id,cc_cod_produto,cc_quantidade,cc_data) values
                    
                    ('".session_id()."','".session_id()."','".$cod_produto."',".$prod_quant.",NOW());";
                    }
                
                    
                    mysqli_query($ligax,$insere);
                }
            }
    
    }

    

if(isset($_GET['acao'])){
    
    if($_GET['acao']=='favoritar'){



            if(isset($_SESSION['id'])){
            $select="select * from favoritos where cod_produto='".$_GET['cod_produto']."' and (id='".$_SESSION['id']."' or session_id='".session_id()."')";
          
        }else{
                $select="select * from favoritos where cod_produto='".$_GET['cod_produto']."' and (id='".session_id()."' or session_id='".session_id()."')"; 
            }
            $result=mysqli_query($ligax, $select);
              $n=mysqli_num_rows($result);
              if($n==1){
                ?>

                 <script type="text/javascript">
            Swal.fire(
              'Favoritos',
              'Esse produto já se encontra nos favoritos!',
              'warning'
            )
        </script>
                <?php
              }else{

                $select4="select * from produtos where cod_produto='".$_GET['cod_produto']."'";
                
                $result4=mysqli_query($ligax,$select4);

                $registo4=mysqli_fetch_assoc($result4);
  $nome_produto=$registo4['nome'];
  $preco_produto=$registo4['preco'];
  $stock_produto=$registo4['stock'];

                if(isset($_SESSION['id'])){
            $insere1="insert into favoritos (cod_produto,id,session_id) values ('".$_GET['cod_produto']."','".$_SESSION['id']."','".session_id()."')";
        
        }else{
             $insere1="insert into favoritos (cod_produto,id,session_id) values ('".$_GET['cod_produto']."','".session_id()."','".session_id()."')";
             
        }


$result2=mysqli_query($ligax,$insere1);

if($result2){
        ?>
        <script type="text/javascript">
            Swal.fire(
              'Favoritos',
              'Foi adicionado aos favoritos com sucesso!',
              'success'
            )
        </script>

        <?php
        }

              }
             
        

       
    }
}



if (isset($_POST['adicionar_comentario'])) {
    $cod_produto=$_POST['cod_produto'];
    if (isset($_SESSION['perfil'])) {
        $select_encomenda_feita = "SELECT item_encomenda.cod_produto FROM item_encomenda, encomenda, produtos WHERE encomenda.id = '".$_SESSION['id']."' and item_encomenda.cod_produto='".$cod_produto."'";
        $result1 = mysqli_query($ligax, $select_encomenda_feita);

        if (mysqli_num_rows($result1) > 0) {
            
                $texto_comentario = $_POST['texto_comentario'];
                $titulo_comentario = $_POST['titulo_comentario'];
                $avaliacao_comentario = $_POST['avaliacao_comentario'];


                if (!empty($avaliacao_comentario)) {
                    $insere = "INSERT INTO comentarios (cod_produto, texto_comentario, titulo_comentario, avaliacao_comentario, id) VALUES ('".$cod_produto."','".$texto_comentario."','".$titulo_comentario."','".$avaliacao_comentario."','".$_SESSION['id']."')";
                    $result = mysqli_query($ligax, $insere);

                    if ($result) {
                        echo '<script type="text/javascript">
                            Swal.fire(
                                "Comentários",
                                "Comentário realizado com sucesso!",
                                "success"
                            )
                        </script>';
                    }
                } else {
                    echo '<script type="text/javascript">
                        Swal.fire(
                            "Comentários",
                            "Necessário selecionar pelo menos 1 estrela!",
                            "warning"
                        )
                    </script>';
                }
            
        } else {
            echo '<script>
                Swal.fire(
                    "Comentários",
                    "Não é possível criar um comentário acerca de um produto que nunca comprou.",
                    "error"
                )
            </script>';
        }
    } else {
        echo '<script type="text/javascript">
            Swal.fire(
                "Comentários",
                "Para adicionar uma avaliação tem de iniciar sessão ou entrar numa conta existente!",
                "warning"
            )
        </script>';
    }
}



        if(isset($_POST['submit_registar'])){
            $flag=false;
            $flag_email=false;
            $flag_pass=false;
            
            $name=$_POST['name'];
        
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            $re_pass=$_POST['re_pass'];
            
            
            /* Verificar se o email já existe */
            $query="select email from users where email='".$email."'";
            $result=mysqli_query($ligax,$query);
            $n=mysqli_num_rows($result);
            if($n>0){
                $flag=true;
                $flag_email=true;
            }   
            
            /* Validação de password */     
            if ($pass!=$re_pass || $pass=="") {
                $flag=true; $flag_pass=true;
            }   
            
            /* Existiu um erro */
            if($flag==true){ 
                if($flag_email==true) { ?>
                    <script> 
                        toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": true,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-right",
                                  "preventDuplicates": true,
                                  "onclick": null,
                                  "showDuration": "300",
                                  "hideDuration": "1000",
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("Existe uma conta associada com esse email")
                    </script>       
                <?php }
                if($flag_pass==true) { ?>
                    <script> 
                        toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": true,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-right",
                                  "preventDuplicates": true,
                                  "onclick": null,
                                  "showDuration": "300",
                                  "hideDuration": "1000",
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["error"]("Passwords não são iguais")
                    </script>       
                <?php }
            } else {    

                $pass = md5($pass);
                $insere="INSERT INTO users
                    (name,pass,email,date_register) VALUES ('".$name."','".$pass."','".$email."',now())";
                    
                $result=mysqli_query($ligax,$insere);
                if($result==1){ 
                    $id=mysqli_insert_id($ligax); //codigo do utilizador 
                    include("enviar_link_email.php");
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
                                  "showDuration": "300",
                                  "hideDuration": "1000",
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["success"]("Conta criada com sucesso");
                        
                    </script>       
                <?php } else {
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
                                  "showDuration": "300",
                                  "hideDuration": "1000",
                                  "timeOut": "3000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "show",
                                  "hideMethod": "fadeOut"
                            }

                        toastr["warning"]("Dados não inseridos!")
                    </script>       
                <?php
                }
            }
        }






if(isset($_GET['page'])) { 
			$pagina=$_GET['page'];     
                        if($pagina=="validar_login"){
                              include("validar_login.php");
                              
                        }
                        elseif($pagina=="validacao")
                                    include("validacao.php");
                        elseif($pagina=="validacaonewsletter")
                              include("validacaonewsletter.php");
			}
        
	
if(isset($_SESSION["perfil"])) {
		if(($_SESSION["perfil"])==3) include("menu_admin.php");
		else if(($_SESSION["perfil"])==2) include("menu_admin.php"); 
		else if(($_SESSION["perfil"])==1) include("menu_util.php"); 
	} else include("menu_visitante.php");
?>

<?php


?>
<?php
if(isset($_GET['page'])){
         $pagina=$_GET['page'];  
            if($pagina=="validar_login")
               include("home.php");
            elseif($pagina=="validacao")
               include("home.php");
            
            elseif($pagina=="carrinho")
                  include("cart.php");
                  elseif($pagina=="shopnow")
                  include("shopnow.php");           
            elseif($pagina=="dashboard_utilizador")

                    if(isset($_SESSION['perfil'])){
                  include("dashboard_utilizador.php");
              }else{
                ?>
                <script type="text/javascript">
                    Swal.fire(
              'Conta',
              'Para adicionar endereço tem de iniciar sessão ou entrar numa conta existente!',
              'warning'
            )
                </script>

                <?php
                include("home.php");
              }
             elseif($pagina=="contact")
                  include("contactos.php");
             elseif($pagina=="metodos-de-pagamento")
                  include("metodos-de-pagamento.php");
            elseif($pagina=="reset_password")
                  include("recuperar_password.php");
            elseif($pagina=="validacaonewsletter")
               include("home.php");
               elseif($pagina=="sobre_nos")
               include("about.php");
           elseif($pagina=="checkout_faturacao")
               include("checkout_faturacao.php");
           elseif($pagina=="checkout_entrega")
                if(isset($_SESSION['perfil'])){
                  include("checkout_entrega.php");
              }else{
                ?>
                <script type="text/javascript">
                    Swal.fire(
              'Conta',
              'Para proceder ao pagamento necessita de criar uma conta!',
              'warning'
            )
                </script>

                <?php
                include("home.php");
              }
            elseif($pagina=="detalhes_produto")
               include("detalhes_produto.php");
           elseif($pagina=="favoritos")
               include("wishlist.php");
            

//PÁGINAS
      }elseif(isset($_GET['pesquisa_produtos'])){
    include("shopnow.php");
}
      
      
      else{ 
        include("home.php");
      }
      
    include("footer.php");
      
      
 ?>



  <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
 
    <li class="nav-item">
        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Iniciar Sessão</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Criar Conta</a>
    </li>


                              
                                
                            </ul>
                            <div class="tab-content" id="tab-content-5" >
                                
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab" >
                                    <form action="index.php?page=validar_login" method="POST">
                                        <div class="form-group">
                                            <label for="singin-email1">Email *</label>
                                    
                                            <input type="text" class="form-control" id="singin-email1" name="email" required autocomplete="given-email">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Palavra Passe *</label>
                                            <input type="password" class="form-control" id="singin-password" name="pass" required>
                                        </div><!-- End .form-group -->
                                        <br>
                <a href="index.php?page=reset_password" class="forgot-link" data-bs-target="#recuperar-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Esqueceu-se da palavra-passe?</a>

                <br>
              
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Entrar </span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Lembrar me</label>
                                            </div><!-- End .custom-checkbox -->
                      
                                     </form>
                                           
                                        </div><!-- End .form-footer -->
                                        <div class="form-choice">
                                        
                                    </div><!-- End .form-choice -->
                                   
                                   
                                </div><!-- .End .tab-pane -->
                 

                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="" method="POST">
                   <div class="form-group">
                                            <label for="register-email">Nome *</label>
                                            <input type="text" class="form-control" id="nome" name="name" required autocomplete="given-name">
                                        </div><!-- End .form-group -->
                  
                    

                                        <div class="form-group">
                                            <label for="register-email">Endereço de Email *</label>
                                            <input type="email" class="form-control" id="register-email" name="email" required autocomplete="given-email" >
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Palavra Passe *</label>
                                            <input type="password" class="form-control" min="5" max="15"  id="register-password" name="pass" required>
                                        </div><!-- End .form-group -->
                    
                      <div class="form-group">
                                            <label for="register-password1">Confirmar Palavra Passe *</label>
                                            <input type="password" class="form-control" minlength="5" maxlength="15" id="register-password1" name="re_pass" required>
                                        </div><!-- End .form-group -->
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">Eu concordo com a <a href="#">politica de privacidade</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        <div class="form-footer">
                                            <button type="submit" name="submit_registar" class="btn btn-outline-primary-2">
                                                <span>Registar</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                          
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                 
                                 
                               
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

        <?php

if (isset($_POST["submit_recuperar"])) {
    include('codigo_recuperar.php');
    $email = $_POST["email_recuperar"];
    $procura = "SELECT * FROM users WHERE email='" . $email . "' ;";
    $result = mysqli_query($ligax, $procura);
    $nregistos = mysqli_num_rows($result);
    $registo = mysqli_fetch_assoc($result);

    if ($nregistos == 0) {
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
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "show",
                "hideMethod": "fadeOut"
            };

            toastr["error"]("Conta não registrada");
        </script>
        <?php
    } else if ($nregistos == 1) {
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
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "show",
                "hideMethod": "fadeOut"
            };

            toastr["success"]("Enviada recuperação de senha para o seu email");
        </script>
        <?php

        $email = $registo["email"]; // Email to which the form will be sent

        // Generate password
        $password = gerar_senha(10, true, true, true, true);

        // Update the record with the new password
        $sql = "UPDATE users SET pass='" . md5($password) . "' WHERE email='" . $email . "';";
        $result = mysqli_query($ligax, $sql);

        // Send email to the contact's email to confirm the data reception
        $mensagem_1 = new Mensagem();

        $mensagem_1->__set('para', $email); // Contact's email
        $mensagem_1->__set('assunto', utf8_decode("Miguel & Alex - Recuperação de Senha"));
        $mensagem_1->__set('mensagem', "<table style='border-collapse: separate; width: 100%; background: rgb(255, 255, 255); border-radius: 8px;'>
              <tbody><tr>
                <td style='font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 30px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; width: 100%;'>
                    <tbody><tr>
                      <td style='font-size: 14px; vertical-align: top;'>
                          <div style='text-align: center; margin-bottom: 20px; width: 100%; padding-top: 30px; padding-bottom: 30px;'><img width='240' height='auto' src='https://i.ibb.co/qksSz6m/logo.webp' alt='Teya' title='Teya' role='presentation'>
</div>
                        <h1 style='font-size: 20px; font-weight: 600; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>
                            Olá {$email}.
                        </h1>
                        <p style='font-size: 16px; font-weight: normal; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>  </p><p style='color: rgb(21, 21, 21);'>Solicitou a recuperação da sua senha.<br><br>
            A sua nova senha é <b>$password</b></p>

        
<p style='color: rgb(51, 51, 51);'>
Por favor, não responda a este email. A sua única função é informar.<br><br>
            A<a style='color: rgb(1, 74, 122); font-weight: 600; border-radius: 8px; background-color: transparent;' href=''>Atenciosamente, <br>Equipa Miguel & Alex.</a>
</p>

                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>");

        if (!$mensagem_1->mensagemValida()) {
            echo "Mensagem não é válida";
        }

        $mail_1 = new PHPMailer(true);

        try {
            $mail_1->isHTML(true); // Set email format to HTML
            $mail_1->SMTPDebug = false; // Enable verbose debug output
            $mail_1->isSMTP(); // Send using SMTP
            $mail_1->Host = 'smtp.sapo.pt'; // Set the SMTP server to send through
            $mail_1->SMTPAuth = true; // Enable SMTP authentication
            $mail_1->Username = 'miguelalextelemoveiscomunicacoes@sapo.pt'; // SMTP username
            $mail_1->Password = 'MiguelAlexPorto2023'; // SMTP password
            $mail_1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail_1->Port = 587; // TCP port to connect to

            $mail_1->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel & Alex Loja Online');
            $mail_1->addAddress($mensagem_1->__get('para')); // Add a recipient

            $mail_1->Subject = $mensagem_1->__get('assunto');
            $mail_1->Body = $mensagem_1->__get('mensagem');
            $mail_1->AltBody = 'É necessário utilizar um cliente que suporte HTML para ter acesso total ao conteúdo dessa mensagem';

            $mail_1->send();
            $mensagem_1->status['codigo_status'] = 1;
            $mensagem_1->status['descricao_status'] = 'E-mail enviado com sucesso! Verifique a sua caixa de correio eletrónico!';

        } catch (Exception $e_1) {
            $mensagem_1->status['codigo_status'] = 2;
            $mensagem_1->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor, tente novamente mais tarde. Detalhes do erro: ' . $mail_1->ErrorInfo;

            // Alguma lógica que armazene o erro para posterior análise por parte do programador
        }
    }
}
?>


<div class="modal fade" id="comentario-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="comentario-tab" data-toggle="tab" href="#comentario" role="tab" aria-controls="comentario" aria-selected="true">Avaliação</a>
                                </li>
                                
                                 
                              
                                
                            </ul>
                            <div class="tab-content" id="tab-content-5" >
                                <div class="tab-pane fade show active" id="comentario" role="tabpanel" aria-labelledby="comentario-tab" >
                                   <form action="" method="POST">
    <div class="form-group">
        <label for="titulo_comentario">Título *</label>
        <input type="text" class="form-control" id="titulo_comentario" name="titulo_comentario" required autocomplete="given-titulo">
    </div><!-- End .form-group -->

    <div class="form-group">
        <label for="texto_comentario">Comentário *</label>
        
            <textarea class="form-control" id="texto_comentario" name="texto_comentario" style="resize: none;" required></textarea>
    </div><!-- End .form-group -->
    <br>
    <style type="text/css">
        .estrelas input[type=radio]{
    display: none;
}.estrelas label i.fa:before{
    content: '\f005';
    color: #FC0;
}.estrelas  input[type=radio]:checked  ~ label i.fa:before{
    color: #CCC;
}
    </style>
    <div class="form-group">
        Avaliação *

<input type="hidden" name="cod_produto" value="<?php if(isset($_GET['cod_produto'])) echo $_GET['cod_produto']; ?>">
<div class="estrelas" id="avaliacao_comentario">
  <input type="radio" id="vazio" name="avaliacao_comentario" value="" checked>
  
  <label for="estrela_um"><i class="fa fa-star"></i></label>
  <input type="radio" id="estrela_um" name="avaliacao_comentario" value="1">
  
  <label for="estrela_dois"><i class="fa fa-star"></i></label>
  <input type="radio" id="estrela_dois" name="avaliacao_comentario" value="2">
  
  <label for="estrela_tres"><i class="fa fa-star"></i></label>
  <input type="radio" id="estrela_tres" name="avaliacao_comentario" value="3">
  
  <label for="estrela_quatro"><i class="fa fa-star"></i></label>
  <input type="radio" id="estrela_quatro" name="avaliacao_comentario" value="4">
  
  <label for="estrela_cinco"><i class="fa fa-star"></i></label>
  <input type="radio" id="estrela_cinco" name="avaliacao_comentario" value="5"><br><br>
</div>

    </div><!-- End .form-group -->

    
    <br>

    <div class="form-footer">
        <button type="submit" name="adicionar_comentario" class="btn btn-outline-primary-2">
            <span>Adicionar </span>
            <i class="icon-long-arrow-right"></i>
        </button>
    </div>
</form>

                                           
                                        </div><!-- End .form-footer -->
                                        
                                   
                                   
                                </div><!-- .End .tab-pane -->
                 
                                 
                                 
                               
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->



   <?php

                                        if(isset($_POST['submit_suporte'])){

                     
                                             $assunto=$_POST["assunto"];
         $contact_question=$_POST["contact_question"];
                                       

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

                        toastr["success"]("Ticket criado com sucesso!")
                        toastr["success"]("Verifique o seu email!")
                        
                        
                        
                    </script>
                    
                    <?php 


$assunto=utf8_decode($assunto);
       $contact_question=utf8_decode($contact_question);


         $insert_ticket="insert into ticket (titulo,descricao,estado,id,data_ticket) VALUES('".$assunto."','".$contact_question."','0','".$_SESSION['id']."',NOW())";
        
        
        
     mysqli_query($ligax, $insert_ticket);
$id = mysqli_insert_id($ligax);
                                        
 $mensagem_1 = new Mensagem();

    $mensagem_1->__set('para' , $_SESSION['email']); //email do contacto
    $mensagem_1->__set('assunto' , "Miguel e Alex: Suporte");
    $mensagem_1->__set('mensagem' , "<table style='border-collapse: separate; width: 100%; background: rgb(255, 255, 255); border-radius: 8px;'>
              <tbody><tr>
                <td style='font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 30px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; width: 100%;'>
                    <tbody><tr>
                      <td style='font-size: 14px; vertical-align: top;'>
                          <div style='text-align: center; margin-bottom: 20px; width: 100%; padding-top: 30px; padding-bottom: 30px;'><img width='240' height='auto' src='https://i.ibb.co/qksSz6m/logo.webp' alt='Teya' title='Teya' role='presentation'>
</div>
                        <h1 style='font-size: 20px; font-weight: 600; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>
                             Formulário submetido com sucesso. Aguarde um momento. 
                        </h1>
                        <p style='font-size: 16px; font-weight: normal; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>  </p><p style='color: rgb(21, 21, 21);'> Entretanto clique no botão abaixo para ser redirecionado ao seu ticket-suporte.</p>

          
<a style='transition: all 0.3s ease 0s; border-radius: 8px; background: rgb(1, 74, 122); font-weight: 600; border: none; cursor: pointer; display: block; font-size: 1em; line-height: 1.86875rem; padding: 0.575rem 1.15rem; font-family: Roboto-Medium, sans-serif; text-align: center; text-decoration: none; color:white;' href='http://localhost/pap/verticket.php?cod_ticket=".$id."'>
Abrir ticket</a>

<p style='color: rgb(51, 51, 51);'>
Ao continuar confirmo que li e concordo com os <a style='color: rgb(1, 74, 122); font-weight: 600; border-radius: 8px; background-color: transparent;' href='http://localhost/pap/termoscondicoes.pdf'>termos e condições</a> que regem meu uso dos serviços da Miguel Alex Telemóveis Comunicações .
</p>

<p style='color: rgb(21, 21, 21);'></p>
                        <hr style='width: 85%; margin: 24px auto; border: 1px solid rgb(224, 224, 224);'>
                        <p style='font-size: 14px; color: rgb(102, 102, 102);'>Ao clicar no botão acima irá ser redirecionado para o nosso suporte. Pedimos que tenha calma enquanto um dos nossos  <a style='color: rgb(1, 74, 122); background-color: transparent; font-weight: 600; border-radius: 8px;' href=''>técnicos</a> o atende.<br><br>Atenciosamente,<br>Equipa Miguel & Alex. </p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>

    ");

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

        $mail_1->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel e Alex');
        $mail_1->addAddress($mensagem_1->__get('para'));     // Add a recipient

        $headers_1 = "MIME-Version: 1.1/r/n";
        $headers_1 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
        $headers_1 .= "From: Catchy Store/r/n"; //Devem personalizar com o nome do vosso projeto
        $headers_1 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
      
       
        $mail_1->Subject = $mensagem_1->__get('assunto');
        $mail_1->Body    = $mensagem_1->__get('mensagem');
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
                                        ?>
<div class="modal fade" id="suporte-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="comentario-tab" data-toggle="tab" href="#comentario" role="tab" aria-controls="comentario" aria-selected="true">Suporte</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="comentario" role="tabpanel" aria-labelledby="comentario-tab">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="titulo_comentario">Assunto *</label>
                                        <input type="text" class="form-control" id="titulo_comentario" name="assunto" required autocomplete="given-titulo">
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="texto_comentario">Questão *</label>
                                        <textarea class="form-control" id="texto_comentario" name="contact_question" style="resize: none;" required></textarea>
                                    </div><!-- End .form-group -->

                                    <br>

                                    <div class="form-footer">
                                        <button type="submit" name="submit_suporte" class="btn btn-outline-primary-2">
                                            <span>Criar Ticket</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal fade -->

    

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.plugin.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/6d44596129.js" crossorigin="anonymous"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demos/demo-2.js"></script>
<!-- molla/index-1.html  22 Nov 2019 09:55:32 GMT -->


</body>
</html>