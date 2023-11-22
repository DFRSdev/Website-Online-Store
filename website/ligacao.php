 <?php

session_start();

$host = "localhost";
$user = "root";
$pwd = "";
$db = "database";
$ligax = mysqli_connect($host, $user, $pwd) 
or die ("Não foi possível efetuar ligação à base de dados ". mysqli_connect_error());
mysqli_select_db($ligax,$db);

if(isset($_SESSION["time"])) {
    //print_r($_SESSION); 
    $t = time(); 
    $t0 = $_SESSION["time"];
    $diff = $t - $t0;
    $_SESSION["diff"]=$diff;
    if ($diff > 15000) {
        session_unset();
        session_destroy();
        location("index.php");
    }
}
?>