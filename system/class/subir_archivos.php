<?php
/** 
* Archivo clase subirArchivos
* Maneja todo lo relacionado a los archivos adjuntos: subir,eliminar
* Author: SAD --> Sinclair Augusto Duncan
* Constructor: (subirArchivos)
* Metodos: LimpiarEspacios, UploaddeArchivos, BuscarAdjuntos
 -->
*/
class subirArchivos
{
	function subirArchivos()
	{
		$this->exito	=	FALSE;
		$this->error	=	FALSE;
		$this->error_ext=	0;
		$this->size		=	3265536;
		
		return true;	
	}
	
	#Limpiar espacios entre cadena
	#Se eliminan los espacios que esten
	#que puedan tener los nombres de los archivos
	#==============================================
	public function LimpiaEspacios($CadenaConEspacios)
	{
		//$CadenaConEspacios		= 	strtolower($CadenaConEspacios); //Esta parte es solo para pasar a minisculas toda la cadena.
		
		$CadenaConMuchosEspacios= 	trim($CadenaConEspacios); 			//Aqui eliminamos todos los espacios que estan antes y despues de la cadena
		
		$CadenaRegulada			= 	str_replace( ' ', '_', $CadenaConEspacios); //Mediante expresiones regulares sustituimos los bloques de más de un espacio por un espacio sencillo
		
		return $CadenaRegulada; 									//El básico return de una función
	}
	
	#Subida de archivos al sistema
	#===============================
	#Parametros:
	#		1 - Archivo: Nombre del archivo a subir (subir 1 X 1)
	#		2 - Ruta: Repositorio en donde se quiere subir el archivo. Por defecto el del Sistema
	#		3 - Perm: Tipos de archivos permitidos
	#		4 - AddCarpeta: Crear una carpeta en algun lugar del sistema
	public function UploaddeArchivos($Archivo, $Ruta = FALSE, $Perm = FALSE, $AddCarpeta = false)
	{
		$perm				=	false;
		//RUTA DEL REPOSITORIO
		//====================
		if($Ruta != FALSE)
		{
			$ruta			=	$Ruta;							//La ruta que se desea especificar
		}
		else
			{	$ruta		=	UPLOAD_DIR_REPOS;				//La ruta que se tiene en el sistema
			}
		#TIPO DE IMAGENES PERMITIDOS
		#==============================
		#Evaluar que el documento a subir sea del tipo solicitado
		if($Perm	!= FALSE){
			$nombre  	=  	$_FILES[$Archivo]['name'];			//Noombre del Archivo
			$nom_sintip	=	explode('.',$_FILES[$Archivo]['name']);//Sacar el tipo y dejar el nombre
			//$nom_sintip	=	$_FILES[$Archivo]['type'];			//
			$TiposArr	=	explode(',',$Perm);					//Split segun caracter (,) de tipos permitidos
			$Tot		=	count($TiposArr);					//Contar total de catetos
			
			if($Tot > 1){
				for($i = 0 ; $i < $Tot ; $i++){
					#Archivos permitidos
					#===================
					$perm    	= 	stristr($nombre,'.'.$TiposArr[$i]);
					if($perm == FALSE)
					{
						$this->error_ext = $this->error_ext + 1 ;
					}
				}
			}
			else
			{	$perm    = stristr($nombre,'.'.$TiposArr);		//Saber si el archivo es del tipo permitido solicitado
				if($perm == FALSE)
				{
					$this->error_ext =	1 ;
				}
			}
		}else
		{	
			$perm    = stristr($nombre,'.pdf');					//Por defecto el sistema evalua que el archivo sea tipo PDF
				if($perm == FALSE)
				{
					$this->error_ext =	1 ;
				}
		}
		#Mandar mensaje de error si no es la extención permitida
		#========================================================
		if($this->error_ext > 0)
		{
			print'
				<script language="javascript">	
					Sexyy.alert("<font color=red face=Verdana />Uno de los archivo que intenta subir no es del tipo permitido")
				</script>
					';
			$msj			=	"<font color=red face=Verdana />Uno de los archivo que intenta subir no es del tipo permitido";	
			$this->exito	=	$msj;
		}
		
		 # VALIDAR EL TAMAÑO DEL ARCHIVO
		 #==============================
		 # Validar el tamaño permitido para cada archivo / por defecto 3mb
			$nombre  	=  	$_FILES[$Archivo]['name'];			//Noombre del Archivo
			$size		=	$_FILES[$Archivo]['size'];			//Conocer el tamaño del archivo
			# Tamaño del archivo
			#===================
			if($size > $this->size)
			{
				$error_size = $error_size + 1 ;
				print'
					<script language="javascript">	
						Sexyy.alert("<font color=red face=Verdana />Uno de los archivo que intenta subir es mayor de 3 Mega \n Vuelva a intentarlo...");
						
					</script>
					';
					$msj			=	"<font color=red face=Verdana />Uno de los archivo que intenta enviar es mayor de 3 Mega. Vuelva a intentarlo...";	
					$this->exito	=	$msj;
			}
			else
			{
				#Eliminar espacios en blanco de los archivos
				#============================================
				$nuevo_nombre		=	$this->LimpiaEspacios($nombre);
				#Si se desea crear una carpeta contenedora
				#============================================
				if($AddCarpeta != FALSE)
				{
					$uploadfileMK		=	$ruta.$AddCarpeta;		//Crear la carpeta contenedora
					@mkdir($uploadfileMK,0777);						//Darle todos los permisos
					$ruta	=	$ruta.$AddCarpeta."/";				//Enrutar los archivos hacia la carpeta
				
				}
				#Subir el archivo
				#================
				$tmp		=	$_FILES[$Archivo]["tmp_name"];
				if(move_uploaded_file($tmp,$ruta.$nuevo_nombre))
				{
					$this->exito	=	'ok';
				}
			}
			return $this->exito; 
	}
	
