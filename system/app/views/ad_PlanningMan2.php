<?PHP

	include_once('../../config.php');
	include_once('../../class/class_fecha.php');
	//include_once('../../functions.php');
	//include_once('../ad_libreria/Reemplazar_letras.inc.php');
	

	function Reemplazar_letras ( $frase ) {
					$frase_original  = $frase;
					$sano = array("á","é","í","ó","ú","ñ",
					"Á","É","Í","Ó","Ú",
					"à","è","ì","ò","ù",
					"Ö","Ñ","Ü","ü","é");
					
					$sabroso   = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
					"&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;",
					"&aacute;","&eacute;","&iacute;","&oacute;","&uacute;",
					"&Ouml;","&Ntilde;","&Uuml;","&uuml;","Ã©");
					
					$nueva_frase = str_replace($sano, $sabroso, $frase_original);
					
					return ($nueva_frase);
	}
	
	$ObjFecha		=	new fecha();
	$DataArr		=	false;
	$x				=	false;
	$NumFact		=	false;
	
	$TOTALF_1		=	isset($_POST['cuantas_f'])?($_POST['cuantas_f']):1;
	
	$POST_habit		=	isset($_GET['habita'])	?	$_GET['habita']	:'';
	$POST_bed		=	isset($_GET['bed'])		?	$_GET['bed']	:'';
	$POST_anyo		=	isset($_GET['anyo'])	?	$_GET['anyo']	:'';
	$POST_mes		=	isset($_GET['mes'])		?	$_GET['mes']	:'';
	
	$POST_dia		=	isset($_GET['dia'])		?	$_GET['dia']	:'';
	$GET_dater		=	isset($_GET['date_r'])	?	$_GET['date_r']	:'';
	$GET_opcion		=	isset($_GET['opcion'])	?	$_GET['opcion']	:'';
	$GET_color		=	isset($_GET['color'])	?	$_GET['color']	:'';
	
	$GET_idFile		=	isset($_GET['id'])		?	$_GET['id']		:'';
	$GET_uregistra	=	isset($_GET['userregistra'])?$_GET['userregistra']:'';	// id_empresa
	$GET_userreg	=	isset($_GET['userreg'])	?$_GET['userreg']	:	'';	// id_usuario
	$GET_id_empresa	=	isset($_GET['id_empresa'])	?$_GET['id_empresa']:'';

	$DataUserCia	=	isset($_GET['id_empresa'])	?$_GET['id_empresa']:'';
	$DataFullVersion=	isset($_GET['full_version'])?$_GET['full_version']:'';
	$DataIdUsuario	=	isset($_GET['id_user'])		?$_GET['id_user']:'';
	$DataWorkAss	=	isset($_GET['work_as'])		?$_GET['work_as']:'';

	$idusIndex		=	$GET_uregistra;
	
	
	
	$msg			=	'<font size="2" color="#FF0000">Todos los campos son obligatorios</font>';
	
	$POST_bookers		=	isset($_POST['bookers'])	?	$_POST['bookers']		:'';
	$POST_fechaa		=	isset($_POST['f_date_a'])	?	$_POST['f_date_a']		:'';
	$POST_fechab		=	isset($_POST['f_date_b'])	?	$_POST['f_date_b']		:'';
	$POST_totpersons	=	isset($_POST['tot_persons'])?	$_POST['tot_persons']	:'';
	$POST_where_from	=	isset($_POST['where_from'])	?	$_POST['where_from']	:'-';
	$POST_destination	=	isset($_POST['destination'])?	$_POST['destination']	:'-';
	$POST_first_name	=	isset($_POST['first_name'])	?	$_POST['first_name']	:'';
	$POST_last_name		=	isset($_POST['last_name'])	?	$_POST['last_name']		:'';
	$POST_nationality	=	isset($_POST['nationality'])?	$_POST['nationality']	:'';
	$POST_date_birth	=	isset($_POST['date_birth'])	?	$_POST['date_birth']	:'000-00-00';
	$POST_typedoc		=	isset($_POST['type_doc'])	?	$_POST['type_doc']		:'P';
	$POST_numberdoc		=	isset($_POST['number_doc'])	?	$_POST['number_doc']	:'-';
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
	
	$POST_iduser		=	isset($_POST['idusuario'])	?	$_POST['idusuario']		:'';

	if($DataIdUsuario==1 || $DataIdUsuario==2):
		$TblRooms	=	'ad_habitaciones';
		$TblBooking	=	'ad_reservas';
		$TblBeds	=	'ad_beds';
		$TblRDays	=	'ad_reservas_days';
	;else:
		$TblRooms	=	'ad_'.$DataIdUsuario.'_habitaciones';
		$TblBooking	=	'ad_'.$DataIdUsuario.'_reservas';
		$TblBeds	=	'ad_'.$DataIdUsuario.'_beds';
		$TblRDays	=	'ad_'.$DataIdUsuario.'_reservas_days';
	endif;
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
	$DataEmpresa		=	mysql_fetch_array(mysql_query('Select *,ad_admin_empresas.id as id_admin_empresas From ad_usuario,ad_admin_empresas Where ad_usuario.id_usuario="'.$GET_uregistra.'" AND ad_admin_empresas.id_empresa="'.$GET_uregistra.'"'));
	
	// ******************************************************
	
	// Select las id from facturas
	// ****************************
	/*
	$NumFatcA			=	mysql_query('Select * From ad_facturas order by id_facturas DESC');
	if(mysql_num_rows($NumFatcA)>0):
		$NumFact		= 	$NumFatc['id_facturas']+1; 
		$NumFatc		=	mysql_fetch_array($NumFatcA);
	
	
		if($NumFatc['id_facturas']==0): $NumFact = '00001'; 
		;elseif(strlen($NumFatc['id_facturas'])==1): @$NumFact = '0000'.$NumFact;
		;elseif(strlen($NumFatc['id_facturas'])==2): $NumFact = '000'.$NumFact;
		;elseif(strlen($NumFatc['id_facturas'])==3): $NumFact = '00'.$NumFact;
		;elseif(strlen($NumFatc['id_facturas'])==4): $NumFact = '0'.$NumFact;
		endif;
		// ****************************
	endif;
	*/
	$TotDaysR			=	$ObjFecha->diasEntreFechas($POST_fechaa, $POST_fechab);
	
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
// *************************************
// Edit Price de un dia en especifico  *
// *************************************
if(isset($_POST['buttonEditPriceThisDay'])):
	mysql_query('Update '.$TblRDays.' set price="'.$_POST['new_price'].'" Where day="'.$_POST['current_day'].'" and id_tbl_reservas="'.$GET_idFile.'"');
	$msg	=	strtoupper('Data saved successfully');	
