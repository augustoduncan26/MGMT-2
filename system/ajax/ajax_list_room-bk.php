<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
//include_once ('../class/clase_mantenimiento.php');
//$ObjMante   = new Mantenimientos();
if ($id_user == 1 || $id_user == 2) {
  $sel        = mysql_query("Select * From ad_habitaciones");
} else {
  $sel        = mysql_query("Select * From ad_".$id_user."_habitaciones");
}

//echo mysql_num_rows($sel);

?>
    <table id="list-table-room" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">

          <th>Nombre</th>
          <th>Tipo</th>
          <th>Total Camas</th>
          <th>Precio</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>

          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->codigo?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php
            $data_tipo   = mysql_fetch_object(mysql_query("Select * From ad_tipo_habitacion Where id  = '".$datos->tipo_habita."' and activo = 1"));
            echo $data_tipo->nombre;
          ?>

          </td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->total_beds?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->price?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">
            <?php ///if($datos->id != 1 && $datos->id !=2) { ?>
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editRoom('<?php echo $datos->id; ?>');"><i class="fa fa-edit"></i></a>

            <?php if($datos->cleaning ==1) { ?>
            <a class="btn btn-xs btn-aspirador tooltips" href="#"><img title="Habitación en limpieza" src="<?=get_asset_dir()?>/images/icono_aspirador.png"></a>
            <?php } ?>

            <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->id; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
    
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
