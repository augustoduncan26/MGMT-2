<?php
	$id_user    = $_GET['id_user'];
	$value 		= $_GET['value'];
//echo 'Hola'.$_SESSION['id_empresa'];exit;
	include_once ('../framework.php');

	if ($id_user == 1 || $id_user == 2) {
	  $sel        = mysql_query("Update usuarios set work_as = '".$value."' Where id_usuario = '".$id_user."'");
	  $sel        = mysql_query("Update ad_admin_empresas set work_as = '".$value."' Where id_usuario = '".$id_user."'");
		
	} else {
	  $sel        = mysql_query("Update usuarios set work_as = '".$value."' Where id_usuario = '".$id_user."'");
	  $sel        = mysql_query("Update ad_admin_empresas set work_as = '".$value."' Where id_usuario = '".$id_user."'");
		
	}
?>