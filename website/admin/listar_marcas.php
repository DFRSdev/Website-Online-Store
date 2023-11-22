
 
<?php
if(isset($_GET['pesquisa'])){
  $pesquisa=$_GET['pesquisa'];
} else { $pesquisa=""; }

  
                     
?>      <div class="content-wrapper">
        <section class="content-header">
          <br>
          <ol class="breadcrumb">
            <li>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> Home </a>
            </li>
            <li>
              <a href="#">Categorias</a>
            </li>
            <li class="active">Listar Categorias</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
      <div class="col-sm-6">
        <div class="dataTables_length" id="example1_length">
          <label>
            <br>
          </label>
        </div>
      </div>
      <div class="col-sm-6">
        <div id="example1_filter" class="dataTables_filter">
          <form action="" method="GET">
            <label style="position: relative;right: 570px;">Search: 
              <input type="hidden" name="page" value="listar_marcas">

              <input type="search" class="form-control input-sm" placeholder="" name="pesquisa" aria-controls="example1">
              </button>
            </label>
          </form>
        </div>
      </div>
    </div>
    <br>
          <div class="row">
            <div class="col-xs-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listar Marcas</h3>
                </div>
                <div class="box-body">
                     <?php

                            if(isset($_GET['pesquisa'])){
                                      $consulta="select * from marcas where nome_marca like '%".$_GET['pesquisa']."%' order by cod_marca ASC";
                                    } 

                                    else {
                                      $consulta= "select * from marcas order by cod_marca ASC";
                                    }
                                    
                            $result=mysqli_query($ligax,$consulta);

                             if($result){
                               $n=mysqli_num_rows($result);
                               if($n>0) {
?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th scope="col">Nome</th>
                  
                      <th scope="col">Descrição</th>
                      <th scope="col">Estado</th>
                      
                    
                      <th scope="col">Opções</th>
                      </tr>
                    </thead>
                    <?php

        
    //Colocar código da páginação
    //Paginação – Apenas listar 10 registos numa página
    $reg_pag=5; // Número de registos a apresentar por página

    if(isset($_GET['pag'])){
            //guarda a página em que o utilizador clicou
            $pag=$_GET['pag'];
        } 
        else {
            //ou mostra a 1.ª
            $pag=1;
        }

        //define a página anterior
    $pag_ant=$pag-1;
        //define a página seguinte
    $pag_seg=$pag+1;

        //calcula quantos registos já foram exibigos em páginas anteriores
    $reg_ini=($reg_pag*$pag)-$reg_pag;

        //calcula o n.º total de registos
    $num_reg=mysqli_num_rows($result);

        //Se temos menos de 10 registos (só dá para 1 página)
    if($num_reg <=$reg_pag) {
      $num_pag=1; 
    }

        //Se for multiplo de 10, dá conta certa
    else if (($num_reg % $reg_pag)==0) {
      $num_pag=$num_reg/$reg_pag; }

        //se não for multiplo de 10, dá mais 1 p+agina
    else {
      $num_pag=$num_reg/$reg_pag + 1; 
    }

    //Vai à base de dados selecionar os registos entre dois limites
    $consulta=$consulta." limit $reg_ini,$reg_pag";
    $result= mysqli_query($ligax, $consulta);




   


                      
?>
                    
                    <tbody>
                        <?php


   

while($registo=mysqli_fetch_assoc($result)){
  $cod_marca=$registo['cod_marca'];
  $nome=$registo['nome_marca'];
  $descricao=$registo['descricao'];
  $estado=$registo['estado'];                
?>
                       <tr>
                     
                     
                      <td>

                       <img class="circle-rounded me-3" src="showfile_fotomarca.php?cod_marca=<?php echo $cod_marca;?>" alt="" width="30" height="30">
                          <?php echo $nome ?>
                          

                        </td>
                        <td><?php echo $descricao ?> </td>
                        
                                                  
                                                 
                       
                      
                                            <?php
                                            if($estado==1) { ?><td class="">Ativo</td><?php }
                                            else if($estado==0) { ?><td class="">Inativo</td><?php }
                                            

                                            ?>  
                     
                      
                       <td class="">
                           
                  <a href="index.php?page=editar_marcas&cod_marca=<?php echo $cod_marca;?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    </tr>
                      <?php

                    } ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <th scope="col">Nome</th>
                      <th scope="col">Descrição</th>
                      <th scope="col">Estado</th>
                   
                   
                 
                      <th scope="col">Opções</th>
                      </tr>
                    </tfoot>
                     

                    
                  </table>
                    <center>
              <table>
                <div class="row">
                  <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
                  </div>
                  <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                      <ul class="pagination">
                        <?php
            if(($pag_ant) && ($pag>1)){
                  echo "
                        <li class='paginate_button previous' id='example1_previous'>
                        
                                    
        
                                      <a href='index.php?page=listar_marcas&pag=$pag_ant&pesquisa=$pesquisa'>Anterior
        
                                      </a> ";

      }else{

    echo " <li class='paginate_button previous disabled' id='example1_previous' disabled><a href='#'' aria-controls='example1' data-dt-idx='0' tabindex='0' disabled>Anterior</a> <?php } ?>
                        </li>";
                        
          }              

    for ($i=1;$i<=$num_pag;$i++) {

            if($i!=$pag) {
                echo "<li class='paginate_button'>
                                      <a href='index.php?page=listar_marcas&pag=$i&pesquisa=$pesquisa' class='paginate_button'>
                    $i
                    </a></li>";
            } 
            else {
                 echo "<li class='paginate_button active'>
                                      <a href='index.php?page=listar_marcas&pag=$i&pesquisa=$pesquisa' class='paginate_button active'>
                  $i
                    </a></li>";
            }
        }
      

    if ($pag+1<=$num_pag) {
            echo "   <li class='paginate_button next' id='example1_next'> 
                                      <a href='index.php?page=listar_marcas&pag=$pag_seg&pesquisa=$pesquisa' class='flex-c-m how-pagination1 trans-04 m-all-7'>
        Seguinte</a></li>";
    }
    ?> 
                      </ul>
                    </div>
                  </div>
                </div>
                <td></td>
            
                 </table>
                      <?php

                  
                }else{
                  ?>
                  <p>Sem dados a listar.</p>
                  <?php
                }
              }

                    ?>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
    
    </div>
   
    <script>
      $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': true,
          'autoWidth': false
        })
      })
    </script>
  </body>
</html>