<?php 

	require_once( dirname(__FILE__) . '/functions.php' ); 
	require_once( dirname(__FILE__) . '/framework.php' );

	$ObjMante   = 	new Mantenimientos();
	$ObjEjec    = 	new ejecutorSQL();
	$objCons	=	new consultor();

	/**
	 * Check if user (email) exists
	 */
	if (isset($_GET['check']) && $_GET['r1']!='') {
		$exito['result'] 	= 0;
		$where 				= 'usuario = "'.$_GET['r1'].'"';
		$selQ       		= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios',$where,'extract');
		if ($selQ['usuario']) {
			$exito['result']= 1;
		}
		echo $exito['result'];
		exit;
	}
	
	get_template_part ( 'header' );

	/** 
	* Sign Up User
	*/
	if ( isset($_POST['register_users']) ) {
		
		$email 		= 	isset($_POST['email'])?$_POST['email']:'';
		$clave 		= 	isset($_POST['password'])?$_POST['password']:'';
		$full_name 	= 	isset($_POST['full_nombre'])?$_POST['full_nombre']:'';
		
		$error		=	FALSE;
		$MSG		=	FALSE;
		$P			=	FALSE;
		$MSSG		=	FALSE;
		
		//include_once ( dirname(__FILE__) .'/ajax/ajax_register_users.php' );

		$CARACTERES	=	RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE);
		$DESPISTAR	=	RandomString($length=20,$uc=TRUE,$n=TRUE,$sc=FALSE);
		$IDFALSE	=	rand(1970,1968);

		$where 		= 'usuario = "'.$_POST['email'].'"';
		$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios',$where);

		if ($sel1['total'] > 0){
			
			$mensaje	=	'Ya existe un usuario con este email';
			$display	=	'block';

		} else {

			/**
			 * Sign Up User
			 */
			$clave 		=	encrypt_decrypt('encrypt', $_POST['password']);

			$P_Tabla 	=	PREFIX.'usuarios';
			$P_Campos 	=	'usuario,contrasena,nombre,apellido,email,id_perfil,name_perfil,created_at,updated_at,id_cia,superadmin,principal,caracteres,activo';
			$P_Valores 	=	"'".$_POST['email']."', '".$clave."','".$_POST['full_nombre']."','','".$_POST['email']."','6','Usuario',NOW(),NOW(),0,0,0,'".$CARACTERES."','0'";
			$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);

			$Obj		=	new EnviarCorreo();

			$mensaG			=	"<font face=verdana size=1.5 />Hola ".$_POST['full_nombre']."&nbsp;<br /><br />
							
							&nbsp;&nbsp;Gracias por tu registro.<br><br>
							&nbsp;&nbsp;Recuerda tus datos de acceso:<br>
							&nbsp;&nbsp;Nombre de usuario: ".$_POST['email']."<br>			
							&nbsp;&nbsp;Para confirmar tu registro, sigue este enlace: <a h	ref='".ENV['URL_NAME']."/system/login.php?pag=login&q=finReg&W=".$IDFALSE."&X=000".$IDFALSE."000000000".$DESPISTAR."&Y=".$IDFALSE."&Z=000-000-".$CARACTERES."-000-".$_POST['email']."000000SI'> Aqui </a><br /><br />
							&nbsp;&nbsp;Esta confirmación estará activa durante 7 días.<br />
							";
						
			$mail_to_send_to= $_POST['email'];
			$from_email 	= $_ENV['MAIL_FROM_ADDRESS'];
			$subject		= "Confirma tu registro";
			$headers  		= "From: " . strip_tags($from_email) . "\r\n";
			$headers 		.= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
			$headers 		.= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
			$headers 		.= "MIME-Version: 1.0\r\n";
			$headers 		.= "Content-Type: text/html; charset=UTF-8\r\n";
			$a 				= mail( $mail_to_send_to, $subject, $mensaG, $headers );
			$mensaje		='Debes confirmar tu cuenta para ingresar. <br />Revisa tu buzón de (entrada / no deseados) para confirmarlo.';
		}
	}

	/** 
	* Validate Sign Up User
	*/
	if (isset($_GET['Z']) && $_GET['Z']!='') {
		
		$PCod			=	explode('-000-',$_GET['Z']);

		$Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','caracteres = "'.$PCod[1].'" and activo=0');
		
		if ( $Data["total"] == 1 ):
			/**
			 * Activate User
			 */
			$Data       		= 	$ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','caracteres = "'.$PCod[1].'" and activo=0','extract');
			$Hecho 				=	$ObjEjec->ejecutarSQL("Update ".PREFIX."usuarios SET activo=1, id_cia='".$Data['id_usuario']."', updated_at=NOW()  Where id_usuario = '".$Data['id_usuario']."'");
				
			if($Hecho==true):
				/**
				 * Set Permissions
				 */
				$permisosNormalUser = [];
				$DataUser       = $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','email = "'.$_POST['email'].'" and activo=0', 'extract');

				$DataPerm       = 	$ObjMante->BuscarLoQueSea('*',PREFIX.'new_users_permissions',false,'array');
				foreach ($DataPerm['resultado'] as $key => $value) {
					$P_Tabla 	=	PREFIX.'permisos';
					$P_Campos 	=	'id_perfil,id_definicion_permiso,id_cia,activo';
					$P_Valores 	=	"'".$DataUser['id_perfil']."', '".$value['permiso']."','".$DataUser['id_cia']."','1'";
					$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
				}			
				$mensaje	=	'Hemos activado su cuenta con éxito.';
			;else:
				$mensaje	=	'¡Error!, No hemos podido validar su activación.';
			endif;
		endif; 
	}

	/** 
	* Reset Password
	*/
	if ( isset($_POST['emailReset']) ) {
		include_once ( dirname(__FILE__) .'/ajax/ajax_reset_password.php' );
	}
