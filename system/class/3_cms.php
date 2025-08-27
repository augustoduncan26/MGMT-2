<?php
/**
*/
class cms extends sesion{
	/**
	* @var string
	*/
	var $predet;
	
	/**
	* @var string
	*/
	var $predet_Autorizado;
	
	/**
	* @var string
	*/
	var $noAutorizado;
	
	/**
	* @var string
	*/
	var $reqLogin;
	
	/**
	* @var string
	*/
	var $login;
	
	/**
	* @var string
	*/
	var $logout;
	
	/**
	* @var string
	*/
	var $vista;
	
	/**
	* @var string
	*/
	var $controlador;
	
	/**
	* @var string
	*/
	var $titulo;
	
	/**
	* @var string
	*/
	var $codPag;
	
	var $admin;
	var $pagNoReg;
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	function cms($P_pag = false){
		$this->predet						=	"login";
		$this->predet_Autorizado 			= 	"defaultAdmin";
		$this->noAutorizado 				=	"noAutorizado";
		$this->pagNoReg		 				=	"pagNoReg";
		$this->reqLogin						=	"reqLogin";
		$this->logout						=	"logout";		
		$this->login						=	"login";
		
		$this->vista						=	"";		
		$this->controlador					=	"";		
		$this->titulo						=	"";
		
		$this->codPag						=	$P_pag;		
		
		$sesionFlag = $this->sesion();
		if ($sesionFlag){
			if ($P_pag !== false OR is_null($P_pag) ) {
				$this->recibirArchivos($P_pag); 
			}
		}
		else{
			$this->vista						=	"cms_noConexion.php";
			$this->controlador					=	"";
			$this->titulo						=	"Base de datos no disponible";
			
			$this->codPag						=	"noConexion";
		}
		
		return (true);
	}
	
	/** 
	* 
	* @param string 
	* @return array|boolean
	*/
	function recibirInfoParam ($P_param_url){
		$objConsultor = new consultor();
		$cmsReg = false;
		
		$sel = "vista, controlador, titulo, titulo_ing, flagProtegido, permiso, padre, codigo_url_pagina";
		$frm = "cms";
		$whr = "codigo_url_pagina='".$P_param_url."'";
		
		$objConsultor->consultar($sel, $frm, $whr);
		
		$nReg = $objConsultor->totalFilas;
		
		if ($nReg > 0){
			$cmsReg = $objConsultor->extraerRegistro();
		}
		
		return ($cmsReg);
	}
	
	/** 
	* @param string
	* @return boolean
	*/
	function recibirArchivos($P_param_url){
		$objPermisos = new  permisos();
		$idi		=	new idioma();
		$sel		=	$idi->BuscarActualizarIdioma();
		
		if ($P_param_url != ""){
			
			$cmsReg = $this->recibirInfoParam ($P_param_url) ;
			
			if ($cmsReg != false){
				if ($cmsReg['flagProtegido'] == 1){
					
					if ($this->esAutorizado()){
									
						if ($objPermisos->tienePermiso($cmsReg['permiso']) OR is_null($cmsReg['permiso']) ){
							$this->titulo = $cmsReg["titulo"];
								if($sel=='ing'){$this->titulo = $cmsReg["titulo_ing"];}
		
							$this->vista = $cmsReg["vista"];					
							$this->controlador = $cmsReg["controlador"];
						}
						else{
							$regNoAuth =  $this->recibirInfoParam ($this->noAutorizado) ;
							
							$this->titulo = $regNoAuth["titulo"];
							if($sel=='ing'){$this->titulo = $regNoAuth["titulo_ing"];}
							$this->vista = $regNoAuth["vista"];					
							$this->controlador = $regNoAuth["controlador"];	
						}
						
					}
					else{
						
						$regLogin =  $this->recibirInfoParam ($this->reqLogin) ;
						
						$this->titulo = $regLogin["titulo"];
						if($sel=='ing'){$this->titulo = $regLogin["titulo_ing"];}
						$this->vista = $regLogin["vista"];					
						$this->controlador = $regLogin["controlador"];	
					}
				}
				else{
					
					$this->titulo = $cmsReg["titulo"];
					if($sel=='ing'){$this->titulo = $cmsReg["titulo_ing"];}
					$this->vista = $cmsReg["vista"];
					$this->controlador = $cmsReg["controlador"];
				}
			}
			else{
				$regPagNR =  $this->recibirInfoParam ($this->pagNoReg) ;
				
				$this->titulo = $regPagNR["titulo"];
				if($sel=='ing'){$this->titulo = $regPagNR["titulo_ing"];}
				$this->vista = $regPagNR["vista"];
				$this->controlador = $regPagNR["controlador"];
			}
		}
		else{
			if ($this->esAutorizado()){				
				$regDef =  $this->recibirInfoParam ($this->predet_Autorizado);
			}
			else{
				$regDef =  $this->recibirInfoParam ($this->predet);
			}
			$this->vista = $regDef["vista"];					
			$this->controlador = $regDef["controlador"];	
			$this->titulo = $regDef["titulo"];	
			if($sel=='ing'){$this->titulo = $regDef["titulo_ing"];}
		}
		
			
		return(true);
	}
	
