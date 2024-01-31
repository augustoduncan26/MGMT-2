<?PHP

	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	$link	   =	mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);
	
	$objUsuario 	=  	new Users();
	$objPermiso		=	new permisos();	
	//$objWebControl	= 	new WebControl();
	//$objPaginador 	= 	new paginador();
	$objPFecha		=	new fecha();
	$objRolTurno	=	new RolesTurnos();	
	$objejec 		=  	new ejecutorSQL();

	$Matriz			=	FALSE;
	
	$objCMSMenu 	= 	new cms();
	$objMante		= 	new Mantenimientos();
	$idUs 	      	= 	$objCMSMenu->consultarID();
	$POST			=	$objMante->ValuePOST('post');
	
	$POST_fechade	=	isset($_POST['select-fecha-desde'])?$_POST['select-fecha-desde']:	'';					// Fecha desde
	$POST_fechaa	=	isset($_POST['select-fecha-hasta'])?$_POST['select-fecha-hasta']:	'';					// Fecha hasta
	/*
		$POST[0]		=		value todos		/	areas
		$POST[1]		=		value Generar (Boton)
		$POST[2]		=		value usuarios
		$POST[3]		=		value fecha de
		$POST[4]		=		value fecha a
		$POST[5]		=		value año
	*/
	// echo "<pre>";
	// var_dump($POST);
	$P_TotalMeses		=	FALSE;
	
	// TOTAL DE MESES SELECCIONADOS
	if (isset($POST_fechade) && isset($mess)) {
		for($mess = $POST_fechade	;	$mess	<	$POST_fechaa+1 ; $mess++)
		{
			$P_TotalMeses	=	$P_TotalMeses+1;
		}
	}
	
	$ToT			=	FALSE;
	$meses_evaluar	=	FALSE;
	$P_TDMeses		=	FALSE;
	$PCaracter		=	FALSE;
	$P_TotUser		=	FALSE;
	$P_OtroMes		=	FALSE;
	$P_Spry			=	FALSE;
	$P_Spry2			=	FALSE;
	$P_Conten		=	FALSE;
	$P_Conten2		=	FALSE;
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
	$NCORTO_		=	FALSE;
	$DEPARTO_		=	FALSE;
	$AREA_			=	FALSE;
	
	$POST_seis		=	isset($_POST['seis'])	?$_POST['seis']	:	'';
	$POST_dos		=	isset($_POST['dos'])	?$_POST['dos']	:	'';
	$POST_diez		=	isset($_POST['diez'])	?$_POST['diez']	:	'';
	$POST_ngrupo	=	isset($_POST['ngrupo'])	?$_POST['ngrupo']:	'';
	$PNGRUPO		=	$POST_ngrupo;
	$POST_GRUPO		=	isset($_POST['ngrupo'])	?$_POST['ngrupo']:	0;					// GRUPO 
	$POST_horario	=	isset($_POST['horario'])?$_POST['horario']:	0;					// HORARIO
	//$POST_selarea	=	isset($_POST['select_areas'])?$_POST['select_areas']:	0;		// AREAS
	$POST_users		=	isset($_POST['cuantos_usuarios'])?$_POST['cuantos_usuarios']	:	0;				// CUANTOS USUARIOS
	$POST_generar	=	isset($_POST['buttonGen'])?$_POST['buttonGen']:'';				// EL BOTON GENERAR
	$POST_anyo		=	isset($_POST['select-year'])	?$_POST['select-year']	:	'';					// EL AÑO
	$POST_generarRol=   isset($_POST['btn-generar-rol-auto'])?$_POST['btn-generar-rol-auto']:'';

	// NEW POST ELEMENTS
	$POST_selarea	=	isset($_POST['select_areas'])?$_POST['select_areas']:	0;		// AREAS
	//$POST_fechadesde=	isset($_POST['select-fecha-desde'])?$_POST['select-fecha-desde']:	0;		// AREAS
	//$POST_fechahasta=	isset($_POST['select-fecha-hasta'])?$_POST['select-fecha-hasta']:	0;		// AREAS


	$POST[0]		=	$POST_selarea; 			// areas
	$POST[1]		=	$POST_generar;	// value Generar (Boton)
	$POST[2]		=	$POST_users;	// value usuarios
	$POST[3]		=	$POST_fechade;	// value fecha de
	$POST[4]		=	$POST_fechaa;	// value fecha a
	$POST[5]		=	$POST_anyo;		// value año



	//SALIR
	#========
	if(isset($_POST['buttonSalir']))
	{
		mysqli_query($link,'DROP TABLE '.$_POST['tabla_tmp_area'].'');
		echo '
			<script>
				self.location=("?pag=defaultAdmin");
			</script>
		';
	}
	
	/**
	 * CANCEL - BORRAN TODOS LOS RESULTADOS
	 */
	if(isset($_POST['BtnCanclarTodo']) && $_POST['BtnCanclarTodo']=="Cancelar") { 
		$objejec->vaciarTabla(PREFIX.'rolturn_tmp');	
		$objejec->vaciarTabla(PREFIX.'rolturn_tmp_rand');
		$objejec->vaciarTabla(PREFIX.'rolturn_desp');
		//echo json_encode(1);
		//return false;
	}
	
	$Tot_turnoA		=	0;
	$Tot_turnoB		=	0;
	$Tot_turnoC		=	0;
	$HAY_c_1		=	0;
	$HAY_c_2		=	0;
	$HAY_c_3		=	0;
	$VACIAR			=	1;
	
	//NOMENCLATURA PARA LOS USUARIOS
	$P_OVE			=	'6034020';
	$P_TUM1			=	'2011400';
	$P_TUM2			=	'2011402';
	
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
	
	
	// SI QUIERE REGRESAR ENTONCES SE BORRAN TODOS LOS RESULTADOS
	if($GET_opt == 'back'){
		$objejec->vaciarTabla('911_rolturn_desp_tmp');		
		$objejec->vaciarTabla('911_rolturn_desp_tmp_rand');	
	}

	// Informacion del usuario logueado
	$P_InfoUser		=	$objUsuario->consultarUsuario($idUs);
	/**
	 * ALGUNAS INFO NECESARIAS EN - VIEW
	 */
	$monthsSelect	=	array('Enero'=>1,'Febrero'=>2,'Marzo'=>3,'Abril'=>4,'Mayo'=>5,'Junio'=>6,'Julio'=>7,'Agosto'=>8,'Septiembre'=>9,'Octubre'=>10,'Noviembre'=>11,'Diciembre'=>12);
	$P_idDepto		=	$objMante->BuscarLoQueSea('*' ,PREFIX.'mant_departamentos', 'name like "%desp%"','extract');
	$PIDDEPTO		=	$P_idDepto['id'];
	$P_Where		=	'id_depto="'.$P_idDepto['id'].'" and active =1';			
	$ListaAreas		=	$objMante->Listar(PREFIX.'mant_areas', $P_Where,false,'name',false,false,'array');		//	Litar las secciones ó areas segun dpto.DESPACHO
	$ListaHrs		=	$objMante->Listar(PREFIX.'otros_param', 'activo = 1 and id_depto = "'.$P_idDepto['id_seccion'].'" AND n_corto="tipo_hrs"',false,'name',false,false,'array');		//	Litar los tipos de horarios para este dpto
	
	
	//var_dump($ListaAreas);
	//PARAMETROS DE USO INTERNO
	/*
		 - Para generar fecha_de, fecha_a,
		 - Label (Etiqueta) para los list de los meses
		 - Para saber total de usuarios promedio dependiendo del depto.
		 - Buscar max y min de las areas
		 - Buscar grupo
		 - Buscar tipo de horario
	*/
	//=========================
	$DIGITOS		=	array('0','1','2','3','4','5','6','7','8','9','10','11','12');			
	$MESES			=	array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$DIGITOS2		=	array('0','01','02','03','04','05','06','07','08','09','10','11','12');
	
	// EXPLODE DE LAS AREAS
	function NombredeArea($Data = false) {
		global	$objMante;
		//echo $Data[0];
		$P_Val	=	explode('-',$Data);
		$P_Son	=	count($P_Val);
		for($xy = 0 ; $xy < $P_Son ; $xy++)
		{	//echo $P_Val[$xy];
			$Nombre		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Val[$xy].'" and activo = 1','extract');
			if($P_Data!='')
			{
				$P_Data .=  '-';
			}
			$P_Data		.=	 strtoupper(substr($Nombre['nombre'],0,15)).'...';	
		}
		return ($P_Data);
	}
	
	// FIND CODCARGO DEL USUARIO
	function CodCargo($IDEMPLEADO) {	
		global	$objMante;
		$IDEMPLEADO = '2';
		//echo 'nempleado = "'.$IDEMPLEADO.'"';
		$P_SQL	=	$objMante->BuscarLoQueSea('*',PREFIX.'empleados','nempleado ="'.$IDEMPLEADO.'"','extract');
		return $P_SQL['codcargo'];
		
	}
	// CONTAR CANTIDAD DE CRITERIOS, SEGUN CRITERIO
	/*
	
	*/

	//Conocer total de usuario promedio segun grupo ó área
	//*****************************************************
	$P_TotUser	=	$objMante->PromUsers('911_mant_areas','usuarios','id_depto = "'.$PIDDEPTO.'" '); 	
	$IDSUP			=	FALSE;
	$MANTIDSUP		=	FALSE;
	$PASSASUP		=	FALSE;
	$FILA_N			=	0;
	// USUARIO DE ESTE DPTO.
	//Conocer usuarios que son de este DPTO y que a la vez son supervisores
	$Wer_userSuperv	=	'id_depto = "'.$PIDDEPTO.'" and id_perfil = "2" AND activo = "1" ORDER BY id_area,nombre ASC';
	$P_UserDptoSup	=	$objMante->Listar(PREFIX.'users', $Wer_userSuperv,false,false,false,false,'array');
	
	//var_dump($P_UserDptoSup['resultado']);

	//SUPERVISORES PARA CUALQUIER AREA
	foreach($P_UserDptoSup['resultado'] as $LabelsSuperv) {
		$IDSUPERV	 =	$LabelsSuperv['id_usuario'];
		$NOMBSUPERV	 =	$LabelsSuperv['nombre'].'&nbsp;'.$LabelsSuperv['apellido'];
		
		//SETEAR EL NOMBRE DE LOS GRUPOS (AREAS)
		$P_NArea	=	$objMante->BuscarLoQueSea('*' ,PREFIX.'perfiles', 'id = "'.$LabelsSuperv['id_perfil'].'"','extract');
		
		if($LabelsSuperv['id_perfil']!=$MANTIDSUP):
			$MANTIDSUP	=	$LabelsSuperv['id_perfil'];
			$OPTION		.=	'<optgroup label="--- '.strtoupper($P_NArea['perfil']).' ---PRE-HOSP." style="background-color:yellow"></optgroup>';
		endif;
		
		//ESTO PARA QUE LOS LABELS EMPIEZEN SEGUN AREA SELECCIONADA
			//asi evitar que se tenga que buscar en todo el scroll del list menu
			//if($LabelsSuperv['id_area']==$POST[0][0] && $PASSASUP==FALSE):
			if($LabelsSuperv['id_area']==$POST[0] && $PASSASUP==FALSE):
				$FILA_N			=	0;
				$PASSASUP		=	TRUE;
				//$ID			=	$Labels['id_usuario'];
				$OPTION		.=	'<option value="" selected>Users:SUPERVISORES</option>';
			endif;
			
		//PONER LOS NOMBRES DE LOS INDIVIDUOS, AGRUPADOS POR: (id_area,nombre)
		//Y EL CARGO SEGUN SU CODCARGO
		if($LabelsSuperv['id_usuario']!=$IDSUP):
			$FILA_N++;
			$IDSUP			=	$LabelsSuperv['id_usuario'];
			//if(CodCargo($LabelsSuperv['nempleado']) == $P_TUM1){ echo$LBL_CARGO = ' - TUM1';}
			//elseif(CodCargo($LabelsSuperv['nempleado']) == $P_TUM2){ $LBL_CARGO = ' - TUM2';}
			//elseif(CodCargo(@$Labels['nempleado']) == $P_OVE){$LBL_CARGO = ' - OVE';}
			//else{$LBL_CARGO='';}
			$OPTION		.=	'<option value="'.$LabelsSuperv['id_usuario'].'" title="'.$NOMBSUPERV.' - SUPERVISORES'.$LBL_CARGO.'">'.$FILA_N.'-&nbsp; '.$NOMBSUPERV.$LBL_CARGO.'</option>';
		endif;
	
	}

	
	//CONOCER LOS USUARIOS QUE SON DE ESTE DEPTO.
	$Wer_user		=	'id_depto = "'.$PIDDEPTO.'" and id_perfil <> 2 AND activo = "1" ORDER BY id_area,nombre ASC';
	$P_UserDpto		=	$objMante->Listar('usuario', $Wer_user,false,false,false,false,'array');
	
	$ID				=	FALSE;
	$MANTID			=	FALSE;
	$PASSA			=	FALSE;
	if(isset($P_UserDpto['resultado'])):
			//$LABEL	=	'<option value="" selected>-Escoja-</option>';
		foreach($P_UserDpto['resultado'] as $Labels)
		{
			$IDLABEL	=	$Labels['id_usuario'];//'<option id="'.$Labels['id_usuario'].'">'.$Labels['nombre'].'&nbsp;'.$Labels['apellido'].'</option>';	
			$NOMBLABEL	=	$Labels['nombre'].'&nbsp;'.$Labels['apellido'];
			
			//SETEAR EL NOMBRE DE LOS GRUPOS (AREAS)
			$P_NArea	=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id = "'.$Labels['id_area'].'"','extract');
					
			if($Labels['id_area']!=$MANTID):
				$FILA_N			=	0;
				//<optgroup label="Lenguajes del lado servidor">
				$OPTION		.=	'<optgroup label="--- '.strtoupper($P_NArea['nombre']).' ---" style="background-color:yellow"></optgroup>';
				$MANTID		=	$Labels['id_area'];
			endif;
			//ESTO PARA QUE LOS LABELS EMPIEZEN SEGUN AREA SELECCIONADA
			//asi evitar que se tenga que buscar en todo el scroll del list menu
			//if($Labels['id_area']==$POST[0][0] && $PASSA==FALSE):
			if($Labels['id_area']==$POST[0] && $PASSA==FALSE):
				$PASSA		=	TRUE;
				//$ID			=	$Labels['id_usuario'];
				$OPTION		.=	'<option value="" selected>Users: '.$P_NArea['nombre'].'</option>';
			endif;
			
			//PONER LOS NOMBRES DE LOS INDIVIDUOS, AGRUPADOS POR: (id_area,nombre)
			if($Labels['id_usuario']!=$ID):
				$FILA_N++;
				$ID			=	$Labels['id_usuario'];
				//if(CodCargo($Labels['nempleado']) == $P_TUM1){ $LBL_CARGO = ' - TUM1';}
				//elseif(CodCargo($Labels['nempleado']) == $P_TUM2){ $LBL_CARGO = ' - TUM2';}
				//elseif(CodCargo($Labels['nempleado']) == $P_OVE){$LBL_CARGO = ' - OVE';}
				//else{$LBL_CARGO='';}
				$OPTION		.=	'<option value="'.$Labels['id_usuario'].'" title="'.$NOMBLABEL.' - '.$P_NArea['nombre'].$LBL_CARGO.'">'.$FILA_N.'-&nbsp; '.$NOMBLABEL.$LBL_CARGO.'</option>';
			endif;
				
		}
	endif;


	// ***********************************************
	// AL PRESIONAR EL BOTON DE GENERAR
	//  - TODO EMPIEZA AQUI
	// (Primero hago un par de consultas necesarias)
	// ***********************************************
	
	
	// Primero verificar que no esten utilizando esta parte
	// if($POST[1] == 'Generar Rol de Turno' || $POST_generar == 'Generar Rol de Turno'):
	// 	// Crear la tabla temporal
	// 	// echo 1;
	// 	//mysql_query('CREATE TABLE 911_'.$_POST['select_areas'].' AS SELECT * FROM 911_rolturn_preh_tmp');
		
	// endif;
	
	if($POST[1] == 'Generar Rol de Turno' || $POST_generar == 'Generar Rol de Turno') {
		/*
			1. Buscar la formula de acuerdo al area seleccionada
			2. Saber el tipo de horario que solicitan
			3. Saber el grupo
			4. Contar para cuantos usuarios se requiere tirar el turno
			5. Saber para cuantos meses		
		*/	
		//1. Cuantas formulas debo buscar?
		// ===============================
		//in_array
		$P_Sale			=	'';
		$P_Data			=	false;
		$Letra			=	false;
		$clave			=	false;
		$P_ParaCuantos	=	false;							//  Saber para cuantos usuarios es toda esta vaina
		$P_Tot			=	count($POST_selarea);			//	Saber el total de las areas
		//$P_Tot			=	count($POST[0]);
		
		$error			=	0;	
		$date			=	date('Y-m-d');
		// PARA TODAS LAS AREAS
		// EN EL FUTURO BIEN LEJANO (No quiero romper mi cabeza :D)
		if($POST_selarea	==	'todos'):
			$P_Cuantos		=	$objMante->BuscarLoQueSea('*','911_mant_areas','id_depto="'.$PIDDEPTO.'" and activo = 1','array');
			$P_Cuantos['total'];
			
			//Arreglar la data para poder comparar
			foreach($P_Cuantos['resultado'] as $P_Depto)
			{	
				if($P_Data!='')
				{
					$P_Data .=  '-';
				}
					$P_Data		.=	 $P_Depto['id'];
					$P_NombreArea_tmp=$P_Depto['nombre'];
					
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
					//$P_Data		.=	 $POST[0][$x];	
					$P_Data			.=	$_POST['select_areas'][$x];
			}
		endif;

		//echo $P_Data;//	
		// CREAR LA TABLA TEMPORAL
		// ***********************
		//$NAREASQL_	=	mysqli_query($link,'SELECT * FROM 911_mant_areas WHERE id = "'.$P_Data.'"');
		$NAREASQL_  =   $objMante->BuscarLoQueSea("*","911_mant_areas","id='".$P_Data."'","extract");
		//echo $NAREASQL_['id'];
		//$NombArea	=	mysqli_fetch_array($NAREASQL_);
		$NAMETBLTMP	=	'911_rolturno_desp_'.strtolower($NAREASQL_['id']);
		$objejec->vaciarTabla($NAMETBLTMP);	
		mysqli_query($link,'CREATE TABLE '.$NAMETBLTMP.' (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)) AS SELECT * FROM 911_rolturn_desp_tmp');
		

		// ESTO ES PARA SI VAN A TIRAR ROL DE TURNO PARA VARIAS 
		// AREAS. POR AHORA NO LO ESTOY UTILIZANDO, ASI QUE SE VA POR,,, ELSE
		// Buscar las areas
		if(!is_numeric($P_Data)){ 
			//echo $P_Data;
			//echo strtoupper('Todas');
			//in_array
			$P_Val	=	explode('-',$P_Data);
			$P_Son	=	count($P_Val);
			$P_Label=	false;
			//echo $P_Val[2];
			for($xy = 0 ; $xy < $P_Son ; $xy++) {
				$Nombre		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Val[$xy].'" and activo = 1','extract');
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
			
		} else  {

		// SI TOMAN LA OPCION: OTROS PARAMETROS
		// ====================================
			//echo $P_Data;
			//$POST[2]		=> saber cuantos usuarios se selecciono
			if(isset($_POST['especial'])): $Tott_esp		=	count($_POST['especial']); $TOTAL_CAMPOS = ($POST_users+$Tott_esp); ;else: $TOTAL_CAMPOS = $POST_users;endif;			
			$N_Area		=	$objMante->BuscarLoQueSea('*' ,PREFIX.'mant_areas', 'id="'.$P_Data.'" and active = 1','extract');
			if($POST_ngrupo!=''): $POST_ngrupo = ' , - GRUPO : '.$POST_ngrupo; endif;
			$P_Areas	=  strtoupper('Para: '.$TOTAL_CAMPOS.' usuarios - Año: '.$POST_anyo.' - area: '.substr($N_Area['name'],0,20)).$POST_ngrupo;
		}
		
		// MAXIMO Y MINIMO SEGUN 
		// EL AREA Y EL HORARIO
		//-------------------------

		if($POST_seis	!=''): 	$N_Area['turno_a'] 	= 	$POST_seis+2	;	endif;
		if($POST_dos	!=''):	$N_Area['turno_b']	=	$POST_dos+2	;	endif;
		if($POST_diez	!=''):	$N_Area['turno_c']	=	$POST_diez+1;	endif;
		
		$Tot_SegArea	=	($N_Area['turno_a'] + $N_Area['turno_b'] + $N_Area['turno_c']);
		$Tot_SegArea;
		if($Tot_SegArea == $POST_users) {	
			$Tot_x			=	$Tot_SegArea;
		} else {
			$Tot_x			=	$POST_users;//$POST[2];//($POST[2]-$Tot_SegArea);//($Tot_SegArea-$POST[2]);//

		}
//--------------------------
		
		// AQUI EMPIEZA LA CONSULTADERA
		// 1. EVITAR EL REFRESH DE LOS USUARIOS
		
		$Wer		=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'"';
		$BuscaFind	=	$objMante->BuscarLoQueSea('*' , $NAMETBLTMP,$Wer);
		
		$objejec->vaciarTabla('911_rolturn_desp_tmp');
		$objejec->vaciarTabla('911_rolturn_desp_tmp_rand');

			// Ocultar el menu principal
			// =========================
			$P_ocultar		=	true;
			$P_VerSalida	=	TRUE;
			$SONMESES		=	0;

//$msg			=	'Existen datos para esta misma seleccion que no ha guardado aun.<br /> Para verlos click <a href=?pag=rolturno&area='.$P_Data.'&dpto='.$PIDDEPTO.'&fecha='.$date.'>Aqui.</a>';	
//}else{
//\\//														\\//		
// ||********************************************************||			
// ||				AQUI EMPIEZO A GUARDAR					*||
// ||				LOS DATOS POR CADA MES 					*||
// ||				QUE SE SELECCIONE						*||
// ||********************************************************||
// ||														 ||
// VV													     VV	
//
		//for($rrh = $POST[3]	;	$rrh	<	$POST[4]+1 ; $rrh++){
		for($rrh = $POST_fechade	;	$rrh	<	$POST_fechaa+1 ; $rrh++) {
			//echo $rrh.'<br>';
			$SONMESES=$SONMESES+1;
			$clave			=	mt_rand(-2147483647,2147483647); //$id=2147483648+mt_rand(-2147483647,2147483647); //mt_rand(26081970,19700826);	//	Evitar el refresh del navegador por el usuario
			//Buscar datos de acuerdo a los seleccionado
			$P_Were 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			$P_Were2 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			$P_Were3 		= 	'dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area = "'.$P_Data.'"';
			
			$P_Campos_tmp	=	'(user,id_usuario,ncorto,fecha,';
		
			for($rh	=	1	; $rh	< 32 ; $rh++) {
				$P_Campos_tmp	.=	 'c'.$rh.',';	
			}
			$P_Campos_tmp	.= 	'dpto,area,meses,anyo,clave,grupo,publicar,horario';
			$P_Campos_tmp	.=	')';
			
			$P_ParaCuantos	=	$POST[2];
			
// GUARDAR DE OTRA MANERA
// ======================
		$P_Horarios			=	array('6','2','10','x');
// TURNO A : 6 AM	
//echo $N_Area['turno_a'];
//echo $POST_users;
			if($POST_GRUPO==0):
				//$SQL_1			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[0].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_a'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
				$SQL_1			=	mysqli_query($link,'SELECT * FROM 911_mant_formulas WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%"') or die('Error 504 inesperado en mysql: '.mysqli_error($link));
				$ENCONTRE		=	mysqli_num_rows($SQL_1);
			;else:
				//$SQL_1			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[0].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" AND grupo like "%'.$POST_GRUPO.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_a'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
				$SQL_1			=	mysqli_query($link,'SELECT * FROM 911_mant_formulas WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%"') or die('Error 504 inesperado en mysql: '.mysqli_error($link));
				$ENCONTRE		=	mysqli_num_rows($SQL_1);
			endif;

// CON ESTO DEBO SABER CUANTAS FORMULAS HAY
// PARA LUEGO SABER LA DIFERENCIA DE LA CANTIDAD
// DE USUARIOS QUE ESTAN SOLICITANDO
/* 
			DIFER
*/
			$DIFER			=	($POST_users - $ENCONTRE);		//	Esta representa la diferencia con respecto a
																//  cantidad de usuarios que seleccionaron
			
			$P_FindSQL1		=	mysqli_num_rows($SQL_1);
			$TotForm_1		=	$P_FindSQL1;
			$TotUsers_		=	$P_ParaCuantos;
			$T				=	0;
			if(mysqli_num_rows($SQL_1) > 0) {
				$P_ValoresColum1		=	false;
				While($Data	=	mysqli_fetch_array($SQL_1)) {	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++) {
						//if($Data['c'.$rh] == 31)
						//{
							if($P_ValoresColum1	!=	'')
							{
								$P_ValoresColum1 .=  ',';
							}	
							$P_ValoresColum1		.=	 "'".$Data['c'.$rh]."'";	
						//}
					}	//echo $P_Campos_tmp;
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum1.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$POST_anyo.'","'.$clave.'","'.$POST_GRUPO.'",0,"'.$POST_horario.'"';
						mysqli_query($link,"INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysqli_error($link));
						$P_ValoresColum1 = '';
						$rh				=	0;
						$T ++;
				}
			}
			
// SI EL PARAMETRO ($DIFER) ES MAYOR A CERO (0), ENTONCES HAGO OTRA CONSULTA
// PARA BUSCAR LA CANTIDAD QUE FALTA : JE JE JE JE,,,, SENCILLO ESTA VEZ
// ==========================================================================
			if($DIFER > 0) {
				//echo $DIFER;
				if($POST_GRUPO==0):
					//$SQL_1			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[0].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_a'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
					$SQL_2			=	mysqli_query($link,'SELECT * FROM 911_mant_formulas WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" LIMIT '.$DIFER) or die('Error 504 inesperado en mysql: '.mysqli_error($link));
					//$ENCONTRE		=	mysql_num_rows($SQL_2);
				;else:
					//$SQL_1			=	mysql_query('SELECT * FROM 911_mant_formulas WHERE c1 = '.$P_Horarios[0].' AND dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" AND grupo like "%'.$POST_GRUPO.'%" ORDER BY RAND() LIMIT '.$N_Area['turno_a'].'') or die('Error 504 inesperado en mysql: '.mysql_error());
					$SQL_2			=	mysqli_query($link,'SELECT * FROM 911_mant_formulas WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" LIMIT '.$DIFER) or die('Error 504 inesperado en mysql: '.mysqli_error($links));
					//$ENCONTRE		=	mysql_num_rows($SQL_1);
				endif;
				$P_FindSQL2		=	mysqli_num_rows($SQL_2);
				$TotForm_2		=	$P_FindSQL2;
				$TotUsers_		=	$P_ParaCuantos;
				$T				=	0;
				if(mysqli_num_rows($SQL_2) > 0) {
					$P_ValoresColum2		=	false;
					While($Data	=	mysqli_fetch_array($SQL_2)) {	//echo $Data['ncorto'];
						for($rh	=	1	; $rh	< 32 ; $rh++) {
							//if($Data['c'.$rh] == 31)
							//{
								if($P_ValoresColum2	!=	'') {
									$P_ValoresColum2 .=  ',';
								}	
								$P_ValoresColum2		.=	 "'".$Data['c'.$rh]."'";	
							//}
						}	//echo $P_Campos_tmp;
							$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum2.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$POST_anyo.'","'.$clave.'","'.$POST_GRUPO.'",0,"'.$POST_horario.'"';
							mysqli_query($link,"INSERT INTO 911_rolturn_desp_tmp ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysqli_error($link));
							$P_ValoresColum2 = '';
							$rh				=	0;
							$T ++;
					}
				}
			
			} else {
				$TotForm_2	=	0;	
			}
//		
// Y AHORA COULTAR ALGUNAS COSAS
// *********************************
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

			$TOTALESTOTALES	=	($TotForm_1+ $TotForm_2);// + $TotForm_2+$TotForm_3+$TotForm_4);
			//$POST[2];
			// LLENO EL ARRAY CON LOS VALORES

			for ($i=0; $i<$TOTALESTOTALES; $i++) {  
				$aleatorios[$i]	=	$i;
			}
			//echo $SONMESES;
			$NUMR 				= 	rand(1,2);
			$MIRAND				=	array(1=>'ASC',2=>'DESC');
			// O HACER EL $MIRAND DE ESTA OTRA MANERA
			if($SONMESES == 1){ $MIRAND[$NUMR] = 'ASC';}
			if($SONMESES == 2){ $MIRAND[$NUMR] = 'DESC';}
			if($SONMESES == 3){ $MIRAND[$NUMR] = 'ASC';}
			if($SONMESES == 4){ $MIRAND[$NUMR] = 'DESC';}
			if($SONMESES == 5){ $MIRAND[$NUMR] = 'ASC';}
			if($SONMESES == 6){ $MIRAND[$NUMR] = 'DESC';}
			
			// ORDER BY RAND()
			//echo $MIRAND[$NUMR];
			// PASAR TODO A LA TABLA QUE VOY A UTILIZAR
			// LA CREADA AL MOMENTO TMP
			//$SQL__ 			=	$objMante->BuscarLoQueSea('*' ,'911_rolturn_desp_tmp', 'name like "%desp%"','array');
			$SQL__			=	mysqli_query($link,'SELECT * FROM 911_rolturn_desp_tmp WHERE dpto = "'.$PIDDEPTO.'" AND activo = 1 AND area like "%'.$P_Data.'%" AND meses="'.$DIGITOS[$rrh].'" ORDER BY id '.$MIRAND[$NUMR].' LIMIT '.$POST[2]);// or die('Error 504 inesperado en mysql: '.mysqli_error($link));
            
			$P_FindSQL_		=	mysqli_num_rows($SQL__);
			$TTTT 			=	0;
			
			$P_ValoresColum5		=	false;
				While($Data	=	mysqli_fetch_array($SQL__)) {	//echo $Data['ncorto'];
					for($rh	=	1	; $rh	< 32 ; $rh++) {
							if($P_ValoresColum5	!=	'')
							{
								$P_ValoresColum5 .=  ',';
							}	
							$P_ValoresColum5		.=	 "'".$Data['c'.$rh]."'";	
					}
						$P_Esto	=	'1,"'.$idUs.'","'.$Data['ncorto'].'","'.date('Y-m-d').'",'.$P_ValoresColum5.',"'.$Data['dpto'].'","'.$P_Data.'","'.$DIGITOS[$rrh].'","'.$POST_anyo.'","'.$clave.'","'.$POST_GRUPO.'",0,"'.$POST_horario.'"';
						mysqli_query($link,"INSERT INTO ".$NAMETBLTMP." ".$P_Campos_tmp." VALUES (".$P_Esto.")") or die('Error en la consulta: '.mysqli_error($link));
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
				$Tott_	=	count($_POST['especial']);
				//echo $_POST['especial'];
				$P_Valores_	=	false;
				for($z	=	0	;	$z	< $Tott_	;	$z++):
									
						for($y	=	1	;	$y < 32 ; $y++):
							if($P_Valores_	!=	'')
							{
								$P_Valores_ .=  ',';
							}	
							$P_Valores_		.=	 "'".$_POST['especial'][$z]."'";
						endfor;
						$P_Esto_		=	'1,"'.$idUs.'","","'.date('Y-m-d').'",'.$P_Valores_.',"'.$DEPARTO_.'","'.$AREA_.'","'.$DIGITOS[$rrh].'","'.$POST_anyo.'","'.$clave.'","'.$POST_GRUPO.'",0,"'.$POST_horario.'"';
						mysqli_query($link,"INSERT INTO ".$NAMETBLTMP." ".$P_Campos_tmp." VALUES (".$P_Esto_.")") or die('Error en la consulta: '.mysqli_error($link));
						$P_Valores_ 		= 	'';
						$y					=	0;

				endfor;

			endif;	
// =============================================================
// =============================================================


// FIN DEL PASO A LA TABLA RAND
// VACIAR LA TABLA TMP
				if($VACIAR == 1) {
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
		// 911_rolturn_preh_tmp_2, para nno estar duplicando
		// Podria usar el truncate pero debo verificar varias cosas
		
		$Wer_b		=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'"';
		$objejec->vaciarTabla('911_rolturn_desp_tmp_2');
		
		
// **************************************************************		
// 			AQUI DIVIDIR LA INFORMACION POR LA 					*
// 			CANTIDAD DE MESES SELECCIONADAS						*
// 				  HERE IS THE TRICKS  							*
/* **************************************************************
*/
$row 			= 0;
$tabActive 		= false;
$inActive 		= false;

for($r = $POST_fechade	;	$r	<	$POST_fechaa+1 ;$r++){ 

	$meses_evaluar=$meses_evaluar+1;

	if($PCaracter!='') {
		$PCaracter	.=	' | ';			
	}		
		
	$P_TDMeses	.=	'<td id="opt'.$r.'" ';
	$P_TDMeses	.=	'style="font-size:10px; font-family:Verdana, Geneva, sans-serif;"">';
	
	if ($row==0) {
		$tabActive 	= "class='active'";
		$inActive 	= 'in active';
	} else {
		$tabActive = false;
		$inActive = false;	
	}
	$row++;
	// Crear el Spry
	$P_Spry		.=	'<li style="font-size:10px;width:60px; font-family:Verdana, Geneva, sans-serif;" class="TabbedPanelsTab comun_titulos_2" onmouseover="this.style.Cursor=\'pointer\'"  id="Tab'.$P_OtroMes.'" tabindex="'.$P_OtroMes.'" onclick="javascript: document.getElementById(\'Tab'.$P_OtroMes.'\').style.backgroundColor=\'#000\'">'.$MESES[$r].'</li>';
	//onclick="SombreadoCampos(\'Tab'.$P_OtroMes.'\',\'Tab\',6)" 
	$P_Spry2	.= '<li '.$tabActive.'><a data-toggle="tab" href="#'.strtolower($MESES[$r]).'">'.$MESES[$r].'</a></li>';

	$P_Conten2	.=	'<div id="'.strtolower($MESES[$r]).'" class="cursor tab-pane fade '.$inActive.'"><font face="Verdana" color="red">'.strtoupper('turnos del mes de '.$MESES[$r]).'</font>';
	$P_Conten	.=	'<div class="TabbedPanelsContent" style="width:100%;background-color:#FFF"><font face="Verdana" color="red">'.strtoupper('turnos del mes de '.$MESES[$r]).'</font>';
	$P_Res		.=	$objPFecha->UltimoDia(date('Y'),$DIGITOS2[$r]);
	$P_Conten	.=	'<p /><table border=0 width="100%" class="bordeTodalaTabla_2">';
	$P_Conten2	.=	'<p /><table border=0 width="100%" class="bordeTodalaTabla_2">';
	$n			 =	0;
	$x			 =	0;

		// Dibujar el total de filas
		/* =========================
			Representan el total de usuarios
			que se necesitan por mes.
		*/
		$P_Conten	.=	'<tr>';
		$P_Conten	.=	'<td>&nbsp;</td>';

		$P_Conten2	.=	'<tr>';
		$P_Conten2	.=	'<td>&nbsp;</td>';
		
		/*	==========================================
			Dibujar los nombres de las columnas
			para cada dia.
			De igual buscar el nombre del dia segun
			la fecha del dia, del mes.
			==========================================
			Letras del dia
		*/
		
		for($d	=	1	;	$d	<	$P_Res+1	;	$d++){
			// Buscar el dia segun mes y año
			//echo $POST_anyo
			$Letra		=	$objPFecha->NombreDelDia($DIGITOS2[$r], $d ,$POST_anyo);   // $POST[5]
			$Letra2		=	substr($Letra,0,1);
			if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =	'bgcolor="#E8FFE8" ';}else{$BGCOLOR =	'';}
			$P_Conten	.= '<td width="25px" '.$BGCOLOR.' class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$Letra.'&nbsp;'.$d.'">'.$Letra2.'</td>';
			$P_Conten2	.= '<td width="25px" '.$BGCOLOR.' class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$Letra.'&nbsp;'.$d.'">'.$Letra2.'</td>';
		}
		$P_Conten	.=	'<td style="width:50px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" colspan=3>&nbsp;T</td>';	
		$P_Conten	.=	'</tr>';
		$P_Conten2	.=	'<td style="width:50px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" colspan=3>&nbsp;T</td>';	
		$P_Conten2	.=	'</tr>';
		
		$P_Conten	.=	'<tr>';
		$P_Conten	.=	'<td colspan=>&nbsp;</td>';
		$P_Conten2	.=	'<tr>';
		$P_Conten2	.=	'<td colspan=>&nbsp;</td>';
		// Dias en numeros
			for($dd	=	1	;	$dd	<	$P_Res+1	;	$dd++){
				$P_Conten	.= '<td width="25px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$dd.'">'.$dd.'</td>';
				$P_Conten2	.= '<td width="25px" class="linea_abajo linea_arriba linea_deresa linea_izq" align="center" title="'.$dd.'">'.$dd.'</td>';
			}
		$P_Conten	.=	'</tr>';
		$P_Conten2	.=	'</tr>';
					
		// AL PARECER PODRE BORRAR ESTO DESDE AQUI

		// INSERTAR EN LA TABLA temp_2, 
		// LA COMBINACION DEL RAND, SEGUN CONSULTA	
		// Segun la consulta de:
		//  (total meses y total usuarios )	
		// Ejem: hacia abjao, los usuarios
		for($h	=	0	;	$h	<	$POST[2]	;	$h++){
		
		$n++;	
		/* ******************************************
		// Darle color a las filas
		// Buscar la informacion en la Tabla tmp
		// ******************************************
		*/
			$objConstr 	= 	new consultor();

			$P_Weretmp	=	'fecha = "'.$date.'" and id_usuario = "'.$idUs.'" and  meses = '.$DIGITOS2[$r];
			$P_Camps	=	$objMante->ListadeCampos();
			$P_Camps	.=	'dpto,area,user,id_usuario,meses,fecha,id, ncorto,clave';			
		}
					


		// AQUI LIMPIO ESTA VARIABLE
		$Tot_turnoA		=	0;
		$Tot_turnoB		=	0;
		$Tot_turnoC		=	0;
		// CAMBIAR EL LIMIT, SI HAY OTROS PARAMETROS
		if(isset($_POST['especial']) && $_POST['especial']): $POST[2]	=	$POST[2] + count($_POST['especial']); endif;
		// OTRA FORMA DE HACERLO
		// PA VER SI ESTA SI PEGA
		$Wer_c			=	'dpto = "'.$PIDDEPTO.'" and area = "'.$P_Data.'" and fecha = "'.$date.'" and id_usuario = "'.$idUs.'" and meses = "'.$DIGITOS[$r].'"';
		//echo 'SELECT '.$P_Camps.' FROM '.$NAMETBLTMP.'  WHERE '.$Wer_c.' LIMIT '.$POST[2];
		$SQL_			=	mysqli_query($link,'SELECT '.$P_Camps.' FROM '.$NAMETBLTMP.'  WHERE '.$Wer_c.' LIMIT '.$POST[2]) or die('Error 505 inesperado en mysql: '.mysqli_error($link));
		$P_FindSQL		=	mysqli_num_rows($SQL_);
		//echo $P_FindSQL;
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
	while($P_Exito2	=	mysqli_fetch_array($SQL_)) { 

	// DESDE AQUI LAS FILAS SEGUN TOTAL DE USUARIOS
	// por id, Ejem. fila 1, fila 2, fila 3, etc...
		$P_Conten	.=	'<tr id="fila_'.$n.'" onMouseOver="this.style.backgroundColor=\'#FFFF00\';" onMouseOut="this.style.backgroundColor=\'\';"';
		$P_Conten2	.=	'<tr id="fila_'.$n.'" onMouseOver="this.style.backgroundColor=\'#FFFF00\';" onMouseOut="this.style.backgroundColor=\'\';"';

		if($x==0):
			$P_Conten	.=	'bgcolor="'.$color.'"';
			$P_Conten2	.=	'bgcolor="'.$color.'"';
			$x = 1;
			;else:
			$P_Conten	.=	'bgcolor="'.$color2.'"';
			$P_Conten2	.=	'bgcolor="'.$color2.'"';
			$x=0; 
		endif;
		$P_Conten	.=	'>';
		$P_Conten2	.=	'>';
		$Tota	=	false;
		
	// DESDE AQUI LAS COLUMNAS DE LAS FILAS
	// por id, Ejem. fila 1 ( dia 1), fila 1 ( dia 2), fila 1 ( dia 3), etc...
		for($w	=	0	;	$w	<	$P_Res	;	$w++):
		//@$NCampo		=	 mysql_field_name($SQL_, $w-1);			// Buscar el nombre del campo       ///     #becfc4
		$P_Conten	.=	'<td width="25px" onMouseOver="this.style.backgroundColor=\'#FF0000\';" onMouseOut="this.style.backgroundColor=\'\';"';
		$P_Conten2	.=	'<td width="25px" onMouseOver="this.style.backgroundColor=\'#FF0000\';" onMouseOut="this.style.backgroundColor=\'\';"';
		//$P_Conten	.=	'<td width="20px" id="'.$NCampo.'" onmouseover="SombreadoCampos(\''.$NCampo.'\',\'1\'); this.style.Cursor=\'pointer\'" onmouseout="SombreadoCampos(\''.$NCampo.'\',\'0\')"';
			$P_Conten	.=	'>';
			$P_Conten2	.=	'>';
			$NCampo		=	mysqli_fetch_field_direct($SQL_, $w); // mysql_field_name($SQL_, $w);			// Buscar el nombre del campo

			//echo $NCampo
			include('911_criterios_de_calculos.php');
			// echo $w."<br />";

	// AQUI LOS CAMPOS CON LOS VALORES
	// ===============================
				if($w==0):
					//var_dump($NCampo);
					$P_Conten   .=  '<select class="js-example-basic-multiple" id="user-'.$P_Exito2['id'].'" name="user-'.$P_Exito2['id'].'" style="width:130px;font-size: 12px !important;" onchange="javascript: OtroGuardadoRapido(\'user-'.$P_Exito2['id'].'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\'); NoDuplicar(\''.$POST_users.'\',\'user-'.$P_Exito2['id'].'\')" title="user-'.$P_Exito2['id'].'">';
					$P_Conten   .=	'<option value="">Escoja</option>';
					$P_Conten   .=	$OPTION;//'<option id="'.$IDLABEL.'">'.$NOMBLABEL.'<option>';
					$P_Conten   .=	'</select>';
					//'<input style="width:70px" type=text id="c'.$w.'" name="c'.$w.'" value="c'.$w.'" />ssd';return TotalXs(\'id\',\''.$NCampo.'\',\''.$P_Res.'\')
					$P_Conten   .=  '<td>';
					//EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$POST[2].'\',\''.$P_Exito2['id'].'\',\''.$DIGITOS[$r].'\');
					//$P_Conten	.= '<input type="text" title="'.$P_Exito2["id"].'-'.$NCampo->name.'" />';
					$P_Conten	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo->name.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo->name.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo->name.'\');GuardadoRapido(\''.$NCampo->name.'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo->name.'" id="'.$P_Exito2['id'].'-'.$NCampo->name.'" style="width:28px;font-size: 12px;" value="'.$P_Exito2[$w].'" />';
					
					//$P_Conten	.=	'<div title="'.$P_Exito2['id'].'-'.$NCampo.'" onkeypress="return permite(event,\'pform\')" class="alrededorRojo" id="'.$P_Exito2['id'].'-'.$NCampo.'" onclick="javascript: creaInput(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'911_rolturn_preh_tmp_2\',\'id-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'24\',\'911_RolesTurnoDespa.php\'); " style="width:24px; text-align:center">'.$P_Exito2[$w].'</div></td>';
					$P_Conten   .=  '</td>';

					/** Nuevo Tab Panel Days */
					$P_Conten2   .=  '<select class="js-example-basic-multiple" id="user-'.$P_Exito2['id'].'" name="user-'.$P_Exito2['id'].'" style="width:130px;font-size: 12px !important;" onchange="javascript: OtroGuardadoRapido(\'user-'.$P_Exito2['id'].'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\'); NoDuplicar(\''.$POST_users.'\',\'user-'.$P_Exito2['id'].'\')" title="user-'.$P_Exito2['id'].'">';
					$P_Conten2   .=	'<option value="">Escoja</option>';
					$P_Conten2   .=	$OPTION;//'<option id="'.$IDLABEL.'">'.$NOMBLABEL.'<option>';
					$P_Conten2   .=	'</select>';
					//'<input style="width:70px" type=text id="c'.$w.'" name="c'.$w.'" value="c'.$w.'" />ssd';return TotalXs(\'id\',\''.$NCampo.'\',\''.$P_Res.'\')
					$P_Conten2   .=  '<td>';
					//EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$POST[2].'\',\''.$P_Exito2['id'].'\',\''.$DIGITOS[$r].'\');
					//$P_Conten	.= '<input type="text" title="'.$P_Exito2["id"].'-'.$NCampo->name.'" />';
					$P_Conten2	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo->name.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo->name.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo->name.'\');GuardadoRapido(\''.$NCampo->name.'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo->name.'" id="'.$P_Exito2['id'].'-'.$NCampo->name.'" style="width:28px;font-size: 12px;" value="'.$P_Exito2[$w].'" />';
					
					//$P_Conten	.=	'<div title="'.$P_Exito2['id'].'-'.$NCampo.'" onkeypress="return permite(event,\'pform\')" class="alrededorRojo" id="'.$P_Exito2['id'].'-'.$NCampo.'" onclick="javascript: creaInput(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'911_rolturn_preh_tmp_2\',\'id-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'24\',\'911_RolesTurnoDespa.php\'); " style="width:24px; text-align:center">'.$P_Exito2[$w].'</div></td>';
					$P_Conten2   .=  '</td>';
				;else:
					//EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo.'\');EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$POST[2].'\',\''.$P_Exito2['id'].'\',\''.$DIGITOS[$r].'\');
					//$P_Conten	.= '<input type="text" />';
					$P_Conten	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo->name.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo->name.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo->name.'\');GuardadoRapido(\''.$NCampo->name.'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo->name.'" id="'.$P_Exito2['id'].'-'.$NCampo->name.'" style="width:28px;font-size: 12px;" value="'.$P_Exito2[$w].'" />';
					
					$P_Conten2	.=	'<input type="text" title="'.$P_Exito2['id'].'-'.$NCampo->name.'" onblur="return BlocCampo(this.id)" onkeypress="return permite(event,\'pform\');" onkeyup="EvaluarHaciaAbajo(\''.$P_Exito2['id'].'-'.$NCampo->name.'\',\''.$TOTAL_CAMPOS.'\',\''.$P_Exito2['id'].'\',\''.$meses_evaluar.'\');EvaluarXs(\'Libre_'.$P_Exito2['id'].'\',\''.$P_Res.'\',\''.$P_Exito2['id'].'\',\'c\',\''.$P_Exito2['id'].'-'.$NCampo->name.'\');GuardadoRapido(\''.$NCampo->name.'\' ,\'DESP\', \''.$P_Exito2['id'].'\', \'id\');" onclick="FunOnclicK(this.id)" name="'.$P_Exito2['id'].'-'.$NCampo->name.'" id="'.$P_Exito2['id'].'-'.$NCampo->name.'" style="width:28px;font-size: 12px;" value="'.$P_Exito2[$w].'" />';
					
					//creaInput(\''.$P_Exito2['id'].'-'.$NCampo.'\',\''.$P_Exito2['id'].'\',\'911_rolturn_preh_tmp_2\',\'id-'.$NCampo.'\',\''.$P_Exito2[$w].'\',\'24\',\'911_RolesTurnoDespa.php\'); 
				endif;
				
			$P_Conten	.=	'</td>';
			$P_Conten2	.=	'</td>';
		
		endfor;

	/** 
	 * AQUI LOS DIAS LIBRES
	 */
	// El Total de dias libres X
		$P_Conten   .= '<td style="width:50px" align="center">&nbsp;<input readonly title="L_'.$P_Exito2['id'].'" type="text" id="Libre_'.$P_Exito2['id'].'" name="Libre_'.$P_Exito2['id'].'" value="'.$Rs.'" style="width:30px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center;font-size: 12px;" align="middle" ></td>'; //readonly
		$P_Conten2   .= '<td style="width:50px" align="center">&nbsp;<input readonly title="L_'.$P_Exito2['id'].'" type="text" id="Libre_'.$P_Exito2['id'].'" name="Libre_'.$P_Exito2['id'].'" value="'.$Rs.'" style="width:30px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center;font-size: 12px;" align="middle" ></td>'; //readonly
		$Rs		=	0;	
		
	} 
	//-> END WHILE

	/* 
		***********************************************
		* DESDE AQUI, EMPIEZO A CONSULTAR PARA SABER  *
		* EL TOTAL DE PERSONAS EN CADA TURNO          *
		* *********************************************
	*/
	//echo $PIDDEPTO;
	$Wer_hrs		=	'depto = "'.$PIDDEPTO.'"';
	$FindHorario 	=	$objMante->BuscarLoQueSea('*','911_mant_horas',$Wer_hrs);
	$P_MostrarHora	=	FALSE;
	// CAPTURAR LOS HORARIOS DENTRO DE UN SOLO PARAMETRO
	foreach($FindHorario['resultado'] as $Muestra) {
		$P_MostrarHora[]  .= $Muestra['horade'].'&nbsp;'.$Muestra['ampm_1'].'&nbsp;'.$Muestra['horaa'].'&nbsp;'.$Muestra['ampm_2'];
	}
	
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

	for($m	=	0	;	$m < $ToTArra ; $m++){			// TOTAL DE HORARIOS
		$P_Conten	.=	'<tr>';
		$P_Conten   .=	'<td align="center" bgcolor="#E8FFE8" style="font-family:Verdana;width:120px">'.$P_MostrarHora[$m].'</td>';
		
		/**
		 * Aqui la descripcion de los Horarios
		 */
		$P_Conten2	.=	'<tr>';
		$P_Conten2   .=	'<td align="center" bgcolor="#E8FFE8" style="font-family:Verdana;width:120px">'.$P_MostrarHora[$m].'</td>';

		/**
		 * Aqui el total de hora segun el dia
		 */
		for($y = 1 ; $y < $P_Res+1 ; $y++):				// TOTAL DE COLUMNAS ò DIAS EN EL MES
											
			$S		=	mysqli_query($link,'SELECT id,SUM(IF(c'.$y.'='.$P_Horarios[$m].',1,0)) as valorA FROM '.$NAMETBLTMP.' WHERE meses="'.$DIGITOS[$r].'" AND id_usuario = "'.$idUs.'" AND dpto = "'.$PIDDEPTO.'" AND area = "'.$P_Data.'" AND fecha = "'.$date.'"');// AND id > 0 AND id <= '.$POST[2]//ORDER BY id ASC LIMIT 0, '.$POST[2]);
			
			//$S		=	mysql_query('SELECT SUM(IF(c1=6,1,0)) as valorA, SUM(IF(c1=2,1,0)) as valorB, SUM(IF(c1=10,1,0)) as valorC FROM 911_rolturn_preh_tmp_2 WHERE meses="'.$DIGITOS[$r].'" AND id = "'.$y.'"');//ORDER BY id ASC LIMIT 0, '.$POST[2]);
			$R	 	=	mysqli_num_rows($S);
			$W		=	mysqli_fetch_array($S); 
			
			$P_Conten	.=	'<td><input disabled type="text" value="'.$W['valorA'].'" id="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" name="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" title="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" style="width:20px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center;font-size: 12px;"></td>';
			$P_Conten2	.=	'<td><input disabled type="text" value="'.$W['valorA'].'" id="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" name="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" title="'.$P_Horarios[$m].'-'.$meses_evaluar.'-'.$y.'" style="width:20px;background-color:#EAEAEA;border:1px solid #BDB737;text-align:center;font-size: 12px;"></td>';

		endfor;
		$P_Conten	.=	'</tr>';
		$P_Conten2	.=	'</tr>';
	}
					
		//unset($TurnoA);
		$P_Conten	.=	'</table>';
		$P_Conten2	.=	'</table>';
		$P_Conten	.=	'</div>';
		$P_Conten2	.=	'</div>';
		// ==============================
		$P_OtroMes	 =	$DIGITOS[$r] + 1;

		$P_Res 		= '';					//	Limpiar el total de dias del mes
		$P_ValoresColum3[1]	=	0;
		$Tot_turnoA	=	0;
		}// END FOR

		$P_TDMeses		.=	'</tr></table>';

		//$P_Conten2 ='';
		$row++;
}
// End: CANTIDAD DE MESES SELECCIONADAS
	
	
	// VERIFICAR QUE NO EXISTA UN ROL DE TURNO PARA ESTE
	// MISMO MES DE ESTE MISMO AÑO
	//echo $P_Data;
	if(!empty($P_VerSalida)):
		$P_Err	 =	0;
		$P_Data2 =	'';
		//echo $POST[5];
		for($rrh = $POST[3]	;	$rrh	<	$POST[4]+1 ; $rrh++):
			$P_SQL			=	mysqli_query($link,'SELECT * FROM 911_rolturn_desp WHERE area = "'.$P_Data.'" and meses = "'.$rrh.'" AND grupo ="'.$PNGRUPO.'" AND anyo= "'.$POST[5].'" LIMIT 1');
			$P_Tot			=	mysqli_num_rows($P_SQL);
			$P_DtArr		=	mysqli_fetch_array($P_SQL);
			
			if($P_Tot > 0):
				$P_Data2	.=	$MESES[$P_DtArr['meses']].' ';
				$P_Err		=	$P_Err + 1;
			endif;
		endfor;
	
		if($P_Err > 0):
			if($PNGRUPO!=''): $PNGRUPO = ' Grupo: '.$PNGRUPO;else: $PNGRUPO = '';endif;
			$MSSG		=	'<font face=Verdana size="2" color="red">Ya existen estos meses ( '.$P_Data2.','.$POST_anyo.' ) PARA ESTA AREA ( '.$N_Area['nombre'].' '.$PNGRUPO.' ), dentro de la base de datos <br /> No se permite guardar esta informacion, ya que ocasionaria duplicaciones. </font>';
			
		;else:
		
		endif;
	endif;
	
	// GUARDAR
	/* **********************************************************************
		- Guardar toda la informacion de los roles generados				*
		mas los cambios que el usuarios realize.							*
		- Se verifica que todos los campos  (usuarios: no esten en blanco),	*
		de igual manera que los campos de los horarios no esten en blanco	*
		- Se guarda cobn una clave para asi poder buscarlos nuevamente,		*
		si es que el usuario lo desea.										*
		*********************************************************************
	*/
	
	if(!empty($_POST['BtnGuardarTodo'])) { 	
		//mysql_query('insert into 911_rolturn_preh select * from 911_rolturn_preh_tmp_2');
		$objEjec 		=  	new ejecutorSQL();
		
		// LOS CAMPOS TABLA DESTINO
		$POSTARR		=	array('area'=>$_POST['PDATA'],'fechade'=>$_POST['de'],'fechaa'=>$_POST['a'],'fechahoy'=>date('Y-m-d'),'totusers'=>$_POST['cuantosuser'],'idUs'=>$idUs);
		$P_Campos_tmp2	=	'(';
		$P_Campos_tmp2	.=	'user,id_usuario,ncorto,fecha,';
		for($hh	 =	1	; $hh	< 32 ; $hh++)
		{
			$P_Campos_tmp2	.=	 'c'.$hh.',';	
		}
		$P_Campos_tmp2	.= 	'dpto,area,meses,anyo,clave,grupo,publicar,horario,activo';
		$P_Campos_tmp2	.=	')';
		
		// LOS CAMPOS TABLA ORIGEN
		$P_Campos_tmp	=	'';
		$P_Campos_tmp	.=	'i.user,i.id_usuario,i.ncorto,i.fecha,';
		for($hh	 =	1	; $hh	< 32 ; $hh++)
		{
			$P_Campos_tmp	.=	 'i.c'.$hh.',';	
		}
		$P_Campos_tmp	.= 	'i.dpto,i.area,i.meses,i.anyo,i.clave,i.grupo,i.publicar,i.horario,i.activo';
		$P_Campos_tmp	.=	'';
		
		//EVITAR EL F5 O REFRESH DE LA PAGINA, Y ASI NO VOLVER A INGRESAR LA TRANS...
		$objEjec->DeshacerTran();		
		//LUEGO INSERTAR EN LA TABLA PROMISCUA
		mysqli_query($link,'INSERT INTO 911_rolturn_desp '.$P_Campos_tmp2.' 
		SELECT '.$P_Campos_tmp.' FROM '.$_POST['tabla_tmp_area'].' i');
		//E INSERTAR EN LA TABLA (original)
		//ESTA NO SERA MODIFICADA, ES PARA LUEGO TENER UNA COMPARACION
		//----->mysql_query('INSERT INTO 911_rolturn_desp_orig '.$P_Campos_tmp2.' 
		//----->SELECT '.$P_Campos_tmp.' FROM '.$_POST['tabla_tmp_area'].' i');
		
		$P_ocultar		=	true;
		$P_VerSalida	=	TRUE;	
		$P_VerPrint		=	TRUE;
	
		// TRUNCATE A LAS TABLAS
		$objEjec->vaciarTabla($_POST['tabla_tmp_area']);
		$objEjec->vaciarTabla('911_rolturn_preh_tmp');
		mysqli_query($link,'DROP TABLE '.$_POST['tabla_tmp_area'].'');
						
		$msg2			=	strtoupper('<font size=2 family=Verdana color=red>Se ha guardado toda la informacion.</font>');
		$P_ParaPrint	=	FALSE;
		//$P_ParaPrint	=	'<a id="OptPrint" href="#" onClick="javascript: window.open(\'ventanas/911_PrintRolTurnoDespa.php?fechade='.$POSTARR['fechade'].'&fechaa='.$POSTARR['fechaa'].'&area='.$POSTARR['area'].'&dpto='.$PIDDEPTO.'&totusers='.$POSTARR['totusers'].'&idUs='.$POSTARR['idUs'].'&fechahoy='.$POSTARR['fechahoy'].'\',\'Rol de Turno\',\'scrollbars=yes,menubar=yes,fullscreen=yes,left=20px,top=20px,titlebar=no,toolbar=no,700px,height=500px\');" title="Imprimir el rol de turno">Imprimir </a>';
		$P_ParaPrint	=	'';//'<a id="OptPrint" href="#" onClick="javascript: window.open(\'ventanas/911_BuscarRolesTurnoPrint.php?fechade='.$POSTARR['fechade'].'&fechaa='.$POSTARR['fechaa'].'&area='.$POSTARR['area'].'&dpto='.$PIDDEPTO.'&totusers='.$POSTARR['totusers'].'&idUs='.$POSTARR['idUs'].'&fechahoy='.$POSTARR['fechahoy'].'\',\'Rol de Turno\',\'scrollbars=yes,menubar=yes,fullscreen=yes,left=20px,top=20px,titlebar=no,toolbar=no,700px,height=500px\');" title="Imprimir el rol de turno">Imprimir </a>';
	}
	
?>