<?php
	//header("Content-Type: text/html;charset=utf-8");
	//include_once('../ad_config/ad_config.php');
	//include_once('../ad_libreria/fecha.php');
	//include_once('ad_Reemplazar_letras.inc.php');
	//include_once('../ad_funciones_php/ad_functions.php');
?>

<?php
	
	$ObjFecha		=	new fecha();
	$DataArr		=	false;
	$x				=	false;
	$NumFact		=	false;
	$msg 			=	false;
	$msg_del_aditional =false;
	$BlockButton	=	false;
	
	$TOTALF_1		=	isset($_POST['cuantas_f'])?($_POST['cuantas_f']):3;
	
	$POST_habit		=	isset($_GET['habita'])	?	$_GET['habita']	:'';
	$POST_bed		=	isset($_GET['bed'])		?	$_GET['bed']	:'';
	$POST_anyo		=	isset($_GET['anyo'])	?	$_GET['anyo']	:'';
	$POST_mes		=	isset($_GET['mes'])		?	$_GET['mes']	:'';
	
	$POST_dia		=	isset($_GET['dia'])		?	$_GET['dia']	:'';
	$GET_dater		=	isset($_GET['date_r'])	?	$_GET['date_r']	:'';
	$GET_opcion		=	isset($_GET['opcion'])	?	$_GET['opcion']	:'';
	$GET_color		=	isset($_GET['color'])	?	$_GET['color']	:'';
	
	$GET_forom		=	isset($_GET['from'])	?	$_GET['from']	:'';
	
	$GET_idFile		=	isset($_GET['id'])		?	$_GET['id']		:'';
	$GET_uregistra	=	isset($_GET['userregistra'])?$_GET['userregistra']:'';	// Same as id_empresa
	$GET_userreg	=	isset($_GET['userreg'])	?$_GET['userreg']	:	'';	// id_usuario
	$GET_id_empresa	=	isset($_GET['id_empresa'])	?$_GET['id_empresa']:'';

	$DataUserCia	=	isset($_GET['id_empresa'])?	$_GET['id_empresa']	:'';
	$DataIdUsuario	=	isset($_GET['id_user'])	?	$_GET['id_user']	:'';
	$DataFullVersion=	isset($_GET['full_version'])?$_GET['full_version']:'';
	$DataWorkAss 	=	isset($_GET['work_as'])	?	$_GET['work_as']	:'';
	$DataLanguage	=	isset($_GET['language'])	?	$_GET['language']		:'';

	$idusIndex		=	$GET_uregistra;
	
	//echo $POST_iduser		=	isset($_POST['idusuario'])	?	$_POST['idusuario']		:'';

	if($DataUserCia==1 || $DataUserCia==2):
	//if($idusIndex==1 || $idusIndex==2 || $idusIndex==5 || $POST_iduser==1 || $POST_iduser == 2 || $POST_iduser==5):
		$TblRooms	=	'ad_habitaciones';
		$TblBooking	=	'ad_reservas';
		$TblBeds	=	'ad_beds';
		$TblRDays	=	'ad_reservas_days';
	;else:
		$TblRooms	=	'ad_'.$DataUserCia.'_habitaciones';
		$TblBooking	=	'ad_'.$DataUserCia.'_reservas';
		$TblBeds	=	'ad_'.$DataUserCia.'_beds';
		$TblRDays	=	'ad_'.$DataUserCia.'_reservas_days';
	endif;
	
	
	// Block Buttons if color is white
	// ********************************
	if($GET_color=='white'): $BlockButton = 'disabled="disabled"';endif;
	
	$POST_bookers		=	isset($_POST['bookers'])	?	$_POST['bookers']		:'';
	$POST_fechaa		=	isset($_POST['f_date_a'])	?	$_POST['f_date_a']		:'';
	$POST_fechab		=	isset($_POST['f_date_b'])	?	$_POST['f_date_b']		:'';
	$POST_totpersons	=	isset($_POST['tot_persons'])?	$_POST['tot_persons']	:'';
	$POST_where_from	=	isset($_POST['where_from'])	?	$_POST['where_from']	:'';
	$POST_destination	=	isset($_POST['destination'])?	$_POST['destination']	:'';
	$POST_first_name	=	isset($_POST['first_name'])	?	$_POST['first_name']	:'';
	$POST_last_name		=	isset($_POST['last_name'])	?	$_POST['last_name']		:'';
	$POST_nationality	=	isset($_POST['nationality'])?	$_POST['nationality']	:'';
	$POST_date_birth	=	isset($_POST['date_birth'])	?	$_POST['date_birth']	:'';
	$POST_typedoc		=	isset($_POST['type_doc'])	?	$_POST['type_doc']		:	'';
	$POST_numberdoc		=	isset($_POST['number_doc'])	?	$_POST['number_doc']	:'';
	$POST_mail			=	isset($_POST['mail'])		?	$_POST['mail']			:'';
	$POST_country		=	isset($_POST['country'])	?	$_POST['country']		:'';
	$POST_gender_f		=	isset($_POST['gender_f'])	?	$_POST['gender_f']		:'';
	$POST_gender_m		=	isset($_POST['gender_m'])	?	$_POST['gender_m']		:'';
	$POST_rooms			=	isset($_POST['habitacion'])	?	$_POST['habitacion']	:'';
	$POST_cama			=	isset($_POST['cama'])		?	$_POST['cama']			:'';	
	$POST_status		=	isset($_POST['status'])		?	$_POST['status']		:'';
	$POST_opcion		=	isset($_POST['opcion'])		?	$_POST['opcion']		:'';	
	$POST_price			=	isset($_POST['price'])		?	$_POST['price']			:'00.00';
	$POST_discounts		=	isset($_POST['discounts'])	?	$_POST['discounts']		:'00.00';
	$POST_hearabout		=	isset($_POST['hear_about'])	?	$_POST['hear_about']	:'';
	$POST_tiposervicio	=	isset($_POST['tipo_servicio'])? $_POST['tipo_servicio']	:'';
	$POST_observation	=	isset($_POST['observation'])? $_POST['observation']		:'';
	$POST_idReg			=	isset($_POST['idReg'])		? $_POST['idReg']			:'';

	// Invoice Name Key
	$Random 			=	$DataIdUsuario.$DataUserCia.sanear_string($POST_habit).$POST_bed.'026_'.date('Y-m-d');//RandomString(10,TRUE,TRUE,FALSE);

	//include_once('ad_TemplateCreateInvoiceTCPDF.php');
	//CreateInvoice($Random); 
	//echo isset($_POST['buttonDelRow'])?$_POST['buttonDelRow']:'';

	// **************************
	// Some message parametter  *
	// switch from language     *
	// ==========================
	switch ($DataLanguage) {
		case 'es':
			$msg_del_reservation=	'Esta seguro de Eliminar este Registro? \n Esta accion eliminara toda información relacionada con este cliente.';
			$msg				=	'Todos los datos son requeridos';
			$msg_change_rooms 	=	'Esta accion cambiara al invitado de habitacion y/o cama, luego de presionar Modificar Data. \n Verifique el precio por cama o habitacion. \n';
			$msg_save_data		=	'Esta seguro de modificar los datos?';
			$msg_del_aditional	=	'Estas seguro?';
			$msg_data_save		=	'<h3>Los datos se han guardado con exito. Planning se refrescar automaticamente.</h3>';
			break;
		case 'ing':
			$msg_del_reservation=	'Are you sure to Delete these Record? \n This will delete all information from these client.';
			$msg				=	'All fields are required';
			$msg_change_rooms	=	'This acction will chang the guest room and/or bed, after pressing the Modify buttom. \n';
			$msg_save_data		=	'Are you sure to modify The record?';
			$msg_del_aditional	=	'Are you really sure?';
			$msg_data_save		=	'<h3>Data saved successfully. Planning will update at closing...</h3>';
			break;
	}
	
// ************************************
// Search for price, in services list *
// ************************************
	//$POST_services		=	isset($_POST['services'])?$_POST['services']:'';;
	/*
	if($TOTALF_1):
		//$SonFilas			=	count($POST_services);

		for($r=1;$r<$TOTALF_1+1;$r++):
			//echo $_POST['services_'.$r];
			$sql	=	"SELECT * FROM ad_iman_inventario Where id='".$_POST['services_'.$r]."'";// WHERE id_tipo_solic = '".$q."' AND fecha like '".date('Y').'-'.date('m').'-%'."'";
			$result = 	mysql_query($sql);
			$DataService	=	mysql_fetch_array($result);// mysql_num_rows($result);
			
		endfor;
	endif;
	*/
	/* 
		Search Data from the company, by the id_empresa user
	*/
	$DataEmpresa		=	mysql_fetch_array(mysql_query('Select *,ad_admin_empresas.id as id_admin_empresas From ad_usuario,ad_admin_empresas Where ad_usuario.id_usuario="'.$DataIdUsuario.'" AND ad_admin_empresas.id_empresa="'.$DataUserCia.'"'));
	// ******************************************************
	
	// Select las id from facturas
	// ****************************
	$NumFatcA			=	mysql_query('Select * From ad_admin_facturas Where id_empresa="'.$DataUserCia.'" order by id_facturas DESC');
	$NumFatc			=	mysql_fetch_array($NumFatcA);
	if(mysql_num_rows($NumFatcA)>0): $NumFact	= $NumFatc['id_facturas']+1; ;else: $NumFact = false; endif;
	
	if($NumFatc['id_facturas']==0): $NumFact = '00001'; 
	;elseif(strlen($NumFatc['id_facturas'])==1): @$NumFact = '0000'.$NumFact;
	;elseif(strlen($NumFatc['id_facturas'])==2): $NumFact = '000'.$NumFact;
	;elseif(strlen($NumFatc['id_facturas'])==3): $NumFact = '00'.$NumFact;
	;elseif(strlen($NumFatc['id_facturas'])==4): $NumFact = '0'.$NumFact;
	endif;
	// ****************************
	
	$TotDaysR			=	$ObjFecha->diasEntreFechas($POST_fechaa, $POST_fechab);
	/*
	function RandomString($length=7,$uc=TRUE,$n=TRUE,$sc=FALSE)
	{
	    $source 			= 'abcdefghijklmnopqrstuvwxyz';
	    if($uc==1) $source 	.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    if($n==1) $source 	.= '1234567890';
	    if($sc==1) $source 	.= '|@#~$%()=^*+[]{}-_';
	    if($length>0){
	        $rstr = "";
	        $source = str_split($source,1);
	        for($i=1; $i<=$length; $i++){
	            mt_srand((double)microtime() * 1000000);
	            $num = mt_rand(1,count($source));
	            $rstr .= $source[$num-1];
	        }
	 
	    }
	    return $rstr;
	}
	*/
// *****************************************************
// Edit Price de un dia en especifico
// *****************************************************
if(isset($_POST['buttonEditPriceThisDay'])):
	mysql_query('Update '.$TblRDays.' set price="'.$_POST['new_price'].'" Where day="'.$_POST['current_day'].'" and id_tbl_reservas="'.$GET_idFile.'"');
	$msg	=	strtoupper('Data saved successfully');	
endif;
	
// *************************
//  DELETE RESERVATION     *
// *************************
	if(isset($_POST['buttonDelReservation']))
	{
		// Delete information of this tables.
		// **********************************
		//echo $POST_idReg;
		mysql_query('Delete from '.$TblBooking.' Where id="'.$POST_idReg.'"');
		mysql_query('Delete from '.$TblRDays.' Where id_tbl_reservas="'.$POST_idReg.'"');
		mysql_query('Delete from ad_reservas_services Where id_tbl_reservas="'.$POST_idReg.'"');
		
		$msg		=	'<h3>The reservation has been deleted, Planning will update, closing window...</h3>';
						//	window.close();
						/*
						echo '
							<script>
								setTimeout("self.parent.tb_remove()",20000);
								//self.parent.tb_remove();
								parent.location.reload(1);
							</script>
						';
						*/
						
						echo '<script>
					          setTimeout("self.parent.tb_remove()",2000)
					          setTimeout(function(){parent.location.reload(0)},2000)
					         </script>';
					    
		
		//mysql_query('INSERT INTO ad_reservas_services(id_guest,id_empresa,id_tbl_reservas,room,cama,email,date,service,cantidad,price,total,observacion,activo)
	 	//	VALUES("'.$GET_idFile.'","'.$idusIndex.'","'.$GET_idFile.'","'.$DataGuest['rooms'].'","'.$DataGuest['cama'].'","'.$DataGuest['email'].'","'.date('Y-m-d').'","'.$_POST['services_'.$x].'","'.$_POST['cantidad_'.$x].'","'.$_POST['precio_'.$x].'","'.$SUB.'","'.$_POST['observacion_'.$x].'",1)');
		//	$filas_exito++;
		
	}
