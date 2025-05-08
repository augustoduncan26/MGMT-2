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
#   Envio de Emails                          =
#=============================================
function sendAnEmail ($messg,$sendToEmail,$fromEmail=false,$subject) {
	$mail_to_send_to = $sendToEmail;
	if ($fromEmail!=false) {
		$from_email 	 = $fromEmail;
	} else {
		$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
	}
	//$subject		 = "Contraseña actualizada.";
	$headers  = "From: " . strip_tags($from_email) . "\r\n";
	$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
	$headers .= "BCC: ".strip_tags($_ENV["MAIL_BBC"])."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	mail( $mail_to_send_to, $subject, $messg, $headers );
}

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

#=============================================
#   Process Api Files                        =
#=============================================
// $nombCarp = "api";
// $arrFiles = scandir (dirname(__FILE__).'/'.$nombCarp);
	
// foreach ($arrFiles as $File){
// 	if ($File != "." AND $File != ".."){
// 		if (mb_ereg(".php$", $File)) {
// 			include_once $nombCarp.DIRECTORY_SEPARATOR.$File;
// 		}
// 	}
// }
// unset ($nombCarp, $arrFiles, $File);

$url_server		=	$_SERVER['HTTP_HOST']; 
$url 			= 	$_SERVER['PHP_SELF'];
$ip 			=	$_SERVER['REMOTE_ADDR'];
$b 				=	isset($_GET['b'])?$_GET['b']:false;
if ($b) {  

$vacio 	=	"";

setcookie("Call_soportemgw_Nick",$vacio); 
setcookie("Call_soportemgw_Pass",$vacio);
#==================================
#Setear log						  =
#==================================
ini_set("log_errors", TRUE);
ini_set("error_log", 'error_log');

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
if ( encrypt_decrypt('decrypt', $saco['contrasena']) == $passN) {

	$ObjMant 		=	new Mantenimientos();
	$Objejec 		=  	new ejecutorSQL();
	$id_session 	=	session_id();

	setcookie("Soporte_Nick",$nickN); 
	setcookie("Soporte_Pass",$passN);

	//str_replace(" ", "_", $saco['nombre']);
	$nombredesesion =	$saco['nombre'];

	// SESSION FOR THE APP
	$_SESSION['username'] 			= 	$nombredesesion;
	$_SESSION['id_session'] 		= 	session_id();
	$_SESSION['id_user']  			= 	$saco['id_usuario'];
	$_SESSION['id_rol']  			= 	$saco['id_perfil'];
	$_SESSION['principal'] 			= 	$saco['principal'];
	$_SESSION['superadmin'] 		= 	$saco['superadmin'];
	$_SESSION['lastname']			= 	$saco['apellido'];
	$_SESSION['email']				= 	$saco['email'];
	$_SESSION['id_cia'] 			= 	$saco['id_cia'];
    // SESSION FOR MODULE FACTURACION
    $_SESSION['user_id'] 			= 	$saco['id_usuario'];
	$_SESSION['user_name'] 			= 	$nombredesesion;
    $_SESSION['user_email'] 		= 	$saco['email'];
    $_SESSION['user_login_status'] 	= 	1;

    // SESSION FOR MODULE INVENTARIO
    $_SESSION['user_id']			=	$saco['id_usuario'];

	$P_valores  =	"'".$id_session."','".$nickN."',NOW(),1";
	$P_campos 	=	"id_session,user,date,activo";

	$Objejec->insertarRegistro(PREFIX.'session', $P_campos , $P_valores);
	
	$logadmin = true;

?>
	<SCRIPT LANGUAGE="javascript"> location.href = 'home'; </SCRIPT>

<?php 

} else { 
	$mensaje= "Datos de acceso incorrectos.";  
}

}  else { $mensaje = "Datos de acceso incorrectos"; }

}

function checkUserLogin ( $id_sess ) {
 	//global $link, $mysqli ;
	$ObjMant 	=	new Mantenimientos();
	$query 		=	$ObjMant->BuscarLoQueSea('COUNT(*) as total',PREFIX.'session','id_session = "'.$id_sess.'"','extract');

		if($query['total'] == 0) {
			echo '<SCRIPT LANGUAGE="javascript"> location.href = "login"; </SCRIPT>';	
		} else {
			$logadmin = true;
		}
}

?>
