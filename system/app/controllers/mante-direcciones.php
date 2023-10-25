<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_empresa = $_SESSION['id_empresa'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
//$lastname 	= $_SESSION['apellido'];

if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$where 			= 	'name="'.$_GET['nombre'].'" and id_cia="'.$id_empresa.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_direcciones',$where, 'array');
	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'mant_direcciones';
		$P_Campos 	=	'id_cia,name,active,created_at,updated_at';
		$P_Valores 	=	"'".$id_empresa."','".$_GET['nombre']."','".$_GET['estado']."',NOW(),NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".$_GET['nombre']."', active = '".$_GET['activo']."', updated_at=NOW()";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_direcciones', 'id = "'.$_GET['id'].'"');
  	echo 'Se ha actualizado el registro con éxito';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_direcciones Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>