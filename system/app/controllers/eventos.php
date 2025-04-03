<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
//$lastname 	= $_SESSION['apellido'];

// All
$selectAll  = $ObjMante->BuscarLoQueSea('*',PREFIX.'events','id_cia = '.$id_cia,'array');

/**
 * Add
 */
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'events','nombre = '.$_GET['nombre']);

	if ($busca['total'] >0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'events';
		$P_Campos 	=	'id_cia,name,class,date_start,time_start,date_end,time_end,activo';
		$P_Valores 	=	"'".$id_cia."','".$_GET['nombre']."','".$_GET['clase']."','".$_GET['dateI']."','".$_GET['horaI']."','".$_GET['dateF']."','".$_GET['horaF']."','".$_GET['estado']."'";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

/**
 * Edit
 */
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "nombre = '".$_GET['nombre']."', activo = '".$_GET['activo']."', precio = '".$_GET['precio']."'";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'events', 'id = "'.$_GET['id'].'"');
  	echo 'Se ha actualizado el registro con éxito';
}

/**
 * Delete
 */
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."events Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>