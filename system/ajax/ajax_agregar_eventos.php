<?php

include_once ('../framework.php');

//$sql  = mysql_query("Select * From ad_tipo_habitacion Where activo = 1");
if ($_GET['dml']=='editar') {
  mysql_query("Update ad_eventos set nombre = '".$_GET['nombre']."', activo = '".$_GET['activo']."' Where id = '".$_GET['id']."'");
  echo 'Se ha actualizado el registro con éxito.';
}  else {
  $sql_insert   = mysql_query("Insert into ad_eventos (id_usuario,id_empresa,nombre,activo)
  values ('".$_SESSION['id_user']."','".$_SESSION['id_empresa']."','".$_GET['nombre']."',0)") or die(mysql_error());
}
?>