// *****************************************************
// ADD & REMOVE DATE
// *****************************************************
	
	// ************************
	// Sumar dias a una fecha *
	// ************************
	if(isset($_POST['buttonAddDays']) || isset($_POST['buttonRemoveDays']))
	{
		// ADD DAY
		// *********
		if(isset($_POST['buttonAddDays'])):
		
			$otrodiamas		=	$ObjFecha->SumarDiasAFecha($_POST['f_date_b'],1);
			
			// VErify if day is available
			// ***************************
			$SelVerify	=	mysql_query('Select * from '.$TblBooking.' Where fecha_e="'.$otrodiamas.'" and activo = 1');// and id="'.$GET_idFile.'"
			if(mysql_num_rows($SelVerify)>0):
				
				$msg		=	strtoupper('<h3>There is a conflict with another reservation.</h3>');
		
			;else:
			
				$buscarDta	=	@mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'"'));
				

				$SelUltDay	=	mysql_query('Select * From '.$TblRDays.' order by day DESC LIMIT 1');
				if(mysql_num_rows($SelUltDay)==1): $DtaLast	=	mysql_fetch_array($SelUltDay) ;else: $DtaLast = false; endif;
				
				$FullName2	=	$buscarDta['first_name'].' '.$buscarDta['last_name'];
		
				//mysql_query('UPDATE into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price,activo) values("'.$GET_idFile.'","'.$FullName2.'","'.$buscarDta['rooms'].'","'.$buscarDta['cama'].'","'.$otrodiamas.'","'.$buscarDta['price'].'",1)');
				mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price,activo) values("'.$GET_idFile.'","'.$FullName2.'","'.$buscarDta['rooms'].'","'.$buscarDta['cama'].'","'.$buscarDta['fecha_s'].'","'.$buscarDta['price'].'",1)');
							

				$SUMARPRECIO=	sprintf("%01.2f",($buscarDta['total_price']+$_POST['price']));
				
				mysql_query('Update '.$TblBooking.' set fecha_s="'.$otrodiamas.'", total_dias="'.($buscarDta['total_dias']+1).'", total_price="'.$SUMARPRECIO.'" Where id="'.$GET_idFile.'"');		//sumar un dia a la fecha final de reserva
				
				
							
				//endfor;
				
				//mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,day,room,cama,price,activo)
				//		values("'.$GET_idFile.'","'.$FullName2.'","'.$otrodiamas.'","'.$buscarDta['rooms'].'","'.$buscarDta['cama'].'","'.$buscarDta['price'].'",1)');	//insertar la fecha en la lista de fechas de reserva
		
				$msg		=	strtoupper('<h3>Data saved, Planning will update at closing...</h3>');
				
			endif;
		endif;
		
		// **************
		//   REMOVE DAY *
		// **************
		if(isset($_POST['buttonRemoveDays'])):
		
			
			$otrodiamenos	=	$ObjFecha->RestarDiasAFecha($_POST['f_date_b'],1);
			
			//echo $otrodiamenos;
			$SelVerify	=	mysql_query('Select * from '.$TblBooking.' Where fecha_s="'.$otrodiamenos.'" and cama="'.$POST_cama.'" and rooms="'.$POST_rooms.'" and activo = 1');// and id="'.$GET_idFile.'"
			
			if(mysql_num_rows($SelVerify)>0):
				
				$msg		=	strtoupper('<h3>There is a conflict with another reservation.</h3>');
		
			;else:
			
				$buscarDta	=	@mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'"'));
				$TotDaysR	=	$ObjFecha->diasEntreFechas($buscarDta['fecha_e'],$buscarDta['fecha_s']);
				
				$result		=	$ObjFecha->DevolverFechasEntreDos($buscarDta['fecha_e'],$buscarDta['fecha_s']);
				
				$RESTARPRECIO=	sprintf("%01.2f",($buscarDta['total_price']-$_POST['price']));
				
				mysql_query('Update '.$TblBooking.' set fecha_s="'.$otrodiamenos.'", total_dias="'.($buscarDta['total_dias']-1).'", total_price="'.$RESTARPRECIO.'" Where id="'.$GET_idFile.'"');		//sumar un dia a la fecha final de reserva
				
				$FullName2	=	$buscarDta['first_name'].' '.$buscarDta['last_name'];
				
				//Clean table
				//*************
				mysql_query('Delete from '.$TblRDays.' Where id_tbl_reservas="'.$GET_idFile.'" order by day DESC LIMIT 1');
				
				//for($r=0;$r<$TotDaysR-1;$r++):
				//			mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price,activo) values("'.$GET_idFile.'","'.$FullName2.'","'.$buscarDta['rooms'].'","'.$buscarDta['cama'].'","'.$result[$r].'","'.$buscarDta['price'].'",1)');
				//endfor;
				$msg		=	strtoupper('<h3>Data saved, Planning will update, closing window...</h3>');
			endif;
		endif;
		
		/*
		echo '
		  <script>
			//opener.location.reload();
			//window.close();
		  </script>
		';
		*/
	
		echo '<script>
          setTimeout("self.parent.tb_remove()",3000)
          setTimeout(function(){parent.location.reload(0)},2000)
         </script>';
    	
	}
	
// **********************
//  Search for customer *
// **********************
	if(isset($_POST['buscando']) && $_POST['buscando']!='')
	{
		$sql_		=	mysql_query('Select * From '.$TblBooking.' Where email="'.$POST_mail.'" and activo = 1');
	}
// **********************
// **********************
	
// *****************
//    CHECK INN    *
// *****************
// *****************

	if(isset($_POST['buttonCheckInnPay'])):
		
		if($POST_fechaa >= $POST_fechab){
			$msg		=	'Error: Wrong input date.';
		}else
		{ 
	
			//$sql_		=	mysql_query('Select * From '.$TblBooking.' Where email="'.$POST_mail.'" and activo = 1');
			$sql_		=	mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'" and activo = 1');
			
			// Update data and Check-Inn
			// **************************
				//, rooms="'.$_POST['rooms'].'", cama="'.$_POST['bed'].'",  where_coming_from="'.$_POST['where_from'].'", booker="'.$_POST['bookers'].'", destination="'.$_POST['destination'].'", escucho_de_nosotros ="'.$_POST['hear_about'].'", first_name="'.$_POST['first_name'].'", last_name="'.$_POST['last_name'].'", nationality="'.$_POST['nationality'].'", date_birth="'.$_POST['date_birth'].'", type_doc="'.$_POST['type_doc'].'", total_persons="'.$_POST['tot_persons'].'", number_doc="'.$_POST['number_doc'].'", email="'.$_POST['mail'].'", country="'.$_POST['country'].'", woman="'.$_POST['gender_f'].'", man="'.$_POST['gender_m'].'", fecha_e="'.$POST_fechaa.'", fecha_s="'.$POST_fechab.'", total_dias="'.$TotDaysR.'", price="'.$POST_price.'", discounts="'.$POST_discounts.'", total_price="'.$TOTAL_Price.'", observation="'.rtrim($POST_observation).'", 
				$Edit	=	mysql_query('Update '.$TblBooking.' set id_user="'.$GET_uregistra.'", paso="3"  Where id="'.$GET_idFile.'"');	
					
						$msg		=	'<h3>Data saved, Planning will update, closing window...</h3>';
						//	window.close();
						/*
						echo '
							<script>
								setTimeout("self.parent.tb_remove()",1000);
								//self.parent.tb_remove();
								parent.location.reload(1);
							</script>
						';
							*/
						
						echo '<script>
					          setTimeout("self.parent.tb_remove()",3000)
					          setTimeout(function(){parent.location.reload(0)},2000)
					         </script>';
					    
		}
	endif;

