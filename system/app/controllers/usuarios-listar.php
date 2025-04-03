<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = 	new Mantenimientos();
$ObjEjec    = 	new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'usuarios';

$where 			= 	'id_cia="'.$id_cia.'" and id_usuario <> 1';
$listUsers 		=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','id_usuario');
$listEmpleados 	=	$ObjMante->BuscarLoQueSea('email',PREFIX.'empleados',false,'array','id,nempleado');
$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','active=1','array');

// Select al Perfiles
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
	$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_perfiles',$where,'array','id,name');
	echo json_encode($listPerfiles['resultado']);
}

// Add
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['user_acceso'] != '') {
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'email="'.$_GET['user_acceso'].'"','array');

	if ($sql['total'] > 0 ) {
		echo $mssg	=	'Ya existe este registro.';
	} else {
		$clave 		=	encrypt_decrypt('encrypt', $_GET['clave']);
		//echo $_GET['perfil'];
		$P_Valores 	= 	"'".$_GET['user_acceso']."','".$_GET['user_acceso']."','".$_GET['nombre']."','".$_GET['apellido']."','".$id_cia."','".$_GET['director']."','".$_GET['principal']."','".$_GET['perfil']."','".$clave."',NOW(),NOW(),'0','".$_GET['estado']."'";
		$sql 		=	$ObjEjec->insertarRegistro($P_Tabla, 'usuario,email,nombre,apellido,id_cia,es_director,principal,id_perfil,contrasena,created_at,updated_at,superadmin,activo', $P_Valores);
		//echo $mssg 	=	'<div class="alert alert-success alert-exito">Se ingreso el registro con éxito</div>';
		echo $mssg 	=	'Se ingreso el registro con éxito';

		if ($_GET['enviar_email']) {
			$Obj		=	new EnviarCorreo();
			$mensaG		=	"<font face=verdana size=1.5 />Hola ".$_POST['nombre']."&nbsp;<br /><br />
							&nbsp;&nbsp;Se ha creado su usuario con éxito.<br><br>
							&nbsp;&nbsp;Sus datos de acceso son:<br>
							&nbsp;&nbsp;Nombre de usuario: ".$_POST['email']."<br>			
							&nbsp;&nbsp;Clave de acceso: ".$clave."<br>
							";
			
			//$Obj->Enviar($_POST['email'] ,"Confirmar Registro" , $mensaG ,'augustoduncan26@hotmail.com' , false, false ,false,false);
			
			$mail_to_send_to = $_POST['email'];
			$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
			$subject		 = "Usuario creado";
			//$message		= "\r\n" . "Name: TEST" . "\r\n";
			$headers  = "From: " . strip_tags($from_email) . "\r\n";
			$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
			$headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
			$mensaje	=	'Usuario creado con éxito. <br />';
		}
	}
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {

	$P_Valores 	= "nombre='".$_GET['nombre']."', apellido = '".$_GET['apellido']."', id_perfil='".$_GET['perfil']."',  activo = '".$_GET['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id_usuario = "'.$_GET['id'].'"');
  	
	$clave = "";
	if (isset($_GET['clave']) && $_GET['clave']!="") {
		$clave 		=	encrypt_decrypt('encrypt', $_GET['clave']);
		$clave 		= 	"contrasena='".$clave."'";
		$l = $ObjEjec->actualizarRegistro($clave, $P_Tabla, 'id_usuario = "'.$_GET['id'].'"');
	}
	
	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

// Permisos
if (isset($_POST['editperm']) && $_POST['editperm']==1) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permisos Where id_usuario = '".$_POST['id_']."'");
	$exp 		=	explode(",",$_POST['valores']);
	$cuantos 	= 	count($exp);
	for ($i = 0 ; $i < $cuantos; $i++) {
		if (is_numeric($exp[$i])) {
			$P_Campos 		=	'id_usuario,id_definicion_permiso';
			$P_Valores 		=	"'".$_POST['id_']."','".$exp[$i]."'";
			$ObjEjec->insertarRegistro(PREFIX.'permisos', $P_Campos, $P_Valores);
		}
	}
	echo $mssg 		=	1;
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}


?>