	#BUSCAR ADJUNTOS
	#===========================
	#Realiza una consulta a la tabla de los archivos
	#para localizar el path de donde se encuentran
	public function BuscarAdjuntos($P_consulta, $P_tabla, $P_where = false, $P_TipoSalida = false) 
	{
		$exito 		= false;
		$objEjec 	= new ejecutorSQL();
		$objCms 	= new cms();
		$objCons 	=  new consultor;
		
		#Realizando consulta a tbl
		#=========================
		$tbl		=	$P_tabla;	
		$cons		=	$P_consulta;
		$where		=	$P_where;
		
		$objCons->consultar($cons,$tbl,$where);
		#Tipo de Salida
		#==============
		if ($objCons->totalFilas > 0 ){
			//echo $objCons->totalFilas;
			if($P_TipoSalida == 'array'){
			 $this->exito = array(
				'total' 	=> $objCons->totalFilas,
				'resultado' => $objCons->volcarTotalRegistro(),
			);
			}else{
				$this->exito = $objCons->extraerRegistro();	
				}
		}
		return ($this->exito);

	}
	
	# ELIMINAR ADJUNTOS
	# =================
	#Eliminar todos los archivos mas
	#la carpeta.
	#$P_ruta	: 	Ruta de la carpeta a eliminar
	#$P_archivo	:	Nombre del archivo a eliminar
	#$P_todo	:	Si quiero eliminar todo lo que
	#				contenga la carpeta
	public function EliminarAdjuntos($P_ruta, $P_archivo = false, $P_todo = false)
	{
		$a      = 	FALSE;
		$del	=	FALSE;
		
		$del	=	$P_ruta;
		$a		=	opendir(UPLOAD_DIR_REPOS.$del);
		$b		=	$del."/";
		# Recorrer toda la carpeta
		# ========================
		if($P_todo == true)
		{
			foreach (glob($b."*.*") as $filename) 
			{
				@unlink($filename);			# Eliminar toda la carpeta
				$this->exito	=	'Se ha eliminado la carpeta.';
				@rmdir(UPLOAD_DIR_REPOS.$b);	
			}
		}else
		{		//echo UPLOAD_DIR_REPOS.$del.'/'.$P_archivo;
				@unlink(UPLOAD_DIR_REPOS.$del.'/'.$P_archivo);		# Eliminar un archivo en específico
				$this->exito	=	'El archivo ha sido eliminado.';
				closedir($a);
		}
		
		
	}
	
