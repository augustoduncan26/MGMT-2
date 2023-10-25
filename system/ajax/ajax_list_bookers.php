<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

$ObjMante		=	new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$P_TBOOKERS = PREFIX.'bookers';

$datas      = $ObjMante->BuscarLoQueSea('*',$P_TBOOKERS,'id_empresa='.$id_empresa,'array');

?>
<div class="table-responsive">
    <table id="list-table-rooms" class="table table-striped table-bordered table-hover table-full-width">
      <thead>
        <tr class=""><!-- header-list-table -->
          <th>Nombre</th>
          <th>Porcentaje</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ( $datas['resultado'] as $data ) {
      ?>
        <tr>
          <td <?php if($data['active']==0){?> class="row-yellow-transp" <?php } ?>><?php echo $data['name'];?></td>
          <td <?php if($data['active']==0){?> class="row-yellow-transp" <?php } ?>><?php echo $data['porcentaje'];?></td>
          <td width="100px" <?php if($data['active']==0){?> class="row-yellow-transp" <?php } ?>><?php if($data['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td width="100px" class="" style="width:15% !important;">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_room" onclick="$('#txt_mssg-label').html(''); editBooker('<?php echo $data['id']; ?>');"><i class="fa fa-edit"></i></a>            
            <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { location.href='?Habitaciones/del=true/num=<?php echo rand(1970,1978)?>/id_st=9910810&amp;id_r=7228590'; } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { $('#txt_mssg-label').html(''); deleteRow('<?php echo $data['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
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