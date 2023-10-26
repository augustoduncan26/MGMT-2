<?php

	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	
	$P_Tabla 		=	"usuarios";

	$ObjMante   = new Mantenimientos();
	$ObjEjec    = new ejecutorSQL();
	$id_user    = $_SESSION["id_user"];
	$id_empresa = $_SESSION['id_empresa'];
	$email 		= $_SESSION['email'];
	$username 	= $_SESSION['username'];

	$ObjMante   = new Mantenimientos();
	$datos 		= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','id_cia = '.$_SESSION['id_empresa'].' and usuario="'.$email.'"','extract');


// Add
if ( $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$datosEmpresa 	=	mysql_fetch_array(mysql_query("Select * From usuarios Where id_usuario = '".$id_user."'"));
	//echo $datosEmpresa['name_cia'];

    $PCLAVE			=	"AES_ENCRYPT('".htmlentities('123456')."','toga')";
	$P_Campos 		=	'usuario,contrasena, email, nombre, apellido, id_empresa,name_cia,fecha_registro,fecha_ult_act,principal,idioma,activo,telephone,direcction,tipo_moneda';
	$P_Valores 		=	"'".$_GET['email']."', AES_ENCRYPT('123456','toga') , '".$_GET['email']."', '".$_GET['nombre']."', '---' ,'".$_SESSION['id_empresa']."', '".$datosEmpresa['name_cia']."' , '".date("Y-m-d H:i:s")."' , '".date("Y-m-d H:i:s")."' , 0 , '".$datosEmpresa['idioma']."' , '".$_GET['estado']."', '".$_GET['telefono']."', '".$_GET['direccion']."', '".$datosEmpresa['tipo_moneda']."'";
	
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


?>