<?php
/**
 * Class
 */
class consultor extends funcionesDB {

	/**
	* @var resource 
	*/
	var $resource;
	
	/**
	* @var integer 
	*/
	var $totalFilas;
	
	/**
	* @var integer
	*/
	var $totalActual;
	
	/**
	* @var string 
	*/
	var $sql;
	
	/**
	* @var string
	*/
	var $agruparPor;
	
	/**
	* @var string 
	*/
	var $condicionHAVING;
	
	/**
	* @var string
	*/
	var $ordenCampo;
	
	/**
	* @var string 
	*/
	var $orden;
	
	/**
	* @var integer Inicio de donde empezar recordset (LIMIT)
	*/
	var $limInicio;
	
	/**
	* @var integer 
	*/
	var $limCuantos;
	
	/**
	* @var boolean 
	*/
	var $FOUNDROWS;
	
	/**
	* @var integer 
	*/
	var $totalFOUNDROWS;
	
	
	/** 
	* Constructor
	* @access constructor
	*/
	function consultor(){
		$this->funcionesDB('S');
		$this->totalFilas			= 0;
		$this->totalActual			= 0;
		$this->resource				= NULL;
		$this->sql					= "";
		$this->agruparPor			= "";
		$this->condicionHAVING		= "";
		$this->ordenCampo			= "";
		$this->orden				= "";
		$this->limInicio			= "";
		$this->limCuantos			= "";
		$this->FOUNDROWS			= false;
		$this->totalFOUNDROWS		= 0;
	}
	

	/** 
	* @param integer 
	* @param integer 
	* @param boolean 
	* @return void 
	*/
	function setearLimite($P_inicio, $P_cuantos, $P_FoundR=false){
		$this->limInicio			= $P_inicio;
		$this->limCuantos			= $P_cuantos;
		
		$this->FOUNDROWS			= $P_FoundR;
	}	
	
	/** 
	* @return void 
	*/
	function setearOrdenAsc(){
		$this->orden="ASC";
	}
	
	/**
	* 
	* @return void 
	*/
	function setearOrdenDesc(){
		$this->orden="DESC";
	}
	
	/** 
	* @param string 
	* @return void 
	*/
	function setearCamposOrder($P_campos){
		$this->ordenCampo=$P_campos;
	}
	
	/** 
	* @param string 
	* @param string|boolean 
	* @return void 
	*/	
	function setearCampoGrupos($P_Group, $P_Having=false){
		$this->agruparPor = $P_Group;
		
		if ($P_Having!=false){
			$this->condicionHAVING = $P_Having;
		}
		
	}
	

