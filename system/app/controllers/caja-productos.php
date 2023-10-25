<?php

include_once ('../../framework.php');

$id_user 		=	$_SESSION['id_user'];
$id_empresa 	=	$_SESSION['id_empresa'];

$P_Tabla 		=	"fact_products";


// Add
	if ( $_GET['add'] == 1 && $_GET['descripcion'] != '') {

	$P_Campos 		=	'image,barcode,description,inventory_min,price_in,price_out,quantity,category_id,id_empresa,activo,id_user,created_at,modify_at';
	$P_Valores 		=	"'".$_GET['imagen']."','".$_GET['codigo_barra']."','".$_GET['descripcion']."','".$_GET['stock_minimo']."','".$_GET['precio_costo']."','".$_GET['precio_venta']."','".$_GET['cantidad']."','".$_GET['categoria']."','".$_SESSION['id_empresa']."','".$_GET['estado']."','".$id_user."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
	
	$busca 			=	mysql_query("Select * From ".$P_Tabla." Where description = '".$_GET['descripcion']."' and id_empresa = '".$_SESSION['id_empresa']."'"); // $ObjMante->BuscarLoQueSea('*' , $P_Tabla, ' codigo ='.$_POST['nombre'], 'extract', false);

	if (mysql_num_rows($busca) >0 ) {

			echo $mssg	=	'Ya existe este producto';

	} else {
		
		//$sql 	=	$Objsql->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		$sql 	=	mysql_query("Insert into ".$P_Tabla." (".$P_Campos.") values(".$P_Valores.")") or die(mysql_error());
		
		if ($sql) {

			echo $mssg 	=	'Se ingreso el registro con éxito';
		}

	}
}

// Edit
if ( $_GET['edit'] == 1 && $_GET['descripcion'] != '') {

	$rand 			=	rand('1234567890','0987654321');
   
    //echo $_FILES["file"]["name"];
	$temp 			= 	explode(".", $_FILES["file"]["name"]);

	$newfilename 	= 	$_SESSION['id_empresa'].'-'.$rand. '.' . $temp[1];

	$P_Valores 	= 	" barcode = '".$_GET['codigo_barra']."', description = '".$_GET['descripcion']."', inventory_min = '".$_GET['stock_minimo']."', price_in = '".$_GET['precio_costo']."', price_out = '".$_GET['precio_venta']."', quantity = '".$_GET['cantidad']."', category_id = '".$_GET['categoria']."', modify_at = '".date('Y-m-d H:i:s')."', activo = '".$_GET['activo']."'";
	$P_condicion=	" id = '".$_GET['id']."' and id_empresa = '".$_SESSION['id_empresa']."'";
	//$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	//echo "Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."";
	mysql_query("Update ".$P_Tabla." set ".$P_Valores." Where ".$P_condicion."") or die(mysql_error());
	echo $mssg 		=	'Se actualizo el registro con éxito';
}

// Delete 
if ( $_GET['delete'] == 1 ) {
	mysql_query("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'") or die(mysql_error());
	echo $mssg 		=	'Se elimino el registro con éxito';
}


?>