<?php

include_once ('../framework.php');

$ObjMante   = new Mantenimientos();
$ObjSql     = new ejecutorSQL();

$P_Tabla    = PREFIX.'rooms_type';

$roomsType     = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'active = 1 and id_empresa = '.$_SESSION['id_empresa'],'array');

///$sql  = mysql_query("Select * From ad_tipo_habitacion Where activo = 1");


// if($_GET['id_user']==1 || $_GET['id_user'] == 2):
//   $TblRooms   = 'ad_habitaciones';
//   $TblBeds    = 'ad_beds';
//   $TblBooking = 'ad_reservas';
// ;else:
//   $TblRooms   = 'ad_'.$_GET['id_user'].'_habitaciones';
//   $TblBeds    = 'ad_'.$_GET['id_user'].'_beds';
//   $TblBooking = 'ad_'.$_GET['id_user'].'_reservas';
// endif;

$thisRoom       = $ObjMante->BuscarLoQueSea('*',$P_Tabla,'id = '.$_GET['id'].' and id_empresa = '.$_SESSION['id_empresa'],'extract');
//$sql_hab      = mysql_query("Select * From ad_tipo_habitacion Where id = '".$_GET['id']."'")or die(mysql_error());
//$data         = mysql_fetch_object($sql_hab);

?>
<form method="post">
 <table class="table table-bordered" id="sample-table-4">
   <thead>
   </thead>
   <tbody>
     <tr>
       <td width="30%">Nombre:</td>
       <td width="70%">
       <input autofocus="" name="txt_nombre" required="" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?=$thisRoom['nombre']?>"></td>
      <input type="hidden" name="id_row" id="id_row" value="<?=$thisRoom['id']?>">
     </tr>
     <tr>
       <td width="30%">Codigo:</td>
       <td width="70%"><input autofocus="" name="txt_codigo" required="" type="text" class="form-control" id="txt_codigo" maxlength="5" placeholder="Código" value="<?=$thisRoom['code']?>"></td>
     </tr>
      <tr>
       <td>Capacidad:</td>
       <td><input name="txt_capacidad" type="number" step="1" min="1" required="" class="form-control" id="txt_capacidad" placeholder="Capacidad" value="<?=$thisRoom['capacidad']?>" ></td>
     </tr>
     <tr>
       <td>Capacidad Max:</td>
       <td><input name="txt_capacidad_max" type="number" step="1" min="1" required="" class="form-control" id="txt_capacidad_max" placeholder="Capacidad Maxima" value="<?=$thisRoom['capacidad_max']?>"></td>
     </tr>
     <tr>
       <td>Estado:</td>
       <td>
        <select name="txt_activo" id="txt_activo" class="form-control">
          <option value="1" <?php if($thisRoom['active']==1) { echo 'selected';}?>>Activo</option>
          <option value="0" <?php if($thisRoom['active']==0) { echo 'selected';}?>>Inactivo</option>
        </select>
       </td>
     </tr>
   </tbody>
   
 </table>
 </form>