// **************************
// **************************	
// *   EDIT INFORMATIONS    *
// **************************
// **************************
	
	if(isset($_POST['buttonModify']) && $_POST['buttonModify']):
		
		$select		=	mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'"'));
		
		// **********************
		// CANCEL RESERVATIONS  *
		// **********************
		if($POST_status=='5'): 
			$Edit	=	mysql_query('Update '.$TblBooking.' set activo=0, id_user="'.$GET_uregistra.'"  Where id="'.$_POST['idReg'].'"');
			/*
			echo '
				  <script>
				 	setTimeout("self.parent.tb_remove()",1000);
					//self.parent.tb_remove();
					parent.location.reload(1);
				  </script>
				';
				*/
				/*
				echo '<script>
			          setTimeout("self.parent.tb_remove()",2000)
			          setTimeout(function(){parent.location.reload(0)},2000)
			         </script>';
			    */

			$msg		=	strtoupper('<h3>Data saved successfully, Planning will update at closing...</h3>');	
		else:
			
			// *******************************
			//  IF THEY CHANGE ROOMS OR BED  *
			// *******************************
			if($select['rooms']!=$_POST['rooms'] || $select['cama']!=$_POST['bed']): 
				//$selectcopy	=	mysql_query('Select * From ad_reservas_copy Where rooms="'.$GET_idFile.'" and cama="'.$GET_idFile.'" and activo=1');
			
				mysql_query('Insert into ad_reservas_copy(id_user,rooms,cama) 
				values("'.$GET_uregistra.'","'.$POST_rooms.'","'.$POST_cama.'")');
				
				mysql_query('Update '.$TblBooking.' set cama="'.$POST_cama.'", rooms="'.$POST_rooms.'" Where id="'.$GET_idFile.'"');
				mysql_query('Update '.$TblRDays.' set cama="'.$POST_cama.'", rooms="'.$POST_rooms.'" Where id_tbl_reservas="'.$GET_idFile.'"');
	
			endif;
			
			// *******************************
			// IF THE DATE CHANGE            *
			// *******************************
			/*
			
			if($select['fecha_e']!=$_POST['f_date_a'] || $select['fecha_s']!=$_POST['f_date_b'] || $select['rooms']!=$_POST['rooms'] || $select['cama']!=$_POST['bed']):
				mysql_query('Delete from '.$TblRDays.' Where cama="'.$select['cama'].'" and room="'.$select['rooms'].'" and activo=1');
				
				// Insert day reserved in table ad_reservas_days
				// *********************************************
				$FullName	=	$POST_first_name.' '.$POST_last_name;
				$result		=	$ObjFecha->DevolverFechasEntreDos($POST_fechaa,$POST_fechab);
				$TotDaysR	=	$ObjFecha->diasEntreFechas($POST_fechaa, $POST_fechab);
				
				for($r=0;$r<$TotDaysR+1;$r++):
					mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price) values("'.$select['id'].'","'.$FullName.'","'.$_POST['rooms'].'","'.$_POST['bed'].'","'.$result[$r].'","'.$POST_price.'")');
				endfor;
				
			endif;
			
			*/
			
// **********************************	
// **********************************
//    EDIT INFO FROM THE TEMPLATE   *
// **********************************
// **********************************
			// How much it is for days
			// ************************
			$TotDaysR	=	($TotDaysR);
			$PRE_PRICE	=	sprintf("%01.2f",($POST_price*$TotDaysR));
			$TOTAL_Price=	'00.00';
				
			if(isset($POST_discounts) && $POST_discounts!='00.00')://echo $POST_discounts;
				$TOTAL_Price=	sprintf("%01.2f",($PRE_PRICE-$POST_discounts));
			;else:
				$TOTAL_Price=	sprintf("%01.2f",$PRE_PRICE);
			endif;
					//echo $POST_tiposervicio; echo $_POST['tipo_servicio'];//$TblBooking;
					//echo 'Update '.$TblBooking.' set id_user="'.$GET_uregistra.'" , rooms="'.$_POST['rooms'].'", cama="'.$_POST['bed'].'", tipo_servicio="'.$_POST['tipo_servicio'].'", where_coming_from="'.$_POST['where_from'].'", booker="'.$_POST['bookers'].'", destination="'.$_POST['destination'].'", hear_about ="'.$_POST['hear_about'].'", first_name="'.$_POST['first_name'].'", last_name="'.$_POST['last_name'].'", nationality="'.$_POST['nationality'].'", date_birth="'.$_POST['date_birth'].'", type_doc="'.$_POST['type_doc'].'", total_persons="'.$_POST['tot_persons'].'", number_doc="'.$_POST['number_doc'].'", email="'.$_POST['mail'].'", country="'.$_POST['country'].'", woman="'.$_POST['gender_f'].'", man="'.$_POST['gender_m'].'", fecha_e="'.$POST_fechaa.'", fecha_s="'.$POST_fechab.'", price="'.$POST_price.'", discounts="'.$POST_discounts.'", total_price="'.$TOTAL_Price.'", paso="'.$POST_status.'" Where id="'.$_POST['idReg'].'"';
			$Edit	=	mysql_query('Update '.$TblBooking.' set id_user="'.$GET_uregistra.'" , rooms="'.$_POST['rooms'].'", cama="'.$_POST['bed'].'",  where_coming_from="'.$_POST['where_from'].'", booker="'.$_POST['bookers'].'", destination="'.$_POST['destination'].'", escucho_de_nosotros ="'.$_POST['hear_about'].'", first_name="'.$_POST['first_name'].'", last_name="'.$_POST['last_name'].'", nationality="'.$_POST['nationality'].'", date_birth="'.$_POST['date_birth'].'", type_doc="'.$_POST['type_doc'].'", total_persons="'.$_POST['tot_persons'].'", number_doc="'.$_POST['number_doc'].'", email="'.$_POST['mail'].'", country="'.$_POST['country'].'", woman="'.$_POST['gender_f'].'", man="'.$_POST['gender_m'].'", fecha_e="'.$POST_fechaa.'", fecha_s="'.$POST_fechab.'", total_dias="'.$TotDaysR.'", price="'.$POST_price.'", discounts="'.$POST_discounts.'", total_price="'.$TOTAL_Price.'", observation="'.rtrim($POST_observation).'", paso="'.$POST_status.'"  Where id="'.$_POST['idReg'].'"');//where_coming_from="'.$_POST['where_from'].'", booker="'.$_POST['bookers'].'", destination="'.$_POST['destination'].'", hear_about ="'.$_POST['hear_about'].'", first_name="'.$_POST['first_name'].'", last_name="'.$_POST['last_name'].'", nationality="'.$_POST['nationality'].'", date_birth="'.$_POST['date_birth'].'", type_doc="'.$_POST['type_doc'].'", total_persons="'.$_POST['tot_persons'].'", number_doc="'.$_POST['number_doc'].'", email="'.$_POST['mail'].'", country="'.$_POST['country'].'", woman="'.$_POST['gender_f'].'", man="'.$_POST['gender_m'].'", fecha_e="'.$POST_fechaa.'", fecha_s="'.$POST_fechab.'", price="'.$POST_price.'", discounts="'.$POST_discounts.'", total_price="'.$TOTAL_Price.'", paso="'.$POST_status.'" Where id="'.$_POST['idReg'].'"');//, hear_about_us="'.$_POST['hear_about'].'", first_name="'.$_POST['first_name'].'", last_name="'.$_POST['last_name'].'", paso="'.$_POST['status'].'" Where id="'.$_POST['idReg'].'"');
			
			$msg		=	strtoupper('<h3>Data saved successfully</h3>');	
		endif;
		
		$msg		=	'<h3>Data saved, Planning will update, closing window...</h3>';	
		/*
		echo '
			<script>
				setTimeout("self.parent.tb_remove()",100000);
				//self.parent.tb_remove();
				parent.location.reload(1);
			</script>
			';
		*/
		
			echo '<script>
          setTimeout("self.parent.tb_remove()",3000)
          setTimeout(function(){parent.location.reload(0)},2000)
         </script>';
         
					
	endif;
	
	
	
	if(isset($POST_mes) && strlen($POST_mes)==1): $POST_mes = '0'.$POST_mes; endif;
	if(isset($POST_dia) && strlen($POST_dia)==1): $POST_dia = '0'.$POST_dia; endif;
	
	//echo 'Select ad_currency_type.simbolo From ad_admin_empresas,ad_currency_type Where ad_admin_empresas.id_empresa="'.$GET_id_empresa.'" AND ad_admin_empresas.tipo_moneda=ad_currency_type.id';
	$SQL_DataCia	=	mysql_query('Select * From ad_admin_empresas Where ad_admin_empresas.id_empresa="'.$GET_uregistra.'"');
	if(mysql_num_rows($SQL_DataCia)>0){
		$DataCIA	=	mysql_fetch_array($SQL_DataCia);
		$SQL_DataCia2=	mysql_query('Select * From ad_currency_type Where id="'.$DataCIA['tipo_moneda'].'"');
		if(mysql_num_rows($SQL_DataCia2)>0){$DataCIA=mysql_fetch_array($SQL_DataCia2);}else{$DataCIA=false;}
		}else{$DataCIA=false;}
		
	
		
	
	$SQL_National	=	mysql_query('Select * From ad_nacionalidad order by nacionalidad ASC');
	$SQL_Country	=	mysql_query('Select * From ad_pais order by pais ASC');
	$SQL_Bookers	=	mysql_query('Select * From ad_bookers Where (id_empresa="0" or id_empresa="'.$DataUserCia.'") AND activo = 1 order by name ASC');
	$SQL_Status		=	mysql_query('Select * From ad_status_reservas');
	$SQL_HearAbout	=	mysql_query('Select * From ad_hear_about_us');
	$SQL_Rooms		=	mysql_query('Select * From '.$TblRooms.' Where activo="1"');
	$SEL_			=	mysql_query('Select * From '.$TblRooms.' Where codigo="'.$POST_habit.'" and activo=1');
	//echo 'Select * From '.$TblRooms.' Where codigo="'.$POST_habit.'"';
	if(@mysql_num_rows($SEL_)>0){$RoomsDetail	=	mysql_fetch_array($SEL_);}else{$RoomsDetail=false;}
	
// ************************************************
//  Search Info from user in ad_reservas_services *
// BUSCAR SERVICIOS DEL USER        	          *
// ************************************************
	if(isset($_POST['buttonAddRow'])):
		$TOTALF_1	=	($TOTALF_1+1);
	endif;
	if(isset($_POST['buttonDelRow'])):
		$TOTALF_1	=	($TOTALF_1-1);
	endif;

// *********************************************
// *********************************************	
// ADD Services to guest					   *
// Code Referente a los servicios que va 	   *
// consumiendo el user.						   *
// *********************************************
// Search price for the service
//for($t=1;$t<$TOTALF_1+1;$t++):
	//if($_POST['$_POST['services_'.$x]']):

	//endif;
//endfor;

// *************************
// SAVE SERVICE OR PRODUCT *
// *************************
// 
if(isset($_POST['buttonSaveDataService'])):
	$filas_exito	=	0;
	$SUB			=	false;
	$DataGuest	=	mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'" and activo=1'));
	
	
	for($x=1;$x<$TOTALF_1+1;$x++):
	
		if(isset($_POST['date_service_'.$x]) && isset($_POST['cantidad_'.$x]) && $_POST['date_service_'.$x]!='' && $_POST['cantidad_'.$x]!=''):
		
			$SUB	=	sprintf("%01.2f",($_POST['cantidad_'.$x]*$_POST['precio_'.$x]));
				$DtaService		=	0;
			if(isset($_POST['optservice_'.$x]) && $_POST['optservice_'.$x]=='service'):
				
				// Services
				$TextType		=	$_POST['optservice_'.$x];
				$DtaService		=	$_POST['services2_'.$x];

			;elseif(isset($_POST['optproduct_'.$x]) && $_POST['optproduct_'.$x]=='product'):
				// Products
				$TextType		=	$_POST['optproduct_'.$x];
				$DtaService		=	$_POST['services_'.$x];
				
				// Restar producto
				// ****************
				$DetailProducto	=	mysql_fetch_array(mysql_query('Select * from ad_iman_inventario Where id="'.$_POST['services_'.$x].'"'));
				$Restar			=	($DetailProducto['cantidad']-$_POST['cantidad_'.$x]);
				mysql_query('Update ad_iman_inventario set cantidad="'.$Restar.'" Where id="'.$_POST['services_'.$x].'"');
				
			endif;
			
			$POST_kilos		=	isset($_POST['quilos_'.$x])?$_POST['quilos_'.$x]:'';
			if($POST_kilos): $SUB	=	sprintf("%01.2f",($_POST['precio_'.$x]*$POST_kilos)); endif;
	
			mysql_query('INSERT INTO ad_reservas_services(id_guest,id_empresa,type,kilos,id_tbl_reservas,room,cama,email,date,service,cantidad,price,total,observacion,activo)
	 		VALUES("'.$GET_idFile.'","'.$DataUserCia.'","'.$TextType.'",0,"'.$GET_idFile.'","'.$DataGuest['rooms'].'","'.$DataGuest['cama'].'","'.$DataGuest['email'].'","'.date('Y-m-d').'","'.$DtaService.'","'.$_POST['cantidad_'.$x].'","'.$_POST['precio_'.$x].'","'.$SUB.'","'.$_POST['observacion_'.$x].'",1)');
			$filas_exito++;
			
		endif;
		
	endfor;
	
	if($filas_exito==0): 
		$msg	=	strtoupper('<h3>Error saving the data.</h3>');
		$TOTALF_1	=	2;
	;else: 
		$msg	=	strtoupper($msg_data_save);
		$TOTALF_1	=	$filas_exito;
	endif;
		/*
		echo '
		  <script>
		   opener.location.reload();
		  </script>
		';
		*/
endif;

	if($GET_idFile):
		$SONTOT_FIND=	0;
		$SL_		=	mysql_query('Select * From ad_reservas_services Where id_guest = "'.$GET_idFile.'" and activo=1 and id_empresa="'.$idusIndex.'"');
		
		$TOT_REF	=	mysql_num_rows($SL_);

		if(mysql_num_rows($SL_)>0):
		$SONTOT_FIND	=	mysql_num_rows($SL_);
		//b. Si ya ingreso datos y quiere mas filas O
		//c. Si no ha ingresado datos y quiere mas filas
		
		;elseif(mysql_num_rows($SL_)>0 && isset($_POST['cuantas_f'])):
			
			$TOTALF_1		=	($TOTALF_1+mysql_num_rows($SL_));
		//d. Por defecto 1 fila		
		/*;else:
			$TOTALF_1		=	1;
		*/
		endif;
		
		
	endif;
// ****************************
//     END DATA SERVICES      *
// ****************************



// *****************************	
//  Search for data by id      *
//  Data del cliente hospedado *
// *****************************
// echo 'Select * From '.$TblBooking.' Where id="'.$GET_idFile.'"';
	if($GET_idFile):
		$SQL_Data		=	mysql_query('Select * From '.$TblBooking.' Where id="'.$GET_idFile.'"');
		//echo mysql_num_rows($SQL_Data);
		$DataArr		=	mysql_fetch_array($SQL_Data);
		if(strlen($DataArr['total_persons'])==1): $DataArr['total_persons']='0'.$DataArr['total_persons'];endif;
		
		$SL_Services	=	mysql_query('Select * From ad_reservas_services Where id_guest="'.$GET_idFile.'" and activo=1 and id_empresa="'.$DataUserCia.'"');

	endif;
	
// Search total days for the reserve
// *********************************
		$Full_N		=	$DataArr['first_name'].' '.$DataArr['last_name'];
		$SL_Totdays	=	mysql_query('Select * From '.$TblRDays.' Where room="'.$DataArr['rooms'].'" AND cama="'.$DataArr['cama'].'" and activo=1 and name_guest="'.$Full_N.'"');
// *********************************

	$ArrayMes		=	array('','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'Dicember');
	//echo $TOTALF_1;

// ************************
//        CHECK OUT       *
// ************************

if(isset($_POST['buttonCheckOut'])):

	// Insert Into tabla facturas
	// ***************************
	$IDGUEST	=	mysql_fetch_array(mysql_query('Select * From ad_guest_list Where email="'.$DataArr['email'].'"'));
	$FULLNAME	=	@$IDGUEST['first_name'].'&nbsp;'.$IDGUEST['last_name'];
	//echo $IDGUEST['id'];
	
	// Insert data to table: caja
	// ***************************
	mysql_query('Insert into ad_admin_caja(id_user,id_empresa,id_guest,fecha_checkout,debito,referencia,detalle)
	values("'.$DataIdUsuario.'","'.$DataUserCia.'","'.$IDGUEST['id'].'","'.date('Y-m-d').'","'.$_POST['total_a_pagar'].'","'.$GET_idFile.'","Se realizo Check-Out id cliente '.$IDGUEST['id'].', nombre: '.$FULLNAME.'")');
	
	mysql_query('Insert into ad_admin_facturas(id_user_registra,id_empresa,id_guest,date,total,referencia,detalle)
	values("'.$DataIdUsuario.'","'.$DataUserCia.'","'.@$IDGUEST['id'].'","'.date('Y-m-d').'","'.$_POST['total_a_pagar'].'","'.$GET_idFile.'","Se realizo Check-Out")');
	
	// Update table: reservas
	// ***************************
	mysql_query('Update '.$TblBooking.' set paso=5, activo=0 Where id="'.$GET_idFile.'"');
	// Update table: ad_admin_services, put activo = 0
	
	// Update table: services
	// ***************************
	mysql_query('Update ad_reservas_services set activo=0 Where id_tbl_reservas="'.$GET_idFile.'" and id_empresa="'.$DataUserCia.'"');
	
	// Update table: Days
	// ***************************
	mysql_query('Update '.$TblRDays.' set activo=0 Where id_tbl_reservas="'.$GET_idFile.'"');
	
	// Verify % for Bookers
	// ********************
	/*
	if(isset($_POST['bookers']) && $_POST['bookers']!=''):
		// Select booker porcentage
		$SelBook	=	mysql_fetch_array(mysql_query('Select * From ad_bookers Where activo = 1 and id = "'.$_POST['bookers'].'" and id_empresa="'.$GET_id_empresa.'"'));
		
		$VALOR		=	(($_POST['total_noches']*$SelBook['porcent'])/100);
		$VALOR		=	sprintf("%01.2f",$VALOR);
		// Insert porcent for the bookers
		mysql_query('Insert into ad_admin_porcent_bookers(id_empresa,id_user_registra,id_guest,id_pais,porcent,id_bookers,date_checkin,date_checkout,date_registration) 
		values("'.$GET_id_empresa.'","'.$GET_uregistra.'","'.@$IDGUEST['id'].'","'.$IDGUEST['country'].'","'.$VALOR.'","'.$SelBook['id'].'","'.$_POST['f_date_a'].'","'.$_POST['f_date_b'].'","'.date("Y-m-d").'")');
	endif;
	
	*/

	$msg	=	strtoupper('<h3>Check-Out Successfully, Planning will update, closing window...</h3>');
	
	// Close PlanningMan
	//sleep(5);
	/*
	echo '
		  <script>
		    //opener.location.reload();
			//window.close();
			setTimeout("self.parent.tb_remove()",1000);
			//self.parent.tb_remove();
			parent.location.reload(1);
		  </script>
		';
		*/
	echo '<script>
          setTimeout("self.parent.tb_remove()",3000)
          setTimeout(function(){parent.location.reload(0)},2000)
         </script>';
endif;	

// *************************
//        CHECK INN        *
// *************************
/**
if(isset($_POST['buttonCheckInn'])):
	//$GET_uregistra
	//echo $idusIndex;
	if(isset($_GET['habita']) && $_GET['habita']!=''):
	
		$sqlB_	=	mysql_query('Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$POST_cama.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"');
		
		if(mysql_num_rows($sqlB_)<1)
		{
			$msg		=	'<h3>There is no data to update.</h3>';
				
		}else
		{
		$PRegistro		=	mysql_fetch_array($sqlB_);		
		//echo $PRegistro['id_tbl_reservas'];

		$Edit	=	mysql_query('Update '.$TblBooking.' set activo=1, paso=2  Where  rooms="'.strtoupper($_GET['habita']).'" AND id_user="'.$idusIndex.'" AND id="'.$PRegistro['id_tbl_reservas'].'"');
				echo '
					  <script>
						opener.location.reload();
					  </script>
					';
				$msg		=	strtoupper('<h3>Data saved successfully, status change to green</h3>');
		}
		
	;else:
				$msg		=	strtoupper('<h3>Error: Failed to save the information.</h3>');
	endif;
endif;

**/
// *************************
//   CHECK INN  & PAID     *
// *************************
if(isset($_POST['buttonCheckInnPay'])):
		
		$sqlB_	=	mysql_query('Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$POST_cama.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"');
		
		if(mysql_num_rows($sqlB_)<1)
		{
			$msg		=	'<h3>There is no data to update.</h3>';
				
		}else
		{
		$PRegistro		=	mysql_fetch_array($sqlB_);		
			$Edit	=	mysql_query('Update '.$TblBooking.' set activo=1, paso=3  Where  rooms="'.strtoupper($_GET['habita']).'" AND id_user="'.$idusIndex.'" AND id="'.$PRegistro['id_tbl_reservas'].'"');
					$msg		=	'<h3>Data saved, Planning will update, closing window...</h3>';
						//	window.close();
						/*
						echo '
							<script>
								setTimeout("self.parent.tb_remove()",1000);
								//self.parent.tb_remove();
								parent.location.reload(1);
							</script>
						';
						*/
					echo '<script>
				          setTimeout("self.parent.tb_remove()",3000)
				          setTimeout(function(){parent.location.reload(0)},2000)
				         </script>';
					//$msg		=	strtoupper('<h3>Data saved successfully, status change to Yellow</h3>');	
		}
endif;


// *****************************************
//   Close the Window (Refresh the opener) *
// *****************************************
if(isset($_POST['buttonClose'])):
	/*
	echo '
		  <script>
		   opener.location.reload();
			window.close();
		  </script>
		';
		*/
endif;

// Find type of currency.
// Using in the system
// **************************
	function CurrencyActual($GET_uregistra)
	{
		include_once('../ad_config/ad_config.php');
		$exito 		= 	false;
		//$objCms		=	new cms();
		//$objCons 	= 	new consultor();
		$datos		=	false;
		
		$cons		=	"*";
		$where		=	" Where id_empresa = '".$GET_uregistra."'";
		$P_Encontre	=	mysql_query('SELECT * FROM ad_admin_empresas '.$where);
		$datos		=	mysql_fetch_array($P_Encontre);
		
		if(mysql_num_rows($P_Encontre)>0)
		{	
			$where		=	" Where id = '".$datos['tipo_moneda']."'";
			$P_Encontre2=	mysql_query('SELECT * FROM ad_currency_type '.$where);
			$datosC		=	mysql_fetch_array($P_Encontre2);
			
			if(mysql_num_rows($P_Encontre2)>0)
			{
				$exito	=	$datosC['simbols'];
			}else
			{
				$exito	=	false;
			}
		}
		else
		{
				$exito	=	false;
		}
		return $exito;
	}
?>
<script type="text/javascript">
    //<![CDATA[
  var startTime = new Date();
  function showElapsedTime() {
    var testSiteUrl = location.href;;
    var testSiteString = String(testSiteUrl).slice(testSiteUrl.indexOf("www"));
    var endTime = new Date();
    var elapsedTime = Number(endTime-startTime);
    var browser=navigator.userAgent;
    var platform=navigator.platform;
   // var msgString = "Tiempo de carga <br/> " + Number(elapsedTime/1000) + " segundos (" + elapsedTime + " ms)<br/><span>Navegador " + browser + "</span>";
    var msgString	=	"";
	document.getElementById('mostrarTiempo').innerHTML 	= msgString;
	document.getElementById('mostrarTiempo2').innerHTML = '<strong>Procesando, espere porfavor... <image name="print" id="print" src="image/ajax-loader.gif" border="0" /></strong>';
  }
  onload=function() {showElapsedTime();}
</script>
<div id="mostrarTiempo" align="right" style="font-family:Verdana, Geneva, sans-serif; text-decoration:blink; color:#F00; font-size:12px;">Cargando... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<script>

// PRODUCTS

function mostrarInfo(cod,fila){

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
//document.getElementById("precio_"+fila).innerHTML=xmlhttp.responseText;
document.getElementById("precio_"+fila).value=xmlhttp.responseText;
// *******************************
// Now do aritmetic operations   *
// *******************************
var subtot_	=	(parseFloat(document.getElementById('cantidad_'+fila).value)*parseFloat(xmlhttp.responseText));
document.getElementById('total_'+fila).value	=	subtot_.toFixed(2);
//(parseInt(document.getElementById('cantidad_'+fila).value)*parseInt(document.getElementById('precio_'+fila).value));

}else{
//document.getElementById("precio_"+fila).innerHTML='Cargando...';
document.getElementById("precio_"+fila).value='espere...';
}
}
xmlhttp.open("POST","../ad_controles/ad_ConsultaAsincronica.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//alert(fila)
xmlhttp.send("cod_banda="+cod);
}


// SEARCH FOR SERVICES
// *******************
function mostrarInfo2(cod,fila){

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
//document.getElementById("precio_"+fila).innerHTML=xmlhttp.responseText;
document.getElementById("precio_"+fila).value=xmlhttp.responseText;
// *******************************
// Now do aritmetic operations   *
// *******************************
var subtot_	=	(parseFloat(document.getElementById('cantidad_'+fila).value)*parseFloat(xmlhttp.responseText));
document.getElementById('total_'+fila).value	=	subtot_.toFixed(2);
//(parseInt(document.getElementById('cantidad_'+fila).value)*parseInt(document.getElementById('precio_'+fila).value));

}else{
//document.getElementById("precio_"+fila).innerHTML='Cargando...';
document.getElementById("precio_"+fila).value='espere...';
}
}
xmlhttp.open("POST","../ad_controles/ad_ConsultaAsincronica.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//alert(cod)
xmlhttp.send("cod_banda="+cod+"&opc=s");
//alert(xmlhttp.send("cod_banda="+cod+"&opc=s"))
}

// TotalKilos = Kilos * Price
function MultKilos(cod,fila)
{
	var subtot_	=	(parseFloat(document.getElementById('quilos_'+fila).value)*parseFloat(document.getElementById('precio_'+fila).value));
	document.getElementById('total_'+fila).value	=	subtot_.toFixed(2);	
}

// ***************************
// Delete Rows from services *
// ***************************
function DeleteService(ID)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
		document.getElementById("mensajes").innerHTML=xmlhttp.responseText;
		document.planning.submit();
		// *******************************
		// Now do aritmetic operations   *
		// *******************************
		var subtot_	=	(parseFloat(document.getElementById('cantidad_'+fila).value)*parseFloat(xmlhttp.responseText));
		document.getElementById('total_'+fila).value	=	subtot_.toFixed(2);
		//(parseInt(document.getElementById('cantidad_'+fila).value)*parseInt(document.getElementById('precio_'+fila).value));
		
		}else{
		//document.getElementById("precio_"+fila).innerHTML='Cargando...';
		document.getElementById("mensajes").innerHTML='espere...';
		
		}
	}
	
	xmlhttp.open("POST","../ad_controles/ad_ConsultaAsincronica.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//alert(cod)
	xmlhttp.send("idReg="+ID+"&opc=R");
	//alert(xmlhttp.send("cod_banda="+cod+"&opc=s"))		
}

