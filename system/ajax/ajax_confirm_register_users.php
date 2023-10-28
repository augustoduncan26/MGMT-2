<?php
// CONFIRM USER REGISTER

include_once ('framework.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

	if(isset($_GET['Z']) && $_GET['Z']!='') { 

		$objCons		=	new consultor();

		$PCod			=	explode('-000-',$_GET['Z']);
		$exito 			=	false;

		$Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','caracteres = "'.$PCod[1].'" and activo=0');
		
		if ( $Data["total"] == 1 ):
			// Activate user
			$Data       	= $ObjMante->BuscarLoQueSea('*',PREFIX.'users','caracteres = "'.$PCod[1].'" and activo=0','extract');
			//$P_Valores  = 	"activo = '1', id_cia = '".$Data['id_usuario']."', updated_at=NOW()";
			//$P_Tabla 	=   PREFIX."users";
			//$P_condicion= 	"id_usuario='".$Data['id_usuario']."'";
			//$Hecho 		=	$ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
			$Hecho 		=	$ObjEjec->ejecutarSQL("Update ".PREFIX."users SET activo=1, id_cia='".$Data['id_usuario']."', updated_at=NOW()  Where id_usuario = '".$Data['id_usuario']."'");
			
			// $P_Tabla 	=	PREFIX.'admin_cia';
			// $P_Campos 	=	'id_cia,name,id_depts,users,turn_a,turn_b,turn_c,turn_d,turn_e,active,created_at,updated_at';
			// $P_Valores 	=	"'".$id_empresa."','".$_GET['nombre']."','".$_GET['departamento']."','".$_GET['total_usuarios']."','".$_GET['turno_a']."','".$_GET['turno_b']."','".$_GET['turno_c']."','".$_GET['turno_d']."','".$_GET['turno_e']."','".$_GET['estado']."',NOW(),NOW()";
			// $result 	= $ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);


			//$sql 		= $ObjMante->BuscarLoQueSea('*',PREFIX.'admin_cia','caracteres = "'.$PCod[1].'" and activo=0','extract');
			// if (mysqli_num_rows($sql) < 1) {
			// 	mysqli_query($link,"Insert into empresas (id_usuario,name_empresa) values('".$Data['id_usuario']."','".$Data['name_cia']."')");
			// }
			
			//$SaveTblCia	=	mysql_query("Insert into admin_empresas (id_empresa,ruc,razon_social,direccion,telefono,fax,email,nombre_local,id_usuario,paginacion,notificar,work_as,idioma,activo) values('".$Data['id_usuario']."','-','".$Data['name_cia']."','-','-','-','".$Data['email']."','".$Data['name_cia']."','".$Data['id_usuario']."','12','0','rooms_bed','es',1)");
			
			//$Permissions=	mysql_query("Insert into permiso(id_usuario,id_definicion_permiso)values()");	
			
			// ********************************************
			//  Create some properies for the New Company *
			// ********************************************
			//$Permisos	=	new permisos();
			//$Permisos->aplicarPerfil($Data['id_usuario'],3,1);
			// $CreateTable=	mysqli_query($link,'CREATE TABLE ad_'.$Data['id_usuario'].'_habitaciones (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)) AS SELECT * FROM ad_habitaciones_tmp');
			// $CreateTable=	mysqli_query($link,'CREATE TABLE ad_'.$Data['id_usuario'].'_beds (id_beds INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_beds)) AS SELECT * FROM ad_beds_tmp');
			// $CreateTable=	mysqli_query($link,'CREATE TABLE ad_'.$Data['id_usuario'].'_reservas (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)) AS SELECT * FROM ad_reservas_tmp');
			// $CreateTable=	mysqli_query($link,'CREATE TABLE ad_'.$Data['id_usuario'].'_reservas_days (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)) AS SELECT * FROM ad_reservas_days_tmp');
			
			// ********************************************
			//     Create some example data & rooms	      *
			// ********************************************
			//FuncionesDML($P_accion	, $P_campos , $P_tabla , $P_condicion = false , $P_valores = false , $P_salida = false , $P_orden = false , $P_paginac=false, $P_pag="");
			//$Gral->FuncionesDML('insert','fecha_ult_acceso='.date("Y-m-d").'','ad_usuario','usuario="'.$usuario.'"');
			
				
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