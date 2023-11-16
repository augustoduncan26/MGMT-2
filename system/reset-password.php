<?php 

	//require_once( dirname(__FILE__) . '/functions.php' ); 
	//require_once( dirname(__FILE__) . '/framework.php' );
	
	include_once ('functions.php');
	include_once ('framework.php');
	$ObjMante   = new Mantenimientos();
	$ObjEjec    = new ejecutorSQL();



	get_template_part ( 'header' );

	$PCod		=	explode('-000-',$_GET['ADZ']);
	$P_User 	=	explode('000000SI',$PCod[2]);

	$sel_       = $ObjMante->BuscarLoQueSea('id_usuario,token',PREFIX.'users','token = "'.$_GET['rst'].'" and usuario="'.$P_User[0].'"');

if ( $sel_['total'] < 1 ) {

	$mensaje = 'Este enlace ya no existe, espere para ser redirigido';
	$SITE   = ENV['URL_NAME'];
	echo '<script>
			setTimeout("location.href=\''.$SITE.'/system/login.php\'", 3000);
		</script>';

} else {

	$dataReset 		=	$sel_;
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

		//$sql       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','token = "'.$_GET['rst'].'" and usuario="'.$P_User[0].'" and activo=1');
		
		$P_Valores 	=	"contrasena=AES_ENCRYPT('".$_POST['password']."','toga'), token='', updated_at=NOW()";
		$sql 		= $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'users', 'token = "'.$_GET['rst'].'" and usuario="'.$P_User[0].'" and activo=1');


		if ($sql) {

			$mensaje=	'Ha cambiado su clave de acceso con éxito, espere para ser redirigido ';
			$SITE   = ENV['URL_NAME'];
			echo '<script>
					setTimeout("location.href=\'"'.$SITE.'"/system/login.php\'", 3000);
			</script>';
		}
	}
}

?>
 
<link href="assets/css/style_login.css" rel="stylesheet">
<style type="text/css" media="screen">
	.errors {
      color: #F05F40 !important;
      /*background-color: #acf;*/
   }
</style>

<!-- start: BODY -->
	<body class="login example2">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo" id="logo-text"><img src="assets/images/template/DC-2.png" width="50px"> Cambiar Clave</div>
			

			<!-- start: LOGIN BOX -->
			<div class="box-login" id="loginform">
				
				<!-- <p>
					Por favor ingrese su nombre de usuario y contraseña.
				</p> -->
				<form id="registerUserForm" class="form-login" action="#SELF" method="post">
					<div id="text-mssg" class="errorHandler alert alert-info <?php if(!isset($mensaje)){?> no-display <?php } ?>">
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

	<script>
//let ENV = "<?php echo ENV["URL_NAME"]; ?>";

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function registerUsers () {
	//let ENV3 = "<?php echo ENV["URL_NAME"]; ?>";
	if (document.getElementById('password').value != document.getElementById('repeat_password').value) {
		document.getElementById('text-mssg').style.display  = 'block';
		document.getElementById('text-mssg').innerHTML = 'Las claves son diferentes, por favor corregir.';
		return false;
	} 
	// else {
	// 	return true;
	// 	//setTimeout("redireccionarPagina()", 3000);
	// 	setTimeout("location.href='"+ENV+"/system/login.php'", 3000);
	// }
}

function redireccionarPagina() {
	let ENV4 = "<?php echo ENV["URL_NAME"]; ?>";
 	window.location = ""+ENV4+"/system/login.php";
}


</script>

<?php get_template_part ( 'copyright' ); ?>