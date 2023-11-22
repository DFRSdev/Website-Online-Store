<?php

    //Instanciando os sNamespaces
    use PHPMailer\PHPMailer\PHPMailer;
  


    if(isset($_POST["submit"])){

       
        $name=$_POST["name"];
         $email=$_POST["email"];
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

                        toastr["success"]("Formulário de Contacto enviado com sucesso.")
                        toastr["success"]("Verifique o seu email!")
                        
                        
                        
                    </script>
                    
                    <?php 


     $name=utf8_decode($name);
      $assunto=utf8_decode($assunto);
       $contact_question=utf8_decode($contact_question);
       
  

     $mensagem_2 = new Mensagem();

    $mensagem_2->__set('para' , 'miguelalextelemoveiscomunicacoes@sapo.pt'); //email do contacto
    $mensagem_2->__set('assunto' , "Miguel e Alex: Novo Formulario Suporte");
    $mensagem_2->__set('mensagem' , "
        <h3>Novo Formulario Suporte</h3><br><br>
        <font size=3><b>Nome Completo: </b>{$name}<br><br>
        <b>Email:</b> {$email}        <br><br>
        <b>Assunto: </b>{$assunto}<br><br>
        <b>Dúvida/Pergunta:</b> {$contact_question}<br><br>

        Atenciosamente,
        Miguel & Alex Telemóveis Comunicações.
        </font>");

    if(!$mensagem_2->mensagemValida()){
            echo "Mensagem não é válida";
    }

   $mail_2 = new PHPMailer(true);

   try {
         $mail_2->isHTML(true);                                  // Set email format to HTML
        $mail_2->SMTPDebug = false;                      // Enable verbose debug output
        $mail_2->isSMTP();                                            // Send using SMTP
        $mail_2->Host       = 'smtp.sapo.pt';                    // Set the SMTP server to send through
        $mail_2->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail_2->Username   = 'miguelalextelemoveiscomunicacoes@sapo.pt';                     // SMTP username
        $mail_2->Password   = 'MiguelAlexPorto2023';                               // SMTP password
        $mail_2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail_2->Port       = 587;                                    // TCP port to connect to

        $mail_2->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel e Alex Suporte');
        $mail_2->addAddress($mensagem_2->__get('para'));     // Add a recipient

        $headers_2 = "MIME-Version: 1.1/r/n";
        $headers_2 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
        $headers_2 .= "From: Miguel Alex/r/n"; //Devem personalizar com o nome do vosso projeto
        $headers_2 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
      
       
        $mail_2->Subject = $mensagem_2->__get('assunto');
        $mail_2->Body    = $mensagem_2->__get('mensagem');;
        $mail_2->AltBody = 'É necessario utilizar um cliente que suport HTML para ter acesso total ao conteúdo dessa mensagem';

        $mail_2->send();
        $mensagem_2->status['codigo_status'] = 1;
        $mensagem_2->status['descricao_status'] = 'E-Mail enviado com secesso!<br> Vá até à sua caixa de correio eletrónico!';

    } catch (Exception $e_2) {

        $mensagem_2->status['codigo_status'] = 2;
        $mensagem_2->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail_2->ErrorInfo;

    //alguma lógica que armazene o erro para posterior análise por parte do programador
    }

//Envio de mensagem para o email do contacto a confirmar a receção dos dados:

    $mensagem_1 = new Mensagem();

    $mensagem_1->__set('para' , $_POST['email']); //email do contacto
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
                             Formulário submetido com sucesso. Aguarde um momento. Entretanto irá receber um email de um administrador do website.
                        </h1>
                        <p style='font-size: 16px; font-weight: normal; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>  </p><p style='color: rgb(21, 21, 21);'> Entretanto clique no botão abaixo para ser redirecionado ao seu ticket-suporte.</p>

          

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
    <div class="page-wrapper">
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contactos</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="container">
	        	<div class="page-header page-header-big text-center" style="background-image: url('assets/images/contact-header-bg.webp')">
        			<h1 class="page-title text-white">Contactos<span class="text-white">
	        	</div><!-- End .page-header -->
            </div><!-- End .container -->

            <div class="page-content pb-0">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-6 mb-2 mb-lg-0">
                			<h2 class="title mb-1">Informações de Contacto</h2><!-- End .title mb-2 -->
                			<p class="mb-3">Nesta secção, poderá consultar as nossas informações de contacto, nomeadamente a nossa localização, horário de funcionamento, endereço de email profissional e número de telefone profissional.</p>
                			<div class="row">
                				<div class="col-sm-7">
                					<div class="contact-info">
                						<h3>Loja Física</h3>

                						<ul class="contact-list">
                							<li>
                								<i class="icon-map-marker"></i>
	                							Rua do Valado, 18, São Paio de Oleiros, Portugal
	                						</li>
                							<li>
                								<i class="icon-phone"></i>
                								<a href="tel:#">+351 916 865 282</a>
                							</li>
                							<li>
                								<i class="icon-envelope"></i>
                								<a href="mailto:#">miguelbrandao38@gmail.com</a>
                							</li>
                						</ul><!-- End .contact-list -->
                					</div><!-- End .contact-info -->
                				</div><!-- End .col-sm-7 -->

                				<div class="col-sm-5">
                					<div class="contact-info">
                						<h3>Loja Física</h3>

                						<ul class="contact-list">
                							<li>
                								<i class="icon-clock-o"></i>
	                							<span class="text-dark">Segunda-Sexta</span> <br>9:00-19:30
	                						</li>
                							<li>
                								<i class="icon-calendar"></i>
                								<span class="text-dark">Sábado</span> <br>9:00-18:00
                							</li>
                						</ul><!-- End .contact-list -->
                					</div><!-- End .contact-info -->
                				</div><!-- End .col-sm-5 -->
                			</div><!-- End .row -->
                		</div><!-- End .col-lg-6 -->
                		<div class="col-lg-6">
                			<h2 class="title mb-1">Envie-nos a sua dúvida?</h2><!-- End .title mb-2 -->

                			<form action="" class="contact-form mb-3" method="POST">
                				<div class="row">
                					<div class="col-sm-6">
                                        <label for="cname" class="sr-only">Nome</label>
                						<input type="text" class="form-control" name="name" value="" id="name" placeholder="Nome *" required>
                					</div><!-- End .col-sm-6 -->

                					<div class="col-sm-6">
                                        <label for="cemail" class="sr-only">Endereço de Email</label>
                						<input type="email" class="form-control" name="email" id="email" value="" placeholder="Endereço de Email *" required>
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->

                				<div class="row">

                					<div class="col-sm-6">
                                        <label for="subject" class="sr-only">Assunto</label>
                						<input type="text" class="form-control" name="assunto" id="subject" name="assunto" placeholder="Assunto *">
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->

                                <label for="cmessage" class="sr-only">Mensagem</label>
                				<textarea class="form-control" cols="30" rows="4" id="message" name="contact_question" required placeholder="Mensagem *"></textarea>

                				<button type="submit" name="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                					<span>Enviar</span>
            						<i class="icon-long-arrow-right"></i>
                				</button>
                			</form><!-- End .contact-form -->
                		</div><!-- End .col-lg-6 -->
                	</div><!-- End .row -->

                	<hr class="mt-4 mb-5">

                
                </div><!-- End .container -->
            
            </div><!-- End .page-content -->
        </main><!-- End .main -->
    </div><!-- End .page-wrapper -->
