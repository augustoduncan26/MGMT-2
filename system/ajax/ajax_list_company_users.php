<?php
$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

  $sel        = mysql_query("Select * From usuarios Where id_empresa = '".$id_empresa."' and id_usuario <> '".$id_user."'");

?>
    <table id="list-table-users" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">

          <th>Nombre</th>
          <th>Email</th>
		  <th>Telefono</th>
          <th style="width: 200px">Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->nombre?></td>
          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->email?></td>

          <td width="150px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?=$datos->telephone?></td>
          <td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>><?php if($datos->activo ==1) { echo '<span class="label label-sm label-success">Active</span>'; } else { echo '<span class="label label-sm label-danger">Inactivo</span>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">

            <a class="btn btn-xs btn-teal tooltips" data-original-title="Editar" data-toggle="modal" role="button" href="#edit_usuarios" onclick="limpiar();editUser('<?php echo $datos->id_usuario; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-green tooltips" data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiar();showUserPermisos('<?php echo $datos->id_usuario; ?>');"><i class="fa fa-key"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->id_usuario; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>

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