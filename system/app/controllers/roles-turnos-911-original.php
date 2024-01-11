<?PHP
	$objUsuario 	=  	new usuario();
	$objPermiso		=	new permisos();	
	$objWebControl	= 	new WebControl();
	$objPaginador 	= 	new paginador();
	$objPFecha		=	new fecha();
	$objRolTurno	=	new RolesTurnos();	
	$objejec 		=  	new ejecutorSQL();

	$Matriz			=	FALSE;
	
	$objCMSMenu 	= 	new cms();
	$objMante		= 	new Mantenimientos();
	$idUs 	      	= 	$objCMSMenu->consultarID();
	$POST			=	$objMante->ValuePOST('post');
	/*
		$POST[0]		=		value todos		/	areas
		$POST[1]		=		value Generar (Boton)
		$POST[2]		=		value usuarios
		$POST[3]		=		value fecha de
		$POST[4]		=		value fecha a
		$POST[5]		=		value año
	*/
	//
	$P_TotalMeses		=	FALSE;
	// Saber el total de meses seleccionado
	for($mess = $POST[3]	;	$mess	<	$POST[4]+1 ; $mess++)
	{
		$P_TotalMeses	=	$P_TotalMeses+1;
	}
	
	$ToT			=	FALSE;
	$meses_evaluar	=	FALSE;
	$P_TDMeses		=	FALSE;
	$PCaracter		=	FALSE;
	$P_TotUser		=	FALSE;
	$P_OtroMes		=	FALSE;
	$P_Spry			=	FALSE;
	$P_Conten		=	FALSE;
	$P_Res			=	FALSE;
	$IDLABEL		=	FALSE;
	$NOMBLABEL		=	FALSE;
	$BGCOLOR		=	FALSE;
	$Rs				=	FALSE;
	$Rs2			=	FALSE;
	$OPTION			=	FALSE;
	$RAND			=	FALSE;
	$RAND2			=	FALSE;
	$INTPUT			=	FALSE;
	
	$POST_seis		=	isset($_POST['seis'])	?$_POST['seis']	:	'';
	$POST_dos		=	isset($_POST['dos'])	?$_POST['dos']	:	'';
	$POST_diez		=	isset($_POST['diez'])	?$_POST['diez']	:	'';
	
	$Tot_turnoA		=	0;
	$Tot_turnoB		=	0;
	$Tot_turnoC		=	0;
	$HAY_c_1		=	0;
	$HAY_c_2		=	0;
	$HAY_c_3		=	0;
	$VACIAR			=	1;
	
	$GET_opt		=	isset($_GET['opt'])?$_GET['opt']:'';				// Buscar opciones de seleccion
	
	$color2			=	"#E8FFE8";
	$color			=	"#FFFFFF";
	
	// Segun opciones del Param opt ?
	switch($GET_opt)
	{
		case 'busc':
			$P_ocultar	=	TRUE;
		break;
	}
	
	
	// SI QUIERE REGRESAR ENTONCES BORRAR LOS RESULTADOS
	if($GET_opt == 'back')
	{
		$objejec->vaciarTabla('911_rolturn_desp_tmp');	
		//$objejec->vaciarTabla('911_rolturn_desp_tmp_2');	
		$objejec->vaciarTabla('911_rolturn_desp_tmp_rand');	
	}
	//echo $POST[0];
	// Informacion del usuario
	$P_InfoUser		=	$objUsuario->consultarUsuario($idUs);
	// Buscar id de despacho
	$P_idDepto		=	$objMante->BuscarLoQueSea('*' ,'911_mant_depto', 'seccion like "%despach%"','extract');
	$PIDDEPTO		=	$P_idDepto['id_seccion'];
	$P_Where		=	'id_depto="'.$P_idDepto['id_seccion'].'"';			
	$ListaAreas		=	$objMante->Listar('911_mant_areas', $P_Where,false,false,false,false,'array');		//	Litar las secciones ò areas segun dpto.DESPACHO
	
	//PARAMETROS DE USO INTERNO
	/*
		 - Para generar fecha_de, fecha_a,
		 - Label (Etiqueta) para los list de los meses
		 - Para saber total de usuarios promedio dependiendo del depto.
		 - Buscar max y min de las areas
	*/
	//=========================
	$DIGITOS		=	array('0','1','2','3','4','5','6','7','8','9','10','11','12');			
	$MESES			=	array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$DIGITOS2		=	array('0','01','02','03','04','05','06','07','08','09','10','11','12');
	
	// EXPLODE DE LAS AREAS
	function NombredeArea($Data = false)
	{
		global	$objMante;
		//echo $Data[0];
		$P_Val	=	explode('-',$Data);
		$P_Son	=	count($P_Val);
		for($xy = 0 ; $xy < $P_Son ; $xy++)
		{	//echo $P_Val[$xy];
			$Nombre		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Val[$xy].'"','extract');
			if($P_Data!='')
			{
				$P_Data .=  '-';
			}
			$P_Data		.=	 strtoupper(substr($Nombre['nombre'],0,15)).'...';	
		}
		return ($P_Data);
	}
	
	// CONTAR CANTIDAD DE CRITERIOS, SEGUN CRITERIO
	/*
	
	*/

	//Conocer total de usuario promedio segun grupo
	//**********************************************
	$P_TotUser	=	$objMante->PromUsers('911_mant_areas','usuarios','id_depto = "'.$PIDDEPTO.'" '); 	
	
	//Conocer usuarios que son de este DPTO
	$Wer_user		=	'id_depto = "'.$PIDDEPTO.'" and activo = "1" ORDER BY id_area,nombre ASC';
	$P_UserDpto		=	$objMante->Listar('usuario', $Wer_user,false,false,false,false,'array');
	
	$ID				=	FALSE;
	$MANTID			=	FALSE;
	if(isset($P_UserDpto['resultado'])):
			//$LABEL	=	'<option value="" selected>-Escoja-</option>';
		foreach($P_UserDpto['resultado'] as $Labels)
		{
			$IDLABEL	=	$Labels['id_usuario'];//'<option id="'.$Labels['id_usuario'].'">'.$Labels['nombre'].'&nbsp;'.$Labels['apellido'].'</option>';	
			$NOMBLABEL	=	$Labels['nombre'].'&nbsp;'.$Labels['apellido'];
			
			//SETEAR EL NOMBRE DE LOS GRUPOS (AREAS)
			$P_NArea	=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id = "'.$Labels['id_area'].'"','extract');
			if($Labels['id_area']!=$MANTID):
				//<optgroup label="Lenguajes del lado servidor">
				//if($POST[0][0]==$P_NArea['id']):
					//$OPTION		.=	'<option value="'.$P_NArea['nombre'].'" selected></option>';
				//;else:
					$OPTION		.=	'<optgroup label="--- '.strtoupper($P_NArea['nombre']).' ---" style="background-color:yellow"></optgroup>';
				//endif;
				$MANTID		=	$Labels['id_area'];
			endif;
			//PONER LOS NOMBRES DE LOS INDIVIDUOS, AGRUPADOS POR: (id_area,nombre)
			if($Labels['id_usuario']!=$ID):
				$ID			=	$Labels['id_usuario'];
				//Buscar otra info del usuario en la tabla empleados
				$Wer__		=	'nempleado = "'.$Labels['nempleado'].'"';
				$P_OtraInfo	=	$objMante->Listar('911_empleados', $Wer__,false,false,false,false,'extract');
				if(trim($P_OtraInfo['licconducir'])!=''): $P_LICENCIA	=	'Con Licencia';;else:$P_LICENCIA	=	'Sin Licencia';endif;   //$P_NArea['nombre']
				$OPTION		.=	'<option value="'.$Labels['id_usuario'].'" title="'.$NOMBLABEL.' - '.$P_LICENCIA.'">'.$NOMBLABEL.'</option>';
			endif;
			
			
		}
	endif;



	if($POST[1] == 'Generar')
	{
		/*
			1. Buscar en las formulas de acuerdo al area
			2. Contar para cuantos usuarios se requiere tirar el turno
			3. Saber para cuantos meses		
		*/	
		//1. Cuantas formulas debo buscar?
		// ===============================
		//in_array
		$P_Sale			=	'';
		$P_Data			=	false;
		$Letra			=	false;
		$clave			=	false;
		$P_ParaCuantos	=	false;						//  Saber para cuantos usuarios es toda esta vaina
		$P_Tot			=	count($POST[0]);			//	Saber el total de las areas
		
		$error			=	0;	
		$date			=	date('Y-m-d');
		// PARA TODAS LAS AREAS
		if($POST[0]	==	'todos'):
			$P_Cuantos		=	$objMante->BuscarLoQueSea('*','911_mant_areas','id_depto="'.$PIDDEPTO.'"','array');
			$P_Cuantos['total'];
			
			//Arreglar la data para poder comparar
			foreach($P_Cuantos['resultado'] as $P_Depto)
			{	
				if($P_Data!='')
				{
					$P_Data .=  '-';
				}
					$P_Data		.=	 $P_Depto['id'];		
			}
			
		// UNA SOLA AREA
		;else:
			
			//$P_Data		=	NombredeArea($POST[0]);
			
			for($x	=	0	;	$x		<	$P_Tot	;	$x++)
			{
				if($P_Data!='')
				{
					$P_Data .=  '-';
				}
					$P_Data		.=	 $POST[0][$x];	
					
			}
		endif;
		//echo $P_Data.'<br>';
// ESTO ES PARA SI VAN A TIRAR ROL DE TURNO PARA VARIAS 
// AREAS. POR AHORA NO LO ESTOY UTILIZANDO, ASI QUE SE VA POR,,, ELSE
// Buscar las areas
		if(!is_numeric($P_Data)){ 
			//echo $Data['area'];
			//echo strtoupper('Todas');
			//in_array
			$P_Val	=	explode('-',$P_Data);
			$P_Son	=	count($P_Val);
			$P_Label=	false;
			//echo $P_Val[2];
			for($xy = 0 ; $xy < $P_Son ; $xy++)
			{	//echo $P_Val[$xy];
				$Nombre		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Val[$xy].'"','extract');
				if($P_Label!='')
				{
					$P_Label .=  '-';
				}
				$P_Label		.=	 strtoupper(substr($Nombre['nombre'],0,15)).'...';	
			}
			
			$N_Area['turno_a']	=	$Nombre['turno_a'];
			$N_Area['turno_b']	=	$Nombre['turno_b'];
			$N_Area['turno_c']	=	$Nombre['turno_c'];
			
			$P_Areas	=	'Para: '.$POST[2].' usuarios; - areas: '.$P_Label;
			
		}
		else
		{
// SI TOMAN LA OPCION: OTROS PARAMETROS
// ====================================
			if(isset($_POST['especial'])): $Tott_esp		=	count($_POST['especial']); $TOTAL_CAMPOS = ($POST[2]+$Tott_esp); ;else: $TOTAL_CAMPOS = $POST[2];endif;
			$N_Area		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Data.'"','extract');
			$P_Areas	=  strtoupper('Para: '.$TOTAL_CAMPOS.' usuarios, - area: '.substr($N_Area['nombre'],0,20));
		}
