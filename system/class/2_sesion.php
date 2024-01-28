<?php
/** 
* Archivo de clase sesion
* Contiene las variables y constantes de sesion
* S.A.D
*/
class sesion{
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var integer Tiempo de vida de la sesi�n en formato TIMESTAMP
	*/
	var $life_time;
	
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	
	/** 
	* Constructor de la clase sesion. 
	* Inicializa los atributos de la clase e instacia la clase padre. 
	* Adem�s, ubica el sesion handler hacia la base de datos, a trav�s de m�todos 
	* definidos en esta clase
	* 
	* @access constructor
	*/
	function sesion(){
		$flagConex = false;
		
		// verificar conexion a Base de datos
		$objODBC = new odbc('M');
		$flagConex = (empty($objODBC->err)) ? $objODBC->linkBD : false;
		
		if ($flagConex){
			// Consultando MAXLIFETIME de sesiones
			$this->life_time = get_cfg_var("session.gc_maxlifetime");
			
			// Seteando Handlers de Sesiones
			// session_set_save_handler( 
			// 	array( &$this, "abrir" ), 
			// 	array( &$this, "cerrar" ),
			// 	array( &$this, "leer" ),
			// 	array( &$this, "escribir"),
			// 	array( &$this, "destruir"),
			// 	array( &$this, "gc" )
			// );
			
			//if(isset($_GET['pag']) && $_GET['pag']<>'login'):
				//@$this->iniciarSesion();
				$this->iniciarSesion();
			//endif;
		}
		
		return ($flagConex);
		
	}
	
	
	////////////////////////////////////////////////////////////////////
	// M�todos
	///////////////////////////////////////////////////////////////////	
	/** 
	* Metodo que abre sesi�n.
	* 
	* @return boolean Retorna TRUE
	*/
	function abrir( $save_path, $session_name){
		$this->gc();
		return true;
	}
	
	/** 
	* M�todo que cierra sesi�n
	* 
	* @return boolean Retorna TRUE
	*/
	function cerrar(){
		return true;
	}
	
	/** 
	* Lee la cadena de datos de una sesi�n previamente creada 
	* 
	* @param string $id Id de la sesi�n activa
	* @return string Retorna la data encontrada del id de sesi�n proporcionado
	*/
	function leer($id){
		$objConsultor = new consultor();
		//@$this->iniciarSesion();
		// Set empty result
        $data = '';
		
        // Fetch session data from the selected database
		$time = time();
		
		$newid = mysqli_real_escape_string($id);
		
		$sel = "*";
		$frm = "ad_session";
		$whr = "id_session = '".$newid."' AND `expires` > ".$time;
		
		$objConsultor->consultar($sel, $frm, $whr);
		
        $numReg = $objConsultor->totalFilas;
		
		if($numReg > 0) {
			$row = $objConsultor->extraerRegistro();
			$data = $row['session_data'];
		}
		//echo time_duration($row['expires']);
		return $data;
	}
	
	/** 
	* Escribe cadena de data asociandola  a un id de sesi�n dado
	* 
	* @param string $id Id de sesi�n identificada
	* @param string $data Data de sesi�n a cargar
	* @return boolean Retorna TRUE siempre
	*/
	function escribir($id, $data){
		$objEjecSQL = new ejecutorSQL();
		
		$time 		= time() * (7 * 24 * 60 * 60);//1336796871 
		//$time = time()+$this->life_time;
		//$idio		=	new idioma();
		//$time =	time() * 28800 * 28800; 
		$newid 		= mysql_real_escape_string($id);
		$newdata 	= mysql_real_escape_string($data);
		
		//CONSULTAR IDIOMA
		//$sel	=	 $idio->Buscaridioma();
		//$sess		=	new sesion();
		$dta		=	$this->consultarIdSesion();
		$objCons 	=  	new consultor;
		
		//$objCms		=	new cms();
		//$idUs 		= 	$objCms->consultarID();
		@$idUs		= 	$_SESSION['idUsuario'];
		
		mysql_query('DELETE FROM ad_session WHERE session_data IS NULL',CONEXIONBD);
		mysql_query('DELETE FROM ad_session WHERE (id_us = "'.$idUs.'" and date < "'.date('Y-m-d').'") or (id_us IS NULL  and date IS NULL)',CONEXIONBD);
		
		
		$whr		=	'(id_us = "'.$idUs.'" and date < "'.date('Y-m-d').'") or (id_us="" and date = "")';
		$objEjecSQL->borrarRegistro('ad_session', $whr);
		
		$wr		=	"id_session = '".$dta."'";
		$objCons->consultar("*", 'ad_session',$wr);
		
		if($objCons->totalFilas > 0)
		{
			$reg   	= 	$objCons->extraerRegistro();
			$sel	=	$reg['idioma'];	
		}
		else
		{
			$sel	=	'ing';	
		}
	
		//FIN CONSULTAR IDIOMA
	
		$tbl = "ad_session";
		$cmp = "id_session, session_data, expires,idioma, date, id_us";
		$val = "'".$newid."','".$newdata."', '".$time."','".$sel."', '".date('Y-m-d')."', '".$idUs."'";
		
		$objEjecSQL->remplazarRegistro($tbl, $cmp, $val);
		
		return true;
	}
	
