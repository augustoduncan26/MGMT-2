<?php

 include_once ('../../framework.php');

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];

// Names of tables
if($_SESSION['id_user']==1 || $_SESSION['id_user'] == 2):
	$TblRooms		=	'ad_habitaciones';
	$TblBeds		=	'ad_beds';
	$TblBooking		=	'ad_reservas';
;else: 
	$TblRooms		=	'ad_'.$_SESSION['id_user'].'_habitaciones';
	$TblBeds		=	'ad_'.$_SESSION['id_user'].'_beds';
	$TblBooking		=	'ad_'.$_SESSION['id_user'].'_reservas';
endif;

// Add
	if ( $_GET['add'] == 1 && $_GET['nombre'] != '' && $_GET['idperfil']) {

	$P_Tabla 		=	'ad_perfil';

	$P_Campos 		=	'id_perfil,perfil,id_empresa,activo';
	$P_Valores 		=	"'".$_GET['idperfil']."','".$_GET['nombre']."','".$_SESSION['id_empresa']."','".$_GET['estado']."'";
	
	$busca 			=	mysql_query("Select * From ".$P_Tabla." Where id_perfil = '".$_GET['idperfil']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if (mysql_num_rows($busca) >0 ) {
		echo $mssg	=	'Ya existe este registro';
	} else {
		//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}

	}
}

// Edit
//if ($_POST['btn_edit_room']) {
if ( $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['tipo'] !='') {

	$P_Tabla 	=  	$TblRooms;
	$P_Valores 	= 	" codigo = '".$_GET['nombre']."', tipo_habita = '".$_GET['tipo']."', price = '".$_GET['precio']."', total_beds = '".$_GET['total_beds']."', cleaning = '".$_GET['cleaning']."', activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( $_GET['delete'] == 1 ) {
	mysql_query("Delete from ".$TblRooms." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}
?>