<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
// include_once ( dirname(dirname(__DIR__)) . '/functions.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia = $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

$ObjMante   = new Mantenimientos();

//$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id = '.$_GET['id'],'extract');
$typeDeptos = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id_cia = '.$_SESSION['id_cia'].' and active=1','array');


if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$where 			= 	'name="'.$_GET['nombre'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'mant_areas';
		$P_Campos 	=	'id_cia,name,id_depto,users,turn_a,turn_b,turn_c,turn_d,turn_e,active,created_at,updated_at';
		$P_Valores 	=	"'".$id_cia."','".$_GET['nombre']."','".$_GET['departamento']."','".$_GET['total_usuarios']."','".$_GET['turno_a']."','".$_GET['turno_b']."','".$_GET['turno_c']."','".$_GET['turno_d']."','".$_GET['turno_e']."','".$_GET['estado']."',NOW(),NOW()";
		$result 	= $ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		if ($result == 1) {
			echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
		} else {
			echo $result;
		}
		
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".$_GET['nombre']."', id_depto = '".$_GET['depto']."', users = '".$_GET['total_usuarios']."', 
	turn_a = '".$_GET['turno_a']."', turn_b = '".$_GET['turno_b']."', turn_c = '".$_GET['turno_c']."', turn_d = '".$_GET['turno_d']."', turn_e = '".$_GET['turno_e']."',
	active = '".$_GET['activo']."', updated_at=NOW()";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_areas', 'id = "'.$_GET['id_row'].'"');
  	echo '<div class="alert alert-success">Se ha actualizado el registro con éxito</div>';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_areas Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>