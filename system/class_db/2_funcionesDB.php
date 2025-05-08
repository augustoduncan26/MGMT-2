<?php
/** 
* Archivo de clase funcionesDB
*/

/** 
* Clase que contiene funciones comunes utilizadas en el lenguaje de base de datos.
* Segunda clase de capa de base de datos. 
* Contiene metodos y funciones varias en la capa de base de datos
* Clase padre:  {@see odbc}
*/
class funcionesDB extends odbc{
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var string Instruccion SQL generado ejecutado por la funcion
	*/
	var $sql;		
	
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	/** 
	* Constructor de la clase funcionesDB. 
	* Instancia la clase padre . 
	* @access constructor
	* @param Char(1) $P_Serv Codigo que define si se utiliza el servidor Master (Codigo 'M')  o el servidor Slave('S'), Valor por defecto 'M' 
	*/
	function funcionesDB($P_Serv='M'){
		// instanciar clase padre
		$this->odbc($P_Serv);
	}
	
	////////////////////////////////////////////////////////////////////
	// Metodos
	///////////////////////////////////////////////////////////////////
	/** 
	* Ordena al servidor de base  de datos BLOQUEAR la tabla indicada para el flujo actual.
	* Tener en cuenta que se realizara COMMIT a cualquier operacion transaccional iniciada en la tabla
	* 
	* @param Char(1) $tabla Tabla de la base de datos a bloquear 
	* @return Boolean Retorna TRUE si pudo realizar la operacion o FALSE sino fue exitosa
	*/
	function BloquearTabla($tabla){
		$exito = false;
		$this->err = ""; // error. Atributo de objeto padre
		
		// verificando si existe conexion
		if ($this->verificarConeccionBD()){
			// Segun el tipo de base de datos ejecutar codigo respectivo
			switch ($this->tipoBD){
				case "mysql" 	:
									$this->sql="LOCK TABLES ".$tabla." WRITE"; // SQL a ejecutar
									
									$exito = mysqli_query($this->linkBD,$this->sql);	
									if (!$exito){
										$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error($this->linkBD);
									}
				break;
				
				case "oracle" 	:
									$this->sql="LOCK TABLE ".$tabla." IN EXCLUSIVE MODE"; // SQL a ejecutar
									
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
	* Ordena al servidor de base  de datos liberar tablas BLOQUEADAS ANTERIORMENTE.
	* 
	* @return Boolean Retorna TRUE si pudo realizar la operacion o FALSE sino fue exitosa
	*/
	function DesbloquearTabla(){
		$exito = false;
		$this->err = ""; // error. Atributo de objeto padre
		
		// verificando si existe conexion
		if ($this->verificarConeccionBD()){
			// Segun el tipo de base de datos ejecutar codigo respectivo
			switch ($this->tipoBD){
				case "mysql" 	:
									$this->sql = "UNLOCK TABLES"; // SQL a ejecutar
									$exito = mysqli_query($this->linkBD,$this->sql);	
									if (!$exito){
										$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error($this->linkBD);
									}
				break;
				
				case "oracle" 	:
									// En ORACLE el bloqueo se mantiene hasta realizar un COMMIT
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
	* Ejecuta comando SQL para obtener Fecha del servidor de base de datos
	* 
	* @return string|Boolean Retorna la cadena de la fecha (Formato YYYY-MM-DD)  si se pudo realizar la operacion o FALSE sino fue exitosa
	*/
	function FechaHoy(){
		// Blanqueando variable de error
		$this->err = "";
		
		// Segun el tipo de base de datos ejecutar codigo respectivo
		switch ($this->tipoBD){
			case "mysql" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT CURDATE() AS hoy";
									
									// Ejecutando SQL
									$tab = mysqli_query($this->linkBD,$sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysql_error();
									else
										//$reg = mysql_fetch_array($tab);	
										$reg = mysqli_fetch_array($tab);	
								}
			break;
			
			case "oracle" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD') AS hoy FROM dual";
									
									// Ejecutando SQL
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
	} // Metodo FechaHoy
	
	/** 
	* Ejecuta comando SQL para obtener Fecha del servidor de base de datos
	* 
	* @return string|Boolean Retorna la cadena de la fecha (Formato YYYY-MM-DD HH:MM:SS) si se pudo realizar la operacion o FALSE sino fue exitosa
	*/
	function FechaAhora(){
		// Blanqueando variable de error
		$this->err = "";
		
		// Segun el tipo de base de datos ejecutar codigo respectivo
		switch ($this->tipoBD){
			case "mysql" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT NOW() AS ahora";
									
									// Ejecutando SQL
									$tab = mysqli_query($this->linkBD, $sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
									else
										//$reg = mysql_fetch_array($tab);	
										$reg = mysqli_fetch_array($tab);	
								}
			break;
			
			case "oracle" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD HH:MI:SS') AS ahora FROM dual";
									
									// Ejecutando SQL
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
	} // Metodo FechaAhora
	
	/** 
	* Ejecuta comando SQL para realizar operacion de suma de fechas del servidor de base de datos
	* 
	* @param string $P_Fecha fecha a la cual se aplicara suma
	* @param integer $P_cantidad Cantidad a sumar
	* @param Char(1) $P_Intervalo En mysql ... intervalos de la operacion (días, meses, años)
	* @return string|Boolean Retorna la cadena de la fecha (Formato YYYY-MM-DD   si se pudo realizar la operacion o FALSE sino fue exitosa
	*/
	function FechaSumar($P_Fecha, $P_cantidad, $P_Intervalo){
		// Blanqueando variable de error
		$this->err = "";
		
		// Segun el tipo de base de datos ejecutar codigo respectivo
		switch ($this->tipoBD){
			case "mysql" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT DATE_ADD('".$P_Fecha."', INTERVAL ".$P_cantidad." ".$P_Intervalo.") AS fechaRes";
									
									// Ejecutando SQL
									$tab = mysqli_query($this->linkBD,$sql);
									
									if (!$tab)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
									else{
										//$reg = mysql_fetch_array($tab);
										$reg = mysqli_fetch_array($tab);
										
									}	
								}
			break;
			
			case "oracle" 	:	
								// Verificando conexion a Base de Datos
								if ($this->verificarConeccionBD()){
									// SQL a ejecutar
									$sql = "SELECT TO_CHAR(to_date('".$P_Fecha."', 'YYYY-MM-DD') + INTERVAL '".$P_cantidad."' ".$P_Intervalo.", 'YYYY-MM-DD') AS fechaRes FROM dual";
									
									// Ejecutando SQL
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
	} // Metodo FechaSumar
	
} // Clase funcionesDB 

?>