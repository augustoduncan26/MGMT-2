<?php

include_once ('../framework.php');

$TblName      = 'zz_permiso_definicion';

$sql_hab      = mysql_query("Select * From ".$TblName." Where id = '".$_GET['id']."'")or die(mysql_error());
$data         = mysql_fetch_object($sql_hab);

?>
<form method="post">
   <table class="table table-bordered" id="sample-table-4">
     <thead>
     </thead>
     <tbody>
       <tr>
         <td width="30%">Nombre:</td>
         <td width="70%"><input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$data->nombre;?>"></td>
         <input type="hidden" name="id_row" id="id_row" value="<?php echo $data->id;?>">
       </tr>
       <tr>
         <td width="30%">Permiso padre</td>
         <td width="70%"><input autofocus="" name="txt_permiso_padre" type="number" step="1" min="1" required="" class="form-control" id="txt_permiso_padre" placeholder="Permiso padre" value="<?=$data->permiso_padre;?>"></td>
       </tr>
       <tr>
         <td width="30%">Permiso</td>
         <td width="70%"><input autofocus="" name="txt_permiso" type="number" step="1" min="1" required="" class="form-control" id="txt_permiso" placeholder="Permiso" value="<?=$data->permiso;?>"></td>
       </tr>
       <tr>
         <td>Estado</td>
         <td>
          <select name="txt_estado" id="txt_estado" class="form-control">
            <option value="1" <?php if ($data->activo == 1) { echo 'selected'; } ?>>Activo</option>
            <option value="0" <?php if ($data->activo == 0) { echo 'selected'; } ?>>Inactivo</option>
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
