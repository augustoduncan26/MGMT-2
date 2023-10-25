<?php
//echo $_GET['id_user'];
include_once ('../framework.php');

$id_user      = $_SESSION['id_user'];
$id_empresa   = $_SESSION['id_empresa'];
$P_Tabla      = $caja_prefix."category";


// if ($id_user == 1 || $id_user == 2) {
//   $sel        = mysql_query("Select * From ".$caja_prefix."category");
// } else {
//   $sel        = mysql_query("Select * From ".$caja_prefix."category Where id_empresa = '".$id_empresa."'");
// }

$sql_hab      = mysql_query("Select * From ".$P_Tabla." Where id = '".$_GET['id']."'")or die(mysql_error());
$data         = mysql_fetch_object($sql_hab);

//$ObjMant    = new Mantenimientos();
//$selEmp     =  $ObjMant->BuscarLoQueSea('*' , 'empresas', 'id_usuario = '.$saco['id_usuario'], 'extract', false);

?>
<form method="post">
   <table class="table table-bordered" id="sample-table-4">
     <thead>
     </thead>
     <tbody>
       <tr>
         <td width="30%">Nombre:</td>
         <td width="70%">
         <input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$data->name?>"></td>
        <input type="hidden" name="id_row" id="id_row" value="<?=$data->id?>">
       </tr>
       <tr>
         <td>Estado:</td>
         <td>
          <select name="txt_activo" id="txt_activo" class="form-control">
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
