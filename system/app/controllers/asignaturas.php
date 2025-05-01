<?php

include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_rol     = $_SESSION["id_rol"];
$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla 	= PREFIX.'assignment';

// All
$selectClases  = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','activo = 1 and id_cia = '.$id_cia,'array');
$selectTeachers= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_perfil =3 and activo = 1 and id_cia = '.$id_cia,'array');
$selectAssig   = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_cia = '.$id_cia,'array');

/**
 * Add
 */
if ( isset($_POST['add']) && $_POST['add'] == 1 && $_POST['r1'] !='') {
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_cia="'.$id_cia.'" and name = "'.$_POST['r1'].'"','array');

	if ($sql['total'] > 0 ) {
		echo 'error';
	} else {
		$perfilArr = $_POST['r3'];
		$perfilArr1 = $_POST['r2'];

		// if ($_POST['r2'] && strlen($_POST['r2']) > 1) {
		// 	foreach ($_POST['r2'] as $key => $value) {
		// 		if($perfilArr1 != '') {
		// 			$perfilArr1 .=  ',';
		// 		}	
		// 		$perfilArr1		.=	 $value;
		// 	}
		// } else { $perfilArr1 = $_POST['r2'];}
		// if ($_POST['r3'] && strlen($_POST['r3']) > 1) {
		// 	foreach ($_POST['r3'] as $key => $value) {
		// 		if($perfilArr != '') {
		// 			$perfilArr .=  ',';
		// 		}	
		// 		$perfilArr		.=	 $value;
		// 	}
		// } else { $perfilArr = $_POST['r3'];}

		$P_Campos 	=	'id_cia,name,class_id,teacher_id,created_at,activo';
		$P_Valores 	=	"'".$id_cia."','".$_POST['r1']."','".$perfilArr1."','".$perfilArr."',NOW(),'".$_POST['r4']."'";
		$l = $ObjEjec->insertarRegistro($P_Tabla, $P_Campos, $P_Valores);
        if ($l) {
            echo "ok";
        } else {
            echo $l;
        }
	}
}

/**
 * List All
*/
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
    $listEvents 	=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','name');
	if ($listEvents['total'] > 0) {
		foreach ($listEvents['resultado'] as $key => $datos) {
			$sel3 = $ObjMante->BuscarLoQueSea('nombre,apellido',PREFIX.'usuarios','id_usuario='.$datos['teacher_id'],'extract',false);
			$resultClass = false;
			$r    = explode(',',$datos['class_id']);
			$tot  = count($r);
			for ($i = 0 ; $i < $tot+1; $i++) {
				if (isset($r[$i])) {
					$sel2 = $ObjMante->BuscarLoQueSea('class_name',PREFIX.'class','id='.$r[$i],'extract',false);
				if($resultClass != false) {
					$resultClass .=  ', ';
				}	
				$resultClass .=  $sel2['class_name'];
				$resultClass = rtrim($resultClass, ", ");
				}
			}
	?>
		<tr>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo $resultClass;?></td>
			<td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo $sel3['nombre'].' '.$sel3['apellido'];?></td>
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

// Edit 
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['r2'] !='') {
	$perfilArr = false;
	$perfilArr1 = false;

	if ($_POST['r3']) {
		foreach ($_POST['r3'] as $key => $value) {
			if($perfilArr1 != '') {
				$perfilArr1 .=  ',';
			}	
			$perfilArr1		.=	 $value;
		}
	}
	if ($_POST['r4']) {
		foreach ($_POST['r4'] as $key => $value) {
			if($perfilArr != '') {
				$perfilArr .=  ',';
			}	
			$perfilArr		.=	 $value;
		}
	}
	$P_Valores = "name = '".Reemplazar_letras($_POST['r2'])."', teacher_id='".$perfilArr."', class_id='".$perfilArr1."',  activo = '".$_POST['r5']."'";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id = "'.$_POST['r1'].'"');
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