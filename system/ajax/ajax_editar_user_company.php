<?php
include_once ('../framework.php');

$sel  = mysql_query("Select * From usuarios Where id_usuario = '".$_GET['id']."'");
$data = mysql_fetch_object($sel);
?>

<table class="table table-bordered table-hover" id="sample-table-4">
   <tbody>
     <tr>
       <td width="30%">Nombre completo</td>
       <td width="70%"><input autofocus="" name="txt_nombre" required maxlength="40" type="text" class="form-control" id="txt_nombre" value="<?=$data->nombre?>" placeholder="Nombre Completo">
       <input type="hidden" name="id_row" id="id_row" value="<?=$data->id_usuario?>"></td>
     </tr>
     <tr>
       <td>Email</td>
       <td><input name="email" type="email" required maxlength="50" class="form-control" id="txt_email" placeholder="Email" value="<?=$data->email?>">
       </td>
     </tr>
     <tr>
       <td>Telfono</td>
       <td><input name="telefono" type="text" maxlength="30" class="form-control" id="txt_telefono" placeholder="Teléfono" value="<?=$data->telephone?>"></td>
     </tr>

     <tr>
       <td>Dirección</td>
       <td><input name="direccion" type="text" maxlength="100" class="form-control" id="txt_direccion" placeholder="Dirección" value="<?=$data->description?>"></td>
     </tr>

     <tr>
       <td>Cambiar contraseña</td>
       <td><input name="contrasena" type="password" maxlength="100" class="form-control" id="txt_contrasena" placeholder="Contraseña" value="">
       <label style="color:red; size: 10px">Dejar en blanco, si no desea cambiar la contraseña</label></td>
     </tr>

     <tr>
       <td>Estado</td>
       <td>
        <select name="estado" id="txt_estado" class="form-control">
          <option value="1" <?php if($data->activo == 1) { echo 'selected';}?>>Activo</option>
          <option value="0" <?php if($data->activo == 0) { echo 'selected';}?>>Inactivo</option>
        </select>
       </td>
     </tr>
                           
   </tbody>
 </table>