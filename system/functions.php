<?php
//Emular register_globals on   
if (!ini_get('register_globals')) {
    
    $superglobales = array($_SERVER, $_ENV, $_FILES, $_COOKIE, $_POST, $_GET);

    if (isset($_SESSION)) {   
        array_unshift( $superglobales, $_SESSION );   
    }

    foreach ($superglobales as $superglobal) {   
        
        extract($superglobal, EXTR_SKIP);   
    }   
}

function get_noPermission () {
	if ($_SESSION['id_user']==7) { 
	echo '
      <p />
      <h2>: '.$_SESSION['username'].' <i class="clip-user-block"></i></h2>
      <h5 style="color:red">: No cuenta con permisos para esta página.</h5>';
    }
}

/** 
 * Page Real Name
 * @return $query_str
 */
function getPageRealName () {
	$query_str = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	if ($query_str) {
		return $query_str;
	} else {
		return false;
	}
}

/* Return directory assets */
function get_asset_dir () {

	return dirname(__FILE__.'/assets');
}

/* Return directory assets */
function get_stylesheet_dir () {

	return dirname(__FILE__.'/assets');
}

/* Return directory assets */
function get_vendors_dir () {

	return dirname(__FILE__.'/../vendors');
}

/* function get_template_part( $slug, $name = null, $load = true ) { */
function get_template_part ( $slug ) {
	include_once dirname(__FILE__).'/app/template/'.$slug.'.php';
}

/* print session name */
function getSessionValue ( $name ) {
	return $_SESSION[$name];
}

/* 
	Obtain GET 
   	obtain keys values and name
*/
function obtainGetValues() {

	$numero 			=	0;
	$exito 				=	false;

	$numero 			= 	count($_GET);
	$tags 				= 	array_keys($_GET);	// obtain name of param
	$valores 			= 	array_values($_GET);// obtain values of param
	$exito   			=	array($tags , $valores);
	
	return $exito;
}

/* 
	Obtain POST 
   	obtain keys values and name
*/
function obtainPostValues() {

	$numero 			=	0;
	$exito 				=	false;

	$numero 			= 	count($_POST);
	$tags 				= 	array_keys($_POST);		// obtain name of param
	$valores 			= 	array_values($_POST);	// obtain values of param
	$exito   			=	array($tags , $valores);
	
	return $exito;
}


/* Open view file */
function get_theView ( $name = false ) {
	
	global $url;
	
	$tags 				=	false;
	$pag 				=	false;

	$url 				=	$_SERVER['PHP_SELF'];

	$maximo 			=  	strlen($url);
	$cadena_comienzo 	= 	"http://";
	$cadena_fin 		=	".php";
	$total 				= 	strpos($url,$cadena_comienzo);
	$total2 			= 	strpos($cadena_comienzo,$cadena_fin);
	$total3 			= 	($maximo - $total2 - 4);

	$tags 				=	obtainGetValues();
	$tags 				=	explode("/",$tags[0][0]);
	//dump($tags);
	if ( $tags[0] == '') {

		include_once dirname(__FILE__).'/app/views/home.php';

	} else {

		//obtainPostValues();
		if (file_exists(dirname(__FILE__).'/app/controllers/'.strtolower($tags[0]).'.php')) {
			include_once dirname(__FILE__).'/app/controllers/'.strtolower($tags[0]).'.php';
		}
		if (file_exists(dirname(__FILE__).'/app/views/'.strtolower($tags[0]).'.php')) {
			include_once dirname(__FILE__).'/app/views/'.strtolower($tags[0]).'.php';
		} else {
			include_once dirname(__FILE__).'/404.php';
		}
	}
}


function GET () {
	$tags 				=	obtainGetValues();
	$tags 				=	explode("/",$tags[0][0]);

	return $tags;
}

function POST () {
	$tags 				=	obtainPostValues();
	$tags 				=	explode("/",$tags[0][0]);

	return $tags;
}

/* get_layout_part */
function get_layout_part ( $name ) {

	include_once dirname(__FILE__).'/app/layout/'.$name.'.php';
}

/* Get Views part of code */
function get_view_part ( $name ) {
	include_once dirname(__FILE__).'/app/views/'.$name.'.php';
}

/* Get controller part of code */
function get_controller_part ( $name ) {

	include_once dirname(__FILE__).'/app/controllers/'.$name.'.php';
}

/* Open controller file */
function get_theController () {

	$tags 				=	false;
	$tags 				=	obtainGetValues();

	include_once dirname(__FILE__).'/app/controllers/'.$tags[0][0].'.php';
}

/* Open class folder file */
function get_theClass () {

}

