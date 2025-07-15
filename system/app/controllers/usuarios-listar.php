<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = 	new Mantenimientos();
$ObjEjec    = 	new ejecutorSQL();
$ObjUsers 	=	new Usuarios();
$objPermOpc = 	new permisos();
$id_rol 	=	$_SESSION['id_rol'];
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'usuarios';
$path 		=  	ROOT_DIR.REPOSITORY."profile_photos/";
if (is_dir($path)) {
	@chmod($path, 0755);
}

/**
 * Query Async
 */
if (isset($_POST) && isset($_POST['r1']) && $_POST['r1']== 'query' && $_POST['r2']!='') {

	$where 			= 	'id_cia="'.$id_cia.'" and id_perfil = '.$_POST['r2'];
	if ($_POST['r2']=='Todos') {
		$where 		= 	'id_cia="'.$id_cia.'" and id_usuario <> 1';
	}
	
	$listUsers 		=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','id_usuario');

	if ($listUsers['total'] > 0) {
		foreach ($listUsers['resultado'] as $key => $datos) {
	?>
		<tr>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['nombre']. ' ' .$datos['apellido']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['email']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['created_at']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
			<td class="text-center">
				<a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id_usuario']; ?>');"><i class="fa fa-edit"></i></a>
            	<!-- <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiarCampos('edit_usuario');showUserPermisos('<?php echo $datos['id_usuario']; ?>');"><i class="fa fa-key"></i></a> -->
            	<a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id_usuario']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
			</td>
		</tr>
	<?php
		}
	} else {
		echo '<tr><td colspan="8" class="text-center">Ningún dato disponible en esta tabla</td></tr>';
	}
}

/**
 * List all Users
 */
$listUsers 		= 	$ObjUsers->list();

$listEmpleados 	=	$ObjMante->BuscarLoQueSea('email',PREFIX.'empleados',false,'array','id,nempleado');
$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id <> 100 and activo=1 and id_cia="'.$id_cia.'"','array');

// Select all Perfiles
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id <> 100 and activo=1 and id_cia="'.$id_cia.'"';
	$listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles',$where,'array','id,name');
	echo json_encode($listPerfiles['resultado']);
}

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['user_acceso'] != '') {
	echo $ObjUsers->save($_POST,$_FILES);
	// $sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'email="'.$_POST['user_acceso'].'"','array');

	// if (is_dir($path)) {
	// 	@chmod($path, 0755);
	// }
	// if ($sql['total'] > 0 ) {
	// 	echo $mssg	=	'Ya existe este registro.';
	// } else {

	// 	if (file_exists(REPOSITORY."profile_photos/")) {
	// 		echo "The directory ".REPOSITORY."profile_photos/ exists.";
	// 		exit;
	// 	}

	// 	// Insert Photo
	// 	if ($_FILES['file']['name']) {
	// 		$rand 			=	rand('1234567890','0987654321');
	// 		$rand2 			=	rand('0987654321','1234567890');
	// 		$image 			= 	getimagesize($_FILES['file']['tmp_name']);
	// 		$extension 		=	explode('/',$image['mime']);
	// 		$temp 			= 	explode(".", $_FILES['file']['name']);
	// 		$newfilename    =   $id_cia.'-foto-'.$rand.'-'.date('Y-m-d').'-'.$rand2. '.' . $extension[1];//$temp[1];
	// 		$fileTempName 	= 	$_FILES['file']['tmp_name'];
			

	// 		// check if there is an error for particular entry in array
	// 		if(!empty($file['error']))  {
	// 			// some error occurred with the file in index $index
	// 			// yield an error here
	// 			echo 'error en foto';
	// 			return false;
	// 		}
	// 	}

	// 	$clave 		=	encrypt_decrypt('encrypt', $_POST['clave']);
	// 	$perfilData =	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id="'.$_POST['perfil'].'"');
	// 	$P_Valores 	= 	"'".$_POST['user_acceso']."','".$_POST['user_acceso']."','".$_POST['nombre']."','".$_POST['apellido']."','".$id_cia."','".$_POST['director']."','".$_POST['principal']."','".$_POST['perfil']."','".$perfilData['name']."','".$clave."',NOW(),NOW(),'0','".$_POST['estado']."'";
	// 	$sql 		=	$ObjEjec->insertarRegistro($P_Tabla, 'usuario,email,nombre,apellido,id_cia,es_director,principal,id_perfil,name_perfil,contrasena,created_at,updated_at,superadmin,activo', $P_Valores);
		
	// 	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	// 		move_uploaded_file($fileTempName, $path . $newfilename);
	// 		$clave 		= 	"photo='".$newfilename."'";
	// 		$l 			= 	$ObjEjec->actualizarRegistro($clave, $P_Tabla, 'email = "'.$_POST['user_acceso'].'"');
	// 	}

	// 	$dataUser 	=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'email = "'.$_POST['user_acceso'].'"','extract');

	// 	// Add permissions
	// 	if ($_POST['perfil']) {
	// 		$selPerms 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_cia="'.$id_cia.'" and id_perfil="'.$_POST['perfil'].'"','array');
	// 		if ($selPerms['resultado']) {
	// 			foreach ($selPerms['resultado'] as $key => $perm) {
	// 				if (is_numeric($perm['id_definicion_permiso'])) {
	// 					$P_Campos 		=	'id_user,id_permission,id_cia,created_at';
	// 					$P_Valores 		=	"'".$_POST['id']."','".$perm['id_definicion_permiso']."','".$id_cia."',NOW()";
	// 					$ObjEjec->insertarRegistro(PREFIX.'users_permissions', $P_Campos, $P_Valores);
	// 				}
	// 			}
	// 		}
	// 	}

	// 	// Save Parents Data
	// 	if ($_POST['contacto']) {
	// 		//$selPerms 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_cia="'.$id_cia.'" and id_perfil="'.$_POST['perfil'].'"','array');
	// 		$selPerfile 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','name like "%Padre%" or name like "%emergencia%"','extract');
	// 		// Save to table parents
	// 		$P_Valores 		=	"'".$_POST['contacto']."','".$selPerfile['id']."','".$dataUser['id']."',NOW(),NOW()";
	// 		$ObjEjec->insertarRegistro(PREFIX.'emergency_contact', 'name,id_perfil,id_students,created_at,updated_at', $P_Valores);
	// 	}

	// 	echo 'Se ingreso el registro con éxito';

	// 	if ($_POST['enviar_email']) {
	// 		$Obj		=	new EnviarCorreo();
	// 		$mensaG		=	"<font face=verdana size=1.5 />Hola ".$_POST['nombre']."&nbsp;<br /><br />
	// 						&nbsp;&nbsp;Se ha creado su usuario con éxito.<br><br>
	// 						&nbsp;&nbsp;Sus datos de acceso son:<br>
	// 						&nbsp;&nbsp;Nombre de usuario: ".$_POST['user_acceso']."<br>			
	// 						&nbsp;&nbsp;Clave de acceso: ".$_POST['clave']."<br>
	// 						";
			
	// 		//$Obj->Enviar($_POST['email'] ,"Confirmar Registro" , $mensaG ,'augustoduncan26@hotmail.com' , false, false ,false,false);
			
	// 		$mail_to_send_to = $_POST['user_acceso'];
	// 		$from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
	// 		$subject		 = "Usuario creado";
	// 		//$message		= "\r\n" . "Name: TEST" . "\r\n";
	// 		$headers  = "From: " . strip_tags($from_email) . "\r\n";
	// 		$headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
	// 		$headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
	// 		$headers .= "MIME-Version: 1.0\r\n";
	// 		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	// 		$a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
	// 		$mensaje	=	'Usuario creado con éxito. <br />';
	// 	}
	// }
}