// List total bed for rooms
// *************************
function SearchforTotalBeds(Room)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
		document.getElementById("mensajes").innerHTML=xmlhttp.responseText;
		document.planning.submit();
		// *******************************
		// Now do aritmetic operations   *
		// *******************************
		var subtot_	=	(parseFloat(document.getElementById('cantidad_'+fila).value)*parseFloat(xmlhttp.responseText));
		document.getElementById('total_'+fila).value	=	subtot_.toFixed(2);
		//(parseInt(document.getElementById('cantidad_'+fila).value)*parseInt(document.getElementById('precio_'+fila).value));
		
		}else{
		//document.getElementById("precio_"+fila).innerHTML='Cargando...';
		document.getElementById("mensajes").innerHTML='espere...';
		
		}
	}
	
	xmlhttp.open("POST","../ad_controles/ad_ConsultaAsincronica.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//alert(cod)
	xmlhttp.send("idReg="+ID+"&opc=R");
	//alert(xmlhttp.send("cod_banda="+cod+"&opc=s"))		
}

</script>

<link href="../ad_css/tablas.css" type="text/css" rel="stylesheet" />
<link href="../ad_css/bordes_tablas.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../ad_js/operaciones_en_campos.js"></script>
<script type="text/javascript" src="../ad_js/consulta_asincronica.js"></script>

<script type="text/javascript" src="../ad_js/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../ad_js/jquery/jquery-ui.min.js"></script>

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
     <?php } ?>
     $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
</script>

<!--
 Consulta asincronica -->
<script type="text/javascript">

// ==============================================
	// Funcion para sombrear la fila al pasar el mouse
function Sombrear(Campo,Valor)
{	
	if(Valor==true)
	{
		document.getElementById(Campo).style.backgroundColor = '#becfc4';
	}
	else
	{
		document.getElementById(Campo).style.backgroundColor = '';
	}
	//this.style.backgroundColor = '#becfc4'; 
	//this.style.backgroundColor = '';"
}
</script>

<script>
function RevisarElCorreo(CAMPO)
{
	var control	=	CAMPO
	var s = document.getElementById(control).value;
	var error = new Array();
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	error[1]= "Please enter a valid email, example: example@domain.com";			
	
	if (!filter.test(s)){ 
		alert(error[1]);
		document.getElementById(control).style.border 		=	'1px solid #BDB737';
		document.getElementById(control).style.borderColor	=	"red";
		document.getElementById(control).focus();
		return (false);
	}
	else
	{
		return true;	
	}
}

// Comparar dos fechas
// *******************
function fechaPosterior(){
	    //cambiarian lo que hay dentro del getElement... por los elementos que contienen las fechas a validar
	    // la fecha debe tener el formato siguiente dd/mm/yyyy
	    var fechaInicio 	= document.getElementById("f_date_a");
	    var fechaFin 	= document.getElementById("f_date_a");
	    
	    var anio		= parseInt(fechaInicio.value.substring(0,4));
	    //var anio 		= parseInt(fechaInicio.value.substring(6,10));
	    var mes 		= fechaInicio.value.substring(5,7);
	    var dia 		= fechaInicio.value.substring(8,10);
	    
	    var c_anio 		= parseInt(fechaFin.value.substring(0,4));
	    //var c_anio 		= parseInt(fechaFin.value.substring(6,10));
	    var c_mes 		= fechaFin.value.substring(5,7);
	    var c_dia 		= fechaFin.value.substring(8,10);
	    if(c_anio > anio)
	        return(true);
	    else{
	        if (c_anio == anio){
	            if(c_mes > mes)
	                return(true);
	            if(c_mes == mes)
	                if(c_dia >= dia)
	                    return(true);
	                else
	                    return(false);
	            else
	                return(false);
	        }else
	            return(false);
	    }
	}
function validar() {
	inicio=document.getElementById('f_date_a').value;
	final=document.getElementById('f_date_b').value;
	inicio=new Date(inicio);
	final=new Date(final);
	if(inicio>final)
	alert('Fechas erroneas');
}
</script>
<!-- OTRO MASK INPUT -->
<script>window.onerror=null</script>
<script type="text/javascript" src="../ad_tools/mask_input/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../ad_tools/mask_input/jquery.maskedinput-1.2.2-co.min.js"></script>
<!-- FIN -->
  <!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
<script type="text/javascript" src="jscalendar/calendar.js"></script>

  <!-- language for the calendar -->
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<form action="" name="planning" autocomplete="off" id="planning" method="post">
<table width="100%" border="0" class="bordeTodalaTabla_3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" style="color:#F00"><div id="mensajes"><?PHP echo $msg;?></div></td>
    <td colspan="2" align="right">
      <!-- bgcolor="#F2F2F2"
    Search:
      <input type="text" name="buscando" id="buscando" style=" margin-left:5px;margin-top:5px;width:200px;background-image:url(../ad_images/buscar.gif); background-repeat:no-repeat; background-position:right; font-size:11px" class="bordered" value="Buscar" onblur="if(this.value=='') this.value='Buscar'" onfocus="if(this.value =='Buscar' ) this.value=''">
      -->
      <?php if($GET_forom!='reservas'):?><a href="#" onclick="javascript: window.close();">close <img src="../ad_images/close.gif" width="16" height="14" border="0" /></a><?php endif;?></td>
    </tr>
    <tr>
    <td colspan="6" height="5px"></td>
    </tr>
  <tr>
    <td width="17" bgcolor="#C9C9C9"><?PHP //echo 'From the day: '.$POST_dia.' of '.$ArrayMes[$POST_mes].' '.$POST_anyo;?></td>
    <td colspan="2" bgcolor="#C9C9C9">Arrival day: 
      <input name="f_date_a" id="f_date_a" type="text" readonly class="bordeTodalaTabla_3" style="width:100px; font-size:12px" value="<?php if(isset($DataArr['fecha_e'])): echo $DataArr['fecha_e']; elseif(isset($_POST)):echo $POST_anyo.'-'.$POST_mes.'-'.$POST_dia;; endif;?>">
      <!--<img src="../ad_images/calendar.png" width="16" height="16" id="f_trigger_c" style="cursor:pointer">-->
      <script type="text/javascript">
    /*
    Calendar.setup({
        inputField     :    "f_date_a",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
    */
