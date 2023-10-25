<?php
/** 
* Archivo de clase consultor
*/

/** 
* Clase que contiene metodos referentes a la realizaci�n de consultas (queries)  en la base de datos, 
* asi como la extracion de los resultados a variable php.
* Tercera clase de capa de base de datos. 
* Clase padre:  {@see funcionesDB}
*/
class consultor extends funcionesDB {
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var resource Puntero a archivo LINK RESOURCE que se crea cuando se realiza una consulta a la base de datos
	*/
	var $resource;
	
	/**
	* @var integer Total de Filas traidas por la consulta.
	*/
	var $totalFilas;
	
	/**
	* @var integer Cada vez que se extrae un registro de la Consulta con la funci�n extraerRegistro(), esta variable tiene el tracking de cuantos registros quedan en el Link Resource
	*/
	var $totalActual;
	
	/**
	* @var string Instruccion SQL generado clase por la funcion
	*/
	var $sql;
	
	/**
	* @var string Campos o columnas para aplicar GROUP BY
	*/
	var $agruparPor;
	
	/**
	* @var string Condiciones para aplicar en el HAVING
	*/
	var $condicionHAVING;
	
	/**
	* @var string Campos o columnas para aplicar ORDER BY
	*/
	var $ordenCampo;
	
	/**
	* @var string Orden del resultado de las consultas (DESC o ASC)
	*/
	var $orden;
	
	/**
	* @var integer Inicio de donde empezar recordset (LIMIT)
	*/
	var $limInicio;
	
	/**
	* @var integer Cantidad de registros a devolver en el recordset (LIMIT)
	*/
	var $limCuantos;
	
	/**
	* @var boolean Flag utilizado para habilitar SQL_FOUND_ROWS. Si el valor es TRUE solamente devolver� los registros delimitados en la secci�n LIMIT, el atributo $totalFOUNDROWS tendr� el total de registros de la consulta sin aplicar el LIMIT (Ideal para paginaci�n y queries grandes)
	*/
	var $FOUNDROWS;
	
	/**
	* @var integer En caso de que $FOUNDROWS sea TRUE, este contendr� el total de registros de una consulta sin el LIMIT
	*/
	var $totalFOUNDROWS;
	
	
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	/** 
	* Constructor de la clase consultor. 
	* Inicializa los atributos de la clase e instacia la clase padre. 
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
	
	////////////////////////////////////////////////////////////////////
	// M�todos
	///////////////////////////////////////////////////////////////////
	/** 
	* Setea los par�metros LIM para la consulta.
	* El LIM restringe el n�mero de registros que devuelve la consulta
	* 
	* @param integer $P_inicio Inicio de donde comenzar el recordset (LIM)
	* @param integer $P_cuantos N�mero de registros a devolver en el LIM
	* @param boolean $P_FoundR Flag que en caso de ser true activa el SQL_CALC_FOUND_ROWS en la consulta
	* @return void No tiene valor de retorno
	*/
	function setearLimite($P_inicio, $P_cuantos, $P_FoundR=false){
		$this->limInicio			= $P_inicio;
		$this->limCuantos			= $P_cuantos;
		
		$this->FOUNDROWS			= $P_FoundR;
	}	
	
	/** 
	* Setea los par�metros ORDER BY para que sea Ascendente
	* 
	* @return void No tiene valor de retorno
	*/
	function setearOrdenAsc(){
		$this->orden="ASC";
	}
	
	/** 
	* Setea los par�metros ORDER BY para que sea Descendente
	* 
	* @return void No tiene valor de retorno
	*/
	function setearOrdenDesc(){
		$this->orden="DESC";
	}
	
	/** 
	* Setea los campos/columnas de orden en la consulta (ORDER BY )
	* 
	* @param string $P_campos Cadena que contiene los campos de orden separados por coma
	* @return void No tiene valor de retorno
	*/
	function setearCamposOrder($P_campos){
		$this->ordenCampo=$P_campos;
	}
	
