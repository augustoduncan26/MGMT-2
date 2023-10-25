<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];
$ObjMante   	= new Mantenimientos();
$Objsql    		= new ejecutorSQL();

$P_Tabla 		=	PREFIX.'rooms_type';

// Add
if ( isset($_GET['add']) && $_GET['add'] == 1 && isset($_SESSION['id_user'])) {

	$P_Campos 		=	'code,nombre,capacidad,capacidad_max,id_empresa,block,active';
	$P_Valores 	=	"'".$_GET['codigo']."','".$_GET['nombre']."','".$_GET['capacidad']."','".$_GET['capacidad_max']."','".$_SESSION['id_empresa']."',0,'".$_GET['estado']."'";
	$buscar 		=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_empresa = '.$id_empresa.' and nombre = "'.$_GET['nombre'].'"','array');
	
	if ( $buscar['total'] > 0 ) {
		echo $mssg	=	'Ya existe este registro.';
	} else {
		$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		if ($sql) {
			echo $mssg 	=	'Se guardo el registro con éxito';
		}
	}
}

// Edit
if ( isset($_GET['edit']) &&  $_GET['edit'] == 1) {
	$P_Valores 		= 	" code = '".$_GET['codigo']."', nombre = '".$_GET['nombre']."', capacidad = '".$_GET['capacidad']."', capacidad_max = '".$_GET['capacidad_max']."', id_empresa = '".$_SESSION['id_empresa']."', active = '".$_GET['estado']."'";
	$P_condicion	=	" id = '".$_GET['id']."'";
	$resultOpe  	=  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( isset($_GET['delete']) &&  $_GET['delete'] == 1 ) {
	$Objsql->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>