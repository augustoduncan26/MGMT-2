<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$whr 		= 'id_cia='.$id_cia;
/** Listar Permisos */
$listPermisos 		= $ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion',$whr,'array','nombre,permiso');
//'id_cia='.$id_cia

// Select al Permissions
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$listPermisos 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion',$whr,'array','permiso');
	echo json_encode($listPermisos['resultado']);
}

// Add
if ( isset($_GET['add']) &&  $_GET['add'] == 1 && $_GET['nombre'] != '') {
	$where 			= 	'id_cia= "'.$id_cia.'" and permiso="'.$_GET['permiso'].'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'Ya existe un registro con el mismo permiso.';
	} else {
		$P_Campos 		=	'nombre,permiso,permiso_padre,id_cia,activo,created_at';
		$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['permiso']."', '".$_GET['permiso_padre']."','".$id_cia."','".$_GET['estado']."',NOW()";
		$sql			=	$ObjEjec->insertarRegistro(PREFIX."permiso_definicion", $P_Campos, $P_Valores);
		if ($sql) {
			echo $mssg 	=	'<div class="alert alert-success">Se ingreso el registro con éxito</div>';
		}
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Update
if ( isset($_GET['edit']) &&  $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['permiso'] !='') {
	$P_Valores 	= 	" nombre = '".$_GET['nombre']."', permiso = '".$_GET['permiso']."', permiso_padre = '".$_GET['permiso_padre']."',  activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	$upd 			=	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'permiso_definicion', $P_condicion);
	echo $mssg 		=	'<div class="alert alert-success">Se actualizo el registro con éxito.</div>';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permiso_definicion Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-success">Se elimino el registro con éxito.</div>';
}
