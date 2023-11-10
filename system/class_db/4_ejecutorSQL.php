<?php
/** 
* class ejecutorSQL
*
* Capa de DB. 
* Clase padre:  {@see funcionesDB}
*/
class ejecutorSQL extends funcionesDB{
	/**
	* @var string Instruction SQL
	*/
	var $sql;
	
	/**
	* @var integer AUTO_INCREMENT
	*/
	var $generado;
	
	/**
	* @var integer
	*/
	var $numRegAfectados;
	
	//*************
	// Constructor
	//*************
	/** 
	* Constructor ejecutorSQL. 
	* @access constructor
	*/
	function ejecutorSQL(){
		$this->funcionesDB('M');
		$this->sql = "";
		$this->generado="";
		$this->numRegAfectados=0;
	}
	
	////////////////////////////////////////////////////////////////////
	// Metodos
	///////////////////////////////////////////////////////////////////
	/** 
	* Declara inicio de Bloque de Transacciones
	* 
	* @return boolean Return TRUE or FALSE
	*/
    function IniciarTran(){
		$exito = false;
		switch ($this->tipoBD){
			// mysql
			case "mysql":
				if ($this->verificarConeccionBD()){
					$exito = mysqli_query("BEGIN");
				}
				
			break;
		}
		return ($exito);
	}
	
	/** 
	* Transaction COMMIT
	* 
	* @return boolean Retorna TRUE si se pudo realizar la consulta, FALSE en caso contrario.
	*/
    function CompletarTran(){
		$exito = false;
		switch ($this->tipoBD){
			// mysql
			case "mysql" 	:
				if ($this->verificarConeccionBD())
					$exito = mysqli_query("COMMIT");
			break;
		}
		
		return ($exito);
	}
	
	/** 
	* ROLLBACK
	* 
	* @return boolean Return TRUE or FALSE
	*/
    function DeshacerTran(){
		$exito = false;
		switch ($this->tipoBD){
			// mysql
			case "mysql":
				if ($this->verificarConeccionBD())
					$exito = mysqli_query("ROLLBACK");
			break;	
		}
		
		return ($exito);
	}
	
	/** 
	* Delete all rows in table
	* 
	* @param string $P_Tabla String
	* @return boolean Return TRUE or FALSE
	*/
	function vaciarTabla($P_Tabla){
		$this->err = "";
		$exito = false;
		
		// SQL a ejecutar
		$sql = "TRUNCATE TABLE ".$P_Tabla;
		$this->sql = $sql; 
		
		switch ($this->tipoBD){
			// mysql
			case "mysql" 	:
				if ($this->verificarConeccionBD()){
					// ejecutando SQL
					$exito = mysqli_query($this->linkBD,$sql);
					
					// If error
					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
						$this->err_no = mysqli_errno($this->linkBD);
					}
					else{
						// AUTO INCREMENT
						$sql = "ALTER TABLE ".$P_Tabla." AUTO_INCREMENT = 0";
						$exito = mysqli_query($this->linkBD,$sql);
						
						// If error
						if (!$exito){
							$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
						}
					}								
				}
				else{
					$exito	= false;						
				}									
			break;	
		}
		
