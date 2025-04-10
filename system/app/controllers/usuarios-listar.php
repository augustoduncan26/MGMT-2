<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = 	new Mantenimientos();
$ObjEjec    = 	new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'usuarios';



$where 			= 	'id_cia="'.$id_cia.'" and id_usuario <> 1';
$listUsers 		=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','id_usuario');
$listEmpleados 	=	$ObjMante->BuscarLoQueSea('email',PREFIX.'empleados',false,'array','id,nempleado');
$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','activo=1','array');

// Select al Perfiles
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
	$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'mant_perfiles',$where,'array','id,name');
	echo json_encode($listPerfiles['resultado']);
}

// Add
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['user_acceso'] != '') {
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'email="'.$_POST['user_acceso'].'"','array');

	$path =  ROOT_DIR.REPOSITORY."profile_photos/"; //$_SERVER['DOCUMENT_ROOT'].'/'.REPOSITORY."profile_photos/";//$_FILES['file']['name'];
	if (is_dir($path)) {
		@chmod($path, 0755);
	}
	// echo ROOT_DIR;
	// exit;
	if ($sql['total'] > 0 ) {
		echo $mssg	=	'Ya existe este registro.';
	} else {

		if (file_exists(REPOSITORY."profile_photos/")) {
			echo "The directory ".REPOSITORY."profile_photos/ exists.";
			exit;
		}

		// Insert Photo
		if ($_FILES['file']['name']) {
			$rand 			=	rand('1234567890','0987654321');
			$rand2 			=	rand('0987654321','1234567890');
			$image 			= 	getimagesize($_FILES['file']['tmp_name']);
			$extension 		=	explode('/',$image['mime']);
			$temp 			= 	explode(".", $_FILES['file']['name']);
			$newfilename    =   $id_cia.'-foto-'.$rand.'-'.date('Y-m-d').'-'.$rand2. '.' . $extension[1];//$temp[1];
			$fileTempName 	= 	$_FILES['file']['tmp_name'];
			

			// check if there is an error for particular entry in array
			if(!empty($file['error']))  {
				// some error occurred with the file in index $index
				// yield an error here
				echo 'error en foto';
				return false;
			}
		}

		$clave 		=	encrypt_decrypt('encrypt', $_POST['clave']);
		$P_Valores 	= 	"'".$_POST['user_acceso']."','".$_POST['user_acceso']."','".$_POST['nombre']."','".$_POST['apellido']."','".$id_cia."','".$_POST['director']."','".$_POST['principal']."','".$_POST['perfil']."','".$clave."',NOW(),NOW(),'0','".$_POST['estado']."'";
		$sql 		=	$ObjEjec->insertarRegistro($P_Tabla, 'usuario,email,nombre,apellido,id_cia,es_director,principal,id_perfil,contrasena,created_at,updated_at,superadmin,activo', $P_Valores);
		
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			move_uploaded_file($fileTempName, $path . $newfilename);
			$clave 		= 	"photo='".$newfilename."'";
			$l 			= 	$ObjEjec->actualizarRegistro($clave, $P_Tabla, 'email = "'.$_POST['user_acceso'].'"');
		}

		echo 'Se ingreso el registro con éxito';

		if ($_POST['enviar_email']) {
			$Obj		=	new EnviarCorreo();
			$mensaG		=	"<font face=verdana size=1.5 />Hola ".$_POST['nombre']."&nbsp;<br /><br />
							&nbsp;&nbsp;Se ha creado su usuario con éxito.<br><br>
							&nbsp;&nbsp;Sus datos de acceso son:<br>
							&nbsp;&nbsp;Nombre de usuario: ".$_POST['user_acceso']."<br>			
							&nbsp;&nbsp;Clave de acceso: ".$clave."<br>
							";
			
			//$Obj->Enviar($_POST['email'] ,"Confirmar Registro" , $mensaG ,'augustoduncan26@hotmail.com' , false, false ,false,false);
			
			$mail_to_send_to = $_POST['user_acceso'];
			$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
			$subject		 = "Usuario creado";
			//$message		= "\r\n" . "Name: TEST" . "\r\n";
			$headers  = "From: " . strip_tags($from_email) . "\r\n";
			$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
			$headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
			$mensaje	=	'Usuario creado con éxito. <br />';
		}
	}
}

/**
 * Show Edit Modal & info
 */
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

/**
 * Edit
 */
if ( isset($_GET['edit']) && $_GET['edit'] == 1 && $_GET['nombre'] !='') {

	$P_Valores 	= "nombre='".$_GET['nombre']."', apellido = '".$_GET['apellido']."', id_perfil='".$_GET['perfil']."',  activo = '".$_GET['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id_usuario = "'.$_GET['id'].'"');
  	
	$clave = "";
	if (isset($_GET['clave']) && $_GET['clave']!="") {
		$clave 		=	encrypt_decrypt('encrypt', $_GET['clave']);
		$clave 		= 	"contrasena='".$clave."'";
		$l 			= 	$ObjEjec->actualizarRegistro($clave, $P_Tabla, 'id_usuario = "'.$_GET['id'].'"');
	}
	
	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

/**
 * Permisos
 */
if (isset($_POST['editperm']) && $_POST['editperm']==1) {
	$ObjEjec->ejecutarSQL("Delete from ".PREFIX."permisos Where id_usuario = '".$_POST['id_']."'");
	$exp 		=	explode(",",$_POST['valores']);
	$cuantos 	= 	count($exp);
	for ($i = 0 ; $i < $cuantos; $i++) {
		if (is_numeric($exp[$i])) {
			$P_Campos 		=	'id_usuario,id_definicion_permiso';
			$P_Valores 		=	"'".$_POST['id_']."','".$exp[$i]."'";
			$ObjEjec->insertarRegistro(PREFIX.'permisos', $P_Campos, $P_Valores);
		}
	}
	echo 1;
}

/**
* Delete  
*/ 
if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo '<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}


?>