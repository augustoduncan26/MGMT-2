<?php
$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$TblRooms   = PREFIX.'rooms_type';
$type_rooms = $ObjMante->BuscarLoQueSea('*',$TblRooms,'active = 1 and id_empresa = '.$id_empresa,'array');

$room         = $ObjMante->BuscarLoQueSea('*',PREFIX.'rooms','id = '.$_GET['id'],'extract');

?>
<form method="post">
    <table class="table table-bordered" id="sample-table-4">
      <thead>
      </thead>
      <tbody>
        <tr>
          <td width="30%">Nombre:</td>
          <td width="70%">
          <input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$room['code']?>"></td>
        <input type="hidden" name="id_row" id="id_row" value="<?=$room['id']?>"
        </tr>
        <tr>
          <td>Tipo de habitación:</td>
          <td>
        <select class="form-control" name="txt_tipo" id="txt_tipo">
            <option value=""> - seleccionar - </option>
            <?php
              foreach ($type_rooms['resultado'] as $type_room) {
                if($type_room['id'] == $room['type_room']) {
                echo '<option value="'.$type_room['id'].'" selected >'.$type_room['nombre'].'</option> ';
                } else {
                echo '<option value="'.$type_room['id'].'">'.$type_room['nombre'].'</option> ';
                }
              }
            ?>
        </select>
          <!-- <input name="pais" type="text" required="" class="form-control" id="pais"  placeholder="País"  ></td> -->
        </td>
        </tr>

        <tr>
          <td>Total de camas:</td>
          <td><input name="txt_total_beds" type="number" required="" class="form-control" id="txt_total_beds" value="<?=$room['total_beds']?>">
          </td>
        </tr>
        <tr>
          <td>Precio:</td>
          <td><input name="txt_precio" type="number" step="0.01" min="1" required="" class="form-control" id="txt_precio" placeholder="Precio" value="<?=$room['price']?>"></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td>
          <select name="txt_activo" id="txt_activo" class="form-control">
            <option value="1" <?php if($room['active']==1) { echo 'selected';}?>>Activo</option>
            <option value="0" <?php if($room['active']==0) { echo 'selected';}?>>Inactivo</option>
          </select>
          </td>
        </tr>
        <tr>
          <td>En Limpieza:</td>
          <td>
          <select name="txt_cleaning" id="txt_cleaning" class="form-control">
            <option value="1" <?php if($room['cleaning']==1) { echo 'selected';}?>>Si</option>
            <option value="0" <?php if($room['cleaning']==0) { echo 'selected';}?>>No</option>
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
