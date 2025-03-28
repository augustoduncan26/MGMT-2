<?php

$id_user    = isset($_GET['id_user'])?$_GET['id_user']:"";
$id_empresa = isset($_GET['id_empresa'])?$_GET['id_empresa']:"";

include_once ('framework.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$CARACTERES		=	RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE);
$DESPISTAR		=	RandomString($length=20,$uc=TRUE,$n=TRUE,$sc=FALSE);
$IDFALSE		=	rand(1970,1968);

$where 		= 'usuario = "'.$_POST['email'].'"';
$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'users',$where);

	if ($sel1['total'] > 0){
		
	$mensaje	=	'Ya existe un usuario con este email';
	$display	=	'block';
	return false;

	} else {
		
	$RUTA	=	'companies/';
	
	// REGISTER BLOCK USER
	$PCLAVE		=	"AES_ENCRYPT('".htmlentities($_POST['password'])."','toga')";//CryptPass( $POST_clave );
	$REALNAME	=	'Usuario_'.$CARACTERES;

	$P_Tabla 	=	PREFIX.'users';
	$P_Campos 	=	'usuario,contrasena,nombre,apellido,email,created_at,updated_at,fecha_ult_acceso,principal,caracteres,activo,telephone,direcction';
	$P_Valores 	=	"'".$_POST['email']."', AES_ENCRYPT('".$_POST['password']."','toga'),'".$_POST['full_nombre']."','','".$_POST['email']."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."',1,'".$CARACTERES."','0','',''";
	$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
	
	$Obj		=	new EnviarCorreo();

	$mensaG			=	"<font face=verdana size=1.5 />Hola ".$_POST['full_nombre']."&nbsp;<br /><br />
					
					&nbsp;&nbsp;Gracias por su registro.<br><br>
					&nbsp;&nbsp;Recuerda sus datos de acceso:<br>
					&nbsp;&nbsp;Nombre de usuario: ".$_POST['email']."<br>			
					&nbsp;&nbsp;Para confirmar su registro, siga este enlace: <a h	ref='".ENV['URL_NAME']."/system/login.php?pag=login&q=finReg&W=".$IDFALSE."&X=000".$IDFALSE."000000000".$DESPISTAR."&Y=".$IDFALSE."&Z=000-000-".$CARACTERES."-000-".$_POST['email']."000000SI'> Aqui </a><br /><br />
					&nbsp;&nbsp;Esta confirmación estará activa durante 7 días.<br />
					";
	
	//$Obj->Enviar($_POST['email'] ,"Confirmar Registro" , $mensaG ,'augustoduncan26@hotmail.com' , false, false ,false,false);
	
	$mail_to_send_to = $_POST['email'];
	$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
	$subject		 = "Confirmar Registro";
	//$message		= "\r\n" . "Name: TEST" . "\r\n";
	$headers  = "From: " . strip_tags($from_email) . "\r\n";
	$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
	$headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
	$mensaje	=	'Debe confirmar su cuenta. <br />Revise su buzón de (entrada / no deseados) para confirmar.';
	//$OCULTAR	=	TRUE;
	}

?>