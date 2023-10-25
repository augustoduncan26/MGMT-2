<?php

include_once ('../framework.php');

if ( $_GET['que'] == 'changeP') {
	$sql 		=	mysql_query("Update usuarios set contrasena = AES_ENCRYPT('".htmlentities($_GET['newpassword'])."','toga') , fecha_ult_act=NOW() Where id_usuario = '".$_GET['id_user']."' and activo = 1") or die('Error!: No hemos podido verificar sus datos');
	//'Error!: No hemos podido verificar sus datos'

	if ($sql) {
		echo 'Ha cambiado su contraseña con éxito';
	}

} 

if ( $_GET['que'] == 'verifyP') {
	$selP 		=	mysql_query("Select AES_DECRYPT(usuarios.contrasena,'toga') as clave From usuarios Where id_usuario = '".$_GET['id_user']."'") or die(mysql_error());

	if ( mysql_num_rows($selP) > 1 ) {
		$datos 		=	mysql_fetch_array($selP);
		//if ($datos['clave'] == $_GET['actualpasswd']) { echo 1; }else { echo 0;}

		if ($datos['clave'] != $_GET['actualpasswd']) {
			echo "¡Error en la contraseña actual!";
		} else { echo "Ha cambiado su contraseña con éxito"; }
	} else {
		echo "¡Error!: No hemos podido verificar sus datos";
	}
}