<?php
	
// include_once ('../../framework.php');
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

	$id_user 		=	$_SESSION['id_user'];
	$id_cia 		=	$_SESSION['id_cia'];
	$P_Tabla 		=	"usuarios";

if ($_SESSION['id_user']) {

	// Add
	if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] != '') {

		$datosEmpresa 	=	mysql_fetch_array(mysql_query("Select * From usuarios Where id_usuario = '".$id_user."'"));

		$PCLAVE			=	"AES_ENCRYPT('".htmlentities('123456')."','toga')";
		$P_Campos 		=	'usuario,contrasena, email, nombre, apellido, id_cia,name_cia,fecha_registro,fecha_ult_act,principal,idioma,activo,telephone,direcction,tipo_moneda';
		$P_Valores 		=	"'".$_GET['email']."', AES_ENCRYPT('123456','toga') , '".$_GET['email']."', '".$_GET['nombre']."', '---' ,'".$_SESSION['id_cia']."', '".$datosEmpresa['name_cia']."' , '".date("Y-m-d H:i:s")."' , '".date("Y-m-d H:i:s")."' , 0 , '".$datosEmpresa['idioma']."' , '".$_GET['estado']."', '".$_GET['telefono']."', '".$_GET['direccion']."', '".$datosEmpresa['tipo_moneda']."'";
		
		$busca 			=	mysql_query("Select * From ".$P_Tabla." Where email = '".$_GET['email']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

		if (mysql_num_rows($busca) >0 ) {
				echo $mssg	=	'Ya existe este email.';
		} else {
			//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
			$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
			if ($sql) {
				echo $mssg 	=	'Se ingreso el registro con éxito';
			}

		}
	}
		
	// Permisos
	//if ($_POST['btn_edit_room']) {
	if ( isset($_POST['editperm']) && $_POST['editperm'] == 1 ) {
		$val 	=	explode(',',$_POST['valores']);

		mysql_query("Delete from zz_permisos Where id_usuario = '".$_POST['id_']."'");
		
		foreach ($val as $key) {

			$sql_in 	=	mysql_query("Insert into zz_permisos (id_usuario,id_definicion_permiso) values('".$_POST['id_']."' , '".$key."')")or die(mysql_error());
		}

		echo 'Se ha actualizado los permisos. Debe refrescar la página.';
	}

	// Edit
	//if ($_POST['btn_edit_room']) {
	if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['email'] !='') {

		

		$P_Valores 	= 	" nombre = '".$_GET['nombre']."', email = '".$_GET['email']."', fecha_ult_act = '".date("Y-m-d H:i:s")."', telephone = '".$_GET['telefono']."', direcction = '".$_GET['direccion']."', activo = '".$_GET['activo']."'";
		if ($_GET['contrasena']!='') { $P_Valores 	.=	" , contrasena = AES_ENCRYPT(".$_GET['contrasena'].",'toga')"; }


		$P_condicion=	" id_usuario = '".$_GET['id']."'";
		//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
		mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
		echo $mssg 		=	'Se actualizo el registro con éxito';
	}

	// Delete 
	if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
		mysql_query("Delete from zz_permisos Where id_usuario = '".$_GET['id']."'") or die(mysql_error());
		mysql_query("Delete from ".$P_Tabla." Where id_usuario = '".$_GET['id']."'") or die(mysql_error());
		echo $mssg 		=	'Se elimino el registro con éxito';
	}

}

?>