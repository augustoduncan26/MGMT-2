<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_rol     = $_SESSION["id_rol"];
$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'events';

// All
$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
$selectPerfiles= $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id <> 100 and activo = 1 and id_cia = '.$id_cia,'array');
$selectEventos = $ObjMante->BuscarLoQueSea('*',PREFIX.'events','id_cia = '.$id_cia,'array');

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] !='') {
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_cia="'.$id_cia.'" and name = "'.$_POST['r1'].'"','array');
	if ($_POST['r2'] =='') { $_POST['r2'] = 0;}
	if ($_POST['r4'] =='') { $_POST['r4'] = '00:00';}
	if ($_POST['r6'] =='') { $_POST['r6'] = '00:00';}

	if ($sql['total'] > 0 ) {
		echo 'error';
	} else {
		$P_Campos 	=	'id_cia,name,class,date_start,time_start,date_end,time_end,class_id,description,created_at,activo';
		$P_Valores 	=	"'".$id_cia."','".$_POST['r1']."','".$_POST['r2']."','".$_POST['r3']."','".$_POST['r4']."','".$_POST['r5']."','".$_POST['r6']."','".$_POST['r2']."','".$_POST['r8']."',NOW(),'".$_POST['r7']."'";
		$ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
		echo "ok";
	}
}

/**
 * Select All
*/
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
    $listEvents 	=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','name');
	if ($listEvents['total'] > 0) {
		foreach ($listEvents['resultado'] as $key => $datos) {
			$sel2 = $ObjMante->BuscarLoQueSea('class_name',PREFIX.'class','id='.$datos['class_id'],'extract','class_name');
	?>
		<tr>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo isset($sel2['class_name']) ? $sel2['class_name'] : '- - - - -';?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_start']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_start']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_end']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_end']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
			<td class="text-center" style="width:10% !important;">
			<a class="btn btn-xs btn-teal tooltips" title="Editar este registro" data-original-title="Ver Detalle" data-toggle="modal" role="button" data-target="#form_edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
			<a class="btn btn-xs btn-bricky tooltips" title="Eliminar este registro" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
			</td>
		</tr>
	<?php
		}
	}
}

/**
 * Show Edit Modal & info 
*/ 
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

/**
 * Edit
 */
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['r1'] !='') {
	if ($_POST['r4'] =='') { $_POST['r4'] = '00:00';}
	if ($_POST['r6'] =='') { $_POST['r6'] = '00:00';}
	if ($_POST['r7'] =='') { $_POST['r7'] = 0;}
	
	$perfilArr = false;

	if ($_POST['r9']) {
		foreach ($_POST['r9'] as $key => $value) {
			if($perfilArr != '') {
				$perfilArr .=  ',';
			}	
			$perfilArr		.=	 $value;
		}
	}

	$P_Valores = "name = '".$_POST['r1']."', time_start='".$_POST['r4']."', time_end='".$_POST['r6']."', activo = '".$_POST['r8']."', class_id='".$_POST['r7']."', perfil_id='".$perfilArr."', description = '".$_POST['r2']."'";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id = "'.$_POST['r_r'].'"');
	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

/**
 * Delete
 */
if ( isset($_POST['delete']) && $_POST['delete'] == 1 ) { 
	$r = $ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_POST['id']."' and id_cia='".$id_cia."'");
	if ($r == 1) {
		echo 'ok';
	} else {
		echo 'error';
	}
}

?>