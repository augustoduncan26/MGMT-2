<?php 

$objPermOpc 	= new permisos();
$active			= "style='background-color: #C8C7CC4D;'";
$activeOpen		= "class = 'active open'";
$id_rol    		= $_SESSION['id_rol'];
$id_user    	= $_SESSION['id_user'];
$id_cia     	= $_SESSION['id_cia'];

?>
<link href="assets/css/style_leftmenu.css" rel="stylesheet">

<div class="main-navigation navbar-collapse collapse">

<!-- start: MAIN MENU TOGGLER BUTTON -->
<!-- <div class="navigation-toggler">
	 <i class="fa fa-bars bars-icons"></i>
	 </div> 
-->
<!-- end: MAIN MENU TOGGLER BUTTON -->
<br />
<nav class="nav" >
        <ul class="sub-menu" style="padding: 0px 0px 0px 20px;">

		<!-- Home -->
		<li class="list_item" id="home">
		<a href="home" class="nav__link" >
			<div class="list__button">
				<i class="clip-home-3"></i>
				<span class="title">Home</span>
				<!-- <span class="selected"></span> -->
			</div>
		</a>
		</li>

		<!-- Estadisticas -->
		<?php 
		//dump($objPermOpc->getRolPermissions($id_rol));
			if(in_array('850', $objPermOpc->getRolPermissions($id_rol))) { 
		?>
		<li <?php if(GET()[0] == 'Estadisticas'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> id="Estadisticas" data-original-title="Gráficos Estadísticos" data-placement="right" title="Estadisticas">
		<a href="?Estadisticas" class="nav__link">
			<div class="list__button">
				<i class="clip-stats"></i>
				<span class="title" >Estadisticas</span>
				<!-- <span class="selected"></span> -->
			</div>
		</a>
		</li>
		<?php } ?>

		<!-- Events -->
		<?php 
			//if ($objPermOpc->tienePermiso(50)) {
			if(in_array('50', $objPermOpc->getRolPermissions($id_rol))) { 
		?>
		<li <?php if(GET()[0] == 'Eventos'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Admin. Eventos" data-placement="right" title="Adminstrar Eventos">
			<a href="?Eventos" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar"></i>
				<span class="title">Eventos</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Teachers -->
		<?PHP if(in_array('100', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Profesores'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Lista de Profesores" data-placement="right" title="Lista de Profesores">
			<a href="?Profesores" class="nav__link">
			<div class="list__button">
				<img src="assets/images/teacher.png" class="icon-teachers" />
				<span class="title">Profesores</span>
			</div>
			</a>
		</li>
		<?php } ?>
		<!-- Cronograma Profesores -->
		<?PHP if(in_array('350', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Schedule-teachers'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Agenda Profesores" data-placement="right" title="Agenda Profesores">
			<a href="?Schedule-teachers" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar"></i>
				<span class="title">Agenda Profesores</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Students / Estudiantes-->
		<?PHP if(in_array('150', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Lista de Estudiantes" data-placement="right" title="Lista de Estudiantes">
			<a href="?Estudiantes" class="nav__link">
			<div class="list__button">
				<i class="clip-users-2"></i>
				<span class="title">Estudiantes</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>
		<!-- Cronograma Estudiantes -->
		<?PHP if(in_array('351', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Agenda Estudiantes" data-placement="right" title="Agenda Estudiantes">
			<a href="?Schedule-students" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar"></i>
				<span class="title">Agenda Estudiantes</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Parents / Padres-->
		<?PHP if(in_array('200', $objPermOpc->getRolPermissions($id_rol))) {  ?>
			<li class="list_item tooltips" data-original-title="Lista de Padres" data-placement="top" title="Lista de Padres">
			<a href="?Padres" class="nav__link">
			<div class="list__button">
				<i class="fa fa-group"></i>
				<span class="title">Padres</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Subjects / Materias-->
		<?PHP if(in_array('250', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Asignaturas" data-placement="right" title="Asignaturas-Materias">
			<a href="?Asignaturas" class="nav__link">
			<div class="list__button">
				<i class="fa fa-indent"></i>
				<span class="title">Asignaturas / Materias</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Classes -->
		<?PHP if(in_array('300', $objPermOpc->getRolPermissions($id_rol))) {  ?>
			<li class="list_item tooltips" data-original-title="Listado de Clases" data-placement="top" title="Lista de Clases">
			<a href="?Clases" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Clases</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>
		

		<!-- Exams -->
		<?PHP if(in_array('400', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Lista de Examenes" data-placement="top" title="Lista de Examentes">
			<a href="?Examenes" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar-3"></i>
				<span class="title">Examenes</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Assignments / Tareas -->
		<?PHP if(in_array('450', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Lista de Tareas" data-placement="top" title="Lista de Tareas">
			<a href="?Tareas" class="nav__link">
			<div class="list__button">
				<i class="fa fa-tasks"></i>
				<span class="title">Tareas</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Results -->
		<?PHP if(in_array('500', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Resultados" data-placement="right" title="Resultados">
			<a href="?Resultados" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Resultados</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Attendance / % de Asistencia -->
		<?PHP if(in_array('550', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Asistencias" data-placement="right" title="Asistencias">
			<a href="?Asistencias" class="nav__link">
			<div class="list__button">
				<i class="clip-checkbox"></i>
				<span class="title">Asistencias</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Messages -->
		<?PHP if(in_array('600', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item tooltips" data-original-title="Mensajes" data-placement="right" title="Mensajes">
			<a href="?Mensajes" class="nav__link">
			<div class="list__button">
				<i class="clip-bubble-dots-2"></i>
				<span class="title">Mensajes</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Announcements -->
		<!-- <?PHP if(in_array('650', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li class="list_item">
			<a href="?Anuncios" class="nav__link">
			<div class="list__button">
				<i class="fa fa-bell"></i>
				<span class="title">Anuncios</span>
			</div>
			</a>
		</li>
		<?php } ?> -->


		<!-- Planning -->
		<?PHP if(in_array('750', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click tooltips" data-original-title="Planning" data-placement="right" title="Planning" <?php if (strpos(GET()[0],'planning')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-calendar"></i>
				<span class="title" >&nbsp;&nbsp;Planning</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_planning">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'planning'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Planning </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'planning-bookers'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning-bookers" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Agencias / Bookers </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'planning-clientes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning-clientes" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Clientes </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'planning-servicios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning-servicios" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Servicios </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'planning-entradas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning-entradas" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Entradas(Check-In) </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'planning-salidas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning-salidas" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Salidas(Check-Out) </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End Planning -->


		<!--  Menu Usuarios -->
		<?php if(in_array('800', $objPermOpc->getRolPermissions($id_rol))) { ?>
			<li class="list_item list__item--click tooltips" data-original-title="Mantenimientos" data-placement="right" title="Mantenimientos" <?php if (strpos(GET()[0],'usuarios')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link">
				<i class="clip-settings"></i>
				<span class="title" >&nbsp;&nbsp;Mantenimientos</span>
				<i class="fa icon-arrow"></i>
				<!-- <span class="selected"></span> -->
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_usuarios">
			</div>

			<ul class="list__show">
				<?PHP if(in_array('800', $objPermOpc->getRolPermissions($id_rol))) {  ?>
				<li <?php if(GET()[0] == 'usuarios-listar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-listar" class="nav__link nav__link--inside">
						-<span class="title"> Usuarios</span>
					</a>
				</li>
				<?php } ?>
				
				<?PHP if(in_array('801', $objPermOpc->getRolPermissions($id_rol))) {   ?>
				<li <?php if(GET()[0] == 'usuarios-perfiles'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-perfiles" class="nav__link nav__link--inside">
						-<span class="title"> Perfiles </span>
					</a>
				</li>
				<?php } ?>
				<?PHP if(in_array('801', $objPermOpc->getRolPermissions($id_rol))) {   ?>
				<li <?php if(GET()[0] == 'usuarios-tipo-eventos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-tipo-eventos" class="nav__link nav__link--inside">
						-<span class="title"> Tipo de Eventos </span>
					</a>
				</li>
				<?php } ?>
				<?PHP if(in_array('802', $objPermOpc->getRolPermissions($id_rol))) {   ?>
				<li <?php if(GET()[0] == 'usuarios-cambiar-clave'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-cambiar-clave" class="nav__link nav__link--inside">
						-<span class="title"> Cambiar Contraseña </span>
					</a>
				</li>
				<?php } ?>
			</ul>
			</li>
		<?php } ?>
		<!-- End: Menun Usuarios -->


		<!-- 
		/**
		* Caja
		*/
		-->
		<?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('900', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'caja')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="fa fa-money"></i>
				<span class="title" >&nbsp;Caja </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_caja">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'caja'){ echo ' class="menu-backg-item"';}?>>
					<a href="?caja" class="nav__link nav__link--inside">
						<i class="fa fa-money"></i><span class="title"> Caja </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'caja-pagos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?caja-pagos" class="nav__link nav__link--inside">
						<i class="fa fa-money"></i><span class="title"> Pagos </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'caja-compras'){ echo ' class="menu-backg-item"';}?>>
					<a href="?caja-comparas" class="nav__link nav__link--inside">
						<i class="fa fa-money"></i><span class="title"> Compras </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'caja-ventas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?caja-ventas" class="nav__link nav__link--inside">
						<i class="fa fa-money"></i><span class="title"> Ventas </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'caja-productos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?caja-productos" class="nav__link nav__link--inside">
						<i class="fa fa-money"></i><span class="title"> Productos </span>
					</a>
				</li>
				
				<ul class="list__show">
					<li <?php if(GET()[0] == 'caja-categorias'){ echo ' class="menu-backg-item"';}?>>
						<a href="?caja-categorias" class="nav__link nav__link--inside">
							<i class="fa fa-tasks"></i><span class="title"> Categorías </span>
						</a>
					</li>
					<li <?php if(GET()[0] == 'caja-clientes'){ echo ' class="menu-backg-item"';}?>>
						<a href="?caja-clientes" class="nav__link nav__link--inside">
							<i class="fa fa-user"></i><span class="title"> Clientes </span>
						</a>
					</li>
					<li <?php if(GET()[0] == 'caja-proveedores'){ echo ' class="menu-backg-item"';}?>>
						<a href="?caja-proveedores" class="nav__link nav__link--inside">
							<i class="fa fa-truck"></i><span class="title"> Proveedores </span>
						</a>
					</li>
				</ul>

			</ul>

		</li>
		<?php } ?>
		<!-- End: Caja -->


		<!-- 
		/**
		* Modulo Facturacion
		*/
		-->
        <?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('950', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'facturacion')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-file-2"></i>
				<span class="title" >&nbsp;Módulo Facturación </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_facturacion">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'facturacion'){ echo ' class="menu-backg-item"';}?>>
					<a href="?facturacion" class="nav__link nav__link--inside">
						<i class="clip-file-2"></i><span class="title"> Facturación </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'facturacion-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?facturacion-reportes" class="nav__link nav__link--inside">
						<i class="fa fa-file"></i><span class="title"> Reportes </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End: Facturacion -->


		<!-- 
		/**
		* Modulo Inventario
		*/
		-->
        <?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('1000', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'inventario')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-list-2"></i>
				<span class="title" >&nbsp;Módulo Inventario </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_inventario">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'inventario'){ echo ' class="menu-backg-item"';}?>>
					<a href="?inventario" class="nav__link nav__link--inside">
						<i class="clip-list-2"></i><span class="title"> Inventario </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'inventrio-contabilizar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?inventrio-contabilizar" class="nav__link nav__link--inside">
						<i class="clip-list-2"></i><span class="title"> Contabilizar </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'inventrio-categorias'){ echo ' class="menu-backg-item"';}?>>
					<a href="?inventrio-categorias" class="nav__link nav__link--inside">
						<i class="clip-list-2"></i><span class="title"> Categorías </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End: Inventario -->


		<!-- 
		/**
		* Modulo Contabilidad
		*/
		-->
        <?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('1050', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'contabilidad')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-stack-empty"></i>
				<span class="title" >&nbsp;Módulo Contabilidad </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_contabilidad">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'contabilidad'){ echo ' class="menu-backg-item"';}?>>
					<a href="?contabilidad" class="nav__link nav__link--inside">
						<i class="clip-stack-empty"></i><span class="title"> Contabilidad </span>
					</a>
				</li>
			</ul>
		</li>
		<?php } ?>
		<!-- End Contabilidad -->

		<!-- Reportes -->
        <?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('1100', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'reportes')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-stack-2"></i>
				<span class="title" >&nbsp;Reportes </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_reportes">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes/" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'reportes-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reportes-reportes" class="nav__link nav__link--inside">
						<i class="clip-stack-2"></i><span class="title"> Reportes </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End Reportes -->

		<!-- Configurations -->
        <?php //if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<?PHP if(in_array('9999', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click tooltips" data-original-title="Configuraciones" data-placement="right" title="Configuraciones" <?php if (strpos(GET()[0],'configurar')!==false) { echo  'class = "active open"'; }?> >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-settings"></i>
				<span class="title" >&nbsp;&nbsp;Configuraciones </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_configurar">
			</div>

			<ul class="list__show">
				<?php //if ($objPermOpc->tienePermiso(5001)) { ?>
				<li <?php if(GET()[0] == 'configurar-datos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-datos" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Configuración </span>
					</a>
				</li>
				<?php //} ?>
				<?php //if ($objPermOpc->tienePermiso(5002)) { ?>
				<li <?php if(GET()[0] == 'configurar-users'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-users" class="nav__link nav__link--inside">
						<i class="clip-user-plus"></i><span class="title"> Usuarios </span>
					</a>
				</li>
				<?php //} ?>
				<?php //if ($objPermOpc->tienePermiso(5003)) { ?>
				<li <?php if(GET()[0] == 'configurar-perfiles'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-perfiles" class="nav__link nav__link--inside">
						<i class="clip-users-2"></i><span class="title"> Perfiles </span>
					</a>
				</li>
				<?php //} ?>
				<?php //if ($objPermOpc->tienePermiso(5004)) { ?>
				<li <?php if(GET()[0] == 'configurar-permisos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-permisos" class="nav__link nav__link--inside">
						<i class="clip-key"></i><span class="title"> Permisos </span>
					</a>
				</li>
				<?php //} ?>
				<li <?php if(GET()[0] == 'configurar-notificaciones'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-notificaciones" class="nav__link nav__link--inside">
						<i class="clip-list-4"></i><span class="title"> Notificaciones </span>
					</a>
				</li>
				
			</ul>

		</li>
		<?php } ?>
		<!-- End Configuracion -->

		<li class="list_item tooltips" data-original-title="Salir" data-placement="right" title="Salir">
			<div class="list__button">
				<a href="quit" class="nav__link">
					<i class="clip-exit"></i>
					<span class="title">&nbsp;&nbsp;Salir </span>
					<span class="selected"></span>
				</a>
			</div>
		</li>

        </ul>
    </nav>
</div>

<script>

const queryString 	= window.location.search.substring(1);
const urlParams 	= new URLSearchParams(queryString);

$(document).ready(()=>{
	if (queryString) {
		let explode = queryString.split('-');
		explode.forEach (function (name , i) {
			if (name) {
				//console.log(name)
				//goToEspecificTag('#'+name);
				let linkMenu = '.arrow_'+name;
				$(linkMenu).trigger('click');
			}
		});
	}
});

const goToEspecificTag = (tag) => {
  $('html, body').animate({
      scrollTop: $(tag).offset().top
  }, 'slow');
}

let listElements = document.querySelectorAll('.list__button--click');
listElements.forEach(listElement => {
    listElement.addEventListener('click', ()=>{
        listElement.classList.toggle('arrow');
        let height = 0;
        let menu = listElement.nextElementSibling;
        if(menu.clientHeight == "0"){
            height=menu.scrollHeight;
        }
        menu.style.height = `${height}px`;
    })
});


</script>