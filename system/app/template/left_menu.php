<?php 

$objPermOpc 	= new permisos();
$active			= "style='background-color: #C8C7CC4D;'";
$activeOpen		= "class = 'active open'";

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
			<div class="list__button">
				<a href="home" class="nav__link">
					<i class="clip-home-3"></i>
					<span class="title"> Dashboard </span>
					<span class="selected"></span>
				</a>
			</div>
		</li>

		<!-- Events -->
		<li class="list_item">
			<div class="list__button">
				<a href="?eventos" class="nav__link">
				<i class="fa fa-group"></i>
				<span class="title"> Eventos </span>
				<span class="selected"></span>
				</a>
			</div>
		</li>

		<!-- Rooms -->
		<?PHP if($objPermOpc->tienePermiso(200) || $objPermOpc->tienePermiso(201)){  ?>
		<li class="list_item list__item--click <?php //if (strpos(GET()[0],'habitacion')!==false) { echo  'active open'; }?>">
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-checkbox-partial"></i>
				<span class="title" > Habitaciones </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_habitaciones">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'habitaciones'){ echo ' class="menu-backg-item"';}?>>
					<a href="?habitaciones" class="nav__link nav__link--inside">
						<i class="clip-checkbox-partial"></i><span class="title"> Habitaciones </span>
					</a>
				</li>

				<?php if ($objPermOpc->tienePermiso(201)) { ?>
				<li <?php if (strpos(GET()[0],'tipo-habitaciones')!==false) { echo  'class="menu-backg-item"'; }?>>
					<a href="?tipo-habitaciones" class="nav__link nav__link--inside">
						<i class="clip-checkbox-partial"></i>
						<span class="title"> Tipo de Habitación </span>
					</a>
				</li>
				<?php } ?>
			</ul>

		</li>
		<?php } ?>
		<!-- /End Habitaciones -->


		<!-- Planning -->
		<?PHP if($objPermOpc->tienePermiso(300)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'planning')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-calendar"></i>
				<span class="title" > Planning </span>
				
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
				<span class="title" > Reservas </span>
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
		<?PHP if($objPermOpc->tienePermiso(305)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'mante')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-settings"></i>
				<span class="title" > Mantenimientos</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_mante">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'mante-direcciones'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-direcciones" class="nav__link nav__link--inside">
					<!--<i class="clip-settings"></i>--> - <span class="title"> Direcciones </span>
				</a>
				</li>

				<li <?php if(GET()[0] == 'mante-departamentos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-departamentos" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Departamentos </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'mante-areas'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-areas" class="nav__link nav__link--inside">
					<!--<i class="clip-settings"></i>--> - <span class="title"> Áreas </span>
				</a>
				</li>
				
				<li <?php if(GET()[0] == 'mante-zonas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-zonas" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Zonas </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'mante-formulas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-formulas" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Formulas </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'mante-horarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-horarios" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Horarios </span>
					</a>
				</li>
				

				<!-- <li <?php if(GET()[0] == 'mante-buscar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-buscar" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Buscar Reservas </span>
					</a>
				</li> -->
			</ul>

		</li>
		<?php } ?>
		<!-- End Settings -->


		<!-- Roles de Turnos -->
		<?PHP if($objPermOpc->tienePermiso(305)){  ?>
		<li class="list_item list__item--click" <?php if (strpos(GET()[0],'roles-turnos')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-calendar"></i>
				<span class="title" > Roles de Turnos</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_roles_turnos">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'mante-direcciones'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-direcciones" class="nav__link nav__link--inside">
					<!-- <i class="clip-settings"></i> --> -<span class="title"> Roles de Turnos </span>
				</a>
				</li>

				<li <?php if(GET()[0] == 'mante-departamentos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-departamentos" class="nav__link nav__link--inside">
						<!-- <i class="clip-settings"></i> --> -<span class="title"> Cambios de Turnos </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'mante-areas'){ echo ' class="menu-backg-item"';}?>>
				<a href="?mante-areas" class="nav__link nav__link--inside">
					<!-- <i class="clip-settings"></i> --> -<span class="title"> Mis Turnos </span>
				</a>
				</li>
				
				<li <?php if(GET()[0] == 'mante-zonas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-zonas" class="nav__link nav__link--inside">
						<!-- <i class="clip-settings"></i> --> -<span class="title"> Buscar Roles de Turnos </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'mante-formulas'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-formulas" class="nav__link nav__link--inside">
						<!--<i class="clip-settings"></i>--> - <span class="title"> Mis Notificaciones </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'mante-horarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-horarios" class="nav__link nav__link--inside">
						<!-- <i class="clip-settings"></i> --> - <span class="title"> Reportes </span>
					</a>

						<ul class="list__show">
						<li <?php if(GET()[0] == 'caja-categorias'){ echo ' class="menu-backg-item"';}?>>
							<a href="?caja-categorias" class="nav__link nav__link--inside">
								<!--<i class="fa fa-truck"></i>--> |- <span class="title"> Listar Roles de Turnos </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'caja-clientes'){ echo ' class="menu-backg-item"';}?>>
							<a href="?caja-clientes" class="nav__link nav__link--inside">
								<!--<i class="fa fa-truck"></i>--> |- <span class="title"> Listar Cambios de Turnos </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'caja-proveedores'){ echo ' class="menu-backg-item"';}?>>
							<a href="?caja-proveedores" class="nav__link nav__link--inside">
								<!--<i class="fa fa-truck"></i>--> |- <span class="title"> Consultas de Usuarios </span>
							</a>
						</li>
						<li <?php if(GET()[0] == 'caja-proveedores'){ echo ' class="menu-backg-item"';}?>>
							<a href="?caja-proveedores" class="nav__link nav__link--inside">
								<!--<i class="fa fa-truck"></i>--> |- <span class="title"> Correcciones de Turnos </span>
							</a>
						</li>
						</ul>

				</li>
				

				<!-- <li <?php if(GET()[0] == 'mante-buscar'){ echo ' class="menu-backg-item"';}?>>
					<a href="?mante-buscar" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Buscar Reservas </span>
					</a>
				</li> -->
			</ul>

		</li>
		<?php } ?>
		<!-- End Roles de Turnos -->


		<!-- Caja -->
		<?php if ($objPermOpc->tienePermiso(500)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'caja')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="fa fa-money"></i>
				<span class="title" > Caja </span>
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
		<!-- End Caja -->

		<!-- Facturación -->
        <?php if ($objPermOpc->tienePermiso(400)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'facturacion')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-file-2"></i>
				<span class="title" > Módulo de Facturación </span>
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
		<!-- End Facturacion -->


		<!-- Inventario -->
        <?php if ($objPermOpc->tienePermiso(600)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'inventario')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-list-2"></i>
				<span class="title" > Módulo de Inventario </span>
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
		<!-- End Inventario -->


		<!-- Contabilidad -->
        <?php //if ($objPermOpc->tienePermiso(900)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'contabilidad')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-stack-empty"></i>
				<span class="title" > Módulo de Contabilidad </span>
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
		<?php //} ?>
		<!-- End Contabilidad -->


		<!-- Insumos -->
        <?php if ($objPermOpc->tienePermiso(700)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'insumos')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-arrow-down-right"></i>
				<span class="title" >Insumos </span>
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
        <?php if ($objPermOpc->tienePermiso(800)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'reportes')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-stack-2"></i>
				<span class="title" > Reportes </span>
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
        <?php if ($objPermOpc->tienePermiso(5000)) { ?>
		<li class="list_item list__item--click <?php if (strpos(GET()[0],'configurar')!==false) { echo  'active open'; }?>" >
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-settings"></i>
				<span class="title" > Configuraciones </span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_configurar">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'configurar-datos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-datos" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Configuración </span>
					</a>
				</li>

				<li <?php if(GET()[0] == 'configurar-usuarios'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-usuarios" class="nav__link nav__link--inside">
						<i class="clip-user-plus"></i><span class="title"> Usuarios </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'facturacion-perfiles'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-perfiles" class="nav__link nav__link--inside">
						<i class="clip-users-2"></i><span class="title"> Perfiles </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'configurar-permisos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-permisos" class="nav__link nav__link--inside">
						<i class="clip-key"></i><span class="title"> Permisos </span>
					</a>
				</li>
				<li <?php if(GET()[0] == 'facturacion-menu'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-menu" class="nav__link nav__link--inside">
						<i class="clip-list-4"></i><span class="title"> Menú </span>
					</a>
				</li>
				
			</ul>

		</li>
		<?php } ?>
		<!-- End Configuracion -->

        </ul>
    </nav>
</div>

<script src=""></script>
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