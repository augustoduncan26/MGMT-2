<?php

require_once 'app/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define("DB_HOST" 	,	$_ENV['DB_HOST']);		// Host
define("DB_USER" 	,	$_ENV['DB_USER']);
define("DB_PASS" 	,	$_ENV['DB_PASSWD']);
define("DB_NAME" 	,	$_ENV['DB_NAME']);
define("DB_TIPO" 	,	'mysql');
define("DB_MODO" 	,	'SIMPLE');
define("PREFIX"     ,   $_ENV['DB_PREFIX']);
define("PREFIX_FACT",   $_ENV['PREFIX_FACT']);
define("ENV",$dotenv->load());



define("SAD_DIR", getcwd()."//");							//DIRECTORIO RAIZ DE LA APLICACION			-	*
define("SAD_DIR_TMP", SAD_DIR."tmp\\");						//DIRECTORIO PARA DESCARGAR LOS TEMP		-	*
define("SAD_URL","http://localhost/MGMT/");			        //URL DE LA PALICACION						
define("SAD_URL_BASE","/system/");						        //DIRECTORIO BASE SOBRE EL QUE ESTA LA APLICACION	
define("SAD_URL_AMIGABLE",false);							//SI SE UTILIZA URL AMIGABLE						-	*
															//False, PARA DESACTIVAR URL AMIGABLE				-	*
define("SAD_CARPETA_IMAGENES","assets/images");				//CARPETA EN DONDE ESTAN LAS IMAGENES				-	*

define('ROOT_DIR', __DIR__);								//CARPETA DONDE CORRE EL PROYECTO
define('REPOSITORY',$_ENV['FLD_REPOSITORY']);				//CARPETA SE GUARDAN LAS IMAGENES

$link       = @mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWD'], $_ENV['DB_NAME']) or die("<h1>No existe conección a la Base de Datos</h1>");
$mysqli     = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWD'], $_ENV['DB_NAME']);

$mysqli->set_charset("utf8");
if ($mysqli->connect_error) {
	die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

define("DB_HOST_S"	,	"");
define("DB_USER_S"	,	"");
define("DB_CLAVE_S"	,	"");

$linkServidor 	=	$mysqli; 

// SHOW ERRORS / PHP
//ini_set('error_reporting', E_ALL);
$PROTOCOLO      =   stripos($_SERVER['SERVER_PROTOCOL'],'http') === true ? 'https://' : 'http://';
$URL 			=	$PROTOCOLO.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>
