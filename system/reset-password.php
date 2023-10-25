<?php 

	require_once( dirname(__FILE__) . '/functions.php' ); 
	require_once( dirname(__FILE__) . '/framework.php' );
	
	get_template_part ( 'header' );

	$PCod		=	explode('-000-',$_GET['ADZ']);
	$P_User 	=	explode('000000SI',$PCod[2]);
	
	$sel_ 		=	mysql_query("Select usuarios.id_usuario,usuarios_reset_passwd.id_usuario,usuarios_reset_passwd.caracters From usuarios,usuarios_reset_passwd Where usuarios_reset_passwd.id_usuario = usuarios.id_usuario and usuarios_reset_passwd.caracters = '".$_GET['rst']."' and usuarios.usuario = '".$P_User[0]."'");

if ( mysql_num_rows($sel_) < 1 ) {

	$mensaje = 'Este enlace ya no existe, espere para ser redirigido.. ';
	echo '<script>
				setTimeout("location.href=\'http://hhs.duncancomputer.com/system/login.php\'", 3000);
		</script>';

} else {

	$dataReset 		=	mysql_fetch_array($sel_);
	// Register User
	if ( $_POST['btn-change-password'] ) {
		
		$clave 		= 	isset($_POST['password'])?$_POST['password']:'';
		$claveR		= 	isset($_POST['repeat_password'])?$_POST['repeat_password']:'';
		$caracteres =   isset($_GET['kracts'])?$_GET['kracts']:'';
		$error		=	FALSE;
		$MSG		=	FALSE;
		$P			=	FALSE;
		$MSSG		=	FALSE;
		
		$PCod		=	explode('-000-',$_GET['ADZ']);
		$P_User 	=	explode('000000SI',$PCod[2]);


		$sql 		=	mysql_query("Update usuarios set contrasena = AES_ENCRYPT('".$_POST['password']."','toga'), fecha_ult_act=NOW() Where usuario = '".$P_User[0]."' and caracteres = '".$_GET['kracts']."'") or die('Error!: No hemos podido verificar sus datos');
		$sql 		=	mysql_query("Delete from usuarios_reset_passwd Where id_usuario = '".$dataReset['id_usuario']."' and caracters = '".$dataReset['caracters']."'") or die('Error!: No hemos podido verificar sus datos');
		
		if ($sql) {

			$mensaje=	'Ha cambiado su clave de acceso con éxito, espere para ser redirigido ';
			echo '<script>
					setTimeout("location.href=\'http://hhs.duncancomputer.com/system/login.php\'", 3000);
			</script>';
		}
	}
}

?>
 
<link href="../assets/css/style_login.css" rel="stylesheet">
<style type="text/css" media="screen">
	.errors {
      color: #F05F40 !important;
      /*background-color: #acf;*/
   }
</style>
<script>

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function registerUsers () {

	if (document.getElementById('password').value != document.getElementById('repeat_password').value) {
		document.getElementById('text-mssg').style.display  = 'block';
		document.getElementById('text-mssg').innerHTML = 'Las claves son diferentes, por favor corregir.';
		return false;
	} else {
		return true;
		//setTimeout("redireccionarPagina()", 3000);
		setTimeout("location.href='http://hhs.duncancomputer.com/system/login.php'", 3000);
	}
}

function redireccionarPagina() {
  window.location = "http://hhs.duncancomputer.com/system/login.php";
}


</script>


<!-- start: BODY -->
	<body class="login example2">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo" id="logo-text"><img src="images/DC-2.png" width="50px"> Cambiar Clave</div>
			

			<!-- start: LOGIN BOX -->
			<div class="box-login" id="loginform">
				
				<!-- <p>
					Por favor ingrese su nombre de usuario y contraseña.
				</p> -->
				<form id="registerUserForm" class="form-login" action="#SELF" method="post">
					<div id="text-mssg" class="errorHandler alert alert-danger <?php if(!isset($mensaje)){?> no-display <?php } ?>">
						<i class="fa fa-remove-sign"></i> <?=$mensaje?>.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" required class="form-control" name="password" maxlength="15" minlength="6" placeholder="Contraseña" autocomplete="off" autofocus id="password">
								<i class="fa fa-lock"></i> 
							</span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" required class="form-control password" maxlength="15" minlength="6" name="repeat_password" id="repeat_password" placeholder="Repetir Contraseña" autocomplete="off">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline" style="color:#F05F40">
								Ingrese de 6 a 15 caracteres
							</label>
							<span class="input-icon pull-right">
							<input type="submit" class="btn btn-bricky pull-right" name="btn-change-password" onClick="return registerUsers()" value="Aceptar" id="btn-change-password">
							<i class="fa fa-arrow-circle-right" style="color:#fff"></i></span> 
						</div>

					</fieldset>
				</form>
			</div>

			<!-- end: LOGIN BOX -->
	</body>


<?php get_template_part ( 'copyright' ); ?>