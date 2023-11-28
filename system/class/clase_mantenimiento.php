<?php

/*
 Clase Mantenimientos
*/

class Mantenimientos
{
	public function Mantenimientos () 
	{
		return true;
	}
	
	//EVALUAR POST
	//=============
	public function EvaluarPOST($P_dato,$P_especial = false)
	{
		if($P_especial == true):
			$exito		=	isset($_POST[$P_dato])?$_POST[$P_dato]:$P_especial;
		else:
			$exito		=	isset($_POST[$P_dato])?$_POST[$P_dato]:'';
		endif;
		return $exito;
	}
	//EVALUAR GET
	//=============
	public function EvaluarGET($P_dato,$P_especial = false)
	{
		if($P_especial == true):
			$exito		=	isset($_GET[$P_dato])?$_GET[$P_dato]:$P_especial;
		else:
			$exito		=	isset($_GET[$P_dato])?$_GET[$P_dato]:'';
		endif;
		return $exito;
	}
	
	//CREAR ARRAY DEL METODO ENVIADO
	//==============================
	public function ValuePOST($Metodo = false)
	{
		//Capturar el array del POST
		if(!empty($Metodo) && $Metodo == 'post')
		{
			$DATO			=	$_POST;	
		}
		elseif(!empty($Metodo) && $Metodo == 'get')
		{
			$DATO			=	$_GET;	
		}
		else
		{
			$DATO			=	false;	
		}
		if(!empty($DATO)):
			foreach ( $DATO as $sForm => $value )
			{
				//$POST[] = $value;
				$this->exito[]	=	$value;
			}
			return $this->exito;
		endif;
	}
	
	
	//BUSCAR LO QUE SEA SEGUN LO QUE SEA
	//=====================================
	//Esta funcion me sirve para hacer cualquier
	//tipo de consulta, que no sea ningun tipo de Join o anidados 
	//o como quieran llamar a las consultas multiples hacia tablas
	function BuscarLoQueSea($P_que , $P_tabla, $P_where = false, $P_salida = false, $P_orden = false)
	{
		$exito		=	true;	
		$objCons 	= 	new consultor();
		
		//Setear orden
		if($P_orden == true)
		{
			$objCons->setearCamposOrder($P_orden);
		}
		//Condicion
		if($P_where == true)
		{	
			$objCons->consultar($P_que,$P_tabla,$P_where);
		}
		else
		{
			$objCons->consultar($P_que,$P_tabla);	
		}
		//Salida
		if ($objCons->totalFilas > 0):
			
			if($P_salida == 'extract')
			{
				$exito 		= $objCons->extraerRegistro();
			}
			else
			{
				$exito = array(
				'total'     => $objCons->totalFilas,
				'resultado' => $objCons->volcarTotalRegistro(),
				);
			}
		endif;
		
		return $exito;
			
	}
	
	//BUSCAR REGISTRO MAYOR
	//Buscar el numero mayor para asi
	//sabe cueal es el que le sigue
	//================================
	function BuscarNext($P_tabla,$P_campo)
	{
		$exito		=	true;
		//SELECT * FROM users ORDER BY fecha_upload DESC LIMIT 1
		$objCons 	= 	new consultor();
		$objCons->consultar('MAX('.$P_campo.')+1 as  '.$P_campo,$P_tabla);
		
		if ($objCons->totalFilas > 0):
			$exito 		= $objCons->extraerRegistro();
			//echo $exito[$P_campo];
		endif;
	
		return $exito;
	}
	
	public function  PromUsers($P_tabla,$P_campo,$Wer_Dpto = false) 
	{
		$exito		=	true;
		//SELECT * FROM users ORDER BY fecha_upload DESC LIMIT 1
		$objCons 	= 	new consultor();
		
		if($Wer_Dpto == TRUE)
		{
			$P_Were	=	$Wer_Dpto;
		}else {
			$P_Were = 1;
		}
		
		$objCons->consultar('MAX('.$P_campo.') as  '.$P_campo,$P_tabla,$P_Were);
		
		if ($objCons->totalFilas > 0):
			$exito 		= $objCons->extraerRegistro();
			//echo $exito[$P_campo];
		endif;
	
		return $exito;			
	}
	