// MAXIMO Y MINIMO SEGUN 
// EL AREA Y EL HORARIO
//-------------------------

		if($POST_seis	!=''): 	$N_Area['turno_a'] 	= 	$POST_seis+2	;	endif;
		if($POST_dos	!=''):	$N_Area['turno_b']	=	$POST_dos+2	;	endif;
		if($POST_diez	!=''):	$N_Area['turno_c']	=	$POST_diez+1;	endif;
		
		$Tot_SegArea	=	($N_Area['turno_a'] + $N_Area['turno_b'] + $N_Area['turno_c']);
		$Tot_SegArea;
		if($Tot_SegArea == $POST[2])
		{	$Tot_x			=	$Tot_SegArea;
			}
			else
			{
			$Tot_x			=	$POST[2];//($POST[2]-$Tot_SegArea);//($Tot_SegArea-$POST[2]);//

		}
//--------------------------
		
		// Aqui empieza la evitadera del refresh
		$Wer		=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'"';
		$BuscaFind	=	$objMante->BuscarLoQueSea('*' , '911_rolturn_desp_tmp',$Wer);
		$objejec->vaciarTabla('911_rolturn_desp_tmp');
		$objejec->vaciarTabla('911_rolturn_desp_tmp_rand');

			// Ocultar el menu principal
			// =========================
			$P_ocultar		=	true;
			$P_VerSalida	=	TRUE;
			$SONMESES		=	0;
			//$msg			=	'Existen datos para esta misma seleccion que no ha guardado aun.<br /> Para verlos click <a href=?pag=rolturno&area='.$P_Data.'&dpto='.$PIDDEPTO.'&fecha='.$date.'>Aqui.</a>';	
		//}else{
