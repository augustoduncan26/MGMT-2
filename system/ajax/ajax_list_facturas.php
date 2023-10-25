<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

$sel        = mysql_query("Select * From ad_facturas Where id_vendedor = '".$id_empresa."' ");

?>
    <table id="list-table-facturas" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">

          <th>id factura</th>
          <th>N° Factura</th>
          <th>Cliente</th>
          <th>Estado</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>

          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->id_factura?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php echo $datos->numero_factura;?></td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->cliente?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->estado_factura?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->total_venta?></td>
          <td width="100px" class="" style="width:15% !important;">
            <?php ///if($datos->id != 1 && $datos->id !=2) { ?>
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editRoom('<?php echo $datos->id_factura; ?>');"><i class="fa fa-edit"></i></a>


            <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->id_factura; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
    
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
