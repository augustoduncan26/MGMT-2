<?php

$id_user    = $_GET['id_user'];
$id_cia = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_tipos_horarios','id_cia = '.$id_cia,'array');

?>
<div class="table-responsive">
    <table id="list-table-direcciones" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class=""><!-- header-list-table -->
          <!-- <th>Nombre</th> -->
          <th>Hora desde</th>
          <th>Hora hasta</th>
          <th>Estado</th>
          <th>Fecha creación</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($sel1['resultado']){
          foreach ($sel1['resultado'] as $datos) {
            //$deptoName  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id = '.$datos['id_depto'].'','extract');
            //$areaName   = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id = '.$datos['id_area'].'','extract');
            
      ?>
        <tr>
          <!-- <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td> -->
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['hora_desde']?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['hora_hasta']?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['created_at']?></td>
          <td class="text-center" style="width:10% !important;">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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