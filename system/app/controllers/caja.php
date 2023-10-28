<?php
//include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

if ($_SESSION['id_empresa'] == 1 || $_SESSION['id_empresa'] == 2) {

  // $sql1             =   mysqli_query($linkServidor,"Select * From fact_products Where id_empresa = '".$_SESSION['id_empresa']."' ");
  // $selProductos     = 	mysqli_num_rows($sql1);

  $sql 		          = $ObjMante->BuscarLoQueSea('*',PREFIX_FACT.'products','id_empresa = "'.$_SESSION['id_empresa'].'"','array');
  $selProductos     = $sql['total'];
  $sql2 		        = $ObjMante->BuscarLoQueSea('*',PREFIX_FACT.'clientes','id_empresa = "'.$_SESSION['id_empresa'].'" and activo = 1','array');
  $selClientes     	= $sql2['total'];


  //$selClientes     	= 	mysqli_num_rows(mysqli_query($link,"Select * From fact_clientes  Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1"))or die(mysqli_error(link));
  // $selProveedores   = 	mysqli_query($link,"Select * From caja_proveedores Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1")or die(mysqli_error(link));
  // $totProveedores  	=	mysqli_num_rows($selProveedores);
  // $selCat     		= 	mysqli_query($link,"Select * From caja_category");
  // $totCategorias  	=	mysqli_num_rows($selCat);
  // $selFact     		= 	mysqli_query($link,"Select * From facturas Where id_empresa = '".$_SESSION['id_empresa']."'");
  // $totselFacturas  	=	mysqli_num_rows($selFact);

} else {
  
  $selCat     = mysqli_query($link,"Select * From caja_category Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1");

}

?>