<?php

$id_user    = isset($_GET['id_user'])?$_GET['id_user']:'';
$id_empresa = isset($_GET['id_empresa'])?$_GET['id_empresa']:'';

include_once ('../framework.php');

if ($id_user == 1 || $id_user == 2) {
  $sel        = mysqli_query($link,"Select * From ad_habitaciones");
} else {
  $sel        = mysqli_query($link,"Select * From ad_".$id_user."_habitaciones");
}

?>
<select class='form-control' name='category'>
<?php
        While ( $datos = mysqli_fetch_object($sel) ) {
?>
  <option value="<?=$datos->id?>"><?=$datos->codigo?></option>
</select>
<?php } ?>