	/** 
	* @return string
	*/
	function devolverArchivoVista (){
		$exito = false;
		
		if (!is_null($this->vista)){
			$exito = SAD_DIR.SAD_CARPETA_VISTA.DIRECTORY_SEPARATOR.$this->vista;
		}
		
		return ($exito);
	}
	
	/** 
	* @return string
	*/
	function devolverArchivoControlador (){
		$exito = false;
		
		if ($this->controlador != ""){
			$exito = SAD_DIR.SAD_CARPETA_CONTROLADOR.DIRECTORY_SEPARATOR.$this->controlador;
		}
		
		return ($exito);
	}
	
	/** 
	* @param string 
	* @return boolean|array
	*/
	function buscarPadre($P_paramPadre){
		$objConsultor = new consultor();
		$exito = false;
		
		$actualReg = $this->recibirInfoParam ($P_paramPadre);
		
		if ($actualReg != false){
			$exito = $this->recibirInfoParam ($actualReg['padre']);			
		}
		
		return ($exito);
	}
	
	/** 
	* @return string
	*/
	function crearCumbread(){		
		$P_pag = $this->codPag;
		
		$actPagina = $this->recibirInfoParam ($P_pag);
		
		$arrCumbread = array();
		$arrCumbread[] = "<strong>".$actPagina['titulo']."</strong>"; 
		
		$tempPag = $this->buscarPadre($P_pag);
		
		if ($tempPag != false){
			while ($tempPag != false ){
				$valLink = "<a href=\"?".SAD_URL_CODIGO."=".$tempPag['codigo_url_pagina'];
				$valLink .= "\">".$tempPag['titulo']."</a>";
				
				$arrCumbread[] = $valLink;
				
				$tempPag = $this->buscarPadre($tempPag['codigo_url_pagina']);
			}
			
			$cadCumbread="";
			
			if (sizeof($arrCumbread)>1){			
				for ($i=sizeof($arrCumbread)-1; $i>=0; $i--){			
					$cadCumbread .= $arrCumbread[$i];
					
					if ($i > 0)
						$cadCumbread .= " -> ";
				}
			}
		}
		else{
			$cadCumbread="";
		}
		
		return $cadCumbread;
		
	}
	
	/**  
	* @param string
	* @param string
	* @return boolean
	*/
	function autorizar($P_Usuario, $P_Clave , $P_idioma = false, $P_Tipo = false){
		$exito = false; 
		
		$objUsuario 	= 	new usuario();
		$exito = $objUsuario->verificarUsuario ($P_Usuario, $P_Clave , $P_idioma = false, $P_Tipo = false);
		
		if ($exito == 1 || $exito == true){
			$reg = $objUsuario->obtenerUsuario($P_Usuario, "Usuario");
			
			$_SESSION["autorizado"] = $this->consultarIdSesion();
			$_SESSION["idUsuario"] = $reg[$objUsuario->campoLlave];
			$_SESSION["nombreUsuario"] = $reg[$objUsuario->campoNombre];

			$ObjetoBitacora		=	new bitacora();
			$ObjetoBitacora->registrar('El usuario acceso a la aplicaci�n');
			$exito = 1;
			
		}
		
		return $exito;
	}
	
