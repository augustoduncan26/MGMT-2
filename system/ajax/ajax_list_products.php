<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

$PTabla     = 'fact_products';

//include_once ('../class/clase_mantenimiento.php');
//$ObjMante   = new Mantenimientos();

if ($id_user == 1 || $id_user == 2) {
  $sel        = mysql_query("Select * From ".$PTabla."");
} else {
  $sel        = mysql_query("Select * From ".$PTabla." Where id_empresa = '".$id_empresa."'");
}

?>
<div class="row">
<div class="table-responsive">
    <table id="list-table-products" class="table table-striped table-bordered table-hover table-full-width dataTable">
      <thead>
        <tr class="header-list-table">

          <th style="width: 130px">Imagen</th>
          <th style="width: 300px">Descripción</th>
          <th style="width: 150px">Precio Compra</th>
          <th style="width: 150px">Precio Venta</th>
          <th style="width: 100px">Cantidad</th>
          <th style="width: 100px">Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp  text-center" <?php } else { ?> class=" text-center" <?php } ?>>
          <?php if ($datos->image == '') { $datos->image = 'nodisponible.png'; } 
              //echo isset($datos->image)?$datos->image:'---';?>
                
          <img src="images/products-images/<?=$datos->image?>" border="1" style="width: 50px; height: 50px">
          
          </td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->description?></td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->price_in?></td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->price_out?></td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->quantity?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">

            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editProduct('<?php echo $datos->id; ?>');"><i class="fa fa-edit"></i></a>
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
</div>
</div>
