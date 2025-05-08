<?php 
/** 
* Class Definicion permisos
*/
class permisos {
	/**
	* @var string Nombre de la tabla
	*/
	var $tablaDefinicionPermisos;

	/**
	* @var string Nombre de la tabla
	*/
	var $tablaUsersPermisos;
	
	/**
	* @var string Nombre de la tabla asociacion permisos y usuarios
	*/
	var $tablaPermisos;

	/**
	* @var string Nombre de la tabla usuarios
	*/
	var $tablaUsuarios;
	
	/**
	* @var array
	*/
	var $DefinicionPermisos;
	
	/**
	* @var integer Llave primaria (id_usuario) de la tabla usuario
	*/
	var $campoLlaveUsuario;

	/**
	* @var integer Campo id_user de la tabla users_permissions
	*/
	var $campoLlaveIdUser;

	/**
	* @var integer Llave primaria de la tabla perfil o rol
	*/
	var $campoLlavePerfil;

	/**
	* @var integer Campo id_permission de la tabla users_permissions
	*/
	var $campoLlaveIdPermission;
	
	/**
	* @var integer Llave primaria de la tabla definicion de permisos
	*/
	var $campoLlaveDefinicionPermiso;
	
	/**
	* @var integer Campo de la base de datos que indica el id del permiso padre, en caso de ser cero(0) significa que no tiene padre
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
		//$this->campoDefinicionPermiso				= "definicion_permiso";
		if($this->cual=='es'){
			$this->campoDefinicionPermiso 				= "definicion_permiso";
		}else{
			$this->campoDefinicionPermiso 				= "definicion_permiso_ing";
		}
		$this->DefinicionPermisos = $this->obtenerListadoPermiso();
	}
	
	/** 
	* Obtiene datos de la tabla de definicion de permisos
	* 
	* @return array|boolean FALSE en caso de no existir ningun usuario, y en caso de devolver resultados(Definicion de permisos con sus ids) en un arreglo
	*/
	function obtenerListadoPermiso(){		
		$exito = false; 
		
		$objCons = new consultor();
		
		// Realizando consulta a tabla usuario
		$objCons->consultar("*", $this->tablaDefinicionPermisos, "1");
		
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	/** 
	* Obtiene datos de la tabla de definicion de permisos
	* 
	* @return array|boolean FALSE en caso de no existir ningun usuario, y en caso de devolver resultados(Definicion de permisos con sus ids) en un arreglo
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
		//echo $P_OtrosParam;
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
	* Devuelve listado de permisos padres de un permiso determinado
	* 
	* @return array|boolean
	*/
	function obtenerListadoPermisoPadre(){		
		$exito = false; 
		
		$objCons = new consultor();
		
		// Realizando consulta a tabla usuario
		$objCons->consultar("*", $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermisoPadre." IS NULL");
	
		if ($objCons->totalFilas > 0){
			$exito = $objCons->volcarTotalRegistro();
		}
		
		return $exito;				
	}
	
	/** 
	* Devuelve todos los permisos hijos de un permiso
	* 
	* @param string $P_Padre Id del permiso del cual se quiere obtener los permiso
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
	 * Consultar el Rol del Usuario
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
	* Buscar si el usuario autenticado tiene un determinado permiso
	* 
	* @param integer $P_permiso Id del permiso a consultar
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
	* Buscar si un usuario tiene un permiso
	* 
	* @param integer $P_permiso Id del permiso a consultar
	* @param integer $P_Usuario Id del usuario a consultar
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
	* Asigna varios permisos a un usuario
	* 
	* @param array $P_Permisos Arreglo de permisos a asignar
	* @param integer $P_idUsuario Id del usuario al que se le van a asignar los permisos
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
	* Quita todos los permisos a un usuario 
	* 
	* @param integer $P_id_usuario Id del usuario al que se le van a quitar todos los permisos
	* @return boolean TRUE / FALSE
	*/
	function quitarPermisos_Todos($P_id_usuario){
		$objEjecutorSQL = new ejecutorSQL();
		//echo $this->campoLlaveUsuario."=". $P_id_usuario;
		$exito = $objEjecutorSQL->borrarRegistro($this->tablaPermisos, $this->campoLlaveUsuario."='". $P_id_usuario."'");
		
		return $exito;
	}
	
	/** 
	* Asocia un permiso determinado a un usuario
	* 
	* @param integer $P_id_usuario Id del usuario al que se le va asignar el permiso 
	* @param integer $P_Permiso Id del permiso que se va a asignar
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
	
	# Consultar toda la informacion segun permiso padre
	function consultarInfoPadre($P_permiso){
		$exito = false;
		$objCons = new consultor();
		
		$objCons->consultar('*', $this->tablaDefinicionPermisos, $this->campoLlaveDefinicionPermiso."=".$P_permiso);
		
		if ($objCons->totalFilas > 0){
			$reg = $objCons->extraerRegistro();
			$exito = $reg;//[$this->campoLlaveDefinicionPermisoPadre];
		}
		
		return $exito;	
		
	}
	
	/** 
	* generarControlPermiso, esta incrusta javascript para que al momento de realizar check en el nodo, automaticamente 
	* se activen todos los nodos padres.
	* 
	* @param string $P_IDPerm Id del permiso al cual se le va a generar javascript
	* @return string Cadena con javascript
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
	
	/** 
	* generarControlPermiso y crea de manera recursivamente cada uno de los checks de los permisos
	* 
	* @param integer $IDpermiso Id del permiso del nodo a crear
	* @param string $descPermiso Descripcion del permiso del nodo a crear
	* @param array $permisosPadre Arreglo con ids de permisos padres, en caso de no tenerlo su valor es un booleano falso
	* @param integer $P_Usuario Id del usuario del cual pertenece el nodo de permiso
	* @return string Cadena con  html/javascript del nodo 
	*/
	// function crearNodoPermiso ($IDpermiso, $descPermiso, $permisosPadre, $P_Usuario){
	// 	//$control  = '<table border=0 width=100%> <tr><td>';
	// 	$control	=	FALSE;
	// 	$DefPerm	=	FALSE;
	// 	$PWhere		=	false;
	// 	$Pexito		=	false;	
		
	// 	$DefPerm	=	$this->consultarInfoPadre($IDpermiso);
	// 	$objCons 	= 	new consultor();
	// 	$PWhere		=	'id_definicion_permiso = "'.$IDpermiso.'" and permisoPadre IS NULL';
	// 	$objCons->consultar('*', 'definicion_permiso',$PWhere);
	// 	if ($objCons->totalFilas > 0){
	// 		$reg 	= $objCons->extraerRegistro();
	// 		$Pexito = $reg;
	// 	}
	// 	for($i = 0; $i < $objCons->totalFilas; $i++)
	// 		{
	// 			if($this->cual=='es')
	// 			{
	// 				$control .='<font color=#000080><strong>'.strtoupper($Pexito['definicion_permiso']).'</strong></font><hr /> <p />';		
	// 			}
	// 			else
	// 			{
	// 				$control .='<font color=#000080><strong>'.strtoupper($Pexito['definicion_permiso_ing']).'</strong></font><hr /> <p />';	
	// 			}
	// 		}	
		
	// 	//$control .='<font color=#000080><strong>'.$IDpermiso.'</strong></font><hr /> <p />';	
		
	// 	$control .= "\t\t<input type=\"checkbox\" name=\"permisos[]\" value=\"".$IDpermiso."\" id=\"PERM_".$IDpermiso."\" ";
		
		
	// 	if ($this->tienePermisoUsuario($IDpermiso, $P_Usuario))
	// 		$control .= " checked=\"checked\" ";
		
	// 	$permHijo = $this->obtenerListadoPermisoHijo($IDpermiso);
		
	// 	if ($permisosPadre!=false OR $permHijo!=false){
			
	// 		$control .= " onclick=\"javascript: ";
	// 		$control .= "c = 0; ";
			
	// 		if ($permisosPadre!=false){
				
	// 			$control .= "if (this.checked){ ";
	// 				foreach($permisosPadre  as $permPadre){
	// 					$control .= " document.getElementById('PERM_".$permPadre."').checked = this.checked; ";
	// 				}
				
	// 			$control .= "}else{";
	// 			$padreInmediato = $this->consultarPadre ($IDpermiso);
				
	// 			if ($padreInmediato != 0){
					
	// 				$permSubHijoArr = $this->obtenerListadoPermisoHijo($padreInmediato);
					
	// 				foreach($permSubHijoArr  as $permSubHijo){
	// 					$control .= " if (document.getElementById('PERM_".$permSubHijo[$this->campoLlaveDefinicionPermiso]."').checked) { c++; } ";							
	// 				}						
					
	// 			}	
	// 			else{
	// 				$permSubHijoArr = $this->obtenerListadoPermisoPadre();
						
	// 				foreach($permSubHijoArr  as $permSubHijo){
	// 					$control .= " if (document.getElementById('PERM_".$permSubHijo[$this->campoLlaveDefinicionPermiso]."').checked) { c++; } ";							
	// 				}						
	// 			}		
				
	// 			$control .= "if (c == 0) {  document.getElementById('PERM_".$padreInmediato."').click(); } ";
				
	// 			$control .= "}";
	// 		}
			
			
	// 		$control .= "\n //Hijos \n";
			
	// 		$control .= $this->checkarHijos ($IDpermiso);
			
	// 		$control .= "\"";
	// 	}
		
	// 	$control .= " />";
		
	// 	$control .= "<label for=\"PERM_".$IDpermiso."\"> ".$descPermiso."</label>\n";
		
	// 	$control .= "<br />";
		
		
		
	// 	if ($permHijo != false){
	// 		$control .= "\t\t\t<blockquote>";
			
	// 		if ($permisosPadre == false)
	// 			$permisosPadre = array();
			
	// 		$permisosPadre[] = $IDpermiso;
			
	// 		foreach($permHijo  as $permisoDH){				
	// 			$control .= $this->crearNodoPermiso ($permisoDH[$this->campoLlaveDefinicionPermiso], $permisoDH[$this->campoDefinicionPermiso], $permisosPadre, $P_Usuario);
	// 		}
			
	// 		//$control .= "<br />";
	// 		$control .= "</blockquote>\n";
	// 	}
	// 	//$control .= '</td></tr></table>';
	// 	return ($control);
		
		
	// }
	
	/** 
	* Construye control HTML que visualiza los permisos asignados a un usuario.
	* 
	* @param string $P_ancho Ancho del control que se va a generar
	* @param string $P_Usuario Id del usuario del que se esta creando el control
	* @return string HTML y javascript del control generado
	*/
	// function generarControlPermiso($P_ancho, $P_Usuario){
	// 	$permPadre = $this->obtenerListadoPermisoPadre();
	// 	$control = "";
		
	// 	if ($permPadre === false){
	// 		$control = "No existen definiciones de permiso en este sistema";
	// 	}
	// 	else{
	// 		foreach($permPadre as $permisoD){
	// 			$idPerm = $permisoD[$this->campoLlaveDefinicionPermiso];
	// 			$descPerm = $permisoD[$this->campoDefinicionPermiso];
				
	// 			$control .= $this->crearNodoPermiso ($idPerm, $descPerm, false, $P_Usuario);
	// 		}		
	// 	}
		
	// 	echo $control;		
	// }
	
	
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
	
	
	
	//Consultar el grupo del usuario
	// function ConsultarGrupo($P_idUsuario)
	// {
	// 	$exito		=	FALSE;
	// 	$objEjec 		= new ejecutorSQL();
	// 	$objConsultor 	= new consultor();
		
	// 	$cons		=	"*";
	// 	$tbl		=	"ad_usuario_grupo";
	// 	$where		=	"id_usuario = '".$P_idUsuario."'";
	// 	$ope		=	$objConsultor->consultar($cons,$tbl,$where);

	// 	if ($ope == true){
	// 		$exito = $objConsultor->extraerRegistro();
	// 	}else{ $exito = false;}
		
	// 	return($exito);
	// }
	
	// Buscar permiso del usuario
	// **************************
	// function tienePermisoElUsuario($P_permiso,$idUser){
		
	// 	//$idUs 	= 	$P_Usuario;
	// 	$where 	= 	"id_usuario = '".$idUser."' and id_definicion_permiso = '".$P_permiso."'";
		
	// 	$SQ		=	mysqli_query("SELECT * FROM permiso WHERE ".$where);
		
	// 	if(mysqli_num_rows($SQ)>0)
	// 	{
	// 		$exito	=	TRUE;
	// 	}else
	// 	{
	// 		$exito	=	FALSE;	
	// 	}
	// 	return $exito;
	// }
	
}// Clase Permiso	
?>