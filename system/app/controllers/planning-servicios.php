<?php

include_once ('../../framework.php');
//var_dump(GET());

//
// $ObjMante		=	new Mantenimientos();
// $Objsql 		=	new ejecutorSQL();
// $Objconsultor	=	new consultor();
// $POST			=	$ObjMante->ValuePOST('post');

// $objUser		=	new Users();
// $DataUserCia	=	$objUser->consultarUsuario($_SESSION['id_user']);


$Dta_idEmpr 	=	$_SESSION['id_user'];

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

if ($_GET['add']) {

	$P_Tabla 		=	'ad_tipo_servicio';

	$P_Campos 		=	'name,descripcion,precio,id_empresa,activo';
	$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['detalle']."','".$_GET['precio']."','".$_SESSION['id_empresa']."','".$_GET['estado']."'";
	
	$busca 			=	mysql_query("Select * From ".$P_Tabla." Where name = '".$_POST['nombre']."'") or die(mysql_error()); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if (mysql_num_rows($busca) > 0 ) {
		echo $mssg	=	'Ya existe este registro';
	} else {
		//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		$sql 	=	mysql_query("Insert into ".$P_Tabla."(name,descripcion,precio,id_empresa,activo) 
				values('".$_GET['nombre']."','".$_GET['detalle']."','".$_GET['precio']."','".$_SESSION['id_empresa']."','".$_GET['estado']."')")or die(mysql_error());
		if ($sql) {
			echo $mssg 	=	'Se ingreso el registro con éxito';
		}
	}
}

// Edit
if ( $_GET['edit'] == 1 && $_GET['nombre'] != '') {

	$P_Tabla 		=	'ad_tipo_servicio';
	$P_Valores 		= 	" name = '".$_GET['nombre']."', descripcion = '".$_GET['detalle']."', precio = '".$_GET['precio']."', activo = '".$_GET['estado']."'";
	$P_condicion	=	" idTS = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}


// Delete 
if ( $_GET['delete'] == 1 ) {
	$P_Tabla 		=	'ad_tipo_servicio';
	mysql_query("Delete from ".$P_Tabla." Where idTS = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}
// if ($_POST['btn_edit_room']) {

// 	$P_Tabla 	=  	$TblRooms;
// 	$P_Valores 	= 	" codigo = '".$_POST['nombre']."', tipo_habita = '".$_POST['tipo']."', price = '".$_POST['precio']."', total_beds = '".$_POST['total_beds']."', limpieza = '".$_POST['limpieza']."', activo = '".$_POST['activo']."'";
// 	$P_condicion=	" id = '".$_POST['id']."'";
// 	$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
// 	$mssg 		=	'Se actualizo el registro con éxito';
// }


// Listar
// if($_SESSION['id_user']==1 || $_SESSION['id_user']==2):
// 	$lista			=	$ObjMante->Listar($TblRooms, false ,$Orden, true, true,$GET_np,'array');
// 	$listaTipoHab	=	$ObjMante->Listar('ad_tipo_habitacion', 'activo=1' , $Orden,true, true,false,'array');
// ;else: 
// 	$lista			=	$ObjMante->Listar($TblRooms,false,$Orden, true, true,$GET_np,'array');
// 	$listaTipoHab	=	$ObjMante->Listar('ad_tipo_habitacion', '(id_empresa = "'.$DataUserCia['id_empresa'].'"  or id_empresa="0") and activo=1' , $Orden,true, true,false,'array');
// endif;

//dump($lista);
//$total		 	= 	$lista['total'];
//$actual 		= 	$GET_np;

?>