</script>
      Departure day:
      <input type="text" name="f_date_b" id="f_date_b" readonly class="bordeTodalaTabla_3" style="width:100px; font-size:12px" onchange="return fechaPosterior()" value="<?PHP if(isset($DataArr['fecha_e'])): echo $DataArr['fecha_s']; elseif(isset($_POST)):echo $POST_fechab; endif;?>">
     <!-- <img src="../ad_images/calendar.png" width="16" height="16" id="f_trigger_d" style="cursor:pointer">-->
      <script type="text/javascript">
    /*
    Calendar.setup({
        inputField     :    "f_date_b",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_d",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
	*/
      </script>

         <td bgcolor="">&nbsp;<input type="submit" name="buttonDelReservation" <?=$BlockButton?> class=" bordeTodalaTabla_3" id="buttonDelReservation" onclick="if(confirm('Esta seguro?')){ return true}else{return false}" value="    Delete Reservation?" title="Delete Reservation." style="background-image:url(../ad_images/b_drop.png); background-repeat:no-repeat; background-position:left; cursor:pointer" />
         <td colspan="2" align="center" bgcolor="">
    
    <?PHP if($GET_opcion==true):?>
    
      <input type="submit" class=" bordeTodalaTabla_3" <?=$BlockButton?> title="Add Days" blocked="blocked" name="buttonAddDays" id="buttonAddDays" value="   Add days" style="background-image:url(../ad_images/add2.png); background-repeat:no-repeat; background-position:left; cursor:pointer" onclick="if(confirm('Are you sure to add 1 day more')){ return true}else{return false}" />
      &nbsp;
      <input type="submit" class=" bordeTodalaTabla_3" <?=$BlockButton?> name="buttonRemoveDays" title="Remove Days" id="buttonRemoveDays" value="   Remove days" style="background-image:url(../ad_images/delete2.png); background-repeat:no-repeat; background-position:left; cursor:pointer" onclick="if(confirm('Are you sure to remove 1 day to the range date')){ return true}else{return false}" />      &nbsp;(<?PHP $TOTDAYSNIGHT	=	$DataArr['total_dias']; echo $DataArr['total_dias'].' nights';//(@mysql_num_rows($SL_Totdays)-1).' noches'; //@mysql_num_rows($SL_Totdays)-1;?>) </td>
    
    <?PHP endif;?>

    <td width="0"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td colspan="6">
    <?PHP if($GET_opcion==true):?>
   
    Services &nbsp;&nbsp; | &nbsp;&nbsp;
    <input type="hidden" name="cuantas_f" id="cuantas_f" style="width:40px; font-size:10px;" value="<?PHP echo $TOTALF_1;?>" />
   <input type="submit" name="buttonAddRow" <?=$BlockButton?> class="bordeTodalaTabla_3" id="buttonAddRow" style="background-image:url(../ad_images/add2.png); background-repeat:no-repeat; cursor:pointer" value="   rows" 
  onclick="
  var encontro		=	'<?PHP echo $TOTALF_1?>';
 
  if(document.getElementById('cuantas_f').value =='')
  { 
  	document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;Debe introducir un valor numerico.';
    return false
  }else{
  
  // VERIFICO QUE NO INTRODUZCAN LETRAS NI CARACTERES
        // ================================================
	   if((String(document.getElementById('cuantas_f').value).search(/^\d+$/) != -1))
	  {
  			document.planning.submit();
  	  }else
      {
      		document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;Debe introducir un valor numerio.';
        	return false
      }
    /**  
  	if(encontro!='' && document.getElementById('cuantas_f').value < encontro)
    {
    	document.getElementById('cuantas_f').value			=   encontro;
        document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;El valor introducido no es permitido.';
        return false
    }else
    {
    	// VERIFICO QUE NO INTRODUZCAN LETRAS NI CARACTERES
        // ================================================
	   if((String(document.getElementById('cuantas_f').value).search(/^\d+$/) != -1))
	  {
  			document.planning.submit();
  	  }else
      {
      		document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;Debe introducir un valor numerio.';
        	return false
      }
    }
    */
  }
  "/>
   <input type="submit" name="buttonDelRow" <?=$BlockButton?> class="bordeTodalaTabla_3" style="background-image:url(../ad_images/delete2.png); background-repeat:no-repeat; cursor:pointer" id="buttonDelRow" value="   rows" onclick="
    if((String(document.getElementById('cuantas_f').value).search(/^\d+$/) != -1))
	  {
  			document.planning.submit();
  	  }else
      {
      		document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;Debe introducir un valor numerio.';
        	return false
      }
      
   // ************************************
   
   if(document.getElementById('cuantas_f').value==1)
   {
   		//document.getElementById('mensajes').innerHTML		=	'&nbsp;&nbsp;Debe introducir un valor numerio.';
       	return false
   }else
   {
   		return true;
   }
   " />
   <input type="submit" name="buttonSaveDataService" <?=$BlockButton?> title="Save Additional" id="buttonSaveDataService" class="Estilo_Boton3D bordered" value="  Save Additional Services" onclick="
   javascript:
   var total	=	document.getElementById('cuantas_f').value;

	
   if(document.getElementById('cuantas_f').value =='')
  { 
  	document.getElementById('mensajes').innerHTML			=	'&nbsp;&nbsp;Debe introducir un valor numerico.';
    document.getElementById('cuantas_f').style.borderColor	=	'red';
    document.getElementById('cuantas_f').focus();
    return false
  }else{
  	//   VERIFICO QUE NO INTRODUZCAN LETRAS NI CARACTERES
    // ===================================================
	   if((String(document.getElementById('cuantas_f').value).search(/^\d+$/) != -1))
	  {
  			document.referencias.submit();
  	  }else
      {
      		document.getElementById('mensajes').innerHTML			=	'SOLO SE ACEPTAN VALORES NUMERICOS.';
            document.getElementById('cuantas_f').style.borderColor	=	'red';
            document.getElementById('cuantas_f').value				=	'';
            document.getElementById('cuantas_f').focus();
        	return false
      }
  }
   " style=" width:200px; background-image:url(../ad_images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" />
   <!---
  <?PHP if($TOTALF_1>0){?><input type="submit" name="buttonEdit" id="buttonEdit" value="     Editar Datos     " onclick="if(confirm('Esta seguro?')){return true}else{return false;}"/><?PHP }else{?><input type="submit" name="buttonGr" id="buttonGr" value="     Guardar Datos     "/><?PHP } ?>
  -->
   <font color="#FF0000" size="1">
   <input type="hidden" name="hiddenField" id="hiddenField" />
   [All files are required. Rows in blank dont saved]</font>
   <table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#FFF" id="tablaFormulario">
      <tr>
        <td width="12%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">&nbsp;Date service</td>
        <td width="17%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">Service or Product?</td>
        <td width="7%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">&nbsp;Amount</td>
        <td bgcolor="#0028CA" class=" linea_abajo linea_deresa" colspan="2">&nbsp;Detail</td>
        
        <td width="6%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">&nbsp;Price</td>
        <td width="6%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">&nbsp;Total</td>
        <td width="19%" bgcolor="#0028CA" class=" linea_abajo linea_deresa">&nbsp;Observation</td>
        <!--<td width="8%" bgcolor="#0028CA" class=" linea_abajo linea_deresa" align="center">Guardar</td>-->
        </tr>
      
      <?PHP
	  if(mysql_num_rows($SL_Services)>0){
		  $x = 0;
      while($DataService=mysql_fetch_array($SL_Services))
			{	
				$x++;
				// <?PHP if($x==$LAFILA){ echo 'style="background-color:#CCC"';}
				//<a href="#" onclick="javascript: if(confirm(\'Esta seguro?\')){ self.location=(\'plantilla.php?pg=expr&reg='.$DataGral['date'].'&del=1\')}"><img src="imgs/delete2.png"  title="" border="0" /></a>
				echo '
						<tr style="color:#000">
						<td class="linea_deresa2 lineaabajo three" align=center width="100px">'.$DataService['date'].'</td>
					
					 ';
				?>
                	<!-- <select name="services_<?PHP echo $x?>" id="services_<?PHP echo $x?>" style="width:300px; border:0px; height:13px; font-size:10px"> 
                    <input class="three" readonly="readonly" maxlength="5" style="height:20px;width:50px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif" type="text" name=cantidad_'.$x.' value="'.$DataService['service'].'">
						-->
                     
					 <!--
                     
                        -->
                <?PHP
				
				echo '  <td class="linea_deresa2 lineaabajo" width="15%" >'.$DataService['type'].'</td>';
                echo '	<td class="linea_deresa2 lineaabajo" width="8%" >'.$DataService['cantidad'].'</td>';
				
				if($DataService['type']=='service'): 
					$Labels1	=	mysql_fetch_array(mysql_query('Select * From ad_tipo_servicio Where activo=1 and id_empresa="'.$DataUserCia.'" and idTS="'.$DataService['service'].'"'));
					$table_		=	'ad_tipo_servicio';
					echo '<td class="linea_deresa2 lineaabajo">'.$Labels1['name'].'</td>';

				;elseif($DataService['type']=='product'):
					$Labels2	=	mysql_fetch_array(mysql_query('Select * From ad_iman_inventario Where activo=1 and id_empresa="'.$DataUserCia.'" and id="'.$DataService['service'].'"'));
					$table_		=	'ad_iman_inventario';
					echo '<td class="linea_deresa2 lineaabajo">'.$Labels2['descripcion'].'</td>';
				endif;
				
				if($DataService['kilos']!=''):
					echo '<td class="linea_deresa2 lineaabajo" width="6%">'.$DataService['kilos'].' (kg)</td>';
				endif;
                 
                echo '
						
						<td class="linea_deresa2 lineaabajo" width="6%"><input disabled="disabled"  readonly="readonly" style=\'height:20px;width:80px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#003\' type=\'text\' name=desde_'.$x.' value="'.$DataService['price'].'"></td>
						<td class="linea_deresa2 lineaabajo" width="6%"><input disabled="disabled"  readonly="readonly" style=\'height:20px;width:80px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#003\' type=\'text\' name=hasta_'.$x.' value="'.$DataService['total'].'" /></td>
						<td class="linea_deresa2 lineaabajo" colspan="2" width="10%"><input disabled="disabled" style=\'height:20px;width:200px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#003\' type=\'text\' name=motivo_'.$x.' value="'.$DataService['observacion'].'"></td>
						<td><input type="button" name=buttonDelRow_'.$x.' id=buttonDelRow_'.$x.' class="Estilo_Boton_X" style="background-image:url(../ad_images/b_drop.png); background-repeat:no-repeat; cursor:pointer" id="buttonDelRow" value="   " onclick="if(confirm(\''.$msg_del_aditional.'\')){ DeleteService(\''.$DataService['id'].'\')}else{return false}" />
						<!--<a href="?pag=&DelRowService=1&id='.$DataService['service'].'" onclick="if(confirm(\'Are you really sure?\')){ return true}else{return false}"><img src="../ad_images/b_drop.png" border=0 title="Delete thisr record Nº'.$x.'" /></a>--></td>
						</tr>  
				';
			}
    	}
	 	 	// AGREGAR FILAS DE MAS
			$desde		=	1;
			//if($SONTOT_FIND>0): $desde = ($SONTOT_FIND+1); $TOTALF_1 = ($TOTALF_1+($SONTOT_FIND)) ; endif;
			
			
			for($x=1;$x<$TOTALF_1+1;$x++):
			
	?>
	  <tr>
      	<td class="linea_deresa2 lineaabajo" align="center" style="color:#000">
        
        <input name="date_service_<?PHP echo $x?>" id="date_service_<?PHP echo $x?>" onchange="var x = '<?php echo $x?>';document.getElementById('cantidad_'+x).disabled=false" type="hidden" readonly style="width:100px; font-size:12px;" value="<?php echo date("Y-m-d")?>"><?php echo date("Y-m-d")?>
      <!--<img src="../ad_images/calendar.png" width="16" height="16" id="date_service_s<?PHP echo $x?>" style="cursor:pointer">-->
      <script type="text/javascript">
	  var x	=	'<?PHP echo $x?>';
    Calendar.setup({
        inputField     :    "date_service_"+x,     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "date_service_s"+x,  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script></td>
      	<td class="linea_deresa2 lineaabajo" style="color:#000"><input type="checkbox" name="optservice_<?PHP echo $x?>" id="optservice_<?PHP echo $x?>" value="service" onclick="
         javascript:
  			var x = '<?PHP echo $x?>';
            document.getElementById('optproduct_'+x).checked	 	=	false;
            document.getElementById('services_'+x).style.display 	= 	'none';
            document.getElementById('precio_'+x).value 				= 	'0.00';
            document.getElementById('total_'+x).value				= 	'0.00';
            document.getElementById('cantidad_'+x).value			= 	'1';
            document.getElementById('services2_'+x).disabled 		= 	false;
            document.getElementById('services2_'+x).style.display 	= 	'block';
            
            "/>
      	  Service 
      	    <input type="checkbox" name="optproduct_<?PHP echo $x?>" id="optproduct_<?PHP echo $x?>" value="product" onclick="
             javascript:
  			var x = '<?PHP echo $x?>';
            document.getElementById('optservice_'+x).checked=false;
            document.getElementById('services2_'+x).style.display = 'none';
            document.getElementById('precio_'+x).value 		= '0.00';
            document.getElementById('total_'+x).value		= '0.00';
             document.getElementById('cantidad_'+x).value	= 	'1';
            document.getElementById('services_'+x).disabled = false;
            document.getElementById('services_'+x).style.display = 'block';" /> 
      	    Product</td>
<td class="linea_deresa2 lineaabajo">
  <input class="three"  maxlength="5" onkeypress="
  javascript:
  var x = '<?PHP echo $x?>';
  /*if(document.getElementById('cantidad_'+x).value=='')
  	//document.getElementById('services_'+x).disabled = true;
  }else{
  */
 // if(!document.getElementById('cantidad_'+x).value==''):
  	document.getElementById('services_'+x).disabled = false;
 // endif;
  //}
  " style='height:20px;width:50px;font-size:11px; font-family:Verdana, Geneva, sans-serif' type='text' name='cantidad_<?PHP echo $x?>' value="" id="cantidad_<?PHP echo $x?>" />
</td>
        <td width="28%" class="linea_deresa2 lineaabajo">
        <!--<input type="text" name="services_<?PHP echo $x?>" disabled="disabled" autocomplete=off id="services_<?PHP echo $x?>" style="width:300px; border:0px; height:16px; font-size:12px" />-->
        
<!-- PRODUCTS -->

        <select name="services_<?PHP echo $x?>" disabled="disabled" id="services_<?PHP echo $x?>" style="width:300px; height:20px; font-size:10px; display:"  onchange="var exis = '<?PHP echo $x?>'; mostrarInfo(this.value,exis);// realizaProceso($('#services_'+exis,exis).val());return false;">
        <option value="">-select-</option>
		<?PHP
        	$search_1	=	mysql_query('Select * From ad_iman_inventario Where activo=1 AND id_empresa="'.$DataUserCia.'"');
			if(mysql_num_rows($search_1)>0):
				while($Data_=mysql_fetch_array($search_1)):
					if(isset($DataService['value']) && $DataService['id']==$Data_['id'] && $Data_['id']==$_POST['services_'.$x]):
						echo '<option value="'.$Data_['id'].'" selected="selected">[ '.$Data_['descripcion'].' ]</option>';
					;else:
						echo '<option value="'.$Data_['id'].'">[ '.$Data_['descripcion'].' ]</option>';
					endif;
				endwhile;
			endif;
		?>
        </select>
        
  <!-- SERVICES -->

        <select name="services2_<?PHP echo $x?>" disabled="disabled" style="width:300px; height:20px; font-size:10px; display:none" id="services2_<?PHP echo $x?>" onchange="var exiss = '<?PHP echo $x?>'; mostrarInfo2(this.value,exiss); if(this.value=='8'){ document.getElementById('quilos_'+exiss).style.display='block'}">
        <option value="">-select-</option>
		<?PHP
        	$search_2	=	mysql_query('Select * From ad_tipo_servicio Where activo=1 AND id_empresa="'.$DataUserCia.'"');
			if(mysql_num_rows($search_2)>0):
				while($Data2_=mysql_fetch_array($search_2)):
					if(isset($DataService['value']) && $DataService['id']==$Data2_['id'] && $Data2_['id']==$_POST['services2_'.$x]):
						echo '<option value="'.$Data2_['idTS'].'" selected="selected">[ '.$Data2_['name'].' ]</option>';
					;else:
						echo '<option value="'.$Data2_['idTS'].'">[ '.$Data2_['name'].' ]</option>';
					endif;
				endwhile;
			endif;
		?>
        </select>
        </td>
        <td width="5%" class="linea_deresa2 lineaabajo">&nbsp;
        <input type="text" name="quilos_<?PHP echo $x?>" id="quilos_<?PHP echo $x?>" class="three" style="height:20px;width:50px;font-size:11px; font-family:Verdana, Geneva, sans-serif;display:none; width:50px" onchange="var ex = '<?PHP echo $x?>';MultKilos(this.vale,ex);"/>
        </td>
        <td class="linea_deresa2 lineaabajo"><input class="three"  maxlength="5" style='height:20px;width:50px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif' type='text' name='precio_<?PHP echo $x?>' value="" id="precio_<?PHP echo $x?>" /></td>
        <td class="linea_deresa2 lineaabajo"><input class="three" readonly="readonly" maxlength="6" style='height:20px;width:50px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif' type='text' name='total_<?PHP echo $x?>' value="" id="total_<?PHP echo $x?>"></td>
        <td class="linea_deresa2 lineaabajo"><input class="three" maxlength="50" style='height:20px;width:150px;border:none;font-size:11px; font-family:Verdana, Geneva, sans-serif' type='text' name='observacion_<?PHP echo $x?>' value="" id="observacion_<?PHP echo $x?>" /></td>
        </tr>  
			<?php endfor;?>
</table>

     
    <?PHP endif;?>
    </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td width="262">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td bgcolor="#C9C9C9">&nbsp;</td>
    <td colspan="3" bgcolor="#C9C9C9">Rooms: 
      <!--<input type="text" name="rooms" id="rooms"  class="bordered bordeTodalaTabla_2" style="width:100px;font-size:12px" value="<?PHP if(isset($DataArr['rooms'])): echo $DataArr['rooms']; elseif(isset($_POST)): echo $POST_habit; endif;?>" /> -->
      <select name="rooms" id="rooms" readonly style="width:150px; font-size:11px; font-family:Verdana, Geneva, sans-serif" <?PHP if(isset($GET_opcion) && isset($DataArr['rooms'])):?> onchange="if(confirm('<?=$msg_change_rooms?>')){return true}else{return false}"<?PHP endif;?>>
      <option value="">-select-</option>
      <?PHP
      	if(mysql_num_rows($SQL_Rooms)>0):
			while($DataR	=	mysql_fetch_array($SQL_Rooms)):
					if((isset($GET_opcion) && $DataArr['rooms']==$DataR['codigo']) || ($POST_habit==$DataR['codigo'])):
						echo '<option value="'.$DataR['codigo'].'" selected="selected">'.$DataR['codigo'].'</option>';
					;else:
						echo '<option value="'.$DataR['codigo'].'">'.$DataR['codigo'].'</option>';
					endif;
			endwhile;
		endif;
	  ?>
      </select>
      Bed:
      <?php //$TotalCamas	=	mysql_fetch_array(mysql_query('Select * ad_habitaciones Where codigo="'.$DataArr['rooms'].'"'));?>
      
      <input type="text" name="bed" id="bed"   class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['cama'])): echo $DataArr['cama'];elseif($_POST):echo $POST_cama; elseif($POST_bed): echo $POST_bed; endif;?>" /> 
      Price:
      <input type="text" name="price" id="price"  class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP echo $RoomsDetail['price'];?>" /> 
      Discount: 
      <input type="text" name="discounts" id="discounts"  class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['discounts'])): echo $DataArr['discounts'];elseif(isset($_POST)):echo $POST_discounts;endif;?>" /> 
      
      <input type="hidden" name="habitacion" id="habitacion" value="<?PHP echo $POST_habit?>" />
      <input type="hidden" name="cama" id="cama" value="<?PHP echo $POST_bed?>" />
      (Change bed or room)
      <input type="hidden" name="opcion" id="opcion" value="<?PHP echo $POST_opcion?>" />
      <input type="hidden" name="idReg" id="idReg" value="<?PHP echo $DataArr['id']?>" /></td>
      <td bgcolor="#C9C9C9" style="font-size:14px;">&nbsp;</td>
      <td bgcolor="#C9C9C9">&nbsp;</td>
    </tr>
    <?PHP if($GET_opcion==true):?>
    <tr>
    <td bgcolor="#C9C9C9">&nbsp;</td>
    <td colspan="3" bgcolor="#C9C9C9" align="center"></td>
    <td bgcolor="#C9C9C9" style="font-size:14px;"></td>
    <td bgcolor="#C9C9C9" style="font-size:14px" width="130">
    <strong >
      <?PHP 	
		// Calculate total a cobrar
		// ************************
		$VALORServ	=	false;
		$SumarServ	=	'00.00';
		$r		=	0;
		//   order by id ASC LIMIT '.$TOTDAYSNIGHT.'
		$SL		=	mysql_query('Select * From ad_reservas_services where id_tbl_reservas="'.$GET_idFile.'" and id_empresa="'.$DataUserCia.'" AND activo = 1');
		//echo mysql_num_rows($SL);
	   while($HowMuchServ=mysql_fetch_array($SL)):
			$r++;
			$SumarServ+=	sprintf("%01.2f",$HowMuchServ['total']);

		endwhile;
		
		
	?>
    </strong></td>
    </tr>
    <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7" >
    Payments: 
      <br />
      <select name="payments_method" id="payments_method" style="width:220px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
        <option value="">-select.</option>
        <option value="C" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='D'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='D'): echo 'selected'; endif;?>>Cash</option>
        <option value="V" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='P'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='P'): echo 'selected'; endif;?>>Visa</option>
        <option value="O" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='P'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='P'): echo 'selected'; endif;?>>Others</option>
        </select>
	</td>

    <td colspan="2" bgcolor="#F7F7F7">Bookers/Agencias
	<br />
			<select name="bookers" id="bookers" style="width:220px; font-size:12px;font-family:Verdana, Geneva, sans-serif">
		     <option value="">-select-</option>
			 <?PHP
		    	if(mysql_num_rows($SQL_Bookers)>0)
				{
					while($Datas=mysql_fetch_array($SQL_Bookers))
					{	
						if((isset($_POST) && $_POST['bookers']==$Datas['id']) || (isset($DataArr['booker']) && $DataArr['booker']==$Datas['id'])):
							echo '<option value="'.$Datas['id'].'" selected="selected">'.$Datas['porcentaje'].'% - '.$Datas['name'].'</option>';
						;else:
							echo '<option value="'.$Datas['id'].'">'.$Datas['porcentaje'].'% - '.$Datas['name'].'</option>';
						endif;
					}
				}
			?>
		    </select> 
		    &nbsp;(<?PHP echo CurrencyActual($DataUserCia).' '.$DataArr['bookers_porcent']?>)
    </td>
    <td bgcolor="#C9C9C9" class=" linea_abajo" style="font-size:14px"><strong>For (<?PHP echo $TOTDAYSNIGHT?>) nights<br />
    Bookers:
    <br>
    Discounts: 
    <br>
    Aditionals services:</strong>
    </td>
    <td bgcolor="#C9C9C9" class=" linea_abajo" style="font-size:14px"><strong >
      <?PHP 
      	// Step - 1	
		// Calculate total a cobrar
		// ************************
		$VALOR	=	false;
		$Sumar	=	false;
		$r		=	0;

		if($DataWorkAss=='rooms'):
			$SL 	=	mysql_query('Select price,total_dias From '.$TblBooking.' where id="'.$GET_idFile.'" AND activo =1');
			$HowMuch=@mysql_fetch_array($SL);
			$VALOR  = sprintf("%01.2f",($HowMuch['price']*$HowMuch['total_dias']));
			$Sumar  = $VALOR;
		else:
			$SL		=	mysql_query('Select price From '.$TblRDays.' where id_tbl_reservas="'.$GET_idFile.'"  order by day ASC LIMIT '.$TOTDAYSNIGHT.'');
			while($HowMuch=@mysql_fetch_array($SL)):
				$r++;
				$VALOR[]	+=	sprintf("%01.2f",$HowMuch['price']);
				
				//$Sumar	+=	($Sumar+$VALOR[$r]);
			endwhile;

			// Sumar todos los precios de los dias
			// ***********************************
			for($i=0;$i<$TOTDAYSNIGHT;$i++):
				@$Sumar	=	 ($Sumar+$VALOR[$i]);
			endfor;

			// ***************
			//  NUEVO CODIGO *
			// ***************
			$SELE		=	mysql_query('Select * FRom '.$TblBooking.' Where id="'.$GET_idFile.'"');
			$HowMuch2	=	mysql_fetch_array($SELE);
			$Sumar		=	($HowMuch2['total_price']);
			// ***************
			//  END NEW CODE *
			// ***************

		endif;

		if($DataArr['bookers_porcent']==''):$DataArr['bookers_porcent']='0.00';endif;
		// Aplicar Descuento si es que tiene
		// *********************************
		$TOTPAY		=	($Sumar-($DataArr['discounts']+$DataArr['bookers_porcent']));
		// Descuentos
		
		echo '<font size="3" color="#000">'.CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",$Sumar).' </font><font size="3" color="#FF0000"><br>'.CurrencyActual($DataUserCia).'. ('.$DataArr['bookers_porcent'].') <br>'.CurrencyActual($DataUserCia).'. ('.$DataArr['discounts'].')</font>';
		echo '<font size="3" color="#000"><br>'.CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",$SumarServ).'</font>';
	?>
      <input type="hidden" name="total_noches" id="total_noches" value="<?php echo $Sumar?>" />
    </strong></td>
    </tr>
    <tr>
    <td bgcolor="#F7F7F7"></td>
    <td bgcolor="#F7F7F7">
    
    Where are you coming from:      
    <br />
	<input type="text" name="where_from" id="where_from" class="bordered bordeTodalaTabla_2" style="width:200px;font-size:12px" value="<?PHP if(isset($DataArr['where_coming_from'])): echo $DataArr['where_coming_from']; elseif(isset($_POST)): echo $POST_where_from; endif;?>">
    </td>
    <td colspan="2" bgcolor="#F7F7F7">
    
    Gender
    	<?PHP
    	if(isset($DataArr['woman']) && strlen($DataArr['woman'])==1): $DataArr['woman']='0'.$DataArr['woman']; endif;
		if(isset($DataArr['man']) && strlen($DataArr['man'])==1): $DataArr['man']='0'.$DataArr['man']; endif;
		?>
		<br />
	F
      <input type="text" name="gender_f" id="gender_f" class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['woman'])): echo $DataArr['woman']; elseif(isset($_POST)):echo $POST_gender_f; endif;?>" />
    M
      <input type="text" name="gender_m" id="gender_m" class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['man'])): echo $DataArr['man']; elseif(isset($_POST)):echo $POST_gender_m;endif;?>" />      
      &nbsp;<span style=" font-size:10px; color:#F00">[Only number]</span>
    </td>

    <td bgcolor="#C9C9C9" style="font-size:14px"><strong >Total</strong></td>
    <td bgcolor="#C9C9C9" style="font-size:14px"><strong ><?PHP echo '<font size="3" color="#000">'.CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",($TOTPAY+$SumarServ)).'</font>';?>
      <input type="hidden" name="total_a_pagar" id="total_a_pagar" value="<?PHP echo sprintf("%01.2f",($TOTPAY+$SumarServ))?>" />
    </strong></td>
    </tr>
    <?PHP endif;?>
   <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">
    First Name
    <br />
    <input type="text" name="first_name" id="first_name" class="bordeTodalaTabla_3" style="width:200px;font-size:12px" value="<?PHP if(isset($DataArr['first_name'])): echo $DataArr['first_name']; elseif(isset($_POST)):echo $POST_first_name;endif;?>">
    </td>
    <td colspan="2" bgcolor="#F7F7F7">
    Last Name
    <br />