	/** 
	* Setea los campos/columnas de grupo en la consulta (GROUP BY )
	* 
	* @param string $P_Group Cadena que contiene los campos de agrupaci�n separados por coma
	* @param string|boolean $P_Having Cadena que contiene las condiciones a ubicar en el HAVING, en caso de no haber having ubicar false o no enviar par�metro
	* @return void No tiene valor de retorno
	*/	
	function setearCampoGrupos($P_Group, $P_Having=false){
		$this->agruparPor = $P_Group;
		
		if ($P_Having!=false){
			$this->condicionHAVING = $P_Having;
		}
		
	}
	
	/** 
	* Construye cadena SQL de la consulta, con los par�metros especificados.
	* 
	* @param string $P_Campos Cadena que contiene los campos a consultar
	* @param string $P_Tabla Cadena que contiene tabla a consultar
	* @param string $P_condicion Cadena que contiene condiciones de la consulta
	* @param boolean $P_addFR Flag que se�ala la utilizaci�n o no de SQL_CALC_FOUND_ROWS en la consulta
	* @param boolean $P_Union Flag que indica si la sentencia a construir es una UNION de sentencias SQL
	* @param string $P_GenerarEnArchivo Ruta y nombre del archivo donde se va a generar el archivo (en caso de que se quiera que la consulta se genere en un archivo)
	* @return string Cadena SQL construida
	*/	
	function construirSentenciaSQL($P_Campos, $P_Tabla, $P_condicion, $P_addFR=false, $P_Union=false, $P_GenerarEnArchivo=""){
		$sql = "";
		
		if ($this->tipoBD == "oracle"){
			// Seteando limite
			if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos)){
				$sql = "SELECT * FROM ( ";
			}
		}
		
		
		// Inicia SELECT
		$sql .= "SELECT ";
		
		// En caso de que se quiera usar SQL_CALC_FOUND_ROWS (Devuelve el total de registros sin importar el LIMIT)
		if ($P_addFR)
			$sql .= "SQL_CALC_FOUND_ROWS ";
		
		// Campo(s) a seleccionar
		$sql .= $P_Campos;
		
		// Tabla(s) a seleccionar
		if ($P_Tabla != "")
			$sql .= " FROM ".$P_Tabla; 
		
		// Condicion(es) a aplicar a la consulta
		if ($P_condicion != "")
			$sql .= " WHERE ".$P_condicion; 
		
		// Campos para aplicar un grupo
		if ($this->agruparPor != "")
			$sql .= " GROUP BY ".$this->agruparPor; 
		
		// Condici�n HAVING de grupo
		if ($this->condicionHAVING != "")
			$sql .= " HAVING ".$this->condicionHAVING; 
		
		// En caso de NO ser sentencia tipo  UNION
		if ($P_Union==false){
			// Campos a ordenar
			if ($this->ordenCampo	!= ""){
				$sql .= " ORDER BY ".$this->ordenCampo; 
				
				// Orden ASC o DESC
				if ($this->orden != "")
					$sql .= " ".$this->orden; 
			}
			
			if ($this->tipoBD == "mysql"){
				// Aplicando LIMIT
				if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos))
					$sql .= " LIMIT ".$this->limInicio.", ".$this->limCuantos;
			}
			
			// Aplicando sentencia para que resultado se grabe en una archivo tomando como separador de campos la , y como separador de registros el salto de l�nea. 
			if ($P_GenerarEnArchivo != "")
				$sql .= " INTO OUTFILE '". $P_GenerarEnArchivo ."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n'";
		}
		
		if ($this->tipoBD == "oracle"){
			// Seteando limite
			if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos)){
				$sql .= ") WHERE ROWNUM >= ". ($this->limInicio + 1) ." AND ROWNUM <= ".($this->limInicio+$this->limCuantos);
			}
		}
		
		// Retorna cadena construida SQL
		return ($sql);	
	}
	
	/** 
	* Funcion que realiza consulta a la base de datos especificada
	* 
	* @param string|array $P_Campos Cadena que contiene los campos a consultar.
	* @param string|array $P_Tabla Cadena que contiene tabla a consultar.
	* @param string|array $P_condicion Cadena que contiene condiciones de la consulta.
	* @param boolean $P_SQLUnion Flag que indica si la consulta se trata de una consulta tipo UNION .
	* @param boolean $P_TypeUnion Indica tipo de UNION. Valor por defecto ALL. Referir documentacion de MySql para mayor informaci�n.
	* @param boolean $P_GenerarEnArchivo Flag que valida si se genera (TRUE) o no (FALSE), la consulta en un archivo.
	* @return boolean Retorna TRUE si pudo ejecutar la consulta y FALSE si no se pudo ejecutar.
	*/
	function consultar($P_Campos, $P_Tabla="", $P_condicion="", $P_SQLUnion=false, $P_TypeUnion="ALL", $P_GenerarEnArchivo=false){
		// Inicializacion de cadena que detalla errores en objeto
		$this->err = "";
		// Inicializacion de parametro de retorno de la funcion
		$exito = false;
		
		// consultando flag en objeto que indica si se utiliza o no SQL_CALC_FOUND_ROWS 
		$addFR = $this->FOUNDROWS;
		
		// Construir cadena SQL a ejecutar
		if ($P_SQLUnion==false)
			$this->sql = $this->construirSentenciaSQL($P_Campos, $P_Tabla, $P_condicion, $addFR, false, $P_GenerarEnArchivo);
		elseif ($P_SQLUnion==true)
			$this->sql = $this->construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $addFR, $P_TypeUnion);
		
		// Usar funciones segun tipo de base de datos declarada
		switch ($this->tipoBD){
			// en caso de ser MySql
			case "mysql" 	:	
				if ($this->verificarConeccionBD()){
					//Ejecuta sentencia construida previamente
					$exito = mysqli_query($this->linkBD,$this->sql);
					
					// En caso de haber un error
					if ($exito == false){
						$this->err 	= "Ha ocurrido un error. MySql dice ";//.mysqli_connect_errno()();
					} 
					else{ // En caso de ser exitosa 
						// Graba apuntador a resource
						$this->resource=$exito;										
						// Se cargar total de filas
						$this->totalFilas=mysqli_num_rows($exito);
						
						// REVISAR
						if($P_GenerarEnArchivo && $this->totalFilas>0){
							$this->sql = $this->construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $addFR, $P_TypeUnion, $P_GenerarEnArchivo);
							mysqli_query($this->linkBD,$this->sql);
						}
						
						// Se cargar variable donde se trackea cuantas filas que despues de extraer registro (mysql_fetch_array)
						$this->totalActual=$this->totalFilas;
						
						// Si se utiliza SQL_CALC_FOUND_ROWS 					
						if ($this->FOUNDROWS){
							// Ejecutar SQL: SELECT FOUND_ROWS(); ... el cual trae el numero de filas de la consulta anterior sin el LIMIT
							$q = "SELECT FOUND_ROWS();";
							$tFR = mysqli_query($this->linkBD,$q);
							
							if ($tFR != false){
								$rFR = mysqli_fetch_array($tFR);
								// Variable en la clase que contiene numero de ROWS sin el Limite
								$this->totalFOUNDROWS = $rFR[0];
							}						
						}
						
					}		
				}
				else{
					// no hubo conexi�n a la base de datos
					$exito	= false;	
				}									
			break;
			
			// en caso de ser ORACLE
			case "oracle" 	:	
				if ($this->verificarConeccionBD()){
					//Ejecuta sentencia construida previamente
					$this->resource = ociparse($this->linkBD, $this->sql);
					$exito = oci_execute($this->resource);
					
					// En caso de haber un error
					if ($exito == false){
						$arrErr = oci_error($this->resource);
						$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
					} 
					else{ // En caso de ser exitosa 
						// Se cargar total de filas
						//$subQ = explode(' FROM ', $this->sql);
						$subQ = 'SELECT COUNT(*) AS cantRow FROM ( '.$this->sql.' )';
						
						$tempRes = ociparse($this->linkBD, $subQ);
						$tempOpe = oci_execute($tempRes);
						$regT = oci_fetch_array($tempRes);
						
						$this->totalFilas= $regT['CANTROW'];
						
						// REVISAR
						/*
						if($P_GenerarEnArchivo && $this->totalFilas>0){
							$this->sql = $this->construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $addFR, $P_TypeUnion, $P_GenerarEnArchivo);
							mysql_query($this->sql, $this->linkBD);
						}
						*/
						
						// Se cargar variable donde se trackea cuantas filas que despues de extraer registro (mysql_fetch_array)
						$this->totalActual = $this->totalFilas;
						
						// Si se utiliza SQL_CALC_FOUND_ROWS 					
						/* POR INVESTIGAR
						if ($this->FOUNDROWS){
							// Ejecutar SQL: SELECT FOUND_ROWS(); ... el cual trae el n�mero de filas de la consulta anterior sin el LIMIT
							$q = "SELECT FOUND_ROWS();";
							$tFR = mysql_query($q);
							
							if ($tFR != false){
								$rFR = mysql_fetch_array($tFR);
								// Variable en la clase que contiene n�mero de ROWS sin el L�mite
								$this->totalFOUNDROWS = $rFR[0];
							}						
						}
						*/
						
					}		
				}
				else{
					// no hubo conexi�n a la base de datos
					$exito	= false;	
				}									
			break;
			
		}			
		return ($exito);				
	}	
	
	/** 
	* Verifica si se llev� a cabo la ejecucipon de de un SQL
	* 
	* @return boolean Retorna TRUE si pudo ejecutar la consulta y FALSE si no se pudo ejecutar.
	*/
	function verificarEjecucion(){
		$this->err = "";
		$exito = false;
		
		//Verifica si existe alg�n resource
		if ($this->resource == NULL){
			$exito = false;
			$this->err = "No se ha ejecutado ninguna consulta";
		}	
		else
			$exito = true;			
		return ($exito);				
	}	
	
	/** 
	* Extrae UN registro de los resultados devueltos en la consulta  en un array
	* 
	* @return array|boolean Retorna arreglo de valores, en caso de no quedar m�s registros retorna FALSE
	*/
	function extraerRegistro(){
		$this->err = "";
		$exito = false;
		
		// ejecutar c�digo dependiendo de tip de base de datos
		switch ($this->tipoBD){
			case "mysql" 	:	
				// Verificar si existe una conexi�n a la Base de Datos
				if ($this->verificarConeccionBD()){
					// Verifica si se ha ejecutado alg�n c�digo
					if ($this->verificarEjecucion()){
						// Extrae registro
						$exito	= mysqli_fetch_array($this->resource);
						
						// Disminuye contadro de registros en el resource
						$this->totalActual--; 
					}
					else{
						// No se pudo extraer registro
						$exito	= false;
					}
				}
				else{
					// No se pudo extraer registro
					$exito	= false;						
				}									
			break;
			
			case "oracle" 	:	
				// Verificar si existe una conexi�n a la Base de Datos
				if ($this->verificarConeccionBD()){
					// Verifica si se ha ejecutado alg�n c�digo
					if ($this->verificarEjecucion()){
						// Extrae registro
						$exito	= oci_fetch_array($this->resource);
						
						$exito	= array_change_key_case($exito); 
						
						// Disminuye contadro de registros en el resource
						$this->totalActual--; 
					}
					else{
						// No se pudo extraer registro
						$exito	= false;
					}
				}
				else{
					// No se pudo extraer registro
					$exito	= false;						
				}									
			break;	
		}			
		return ($exito);				
	}	
	
	/** 
	* Extrae TODOS los registros resultados de una consulta en un array
	* NOTA: Se debe tener precauci�n cuando los resultados son demasiados grandes, ya que PHP tiene un l�mite de MEMORIA y si el resultado 
	* es muy grande �ste arrojar� un error de memmory allocation
	* 
	* @return array|boolean Retorna arreglo de valores, en caso de no quedar m�s registros retorna FALSE
	*/
	function volcarTotalRegistro(){
		// Inicializaci�n de variables 
		$this->err = "";
		$exito = false;
		
		//Depenciendo del tipo de base de datos ejecutar c�digo de PHP
		switch ($this->tipoBD){
			case "mysql" 	:
				// Verificar que existe una conexi�n
				if ($this->verificarConeccionBD()){
					
					//Verificar que se haya realizado una consulta
					if ($this->verificarEjecucion()){
						//Verificar que la consulta haya arrojado resultados
						if ($this->totalFilas>0){
							// Cargando resultado en array
							$exito =  array();
							for ($i=0; $i<$this->totalFilas; $i++ ){
								$reg = $this->extraerRegistro();												
								$exito[] = $reg;
							}						
						}	
					}
					else{
						// No se realiz� la operaci�n
						$exito	= false;
					}
				}
				else{
					// No se realiz� la operaci�n
					$exito	= false;						
				}									
			break;
			
			case "oracle" 	:
				// Verificar que existe una conexi�n
				if ($this->verificarConeccionBD()){
					
					//Verificar que se haya realizado una consulta
					if ($this->verificarEjecucion()){
						//Verificar que la consulta haya arrojado resultados
						if ($this->totalFilas>0){
							// Cargando resultado en array
							$exito =  array();
							for ($i=0; $i<$this->totalFilas; $i++ ){
								$reg = $this->extraerRegistro();												
								$exito[] = $reg;
							}						
						}	
					}
					else{
						// No se realiz� la operaci�n
						$exito	= false;
					}
				}
				else{
					// No se realiz� la operaci�n
					$exito	= false;						
				}									
			break;	
		}			
		return ($exito);				
	}//volcarTotalRegistro
	
	/** 
	* Construye cadena SQL de la consulta tipo UNION, con los par�metros especificados.
	* 
	* @param array $P_Campos Cadena que contiene los campos a consultar
	* @param array $P_Tabla Cadena que contiene tabla a consultar
	* @param array $P_condicion Cadena que contiene condiciones de la consulta
	* @param boolean $P_addFR Flag que se�ala la utilizaci�n o no de SQL_CALC_FOUND_ROWS en la consulta
	* @param boolean $P_TypeUnion Indica tipo de UNION. Valor por defecto ALL. Referir documentaci�n de MySql para mayor informaci�n.
	* @param string $P_GenerarEnArchivo Ruta y nombre del archivo donde se va a generar el archivo (en caso de que se quiera que la consulta se genere en un archivo)
	* @return string Retorna cadena SQL de la consulta.
	*/	
	function construirUnionSql($P_Campos, $P_Tabla, $P_condicion, $P_addFR=false, $P_TypeUnion, $P_GenerarEnArchivo=false){
		// Inicializaci�n de  variables
		$sql="";
		
		// Contar cuantos arreglos de consultas se han enviado
		$totEl = count($P_Campos);
		
		// Recorrer el arreglo de consultas 
		for ($i=0; $i<$totEl; $i++){
			// Construyendo SQL
			$sql .= "(";
			$FR = ($P_addFR===true AND $i==0)?true:false;	
			$sql .= $this->construirSentenciaSQL($P_Campos[$i], $P_Tabla[$i], $P_condicion[$i], $FR, true, false);
			
			// REVISAR ****************
			$sql .= ($P_GenerarEnArchivo && $i+1 == $totEl)
				? " INTO OUTFILE '". $P_GenerarEnArchivo ."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n'"
				: "";
			// REVISAR ****************
			
			$sql .= ")";
			
			$sql .= ($i+1 < $totEl) ? " UNION ".$P_TypeUnion." " : "";
		}
		
		// Aplicando Campos de Orden
		if ($this->ordenCampo	!= ""){
			$sql .= " ORDER BY ".$this->ordenCampo; 
			
			//Aplicando ASC o DESC
			if ($this->orden != "")
				$sql .= " ".$this->orden; 
		}
		
		// Aplicando LIMIT
		if (is_numeric($this->limInicio) AND is_numeric($this->limCuantos))
			$sql .= " LIMIT ".$this->limInicio.", ".$this->limCuantos; 
		
		// Retornar SQL
		return ($sql);	
	}
	
	
	/** 
	* 
	* 
	* @param string|array $P_Campos Cadena que contiene los campos a consultar.
	* @param string|array $P_Tabla Cadena que contiene tabla a consultar.
	* @param string|array $P_condicion Cadena que contiene condiciones de la consulta.
	* @param boolean $P_SQLUnion Flag que indica si la consulta se trata de una consulta tipo UNION .
	* @param boolean $P_TypeUnion Indica tipo de UNION. Valor por defecto ALL. Referir documentaci�n de MySql para mayor informaci�n.
	* @param boolean $P_GenerarEnArchivo Flag que se�ala si se genera (TRUE) o no (FALSE), la consulta en un archivo.
	* @return boolean Retorna TRUE si pudo ejecutar la consulta y FALSE si no se pudo ejecutar.
	*/
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
	
} // Clase consultor 
?>