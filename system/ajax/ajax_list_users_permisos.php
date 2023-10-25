<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');

$sql_nom          =   mysql_query("Select * From usuarios Where id_usuario = '".$_GET['id']."'");
$nombre           =   mysql_fetch_object($sql_nom);

//$sql_p            =   mysql_query("Select * From zz_permiso_definicion Where activo = 1");

if ($_GET['id_user'] < 7 ) {
  $sql_p = mysql_query("Select * From zz_permiso_definicion order by permiso_padre ASC")or die(mysql_error());
  //echo mysql_num_rows($sql_p);
} else {
  $sql_p = mysql_query("Select * From zz_permiso_definicion Where permiso < 5000  order by permiso ASC");
}

?>
Usuario:  <?php echo $nombre->nombre;?>
  <!-- start: DYNAMIC TABLE PANEL -->
  <table width="100%" class="table table-striped table-bordered table-hover table-full-width" id="table_permisos">
    <thead>
      <tr class="header-list-table"><input type="text" style="width:0px;visibility: hidden;" id="id_row" name="id_row" value="<?=$_GET['id']?>">
        <th width="50px">Permiso</th>
        <th width="100px">Nombre <input type="hidden" value="<?=$_GET['id']?>" name=""></th>
        <th width="20px"></th>
      </tr>
    </thead>
    <tbody>

    <?php 
        While ( $datos = mysql_fetch_object($sql_p)) {

          $i++;

          $sql_perm     =   mysql_query("Select * From zz_permisos Where id_usuario = '".$_GET['id']."' and id_definicion_permiso = '".$datos->permiso."'");
          $permiso      = mysql_fetch_object($sql_perm);
    ?>
      <tr>
        <td><?=$datos->permiso_padre?></td>
        <td><?=$datos->nombre?></td>
        <td class="text-center"><input value="<?=$datos->permiso?>" id="permisos" name=""  type="checkbox" <?php if($permiso->id_definicion_permiso == $datos->permiso){ echo 'checked';}?>>
        <!--<ins class="iCheck-helper" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>--></td>
      </tr>
    
    <?php
          $elpadre  = $datos->permiso_padre;} ?>

    </tbody>
  </table>
<!-- end: DYNAMIC TABLE PANEL -->