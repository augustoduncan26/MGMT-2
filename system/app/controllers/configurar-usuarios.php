<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'usuarios';

$where 			= 	'id_cia="'.$id_cia.'"';
$listUsers 		=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','id_usuario');
$listEmpleados 	=	$ObjMante->BuscarLoQueSea('email',PREFIX.'empleados',false,'array','id,nempleado');
$listUsuarios 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios',$where,'array');

// Select al Perfiles
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
	$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_perfiles',$where,'array','id,name');
	echo json_encode($listPerfiles['resultado']);
}

// Add
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] != '') {
	$P_Campos 		=	'name,id_cia,active,created_at,updated_at';
	$P_Valores 		=	"'".sanear_string($_GET['nombre'])."','".$_SESSION['id_cia']."','".$_GET['estado']."',NOW(),NOW()";
	
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'name="'.$_GET['nombre'].'"','array');

	if ($sql['total'] > 0 ) {
		echo $mssg	=	'Ya existe este registro.';
	} else {
		$P_Valores = "'".$_GET['nombre']."','".$_GET['id_cia']."','".$_GET['estado']."'";
		$sql 		=	$ObjEjec->insertarRegistro($P_Tabla, 'name,id_cia,active', $P_Valores);
		echo $mssg 	=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".Reemplazar_letras($_GET['nombre'])."',active = '".$_GET['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id = "'.$_GET['id'].'"');
  	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

// Permisos
if (isset($_POST['editperm']) && $_POST['editperm']==1) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permisos Where id_usuario = '".$_POST['id_']."'");
	$exp 		=	explode(",",$_POST['valores']);
	$cuantos 	= 	count($exp);
	for ($i = 0 ; $i < $cuantos; $i++) {
		if (is_numeric($exp[$i])) {
			$P_Campos 		=	'id_usuario,id_definicion_permiso';
			$P_Valores 		=	"'".$_POST['id_']."','".$exp[$i]."'";
			$ObjEjec->insertarRegistro(PREFIX.'permisos', $P_Campos, $P_Valores);
		}
	}
	echo $mssg 		=	1;
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>