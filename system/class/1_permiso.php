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
	* @var string Nombre de la tabla asociacion permisos y usuarios
	*/
	var $tablaPermisos;
	
	/**
	* @var array
	*/
	var $DefinicionPermisos;
	
	/**
	* @var integer Llave primaria de la tabla usuario
	*/
	var $campoLlaveUsuario;
	
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
		
		$menu			=	new idioma();
		$this->cual		=	$menu->Buscaridioma();
		
		$this->tablaDefinicionPermisos 				= PREFIX."permiso_definicion";
		$this->tablaPermisos 						= PREFIX."permisos";
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
		if($P != false && $P != 'T')
		{
			$P_Where	=	"tipo_permiso = '".$P."'";	
		}
		elseif($P == 'T')
		{
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
	public function TodosPermisos($P_sel, $P_tabla, $P_OtrosParam = false)
	{	
		$P_data			=	false;
		$exito			=	false;
		$objCons 		= 	new consultor();
		//echo $P_OtrosParam;
		if($P_OtrosParam!=false)
		{
			$PWhere		=	$P_OtrosParam;
				
		}else
		{
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
	function crearNodoPermiso ($IDpermiso, $descPermiso, $permisosPadre, $P_Usuario){
		//$control  = '<table border=0 width=100%> <tr><td>';
		$control	=	FALSE;
		$DefPerm	=	FALSE;
		$PWhere		=	false;
		$Pexito		=	false;	
		
		$DefPerm	=	$this->consultarInfoPadre($IDpermiso);
		$objCons 	= 	new consultor();
		$PWhere		=	'id_definicion_permiso = "'.$IDpermiso.'" and permisoPadre IS NULL';
		$objCons->consultar('*', 'definicion_permiso',$PWhere);
		if ($objCons->totalFilas > 0){
			$reg 	= $objCons->extraerRegistro();
			$Pexito = $reg;
		}
		for($i = 0; $i < $objCons->totalFilas; $i++)
			{
				if($this->cual=='es')
				{
					$control .='<font color=#000080><strong>'.strtoupper($Pexito['definicion_permiso']).'</strong></font><hr /> <p />';		
				}
				else
				{
					$control .='<font color=#000080><strong>'.strtoupper($Pexito['definicion_permiso_ing']).'</strong></font><hr /> <p />';	
				}
			}	
		
		//$control .='<font color=#000080><strong>'.$IDpermiso.'</strong></font><hr /> <p />';	
		
		$control .= "\t\t<input type=\"checkbox\" name=\"permisos[]\" value=\"".$IDpermiso."\" id=\"PERM_".$IDpermiso."\" ";
		
		
		if ($this->tienePermisoUsuario($IDpermiso, $P_Usuario))
			$control .= " checked=\"checked\" ";
		
		$permHijo = $this->obtenerListadoPermisoHijo($IDpermiso);
		
		if ($permisosPadre!=false OR $permHijo!=false){
			
			$control .= " onclick=\"javascript: ";
			$control .= "c = 0; ";
			
			if ($permisosPadre!=false){
				
				$control .= "if (this.checked){ ";
					foreach($permisosPadre  as $permPadre){
						$control .= " document.getElementById('PERM_".$permPadre."').checked = this.checked; ";
					}
				
				$control .= "}else{";
				$padreInmediato = $this->consultarPadre ($IDpermiso);
				
				if ($padreInmediato != 0){
					
					$permSubHijoArr = $this->obtenerListadoPermisoHijo($padreInmediato);
					
					foreach($permSubHijoArr  as $permSubHijo){
						$control .= " if (document.getElementById('PERM_".$permSubHijo[$this->campoLlaveDefinicionPermiso]."').checked) { c++; } ";							
					}						
					
				}	
				else{
					$permSubHijoArr = $this->obtenerListadoPermisoPadre();
						
					foreach($permSubHijoArr  as $permSubHijo){
						$control .= " if (document.getElementById('PERM_".$permSubHijo[$this->campoLlaveDefinicionPermiso]."').checked) { c++; } ";							
					}						
				}		
				
				$control .= "if (c == 0) {  document.getElementById('PERM_".$padreInmediato."').click(); } ";
				
				$control .= "}";
			}
			
			
			$control .= "\n //Hijos \n";
			
			$control .= $this->checkarHijos ($IDpermiso);
			
			$control .= "\"";
		}
		
		$control .= " />";
		
		$control .= "<label for=\"PERM_".$IDpermiso."\"> ".$descPermiso."</label>\n";
		
		$control .= "<br />";
		
		
		
		if ($permHijo != false){
			$control .= "\t\t\t<blockquote>";
			
			if ($permisosPadre == false)
				$permisosPadre = array();
			
			$permisosPadre[] = $IDpermiso;
			
			foreach($permHijo  as $permisoDH){				
				$control .= $this->crearNodoPermiso ($permisoDH[$this->campoLlaveDefinicionPermiso], $permisoDH[$this->campoDefinicionPermiso], $permisosPadre, $P_Usuario);
			}
			
			//$control .= "<br />";
			$control .= "</blockquote>\n";
		}
		//$control .= '</td></tr></table>';
		return ($control);
		
		
	}
	
	/** 
	* Construye control HTML que visualiza los permisos asignados a un usuario.
	* 
	* @param string $P_ancho Ancho del control que se va a generar
	* @param string $P_Usuario Id del usuario del que se esta creando el control
	* @return string HTML y javascript del control generado
	*/
	function generarControlPermiso($P_ancho, $P_Usuario){
		$permPadre = $this->obtenerListadoPermisoPadre();
		$control = "";
		
		if ($permPadre === false){
			$control = "No existen definiciones de permiso en este sistema";
		}
		else{
			foreach($permPadre as $permisoD){
				$idPerm = $permisoD[$this->campoLlaveDefinicionPermiso];
				$descPerm = $permisoD[$this->campoDefinicionPermiso];
				
				$control .= $this->crearNodoPermiso ($idPerm, $descPerm, false, $P_Usuario);
			}		
		}
		
		echo $control;		
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
	
	/**
	* Aplicar perfil
	* @param $P_idUsuario int - ID del usuario
	* @param $P_idPerfil int - ID del perfil
	* @param $bCampoPerfilTblUsr bool - (false)
	* (true) Dice si hay campo de perfil asignado en tabla de usuario
	* @param $bAsocPrflCondic bool - (false) No hay restriccion al perfil
	* (true) Existe condiciones, definir...
	*/
	function aplicarPerfil($P_idUsuario, $P_idPerfil, $P_Principal=false,$bCampoPerfilTblUsr=false, $bAsocPrflCondic=false){
		$exito = false;
		$objEjec = new ejecutorSQL();
		
		if($P_idPerfil)
		{
			 $P_idPerfil;	
		}
		
		if($bAsocPrflCondic===true){
			
		}
		else{
			$permisosPerfil = $this->consultarPermisosPerfil($P_idPerfil);
		//echo ' b ';
		
		if ($permisosPerfil != false){
			//Agregar grupo a tabla: usuario_grupo
			$this->InsertarEnGrupos($P_idUsuario, $P_idPerfil,$P_Principal);
			/* Asocia perfil en tabla de usuario */
			if($bCampoPerfilTblUsr===true){
				$val = "id_perfil = '".$P_idPerfil."'";
				$tbl = "ad_usuario";
				$cdc = "id_usuario = '".$P_idUsuario."'";
				$objEjec->actualizarRegistro($val, $tbl, $cdc);
			}
			
			$exito = $this->asignarPermisosGrupo($permisosPerfil, $P_idUsuario);
		}
		else
		{
			$CrearGrupo = $this->InsertarEnGrupos($P_idUsuario, $P_idPerfil,$P_Principal);;	
			$exito	=	$CrearGrupo;
		}
			return ($exito);
		}
	}
	
	//Consultar el grupo del usuario
	function ConsultarGrupo($P_idUsuario)
	{
		$exito		=	FALSE;
		$objEjec 		= new ejecutorSQL();
		$objConsultor 	= new consultor();
		
		$cons		=	"*";
		$tbl		=	"ad_usuario_grupo";
		$where		=	"id_usuario = '".$P_idUsuario."'";
		$ope		=	$objConsultor->consultar($cons,$tbl,$where);

		if ($ope == true){
			$exito = $objConsultor->extraerRegistro();
		}else{ $exito = false;}
		
		return($exito);
	}
	/*
	Funcion para ingresar el numero de grupo segun el usuario
	Tabla 911_mant_secciones
	*/
	public function InsertarEnGrupos($P_idUsuario, $P_idGrupo,$P_Principal)
	{
		$objEjec 		= new ejecutorSQL();
		$objConsultor 	= new consultor();
		$exito			=	false;
		$P_idUsuario;
		$sel 			= "id_usuario";
		$tbl 			= "ad_usuario_grupo";
		$whr 			= "id_usuario=".$P_idUsuario;
		$objConsultor->consultar($sel, $tbl, $whr);

		SWITCH($P_idGrupo)
		{
			case '1':		//JEFES
				//$P_idPerfil	=	'3';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
					$objEjec->actualizarRegistro('principal=1', 'usuario', $whr);
					$exito	=	true;
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario, principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."', '".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);
					//$objEjec->insertarRegistro('usuario','principal', $val);	
					$exito	=	true;
				}
			break;
			
			case 2:		//SUPERVISORES
				//$P_idPerfil	=	'4';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
					//Tabla Ususario
					$objEjec->actualizarRegistro('principal=1', 'usuario', $whr);
					
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario, principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."','".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);			
				}
			break;
			
			case 3:		//USUARIO OPERACIONES
				   // $P_idPerfil	=	'5';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
					$objEjec->actualizarRegistro('principal=1', 'usuario', $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario,principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."','".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);			
				}
			break;
			
			case 4:		//USUARIO PRE-HOSPITALARIA
				//$P_idPerfil	=	'6';
				
				if ($objConsultor->totalFilas > 0 ){
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
					$objEjec->actualizarRegistro('principal=1', 'usuario', $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario, principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."','".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);			
				}
			break;
			
			case 5:		//USUARIO O.I.R.H.
				//$P_idPerfil	=	'7';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario, principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."','".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);		
				}
			break;
			
			case 6:		//USUARIO COMUN
				//$P_idPerfil	=	'8';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idGrupo."', principal = '".$P_Principal."'";
					$tbl 	= 	"ad_usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario, principal";
					$tbl 	= 	"ad_usuario_grupo";
					$val 	= 	"'".$P_idGrupo."','".$P_idUsuario."','".$P_Principal."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);		
				}
			break;
			
			case 7:		//PERFIL DE EJMEPLO
				$P_idPerfil	=	'';
			break;
			/*
			case 8:		//FUNSIONARIO ENLACE CON ENTIDAD
				$P_idPerfil	=	'2';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idPerfil."'";
					$tbl 	= 	"usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario";
					$tbl 	= 	"usuario_grupo";
					$val 	= 	"'".$P_idPerfil."','".$P_idUsuario."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);			
				}
			break;
			
			case 9:		//FUNSIONARIO SECRETARIA GENERAL
				$P_idPerfil	=	'9';
				if ($objConsultor->totalFilas > 0 ){
		
					$camp	= 	"id_grupo = '".$P_idPerfil."'";
					$tbl 	= 	"usuario_grupo";
					$whr 	= 	"id_usuario = '".$P_idUsuario."'";
					$exito	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
				}
				else
				{
					$cmp	= 	"id_grupo, id_usuario";
					$tbl 	= 	"usuario_grupo";
					$val 	= 	"'".$P_idPerfil."','".$P_idUsuario."'";///"id_usuario = $P_idUsuario";
					$exito	=	$objEjec->insertarRegistro($tbl, $cmp, $val);			
				}
			break;
			*/
			case 50:
					$exito = true;
			break;
			
		}
		
		/*
			VERIFICAR PRINCIPAL DEL GRUPO
			=============================
		*/
		if($P_Principal=="SI")
		{
			//echo $P_infoUsuario[usuario];
			
			$cons		=	"principal";
			$tbl		=	"ad_usuario_grupo,ad_usuario";
			$where		=	"usuario_grupo.id_grupo = '".$P_idGrupo."' and usuario_grupo.principal = 1 and usuario_grupo.id_usuario = usuario.id_usuario and usuario.id_entidad = ".$_POST['entidad'];
			$objConsultor->consultar($cons,$tbl,$where);
			$datos		=	$objConsultor->extraerRegistro();
			
			if ($objConsultor->totalFilas > 0 ){
				 $_POST['mensaje'] = 'Ya existe un usuario como principal de este grupo';
			}else{
				$camp	= 	"principal = 1";
				$tbl 	= 	"ad_usuario_grupo";
				$whr	=	"id_usuario = '".$P_idUsuario."' and  id_grupo = '".$P_idGrupo."'";
				$resulta	=	$objEjec->actualizarRegistro($camp, $tbl, $whr);
				$exito	=	true;
					
			}
		}
		
		return ($exito);
	}
	
	// Buscar permiso del usuario
	// **************************
	function tienePermisoElUsuario($P_permiso,$idUser){
		
		//$idUs 	= 	$P_Usuario;
		$where 	= 	"id_usuario = '".$idUser."' and id_definicion_permiso = '".$P_permiso."'";
		
		$SQ		=	mysqli_query("SELECT * FROM permiso WHERE ".$where);
		
		if(mysqli_num_rows($SQ)>0)
		{
			$exito	=	TRUE;
		}else
		{
			$exito	=	FALSE;	
		}
		return $exito;
	}
	
}// Clase Permiso	
?>