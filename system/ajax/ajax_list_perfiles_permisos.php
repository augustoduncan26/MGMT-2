<?php
include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user 	  =	$_SESSION['id_user'];
$id_cia 	  =	$_SESSION['id_cia'];

$data       = $ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id="'.$_GET['id'].'" and id_cia = '.$id_cia,'extract');
$permss     = $ObjMante->BuscarLoQueSea('*',PREFIX.'permiso_definicion','activo=1',false,'permiso');

?>
  <div class="row">
    <div class="col-md-6"><strong style="font-size: 16px;">Perfil / Rol: <?php echo strtoupper($data['name']);?></strong></div>
    <div class="col-md-6 text-right"><!--Seleccionar todos <input type="checkbox" class="check-all-selector" onClick="toggle(this)">--></div>
  </div>
  
  <input type="hidden"  id="id_row_perm" name="id_row_perm" value="<?=$_GET['id']?>">
  <!-- start: DYNAMIC TABLE PANEL -->
  <table width="100%" class="table table-striped table-bordered table-hover table-full-width" id="table_permisos">
    <thead>
      <tr class=""><!-- header-list-table -->
        <th width="100px">Nombre <input type="hidden" value="<?=$_GET['id']?>" name=""></th>
        <th width="30px">Permiso</th>
        <th width="70px" class="text-center"><label class="select-all" style="font-weight: bold;">Tildar Todos</label> &nbsp; <input type="checkbox" class="check-all-selector" onClick="toggle(this)"></th>
      </tr>
    </thead>
    <tbody>

    <?php 
    $i = 0;
    foreach ($permss['resultado'] as $key => $datos) {
      $i++;
      $permiso    = $ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_perfil = "'.$_GET['id'].'" and id_definicion_permiso = "'.$datos['permiso'].'"');
    ?>
      <tr>
        <td><?=$datos['nombre']?></td>
        <td><?=$datos['permiso']?></td>
        <td class="text-center"><input value="<?=$datos['permiso']?>" id="permisos" name="permisos"  type="checkbox" <?php if($permiso['resultado'][0]['id_definicion_permiso'] == $datos['permiso']){ echo 'checked';}?>>
      </tr>
    <?php
          $elpadre  = $datos['permiso_padre'];} ?>

    </tbody>
  </table>
<!-- end: DYNAMIC TABLE PANEL -->
 <script>
//   function toggle(source) {
//   checkboxes = document.getElementsByName('permisos');
//   for(var checkbox in checkboxes)
//     checkbox.checked = source.checked;
// }
//   $('.check-all-selector').on('click', ()=>{ alert()});
  // $('.check-all-selector').click(function() {
  // //This will select all inputs with id starting with green
  // $("input[id^='permisos']").prop('checked', $(this).prop("checked"));
  // });
  </script>