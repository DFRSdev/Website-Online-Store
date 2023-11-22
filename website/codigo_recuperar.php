<?php
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/OAuth.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/POP3.php";
require "PHPMailer/src/SMTP.php";

// Instanciating the namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mensagem {
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status = array(
        'codigo_status' => null,
        'descricao_status' => '',
    );

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value) {
        $this->$attr = $value;
    }

    public function mensagemValida() {
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        } else {
            return true;
        }
    }
}

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
?>