<?php $objPermOpc 	= new permisos();$id_rol= $_SESSION['id_rol'];?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <!-- start: TOP NAVIGATION CONTAINER -->
      <div class="container" >
        <div class="navbar-header">
          <!-- start: RESPONSIVE MENU TOGGLER -->
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="clip-list-2"></span>
          </button>
          <!-- end: RESPONSIVE MENU TOGGLER -->
          <!-- start: LOGO -->
          <a class="navbar-brand" href="home" title="Schedule Manager">
             <?php echo $_ENV['APP_NAME']; ?>
          </a>
          <!-- end: LOGO -->
        </div>


        <div class="navbar-tools">
          <!-- start: TOP NAVIGATION MENU -->
          <ul class="nav navbar-right">


            <?php /* */ ?>
            <!-- start: NOTIFICATION DROPDOWN -->
             <li class="dropdown">
              <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                <i class="clip-notification-2"></i>
                <span class="badge" id="total-eventos"> 0</span>
              </a>
              <ul class="dropdown-menu notifications">
                <li>
                  <span class="dropdown-menu-title"> Existen <span id="total-eventos-text">0</span> notificación(es)</span>
                </li>
                <li>
                  <div class="drop-down-wrapper" id="drop-down-notifications"></div>
                </li>
                <li class="view-all">
                  <a href="?Eventos">
                  <?php if(in_array('801', $objPermOpc->getRolPermissions($id_rol))) {   ?>
                    Ver todoas las notificaciones <i class="fa fa-arrow-circle-o-right"></i>
                  <?php } ?>
                  </a>
                </li>
              </ul>
            </li>
            <!-- end: MESSAGE DROPDOWN -->
            <?php /**/ ?>

            <!-- start: USER DROPDOWN -->

            <li class="dropdown current-user">
              <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                <?php if ($_SESSION['user_photo']) { $photo = 'repositorio/profile_photos/'.$_SESSION['user_photo'];} else { $photo = 'assets/images/template/logo_mgmt.png';}?>
                <img src="<?=$photo?>" class="circle-img circle-img-size" alt="">
                <span class="username"><?=$_SESSION['username']?></span>
                <i class="clip-chevron-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="?Editar-Perfil">
                    <i class="clip-user-2"></i>
                    &nbsp;Mi Perfil
                  </a>
                </li>
                
                <?php
                  // Si es usuario principal de la Cia
                  if ($_SESSION['superadmin']==1) {
                ?>

                <li>
                  <a href="?Editar-Perfil-Configuraciones">
                    <i class="clip-settings"></i>
                    &nbsp;Configuraciones
                  </a>
                <li> 

                <?php } ?>
                
                <li class="divider"></li>
                
                <li>
                  <a href="quit">
                    <i class="clip-exit"></i>
                    &nbsp;Salir
                  </a>
                </li>
              </ul>
            </li>

            <!-- end: USER DROPDOWN -->

          </ul>
          <!-- end: TOP NAVIGATION MENU -->
        </div>


      </div>
      <!-- end: TOP NAVIGATION CONTAINER -->
    </div>