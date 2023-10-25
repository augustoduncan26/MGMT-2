<?php

  if(date('d')=='30' || date('d')=='31'):
    $num_today = 2;
 else: 
  $num_today = 3; 
endif;

 ?>


<!-- Switchery -->
<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

<script src="../vendors/tooltip/themes/<?=$num_today?>/tooltip.js" type="text/javascript"></script>
<link href="../vendors/tooltip/themes/3/tooltip.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/tablas.css" rel="stylesheet">
<link href="../assets/css/calendario_meses.css" rel="stylesheet">
<link href="../assets/css/cms_mensajes.css" rel="stylesheet">
<link href="../assets/css/campos_de_textos.css" rel="stylesheet">
<link href="../assets/css/comunes.css" rel="stylesheet">

<style type="text/css">
        h3 { font: normal 24px/36px Arial;}
        h4 { font-family: "Trebuchet MS", Verdana; }    
        #span4 img {cursor:pointer;margin:20px;}   
    </style>
    <script>
    tooltip.pop("position1", "#tip3", {position: 1});
        /*
        function open() {
            var msg = "hhs.duncan-computer";
            tooltip.pop(null, msg);
        }
        setTimeout(open, 2000);
        setTimeout(function () { tooltip.pop(null, "#tip2"); }, 5000);
        setTimeout(function () { tooltip.pop("position1", "#tip3", {position: 1}); }, 9000);
        setTimeout(function () { tooltip.pop(null, "#tip4", { overlay: true, position: 4 }); }, 13000);
        setTimeout(tooltip.hide, 16000);
        */
    </script>
<!-- OTHER TOOL TIP -->
<!--   TipMessage   -->
<!--
<SCRIPT language="JavaScript1.2" src="ad_tools/tipmessage/main.js"type="text/javascript"></SCRIPT>
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100"></DIV>
<SCRIPT language="JavaScript1.2" src="ad_tools/tipmessage/style.js" type="text/javascript"></SCRIPT>
-->
<!-- EndTipMessage  -->

<script>

// function cambiarDisplay(id,image1, image2) {
//   if (!document.getElementById) return false;
//       fila  =  document.getElementById(id);
//       //img   =  document.getElementById(image);
  
