<?php
/** 
* Clase que contiene definicion CMS, maneja los contenidos de
* vistas y controladores dentro del sistema
* clase extendida de sesion
*/
class cms extends sesion{
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	/**
	* @var string C�digo de p�gina predeterminada a cargar, cuando NO se esta autenticado
	*/
	var $predet;
	
	/**
	* @var string C�digo de p�gina predeterminada a cargar, cuando se esta autenticado
	*/
	var $predet_Autorizado;
	
	/**
	* @var string C�digo de p�gina que se muestra cuando el usuario no tiene acceso a un codigo de p�gina
	*/
	var $noAutorizado;
	
	/**
	* @var string C�digo de p�gina que se muestra al usuario para indicarle que necesita estar logueado
	*/
	var $reqLogin;
	
	/**
	* @var string C�digo de p�gina que contiene la forma de login
	*/
	var $login;
	
	/**
	* @var string C�digo de p�gina que muestra al usuario mensaje de logout ademas realiza el logout del usuario autenticado
	*/
	var $logout;
	
	/**
	* @var string Nombre de archivo php que contiene vista de c�digo de p�gina
	*/
	var $vista;
	
	/**
	* @var string Nombre de archivo php que contiene controlador de c�digo de p�gina
	*/
	var $controlador;
	
	/**
	* @var string T�tulo de c�digo de p�gina
	*/
	var $titulo;
	
	/**
	* @var string C�digo de P�gina
	*/
	var $codPag;
	
