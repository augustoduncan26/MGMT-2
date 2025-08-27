<?php
/** 
* Class
*/
class ejecutorSQL extends funcionesDB{
	/**
	* @var string
	*/
	var $sql;
	
	/**
	* @var integer
	*/
	var $generado;
	
	/**
	* @var integer
	*/
	var $numRegAfectados;

	/** 
	* @access constructor
	*/
	function ejecutorSQL(){
		$this->funcionesDB('M');
		$this->sql = "";
		$this->generado="";
		$this->numRegAfectados=0;
	}

	
    function IniciarTran(){
		$exito = false;
		switch ($this->tipoBD){

			case "mysql":
				if ($this->verificarConeccionBD()){
					$exito = mysqli_query("BEGIN");
				}
				
			break;
		}
		return ($exito);
	}
	

    function CompletarTran(){
		$exito = false;
		switch ($this->tipoBD){
			case "mysql" 	:
				if ($this->verificarConeccionBD())
					$exito = mysqli_query("COMMIT");
			break;
		}
		
		return ($exito);
	}
	

    function DeshacerTran(){
		$exito = false;
		switch ($this->tipoBD){
			case "mysql":
				if ($this->verificarConeccionBD())
					$exito = mysqli_query("ROLLBACK");
			break;	
		}
		
		return ($exito);
	}
	

	function vaciarTabla($P_Tabla, $P_condicion = false){
		$this->err = "";
		$exito = false;
		

		if ($P_condicion == true) {
			$sql = "TRUNCATE TABLE ".$P_Tabla." WHERE ".$P_condicion;
		} else {
			$sql = "TRUNCATE TABLE ".$P_Tabla;
		}
		
		$this->sql = $sql; 
		
		switch ($this->tipoBD){
	
			case "mysql" 	:
				if ($this->verificarConeccionBD()){
				
					$exito = mysqli_query($this->linkBD,$sql);
					
				
					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
						$this->err_no = mysqli_errno($this->linkBD);
					}
					else{
				
						$sql = "ALTER TABLE ".$P_Tabla." AUTO_INCREMENT = 0";
						$exito = mysqli_query($this->linkBD,$sql);
						
					
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
	}

	function insertarRegistro($P_Tabla, $P_Campos, $P_Valores){

		$this->err = "";
		$exito = false;
		
	
		$sql = "INSERT INTO ".$P_Tabla." ( ".$P_Campos." ) VALUES ( ".$P_Valores." )";
		
		$this->sql = $sql;  
	
		switch ($this->tipoBD){
			
			case "mysql" 	:
			if ($this->verificarConeccionBD()){ 
			
				$exito = mysqli_query($this->linkBD, $sql) or die(mysqli_error($this->linkBD));
				
				
				if (!$exito){
					$this->err 		= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					$this->generado = 0;										
					$this->err_no 	= mysqli_errno($this->linkBD);
				}
				else{ 
				
					$this->generado = mysqli_insert_id($this->linkBD);
					$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
				}
			}
			else{
			
				$exito	= false;
			}									
			break;	
		}		

		return ($exito);				
	}
	
	
	function remplazarRegistro($P_Tabla, $P_Campos, $P_Valores){
		$this->err = "";
		$exito = false;
		
	
		$sql = "REPLACE ".$P_Tabla." ( ".$P_Campos." ) VALUES ( ".$P_Valores." )";
	
		$this->sql = $sql;  
		
		switch ($this->tipoBD){
		
			case "mysql" 	:	
		
				if ($this->verificarConeccionBD()){
		
					$exito = mysqli_query($this->linkBD,$sql);
					
				
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
				
					$exito	= false;
				}									
			break;	
		}			
		return ($exito);				
	}
	
	
	function borrarRegistro($P_Tabla, $P_condicion){
		$this->err = "";
		$exito = false;
		

		$sql = "DELETE FROM ".$P_Tabla." WHERE ".$P_condicion;
		$this->sql = $sql; 

		switch ($this->tipoBD){

			case "mysql" 	:	
				if ($this->verificarConeccionBD()){
			
					$exito = mysqli_query($this->linkBD,$sql);
					
					
					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
					}
					else{
						$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
					}
				}
				else{
					
					$exito	= false;
				}
			break;
		}			
		return ($exito);
	}
	
	
	function actualizarRegistro($P_Valores, $P_Tabla, $P_condicion){
		$this->err = "";
		$exito = false;
		

		$sql = "UPDATE ".$P_Tabla." SET ".$P_Valores." WHERE ".$P_condicion;		
		$this->sql = $sql;

		switch ($this->tipoBD){ 
			case "mysql" 	:	

				if ($this->verificarConeccionBD()){ 
			
					$exito = mysqli_query($this->linkBD,$sql);

					if (!$exito){
						$this->err 	= "Ha ocurrido un error. MySql dice ".mysqli_error($this->linkBD);
						$exito = $this->err;
					}
					else{
						$this->numRegAfectados = mysqli_affected_rows($this->linkBD);
					}
				}
				else{
				
					$exito	= false;
				}
			break;	
		}			
		return ($exito);				
	}

	function ejecutarSQL($P_sql){
		$this->err = "";
		$exito = false;
		
	
		$sql = $P_sql;
		$this->sql = $sql; 

		switch ($this->tipoBD){
			case "mysql" 	:	
				if ($this->verificarConeccionBD()){									
			
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
