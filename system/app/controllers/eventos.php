<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$ObjEvents  = new Events();
$objPermOpc = new permisos();
$id_rol     = $_SESSION["id_rol"];
$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'events';

// All
$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array','class_name,grade');
$selectPerfiles= $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id <> 100 and activo = 1 and id_cia = '.$id_cia,'array');
$selectEventos = $ObjEvents->list();

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] !='') {
	echo $ObjEvents->save ($_POST);
}

/**
 * Select All
*/
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$resultClass    = false;
	$where 			= 	'id_cia="'.$id_cia.'"';
    $listEvents 	=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','name');
	if ($listEvents['total'] > 0) {
		foreach ($listEvents['resultado'] as $key => $datos) {
			if ($datos['class_id']) {
				$expl = explode(',',$datos['class_id']);
				$tot  = count($expl);
				if ($tot > 1) {
				  for ($i=0;$i<$tot;$i++) { 
					$classes   = $ObjMante->BuscarLoQueSea('class_name,grade',PREFIX.'class','id='.$expl[$i],'extract');
					if ($classes) {
					  $resultClass .= $classes['class_name'].' '.$classes['grade'].'&deg;,';
					}
				  }
				  $resultClass = rtrim($resultClass, ", ");
				} else {
				  $classes    = $ObjMante->BuscarLoQueSea('class_name,grade',PREFIX.'class','id='.$datos['class_id'],'extract');
				  $resultClass= $classes['class_name'].' '.$classes['grade'].'&deg;';
				}
			  }
			  
			  if (empty($resultClass)) { $resultClass = '- - - -';}

	?>
		<tr>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$resultClass;?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_start']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_start']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_end']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_end']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
			<td class="text-center" style="width:10% !important;">
			<?php if(in_array('52', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-xs btn-teal tooltips" title="Editar este registro" data-original-title="Ver Detalle" data-toggle="modal" role="button" data-target="#form_edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a><?php } ?>
			<?php if(in_array('53', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-xs btn-bricky tooltips" title="Eliminar este registro" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a><?php } ?>
			</td>
		</tr>
	<?php
		}
	} else {
		echo '<tr><td colspan="8" class="text-center">Ningún dato disponible en esta tabla</td></tr>';
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

	$classArr = false;

	if ($_POST['r7']) {
		foreach ($_POST['r7'] as $key => $value) {
			if($classArr != '') {
				$classArr .=  ',';
			}	
			$classArr		.=	 $value;
		}
	}

	$P_Valores = "name = '".$_POST['r1']."', date_start='".$_POST['r3']."', time_start='T".$_POST['r4']."', date_end='".$_POST['r5']."', time_end='T".$_POST['r6']."', activo = '".$_POST['r8']."', class_id='".$classArr."', perfil_id='".$perfilArr."', tipo_color='".$_POST['r10']."', description = '".$_POST['r2']."'";
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