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
			</div>
		</a>
		</li>

		<!-- Estadisticas -->
		<?php 
			if(in_array('850', $objPermOpc->getRolPermissions($id_rol))) { 
		?>
		<li <?php if(GET()[0] == 'Estadisticas'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> id="Estadisticas" data-original-title="Gráficos Estadísticos" data-placement="right" title="Estadisticas">
		<a href="?Estadisticas" class="nav__link">
			<div class="list__button">
				<i class="clip-stats"></i>
				<span class="title" >Estadisticas</span>
			</div>
		</a>
		</li>
		<?php } ?>

		<!-- Events -->
		<?php 
			if(in_array('50', $objPermOpc->getRolPermissions($id_rol))) { 
		?>
		<li <?php if(GET()[0] == 'Eventos'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Admin. Eventos" data-placement="right" title="Adminstrar Eventos">
			<a href="?Eventos" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar"></i>
				<span class="title">Eventos</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Teachers -->
		<?PHP if(in_array('100', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Profesores'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Asignación de Profesores" data-placement="right" title="Asignación de Profesores">
			<a href="?Profesores" class="nav__link">
			<div class="list__button">
				<img src="assets/images/teacher.png" class="icon-teachers" />
				<span class="title">Asig. Profesores</span>
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
				<span class="title">Agenda Profesor</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Students / Estudiantes-->
		<?PHP if(in_array('150', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Estudiantes'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Asignación de Estudiantes" data-placement="right" title="Asignación de Estudiantes">
			<a href="?Estudiantes" class="nav__link">
			<div class="list__button">
				<i class="clip-users-2"></i>
				<span class="title">Asig. Estudiantes</span>
			</div>
			</a>
		</li>
		<?php } ?>
		<!-- Cronograma Estudiantes -->
		<?PHP if(in_array('351', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Schedule-students'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Agenda Estudiantes" data-placement="right" title="Agenda Estudiantes">
			<a href="?Schedule-students" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar"></i>
				<span class="title">Agenda Estudiante</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Parents / Padres-->
		<?PHP if(in_array('200', $objPermOpc->getRolPermissions($id_rol))) {  ?>
			<li <?php if(GET()[0] == 'Padres'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Lista de Padres" data-placement="top" title="Lista de Padres">
			<a href="?Padres" class="nav__link">
			<div class="list__button">
				<i class="fa fa-group"></i>
				<span class="title">Padres</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Subjects / Materias-->
		<?PHP if(in_array('250', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Asignaturas'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Asignaturas" data-placement="right" title="Asignaturas-Materias">
			<a href="?Asignaturas" class="nav__link">
			<div class="list__button">
				<i class="fa fa-indent"></i>
				<span class="title">Asignaturas / Materias</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Classes -->
		<?PHP if(in_array('300', $objPermOpc->getRolPermissions($id_rol))) {  ?>
			<li <?php if(GET()[0] == 'Clases'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Listado de Clases" data-placement="top" title="Lista de Clases">
			<a href="?Clases" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Clases</span>
			</div>
			</a>
		</li>
		<?php } ?>
		

		<!-- Exams -->
		<?PHP if(in_array('400', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Examenes'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Lista de Examenes" data-placement="top" title="Lista de Examentes">
			<a href="?Examenes" class="nav__link">
			<div class="list__button">
				<i class="clip-calendar-3"></i>
				<span class="title">Examenes</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Assignments / Tareas -->
		<?PHP if(in_array('450', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Tareas'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Lista de Tareas" data-placement="top" title="Lista de Tareas">
			<a href="?Tareas" class="nav__link">
			<div class="list__button">
				<i class="fa fa-tasks"></i>
				<span class="title">Tareas</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Results -->
		<?PHP if(in_array('500', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Resultados'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Resultados" data-placement="right" title="Resultados">
			<a href="?Resultados" class="nav__link">
			<div class="list__button">
				<i class="clip-list-2"></i>
				<span class="title">Resultados</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Attendance / % de Asistencia -->
		<?PHP if(in_array('550', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Asistencias'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Asistencias" data-placement="right" title="Asistencias">
			<a href="?Asistencias" class="nav__link">
			<div class="list__button">
				<i class="clip-checkbox"></i>
				<span class="title">Asistencias</span>
			</div>
			</a>
		</li>
		<?php } ?>

		<!-- Messages -->
		<?PHP if(in_array('600', $objPermOpc->getRolPermissions($id_rol))) {   ?>
			<li <?php if(GET()[0] == 'Mensajes'){ echo ' class="menu-backg-item list_item tooltips"'; } else { echo 'class="list_item tooltips"' ;}?> data-original-title="Mensajes" data-placement="right" title="Mensajes">
			<a href="?Mensajes" class="nav__link">
			<div class="list__button">
				<i class="clip-bubble-dots-2"></i>
				<span class="title">Mensajes</span>
			</div>
			</a>
		</li>
		<?php } ?>


		<!-- Planning -->
		<?PHP if(in_array('750', $objPermOpc->getRolPermissions($id_rol))) {   ?>
		<li class="list_item list__item--click tooltips" data-original-title="Planning" data-placement="right" title="Planning" <?php if (strpos(GET()[0],'planning')!==false) { echo  'class = "active open"'; }?>>
			<div class="list__button list__button--click">
			<a href="javascript:void(0)" class="nav__link"><i class="clip-calendar"></i>
				<span class="title" >&nbsp;&nbsp;Planner</span>
				<i class="fa icon-arrow"></i>
				<span class="selected"></span>
			</a>
			<img src="assets/images/arrow.svg" class="list__arrow arrow_planning">
			</div>

			<ul class="list__show">
				<li <?php if(GET()[0] == 'planning'){ echo ' class="menu-backg-item"';}?>>
					<a href="?planning" class="nav__link nav__link--inside">
						<i class="clip-calendar"></i><span class="title"> Planner </span>
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


		<!-- Configurations -->
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
				<li <?php if(GET()[0] == 'configurar-datos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-datos" class="nav__link nav__link--inside">
						<i class="clip-settings"></i><span class="title"> Configuración </span>
					</a>
				</li>
		
				<li <?php if(GET()[0] == 'configurar-users'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-users" class="nav__link nav__link--inside">
						<i class="clip-user-plus"></i><span class="title"> Usuarios </span>
					</a>
				</li>
			
				<li <?php if(GET()[0] == 'configurar-perfiles'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-perfiles" class="nav__link nav__link--inside">
						<i class="clip-users-2"></i><span class="title"> Perfiles </span>
					</a>
				</li>
			
				<li <?php if(GET()[0] == 'configurar-permisos'){ echo ' class="menu-backg-item"';}?>>
					<a href="?configurar-permisos" class="nav__link nav__link--inside">
						<i class="clip-key"></i><span class="title"> Permisos </span>
					</a>
				</li>
				
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