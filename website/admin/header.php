 <header class="main-header">
        <a href="index.php" class="logo">
          <span class="logo-mini">
            <b>A</b>LT </span>
          <span class="logo-lg">
            <b>Painel</b> Admin </span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="showfile_fotoperfil.php?id=<?php echo $id ?>" onerror="this.src='blank.jpg'" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $nome?></span>

                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="showfile_fotoperfil.php?id=<?php echo $id ?>" onerror="this.src='blank.jpg'" class="img-circle" alt="User Image">
                    <p> <?php echo $nome?>  <small>Membro desde 2023</small>
                    </p>
                  </li>
                 
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../index.php?page=dashboard_utilizador" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Sair</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
      </header>