/* System Utilities functions */
function dump ( $name ) {
	echo "<pre class='pre-dump'>";
	var_dump($name);
	exit;
}

/*  Function for Remove html characters */
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}

/* Uppercase first character */
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}

/* Return directory url */
function get_url_directory () {

	return dirname(__FILE__.'/');
}


/*
 	Function get_page_section
		- header
		- content
		- foot
		- footer
 */
function get_page_section ( $slug ) {

}


//Calcular dias transcurridos entre dos fechas dadas
//===================================================
	
function diasEntreFechas($fechainicio, $fechafin){
  	return ((strtotime($fechafin)-strtotime($fechainicio))/86400);
}

$url_server		=	$_SERVER['HTTP_HOST'];
$url 			= 	$_SERVER['PHP_SELF'];

$fecha 			= 	time ();
$ano 			=	date ( "Y" , $fecha );
$mes 			=	date ( "m" , $fecha );
$dia 			=	date ( "d" , $fecha );
$hora 			=	date ( "H" , $fecha ); 
$minuto 		=	date ( "i" , $fecha );
$segundo 		=	date ( "s" , $fecha );

$fechadehoy 	=	"$ano-$mes-$dia $hora:$minuto:$segundo";
$fechadehoysimple=	"$ano-$mes-$dia";
$horadehoy		=	"$hora:$minuto:$segundo";

$ip 			=	$_SERVER['REMOTE_ADDR'];


// Quitar caracteres raros en el mensaje
function quitar($mensaje) { 

	$mensaje = str_replace("<","&lt;",$mensaje); 
	$mensaje = str_replace(">","&gt;",$mensaje); 
	$mensaje = str_replace("\'","&#39;",$mensaje); 
	$mensaje = str_replace('\"',"&quot;",$mensaje); 
	$mensaje = str_replace("\\\\","&#92",$mensaje);

	return $mensaje; 
} 

// Restar Fechas
function resta_fechasF($fecha1,$fecha2, $absoluto = true){
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
		

		list($año1,$mes1,$dia1)=explode("/",$fecha1);
		

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
		

		//list($año1,$mes1,$dia1)=split("-",$fecha1);
		$Res1	=	explode("-",$fecha1);	//	0 = Año ; 1 = Mes ; 2 = Dia
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
		

		//list($año2,$mes2,$dia2)=explode("/",$fecha2);
		$Res2	=	explode("-",$fecha2);	//	0 = Año ; 1 = Mes ; 2 = Dia

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
		

		//list($año2,$mes2,$dia2)=explode("-",$fecha2);
		$Res3	=	explode("-",$fecha2);	//	0 = Año ; 1 = Mes ; 2 = Dia
		$dif = mktime(0,0,0,$Res1[1],$Res1[2],$Res1[0]) - mktime(0,0,0,$Res3[1],$Res3[2],$Res3[0]);
		
		
		
		$dif = $dif / (60*60*24);
		
		$dif = ($absoluto)?abs($dif):$dif; 
		$ndias=floor($dif);

		return($ndias);

	}


