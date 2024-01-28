<?PHP
	/*
 		Clase ProcRoles
	*/
	
class RolesTurnos
{
	public function RolesTurnos () 
	{
		return true;
	}
	
	//EVALUAR POST
	//=============
	/*
	public function EvaluarPOST($P_dato,$P_especial = false)
	{
		if($P_especial == true):
			$exito		=	isset($_POST[$P_dato])?$_POST[$P_dato]:$P_especial;
		else:
			$exito		=	isset($_POST[$P_dato])?$_POST[$P_dato]:'';
		endif;
		return $exito;
	}
	*/
	//Guardar data en temp
	/*
		Parametros:
			-	P_Tabla				=	Tabla a utilizar
			-	P_Meses				=	Meses a guardar
	*/
	public function GuardarData($P_Sel, $P_Tabla , $P_Where, $P_Tabla_tmp = false, $P_Campos_tmp  = false, $P_idUser = false , $P_CuantasVeces = false, $P_Otros = false, $P_Mes = false)
	{
		$exito			=	false;
		$SQL_			=	false;
		$P_ValoresColum	=	false;
		$objCons 		= 	new consultor();
		$Data			=	false;
		$nn				=	0;
		$sql			=	false;
		//Hacer el query tipo RAND
		//SELECT * FROM tabla_elbitcampeador ORDER BY RAND() LIMIT 100;
		if($P_CuantasVeces != false)
		{
			
			for($TT	=	0	;	$TT < $P_CuantasVeces+1	;	$TT++)
			{

			//$sql			=	mysql_query('SELECT * FROM '.$P_Tabla_tmp.' WHERE ');
			
			$SQL_			=	mysql_query('SELECT '.$P_Sel.' FROM '.$P_Tabla.' WHERE '.$P_Where.' ORDER BY RAND(),c2,c14,c30 ASC ') or die('Error 504 inesperado en mysql: '.mysql_error());
			$P_FindSQL		=	mysql_num_rows($SQL_);
			
			// Hacer el calculo de el total de usuarios
			// y el total de formulas encontradas.
			$TotForm_		=	$P_FindSQL;
			$TotUsers_		=	$P_CuantasVeces;
		
			if(mysql_num_rows($SQL_) > 0)
			{	
				While($Data	=	mysql_fetch_array($SQL_))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum	!=	'')
							{
								$P_ValoresColum .=  ',';
							}	
							$P_ValoresColum		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}
						$P_Esto	=	'1,"'.$P_idUser.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum.',"'.$Data['dpto'].'","'.$Data['area'].'","'.$P_Mes.'","'.$P_Otros.'"';
						mysql_query("INSERT INTO ".$P_Tabla_tmp." ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum = '';
						$rh				=	0;
				}
			}
			//$P_Result		=	$objMante->Listar('911_mant_formulas', $P_Were,false, false, false, false, 'array');
			
			// SELECT * FROM Tabla1 ORDER BY RAND() LIMIT 1 WHERE Campo1 NOT IN (SELECT campo2 FROM Tabla2)
			// SELECT * FROM Tabla ORDER BY RAND() LIMIT 1
			//SELECT columna FROM table
			//ORDER BY RAND()
			//LIMIT 1
			}
		}
	}
}
	
?>