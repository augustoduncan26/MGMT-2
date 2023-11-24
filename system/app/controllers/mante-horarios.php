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

		$P_Data		=	false;
		$PCuantos	=	 count($_GET['area']);
		for($i 	= 	0; $i < $PCuantos ; $i++) {	
			if($P_Data!='') {
				$P_Data .=  ',';
			}
			$P_Data		.=	 $_GET['areas'][$i];
		}

		$P_Tabla 	=	PREFIX.'mant_horarios';
		$P_Campos 	=	'id_cia,grupo,hora_corta,hora_desde,hora_hasta,id_depto,id_area,active,created_at';
		$P_Valores 	=	"'".$id_cia."','".$_GET['grupo']."','".$horacorta."','".$_GET['hora_desde']."','".$_GET['hora_hasta']."','".$_GET['depto']."','".$P_Data."','".$_GET['estado']."',NOW()";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		
		echo $mssg 		=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('id,grupo,hora_corta,hora_desde,hora_hasta,id_cia,id_depto,id_area,active,created_at',PREFIX.'mant_horarios','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Update row 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['grupo'] !='') {
	$P_Valores = "grupo = '".$_GET['grupo']."', hora_desde = '".$_GET['hora_desde']."', hora_hasta = '".$_GET['hora_hasta']."', id_depto = '".$_GET['id_depto']."', id_area = '".$_GET['id_area']."', active = '".$_GET['activo']."', updated_at=NOW()";
	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'mant_horarios', 'id = "'.$_GET['id'].'"');
  	echo 'OK';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."mant_horarios Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-success">Se elimino el registro con éxito.</div>';
}

/*
// Definir los horarios de los turnos
$turnos = ['06:00 - 2:00', '14:00 - 22:00', '22:00 - 06:00'];

// Inicializar el calendario para 30 días
$calendario = [];

// Rellenar el calendario con días de trabajo y días libres intercalados
$trabajo = 0;
$dia_libre = false;
for ($dia = 1; $dia <= 30; $dia++) {
    if (!$dia_libre && ($dia % 4 == 0 || $dia % 4 == 1 || $dia % 4 == 2)) {
        // Días de trabajo (M, T, N)
        $turno = $turnos[$dia % count($turnos)];
        $calendario[$dia] = $turno;
    } else {
        // Días libres
        $calendario[$dia] = 'Libre';
        $dia_libre = true;
    }
    if ($dia % 4 == 3) {
        $dia_libre = false;
    }
}

// Mostrar el calendario
foreach ($calendario as $dia => $turno) {
    echo "Día $dia: Turno $turno <br>";
}
*/
?>