/* Sumar dias a una fecha 
   @Param (2017-08-26 , +5 )  
*/
function suma_fechas($fecha,$ndias){

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
	list($dia,$mes,$año) 	=	split("/", $fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($año,$mes,$dia)	=	explode("-",$fecha);
	$nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
	$nuevafecha=date("Y-m-d",$nueva);

	return ($nuevafecha);  
}


/* Restar dias a una fecha 
   @Param (2017-08-26 , -5 )  
*/
function resta_fechas ( $fecha , $ndias ) {

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
	list($dia,$mes,$año)=split("/", $fecha);

	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($año,$mes,$dia)=explode("-",$fecha);
	
	$nueva 		= 	mktime(0,0,0, $mes,$dia,$año) - $ndias * 24 * 60 * 60;
	
	$nuevafecha	=	date("Y-m-d",$nueva);
	
	return ($nuevafecha);  
}

/* Formato de dia */
function formato_dia ($valor) { 

	$valor = str_replace('Monday'	, "Lunes", 		$valor);
	$valor = str_replace('Tuesday'	, "Martes", 	$valor);
	$valor = str_replace('Wednesday', "Miércoles", 	$valor);
	$valor = str_replace('Thursday'	, "Jueves", 	$valor);
	$valor = str_replace('Friday'	, "Viernes", 	$valor);
	$valor = str_replace('Saturday'	, "Sábado", 	$valor);
	$valor = str_replace('Sunday'	, "Domingo", 	$valor);

	 return $valor;
}
		
/* Formato de mes */							
function formato_mes ($valor) { 	

	$valor = str_replace('01', "Enero", 	$valor);
	$valor = str_replace('02', "Febrero", 	$valor);
	$valor = str_replace('03', "Marzo", 	$valor);
	$valor = str_replace('04', "Abril", 	$valor);
	$valor = str_replace('05', "Mayo", 		$valor);
	$valor = str_replace('06', "Junio", 	$valor);
	$valor = str_replace('07', "Julio", 	$valor);
	$valor = str_replace('08', "Agosto", 	$valor);
	$valor = str_replace('09', "Septiembre",$valor);
	$valor = str_replace('10', "Octubre", 	$valor);
	$valor = str_replace('11', "Noviembre", $valor);
	$valor = str_replace('12', "Diciembre", $valor);

	return $valor;
}

/* Formato de dia escrito */									
function formato_dia_escrito($valor){
	$inicio 	=	(int)substr($valor,8,2);
	$formateado =	$inicio." de ".formato_mes(substr($valor,5,2));
	return $formateado;
}

/* Sacar los segundos entre dos horas */
function segundos($hora_inicio,$hora_fin) {

	$hora_i 	=	substr($hora_inicio,11,2);
	$minutos_i	=	substr($hora_inicio,14,2);
	$año_i		=	substr($hora_inicio,0,4);
	$mes_i		=	substr($hora_inicio,5,2);
	$dia_i 		=	substr($hora_inicio,8,2);
	$hora_f 	=	substr($hora_fin,11,2);
	$minutos_f	=	substr($hora_fin,14,2);
	$año_f		=	substr($hora_fin,0,4);
	$mes_f		=	substr($hora_fin,5,2);
	$dia_f		=	substr($hora_fin,8,2);
	
	$diferencia_seg=mktime($hora_f,$minutos_f,0,$mes_f,$dia_f,$año_f) - mktime($hora_i,$minutos_i,0,$mes_i,$dia_i,$año_i);
	
	return $diferencia_seg;
}

/* Limpiar un string */
function limpiarString ($String) {

	$String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
	$String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
	$String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
	$String = str_replace(array('í','ì','î','ï'),"i",$String);
	$String = str_replace(array('é','è','ê','ë'),"e",$String);
	$String = str_replace(array('É','È','Ê','Ë'),"E",$String);
	$String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
	$String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
	$String = str_replace(array('ú','ù','û','ü'),"u",$String);
	$String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
	$String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
	$String = str_replace("ç","c",$String);
	$String = str_replace("Ç","C",$String);
	$String = str_replace("ñ","n",$String);
	$String = str_replace("Ñ","N",$String);
	$String = str_replace("Ý","Y",$String);
	$String = str_replace("ý","y",$String);
	$String = str_replace("`"," ",$String);
	$String = str_replace('"'," ",$String);
	$String = str_replace("'"," ",$String);

	return $String;
}

/* Crear un thumbnail */
function createThumb ( $spath , $dpath , $maxd ) {
	$src=@imagecreatefromjpeg($spath);
	
	if (!$src) {return false;} else {
		$srcw=imagesx($src);
		$srch=imagesy($src);
		if ($srcw<$srch) {$height=$maxd;$width=floor($srcw*$height/$srch);}
		else {$width=$maxd;$height=floor($srch*$width/$srcw);}
		if ($width>$srcw && $height>$srch) {$width=$srcw;$height=$srch;}  //if image is actually smaller than you want, leave small (remove this line to resize anyway)
		$thumb=imagecreatetruecolor($width, $height);
		if ($height<100) {imagecopyresized($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
		else {imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
		imagejpeg($thumb, $dpath);
		return true;
	}
}

/* Ordenar un array */
function ordenar ($toOrderArray, $field, $inverse = false) {  
        $position = array();  
        $newRow = array();  
        foreach ($toOrderArray as $key => $row) {  
                $position[$key]  = $row[$field];  
                $newRow[$key] = $row;  
        }  

        if ($inverse) {  
            arsort($position);  
        }  
        else {  
            asort($position);  
        }

        $returnArray = array();  
        
        foreach ($position as $key => $pos) {       
            $returnArray[] = $newRow[$key];  
        }

        return $returnArray;  
    }

/**
 * Checks and cleans a URL.
 * A number of characters are removed from the URL. If the URL is for displaying
 * filter is applied to the returned cleaned URL.
 */
function esc_url( $url, $protocols = null, $_context = 'display' ) {
	$original_url = $url;

	if ( '' == $url )
		return $url;

	$url = str_replace( ' ', '%20', $url );
	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\[\]\\x80-\\xff]|i', '', $url);

	if ( '' === $url ) {
		return $url;
	}

	if ( 0 !== stripos( $url, 'mailto:' ) ) {
		$strip = array('%0d', '%0a', '%0D', '%0A');
		$url = _deep_replace($strip, $url);
	}

	$url = str_replace(';//', '://', $url);
	/* If the URL doesn't appear to contain a scheme, we
	 * presume it needs http:// prepended (unless a relative
	 * link starting with /, # or ? or a php file).
	 */
	if ( strpos($url, ':') === false && ! in_array( $url[0], array( '/', '#', '?' ) ) &&
		! preg_match('/^[a-z0-9-]+?\.php/i', $url) )
		$url = 'http://' . $url;

	// Replace ampersands and single quotes only when displaying.
	if ( 'display' == $_context ) {
		$url = wp_kses_normalize_entities( $url );
		$url = str_replace( '&amp;', '&#038;', $url );
		$url = str_replace( "'", '&#039;', $url );
	}

	if ( ( false !== strpos( $url, '[' ) ) || ( false !== strpos( $url, ']' ) ) ) {

		$parsed = wp_parse_url( $url );
		$front  = '';

		if ( isset( $parsed['scheme'] ) ) {
			$front .= $parsed['scheme'] . '://';
		} elseif ( '/' === $url[0] ) {
			$front .= '//';
		}

		if ( isset( $parsed['user'] ) ) {
			$front .= $parsed['user'];
		}

		if ( isset( $parsed['pass'] ) ) {
			$front .= ':' . $parsed['pass'];
		}

		if ( isset( $parsed['user'] ) || isset( $parsed['pass'] ) ) {
			$front .= '@';
		}

		if ( isset( $parsed['host'] ) ) {
			$front .= $parsed['host'];
		}

		if ( isset( $parsed['port'] ) ) {
			$front .= ':' . $parsed['port'];
		}

		$end_dirty = str_replace( $front, '', $url );
		$end_clean = str_replace( array( '[', ']' ), array( '%5B', '%5D' ), $end_dirty );
		$url       = str_replace( $end_dirty, $end_clean, $url );

	}

	if ( '/' === $url[0] ) {
		$good_protocol_url = $url;
	} else {
		if ( ! is_array( $protocols ) )
			$protocols = wp_allowed_protocols();
		$good_protocol_url = wp_kses_bad_protocol( $url, $protocols );
		if ( strtolower( $good_protocol_url ) != strtolower( $url ) )
			return '';
	}
}


// Replace letter
// letter and characthers
// ======================
	function Reemplazar_letras($frase)
	{
				$frase_original  = $frase;
				$sano = array("á","é","í","ó","ú","ñ",
				"Á","É","Í","Ó","Ú",
				"à","è","ì","ò","ù",
				"Ö","Ñ","Ü","ü","é");
				
				$sabroso   = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
				"&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;",
				"&aacute;","&eacute;","&iacute;","&oacute;","&uacute;",
				"&Ouml;","&Ntilde;","&Uuml;","&uuml;","Ã©");
				
				$nueva_frase = str_replace($sano, $sabroso, $frase_original);
				
				return ($nueva_frase);
	}



/**
 * Reemplaza todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function sanear_string($string) {

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        '',
        $string
    );


    return $string;
}

function RandomString($length=7,$uc=TRUE,$n=TRUE,$sc=FALSE) {
	$source             = 'abcdefghijklmnopqrstuvwxyz';
	if($uc==1) $source  .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if($n==1) $source   .= '1234567890';
	if($sc==1) $source  .= '|@#~$%()=^*+[]{}-_';
	if($length>0){
		$rstr = "";
		$source = str_split($source,1);
		for($i=1; $i<=$length; $i++){
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,count($source));
			$rstr .= $source[$num-1];
		}
	
	}
	return $rstr;
}

/**
 * Encryp & Decrypt
 * @return $output
 */
function encrypt_decrypt($action, $string) {
	$output = false;

	$encrypt_method = $_ENV['ENCRYPT_METHOD'];
	$secret_key = $_ENV['SECRET_KEY'];
	$secret_iv = $_ENV['SECRET_IV'];

	// hash
	$key = hash('sha256', $secret_key);
	
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

/**
 * Get eventos
 */
// function getNotifications () {
// 	$ObjMant 	=	new Mantenimientos();
// 	$query 		=	$ObjMant->BuscarLoQueSea('*',PREFIX.'events','activo =1','array');
// 	$result 	= array('total'=>$query['total'], 'result'=>$query['resultado']);
// 	return $result;
// }
?>