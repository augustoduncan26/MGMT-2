<?php
	
	$objUsuario 	=	new Users();

	// Actualizar Infomacion
	if(isset($_POST['btn_actualizar_perfil'])) {
	
		$infoUsuario 		= array(
			'user' 			=> isset($_POST['username'])		? $_POST['username']:'',
			'name' 			=> isset($_POST['full_name'])		? $_POST['full_name']:'',
			'direcction' 	=> isset($_POST['direcction'])		? $_POST['direcction']:'',
			'telephone' 	=> 	isset($_POST['telephone'])		? $_POST['telephone']:'');
		
		$resultOpe  =  $objUsuario->updateUser ( $infoUsuario , $_POST['id_user']);
		$mssg 		=	$resultOpe['mensaje'];
		
	if ($_FILES['photo']!="") {  

		$dir 		=	dirname(__FILE__)."/web/repository/profiles/".$_FILES['photo']['name'].".jpg";
		$nombre_tn 	=	dirname(__FILE__)."/web/repository/profiles/foto_perfil_".$_POST['id_user']."_tn.jpg";
		$nombre_tn2 =	dirname(__FILE__)."/web/repository/profiles/foto_perfil_".$_POST['id_user']."_tn2.jpg";

		if (move_uploaded_file($_FILES['photo']['tmp_name'], $dir)) {  } else {  }

		$src 		= $dir;
		createThumb($src,$src,600);

		$src2 		= $nombre_tn;
		createThumb($src,$src2,50);
		
		$src3 		= $nombre_tn2;
		createThumb($src,$src3,37);
		if ($resultOpe['resultado']){
			//$mssg 	=	'Sus datos fueron actualizados';
		}
	}
}

// Update password
//if () {


//}
	
	$datos 			=	$objUsuario->getUser ( getSessionValue('id_user') );
	//dump($datos);
?>