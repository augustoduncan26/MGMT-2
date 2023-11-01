<?php
$id_user    = $_GET['id_user'];
$id_cia     = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$datos       = $ObjMante->BuscarLoQueSea('*',PREFIX.'users','id_cia = '.$id_cia,'array');

?>
    <table id="list-table-users" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class="header-list-table">
          <th>Nombre</th>
          <th>Email</th>
		      <th>Telefono</th>
          <th>Departamento</th>
          <th>Dirección</th>
          <th style="width: 200px">Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ( $datos['resultado'] as $key => $dato) {
          
          $depto       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id = "'.$dato['id_depto'].'" and id_cia = '.$id_cia,'extract');
      ?>
        <tr>
          <td width="150px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$dato['nombre']?></td>
          <td width="150px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$dato['email']?></td>

          <td width="150px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$dato['telephone']?></td>
          <td width="150px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$depto['name']?></td>
          <td width="150px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?=$dato['direcction']?></td>
          <td width="100px" <?php if($dato['activo']==0){?> class="row-yellow-transp" <?php } ?>><?php if($dato['activo'] ==1) { echo '<span class="label label-sm label-success">Active</span>'; } else { echo '<span class="label label-sm label-danger">Inactivo</span>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">

            <a class="btn btn-xs btn-teal " data-original-title="Editar" data-toggle="modal" role="button" href="#edit_usuarios" onclick="limpiar();editUser('<?php echo $dato['id_usuario']; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiar();showUserPermisos('<?php echo $dato['id_usuario']; ?>');"><i class="fa fa-key"></i></a>
            <a class="btn btn-xs btn-bricky " data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $dato['id_usuario']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>

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