	//BUSCAR NUMERO DE COLABORADOR
	//=============================
	function BuscarNdeRegistro($P_registro = false)
	{
		$objCms 	= 	new cms();
		$objEjec 	= 	new ejecutorSQL();
		$objCons 	=  	new consultor;
		$exito 		= 	false;
		
		if($NFormDMC == true)
		{
			$objCons->consultar('numeraciones_dmc', 'numeracion_cont_dmc');
			$exito	=	$objCons->extraerRegistro();
		}
		else
		{
			$objCons->setearCamposOrder($this->id_pago);
			$objCons->setearOrdenDesc();
			$objCons->setearLimite(0,1);
			$objCons->consultar('id_pago', 'pago');
		
		$exito		=	$objCons->extraerRegistro();
		
		$cuantosN	=	strlen($exito[id_pago]+1);
		$exito		=	$exito[id_pago]+1;
		switch($cuantosN)
		{
			case 1:
				$exito  = 	'0000'.$exito;
			break;
			case 2:
				$exito  = 	'000'.$exito;
			break;
			case 3:
				$exito  = 	'00'.$exito;
			break;
			case 4:
				$exito  = 	'0'.$exito;
			break;
		}
		}
		return $exito;
		
	}
	
	
	# FuncionDML: Realiza las acciones comunes de BD: Consultar, Modificar, Eliminar, Insertar
	# $P_accion: conocer el tipo de  accion DML a realizar
	# $P_campos: camppos a utilizar
	# $P_tabla: tabla a utilizar, aunque estan definidas en el constructor de la clase
	# $P_condicion: condicion dependiendo de la accion a realizar
	# $P_valores: parametro que contiene los valores para ingresar de acuerdo a la cantidad de campos
	# $P_salida: el tipo de salida que se desea (array: para tener todos los registros - extract: para tener un registro)
	# $P_orden: de acuerdo a la consulta que tipo de orden se necesita ASC - DESC
	# $GET_id:	El Identificador del registro la cual se encia como parametro por URL
	
	function FuncionesDML($P_accion	, $P_campos , $P_tabla , $P_condicion = false , $P_valores = false , $P_salida = false , $P_orden = false , $P_paginac=false, $P_pag="") {
		$exito 		=	false;
		$result		=	false;
		$objejec 	=  	new ejecutorSQL();
		$ObjBitac	=	new bitacora();
		$objCons 	= 	new consultor();
		$GET_id		=	isset($_GET['id'])?$_GET['id']:'';
		
		switch($P_accion)
		{
			# EDITAR
			#=========
			case 'editar':
				//$P_tabla 	=	$this->tabla_rh_dpto;
				$cmp_ 		= 	$P_campos; 
				$whr_ 		= 	$P_condicion;
				$result 	= 	$objejec->actualizarRegistro($cmp_, $P_tabla, $whr_);
				if ($result == false){
					$this->err 	= "Ha ocurrido un error. MySql dice: ".mysqli_error();
					$exito		=	$this->err;
				}
				else
				{
					$ObjBitac->registrarBitaUser('Se ha actualizado el registro: ('.$GET_id.') de la tabla: ('.$P_tabla.')', $_SESSION['id_usuario'],false);
					$exito	=	"Se ha actualizado el registro con éxito"; //"The Information has been saved successfully";
				}
				
			break;
			
			# INSERTAR
			#==========
			case 'insert':
					$result 	= 	$objejec->insertarRegistro($P_tabla, $P_campos , $P_valores);
					if ($result == false){
						  $this->err 	= "Ha ocurrido un error al tratar de ingresar los datos en la base de datos. ";
						  //MySql dice: ".mysql_error();
						  $exito		=	$this->err;
					}
					else
					{
						$ObjBitac->registrarBitaUser('Se ha ingresado un registro en la tabla: ('.$P_tabla.')',$_SESSION['id_usuario'],false);
						$exito		=	"The Information has benn saved successfully";//"Se ha ingresado el registro.";
					}
			break;
			
			# SELECT
			#=========
			case 'select':
			
					if($P_orden == 'asc')
					{
						$objCons->setearOrdenAsc();
					}
					if($P_orden == 'desc')
					{
						$objCons->setearOrdenDesc();
					}
				if ($P_paginac == true){
					$P_pag = ($P_pag == "")?0:$P_pag;
					$objCons->setearLimite($P_pag * SAD_NUM_REG_PAGINACION, SAD_NUM_REG_PAGINACION, true);			
				}

				$objCons->consultar($P_campos,$P_tabla, $P_condicion);
				//echo $objCons->totalFilas;
				if ($objCons->totalFilas > 0):

					if($P_salida == 'array' || $P_salida == ''){

						$exito = array(
		
						'total'     => $objCons->totalFOUNDROWS,
			
						'resultado' => $objCons->volcarTotalRegistro(),
			
						);
					}

					if($P_salida == 'extract')
					{
						$exito = $objCons->extraerRegistro();	
					}

				endif;
			break;
			
			# BORRAR
			#=========
			case 'delete':
				$cmp_ 		= 	$P_campos; 
				$whr_ 		= 	$P_condicion;
				$result 	= 	$objejec->actualizarRegistro($cmp_, $P_tabla, $whr_);
				if ($result == false){
					$this->err 	= "Ha ocurrido un error. MySql dice: ".mysql_error();
					$exito		=	$this->err;
				}
				else
				{
					$ObjBitac->registrarBitaUser('Se a cambiado el status del registro a inactivo, id: ('.$GET_id.'), de la tabla: ('.$P_tabla.')',$_SESSION['id_usuario'],false);
					$exito	=	"Action successfully";
				}
				
				
			break;
			
			# TRUNCATE
			#=========
			case 'truncate':
				//mysql_query('Truncate table');
				
			break;
			
			# TRUNCATE
			#=========
			case 'drop':
					$consult	=	mysql_query('Delete from '.$P_tabla.' Where '.$P_condicion);
					if($consult):
						$exito	=	"Rows Delete successfully";
					;else:
						$exito	=	'Error: '.mysql_error();
					endif;
			break;
			
		}
		return ($exito);
	}
	
