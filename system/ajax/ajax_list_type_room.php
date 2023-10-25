<?php
$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
//include_once ('../class/clase_mantenimiento.php');
$ObjMante   = new Mantenimientos();
$type_roomes= $ObjMante->BuscarLoQueSea('*',PREFIX.'rooms_type','id_empresa = '.$id_empresa,'array');

?>
<div class="table-responsive">
    <table id="list-table-rooms" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class=""><!-- header-list-table -->
          <th>Nombre</th>
          <th>Código</th>
          <th>Capacidad</th>
          <th>Capacidad Max</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($type_roomes['resultado'] as $datos) {
      ?>
        <tr>
         
          <td <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['nombre']?></td>
          <td width="100px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['code']?></td>
          <td width="100px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['capacidad']?></td>
          <td width="130px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['capacidad_max']?></td>
          <td width="100px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="80px" class="" style="width:15% !important;">
            <a class="btn btn-xs btn-teal tooltips" title="Editar este registro" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="$('#txt_mssg-label').html('');editRoom('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" title="Eliminar este registro" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
            </td>
        </tr>
     <?php
        }
     ?>
       <tfoot>
         <tr></tr>
       </tfoot>
      </tbody>
    </table>
</div>