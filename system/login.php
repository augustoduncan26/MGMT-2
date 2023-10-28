<?php 

	require_once( dirname(__FILE__) . '/functions.php' ); 
	require_once( dirname(__FILE__) . '/framework.php' );
	
	get_template_part ( 'header' );

	// Register User
	if ( isset($_POST['register_users']) ) {
		
		$email 		= 	isset($_POST['usuario'])?$_POST['usuario']:'';
		$clave 		= 	isset($_POST['clave'])?$_POST['clave']:'';
		$cia 		= 	isset($_POST['cia'])?$_POST['cia']:'';
		$tipo		= 	isset($_POST['select_tipo'])?$_POST['select_tipo']:'';
		$flagEjec 	= 	isset($_POST['acceso'])?$_POST['acceso']:'';
		
		$error		=	FALSE;
		$MSG		=	FALSE;
		$P			=	FALSE;
		$MSSG		=	FALSE;
		include_once ( dirname(__FILE__) .'/ajax/ajax_register_users.php' );

	}

	// Validate users register
	if (isset($_GET['Z'])) {
		include_once ( dirname(__FILE__) .'/ajax/ajax_confirm_register_users.php' );
	}

	// Send Reset Password
	if ( isset($_POST['emailReset']) ) {
		include_once ( dirname(__FILE__) .'/ajax/ajax_reset_password.php' );
	}
?>
 
<link href="assets/css/style_login.css" rel="stylesheet">

<?php
// Change Password
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
					<div class="errorHandler alert alert-info <?php if(!isset($mensaje)){?> no-display <?php } ?>">
						<i class="fa fa-remove-sign"></i><?=$mensaje?>.
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

							<label for="remember" class="checkbox-inline" onclick="javascript: $('#registerusers').show(); $('#logo-text').hide();$('#loginform').hide();" style="color:#F05F40">
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
				<div class="alert alert-info alert-mssg-register"></div>
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
							<label>La contraseña debe tener entre 6 a 10 caracteres.</label>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Repetir Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree" checked>
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