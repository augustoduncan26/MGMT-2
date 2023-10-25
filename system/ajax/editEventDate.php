<?php

// Conexion a la base de datos
require_once('../config.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id 	= $_POST['Event'][0];
	$start 	= $_POST['Event'][1];
	$end 	= $_POST['Event'][2];

	$query 	= mysqli_query($link,"UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ");
	
	//$query = $bdd->prepare( $sql );
	// if ($query == false) {
	//  print_r($bdd->errorInfo());
	//  die ('Error');
	// }
	//$sth = $query->execute();
	if (mysqli_affected_rows($link) != false) {
	 die ('Error');
	}else{
		die ('OK');
	}

}
?>