<input type="text" name="last_name" id="last_name" class="bordeTodalaTabla_3" style="width:200px;font-size:12px" value="<?PHP if(isset($DataArr['last_name'])): echo $DataArr['last_name'];elseif($_POST):echo $POST_last_name;endif;?>">
    </td>
    <td colspan="2" bgcolor="#F7F7F7">&nbsp;
    </td>
    </tr>
   <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">
    Date of Birth
    <br />
    <input type="text" name="date_birth" id="date_birth" readonly class="bordeTodalaTabla_3" style="width:100px; font-size:12px" value="<?PHP if(isset($DataArr['date_birth'])): echo $DataArr['date_birth']; elseif(isset($_POST)):echo $POST_date_birth;endif;?>" >
    <img src="../ad_images/calendar.png" width="16" height="16" id="datebirth" style="cursor:pointer">
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "date_birth",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "datebirth",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script>  
    </td>
    <td colspan="3" bgcolor="#F7F7F7">
    Type Document
    <br />
    <select name="type_doc" id="type_doc" style="width:220px; font-size:12px;font-family:Verdana, Geneva, sans-serif">
    <option value="">-select.</option>
    <option value="D" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='D'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='D'): echo 'selected'; endif;?>>DNI</option>
    <option value="P" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='P'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='P'): echo 'selected'; endif;?>>Passport</option>
    </select> &nbsp;Number Doc.<input type="text" name="number_doc" id="number_doc" class="bordeTodalaTabla_3" style="width:100px; font-size:12px" value="<?PHP if(isset($DataArr['number_doc'])): echo $DataArr['number_doc']; elseif(isset($_POST)): echo $POST_numberdoc; endif;?>" maxlength="25" />
    </td>
	
