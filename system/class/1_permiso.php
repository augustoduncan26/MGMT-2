<?php 
/** 
* Class
*/
class permisos {
	/**
	* @var string
	*/
	var $tablaDefinicionPermisos;

	/**
	* @var string 
	*/
	var $tablaUsersPermisos;
	
	/**
	* @var string
	*/
	var $tablaPermisos;

	/**
	* @var string 
	*/
	var $tablaUsuarios;
	
	/**
	* @var array
	*/
	var $DefinicionPermisos;
	
	/**
	* @var integer 
	*/
	var $campoLlaveUsuario;

	/**
	* @var integer
	*/
	var $campoLlaveIdUser;

	/**
	* @var integer 
	*/
	var $campoLlavePerfil;

	/**
	* @var integer 
	*/
	var $campoLlaveIdPermission;
	
	/**
	* @var integer
	*/
	var $campoLlaveDefinicionPermiso;
	
	/**
	* @var integer
	*/
	var $campoLlaveDefinicionPermisoPadre;
	
	/**
	* @var string
	*/
	var $campoDefinicionPermiso;
	
	/**
	* Definicion del idioma seleccionado por le usuario
	*/
	var $cual;
	
	/** 
	* Constructor
	* @access constructor
	*/
	function permisos(){
		$menu		=	false;
		$cual		=	false;
		
		$menu		=	new idioma();
		$this->cual	=	$menu->Buscaridioma();
		
		$this->tablaDefinicionPermisos 				= PREFIX."permiso_definicion";
		$this->tablaUsersPermisos					= PREFIX."users_permissions";
		$this->tablaPermisos 						= PREFIX."permisos";
		$this->tablaUsuarios 						= PREFIX."usuarios";
		$this->campoLlavePerfil 					= "id_perfil";
		$this->campoLlaveIdPermission 				= "id_permission";
		$this->campoLlaveIdUser 					= "id_user";
		$this->campoLlaveUsuario 					= "id_usuario";
		$this->campoLlaveDefinicionPermiso 			= "id_definicion_permiso";
		$this->campoLlaveDefinicionPermisoPadre		= "permisoPadre";
		if($this->cual=='es'){
			$this->campoDefinicionPermiso 				= "definicion_permiso";
		}else{
			$this->campoDefinicionPermiso 				= "definicion_permiso_ing";
		}
		$this->DefinicionPermisos = $this->obtenerListadoPermiso();
	}
	
