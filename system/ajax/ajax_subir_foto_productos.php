<?php

include_once ('../framework.php');


$rand 			=	rand('1234567890','0987654321');
$tamanyo		=	$_FILES['la_foto']['size']; 


if ( $_FILES["la_foto"]["name"] !='') {

if ($tamanio>10240) {
	
	echo "  &nbsp;&nbsp; (Tamaño incorrecto de foto.) &nbsp;&nbsp; ";

} else {

		$archivo 		= 	array('jpg','jpeg','gif','png');
		$tipofoto 		=	explode('/',$_FILES['la_foto']['type']);

	if(!in_array($tipofoto[1],$archivo)) {

		echo "  &nbsp;&nbsp; (Este tipo de Archivo no es Válido) &nbsp;&nbsp; ";

	} else {

		// If its Updating
		if ( $_POST['id'] !='') {

		if (file_exists('../images/products-images/' . substr($_SESSION['id_empresa'].'-'.$_FILES["la_foto"]["name"],0,5))) {
			unlink('../images/products-images/' . $_SESSION['id_empresa'].'-'.$_FILES["la_foto"]["name"])	;
		}
		
			$temp 			= 	explode(".", $_FILES["la_foto"]["name"]);
			$newfilename 	= 	$_SESSION['id_empresa'].'-'.$_FILES["la_foto"]["name"];

			mysql_query("Update fact_products set image = '".$newfilename."' Where id = '".$_POST['id']."'")or die(mysql_error());

			$dir			=	"../images/products-images/";

		} else {

			$newfilename 	= 	$_SESSION['id_empresa'].'-'.$_FILES["la_foto"]["name"];
			$dir			=	"../images/products-images/";
		}

	}
}


move_uploaded_file($_FILES["la_foto"]["tmp_name"], $dir.$newfilename);
//if (move_uploaded_file($_FILES["la_foto"]["tmp_name"], $dir.$newfilename)) { echo ". &nbsp; Subio la foto"; } else { echo " No subio";  }
echo 'Se actualizo el registro con éxito';

}


?>