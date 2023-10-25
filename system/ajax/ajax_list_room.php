<?php
$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();

$sel       = $ObjMante->BuscarLoQueSea('*',PREFIX.'rooms','id_empresa = '.$id_empresa,'array');

?>
<div class="table-responsive">
    <table id="list-table-rooms" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class=""><!-- header-list-table -->
          <th>Nombre</th>
          <th>Tipo de Habitación</th>
          <th>Total Camas</th> 
          <th>Precio</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($sel['resultado'] as $datos) {
      ?>
        <tr>
          <td <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['code']?></td>
          <?php
            $type_room   = $ObjMante->BuscarLoQueSea('*',PREFIX.'rooms_type','id = '.$datos['type_room'].' and id_empresa = '.$id_empresa,'extract');
          ?>

          </td>
          <td width="250px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$type_room['nombre']?></td>
          <td width="150px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['total_beds']?></td>
          <td width="100px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?=$datos['price']?></td>
          <td width="100px" <?php if($datos['active']==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">
            <a class="btn btn-xs btn-teal tooltips" title="Ver registro" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="$('#txt_mssg-label').html('');editRoom('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
            <?php if($datos['cleaning'] ==1) { ?>
            <a class="btn btn-xs btn-aspirador tooltips" href="#"><img title="Habitación en limpieza" src="assets/images/icono_aspirador.png"></a>
            <?php } ?>
            <a class="btn btn-xs btn-bricky tooltips" title="Eliminar registro" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
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