	/** 
	* @return boolean TRUE - FALSE
	*/
	function esAutorizado(){
		$exito = false; 
		
		$exito = $this->consultarVariableSesion('autorizado');
		
		if (($exito == $this->consultarIdSesion()) AND (!is_null($exito))){
			$exito = true;
		}
		
		return $exito;
	}
	
	/** 
	* @param string
	* @param string
	* @return string
	*/
	function generarAtras($P_texto="Atrás", $P_estilo="link"){
	
		$P_pag_Actual =  $this->codPag;
		
		$atrasLnk = $this->buscarPadre($P_pag_Actual);
		
		switch ($P_estilo){
			
			case "boton"	:
				echo '<input type="button" name="boton_bck_aplic_cms" value="'.$P_texto.'" onclick="javascript: location.href=\''.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$atrasLnk['codigo_url_pagina'].'\'" />';
			break;
			
			case "link"		:					
				echo '<a href="'.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$atrasLnk['codigo_url_pagina'].'">'.$P_texto.'</a>';
			break;
			
			case "imagen"	:
				echo '<a href="'.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$atrasLnk['codigo_url_pagina'].'"><img border="0" src="'.$P_texto.'"/></a>';
			break;
			
		}
		
	}
	
	/** 
	* @return boolean
	*/
	function desconectar(){
		$ObjetoBitacora		=	new bitacora();
		$objEjecSQL 		= 	new ejecutorSQL();
		$ObjetoBitacora->registrar('El usuario cerro el acceso a la aplicacion');
		mysql_query('DELETE FROM ad_session WHERE id_session="'.$this->consultarIdSesion().'"',CONEXIONBD);
		mysql_query('UPDATE ad_session set id_session="", expires="" WHERE id_session="'.$this->consultarIdSesion().'"',CONEXIONBD);
		
		$tbl = 'ad_session';
		$cmp = "expires = ''"; 
		$whr = "id_session ='".$this->consultarIdSesion()."'";
				
		$result = $objEjecSQL->actualizarRegistro($cmp, $tbl, $whr);
		
		$objEjecSQL->borrarRegistro('ad_session','id_session="'.$this->consultarIdSesion().'"');
		//exit();
		$this->destruirVariableSesion('autorizado');  
		$this->destruirVariableSesion('idUsuario'); 
		$this->destruirVariableSesion('nombreUsuario');
		
	}
	
	/** 
	* @param string
	* @param string
	* @return string
	*/
	function generarCerrarSesion($P_texto="Cerrar Sesi�n", $P_estilo="boton"){
		switch ($P_estilo){			
			case "boton":
				if (SAD_URL_AMIGABLE){
					echo '<input type="button" name="boton_bck_aplic_cms" value="'.$P_texto.'" onclick="javascript: location.href=\''.SAD_URL_BASE.$this->logout.'\'" id="linkCerrarSesion" />';
				}
				else{
					echo '<input type="button" name="boton_bck_aplic_cms" value="'.$P_texto.'" onclick="javascript: location.href=\''.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$this->logout.'\'" />';
				}
			break;
			
			case "link"	:					
				if (SAD_URL_AMIGABLE){
					echo '<a href="'.SAD_URL_BASE.$this->logout.'" id="linkCerrarSesion" title="Cerrar sesi�n">'.$P_texto.'</a>';
				}
				else{
					echo '<a href="'.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$this->logout.'" id="linkCerrarSesion" title="Cerrar sesi�n">'.$P_texto.'</a>';
				}
			break;
			
			case "imagen":
				if (SAD_URL_AMIGABLE){
					echo '<a href="'.SAD_URL_BASE.$this->logout.'"><img border="0" src="'.$P_texto.'"/></a>';
				}
				else{
					echo '<a href="'.basename($_SERVER['PHP_SELF']).'?'.SAD_URL_CODIGO.'='.$this->logout.'"><img border="0" src="'.$P_texto.'"/></a>';
				}
			break;
		}
		
		return (true);
	}
	
