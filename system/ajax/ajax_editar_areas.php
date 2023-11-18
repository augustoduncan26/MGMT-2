<?php

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_areas','id = '.$_GET['id'],'extract');
$typeDeptos = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id_cia = '.$_SESSION['id_empresa'].' and active=1','array');

?>

<div id="mssg-edit" style="color:red"></div>
<table class="table table-bordered" id="sample-table-4">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Nombre: <span class="symbol required"></span></td>
      <td width="70%" colspan="3"><input autofocus="" name="nombre" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?php echo $data['name']; ?>">
      <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="Nombre" value="<?php echo $data['id']; ?>">
      </td>
    </tr>

    <tr>
      <td width="30%">Departamento <span class="symbol required"></span></td>
      <td colspan="3">
        <select class="form-control" name="txt_departamento" id="txt_departamento">
            <option value=""> - seleccionar - </option> 
            <?php
              foreach ($typeDeptos['resultado'] as $typeData) {
                if ($data['id_depts'] == $typeData['id']) {
                  echo '<option value="'.$typeData['id'].'" selected>'.$typeData['name'].'</option> ';
                } else {
                  echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
                }
              }
            ?>
        </select>
        </td>
    </tr>

    <tr>
      <td width="30%">Total Usuarios <span class="symbol required"></span></td>
      <td width="70%" colspan="3">
        <input maxlength="50" min="1" value="<?php echo $data['users']; ?>" autofocus="" name="total_usuarios" type="number" class="form-control" id="txt_total_usuarios" placeholder="Total Usuarios">
      </td>
    </tr>

    <tr>
      <td>Estado:</td>
      <td colspan="3">
       <select name="estado" id="txt_estado" class="form-control">
         <option value="1" <?php if($data['active'] == 1) { echo 'selected'; } ?>>Activo</option>
         <option value="0" <?php if($data['active'] == 0) { echo 'selected'; } ?>>Inactivo</option>
       </select>
      </td>
    </tr>

    <tr><td colspan="4">Turnos &nbsp; <small class="color-red">[el valor minimo debe ser 1]</small></td></tr>

      <tr>
        <td width="20%">A</td>
        <td ><input maxlength="50" autofocus="" min="1" value="<?php echo $data['turn_a']; ?>" name="turno_a" type="number" class="" id="txt_turno_a" placeholder="Turno A"></td>
        <td width="20%">B</td>
        <td ><input maxlength="50" autofocus="" min="1" value="<?php echo $data['turn_b']; ?>" name="turno_a" type="number" class="" id="txt_turno_b" placeholder="Turno B"></td>
      </tr>

      <tr>
        <td width="20%">C</td>
        <td ><input maxlength="50" autofocus="" min="1" value="<?php echo $data['turn_c']; ?>" name="turno_c" type="number" class="" id="txt_turno_c" placeholder="Turno C"></td>
        <td width="20%">D</td>
        <td ><input maxlength="50" autofocus="" min="1" value="<?php echo $data['turn_d']; ?>" name="turno_d" type="number" class="" id="txt_turno_d" placeholder="Turno D"></td>
      </tr>

      <tr>
        <td width="20%">E</td>
        <td ><input maxlength="50" autofocus="" min="1" value="<?php echo $data['turn_e']; ?>" name="turno_e" type="number" class="" id="txt_turno_e" placeholder="Turno E"></td>
      </tr>

  </tbody>
<tfoot>
  
</tfoot>
</table>

</div>
