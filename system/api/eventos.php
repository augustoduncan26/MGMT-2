<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
/**
 * Get total eventos
 */
    include_once ( dirname(dirname(__DIR__)) . '/system/framework.php');
	//include_once ( dirname(dirname(__DIR__)) . '/system/functions.php');

	$ObjMant 	=	new Mantenimientos();
	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','activo =1','array');
	$result 	=   array('total'=>$query['total']);
	echo json_encode($result);

?>