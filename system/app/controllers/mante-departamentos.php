<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia  	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

//$listaDeptos    = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','active = 1 and id_cia = '.$id_cia,'array');


if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$where 			= 	'name="'.$_GET['nombre'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Tabla 	=	PREFIX.'mant_departamentos';
		$P_Campos 	=	'id_cia,name,telephone,active,created_at';
		$P_Valores 	=	"'".$id_cia."','".$_GET['nombre']."','".$_GET['telefono']."','".$_GET['estado']."',NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('id,id_cia,name,telephone,active,created_at',PREFIX.'mant_departamentos','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Valores = "name = '".$_GET['nombre']."', telephone = '".$_GET['telefono']."',active = '".$_GET['activo']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_departamentos', 'id = "'.$_GET['id'].'"');
  	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
	  
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_departamentos Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>