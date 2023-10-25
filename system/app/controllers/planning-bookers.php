<?php

include_once (dirname(dirname(__DIR__)).'/framework.php');

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];

$ObjMante		=	new Mantenimientos();
$Objsql    		= 	new ejecutorSQL();
$P_TBOOKERS 	= 	PREFIX.'bookers';

// Add
if ( $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$P_Tabla 		=	'ad_bookers';

	if ($_GET['porc'] == '') { $_GET['porc'] = 0; }

	$P_Campos 		=	'name,id_empresa,porcentaje,active';
	$P_Valores 		=	"'".$_GET['nombre']."','".$id_empresa."','".$_GET['porc']."','".$_GET['estado']."'";
	
	$buscar 		=	$ObjMante->BuscarLoQueSea('*',$P_TBOOKERS,'name='.$_GET['nombre'],'array');
	//$busca 			=	mysql_query("Select * From ".$P_Tabla." Where name = '".$_GET['nombre']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if ($buscar['total'] > 0){	
	//if (mysql_num_rows($busca) >0 ) {
		echo $mssg	=	'Ya existe esta registro';
	} else {
		$sql 	=	$Objsql->insertarRegistro($P_TBOOKERS, $P_Campos, $P_Valores);
		//$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}

	}
}

// Edit
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] != '') {

	$P_Tabla 	=  	'ad_bookers';
	$P_Valores 	= 	" name = '".$_GET['nombre']."', porcentaje = '".number_format($_GET['porcentaje'],2)."', activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito.';
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
	$P_Tabla 	=  	'ad_bookers';
	mysql_query("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito.';
}

if ($_SESSION['id_user'] || $_SESSION['id_user']) {
	//$ObjMante		=	new Mantenimientos();
	//$Objsql 		=	new ejecutorSQL();
	//$Objconsultor	=	new consultor();
	//$POST			=	$ObjMante->ValuePOST('post');

	//$objUser		=	new Users();
	//$DataUserCia	=	$objUser->consultarUsuario($_SESSION['id_user']);

	//$Dta_idEmpr 	=	$_SESSION['id_user'];
}

?>