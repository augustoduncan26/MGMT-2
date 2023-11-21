<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas','id_cia = '.$id_empresa,'array');

?>
<div class="table-responsive">
    <table id="list-table-direcciones" class="table table-striped table-bordered table-hover">
      <thead>
        <tr class=""><!-- header-list-table -->
          <th>Área</th>
          <?PHP 
          for($i	=	1	;	$i	<	32	;	$i++) {
            echo '<th width="30" data-orderable="false">'.$i.'</th>';	
          }
          ?>
          <th>Estado</th>
          <th>Fecha creación</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($sel1['resultado']){
          $i = 0;

          foreach ($sel1['resultado'] as $datos) {
            $depto  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id ='.$datos['id_depto'].'');
            $areas  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id IN ('.$datos['id_area'].')','array');
            $P_Data = "";
            $P_Data		=	false;
            $PCuantos	=	 count($areas['resultado']);
            for($i 	= 	0; $i < $PCuantos ; $i++) {	
              if($P_Data!='') {
                $P_Data .=  ', ';
              }
              $P_Data		.=	 $areas['resultado'][$i]['name'];
            }
      ?>
        <tr>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$depto['resultado'][0]['name']?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$P_Data?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['created_at']?></td>
          <td class="text-center" style="width:10% !important;">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
            </td>
        </tr>
     <?php
        }
      }
     ?>
       <tfoot>
         <tr></tr>
       </tfoot>
      </tbody>
    </table>
</div>