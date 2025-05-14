<?PHP 
	// PLANNING
	/*
		Plantilla que muestra las reservas dentro del mes
		actual y los seleccionados
	*/
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	// require_once('config.php'); 
	include_once("config_pdo.php");

//header("Content-Type: text/html; charset=utf-8");
//header( 'Content-type: text/html; charset=iso-8859-1' );
//include_once("config_pdo.php");

  

  
	$P_TablePlanning = PREFIX.'planner';
	$P_TROOMS		 = PREFIX.'rooms';
	$P_TROOMSTYPE 	 = PREFIX.'rooms_type';
	$P_TFACTURAS     = PREFIX.'facturas';
	$P_TFACTClIENTES = PREFIX.'fact_clinetes';
	$P_TFACTPERFIL   = PREFIX.'fact_perfil';
	$P_TFACTPRODUCTS = PREFIX.'fact_products';
	$P_TFACTTMP 	 = PREFIX.'fact_tmp';
	$P_TADMINCIA 	 = PREFIX.'admin_empresas';
	$P_TNATIONALITIES= PREFIX.'nacionalidad';
	$P_TDOCUMENTSTYPE= PREFIX.'tipo_documentos';

	$ObjMante		 =	new Mantenimientos();
	$ObjMante2		 =	new Mantenimientos();
	$ObjEjec    	 = 	new ejecutorSQL();
	$ObjDate 		 =  new fecha();
	$objcmsIndx		 = 	new cms();

	$idusIndex 		 = 	$_SESSION['id_user'];//$objcmsIndx->consultarID();
	$TblBooking		 =	false;
	$objUser		 =	new Users();
	$DataUserCia	 =	$objUser->consultarUsuario($_SESSION['id_user']);
	$IDEMPRESA 		 = $_SESSION['id_cia'];


	// Search in planning
	//$events     	= $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'active=1 and id_cia='.$_SESSION['id_cia'],'array');
	// $sql        = "SELECT * FROM ".$P_TablePlanning." Where id_empresa = '".$_SESSION['id_empresa']."' and active = 1";
	// $req        = $connPDO->prepare($sql);
	// $req->execute();
	//$events     = $events['resultado'];//$req->fetchAll(PDO::FETCH_ASSOC);
  
	$date   = date('Y-m-d');

	
	if($DataUserCia['work_as']=='rooms') { 
    	$UseLike      =   '<font color="red">Hotel</font>';
  	} else {
    	$UseLike      =   '<font color="green">Hostel</font>';
  	}

	if($idusIndex==''): $objcmsIndx->direccionarPagina('login'); endif;

	
	// if(isset ($_SESSION['id_user']) && $_SESSION['id_user']==1||$_SESSION['id_user']==2):
	// 	$TblRooms	=	'ad_habitaciones';
	// 	$TblBooking	=	'ad_reservas';
	// 	$TblBeds	=	'ad_beds';
	// 	$TblRDays	=	'ad_reservas_days';
	// ;else:
	// 	$TblRooms	=	'ad_'.$_SESSION['id_user'].'_habitaciones';
	// 	$TblBooking	=	'ad_'.$_SESSION['id_user'].'_reservas';
	// 	$TblBeds	=	'ad_'.$_SESSION['id_user'].'_beds';
	// 	$TblRDays	=	'ad_'.$_SESSION['id_user'].'_reservas_days';
	// endif;

	// CAPTURAR PARAMETROS
	$PL_fin_est		=	isset($_POST['fin_estancia'])	?	$_POST['fin_estancia']	:	false	;		//	SHOW END DAYS OF GUEST
	$PL_habita_nes	=	isset($_POST['habita_nes'])		?	$_POST['habita_nes']	:	false	;		//	SHOW ROOMS
	$PL_Thabita_nes	=	isset($_POST['Thabita_nes'])	?	$_POST['Thabita_nes']	:	false	;		//	SHOW ROOMS TYPE
	$PL_meses		=	isset($_POST['PL_meses'])		?	$_POST['PL_meses']		:	date('n')	;
	$PL_anyo		=	isset($_POST['PL_anyo'])		?	$_POST['PL_anyo']		:	false	;
	
	$objcmsIndx		= 	new cms();
	$idusIndex 	    = 	$_SESSION['id_user'];//$objcmsIndx->consultarID();

	$P_Res			=	false;
	$x				=	false;										// Parametro utilizado para el for
	$ListaTotal		=	0;
	$objPFecha		=	new fecha();
	$MESACTUAL		=	date('m');									// Para saber el mes actual de 01 al 12
	$ANYOACTUAL		=	isset($_POST['PL_anyo'])?$_POST['PL_anyo']:date('Y');// Para sabaer el año actual
	$MESDIG1		=	isset($PL_meses)?$PL_meses:false;			// Representación numérica de un mes, sin ceros iniciales 	1 hasta 12
	$DIASDELMES		=	date('j');									// Día del mes sin ceros iniciales 	1 a 31
	$DIAACTUAL		=	date('Y-m-d');	


	// ***************
	// CHECK-OUT/In  *
	// ***************

	$DateSearch_s		=	' fecha_s = "'.date('Y-m-d').'"  AND activo = 1';
	$DateSearch_e		=	' fecha_e = "'.date('Y-m-d').'"  AND activo = 1';

	$totCheckOut		=	$ObjMante->BuscarLoQueSea('count(fecha_s) as tfecha_s', $P_TablePlanning, $DateSearch_s, 'extract');
	$totCheckIn			=	$ObjMante->BuscarLoQueSea('count(fecha_e) as tfecha_e', $P_TablePlanning, $DateSearch_e, 'extract');
	$TotCheckOut		=	0;
	$TotCheckIn			=	0;
	
	if($totCheckOut['tfecha_s']>0): $TotCheckOut	=	'<font color="#FF000" size=2 style="text-decoration:blink">'.$totCheckOut['tfecha_s'].'</font>';endif;
	if($totCheckIn['tfecha_e']>0): $TotCheckIn	=	'<font color="#FF000" size=2 style="text-decoration:blink">'.$totCheckIn['tfecha_e'].'</font>';endif;

	if($MESDIG1 == false):
		$MESDIG1	=	date('n');
	endif;
	
	$TotDiasMes		=	$objPFecha->UltimoDia(date('Y'),$MESDIG1);
	
	// SABER EL MES ACTUAL
	$ARRAY_F		=	array('','01'=>31,'02'=>29,'03'=>31,'04'=>30,'05'=>31,'06'=>30,'07'=>31,'08'=>31,'09'=>30,'10'=>31,'11'=>30,'12'=>31);
	$ARRAY_Ms		=	array('','1'=>'ENERO ','2'=>'FEBRERO ','3'=>'MARZO','4'=>'ABRIL','5'=>'MAYO','6'=>'JUNIO','7'=>'JULIO','8'=>'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11'=>'NOVIEMBRE','12'=>'DICIEMBRE');	
	$ARRAY_DIG		=	array('','01','02','03','04','05','06','07','08','09','10','11','12');
	$ARRAY_DIG1		=	array('','1','2','3','4','5','6','7','8','9','10','11','12');
	
	$DIGITOS		=	array('0','1','2','3','4','5','6','7','8','9','10','11','12');			
	$MESESLBL		=	array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$DIGITOS2		=	array('0','01','02','03','04','05','06','07','08','09','10','11','12');
	
	$P_Res			=	$objPFecha->UltimoDia(date('Y'),$DIGITOS2[8]);
	
	//$Letra			=	$objPFecha->NombreDelDia($DIGITOS2[$r], $d , $POST[5]);
	
	$listaHabita	=	$ObjMante->BuscarLoQueSea('*' , $P_TROOMS ,false,'array');
	$listaTHabita	=	$ObjMante->BuscarLoQueSea('*' , $P_TROOMSTYPE,false ,'array')	;
	
	//$DatosEmpresA	=	$mysqli->query('Select * From ad_admin_empresas Where activo=1 and id_empresa="'.$DataUserCia['id_empresa'].'"');
	$DatosEmpresA	=   $ObjMante->BuscarLoQueSea('*' , 'ad_admin_empresas','activo=1 and id_empresa="'.$DataUserCia['id_empresa'].'"',false);
	$DatosEmpresa	=	$DatosEmpresA; //$mysqli->mysqli_fetch_array($DatosEmpresA);
	$DatosEmpresa['work_as'];
	/*if($DatosEmpresa['total']==0):
		$Datos	=	$ObjMante->BuscarLoQueSea('*' , 'ad_usuario','activo=1 and id_usuario="'.$idusIndex.'"','extract');
		$DatosEmpresa	=	$ObjMante->BuscarLoQueSea('*' , 'ad_admin_empresas','activo=1 and id_empresa="'.$Datos['id_empresa'].'"','extract');
		$idusIndex		=	$DatosEmpresa['id_empresa'];
	endif;
	*/
	


	// Review some querys
	function Review($DActual,$Devaluate, $ID)
	{
		global $TblBooking,$IDEMPRESA;
		//ECHO 'Update ad_reservas_services set activo=0 Where id_tbl_reservas="'.$ID.'" id_empresa="'.$IDEMPRESA.'"';
		if($DActual>$Devaluate):
			//If It`s old reservations
			mysqli_query($link,'Update '.$TblBooking.' set activo=0 Where id="'.$ID.'"');
			
			mysqli_query($link,'Update ad_reservas_services set activo=0 Where id_tbl_reservas="'.$ID.'" id_empresa="'.$IDEMPRESA.'"');
			
		endif;		
	}
	
	// SEARCH FOR GUEST
	// *****************
	if($GET_q!=''):
		$FindGuest	=	$ObjMante->BuscarLoQueSea('*' , 'ad_guest_list' ,'(name like "%'.$GET_q.'%" or last_name like "%'.$GET_q.'%" or email like "%'.$GET_q.'%")','array');
		
	endif;
	
	// Month After & Month Befor
	// **************************
	if(isset($_POST['buttonMesDespues']) && $PL_meses && $PL_meses<13):
		$PL_meses 	= 	$PL_meses+1;
	endif;
	if(isset($_POST['buttonMesAntes']) && $PL_meses):
		$PL_meses 	= 	$PL_meses-1;
	endif;									
	// Some query's
	// *************
	// 1. Total Reservas
	
