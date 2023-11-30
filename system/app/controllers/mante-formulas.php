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
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas_detalle',$where,'array');

	if ($busca['total'] > 0 ) {
		echo $mssg	=	'EXISTE';
	} else {

		// Insertar en formulas_detalles
		$P_Data		=	false;
		$PCuantos	=	 count($_GET['areas']);
		for($i 	= 	0; $i < $PCuantos ; $i++) {	
			if($P_Data!='') {
				$P_Data .=  ',';
			}
			$P_Data		.=	 $_GET['areas'][$i];
		}
		$P_Tabla 	=	PREFIX.'mant_formulas_detalle';
		$P_Campos	=	'id_cia,descripcion,id_depto,id_area,created_at,active';
		$P_Valores	=	"'".$id_cia."','".$_GET['descripcion']."','0','".$P_Data."',NOW(),'".$_GET['estado']."'";
		$insert 	= 	mysqli_query($link, "INSERT INTO ".$P_Tabla." (".$P_Campos.") values (".$P_Valores.")");
		$lastId 	= 	mysqli_insert_id($link);

		$P_Valores2	=	false;
		$P_Val		=	false;
		$Total 		= 	(count($_GET['filas'])/$_GET['tot_filas']);
		$PCuantos2	=	 count($_GET['filas']);
		$P_Campos2	=   "id_detalle,id_cia,";
		$P_Campos2	.=	$ObjMante->ListadeCampos();
		$P_Campos2	.=   "created_at";
		
		for ($x = 0; $x < $_GET['tot_filas'] ; $x++) {
			$P_Valores2	 =	"'".$lastId."','".$id_cia."',";
			for($ix 	= 	0; $ix < $Total ; $ix++) {
				$P_Valores2	.=	"'".$_GET['filas'][$ix]."',";
			}
			$P_Valores2 .= "NOW()";
			// Aqui ingresar a la table
			$ObjEjec->insertarRegistro(PREFIX.'mant_formulas', $P_Campos2, $P_Valores2);
			$P_Valores2 = false;
		}

		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas_detalle','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	$data2      = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas','id_detalle="'.$_GET['id'].'" and id_cia = '.$id_cia,'array');
	$dataResp = ["data"=>$data,"data_formulas"=>$data2];
	echo json_encode($dataResp);
}

// Update 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['descripcion'] !='') {
	$P_Data		=	false;
	$PCuantos	=	 count($_GET['areas']);
	for($i 	= 	0; $i < $PCuantos ; $i++) {	
		if($P_Data!='') {
			$P_Data .=  ',';
		}
		$P_Data		.=	 $_GET['areas'][$i];
	}
	$P_Valores = "descripcion = '".$_GET['descripcion']."', id_depto = '0', id_area = '".$P_Data."', active = '".$_GET['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_formulas_detalle', 'id = "'.$_GET['id'].'"');
  	

	$Total 		= 	(count($_GET['filas'])/$_GET['tot_filas']);
	
	// for($ix	=	1	;	$ix	<	$Total+1	;	$ix++){	
	// 	$P_campos			=	'c'.$ix.' ="'.$_GET['filas'][$ix].'"';
	// 	$P_tabla			=	PREFIX.'mant_formulas';
	// 	$P_condicion		=	'id_detalle = "'.$_GET['id'].'"';
	// 	$P_respuesta		=	$ObjMante->FuncionesDML('editar', $P_campos , $P_tabla , $P_condicion);
	// 	//$msg2				=	strtoupper('<center><font size="2" color="red" face="Verdana">Se ha guardado toda la informacion.</font></center>');
	// }

	$P_Valores2	=	false;
	$P_Val		=	false;
	$Total 		= 	(count($_GET['filas'])/$_GET['tot_filas']);
	$PCuantos2	=	 count($_GET['filas']);
	$P_Campos2	=   "id_detalle,id_cia,";
	$P_Campos2	.=	$ObjMante->ListadeCampos();
	$P_Campos2	.=   "created_at";
	$r          = 0;

	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_formulas Where id_detalle = '".$_GET['id']."' and id_cia='".$id_cia."'");

	$P_Valores2	=	false;
	$P_Val		=	false;
	$Total 		= 	(count($_GET['filas'])/$_GET['tot_filas']);
	$PCuantos2	=	 count($_GET['filas']);
	$P_Campos2	=   "id_detalle,id_cia,";
	$P_Campos2	.=	$ObjMante->ListadeCampos();
	$P_Campos2	.=   "created_at";
	
	for ($x = 0; $x < $_GET['tot_filas'] ; $x++) {
		$P_Valores2	 =	"'".$_GET['id']."','".$id_cia."',";
		for($ix 	= 	0; $ix < $Total ; $ix++) {
			$P_Valores2	.=	"'".$_GET['filas'][$r]."',";
			$r++;
		}
		$P_Valores2 .= "NOW()";
		// Aqui ingresar a la table
		$ObjEjec->insertarRegistro(PREFIX.'mant_formulas', $P_Campos2, $P_Valores2);
		$P_Valores2 = false;
	}

	// for ($x = 0; $x < $_GET['tot_filas'] ; $x++) {
	// 	$P_Valores2	 =	" id_detalle = '".$_GET['id']."', id_cia='".$id_cia."', ";
	// 	for($ix 	= 	1; $ix < $Total+1 ; $ix++) {
	// 		$P_Valores2	.=	" c".$ix." ='".$_GET['filas'][$r]."',";
	// 		$r++;
	// 	}
	// 	$P_Valores2 .= " updated_at=NOW()";
	// 	// Aqui ingresar a la table
	// 	$ObjEjec->insertarRegistro(PREFIX.'mant_formulas', $P_Campos2, $P_Valores2);
	// 	$l = $ObjEjec->actualizarRegistro($P_Valores2, PREFIX.'mant_formulas', 'id_detalle = "'.$_GET['id'].'"');
	// 	//echo $P_Valores2;
	// 	//$P_Valores2 = false;
	// 	//$r          = 0;
	// }

	// $P_Valores2	=	false;
	// $P_Val		=	false;
	// echo $Total 		= 	(count($_GET['filas'])/$_GET['tot_filas']);
	// $PCuantos2	=	 count($_GET['filas']);
	// $P_Campos2	=   "id_detalle,id_cia,";
	// $P_Campos2	.=	$ObjMante->ListadeCampos();
	// $P_Campos2	.=   "created_at";
	// $r          = 0;
	// for ($x = 0; $x < $_GET['tot_filas'] ; $x++) {
	// 	$P_Valores2	 =	" id_cia = '".$id_cia."',";
	// 	for($ix 	= 	0; $ix < $Total ; $ix++) {
	// 		$r++;
	// 		$P_Valores2	.=	" c".$r." = '".$_GET['filas'][$ix]."',";
	// 	}
	// 	$P_Valores2 .= " updated_at=NOW()";
	// 	echo $P_Valores2;
	// 	mysqli_query($link,"UPDATE ".PREFIX."mant_formulas
	// 	SET ".$P_Valores2."
	// 	WHERE id_detalle = '".$_GET['id']."'") or die(mysqli_error($link));
	// 	$r          = 0;
	// }
	
	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
	  
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	//$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_formulas_detalle Where id = '".$_GET['id']."'");
	mysqli_query($link,"DELETE f, r
    FROM ".PREFIX."mant_formulas_detalle f LEFT JOIN
         ".PREFIX."mant_formulas r
         ON r.id_detalle = f.id 
    WHERE f.id = '".$_GET['id']."'") or die(mysqli_error($link));
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>