// AQUI EMPIEZO A GUARDAR
// LOS DATOS POR CADA MES 
// QUE SE SELECCIONE
		for($rrh = $POST[3]	;	$rrh	<	$POST[4]+1 ; $rrh++){ 
			//echo $rrh.'<br>';
			$SONMESES=$SONMESES+1;
			$clave			=	mt_rand(26081970,19700826);	//	Evitar el refresh del navegador por el usuario
			//Buscar datos acuerdo a los seleccionado
			$P_Were 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			$P_Were2 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			$P_Were3 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			$P_Campos_tmp	=	'(user,id_usuario,ncorto,fecha,';
		
			for($rh	=	1	; $rh	< 32 ; $rh++)
			{
				$P_Campos_tmp	.=	 'c'.$rh.',';	
			}
			$P_Campos_tmp	.= 	'dpto,area,meses,clave,publicar,horario';
			$P_Campos_tmp	.=	')';
			
			$P_ParaCuantos	=	$POST[2];
			//$P_Roles1		=	$objRolTurno->GuardarData('*', '911_mant_formulas' , $P_Were, '911_rolturn_desp_tmp', $P_Campos_tmp, $idUs , $P_ParaCuantos, $clave, $DIGITOS[$rrh]);
			//$P_Roles2		=	$objRolTurno->GuardarData('*', '911_mant_formulas' , $P_Were2, '911_rolturn_desp_tmp', $P_Campos_tmp, $idUs , $P_ParaCuantos, $clave, $DIGITOS[$rrh]);
			//$P_Roles3		=	$objRolTurno->GuardarData('*', '911_mant_formulas' , $P_Were3, '911_rolturn_desp_tmp', $P_Campos_tmp, $idUs , $P_ParaCuantos, $clave, $DIGITOS[$rrh]);
			
// GUARDAR DE OTRA MANERA
// ======================
			$P_Horarios			=	array('6','2','10','x');
// TURNO A : 6 AM	
//echo $N_Area['turno_a'];

			$SQL_1			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[0].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_a'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
			$P_FindSQL1		=	mysql_num_rows($SQL_1);
			$TotForm_1		=	$P_FindSQL1;
			$TotUsers_		=	$P_ParaCuantos;
			$T				=	0;
			if(mysql_num_rows($SQL_1) > 0)
			{
				$P_ValoresColum1		=	false;
				While($Data	=	mysql_fetch_array($SQL_1))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum1	!=	'')
							{
								$P_ValoresColum1 .=  ',';
							}	
							$P_ValoresColum1		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum1.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum1 = '';
						$rh				=	0;
						$T ++;
				}
			}
// FIN TURNO A: 6 AM
// ==========================================
// TURNO B: 2 PM
			$SQL_2			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[1].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_b'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
			$P_FindSQL2		=	mysql_num_rows($SQL_2);
			$TotForm_2		=	$P_FindSQL2;
			$TotUsers_		=	$P_ParaCuantos;
			$TT				=	0;
			if(mysql_num_rows($SQL_2) > 0)
			{
				$P_ValoresColum2		=	false;
				While($Data	=	mysql_fetch_array($SQL_2))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum2	!=	'')
							{
								$P_ValoresColum2 .=  ',';
							}	
							$P_ValoresColum2		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum2.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum2 = '';
						$rh				=	0;
						$TT ++;	
				}
			}
// FIN TURNO B : 2 PM
// =========================================================
// TURNO C : 10 PM
			
			$SQL_3			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[2].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_c'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
			$P_FindSQL3		=	mysql_num_rows($SQL_3);
			$TotForm_3		=	$P_FindSQL3;
			$TotUsers_		=	$P_ParaCuantos;
			$TTT			=	0;
			if(mysql_num_rows($SQL_3) > 0)
			{
				$P_ValoresColum3		=	false;
				While($Data	=	mysql_fetch_array($SQL_3))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum3	!=	'')
							{
								$P_ValoresColum3 .=  ',';
							}	
							$P_ValoresColum3		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum3.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum3 = '';
						$rh				=	0;
						$TTT ++;	
				}
			}
			
// FIN TURNO C: 10 PM
// ================================================
// EL RESTO EN DIAS LIBRES : X
			$SQL_4			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = "'.$P_Horarios[3].'" AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$Tot_x.'') or die('Error 504 inesperado en mysql: '.mysql_error());
			$P_FindSQL4		=	mysql_num_rows($SQL_4);
			$TotForm_4		=	$P_FindSQL4;
			$TotUsers_		=	$P_ParaCuantos;
			$TTTT			=	0;
			if(mysql_num_rows($SQL_4) > 0)
			{
				$P_ValoresColum4		=	false;
				While($Data	=	mysql_fetch_array($SQL_4))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum4	!=	'')
							{
								$P_ValoresColum4 .=  ',';
							}	
							$P_ValoresColum4		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum4.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum4 = '';
						$rh				=	0;
						$TTTT ++;	
				}
			}
