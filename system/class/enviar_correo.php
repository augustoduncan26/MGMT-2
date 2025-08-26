<?php
/**
 * Class enviar correos
 */

	class EnviarCorreo
	{

		function EnviarCorreo()
		{	
			$exito	=	true;
			return($exito);
		}
		
		function Enviar($Para , $Asunto , $MenzG , $CC=false , $CCC=false, $CCO = false ,$correo_masivo = false , $adjuntos = false) {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host     = 'webmail.hosting.com';  
			$mail->SMTPAuth = true;     			 
			$mail->Username = "no-reply@hosting.com"; 
			$mail->Password = "no-replay-hosting.com"; 		 
			$mail->Port       = 465;
		
			//MASS MAILINGS
			//=============
			if($correo_masivo == true) {

				$mail->From     = "no-reply@hosting.com"; 
				$mail->FromName = "MGMT-System";
				$mail->AddAddress($Para,""); 
				if($CCO == true) {
					$mail->AddCC($CCO);
				}

				if($CC == true) {
					$mail->AddBCC($CC);
				}

				if($CCC == true) {
					$mail->AddBCC($CCC);
				}
				
				$mail->WordWrap = 50;                              
			
				$mail->IsHTML(true);
				
				$mail->Subject  =  "$Asunto";
				$total	=	count(glob('REPOSITORIO/BOLETIN/*.jpg'));
				
				$mail->Body = '<center>'.$_POST['data'];
				
				for($i = 0 ; $i < $total ; $i++){
				$mail->AddEmbeddedImage('ad_REPOSITORY/BOLETIN/BOLETIN_'.date("Y-m-d").'_'.$i.'_.jpg', 'boletin'.$i, 'my-photo.jpg ');
				$mail->Body .= '<center />
							   <br><br>
							   <img alt="Boletin Informativo" src="cid:boletin'.$i.'">';
				}
			} else {

			// Normal
			//========
			$mail->From     = "no-reply@hosting.com";
			$mail->FromName = "MGMT-System";
			$mail->AddAddress($Para,""); 
			if($CCO == true)
			{
				$mail->AddCC($CCO);
			}
			if($CC == true)
			{	
				$mail->AddBCC($CC);
			}
			if($CCC == true)
			{
				$mail->AddAddress($CCC,"");
			}
			
			$mail->WordWrap = 50;                              
			
			
			$mail->IsHTML(true);
			
			$mail->Subject  =  "$Asunto";
			$mail->Body     =  '
						<table style="" id="Table_01" width="647" height="314" border="0" class="" cellpadding="0" cellspacing="0" >
						<tr>
							<td width="60" rowspan="3" bgcolor="#f70"  align="left" valign="top">
								&nbsp;</td>
							<td valign="top" align= "center"><font face=verdana size=3 /></td>
						</tr>
						 <tr>
						 <td colspan=3>
						 <img src="images/DC-2.png"><br />
						  &nbsp; '.$MenzG.'<br><br><br><br>
						  &nbsp; <font face=verdana size=1 color="#999999" />MGMT<br>
						 </td></tr></table> 
						 
						  ';
						 
			}
		
			$mail->AltBody  =  '';
			
			$mail->Send();
			
			unset($MenzG,$Asunto,$Para,$CC,$CCO);
		}
		/*
			Save email to DB
			Parametros:
				-	$D			=	From Name
				-	$CorreoD	=	From Email
				-	$Para		=	To
				-	$CorreoPara	=	Emil To
				-	$Asunto		=	Subject
				-	$ParaCC		=	CC
				-	$Data		=	Message
		*/
		function GrabarCorreoEnBD($D,$CorreoD,$Para,$CorreoPara,$Asunto,$ParaCC = false,$Data =false)
		{
			$exito 	 	=  false;
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