/**
 * Show Edit Modal & info
 */
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
	// $data 		= $ObjAssignm->listAssignmentsById($_GET['id']);
	// echo json_encode($data);
}

/**
 * Update
 */
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['nombre'] !='') {

	$newfilename 		= 	false;
	$data       		= 	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_usuario="'.$_POST['id'].'" and id_cia = '.$id_cia,'extract');
	$newfilename		=	$data['photo'];

	// Insert Photo
	if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {

		@unlink($path.$data['photo']);

		$rand 			=	rand('1234567890','0987654321');
		$rand2 			=	rand('0987654321','1234567890');
		$image 			= 	getimagesize($_FILES['file']['tmp_name']);
		$extension 		=	explode('/',$image['mime']);
		$temp 			= 	explode(".", $_FILES['file']['name']);
		$newfilename    =   $id_cia.'-foto-'.$rand.'-'.date('Y-m-d').'-'.$rand2. '.' . $extension[1];
		$fileTempName 	= 	$_FILES['file']['tmp_name'];
		
		// check if there is an error for particular entry in array
		if(!empty($file['error']))  {
			// some error occurred with the file in index $index
			// yield an error here
			echo 'error en foto';
			return false;
		}
	}

	$P_Valores 	= "nombre='".$_POST['nombre']."', apellido = '".$_POST['apellido']."', photo='".$newfilename."', birthday='".$_POST['birthday']."' , id_perfil='".$_POST['perfil']."',  activo = '".$_POST['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id_usuario = "'.$_POST['id'].'"');

	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		move_uploaded_file($fileTempName, $path . $newfilename);
	}
  	
	// Update password
	$clave = "";
	if (isset($_POST['clave']) && $_POST['clave']!="") {
		$clave 		=	encrypt_decrypt('encrypt', $_POST['clave']);
		$clave 		= 	"contrasena='".$clave."'";
		$l 			= 	$ObjEjec->actualizarRegistro($clave, $P_Tabla, 'id_usuario = "'.$_POST['id'].'"');
	}

	// Update permissions
	if ($data['id_perfil'] != $_POST['perfil']) {
		if ($id_user == $data['id_usuario']) {
			unset($_SESSION['id_rol']);
			$_SESSION['id_rol'] = $_POST['perfil'];
		}
		$perfilData =	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id="'.$_POST['perfil'].'"');
		$ObjEjec->actualizarRegistro("name_perfil='".$perfilData['name']."'", $P_Tabla, 'id_usuario = "'.$_POST['id'].'"');
		$ObjEjec->ejecutarSQL("Delete from ".PREFIX."users_permissions Where id_user = '".$_POST['id']."' and id_cia='".$id_cia."'");
		$selPerms 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_cia="'.$id_cia.'" and id_perfil="'.$_POST['perfil'].'"','array');
		if ($selPerms['resultado']) {
			foreach ($selPerms['resultado'] as $key => $perm) {
				if (is_numeric($perm['id_definicion_permiso'])) {
					$P_Campos 		=	'id_user,id_permission,id_cia,created_at';
					$P_Valores 		=	"'".$_POST['id']."','".$perm['id_definicion_permiso']."','".$id_cia."',NOW()";
					$ObjEjec->insertarRegistro(PREFIX.'users_permissions', $P_Campos, $P_Valores);
				}
			}
		}
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
	// $ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	// echo '<div class="alert alert-danger">Se elimino el registro con éxito</div>';
	echo $ObjUsers->delete($_GET);
}


?>