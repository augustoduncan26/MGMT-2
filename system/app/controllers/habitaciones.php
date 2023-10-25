<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$Objsql    	= new ejecutorSQL();

$id_user 		=	isset($_SESSION['id_user'])?$_SESSION['id_user']:'';
$id_empresa 	=	isset($_SESSION['id_empresa'])?$_SESSION['id_empresa']:'';
$P_Tabla 		=	PREFIX.'rooms';

// Add
if ( isset($_GET['add']) &&  $_GET['add'] == 1 && $_GET['nombre'] != '' && $_GET['tipo']) {
	$P_Campos 		=	'code,type_room,total_beds,price,id_empresa,cleaning,active';
	$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['tipo']."','".$_GET['total_beds']."','".$_GET['precio']."','".$_SESSION['id_empresa']."',0,'".$_GET['estado']."'";	
	$busca 			= 	$ObjMante->BuscarLoQueSea('*', $P_Tabla, 'id_empresa = '.$id_empresa.' and code = "'.$_GET['nombre'].'"', 'array');

	if ( $busca['total'] > 0 ) {
		echo $mssg	=	'Ya existe esta habitación';
	} else {
		$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}
	}
}

// Edit
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['tipo'] !='') {
	$P_Valores 		= 	" code = '".$_GET['nombre']."', type_room = '".$_GET['tipo']."', price = '".number_format($_GET['precio'],2)."', total_beds = '".$_GET['total_beds']."', cleaning = '".$_GET['cleaning']."', active = '".$_GET['activo']."'";
	$P_condicion	=	" id = '".$_GET['id']."'";
	$resultOpe  	=  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
	$Objsql->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>