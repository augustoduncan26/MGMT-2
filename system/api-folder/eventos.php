<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
/**
 * Get eventos
 */
    include_once ( dirname(dirname(__DIR__)) . '/system/framework.php');
	
	$ObjMant 	=	new Mantenimientos();
	$ObjEjec    = 	new ejecutorSQL();
	/**
	 * Check for events beyond the date range
	 */
	$notInRange = 	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','date_start < "'.date('Y-m-d').'" and date_end < "'.date('Y-m-d').'" and id_cia="'.$_SESSION['id_cia'].'" and  activo =1','array');
	if ($notInRange['total']>0) {
		foreach ($notInRange['resultado'] as $key => $value) {
			$ObjEjec->actualizarRegistro('activo=0', PREFIX.'events', 'id = "'.$value['id'].'"');
		}
	}

	$dates  	= $ObjMant->BuscarLoQueSea('MAX(date_end) as date_end, MIN(date_start) as date_start',PREFIX.'events','activo =1','extract');
	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','date_start between "'.$dates['date_start'].'" and "'.$dates['date_end'].'" and id_cia = "'.$_SESSION['id_cia'].'" and activo =1','array');
	if ($query['total']>0) {
		$result 	=   array('total'=>$query['total']);
	} else {
		$result 	=   array('total'=>0);
	}
	
	echo json_encode($result);

?>