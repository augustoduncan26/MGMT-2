<?php

	class idioma{
	
	function idioma()
	{
		
	}
	
	function Buscaridioma()
	{
		$sess		=	new sesion();
		$dta		=	$sess->consultarIdSesion();
		$objCons 	=  	new consultor;
		
		$wr		=	"id_session = '".$dta."'";
		$objCons->consultar("*", 'ad_session',$wr);
		
		if($objCons->totalFilas > 0)
		{
			$reg   	= 	$objCons->extraerRegistro();
			$exito	=	$reg['idioma'];	
		}
		else
		{
			$exito	=	'es';	
		}
		return ($exito);
	}
	
	function BuscarActualizarIdioma()
	{
		$sess		=	new sesion();
		$dta		=	$sess->consultarIdSesion();
		$objcmsIndx		 	= 	new cms();
		$idusIndex 	      	= 	$objcmsIndx->consultarID();
		$objuserIndex	 	=  	new usuario();
		$InfoUserIndex		=	$objuserIndex->consultarUsuario($idusIndex);
		
		$exito 	 	= 	false;
		$objCMS 	=  	new cms() ;	
		$objCons 	=  	new consultor;
		$objEjec 	=   new ejecutorSQL();
		
		if(isset($_GET['idioma'])):
			
			$wr		=	"id_session = '".$dta."'";
			$objCons->consultar("*", 'ad_session',$wr);
			
			if($objCons->totalFilas > 0)
			{
				$tbl = 'ad_session';
				$tbl2= 'ad_admin_empresas';

				$cmp = "idioma = '$_GET[idioma]'";
				
				$whr = "id_session ='".$dta."'";
				$whr2 = "id_empresa ='".$InfoUserIndex['id_empresa']."'";

				$result = $objEjec->actualizarRegistro($cmp, $tbl, $whr);
				$result = $objEjec->actualizarRegistro($cmp, $tbl2, $whr2);
				
			}
		endif;
		
			$wr		=	"id_session = '".$dta."'";
			$objCons->consultar("*", 'ad_session',$wr);
			
			if($objCons->totalFilas > 0)
			{
				$reg   	= 	$objCons->extraerRegistro();
				$exito	=	$reg['idioma'];	
			}
			
		return ($exito);	
	}
}
?>