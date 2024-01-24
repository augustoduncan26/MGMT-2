<?php

$id_user    = $_GET['id_user'];
$id_cia     = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$sel1       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_formulas','id_cia = '.$id_cia,'array');

$PCampos = false;
for ($i = 1; $i < 32 ; $i++) {
  $PCampos .= "f.c".$i.",";
}

$list  = mysqli_query($linkServidor,"SELECT ".$PCampos."fd.* FROM ".PREFIX."mant_formulas_detalle fd
LEFT JOIN ".PREFIX."mant_formulas f ON f.id_detalle = fd.id 
Where fd.id_cia = ".$id_cia." order by fila ASC");
$tot = mysqli_num_rows($list);

$daysInMonth= date('t');

?>
<style>
  th {
    font-size: 11px;
    color: #696969;
  }
</style>
<div class="table-responsive" style="">
    <table id="list-table-formulas" class="table table-striped table-bordered table-hover" style='width:100%'>
      <thead>
        <tr class=""><!-- header-list-table -->
          <th width="20%">Descripción&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th width="20%">Departamento</th>
          <th width="20%">Área</th>
          <?PHP 
          for($i	=	1	;	$i	<	32	;	$i++) {
            echo '<th style="width:50px !important" data-orderable="false" title="Día '.$i.'">D'.$i.'</th>';	
          }
          ?>
          <th width="20%">Estado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <!-- <th width="10%">Fecha</th> -->
          <td style="width:500px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Opciones&nbsp;&nbsp;&nbsp;&nbsp; </td>
        </tr>
      </thead>
      <tbody>
      <?php
        //if ($sel1['resultado']){
        if ($tot > 0) {
          $i = 0;

          //foreach ($sel1['resultado'] as $datos) {
            while ( $datos = mysqli_fetch_array($list) ) {
            $depto  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id ='.$datos['id_depto'].'','extract');
            $areas  = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id IN ('.$datos['id_area'].')','array');
            
            $date   = explode(" ",$datos['created_at']);
            
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
          <td style="width:400px"  <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['descripcion']?></td>
          <td style="width:400px"  <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$depto['name']?></td>
          <td style="width:400px" <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$P_Data?>&nbsp;&nbsp;&nbsp;</td>

          <?PHP 
          for($i	=	1	;	$i	<	32	;	$i++) {
            if($datos['active']==0) { $class = 'class="row-yellow-transp"'; } else { $class = "class=''"; }
            echo '<td width="10%" '.$class.' data-orderable="false" style="font-size:11px;color:#696969">&nbsp;'.$datos['c'.$i].'&nbsp;</td>';	
          }
          ?>

          <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['active'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
          <!-- <td <?php if($datos['active']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$date[0]?></td> -->
          <td width="20%" class="text-center">
          <?php ?>
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
          <?php ?>
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