<?php
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	$ObjMante   = new Mantenimientos();
	$ObjEjec    = new ejecutorSQL();

	$id_user 		=	$_SESSION['id_user'];
	$id_cia 		=	$_SESSION['id_cia'];
	$P_Tabla 		=	"users";

	$listaDeptos    = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','active = 1 and id_cia = '.$id_cia,'array');

// Add
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] != '') {

	$where 			= 	'usuario="'.$_GET['email'].'" and id_cia="'.$id_cia.'"';
	$busca 			=	$ObjMante->BuscarLoQueSea('*',PREFIX.'users',$where);

    //$PCLAVE			=	"AES_ENCRYPT('".htmlentities('123456')."','toga')";
	$P_Campos 		=	'usuario,contrasena, email, nombre, id_cia, id_depto,created_at,is_principal,activo,telephone,direcction,profile_photo';
	$P_Valores 		=	"'".$_GET['email']."', AES_ENCRYPT('".$_GET['contrasena']."','toga') , '".$_GET['email']."', '".$_GET['nombre']."', '".$_SESSION['id_cia']."', '".$_GET['depto']."', NOW() , '0' , '".$_GET['estado']."', '".$_GET['telefono']."', '".$_GET['direccion']."','-'";
	
	if ($busca['total'] > 0 ) {
		echo '<div class="alert alert-danger">Este usuario ya existe.</div>';
	} else {
		$mensaG			=	"<font face=verdana size=1.5 />Hola ".$_GET['nombre']."&nbsp;<br /><br />
					
		&nbsp;&nbsp;Sus datos de acceso para utilizar H&HSystem fueron creados.<br><br>
		&nbsp;&nbsp;Esto son tus datos de acceso:<br>
		&nbsp;&nbsp;Nombre de usuario: ".$_GET['email']."<br>			
		&nbsp;&nbsp;Contraseña: ".$_GET['contrasena']."<br><br />
		Bienvenido a H&HSystem<br />
		Derechos Reservados ".date('Y')."
		";
		$ObjEjec->insertarRegistro(PREFIX.'users', $P_Campos, $P_Valores);
		$mail_to_send_to = $_GET['email'];
		$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
		$subject		 = "Usuario Creado";
		$headers  = "From: " . strip_tags($from_email) . "\r\n";
		$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
		$headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
		echo '<div class="alert alert-success">Se ha creado el registro con éxito. <br />Se envó un email al usuario creado, con sus datos de acceso.</div>';
	}
}

// Show Edit info
if ( isset($_GET['showEdit']) && $_GET['id']) {
	//nombre,email,id_depto,telephone,direcction,activo
	$data       = $ObjMante->BuscarLoQueSea('id_usuario,nombre,email,id_depto,telephone,direcction,activo',PREFIX.'users','id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	$deptos     = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','active = 1 and id_cia = '.$id_cia,'array');
	echo json_encode($data);
}

// Edit / Update info
if ( isset($_GET['edit']) &&  $_GET['edit'] == 1 && $_GET['nombre'] != '' && $_GET['email'] !='') {

	$P_Valores 		= 	" nombre = '".$_GET['nombre']."', id_depto='".$_GET['depto']."', email = '".$_GET['email']."', updated_at = NOW(), telephone = '".$_GET['telefono']."', direcction = '".$_GET['direccion']."', activo = '".$_GET['activo']."'";
    if ($_GET['contrasena']!='') { $P_Valores 	.=	" , contrasena = AES_ENCRYPT(".$_GET['contrasena'].",'toga')"; }
	$P_condicion 	=	" id_usuario = '".$_GET['id']."'";
	$upd 			=	$ObjEjec->actualizarRegistro($P_Valores, PREFIX.'users', $P_condicion);
  	if ($upd) {
		echo 'ok';
	} else {
		echo 'error';
	}
}

// Delete 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) {
	mysql_query("Delete from zz_permisos Where id_usuario = '".$_GET['id']."'") or die(mysql_error());
	mysql_query("Delete from ".$P_Tabla." Where id_usuario = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}

?>