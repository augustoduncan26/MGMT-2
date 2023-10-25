<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_empresa = $_SESSION['id_empresa'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

$ObjMante   = new Mantenimientos();
//$typeDirecciones  	= $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_direcciones','id_cia = '.$_SESSION['id_empresa'].' and active=1','array');
$typeDeptos  		= $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id_cia = '.$_SESSION['id_empresa'].' and active=1','array');


if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$where 			= 	'name="'.$_GET['nombre'].'" and id_cia="'.$id_empresa.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'mant_areas';
		$P_Campos 	=	'id_cia,name,id_depts,users,turn_a,turn_b,turn_c,turn_d,turn_e,active,created_at,updated_at';
		$P_Valores 	=	"'".$id_empresa."','".$_GET['nombre']."','".$_GET['departamento']."','".$_GET['total_usuarios']."','".$_GET['turno_a']."','".$_GET['turno_b']."','".$_GET['turno_c']."','".$_GET['turno_d']."','".$_GET['turno_e']."','".$_GET['estado']."',NOW(),NOW()";
		$result 	= $ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		if ($result == 1) {
			echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
		} else {
			echo $result;
		}
		
	}
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".$_GET['nombre']."', telephone = '".$_GET['telefono']."',active = '".$_GET['activo']."', updated_at=NOW()";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_areas', 'id = "'.$_GET['id'].'"');
  	echo 'Se ha actualizado el registro con éxito';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_areas Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>