endif;
	

	
// *****************************
//  SAVE THE DATA IN DATA BASE *
// *****************************

	if(isset($_POST['buttonSave']) || isset($_POST['buttonCheckInnPay'])):
		
		if($POST_fechaa >= $POST_fechab){
			
			$msg		=	'Error: Wrong input date.';

		} else { 
			//echo 'Select * From '.$TblBooking.' Where email="'.$POST_mail.'" and activo = 1';
			$sql_		=	mysql_query('Select * From '.$TblBooking.' Where email="'.$POST_mail.'" and activo = 1');
			$TotFind	=	@mysql_num_rows($sql_);
			if($TotFind>0)
			{
				$msg		=	'<h3>There is an active reserve with this email.</h3>';
				$DataExists	=	mysql_fetch_array($sql_);
			} else {
				// ******************************************
				// Check, they dont mess with another day   *
				// That have guest in te rooms or bed       *
				// ******************************************
				//echo 'Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$POST_cama.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"';
				// No idea what i'm doing
				if($TotDaysR>1):
					$sqlB_		=	mysql_query('Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$POST_cama.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"');
				;else:
					$sqlB_		=	mysql_query('Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$POST_cama.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"');// and "'.$POST_fechab.'"');
					
				endif;
				
				
				if(@mysql_num_rows($sqlB_)>0)
				{
					$msg		=	'<h3>There is another rooms reserved for the range of days selected.</h3>';
					
				}else
				{
				
					// Explode date
					// ************
					$FDate_e	=	explode('-',$POST_fechaa);
					$FDate_s	=	explode('-',$POST_fechab);
					
					// How much it is for days
					// ************************
					$TotDaysR	=	($TotDaysR);
					$PRE_PRICE	=	sprintf("%01.2f",($POST_price*$TotDaysR));
					$TOTAL_Price=	'00.00';
					
					if(isset($POST_discounts) && $POST_discounts!='00.00'):
						$TOTAL_Price=	sprintf("%01.2f",($PRE_PRICE-$POST_discounts));
					endif;
					
					//if($POST_status==''):$POST_status=1;endif;
					if(isset($_POST['buttonSave']) && !isset($_POST['buttonCheckInnPay'])): $POST_status=1; ;else: $POST_status = 3; endif;
					
					/*
						Fields in this short window:
						1. Arryval day
						2. Departure day
						3. Rooms
						4. Bed
						5. Price
						6. Discounts
						7. First Name
						8. Lasta Name
						9. Nationality
						10. Type & Number of Documents
						11. Email
						
					*/
			
			$POST_totpersons	=	intval($POST_totpersons);
			
	// ***********************************************
	// Duplicate information if is more than 1 guest  *
	// ***********************************************
	if($POST_totpersons >1 && $DataWorkAss=='rooms_bed'):
			
			$ALPHABETH			=	array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s');
			$result				=	$ObjFecha->DevolverFechasEntreDos($POST_fechaa,$POST_fechab);
			
			$BuscarCamas		=	mysql_fetch_array(mysql_query('Select * From '.$TblRooms.' Where codigo="'.$POST_rooms.'" and id_empresa="'.$GET_uregistra.'" and activo = 1'));
			//echo $BuscarCamas['total_beds'];
			// Wich beds are free
			$CAMASLIBRES	=	'';
			$ASIGNCAMA		=	false;
			$van			=	0;
			
			for($L=1;$L<$BuscarCamas['total_beds']+1;$L++):
				$sqlB_		=	mysql_query('Select * From '.$TblRDays.' Where room="'.$POST_rooms.'" and cama="'.$L.'" and activo = 1 and day between "'.$POST_fechaa.'" and "'.$POST_fechab.'"');
				
					if(mysql_num_rows($sqlB_)<1)
					{	
						if($CAMASLIBRES!='')
						{
							$CAMASLIBRES 	.=  ',';
						}
							$CAMASLIBRES	.=	$L;
							$van++;
					}
				
			endfor;
			

			// Check disponibility beds
			//*************************
			if($van<$POST_totpersons): 
			
				$msg		=	strtoupper('<h3>There are not enough bed in this room. </h3>');
			;else:
				
				// if usign system as hostel
					$CAMASLIBRES;
					$CAMASLIBRES	=	explode(',',$CAMASLIBRES);
				

				for($i=0;$i<$POST_totpersons;$i++):
						
							$explodEmail		=	explode('@',$POST_mail);
							$NewEmail			=	$explodEmail[0].'_'.$i.'@'.$explodEmail[1];
							
							if($POST_nationality==''): $POST_nationality='215';endif;				
							// Verify % for Bookers
							// ********************
							$VALOR0		=	false;
							$VALOR1		=	false;
							$VALOR2		=	false;
							$PRE_PRICE2	=	false;
							
							/*
							if(isset($_POST['bookers']) && $_POST['bookers']!=''):
								// Select booker porcentage
								$SelBook	=	mysql_fetch_array(mysql_query('Select * From ad_bookers Where activo = 1 and id = "'.$_POST['bookers'].'"'));// and id_empresa="'.$DataUserCia.'"'));
								
								$VALOR1		=	sprintf("%01.2f",($PRE_PRICE*$SelBook['porcentaje']));
								$VALOR2		=	sprintf("%01.2f",($VALOR1/100));
								//$VALOR		=	sprintf("%01.2f",$VALOR2);
								//echo $VALOR2;exit();
								$PRE_PRICE	=	sprintf("%01.2f",($PRE_PRICE-$VALOR2));
								
								// Insert porcent for the bookers
								mysql_query('Insert into ad_bookers_porcents(id_empresa,id_booker,id_user_reg,id_guest,id_pais,porcent,date_checkin,date_checkout,date_regist,activo) 
								values("'.$DataUserCia.'","'.$SelBook['id'].'","'.$DataIdUsuario.'","","'.$POST_nationality.'","'.$SelBook['porcentaje'].'","'.$POST_fechaa.'","'.$POST_fechab.'","'.date("Y-m-d").'",1)');
					
							endif;
							*/

							if(isset($_POST['bookers']) && $_POST['bookers']!=''):
									// Select booker porcentage
									$SelBook	=	mysql_fetch_array(mysql_query('Select * From ad_bookers Where activo = 1 and id = "'.$_POST['bookers'].'"'));// and id_empresa="'.$DataUserCia.'"'));
									
									$VALOR0		=	($BuscarCamas['price']*$TotDaysR);
									$VALOR1		=	sprintf("%01.2f",($VALOR0*$SelBook['porcentaje']));
									$VALOR2		=	sprintf("%01.2f",($VALOR1/100));
									//$VALOR		=	sprintf("%01.2f",$VALOR2);
									//echo $VALOR2;exit();
									$PRE_PRICE2	=	sprintf("%01.2f",($VALOR0-$VALOR2));
									
									// Insert porcent for the bookers
									mysql_query('Insert into ad_bookers_porcents(id_empresa,id_booker,id_user_reg,id_guest,id_pais,porcent,date_checkin,date_checkout,date_regist,activo) 
									values("'.$DataUserCia.'","'.$SelBook['id'].'","'.$DataIdUsuario.'","","'.$POST_nationality.'","'.$SelBook['porcentaje'].'","'.$POST_fechaa.'","'.$POST_fechab.'","'.date("Y-m-d").'",1)');
			
							endif;
							// End verify % for Bookers
							// *************************
							
							if($POST_typedoc==''):$POST_typedoc='P';endif;
							
								if($PRE_PRICE2!=''): $PRE_PRICE =  $PRE_PRICE2; endif;
								
								mysql_query('Insert into '.$TblBooking.'(
																	id_user,rooms,cama,fecha_e,fecha_s,total_dias,total_persons,
																	tipo_servicio,bookers_porcent,booker,where_coming_from,destination,
																	fecha_registro,first_name,last_name,nationality,country,woman,man,
																	date_birth,type_doc,number_doc,email,price,discounts,total_price,
																	escucho_de_nosotros,paso,observation,activo) 
													values("'.$DataIdUsuario.'","'.$POST_rooms.'","'.$CAMASLIBRES[$i].'","'.$POST_fechaa.'","'.$POST_fechab.'","'.$TotDaysR.'","'.$POST_totpersons.'",
															"'.$POST_tiposervicio.'","'.$VALOR2.'","'.$POST_bookers.'","'.$POST_where_from.'","'.$POST_destination.'",
															"'.date('Y-m-d').'","'.$POST_first_name.$i.'","'.$POST_last_name.$i.'","'.$POST_nationality.'","'.$POST_nationality.'","'.$POST_gender_f.'","'.$POST_gender_m.'",
															"'.$POST_date_birth.'","'.$POST_typedoc.'","'.$POST_numberdoc.'","'.$POST_mail.'","'.$POST_price.'","'.$POST_discounts.'","'.$PRE_PRICE.'",
															"'.$POST_hearabout.'","'.$POST_status.'","'.$POST_observation.'",1)');
						
								// **********************************
								//   Search id for the record saved *
								// **********************************
								$P_Reg		=	mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where first_name="'.$POST_first_name.$i.'" AND last_name="'.$POST_last_name.$i.'" AND fecha_registro="'.date('Y-m-d').'" order by id DESC LIMIT 1'));// AND type_doc="'.$POST_typedoc.'" AND number_doc="'.$POST_numberdoc.'"'));
								$FullName	=	$POST_first_name.$i.' '.$POST_last_name.$i;
								$result		=	$ObjFecha->DevolverFechasEntreDos($POST_fechaa,$POST_fechab);
							
								// ***********************************************
								//   Insert user detail in table ad_guest_list    *
								// ***********************************************
								$sqlC_		=	mysql_query('Select * From ad_guest_list Where email="'.$POST_mail.'" and id_empresa="'.$DataUserCia.'"');
								
								if(mysql_num_rows($sqlC_)==0):
									mysql_query('Insert into ad_guest_list(first_name,last_name,email,country,nationality,date_birth,gender_f,gender_m,id_empresa) 
									values("'.$POST_first_name.$i.'","'.$POST_last_name.$i.'","'.$POST_mail.'","'.$POST_nationality.'","'.$POST_nationality.'","'.$POST_date_birth.'","'.$POST_gender_f.'","'.$POST_gender_m.'","'.$GET_id_empresa.'")');
								endif;
							
							// ****************************************************
							// Insert day reserved in table ad_reservas_days      *
							// ****************************************************
							//for($r=0;$r<$TotDaysR+1;$r++):
							for($r=0;$r<$TotDaysR;$r++):
									mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price) values("'.$P_Reg['id'].'","'.$FullName.'","'.$POST_rooms.'","'.$P_Reg['cama'].'","'.$result[$r].'","'.$POST_price.'")');
							endfor;
						
					$POST_cama	=	($POST_cama+1);
					$PRE_PRICE2	=	false;
						
					endfor;
					
					$msg		=	'<h3>Data saved, updating planning, please wait...</h3>';	
					//	window.close();
						echo '
							<script>
								setTimeout("self.parent.tb_remove()",100000);
								//self.parent.tb_remove();
								parent.location.reload(1);
							</script>
						';
			endif;		

		// ******************************************
		//   If It`s only 1 guest, reservation      *
		//   in hotel = rooms or hostel=romms_bed   *
		//   no matter if is more than 1 guest and  *
		//   if is rooms, go in here                * 
		// ******************************************
		
		;else:
					if($POST_nationality==''): $POST_nationality='215';endif;				
					// Verify % for Bookers
					// ********************
						$VALOR2		=	'0.00';
					if(isset($_POST['bookers']) && $_POST['bookers']!=''):
						// Select booker porcentage
						$SelBook	=	mysql_fetch_array(mysql_query('Select * From ad_bookers Where activo = 1 and id = "'.$_POST['bookers'].'"'));// and id_empresa="'.$DataUserCia.'"'));
						
						$VALOR1		=	sprintf("%01.2f",($PRE_PRICE*$SelBook['porcentaje']));
						$VALOR2		=	sprintf("%01.2f",($VALOR1/100));
						//$VALOR		=	sprintf("%01.2f",$VALOR2);
						//echo $VALOR2;exit();
						$PRE_PRICE	=	sprintf("%01.2f",($PRE_PRICE-$VALOR2));
						
						// Insert porcent for the bookers
						mysql_query('Insert into ad_bookers_porcents(id_empresa,id_booker,id_user_reg,id_guest,id_pais,porcent,date_checkin,date_checkout,date_regist,activo) 
						values("'.$DataUserCia.'","'.$SelBook['id'].'","'.$DataIdUsuario.'","","'.$POST_nationality.'","'.$SelBook['porcentaje'].'","'.$POST_fechaa.'","'.$POST_fechab.'","'.date("Y-m-d").'",1)');
			
					endif;
					
					if($POST_typedoc==''):$POST_typedoc='P';endif;
					
					// *******************************
					// Insert into table reservation *
					// *******************************
					mysql_query('Insert into '.$TblBooking.'(id_user,rooms,cama,fecha_e,fecha_s,total_dias,total_persons,
															tipo_servicio,bookers_porcent,booker,where_coming_from,destination,
															fecha_registro,first_name,last_name,nationality,country,woman,man,
															date_birth,type_doc,number_doc,email,price,discounts,total_price,
															escucho_de_nosotros,paso,observation,activo) 
										values("'.$DataIdUsuario.'","'.$POST_rooms.'","'.$POST_cama.'","'.$POST_fechaa.'","'.$POST_fechab.'","'.$TotDaysR.'","'.$POST_totpersons.'",
											"'.$POST_tiposervicio.'","'.$VALOR2.'","'.$POST_bookers.'","'.$POST_where_from.'","'.$POST_destination.'",
											"'.date('Y-m-d').'","'.$POST_first_name.'","'.$POST_last_name.'","'.$POST_nationality.'","'.$POST_nationality.'","'.$POST_gender_f.'","'.$POST_gender_m.'",
											"'.$POST_date_birth.'","'.$POST_typedoc.'","'.$POST_numberdoc.'","'.$POST_mail.'","'.$POST_price.'","'.$POST_discounts.'","'.$PRE_PRICE.'",
											"'.$POST_hearabout.'","'.$POST_status.'","'.$POST_observation.'",1)');
					
					
					$msg		=	'<h3>Data saved, updating planning, please wait...</h3>';	
					
					// **********************************
					//   Search id for the record saved *
					// **********************************
					
					$P_Reg		=	mysql_fetch_array(mysql_query('Select * From '.$TblBooking.' Where email="'.$POST_mail.'" AND fecha_registro="'.date('Y-m-d').'" AND type_doc="'.$POST_typedoc.'" AND number_doc="'.$POST_numberdoc.'"'));
					$FullName	=	$POST_first_name.' '.$POST_last_name;
					$result		=	$ObjFecha->DevolverFechasEntreDos($POST_fechaa,$POST_fechab);
					
					// ***********************************************
					//   Insert user detail in table ad_guest_list    *
					// ***********************************************
					$sqlC_		=	mysql_query('Select * From ad_guest_list Where email="'.$POST_mail.'" and id_empresa="'.$DataUserCia.'"');
					
					if(mysql_num_rows($sqlC_)==0):
						mysql_query('Insert into ad_guest_list(first_name,last_name,email,country,nationality,date_birth,gender_f,gender_m,id_empresa) 
						values("'.$POST_first_name.'","'.$POST_last_name.'","'.$POST_mail.'","'.$POST_nationality.'","'.$POST_nationality.'","'.$POST_date_birth.'","'.$POST_gender_f.'","'.$POST_gender_m.'","'.$GET_uregistra.'")');
					endif;
					
					// ****************************************************
					// Insert day reserved in table ad_reservas_days      *
					// ****************************************************
					//for($r=0;$r<$TotDaysR+1;$r++):
					for($r=0;$r<$TotDaysR;$r++):
							mysql_query('Insert into '.$TblRDays.'(id_tbl_reservas,name_guest,room,cama,day,price) values("'.$P_Reg['id'].'","'.$FullName.'","'.$POST_rooms.'","'.$POST_cama.'","'.$result[$r].'","'.$PRE_PRICE.'")');
					endfor;	
					
					//	window.close();
						echo '
							<script>
								setTimeout("self.parent.tb_remove()",100000);
								//self.parent.tb_remove();
								parent.location.reload(1);
							</script>
						';
					
		endif;
					
			// ********************************
			//    End duplicate information   *
			// ********************************
				
						
				}
				
			}
		}
	endif;

// **************************
// **************************	
// *   EDIT INFORMATIONS    *
// **************************
// **************************

	if(isset($POST_mes) && strlen($POST_mes)==1): $POST_mes = '0'.$POST_mes; endif;
	if(isset($POST_dia) && strlen($POST_dia)==1): $POST_dia = '0'.$POST_dia; endif;
	
	//echo 'Select ad_currency_type.simbolo From ad_admin_empresas,ad_currency_type Where ad_admin_empresas.id_empresa="'.$GET_id_empresa.'" AND ad_admin_empresas.tipo_moneda=ad_currency_type.id';
	//$SQL_DataCia 	=	mysql_query('
	//					SELECT * From ad_admin_empresas,ad_currency_type
	//						');


	$SQL_DataCia	=	mysql_query('Select * From ad_admin_empresas Where ad_admin_empresas.id_empresa="'.$DataUserCia.'"');
	if(mysql_num_rows($SQL_DataCia)>0){
		$DataCIA	=	mysql_fetch_array($SQL_DataCia);
		$SQL_DataCia2=	mysql_query('Select * From ad_currency_type Where id="'.$DataCIA['tipo_moneda'].'"');
		if(mysql_num_rows($SQL_DataCia2)>0){$DataCIA=mysql_fetch_array($SQL_DataCia2);}else{$DataCIA=false;}
		}else{$DataCIA=false;}
		
	
	//echo 'Select * From '.$TblRooms.' Where codigo="'.$POST_habit.'" and activo=1';
	
	$SQL_National	=	mysql_query('Select * From ad_nacionalidad order by nacionalidad ASC');
	$SQL_Country	=	mysql_query('Select * From ad_pais order by pais ASC');
	$SQL_Bookers	=	mysql_query('Select * From ad_bookers Where (id_empresa="0" or id_empresa="'.$DataUserCia.'") order by name ASC');
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


// *****************************************
//   Close the Window (Refresh the opener) *
// *****************************************
if(isset($_POST['buttonClose'])):
	echo '
		  <script>
		   opener.location.reload();
			window.close();
		  </script>
		';
endif;

// Find type of currency.
// Using in the system
// **************************
	function CurrencyActual($GET_id_empresa)
	{
		include_once('../ad_config/ad_config.php');
		$exito 		= 	false;
		//$objCms		=	new cms();
		//$objCons 	= 	new consultor();
		$datos		=	false;
		
		$cons		=	"*";
		$where		=	" Where id_empresa = '".$GET_id_empresa."'";
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
<!--<div id="mostrarTiempo" align="right" style="font-family:Verdana, Geneva, sans-serif; text-decoration:blink; color:#F00; font-size:12px;">Cargando... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>-->
<script>

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
var subtot_	=	(parseInt(document.getElementById('cantidad_'+fila).value)*parseInt(xmlhttp.responseText));
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



function permite(elEvento, permitidos) {

  // Variables que definen los caracteres permitidos
  var numeros               =   "0123456789";
  var numeros_esp           =   " 0123456789";
  var caracteres            =   "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres    =   numeros + caracteres;
  var numeros_puntos        =   "0123456789.-";
  var numeros_coma_puntos   =   ",0123456789.";
  var pformula              =   "xXcChHvVtTaAsSgGlLADMeEfFiIoOpPuU" + numeros;
 
  // Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num': //SOLO NUMEROS
      permitidos = numeros;
      break;
    
    case 'car':
      permitidos = caracteres;
      break;
    
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
    
    case 'num_p':
      permitidos = numeros_puntos;
      break;
      
    case 'num_coma_p':
      permitidos = numeros_coma_puntos;
      break;
    
    case 'numeros_esp':
        permitidos = numeros_esp;
      break;
    
    case 'pform':
        permitidos = pformula;
      break;
    
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  return permitidos.indexOf(caracter) != -1;
}
</script>

<!-- <link href="../ad_css/tablas.css" type="text/css" rel="stylesheet" />
<link href="../ad_css/bordes_tablas.css" type="text/css" rel="stylesheet" /> - - >
<script type="text/javascript" src="ad_js/operaciones_en_campos.js"></script>
<script type="text/javascript" src="ad_js/consulta_asincronica.js"></script>

<script type="text/javascript" src="ad_js/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="ad_js/jquery/jquery-ui.min.js"></script> -->

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
// **********************
// SEARCH DIAS HABILES  *
// **********************
function ConsultarDispo(fechaa,fechab,rooms,bed){

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
xmlhttp.send("fechaa="+fechaa+"&fechab="+fechab+"&rooms="+rooms+"&bed="+bed+"&opc=dispo");

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
		//alert(error[1]);
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
	{
	//alert('Fechas erroneas');
	return false;
	}
	
	if(inicio==final)
	{
	//alert('Fechas erroneas');
	return false;
	}
	
}
</script>


<!-- OTRO MASK INPUT -->
<script>window.onerror=null</script>
<script type="text/javascript" src="../vendors/mask_input/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../vendors/mask_input/jquery.maskedinput-1.2.2-co.min.js"></script>
<!-- FIN -->

<?php /* ?>
  <!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../vendors/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="../vendors/jscalendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../vendors/jscalendar/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../vendors/jscalendar/calendar-setup.js"></script>
<?php */ ?>  
  <form action="" name="planning" autocomplete="off" id="planning" method="post">
    
    <div class="row" style="font-size:12px">

        <div class="col-md-12">
            <div class="col-md-6"><label>Fecha llegada</label></div>
            <div class="col-md-6"><input name="f_date_a" id="f_date_a" type="date" readonly class="bordeTodalaTabla_3" value="<?php if(isset($DataArr['fecha_e'])): echo $DataArr['fecha_e']; elseif(isset($_POST)):echo $POST_anyo.'-'.$POST_mes.'-'.$POST_dia;; endif;?>"></div>
        </div>
          
        <div class="col-md-12">
            <div class="col-md-6"><label>Fecha salida (dd/mm/YYYY)</label></div>
            <?php
				$lafechallegada =   $POST_anyo.'-'.$POST_mes.'-'.$POST_dia;
		      	$fechaSalida 	=	$ObjFecha->SumarDiasAFecha($lafechallegada,1);
		     ?>
            <div class="col-md-6"><input type="date" name="f_date_b" id="f_date_b" min="<?=$fechaSalida?>" max="" value="<?=$fechaSalida?>"></div>
        </div>

	<div class="clearfix"></div>
	<div class="ln_solid"></div>

        <div class="col-md-12">
            <div class="col-md-6"><label>Habitación:</label></div>
            <div class="col-md-6">

            <select name="rooms" id="rooms" disabled="disabled" class="" style="width:100%; font-size:11px; font-family:Verdana, Geneva, sans-serif" <?PHP if(isset($GET_opcion) && isset($DataArr['rooms'])):?> onchange="alert('Esta accion cambiara al invitado de habitacion y/o cama, luego de presionar Modificar Data. \n Verifique el precio por cama o habitacion. \n')"<?PHP endif;?>>
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
		      </div>
        </div>
<br /><br />
		<div class="col-md-12">
            <div class="col-md-3"><label>Cama</label></div>
            <div class="col-md-3"><input type="number" name="bed" id="bed" disabled="disabled"   class="bordeTodalaTabla_3" style="width:100px;font-size:12px" value="<?PHP if(isset($DataArr['cama'])): echo $DataArr['cama'];elseif($_POST):echo $POST_cama; elseif($POST_bed): echo $POST_bed; endif;?>" /> </div>

            <div class="col-md-3"><label>Bookers</label></div>
            <div class="col-md-3">
            	<?php $SQL_Bookers	=	mysql_query('Select * From ad_bookers Where (id_empresa="0" or id_empresa="'.$DataUserCia.'") and activo = 1 order by name ASC');?>
		        <select name="bookers" id="bookers" style="width:100%; font-size:12px; font-family:Verdana, Geneva, sans-serif">
		         <option value="">-select-</option>
				    <?PHP
				    	if(mysql_num_rows($SQL_Bookers)>0)
						{
							while($Datas=mysql_fetch_array($SQL_Bookers))
							{
								if((isset($_POST) && $_POST['bookers']==$Datas['id']) || (isset($DataArr['booker']) && $DataArr['booker']==$Datas['id'])):
									echo '<option value="'.$Datas['id'].'" selected="selected">'.$Datas['name'].'</option>';
								;else:
									echo '<option value="'.$Datas['id'].'">'.$Datas['name'].'</option>';
								endif;
							}
						}
					?>
        		</select>
            </div>
        </div>
		
		<div class="col-md-12">
			<div class="col-md-3"><label>Precio:</label></div>
			<div class="col-md-3"><input type="number" name="price" onkeypress="return permite(event, 'num')" id="price"  class="bordeTodalaTabla_3" step="0.01" style="width:100px;font-size:12px" value="<?PHP echo $RoomsDetail['price'];?>" /></div>
			
			<div class="col-md-3"><label>Descuento:</label></div>
			<div class="col-md-3"><input type="number" name="discounts" id="discounts"  class="bordeTodalaTabla_3" style="width:100%;font-size:12px" value="<?PHP if(isset($DataArr['discounts'])): echo $DataArr['discounts'];elseif(isset($_POST)):echo $POST_discounts;endif;?>" /> </div>
		
		</div>
		<div class="col-md-12">
			<div class="col-md-3"><label>Personas</label></div>
            <div class="col-md-3">
            	<input type="number" name="tot_persons" id="tot_persons" min="1" onkeypress="return permite(event, 'num');" maxlength="3" class="bordeTodalaTabla_3" style="width:100px;font-size:12px" onchange="
		        javascript:
		        var numero	=	document.getElementById('tot_persons').value;
		        var using_as=	'<?php echo $DataWorkAss?>';
		        
		        if(document.getElementById('f_date_b').value=='')
		        {
		        	document.getElementById('f_date_b').focus();
		            document.getElementById('f_date_b').style.border 		=	'1px solid red';	
		            document.getElementById('mensajes').innerHTML			=	' &nbsp;Introduzca fecha de salida';
		            document.getElementById('tot_persons').value			=	'';
		            return false;
		        }
		        
		        if(using_as!='rooms'){
			        if(numero !=1 && numero !=0 && numero !='')
			        {
			        	document.getElementById('td_mensaje2').innerHTML	=	'<strong>Will be blocking '+numero+' beds.</strong>';
			        }
			        var date_a	=	document.getElementById('f_date_a').value
			        var date_b	=	document.getElementById('f_date_b').value
			        var rooms	=	document.getElementById('rooms').value
			        var bed		=	document.getElementById('bed').value;
			        ConsultarDispo(date_a,date_b,rooms,bed)
			     }
        		" title="Insert two numbers, Ex. 01, 02, 10.." required value="<?PHP if(isset($DataArr['total_persons'])): echo $DataArr['total_persons'];elseif(isset($_POST)):echo $POST_totpersons;endif;?>" />
            </div>
            <div class="col-md-6"><div id="mensajes" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#F00"><?PHP echo $msg;?></div></div>
            <!-- <div class="col-md-3"></div> -->
		</div>

	<div class="clearfix"></div>
	<div class="ln_solid"></div>
		<!-- Full Name -->
		<div class="col-md-12">
            <div class="col-md-2"><label>Nombre</label></div>
            <div class="col-md-4"><input type="text" required name="first_name" id="first_name" class="bordeTodalaTabla_3" style="width:150px;font-size:12px" maxlength="30" value="<?PHP if(isset($DataArr['first_name'])): echo $DataArr['first_name']; elseif(isset($_POST)):echo $POST_first_name;endif;?>"></div>
        	<div class="col-md-2"><label>Apellido</label></div>
        	<div class="col-md-4"><input type="text" required name="last_name" id="last_name" class="bordeTodalaTabla_3" style="width:150px;font-size:12px" maxlength="30" value="<?PHP if(isset($DataArr['last_name'])): echo $DataArr['last_name']; elseif(isset($_POST)):echo $POST_last_name;endif;?>"></div>
        </div>

		<!-- Nationality -->
        <div class="col-md-12">
            <div class="col-md-2"><label>Nacionalidad</label></div>
            <div class="col-md-4">
            	<select id="nationality" name="nationality" style="width:150px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
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
            </div>
            <div class="col-md-2"><label>Documento</label></div>
            <div class="col-md-4">
            	<select name="type_doc" id="type_doc" style="width:150px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
		          <option value="">-select.</option>
		          <option value="D" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='D'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='D'): echo 'selected'; endif;?>>DNI / Cédula</option>
		          <option value="P" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='P'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='P'): echo 'selected'; endif;?>>Passporte</option>
		        </select>
            </div>
        </div>

		<div class="col-md-12">
		<div class="col-md-2"><label>Email</label></div>
            <div class="col-md-4"><input type="email" required name="mail" id="mail" class="bordeTodalaTabla_3" style="width:150px;font-size:12px" value="<?PHP if(isset($DataArr['email'])): echo $DataArr['email']; elseif($_POST): echo $POST_mail; endif;?>" maxlength="40" /></div>
            <div class="col-md-2"><label>#Documento</label></div>
            <div class="col-md-4"><input type="text" name="number_doc" id="number_doc" class="bordeTodalaTabla_3" style="width:150px; font-size:12px"  value="<?PHP if(isset($DataArr['number_doc'])): echo $DataArr['number_doc']; elseif(isset($_POST)): echo $POST_numberdoc; endif;?>" maxlength="25" /></div>  
        </div>

        <!-- Observations -->
        <div class="col-md-12">
            <div class="col-md-2"><label>Observaciones</label></div>
            <div class="col-md-10"><textarea name="observation" id="observation" cols="35" style="width:100%" rows="3" class="bordeTodalaTabla_3"></textarea></div>
        </div>

	</div>

	<div class="clearfix"></div>
	<div class="ln_solid"></div>

	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="buttonCheckInnPay" id="buttonCheckInnPay" class="btn btn-primary" style="background-color: #FF0;color: #000">Check-In</button>
        <button type="submit" name="buttonSave" id="buttonSave" class="btn btn-danger">Guardar Reservación</button>
     	<button type="button" data-backdrop="static" data-toggle="modal" data-target="#yourID" onClick="saveReservation()">Subscribe</button>
    </div>

