<?php
/** 
* Archivo de clase sesion
* Contiene las variables y constantes de sesion
* S.A.D
*/
class sesion{
	/**
	* @var integer
	*/
	var $life_time;

	
	/**
	* 
	* @access constructor
	*/
	function sesion(){
		$flagConex = false;
		
		$objODBC = new odbc('M');
		$flagConex = (empty($objODBC->err)) ? $objODBC->linkBD : false;
		
		if ($flagConex){
			$this->life_time = get_cfg_var("session.gc_maxlifetime");
				$this->iniciarSesion();
		}
		
		return ($flagConex);
		
	}
	
	
	/** 
	* 
	* @return boolean Retorna TRUE
	*/
	function abrir( $save_path, $session_name){
		$this->gc();
		return true;
	}
	
	/** 
	* @return boolean Retorna TRUE
	*/
	function cerrar(){
		return true;
	}
	
	/** 
	* 
	* @param string 
	* @return string 
	*/
	function leer($id){
		$objConsultor = new consultor();
		
        $data = '';
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
		return $data;
	}
	
	/** 
	* @param string
	* @param string 
	* @return boolean Return TRUE
	*/
	function escribir($id, $data){
		$objEjecSQL = new ejecutorSQL();
		
		$time 		= time() * (7 * 24 * 60 * 60);
		$newid 		= mysql_real_escape_string($id);
		$newdata 	= mysql_real_escape_string($data);
		
		$dta		=	$this->consultarIdSesion();
		$objCons 	=  	new consultor;

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
	* @param string
	* @return boolean
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
	* Metodo
	* @return boolean
	*/
	function gc() {
		
		$objEjecSQL = new ejecutorSQL();
		
		$newid = mysql_real_escape_string(@$id);
		
		$tbl = "ad_session";
		$whr = "expires < UNIX_TIMESTAMP()";		
		
		$objEjecSQL->borrarRegistro($tbl, $whr);
		
		// Always return TRUE
        return true;
	}
	
	/**
	*/
	function iniciarSesion(){
	 	@session_start();
	}
	
	/** 
	* 
	*/
	function terminarSesion(){
	 	@session_destroy();
		
	}
	
	/** 
	* 
	* @return string
	*/
	function consultarIdSesion(){
		return (@session_id());	
	}
	
	/** 
	* @param string 
	* @param string
	*/
	function registrarVariableSesion($P_nomb, $P_valor){
		$_SESSION[$P_nomb] = $P_valor;	
	}
	
	/** 
	* @param string
	* @return string
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
	* @param string
	*/
	function destruirVariableSesion($P_nomb){

		if(isset($_SESSION[$P_nomb])):
			unset($_SESSION[$P_nomb]);	
		endif;
	}
	
	/**
	 * @author     
	 * @version    
	 * @link       
	 * @param       int   
	 * @param       string
	 * @param       bool 
	 */
	function time_duration($seconds, $use = null, $zeros = false)
	{
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
	
}
?>