	/** 
	* Destruye registro de sesi�n seg�n id de sesi�n dada.
	* 
	* @param string $id Id de sesi�n
	* @return boolean Retorna TRUE siempre
	*/
	function destruir( $id ) {
		$objEjecSQL = new ejecutorSQL();
		
		$newid = mysql_real_escape_string($id);
		
		$tbl = "ad_session";
		$whr = "id_session='".$newid."'";		

		$objEjecSQL->borrarRegistro($tbl, $whr);
		return true;
	}
	
	/** 
	* Metodo que funciona como garbage collector, se encarga de borrar sesiones que
	* no fueron cerradas y que ya expiraron
	* 
	* @return boolean Siempre retorna TRUE
	*/
	function gc() {
		// Garbage Collection
		// Build DELETE query.  Delete all records who have passed the expiration time
		
		$objEjecSQL = new ejecutorSQL();
		
		$newid = mysql_real_escape_string(@$id);
		
		$tbl = "ad_session";
		$whr = "expires < UNIX_TIMESTAMP()";		
		
		$objEjecSQL->borrarRegistro($tbl, $whr);
		
		// Always return TRUE
        return true;
	}
	
	/** 
	* Inicia la sesion en la aplicaci�n
	* 
	*/
	function iniciarSesion(){
	 	@session_start();
	}
	
	/** 
	* Termina la sesion en la aplicacion (todas las sesiones se cerraran)
	* 
	*/
	function terminarSesion(){
	 	@session_destroy();
		
	}
	
	/** 
	* Devuelve el ID de la sesi�n 
	* 
	* @return string Cadena que contiene el ID de la sesion, en caso de no existir retorna 
	*/
	function consultarIdSesion(){
		return (@session_id());	
	}
	
	/** 
	* Registra una variable de sesi�n.
	* 
	* @param string $P_nomb Nombre de la variable de sesi�n a crear
	* @param string $P_valor Valor de la variable de sesi�n
	*/
	function registrarVariableSesion($P_nomb, $P_valor){
		$_SESSION[$P_nomb] = $P_valor;	
	}
	
	/** 
	* Devuelve el valor de una variable de sesi�n registrada previamente
	* 
	* @param string $P_nomb Nombre de la variable de sesi�n a consultar
	* @return string Valor o data almacenada en la variable de sesi�n
	*/
	function consultarVariableSesion($P_nomb){
		if (isset($_SESSION[$P_nomb])){
			
			return($_SESSION[$P_nomb]);
		}
		else{
			return(NULL);
		}
		
	}
	
	/** 
	* Elimina variable de sesion, creada anteriormente
	* 
	* @param string $P_nomb Nombre de la variable a eliminar
	*/
	function destruirVariableSesion($P_nomb){

		if(isset($_SESSION[$P_nomb])):
			unset($_SESSION[$P_nomb]);	
		endif;
	}
	
	/**
	 * A function for making time periods readable
	 *
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     2.0.1
	 * @link        http://aidanlister.com/2004/04/making-time-periods-readable/
	 * @param       int     number of seconds elapsed
	 * @param       string  which time periods to display
	 * @param       bool    whether to show zero time periods
	 */
	function time_duration($seconds, $use = null, $zeros = false)
	{
    // Define time periods
    $periods = array (
        'years'     => 31556926,
        'Months'    => 2629743,
        'weeks'     => 604800,
        'days'      => 86400,
        'hours'     => 3600,
        'minutes'   => 60,
        'seconds'   => 1
        );
 
    // Break into periods
    $seconds = (float) $seconds;
    $segments = array();
    foreach ($periods as $period => $value) {
        if ($use && strpos($use, $period[0]) === false) {
            continue;
        }
        $count = floor($seconds / $value);
        if ($count == 0 && !$zeros) {
            continue;
        }
        $segments[strtolower($period)] = $count;
        $seconds = $seconds % $value;
    }
 
    // Build the string
    $string = array();
    foreach ($segments as $key => $value) {
        $segment_name = substr($key, 0, -1);
        $segment = $value . ' ' . $segment_name;
        if ($value != 1) {
            $segment .= 's';
        }
        $string[] = $segment;
    }
 
    return implode(', ', $string);
	}
	
} // Clase sesion 
?>