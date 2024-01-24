<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
// include_once ( dirname(dirname(__DIR__)) . '/functions.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia  	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

$listaDeptos    = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','active = 1 and id_cia = '.$id_cia,'array');
$listaAreas     = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','active = 1 and id_cia = '.$id_cia,'array');

// Add rows
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] !='') {

	$where 			= 	'name="'.$_GET['nombre'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_zonas',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'<div class="alert alert-danger">Ya existe este registro.</div>';
	} else {

		$P_Data		=	false;
		$PCuantos	=	 count($_GET['areas']);
		for($i 	= 	0; $i < $PCuantos ; $i++) {	
			if($P_Data!='') {
				$P_Data .=  ',';
			}
			$P_Data		.=	 $_GET['areas'][$i];
		}

		$P_Tabla 	=	PREFIX.'mant_zonas';
		$P_Campos 	=	'id_cia,name,id_depto,id_area,active,created_at';
		$P_Valores 	=	"'".$id_cia."','".$_GET['nombre']."','".$_GET['depto']."','".$P_Data."','".$_GET['estado']."',NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_zonas','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {
	$P_Data		=	false;
	$PCuantos	=	 count($_GET['areas']);
	for($i 	= 	0; $i < $PCuantos ; $i++) {	
		if($P_Data!='') {
			$P_Data .=  ',';
		}
		$P_Data		.=	 $_GET['areas'][$i];
	}
	$P_Valores = "name = '".$_GET['nombre']."', id_depto = '".$_GET['depto']."', id_area = '".$P_Data."', active = '".$_GET['activo']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_zonas', 'id = "'.$_GET['id'].'"');
  	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
	  
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_zonas Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>