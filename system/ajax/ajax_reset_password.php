<?php
	
	$CARACTERES		=	RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE);
	$DESPISTAR		=	RandomString($length=20,$uc=TRUE,$n=TRUE,$sc=FALSE);
	$IDFALSE		=	rand(1970,1978);

		$SQ		=	mysql_query("Select AES_DECRYPT(contrasena,'toga') as decript,nombre,email,usuario,caracteres,id_usuario FROM usuarios WHERE usuario ='".$_POST['emailReset']."' AND activo = 1");

		if ( mysql_num_rows($SQ)==1 ) {

				$Data		=	mysql_fetch_array($SQ);
				//include("enviar_correo/enviar_correo.php");
				$Obj		=	new EnviarCorreo();
				$MenzG		=	'';
				$asunto		=	'Solicitud de Clave';
				// $mensaG		=	"<font face=verdana size=2 />Hola: ".$Data['nombre']."<br /><br />
						
				// 		&nbsp;&nbsp;Has solicitado recuperar tu clave de acceso<br>
				// 		&nbsp;&nbsp;Su clave de acceso es: ".$Data['decript']."<br><br>
				// 		&nbsp;&nbsp;<font color=red face=verdana size=2 >Si usted no ha solicitado esta informaci&oacute;n,<br>
				// 		&nbsp;&nbsp; porfavor notificarlo lo antes posible al Administrador del Sistema.</font>
				// 		";
				// 		
				$mensaG			=	"<font face=verdana size=2 />Hola ".$Data['nombre']."&nbsp;<br /><br />
						
						&nbsp;&nbsp;Para cambiar tu clave de acceso sigue el enlace de abajo.<br><br>		
						&nbsp;&nbsp;Siga este enlace: <a href='http://hhs.duncancomputer.com/system/login.php?pag=login&q=finReg&W=".$IDFALSE."&X=000".$IDFALSE."000000000".$DESPISTAR."&Y=".$IDFALSE."&ADZ=000-000-".$CARACTERES."-000-".$Data['usuario']."000000SI&kracts=".$Data['caracteres']."&rst=".$CARACTERES."&ad=1970'> Here </a><br /><br />
						&nbsp;&nbsp;Este enlace estar&aacute; activo por 24 horas<br />
						";

				mysql_query("Insert into usuarios_reset_passwd (id_usuario,caracters,date,active) values ('".$Data['id_usuario']."','".$CARACTERES."',NOW(),1)")or die('Error: '.mysql_error());

				$Obj->Enviar($Data['email'], $asunto , $mensaG , 'augustoduncan26@hotmail.com' ,false,false);
				$mensaje		=	'Te hemos enviado un correo a: '.$_POST['emailReset'].', solo sigue las instrucciones';
								//Hemos enviado tu clave de acceso a tu correo electronico.';
				$_POST		=	'';
		}else
		{
			$mensaje		=	'No hemos encontrado información con este correo';
			//No encontramos informaci&oacute;n a este correo.';
		}

