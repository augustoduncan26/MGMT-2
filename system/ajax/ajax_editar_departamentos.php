<?php

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'mant_departamentos','id = '.$_GET['id'],'extract');

?>

<label id="mssg-edit" style="color:red"></label>
<table class="table table-bordered" id="sample-table-4">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Nombre: <span class="symbol required"></span></td>
      <td width="70%"><input autofocus="" name="nombre" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?php echo $data['name']; ?>">
      <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="Nombre" value="<?php echo $data['id']; ?>">
      </td>
    </tr>
    <tr>
    <td width="30%">Teléfono: <span class="symbol"></span></td>
    <td width="70%"><input autofocus="" name="telefono" type="text" class="form-control" id="txt_telefono" placeholder="Teléfono" value="<?php echo $data['telephone']; ?>">
    </tr>
    <tr>
      <td>Estado:</td>
      <td>
       <select name="estado" id="txt_estado" class="form-control">
         <option value="1" <?php if($data['active'] == 1) { echo 'selected'; } ?>>Activo</option>
         <option value="0" <?php if($data['active'] == 0) { echo 'selected'; } ?>>Inactivo</option>
       </select>
      </td>
    </tr>
  </tbody>
<tfoot>
  <tr><td colspan="2">
   
</td></tr>
</tfoot>
</table>

</div>