		return ($exito);				
	}//Delete all rows

	/** 
	* Insert row
	* 
	* @param string $P_Tabla : Table Name
	* @param string $P_Campos : Columns
	* @param string $P_Valores : Values
	* @return boolean Return TRUE or FALSE
	*/
	function insertarRegistro($P_Tabla, $P_Campos, $P_Valores){

		$this->err = "";
		$exito = false;
		
		// SQL String
		$sql = "INSERT INTO ".$P_Tabla." ( ".$P_Campos." ) VALUES ( ".$P_Valores." )";
		
		$this->sql = $sql;  
	
		switch ($this->tipoBD){
			// mysql
			case "mysql" 	:
			if ($this->verificarConeccionBD()){ 
				// exec
				$exito = mysqli_query($this->linkBD, $sql) or die(mysqli_error($this->linkBD)); //or die(mysqli_connect_error($this->linkBD));
				
				// error
				if (!$exito){
					$this->err 		= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					$this->generado = 0;										
					$this->err_no 	= mysqli_errno($this->linkBD);
				}
				else{ 
					// Insert id
					$this->generado = mysqli_insert_id($this->linkBD);
					$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
				}
			}
			else{
				// error
				$exito	= false;
			}									
			break;	
		}		

		return ($exito);				
	}//Insert row
	
	/** 
	* Replace row
	* 
	* @param string $P_Tabla : Table name
	* @param string $P_Campos : Columns
	* @param string $P_Valores : Values
	* @return boolean Return TRUE or FALSE
	*/
	function remplazarRegistro($P_Tabla, $P_Campos, $P_Valores){
		$this->err = "";
		$exito = false;
		
		// SQL String
		$sql = "REPLACE ".$P_Tabla." ( ".$P_Campos." ) VALUES ( ".$P_Valores." )";
	
		$this->sql = $sql;  
		
		switch ($this->tipoBD){
			// mysql
			case "mysql" 	:	
				// validate connection
				if ($this->verificarConeccionBD()){
					// sql command
					$exito = mysqli_query($this->linkBD,$sql);
					
					// error
					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
						$this->generado = 0;										
						$this->err_no = mysqli_errno($this->linkBD);
					}
					else{
						$this->generado = mysqli_insert_id($this->linkBD);
						$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
					}
				}
				else{
					// error
					$exito	= false;
				}									
			break;	
		}			
		return ($exito);				
	}//Replace row
	
	
	/** 
	* Delete row
	* 
	* @param string $P_Tabla : Table name
	* @param string $P_condicion : Condition
	* @return boolean Return TRUE or FALSE
	*/
	function borrarRegistro($P_Tabla, $P_condicion){
		$this->err = "";
		$exito = false;
		
		// Query SQL
		$sql = "DELETE FROM ".$P_Tabla." WHERE ".$P_condicion;
		$this->sql = $sql; 

		switch ($this->tipoBD){

			case "mysql" 	:	
				if ($this->verificarConeccionBD()){
					// Exec SQL
					$exito = mysqli_query($this->linkBD,$sql);
					
					// error
					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					}
					else{
						$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
					}
				}
				else{
					// error or false
					$exito	= false;
				}
			break;
		}			
		return ($exito);
	}
	
	/** 
	* Update row(s)
	* 
	* @param string $P_Valores : Values, exampe: row1=value1, row2=value2 
	* @param string $P_Tabla : Table name
	* @param string $P_condicion : Conditions
	* @return boolean Return TRUE or FALSE
	*/
	function actualizarRegistro($P_Valores, $P_Tabla, $P_condicion){
		$this->err = "";
		$exito = false;
		
		// SQL Query
		$sql = "UPDATE ".$P_Tabla." SET ".$P_Valores." WHERE ".$P_condicion;		
		$this->sql = $sql;

		switch ($this->tipoBD){ 
			case "mysql" 	:	

				if ($this->verificarConeccionBD()){ 
					// Exec SQL
					$exito = mysqli_query($this->linkBD,$sql);

					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					}
					else{
						$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
					}
				}
				else{
					// false
					$exito	= false;
				}
			break;	
		}			
		return ($exito);				
	}
	
	/** 
	* SQL Command
	* 
	* @param string $P_sql : SQL String
	* @return boolean Return TRUE or FALSE
	*/
	function ejecutarSQL($P_sql){
		$this->err = "";
		$exito = false;
		
		// SQL Query
		$sql = $P_sql;
		$this->sql = $sql; 

		switch ($this->tipoBD){
			case "mysql" 	:	
				if ($this->verificarConeccionBD()){									
					// Exec SQL
					mysqli_query($this->linkBD,$this->sql);
					$this->err_no = mysqli_errno($this->linkBD);

					if (mysqli_errno($this->linkBD) != 0){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					}
					else{
						$this->generado = mysqli_insert_id($this->linkBD);
						$exito = true;	
					}
				}
				else{
					$exito	= false;						
				}									
			break;
		}
            return ($exito);
	}
} 
?>