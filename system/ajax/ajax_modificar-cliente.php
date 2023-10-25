<?php
//echo $_GET['id_user'];
include_once ('../framework.php');

if (isset($_SESSION['id_user'])) {
// $sql  = mysql_query("Select * From ad_tipo_habitacion Where activo = 1");


// if($_GET['id_user']==1 || $_GET['id_user'] == 2):
//   $TblRooms   = 'ad_habitaciones';
//   $TblBeds    = 'ad_beds';
//   $TblBooking = 'ad_reservas';
// ;else:
//   $TblRooms   = 'ad_'.$_GET['id_user'].'_habitaciones';
//   $TblBeds    = 'ad_'.$_GET['id_user'].'_beds';
//   $TblBooking = 'ad_'.$_GET['id_user'].'_reservas';
// endif;

$sql_hab      = mysql_query("Select * From fact_clientes Where id_cliente = '".$_GET['id']."' and id_empresa = '".$_SESSION['id_empresa']."'")or die(mysql_error());
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
         <td width="30%">Nombre <span class="symbol required"></span></td>
         <td width="70%">
         <input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$data->nombre_cliente?>"></td>
        <input type="hidden" name="id_row" id="id_row" value="<?=$data->id_cliente?>" />
       </tr>
        <tr>
         <td>Teléfono</td>
         <td><input name="txt_telefono" type="text" class="form-control" id="txt_telefono"  placeholder="Teléfono" value="<?php echo $data->telefono_cliente?>" ></td>                  </td>
       </tr>

       <tr>
         <td>Email</td>
         <td><input name="txt_email" type="email" class="form-control" id="txt_email" value="<?=$data->email_cliente?>">
         </td>
       </tr>
       <tr>
         <td>Dirección &nbsp; <a id="geoImg" href="#" style="border-radius: 50px;" class="btn btn-info" data-toggle="modal" data-target="#myModalMap"><img src="images/geoicon.svg" width="16" height="16" ></a></td>
         <td><input type="hidden" id="txt_latitude" value="<?php echo $data->latitude?>"><input type="hidden" id="txt_longitude" value="<?php echo $data->longitude?>">
         <textarea readonly class="form-control" id="txt_direccion" name="txt_direccion" maxlength="255"><?=$data->direccion_cliente?></textarea></td>
       </tr>
       <tr>
         <td>Estado</td>
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
<?php } ?>