	/**
	* 
	* @return array|boolean 
	*/
	function obtenerListadoPermiso(){		
		$exito = false; 
		
		$objCons = new consultor();
		
		$objCons->consultar("*", $this->tablaDefinicionPermisos, "1");
		
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	/**
	* 
	* @return array|boolean
	*/
	function obtenerListadoPermisoExacto($P=false){		
		$exito = false; 
		
		$objCons = new consultor();
		if($P != false && $P != 'T') {
			$P_Where	=	"tipo_permiso = '".$P."'";	
		} elseif($P == 'T') {
			$P_Where	=	false;		
		}
		// Realizando consulta a tabla usuario
		$objCons->consultar("*", $this->tablaDefinicionPermisos,$P_Where );
		
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	
	
	/**
	*	Buscar permisos del usuario en tabla permiso
	*/
	public function TodosPermisos($P_sel, $P_tabla, $P_OtrosParam = false) {	
		$P_data			=	false;
		$exito			=	false;
		$objCons 		= 	new consultor();
		if($P_OtrosParam!=false) {
			$PWhere		=	$P_OtrosParam;
				
		} else {
			$PWhere		=	false;	
		}
			$P_data		=	$objCons->consultar($P_sel,$P_tabla,$PWhere);	
			if($objCons->totalFilas > 0){
			
				$exito	=	true;
			}
			return $exito;
	}
	
	/**
	* 
	* @return array|boolean
	*/
	function obtenerListadoPermisoPadre(){		
		$exito = false; 
		
		$objCons = new consultor();
		
		$objCons->consultar("*", $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermisoPadre." IS NULL");
	
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	
	/**
	* 
	* @param string
	* @return array|boolean
	*/
	function obtenerListadoPermisoHijo($P_Padre){		
		$exito = false; 
		
		$objCons = new consultor();
		
		// Realizando consulta a tabla usuario
		$objCons->consultar("*", $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermisoPadre."=".$P_Padre);
		
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	
	/**
     * Get Rol / Perfil permissions data
     * @param $ID
     */
	public function getRolPermissions ($ID) {
		$ObjMante   	= new Mantenimientos();
		$permissions    = $ObjMante->BuscarLoQueSea('*', $this->tablaPermisos, " id_cia=".$_SESSION['id_cia']." and ".$this->campoLlavePerfil."=".$ID,'array');
		
        $permission     = [];
		if ($permissions['resultado']) {
			foreach ($permissions['resultado'] as $key => $value) {
				$permission[] = $value['id_definicion_permiso'];
			}
		}
        return $permission;
	}

	/**
     * Get user permissions data
     * @param $ID
     */
	public function getUserPermissions ($ID) {
		$ObjMante   	= new Mantenimientos();
		$permissions    = $ObjMante->BuscarLoQueSea('*', $this->tablaUsersPermisos, " id_cia=".$_SESSION['id_cia']." and ".$this->campoLlaveIdUser."=".$ID,'array');
		
        $permission     = [];
        foreach ($permissions['resultado'] as $key => $value) {
            $permission[] = $value['id_permission'];
        }
        return $permission;
	}

	/**
     * Check User Permissions
     */
    public function checkUserPermission ($P_permiso, $P_idUser) {
		$ObjMante   	= new Mantenimientos();
		$permission     = $ObjMante->BuscarLoQueSea('*', $this->tablaUsersPermisos, " id_cia=".$_SESSION['id_cia']." and ".$this->campoLlaveIdPermission."=".$P_permiso." and ".$this->campoLlaveIdUser."=".$P_idUser,'extract');
		
		if ($permission['id_permission'])
			$exito = true;
		else
			$exito = false;
			
		return $exito;
    }

	/**
	 * @param $P_idUser
	 * @retun $exito
	 */
	public function checkUserRol($P_idUser){
		$exito 		= false;
		$ObjMante   = new Mantenimientos();
		$data 	    = $ObjMante->BuscarLoQueSea('*', $this->tablaUsuarios, " id_cia=".$_SESSION['id_cia']." and ".$this->campoLlaveUsuario."=".$P_idUser,'extract');
		
		if ($data['id_perfil'])
			$exito = true;
		else
			$exito = false;
			
		return $exito;
	}

	/**
	* 
	* @param integer
	** @return boolean TRUE / FALSE
	*/
	function tienePermiso($P_permiso){

		$objCMS_T = new cms();
		$idUs = $objCMS_T->consultarID();
		
		$objCons = new consultor();
		
		//$this->tablaPermisos;
		$where = $this->campoLlaveUsuario."=".$idUs." AND ".$this->campoLlaveDefinicionPermiso."=".$P_permiso;
		
		$objCons->consultar("*", $this->tablaPermisos, $where);
		
		
		if ($objCons->totalFilas > 0)
			$exito = true;
		else
			$exito = false;
			
		return $exito;
	}
	
	/** 
	* @param integer
	* @param integer
	* @return boolean TRUE / FALSE
	*/
	function tienePermisoUsuario($P_permiso, $P_Usuario){
		$idUs = $P_Usuario;
		
		$objCons = new consultor();
		
		$where = $this->campoLlaveUsuario."=".$idUs." AND ".$this->campoLlaveDefinicionPermiso."=".$P_permiso;
		
		$objCons->consultar("*", $this->tablaPermisos, $where);
		
		if ($objCons->totalFilas > 0)
			$exito = true;
		else
			$exito = false;
		
		return $exito;
	}
	
	/** 
	* @param array
	* @param integer
	* @return boolean TRUE / FALSE
	*/
	function asignarPermisosGrupo($P_Permisos, $P_idUsuario){
		$exito = false; 
		$c=0; 
		$i=0;
		//echo $P_idUsuario;
		if ($this->quitarPermisos_Todos($P_idUsuario)):
		   $c = $c + 1;//++;
		endif;
		
		if (!empty($P_Permisos)){		
			foreach ($P_Permisos as $permisoAsignado){
				
				if ($this->asignarPermiso($P_idUsuario, $permisoAsignado))
				   $i++;
			}
		}
		
		if ($i == sizeof($P_Permisos) and $c == 1):
		  $exito = true;
		endif;
		return ($exito);	
	}
	
	/** 
	* @param integer
	* @return boolean TRUE / FALSE
	*/
	function quitarPermisos_Todos($P_id_usuario){
		$objEjecutorSQL = new ejecutorSQL();
		$exito = $objEjecutorSQL->borrarRegistro($this->tablaPermisos, $this->campoLlaveUsuario."='". $P_id_usuario."'");
		
		return $exito;
	}
	
	/** 
	* @param integer
	* @param integer
	* @return boolean TRUE / FALSE
	*/
	function asignarPermiso($P_id_usuario, $P_Permiso){
		$objEjecutorSQL = new ejecutorSQL();
		$exito = $objEjecutorSQL->insertarRegistro($this->tablaPermisos, $this->campoLlaveUsuario.", ".$this->campoLlaveDefinicionPermiso , $P_id_usuario.", ".$P_Permiso);
        
		return ($exito);	  
	}	
	
	/** 
	* Devuelve el id padre padre de un registro de permiso
	* 
	* @param string $P_permiso Id del Permiso
	* @return integer|boolean id del permiso padre
	*/
	function consultarPadre($P_permiso){
		$exito = false;
		$objCons = new consultor();
		
		$objCons->consultar($this->campoLlaveDefinicionPermisoPadre, $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermiso."=".$P_permiso);
		
		if ($objCons->totalFilas > 0){
			$reg = $objCons->extraerRegistro();
			$exito = $reg[$this->campoLlaveDefinicionPermisoPadre];
		}
		
		return $exito;	
		
	}
	
	function consultarInfoPadre($P_permiso){
		$exito = false;
		$objCons = new consultor();
		
		$objCons->consultar('*', $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermiso."=".$P_permiso);
		
		if ($objCons->totalFilas > 0){
			$reg = $objCons->extraerRegistro();
			$exito = $reg;
		}
		
		return $exito;	
		
	}
	
	/** 
	* @param string
	* @return string
	*/
	function checkarHijos ($P_IDPerm){
		$control = "";
		
		$permHijo = $this->obtenerListadoPermisoHijo($P_IDPerm);
		
		if ($permHijo != false){
			foreach ($permHijo AS $permisoH){
				$control .= " document.getElementById('PERM_".$permisoH[$this->campoLlaveDefinicionPermiso]."').checked = this.checked; ";
				$control .= $this->checkarHijos ($permisoH[$this->campoLlaveDefinicionPermiso]);				
			}
		}
		
		return ($control);
	}
	
	
	function consultarPermisosPerfil($P_idPerfil){
		$exito = false;
		$arrPerm = array();
		
		$objConsultor = new consultor();
		
		$sel = "id_definicion_permiso";
		$tbl = "asoc_perfil_permiso";
		$whr = "id_perfil=".$P_idPerfil;
		
		$objConsultor->consultar($sel, $tbl, $whr);
		
		if ($objConsultor->totalFilas > 0 ){
			$resCons = $objConsultor->volcarTotalRegistro();
			
			foreach ($resCons as $perm){
				$arrPerm[] = $perm['id_definicion_permiso'];
			}
			
			$exito = $arrPerm;
			
		}
		
		return ($exito);
	}
}
?>