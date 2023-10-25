<?php
include "config.php";

if($_SESSION['id_user']==1 || $_SESSION['id_user'] == 2):
	$TblRooms		  =	'ad_habitaciones';
	$TblBeds		  =	'ad_beds';
	$TblBooking		=	'ad_reservas';
;else:
	$TblRooms		  =	'ad_'.$_SESSION['id_user'].'_habitaciones';
	$TblBeds		  =	'ad_'.$_SESSION['id_user'].'_beds';
	$TblBooking		=	'ad_'.$_SESSION['id_user'].'_reservas';
endif;


$departid = $_POST['depart'];   // department id

$sql = "SELECT id,name FROM ".$TblRooms." WHERE id = ".$departid;

$result = mysqli_query($con,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['id'];
    $name = $row['codigo'];

    $users_arr[] = array("id" => $userid, "name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
