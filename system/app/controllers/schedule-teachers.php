<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_rol     = $_SESSION["id_rol"];
$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'planner';

// Search in planning
$events = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'activo=1 and id_cia='.$_SESSION['id_cia'],'array');
$events = $events['resultado'];//$req->fetchAll(PDO::FETCH_ASSOC);
$date   = date('Y-m-d');

