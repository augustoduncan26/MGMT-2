<?php
/* Definition of Users class */

//use DComputer;


class Users {

////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var string Nombre de la tabla de la base de datos donde se almacenan los usuarios del sistema
	*/
	var $tablaUsuarios;
	
	/**
	* @var string Campo llave de la tabla de la base de datos donde se almacenan los usuarios del sistema
	*/
	var $id_usuarios;
	
	/**
	* @var string Campo que contiene los usuarios de acceso de los usuarios del sistema
	*/
	var $campoUser;
	
	/**
	* @var string Campo que contiene las contraseñas de acceso de los usuarios del sistema
	*/
	var $campoClave;
	
	/**
	* @var string Campo que contiene el nombre del usuario
	*/
	var $campoNombre;

	/**
	* @var string Campo que contiene el email del usuario
	*/
	var $campoEmail;

	/**
	* @var string Nombre del campo que indica si un usuario esta activo o no
	*/
	var $flagActivo;
	
	
	/**
	* @var string Mensajes que el objeto deja despues de una operacion
	*/
	var $msg;
	
	/**
	* Parametro que retorna un valor true
	*/
	var $exito;
		
	var $idLlave;


	// Constructor
	function __construct ( $tablaUsuarios = false) {

		$this->tablaUsuarios 		= "ad_users";
		//$this->tablaUsuarios_otros 	= "usuario_otros";
		$this->tablaEmpresa 		= "ad_admin_empresas";
		$this->tablaUserEmpresa		= "ad_admin_empresas_users";
		$this->campoLlave 			= "id_usuario";
		$this->campoUser 			= "usuario";
		$this->campoClave 			= "contra";
		$this->campoNombre 			= "nombre";
		$this->campoEmail 			= "email";
		$this->flagActivo			= "activo";
		
		$this->msg		 			= "";
		$this->resultOk				= false;
	}


	// Create User
	function createUser () {
		
	}


	/**
	* Consult active user infomation
	*   
	* Función que obtiene el registro (row) del usuario según el parámetro dado
	* 
	* @param string $P_Param Usuario Parametro que sirve  como criterio de búsqueda, que según el segundo argumento de la función puede ser el id o el user
	* @param integer $P_modo Modo en que se utiliza la función. Sus valores posibles pueden ser: idUsuario y Usuario
	* @return array|boolean FALSE en caso de no existir ningun usuario, y en caso de devolver resultados un arreglo
	*/
	function getUser ( $P_ParamUsuario, $P_modo = "idUsuario" ) {
		
		$exito 		= false;
		$objCons 	= new consultor();
		
		if ($P_modo == "idUsuario") {

			$where  = $this->campoLlave."=".$P_ParamUsuario."";

		} elseif ($P_modo == "Usuario") {

			$where = $this->campoUser." LIKE BINARY '".$P_ParamUsuario."'";
		
		}
		
		// Realizando consulta a tabla usuario
		$objCons->consultar("*, AES_DECRYPT(contrasena,'toga') as contrasena", $this->tablaUsuarios, $where);

	    //echo $objCons->sql;
	    
		if ($objCons->totalFilas > 0){ 

			$exito = $objCons->extraerRegistro();
		}
		
		return($exito);	
	}


	/* Update user information */
	function updateUser ( $P_infoUsuario , $idUser ) {

		$objEjecSql = new ejecutorSQL();
		$objCms 	= new cms ();
		$objCons 	= new consultor();
		//$objPermiso = new permisos ();

		// Patrones de inserción
		// , id_usuario_act=".$objCms->consultarID()
		$tbl = $this->tablaUsuarios;
		$val = vsprintf("usuario='%s', nombre='%s', direcction='%s', telephone='%s', fecha_ult_act='".date('Y-m-d H:i:s')."'", $P_infoUsuario);

		$whr = $this->campoLlave."=".$idUser;
			
		$result = $objEjecSql->actualizarRegistro($val, $tbl, $whr);
		//echo $objCons->sql;
		if ( $result ) {
				$msj 		= 	"Datos actualizados con éxito.";
				//unset($_SESSION['username']);
				$_SESSION['username'] 	=   '';
				$_SESSION['username']	=	$_POST['full_name'];
				$idUsuario 	= 	$objEjecSql->generado;
				
		} else { 
				if ($objEjecSql->err_no == 1062){ 
					$msj = "El usuario '".$P_infoUsuario['usuario']."' ya esta registrado, o alg&uacute;n otro usuario utiliza este usuario como acceso.";
				}
				else{ 
					$msj = "¡Error! Al realizar la actualización.";
				}
			}
		
		$exito = array (
			'resultado' => $result,
			'mensaje' => $msj
		);
		
		return $exito;		
	}

	
/** 
	* Función que verifica si el usuario y contraseña dados coinciden con los registros de la tabla de usuarios.
	* Verifica la existencia de ese usuario con la contraseño correspondiente
	*/
	function verificarUsuario ($usuario, $contrasena, $tipo = false){
		$exito 		= 	false;
		$extract	=	false;
		$objCons 	= new consultor();
		
		$sel = "COUNT(*) AS usuarioFlag"; 
		
		if($tipo == 1) {
			
			$tbl = $this->tablaPersonal_otros; 
		
		} else	{
			
			$tbl = $this->tablaUsuarios; 	
		}

		$whr			=	'usuario = "'.$usuario.'" AND activo = 1';
		$objCons->consultar ("AES_DECRYPT(contrasena,'toga') as clave, usuario", $tbl, $whr);
		$extract 		= $objCons->extraerRegistro();

		if($extract['clave'] == $contrasena) {
			$exito = 1;
		} else {
			$exito = 0;	
		}
	
		return($exito);
	}

	/** 
	* Función que obtiene el listado de usuarios registrados en el sistema
	*/
	function consultarUsuario($P_idUsuario) { 
		$exito = false;
		
		$prefTab = $this->tablaUsuarios.".";
		
		
		$objCons = new consultor();
		
		$where = $prefTab.$this->campoLlave." = ".$P_idUsuario;
		
		// Realizando consulta a tabla usuario
		$ope = $objCons->consultar($this->tablaUsuarios.".*", $this->tablaUsuarios, $where);
		
		if ($ope){ 
			$exito = $objCons->extraerRegistro();
		}
		
		return($exito);
	}

	/** 
	* Consultar Usuario de una empresa
	*/
	function consultarUsuarioEmpresa( $P_emailUsuario , $P_empresa ) { 

		$exito = false;
		
		$objCons = new consultor();
		
		$where = " email = ".$P_emailUsuario;

		$ope = $objCons->consultar("*", $this->tablaUserEmpresa, $where);
		
		if ($ope){ 
			$exito = $objCons->extraerRegistro();
		}
		
		return($exito);
	}
	
}


?>