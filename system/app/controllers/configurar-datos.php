<?php
	include_once ( dirname(dirname(__DIR__)) . '/framework.php');

	$objUser		=	new Users();
	$objcmsIndx		= 	new cms();
	$Objsql			=   new	ejecutorSQL();
	$ObjMante 		=	new Mantenimientos();
	$P_TEMPRESAS 	= 	PREFIX.'admin_empresas';
	$P_TUSERS 		= 	PREFIX.'users';
	
	$DataUserCia	= $objUser->consultarUsuario($_SESSION['id_user']);
	$sel_moneda   	= $ObjMante->BuscarLoQueSea('*' , PREFIX.'type_moneda', 'active = 1', 'array', false);

	$DataUserCia['idioma'];
	
	// Save Info
	if (isset($_POST['btn-modificar'])) {

		$_SESSION['id_empresa'];
		$P_Valores 	=  "idioma = '".$_POST['idioma']."', name_cia = '".$_POST['name_cia']."', direcction = '".$_POST['direcction']."', telephone = '".$_POST['telephone']."',  tipo_moneda = '".$_POST['moneda']."', updated_at='".date('Y-m-d H:i:s')."'";
		$P_Tabla 	=  'users';
		$P_condicion=  " id_usuario = '".$_SESSION['id_user']."'";
		$resultOpe  =  $Objsql->actualizarRegistro($P_Valores, $P_TUSERS, $P_condicion);

		// Query
		$sel_ 		= $ObjMante->BuscarLoQueSea('*',$P_TEMPRESAS,'id_empresa='.$_SESSION['id_empresa'],'array');
		
		$P_Campos 	=	'razon_social,direccion,telefono,tipo_moneda,idioma,created_at';
		$P_Valores 	=	"'".$_POST['name_cia']."','".$_POST['direcction']."','".$_POST['telephone']."','".$_POST['moneda']."','".$_POST['idioma']."','".date('Y-m-d H:i:s')."'";
		
		if ($sel_['total'] < 1){
			$sql 	=	$Objsql->insertarRegistro($P_TEMPRESAS, $P_Campos, $P_Valores);
		} else{ 
			$P_ValUpdate=  "razon_social = '".$_POST['name_cia']."', idioma = '".$_POST['idioma']."', direccion = '".$_POST['direcction']."', telefono = '".$_POST['telephone']."',  tipo_moneda = '".$_POST['moneda']."', updated_at='".date('Y-m-d H:i:s')."'";
			$sql  	=  	$Objsql->actualizarRegistro($P_ValUpdate, $P_TEMPRESAS, "id_empresa = '".$_SESSION['id_empresa']."'");
		}

		if($resultOpe){ $mssg = 'Datos actualizados con éxito';}
	} 


	// Add User to Cia
	if ( $_POST['btn-agregar-user']) {
		
		$DataUserCia2	=	$objUser->consultarUsuarioEmpresa($_POST['email']);
		
		if($DataUserCia2 == false) {
			
			$_SESSION['id_empresa'];
			$CARACTERES	=	RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE);
			$P_Tabla 	=	'usuarios';
			$P_TUSERS;
			$clave 		=	
			$P_Campos 	=	'id_empresa,principal,name_cia,nombre,email,clave,idioma,caracteres,tipo_moneda,fecha_registro,activo';
			$P_Valores 	=	"'".$_SESSION['id_empresa']."',0,'".$DataUserCia2['nombre_cia']."', '".$_POST['nombre']."', '".$_POST['email']."','".$_POST['password']."','','','','','','".$_POST['estado']."'";
			$Objsql->insertarRegistro($P_TUSERS, $P_Campos, $P_Valores);

		} else {

			$mssg =  'Si existe';
		}
	}

	$DatosUser		=	$objUser->consultarUsuario($_SESSION['id_user']);
//var_dump($DatosUser);
 // if($DatosUser['work_as']=='rooms') { 
 //    $UseLike      =   '<font color="red">Hotel</font>';
 // } else {
 //   $UseLike      =   '<font color="green">Hostel</font>';
 // }
