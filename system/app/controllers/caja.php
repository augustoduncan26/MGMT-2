<?php

include_once ('../../framework.php');

if ($_SESSION['id_empresa'] == 1 || $_SESSION['id_empresa'] == 2) {

  $selProductos     = 	mysql_num_rows(mysql_query("Select * From fact_products Where id_empresa = '".$_SESSION['id_empresa']."' "))or die(mysql_error());
  $selClientes     	= 	mysql_num_rows(mysql_query("Select * From fact_clientes  Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1"))or die(mysql_error());
  $selProveedores   = 	mysql_query("Select * From caja_proveedores Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1")or die(mysql_error());
  $totProveedores  	=	mysql_num_rows($selProveedores);
  $selCat     		= 	mysql_query("Select * From caja_category");
  $totCategorias  	=	mysql_num_rows($selCat);
  $selFact     		= 	mysql_query("Select * From facturas Where id_empresa = '".$_SESSION['id_empresa']."'");
  $totselFacturas  	=	mysql_num_rows($selFact);

} else {
  
  $selCat     = mysql_query("Select * From caja_category Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1");

}

?>