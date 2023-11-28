<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia  	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];

$daysInMonth = date('t'); // Total de dias del mes
$dayOfMonth	= date("n");
$actualYear = date("Y");
// $mesActual 	= date("n");

$monthNameSpanish 	= array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

$listaDeptos    = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','active = 1 and id_cia = '.$id_cia,'array');
$listaAreas     = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','active = 1 and id_cia = '.$id_cia,'array');
$listaHorarios  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_horarios','active = 1 and id_cia = '.$id_cia,'array');

// Add rows
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['descripcion'] !='') {

	$where 			= 	'descripcion="'.$_GET['descripcion'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'EXISTE';
	} else {

		$P_Data		=	false;
		$PCuantos	=	 count($_GET['areas']);
		for($i 	= 	0; $i < $PCuantos ; $i++) {	
			if($P_Data!='') {
				$P_Data .=  ',';
			}
			$P_Data		.=	 $_GET['areas'][$i];
		}

		$P_Campos	=	'ncorto,';
		$P_Campos	.=	$ObjMante->ListadeCampos();
		$P_Campos	.=	'id_cia,descripcion,id_depto,id_area,created_at,active';
		$P_Valores	=	'';
		$P_Valores	=	"'-',";
		$PCuantos2	=	 count($_GET['filas']);
		$P_Data2	=	false;
		for($ix	=	0	;	$ix	<	$PCuantos2	;	$ix++)
		{	
			if($_GET['filas'][$ix] == '31' && $_GET['filas'][$ix] == '')
			{
				$_GET['filas'][$ix]	=	'x';
			}
			// if($P_Data2!='') {
			// 	$P_Data2 .=  ',';
			// }
			$P_Valores			.=	"'".$_GET['filas'][$ix]."',";
		}

		$P_Valores	.=	"'".$id_cia."','".$_GET['descripcion']."','0','".$P_Data."',NOW(),'".$_GET['estado']."'";
		$P_Tabla 	=	PREFIX.'mant_formulas';
		//$P_Campos 	=	'id_cia,descripcion,id_area,active,created_at';
		//$P_Valores 	=	"'".$id_cia."','".$_GET['descripcion']."','".$P_Data."','".$_GET['estado']."',NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		//$last_id = mysqli_insert_id($conn);
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