	var $admin;
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	/** 
	* Constructor de la clase cms. 
	* Inicializa los atributos de la clase e instacia la clase padre. 
	*/
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
	
	
	////////////////////////////////////////////////////////////////////
	// M�todos
	///////////////////////////////////////////////////////////////////
	/** 
	* Consulta en base de datos (tabla cms), la informaci�n respectiva de un c�digo de 
	* p�gina.
	* 
	* @param string $P_param_url C�digo de p�gina a cargar
	* @return array|boolean En caso de NO encontrarlo retorna FALSE, caso contratio retorna el arreglo con la informacion. 
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
	* Recibe el t�tulo, la vista y controlador correspondiente a un codigo de p�gina dado
	* Valida si el usuario necesita estar logueado, si necesita alg�n permiso en particular y si el c�digo de p�gina es v�lido
	* 
	* @param string $P_param_url C�digo de p�gina a cargar
	* @return boolean Retorna TRUE, y setea los atributos del objeto vista, controlador y titulo
	*/
	function recibirArchivos($P_param_url){
		$objPermisos = new  permisos();
		// agregar default
		$idi		=	new idioma();
		$sel		=	$idi->BuscarActualizarIdioma();
		
		if ($P_param_url != ""){
			
			$cmsReg = $this->recibirInfoParam ($P_param_url) ;
			
			// Retorna pagina que se encuentra registrado en el arreglo
			if ($cmsReg != false){
				if ($cmsReg['flagProtegido'] == 1){
					
					if ($this->esAutorizado()){
						// Devuelve p�gina registrada en arreglo							
						if ($objPermisos->tienePermiso($cmsReg['permiso']) OR is_null($cmsReg['permiso']) ){
							$this->titulo = $cmsReg["titulo"];
								if($sel=='ing'){$this->titulo = $cmsReg["titulo_ing"];}
		
							$this->vista = $cmsReg["vista"];					
							$this->controlador = $cmsReg["controlador"];
						}
						else{
							// no autorizado
							$regNoAuth =  $this->recibirInfoParam ($this->noAutorizado) ;
							
							$this->titulo = $regNoAuth["titulo"];
							if($sel=='ing'){$this->titulo = $regNoAuth["titulo_ing"];}
							$this->vista = $regNoAuth["vista"];					
							$this->controlador = $regNoAuth["controlador"];	
						}
						
					}
					else{
						// Necesita loguearse 
						$regLogin =  $this->recibirInfoParam ($this->reqLogin) ;
						
						$this->titulo = $regLogin["titulo"];
						if($sel=='ing'){$this->titulo = $regLogin["titulo_ing"];}
						$this->vista = $regLogin["vista"];					
						$this->controlador = $regLogin["controlador"];	
					}
				}
				else{
					// Devuelve p�gina registrada en arreglo
					
					$this->titulo = $cmsReg["titulo"];
					if($sel=='ing'){$this->titulo = $cmsReg["titulo_ing"];}
					$this->vista = $cmsReg["vista"];
					$this->controlador = $cmsReg["controlador"];
				}
			}
			else{
				// P�gina no registrada
				$regPagNR =  $this->recibirInfoParam ($this->pagNoReg) ;
				
				$this->titulo = $regPagNR["titulo"];
				if($sel=='ing'){$this->titulo = $regPagNR["titulo_ing"];}
				$this->vista = $regPagNR["vista"];
				$this->controlador = $regPagNR["controlador"];
			}
		}
		else{
			//Devuelve defecto
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
	} // Metodo recibirArchivo
	
	/** 
	* Devuelve el archivo de la vista a cargar 
	* Este valor lo toma del atributo vista.
	* 
	* @return string Ruta del archivo a cargar que contiene la vista
	*/
	function devolverArchivoVista (){
		$exito = false;
		
		if (!is_null($this->vista)){
			$exito = SAD_DIR.SAD_CARPETA_VISTA.DIRECTORY_SEPARATOR.$this->vista;
		}
		
		return ($exito);
	}
	
	/** 
	* Devuelve el archivo del controlador a cargar 
	* Este valor lo toma del atributo controlador.
	* 
	* @return string Ruta del archivo a cargar que contiene el controlador
	*/
	function devolverArchivoControlador (){
		$exito = false;
		
		if ($this->controlador != ""){
			$exito = SAD_DIR.SAD_CARPETA_CONTROLADOR.DIRECTORY_SEPARATOR.$this->controlador;
		}
		
		return ($exito);
	}
	
	/** 
	* Funcion que busca el registro padre de un c�digo de p�gina
	* 
	* @param string $P_paramPadre C�digo de p�gina a cargar
	* @return boolean|array Retorna FALSE en caso de NO encontrar el padre, y en caso de encontrarlo devuelve el arrreglo con la info del mismo 
	*/
	function buscarPadre($P_paramPadre){
		$objConsultor = new consultor();
		$exito = false;
		
		$actualReg = $this->recibirInfoParam ($P_paramPadre);
		
		if ($actualReg != false){
			$exito = $this->recibirInfoParam ($actualReg['padre']);			
		}
		
		return ($exito);
	}// Metodo buscarPadre
	
	/** 
	* Funcion que crea el cumbread del c�digo, bas�ndose en el padre.
	* Ej; Inicio -> Pagina 1 -> Pagina 2
	* 
	* @return string Cadena que contiene Cumbread de p�gina
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
		
	}//crearCumbread	
	
	/**  
	* Autoriza o da acceso a un usuario, utilizando el objeto de usuario, 
	* crea las variables de sesion
	* 
	* @param string $P_Usuario Usuario del sistema
	* @param string $P_Clave Clave del sistema 
	* @return boolean Retorna TRUE o FALSE dependiendo de si se pudo o no realizar la operaci�n 
	*/
	function autorizar($P_Usuario, $P_Clave , $P_idioma = false, $P_Tipo = false){
		$exito = false; 
		
		$objUsuario 	= 	new usuario();
		$exito = $objUsuario->verificarUsuario ($P_Usuario, $P_Clave , $P_idioma = false, $P_Tipo = false);
		
		if ($exito == 1 || $exito == true){
			$reg = $objUsuario->obtenerUsuario($P_Usuario, "Usuario");
			
			// Crear variables de sesion
			//$this->registrarVariableSesion("autorizado",  $this->consultarIdSesion());
			$_SESSION["autorizado"] = $this->consultarIdSesion();
			$_SESSION["idUsuario"] = $reg[$objUsuario->campoLlave];
			$_SESSION["nombreUsuario"] = $reg[$objUsuario->campoNombre];


			//$this->registrarVariableSesion("autorizado",  $this->consultarIdSesion());
			//$this->registrarVariableSesion("idUsuario", $reg[$objUsuario->campoLlave]);
			//$this->registrarVariableSesion("nombreUsuario", $reg[$objUsuario->campoNombre]." ". $reg[$objUsuario->campoApellido] );
			
			//Dejar log en bitacora
			//bitacora::registrar('El usuario acceso a la aplicaci�n');
			$ObjetoBitacora		=	new bitacora();
			$ObjetoBitacora->registrar('El usuario acceso a la aplicaci�n');
			$exito = 1;
			
		}
		
		return $exito;
	}
	
	/** 
	* Funcion que verifica si un usuario esta auntenticado o no en la aplicacion
	* 
	* @return boolean TRUE o FALSE dependiendo si esta autenticado o no
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
	* Funcion que genera un boton de atras (hacia el padre del c�digo de p�gina dado)
	* 
	* @param string $P_texto Opcional, texto que llevara el boton o link
	* @param string $P_estilo Opcional, forma de visualizar el boton atr�s, puede ser: 'boton' genera un bot�n (INPUT), 'link' genera un link  (A), 'imagen' genera una imagen con su link (A, IMG)
	* @return string Cadena HTML de bot�n de atr�s
	*/
	function generarAtras($P_texto="Atr�s", $P_estilo="link"){
		//$estilo: Variable que da comportamiento del control que se genera 
		// boton: genera un boton
		// link:  genera un link
		// imagen: genera una imagen
		
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
	* Funcion que destruye las variables de sesion (retira autenticacion del usuario en aplicacion)
	* 
	* @return boolean TRUE o FALSE dependiendo si realizo la operacion o no
	*/
	function desconectar(){
		//Dejar log en bitacora
		$ObjetoBitacora		=	new bitacora();
		$objEjecSQL 		= 	new ejecutorSQL();
		$ObjetoBitacora->registrar('El usuario cerro el acceso a la aplicacion');
		//bitacora::registrar('El usuario cerr� el acceso a la aplicaci�n');
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
	* Funcion que genera un boton para cerrar sesi�n
	* 
	* @param string $P_texto Opcional, texto que llevara el boton o link
	* @param string $P_estilo Opcional, forma de visualizar el boton atr�s, puede ser: 'boton' genera un bot�n (INPUT), 'link' genera un link  (A), 'imagen' genera una imagen con su link (A, IMG)
	* @return string Cadena HTML de bot�n de cerrar sesi�n
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
	* Funcion que devuelve nombre de usuario que se ha autenticado 
	* 
	* @return string Cadena con el nombre del usuario autenticado
	*/
	function consultarNombreActivo(){
		$exito = false; 
		$exito = $this->consultarVariableSesion('nombreUsuario');
		
		return $exito;		
	}
	
	/** 
	* Funcion que devuelve id de usuario que se ha autenticado 
	* 
	* @return integer ID del usuario autenticado
	*/
	function consultarID(){
		$exito = false;		
		$exito = $this->consultarVariableSesion('id_user');
		
		return $exito;
	}
	
	/** 
	* Para utilizar o invocar dentro de <head>, imprime titulo de c�digo de p�gina proporcionado
	* 
	* @return string HTML con tags de title con el t�tulo asociado al c�digo de p�gina
	*/
	function consultarTitulo(){
		print "<title>".$this->titulo."</title>";
		
		return (true);
	}
	
	/** 
	* Para utilizar o invocar dentro de <head>, realiza includes de archivos js 
	* encontrados en la carpeta js
	* 
	* @return boolean Esta funci�n devuelve true
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
	* Para utilizar o invocar dentro de <head>, realiza includes de archivos css 
	* encontrados en la carpeta css
	* 
	* @return boolean Esta funci�n devuelve true
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
	* Redirect to a specific page
	* Only use in controller page
	* 
	* @param string $P_codPag : Page code
	* @return boolean Return FALSE if no redirect the page
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
	* Imprime en la p�gina generada el link con URL a p�gina  
	* 
	* @param string $P_codPag C�digo de p�gina 
	* @param string $P_extra Parametros extras pasados por el URL
	* @return string Cadena con el href de la p�gina a direccionar
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
	* Devuelve cadena para el link con URL a p�gina  
	* 
	* @param string $P_codPag C�digo de p�gina 
	* @param string $P_extra Parametros extras pasados por el URL
	* @return string Cadena con el href de la p�gina a direccionar
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
		
		//return (true);
	}
	
	/** 
	* Devuelve cadena para el link con URL a ARCHIVO o Imagen  
	* 
	* @param string $P_codPag Codigo de pagina 
	* @param string $P_extra Parametros extras pasados por el URL
	* @return string Cadena con el href de la pagina a direccionar
	*/
	function imagenURL($P_nombreArchivo){
		print (SAD_URL_BASE.SAD_CARPETA_IMAGENES.'/'.$P_nombreArchivo);
	}

	function imagenURLicons($P_nombreArchivo){
		print (SAD_URL_BASE.SAD_CARPETA_IMAGENES.'/icons/'.$P_nombreArchivo);
	}
	
	
} // Clase cms 
?>