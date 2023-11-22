<link rel="stylesheet" href="../assets/css/bootstrap.min1.css">



<?php include("../ligacao.php"); ?>


<?php



   if(isset($_SESSION["perfil"])){
if($_SESSION["perfil"]==3 || $_SESSION["perfil"]==2 ){

if(isset($_POST['atualizar'])){

$perfil=$_POST['perfil_util'];

                      $estado=$_POST['estado'];
                      $atualizar="UPDATE users set perfil='".$perfil."', estado='".$estado."' where id='".$_GET['id']."'";
                       $result=mysqli_query($ligax,$atualizar);
                        if($result=1){

                       
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

                        toastr["success"]("Edição realizada com sucesso")

                          </script>
                          <?php
                       }else{ 
                        ?>
                        <script>
                      alert("Variavel de perfil nao atualizada.");
                      </script>
                      <?php
                       }
                    }  
                  }
                }
                    ?> 




<?php
  $consulta="SELECT * FROM users where id='".$_GET['id']."'";
 $result=mysqli_query($ligax,$consulta);
   $n=mysqli_num_rows($result);
   $registo=mysqli_fetch_assoc($result);
  $id=$registo['id'];
  $name=$registo['name'];
  $email=$registo['email'];
  $perfil=$registo['perfil'];
  $estado=$registo['estado'];
  $date_register=$registo['date_register'];
  ?>
  <br><br><br><br><br><br>
  <form method="POST">
<div class="container">
  <div class="main-body">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ul class="breadcrumb">
        
        <li class="breadcrumb-item active" aria-current="page">Administrador: <?php echo $_SESSION['name'];?></li>
        <li></li>
        <li class="breadcrumb-item active" aria-current="page" style="position: relative;left:840px;"><a href="index.php?page=listar_utilizadores" class="btn btn-info"  >Voltar</a></li>
      </ul>
    </nav>
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="../showfile_fotoperfil.php?id=<?php echo $id ?>" onerror="this.src='blank.jpg'"  width="150">
              
            </div>
          </div>
        </div>
       
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nome</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo $name; ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo $email; ?></div>
            </div>
            <hr>
           
          
            
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Data de Registro:</h6>
              </div>
              <div class="col-sm-9 text-secondary"> <?php echo $date_register; ?></div>
            </div>
             <hr>
            <div class="row">
              <div class="col-sm-12">
                <button class="btn btn-info" name="atualizar" >Atualizar </button>
              </div>
            </div>
          </div>
        </div>
        <div class="row gutters-sm">
          <div class="col-sm-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="d-flex align-items-center mb-3">
                  Perfil
                </h6>
              
               
                <select id="selecao" name="perfil_util" class="form-control">
                <option value="0" <?php if($perfil==0) echo "selected" ?>>Não autenticado</option> 
                                <option value="1" <?php if($perfil==1) echo "selected" ?>>Cliente</option> 
                                <option value="2" <?php if($perfil==2) echo "selected" ?>>Admin</option> 
                                <option value="4" <?php if($perfil==4) echo "selected" ?>>Banido</option> 
              
              </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="d-flex align-items-center mb-3">
                 Estado
                </h6>
              <select id="selecao" name="estado" class="form-control">
                <option value="1" <?php if($estado==1) echo "selected" ?>>Ativo</option> 
                <option value="0" <?php if($estado==0) echo "selected" ?>>Inativo</option> 
                               
              </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<style type="text/css">body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}</style>

