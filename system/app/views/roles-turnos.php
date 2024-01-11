<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/DataTables/media/css/DT_bootstrap.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/SpryAssets/SpryTabbedPanels_RolTurnoDespa.js" type="text/javascript"></script>
<link href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/SpryAssets/SpryTabbedPanels_RolTurnoDespa.css" rel="stylesheet" type="text/css" />

<body>
<div class="row view-container">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

      <div class="x_title">
        <h3>Roles de Turnos</h3>
        <!-- <div class="clearfix"></div>
        <label id="mssg-window"><?=$mssg?></label> -->
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- start: ROLES DE TURNOS PANEL -->
            <div class="panel panel-default">
                <div class="panel-heading">
                <i class="fa fa-calendar"></i>Roles de Turnis
                </div>
                
                <div class="clearfix">&nbsp;</div> 
                
                <div class="container">
                  <!-- Row 1 -->
                  <div class="col-md-3 col-sm-3">Departamento:
                  <select class="select-departamento">
                  <option value="">seleccionar</option>
                  <?php 
                  foreach ($sqlDeptos['resultado'] as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                  }
                  ?>
                  </select>
                  </div>
                  <div class="col-md-9 col-sm-9">Área:
                  <select class="select-areas" id="select-areas" multiple>
                  </select>
                  </div>
                  <!-- Row 2 -->
                  <div class="col-md-3 col-sm-3">
                  Total de usuario:
                  <input class="form-control" min="1" name="cuantos" id="cuantos" value="<?php if (isset($_POST['users_rol'])) { echo $_POST['users_rol']; } else { echo 1; }?>" type="number" />
                  </div>
                  <div class="col-md-3 col-sm-3">Fecha desde
                  <select class="form-control select-fecha-desde"></select>
                  </div>
                  <div class="col-md-3 col-sm-3">Fecha hasta
                  <select class="form-control select-fecha-hasta"></select>
                  </div>
                  <div class="col-md-3 col-sm-3">Año
                  <select class="form-control select-year"></select>
                  </div>

                  <!-- Row 3 -->
                  <div class="col-md-3 col-sm-3">&nbsp;</div>
                  
                  

                </div>

                <!-- Buttons -->
                  <div class="row">
                    <div class="col-md-6 text-right">
                    <small>Generar Rol de Turno Automáticamente</small>
                    <br>
                    <button name="btn-generar-rol-auto" class="btn btn-primary" >Rol de Turno - Automático</button>
                    </div>
                    <div class="col-md-6 text-left">
                    <small>Generar Rol de Turno Manualmente</small>
                    <br>
                    <button name="btn-generar-rol-manual" class="btn btn-primary" <?=$disableBtnMan?>>Rol de Turno - Manual</button>
                    </div>

                    <div class="col-md-3 col-sm-3">&nbsp;</div>

                  </div>


            </div>
        </div>
    </div>





</div>
</div>


<div class="clearfix">&nbsp;</div>

<div id="" class="col-md-12 col-sm-12">

<form id="FrmRolTurno" name="FrmRolTurno" method="post" action="">
<!-- <div class="COMMON_titulo" id="USR_titulo">&nbsp;<image name="iconoUser" id="iconoUser" src="assets/image/calendar.png" border="0" width="19px" height="19px" title="Roles de turnos" />
<?php echo $TitPaginaInterna[1];?>
</div> -->
<!--<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; background-color:#D5FFFF; color:#F00;"> &nbsp;&nbsp;Revisar las actualizaciones del sistema vrs. 1.0 <a href="ventanas/sad_Actualizaciones.php?lightbox[iframe]=true&lightbox[width]=80p&lightbox[height]=400" class="lightbox">AQUI</a></div>-->
<?php
	if(empty($P_ocultar)):
?>

<div>
<!-- 
<div class="clearfix">&nbsp;</div> 
-->






<div class="clearfix">&nbsp;</div> 



