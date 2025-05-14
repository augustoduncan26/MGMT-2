<?php
// CONFIRM USER REGISTER

//include_once ('framework.php');
include_once ('../framework.php');
set_error_handler(header("Location: ../404"));
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

	if(isset($_GET['Z']) && $_GET['Z']!='') { 

		$objCons		=	new consultor();

		$PCod			=	explode('-000-',$_GET['Z']);
		$exito 			=	false;

		$Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','caracteres = "'.$PCod[1].'" and activo=0');
		
		if ( $Data["total"] == 1 ):
			// Activate user
			$Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','caracteres = "'.$PCod[1].'" and activo=0','extract');
			//$P_Valores  = 	"activo = '1', id_cia = '".$Data['id_usuario']."', updated_at=NOW()";
			//$P_Tabla 	=   PREFIX."users";
			//$P_condicion= 	"id_usuario='".$Data['id_usuario']."'";
			//$Hecho 		=	$ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
			$Hecho 		=	$ObjEjec->ejecutarSQL("Update ".PREFIX."users SET activo=1, id_cia='".$Data['id_usuario']."', updated_at=NOW()  Where id_usuario = '".$Data['id_usuario']."'");
				
				if($Hecho==true):
					//$mensaje	=	'Activation has been successfully. <br> Now you can login with your user account and password.';
					$mensaje	=	'Hemos activado su cuenta con éxito. Ahora puedes disfrutar de H&HSys';
				;else:
					//$mensaje	=	'¡Error!,Could not validate the activation.';
					$mensaje	=	'¡Error!, No hemos podido validar su activación.';
				endif;
		// ;else:
		//  $Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','caracteres = "'.$PCod[1].'" and activo=0');
		// 	$SQDD	=	mysqli_query($link,"SELECT * FROM hhs_usuario WHERE caracteres = '".$PCod[1]."'");
			
		// 	//Registrar para recibir notificaciones
		// 	mysqli_query($link,"Insert into usuarios_grupo(id_usuario,grupo,fecha,principal,activo) values('".$Data['id_usuario']."','".$Data['id_usuario']."','".date('Y-m-d')."',1,1)");
			
		// 	if(mysqli_num_rows($SQDD)>0):
		// 		//$mensaje	=	'Your account is already active.';
		// 		$mensaje	=	'Su cuenta ya esta activa';
		// 	;else:
		// 		//$mensaje	=	'¡Error!, Could not validate the activation';
		// 		$mensaje	=	'¡Error!, No hemos podido verificar tu activación';
		// 	endif;
		endif; 
	}


?>