// FIN DIAS LIBRES : X			
			// Ocultar le menu principal
			$P_ocultar		=	true;
			$P_VerSalida	=	TRUE;
			//$rh				=	'';
			//$P_Campos_tmp	=	'';
			$P_Roles1		=	'';
			$P_Roles2		=	'';
			$P_Roles3		=	'';
			$P_ParaCuantos	=	'';
			$TOTALESTOTALES	=	FALSE;
			$aleatorios	= false;$nuevo=false;$max=0;
// OTRA FORMA MAS
// PASAR TODO A LA TABLA RAND, DE MANERA ALEATORIA
// ================================================

			$TOTALESTOTALES	=	($TotForm_1 + $TotForm_2+$TotForm_3+$TotForm_4);
			$POST[2];
			// LLENO EL ARRAY CON LOS VALORES

			for ($i=0; $i<$TOTALESTOTALES; $i++)  
            {  
				$aleatorios[$i]	=	$i;
			}
			$SQL__			=	mysql_query('SELECT * FROM 911_rolturn_desp_tmp WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'" AND meses="'.$DIGITOS[$rrh].'" ORDER BY RAND() ASC LIMIT '.$POST[2]) or die('Error 504 inesperado en mysql: '.mysql_error());
            
			$P_FindSQL_		=	mysql_num_rows($SQL__);
			$TTTT 			=	0;
			
			$P_ValoresColum5		=	false;
				While($Data	=	mysql_fetch_array($SQL__))
				{	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++)
					{
							if($P_ValoresColum5	!=	'')
							{
								$P_ValoresColum5 .=  ',';
							}	
							$P_ValoresColum5		.=	 "'".$Data['c'.$rh]."'";	
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum5.',"'.$Data['dpto'].'","'.$Data['area'].'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp_rand ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysql_error());
						$P_ValoresColum5 = '';
						$rh				=	0;
						$TTTT ++;	
						$NCORTO_		=	$Data['ncorto'];
						$DEPARTO_		=	$Data['dpto'];
						$AREA_			=	$Data['area'];
				}

// =============================================================
// =============================================================
// MOSTRAR FILAS EXTRAS
// SI SE TOMA LA OPCION DE OTROS PARAMETROS
			if(isset($_POST['especial']) && $_POST['especial']):
				$Tott_		=	count($_POST['especial']);
				
				$P_Valores_	=	false;
				
				for($z	=	0	;	$z	< $Tott_	;	$z++):

						for($y	=	1	;	$y < 32 ; $y++):
					
							if($P_Valores_	!=	'')
							{
								$P_Valores_ .=  ',';
							}	
							$P_Valores_		.=	 "'".$_POST['especial'][$z]."'";

						endfor;
						//echo $z;
						$P_Esto_		=	'1,"'.$idUs.'","","'.date('Y-m-d').'",'.$P_Valores_.',"'.$DEPARTO_.'","'.$AREA_.'","'.$DIGITOS[$rrh].'","'.$clave.'",0,"R"';
						mysql_query("INSERT INTO 911_rolturn_desp_tmp_rand ".$P_Campos_tmp." VALUES (".$P_Esto_.")") or die('Error en la consulta: '.mysql_error());
						$P_Valores_ 		= 	'';
						$y					=	0;
				endfor;
			endif;	
// =============================================================
// =============================================================
				
// FIN DEL PASO A LA TABLA RAND
// VACIAR LA TABLA TMP
				if($VACIAR == 1)
				{
					$objejec->vaciarTabla('911_rolturn_desp_tmp');
					$VACIAR++;
				}
		}
// FIN DEL FOR
// GUARDAR LOS DATOS POR CADA MES
// SELECCIONADOS

		// EMPEZAR PROCESO DE LOS MESES A CALCULAR Y MOSTRAR
		//    - Saber cuantos meses en numero
		/* *************************************************
				Parametros:
					- 	$P_TDMeses
					- 	$P_OtroMes
					-  messig				=	siguiente mes
					-  mesact				=	el mes actual
		*/
		//    - Sacar cada total de dias por mes
		// **************************************
		//$P_Conten	.= '<iframe>';
		$P_TDMeses		=	'<table><tr>';
		
		// Eliminar la data que exista retrasada en
		// 911_rolturn_desp_tmp_2, para nno estar duplicando
		// Podria usar el truncate pero debo verificar varias cosas
		
		$Wer_b		=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'"';
		$objejec->vaciarTabla('911_rolturn_desp_tmp_2');