?>
 
<link href="assets/css/style_login.css" rel="stylesheet">

<?php
/**
 *  Change Password
 */ 
	if (isset($_GET['ADZ']) && isset($_GET['kracts'])) {
		include_once ( dirname(__FILE__) .'/reset-password.php' );
	} else {
?>
<!-- start: BODY -->
	<body class="login example2">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo" id="logo-text">Login</div>
			

			<!-- start: LOGIN BOX -->
			<div class="box-login" id="loginform">
				
				<!-- <p>
					Por favor ingrese su nombre de usuario y contraseña.
				</p> -->
				<form class="form-login" action="#SELF" method="post">
					<div class="errorHandler alert <?php if(!isset($mensaje)){?>  no-display alert-info <?php } else { ?> alert-danger <?php } ?>">
						<i class="fa fa-remove-sign"></i><?=$mensaje?>
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" required class="form-control" name="nick" placeholder="Email" autocomplete="off" id="nick">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" required class="form-control password" name="password" placeholder="Contraseña" autocomplete="off">
								<i class="fa fa-lock"></i>
								<a class="forgot" href="#" onclick="$('#loginform').hide(); $('#forgotpassword').show();">
									Olvidé mi contraseña
								</a> </span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="" id="remember" name="remember" checked>
								Recordarme 
							</label>

							<label for="remember" class="checkbox-inline text-sign-up" onclick="javascript: $('#registerusers').show(); $('#logo-text').hide();$('#loginform').hide();" style="color:#F05F40">
								Regístrate Gratis
							</label>

							<span class="input-icon pull-right">
							<input type="submit" class="btn btn-bricky pull-right btn-login" name="entrar" value="Login" id="entrar">
							<i class="fa fa-arrow-circle-right" style="color:#fff"></i></span> 
						</div>

					</fieldset>
				</form>
			</div>

			<!-- end: LOGIN BOX -->


			<!-- start: FORGOT PASSWORD / RESET BOX -->
			<div class="box-forgot" id="forgotpassword" >
				<h3>Olvidaste tu contraseña?</h3>
				<p>
					Ingrese: correo electrónico.
				</p>
				<form class="form-forgot" id="resetPassword" name="resetPassword" method="post">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="emailReset" placeholder="Email" required autocomplete="off">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<button class="btn btn-med-grey go-back" onclick="$('#loginform').show();$('#logo-text').show(); $('#forgotpassword').hide();">
								<i class="fa fa-circle-arrow-left"></i> Regresar
							</button>
							<button type="submit" class="btn btn-bricky pull-right" id="enviarPassword" name="enviarPassword">
								Enviar <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- end: FORGOT BOX -->



			<!-- start: REGISTER BOX -->
			<div class="box-register" id="registerusers" style="width:100%">
				<h3>Registrarse</h3>
				<p id="text-mssg">
					Ingrese todos los datos:
				</p>
				<label id="msg-claves"></label>
				<div class="alert alert-info alert-mssg-register" id="alert-mssg-register"></div>
				<div class="container">
				<form class="form-register form-horizontal form-label-left" id="registerUserForm" method="post" action="#SELF">
					<fieldset>
						
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" id="email" placeholder="Email">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="full_nombre" id="full_nombre" placeholder="Nombre Completo" >
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group">
							<label>La contraseña debe tener entre 8 a 16 caracteres.</label>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" maxlength="16" class="form-control" id="password" name="password" placeholder="Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" maxlength="16" class="form-control" name="password_again" id="password_again" placeholder="Repetir Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<div>
								<label for="agree_check" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree_check" name="agree" checked>
									Acepto los terminos y servicios de privacidad.
								</label>
							</div>
						</div>
						<div class="form-actions">
							<button id="registrarse" class="btn btn-med-grey go-back" onclick="$('#loginform').show();$('#logo-text').show(); $('#registerusers').hide();">
								<i class="fa fa-circle-arrow-left"></i> Regresar
							</button>
							<span class="input-icon pull-right">
							<input type="submit" id="register_users" name="register_users" value="Registrarse" onclick="/* registerUsers() */" class="btn btn-bricky btn-register" role="button">
							
							<i class="fa fa-arrow-circle-right" style="color:#fff"></i></span> 

						</div>
					</fieldset>
				</form>
				</div>
			</div>
			<!-- end: REGISTER BOX -->
	</body>
<?php } ?>

<script type="text/javascript" src="assets/js/login.js"></script>
<?php get_template_part ( 'copyright' ); ?>