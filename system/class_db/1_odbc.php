<?php
/** 
* Class odbc
*/

class odbc{
	/**
	* @var string
	*/
	var $servidor;		
	
	/**
	* @var string
	*/
	var $usuario;
	
	/**
	* @var string
	*/
	var $clave;
	
	/**
	* @var string
	*/
	var $servidor_S;		
	
	/**
	* @var string
	*/
	var $usuario_S;
	
	/**
	* @var string
	*/
	var $clave_S;
	
	/**
	* @var string 
	*/
	var $nombreBD;
	
	/**
	* @var string
	*/
	var $tipoBD;
	
	/**
	* @var string
	*/
	var $err;
	
	/**
	* @var integer
	*/
	var $err_no;
	
	/**
	* @var resource 
	*/
	var $linkBD;		
	

	/** 
	* @access constructor
	* @param
	*/
	function odbc($P_Serv='M'){
		$this->servidor	= DB_HOST;
		$this->usuario	= DB_USER;
		$this->clave	= DB_PASS;
		
		$this->servidor_S = DB_HOST_S;
		$this->usuario_S  = DB_USER_S;
		$this->clave_S	  = DB_CLAVE_S;
		
		$this->nombreBD	= DB_NAME;
		$this->tipoBD	= DB_TIPO;
		
		$this->err_no	= 0;		
		
		$this->conectarBD($P_Serv);
		
		$this->seleccionarBD($this->nombreBD);
	}

	/** 
	* @param 
	* @return
	*/	
	function conectarBD($P_Serv){
		$this->err = ""; 
		$exito = false; 
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								if (DB_MODO == "SIMPLE"){
									$this->linkBD 	= @mysqli_connect($this->servidor, $this->usuario, $this->clave);
								} 							
								elseif (DB_MODO == "REPLICACION"){
									
									if ($P_Serv=='M'){
										$this->linkBD 	= @mysqli_connect($this->servidor, $this->usuario, $this->clave);
									} 
									elseif ($P_Serv=='S')	{
										$this->linkBD 	= @mysqli_connect($this->servidor_S, $this->usuario_S, $this->clave_S);
									}	
								}						
								
								if (!$this->linkBD){
									$this->err 	= "Ocurrio un error al conectar a la Base de Datos: MySql Dice ".mysqli_error($this->linkBD);
									$exito 		= false;
								} 
								else{
									$exito 		= true;
								}	
			break;
			

			case "oracle" 	:	
								
								if (DB_MODO == "SIMPLE"){
									$cadConeccion = '//'.$this->servidor.'/'.$this->nombreBD;
									$this->linkBD 	= @oci_connect($this->usuario, $this->clave, $cadConeccion);
								}						
								elseif (DB_MODO == "REPLICACION"){
									//??
									
								}						
								
								if (!$this->linkBD){
									$arrErr = oci_error();
									$this->err 	= "Ocurrio un error al conectar a la Base de Datos: Oracle Dice ".$arrErr['message'];
									$exito 		= false;
								} 
								else{
									$exito 		= true;
								}	
			break;
			
		}
		return ($exito);						
	} 
	
	/** 
	* @return Boolean
	*/
	function verificarConeccionBD(){
		$exito = false;
		
		if (!$this->linkBD){
			$exito=false;
			$this->err="No ha abierto una conexion a la base de datos ";
		}	
		else
			$exito=true;
		
		return($exito);	
		
	} 
	
	/** 
	* @return Boolean
	*/
	function desconectarBD(){
		$this->err = "";
		$exito = false;
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								if (!$this->verificarConeccionBD()){									
									$exito = false;
								}
								else{
									$exito = mysqli_close($this->linkBD);
									
									if (!$exito)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
								}									
			break;
			
			case "oracle" 	:	
								
								if (!$this->verificarConeccionBD()){									
									$exito = false;
								}
								
								else{
									$exito = oci_close($this->linkBD);
									
									
									if (!$exito){
										$arrErr = oci_error();
										$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
									}
								}									
			break;	
		}			
		return ($exito);									
	} 
	
	/** 
	* @param string 
	* @return Boolean
	*/
	function seleccionarBD($P_bd){
		$this->err = "";
		$exito = false;
		$this->nombreBD = $P_bd;
		
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								
								if ($this->verificarConeccionBD()){
									$exito = mysqli_select_db($this->linkBD,$this->nombreBD);
									
									if (!$exito)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
									
								} 
								else{
									$exito		= false;
								}									
			break;	
			
			case "oracle" 	:	
								if ($this->verificarConeccionBD()){
									$exito = true;									
								} 
								else{
									$exito		= false;
								}									
			break;	
		}			
		return ($exito);				
	}
	
	
} 