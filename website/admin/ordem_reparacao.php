<?php
if(isset($_GET['cod_reparacao'])){
  $cod_reparacao=$_GET['cod_reparacao'];
} else { $cod_reparacao=""; }

if(isset($_GET['telefone'])){
  $telefone=$_GET['telefone'];
} else { $telefone=""; }  
                            
if(isset($_GET['n_serie'])){
  $n_serie=$_GET['n_serie'];
} else { $n_serie=""; }                     
?> 


<div class="content-wrapper">

<section class="content" >

<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Ordem de Reparação</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
<i class="fa fa-minus"></i></button>
<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
<i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body">
 
                <table class="table lms_table_active">
                  <form method="POST" action="" enctype="multipart/form-data">
                   <!-- Tab panes -->
            <div class="tab-content mb30" style="background-color: transparent !important;padding:0">
             <!-- TAB 1 -->
              <div class="tab-pane active" id="tab1" style="background-color: transparent !important;">


                <div style="float:left;width:70%;">
                  <div style="background-color: #fff;padding:20px">
                        
                        
                      
                       <div class="row">
                          <div class="col-sm-12">
                             
                                <form action="" method="GET" >
                               <div style="width: 230px;position:relative;top:-21px;">
                                    
                                    


                              </div>
                              </form>
                         </div>
                      </div>
                      <br>
                      
                      <div class="row">
                          <div class="col-sm-12">
                             
                                <form action="" method="GET" >
                               <div style="width: 230px;position:relative;top:-21px;">
                                    
                                    <label class="control-label">Número de Série: </label>
                                    <input type="hidden" name="page" value="ordem_reparacao">
                                    <input formfield="titulo" langmanager="true" formtype="input" class="text-input2 required form-control" type="search" id="nome" name="n_serie" value="<?php if(isset($_GET['n_serie'])) echo $_GET['n_serie'];?>" aria-required="true">


                              </div>
                              </form>
                         </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                             
                            
                               <div style="float:left;width: 100px;position: absolute;top:-79px;left: 270px;">
                                    
                                    <label class="control-label">Reparação: </label>
                                    <form method="GET">
                                    <input type="hidden" name="page" value="ordem_reparacao">
                                    <input class="text-input2 required form-control" type="search" name="cod_reparacao" value="<?php if(isset($_GET['cod_reparacao']))echo $_GET['cod_reparacao'];?>">
                                    </form>


                              </div>
                           
                         </div>
                      </div>
                        <div class="row">
                          <div class="col-sm-12">
                             
                            <form action="" method="GET" >
                               <div style="float:left;width: 120px;position: absolute;top:-100px;left: 400px;">
                                    
                                    <label class="control-label">Número de telefone: </label>
                                    <input type="hidden" name="page" value="ordem_reparacao">
                                    <input formfield="titulo" langmanager="true" formtype="input" class="text-input2 required form-control" type="search" id="nome" name="telefone" value="<?php if(isset($_GET['telefone']))echo $_GET['telefone'];?>" aria-required="true">


                              </div>
                              </form>
                         </div>
                      </div>
                       
                   </div>
    
                   
                </div>




             </form>
                </table>
            <a href="index.php?page=nova_ordem_reparacao" ><input type="submit" name="" class="btn btn-primary"  value="Nova Ordem de Reparação"  ></a> 
              <?php
    $ultima_reparacao="SELECT MAX(cod_reparacao)  AS max_page from ordem_reparacao";
    $result=mysqli_query($ligax,$ultima_reparacao);
    $registo=mysqli_fetch_assoc($result);
    $cod_reparacao=$registo['max_page'];
    
    ?>
            <div class="row no-print" style="position:relative;top:-89px;left:100px;">
<div class="col-xs-12" style="position:relative;top:55px;left:130px;">
    
  
<a href="fotocopia_reparacao.php?cod_reparacao=<?php echo $cod_reparacao?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
</div>
</div>
            
         <?php
if(isset($_GET['telefone'])){
    $consulta = "select * from ordem_reparacao where telefone like '%" . $_GET['telefone'] . "%' order by cod_reparacao ASC";
    $result = mysqli_query($ligax, $consulta);
}elseif(isset($_GET['cod_reparacao'])){
    $consulta = "select * from ordem_reparacao where cod_reparacao like '%" . $_GET['cod_reparacao'] . "%' order by cod_reparacao ASC";
    $result = mysqli_query($ligax, $consulta);
}elseif(isset($_GET['n_serie'])){
    $consulta = "select * from ordem_reparacao where n_serie like '%" . $_GET['n_serie'] . "%' order by cod_reparacao ASC";
    $result = mysqli_query($ligax, $consulta);
}else{
    echo '<br>';
    echo '<br>';
    echo 'Sem resultados.';
}

if(isset($result) && mysqli_num_rows($result) > 0){
    ?>
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
      
        <thead>
            <tr>
                <th scope="col">RMA</th>
                <th scope="col">Cliente</th>
                <th scope="col">Telefone</th>
                <th scope="col">Data de Pedido</th>
                <th scope="col">Data da Entrega</th>
                <th scope="col">Descricao</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($registo = mysqli_fetch_assoc($result)){
                $cod_reparacao = $registo['cod_reparacao'];
                $telefone = $registo['telefone'];
                $nome = $registo['cliente'];
                $data_pedido = $registo['data_pedido'];
                $data_entrega = $registo['data_entrega'];
                $descricao = $registo['descricao_problema'];
            ?>
            <tr>
                <td><?php echo $cod_reparacao ?></td>
                <td><?php echo $nome; ?></td>
                <td><?php echo $telefone ?></td>
                <td><?php echo $data_pedido; ?></td>
                <td><?php echo $data_entrega; ?></td>
                <td><?php echo $descricao; ?></td>
                <td>
                    <a href="index.php?page=editar_ordem_reparacao&cod_reparacao=<?php echo $cod_reparacao; ?>">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo '<br><br>Sem resultados.';
}
?>

</div>


</div>

</section>

</div>