// AQUI DIVIDIR LA INFORMACION POR LA CANTIDAD DE MESES SELECCIONADAS
/* ******************************************************************
*/

		for($r = $POST[3]	;	$r	<	$POST[4]+1 ;$r++){ 
			//$Tot_turnoA	=	0;
			$meses_evaluar=$meses_evaluar+1;
			if($PCaracter!='')
			{
				$PCaracter	.=	' | ';			
			}			
				$P_TDMeses	.=	'<td id="opt'.$r.'" onmouseover="SombreadoCampos(\'opt\''.$r.'\',\'1\'); " onmouseout="SombreadoCampos(\'opt\''.$r.'\',\'0\')"';
				$P_TDMeses	.=	'style="font-size:10px; font-family:Verdana, Geneva, sans-serif;"">';
				// $PCaracter	=	$P_TDMeses;
				// Crear el Spry
				$P_Spry		.=	'<li style="font-size:10px;width:60px; font-family:Verdana, Geneva, sans-serif;" class="TabbedPanelsTab comun_titulos_2" onmouseover="SombreadoCampos(\'Tab'.$P_OtroMes.'\',\'1\'); this.style.Cursor=\'pointer\'" onmouseout="SombreadoCampos(\'Tab'.$P_OtroMes.'\',\'0\')" id="Tab'.$P_OtroMes.'" tabindex="'.$P_OtroMes.'" onclick="javascript: document.getElementById(\'Tab'.$P_OtroMes.'\').style.backgroundColor=\'#000\'">'.$MESES[$r].'</li>';
				//onclick="SombreadoCampos(\'Tab'.$P_OtroMes.'\',\'Tab\',6)" 
				
				$P_Conten	.=	'<div class="TabbedPanelsContent" style="width:100%;background-color:#FFF"><font face="Verdana"><strong>'.strtoupper('turnos del mes de '.$MESES[$r]).'</strong></font>';
				$P_Res		.=	$objPFecha->UltimoDia(date('Y'),$DIGITOS2[$r]);
				$P_Conten	.=	'<p /><table border=0 width="100%" class="bordeTodalaTabla_2">';
				$n			 =	0;
				$x			 =	0;
					// Dibujar el total de filas
					/* =========================
						Representan el total de usuarios
						que se necesitan por mes.
					*/
					//.$MESES[$r]
					$P_Conten	.=	'<tr>';
					$P_Conten	.=	'<td style="width:100px; font-size:12px; color:RED" ><marquee direction="left">Hay ('.$TOTALESTOTALES.') formulas.</marquee></td>';
					/*	==========================================
						Dibujar los nombres de las columnas
						para cada dia.
						De igual buscar el nombre del dia segun
						la fecha del dia, del mes.
						==========================================
						Letras del dia
					*/
					
						for($d	=	1	;	$d	<	$P_Res+1	;	$d++):
							// Buscar el dia segun mes y año
							$Letra		=	$objPFecha->NombreDelDia($DIGITOS2[$r], $d , $POST[5]);
							$Letra2		=	substr($Letra,0,1);
							if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =	'bgcolor="#E8FFE8" ';}else{$BGCOLOR =	'';}
							$P_Conten	.= '<td width="20px" '.$BGCOLOR.' class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$Letra.'&nbsp;'.$d.'">'.$Letra2.'</td>';
						endfor;
					$P_Conten	.=	'<td style="width:50px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" colspan=3>&nbsp;T</td>';	
					$P_Conten	.=	'</tr>';
					
					$P_Conten	.=	'<tr>';
					$P_Conten	.=	'<td colspan=>&nbsp;</td>';
					// Dias en numeros
						for($dd	=	1	;	$dd	<	$P_Res+1	;	$dd++):
							$P_Conten	.= '<td width="20px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$dd.'">'.$dd.'</td>';
						endfor;
					$P_Conten	.=	'</tr>';
					
// INSERTAR EN LA TABLA temp_2, 
// LA COMBINACION DEL RAND, SEGUN CONSULTA	
// Segun la consulta de:
//  (total meses y total usuarios )	
// Ejem: hacia abjao, los usuarios
					for($h	=	0	;	$h	<	$POST[2]	;	$h++):
					
					$n++;	

					// Darle color a las filas
					// Buscar la informacion en la Tabla tmp
						$objConstr 	= 	new consultor();

						$P_Weretmp	=	'fecha = "'.$date.'" and id_usuario = "'.$idUs.'" and  meses = '.$DIGITOS2[$r];
						$P_Camps	=	$objMante->ListadeCampos();
						$P_Camps	.=	'dpto,area,user,id_usuario,meses,fecha,id, ncorto,clave';
						//Setear orden
						//$objConstr->setearCamposOrder(' ORDER BY RAND() ');
						//$P_Data		=	$objConstr->consultar($P_Camps,'911_rolturn_desp_tmp',$P_Weretmp);
						//$P_Exito 	= 	$objConstr->extraerRegistro();
						//,c31,c15,29,id = 15 , LIMIT
						//$SQL_			=	mysql_query('SELECT '.$P_Camps.' FROM 911_rolturn_desp_tmp  WHERE '.$P_Weretmp.' ORDER BY RAND() ASC') or die('Error 505 inesperado en mysql: '.mysql_error());
						//SELECT name FROM random JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM random)) AS id) AS r2 USING (id);
						
						$SQL_			=	mysql_query('SELECT '.$P_Camps.' FROM 911_rolturn_desp_tmp_rand  WHERE '.$P_Weretmp.' ') or die('Error 505 inesperado en mysql: '.mysql_error());
						$P_FindSQL		=	mysql_num_rows($SQL_);
						$P_Exito		=	mysql_fetch_array($SQL_);

						// INSERTAR EN TABLA temp_2
						$P_Campos_tmp2	=	'(user,id_usuario,ncorto,fecha,';
						for($rhh	=	1	; $rhh	< 32 ; $rhh++)
						{
							$P_Campos_tmp2	.=	 'c'.$rhh.',';	
						}
						$P_Campos_tmp2	.= 	'dpto,area,meses,clave,publicar,horario';
						$P_Campos_tmp2	.=	')';
						//echo $P_Campos_tmp;
						// Capturar los valores de los campos
						$P_ValoresColum2	=	false;
						for($rrh	=	1	;	$rrh < 32 ; $rrh++)
						{
							if($P_ValoresColum2	!=	'')
							{
								$P_ValoresColum2 .=  ',';
							}	
							$P_ValoresColum2	.=	"'".$P_Exito['c'.$rrh]."'";	
						}
						$error_b	=	false;
						
				
						mysql_query('insert into 911_rolturn_desp_tmp_2 select * from 911_rolturn_desp_tmp_rand');
						
						$P_Campos_tmp2		=	false;
						$P_ValoresColum2	=	false;
						$rrh				=	0;
						//$HAY_c_1;//			=	0;
						
						
					endfor;
					//echo $POST[2];
					// AQUI LIMPIO ESTA VARIABLE
					$Tot_turnoA		=	0;
					$Tot_turnoB		=	0;
					$Tot_turnoC		=	0;
					// CAMBIAR EL LIMIT, SI HAY OTROS PARAMETROS
					if(isset($_POST['especial']) && $_POST['especial']): $POST[2]	=	$POST[2] + count($_POST['especial']); endif;
					// OTRA FORMA DE HACERLO
					// PA VER SI ESTA SI PEGA
					$Wer_c			=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'" and meses = "'.$DIGITOS[$r].'"';
					$SQL_			=	mysql_query('SELECT '.$P_Camps.' FROM 911_rolturn_desp_tmp_2  WHERE '.$Wer_c.' LIMIT '.$POST[2]) or die('Error 505 inesperado en mysql: '.mysql_error());
					$P_FindSQL		=	mysql_num_rows($SQL_);
					
					//echo count($DIGITOS[$r]);
					$P_FindSQL		=	($P_FindSQL * $DIGITOS[$r]);
					
					$morder			=	false;
					$wn				=	0;
					$TurnoA6		=	0;
					$TurnoA2		=	0;
					$TurnoA10		=	0;
					$nuser_z		=	0;
					$NN				=	0;
					