// INSERT / ADD

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['form-action']) && $_POST['form-action']=='add'){

	$title 	= $_POST['title'];
	$start 	= $_POST['start'];
	$end 	= $_POST['end'];
	$color 	= $_POST['color'];

	$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.$TblRooms,'activo = 1 and id_cia = '.$id_cia,'array');
	$sel_hb 	= 	$ObjMante->BuscarLoQueSea();
	$sel_hb 	=	mysqli_query($link,"Select * From ".$TblRooms." Where id = '".$_REQUEST['habitacion']."'") or die (mysqli_error($link));
	$data_hb 	=	mysqli_fetch_array($sel_hb);

	$start_n  	= 	explode(" ", $start);
    $end_n    	= 	explode(" ", $end);


	if ($_REQUEST['precio'] == '') { $_REQUEST['precio'] = '0.00'; }
	if ($_REQUEST['tot_personas'] == '') { $_REQUEST['tot_personas'] = '1'; }

	if ($color == '') { $color = '#FF0000';}


	// Reservas
	if ( $_POST['tipo_reserva'] == 'R') {

		// Aritmetic
		$total_dias	=	diasEntreFechas($start_n[0],$end_n[0]);
		$sub_total 	=	number_format(($total_dias * $_REQUEST['precio']),2);
		
		if ($_REQUEST['descuento'] > 0 ){ 
			$discounts_t= 	number_format($sub_total*$_REQUEST['descuento']/100,2);
		} else { $discounts_t = 0; } 
		
		//$total_price= number_format($sub_total*$_REQUEST['precio']/100 , 2);
		$total_price= 	number_format($sub_total-$discounts_t,2);//number_format($sub_total-$discounts_t,2);



		$sql 	= "INSERT INTO ".$TblBooking."(id_user, email, first_name, last_name, title, nationality, type_doc, number_doc, rooms, name_room, total_dias, total_persons, price, discounts, total_discounts, total_price, fecha_e, fecha_s, color, observation, tipo, activo) values ('".$_SESSION['id_user']."', '".$_REQUEST['email']."', '$title', '".$_REQUEST['apellido']."', '$title', '".$_REQUEST['nacionalidad']."', '".$_REQUEST['documento']."' , '".$_REQUEST['n_documento']."' , '".$_REQUEST['habitacion']."' , '".$data_hb['codigo']."' , '$total_dias' , '".$_REQUEST['tot_personas']."',  '".$_REQUEST['precio']."' , '".$_REQUEST['descuento']."' , '$discounts_t' , '$total_price' , '$start', '$end', '$color', '".$_REQUEST['observacion']."', '".$_REQUEST['tipo_reserva']."', 1)";

	// Eventos
	} elseif ( $_POST['tipo_reserva'] == 'E' ) {

		$sql 	= "INSERT INTO ".$TblBooking."(id_user, title, fecha_e, fecha_s, color, tipo, activo) values ('".$_SESSION['id_user']."','$title', '$start', '$end', '$color', '".$_REQUEST['tipo_reserva']."',1)";
	}

	// Save the customer in customer table 
	$nombre_cliente = $title . ' '. $_REQUEST['apellido'];
	$direccion 		= 'Cinta Costera, Panama City, Panama';
	$P_Campos 		= 'nombre_cliente,email_cliente,telefono_cliente,direccion_cliente,latitude,longitude,activo,date_added,id_empresa';
	$P_Valores 		= "'".$nombre_cliente."','".$_REQUEST['email']."','0','".$direccion."','0','0','1','".date('Y-m-d H:i:s')."','".$IDEMPRESA."'";
	// mysqli_query($link,"Insert into fact_clientes 
	// (nombre_cliente,email_cliente,telefono_cliente,direccion_cliente,latitude,longitude,activo,date_added,id_empresa) 
	// values ('".$nombre_cliente."','".$_REQUEST['email']."','0','".$direccion."','0','0','1','".date('Y-m-d H:i:s')."','".$IDEMPRESA."')")or die(mysqli_error($link));
	$query 			= $ObjEjec->insertarRegistro($P_FACTClIENTES, $P_Campos, $P_Valores);
	//$sql_tbl= "INSERT INTO ".$TblBooking."(title, fecha_e, fecha_s, color) values ('$title', '$start', '$end', '$color')";
	
	//echo $sql;	
	$query = $connPDO->prepare( $sql );
	if ($query == false) {
	 print_r($connPDO->errorInfo());
	 die ('Erreur prepare');
	}

	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}

