<?php

class Users {

	/**
	* @var string
	*/
	var $tablaUsuarios;
	
	/**
	* @var string 
	*/
	var $id_usuarios;
	
	/**
	* @var string 
	*/
	var $campoUser;
	
	/**
	* @var string 
	*/
	var $campoClave;
	
	/**
	* @var string
	*/
	var $campoNombre;

	/**
	* @var string
	*/
	var $campoEmail;

	/**
	* @var string
	*/
	var $flagActivo;
	
	
	/**
	* @var string 
	*/
	var $msg;
	
	var $tablaEmpresa;

	var $tablaUserEmpresa;

	var $campoLlave;

	var $exito;

	var $resultOk; 
		
	var $idLlave;

	var $tablaPersonal_otros;


	function __construct ( $tablaUsuarios = false) {

		$this->tablaUsuarios 		= $_ENV['DB_PREFIX'] . "usuarios";
		$this->tablaEmpresa 		= $_ENV['DB_PREFIX'] ."admin_empresas";
		$this->tablaUserEmpresa		= $_ENV['DB_PREFIX'] ."admin_empresas_users";
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
	* @param string 
	* @param integer 
	* @return array|boolean 
	*/
	function getUser ( $P_ParamUsuario, $P_modo = "idUsuario" ) {
		
		$exito 		= false;
		$objCons 	= new consultor();
		
		if ($P_modo == "idUsuario") {

			$where  = $this->campoLlave."=".$P_ParamUsuario."";

		} elseif ($P_modo == "Usuario") {

			$where = $this->campoEmail." LIKE BINARY '".$P_ParamUsuario."'";
		
		}
		
		$objCons->consultar("*", $this->tablaUsuarios, $where);

	    	$objCons->sql;
	    
		if ($objCons->totalFilas > 0){ 

			$exito = $objCons->extraerRegistro();
		}
		
		return($exito);	
	}


	function updateUser ( $P_infoUsuario , $idUser ) {

		$objEjecSql = new ejecutorSQL();
		$objCms 	= new cms ();
		$objCons 	= new consultor();

		$tbl = $this->tablaUsuarios;
		$val = vsprintf("usuario='%s', nombre='%s', direcction='%s', telephone='%s', fecha_ult_act='".date('Y-m-d H:i:s')."'", $P_infoUsuario);

		$whr = $this->campoLlave."=".$idUser;
			
		$result = $objEjecSql->actualizarRegistro($val, $tbl, $whr);
		if ( $result ) {
				$msj 		= 	"Datos actualizados con éxito.";
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

		$whr			=	'email = "'.$usuario.'" AND activo = 1';
		$objCons->consultar ("contrasena, usuario", $tbl, $whr);
		
		$extract 		= $objCons->extraerRegistro();

		if($extract['contrasena']) {
			$exito = 1;
		} else {
			$exito = 0;	
		}
	
		return($exito);
	}


	function consultarUsuario($P_idUsuario) { 
		$exito = false;
		
		$prefTab = $this->tablaUsuarios.".";
		
		
		$objCons = new consultor();
		
		$where = $prefTab.$this->campoLlave." = ".$P_idUsuario;
		
		$ope = $objCons->consultar($this->tablaUsuarios.".*", $this->tablaUsuarios, $where);
		
		if ($ope){ 
			$exito = $objCons->extraerRegistro();
		}
		
		return($exito);
	}
	
}

