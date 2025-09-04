<?PHP 
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');

	$P_TablePlanning = 	PREFIX.'events';
	$ObjMante		 =	new Mantenimientos();
	$ObjEjec    	 = 	new ejecutorSQL();
	$ObjDate 		 =  new fecha();
	$objcmsIndx		 = 	new cms();
	$idusIndex 		= 	$_SESSION['id_user'];
	$id_rol     	= 	$_SESSION["id_rol"];
	$id_user    	= 	$_SESSION["id_user"];
	$id_cia 		= 	$_SESSION['id_cia'];
	$email 			= 	$_SESSION['email'];
	$TblBooking		=	false;
	$objUser		=	new Users();
	$DataUserCia	=	$objUser->consultarUsuario($_SESSION['id_user']);
	$IDEMPRESA 		= 	$_SESSION['id_cia'];
	
	 // Search in events
	 $events = $ObjMante->BuscarLoQueSea('*',$P_TablePlanning,'FIND_IN_SET('.$id_user.', perfil_id) > 0 and activo=1 and id_cia='.$_SESSION['id_cia'],'array');
	 if ($events['total'] > 0) {
		$events = $events['resultado'];
	 } else {
		$events = 0;
	 }
	 $date   = date('Y-m-d');
	
	$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
	$selectPerfiles= $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id <> 100 and activo = 1 and id_cia = '.$id_cia,'array');
	$selectEventos = $ObjMante->BuscarLoQueSea('*',PREFIX.'events','id_cia = '.$id_cia,'array');

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] !='') {

	if ($_POST['r2'] =='') { $_POST['r2'] = 0;}
	if ($_POST['r9'] =='') { $_POST['r9'] = 0;}
	if ($_POST['r4'] =='') { $_POST['r4'] = '00:00';}
	if ($_POST['r6'] =='') { $_POST['r6'] = '00:00';}

	$sql 		=	$ObjMante->BuscarLoQueSea('*',$P_TablePlanning,'id_cia="'.$id_cia.'" and name = "'.$_POST['r1'].'"','array');

	if ($sql['total'] > 0 ) {
		echo 'error';
	} else {
		$classArr = false;
		if ($_POST['r2']) {
			foreach ($_POST['r2'] as $key => $value) {
				if($classArr != '') {
					$classArr .=  ',';
				}	
				$classArr		.=	 $value;
			}
		}

		$perfilArr = false;
		if ($_POST['r9']) {
			foreach ($_POST['r9'] as $key => $value) {
				if($perfilArr != '') {
					$perfilArr .=  ',';
				}	
				$perfilArr		.=	 $value;
			}
		}

		$P_Campos 	=	'id_cia,name,date_start,time_start,date_end,time_end,class_id,perfil_id,description,tipo_color,created_at,activo';
		$P_Valores 	=	"'".$id_cia."','".$_POST['r1']."','".$_POST['r3']."','T".$_POST['r4']."','".$_POST['r5']."','T".$_POST['r6']."','".$classArr."','".$perfilArr."','".$_POST['r8']."','".$_POST['r10']."',NOW(),'".$_POST['r7']."'";
		$ObjEjec->insertarRegistro($P_TablePlanning, $P_Campos, $P_Valores);
		echo "ok";
	}
}


/**
 * Edit when user move the event
 */
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id 	= $_POST['Event'][0];
	$start 	= $_POST['Event'][1];
	$end 	= $_POST['Event'][2];

	$data1 = explode(' ',$_POST['Event'][1]);
	$data2 = explode(' ',$_POST['Event'][2]);

	$P_Valores 	= "date_start='".$data1[0]."', date_end='".$data2[0]."'";
	$l 			= $ObjEjec->actualizarRegistro($P_Valores, $P_TablePlanning, 'id = "'.$id.'"');

	if ($data1[1]!='' && $data2[1]!='') {
		$P_Valores 	= "time_start='T".$data1[1]."', time_end='T".$data2[1]."'";
		$l 			= $ObjEjec->actualizarRegistro($P_Valores, $P_TablePlanning, 'id = "'.$id.'"');
	}

	if ($l == 1) {
	 die ('OK');
	}else{
	 die ('Error');
	}
}


