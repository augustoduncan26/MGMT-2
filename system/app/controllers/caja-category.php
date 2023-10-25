<?php

include_once ('../../framework.php');

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];
$P_Tabla 		=	$caja_prefix."category";
// Names of tables
// if($_SESSION['id_user']==1 || $_SESSION['id_user'] == 2):
// 	$TblRooms		=	'ad_habitaciones';
// 	$TblBeds		=	'ad_beds';
// 	$TblBooking		=	'ad_reservas';
// ;else: 
// 	$TblRooms		=	'ad_'.$_SESSION['id_user'].'_habitaciones';
// 	$TblBeds		=	'ad_'.$_SESSION['id_user'].'_beds';
// 	$TblBooking		=	'ad_'.$_SESSION['id_user'].'_reservas';
// endif;

// Add
	if ( $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$P_Campos 		=	'name,id_empresa,activo,created_at';
	$P_Valores 		=	"'".$_GET['nombre']."','".$_SESSION['id_empresa']."','".$_GET['estado']."','".date('Y-m-d H:i:s')."'";
	
	$busca 			=	mysql_query("Select * From ".$P_Tabla." Where name = '".$_GET['nombre']."' and id_empresa = '".$_SESSION['id_empresa']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if (mysql_num_rows($busca) >0 ) {
			echo $mssg	=	'Ya existe esta categoria';
	} else {
		//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}

	}
}

// Edit
if ( $_GET['edit'] == 1 && $_GET['nombre'] != '') {

	$P_Valores 	= 	" name = '".$_GET['nombre']."', activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( $_GET['delete'] == 1 ) {
	mysql_query("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
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

// Listar
// if($_SESSION['id_user']==1 || $_SESSION['id_user']==2):
// 	$ObjMante		=	new Mantenimientos();
// 	$lista			=	$ObjMante->Listar($TblRooms, false ,$Orden, true, true,$GET_np,'array');
// 	$listaTipoHab	=	$ObjMante->Listar('ad_tipo_habitacion', 'activo=1' , $Orden,true, true,false,'array');
// ;else: 
// 	$ObjMante		=	new Mantenimientos();
// 	$lista			=	$ObjMante->Listar($TblRooms,false,$Orden, true, true,$GET_np,'array');
// 	$listaTipoHab	=	$ObjMante->Listar('ad_tipo_habitacion', '(id_empresa = "'.$id_empresa.'"  or id_empresa="0") and activo=1' , $Orden,true, true,false,'array');
// endif;

// //dump($lista);
// $total		 	= 	$lista['total'];
// $actual 		= 	$GET_np;

?>