<!-- SECTION DETAIL PAYMENTS -->
    <td bgcolor="#F7F7F7">&nbsp;
      </td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">
    Country
    <br />
    <select id="country" name="country" style="width:220px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
      <option value="">-select-</option>
      <?PHP
    	if(mysql_num_rows($SQL_Country)>0)
		{
			while($Datas=mysql_fetch_array($SQL_Country))
			{
				if((isset($_POST) && $_POST['country']==$Datas['id']) || (isset($DataArr['country']) && $DataArr['country']==$Datas['id'])):
					echo '<option value="'.$Datas['id'].'" selected="selected">'.$Datas['pais'].'</option>';
				;else:
					echo '<option value="'.$Datas['id'].'">'.$Datas['pais'].'</option>';
				endif;
			}
		}
	?>
    </select>
    </td>
    <td colspan="2" bgcolor="#F7F7F7">
    Heare about us
    <br />
    <select id="hear_about" name="hear_about" style="width:220px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
      <option value="">-select-</option>
      <?PHP
    	if(mysql_num_rows($SQL_HearAbout)>0)
		{
			while($DatasH=mysql_fetch_array($SQL_HearAbout))
			{
				if((isset($_POST) && $_POST['hear_about']==$DatasH['id']) || (isset($DataArr['hear_about']) && $DataArr['hear_about']==$DatasH['id'])):
					echo '<option value="'.$DatasH['id'].'" selected="selected">'.$DatasH['name'].'</option>';
				;else:
					echo '<option value="'.$DatasH['id'].'">'.$DatasH['name'].'</option>';
				endif;
			}
		}
	?>
    </select>
    </td>
    <td colspan="2" bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td colspan="2" bgcolor="#F7F7F7"></td>
    <td bgcolor="#F7F7F7" >Observations</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td width="314" bgcolor="#F7F7F7">
    Email
    <br />
    <input type="text" name="mail" id="mail" class="bordeTodalaTabla_3" style="width:220px;font-size:12px" value="<?PHP if(isset($DataArr['email'])): echo $DataArr['email']; elseif($_POST): echo $POST_mail; endif;?>"></td>
    <td colspan="2" bgcolor="#F7F7F7">
   	Nationality
   	<br />
   	<select id="nationality" name="nationality" style="width:220px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
        <option value="">-select-</option>
        <?PHP
    	if(mysql_num_rows($SQL_National)>0)
		{
			while($Datas=mysql_fetch_array($SQL_National))
			{
				if((isset($_POST) && $_POST['nationality']==$Datas['id']) || (isset($DataArr['nationality']) && $DataArr['nationality']==$Datas['id'])):
					echo '<option value="'.$Datas['id'].'" selected>'.Reemplazar_letras($Datas['nacionalidad']).'</option>';
				;else:
					echo '<option value="'.$Datas['id'].'">'.Reemplazar_letras($Datas['nacionalidad']).'</option>';
				endif;
			}
		}
	?>
        </select>
    </td>
    
    <td rowspan="4" bgcolor="#F7F7F7"><textarea name="observation" id="observation" class="bordered" cols="25" rows="7" style="font-size:10px; width:320px"><?PHP echo isset($DataArr['observation'])?$DataArr['observation']:$POST_observation?></textarea></td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">
    Total Persons
    <br />
    <input type="text" name="tot_persons" id="tot_persons" class="bordeTodalaTabla_3" style="width:50px;font-size:12px" onkeypress="return permite(event, 'num')" title="Ingrese dos digitos, Ej. 01, 02, 10.." value="<?PHP if(isset($DataArr['total_persons'])): echo $DataArr['total_persons'];elseif(isset($_POST)):echo $POST_totpersons;endif;?>">
      <span style=" font-size:10px; color:#F00">[Ejemp. 01,02,10...]</span></td>
    <td colspan="2" bgcolor="#F7F7F7">
    Destination
    <br />
    <input type="text" name="destination" id="destination" class="bordeTodalaTabla_3" style="width:220px;font-size:12px" value="<?PHP if(isset($DataArr['destination'])): echo $DataArr['destination']; elseif(isset($_POST)):echo $POST_destination;endif;?>"></td>
    <td bgcolor="#F7F7F7">&nbsp;    </td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td width="186" bgcolor="#F7F7F7">&nbsp;</td>
    <td width="162" bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7"></td>
 
    <td colspan="2" bgcolor="#F7F7F7"></td>
    <td bgcolor="#F7F7F7">&nbsp; </td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <!--<td>-->
    <?PHP
    	// ***********************************************
		// Verify if this guest change from room or bed  *
		// ***********************************************
		/*
		$sql_s	=	mysql_query('Select * from ad_reservas_copy Where rooms="'.$_POST['rooms'].'" and cama="'.$_POST['bed'].'" and activo="1"');
		
		if(mysql_num_rows($sql_s)>0):
			echo '<fot color=red face=Verdana >'.mysql_num_rows($sql_s).'Notificaciones</font>';
		;else:
			echo '&nbsp;';
		endif;
		*/
	?>
   <!-- </td>-->
    <td colspan="3" align="center">
     <?PHP if($GET_opcion && $_GET['color']!='red' && $GET_color!='white'):?>
     <!-- onclick="javascript:imprSelec('factura')"  -->
     <script type="text/javascript" src="../ad_tools/thickbox/thickbox/jquery.js"></script>
	 <script type="text/javascript" src="../ad_tools/thickbox/thickbox/thickbox.js"></script>
	 <link rel="stylesheet" href="../ad_tools/thickbox/thickbox/thickbox.css" type="text/css" media="screen" />

     <input type="button" name="button" id="button" title="Print Invoice" class="Estilo_Botones_X bordered" value="Print Invoice" style="width:200px;height:30px; cursor:pointer;background-color:#CCC; border-color:#000; background-image:url(../ad_images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="tb_show('Factura','ad_TemplateCreateInvoiceTCPDF.php?random=<?=$Random?>&id_usuario=<?=$DataIdUsuario?>&num_fact=<?=$NumFact?>&tbl=<?=$TblBooking?>&id_file=<?=$GET_idFile?>&id_empresa=<?=$DataUserCia?>&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=500&width=900')" />
     <input type="submit" name="buttonCheckOut" title="Check-Out" class="Estilo_Botones_X bordered" id="buttonCheckOut" value="Check Out" style="width:200px;height:30px;background-color:#FF0;border-color:#000; cursor:pointer; background-image:url(../ad_images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="
     if(confirm('Are You sure to check out the guest?'))
     {
     	return true;
     }else
     {
     	return false;
     }
     " />
     <?PHP endif;?>
      &nbsp;&nbsp;<?PHP if(!$GET_opcion || $GET_color=='red'):// && $GET_color=='red'):?>
	  <!--
      <input type="submit" name="buttonCheckInn" class="Estilo_Botones_X bordered" id="buttonCheckInn" value="Check In" style="width:100px; cursor:pointer" onclick="
     
     if(RevisarElCorreo('mail')==false)
        {
        	return false;	
        }
        
        //   OTHERS DATA
        // ****************
        if(document.getElementById('where_from').value=='' || document.getElementById('destination').value=='' || document.getElementById('first_name').value=='' || document.getElementById('last_name').value=='' || document.getElementById('nationality').value=='' || document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='' || document.getElementById('country').value==''   || document.getElementById('type_doc').value=='' || document.getElementById('number_doc').value=='')
        {
        	//document.getElementById('where_from').style.border 		=	'1px solid red'; //#BDB737
            //document.getElementById('destination').style.border 		=	'1px solid red';
            //document.getElementById('first_name').style.border 		=	'1px solid red';
            //document.getElementById('last_name').style.border 		=	'1px solid red';
            //document.getElementById('nationality').style.border 		=	'1px solid red';
            //document.getElementById('f_date_a').style.border 			=	'1px solid red';
            //document.getElementById('f_date_b').style.border 			=	'1px solid red';
            //document.getElementById('where_from').style.border 		=	'1px solid red';
			//document.getElementById('where_from').style.borderColor	=	'red';
			//document.getElementById('where_from').focus();
            document.getElementById('mensajes').innerHTML			=	'<h2>ALL FIELDS ARE REQUIRED</h2>';
            return false;
        }
        
        // Review Gender
        // **************
        if(document.getElementById('gender_f').value=='' && document.getElementById('gender_m').value=='')
        {
        	document.getElementById('mensajes').innerHTML			=	'Please Select: Gender [F] or [M]';
            document.getElementById('gender_f').style.border 		=	'1px solid red';
            document.getElementById('gender_m').style.border 		=	'1px solid red';
            return false;
        }
        
        // Revisar Fechas
        // **************
        if(fechaPosterior()==false)
        {
        	return false;
        }
     
         if(confirm('Are You sure to Check In the guest?'))
         {
            return true;
         }else
         {
            return false;
         }
     " />
     -->
     &nbsp;
      <input type="submit" name="buttonCheckInnPay" class="Estilo_Botones_X bordered" id="buttonCheckInnPay" value="Check In" style="width:200px;height:30px; cursor:pointer;background-color:#FF0; background-image:url(../ad_images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="
    
    if(RevisarElCorreo('mail')==false)
        {
        	return false;	
        }
        
        if(document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='')
        {
        	document.getElementById('f_date_a').style.border 			=	'1px solid red';
            document.getElementById('f_date_b').style.border 			=	'1px solid red';	
        	return false;
        }
        //   OTHERS DATA
        // ****************
        if(document.getElementById('where_from').value=='' || document.getElementById('destination').value=='' || document.getElementById('first_name').value=='' || document.getElementById('last_name').value=='' || document.getElementById('nationality').value=='' || document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='' || document.getElementById('country').value==''   || document.getElementById('type_doc').value=='' || document.getElementById('number_doc').value=='')
        {
        	//document.getElementById('where_from').style.border 		=	'1px solid red'; //#BDB737
            //document.getElementById('destination').style.border 		=	'1px solid red';
            //document.getElementById('first_name').style.border 		=	'1px solid red';
            //document.getElementById('last_name').style.border 		=	'1px solid red';
            //document.getElementById('nationality').style.border 		=	'1px solid red';
            //document.getElementById('f_date_a').style.border 			=	'1px solid red';
            //document.getElementById('f_date_b').style.border 			=	'1px solid red';
            //document.getElementById('where_from').style.border 		=	'1px solid red';
			//document.getElementById('where_from').style.borderColor	=	'red';
			//document.getElementById('where_from').focus();
            document.getElementById('mensajes').innerHTML			=	'<h2>ALL FIELDS ARE REQUIRED</h2>';
            return false;
        }
        
        // Review Gender
        // **************
        if(document.getElementById('gender_f').value=='' && document.getElementById('gender_m').value=='')
        {
        	document.getElementById('mensajes').innerHTML			=	'Please Select: Gender [F] or [M]';
            document.getElementById('gender_f').style.border 		=	'1px solid red';
            document.getElementById('gender_m').style.border 		=	'1px solid red';
            return false;
        }
        
        // Revisar Fechas
        // **************
        if(fechaPosterior()==false)
        {
        	return false;
        }
    
     if(confirm('Confirm The guest would Check In?'))// and set status: Ready Pay.'))
     {
     	return true;
     }else
     {
     	return false;
     }
     " />
	 
	 <?PHP endif; ?></td>
    <td colspan="2" bgcolor="">
      <select id="status" name="status" style="width:100px; font-size:11px; font-family:Verdana, Geneva, sans-serif; visibility:hidden">
        <option value="">-select</option>
        <?PHP
		
    	if(mysql_num_rows($SQL_Status)>0)
		{
			while($Datas=mysql_fetch_array($SQL_Status))
			{
				if((isset($DataArr['paso']) && $DataArr['paso']==$Datas['id'])||($POST_status==$Datas['id'])||(isset($DataExists['paso']) && $DataExists['paso']==$Datas['id'])):
					echo '<option value="'.$Datas['id'].'" style="background-color:'.$Datas['name'].'; color:#000" selected="selected">'.$Datas['name'].'</option>';
				;else:
					echo '<option value="'.$Datas['id'].'" style="background-color:'.$Datas['name'].'; color:#000">'.$Datas['name'].'</option>';
				endif;
			}
		}
	?>
    	<!--<option value="0">Cancel</option>-->
        </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?PHP if($POST_opcion==false && $GET_opcion==false):?>
      <?php 
	  //echo $GET_uregistra;
	  //if($GET_uregistra=='1' || $GET_uregistra=='2'):
	  ?>
      <input type="submit" name="buttonSave" class="bordered" id="buttonSave" value="  Save Reservation " style="cursor:pointer; background-color:#F00; color:#FFF; background-image:url(../ad_images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="javascript:
    	if(RevisarElCorreo('mail')==false)
        {
        	return false;	
        }
        
        //   OTHERS DATA
        // ****************
        //  || document.getElementById('status').value==''
        if(document.getElementById('where_from').value=='' || document.getElementById('destination').value=='' || document.getElementById('first_name').value=='' || document.getElementById('last_name').value=='' || document.getElementById('nationality').value=='' || document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='' || document.getElementById('country').value==''  || document.getElementById('type_doc').value=='' || document.getElementById('number_doc').value=='')
        {
        	//document.getElementById('where_from').style.border 		=	'1px solid red'; //#BDB737
            //document.getElementById('destination').style.border 		=	'1px solid red';
            //document.getElementById('first_name').style.border 		=	'1px solid red';
            //document.getElementById('last_name').style.border 		=	'1px solid red';
            //document.getElementById('nationality').style.border 		=	'1px solid red';
            //document.getElementById('f_date_a').style.border 			=	'1px solid red';
            //document.getElementById('f_date_b').style.border 			=	'1px solid red';
            //document.getElementById('where_from').style.border 		=	'1px solid red';
			//document.getElementById('where_from').style.borderColor	=	'red';
			//document.getElementById('where_from').focus();
            document.getElementById('mensajes').innerHTML			=	'<h2>ALL FIELDS ARE REQUIRED</h2>';
            return false;
        }
        
        // Review Gender
        // **************
        if(document.getElementById('gender_f').value=='' && document.getElementById('gender_m').value=='')
        {
        	document.getElementById('mensajes').innerHTML			=	'Please Select: Gender [F] or [M]';
            document.getElementById('gender_f').style.border 		=	'1px solid red';
            document.getElementById('gender_m').style.border 		=	'1px solid red';
            return false;
        }
        
        // Revisar Fechas
        // **************
        if(fechaPosterior()==false)
        {
        	return false;
        }
        
    " /> 
    &nbsp;&nbsp;
     <?php //;else:?>
     <!--<input type="submit" name="buttonSave" class="bordered" id="buttonSave" value=" Save Data " style="cursor:pointer" onclick="alert('Only in full version'); return false" />-->
      
    <?php //endif;?>
      <?PHP ;elseif($GET_color!='white'):?>
      <input type="submit" name="buttonModify" title="Modify Data" class=" bordeTodalaTabla_3" id="buttonModify" value="    Modify Data " style="width:200px;height:30px;cursor:pointer;border-color:#000;background-image:url(../ad_images/arrow_collapsed.gif); background-repeat:no-repeat; background-position:left;" onclick="javascript:
    	if(RevisarElCorreo('mail')==false)
        {
        	return false;	
        }


        if(confirm('<?=$msg_save_data?>'))
		{

	        //   OTHERS DATA
	        // ****************
	        if(document.getElementById('where_from').value=='' || document.getElementById('destination').value=='' || document.getElementById('first_name').value=='' || document.getElementById('last_name').value=='' || document.getElementById('nationality').value=='' || document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='' || document.getElementById('country').value==''  || document.getElementById('status').value=='' || document.getElementById('type_doc').value=='' || document.getElementById('number_doc').value=='')
	        {
	        	//document.getElementById('where_from').style.border 		=	'1px solid red'; //#BDB737
	            //document.getElementById('destination').style.border 		=	'1px solid red';
	            //document.getElementById('first_name').style.border 		=	'1px solid red';
	            //document.getElementById('last_name').style.border 		=	'1px solid red';
	            //document.getElementById('nationality').style.border 		=	'1px solid red';
	            //document.getElementById('f_date_a').style.border 			=	'1px solid red';
	            //document.getElementById('f_date_b').style.border 			=	'1px solid red';
	            //document.getElementById('where_from').style.border 		=	'1px solid red';
				//document.getElementById('where_from').style.borderColor	=	'red';
				//document.getElementById('where_from').focus();
	            document.getElementById('mensajes').innerHTML			=	'<h3>ALL FIELDS ARE REQUIRED</h3>';
	            return false;
	        }
	        
	        // Review Gender
	        // **************
	        if(document.getElementById('gender_f').value=='' && document.getElementById('gender_m').value=='')
	        {
	        	document.getElementById('mensajes').innerHTML			=	'Please Select: Gender [F] or [M]';
	            document.getElementById('gender_f').style.border 		=	'1px solid red';
	            document.getElementById('gender_m').style.border 		=	'1px solid red';
	            return false;
	        }
	        
	        // Revisar Fechas
	        // **************
	        if(fechaPosterior()==false)
	        {
	        	return false;
	        }
	    }
	    else
	    {
	    	return false;
	    }
    " />
      <?PHP endif;?>
      <!--<input type="submit" name="buttonClose" id="buttonClose" value="Close" class="bordered" style="cursor:pointer" />--></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
