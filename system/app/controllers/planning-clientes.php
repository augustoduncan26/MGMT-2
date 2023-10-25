<?php

//var_dump(GET());

//
// $ObjMante		=	new Mantenimientos();
// $Objsql 		=	new ejecutorSQL();
// $Objconsultor	=	new consultor();
// $POST			=	$ObjMante->ValuePOST('post');

// $objUser		=	new Users();
// $DataUserCia	=	$objUser->consultarUsuario($_SESSION['id_user']);


include_once ('../../framework.php');


if ( $_SESSION['id_user'] ) {

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];


// Add
if ( $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$P_Tabla 		=	'fact_clientes';

	$_GET['telefono'] 	=	isset($_GET['telefono'])?$_GET['telefono']:'---';
	$_GET['email'] 		=	isset($_GET['email'])?$_GET['email']:'---';
	$_GET['direccion'] 	=	isset($_GET['direccion'])?$_GET['direccion']:'---';


	$P_Campos 		=	'nombre_cliente,telefono_cliente,email_cliente,direccion_cliente,latitude,longitude,activo,date_added,id_empresa';
	$P_Valores 		=	"'".$_GET['nombre']."','".$_GET['telefono']."','".$_GET['email']."','".$_GET['direccion']."','".$_GET['latitude']."','".$_GET['longitude']."',1,NOW(),'".$id_empresa."'";
	
	$busca 			=	mysql_query("SELECT * FROM ".$P_Tabla." WHERE nombre_cliente = '".$_GET['nombre']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);
	//$row 			=	mysql_fetch_array($busca);

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
if ( $_GET['edit'] == 1 && $_GET['nombre'] != '') {

	$P_Tabla 	=  	'fact_clientes';

	$P_Valores 	= 	" nombre_cliente = '".$_GET['nombre']."', telefono_cliente = '".$_GET['telefono']."', email_cliente = '".$_GET['email']."', direccion_cliente = '".htmlentities($_GET['direccion'])."', latitude = '".$_GET['latitude']."', longitude = '".$_GET['longitude']."', activo = '".$_GET['activo']."'";
	$P_condicion=	" id_cliente = '".$_GET['id']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( $_GET['delete'] == 1 ) {
	mysql_query("Delete from ".$TblRooms." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}


}

?>