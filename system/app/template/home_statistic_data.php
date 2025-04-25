<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   	= new Mantenimientos();
$ObjEjec    	= new ejecutorSQL();
$id_rol     	= $_SESSION["id_rol"];
$id_user    	= $_SESSION["id_user"];
$id_cia 		= $_SESSION['id_cia'];
$email 			= $_SESSION['email'];
$username 		= $_SESSION['username'];
$P_tabla   		= PREFIX.'usuarios';

$totalTeachers 	= $ObjMante->BuscarLoQueSea('*',$P_tabla,'id_perfil=3',false);
$totalStudents 	= $ObjMante->BuscarLoQueSea('*',$P_tabla,'id_perfil=2',false);
$totalParents 	= $ObjMante->BuscarLoQueSea('*',$P_tabla,'id_perfil=1',false);

?>
<!-- Top Data: Students, Teachers, Parents -->
<div class="row">
	
	<div class="col-sm-4">
		<div class="core-box core-box-top-menu">
			<div class="heading">
				<i class="clip-users circle-icon circle-teal"></i>
				<h2>Profesores</h2>
			</div>
			<div class="content">
				<h4><span>Total:</span> <?=($totalTeachers['total'])?$totalTeachers['total']:0?></h4>
			</div>
			<a class="view-more" href="#">
			Ver Más <i class="clip-arrow-right-2"></i>
			</a>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="core-box core-box-top-menu">
			<div class="heading">
				<!-- <i class="clip-user-4 circle-icon circle-green"></i> -->
				<i class="clip-users-2 circle-icon circle-green"></i>
				<h2 style="text-align: left;">Estudiantes</h2>
			</div>
			<div class="content">
				<h4><span>Total:</span> <?=($totalParents['total'])?$totalParents['total']:0?></h4>
			</div>
			<a class="view-more" href="#">
				Ver Más <i class="clip-arrow-right-2"></i>
			</a>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="core-box core-box-top-menu">
			<div class="heading">
				<i class="clip-users circle-icon  circle-bricky"></i>
				<h2>Padres</h2>
			</div>
			<div class="content">
				<h4><span>Total:</span> <?=($totalTeachers['total'])?$totalTeachers['total']:0?></h4>
			</div>
			<a class="view-more" href="#">
			Ver Más <i class="clip-arrow-right-2"></i>
			</a>
		</div>
	</div>
</div>
<!-- End Top Data -->