<?php include('../ligacao.php'); ?>
<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Painel Administrador | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <!--[if lt IE 9]>
															<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
															<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
															<![endif]-->

     <script src="toastr_notify/jquery-3.6.1.js"></script>
                              <script src="toastr_notify/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="toastr_notify/toastr.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

<?php

  



   if(isset($_SESSION["perfil"])){
if($_SESSION["perfil"]==3 || $_SESSION["perfil"]==2 ){
      $query="select * from users where id='".$_SESSION["id"]."'";
                  $result=mysqli_query($ligax,$query);
                  $registo=mysqli_fetch_assoc($result);
                  $nome=$registo['name'];
                  $id=$registo['id'];
   
        
   include("navegador.php");
include("header.php");



if(isset($_GET['page'])) { 

      $pagina=$_GET['page'];     
                        if($pagina=="validar_login")
                              include("validar_login.php");
                        elseif ($pagina=="listar_utilizadores") 
                          include("listar_utilizadores.php");
                        elseif ($pagina=="listar_produtos") 
                          include("listar_produtos.php");
                        elseif ($pagina=="error") 
                          include("404.php");
                        elseif ($pagina=="listar_produtos") 
                          include("listar_produtos.php");
                         elseif($pagina=="listar_newsletter")
                          include("listar_newsletter.php");
                      elseif($pagina=="ver_encomenda")
                          include("ver_encomenda.php");
                     elseif($pagina=="listar_encomendas")
               include("listar_encomendas.php");  
             elseif($pagina=="listar_subscricoes")
               include("listar_subscricoes.php");
              elseif($pagina=="listar_marcas")
               include("listar_marcas.php");
             elseif($pagina=="listar_categorias")
               include("listar_categorias.php");
             elseif($pagina=="editar_produtos")
               include("editar_produtos.php");
             elseif($pagina=="criar_produtos")
               include("criar_produtos.php");
             elseif($pagina=="criar_newsletter")
               include("criar_newsletter.php");
             elseif($pagina=="criar_categorias")
               include("criar_categorias.php");
             elseif($pagina=="criar_marcas")
               include("criar_marcas.php");
               elseif($pagina=="ordem_reparacao")
               include("ordem_reparacao.php");
               elseif($pagina=="nova_ordem_reparacao")
               include("criar_ordem_reparacao.php");
             
       
             elseif($pagina=="editar_categorias")
               include("editar_categorias.php");
               elseif($pagina=="editar_marcas")
               include("editar_marcas.php");
             elseif($pagina=="editar_newsletter")
               include("editar_newsletter.php");
               elseif($pagina=="editar_ordem_reparacao")
               include("editar_ordem_reparacao.php");
             elseif($pagina=="historico_newsletter")
                include("historico_newsletter.php");
            elseif($pagina=="listar_ticket")
                include("listar_ticket.php");
                       
      }
        

if(isset($_GET['page'])){
         $pagina=$_GET['page'];  
            if($pagina=="validar_login")
               include("home.php");
//PÁGINAS
      }else{ 
         include("home.php");
      }

 }else{
    include("404.php");
  }

}else{
    include("404.php"); 
}
 ?>
      <div class="control-sidebar-bg"></div>
    </div>
   
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
  <script src="https://kit.fontawesome.com/6d44596129.js" crossorigin="anonymous"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/raphael/raphael.min.js"></script>
    <script src="bower_components/morris.js/morris.min.js"></script>
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>
  </body>
</html>