// DIBUJAR LOS CAMPOS Y VALORES
//==============================
// INICIO DEL WHILE		//	Inicio de todo lo que quiero mostrar
//echo $P_Res;
					while($P_Exito2	=	mysql_fetch_array($SQL_))
					{ 
// DESDE AQUI LAS FILAS SEGUN TOTAL DE USUARIOS
// por id, Ejem. fila 1, fila 2, fila 3, etc...
						$P_Conten	.=	'<tr id="fila_'.$n.'" onMouseOver="this.style.backgroundColor=\'#FFFF00\';" onMouseOut="this.style.backgroundColor=\'\';"';
					
						if($x==0):
							$P_Conten	.=	'bgcolor="'.$color.'"';
							$x = 1;
							;else:
							$P_Conten	.=	'bgcolor="'.$color2.'"';
							$x=0; 
						endif;
						$P_Conten	.=	'>';
						$Tota	=	false;
						
// DESDE AQUI LAS COLUMNAS DE LAS FILAS
// por id, Ejem. fila 1 ( dia 1), fila 1 ( dia 2), fila 1 ( dia 3), etc...
						for($w	=	0	;	$w	<	$P_Res	;	$w++):
						//@$NCampo		=	 mysql_field_name($SQL_, $w-1);			// Buscar el nombre del campo       ///     #becfc4
						$P_Conten	.=	'<td width="20px" onMouseOver="this.style.backgroundColor=\'#FF0000\';" onMouseOut="this.style.backgroundColor=\'\';"';
							//$P_Conten	.=	'<td width="20px" id="'.$NCampo.'" onmouseover="SombreadoCampos(\''.$NCampo.'\',\'1\'); this.style.Cursor=\'pointer\'" onmouseout="SombreadoCampos(\''.$NCampo.'\',\'0\')"';
							$P_Conten	.=	'>';
							$NCampo		=	 mysql_field_name($SQL_, $w);			// Buscar el nombre del campo

							//echo $NCampo
							include('911_criterios_de_calculos.php');
					// AQUI LOS CAMPOS CON LOS VALORES
					// ===============================
							 if($w==0):
							 		
									$P_Conten   .=  '<select id="user-'.$P_Exito2['id'].'" name="user-'.$P_Exito2['id'].'" style="width:130px" onchange="javascript: OtroGuardadoRapido(\'user-'.$P_Exito2['id'].'\' ,\'911_rolturn_desp_tmp_2\', \''.$P_Exito2['id'].'\', \'id\');" title="user-'.$P_Exito2['id'].'">';
									$P_Conten   .=	'<option value="">Escoja</option>';
									$P_Conten   .=	$OPTION;//'<option id="'.$IDLABEL.'">'.$NOMBLABEL.'<option>';
									$P_Conten   .=	'</select>';
									//'<input style="width:70px" type=text id="c'.$w.'" name="c'.$w.'" value="c'.$w.'" />ssd';return TotalXs(\'id\',\''.$NCampo.'\',\''.$P_Res.'\')
									$P_Conten   .=  '<td>';
									//EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$POST[2].'\',\''.$P_Exito2['id'].'\',\''.$DIGITOS[$r].'\');
									$P_Conten	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');GuardadoRapido(\''.$NCampo.'\' ,\'911_rolturn_desp_tmp_2\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo.'" id="'.$P_Exito2['id'].'-'.$NCampo.'" style="width:20px;" value="'.$P_Exito2[$w].'" />';
									//$P_Conten	.=	'<div title="'.$P_Exito2['id'].'-'.$NCampo.'" onkeypress="return permite(event,\'pform\')" class="alrededorRojo" id="'.$P_Exito2['id'].'-'.$NCampo.'" onclick="javascript: creaInput(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'911_rolturn_desp_tmp_2\',\'id-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'24\',\'911_RolesTurnoDespa.php\'); " style="width:24px; text-align:center">'.$P_Exito2[$w].'</div></td>';
									$P_Conten   .=  '</td>';
								;else:
									//EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$POST[2].'\',\''.$P_Exito2['id'].'\',\''.$DIGITOS[$r].'\');
									$P_Conten	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');GuardadoRapido(\''.$NCampo.'\' ,\'911_rolturn_desp_tmp_2\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo.'" id="'.$P_Exito2['id'].'-'.$NCampo.'" style="width:20px;" value="'.$P_Exito2[$w].'" />';
									//creaInput(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$P_Exito2['id'].'\',\'911_rolturn_desp_tmp_2\',\'id-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'24\',\'911_RolesTurnoDespa.php\'); 
								endif;
								
							$P_Conten	.=	'</td>';
						
						endfor;
					// AQUI LOS CAMPOS DE DIAS LIBRES
					// ===============================	
						//$P_Conten   .=  '<td><input style="width:100px" type=text id="c" name="c" value="c" /></td>';
						// El Total de dias libres X
						$P_Conten   .= '<td style="width:50px" align="center">&nbsp;<input title="L_'.$P_Exito2['id'].'" type="text" id="Libre_'.$P_Exito2['id'].'" name="Libre_'.$P_Exito2['id'].'" value="'.$Rs.'" style="width:20px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center" align="middle" ></td>'; //readonly
						
						$Rs		=	0;	
						
					} 
