<?php

	include_once ( dirname(dirname(__DIR__)) . '/framework.php');
	
	$P_Tabla 	=	"usuarios";
	$mssg 		= "";	
	$ObjMante   = new Mantenimientos();
	$ObjEjec    = new ejecutorSQL();
	$id_user    = $_SESSION["id_user"];
	$id_cia 	= $_SESSION['id_cia'];
	$email 		= $_SESSION['email'];
	$username 	= $_SESSION['username'];

	$ObjMante   = new Mantenimientos();
	
// Editar Perfil
if (isset($_POST['btn_actualizar_perfil'])) {
	$newfilename =	'';

	if ($_FILES["photo"]) {
	
	$rand 		=	rand('1234567890','0987654321');
	$temp 		= 	explode(".", $_FILES["photo"]["name"]);
	//$total      =   count($_FILES['photo']['name']);
	$newfilename=   $id_user.'-foto-'.$rand. '.' . $temp[1];

	// Delete the profile photo

	// Upload the profile photo

	}
	// Update data
	$sql 		=	$ObjEjec->ejecutarSQL("Update ".PREFIX.$P_Tabla." SET nombre='".$_POST['full_name']."', telephone='".$_POST['telephone']."', direcction='".$_POST['direcction']."', profile_photo='".$newfilename."', updated_at=NOW()  Where id_usuario = '".$id_user."'");
	if ($sql) {
		$_SESSION['username'] = $_POST['full_name'];
		$mssg = "Los datos fueron actualizados con éxito.";
	}
}


$datos 		= $ObjMante->BuscarLoQueSea('*',PREFIX.$P_Tabla,' id_cia = '.$id_cia.' and email="'.$email.'"','extract');


?>