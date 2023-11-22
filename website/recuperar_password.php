<?php


// Instanciating the namespaces
use PHPMailer\PHPMailer\PHPMailer;




function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos) {
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contains uppercase letters
    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contains lowercase letters
    $nu = "0123456789"; // $nu contains numbers
    $si = "!@#$%&*()_+="; // $si contains symbols
    $password = "";

    if ($maiusculas) {
        // If $maiusculas is true, shuffle and add $ma to $password
        $password .= str_shuffle($ma);
    }

    if ($minusculas) {
        // If $minusculas is true, shuffle and add $mi to $password
        $password .= str_shuffle($mi);
    }

    if ($numeros) {
        // If $numeros is true, shuffle and add $nu to $password
        $password .= str_shuffle($nu);
    }

    if ($simbolos) {
        // If $simbolos is true, shuffle and add $si to $password
        $password .= str_shuffle($si);
    }

    // Return the shuffled password with length defined by $tamanho
    return substr(str_shuffle($password), 0, $tamanho);
}

if (isset($_POST["submit_recuperar"])) {
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

                
            
<br><br><br>
           
            <div class="container">
            <div class="form-box">
            <div class="form-tab">
            <ul class="nav nav-pills nav-fill" role="tablist">
   <li class="nav-item">
       <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#" role="tab" aria-controls="signin-2" aria-selected="false"> Recuperar Password</a>
   </li>
 
</ul>

  <div class="tab-pane fade show" id="recuperar" role="tabpanel" aria-labelledby="recuperar-tab" >
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="singin-email">Email *</label>
                                            <input type="text" class="form-control" id="singin-email" name="email_recuperar" required>
                                        </div><!-- End .form-group --> 
                                        <div class="form-footer">
                                            <button type="submit" name="submit_recuperar" class="btn btn-outline-primary-2">
                                                <span>Recuperar </span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                        </div><!-- End .form-footer -->
                      
                                     </form>
                                           
                                        </div><!-- End .form-footer -->
   </div><!-- .End .tab-pane -->
</div><!-- End .tab-content -->
</div><!-- End .form-tab -->
            </div><!-- End .form-box -->
            </div><!-- End .container -->
      <br><br><br>
           