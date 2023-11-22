  <?php 
  
 $sql = "SELECT COUNT(id) AS users FROM users";
  $result = mysqli_query($ligax,$sql);
  $count_registos = mysqli_fetch_assoc($result);
  $count_registos=$count_registos['users'];
  

  $sql1="SELECT COUNT(cod_encomenda) AS encomenda FROM encomenda  where cod_fatura<>'0'";
  $result1=mysqli_query($ligax,$sql1);
 $registo2 = mysqli_fetch_assoc($result1);
$count_encomendas=$registo2['encomenda'];

  $sql2="SELECT COUNT(email) AS newsletter FROM newsletter";
  $result2=mysqli_query($ligax,$sql2);
 $registo3 = mysqli_fetch_assoc($result2);
$count_newsletter=$registo3['newsletter'];


$sql3="SELECT COUNT(cod_categoria) AS categoria FROM categorias";
  $result3=mysqli_query($ligax,$sql3);
 $registo4 = mysqli_fetch_assoc($result3);
$count_categoria=$registo4['categoria'];

$sql4="SELECT COUNT(cod_marca) AS marca FROM marcas";
  $result4=mysqli_query($ligax,$sql4);
 $registo5 = mysqli_fetch_assoc($result4);
$count_marca=$registo5['marca'];


$sql5="SELECT COUNT(cod_produto) AS produtos FROM produtos";
  $result5=mysqli_query($ligax,$sql5);
 $registo6 = mysqli_fetch_assoc($result5);
$count_produtos=$registo6['produtos'];

$sql6="SELECT COUNT(cod_reparacao) AS reparacao FROM ordem_reparacao";
  $result6=mysqli_query($ligax,$sql6);
 $registo7 = mysqli_fetch_assoc($result6);
$count_reparacoes=$registo7['reparacao'];

  ?>
  
  <div class="content-wrapper">
        <section class="content-header">
          <h1> Dashboard <small>Painel de Controlo</small>
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="../index.php">
                <i class="fa fa-dashboard"></i> Home </a>
            </li>
            <li class="active">Início</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $count_encomendas ?></h3>
                  <p>Encomendas Registadas</p>
                </div>
                <div class="icon">
                  
                  <i class="fa fa-box-open"></i>
                </div>
                <a href="index.php?page=listar_encomendas" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $count_newsletter; ?>
                  </h3>
                  <p>Subscrições Newsletter</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bookmark-o"></i>
                </div>
                <a href="index.php?page=listar_subscricoes" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $count_registos; ?></h3>
                  <p>Utilizadores</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-o"></i>
                </div>
                <a href="index.php?page=listar_utilizadores" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
              <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $count_categoria; ?></h3>
                  <p>Categorias</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-o"></i>
                </div>
                <a href="index.php?page=listar_categorias" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>

                 </section>
                  <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $count_encomendas ?></h3>
                  <p>Histório de Envio da Newsletter</p>
                </div>
                <div class="icon">
                  <i class="fas fa-newspaper"></i>
                </div>
                <a href="index.php?page=historico_newsletter" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-black">
                <div class="inner">
                  <h3><?php echo $count_marca; ?>
                  </h3>
                  <p>Marcas</p>
                </div>
                <div class="icon">
              <i class="fa fa-bookmark" style="color:white;"></i>
                </div>
                <a href="#" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-gray">
                <div class="inner">
                  <h3><?php echo $count_reparacoes; ?></h3>
                  <p>Reparações</p>
                </div>
                <div class="icon">
                 <i class="fa fa-wrench"></i>
                </div>
                <a href="index.php?page=ordem_reparacao" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $count_produtos; ?></h3>
                  <p>Produtos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="index.php?page=listar_produtos" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
          
                 </section>
      </div>