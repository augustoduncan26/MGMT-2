<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

//include_once ('../class/clase_mantenimiento.php');
//$ObjMante   = new Mantenimientos();
if ($id_user == 1 || $id_user == 2) {
  $sel        = mysql_query("Select * From ".$caja_prefix."category");
} else {
  $sel        = mysql_query("Select * From ".$caja_prefix."category Where id_empresa = '".$id_empresa."'");
}

//echo mysql_num_rows($sel);

?>
    <table id="list-table-room" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">

          <!-- <th>Imagen</th> -->
          <!-- <th>Tipo</th> -->
          <th>Nombre</th>
<!--           <th>Descripción</th> -->
          <th style="width: 200px">Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>

         
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->name?></td>

          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">

            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editCategory('<?php echo $datos->id; ?>');"><i class="fa fa-edit"></i></a>
            <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->id; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>

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
