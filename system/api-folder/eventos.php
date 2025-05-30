<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
/**
 * Get eventos
 */
    include_once ( dirname(dirname(__DIR__)) . '/system/framework.php');
	
	$ObjMant 	=	new Mantenimientos();
	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','date_start = "'.date('Y-m-d').'" and activo =1','array');
	$result 	=   array('total'=>$query['total']);
	echo json_encode($result);

?>