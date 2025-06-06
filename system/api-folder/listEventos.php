<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
/**
 * Get list de eventos
 */
    include_once ( dirname(dirname(__DIR__)) . '/system/framework.php');
	//include_once ( dirname(dirname(__DIR__)) . '/system/functions.php');

	$id_cia 	= 	$_SESSION['id_cia'];
	$ObjMant 	=	new Mantenimientos();
	$dates  	= 	$ObjMant->BuscarLoQueSea('MAX(date_end) as date_end, MIN(date_start) as date_start',PREFIX.'events','id_cia="'.$id_cia.'" and activo =1','extract');
	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','date_start between "'.$dates['date_start'].'" and "'.$dates['date_end'].'" and id_cia="'.$id_cia.'" and activo =1','array');
	$result 	=   array('result'=>$query['resultado']);
	echo json_encode($result);

?>