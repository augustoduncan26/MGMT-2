<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

  $sel        = mysql_query("Select * From usuarios");

?>
    <table id="list-table-users" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">
          
          <th>Nombre</th>
          <th>Usuario</th>
          <th>Email</th>
          <th>Activo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?> ><?=$datos->nombre;?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?> ><?=$datos->usuario;?></td>
          <td <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?> ><?=$datos->email;?></td>
          <td>
          <?php if ( $datos->activo == 1 ) { echo '<span class="label label-sm label-success">Active</span>'; } else { echo '<span class="label label-sm label-danger">Inactivo</span>'; }?></td>       
          <td class="" style="width:15% !important;" <?php if($datos->activo==0){?> class="row-yellow-transp" <?php } ?>>

            <a class="btn btn-xs btn-teal tooltips input-help" data-rel="tooltip" data-original-title="Detalle" title="Editar" data-toggle="modal" role="button" href="#edit_user" onclick="limpiar();editUser('<?php echo $datos->id_usuario; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-green tooltips" data-original-title="Permisos" title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiar();showUserPermisos('<?php echo $datos->id_usuario; ?>');"><i class="fa fa-key"></i></a>
            <a class="btn btn-xs btn-info tooltips" data-original-title="Enviar Email" title="Enviar email" data-toggle="modal" role="button" href="#user-send-email" onclick="limpiar(); sendEmailUser('<?php echo $datos->id_usuario; ?>');"><i class="fa fa-envelope-o"></i></a>
            
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos->id_usuario; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>

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

