<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
/**
 * Get list de eventos
 */
    include_once ( dirname(dirname(__DIR__)) . '/system/framework.php');
	//include_once ( dirname(dirname(__DIR__)) . '/system/functions.php');

	$ObjMant 	=	new Mantenimientos();
	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','date_start = "'.date('Y-m-d').'" and activo =1','array');
	$result 	=   array('result'=>$query['resultado']);
	echo json_encode($result);

?>