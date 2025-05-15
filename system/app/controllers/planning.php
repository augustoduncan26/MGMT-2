<?PHP 
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');

	$P_TablePlanning = PREFIX.'events';
	$ObjMante		 =	new Mantenimientos();
	$ObjEjec    	 = 	new ejecutorSQL();
	$ObjDate 		 =  new fecha();
	$objcmsIndx		 = 	new cms();
	//$objcmsIndx->consultarID();
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
	 $events = $ObjMante->BuscarLoQueSea('*',$P_TablePlanning,'activo=1 and id_cia='.$_SESSION['id_cia'],'array');
	 $events = $events['resultado'];
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

/*
// DELETE 
if (isset($_POST['delete']) && isset($_POST['id'])){	
	$id = $_POST['id'];
	
	$sql = "UPDATE ".$TblBooking." set activo = 0 WHERE id = $id";
	$query = $connPDO->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

} // EDIT
 elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id 		= $_POST['id'];			$last_name 	=	$_POST['apellido_edit'];
	$title 		= $_POST['title'];		$rooms 		=	$_POST['habitacion_edit'];
	$color 		= $_POST['color'];		$totpersons =   $_POST['tot_personas'];
	$email 		= $_POST['email'];		$precio 	=	$_POST['precio_edit'];
	$descuento 	= $_POST['descuento_edit'];

	$fecha_e 	=	$_POST['fecha_e_editar'];
	$fecha_s 	=	$_POST['fecha_s_editar'];

	$nacionalidad = $_POST['nacionalidad_edit'];
	$documento 	=	$_POST['documento_edit'];
	$ndocumento =	$_POST['n_documento_edit'];
	$observacion =  $_POST['observacion_edit'];

	if ($_POST['tot_personas']=='') { $_POST['tot_personas'] = 0;}

	// Aritmetic
	//$total_dias	=	diasEntreFechass($start_n[0],$end_n[0]);
	//$sub_total 	=	($total_dias * $_REQUEST['precio_edit']);
	//$discounts_t= 	number_format($sub_total*$_REQUEST['precio_edit']/100 , 2);
	//$total_price= 	number_format($sub_total-$discounts_t,2);


	$sel_hb 	=	mysqli_query($link,"Select * From ".$TblRooms." Where id = '".$rooms."'") or die (mysqli_error($link));
	$data_hb 	=	mysqli_fetch_array($sel_hb);

	// Reservas
	if ( $_POST['tipo_reserva_edit'] == 'R') {

	 $sql = "UPDATE ".$TblBooking." SET  title = '$title', color = '$color', email='$email', last_name='$last_name', rooms='$rooms', name_room = '".$data_hb['codigo']."', total_persons = '".$_POST['tot_personas']."', price = '$precio', discounts = '$descuento', nationality = '$nacionalidad', type_doc = '$documento', number_doc = '$ndocumento', observation = '$observacion', fecha_e = '".$fecha_e."', fecha_s = '".$fecha_s."'  WHERE id = '$id' ";

	// Eventos
	} elseif ( $_POST['tipo_reserva_edit'] == 'E' ) {

		$sql 	= "UPDATE ".$TblBooking." SET  title = '$title', color = '$color',fecha_e = '".$fecha_e."', fecha_s = '".$fecha_s."'  WHERE id = $id";
	}

	$query = $connPDO->prepare( $sql );
	if ($query == false) {
	 print_r($query->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
*/

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
