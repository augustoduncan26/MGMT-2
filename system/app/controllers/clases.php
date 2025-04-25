<?php
// if(!defined('MyConst')) {
//     die('Direct access not permitted');
//  }
//  define('MyConst', TRUE);
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
include_once ( dirname(dirname(__DIR__)) . '/functions.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$id_user    = $_SESSION["id_user"];
$id_cia 	= $_SESSION['id_cia'];
$email 		= $_SESSION['email'];
$username 	= $_SESSION['username'];
$P_Tabla    = PREFIX.'class';
//$lastname 	= $_SESSION['apellido'];


// All
$selectAll      = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_cia = '.$id_cia,'array','class_name');

// $r = mysqli_query($linkServidor,"SELECT * FROM ".PREFIX."usuarios u 
// LEFT JOIN ".PREFIX."class c
// ON c.supervisor_id = u.id_perfil 
// WHERE u.id_cia = '".$id_cia."'");// or die(mysqli_error($linkServidor));

// $list  = mysqli_query($linkServidor,"SELECT ".$PCampos."fd.* FROM ".PREFIX."mant_formulas_detalle fd
// LEFT JOIN ".PREFIX."mant_formulas f ON f.id_detalle = fd.id 
// Where fd.id_cia = ".$id_cia." order by fila ASC");
// $tot = mysqli_num_rows($list);

//echo "<pre>";
//var_dump($r);

$selecPerfiles  = $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id_cia = '.$id_cia,'array');
$selecUsers     = $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','(id_perfil = 3 or id_perfil = 5) and id_cia = '.$id_cia,'array');


// Add
if ( isset($_GET['add']) && $_GET['add'] == 1 && $_GET['nombre'] != '') {
	$sql 			=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,'class_name="'.$_GET['nombre'].'" and id_cia="'.$id_cia.'"','array');
	if ($sql['total'] > 0 ) {
		echo 'Ya existe este registro.';
	} else {
		$P_Valores 	= 	"'".$_GET['nombre']."','".$_GET['cantidad']."','".$_GET['superv']."','".$_GET['grado']."','".$id_cia."',NOW(),NOW(),'".$_GET['estado']."'";
		$sql 		=	$ObjEjec->insertarRegistro($P_Tabla, 'class_name,capacity,supervisor_id,grade,id_cia,created_at,updated_at,activo', $P_Valores);
		echo 'Se ingreso el registro con éxito';
	}
}

// Select All
if (isset($_GET['all']) && $_GET['all'] == 1) {
	$where 			= 	'id_cia="'.$id_cia.'"';
    $listPerfiles 	=	$ObjMante->BuscarLoQueSea('*',$P_Tabla,$where,'array','class_name');
    foreach ($listPerfiles['resultado'] as $key => $datos) {
        $sel2 = $ObjMante->BuscarLoQueSea('nombre,apellido',PREFIX.'usuarios','id_perfil='.$datos['supervisor_id'],'extract','nombre');
        ?>
        <tr>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_name']?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['capacity']?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['grade']?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$sel2['nombre']?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
            <td class="text-center" style="width:10% !important;">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
            </td>
        </tr>
        <?php
    }
    //echo json_encode($list);
}

// Show Edit Modal & info
if (isset($_GET['showEdit']) && $_GET['id'] != "") {
	$data       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
	echo json_encode($data);
}

// Edit 
if ( isset($_POST['edit']) && $_POST['edit'] == 1 && $_POST['nombre'] !='') {
	$P_Valores = "class_name = '".Reemplazar_letras($_POST['nombre'])."', capacity='".$_POST['cantidad']."', supervisor_id='".$_POST['superv']."', grade='".$_POST['grado']."', activo = '".$_POST['estado']."', updated_at=NOW()";
	$l = $ObjEjec->actualizarRegistro($P_Valores, $P_Tabla, 'id = "'.$_POST['id'].'"');
  	if($l == 1){
		echo 'ok';
	} else {
		echo 'error';
	}
}

// Delete 
if ( isset($_GET['del']) && $_GET['del'] == 1 ) { 
	$ObjEjec->ejecutarSQL("Delete from ".$P_Tabla." Where id = '".$_GET['id']."'");
	echo $mssg 		=	'<div class="alert alert-danger">Se elimino el registro con éxito</div>';
}

?>