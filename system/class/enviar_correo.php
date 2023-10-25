<?php
//Clase: 	EnviarCorreo
//			Rutina que contiene el esquema de correo para todo el sistema
//			Desarrollado por:
//			SAD:	Sinclair Augusto Duncan
//					2009 - augustoduncan26@hotmail.com
//			Para:	AAEEPP

	class EnviarCorreo
	{

		function EnviarCorreo()
		{	
			$exito	=	true;
			return($exito);
		}
		
		function Enviar($Para , $Asunto , $MenzG , $CC=false , $CCC=false, $CCO = false ,$correo_masivo = false , $adjuntos = false) {
			$mail = new PHPMailer();
			$mail->IsSMTP();  // send via SMTP
			$mail->Host     = 'www.duncancomputer.com';	//	relay-hosting.secureserver.net//'192.168.2.15';// SMTP servers//190.34.151.107//mail.avipacinc.com//190.123.192.118//mail.sume911.pa
			$mail->SMTPAuth = true;     			// authenticacion SMTP 
			$mail->Username = "no-reply@duncancomputer.com";  	// SMTP usuario / rootaugusto.duncan //admin@ideasexpertos.com
			$mail->Password = "pelaito11"; 			// SMTP clave / avi45pl9 /8-364-936 / pelaito11 / sume911$$
			
			//PARA CORREOS MASIVOS - BOLETINES DE ANUNCIOS DE LA AAEEPP
			//=========================================================
			if($correo_masivo == true) {

				$mail->From     = "no-reply@duncancomputer.com";//"info@decoflorespaola.com";
				$mail->FromName = "Hotel-System";
				$mail->AddAddress($Para,""); 
				if($CCO == true) {
					$mail->AddCC($CCO);
				}

				if($CC == true) {
					$mail->AddBCC($CC);
				//$mail->AddBCC($CCC);
				}

				if($CCC == true) {
					$mail->AddBCC($CCC);
				//$mail->AddBCC($CCC);
				}
				
				$mail->WordWrap = 50;                              
			
			
				//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // archivo adjunto
				$mail->IsHTML(true);  // enviar como HTML
				
				$mail->Subject  =  "$Asunto";//"Este es el asunto";
				//$mail->AddEmbeddedImage("BOLETIN.jpg", "my-attach", "BOLETIN.jpg"); 
				//$mail->AddEmbeddedImage('logo.gif','my-logo');
				$total	=	count(glob('REPOSITORIO/BOLETIN/*.jpg'));
				
				$mail->Body = '<center>'.$_POST['data'];
				
				for($i = 0 ; $i < $total ; $i++){
				//rename("/tmp/archivo_temp.txt", "/home/usuario/login/docs/mi_archivo.txt"); 
				$mail->AddEmbeddedImage('ad_REPOSITORY/BOLETIN/BOLETIN_'.date("Y-m-d").'_'.$i.'_.jpg', 'boletin'.$i, 'my-photo.jpg ');
				$mail->Body .= '<center />
							   <br><br>
							   <img alt="Boletin Informativo" src="cid:boletin'.$i.'">';
				}
			}
			
			else
			
			{
			//ENVIO DE CORREOS COMUNES
			//=========================================
			
			$mail->From     = "no-reply@duncancomputer.com";//"info@decoflorespaola.com";
			$mail->FromName = "Hotel-System";
			$mail->AddAddress($Para,""); 
			//$mail->AddAddress($CC); 
			if($CCO == true)
			{
				$mail->AddCC($CCO);
			}
			if($CC == true)
			{	// COPIA OCULTA
				$mail->AddBCC($CC);
				//$mail->AddAddress($CC,"");
				//$mail->AddBCC($CCC);
			}
			if($CCC == true)
			{
				//$mail->AddBCC($CCC);
				$mail->AddAddress($CCC,"");
				//$mail->AddBCC($CCC);
			}
			//$mail->AddBCC($CCCC);
			//$mail->AddReplyTo($CCO);
			
			$mail->WordWrap = 50;                              
			
			//AGREGAR ARCHIVOS ADJUNTOS
			// =========================
			//$mail->AddAttachment("http://www.ideasexpertos.com/sume911/image/sume911.png", "sume911.png"); // archivo adjunto
			$mail->IsHTML(true);  // enviar como HTML
			
			$mail->Subject  =  "$Asunto";//"Este es el asunto";
			//$mail->AddEmbeddedImage('image/sume911.png', 'imagen', 'image/sume911.png','base64','sume911.png');
			$mail->Body     =  '
						<style type="text/css">
						<!--
						.Estilo1 {
							font-size: 18px;
							font-family: Arial, Helvetica, sans-serif;
							font-weight: bold;
							color: #010066;
						}
						.Estilo4 {
							font-size: 12px;
							font-family: Arial, Helvetica, sans-serif;
						}
						.lineaarribax {
							border-top-width: 1px;
							border-top-style: solid;
							border-top-color: #010066;
						}
						.cuadroazulx {
							border: 1px solid #010066;
						}
						.bordeTodalaTabla {
							border-right-width: 1px;
							border-right-style: solid;
							border-right-color: #010066;
							border-top-width: 1px;
							border-top-style: solid;
							border-top-color:#010066;
							border-left-width: 1px;
							border-left-style: solid;
							border-left-color: #010066;
							background-position: left top;
							border-bottom-width: 1px;
							border-bottom-style: solid;
							border-bottom-color:#010066;
						}
						-->
						</style>
						  <table style="" id="Table_01" width="647" height="314" border="0" class="" cellpadding="0" cellspacing="0" >
						<tr>
							<td width="60" rowspan="3" bgcolor="#f70"  align="left" valign="top">
								&nbsp;</td>
							<td valign="top" align= "center"><font face=verdana size=3 /><!--<img src="http://190.34.151.109/AviSistema/image/logoavipac.png" height="80" >--></td>
						</tr>
						 <tr>
						 <td colspan=3>
						 <img src="images/DC-2.png"><br />
						  &nbsp; '.$MenzG.'<br><br><br><br>
						  &nbsp; <font face=verdana size=1 color="#999999" />Hotel-System 2015-2018.<br>
						 </td></tr></table> 
						 
						  ';
						  //&nbsp; Para acceder al sistema click <a href="http://sit.aaeepp.gob.pa" >AQUI</a>
			}
			//#BAD80A
			$mail->AltBody  =  '';//"Este es el texto del cuepo solamente";
			
			$mail->Send();
			
			unset($MenzG,$Asunto,$Para,$CC,$CCO);
			/*
			if($mail->Send() && isset($P_Listo) && $P_Listo == TRUE)
			{
			 $P_Listo		=	FALSE;
			 //  echo "Mensaje no Enviado <p>";
			 //  echo "Error: " . $mail->ErrorInfo;
			 //  exit;
			 $mail->Host	 = 	FALSE;
			 $mail->Username =	FALSE;
			 $mail->Password =	FALSE;
			 $mail			 =  FALSE;
			 //$mail->Send()	 =  FALSE;
			 unset($mail);
			 
			 	return false;
			}
			*/
			//echo "Mensaje Enviado";
			
			//return true;
		}
		/*
			Funcion que graba los correos que se envian
			Parametros:
				-	$D			=	Nombre de quien envia
				-	$CorreoD	=	Correo de quien envia
				-	$Para		=	Nombre a quien va el correo
				-	$CorreoPara	=	Correo del destinatario
				-	$Asunto		=	Asunto del correo
				-	$ParaCC		=	Correo del CC
				-	$Data		=	El mensaje del correo
		*/
		function GrabarCorreoEnBD($D,$CorreoD,$Para,$CorreoPara,$Asunto,$ParaCC = false,$Data =false)
		{
			$exito 	 	=  false;
			//$objCMS 	=  new cms() ;	
			$objCons 	=  new consultor;
			$objEjec 	=  new ejecutorSQL();
			
			if($Data == false)
			{
				$Data = '';	
			}
		
			$tbl 	= 'ad_correos_enviados';
			$cmp 	= "de,correode,para,correopara,paracc,asunto,data,fecha"; 
			$val 	= ("'".$D."','".$CorreoD."','".$Para."','".$CorreoPara."','".$ParaCC."','".$Asunto."','".$Data."','".date("Y-m-d")."'"); 
			$result = $objEjec->insertarRegistro($tbl , $cmp, $val);
		}
		
	}
	
?>