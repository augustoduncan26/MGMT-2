<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user 		=	$_SESSION['id_user'];
$id_cia 		=	$_SESSION['id_cia'];

// Add
if ( isset($_GET['add']) &&  $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$where 			= 	'permiso="'.$_GET['permiso'].'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'Ya existe un registro con el mismo permiso.';
	} else {
		$P_Campos 		=	'nombre,permiso,permiso_padre,activo,created_at';
		$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['permiso']."', '".$_GET['permiso_padre']."','".$_GET['estado']."',NOW()";
		$sql		=	$ObjEjec->insertarRegistro(PREFIX."permiso_definicion", $P_Campos, $P_Valores);
		
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}
	}
}

// Edit
if ( isset($_GET['edit']) &&  $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['permiso'] !='') {
	$P_Valores 	= 	" nombre = '".$_GET['nombre']."', permiso = '".$_GET['permiso']."', permiso_padre = '".$_GET['permiso_padre']."',  activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	$upd 			=	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'permiso_definicion', $P_condicion);
	echo $mssg 		=	'Se actualizo el registro con éxito.';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permiso_definicion Where id = '".$_GET['id']."'");
	//mysql_query("Delete from ".$tblDefinicion." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito.';
}


?>