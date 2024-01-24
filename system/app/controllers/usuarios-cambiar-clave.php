<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   =   new Mantenimientos();
$ObjEjec    =   new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'users';

$DataUser   = $ObjMante->BuscarLoQueSea('AES_DECRYPT(contrasena,"toga") as clave_actual',$P_Tabla,'id_usuario = "'.$id_user.'"','extract');


echo $DataUser['clave_actual'];