<div class="clearfix">&nbsp;</div> 

    <table border="0" align="center" class="bordeTodalaTabla_2  bordered col-md-12" >
      <tr align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td colspan="4" bgcolor="#EBEBEB" id="OptNuevo">&nbsp;</td>
	   </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px" height="100px">
        <td  id="OptAreas" valign="middle" align="center">&nbsp;&nbsp; Seleccione un &Aacute;rea:<br /><br />
      <a href="#" onclick="cambiarDisplay('OtrosParam','true')" style="text-decoration:blink; color:#600">Click Otros Parametros.</a><!--&Aacute;reas:
         <br /> <?php
			echo 'Todos: <input type="checkbox" name="todos" id="todos" value="todos" onclick="javascript:
				document.getElementById(\'select_areas[]\').disabled=!document.getElementById(\'select_areas[]\').disabled
				if(document.getElementById(\'select_areas[]\').disabled == true)
				{
					//alert(\'BLOQUEADO\');
					document.getElementById(\'select_areas[]\').style.border			=\'1px solid #BDB737\';	
					document.getElementById(\'select_areas[]\').style.borderColor		=\'red\';	
					document.getElementById(\'select_areas[]\').style.backgroundColor  	= \'gray\';
					
				}else
				{
					//alert(\'DES - BLOQUEADO\');
					document.getElementById(\'select_areas[]\').style.border			=\'1px solid #ffffff\';	
					document.getElementById(\'select_areas[]\').style.borderColor		=\'\';
					document.getElementById(\'select_areas[]\').style.backgroundColor  	= \'#ffffff\';
				}
				
				" />';
        ?>
        --></td>
        <td colspan="2" align="center" id="OptLisArea" >
		
		<!-- SELEC AREA -->	

		<?php
			//multiple="multiple" 
        	echo '
				<select name="select_areas[]" size="5" id="select_areas[]" style="width:250px; font-size:10px" onchange="">
				<option value="">...</option>
				';
				if($ListaAreas != false){
					foreach ($ListaAreas['resultado'] as $reg){
						echo	'<option value="'.$reg['id'].'">'.strtoupper($reg['nombre']).'</option>';
			 		}
				}
		echo '</select>';
		echo '';
		?>
        <div id="mssg"></div>
        </td>
        
        <!-- BOTON GENERAR -->

        <td id="OptBotonGen" align="center">
        <input type="submit" name="buttonGen" class="Estilo_botones bordered" id="buttonGen" value="Generar" onClick="javascript:
        //alert(RecorrerForm('FrmRolTurno','2'))
        //if((RecorrerForm('FrmRolTurno','1') == '' || RecorrerForm('FrmRolTurno','1') == 0)) //&& document.getElementById(\'select_areas[]\').disabled == false
		if(document.getElementById('select_areas[]').value=='')        
        {
            	document.getElementById('select_areas[]').style.border		='1px solid #BDB737';	
				document.getElementById('select_areas[]').style.borderColor	='red';	
            	Sexyy.alert('Debe seleccionar un area.');
            	return (false)
        }
	           	if(document.getElementById('cuantos').value == '' || document.getElementById('cuantos').value == false)
                {
                    document.getElementById('cuantos').style.border					='1px solid #BDB737';	
                    document.getElementById('cuantos').style.borderColor			='red';	
                    Sexyy.alert('Debe seleccionar para cuantas personas.');
                    return (false)
                }
                else
                {
                	if(document.getElementById('de').value == '' || document.getElementById('a').value == '')
                    {
                    	document.getElementById('de').style.border		='1px solid #BDB737';	
                    	document.getElementById('de').style.borderColor	='red';	
                        document.getElementById('a').style.border		='1px solid #BDB737';	
                    	document.getElementById('a').style.borderColor	='red';	
                        document.getElementById('cuantos').style.borderColor	='';
                    	Sexyy.alert('Debe seleccionar un rango de fecha.');
                    	return (false)
                    }
                }
               document.getElementById('DivMensaje').style.display	= 'block';
        ">
        </td>
      </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td colspan="2" align="center"  id="OptAreas2" >Cuantos usuarios:

			<!-- CUANTOS USUARIOS -->
			         
          <?php
				echo '<select name="cuantos" id="cuantos" style="width:100px">
				   <option value="">-Escoja-</option>
				  ';
					for($i = 1 ; $i < $P_TotUser['usuarios']+10 ; $i++)
					{
						if(!empty($_POST['cuantos']) && $_POST['cuantos']==$i)
						{
							echo '<option value="'.$i.'" selected>'.$i.'</option>';
						}else {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}				
					}
			echo  '</select>';
		?>        </td>
        <td colspan="2" align="center"  id="OptAreas4" > Fecha:  de:

		<select id="de" name="de" class="selectores" style="width:70px" onchange="javascript:
		
		if((document.getElementById('a').value != '') && parseInt(document.getElementById('a').value) < parseInt(document.getElementById('de').value))
			{
				Sexyy.alert('Debe hacer una mejor selccion de las fechas');
				document.getElementById('de').value	=	'';
				document.getElementById('a').value	=	'';
				return false;
			}">
			
			<?php
			
				echo '<option value="">-Escoja-</option> ';
				for($x = 1 ; $x < 13 ; $x++)
				{
					if(isset($_POST['de']) && $_POST['de'] == $DIGITOS[$x])
					{
						echo '<option value="'.$DIGITOS[$x].'" selected>'.$MESES[$x].'</option>';	
					}	else {
						echo '<option value="'.$DIGITOS[$x].'">'.$MESES[$x].'</option>';	
					}			
				}			
			?>
			<!--
    		<option value="01">Enero</option>
    		<option value="02">Febrero</option>
   	 	<option value="03">Marzo</option>
   		<option value="04">Abril</option>
    		<option value="05">Mayo</option>
    		<option value="06">Junio</option>
    		<option value="07">Julio</option>
    		<option value="08">Agosto</option>
    		<option value="09">Septiembre</option>
    		<option value="10">Octubre</option>
    		<option value="11">Noviembre</option>
    		<option value="12">Diciembre</option>
    		-->
  		</select> 
  		<!--          
          <input type="text" name="de" id="de" style="width:80px" readonly="readonly" />
          <image name="calendar-de" id="calendar-de" src="image/b_calendar.png" title="calendario" width="16" height="16" style="cursor:pointer" />
          <script>
    			new Calendar({
                          inputField: "de",
                          dateFormat: "%Y-%m-%d",
                          trigger: "calendar-de",
                          bottomBar: false,
						  onSelect   : function(static) { this.hide() }
                         
                  		});
				</script> 
				-->
          a:
          <select id="a" name="a" class="selectores" style="width:70px" onchange="javascript: 
         // alert(document.getElementById('a').value); alert(document.getElementById('de').value)
         var MesActual		=	'<?PHP echo date("n")?>';
         //alert('es: '+MesActual)
			if((document.getElementById('de').value != '') && parseInt(document.getElementById('de').value) > parseInt(document.getElementById('a').value))
			{
				Sexyy.alert('Debe hacer una mejor selccion de las fechas');
				document.getElementById('de').value	=	'';
				document.getElementById('a').value	=	'';
				return false;
			} 
              
          //return ValidaFecha('de','a')
          ">
          
			<?php
			
				echo '<option value="">-Escoja-</option> ';
				for($d = 1 ; $d < 13 ; $d++)
				{
					if(isset($_POST['a']) && $_POST['a'] == $DIGITOS[$d])
					{
						echo '<option value="'.$DIGITOS[$d].'" selected>'.$MESES[$d].'</option>';	
					}	else {
						echo '<option value="'.$DIGITOS[$d].'">'.$MESES[$d].'</option>';	
					}			
				}			
			?>
			<!--
			<option value="">-Escoja-</option>    		
    		<option value="01">Enero</option>
    		<option value="02">Febrero</option>
   	 	<option value="03">Marzo</option>
   		<option value="04">Abril</option>
    		<option value="05">Mayo</option>
    		<option value="06">Junio</option>
    		<option value="07">Julio</option>
    		<option value="08">Agosto</option>
    		<option value="09">Septiembre</option>
    		<option value="10">Octubre</option>
    		<option value="11">Noviembre</option>
    		<option value="12">Diciembre</option>
    		-->
  		</select> 
  		<!--
          <input type="text" name="a" id="a" style="width:80px" readonly="readonly" />
          <image name="calendar-a" id="calendar-a" src="image/b_calendar.png" title="calendario" width="16" height="16" style="cursor:pointer" />
          <script>
    			new Calendar({
                          inputField: "a",
                          dateFormat: "%Y-%m-%d",
                          trigger: "calendar-a",
                          bottomBar: false,
						  onSelect   : function(static) { this.hide() }
                         
                  		});
				</script>
				-->&nbsp;&nbsp;A&ntilde;o:
                <select id="anyo" name="anyo">
                <?PHP
                for($q = 2010 ; $q < date('Y')+5 ; $q++)
				{
					if($q == date('Y'))
					{
						echo '<option value="'.$q.'" selected>'.$q.'</option>';
					}else
					{
						echo '<option value="'.$q.'">'.$q.'</option>';		
					}
				}	
				?>
                </select></td>
        </tr>
        <tr id="Line">
        <td colspan="4" height="5px" id="OptLine"></td>
        </tr>
         <tr id="OtrosParam" style="display:none;font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td align="center" id="OptEspecial" >Especial: <br /><font color="#660000">(Seleccionar mas de uno: ctrl+click)</font></td>
        <td colspan="2" id="OptEspecial2" align="center">
        <select name="especial[]" size="7" multiple="multiple" id="especial[]" style="width:250px; font-size:10px">
          <option value="">...</option>
          <option value="ADM" title="Horario Administrativo">HRS.ADMINISTRATIVO</option>
          <option value="AC" title="Asignaci&oacute;n Cobertura">ASIG.COBERTURA</option>
          <option value="CA" title="Capacitacion">CAPACITACI&Oacute;N</option>
          <option value="C" title="Compensatorio">COMPENSATORIO</option>
          <option value="EM" title="Embarazada">EMBARAZADA</option>
          <option value="F" title="Feriado">FERIADO</option>
          <option value="CF" title="Compensatorio x Feriado">COMP.FERIADO</option>
          <option value="MF" title="Mision Oficial">MISI&Oacute;N OFICIAL</option>
          <option value="LI" title="Licencia">LICENCIA</option>
          <option value="OP" title="Operativo">OPERATIVO</option>
          <option value="SU" title="Suspendido">SUSPENDIDO</option>
          <option value="TT" title="Tutoria">TUTORIA</option>
          <option value="V" title="Vacaciones">VACACIONES</option>
          <option value="OT" title="Otros">OTROS</option>
        </select>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-size:10px" align="center">
        <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana, Geneva, sans-serif; font-size:10px">
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-size:10px"><input maxlength="2" type="text" name="text_ad" id="text_ad" onkeypress="return permite(event,'num')" size="3px" height="10px"/>
Total en Administrativo</td>
          </tr>
          <tr>
            <td><input maxlength="2"  type="text" name="text_cp" id="text_cp" onkeypress="return permite(event,'num')" size="3px" height="10px" />
          Total de Capacitaciones</td>
          </tr>
          <tr>
            <td><input maxlength="2"  type="text" name="text_emb" id="text_emb" onkeypress="return permite(event,'num')" size="3px" height="10px" />
          Total de Embarazadas</td>
          </tr>
          <tr>
            <td><input maxlength="2"  type="text" name="text_mof" id="text_mof" onkeypress="return permite(event,'num')" size="3px" height="10px" />
          Total Misi&oacute; Ofc.</td>
          </tr>
          <tr>
            <td><input maxlength="2"  type="text" name="text_vac" id="text_vac" onkeypress="return permite(event,'num')" size="3px" height="10px" />
          Total Vacaciones</td>
          </tr>
        </table>-->&nbsp;&lt;- Agregar fila extra seg&uacute;n opci&oacute;n seleccionada.</td>
        </tr>
        <tr>
        <td colspan="4" class="fondoAbajoGris" id="OptAreas3" >&nbsp;</td>
      </tr>
    </table>
  </div>
  <br />
  <div align="center" id="DivMensaje" style="display:none; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#F00">Espere porfavor...<image name="ayuda" id="ayuda" src="assets/image/loader.gif" border="0" /></div>
</form>
<?php endif; ?>
<!--<br />-->
<?PHP
	if(!empty($GET_opt) && $GET_opt == 'busc'):
?>
<form action="?pag=rolturno" method="post" id="FormBuscar" name="FormBuscar">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bordeTodalaTabla_2" width="60%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
  <tr bgcolor="#EBEBEB" >
    <td width="12%">&nbsp;BUSCAR</td>
    <td width="25%">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    <td width="5%" align="center"><image name="cerrar" id="cerrar" src="image/close.gif" title="Cerrar" border="0" onclick="tjavascript: self.location=('?pag=rolturno')" onmouseover='this.style.cursor="pointer"'></td>
  </tr>
  <tr>
    <td height="50" align="right">&nbsp;Por:&nbsp;</td>
    <td>&nbsp;
    <select name="criterio_busq" id="criterio_busq" onchange="
 var opcion	=	document.getElementById('criterio_busq').value;
		switch(opcion)
        {
        	case '1':
            	document.getElementById('bAreas').style.display 	= 'block';
                document.getElementById('bFecha').style.display 	= 'none';
                document.getElementById('bMes').style.display 		= 'none';
                document.getElementById('bSeleccione').style.display= 'none';
            break;
            
            case '2':
            	document.getElementById('bFecha').style.display		= 'block';
                document.getElementById('bAreas').style.display 	= 'none';
                document.getElementById('bMes').style.display 		= 'none';
                document.getElementById('bSeleccione').style.display= 'none';
            break;
            
             case '3':
            	document.getElementById('bFecha').style.display		= 'none';
                document.getElementById('bAreas').style.display 	= 'none';
                document.getElementById('bMes').style.display 		= 'block';
                document.getElementById('bSeleccione').style.display= 'none';
            break;
        }
">
    <option value="">- escoja -</option>
    <option value="1">Por area</option>
    <option value="2">Por fecha</option>
    <option value="3">Por mes</option>
    <option value="4">Combinado</option>
    </select></td>
    <td width="43%">
	<label id="bSeleccione" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#F00">Seleccione para consultar.</label>
	<?php 
			echo "<select name='bAreas' id='bAreas' style='display:none'>";
			echo "<option>...</option>";
	    	if($ListaAreas != false){
					foreach ($ListaAreas['resultado'] as $reg){
								echo	'<option value="'.$reg['id'].'">'.strtoupper($reg['nombre']).'</option>';
			 		}
				}
			echo "
			<option value=T>Todas las direcciones</option>
			</select>";

	   
      		echo '<input type="text" name="numero" id="numero" size="50" style="display:none" />';
	  ?>
      <label id="bFecha" style="display:none">
      De:
      <input type="text" name="fechadesde" id="fechadesde" style="width:75px"  readonly="readonly"/>
      <image name="calendar-fechadesde" id="calendar-fechadesde" src="image/b_calendar.png" title="calendario" width="16" height="16" style="cursor:pointer" />
      <script>
    			new Calendar({
                          inputField: "fechadesde",
                          dateFormat: "%Y-%m-%d",
                          trigger: "calendar-fechadesde",
                          bottomBar: false,
			  onSelect   : function(static) { this.hide() }                         
                  		});
				</script>
      &nbsp;
      A:<input type="text" name="fechahasta" id="fechahasta" style="width:75px"  readonly="readonly"/>
      <image name="calendar-fechahasta" id="calendar-fechahasta" src="image/b_calendar.png" title="calendario" width="16" height="16" style="cursor:pointer" />
      <script>
    			new Calendar({
                          inputField: "fechahasta",
                          dateFormat: "%Y-%m-%d",
                          trigger: "calendar-fechahasta",
                          bottomBar: false,
			  onSelect   : function(static) { this.hide() }                         
                  		});
				</script>
      <font color="#660000" size = "1" face="Verdana, Geneva, sans-serif">
        
      (YY-mm-dd)</font>
      </label>
      
      <label id="bMes" style="display:none">
      <select name="Optmeses" id="Optmeses">
      <option value="">- meses -</option>
     <?PHP
     	$MESES		=	array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		
		for($M	=	1	;	$M	< count($MESES) ; $M++)
		{
			if(isset($_POST) && $POST[1] == $M)
			{
				echo '<option value="'.$M.'" selected>'.$MESES[$M].'</option>';	
			}else
			{
				echo '<option value="'.$M.'">'.$MESES[$M].'</option>';
			}
		}
	 ?>
    </select>
    <select id="anyo" name="anyo">
      <?PHP
                for($q = 2010 ; $q < date("Y")+20 ; $q++)
				{
					if($q == date('Y'))
					{
						echo '<option value="'.$q.'" selected>'.$q.'</option>';
					}
					else
					{
						echo '<option value="'.$q.'">'.$q.'</option>';		
					}
				}	
				?>
    </select>
    </label>
      </td>
    <td width="15%"><input type="submit" name="buttonSearch" id="buttonSearch" value="Consultar" onclick="javascript:
    if(document.getElementById('criterio_busq').value == '')
    {
    	Sexyy.alert('Debe seleccionar alguna opcion para poder consultar');
        return false
    }
    " /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?PHP endif;?>
<?PHP	if (isset($msg) && $msg !=''){ echo '<div class="mensajeValidacion" style="width:38%">'.$msg.'</div>';}?>
<!-- <br />-->
<!-- <br />-->
<!-- 
		TIRAR LOS ROLES
		=================
-->
<?php if(!empty($P_VerSalida)):?>
<table id="VerAyuda" width="90%" border="0" class="bordeTodalaTabla_2" cellpadding="0" cellspacing="0" align="center" style="display:none;">
      <tr bgcolor="#EBEBEB">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">
        <a href="#" onclick="cambiarDisplay('VerAyuda','true')" style="cursor:pointer"><image name="cerrar" id="cerrar" src="image/close.gif" title="Cerrar" border="0" onmouseover="
			  javascript:
			  	document.getElementById('VerAyuda').style.backgroundColor	=	'#ADADAD';
			  " onmouseout="
			  javascript:
			  	document.getElementById('VerAyuda').style.backgroundColor	=	'';
			  "/></a>&nbsp;
        </td>
      </tr>
      <tr >
        <td style="font-size:12px">&nbsp;- Horarios: [ 6:00 am a 2:00 pm] &nbsp; [ 2:00 pm a 10:00 pm] &nbsp; [ 10:00 pm a 6:00 am] </td>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:12px">&nbsp;- <image name="ayuda" id="ayuda" src="assets/image/actualiza.png" border="0" width="15px" /> Actualizar: Se realiza nuevamente una consulta segun los datos ya seleccionados para el rol de turno.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:12px">&nbsp;- Guardar datos: Se guardan los datos con todos los cambios realizados.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:12px; color:#600; text-transform:uppercase">&nbsp; nomenclatura:</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     <tr>
        <td colspan="3" style="font-size:12px">
        <table width="100%" border="1" class="bordered" cellpadding="0" cellspacing="0" align="center">
        <tr>
        <td>&nbsp;ADM: Hr. Administrativo</td>
        <td>&nbsp;AC: Asig. Cobertura</td>
        <td>&nbsp;CA: Capacitaci&oacute;n</td>
        <td>&nbsp;C: Compensatorio</td>
        <td>&nbsp;EM: Embarazada</td>
        <td>&nbsp;F: Feriado</td>
        <td title="Compensatorio por feriado">&nbsp;CF: Comp. Feriado</td>
        </tr>
        <tr>
        <td>&nbsp;MF: Misi&oacute;n Oficial</td>
        <td>&nbsp;LI: Licencia</td>
        <td>&nbsp;OP: Operativo</td>
        <td>&nbsp;SU: Suspendido</td>
        <td>&nbsp;TT: Tutoria</td>
        <td>&nbsp;V: Vacaciones</td>
        <td>&nbsp;OT: Otro</td>
        </tr>
        </table>
        </td>
      </tr>
 </table>
 <div id="mssg" align="center"><?PHP echo isset($MSSG)?strtoupper($MSSG):'';?></div>
 <br />
 <form name="YaMatriz" id="YaMatriz" method="post" action="">
	<table width="90%" border="0" class="bordeTodalaTabla_2" align="center">
	<tr bgcolor="#EBEBEB">  
	<td style="font-size:10px;font-family:Verdana" align="right"><a href="?pag=rolturno&opt=back" onclick="javascript: if(!confirm('Esta seguro?')){ return false;}"> <image name="ayuda" id="ayuda" src="assets/image/regresar.GIF" border="0" /> REGRESAR</a></td>	
	</tr>
	<tr>  
	<td>
	<!-- OPCIONES DENTRO DE LOS ROLES 
		  ============================	
	-->
	<table width="100%" class="bordeTodalaTabla_2" style="font-size:12px;font-family:Verdana">
	<tr bgcolor="#EBEBEB">
		<?PHP if(isset($P_VerPrint) == FALSE):?>
        <td width="180" id="OptOpcion1" style="width:180px" ><!-- javascript: self.location=('?pag=rolturno')-->
		&nbsp;<!--<image name="infoEditar" id="infoEditar" src="assets/image/disk.png" border="0" /> <a href="#" id="OptSave" onclick="" title="Guardar este rol de turno"> Guardar </a>-->
		<?PHP if(isset($P_Err) && $P_Err < 1):?>
        <input type=submit value="Guardar datos" name="BtnGuardarTodo" class="Estilo_botones" style="width:130px" onclick="javascript: 
        if(!confirm('Esta seguro?')){ 
        	return false;
           }else
           {
           	var TOT = '<?PHP echo $POST[2]?>';
            for(i = 1 ; i < TOT+1 ; i++)
            {
            	if(document.getElementById('user-'+i).value == '')
                {
                	Sexyy.alert('Debe seleccionar los usuarios');
                    return false
                }
            }
           }
           document.getElementById('DivMensaje').style.display	= 'block';
           " /><?PHP endif;?>
        </td>
        <?PHP endif;?>
        <!--<td width="121"  id="OptOpcion2" onmouseover="SombreadoCampos('OptOpcion2','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion2','0')">
		&nbsp;<image name="ayuda" id="ayuda" src="assets/image/actualiza.png" border="0" width="15px" /><a href="javascript: parent.location.reload();" style="" title="Se genera otro rol de turno aleatorio"> Actualizar </a>
		</td>-->
		<?PHP if(isset($P_VerPrint) == true):?>
        <td width="125"  id="OptOpcion3" align="center">
		&nbsp;<!--<image name="infoEditar" id="infoEditar" src="assets/image/print.gif" border="0" /> -->
        <?PHP echo $P_ParaPrint;?>
        <!--<a id="OptPrint" href="#" onClick="javascript: window.open('ventanas/911_PrintRolTurnoDespa.php?fechade=<?PHP echo $POSTARR[1]?>&fechaa=<?PHP echo $POSTARR[2]?>&area=<?PHP echo $POSTARR[0]?>&fechahoy=<?PHP echo $POSTARR[3]?>','','status=0,scrollbars=0,width=700,height=400');" title="Guardar este rol de turno"> Imprimir </a>-->
        <!-- if(document.getElementById('OptSave').onclick != TRUE){this.onclick = function(){return false;}}-->
		</td>
        <?PHP endif;?>
		<td width="494"  id="OptOpcion4"  style="font-size:14px; font-family:Verdana, Geneva, sans-serif; color:#600"><?PHP echo isset($P_Areas)?$P_Areas:'';?><input type="hidden" id="mantenerArea" name="mantenerArea" value="<?PHP echo $P_Areas?>" />
		  <input type="hidden" name="PDATA" id="PDATA" value="<?PHP echo $P_Data?>" />
		  <input type="hidden" name="PIDDEPTO" id="PIDDEPTO" value="<?PHP echo $PIDDEPTO;?>" />
		  <input type="hidden" name="date" id="date" value="<?PHP echo $date?>"/>
		  <input type="hidden" name="de" id="de" value="<?PHP echo $POST[3]?>"/>
		  <input type="hidden" name="a" id="a" value="<?PHP echo $POST[4]?>"/>
		  <input type="hidden" name="cuantosuser" id="cuantosuser" value="<?PHP echo $POST[2]?>"/>
          <input type="hidden" name="tabla_tmp_area" id="tabla_tmp_area" value="<?PHP echo isset($NAMETBLTMP)?$NAMETBLTMP:''?>" />
		  <input type="hidden" name="tipo_horario" id="tipo_horario" value="<?PHP echo isset($POST_horario)?$POST_horario:''?>" />
          </td>
		<td width="236" align="center"  id="OptOpcion5" ><input type="submit" name="buttonSalir" id="buttonSalir" value="Salir" class="Estilo_botones" onclick="javascript: if(confirm('Esta seguro?')){ self.location=('?pag=defaultAdmin')}else{return false}" /></td>
		<td align="center" width="113"  id="OptOpcion7"> <image name="ayuda" id="ayuda" src="assets/image/ayuda2.png" border="0" /> <a href="#" onclick="cambiarDisplay('VerAyuda','true')">Ayuda</a></td>
		</tr>
	<tr bgcolor="#EBEBEB">
	  <td colspan="6" style="width:100px"><?php echo $P_TDMeses; ?>
      <div class="mensajes" id="error" align="left" style="background-color:#FFF;"></div>
      </td>
	  </tr>
	<tr bgcolor="#EBEBEB">
	  <td colspan="6"  style="width:100px">
      <div id="TabbedPanels1" class="TabbedPanels" style="width:100%"><!-- background-color:#FFF -->
	    <ul class="TabbedPanelsTabGroup" style="background-color:#FFF">
	      <!--
          <li class="TabbedPanelsTab" tabindex="0">Ficha 1</li>
	      <li class="TabbedPanelsTab" tabindex="0">Ficha 2</li>
          -->
          <?PHP //echo $P_Spry;?>
	      </ul>
	    <div class="TabbedPanelsContentGroup">
	      <!--
          <div class="TabbedPanelsContent">Contenido 1</div>
	      <div class="TabbedPanelsContent">Contenido 2</div>
          -->
          <?PHP echo $P_Conten;?>
	      </div>
	    </div></td>
	  </tr>
	</table>
   
	<!--  FIN DE OPCIONES DENTRO DE LOS ROLES
			===================================
	-->
	</td>	
	</tr>
	<?php
		// Total de filas = Total de usuarios deseados 
		$n			=	0;	
		$x			=	0;
		for($h	=	0	;	$h	<	$POST[2]	;	$h++):	
			$n++;	
			$color2		=	"#E8FFE8";
			$color		=	"#FFFFFF";
	?>
    <!--
	<tr id="fila_<?php echo $n;?>" onMouseOver="this.style.backgroundColor='#becfc4';" onMouseOut="this.style.backgroundColor='';" bgcolor="<?php if($x==0){ echo $color; $x = 1;}else{ echo $color2; $x=0;}?>">  
	
	<td>&nbsp;</td>	

	</tr>	
    -->
	<?php
		endfor;
	?>
    
	<tr class="fondoAbajoGris">  
	<td style="font-size:10px;font-family:Verdana" align="right">SUME 9-1-1</td>	
	</tr>
    <tr>
    <td><!--<div id="usuarioPaginador"><?php echo $objPaginador->generarcontrolPaginacion($total, $actual);?></div>--></td>
    </tr>
	<tr>  
	<td align="left" style="font-size:10px;font-family:Verdana"><?PHP echo isset($msg2)?$msg2:'';?></td>
	</tr>
	</table>
    </form>
	<script>
	tunCalendario();
	establecerFecha();
	</script>
  <!--<input type="text" id="tunAnio" class="selectores" onblur="if(!isNaN(this.value)){anio=this.value;borra();tunCalendario()}" size="4" maxlength="4" />-->
 <?php endif;?>
 <br><br><br><br>
 <!-- 
	FIN TIRAR MATRIZ
	================ 
 -->
</div>

<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

  /**
 * Cancel Rol
 */
const cancelRolManual = () => {
    $('.roles-container').empty();
    $('[name="btn-generar-rol-auto"]').prop('disabled', false);
    subirTopLista();
}
const cancelRolAuto = () => {
    
    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    let area        = $("#area_rol").val();
    let date_from   = $("#date_from").val();
    let year_from   = $("#year_from").val();
    let route       = "app/controllers/roles-turnos.php";

    $.ajax({
        headers : {
            Accept        : "application/json; charset=utf-8",
            "Content-Type": "application/json: charset=utf-8"
        },
        url : route,
        type: "GET",
        data : {
            cancel      : 'rolback',
            id_user     : id_user,
            id_cia      : id_cia,
            area        : area,
            date_from   : date_from,
            year_from   : year_from,
            nocache     : "<?php echo rand(99999,66666); ?>"
        },
        dataType     : 'html',
        success      : function (response) { 
            $('html, body').animate({scrollTop: '0px'},'slow');
            if (response == 1) {
                $("#users_rol").val('1');
                $("#area_rol").val(null).trigger('change');
                $("#date_from").val(null).trigger('change');
                $("#year_from").val(null).trigger('change');
                $('.roles-container').empty();
                $('[name="btn-generar-rol-auto"]').prop('disabled', false);
                //form-container-rol
                //$('.form-container-rol').submit();
                //location.reload();
            }
        },
        error        : function (error) {
        console.log(error);
        }
    });
}

/** Evitar Refresh */
/** Evitar Refresh */
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
$(document).ready(function(){
    $(document).on("keydown", disableF5);
});

/** Manual Button */
$('[name="btn-generar-rol-manual"]').on('click',(e)=>{
    e.preventDefault();
    
    // Params
    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    let area        = e.target.form['area_rol'].value;
    let users       = e.target.form['users_rol'].value;
    let date_from   = e.target.form['date_from'].value;
    //let date_to     = e.target.form['date_to'].value;
    let areaNameSelected    = $('[name="area_rol"]').select2('data');
    let totalUsers          = users;
    let splitDate           = date_from.split('-');
    let monthName           = {'01':'Enero','02':'Febrero','03':'Marzo','04':'Abril','05':'Mayo','06':'Junio','07':'Julio','08':'Agosto','09':'Septiembre','10':'Octubre','11':'Noviembre','12':'Diciembre'};
    let today               = new Date();
    let month               =  Number(splitDate[1]);//today.getMonth();
    let totalMonthDays      = daysInMonth(month, splitDate[0]);

    // Validate 
    if (area == "" || users == "" || date_from == "") {
        $('.alert').show();
        $('.alert').addClass('alert-danger').html('Todos los campos son requeridos');
            setTimeout(()=>{
                $('.alert').hide();
            },4000);
        return false;
    }

    $('[name="btn-generar-rol-auto"]').prop('disabled', true);

    // Go to div container
    gotToDownPage($('.roles-container'));

    let trHTML  = false;
    $('.roles-container').empty();
    $('.fa-spinner').show();

    let listUsers = '<?=$list?>';
    //console.log(listUsers)

    trHTML =` 
    <hr />
    <br />
    <div class='col-md-6 col-sm-6'><button name="btn-generar-rol-auto" class="btn btn-success" >Guardar</button> &nbsp; <button name="btn-cancel-rol-manual" class="btn btn-default btn-cancelar-rol" onclick="cancelRolManual()" >Cancelar</button></div>
    <div class='col-md-3 col-sm-3'><h4>Área: `+areaNameSelected.text+`</h4></div>
    <div class='col-md-3 col-sm-3'><h4>Fecha: `+monthName[splitDate[1]]+ ` ` +splitDate[0]+`</h4></div>`;
    trHTML += `<div class="table-responsive" style="width:100% !important;overflow:auto;"><table style='width:100%' class='table-bordered table-hover' id='table-rol-manual'>`;
    trHTML += `<tr>`;
    trHTML += `<td width='150px'>Usuarios</td>`;
    
    for (i = 1 ; i < totalMonthDays+1 ; i++) {
        trHTML+= `<td style="width:40px;height: 20px;" data-orderable="false" label="c`+i+`" title="Día `+i+`">D`+i+`</td>`;
    }
    trHTML += `</tr>`;
    let rowCount = $('#table-rol-manual tr').length;

    // Rows: Users selector
    for (x = 0; x < users; x++) {
        trHTML +=`<tr class='f-`+(x+1)+`'>`;
        trHTML +=`
            <td>
            <select style='
            top: 100%;
            z-index: 1000;
            min-width: 100%;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.25rem;' 
            data-role="select-dropdown" id='select-`+(x+1)+`' style='width:100%' class='select selectpicker select-users user-select-`+(x+1)+`'>
            <option></option>
            `+listUsers+`
            </select>
            </td>`;
        // Columns: Days
        for (i = 1 ; i < totalMonthDays+1 ; i++) {
            trHTML+= `<td><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="`+(x+1)+`-c`+(i)+`" id="`+(x+1)+`-c`+(i)+`" /></td>`;
        }
        trHTML +=`</tr>`;
    }
    
    trHTML += `</table></div><br /><br />`;
    $('.roles-container').append(trHTML);
    $('.fa-spinner').hide();
});

/** Automatic Button */
$('[name="btn-generar-rol-auto"]').on('click',(e)=>{
    // console.log($('.select-departamento').val())
    // e.preventDefault();

    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';

    let depto       = $('.select-departamento').val(); //e.target.form['select-departamentos'].value;
    let area        = $('.select-areas').val();         //e.target.form['area_rol'].value;
    let users       = $('.select-departamentos').val(); //e.target.form['users_rol'].value;
    let date_from   = $('.select-departamentos').val(); //e.target.form['date_from'].value;
    let date_end    = $('.select-departamentos').val(); //e.target.form['date_from'].value;
    let year        = $('.select-departamentos').val(); //e.target.form['date_from'].value;
    //let date_to     = e.target.form['date_to'].value;

    if (area == "" || users == "" || date_from == "") {
        $('.alert').show();
        $('.alert').addClass('alert-danger').html('Todos los campos son requeridos');
        setTimeout(()=>{
            $('.alert').hide();
        },4000);
        return false;
    }

    // $('[name="btn-generar-rol-manual"]').prop('disabled', true);

    // let route       = "ajax/ajax_generate_rolturno.php";
    // $('.fa-spinner').show();
    
    // $.ajax({
    //     headers : {
    //         Accept        : "application/json; charset=utf-8",
    //         "Content-Type": "application/json: charset=utf-8"
    //     },
    //     url : route,
    //     type: "GET",
    //     data : {
    //         generate: 1,
    //         id_user : id_user,
    //         id_cia  : id_cia,
    //         area    : area,
    //         users   : users,
    //         date_from: date_from,
    //         //date_to  : date_to,
    //         nocache  : "<?php echo rand(99999,66666); ?>"
    //     },
    //     dataType     : 'html',
    //     success      : function (response) { 
    //         $('html, body').animate({scrollTop: '0px'},'slow');
    //         //listResultTable();
    //     },
    //     error        : function (error) {
    //     console.log(error);
    //     }
    // });
});

/** Save Rol de Turnos */
$('.btn-guardar-rol').on('',()=>{
 
  let filas     = [];
  let rowCount  = $('#table-formulas tr').length;

  for (i = 0 ; i < 32; i++) {
    for (y=1;y<rowCount;y++) {
      if($("#f"+y+"-"+i).val()==""){
        $("#mssg-alert").show().html('<div class="alert alert-danger">Debe agregar como mínimo una fila para la formula');
        setTimeout(()=>{
          $("#mssg-alert").hide();
        },3000);
        return false
      }
    }
  }
});

const daysInMonth = (month,year) => {
  return new Date(year, month, 0).getDate();
}
// Go to Top page
const subirTopLista = () => {
	jQuery('html, body').animate({scrollTop: '0px'}, 'slow');
}
// Go to specific area
const gotToDownPage = (element) => {
  $('html, body').animate({
      scrollTop: element.offset().top
  }, 'slow');
}


  $('.select-departamento').on('change',()=>{
    let idDepto = $('.select-departamento').val();
    console.log(idDepto);
    let route = "app/controllers/roles-turnos.php";
    $.ajax({
      headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
        search   : 1,
        depto    : idDepto,
    },
    dataType      : 'json',
    success       : function (response) { 
      let arr = response; 
      $(".select-areas").empty().trigger('change');

      if (arr) {
        $('.select-areas').append('<option>seleccionar</option>');
        arr.forEach((item,key)=>{
          $(".select-areas").append("<option value='"+item.id_depto+"'>"+item.name+"</option>");
        });
      }
      $('.select-areas').trigger('change');
    },
    error         : function (error) { 
      console.log(error);
    }
    });
  });

  $('.select-departamento').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-areas').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-fecha-desde').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-fecha-hasta').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-year').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $("[name='area_rol']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>
<!-- <script src="<?php echo $_ENV['FLD_ASSETS']?>/js/operaciones_en_campos.js"></script> -->
<script type="text/javascript">
<!--
//var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1",false,0);
//-->
</script>
