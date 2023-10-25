<?php
	include_once ('../framework.php');
	$ObjMante = new Mantenimientos();
	if ( $_SESSION['id_session'] ) {
		$sel 	= $ObjMante->BuscarLoQueSea('price', PREFIX.$_GET['tbl'] , 'id_empresa = '.$_SESSION['id_empresa'].' and id = '.$_GET['hab'], 'extract');
		$data 	=	$sel;
		echo $data['price'];
	} else {
		echo '0';
	}

?>