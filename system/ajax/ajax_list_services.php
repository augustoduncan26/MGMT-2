<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

  $sel        =   mysql_query("Select * From ad_tipo_servicio") or die(mysql_error());

?>
<div class="table-responsive">
    <table id="list-table-room" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">
          <th style="width:300px">Nombre</th>
          <th>Detalle</th>
          <th style="width:100px">Precio</th>
          <th style="width:100px">Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>

          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php echo $datos->name;?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php echo substr($datos->descripcion, 0,150).'...';?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php echo $datos->precio;?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">
            <?php ///if($datos->id != 1 && $datos->id !=2) { ?>
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_servicio" onclick="jQuery('#txt_mssg-label').html('');$('#label-mssg').html('');editServicio('<?php echo $datos->idTS; ?>');"><i class="fa fa-edit"></i></a>            <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->idTS; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
    
            <?php ///} ?>
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