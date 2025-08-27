<?php

class ayuda{

	var $msg;
	var $Html;
	var $Txt;
	var $exito;
	
	public function ayuda(){		
		return $this->exito;
	}
	

	public function Buscar_Cualquier_yerba($sel , $tabla , $wer , $campo_orden = false , $orden  = false , $forma = false, $P_paginac=false , $P_pag="")
	{
		$exito		=	false;
		$objCons 	=  	new consultor;
		$objEjec 	=  	new ejecutorSQL();	
		if($campo_orden == true)
		{
			$objCons->setearCamposOrder($campo_orden);
		}

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
		
				if($total > 1)
				{
					for($i = 0; $i < $total + 1 ; $i++)
					{
						if(!empty($_POST['Ent_'.$i]) && $_POST['Ent_'.$i] != ''):
							$val_ = $Data;
							//insertar
							$result = $objEjec->insertarRegistro($tabla,$Campos,$val_);
							$exito	=	'Se ha ingresado el registro satisfactoriamente';
						endif;
					}
				}
				else
				{
					
					$val_ 	= $Data; 
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