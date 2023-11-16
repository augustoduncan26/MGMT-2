<?php
	
	$CARACTERES		=	RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE);
	$DESPISTAR		=	RandomString($length=20,$uc=TRUE,$n=TRUE,$sc=FALSE);
	$IDFALSE		=	rand(1970,1978);
	include_once ('framework.php');
	$ObjMante   = new Mantenimientos();
	$ObjEjec    = new ejecutorSQL();

		$Data       	= $ObjMante->BuscarLoQueSea('AES_DECRYPT(contrasena,"toga") as decript,id_usuario,nombre,email,usuario,caracteres,id_usuario',PREFIX.'users','usuario = "'.$_POST['emailReset'].'" and activo=1');
		
		//var_dump($Data["resultado"][0]['nombre']);
		//echo $SQ['total'];
		//exit;
		//$SQ		=	mysql_query("Select AES_DECRYPT(contrasena,'toga') as decript,nombre,email,usuario,caracteres,id_usuario FROM usuarios WHERE usuario ='".$_POST['emailReset']."' AND activo = 1");

		if ( $Data['total']==1 ) {

			$P_Valores = "caracteres = '".$CARACTERES."', token='".$CARACTERES."', updated_at=NOW()";
			$l = $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'users', 'id_usuario = "'.$Data["resultado"][0]['id_usuario'].'"');

				$Obj		=	new EnviarCorreo();
				$MenzG		=	'';
				$asunto		=	'Solicitud de Clave';	
				$mensaG			=	"<font face=verdana size=2 />Hola ".$Data["resultado"][0]['nombre']."&nbsp;<br /><br />
						
						&nbsp;&nbsp;Para cambiar tu clave de acceso sigue el enlace de abajo.<br><br>		
						&nbsp;&nbsp;Siga este enlace: <a href='".ENV['URL_NAME']."/system/login.php?pag=login&q=finReg&W=".$IDFALSE."&X=000".$IDFALSE."000000000".$DESPISTAR."&Y=".$IDFALSE."&ADZ=000-000-".$CARACTERES."-000-".$Data["resultado"][0]['usuario']."000000SI&kracts=".$CARACTERES."&rst=".$CARACTERES."&sad=adg'> Here </a><br /><br />
						&nbsp;&nbsp;Este enlace estar&aacute; activo por 24 horas<br />
						";

				// $P_Tabla 	=	PREFIX.'users';
				// $P_Campos 	=	'usuario,contrasena,nombre,apellido,email,created_at,updated_at,fecha_ult_acceso,principal,caracteres,activo,telephone,direcction';
				// $P_Valores 	=	"'".$_POST['email']."', AES_ENCRYPT('".$_POST['password']."','toga'),'".$_POST['full_nombre']."','','".$_POST['email']."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."',1,'".$CARACTERES."','0','',''";
				// $ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);

				//mysql_query("Insert into usuarios_reset_passwd (id_usuario,caracters,date,active) values ('".$Data['id_usuario']."','".$CARACTERES."',NOW(),1)")or die('Error: '.mysql_error());


				$mail_to_send_to= $_POST['emailReset'];
				$from_email 	= $_ENV['MAIL_FROM_ADDRESS'];
				$subject		= "Restablecer Contraseña";
				$headers  		= "From: " . strip_tags($from_email) . "\r\n";
				$headers 		.= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
				$headers 		.= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
				$headers 		.= "MIME-Version: 1.0\r\n";
				$headers 		.= "Content-Type: text/html; charset=UTF-8\r\n";
				$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
				$mensaje		=	'Te hemos enviado un correo a: '.$_POST['emailReset'].', solo sigue las instrucciones';

				// $Obj->Enviar($Data['email'], $asunto , $mensaG , 'augustoduncan26@hotmail.com' ,false,false);
				// $mensaje		=	'Te hemos enviado un correo a: '.$_POST['emailReset'].', solo sigue las instrucciones';
								//Hemos enviado tu clave de acceso a tu correo electronico.';
				$_POST		=	'';
		}else
		{
			$mensaje		=	'No hemos encontrado información con este correo';
			//No encontramos informaci&oacute;n a este correo.';
		}

