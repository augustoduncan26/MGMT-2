<?php

include_once ('../../framework.php');

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];

// Names of tables
if($_SESSION['id_user']==1 || $_SESSION['id_user'] == 2):
	$TblRooms		=	'ad_habitaciones';
	$TblBeds		=	'ad_beds';
	$TblBooking		=	'ad_reservas';
;else: 
	$TblRooms		=	'ad_'.$_SESSION['id_user'].'_habitaciones';
	$TblBeds		=	'ad_'.$_SESSION['id_user'].'_beds';
	$TblBooking		=	'ad_'.$_SESSION['id_user'].'_reservas';
endif;

$tblDefinicion 		=	'zz_permiso_definicion';

// Add
	if ( $_GET['add'] == 1 && $_GET['nombre'] != '') {
// if ($_POST['agregar_habitacion']) {

	$P_Tabla 		=	$tblDefinicion;

	$P_Campos 		=	'nombre,permiso,permiso_padre,id_empresa,activo';
	$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['permiso']."', '".$_GET['permiso_padre']."','".$id_empresa."','".$_GET['estado']."'";
	
	$busca 			=	mysql_query("Select * From ".$P_Tabla." Where permiso = '".$_GET['permiso']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if (mysql_num_rows($busca) >0 ) {
		echo $mssg	=	'Ya existe un registro con el mismo permiso';
	} else {
		//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}

	}
}

// Edit
if ( $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['permiso'] !='') {

	$P_Tabla 	=  	$tblDefinicion;

	$P_Valores 	= 	" nombre = '".$_GET['nombre']."', permiso = '".$_GET['permiso']."', permiso_padre = '".$_GET['permiso_padre']."',  activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( $_GET['delete'] == 1 ) {
	mysql_query("Delete from ".$tblDefinicion." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}


?>