<?php ?>
    <table width="" border="0" style="font-size:12px">
      <?php /* ?>
      <tr>
        <td colspan="4"><!--  onclick="javascript:self.parent.tb_remove();parent.location.reload(1);"close--></td>
      </tr>
      <tr>
      <td width="2%" bgcolor="#C9C9C9"><?PHP //echo 'From the day: '.$POST_dia.' of '.$ArrayMes[$POST_mes].' '.$POST_anyo;?></td>
      <td colspan="2" bgcolor="#C9C9C9">Llegada: 
      <input name="f_date_a" id="f_date_a" type="date" readonly class="bordeTodalaTabla_3" value="<?php if(isset($DataArr['fecha_e'])): echo $DataArr['fecha_e']; elseif(isset($_POST)):echo $POST_anyo.'-'.$POST_mes.'-'.$POST_dia;; endif;?>">
     <!--  <img src="web/images/calendar.png" width="16" height="16" id="f_trigger_c" style="cursor:pointer">
 	 -->
 	 </td>
 	 </tr>
 	 <tr>
 	 <td>
      Salida (mm/dd/YYY):
      <?php
		$lafechallegada =   $POST_anyo.'-'.$POST_mes.'-'.$POST_dia;
      	$fechaSalida 	=	$ObjFecha->SumarDiasAFecha($lafechallegada,1);
      ?>
      <!-- <input type="text" name="input" placeholder="YYYY-MM-DD" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY/MM/DD"/>
  -->
      <input type="date" name="f_date_b" id="f_date_b" min="<?=$fechaSalida?>" max="" value="<?=$fechaSalida?>">
      <!--<input type="date" name="f_date_b" id="f_date_b" readonly class="bordeTodalaTabla_3" style="width:100px; font-size:12px" onchange="return fechaPosterior()" value="<?PHP if(isset($DataArr['fecha_e'])): echo $DataArr['fecha_s']; elseif(isset($_POST)):echo $POST_fechab; endif;?>">-->
     <!--  <img src="web/images/calendar.png" width="16" height="16" id="f_trigger_d" style="cursor:pointer"> -->
      <td colspan="2" align="center" bgcolor="#C9C9C9">
    <?PHP if($GET_opcion==true):?>
      <input type="submit" class=" bordeTodalaTabla_3" name="buttonAddDays" id="buttonAddDays" value="   Add days" style="background-image:url(web/images/add2.png); background-repeat:no-repeat; background-position:left; cursor:pointer" onclick="if(confirm('Are you sure to add 1 day more')){ return true}else{return false}" />
      &nbsp;
      <input type="submit" class=" bordeTodalaTabla_3" name="buttonRemoveDays" id="buttonRemoveDays" value="   Remove days" style="background-image:url(web/images/delete2.png); background-repeat:no-repeat; background-position:left; cursor:pointer" onclick="if(confirm('Are you sure to remove 1 day to the range date')){ return true}else{return false}" />      &nbsp;(<?PHP $TOTDAYSNIGHT	=	$DataArr['total_dias']; echo $DataArr['total_dias'].' noches';//(@mysql_num_rows($SL_Totdays)-1).' noches'; //@mysql_num_rows($SL_Totdays)-1;?>) </td>
   <?PHP endif;?>   
      
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="center"><div id="mensajes" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#F00"><?PHP echo $msg;?></div></td>
        <td width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
        Rooms: 
      <!--<input type="text" name="rooms" id="rooms"  class="bordered bordeTodalaTabla_2" style="width:100px;font-size:12px" value="<?PHP if(isset($DataArr['rooms'])): echo $DataArr['rooms']; elseif(isset($_POST)): echo $POST_habit; endif;?>" /> -->
      <select name="rooms" id="rooms" disabled="disabled" style="width:150px; font-size:11px; font-family:Verdana, Geneva, sans-serif" <?PHP if(isset($GET_opcion) && isset($DataArr['rooms'])):?> onchange="alert('Esta accion cambiara al invitado de habitacion y/o cama, luego de presionar Modificar Data. \n Verifique el precio por cama o habitacion. \n')"<?PHP endif;?>>
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
      <input type="text" name="bed" id="bed" disabled="disabled"   class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['cama'])): echo $DataArr['cama'];elseif($_POST):echo $POST_cama; elseif($POST_bed): echo $POST_bed; endif;?>" /> 
      Bookers:
      <?php $SQL_Bookers	=	mysql_query('Select * From ad_bookers Where (id_empresa="0" or id_empresa="'.$DataUserCia.'") and activo = 1 order by name ASC');?>
        <select name="bookers" id="bookers" style="width:100px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
         <option value="">-select-</option>
          <?PHP
    	if(mysql_num_rows($SQL_Bookers)>0)
		{
			while($Datas=mysql_fetch_array($SQL_Bookers))
			{
				if((isset($_POST) && $_POST['bookers']==$Datas['id']) || (isset($DataArr['booker']) && $DataArr['booker']==$Datas['id'])):
					echo '<option value="'.$Datas['id'].'" selected="selected">'.$Datas['name'].'</option>';
				;else:
					echo '<option value="'.$Datas['id'].'">'.$Datas['name'].'</option>';
				endif;
			}
		}
	?>
        </select>
      <br /><br />  Price:
      <input type="text" name="price" onkeypress="return permite(event, 'num')" id="price"  class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP echo $RoomsDetail['price'];?>" /> 
      Discount: 
      <input type="text" name="discounts" id="discounts"  class="bordeTodalaTabla_3" style="width:50px;font-size:12px" value="<?PHP if(isset($DataArr['discounts'])): echo $DataArr['discounts'];elseif(isset($_POST)):echo $POST_discounts;endif;?>" /> 
      
      <input type="hidden" name="habitacion" id="habitacion" value="<?PHP echo $POST_habit?>" />
      <input type="hidden" name="cama" id="cama" value="<?PHP echo $POST_bed?>" />
      <input type="hidden" name="opcion" id="opcion" value="<?PHP echo $POST_opcion?>" />
      <input type="hidden" name="idReg" id="idReg" value="<?PHP echo $DataArr['id']?>" />
      <input type="hidden" name="idusuario" id="idusuario" value="<?PHP echo $idusIndex?>" />
        &nbsp;Total Persons:
        <input type="text" name="tot_personssss" id="tot_personssss" onkeypress="return permite(event, 'num');" maxlength="3" class="bordeTodalaTabla_3" style="width:50px;font-size:12px" onchange="
        javascript:
        var numero	=	document.getElementById('tot_persons').value;
        var using_as=	'<?php echo $DataWorkAss?>';
        
        if(document.getElementById('f_date_b').value=='')
        {
        	document.getElementById('f_date_b').focus();
            document.getElementById('f_date_b').style.border 		=	'1px solid red';	
            document.getElementById('mensajes').innerHTML			=	' &nbsp;Enter Departure day';
            document.getElementById('tot_persons').value			=	'';
            return false;
        }
        
        if(using_as!='rooms'){
	        if(numero !=1 && numero !=0 && numero !='')
	        {
	        	document.getElementById('td_mensaje2').innerHTML	=	'<strong>Will be blocking '+numero+' beds.</strong>';
	        }
	        var date_a	=	document.getElementById('f_date_a').value
	        var date_b	=	document.getElementById('f_date_b').value
	        var rooms	=	document.getElementById('rooms').value
	        var bed		=	document.getElementById('bed').value;
	        ConsultarDispo(date_a,date_b,rooms,bed)
	     }
        " title="Insert two numbers, Ex. 01, 02, 10.." value="<?PHP if(isset($DataArr['total_persons'])): echo $DataArr['total_persons'];elseif(isset($_POST)):echo $POST_totpersons;endif;?>" />
        </td>
      </tr>
      <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td width="28%" bgcolor="#F7F7F7">&nbsp;</td>
    <td width="60%" bgcolor="#F7F7F7" style="color:#F00; font-size:12px" id="td_mensaje2"><strong>[Ex.01,02,10...]</strong></td>
    <td colspan="2" bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="2">First Name</td>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td bgcolor="#F7F7F7"><input type="text" name="first_name" id="first_name" class="bordeTodalaTabla_3" style="width:250px;font-size:12px" maxlength="30" value="<?PHP if(isset($DataArr['first_name'])): echo $DataArr['first_name']; elseif(isset($_POST)):echo $POST_first_name;endif;?>"></td>
    <td bgcolor="#F7F7F7" style="color:#F00;" id="mensaje_firstname">&nbsp;</td>
    <td colspan="2" bgcolor="#F7F7F7">&nbsp;</td>
    </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Last Name</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="last_name" id="last_name" class="bordeTodalaTabla_3" style="width:250px;font-size:12px" maxlength="30" value="<?PHP if(isset($DataArr['last_name'])): echo $DataArr['last_name'];elseif($_POST):echo $POST_last_name;endif;?>" /></td>
        <td style="color:#F00;" id="mensaje_lastname">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>Nationality</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><select id="nationality" name="nationality" style="width:250px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
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
        </select></td>
        <td style="color:#F00;" id="mensaje_nationality">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Type Document</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><select name="type_doc" id="type_doc" style="width:250px; font-size:12px; font-family:Verdana, Geneva, sans-serif">
          <option value="">-select.</option>
          <option value="D" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='D'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='D'): echo 'selected'; endif;?>># Identificaci&oacute;n</option>
          <option value="P" <?php if(isset($DataArr['type_doc']) && $DataArr['type_doc']=='P'): echo 'selected'; elseif(isset($_POST['type_doc']) && $_POST['type_doc']=='P'): echo 'selected'; endif;?>>Passport</option>
        </select></td>
        <td style="color:#F00;" id="mensaje_typedoc">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Number doc.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="number_doc" id="number_doc" class="bordeTodalaTabla_3" style="width:250px; font-size:12px"  value="<?PHP if(isset($DataArr['number_doc'])): echo $DataArr['number_doc']; elseif(isset($_POST)): echo $POST_numberdoc; endif;?>" maxlength="25" /></td>
        <td style="color:#F00;" id="mensaje_numberdoc">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Mail</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="mail" id="mail" class="bordeTodalaTabla_3" style="width:250px;font-size:12px" value="<?PHP if(isset($DataArr['email'])): echo $DataArr['email']; elseif($_POST): echo $POST_mail; endif;?>" maxlength="40" /></td>
        <td style="color:#F00;" id="mensaje_email">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Observations</td>
        <td style="color:#F00; font-size:14px" id="td_mensaje">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><textarea name="observation" id="observation" cols="35" rows="3" class="bordeTodalaTabla_3"></textarea></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="color:#F00; font-size:14px" id="">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>

      <?php */ ?>
      <tr style="display: none">
        <td>&nbsp;</td>
        <td colspan="2" align="center">
        <input type="submit" name="buttonCheckInnPay" class="Estilo_Botones_X bordered" id="buttonCheckInnPay" value="Check In" style="width:200px; height:30px; cursor:pointer;background-color:#FF0; background-image:url(web/images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="
    
    
        
        if(RevisarElCorreo('mail')==false)
        {
        	document.getElementById('mensaje_email').innerHTML			=	' &nbsp;Enter a valid email';
            return false;	
        }
        
        if((document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value==''))
        {
        	document.getElementById('f_date_a').style.border 			=	'1px solid red';
            document.getElementById('f_date_b').style.border 			=	'1px solid red';	
            document.getElementById('mensajes').innerHTML				=	' &nbsp;Enter Departure day';
        	return false;
        }
         if(document.getElementById('f_date_b').value==document.getElementById('f_date_a').value)
         {
         	document.getElementById('mensajes').innerHTML				=	' &nbsp;The range of the days is wrong';
            document.getElementById('f_date_b').focus();
        	return false;
         }
        
        // Revisar Fechas
        // **************
        if(validar()==false)
        {
        	document.getElementById('mensajes').innerHTML				=	' &nbsp;The range of the days is wrong';
            document.getElementById('f_date_b').focus();
        	return false;
        }
        
        // Revisar Total de Personas
        // *************************
        if(document.getElementById('tot_persons').value=='')
        {
        	document.getElementById('td_mensaje2').innerHTML			=	' Total Persons(2 digit)';
            document.getElementById('tot_persons').style.border 		=	'1px solid red';
            document.getElementById('tot_persons').focus()
            return false;
        }
        
        //   OTHERS DATA
        // ****************
      if(document.getElementById('first_name').value=='')
      {
      		document.getElementById('mensaje_firstname').innerHTML		=	' &nbsp;Enter First Name';
            document.getElementById('first_name').style.border 			=	'1px solid red';
            document.getElementById('first_name').focus()
            return false;
      }
      if(document.getElementById('last_name').value=='')
      {
      		document.getElementById('mensaje_lastname').innerHTML	=	' &nbsp;Enter Last Name';
            document.getElementById('last_name').style.border 		=	'1px solid red';
            document.getElementById('last_name').focus()
            return false;
      }
      /*
      if(document.getElementById('nationality').value=='')
      {
      		document.getElementById('mensaje_nationality').innerHTML	=	' &nbsp;Select The Nationality';
            document.getElementById('nationality').style.border 		=	'1px solid red';
            document.getElementById('nationality').focus()
            return false;
      }
      if(document.getElementById('type_doc').value=='')
      {
      		document.getElementById('mensaje_typedoc').innerHTML	=	' &nbsp;Select Type of Document';
            document.getElementById('type_doc').style.border 		=	'1px solid red';
            document.getElementById('type_doc').focus()
            return false;
      }
      if(document.getElementById('number_doc').value=='')
      {
      		document.getElementById('mensaje_numberdoc').innerHTML			=	' Number of Document';
            document.getElementById('number_doc').style.border 		=	'1px solid red';
            document.getElementById('number_doc').focus()
            return false;
      }
        */
       
        // Review Gender
        // **************
        /*if(document.getElementById('gender_f').value=='' && document.getElementById('gender_m').value=='')
        {
        	document.getElementById('mensajes').innerHTML			=	'Please Select: Gender [F] or [M]';
            document.getElementById('gender_f').style.border 		=	'1px solid red';
            document.getElementById('gender_m').style.border 		=	'1px solid red';
            return false;
        }
        */
        
    
     if(confirm('Confirm The guest would Check In?'))// and set status: Ready Pay.'))
     {
     	return true;
     }else
     {
     	return false;
     }
     
     " />
     &nbsp;&nbsp;&nbsp;
     <input type="submit" name="buttonSave" class="bordered" id="buttonSave" value="  Save Reservation " style="cursor:pointer; background-color:#F00;height:30px; color:#FFF; background-image:url(web/images/arrow_collapsed.gif); background-position:left; background-repeat:no-repeat" onclick="javascript:
    	if(RevisarElCorreo('mail')==false)
        {
        	document.getElementById('mensaje_email').innerHTML			=	' &nbsp;Enter a valid email';
            return false;	
        }
        
        if(document.getElementById('f_date_b').value=='' || document.getElementById('f_date_a').value=='')
        {
        	document.getElementById('f_date_a').style.border 			=	'1px solid red';
            document.getElementById('f_date_b').style.border 			=	'1px solid red';	
            document.getElementById('mensajes').innerHTML				=	' &nbsp;Enter Departure day';
        	return false;
        }
        if(document.getElementById('f_date_b').value==document.getElementById('f_date_a').value)
         {
         	document.getElementById('mensajes').innerHTML				=	' &nbsp;The range of the days is wrong';
            document.getElementById('f_date_b').focus();
        	return false;
         }
        // Revisar Fechas
        // **************
        if(validar()==false)
        {
        	document.getElementById('mensajes').innerHTML				=	' &nbsp;The range of the days is wrong';
            document.getElementById('f_date_b').focus();
        	return false;
        }
        
        // Revisar Total de Personas
        // *************************
        if(document.getElementById('tot_persons').value=='')
        {
        	document.getElementById('td_mensaje2').innerHTML			=	' Total Persons(2 digit)';
            document.getElementById('tot_persons').style.border 		=	'1px solid red';
            document.getElementById('tot_persons').focus()
            return false;
        }
        
        //   OTHERS DATA
        // ****************
      if(document.getElementById('first_name').value=='')
      {
      		document.getElementById('mensaje_firstname').innerHTML		=	' &nbsp;Enter First Name';
            document.getElementById('first_name').style.border 			=	'1px solid red';
            document.getElementById('first_name').focus()
            return false;
      }
      if(document.getElementById('last_name').value=='')
      {
      		document.getElementById('mensaje_lastname').innerHTML	=	' &nbsp;Enter Last Name';
            document.getElementById('last_name').style.border 		=	'1px solid red';
            document.getElementById('last_name').focus()
            return false;
      }
     /*
      if(document.getElementById('nationality').value=='')
      {
      		document.getElementById('mensaje_nationality').innerHTML	=	' &nbsp;Select The Nationality';
            document.getElementById('nationality').style.border 		=	'1px solid red';
            document.getElementById('nationality').focus()
            return false;
      }
      if(document.getElementById('type_doc').value=='')
      {
      		document.getElementById('mensaje_typedoc').innerHTML	=	' &nbsp;Select Type of Document';
            document.getElementById('type_doc').style.border 		=	'1px solid red';
            document.getElementById('type_doc').focus()
            return false;
      }
      if(document.getElementById('number_doc').value=='')
      {
      		document.getElementById('mensaje_numberdoc').innerHTML			=	' Number of Document';
            document.getElementById('number_doc').style.border 		=	'1px solid red';
            document.getElementById('number_doc').focus()
            return false;
      }
      */
        /*
        if(confirm('Confirm The Reservation?'))// and set status: Ready Pay.'))
     {
     	return true;
     }else
     {
     	return false;
     }
       */ 
    " />
          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  
  </form>
<script>
document.getElementById('f_date_b').focus();
<!--
//<![CDATA[
jQuery(function($){
   $('#tot_persons').mask("99");
    $('#gender_f').mask("99");
	 $('#gender_m').mask("99");
	 $('#new_price').mask("99.99");
	/* $('#price').mask("99.99");
	 $('#discounts').mask("99.99");*/
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
	
	
	//document.getElementById('f_date_b').focus();
	
</script>