	# FuncionObtenerListado: Listar los registros de una tabla Personal en RH
	# Parametro: $Ordenar se ordena el resultado de acuerdo al campo la cual se desea el orden
	
	function obtenerListado($P_Busqueda, $P_Tabla, $P_paginac=false, $P_pag="", $P_orden = false , $P_clave = false)
	{
		$exito = false;
	
		$objCons = new consultor();

	   switch($P_clave)
	   {
		   case '*':
		   	$where		=	1;
		   break;
		   
		   case 'act':
		   	 $where		=	' activo = 1';
		   break;
		   
		   case 'inact':
		   	 $where		=	' activo = 0';
		   break;
		  
		  case 'cedula':
		  	$where		=	"cedula LIKE '".$P_Busqueda."%'";
		  break;
		  
		   case 'provincia':
		  		$where		=	"provincia = '".$P_Busqueda."'";
				//$P_clave		=	'';
		  break;
		   case 'adm_rh_jornadas':
				$where = "( codigo LIKE '%".$P_Busqueda."%'"; 		
				$where .= " OR nombre LIKE '%".$P_Busqueda."%'";
		   break;
		   case 'adm_rh_tipodeduccion':				   
				$where = "( n_corto LIKE '%".$P_Busqueda."%'"; 		
				$where .= " OR nombre LIKE '%".$P_Busqueda."%'";	
    	          break;
		  
		   default:
		   		$P_clave		=	$P_clave;
		   		$where  = "(";	
				if(is_numeric($P_Busqueda) && $P_clave == NULL)
					{
						$where .= " codigo LIKE '".$P_Busqueda."%'"; 		
						$where .= " OR cedula LIKE '".$P_Busqueda."'";
					}
					elseif(is_string($P_Busqueda) && $P_clave == NULL)
					{
						$where .= " nombre LIKE '".$P_Busqueda."%'";
						$where .= " OR nombre1 LIKE '".$P_Busqueda."%'";
						$where .= " OR apellido LIKE '".$P_Busqueda."%'";
						$where .= " OR apellido1 LIKE '".$P_Busqueda."%'";	
					}
				}
				//$where .= " AND activo = 1";
				$where .= ")";

		
			if($P_orden == 'asc')
			{
				$objCons->setearCamposOrder('nombre');
				$objCons->setearOrdenAsc();
				
			}elseif($P_orden == 'desc')
			{
				$objCons->setearCamposOrder('nombre');
				$objCons->setearOrdenDesc();
			}
			else
			{	
				$objCons->setearCamposOrder($P_orden);
				$objCons->setearOrdenAsc();
			}
		
		if ($P_paginac == true){
			$P_pag = ($P_pag == "")?0:$P_pag;
			$objCons->setearLimite($P_pag * SAD_NUM_REG_PAGINACION, SAD_NUM_REG_PAGINACION, true);			
		}
		
		// Realizando consulta a la tabla
		$objCons->consultar($P_Tabla.".*",$P_Tabla, $where);
		//echo $objCons->totalFilas;
		if ($objCons->totalFilas > 0 ){
			$exito = array(
				'total' 	=> $objCons->totalFOUNDROWS,
				'resultado' => $objCons->volcarTotalRegistro(),
			);
		}
		
		return($exito);
	}
	