// EDIT DATE
//echo$_POST['form-action'];
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id 	= $_POST['Event'][0];
	$start 	= $_POST['Event'][1];
	$end 	= $_POST['Event'][2];

	// Aritmetic
	/*$total_dias	=	diasEntreFechas($start_n[0],$end_n[0]);
	$sub_total 	=	number_format(($total_dias * $_REQUEST['precio']),2);
		
	if ($_REQUEST['descuento'] > 0 ){ 
		$discounts_t= 	number_format($sub_total*$_REQUEST['descuento']/100,2);
	} else { $discounts_t = 0; } 
	
	$total_price= 	number_format($sub_total-$discounts_t,2);//number_format($sub_total-$discounts_t,2);

*/
	
	$sql = "UPDATE ".$TblBooking." SET  fecha_e = '$start', fecha_s = '$end' WHERE id = $id ";

	
	$query = $connPDO->prepare( $sql );
	if ($query == false) {
	 print_r($connPDO->errorInfo());
	 die ('Error');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error');
	}else{
		die ('OK');
	}

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
	$DataEmpr   = $ObjMante->BuscarLoQueSea('*',$P_TADMINCIA,'id_empresa='.$DataUserCia['id_empresa'],'extract');
	//var_dump($DataEmpr['resultado']);
	//$DataEmpr	=	mysqli_fetch_array(mysqli_query($link,'Select * FRom ad_admin_empresas Where id_empresa="'.$DataUserCia['id_empresa'].'"'));
