<?php

class funcionesDB extends odbc{
	
	/**
	* @var string
	*/
	var $sql;		
	
	
	/** 
	* @access constructor
	* @param Char(1) 
	*/
	function funcionesDB($P_Serv='M'){
		$this->odbc($P_Serv);
	}
	
	
	/** 
	* @param 
	* @return Boolean
	*/
	function BloquearTabla($tabla){
		$exito = false;
		$this->err = "";
		
		if ($this->verificarConeccionBD()){
			switch ($this->tipoBD){
				case "mysql" 	:
									$this->sql="LOCK TABLES ".$tabla." WRITE";
									
									$exito = mysqli_query($this->linkBD,$this->sql);	
									if (!$exito){
										$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error($this->linkBD);
									}
				break;
				
				case "oracle" 	:
									$this->sql="LOCK TABLE ".$tabla." IN EXCLUSIVE MODE";
									
									$resc = ociparse($this->linkBD, $this->sql);
									$exito = oci_execute($resc);
									
									if (!$exito){
										$arrErr = oci_error($resc);
										$this->err = $arrErr['message']; 
									}
				break;
			}
		}
		else{
			$this->err = "No se esta conectado a una base de datos"; 
		}
		
		return ($exito);
	}
	
	/** 
	* @return Boolean
	*/
	function DesbloquearTabla(){
		$exito = false;
		$this->err = ""; 
		
		if ($this->verificarConeccionBD()){
			switch ($this->tipoBD){
				case "mysql" 	:
									$this->sql = "UNLOCK TABLES"; 
									$exito = mysqli_query($this->linkBD,$this->sql);	
									if (!$exito){
										$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error($this->linkBD);
									}
				break;
				
				case "oracle" 	:
									$exito = oci_commit($this->linkBD);
				break;
			}
		}
		else{
			$this->err = "No se esta conectado a una base de datos"; 
		}
		
		return ($exito);
	}
	
	/** 
	* @return string|Boolean
	*/
	function FechaHoy(){
		$this->err = "";
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT CURDATE() AS hoy";
									
									$tab = mysqli_query($this->linkBD,$sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysql_error();
									else
										$reg = mysqli_fetch_array($tab);	
								}
			break;
			
			case "oracle" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD') AS hoy FROM dual";
									
									$resc = ociparse($this->linkBD, $sql);
									$tab = oci_execute($resc);
									
									if (!$tab){
										$arrErr = oci_error($resc);
										$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
									}
									else{
										$reg = oci_fetch_array($resc);
										$reg['hoy'] = $reg['HOY'];									
									}
								}
			break;	
		}			
		
		return ($reg['hoy']);				
	} 
	
	/** 
	* @return string|Boolean
	*/
	function FechaAhora(){
		$this->err = "";
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT NOW() AS ahora";
									
									$tab = mysqli_query($this->linkBD, $sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
									else
										$reg = mysqli_fetch_array($tab);	
								}
			break;
			
			case "oracle" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD HH:MI:SS') AS ahora FROM dual";
									
									$resc = ociparse($this->linkBD, $sql);
									$tab = oci_execute($resc);
									
									if (!$tab){
										$arrErr = oci_error($resc);
										$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
									}
									else{
										$reg = oci_fetch_array($resc);
										$reg['ahora'] = $reg['AHORA'];									
									}
								}
			break;
		}			
		
		return ($reg['ahora']);				
	}
	
	/** 
	* @param string 
	* @param integer 
	* @param 
	* @return string|Boolean
	*/
	function FechaSumar($P_Fecha, $P_cantidad, $P_Intervalo){
		$this->err = "";
		
		switch ($this->tipoBD){
			case "mysql" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT DATE_ADD('".$P_Fecha."', INTERVAL ".$P_cantidad." ".$P_Intervalo.") AS fechaRes";
									
									$tab = mysqli_query($this->linkBD,$sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
									else{
										$reg = mysqli_fetch_array($tab);
										
									}	
								}
			break;
			
			case "oracle" 	:	
								if ($this->verificarConeccionBD()){
									$sql = "SELECT TO_CHAR(to_date('".$P_Fecha."', 'YYYY-MM-DD') + INTERVAL '".$P_cantidad."' ".$P_Intervalo.", 'YYYY-MM-DD') AS fechaRes FROM dual";
									
									$resc = ociparse($this->linkBD, $sql);
									$tab = oci_execute($resc);
									
									if (!$tab){
										$arrErr = oci_error($resc);
										$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
									}
									else{
										$reg = oci_fetch_array($resc);
										$reg['fechaRes'] = $reg['FECHARES'];									
									}
								}
			break;
			
		}			
		
		return ($reg['fechaRes']);				
	}
	
}