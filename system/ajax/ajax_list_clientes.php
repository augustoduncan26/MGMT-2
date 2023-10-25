<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
include_once ('../class/clase_mantenimiento.php');
$ObjMante   = new Mantenimientos();

if ($id_user == 1 || $id_user == 2) {
  $sel        = mysql_query("Select * From fact_clientes");
} else {
  $sel        = mysql_query("Select * From fact_clientes Where id_empresa = '".$id_empresa."'");
}

//echo mysql_num_rows($sel);
/*
width: 100%;
margin-bottom: 15px;
overflow-y: hidden;
-ms-overflow-style: -ms-autohiding-scrollbar;
border: 1px solid #ddd;


min-height: .01%;
overflow-x: auto;
 */
?>
<div class="table-responsive">
    <table id="list-table-room" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class="header-list-table">

          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Email</th>
          <!-- <th>Dirección</th> -->
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>

          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->nombre_cliente?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->telefono_cliente;
          ?>

          </td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->email_cliente?></td>
          <!-- <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->direccion_cliente?></td> -->
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">
            <?php ///if($datos->id != 1 && $datos->id !=2) { ?>
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editCliente('<?php echo $datos->id_cliente; ?>');"><i class="fa fa-edit"></i></a>

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
</div>