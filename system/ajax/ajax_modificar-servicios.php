<?php
//echo $_GET['id_user'];
include_once ('../framework.php');

$sql  = mysql_query("Select * From ad_tipo_servicio");

$mssg = '';

$TblName      = 'ad_tipo_servicio';

$sql_hab      = mysql_query("Select * From ".$TblName." Where idTS = '".$_GET['id']."'")or die(mysql_error());
$data        = mysql_fetch_object($sql_hab);

if ( $data->name == '') {  $data->name = 0;}

?>
<form method="post">
             <table class="table table-bordered" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre:</td>
                   <td width="70%"><input autofocus="" name="nombre_editar" required="" type="text" class="form-control" id="nombre_editar" placeholder="Nombre" value="<?=$data->name?>"></td>
                   <input type="hidden" name="id_row" id="id_row" value="<?php echo $data->idTS;?>">
                 </tr>
                 <tr>
                   <td width="30%" valign="top">Detalle:</td>
                   <td width="70%"><textarea id="detalle_editar" class="form-control" name="detalle_editar" row="2" col="5" ><?=$data->descripcion?></textarea></td>
                 </tr>
                 <tr>
                   <td width="30%">Precio:</td>
                   <td width="70%"><input autofocus="" name="precio_editar" type="number" step="1" min="1" required="" class="form-control" id="precio_editar" placeholder="Precio" value="<?=$data->precio?>"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
                   <td>
                    <select name="estado_editar" id="estado_editar" class="form-control">
                      <option value="1" <?php if($data->activo==1) { echo 'selected';}?>>Activo</option>
                      <option value="0" <?php if($data->activo==0) { echo 'selected';}?>>Inactivo</option>
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
