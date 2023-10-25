<?php

include_once ('../framework.php');
$ObjMante		  =	new Mantenimientos();
$Objsql    		= 	new ejecutorSQL();
$P_TBOOKERS 	= 	PREFIX.'bookers';

$mssg = '';
$TblName      = 'ad_bookers';
$data         = $ObjMante->BuscarLoQueSea('*',$P_TBOOKERS,'id='.$_GET['id'],'extract');

if ( $data['name'] == '') {  $data['name'] = 0;}

?>
<form method="post">
             <table class="table table-bordered" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre:</td>
                   <td width="70%">
                   <input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$data['name']?>"></td>
                  <input type="hidden" name="id_row" id="id_row" value="<?=$data['id']?>">
                 </tr>

                  <tr>
                   <td width="30%">Porcentaje:</td>
                   <td width="70%">
                   <input autofocus="" name="txt_porcentaje" required="" type="text" class="form-control" id="txt_porcentaje" placeholder="Porcentaje" value="<?=$data['porcentaje']?>"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
                   <td>
                    <select name="txt_activo" id="txt_activo" class="form-control">
                      <option value="1" <?php if($data['active']==1) { echo 'selected';}?>>Activo</option>
                      <option value="0" <?php if($data['active']==0) { echo 'selected';}?>>Inactivo</option>
                    </select>
                   </td>
                 </tr>
               </tbody>
               <tfoot>
                 <tr>
                 <td colspan="2">  
                 </td>
                 </tr>
               </tfoot>
             </table>
             </form>