	function construirSentenciaSQL($P_Campos, $P_Tabla, $P_condicion, $P_addFR=false, $P_Union=false, $P_GenerarEnArchivo=""){
		$sql = "";
		
		if ($this->tipoBD == "oracle"){
			if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos)){
				$sql = "SELECT * FROM ( ";
			}
		}
		
		
		$sql .= "SELECT ";
		
		if ($P_addFR)
			$sql .= "SQL_CALC_FOUND_ROWS ";
		
		$sql .= $P_Campos;
		
		if ($P_Tabla != "")
			$sql .= " FROM ".$P_Tabla; 
		
		if ($P_condicion != "")
			$sql .= " WHERE ".$P_condicion; 
		
		if ($this->agruparPor != "")
			$sql .= " GROUP BY ".$this->agruparPor; 
		
		if ($this->condicionHAVING != "")
			$sql .= " HAVING ".$this->condicionHAVING; 
		
		if ($P_Union==false){
			if ($this->ordenCampo	!= ""){
				$sql .= " ORDER BY ".$this->ordenCampo; 
				
				if ($this->orden != "")
					$sql .= " ".$this->orden; 
			}
			
			if ($this->tipoBD == "mysql"){
				if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos))
					$sql .= " LIMIT ".$this->limInicio.", ".$this->limCuantos;
			}
			
	
			if ($P_GenerarEnArchivo != "")
				$sql .= " INTO OUTFILE '". $P_GenerarEnArchivo ."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n'";
		}
		
		if ($this->tipoBD == "oracle"){
			if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos)){
				$sql .= ") WHERE ROWNUM >= ". ($this->limInicio + 1) ." AND ROWNUM <= ".($this->limInicio+$this->limCuantos);
			}
		}
		
		return ($sql);	
	}
	

	function consultar($P_Campos, $P_Tabla="", $P_condicion="", $P_SQLUnion=false, $P_TypeUnion="ALL", $P_GenerarEnArchivo=false){
		$this->err = "";
		$exito = false;
		
		$addFR = $this->FOUNDROWS;
		
		if ($P_SQLUnion==false)
			$this->sql = $this->construirSentenciaSQL($P_Campos, $P_Tabla, $P_condicion, $addFR, false, $P_GenerarEnArchivo);
		elseif ($P_SQLUnion==true)
			$this->sql = $this->construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $addFR, $P_TypeUnion);
		
		switch ($this->tipoBD){
			case "mysql" 	:	
				if ($this->verificarConeccionBD()){
					$exito = mysqli_query($this->linkBD,$this->sql);
					
					if ($exito == false){
						$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error($this->linkBD);
					}  else { 
						
						$this->resource=$exito;										
						$this->totalFilas=mysqli_num_rows($exito);
						
					
						if($P_GenerarEnArchivo && $this->totalFilas>0){
							$this->sql = $this->construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $addFR, $P_TypeUnion, $P_GenerarEnArchivo);
							mysqli_query($this->linkBD,$this->sql);
						}
						
						$this->totalActual=$this->totalFilas;
						
						if ($this->FOUNDROWS){
							$q = "SELECT FOUND_ROWS();";
							$tFR = mysqli_query($this->linkBD,$q);
							
							if ($tFR != false){
								$rFR = mysqli_fetch_array($tFR);
								$this->totalFOUNDROWS = $rFR[0];
							}						
						}
						
					}		
				}
				else{
					$exito	= false;	
				}									
			break;
			
			case "oracle" 	:	
				if ($this->verificarConeccionBD()){
					$this->resource = ociparse($this->linkBD, $this->sql);
					$exito = oci_execute($this->resource);
					
					if ($exito == false){
						$arrErr = oci_error($this->resource);
						$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
					} 
					else{ 
						$subQ = 'SELECT COUNT(*) AS cantRow FROM ( '.$this->sql.' )';
						
						$tempRes = ociparse($this->linkBD, $subQ);
						$tempOpe = oci_execute($tempRes);
						$regT = oci_fetch_array($tempRes);
						
						$this->totalFilas= $regT['CANTROW'];

						$this->totalActual = $this->totalFilas;
						
					}		
				}
				else{
					$exito	= false;	
				}									
			break;
			
		}			
		return ($exito);				
	}	
	

	function verificarEjecucion(){
		$this->err = "";
		$exito = false;
		
		if ($this->resource == NULL){
			$exito = false;
			$this->err = "No se ha ejecutado ninguna consulta";
		}	
		else
			$exito = true;			
		return ($exito);				
	}	
	

	function extraerRegistro(){
		$this->err = "";
		$exito = false;
		
		switch ($this->tipoBD){
			case "mysql" 	:	
				if ($this->verificarConeccionBD()){
					if ($this->verificarEjecucion()){
						$exito	= mysqli_fetch_array($this->resource);
						
						$this->totalActual--; 
					}
					else{
						$exito	= false;
					}
				}
				else{
					$exito	= false;						
				}									
			break;
			
			case "oracle" 	:	
				if ($this->verificarConeccionBD()){
					if ($this->verificarEjecucion()){
						$exito	= oci_fetch_array($this->resource);
						
						$exito	= array_change_key_case($exito); 
						
						$this->totalActual--; 
					}
					else{
						$exito	= false;
					}
				}
				else{
					$exito	= false;						
				}									
			break;	
		}			
		return ($exito);				
	}	
	

	function volcarTotalRegistro(){
		$this->err = "";
		$exito = false;
		
		switch ($this->tipoBD){
			case "mysql" 	:
				if ($this->verificarConeccionBD()){
					
					if ($this->verificarEjecucion()){
						if ($this->totalFilas>0){
							$exito =  array();
							for ($i=0; $i<$this->totalFilas; $i++ ){
								$reg = $this->extraerRegistro();												
								$exito[] = $reg;
							}						
						}	
					}
					else{
						$exito	= false;
					}
				}
				else{
					$exito	= false;						
				}									
			break;
			
			case "oracle" 	:
				if ($this->verificarConeccionBD()){
					
					if ($this->verificarEjecucion()){
						if ($this->totalFilas>0){
							$exito =  array();
							for ($i=0; $i<$this->totalFilas; $i++ ){
								$reg = $this->extraerRegistro();												
								$exito[] = $reg;
							}						
						}	
					}
					else{
						$exito	= false;
					}
				}
				else{
					$exito	= false;						
				}									
			break;	
		}			
		return ($exito);				
	}

	function construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $P_addFR=false, $P_TypeUnion, $P_GenerarEnArchivo=false){
		$sql="";
		
		$totEl = count($P_Campos);
		
		for ($i=0; $i<$totEl; $i++){
			$sql .= "(";
			$FR = ($P_addFR===true AND $i==0)?true:false;	
			$sql .= $this->construirSentenciaSQL($P_Campos[$i], $P_Tabla[$i], $P_condicion[$i], $FR, true, false);
			
			$sql .= ($P_GenerarEnArchivo && $i+1 == $totEl)
				? " INTO OUTFILE '". $P_GenerarEnArchivo ."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n'"
				: "";
			
			$sql .= ")";
			
			$sql .= ($i+1 < $totEl) ? " UNION ".$P_TypeUnion." " : "";
		}
		
		if ($this->ordenCampo	!= ""){
			$sql .= " ORDER BY ".$this->ordenCampo; 
			
			if ($this->orden != "")
				$sql .= " ".$this->orden; 
		}
		
		if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos))
			$sql .= " LIMIT ".$this->limInicio.", ".$this->limCuantos; 
		
		return ($sql);	
	}
	
	

	function consultaRapida($P_Campos, $P_Tabla="", $P_condicion="", $P_SQLUnion=false, $P_TypeUnion="ALL", $P_GenerarEnArchivo=false){
		$resultOper = false;
		$resultArr = false;
		
		$resultOper = $this->consultar($P_Campos, $P_Tabla, $P_condicion, $P_SQLUnion, $P_TypeUnion, $P_GenerarEnArchivo);
		
		if ($this->totalFilas){
			$resultArr = $this->volcarTotalRegistro();
		}
		
		$exito = array (
			'sql' => $this->sql,
			'operacion' => $resultOper,
			'resultado' => $resultArr,
		);
		
		return ($exito);
	}
	
} 