</form>


<!-- 
*********************
* INVOICE - FACTURA *
*********************
-->

<?PHP if($GET_color=='yellow'):?>


<!-- <label onclick="javascript:imprSelec('factura')" style="cursor:pointer; font-size:12px"><img src="../ad_images/print.gif" /> Imprimir</label>-->

<div id="factura" style=" display:none">

  <table width="100%" border="1" cellpadding="0" cellspacing="0" class="" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
    <tr>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="50%" valign="top">
      <table width="90%" style="margin-left:10px" class="bordeTodalaTabla_3" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25px" style=" font-size:16px">&nbsp;<strong><?PHP echo strtoupper($DataEmpresa['name_cia'])?></strong></td>
          </tr>
        <tr>
          <td height="25px">&nbsp;<?PHP echo 'Date: '. date('d - M - Y');?></td>
          </tr>
        <tr>
          <td height="25px">&nbsp;<?PHP echo 'Direction: '. $DataEmpresa['direccion'];?></td>
        </tr>
        <tr>
          <td height="25px">&nbsp;<?PHP echo 'Telephone: '. $DataEmpresa['telefono'];?></td>
        </tr>
        <tr>
          <td height="25px">&nbsp;<?PHP echo 'Email: '. $DataEmpresa['email'];?></td>
        </tr>
      </table></td>
      <td width="50%" valign="top"><table width="95%" class="bordeTodalaTabla_3" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25px" width="33%" style=" font-size:16px">&nbsp;<strong>RUC</strong></td>
          <td height="25px" width="67%">&nbsp;<?PHP echo $DataEmpresa['ruc']?></td>
          </tr>
        <tr>
          <td style=" font-size:16px">&nbsp;<strong>INVOICE</strong></td>
          <td>&nbsp;<?PHP echo $NumFact;?></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="80" colspan="2"><table width="97%" style="margin-left:10px" class="bordeTodalaTabla_3" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="43%" height="25px">&nbsp;CUSTOMER NAME: <?PHP echo strtoupper($DataArr['first_name'].' '.$DataArr['last_name'])?></td>
          <td width="57%">COUNTRY: <?PHP 
		  $Pais	=	mysql_query('Select * From ad_pais Where id="'.$DataArr['country'].'"'); if(mysql_num_rows($Pais)>0): $DtaPais=mysql_fetch_array($Pais); echo strtoupper($DtaPais['pais']);endif;?></td>
          </tr>
        <tr>
          <td height="40">&nbsp;DOCUMENT N&deg;: <?PHP echo strtoupper($DataArr['number_doc']);?></td>
          <td height="40">EMAIL: <?PHP echo strtoupper($DataArr['email']);?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2">
      <table width="97%" style="margin-left:10px" border="0" cellpadding="0" cellspacing="0" class="bordeTodalaTabla_3">
        <tr>
          <td colspan="3" align="left" bgcolor="#E8E8E8">&nbsp;&nbsp;&nbsp;DETAILS</td>
          </tr>
        <tr>
          <td width="2%">&nbsp;</td>
          <td width="96%">&nbsp;</td>
          <td width="2%" class="lineaderesa">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp; For the sale of ( <?PHP echo $TOTDAYSNIGHT?> ) nights accommodation. From <?PHP echo $DataArr['fecha_e'] .'&nbsp; until &nbsp;'. $DataArr['fecha_s']?></td>
          <td>&nbsp;</td>
        </tr>
        
        <?PHP
			echo '<br /><br />';
			$Sele	=	mysql_query('Select * From ad_reservas_services Where id_guest="'.$GET_idFile.'" and activo=1 and id_empresa="'.$DataUserCia.'"');
			if(mysql_num_rows($Sele)>0):
				
				$GRANTOT	=	false;
				
        		while($DataFact=mysql_fetch_array($Sele)):
		?>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp; 
		  <?php 
		  	
			echo '<font size="2">'.$DataFact['date']. ' - ';
			
			if($DataFact['type']=='service'): 
				$Labels1	=	mysql_fetch_array(mysql_query('Select * From ad_tipo_servicio Where activo=1  and idTS="'.$DataFact['service'].'"'));//and id_empresa="'.$GET_uregistra.'"
				echo $Labels1['name'].' ';

			;elseif($DataFact['type']=='product'):
				$Labels2	=	mysql_fetch_array(mysql_query('Select * From ad_iman_inventario Where activo=1 and id="'.$DataFact['service'].'"'));//id_empresa="'.$GET_uregistra.'" and 
				echo $Labels2['descripcion'].' ';
			endif;
				
			if($DataFact['kilos']!=''):
				echo $DataFact['kilos'].' (kg)';
			endif;
			
			echo ' - cantidad: '.$DataFact['cantidad'];
			
			//echo ' - Price: '.$DataFact['price'];
			
			echo ' - sub-total: '.sprintf("%01.2f",$DataFact['total']).'</font>';
			
			$GRANTOT	+=	sprintf("%01.2f",$DataFact['total']);
			
		  ?></td>
          <td>&nbsp;</td>
        </tr>
        <?PHP
        		endwhile;
				
				if(isset($GRANTOT)): echo '<p /><td colspan="3" align=""><font size="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total services: '.sprintf("%01.2f",$GRANTOT).'</font></td>'; endif;
			endif;
		?>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      &nbsp;
      <table width="97%" border="0" cellpadding="0" cellspacing="0" style="margin-left:10px" class="bordeTodalaTabla_3">
        <tr>
          <td width="86%" height="30" align="right" class="line_deresa_gris">Sub Total&nbsp;</td>
          <td width="14%" align="right">&nbsp;<?PHP echo CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",$Sumar);?>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="right" class="line_deresa_gris">Total Services&nbsp;</td>
          <td align="right">&nbsp;<?PHP echo CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",$SumarServ)?>&nbsp;&nbsp;</td>
        </tr>
        <!--
        <tr>
          <td align="right" height="30" class="line_deresa_gris">Others &nbsp;</td>
          <td align="right">&nbsp;<?PHP echo CurrencyActual($DataUserCia).'. (-'.$DataArr['discounts'].')';?>&nbsp;&nbsp;</td>
        </tr>
        -->
        <tr>
          <td height="30" align="right" class="line_deresa_gris">Discounts&nbsp;</td>
          <td align="right" class="linea_abajo_gris">&nbsp;<?PHP echo CurrencyActual($DataUserCia).'. (-'.$DataArr['discounts'].')';?>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="line_deresa_gris">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="line_deresa_gris">Total&nbsp;</td>
          <td align="right">&nbsp;<?PHP echo CurrencyActual($DataUserCia).'. '.sprintf("%01.2f",($TOTPAY+$SumarServ));?>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td class="line_deresa_gris">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="background-color:#E8E8E8" class="line_deresa_gris">&nbsp;</td>
          <td style="background-color:#E8E8E8">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td height="62" align="center" valign="bottom">____________________________<br />
      Authorized Signature</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>

</div>
<?PHP endif;?>
<script>
document.getElementById('f_date_b').focus();
<!--
//<![CDATA[
jQuery(function($){
   $('#tot_persons').mask("99");
    $('#gender_f').mask("99");
	 $('#gender_m').mask("99");
	 $('#new_price').mask("99.99");
});
-->

	function imprSelec(nombre) {
	  var ficha = document.getElementById(nombre);
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
	
</script>
