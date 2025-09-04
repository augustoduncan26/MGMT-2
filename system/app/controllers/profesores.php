<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$ObjAssignm = new Assignments();

$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'assoc_teacher_assignment';

/**
 * Show All
 */
$sqlAssignment 		= $ObjAssignm->listAssignments();
$selectPerfil   	= $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles',' (name like "%profesor%" or name like "%teacher%") and activo = 1 and id_cia = '.$id_cia,'extract');
$selectTeachers 	= false;
if (isset($selectPerfil)) {
	$selectTeachers   	= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_perfil = "'.$selectPerfil['id'].'" and activo = 1 and id_cia = '.$id_cia,'array');
}

$selectClases       = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
$selectAssignment   = $ObjMante->BuscarLoQueSea('*',PREFIX.'assignment','activo = 1 and id_cia = '.$id_cia,'array');

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] !='') {
	echo $ObjAssignm->save($_POST);
}

/**
 * Select All
*/
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$ObjAssignm->showAll();
}

/**
 * Show Edit Modal & info 
*/ 
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data 		= $ObjAssignm->listAssignmentsById($_GET['id']);
	echo json_encode($data);
}

/**
 * Update
 */
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['r1'] !='') {
	echo $ObjAssignm->update($_POST);
}

/**
 * Delete
 */
if ( isset($_POST['delete']) && $_POST['delete'] == 1 ) {
	echo $ObjAssignm->delete($_POST['id']);
}

?>