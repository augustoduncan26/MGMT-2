<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante       = new Mantenimientos();
$ObjAttendance  = new Attendances();
$ObjEjec        = new ejecutorSQL();
$objPermOpc     = new permisos();
$id_rol     = $_SESSION["id_rol"];
$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'assignment';

// All
$selectClases   = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
$selectTeachers = $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_perfil =3 and activo = 1 and id_cia = '.$id_cia,'array');
$selectAssig    = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_cia = '.$id_cia,'array');
$assignment     = $ObjAttendance->showAll();