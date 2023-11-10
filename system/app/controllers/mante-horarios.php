<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

$typeDeptos = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id_cia = '.$_SESSION['id_cia'].' and active=1','array');
$typeArea   = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id_cia = '.$_SESSION['id_cia'].' and active=1','array');


if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['grupo'] !='') {

	$am 			= 	false;
	$pm 			= 	false;

	if ($_GET['hora_desde'] < "12") {
		$am = "am";
	} else { $pm = "pm";}
	$horacorta 		= 	$_GET['hora_desde']."".$_GET['hora_hasta'];
	$where 			= 	'grupo="'.$_GET['grupo'].'" and hora_desde="'.$_GET['hora_desde'].'" and hora_hasta="'.$_GET['hora_hasta'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_horarios',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'mant_horarios';
		$P_Campos 	=	'id_cia,grupo,hora_corta,hora_desde,hora_hasta,id_depto,id_area,active,created_at';
		$P_Valores 	=	"'".$id_cia."','".$_GET['grupo']."','".$horacorta."','".$_GET['hora_desde']."','".$_GET['hora_hasta']."','".$_GET['depto']."','".$_GET['area']."','".$_GET['estado']."',NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".$_GET['nombre']."', telephone = '".$_GET['telefono']."',active = '".$_GET['activo']."', updated_at=NOW()";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_departamentos', 'id = "'.$_GET['id'].'"');
  	echo 'Se ha actualizado el registro con éxito';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_departamentos Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>