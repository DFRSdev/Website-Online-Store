<?php
include('ligacao.php');



  if (isset($_POST['save']) && isset($_POST['resposta'])) {
    $cod_ticket = $_GET['cod_ticket'];
    $resposta = $_POST['resposta'];

    // Assuming you have a column named `cod_ticket` in the table `resposta_ticket`
    $insert_resposta = "INSERT INTO resposta_ticket (cod_ticket, id, mensagem,data_resposta) VALUES ('$cod_ticket', '{$_SESSION['id']}', '$resposta',NOW())";
    $result = mysqli_query($ligax, $insert_resposta);

}
?>

<html lang="en" class="light">
        <head>
                <title>Miguel & Alex - Ver Ticket</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="assets/css/ticket/hexa.min.css" rel="stylesheet">
                <link href="assets/css/ticket/ticket.css" rel="stylesheet">
                <link rel="stylesheet" href="assets/css/ticket/core.min.css">                                   
        </head>
    
                  
                            <?php






                            $select_info_ticket="select * from ticket where cod_ticket='".$_GET['cod_ticket']."'";
                            $result=mysqli_query($ligax,$select_info_ticket);
                            if( mysqli_num_rows($result) > 0 ){
                            $registo=mysqli_fetch_assoc($result);

                            $titulo=$registo['titulo'];
                            $descricao=$registo['descricao'];
                            $estado=$registo['estado'];
                            $reclamado=$registo['reclamado'];
                            $id=$registo['id'];
                            
                            $data_ticket=$registo['data_ticket'];
                            $select_info="select name,email from users where id='".$id."'";
                            $result_dados=mysqli_query($ligax,$select_info);
                            $registo3=mysqli_fetch_assoc($result_dados);
                            $nome=$registo3['name'];
                            $email=$registo3['email'];
                            }else{
                              echo "<script>location.href='404.php';</script>";
                            }


                            ?>
                                                        
                            <div class="site-holder container mini-sidebar">
     <div class="box-holder">
       <div class="content main-content onload">
         <div id="top_bar_alerts_holder"></div>
         <div class="items-center pt-5 pb-2 border-0 border-b border-solid sm:flex sm:h-20 hexa-page-header">
           <h2 class="items-center text-lg font-medium truncate sm:flex sm:ml-5 sm:mr-5">
             <span>Ver Ticket #<?php echo $_GET['cod_ticket']; ?></span>
           </h2>
           <div class="sm:ml-auto">
             <ol class="breadcrumb bg-transparent p-0 pt-2 mb-0">
              <li>
                 <a class="text-gray-600 leading-8 sm:leading-5" href="index.php"> Home </a>
               </li>
               
               <li class="text-gray-400"> Ver Ticket </li>
             </ol>
           </div>
         </div>
         <script src="https://kit.fontawesome.com/28864472a5.js" crossorigin="anonymous"></script>
         <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
         <div class="alert alert-warning alert-block mb-0" style="    background-color: #2e7ecb;">
           <div class="absolute bottom-0 right-0 m-5 opacity-25 alert-watermark">
             <i class="fas fa-ticket-alt fa-4x fa-inverse"></i>
           </div>
           <h4 style="color:white;"><?php echo $titulo; ?></h4>
           <ul class="list-inline">
             <li class="mr-2" style="color:white;">
               <span aria-hidden="true" class="icon icon-event"></span> <?php echo $data_ticket; ?>
             </li>
             <li style="color:white;">
               <span aria-hidden="true" class="icon icon-tag"></span> Resposta do Cliente ( <a style="text-transform: lowercase;color:white;" href="/viewticket.php?tid=302245&amp;c=6WliSVwk&amp;closeticket=true">Fechar Ticket</a>)
             </li>
           </ul>
         </div>
             <?php if ($_SESSION['id'] == $reclamado) { ?>
    <div class="panel panel-info panel-reply hidden-print mb-0">
        <div class="panel-heading" id="btnTicketReply">
    <h3 class="panel-title">
        <i class="fa-solid fa-pencil"></i> Responder
    </h3>
   
</div>



        <div class="pr-0 panel-body panel-body-collapsed">
            <form method="POST" action="verticket.php?cod_ticket=<?php echo $_GET['cod_ticket']; ?>"
                enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="inputMessage">Mensagem</label>
                    <textarea id="resposta" name="resposta"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="save" value="Enviar">
                </div>
            </form>
        </div>

    
    </div>


<?php }elseif ($_SESSION['id']==$id) {
  ?>
 <div class="panel panel-info panel-reply hidden-print mb-0">
        <div class="panel-heading" id="btnTicketReply">
            <h3 class="panel-title">
                <i class="fa-solid fa-pencil"></i> Responder
            </h3>
        </div>

        <div class="pr-0 panel-body panel-body-collapsed">
            <form method="POST" action="verticket.php?cod_ticket=<?php echo $_GET['cod_ticket']; ?>"
                enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="inputMessage">Mensagem</label>
                    <textarea id="resposta" name="resposta"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="save" value="Enviar">
                </div>
            </form>
        </div>

    </div>



<?php }elseif(isset($_SESSION['perfil']) && ($_SESSION['perfil']==2 || $_SESSION['perfil']==3)) { ?>
    <div class="panel panel-info panel-reply hidden-print mb-0">
        <div class="panel-heading" id="btnTicketReply">
            <h3 class="panel-title">
                <i class="fa-solid fa-pencil"></i> Permitido apenas visualização
            </h3>
        </div>
    </div>
<?php }else{echo "  <script>location.href='404.php';</script>";} ?>
          

          <?php
          $select_resposta="select id, mensagem,data_resposta from resposta_ticket where cod_ticket='".$_GET['cod_ticket']."' ORDER BY cod_resposta DESC";
           $result_aa= mysqli_query($ligax, $select_resposta);

           while($registo_resposta=mysqli_fetch_assoc($result_aa)){
                 $select_nome="select name,perfil from users where id='".$registo_resposta['id']."'";
                $result3=mysqli_query($ligax,$select_nome);
                $registo2=mysqli_fetch_assoc($result3);

          ?>
         <div class="overflow-hidden ticket-reply">
           <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
             <div class="flex flex-wrap items-center justify-between -mt-4 -ml-4 sm:flex-no-wrap">
               <div class="mt-4 ml-4">
                 <div class="flex items-center">
                   <div class="flex-shrink-0">
                     <img class="w-10 h-10 rounded-full" src="showfile_fotoperfil.php?id=<?php echo $registo_resposta['id']; ?>" onerror="this.src='../blank.jpg'">
                   </div>
                   <div class="ml-4">
                     <h3 class="m-0 text-lg font-medium leading-6 text-gray-500"> <?php echo $registo2['name']; ?> <span> <?php if ($registo2['perfil'] == 2) {
  echo 'Admin</button>';
} ?> </span>
                     </h3>
                     <p class="p-0 m-0 text-sm leading-5 text-gray-500"> <?php if ($registo2['perfil'] == 2) {
  echo 'Admin</button>';
} else {echo $email;}?> </p>
                   </div>
                 </div>
               </div>
               <div class="flex flex-shrink-0 mt-4 ml-4">
                 <span class="inline-flex rounded-md">
                   <div class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 rounded-md">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1 text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <circle cx="12" cy="12" r="10"></circle>
                       <polyline points="12 6 12 12 16 14"></polyline>
                     </svg>
                     <span> <?php echo $registo_resposta['data_resposta']; ?> </span>
                   </div>
                 </span>
               </div>
             </div>
           </div>
           <div class="px-4 py-5 ticket-reply-body sm:p-6">
             <div class="p-0 m-0">
               
              <?php echo $registo_resposta['mensagem']; ?>
             </div>
             
           </div>
         </div>
<?php } ?>



         <div class="overflow-hidden ticket-reply">
           <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
             <div class="flex flex-wrap items-center justify-between -mt-4 -ml-4 sm:flex-no-wrap">
               <div class="mt-4 ml-4">
                 <div class="flex items-center">
                   <div class="flex-shrink-0">
                     <img class="w-10 h-10 rounded-full" src="showfile_fotoperfil.php?id=<?php echo $id; ?>" alt="Gravatar">
                   </div>
                   <div class="ml-4">
                     <h3 class="m-0 text-lg font-medium leading-6 text-gray-500"> <?php echo $nome; ?> 
                     </h3>
                     <p class="p-0 m-0 text-sm leading-5 text-gray-500"> <?php echo $email; ?> </p>
                   </div>
                 </div>
               </div>
               <div class="flex flex-shrink-0 mt-4 ml-4">
                 <span class="inline-flex rounded-md">
                   <div class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 rounded-md">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1 text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <circle cx="12" cy="12" r="10"></circle>
                       <polyline points="12 6 12 12 16 14"></polyline>
                     </svg>
                     <span> <?php echo $data_ticket; ?> </span>
                   </div>
                 </span>
               </div>
             </div>
           </div>
           <div class="px-4 py-5 ticket-reply-body sm:p-6">
             <div class="p-0 m-0">
               <p><?php echo $descricao; ?></p>
             </div>
           </div>
         </div>


         <br>
         <br>
       </div>
       <!--/.content-->
     </div>
   </div>


        <script type="text/javascript">
            function validateForm() {
                var editorData = CKEDITOR.instances.resposta.getData().trim();
                if (editorData === '') {
                    alert("Por favor, preencha o campo de resposta.");
                    return false;
                }
            }
            CKEDITOR.replace('resposta');
        </script>