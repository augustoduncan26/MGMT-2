<?php

$id_user    = $_GET['id_user'];
$id_cia     = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$sql       = $ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion',false,false,'permiso');
?>
  <table id="list-table-permisos" class="table table-striped table-bordered table-hover table-full-width" style=""><!--clear: both-->
     <thead>
        <tr class="header-list-table">
          <th >Nombre Permiso</th>
          <th style="width:180px">Permiso</th>
          <th style="width:180px">Permiso Padre</th>
          <th style="width:180px">Estado</th>
          <th style="width:180px"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        // if ($_SESSION['id_user'] < 7 ) {
        //   $sel = mysql_query("Select * From zz_permiso_definicion order by permiso ASC");
        // } else {
        //   $sel = mysql_query("Select * From zz_permiso_definicion Where permiso < 5000  order by permiso ASC");
        // }
        foreach ($sql['resultado'] as $key => $datos) {
        
        //while ( $datos = mysql_fetch_object($sel)) {
        ?>
             <tr>
             <td <?php if($datos['activo']==0){?> class="row-yellow-transp" <?php } ?>><label><?=$datos['nombre']?></label><input style="width:200px;border:0;background-color:rgba(0,0,0,0);" type="hidden" value="<?=$datos['nombre']?>" /></td>
                <td <?php if($datos['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['permiso']?><input style="width:100px;border:0;background-color:rgba(0,0,0,0);" type="hidden" value="<?=$datos['permiso']?>" /></td>
                <td <?php if($datos['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['permiso_padre']?></td>
                <td <?php if($datos['activo']==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos['activo']==1){ echo 'Activo'; } else { echo 'Inactivo';}?>
                <!-- <input style="width:100px;border:0;background-color:rgba(0,0,0,0);" type="number" value="<?=$dato['activo']?>" /> -->
                </td>
                <td class="text-center">
                  
                  <a class="btn btn-xs btn-teal tooltips" data-original-title="Detalle" data-toggle="modal" role="button" href="#edit_permiso" onclick="limpiar();editPermiso('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
          
                  <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deletePermiso('<?php echo $datos->id; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
    
                </td>
             </tr>
      <?php } ?>
        </tbody>
      </table>