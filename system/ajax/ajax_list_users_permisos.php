<?php
$id_user    = $_GET['id_user'];
$id_cia     = $_GET['id_cia'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();

$nombre       = $ObjMante->BuscarLoQueSea('*',PREFIX.'users','id_usuario="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
$permss       = $ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion','active=1',false,'permiso');

?>
  <strong style="font-size: 16px;">Usuario: <?php echo $nombre['nombre'];?></strong>
  <input type="hidden"  id="id_row_perm" name="id_row_perm" value="<?=$_GET['id']?>">
  <!-- start: DYNAMIC TABLE PANEL -->
  <table width="100%" class="table table-striped table-bordered table-hover table-full-width" id="table_permisos">
    <thead>
      <tr class="header-list-table">
        <th width="50px">Permiso</th>
        <th width="100px">Nombre <input type="hidden" value="<?=$_GET['id']?>" name=""></th>
        <th width="20px"></th>
      </tr>
    </thead>
    <tbody>

    <?php 
    $i = 0;
    foreach ($permss['resultado'] as $key => $datos) {
      $i++;
      $permiso    = $ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_usuario = "'.$_GET['id'].'" and id_definicion_permiso = "'.$datos['permiso'].'"');
    ?>
      <tr>
        <td><?=$datos['permiso']?></td>
        <td><?=$datos['nombre']?></td>
        <td class="text-center"><input value="<?=$datos['permiso']?>" id="permisos" name=""  type="checkbox" <?php if($permiso['resultado'][0]['id_definicion_permiso'] == $datos['permiso']){ echo 'checked';}?>>
      </tr>
    <?php
          $elpadre  = $datos['permiso_padre'];} ?>

    </tbody>
  </table>
<!-- end: DYNAMIC TABLE PANEL -->