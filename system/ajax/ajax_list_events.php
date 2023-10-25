<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'events','id_empresa = '.$id_empresa,'array');

?>
<div class="table-responsive">
    <table id="list-table-events" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class=""><!-- header-list-table -->
          <!-- <th style="width:10px"><input type="checkbox" /></th> -->
          <th>Nombre</th>
          <th>Precio</th> 
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($sel1['resultado']){
          foreach ($sel1['resultado'] as $datos) {
      ?>
        <tr>
          <!-- <td><input type="checkbox" /></td> -->
          <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['nombre']?></td>
          <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['precio']?></td>
          <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td class="text-center" style="width:10% !important;">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editEvent('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
            </td>
        </tr>
     <?php
        }
      }
     ?>
       <tfoot>
         <tr></tr>
       </tfoot>
      </tbody>
    </table>
</div>