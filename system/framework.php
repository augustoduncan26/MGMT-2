<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();
defined('DIRECTORY_SEPARATOR') or define('DIRECTORY_SEPARATOR', '/');

include ('config.php') ;

// include_once ("class/enviar_correo.php");
// include_once("class/class.phpmailer.php");
// include_once("class/class.smtp.php");

// Otras yerbas
$caja_prefix 		=	'caja_';
$fcatura_prefix 	=	'fact_';

#=============================================
#   Process class_db                         =
#=============================================
$nombCarp = "class_db";
$arrFiles = scandir (dirname(__FILE__).'/'.$nombCarp);
	
foreach ($arrFiles as $File){
	if ($File != "." AND $File != ".."){
		if (mb_ereg(".php$", $File)) {
			include_once $nombCarp.DIRECTORY_SEPARATOR.$File;
		}
	}
}
unset ($nombCarp, $arrFiles, $File);

#=============================================
#   Process class                            =
#=============================================
$nombCarp = "class";
$arrFiles = scandir (dirname(__FILE__).'/'.$nombCarp);
	
foreach ($arrFiles as $File){
	if ($File != "." AND $File != ".."){
		if (mb_ereg(".php$", $File)) {
			include_once $nombCarp.DIRECTORY_SEPARATOR.$File;
		}
	}
}
unset ($nombCarp, $arrFiles, $File);

$url_server		=	$_SERVER['HTTP_HOST']; 
$url 			= 	$_SERVER['PHP_SELF'];
$ip 			=	$_SERVER['REMOTE_ADDR'];
$b 				=	isset($_GET['b'])?$_GET['b']:false;
if ($b) {  

$vacio 	=	"";

setcookie("Call_soportemgw_Nick",$vacio); 
setcookie("Call_soportemgw_Pass",$vacio);

$detalle		=	"Usuario: $user";	

?>

<script>location.href='index.php'</script>

<?php 
}

// Enter to the system
// ********************

if (isset($entrar) and $entrar and $nick!="" and $password!="") { 

$mensaje =  false;
$ObjUser =  new Users();

$nickN 	 = 	$_POST["nick"]; 
$passN 	 = 	$_POST["password"]; 

$busco 	 =	$ObjUser->verificarUsuario ($nickN, $passN);

if ( $busco == 1 ) { 
	$saco 			=	$ObjUser->getUser( $nickN, "Usuario" );
if ( $saco['contrasena'] == $passN ) {

	$ObjMant 		=	new Mantenimientos();
	$Objejec 		=  	new ejecutorSQL();
	$id_session 	=	session_id();

	setcookie("Soporte_Nick",$nickN); 
	setcookie("Soporte_Pass",$passN);

	//str_replace(" ", "_", $saco['nombre']);
	$nombredesesion =	$saco['nombre'];

	// SESSION FOR THE APP
	$_SESSION['username'] 	= $nombredesesion;
	$_SESSION['id_session'] = session_id();
	$_SESSION['id_user']  	= $saco['id_usuario'];
	$_SESSION['principal'] 	= $saco['principal'];
	$_SESSION['lastname']	= $saco['apellido'];
	$_SESSION['email']		= $saco['email'];
	$_SESSION['id_empresa'] = $saco['id_usuario'];


	// $selEmp 				=  $ObjMant->BuscarLoQueSea('*' ,'empresas', 'id_usuario = '.$saco['id_usuario'], 'extract', false);
	// $_SESSION['id_empresa'] = $selEmp['id_usuario'];

    // SESSION FOR MODULE FACTURACION
    $_SESSION['user_id'] 			= 	$saco['id_usuario'];
	$_SESSION['user_name'] 			= 	$nombredesesion;
    $_SESSION['user_email'] 		= 	$saco['email'];
    $_SESSION['user_login_status'] 	= 	1;

    // SESSION FOR MODULE INVENTARIO
    $_SESSION['user_id']			=	$saco['id_usuario'];
    
	//mysql_query("insert into log (fecha, tipo, clase, detalle, usuario, contra, ip, tipo_usuario) values ('$fechadehoy','Login','Correcto','-','$nickN','','$ip', '$tipo_usuario')");
	$P_valores  =	"'".$id_session."','".$nickN."',NOW(),1";
	$P_campos 	=	"id_session,user,date,active";

	$Objejec->insertarRegistro('session', $P_campos , $P_valores);
	
	$logadmin = true;

?>
	<SCRIPT LANGUAGE="javascript"> location.href = 'home.php'; </SCRIPT>

<?php 

} else { 
	$mensaje= "Datos de acceso incorrectos.";  
}

}  else { $mensaje = "Datos de acceso incorrectos"; }

}

function checkUserLogin ( $id_sess ) {
 	//global $link, $mysqli ;
	$ObjMant 	=	new Mantenimientos();
	$query 		=	$ObjMant->BuscarLoQueSea('COUNT(*) as total','session','id_session = "'.$id_sess.'"','extract');

		if($query['total'] == 0) {
			echo '<SCRIPT LANGUAGE="javascript"> location.href = "login"; </SCRIPT>';	
		} else {
			$logadmin = true;
		}
}

?>
