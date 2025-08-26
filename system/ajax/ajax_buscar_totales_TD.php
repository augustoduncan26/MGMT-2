<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];


include_once ('../framework.php');

if ( $_SESSION["id_user"] ) {
	$sel_reservado   = mysql_query("Select COUNT(*) as total From $TblBooking Where color = '#FF0000' and id_user = '".$_SESSION['id_user']."' and DATE(fecha_e) >= '".$date."' and tipo = 'R' and activo = 1");
  
	if (mysql_num_rows($sel_reservado)>0) { $data_reservado = mysql_fetch_array($sel_reservado); }else{$data_reservado['total_reservado']=0;}

    echo $data_reservado['total'];
    
} else {
	echo "<script>location.href='login.php';</script>";
}
?>