//-> END WHILE
//==================================================================					
					/* 
					 ***********************************************
					 * DESDE AQUI, EMPIEZO A CONSULTAR PARA SABER  *
					 * EL TOTAL DE PERSONAS EN CADA TURNO          *
					 * *********************************************
					*/
					$Wer_hrs		=	'depto = "'.$PIDDEPTO.'"';
					$FindHorario 	=	$objMante->BuscarLoQueSea('*','911_mant_horas',$Wer_hrs);
					$P_MostrarHora	=	FALSE;
					// CAPTURAR LOS HORARIOS DENTRO DE UN SOLO PARAMETRO
					foreach($FindHorario['resultado'] as $Muestra):
						$P_MostrarHora[]  .= $Muestra['horade'].'&nbsp;'.$Muestra['ampm_1'].'&nbsp;'.$Muestra['horaa'].'&nbsp;'.$Muestra['ampm_2'];
					endforeach;
					
					$ToTArra			=	count($P_MostrarHora);			// Total de los horarios encontrados
					$Son		 		=	$FindHorario['total'];			// Total de los horarios encontrados, la misma vaina que arriba
					$P_Horarios			=	array('6','2','10');
					$P_HorLabel			=	array('06:00am-2:00pm','2:00pm - 10:00pm','10:00pm - 06:00am');
					$ToArr				=	count($P_HorLabel);
					