	/**
	* 
	* @return string
	*/
	function consultarNombreActivo(){
		$exito = false; 
		$exito = $this->consultarVariableSesion('nombreUsuario');
		
		return $exito;		
	}
	
	/**
	* 
	* @return integer
	*/
	function consultarID(){
		$exito = false;		
		$exito = $this->consultarVariableSesion('id_user');
		
		return $exito;
	}
	
	/**
	* 
	* @return string
	*/
	function consultarTitulo(){
		print "<title>".$this->titulo."</title>";
		
		return (true);
	}
	
	/** 
	* 
	* @return boolean
	*/
	function incluirJavascript($nombCarp = "ad_js"){
		$arrFiles = scandir (SAD_DIR.$nombCarp);
		
		foreach ($arrFiles as $File){
			if ($File != "." AND $File != ".."){
				
				if (mb_ereg(".js$", $File)){
					print "<script language=\"javascript\" type=\"text/javascript\" src=\"".SAD_URL_BASE.$nombCarp."/".$File."\"></script> \n";
				
				}elseif(is_dir($nombCarp.DIRECTORY_SEPARATOR.$File)){
					$arrFiles_L2 = scandir (SAD_DIR.$nombCarp."/".$File);
										
					if($arrFiles_L2){
						
						foreach ($arrFiles_L2 as $File_L2){
							if ($File_L2 != "." AND $File_L2 != ".."){
								
								if (mb_ereg(".js$", $File_L2))
									print "<script language=\"javascript\" type=\"text/javascript\" src=\"".SAD_URL_BASE.$nombCarp."/".$File."/".$File_L2."\"></script> \n";
							}
						}
					}
				}
			}
		}
		
		return (true);
	}
	
	/** 
	* 
	* @return boolean
	*/
	function incluirCSS(){
		$nombCarp = "ad_css";
		$arrFiles = scandir (SAD_DIR.$nombCarp);
		
		foreach ($arrFiles as $File){
			if ($File != "." AND $File != ".."){
				if (mb_ereg(".css$", $File))
					print "<link href=\"".SAD_URL_BASE.$nombCarp."/".$File."\" rel=\"stylesheet\" type=\"text/css\" /> \n";
			}
		}
		
		return (true);
	}
	
	
	/** 
	* 
	* @param string
	* @return boolean
	*/
	function direccionarPagina($P_codPag){
		$exito = false;
		
		if (!headers_sent()){
			if (!SAD_URL_AMIGABLE)
				header ("Location: ?".SAD_URL_CODIGO."=".$P_codPag);
			else
				header ("Location: ".SAD_URL_BASE.$P_codPag);
		}
		
		return ($exito);
	}
	
	/** 
	* 
	* @param string
	* @param string
	* @return string
	*/
	function ubicarURL($P_codPag, $P_extra=""){
		if (!SAD_URL_AMIGABLE)
			print ("?".SAD_URL_CODIGO."=".$P_codPag.$P_extra);
		else{	
			$cad = SAD_URL_BASE.$P_codPag;
			
			if (!empty($P_extra)):
				$arrParam = explode('&', $P_extra);
				
				foreach ($arrParam AS $param){
					if (!empty($param[0])){
						$arrVar = explode('=', $param);
						
						$cad .= '/'.$arrVar[0].','.$arrVar[1];
					}
				}
				
			endif;
			
			print ($cad);
		}
		
		//return (true);
	}
	
	/** 
	* 
	* @param string
	* @param string
	* @return string
	*/
	function ubicarCadenaURL($P_codPag, $P_extra=""){
		if (!SAD_URL_AMIGABLE)
			return ("?".SAD_URL_CODIGO."=".$P_codPag.$P_extra);
		else{
			$cad = SAD_URL_BASE.$P_codPag;
			
			if (!empty($P_extra)):
				$arrParam = explode('&', $P_extra);
				
				foreach ($arrParam AS $param){
					if (!empty($param[0])){
						$arrVar = explode('=', $param);
						
						$cad .= '/'.$arrVar[0].','.$arrVar[1];
					}
				}
				
			endif;
			
			
			return ($cad);
		}
		
	}
	
}
?>