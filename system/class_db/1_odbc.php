<?php
/** 
* Archivo de clase odbc
*/

/** 
* Clase que permite la abstracci�n de las conexiones a las base de datos.
* Primera clase de capa de base de datos. 
* Contiene par�metros y m�todos que manejan la conexi�n a las bases de datos de la aplicaci�n.
*
*/
class odbc{
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var string Contiene el servidor/host de la base de datos a conectarse 
	*/
	var $servidor;		
	
	/**
	* @var string Contiene el usuario que se utiliza para conectarse a la base de datos
	*/
	var $usuario;
	
	/**
	* @var string Contiene la clave/password que se utiliza para conectarse a la base de datos
	*/
	var $clave;
	
	/**
	* @var string Contiene el servidor/host SLAVE de la base de datos a conectarse 
	*/
	var $servidor_S;		
	
	/**
	* @var string Contiene el usuario que se utiliza para conectarse a la base de datos SLAVE
	*/
	var $usuario_S;
	
	/**
	* @var string Contiene la clave/password que se utiliza para conectarse a la base de datos SLAVE
	*/
	var $clave_S;
	
	/**
	* @var string Contiene el nombre de la base de datos a conectarse 
	*/
	var $nombreBD;
	
	/**
	* @var string Contiene el tipo de base de datos a conectarse. Hasta ahora solo esta implementado la codificaci�n para MySql
	*/
	var $tipoBD;
	
	/**
	* @var string Atributo que almacena cadena de error que devuelve el engine de la base de datos. En caso de que no exista la cadena estar� vac�a.
	*/
	var $err;
	
	/**
	* @var integer N�mero de error seg�n engine de base de datos
	*/
	var $err_no;
	
	/**
	* @var resource LINK RESOURCE de conexi�n de base de datos
	*/
	var $linkBD;		
	
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	/** 
	* Constructor de la clase odbc. 
	* Utilizando las constantes de conexi�n declaradas en el archivo de configuraci�n, realiza la conexi�n a la base de datos. 
	* @access constructor
	* @param Char(1) $P_Serv C�digo que define si se utiliza el servidor Master (Codigo 'M')  o el servidor Slave('S'), Valor por defecto 'M' 
	*/
	function odbc($P_Serv='M'){
		// Cargando a atributos de clase el valor de las constantes declaradas en el archivo de configuraci�n
		$this->servidor	= DB_HOST;
		$this->usuario	= DB_USER;
		$this->clave	= DB_PASS;
		
		$this->servidor_S = DB_HOST_S;
		$this->usuario_S  = DB_USER_S;
		$this->clave_S	  = DB_CLAVE_S;
		
		$this->nombreBD	= DB_NAME;
		$this->tipoBD	= DB_TIPO;
		
		// No hay errores hasta aqui
		$this->err_no	= 0;		
		
		// conectar a host base de datos
		$this->conectarBD($P_Serv);
		
		// Seleccionar base de datos del servidor
		$this->seleccionarBD($this->nombreBD);
	}
	
	////////////////////////////////////////////////////////////////////
	// M�todos
	///////////////////////////////////////////////////////////////////
	/** 
	* Conecta a la base de datos especificada en los atributos de la clase. Se recomienda hacer la llamada desde el constructor de la clase.
	* 
	* @param Char(1) $P_Serv C�digo que define si se utiliza el servidor Master (Codigo 'M')  o el servidor Slave('S'), Valor por defecto 'M' 
	* @return Boolean Retorna TRUE si pudo realizar la operaci�n o FALSE sino fue exitosa
	*/	
	function conectarBD($P_Serv){
		// variables		
		$this->err = ""; // error
		$exito = false;  // valor a retornar
		
		// Dependiendo del tipo de base de datos
		switch ($this->tipoBD){
			// Funciones para MYSQL
			case "mysql" 	:	
								// En caso de ser una configuraci�n de un solo servidor.
								if (DB_MODO == "SIMPLE"){
									$this->linkBD 	= @mysqli_connect($this->servidor, $this->usuario, $this->clave);
								} // En caso de ser una configuraci�n MASTER - SLAVE								
								elseif (DB_MODO == "REPLICACION"){
									// Conectar a master y almacenar LINK RESOURCE
									if ($P_Serv=='M'){
										$this->linkBD 	= @mysqli_connect($this->servidor, $this->usuario, $this->clave);
									} // Conectar a slave y almacenar LINK RESOURCE	
									elseif ($P_Serv=='S')	{
										$this->linkBD 	= @mysqli_connect($this->servidor_S, $this->usuario_S, $this->clave_S);
									}	
								}						
								
								// Si no se pudo establecer conexi�n a la BD, enviar error
								if (!$this->linkBD){
									$this->err 	= "Ocurrio un error al conectar a la Base de Datos: MySql Dice ".mysql_error();
									$exito 		= false;
								} // Caso contrario devolver TRUE
								else{
									$exito 		= true;
								}	
			break;
			
			// Funciones para ORACLE
			case "oracle" 	:	
								// En caso de ser una configuraci�n de un solo servidor.
								if (DB_MODO == "SIMPLE"){
									$cadConeccion = '//'.$this->servidor.'/'.$this->nombreBD;
									$this->linkBD 	= @oci_connect($this->usuario, $this->clave, $cadConeccion);
								} // En caso de ser una configuraci�n MASTER - SLAVE								
								elseif (DB_MODO == "REPLICACION"){
									// Por investigar
									
								}						
								
								// Si no se pudo establecer conexi�n a la BD, enviar error
								if (!$this->linkBD){
									$arrErr = oci_error();
									$this->err 	= "Ocurrio un error al conectar a la Base de Datos: Oracle Dice ".$arrErr['message'];
									$exito 		= false;
								} // Caso contrario devolver TRUE
								else{
									$exito 		= true;
								}	
			break;
			
		}
		return ($exito);						
	} // Metodo ConectarBD
	