// MOSTRAR HORARIOS Y TOTALES
// Totales segun los horarios
// Buesca en la tabla ya creada como quedo el resultado 
// segun los horarios definidos
// Ejem. (6 a 2)   = 4 ; (2 a 10) = 4 ; (10 a 6) = 3

						for($m	=	0	;	$m < $ToTArra ; $m++):			// TOTAL DE HORARIOS
							$P_Conten	.=	'<tr>';
							$P_Conten   .=	'<td align="center" bgcolor="#E8FFE8" style="font-family:Verdana;width:120px">'.$P_MostrarHora[$m].'</td>';
							for($y = 1 ; $y < $P_Res+1 ; $y++):				// TOTAL DE COLUMNAS ò DIAS EN EL MES
								//echo $y;
								
								$S		=	mysql_query('SELECT id,SUM(IF(c'.$y.'='.$P_Horarios[$m].',1,0)) as valorA FROM 911_rolturn_desp_tmp_rand WHERE meses="'.$DIGITOS[$r].'" AND id_usuario = "'.$idUs.'" AND dpto = "'.$PIDDEPTO.'" AND area = "'.$P_Data.'" AND fecha = "'.$date.'"');// AND id > 0 AND id <= '.$POST[2]//ORDER BY id ASC LIMIT 0, '.$POST[2]);
								//$S2		=	mysql_query('SELECT SUM(IF(c'.$y.'=2,1,0)) as valorB FROM 911_rolturn_desp_tmp_2 WHERE meses="'.$DIGITOS[$r].'" AND id_usuario = "'.$idUs.'" AND id > 0 AND id <= '.$POST[2]);//ORDER BY id ASC LIMIT 0, '.$POST[2]);
								//$S3		=	mysql_query('SELECT SUM(IF(c'.$y.'=10,1,0)) as valorC FROM 911_rolturn_desp_tmp_2 WHERE meses="'.$DIGITOS[$r].'" AND id_usuario = "'.$idUs.'" AND id > 0 AND id <= '.$POST[2]);//ORDER BY id ASC LIMIT 0, '.$POST[2]);
								//$R	 	=	mysql_num_rows($S);
								//$Wer_c	=	'';
								//$S		=	mysql_query('SELECT SUM(IF(c1=6,1,0)) as valorA, SUM(IF(c1=2,1,0)) as valorB, SUM(IF(c1=10,1,0)) as valorC FROM 911_rolturn_desp_tmp_2 WHERE meses="'.$DIGITOS[$r].'" AND id = "'.$y.'"');//ORDER BY id ASC LIMIT 0, '.$POST[2]);
								$R	 	=	mysql_num_rows($S);
								$W		=	mysql_fetch_array($S); 
								// name="'.$P_Horarios[$m].'-'.$W['id'].'-'.$y.'"
								// id="'.$P_Horarios[$m].'-'.$P_Exito2['id'].'-'.$y.'"
								// $DIGITOS[$r]
								$P_Conten	.=	'<td><input type="text" value="'.$W['valorA'].'" id="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" name="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" title="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" style="width:20px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center"></td>';
							endfor;
							$P_Conten	.=	'</tr>';
						endfor;
					
				//unset($TurnoA);
				$P_Conten	.=	'</table>';
				$P_Conten	.=	'</div>';
				// ==============================
				$P_OtroMes	 =	$DIGITOS[$r] + 1;
				
				//$P_TDMeses	.=	'<a href="?pag=rolturno&messig='.$P_OtroMes.'=&mesact='.$r.'"> | '.$MESES[$r].'</a></td>';
				//$CUANTAS	=	$P_Res;
				$P_Res 		= '';					//	Limpiar el total de dias del mes
				$P_ValoresColum3[1]	=	0;
				$Tot_turnoA	=	0;
		}// END FOR
			
		$P_TDMeses		.=	'</tr></table>';
		//echo 'TOTAL:'.$Tot_turnoA;
		
	}
	
	
	// VERIFICAR QUE NO EXISTA UN ROL DE TURNO PARA ESTE
	// MISMO MES DE ESTE MISMO AÑO
	//echo $P_Data;
	if(!empty($P_VerSalida)):
		$P_Err	 =	0;
		$P_Data2 =	'';
		
		for($rrh = $POST[3]	;	$rrh	<	$POST[4]+1 ; $rrh++):
			$P_SQL			=	mysql_query('SELECT * FROM 911_rolturn_desp WHERE area = "'.$P_Data.'" and meses = "'.$rrh.'" AND fecha LIKE "'.$POST[5].'-%" LIMIT 1');
			$P_Tot			=	mysql_num_rows($P_SQL);
			$P_DtArr		=	mysql_fetch_array($P_SQL);
			
			if($P_Tot > 0):
				$P_Data2	.=	$MESES[$P_DtArr['meses']].' ';
				$P_Err		=	$P_Err + 1;
			endif;
		endfor;
	
		if($P_Err > 0):
			
			$MSSG		=	'<font face=Verdana size="2" color="red">Ya existen estos meses ( '.$P_Data2.' ) PARA ESTA AREA ( '.$N_Area['nombre'].' ), dentro de la base de datos <br /> No se permite guardar esta informacion, pues ocasionaria duplicidad. </font>';
			
		;else:
		
		endif;
	endif;
	
	// GUARDAR
	/* *********
		- Guardar toda la informacion de los roles generados
		mas los cambios que el usuarios realize.
		- Se verifica que todos los campos  (usuarios: no esten en blanco),
		de igual manera que los campos de los horarios no esten en blanco
		- Se guarda cobn una clave para asi poder buscarlos nuevamente,
		si es que el usuario lo desea.
	*/
	//echo $TurnoA;
	//echo $P_Data;
	if(!empty($_POST['BtnGuardarTodo']))
	{ 	//echo $PIDDEPTO;
		//mysql_query('insert into 911_rolturn_desp select * from 911_rolturn_desp_tmp_2');
		$objEjec 		=  	new ejecutorSQL();
		
		// LOS CAMPOS TABLA DESTINO
		$POSTARR		=	array('area'=>$_POST['PDATA'],'fechade'=>$_POST['de'],'fechaa'=>$_POST['a'],'fechahoy'=>date('Y-m-d'),'totusers'=>$_POST['cuantosuser'],'idUs'=>$idUs);
		$P_Campos_tmp2	=	'(';
		$P_Campos_tmp2	.=	'user,id_usuario,ncorto,fecha,';
		for($hh	 =	1	; $hh	< 32 ; $hh++)
		{
			$P_Campos_tmp2	.=	 'c'.$hh.',';	
		}
		$P_Campos_tmp2	.= 	'dpto,area,meses,clave,publicar,horario,activo';
		$P_Campos_tmp2	.=	')';
		
		// LOS CAMPOS TABLA ORIGEN
		$P_Campos_tmp	=	'';
		$P_Campos_tmp	.=	'i.user,i.id_usuario,i.ncorto,i.fecha,';
		for($hh	 =	1	; $hh	< 32 ; $hh++)
		{
			$P_Campos_tmp	.=	 'i.c'.$hh.',';	
		}
		$P_Campos_tmp	.= 	'i.dpto,i.area,i.meses,i.clave,i.publicar,i.horario,i.activo';
		$P_Campos_tmp	.=	'';
		
		//EVITAR EL F5 O REFRESH DE LA PAGINA, Y ASI NO VOLVER A INGRESAR LA TRANS...
		$objEjec->DeshacerTran();		
		//LUEGO INSERTAR EN LA TABLA PROMISCUA
		mysql_query('INSERT INTO 911_rolturn_desp '.$P_Campos_tmp2.' 
		SELECT '.$P_Campos_tmp.' FROM 911_rolturn_desp_tmp_2 i');
		//E INSERTAR EN LA TABLA (original)
		//ESTA NO SERA MODIFICADA, ES PARA LUEGO TENER UNA COMPARACION
		mysql_query('INSERT INTO 911_rolturn_desp_orig '.$P_Campos_tmp2.' 
		SELECT '.$P_Campos_tmp.' FROM 911_rolturn_desp_tmp_2 i');
		
		$P_ocultar		=	true;
		$P_VerSalida	=	TRUE;	
		$P_VerPrint		=	TRUE;
	
		// TRUNCATE A LAS TABLAS
		$objEjec->vaciarTabla('911_rolturn_desp_tmp_2');
		$objEjec->vaciarTabla('911_rolturn_desp_tmp');
		$objEjec->vaciarTabla('911_rolturn_desp_tmp_rand');
						
		$msg2			=	strtoupper('<font size=2 family=Verdana color=red>Se ha guardado la informacion satisfactoriamente.</font>');
		$P_ParaPrint	=	FALSE;
		//$P_ParaPrint	=	'<a id="OptPrint" href="#" onClick="javascript: window.open(\'ventanas/911_PrintRolTurnoDespa.php?fechade='.$POSTARR['fechade'].'&fechaa='.$POSTARR['fechaa'].'&area='.$POSTARR['area'].'&dpto='.$PIDDEPTO.'&totusers='.$POSTARR['totusers'].'&idUs='.$POSTARR['idUs'].'&fechahoy='.$POSTARR['fechahoy'].'\',\'Rol de Turno\',\'scrollbars=yes,menubar=yes,fullscreen=yes,left=20px,top=20px,titlebar=no,toolbar=no,700px,height=500px\');" title="Imprimir el rol de turno">Imprimir </a>';
		$P_ParaPrint	=	'';//'<a id="OptPrint" href="#" onClick="javascript: window.open(\'ventanas/911_BuscarRolesTurnoPrint.php?fechade='.$POSTARR['fechade'].'&fechaa='.$POSTARR['fechaa'].'&area='.$POSTARR['area'].'&dpto='.$PIDDEPTO.'&totusers='.$POSTARR['totusers'].'&idUs='.$POSTARR['idUs'].'&fechahoy='.$POSTARR['fechahoy'].'\',\'Rol de Turno\',\'scrollbars=yes,menubar=yes,fullscreen=yes,left=20px,top=20px,titlebar=no,toolbar=no,700px,height=500px\');" title="Imprimir el rol de turno">Imprimir </a>';
	}
	
	
	
	
	
?>