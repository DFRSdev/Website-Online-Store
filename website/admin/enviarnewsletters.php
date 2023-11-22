<?php
include("../ligacao.php");

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/OAuth.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/POP3.php";
require "../PHPMailer/src/SMTP.php";

// Instanciando os namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mensagem1 {
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
  

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value) {
        $this->$attr = $value;
    }

  
}

$consulta = "SELECT email FROM newsletter WHERE subscricao = 1";
$result = mysqli_query($ligax, $consulta);
$id_newsletter = $_GET['id_newsletter'];

if ($result) {
    $n = mysqli_num_rows($result);
    if ($n > 0) {
      
        $mail_1 = new PHPMailer(true);
        $mail_1->SMTPDebug = false; // Enable verbose debug output
        $mail_1->isSMTP(); // Send using SMTP
        $mail_1->Host = 'smtp.sapo.pt'; // Set the SMTP server to send through
        $mail_1->SMTPAuth = true; // Enable SMTP authentication
        $mail_1->Username = 'miguelalextelemoveiscomunicacoes@sapo.pt'; // SMTP username
        $mail_1->Password = 'MiguelAlexPorto2023'; // SMTP password
        $mail_1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail_1->Port = 587; // TCP port to connect to

        $mail_1->setFrom('miguelalextelemoveiscomunicacoes@sapo.pt', 'Miguel e Alex: Envio da Newsletter');

        while ($registo1 = mysqli_fetch_assoc($result)) {
            $email = $registo1['email'];
            $subscricao = "SELECT assunto, mensagem_dados, ficheiro_nome, ficheiro_tipo, ficheiro_tamanho, ficheiro_dados FROM tipo_newsletter WHERE id_newsletter = '".$id_newsletter."'";
            $result_news = mysqli_query($ligax, $subscricao);
            $n_news = mysqli_num_rows($result_news);
            if ($n_news > 0) {
                $registo_news = mysqli_fetch_assoc($result_news);
                $assunto = $registo_news['assunto'];
                $ficheiro_tipo = $registo_news["ficheiro_tipo"];
                $ficheiro_nome = $registo_news["ficheiro_nome"];
                $ficheiro_tamanho = $registo_news["ficheiro_tamanho"];
                $ficheiro_dados = base64_decode($registo_news["ficheiro_dados"]);
                $mensagem_dados = base64_decode($registo_news['mensagem_dados']);

                $mail_1->addAddress($email); // Add a recipient
                $mail_1->addStringAttachment($ficheiro_dados, $ficheiro_nome); // Add attachment
                $mail_1->addStringEmbeddedImage($mensagem_dados, 'imagem1', 'imagem1.jpg', 'base64'); // Add embedded image

                $mail_1->isHTML(true); // Set email format to HTML
                $mail_1->Subject = utf8_decode($assunto);
                $mail_1->Body = '<center><img src="cid:imagem1" style="width:70%;"></center>';
                $mail_1->AltBody = 'É necessário utilizar um cliente de email que suporte HTML para ter acesso total ao conteúdo desta mensagem';
            }
        }

        $mail_1->send();

        $historico = "INSERT INTO historico_newsletter (pessoa, nome_newsletter, hora) VALUES ('" . $_SESSION['name'] . "','" . $assunto . "',now())";
        $result_historico = mysqli_query($ligax, $historico);
        ?>

        <script type="text/javascript">
            location.href="index.php?page=listar_newsletter";
        </script>
        <?php
    }
}


?>
