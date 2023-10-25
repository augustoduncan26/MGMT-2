<?php
// Librería

// Definición de objeto ayuda
// Rutinas para guardar y mostrar las ayudas del Sistema
/* Parametros contenidos dentro de la funcion:
		- lo que deseo seleccionar
		- tabla
		- condicion, cirterio de consulta
		- setear campo de orden
		- tipo de orden
		- forma de extraer los datos (array , extraer).
		
*/
class ayuda{
	////////////////////////////////////////////////////////////////////
	// Atributos
	////////////////////////////////////////////////////////////////////
	var $msg;
	var $Html;
	var $Txt;
	var $exito;
	
	
	
	////////////////////////////////////////////////////////////////////
	// Constructor
	////////////////////////////////////////////////////////////////////
	public function ayuda(){		
		return $this->exito;
	}
	
	
	////////////////////////////////////////////////////////////////////
	// Métodos
	///////////////////////////////////////////////////////////////////
	public function Buscar_Cualquier_yerba($sel , $tabla , $wer , $campo_orden = false , $orden  = false , $forma = false, $P_paginac=false , $P_pag="")
	{
		$exito		=	false;
		$objCons 	=  	new consultor;
		$objEjec 	=  	new ejecutorSQL();	
		//Listar grupos
		if($campo_orden == true)
		{
			$objCons->setearCamposOrder($campo_orden);
			//$objCons->setearOrden.$orden;
		}
		//$objCons->setearLimite(0,1);
		//Paginar
		if ($P_paginac == true){
			$P_pag = ($P_pag == "")?0:$P_pag;
			$objCons->setearLimite($P_pag * SAD_NUM_REG_PAGINACION, SAD_NUM_REG_PAGINACION, true);			
		}
			
		$extract	=	$objCons->consultar('*', $tabla , $wer);
		if($forma	==	'extraer')
		{
			$exito	=	$objCons->extraerRegistro();
		}
		if($forma 	==	'array')
		{
			$totalR	=	$objCons->totalFilas;
			if ($objCons->totalFilas > 0)
			{
				$exito = array(
	
					'total'     => $objCons->totalFOUNDROWS,
		
					'resultado' => $objCons->volcarTotalRegistro(),
		
					);	
			}
		}
		return $exito;
	}
	
	public function Ingresar_Editar_Eliminar($Delete_Edit_Ingr , $Id , $tabla , $Wer , $Campos = false , $Data = false, $total = false)
	{
		$exito 	 	= false;
		$objCMS 	=  new cms() ;	
		$objCons 	=  new consultor;
		$objEjec 	=  new ejecutorSQL();
		
		$idUs 		= $objCMS->consultarID();
		
		switch($Delete_Edit_Ingr)
		{
			case 'del':
				
				$whr_ = "id ='".$Id."'";
				$result	= $objEjec->borrarRegistro($tabla, $whr_);
				$exito	=	'Se ha eliminado el registro con &eacute;xito';
				
			break;
			
			case 'edit':
			if(!empty($_POST['radio']) && $_POST['radio'] == 0){ $acti	=	0;}else{ $acti = 1;}
				
				$result = $objEjec->actualizarRegistro($Campos, $tabla, $Wer);
				$exito	=	'Se ha actualizado el registro';
				
			break;
			
			case 'insert':
				
				$whr	= "tema like '%".$_POST['tema']."%'";
				$objCons->consultar('*', $tabla,$whr);
				/*
				if($objCons->totalFilas > 0){
					$exito	=	'Parece haber un tema parecido, revise lista de ayuda para mayor seguridad.';		
				}
				else
				{
				*/
				if($total > 1)
				{
					for($i = 0; $i < $total + 1 ; $i++)
					{
						if(!empty($_POST['Ent_'.$i]) && $_POST['Ent_'.$i] != ''):
							$val_ = $Data;//"'".$_POST['grupo']."','".$_POST['tema']."','".$_POST['Ent_'.$i]."',NOW(),1";
							//insertar
							$result = $objEjec->insertarRegistro($tabla,$Campos,$val_);
							$exito	=	'Se ha ingresado el registro satisfactoriamente';
						endif;
					}
				}
				else
				{
					
					$val_ 	= $Data; //"'".$_POST['grupo']."','".$_POST['tema']."','".$_POST['Ent_0']."',NOW(),1";
					//insertar
					$result = $objEjec->insertarRegistro($tabla,$Campos,$val_);
					$exito	=	'Se ha ingresado el registro satisfactoriamente';	
				}
				//}
			break;
		}
		
		return $exito;	
	}
	
	
} 
?>