<?php


    //Instanciando os sNamespaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem1{
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


//Dados do formulário de registo
$email=$_POST['nl_email'];

	
    
//Envio de mensagem para o email do contacto a confirmar a receção dos dados:

    $mensagem_1 = new Mensagem1();
    $mensagem_1->__set('para' , $_POST['nl_email']); //email do contacto
    $mensagem_1->__set('assunto' , "Miguel e Alex: Newsletter");
    $mensagem_1->__set('mensagem' , "<table style='border-collapse: separate; width: 100%; background: rgb(255, 255, 255); border-radius: 8px;'>
              <tbody><tr>
                <td style='font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 30px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; width: 100%;'>
                    <tbody><tr>
                      <td style='font-size: 14px; vertical-align: top;'>
                          <div style='text-align: center; margin-bottom: 20px; width: 100%; padding-top: 30px; padding-bottom: 30px;'><img width='240' height='auto' src='https://i.ibb.co/qksSz6m/logo.webp' alt='Teya' title='Teya' role='presentation'>
</div>
                        <h1 style='font-size: 20px; font-weight: 600; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>
                            Email de verificação da Newsletter:
                        </h1>
                        <p style='font-size: 16px; font-weight: normal; margin: 0px 0px 15px; color: rgb(21, 21, 21);'>  </p><p style='color: rgb(21, 21, 21);'>Para ativar a newsletter necessitamos de verificar o seu email, por favor carregue no botão abaixo.</p>

          
<a style='transition: all 0.3s ease 0s; border-radius: 8px; background: rgb(1, 74, 122); font-weight: 600; border: none; cursor: pointer; display: block; font-size: 1em; line-height: 1.86875rem; padding: 0.575rem 1.15rem; font-family: Roboto-Medium, sans-serif; text-align: center; text-decoration: none; color:white;' href='http://localhost/pap/index.php?page=validacaonewsletter&email=$email'>
Verifique o email</a>

<p style='color: rgb(51, 51, 51);'>
Ao continuar confirmo que li e concordo com os <a style='color: rgb(1, 74, 122); font-weight: 600; border-radius: 8px; background-color: transparent;' href='http://localhost/pap/termoscondicoes.pdf'>termos e condições</a> que regem meu uso dos serviços da Miguel Alex Telemóveis Comunicações .
</p>

<p style='color: rgb(21, 21, 21);'></p>
                        <hr style='width: 85%; margin: 24px auto; border: 1px solid rgb(224, 224, 224);'>
                       <p style='font-size: 14px; color: rgb(102, 102, 102);'>Estamos aqui para o ajudar. Se tiver alguma dúvida ou precisar de mais informações, contacte-nos através do nosso <a style='color: rgb(1, 74, 122); background-color: transparent; font-weight: 600; border-radius: 8px;' href='http://localhost/pap/index.php?page=contact'>centro de ajuda.</a>.<br><br>Atenciosamente,<br>Equipa Miguel & Alex. </p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>");

	if(!$mensagem_1->mensagemValida()){
			echo "Mensagem não é válida";
	}

   $mail_1 = new PHPMailer(true);

   try {
   
		$mail_1->SMTPDebug = false;                      // Enable verbose debug output
		$mail_1->isSMTP();                                            // Send using SMTP
		$mail_1->Host       = 'smtp.sapo.pt';                    // Set the SMTP server to send through
		$mail_1->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail_1->Username   = 'miguelalextelemoveiscomunicacoes@sapo.pt';                     // SMTP username
		$mail_1->Password   = 'MiguelAlexPorto2023';                               // SMTP password
		$mail_1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail_1->Port       = 587;                                    // TCP port to connect to

		$mail_1->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel e Alex: NEWSLETTER');
		$mail_1->addAddress($mensagem_1->__get('para'));     // Add a recipient

		$headers_1 = "MIME-Version: 1.1/r/n";
		$headers_1 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
		$headers_1 .= "From: Catchy Store/r/n"; //Devem personalizar com o nome do vosso projeto
		$headers_1 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
	  
		$mail_1->isHTML(true);                                  // Set email format to HTML
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


 
?>


	 
