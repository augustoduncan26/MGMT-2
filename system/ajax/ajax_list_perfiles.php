<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

  $sel        = mysql_query("Select * From ad_perfil");

?>
    <table id="list-table-users" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class="header-list-table">
          
          <th>Nombre de perfil</th>
          <th>ID perfil</th>
          <th>Activo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>
          <td><?=$datos->perfil;?></td>
          <td><?=$datos->id_perfil;?></td>
          <td><?php if ( $datos->activo == 1 ) { echo 'Activo'; } else { echo 'Inactivo'; }?></td>       
          <td class="" style="width:15% !important;">

            <a class="btn btn-xs btn-teal tooltips input-help" data-rel="tooltip" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="editPerfil('<?php echo $datos->id_perfil; ?>');"><i class="fa fa-edit"></i></a>
            <!-- <a class="btn btn-xs btn-green tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#user-permission" onclick="editRoom('<?php echo $datos->id; ?>');"><i class="fa fa-key"></i></a>
            <a class="btn btn-xs btn-info tooltips" data-original-title="Enviar Email" data-toggle="modal" role="button" href="#user-permission" onclick="editRoom('<?php echo $datos->id; ?>');"><i class="fa fa-envelope-o"></i></a>
             -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>

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

