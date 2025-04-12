<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'perfiles';

$where 			= 	'id_cia="'.$id_cia.'"';
$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles',$where,'array','name');

/**
 * Select All
 */
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
	$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles',$where,'array','name');
	echo json_encode($listPerfiles['resultado']);
}

/**
 * Permisos
*/ 
if (isset($_POST['editperm']) && $_POST['editperm']==1) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permisos Where id_perfil = '".$_POST['id_']."' and id_cia='".$id_cia."'");
	$exp 		=	explode(",",$_POST['valores']);
	$cuantos = count($exp);
	for ($i = 0 ; $i < $cuantos; $i++) {
		if ($exp[$i]!='on') {
			$P_Campos 		=	'id_perfil,id_definicion_permiso,id_cia,activo';
			$P_Valores 		=	"'".$_POST['id_']."','".$exp[$i]."','".$id_cia."',1";
			$ObjEjec->insertarRegistro(PREFIX.'permisos', $P_Campos, $P_Valores);
		}
	}
	echo 'Se actualizo el registro con éxito.';
}

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] != '') {
	$P_Campos 		=	'name,description,id_cia,activo,created_at,updated_at';
	$P_Valores 		=	"'".sanear_string($_POST['r1'])."','".$_POST['r2']."','".$_SESSION['id_cia']."','".$_POST['r3']."',NOW(),NOW()";
	
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'name="'.$_POST['r1'].'"','array');

	if ($sql['total'] > 0 ) {
		echo 'Ya existe este registro.';
	} else {
		//$P_Valores 	= 	"'".$_POST['r1']."','".$_SESSION['id_cia']."','".$_POST['r3']."'";
		$l 		=	$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		//$l 			=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
		if ($l ==1) {
			echo 'okay';
		} else {
			echo 'error';
		}
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

/**
 * Edit
 */
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['r1'] !='') {
	$P_Valores = "name = '".Reemplazar_letras($_POST['r1'])."', description='".$_POST['r2']."' ,activo = '".$_POST['r3']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id = "'.$_POST['id'].'"');
  	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

/**
 * Delete
 */
if ( isset($_POST['delete']) && $_POST['delete'] == 1 ) { 
	$r = $ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_POST['id']."' and id_cia='".$id_cia."'");
	if ($r == 1) {
		echo 'ok';
	} else {
		echo 'error';
	}
}
?>