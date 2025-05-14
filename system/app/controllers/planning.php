<?PHP 
	// PLANNING
	/*
		Plantilla que muestra las reservas dentro del mes
		actual y los seleccionados
	*/
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	// require_once('config.php'); 
	include_once("config_pdo.php");

	$P_TablePlanning = PREFIX.'planner';
	$P_TablePlanning = PREFIX.'events';

	$ObjMante		 =	new Mantenimientos();
	// $ObjMante2		 =	new Mantenimientos();
	$ObjEjec    	 = 	new ejecutorSQL();
	$ObjDate 		 =  new fecha();
	$objcmsIndx		 = 	new cms();

	$idusIndex 		 = 	$_SESSION['id_user'];//$objcmsIndx->consultarID();
	$id_rol     = $_SESSION["id_rol"];
	$id_user    = $_SESSION["id_user"];
	$id_cia 	= $_SESSION['id_cia'];
	$email 		= $_SESSION['email'];
	$TblBooking		 =	false;
	$objUser		 =	new Users();
	$DataUserCia	 =	$objUser->consultarUsuario($_SESSION['id_user']);
	$IDEMPRESA 		 = $_SESSION['id_cia'];
	
	 // Search in planning
	 $events = $ObjMante->BuscarLoQueSea('*',$P_TablePlanning,'activo=1 and id_cia='.$_SESSION['id_cia'],'array');
	 $events = $events['resultado'];//$req->fetchAll(PDO::FETCH_ASSOC);
	 $date   = date('Y-m-d');
	//  echo '<pre>';
	//  dump($events);
	 
	$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
	$selectPerfiles= $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id <> 100 and activo = 1 and id_cia = '.$id_cia,'array');
	$selectEventos = $ObjMante->BuscarLoQueSea('*',PREFIX.'events','id_cia = '.$id_cia,'array');

// INSERT / ADD

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['form-action']) && $_POST['form-action']=='add'){

	$title 	= $_POST['title'];
	$start 	= $_POST['start'];
	$end 	= $_POST['end'];
	$color 	= $_POST['color'];

	$selClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.$P_TablePlanning,'activo = 1 and id_cia = '.$id_cia,'array');

	$nombre_cliente = $title . ' '. $_REQUEST['apellido'];
	$direccion 	= 'Cinta Costera, Panama City, Panama';
	$P_Campos 	= 'nombre_cliente,email_cliente,telefono_cliente,direccion_cliente,latitude,longitude,activo,date_added,id_empresa';
	$P_Valores 	= "'".$nombre_cliente."','".$_REQUEST['email']."','0','".$direccion."','0','0','1','".date('Y-m-d H:i:s')."','".$IDEMPRESA."'";
	$query 		= $ObjEjec->insertarRegistro($P_FACTClIENTES, $P_Campos, $P_Valores);


}


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

// TAMBIEN EDIT MODAL FORM
if (GET()[1]=='12') { 
//echo 'AQUI';
}	
	//*************
	//Using the system as
	//echo $DataUserCia['id_empresa'];
	//$DataEmpr   = $ObjMante->BuscarLoQueSea('*',$P_TADMINCIA,'id_empresa='.$DataUserCia['id_empresa'],'extract');
	//var_dump($DataEmpr['resultado']);
	//$DataEmpr	=	mysqli_fetch_array(mysqli_query($link,'Select * FRom ad_admin_empresas Where id_empresa="'.$DataUserCia['id_empresa'].'"'));
