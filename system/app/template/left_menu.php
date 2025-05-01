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
<nav class="nav">
        <ul class="sub-menu" style="padding: 0px 0px 0px 20px;">

		<!-- Home -->
		<li class="list_item">
		<a href="home" class="nav__link">
			<div class="list__button">
				<i class="clip-home-3"></i>
				<span class="title">Home</span>
				<!-- <span class="selected"></span> -->
			</div>
		</a>
		</li>

		<!-- Events -->
		<?php 
		//if ($objPermOpc->tienePermiso(50)) {
		if(in_array('50', $objPermOpc->getUserPermissions($id_user))) { 
		?>
		<li class="list_item">
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
		<?PHP if(in_array('100', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Profesores" class="nav__link">
			<div class="list__button">
				<i class="clip-user-5"></i>
				<span class="title">Profesores</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Students -->
		<?PHP if(in_array('150', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Estudiantes" class="nav__link">
			<div class="list__button">
				<i class="clip-users-2"></i>
				<span class="title">Estudiantes</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Parents -->
		<?PHP if(in_array('200', $objPermOpc->getUserPermissions($id_user))) {  ?>
			<li class="list_item">
			<a href="?Padres" class="nav__link">
			<div class="list__button">
				<i class="fa fa-group"></i>
				<span class="title">Padres</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Subjects -->
		<?PHP if(in_array('250', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Asignaturas" class="nav__link">
			<div class="list__button">
				<i class="fa fa-indent"></i>
				<span class="title">Asignaturas</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Classes -->
		<?PHP if(in_array('300', $objPermOpc->getUserPermissions($id_user))) {  ?>
			<li class="list_item">
			<a href="?Clases" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Clases</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Lessons -->
		<?PHP if(in_array('350', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Lecciones" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Lecciones</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Exams -->
		<?PHP if(in_array('400', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Examenes" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar-3"></i>
				<span class="title">Examenes</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Assignments -->
		<?PHP if(in_array('450', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
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
		<?PHP if(in_array('500', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Resultados" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Resultados</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Attendance -->
		<?PHP if(in_array('550', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
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
		<?PHP if(in_array('600', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Mensajes" class="nav__link">
			<div class="list__button">
				<i class="clip-bubble-dots-2"></i>
				<span class="title">Mensajes</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Announcements -->
		<?PHP if(in_array('650', $objPermOpc->getUserPermissions($id_user))) {   ?>
			<li class="list_item">
			<a href="?Anuncios" class="nav__link">
			<div class="list__button">
				<i class="fa fa-bell"></i>
				<span class="title">Anuncios</span>
				<!-- <span class="selected"></span> -->
			</div>
			</a>
		</li>
		<?php } ?>


		<!-- <li class="list_item list__item--click <?php //if (strpos(GET()[0],'habitacion')!==false) { echo  'active open'; }?>">
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="fa fa-group"></i>
				<span class="title" >&nbsp;Profesores </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_habitaciones">
			</div>

			<ul class="list__show">
				<?php if ($objPermOpc->tienePermiso(200)) { ?>
				<li <?php if(GET()[0] == 'habitaciones'){ echo ' class="menu-backg-item"';}?>>
					<a href="?habitaciones" class="nav__link nav__link--inside">
						<i class=""></i><span class="title"> Profesores </span>
					</a>
				</li>
				<?php } ?>
				<?php if ($objPermOpc->tienePermiso(201)) { ?>
				<li <?php if (strpos(GET()[0],'tipo-habitaciones')!==false) { echo  'class="menu-backg-item"'; }?>>
					<a href="?tipo-habitaciones" class="nav__link nav__link--inside">
						<i class=""></i>
						<span class="title"> Profesores </span>
					</a>
				</li>
				<?php } ?>
			</ul>

		</li> -->
		<?php //} ?>
		<!-- /End Habitaciones -->


		<!-- Planning -->
		<?PHP if(in_array('700', $objPermOpc->getUserPermissions($id_user))) {   ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'planning')!==false) { echo  'class = "active open"'; }?>>
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


		<!-- Reservas -->
		<?PHP if($objPermOpc->tienePermiso(305)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'reservas')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-tag"></i>
				<span class="title" >&nbsp;Reservas </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_reservas">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'reservas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reservas" class="nav__link nav__link--inside">
						<i class="clip-tag"></i><span class="title"> Reservas </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'reservas-buscar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?reservas-buscar" class="nav__link nav__link--inside">
						<i class="clip-tag"></i><span class="title"> Buscar Reservas </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End Reservas -->


		<!-- Settings / Mantenimientos -->
		<?PHP if($objPermOpc->tienePermiso(1000)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'mante')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-settings"></i>
				<span class="title" >&nbsp;Mantenimientos</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_mante">
			</div>

			<ul class="list__show">
				<?PHP if($objPermOpc->tienePermiso(1100)){  ?>
				<li <?php if(GET()[0] == 'mante-direcciones'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-direcciones" class="nav__link nav__link--inside">
					<!--<i class="clip-settings"></i>--> - <span class="title"> Direcciones </span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1150)){  ?>
				<li <?php if(GET()[0] == 'mante-departamentos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-departamentos" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Departamentos </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1200)){  ?>
				<li <?php if(GET()[0] == 'mante-areas'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-areas" class="nav__link nav__link--inside">
					<!--<i class="clip-settings"></i>--> - <span class="title"> Áreas </span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1250)){  ?>
				<li <?php if(GET()[0] == 'mante-zonas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-zonas" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Zonas </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1300)){  ?>
				<li <?php if(GET()[0] == 'mante-formulas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-formulas" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Formulas </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1350)){  ?>
				<li <?php if(GET()[0] == 'mante-horarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-horarios" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Horarios </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(1351)){  ?>
				<li <?php if(GET()[0] == 'mante-tipos-horarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-tipos-horarios" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title">Tipos de Horarios </span>
					</a>
				</li>
				<?php } ?>
				<?PHP if($objPermOpc->tienePermiso(1352)){  ?>
				<li <?php if(GET()[0] == 'mante-rolesturnos-otros-param-despacho'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-rolesturnos-otros-param-despacho" class="nav__link nav__link--inside" title="Otros Mant. Despacho">
						<!--<i class="clip-settings"></i>--> - <span class="title">Otros Mant. Despacho </span>
					</a>
				</li>
				<?php } ?>
				<?PHP if($objPermOpc->tienePermiso(1353)){  ?>
				<li <?php if(GET()[0] == 'mante-rolesturnos-otros-param-preh'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-rolesturnos-otros-param-preh" class="nav__link nav__link--inside" title="Otros Mant. Pre-Hospitalaria">
						<!--<i class="clip-settings"></i>--> - <span class="title">Otros Mant. Pre-Hosp. </span>
					</a>
				</li>
				<?php } ?>

				<!-- <li <?php if(GET()[0] == 'mante-buscar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-buscar" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Buscar Reservas </span>
					</a>
				</li> -->
			</ul>

		</li>
		<?php } ?>
		<!-- End Settings / Mantenimientos -->


		<!-- Roles de Turnos -->
		<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'roles')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-calendar"></i>
				<span class="title" >&nbsp;Roles de Turnos</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_roles">
			</div>

			<ul class="list__show">

				<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
				<li <?php if(GET()[0] == 'roles-turnos'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-turnos" class="nav__link nav__link--inside">
					-<span class="title"> Roles de Turnos</span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
				<li <?php if(GET()[0] == 'roles-turnos-despacho'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-turnos-despacho" class="nav__link nav__link--inside">
					-<span class="title">Roles Turnos Despacho</span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
				<li <?php if(GET()[0] == 'roles-turnos-preh'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-turnos-preh" class="nav__link nav__link--inside">
					-<span class="title">Roles Turnos Pre-Hosp.</span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
				<li <?php if(GET()[0] == 'roles-turnos-medicos'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-turnos-medicos" class="nav__link nav__link--inside">
					-<span class="title">Roles Turnos Médicos</span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2000)){  ?>
				<li <?php if(GET()[0] == 'roles-turnos-mecanicos'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-turnos-mecanicos" class="nav__link nav__link--inside">
					-<span class="title">Roles Turnos Mecánicos</span>
				</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2050)){  ?>
				<li <?php if(GET()[0] == 'roles-cambios-turnos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?roles-cambios-turnos" class="nav__link nav__link--inside">
						-<span class="title"> Cambios de Turnos </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2100)){  ?>
				<li <?php if(GET()[0] == 'roles-mis-turnos'){ echo ' class="menu-backg-item"';}?>>
				<a href="?roles-mis-turnos" class="nav__link nav__link--inside">
					-<span class="title"> Mis Turnos </span>
				</a>
				</li>
				<?php } ?>
				
				<?PHP if($objPermOpc->tienePermiso(2150)){  ?>
				<li <?php if(GET()[0] == 'roles-buscar-turnos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?roles-buscar-turnos" class="nav__link nav__link--inside">
						-<span class="title"> Buscar Roles de Turnos </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2200)){  ?>
				<li <?php if(GET()[0] == 'roles-notificaciones'){ echo ' class="menu-backg-item"';}?>>
					<a href="?roles-notificaciones" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Mis Notificaciones </span>
					</a>
				</li>
				<?php } ?>

				<?PHP if($objPermOpc->tienePermiso(2250)){  ?>
				<li <?php if(GET()[0] == 'roles-reportes'){ echo ' class="menu-backg-item"';}?>>
					<a href="#" class="nav__link nav__link--inside">
						- <span class="title"> Reportes </span>
					</a>

						<ul class="list__show">
						<li <?php if(GET()[0] == 'roles-listar-roles-turnos'){ echo ' class="menu-backg-item"';}?>>
							<a href="?roles-listar-roles-turnos" class="nav__link nav__link--inside">
								|- <span class="title"> Listar Roles de Turnos </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'roles-listar-cambios-turnos'){ echo ' class="menu-backg-item"';}?>>
							<a href="?roles-listar-cambios-turnos" class="nav__link nav__link--inside">
								|- <span class="title"> Listar Cambios de Turnos </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'roles-consultas-usuarios'){ echo ' class="menu-backg-item"';}?>>
							<a href="?roles-consultas-usuarios" class="nav__link nav__link--inside">
								|- <span class="title"> Consultas de Usuarios </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'roles-correcciones-turnos'){ echo ' class="menu-backg-item"';}?>>
							<a href="?roles-correcciones-turnos" class="nav__link nav__link--inside">
								|- <span class="title"> Correcciones de Turnos </span>
							</a>
						</li>
						</ul>

				</li>
				<?php } ?>
			</ul>
		</li>
		<?php } ?>
		<!-- End Roles de Turnos -->

		<!--  Menu Usuarios -->
		<?php if(in_array('800', $objPermOpc->getUserPermissions($id_user))) { ?>
			<li class="list_item list__item--click" <?php if (strpos(GET()[0],'usuarios')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link">
				<i class="clip-settings"></i>
				<span class="title" >&nbsp;Mantenimientos</span>
				<i class="fa icon-arrow"></i>
				<!-- <span class="selected"></span> -->
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_usuarios">
			</div>

			<ul class="list__show">
				<?PHP if(in_array('800', $objPermOpc->getUserPermissions($id_user))) {  ?>
				<li <?php if(GET()[0] == 'usuarios-listar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-listar" class="nav__link nav__link--inside">
						-<span class="title">Mant. Usuarios</span>
					</a>
				</li>
				<?php } ?>
				
				<?PHP if(in_array('801', $objPermOpc->getUserPermissions($id_user))) {   ?>
				<li <?php if(GET()[0] == 'usuarios-perfiles'){ echo ' class="menu-backg-item"';}?>>
					<a href="?usuarios-perfiles" class="nav__link nav__link--inside">
						-<span class="title"> Mant. Perfiles </span>
					</a>
				</li>
				<?php } ?>
				<?PHP if(in_array('802', $objPermOpc->getUserPermissions($id_user))) {   ?>
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
		<?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
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
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
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
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
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
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
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


		<!-- Insumos -->
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'insumos')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-arrow-down-right"></i>
				<span class="title" >&nbsp;Insumos </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_insumos">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'insumos-stock'){ echo ' class="menu-backg-item"';}?>>
					<a href="?insumos-stock" class="nav__link nav__link--inside">
						<i class="clip-arrow-down-right"></i><span class="title"> Stock </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'insumos-contabilizar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?insumos-contabilizar" class="nav__link nav__link--inside">
						<i class="clip-arrow-down-right"></i><span class="title"> Contabilizar </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'insumos-ingresos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?insumos-ingresos" class="nav__link nav__link--inside">
						<i class="clip-arrow-down-right"></i><span class="title"> Ingresos </span>
					</a>
				</li>
			</ul>

		</li>
		<?php } ?>
		<!-- End Insumos -->

		<!-- Reportes -->
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
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
        <?php if ($objPermOpc->checkUserRol($_SESSION['id_user']) == 100 ) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'configurar')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-settings"></i>
				<span class="title" >&nbsp;Configuraciones </span>
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
				<li <?php if(GET()[0] == 'configurar-usuarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-usuarios" class="nav__link nav__link--inside">
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

		<li class="list_item">
			<div class="list__button">
				<a href="quit" class="nav__link">
					<i class="clip-exit"></i>
					<span class="title">&nbsp;Salir </span>
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
				let linkMenu = '.arrow_'+name;
				$(linkMenu).trigger('click');
			}
		});
	}
});

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