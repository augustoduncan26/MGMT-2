<?PHP
	$objMante		= 	new Mantenimientos();
	$objPaginador 	= 	new paginador();
	$GET_opt		=	isset($_GET['opt'])?$_GET['opt']:'';			//	Buscar la opcion deseada
	$GET_np			=	isset($_GET['np'])		?	$_GET['np']			:	'';
	
	// PARAMETROS DE HOY
	$DIADEHOY		=	date("Y-m-d");
	$MESDEHOY1		=	date("Y-m-01");
	$MESDEHOY2		=	date("Y-m-30");
	
	$ARRAY_Ms		=	array('','1'=>'ENERO ','2'=>'FEBRERO ','3'=>'MARZO','4'=>'ABRIL','5'=>'MAYO','6'=>'JUNIO','7'=>'JULIO','8'=>'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11'=>'NOVIEMBRE','12'=>'DICIEMBRE');
	
	$MESACTUAL		=	date("n");
	$ANYOACTUAL		=	date("Y");
	
	
	// Buscar 	
	//$SQB	    		=	mysql_query('SELECT * FROM 911_cambios_x_mes,911_cambios_turnos WHERE 911_cambios_x_mes.id_usuario = 911_cambios_turnos.id_user_solic AND 911_cambios_turnos.fecha_registro between "'.$MESDEHOY1.'" AND "'.$MESDEHOY2.'"');
	//$TOT		=	mysql_num_rows($SQB);
	$ToTCambios		=	$objMante->Listar('911_cambios_x_mes','mes ="'.$MESACTUAL.'"',false,'id',true, $GET_np,'array');
	//$ToTCambios    	=	$objMante->BuscarLoQueSea('*', '911_cambios_x_mes','mes ="'.$MESACTUAL.'"', 'array');
	$total			=	$ToTCambios['total'];
	$actual			=	$GET_np;
?>