	#	Revisar_tipo:
	# =====================================================================
	#	-	Ayuda a verificar el tipo de archivo
	#		que se esten subiendo, de acuerdo al criterio de tipo
	#	-	Quita los espacios,comas,puntos,y cualquier tipo de caracteres
	#		que contenga el nombre del archivo a subir
	# Parametros:
	# $cantidad	:	cantidad de archivos a revisar
	# $file		:	nombre del objeto del form a revisar
	# OJO posdata: Hay que revisar este codigo nuevamente....!!!!!!! OJO
	# NO ESTOY SEGURO QUE ESTO DEBA QUEDAR ASI,,, LA PEREZA NO ME DEJA MEJORARLO
	# 
	# Version 2:
	# 			Al parecer ya funciona mejor, pero hay que seguir borrando porquerias.
	public function Revisar_tipo($cantidad,$file,$tipofile){
		
	   $RealName	=	false;
	   $error		=	0;
	   $exito		=	false;
		//Para un solo archivo
	   if($cantidad == 1)
	   {
			$espacios	=	substr_count($_FILES[$file.'0']['name'],' ');
			$tipo    	= 	$_FILES[$file.'0']['name'];
			$tipo    	=	substr($tipo,-3,3);
			//$tipo    	= explode(".",$_FILES[$file.'0']['name']);
			//echo $tipo[1];
			if($espacios > 0):
				$RealName					=	$this->LimpiaEspacios($_FILES[$file.'0']['name']);
				$_FILES[$file.'0']['name']	=	$RealName;
			endif;
			
			$nombre			=	$_FILES[$file.'0']['name'];
			$RevisarTipo	=	explode(',',$tipofile);
			$TotTipo		=	count($RevisarTipo);
			//echo $RevisarTipo[1];
			//echo $tipo;
			if($TotTipo > 0):
				for($x = 0 ; $x < $TotTipo ; $x++)
				{
					//$num     .= stristr($tipo[1],
					if($tipo	==	$RevisarTipo[$x])
					{
						$exito	=	1;	
					}
						
				}
			;else:
				//echo 2;
			endif;
			if($exito < 1)
			{
				$error	=	$error + 1;	
			}
	   }
	   else
	   {
		   for($h = 0 ; $h	<	$cantidad ; $h++)
		   {
			   $tamano 	= $_FILES[$file.$h]['size'];
			   //====>$tipo    = explode(".",$_FILES[$file.$h]['name']);
			   
			  //$tipo    = $_FILES[$file.$h]['type'];
			  // echo $tipo[1];
			 	$espacios	=	substr_count($_FILES[$file.$h]['name'],' ');
				$tipo    	= 	$_FILES[$file.$h]['name'];
				$tipo    	=	substr($tipo,-3,3);
			  
			  
			   //Revisar que los  archivos a subier no contengan espacios en blancos
				$espacios	=	substr_count($_FILES[$file.$h]['name'],' ');
		  
				if( $espacios > 0 ){
					$RealName	=	$this->LimpiaEspacios($_FILES[$file.$h]['name']);
					$_FILES[$file.$h]['name']	=	$RealName;
				}  
			
				if($tamano > 3265536){
					
					//$error = 1;
			   } 
			   
			   $nombre  	=  $_FILES[$file.$h]['name'];	
			   
			   $RevisarTipo	=	explode(',',$tipofile);
			   $TotTipo		=	count($RevisarTipo);
			  	//echo $RevisarTipo;
			   for($x = 0 ; $x < $TotTipo ; $x++)
			   {
					//$num     = stristr($nombre,$RevisarTipo[$x]);	
					if(in_array($tipo,$RevisarTipo, true))//$tipo[1]	==	 $RevisarTipo[$x])
					{
						$exito	=	1;	
					}
			   }
			   	if($exito < 1)
				{
					$error	=	$error + 1;	
				}
		   }
	   }
	   //echo $error;
	return $error;
 }
}


?>