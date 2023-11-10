<?php
$id_user    = $_GET['id'];
$id_cia     = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'users','id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
$deptos     = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id_cia = '.$id_cia,'array');

?>

<table class="table table-bordered table-hover" id="sample-table-4">
   <tbody>
     <tr>
       <td width="30%">Nombre completo</td>
       <td width="70%"><input autofocus="" name="txt_nombre" required maxlength="40" type="text" class="form-control" id="txt_nombre" value="<?=$data['nombre']?>" placeholder="Nombre Completo">
       <input type="hidden" name="id_row" id="id_row" value="<?=$data['id_usuario']?>"></td>
     </tr>
     <tr>
       <td>Email</td>
       <td><input name="email" type="email" required maxlength="50" class="form-control" id="txt_email" placeholder="Email" value="<?=$data['email']?>">
       </td>
     </tr>
     <tr>
       <td>Departamento</td>
       <td>
        <select name="deptoEditar" class="form-control" id="txt_depto">
          <option value='s'></option>
        <?php
          foreach ($deptos['resultado'] as $key => $depto) {
            if ($depto['id'] == $data['id_depto']) {
              echo "<option selected value='".$depto['id']."'>".$depto['name']."</option>";
            } else {
              echo "<option value='".$depto['id']."'>".$depto['name']."</option>";
            }
          }
        ?> 
        </select>
       <!-- <input name="depto" type="text" maxlength="30" class="form-control" id="txt_depto" placeholder="Departamento" value="<?=$depto['name']?>"> -->
      </td>
     </tr>
     <tr>
       <td>Telfono</td>
       <td><input name="telefono" type="text" maxlength="30" class="form-control" id="txt_telefono" placeholder="Teléfono" value="<?=$data['telephone']?>"></td>
     </tr>

     <tr>
       <td>Dirección</td>
       <td><input name="direccion" type="text" maxlength="100" class="form-control" id="txt_direccion" placeholder="Dirección" value="<?=$data['direcction']?>"></td>
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
          <option value="1" <?php if($data['activo'] == 1) { echo 'selected';}?>>Activo</option>
          <option value="0" <?php if($data['activo'] == 0) { echo 'selected';}?>>Inactivo</option>
        </select>
       </td>
     </tr>
                           
   </tbody>
 </table>

 <script>$("[name='deptoEditar']").select2({ width: '100%', dropdownCssClass: "bigdrop"});</script>