	//FUNCION PROMISCUA DE LISTAR
	//============================
	function Listar($P_Tabla, $P_Were = false,$P_orden = false, $P_SeteaOrden = false, $P_paginac=false, $P_pag="", $P_extract= false)
	{
		//$P_ID	;
		//echo $P_Were;
		
		$exito 		= 	false;
		$PageRecord	=	false;
		$objCons 	= 	new consultor();

		if($P_SeteaOrden == true){$objCons->setearCamposOrder($P_SeteaOrden);}
		if($P_orden == true)
		{
			if($P_orden == 'desc')
			{
				$objCons->setearOrdenDesc();
			}
			else
			{
				$objCons->setearOrdenAsc();
					
			}
		}

		if ($P_paginac == true){

			/*
			$objcmsIndx		 	= 	new cms();
			$idUs 	      		= 	$objcmsIndx->consultarID();
			$objCons->consultar('ad_usuario.id_empresa,ad_usuario.id_usuario,ad_admin_empresas.id_empresa,ad_admin_empresas.paginacion',
								'ad_usuario,ad_admin_empresas','ad_usuario.id_usuario="'.$idUs.'"');
			//echo $_SESSION['SAD_NUM_REG_PAGINACION'];die();
			if ($objCons->totalFilas > 0):
				$Record		= $objCons->extraerRegistro();
			 	echo $PageRecord	=	$Record['paginacion'];
			;else:
				$PageRecord	=	'12';
			endif;
			*/
				$P_pag = ($P_pag == "")?0:$P_pag;
				//$objCons->setearLimite($P_pag * SAD_NUM_REG_PAGINACION, SAD_NUM_REG_PAGINACION, true);			
				$objCons->setearLimite($P_pag * $_SESSION['SAD_NUM_REG_PAGINACION'], $_SESSION['SAD_NUM_REG_PAGINACION'], true);
				//$objCons->setearLimite($P_pag * $PageRecord, $PageRecord, true);

		}

		if(!$P_Were == false):
			$objCons->consultar("*", $P_Tabla, $P_Were);
		else:
			
			$objCons->consultar("*", $P_Tabla);//'activo = 1'
		endif;
		
		//$Totales	=	$objCons->totalFilas;
		if ($objCons->totalFilas > 0):
		//echo $objCons->totalFilas;
			if($P_extract == 'array')
			{
				$exito = array(
				'total'     => $objCons->totalFOUNDROWS,//totalFOUNDROWS,
				'resultado' => $objCons->volcarTotalRegistro(),);
			}
			else
			{
				$exito = $objCons->extraerRegistro();
			}
		endif;
		
		return ($exito);
	}
	
	// LISTAR LOS CAMPOS (31) DE LAS FORMULAS
	//=======================================
	// Para non tener que estar haciendo un ciclo
	// repetitivo en varios lugares del codigo
	public function ListadeCampos()
	{
		$start		=	false;
		$P_result	=	false;
		
		for($start	=	1	; $start	< 32 ; $start++)
		{
			$P_result	.=	 'c'.$start.',';	
		}	
		return ($P_result);
	}
	
	//FUNCION UTILIZADA PARA HACER UN JOIN A CUALQUIER TABLA SEGUN CODIGO DEL EMPLEADO
	//=================================================================================
	//
	function ConsultaTipoJoin($P_tablas, $P_Id = false, $P_codigo = false, $P_salida = false)
	{
		$exito			=	false;$where=false;
		$objCons 		= 	new consultor();
		$T_tablas		=	explode(',',$P_tablas);
		$C_campos		=	explode(',',$P_codigo);
		
		$Tot			=	count($T_tablas);
		$P_tablaArr		=	$T_tablas;
		
		$Tot_campos		=	count($C_campos);
		//if($Tot_campos > 1){$P_codigo = $C_campos;}//else{}
		
		if($Tot > 1 && $P_codigo == true)
		{
			//PARA CONSULTAR VARIAS TABLA, CON RESPECTO A UN(1) COMODIN
			//COMODIN =  ID Y/O CODIGO
			
			if($P_codigo == true){ $codigo	=	'.codigo = ';}else{ $codigo	=	'.id = ';}
			
			for($i = 0; $i < $Tot; $i++)
			{  
				$where  .=  $P_tablaArr[$i].$codigo.'"'.$P_codigo.'"';	
				
				if($i != $Tot-1):
					$where  .= ' and ';	
				endif;
			}
			$objCons->consultar("*", $P_tablas ,$where);
			
		}
		//UNA SOLA TABLA
		//==============
		elseif($Tot == 1 && $P_Id == false && $P_codigo == true)
		{	
			$where	=	' codigo = "'.$P_codigo.'"';
			$objCons->consultar("*", $P_tablas ,$where);	
		}
		//CONSULTA POR ID
		//================
		if($P_Id	==	true && $P_codigo == false && $Tot < 1)
		{
			$where		=	'id = "'.$P_Id.'"';
			$objCons->consultar("*", $P_tablas ,$where);
		}
		
		if ($objCons->totalFilas > 0):
		//TIPO DE SALIDA ARRAY / EXTRACT (1)
			if($P_salida == false)
			{
				$exito = array(
				'total'     => $objCons->totalFilas,
				'resultado' => $objCons->volcarTotalRegistro(),);
			}
			elseif($P_salida == 'extract')
			{
				$exito 		= $objCons->extraerRegistro();
				
			}
		endif;
	
		return $exito;
	}
}
?>