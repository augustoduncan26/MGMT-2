<?php
include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user    = $_SESSION["id_user"];
$id_cia  	= $_SESSION['id_cia'];

if ( $_GET['que'] == 'changeP') {

	$datos       = $ObjMante->BuscarLoQueSea('AES_DECRYPT(contrasena,"toga") as contrasena',PREFIX.'users','id_usuario = "'.$_GET['id_user'].'"');
	
	if ( $datos['total'] == 1 ) {

		if ($datos['resultado'][0]['contrasena'] != $_GET['actualpasswd']) {
			echo '<div class="alert alert-danger">¡Error en la contraseña actual.</div>';
		} else {
			$P_Valores = "contrasena = AES_ENCRYPT('".htmlentities($_GET['newpassword'])."','toga'), updated_at=NOW()";
			$sql 	= $ObjEjec->actualizarRegistro($P_Valores, PREFIX.'users', 'id_usuario = "'.$_GET['id_user'].'" and activo=1');
			
			if ($sql) {
				echo 'OK';
			} else {
				echo '<div class="alert alert-danger">¡Error: No hemos podido verificar sus datos.</div>';
			}
		}
	} else {
			echo '<div class="alert alert-danger">¡Error!: No hemos podido verificar sus datos</div>';
	}
} 

if ( $_GET['que'] == 'verifyP') {
	$datos       = 	$ObjMante->BuscarLoQueSea('AES_DECRYPT(usuarios.contrasena,"toga") as clave',PREFIX.'users','id_usuario="'.$_GET['id_user'].'"');
	if ( $datos['total'] < 1 ) {
		if ($datos['contrasena'] != $_GET['actualpasswd']) {
			echo "¡Error en la contraseña actual!";
		} else { echo "Ha cambiado su contraseña con éxito"; }
	} else {
		echo "¡Error!: No hemos podido verificar sus datos";
	}
}