//   if (fila.style.display != "none") 
//   {
//       fila.style.display = "none"; //ocultar fila 
//     document.getElementById(image1).style.display = "";
//     document.getElementById(image2).style.display = "none";
//   }
//   else
//   {
//       fila.style.display = ""; //mostrar fila 
//     //img.style.display = "";
//     document.getElementById(image2).style.display = "";
//       document.getElementById(image1).style.display = "none";
//   } 
// }

 function selectUseLike ( id ) {
    if ( $('#' + id).is(":checked") ) {
      $('#use-sistem-as').val('rooms');
      $('#use-like').html('Hotel').css('color','red');
    } else { 
      $('#use-sistem-as').val('rooms_bed');
      $('#use-like').html('Hostel').css('color','green');
    }

    // var contenido_editor = $('#add-reservation-content')[0];
    // ajax1   = nuevoAjax();
    // ajax1.open("GET", "app/views/ad_PlanningMan2.php?title="+title+""+vars+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    // ajax1.onreadystatechange=function() {

    //   if (ajax1.readyState==4) {
    //     contenido_editor.innerHTML = ajax1.responseText;
    //     $('#title-modal').html('Reservación: ' + title);
    //     //$('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
    //   }
    // }

    // ajax1.send(null);
  }

  function changeMode( value ) {
    var id_user   = '<?php echo $_SESSION['id_user']?>';
    var id_empresa= '<?php echo $_SESSION['id_empresa']?>';
    
    var vars      = value;

    //var contenido_editor = $('#add-reservation-content')[0];
    ajax1   = nuevoAjax();
    ajax1.open("GET", "ajax/ajax_change_planning_mode.php?id_user="+id_user+"&value="+vars+"&nocache=<?php echo rand(99999,66666)?>",true);    
    ajax1.onreadystatechange=function() {

      if (ajax1.readyState==4) {
        //contenido_editor.innerHTML = ajax1.responseText;
        //$('#title-modal').html('Reservación: ' + title);
        //$('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
      }
    }

    ajax1.send(null);
    window.location = '?Planning';

  }

  function addReservation ( title , vars ) {

    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

    var contenido_editor = $('#add-reservation-content')[0];
    ajax1   = nuevoAjax();
    ajax1.open("GET", "app/views/ad_PlanningMan2.php?title="+title+""+vars+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    ajax1.onreadystatechange=function() {

      if (ajax1.readyState==4) {
        contenido_editor.innerHTML = ajax1.responseText;
        $('#title-modal').html('Reservación: ' + title);
        //$('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
      }
    }

    ajax1.send(null);
  }

  function saveReservation () {
    // var id_user     = '<?php echo $_SESSION["id_user"]?>';
    // var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

    // var contenido_editor = $('#add-reservation-content')[0];
    // ajax1   = nuevoAjax();
    // ajax1.open("GET", "app/views/ad_PlanningMan2.php?title="+title+""+vars+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    // ajax1.onreadystatechange=function() {

    //   if (ajax1.readyState==4) {
    //     contenido_editor.innerHTML = ajax1.responseText;
    //     $('#title-modal').html('Reservación: ' + title);
    //     //$('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
    //   }
    // }

    // ajax1.send(null);
  }


</script>

<style>
a{color:#000;}
a:active{color:#000;}
a:link{color:#000;}
a:hover{color:#000;}
a:visited{color:#000;}
</style>

<!-- <div id="Opciones" class="" style="background-color:; font-family:Verdana, sans-serif;width:100%; font-size:12px; color:#FFF; ">
 -->
 <div class="col-md-12 col-sm-12 col-xs-12">
 
 <div class="x_panel">

    <div class="x_title">
      <h2>Planning</h2>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
 <div class="x_content">
 <div id="Opciones" style="background-color:;font-family:Verdana,Geneva, sans-serif;width:100%;font-size:12px;">
<?PHP

if($DatosEmpresa['work_as']=='' && $DatosEmpresa['id_empresa']==''):
      
      echo '<br />
          <br />
          <h1><center style=color:yellow>Debe actualizar sus datos de empresa <br /> 
          <a href="?Configurar-Empresa" style="text-decoration:underline; color:yellow">Click Here</a>
          </center></h1>' ;
      
;else: 

?>
  <table width="100%" class="bordeTodalaTabla_3" border="0" align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" bgcolor="#fff">
    <tr align="center">
    
    
    </tr>

<!-- Improving the system, daily -->

 
  </table>
  
 
  <!-- Search Result -->

</div>

<form id="form1" name="form1" method="post" action="">

  <table id="planning_mess" width="100%" border="0" align="center" cellspacing="0" cellpadding="0" class="bordeTodalaTabla_3" style="font-family:Verdana, Geneva, sans-serif; font-size:10px" bgcolor="#FFFFFF">
 
     <tr>
      <td >

      <table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" class="" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
        <tr>
          <td colspan="3" >
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Utilizar para?
              </label>
              <div class="item form-group">
                <label>
                  <input id="select-use-like" type="checkbox" onclick="selectUseLike('select-use-like');changeMode($('#use-sistem-as').val());" class="js-switch" <?php if($DataUserCia['work_as']=='rooms') { echo 'checked';}?>  style="display: none; background-color:#337ab7 !important;"> &nbsp; <label id="use-like"> <?=$UseLike?></label>     
                  <input type="hidden" name="use-sistem-as" id="use-sistem-as" value="<?=$DatosUser['work_as']?>">
                </label>
              </div>
              </div>
          </td>
          <td width="6%">Mes</td>
          <td width="15%">
 <!--     
      LOS MESES 
     ===========
 -->
 <!-- height:24px; font-size:10px; width:100px -->
          <select class="form-control" name="PL_meses" id="PL_meses" style="" onChange="javascript: document.form1.submit()">
          <option value=""></option>
          <?PHP 
        if($sel=='es'):
          $MESES    = array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        ;else:
          $MESES    = array('XXX','January','February','March','April','May','June','July','August','September','October','November','Dicember');
        endif;


        for($M  = 1 ; $M  < count($MESES) ; $M++)
        {
          if((isset($PL_meses) && $PL_meses == $M))
          {
            echo '<option value="'.$M.'" selected>'.$MESES[$M].'</option>'; 
            
          }elseif($M == date('n') && !isset($_POST['PL_meses'])){
                                 
            echo '<option value="'.$M.'" selected>'.$MESES[$M].'</option>';
            
          }else
          {
            echo '<option value="'.$M.'">'.$MESES[$M].'</option>';
          }
        }
     ?>
          </select>
          </td>
<!--           <td width="10%" class="linea_abajo" align="center">Reservado</td>
          <td width="1%" bgcolor="#FF0000">&nbsp;</td>
          <td width="10%" class="linea_abajo" align="center">&nbsp;Registrado</td>
          <td width="1%" bgcolor="#FFFF00" class="linea_abajo">&nbsp;</td> -->
        </tr>
        <tr>
          <td width="10%" bgcolor="#FF0000" style="color:#fff" class="" align="center">Reservados</td>
          <td width="10%" bgcolor="#FFFF00" style="color:#000" class="" align="center">Registrados</td>
          <td width="10%" class="" align="center">En Limpieza <image name="listo" id="listo" src="web/images/icono_aspirador.png" border="0" /></td>
          <!-- <td width="10%" class="linea_abajo" align="center">&nbsp;</td> -->
          <td>Año</td>
          <td>
  
  <!--     EL AÑO 
           =======
  -->
          <select name="PL_anyo" id="PL_anyo" class="form-control" style="" onChange="javascript: document.form1.submit()">
          <option value="">-seleccione-</option>
          <?PHP
              for($x = date("Y")-4 ; $x < date("Y")+3 ; $x++)
        {
          if(isset($PL_anyo) && $PL_anyo==$x)
          {
            echo '<option value="'.$x.'" selected>'.date($x).'</option>'  ;
            
          }else if(date("Y") == $x && $PL_anyo==false){
            
            echo '<option value="'.$x.'" selected>'.$ANYOACTUAL.'</option>' ;
            
          }else{
            
            echo '<option value="'.$x.'">'.date($x).'</option>' ;
          }
        }
      ?>
          </select>

<!-- Icons Cleanning Room,  -->
        
        </td>
          <!-- <td  class="linea_abajo" align="center">Room cleaning</td>
          <td class="linea_abajo"><image name="listo" id="listo" src="web/images/icono_aspirador.png" border="0" /></td>
          <td >&nbsp;</td>
          <td>&nbsp;</td> -->
        </tr>
        <tr><td colspan="6">&nbsp;</td></tr>
       </table>
       
       <!-- <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
       <tr>
       <td> 
       
       </td>
       <td align="right">
       
       </td>
       </tr>
       </table>
       
       <br> -->
       
</td>
    </tr>
     <tr>
     <td height="29">
     <!-- Table to put:
      1 - the name of the month&year
        2 - the leter of the days
        3 - the number of the days
     -->
     <?PHP
      // PRIMEROS PASOS PARA LA CONFECCION 
    // DINAMICA DEL PLANNING
    
    // FIRST:
    // ********
    
    // PONER LABEL DEL MES QUE ESTAN VIENDO Y EL AÑO
    // SEGUN LA CONSULTA REALIZADA
    
    if(isset($_POST['PL_meses']) && $_POST['PL_meses']!=''):
      //$MES_ANTES    = ($ARRAY_Ms[$MESDIG1]-1).' - '.$ANYOACTUAL;
      $MES_ACTUAL   = $ARRAY_Ms[$MESDIG1].' - '.$ANYOACTUAL;
      //$MES_SIGUE    = ($ARRAY_Ms[$MESDIG1]+1).' - '.$ANYOACTUAL;
      
      $DOSDIG = substr($ANYOACTUAL,2,2);          // Ver los ultimos 2 digitos del año
    ;else:
      $MES_ACTUAL   = $ARRAY_Ms[date('n')].' - '.date('Y');
      $DOSDIG     = substr($ANYOACTUAL,2,2);      // Ver los ultimos 2 digitos del año
      $MESDIG1    = date('n');
      $ANYOACTUAL   = date('Y');
    endif;
   ?>
   
   <!-- GRILLA PARA EL PLANNING -->

     <div id="man_planning" style="float:left; width:100%">

     <table width="100%" class="bordeTodalaTabla_3" style="font-family:Verdana, Geneva, sans-serif; font-size:10px">
       <tr>
         <td colspan="31" align="center">
          <h2><?PHP echo $MES_ACTUAL;?></h2>
         </td>
       </tr>
       
 <!-- Here Letter of the Days in Plannig Top -->
       
       <tr>
         <td style="width:3px" class="cuadro2">&nbsp;</td>
         <?PHP
            $ANYO     = $ANYOACTUAL;
        for($DM = 1 ; $DM < $TotDiasMes+1 ; $DM++):
          $Letra    = $objPFecha->NombreDelDia($MESDIG1, $DM ,$ANYO);
          $Letra2   = substr($Letra,0,1);
          
          if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =  'bgcolor="#E8FFE8" ';}else{$BGCOLOR = '';}
          
          if($DM == $DIASDELMES  && date('n')==$PL_meses){ $BGCOLOR = 'bgcolor="#8BC2C2" ';} // #069  // #009999
          /*
          $Letra    = $objPFecha->NombreDelDia($MESDIG1, $DM ,$ANYO);
          $Letra2   = substr($Letra,0,1);
          Letra de los Dias
          */
          echo '<td align="center" style="width:3px" '.$BGCOLOR.' title="'.$Letra.'" class="cuadro2"><a href="#" style="color:blue">'.$Letra2.'</a></td>';
      
        endfor;
     ?>
       </tr>
       
       <!-- Here Number of the Days -->
       
       <tr>
         <td style="width:10px" class="cuadro2">&nbsp;</td>
         <?PHP
            $ANYO     = $ANYOACTUAL;
        
        for($DM = 1 ; $DM < $TotDiasMes+1 ; $DM++):
        
          $Letra    = $objPFecha->NombreDelDia($MESDIG1, $DM ,$ANYO);
          $Letra2   = substr($Letra,0,1);
          if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =  'bgcolor="#E8FFE8" ';}else{$BGCOLOR = '';}
          
          if($DM == $DIASDELMES && date('n')==$PL_meses){ $BGCOLOR =  'bgcolor="#8BC2C2" ';} // #069
                    
          echo '<td align="center" style="width:3px" '.$BGCOLOR.' title="'.$Letra.'" class="cuadro2"><a href="#" style="color:blue">'.$DM.'</a></td>';
      
        endfor;
     ?>
       </tr>
       
       <!-- Here Name of the Rooms -->
      
         <?PHP
          $NameRoom2    = array();
          $CodeRooms    = array();
          $Celaning     = array();

          $listaHB    = mysql_query('SELECT * FROM '.$TblRooms.' Where activo=1 ORDER BY codigo');
          if(@mysql_num_rows($listaHB)>0):
          $ListaTotal   = mysql_num_rows($listaHB);
          while($Data   = mysql_fetch_array($listaHB))
          {
            $NameRoom2[]  .=  $Data['codigo'];
            $CodeRooms[]  .=  $Data['id'];  
            $Celaning[]   .=  $Data['cleaning'];
          }
          endif;
      if($ListaTotal==0): echo '<a href=?pag=rooms style=font-size:16px;color:red><font size=3 color=red >- '.strtoupper($idioma[$sel]['plan_configroom']).'</font></a>'; endif;
      
      for($HB = 0;  $HB < $ListaTotal;  $HB++):
      
      echo '';
      echo '<tr>
              <td colspan='.($TotDiasMes+1).' onclick="cambiarDisplay(\'div_'.$NameRoom2[$HB].'\',\'\')" style="cursor:pointer; width:100%">'.$NameRoom2[$HB].'</td>
            </tr>';
      



// **********************************
// If use only with Rooms setting *
// **********************************
// Si solo se quiere usar con     *
// habitaciones y NO cama (HOTEL) *
// **********************************
      //echo $TblBooking;
      
      if(@$DatosEmpresa['work_as']=='rooms'):
        
        echo '<tr><td>&nbsp;</td>';
        
        
        for($DM = 1 ; $DM < $TotDiasMes+1 ; $DM++):
          
            $Letra    = $objPFecha->NombreDelDia($MESDIG1, $DM ,$ANYO);
            $Letra2   = substr($Letra,0,1);
            if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =  'bgcolor="#E8FFE8" ';}else{$BGCOLOR = '';}
            if($DM == $DIASDELMES){ $BGCOLOR =  'bgcolor="#009999" ';} // #009999
            
            if(strlen($DM)==1):$DIACONDOSDIGITOS = '0'.$DM;else:$DIACONDOSDIGITOS=$DM; endif;
            $FECHA_EVAL   = $ANYO.'-'.$DIGITOS2[$MESDIG1].'-'.$DIACONDOSDIGITOS;
          
            //$Sentencia  = 'Select *,'.$TblBooking.'.id';
            
            $sql_Days = @mysql_query('Select *,'.$TblBooking.'.id as IDR From '.$TblBooking.','.$TblRDays.' Where '.$TblBooking.'.rooms="'.$NameRoom2[$HB].'" and '.$TblRDays.'.id_tbl_reservas = '.$TblBooking.'.id and '.$TblRDays.'.day = "'.$FECHA_EVAL.'" and '.$TblRDays.'.activo = 1 and '.$TblBooking.'.activo=1');
            $Status   = @mysql_fetch_array($sql_Days);
                
            // Evaluate if reservation day, is old& other things            
            // **************************************************
            //Review($DIAACTUAL,$Status['fecha_e'],$Status['id_tbl_reservas']);
            Review($DIAACTUAL,$Status['fecha_s'],$Status['IDR']);
            
            // The room is cleanning
              $RoomIsCleaning  = ''; //echo $Celaning[$HB];
              if($Celaning[$HB]==1 && $DIAACTUAL==$FECHA_EVAL): $RoomIsCleaning = '<image name="cleaning" id="cleaning" src="ad_images/icono_aspirador.png" border="0" title="This room is cleaning"/>';endif;
           // End the room is cleanning
                  
            // The room reserved
            // COLOR RED
            // *********
            if($Status['paso']=='1' && $FECHA_EVAL==$Status['day'])
            {
              $BGCOLOR  = 'bgcolor="red"';
              $Details  = 'Reservations: '.$NameRoom2[$HB].' Bed: 1,&nbsp;<br />Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Reservado<br />';
                
              echo '
              <td class="cuadro2 tooltip" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'> 
              <a  href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' Bed: 1\',\'ad_pantallas/ad_PlanningMan.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&from=reservas&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=550&width=1200\')" title="">
              '.$RoomIsCleaning.'&nbsp;</a>';
              //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
              
              
            }
            
             // COLOR GREEN
                 // ***********
                  elseif($Status['paso']=='2' && $FECHA_EVAL==$Status['day'])//  && $FECHA_EVAL>=$Status['fecha_e'] && $FECHA_EVAL<=$Status['fecha_s'])
                  {
                    $BGCOLOR  = 'bgcolor="green" ';
                    $Details  = 'Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Check In, not paid yet <br />';
                    
                    echo '
                      <td class="tooltip cuadro2" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'>
                      <a href="#" onclick="tb_show(\'\',\'ad_pantallas/ad_PlanningMan.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&language='.$sel.'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=green&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                      <img src="ad_images/perfil_07.gif" height="10px" />'.$RoomIsCleaning.'&nbsp;</a>';
                
                // COLOR YELLOW
                // ************ 
                  }elseif($Status['paso']=='3' && $FECHA_EVAL==$Status['day'])//  && $FECHA_EVAL>=$Status['fecha_e'] && $FECHA_EVAL<=$Status['fecha_s'])
                  {
                    
              // **************************
              // Calculate total a cobrar *
              // **************************
                    $VALOR  = false;
                    $Sumar  = false;
                    $r    = 0;
                    $SL   = mysql_query('Select price,total_dias From '.$TblBooking.' where id="'.$Status['IDR'].'" AND activo =1');// LIMIT '.$Status['total_dias'].'');
                    //$SL2  = mysql_query('');
                    //echo mysql_num_rows($SL);
                    $HowMuch=mysql_fetch_array($SL);
                    $VALOR  = sprintf("%01.2f",($HowMuch['price']*$HowMuch['total_dias']));

                    /*
                    while($HowMuch=mysql_fetch_array($SL)):
                      $r++;
                      //$VALOR[]  +=  sprintf("%01.2f",$HowMuch['price']);
                      $VALOR   = sprintf("%01.2f",$HowMuch['price']);
                      //$Sumar  +=  ($Sumar+$VALOR[$r]);
                    endwhile;
                    */
                  
                    // Sumar todos los precios de los dias
                    // ***********************************
                    //for($i=0;$i<$Status['total_dias'];$i++):
                    //  $Sumar  =  ($Sumar+$VALOR[$i]);
                    //endfor;
                    $Sumar    = $VALOR;

                    // *********************
                    //  TOTAL FOR SERVICES *
                    // *********************
                    
                    $VALORServ  = false;
                    $SumarServ  = '00.00';
                    $SL   = mysql_query('Select * From ad_reservas_services where id_tbl_reservas="'.$Status['IDR'].'" and id_empresa="'.$DataUserCia['id_empresa'].'" AND activo = 1');
                    while($HowMuchServ=mysql_fetch_array($SL)):
                      $r++;
                      $SumarServ+=  sprintf("%01.2f",$HowMuchServ['total']);
                    endwhile;
                    $SERVICIOS  = 'Total services '.CurrencyActual2($DataUserCia['id_empresa']).'. '.sprintf("%01.2f",$SumarServ);
                    
                    // *********************
                    //      END SERVICES   *
                    // *********************
                    
                    // Aplicar Descuento si es que tiene
                    // *********************************
                    $TOTPAY   = sprintf("%01.2f",($Sumar-($Status['discounts']+$Status['bookers_porcent'])));
                    $TOTPAY   = sprintf("%01.2f",($SumarServ+$TOTPAY));
                                      
                    
                    // Descuentos
                    $APAGARACTUAL=  '<hr />Total '.$Status['total_dias'].' days: &nbsp;&nbsp;'.CurrencyActual2($DataUserCia['id_empresa']).'. '.sprintf("%01.2f",$Sumar).' <br /> '.$SERVICIOS.' <br /> Discounts: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.CurrencyActual2($DataUserCia['id_empresa']).'. (-'.$Status['discounts'].') <br> Bookers &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.CurrencyActual2($DataUserCia['id_empresa']).'. ('.$Status['bookers_porcent'].')<hr />Total to pay: '.CurrencyActual2($DataUserCia['id_empresa']).'. '.$TOTPAY;
                    //echo '<font size="+1" color="#FF0000">'.CurrencyActual($_GET['userregistra']).'. '.sprintf("%01.2f",$Sumar).' <br>'.CurrencyActual($_GET['userregistra']).'. (-'.$DataArr['discounts'].')</font>';
                    
              // ********************
              //  END TOTAL A PAGAR *
              // ********************
                    
                    $BGCOLOR =  'bgcolor="yellow" ';
                    $Details  = 'Reservations: '.$NameRoom2[$HB].' Bed: 1,&nbsp;<br />Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Check In.<br />'.$APAGARACTUAL;
                    //style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"
                    echo '
                    <td class="tooltip cuadro2" align="center" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'> 
                       <a href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' Bed: 1,&nbsp;\',\'ad_pantallas/ad_PlanningMan.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&from=reservas&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=550&width=1200\')" title="">
                    <img src="ad_images/perfil_07.gif" height="10px" />'.$RoomIsCleaning.'&nbsp;</a>';
                    //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                    //
                    $VALOR  = false;

                  }else{

                //}
                // No seleccionar fechas anteriores al
                // dia de hoy
                // ***********************************
                if($DIAACTUAL > $FECHA_EVAL):

                  echo '
                  <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  <a class="badge bg-none" href="#" onclick="javascrit: alert(\'Error: The selected day is less than the current day.\')">
                  '.$RoomIsCleaning.'&nbsp;</a>';

                ;else:
                
                  //echo '
                  //<td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  //<a href="#" onclick="javascript:window.open(\'app/views/ad_PlanningMan2.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                  //&nbsp;</a>';
                  $title_modal = $NameRoom2[$HB].',&nbsp;'.$Letra.' '.$DM.' '.$MES_ACTUAL;
                  $var_modal   = '&id_empresa='.$_SESSION['id_empresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&id_user='.$_SESSION['id_user'].'&work_as='.$DatosEmpresa['work_as'].'&language='.$sel.'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'';
                ?>
                  <td class="cuadro2" align="center" style="width:2px" <?=$BGCOLOR;?> title="<?php echo $Letra.' '.$DM.' '.$MES_ACTUAL;?>"><a class="badge bg-none" data-toggle="modal" role="button" href=#add_reservation onClick = "addReservation('<?php echo $title_modal; ?>' , '<?php echo $var_modal;?>' )">&nbsp;</a></td>
                
                <?php

                  // echo '
                  // <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  // <a href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' 1,&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'\',\'app/views/ad_PlanningMan2.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&language='.$sel.'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed=1&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=550&width=450\')" title="Reservations: '.$NameRoom2[$HB].' 1,&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'">
                  //   '.$RoomIsCleaning.'&nbsp;si</a>
                  // ';
                
                endif;
                }

          endfor;
          
        echo '</tr>';
      endif;
    
  // **************************************
  // End if only using ROOMS setting      *
  // **************************************
 

  // **************************************
  // IF USE Like ROOMS & BEDS             *
  // **************************************
      

      if(@$DatosEmpresa['work_as']=='rooms_bed'):
        // Work as Rooms & Bed the same time
        // *********************************
        // Trabajar como habitacion y cama al 
        // mismo tiempo
        // FIFTH :
        // ******
        // Here show number of bed in rooms
        // This is only apply in CondorsHouse
        
          
        //echo '<table id="table_'.$NameRoom2[$HB].'" class="bordeTodalaTabla_3" style="font-family:Verdana, Geneva, sans-serif; font-size:10px" width="100%">';
        // Search for total beds in this room
          $sq_  = mysql_query('Select * from '.$TblBeds.' Where rooms="'.$CodeRooms[$HB].'"');
          if(mysql_num_rows($sq_)>0): $RoomsNumber = mysql_fetch_array($sq_); ;else: echo ''; endif;
          
          echo '<div id="" style=" background-color:gray;border:1px;">';
          
          for($DMBed  = 1 ; $DMBed < mysql_num_rows($sq_)+1 ; $DMBed++):
          
            //echo '<td style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.'">ooooa</td>'; 
            echo '<tr style=""><td style="font-size:10px;width:2px;" title=" Rooms Nº '.$DMBed.'">'.$DMBed.'.</td>';
              
              // Days of the moth
              for($DM = 1 ; $DM < $TotDiasMes+1 ; $DM++):
      
                $Letra    = $objPFecha->NombreDelDia($MESDIG1, $DM ,$ANYO);
                $Letra2   = substr($Letra,0,1);
                if($Letra2 == 'S' || $Letra2 == 'D'){ $BGCOLOR =  'bgcolor="#E8FFE8" ';}else{$BGCOLOR = '';}
                  if($DM == $DIASDELMES  && date('n')==$PL_meses ){ $BGCOLOR =  'bgcolor="#8BC2C2"';}//'bgcolor="#069" ';}
                
                //echo '
                //<td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'">
                //<a href="#" onclick="javascript:VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\',\'Reservations\',\'menubar=yes,width=750px, height=300px,scrollbars=no\',false,\'iframe\'); return false">
                //&nbsp;</a>';
                //if($DIAACTUAL<)
                if(strlen($DM)==1):$DIACONDOSDIGITOS = '0'.$DM;else:$DIACONDOSDIGITOS=$DM; endif;
                
                $FECHA_EVAL   = $ANYO.'-'.$DIGITOS2[$MESDIG1].'-'.$DIACONDOSDIGITOS;
                
                // Search status of bed??
                // ***********************
                //$sql_F    = mysql_query('Select * From ad_reservas Where rooms="'.$NameRoom2[$HB].'" and cama="'.$DMBed.'" and (fecha_e between "'.$FECHA_EVAL.'" and "'.$FECHA_EVAL.'" or fecha_s between "'.$FECHA_EVAL.'" and "'.$FECHA_EVAL.'") and activo = 1');
                $sql_F    = mysql_query('Select * From '.$TblBooking.' Where rooms="'.$NameRoom2[$HB].'" and cama="'.$DMBed.'" and (fecha_e >= "'.$FECHA_EVAL.'" and  fecha_s <="'.$FECHA_EVAL.'") and activo = 1');
                
                //echo mysql_num_rows($sql_F);
                //if(mysql_num_rows($sql_F)>0): echo 1; endif;
                // Evaluate status of the bed
                // **************************
                $Status   = @mysql_fetch_array($sql_F);
                
                $sql_Days = @mysql_query('Select *,'.$TblBooking.'.id as IDR From '.$TblBooking.','.$TblRDays.' Where '.$TblBooking.'.rooms="'.$NameRoom2[$HB].'" and '.$TblBooking.'.cama="'.$DMBed.'" and '.$TblRDays.'.id_tbl_reservas = '.$TblBooking.'.id and '.$TblRDays.'.day = "'.$FECHA_EVAL.'" and '.$TblRDays.'.activo = 1 and '.$TblBooking.'.activo=1');
                $Status   = @mysql_fetch_array($sql_Days);
                //echo $StatusDays['day'];
                //echo mysql_num_rows($sql_Days);
                //if(isset($Status['total_dias']) && @$r_rows<=$Status['total_dias']):
                //echo @$r_rows = $r_rows+1;
                //endif;
                //echo $FECHA_EVAL;
                // Definitions of Colors:
                // red    = reservando
                // green  =   hospedado
                // yellow = pago  
                
                // Evaluate if reservation day, is old& other things            
                // **************************************************
                //Review($DIAACTUAL,$Status['fecha_e'],$Status['id_tbl_reservas']);
                Review($DIAACTUAL,$Status['fecha_s'],$Status['IDR']);
               
              // The room is cleanning
              $RoomIsCleaning  = ''; //echo $Celaning[$HB];
              if($Celaning[$HB]==1 && $DIAACTUAL==$FECHA_EVAL): $RoomIsCleaning = '<image name="cleaning" id="cleaning" src="ad_images/icono_aspirador.png" border="0" title="This room is cleaning"/>';endif;
              // End the room is cleanning
           
          // *********************
          // The room reserved
          // COLOR RED
          // *********************
                  if($Status['paso']=='1' && $FECHA_EVAL==$Status['day'])
                  {
                    $BGCOLOR  = 'bgcolor="red"';
                    $Details  = ''.$NameRoom2[$HB].' Bed: '.$DMBed.',&nbsp;<br />Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Reservado<br />';
                    /*
                    echo '
                    <td class="cuadro2 tooltip" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'> 
                    <a href="#"  id="myList" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                    &nbsp;</a>';
                    */
                    echo '
                    <td class="cuadro2 tooltip" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'> 
                    <a  href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' Bed: '.$DMBed.'\',\'ad_pantallas/ad_PlanningMan.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&from=reservas&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=550&width=1200\')" title="">
                    '.$RoomIsCleaning.'&nbsp;</a>';
                    
                    //<a href="#" onclick="javascript: VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'\', \'Modify Data\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=1000, height=550px,scrollbars=yes\',false,\'iframe\'); return false">
                    
                    // Lightbox: <a href=\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'&lightbox[iframe]=true&lightbox[width]=80p&lightbox[height]=550\' class=\'lightbox\'>
                    //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=red&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                  }
          // *****************
          // COLOR GREEN
          // *****************
                  elseif($Status['paso']=='2' && $FECHA_EVAL==$Status['day'])//  && $FECHA_EVAL>=$Status['fecha_e'] && $FECHA_EVAL<=$Status['fecha_s'])
                  {
                    $BGCOLOR  = 'bgcolor="green" ';
                    $Details  = 'Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Check-In<br />';
                    
                    echo '
                      <td id="" class="cuadro2 tooltip" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'>
                      <a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?language='.$sel.'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=green&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                      
                      <img src="ad_images/perfil_07.gif" height="10px" />&nbsp;</a>';
                      
                      //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=green&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                      // Visor Ventana: <a href="#" onclick="javascript: VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=green&date_r='.$FECHA_EVAL.'&dia='.$DM.'\', \'Modify Data\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=1000, height=550px,scrollbars=yes\',false,\'iframe\'); return false">
                
          // ******************
          // COLOR YELLOW
          // ****************** 
                  }
                    elseif($Status['paso']=='3' && $FECHA_EVAL==$Status['day'])//  && $FECHA_EVAL>=$Status['fecha_e'] && $FECHA_EVAL<=$Status['fecha_s'])
                  {
                    
                    $BGCOLOR =  'bgcolor="yellow" ';
                    
              // **************************
              // Calculate total a cobrar *
              // **************************
                    $VALOR  = false;
                    $Sumar  = false;
                    $r    = 0;
                    $SL   = mysql_query('Select price From '.$TblRDays.' where id_tbl_reservas="'.$Status['IDR'].'" AND activo =1  order by id ASC LIMIT '.$Status['total_dias'].'');
                    //$SL2  = mysql_query('');
                    //echo mysql_num_rows($SL);
                    while($HowMuch=mysql_fetch_array($SL)):
                      $r++;
                      $VALOR[]  +=  sprintf("%01.2f",$HowMuch['price']);
                      
                      //$Sumar  +=  ($Sumar+$VALOR[$r]);
                    endwhile;
                    
                    // Sumar todos los precios de los dias
                    // ***********************************
                    for($i=0;$i<$Status['total_dias'];$i++):
                      $Sumar  =  ($Sumar+$VALOR[$i]);
                    endfor;
                    
                    // *********************
                    //  TOTAL FOR SERVICES *
                    // *********************
                    
                    $VALORServ  = false;
                    $SumarServ  = '00.00';
                    $SL   = mysql_query('Select * From ad_reservas_services where id_tbl_reservas="'.$Status['IDR'].'" and id_empresa="'.$DataUserCia['id_empresa'].'" AND activo = 1');
                    while($HowMuchServ=mysql_fetch_array($SL)):
                      $r++;
                      $SumarServ+=  sprintf("%01.2f",$HowMuchServ['total']);
                    endwhile;
                    $SERVICIOS  = 'Total services: '.CurrencyActual2($DataUserCia['id_empresa']).'. '.sprintf("%01.2f",$SumarServ);
                    
                    // *********************
                    //      END SERVICES   *
                    // *********************
                    
                    // Aplicar Descuento si es que tiene
                    // *********************************
                    $TOTPAY   = sprintf("%01.2f",($Sumar-$Status['discounts']));
                    $TOTPAY   = sprintf("%01.2f",($SumarServ+$TOTPAY));
                    
                    // Descuentos
                    $APAGARACTUAL=  '<hr />Total '.$Status['total_dias'].' nights: '.CurrencyActual2($DataUserCia['id_empresa']).'. '.sprintf("%01.2f",$Sumar).' <br />'.$SERVICIOS.'<br /> Discounts: '.CurrencyActual2($DataUserCia['id_empresa']).'. (-'.$Status['discounts'].')'.' <hr />Total to pay: '.CurrencyActual2($DataUserCia['id_empresa']).'.'.$TOTPAY;
                    //echo '<font size="+1" color="#FF0000">'.CurrencyActual($_GET['userregistra']).'. '.sprintf("%01.2f",$Sumar).' <br>'.CurrencyActual($_GET['userregistra']).'. (-'.$DataArr['discounts'].')</font>';
                    
              // ********************
              //  END TOTAL A PAGAR *
              // ********************
                    
                    $Details  = ''.$NameRoom2[$HB].' Bed: '.$DMBed.',&nbsp;<br />Name: '.$Status['first_name'].'&nbsp;'.$Status['last_name'].'<br /> From: '.$Status['fecha_e'].' to '.$Status['fecha_s'].'<br />Email: '.$Status['email'].'<br />Status: Check-In<br />'.$APAGARACTUAL;
                    //style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"
                    
                    echo '
                    <td class="cuadro2 tooltip" align="center" onmouseover="tooltip.pop(this, \''.$Details.'\')" align="center" style="width:2px" '.$BGCOLOR.'> 
                    <a href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' Bed: '.$DMBed.'\',\'ad_pantallas/ad_PlanningMan.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&from=reservas&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&height=550&width=1200\')" title="">
                    
                    <img src="ad_images/perfil_07.gif" height="10px" />'.$RoomIsCleaning.'&nbsp;</a>';
                    
                    //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                    
                    //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                    // Visor Ventana: <a href="#" onclick="javascript: VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&id='.$Status['IDR'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&opcion=modify&color=yellow&date_r='.$FECHA_EVAL.'&dia='.$DM.'\', \'Modify Data\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=1000, height=550px,scrollbars=yes\',false,\'iframe\'); return false">
                  }else{

                //}
                // No seleccionar fechas anteriores al
                // dia de hoy
                // ***********************************
                if($DIAACTUAL>$FECHA_EVAL):
                  echo '
                  <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  
                  <a href="#" onclick="javascrit: alert(\'Error: The selected day is less than the current day.\')">
                  '.$RoomIsCleaning.'&nbsp;</a>';
                ;else:
                  /*
                  echo '
                  <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  <a href="#" onclick="javascript: VisorVentana(\'ad_pantallas/ad_PlanningMan2.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\', \'Reservations: '.$NameRoom2[$HB].' '.$DMBed.',&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'\',\'width=500px, height=480px\',false,\'ajax\');">
                    &nbsp;</a>
                  ';
                  */
        
        //*****************************
        // Free space day to selected *
        //=============================
        
                  // echo '
                  // <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  // <a href="#" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' '.$DMBed.',&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'\',\'app/views/ad_PlanningMan2.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&inlineId=simple_div&height=550&width=450\')" title="Reservations: '.$NameRoom2[$HB].' '.$DMBed.',&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'" >
                  //   '.$RoomIsCleaning.'&nbsp;</a>
                  // ';

                  echo '
                  <td class="cuadro2" align="center" style="width:2px" '.$BGCOLOR.' title="'.$Letra.' '.$DM.' '.$MES_ACTUAL.'"> 
                  <a href="#" onclick="VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\', \'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=1000, height=550px,scrollbars=yes\',false,\'iframe\'); return false" onclick="tb_show(\'Reservations: '.$NameRoom2[$HB].' '.$DMBed.',&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'\',\'app/views/ad_PlanningMan2.php?id_empresa='.$_SESSION['idEmpresa'].'&full_version='.$_SESSION['FULL_VERSION'].'&language='.$sel.'&id_user='.$_SESSION['idUsuario'].'&work_as='.$DatosEmpresa['work_as'].'&habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'&placeValuesBeforeTB_=savedValues&keepThis=true&TB_iframe=true&inlineId=simple_div&height=550&width=450\')" title="Reservations: '.$NameRoom2[$HB].' '.$DMBed.',&nbsp; '.$Letra.' '.$DM.' '.$MES_ACTUAL.'" >
                    '.$RoomIsCleaning.'&nbsp;</a>
                  ';
                  
                  //<a href="../../ad_controles/sad_EnviarClave.php?keepThis=true&TB_iframe=true&height=250&width=400" title="" class="thickbox">Open iFrame Modal</a>

                  
                  /// <a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                  // &nbsp;</a>
                  
                  //<a href="#" onclick="javascript: VisorVentana(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\', \'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100,width=1000, height=550px,scrollbars=yes\',false,\'iframe\'); return false">
                  //&nbsp;</a>';
                  
                  // Lightbox: <a href=\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'&lightbox[iframe]=true&lightbox[width]=80p&lightbox[height]=550\' class=\'lightbox\'>
                  //<a href="#" onclick="javascript:window.open(\'ad_pantallas/ad_PlanningMan.php?habita='.$NameRoom2[$HB].'&userregistra='.$DataUserCia['id_empresa'].'&bed='.$DMBed.'&anyo='.$ANYO.'&mes='.$MESDIG1.'&dia='.$DM.'\',\'Reservations\',\'menubar=0,directories=0, RESIZABLE=NO,toolbar=0,left=300,top=100, width=\'+screen.availWidth+\', height=\'+screen.availHeight+\',scrollbars=yes\'); return false">
                  
                
                endif;
                }
                
              endfor;
      
            echo '</tr>';
            
            
            //for($DM = 1 ; $DM < $TotDiasMes+1 ; $DM++):
          endfor;
      endif;
  
          unset($FECHA_EVAL);

        echo '</div>';
        // End addittional for CondorsHouse
      
      echo '</tr>';
    
    endfor;
    
     ?>
        <!--</td>
       </tr>-->
       
       
       <tr>
         <td style="width:10px" class="">&nbsp;</td>
       </tr>
       <tr>
         <td style="width:10px" class="">&nbsp;</td>
       </tr>
       <tr>
         <td style="width:10px" class="">&nbsp;</td>
       </tr>
     </table>
    </div>
     
    </td></tr>

  </table>
  <br />
<br />

</form>

<?PHP endif;?>
<!--</div>
 </div> -->


<!-- ******************************************************
                              MODALS
**********************************************************-->

<!-- Modal New reservation -->
<div class="modal fade " id="add_reservation" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="title-modal">Reservación <?php echo $_GET['title']?></h4>
      </div>
      <div class="modal-body" id="add-reservation-content">
        Cargando...
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Agregar Usuario</button>
      </div> -->
    </div>
  </div>
</div>
<!-- End New reservation -->


<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>

</image>
</td>
</tr>
</table>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>

