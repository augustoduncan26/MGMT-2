<?php

$id_user    = $_GET['id_user'];
$id_empresa = $_GET['id_empresa'];

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$P_Tabla    = PREFIX.'rooms';
$ObjMante->BuscarLoQueSea('*',$P_Tabla,'id_empresa='.$_GET['id_empresa'].' and active=1', 'array');

//echo mysql_num_rows($sel);

?>
<select name="" multiple>
<?php
        While ( $datos = mysql_fetch_object($sel) ) {
?>
  <option value=""></option>
</select>
    <table id="list-table-room" class="table table-striped table-bordered table-hover table-full-width">
      <thead style="background-color: #428bca !important;">
        <tr id="event-categories">
          <th style=" color:#fff">Habitaciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
        While ( $datos = mysql_fetch_object($sel) ) {
      ?>
        <tr>
          <td class="event-category label-orange" data-class="label-orange"><i class="fa fa-move"></i><?=$datos->codigo?></td>
        </tr>
     <?php
        }
     ?>
       <tfoot>
         <tr></tr>
       </tfoot>
      </tbody>
    </table>
    <?php } ?>