	/** 
	* M�todo que verifica si existe conexi�n activa a Base de Datos.
	* 
	* @return Boolean Retorna TRUE si existe conexi�n a la BD o FALSE si no existe conexi�n
	*/
	function verificarConeccionBD(){
		// variable de retorno inicializada en FALSE
		$exito = false;
		
		//Verifica si existe LINK RESOURCE
		if (!$this->linkBD){
			$exito=false;
			$this->err="No ha abierto una conexion a la base de datos ";
		}	
		else
			$exito=true;
		
		return($exito);	
		
	} // Metodo verificarConeccionBD
	
	/** 
	* M�todo que cierra conexi�n activa a Base de Datos.
	* 
	* @return Boolean Retorna TRUE si pudo realizar la operaci�n o FALSE sino fue exitosa
	*/
	function desconectarBD(){
		// Inicializaci�n de variables 
		$this->err = "";
		$exito = false;
		
		// En base a tipo de base de datos, seleccionar sentencias a ejecutar
		switch ($this->tipoBD){
			case "mysql" 	:	
								// En caso de no haber conexi�n activa a la BD
								if (!$this->verificarConeccionBD()){									
									$exito = false;
								}
								// En caso de haber conexi�n activa a la BD
								else{
									$exito = mysql_close($this->linkBD);
									
									// Si ocurri� alg�n error registrar error
									if (!$exito)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysql_error();
								}									
			break;
			
			case "oracle" 	:	
								// En caso de no haber conexi�n activa a la BD
								if (!$this->verificarConeccionBD()){									
									$exito = false;
								}
								// En caso de haber conexi�n activa a la BD
								else{
									$exito = oci_close($this->linkBD);
									
									// Si ocurri� alg�n error registrar error
									if (!$exito){
										$arrErr = oci_error();
										$this->err 	= "Ha ocurrido un error. Oracle dice ".$arrErr['message'];
									}
								}									
			break;	
		}			
		return ($exito);									
	} // Metodo ConectarBD
	
	/** 
	* M�todo que selecciona Base de Datos de un Servidor de Base de Datos
	*
	* @param string $P_bd Nombre de la Base de datos a seleccionar
	* @return Boolean Retorna TRUE si pudo realizar la operaci�n o FALSE sino fue exitosa
	*/
	function seleccionarBD($P_bd){
		// declaraci�n de variables
		$this->err = "";
		$exito = false;
		$this->nombreBD = $P_bd;
		
		// Selecci�n de sentecias seg�n tipo de base de datos
		switch ($this->tipoBD){
			case "mysql" 	:	
								// Si existe conexi�n a Base de Datos activa
								if ($this->verificarConeccionBD()){
									// Selecciona base de datos
									$exito = mysqli_select_db($this->linkBD,$this->nombreBD);
									
									// En caso de error logear
									if (!$exito)
										$this->err 	= "Ha ocurrido un error. MySql dice ".mysql_error();
									
								} // Si no  hubo conexi�n devolver FALSE
								else{
									$exito		= false;
								}									
			break;	
			
			case "oracle" 	:	
								// Si existe conexi�n a Base de Datos activa
								if ($this->verificarConeccionBD()){
									// Selecciona base de datos
									$exito = true;									
								} // Si no  hubo conexi�n devolver FALSE
								else{
									$exito		= false;
								}									
			break;	
		}			
		return ($exito);				
	}//Metodo seleccionarBD
	
	
} // Clase ODBC 

?>