<script src="SpryAssets/SpryTabbedPanels_RolTurnoDespa.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels_RolTurnoDespa.css" rel="stylesheet" type="text/css" />
<!--
<style type="text/css">
#loadingg{position:absolute;top:0; left:0;height:2600px; width:100%; background-color:#000000;-khtml-opacity:.50; -moz-opacity:.50; filter:alpha(opacity=50); opacity:.50; zoom:1; cursor:wait; z-index:100}
</style>
-->
<!--<div id="loadingg"></div>-->
<div id="" style="width:100%"><!-- areaEdicionUsuario-->
<!-- 
	========================== CREAR ROL DE TURNO =========================
-->
<script language="javascript">
	
	// VERIFICAR QUE NO SELECCIONEN DOS USUARIOS EN EL MISMO LIST
	// (LA PEREZA DE LOS SUPERVISORES DE PRE-HOSPIT)
	function NoDuplicar(TotUSer , iDCampo )
	{
			
	}	
</script>
<!--
<div id="question" style="display:none; cursor: default">
        <h1>Esta seguro?.</h1>
        <input type="button" id="yes" class="Estilo_botones" value="Yes" />

        <input type="button" id="no" class="Estilo_botones" value="No" />
</div>
-->
<!--
<script language="javascript">
		onload=function(){
		document.getElementById('loadingg').style.display='none';}
		// El label cargando...
		document.getElementById('mostrarTiempo').style.display	=	'none';
		document.getElementById('mostrarTiempo').style.visibility	=	'hidden';
</script>
<?PHP
/*
	echo '
		 <style type="text/css">
			 #loadingg{position:absolute;top:200; left:0;height:2600px; width:100%; background-color:#000000;-khtml-opacity:.50; -moz-opacity:.50; filter:alpha(opacity=50); opacity:.50; zoom:1; cursor:wait; z-index:100}
		  </style>';
	echo '<div id="loadingg" style="text-align:center; color:#FFF;"><strong>Espere porfavor...</strong></div>';
	*/
?>
-->
<form id="FrmRolTurno" name="FrmRolTurno" method="post" action="">
<div class="COMMON_titulo" id="USR_titulo" style="margin-top:10px">&nbsp;<image name="iconoUser" id="iconoUser" src="<?php $objCMS->imagenURL('calendar.png');?>" border="0" width="19px" height="19px" title="Roles de turnos" />
<?php echo _('Roles de Turnos');?>
</div>
<!--<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; background-color:#D5FFFF; color:#F00;"> &nbsp;&nbsp;Revisar las actualizaciones del sistema vrs. 1.0 <a href="ventanas/sad_Actualizaciones.php?lightbox[iframe]=true&lightbox[width]=80p&lightbox[height]=400" class="lightbox">AQUI</a></div>-->
<?php
	if(empty($P_ocultar)):
?>
<table id="VerAyuda" border="0" class="bordeTodalaTabla_2" cellpadding="0" cellspacing="0" align="center" style="display:none;width:60%; font-family:Verdana, Geneva, sans-serif; font-size:12px">
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
      <tr>
        <td colspan="3">&nbsp;[ <image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('add.png');?>" border="0" /> ] Hacer un nuevo rol de turno</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;[ <image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('buscar_03.png');?>" border="0" /> ] Buscar roles de turnos, por criterio de consulta</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;[ <image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('actualiza.png');?>" border="0" width="15px" /> ] Actualizar la pantalla (Se pierde cualquier opci&oacute;n seleccionada)</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;Opciones de proceso:</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp; 1. Para generar el rol de turno debe seleccionar (&Aacute;rea, Cuantos usuarios, Fecha, Grupo y tipo de horario).</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp; 2. Puede cambiar cualquier valor de los turnos, este cambio se guardara inmediatamente.</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp; 3. Luego de hacer todos los cambios necesarios en el rol de turno, debe guardarlo para que este sea v&aacute;lido.</td>
      </tr>
       <tr>
        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp; 4. Tiene la opci&oacute;n de imprimir el rol de turno [ <image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('print.gif');?>" border="0" /> ], si es que lo desea.</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
 </table>
<div>
<font size="1" face="Verdana, Geneva, sans-serif"></font>
    <table align="center" class="bordeTodalaTabla_3 bordered" style="width:60%;font-family:Verdana, Geneva, sans-serif; font-size:12px; background-color:#FFF">
      <tr align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td width="25%" bgcolor="#EBEBEB" id="OptNuevo" onmouseover="SombreadoCampos('OptNuevo','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptNuevo','0')"><a href="?pag=rolturnoPH" id="Nuevo"><image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('add.png');?>" border="0" /> Nuevo</a></td>
       <?PHP
	   if($objPermiso->tienePermiso(41100103)):
	   ?>
        <td width="20%" bgcolor="#EBEBEB" id="OptEdit" onmouseover="SombreadoCampos('OptEdit','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptEdit','0')"><a href="?pag=defaultAdmin&pags=buscarPREH&optm=sera&padr=preh"><image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('buscar_03.png');?>" border="0" /> 
        Buscar</a></td>
         <?PHP ;else: echo '<td bgcolor="#EBEBEB">&nbsp;</td>'; endif;?>
        <td width="27%" bgcolor="#EBEBEB" id="OptElim" onmouseover="SombreadoCampos('OptElim','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptElim','0')"><a href="#" onclick="cambiarDisplay('VerAyuda','true')"><image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('cruz-roja.png');?>" border="0" /> Ayuda <image name="iconoInfoGen1" id="iconoInfoGen1" src="<?php $objCMS->imagenURL('ar11-l.gif');?>" border="0" title="Ver la ayuda" /></a></td>
       <td width="28%" bgcolor="#EBEBEB" id="OptRefresh" onmouseover="SombreadoCampos('OptRefresh','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptRefresh','0')"><a href="?pag=defaultAdmin&pags=prehosp"><image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('cruz-roja.png');?>" border="0" /> Regresar al Men&uacute;</a></td>
	   </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px" height="100px">
        <td  id="OptAreas" onmouseover="SombreadoCampos('OptAreas','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptAreas','0')" valign="middle" align="center">&nbsp;&nbsp; Seleccione un &Aacute;rea:<br /><br />
      <a href="#" onclick="cambiarDisplay('OtrosParam','true');cambiarDisplay('tbl_otros_param','true');" style="text-decoration:blink; color:#600">Otros Parametros.</a><!--&Aacute;reas:
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
        <td colspan="2" align="center" id="OptLisArea" onmouseover="SombreadoCampos('OptLisArea','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptLisArea','0')">
		
		<!-- SELEC AREA -->	

		<?php
			//multiple="multiple" 
        	echo '
				<select name="select_areas[]" size="5" id="select_areas[]" style="width:250px; font-size:10px" onchange="javascript: if(document.getElementById(\'select_areas[]\').value==\'5\'){ document.getElementById(\'ngrupo\').disabled=\'disabled\'}else{document.getElementById(\'ngrupo\').disabled=\'\'} ">
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

        <td id="OptBotonGen" align="center" onmouseover="SombreadoCampos('OptBotonGen','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptBotonGen','0')">
        <input type="submit" name="buttonGen" class="Estilo_botones" id="buttonGen" value="Generar" onClick="javascript:
        //alert(RecorrerForm('FrmRolTurno','2'))
        //if((RecorrerForm('FrmRolTurno','1') == '' || RecorrerForm('FrmRolTurno','1') == 0)) //&& document.getElementById(\'select_areas[]\').disabled == false
        
        // SELECCIONAR UN AREA
		if(document.getElementById('select_areas[]').value=='')        
        {
            	document.getElementById('select_areas[]').style.border		=	'1px solid #BDB737';	
				document.getElementById('select_areas[]').style.borderColor	=	'red';	
            	Sexyy.alert('Debe seleccionar un area.');
            	return (false)
        }
        		//Si seleccionan T. Puestos Lanz
                //Todas las formulas para uno en especìfico
	           	if(document.getElementById('select_areas[]').value=='15'){
                	document.getElementById('nombre_puesto').style.border					='1px solid #BDB737';	
                    document.getElementById('nombre_puesto').style.borderColor			='red';	
                	Sexyy.alert('Ingrese el nombre del puesto de lanzamiento');
                	return false
                }
                
                // SI NO SELECCIONA PARA CUANTOS
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
                
                 // SI NO SELECCIONA EL HORARIO
                    if(document.getElementById('horario').value == '')
                    {
                        document.getElementById('horario').style.border		='1px solid #BDB737';	
                        document.getElementById('horario').style.borderColor	='red';
                        Sexyy.alert('Especifique el tipo de horario por favor.');
                        return (false)
                    }
                
                
                // SI EL AREA SELECCIONADO NO ES PARA SUPERVISORES
                 if(document.getElementById('select_areas[]').value!='5' && document.getElementById('ngrupo').value == '') 
        		{
        			document.getElementById('ngrupo').style.border		='1px solid #BDB737';	
                    document.getElementById('ngrupo').style.borderColor	='red';
                    Sexyy.alert('Especifique un grupo por favor.');
                    return (false)
        		}
                
                if(document.getElementById('ngrupo').value > 10) 
        		{
                	document.getElementById('ngrupo').style.border		='1px solid #BDB737';	
                    document.getElementById('ngrupo').style.borderColor	='red';
                    Sexyy.alert('El valor introducido en el campo grupo no puede ser mayor a 10');
                    return (false)
                
                }
               document.getElementById('DivMensaje').style.display	= 'block';
        ">
        </td>
      </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td colspan="2" align="center"  id="OptAreas2" onmouseover="SombreadoCampos('OptAreas2','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptAreas2','0')">Cuantos usuarios:

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
		?>       </td>
        <td colspan="2" align="center"  id="OptAreas4" onmouseover="SombreadoCampos('OptAreas4','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptAreas4','0')"> Fecha:  de:

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
			if((document.getElementById('de').value != '') && parseInt(document.getElementById('de').value) > parseInt(document.getElementById('a').value))
			{
				Sexyy.alert('Debe hacer una mejor selccion de las fechas.');
				document.getElementById('de').value	=	'';
				document.getElementById('a').value	=	'';
				return false;
			}  
            /*  
            if(document.getElementById('de').value < MesActual || document.getElementById('a').value < MesActual)
            {
            	Sexyy.alert('Debe hacer una mejor selccion de las fechas.');
				document.getElementById('de').value	=	'';
				document.getElementById('a').value	=	'';
				return false;
            } */     
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
        
        
        <tr id="PGrupo">
        <td colspan="2" title="Solo se permiten numeros." align="center" id="OptGrupo" onmouseover="SombreadoCampos('OptGrupo','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptGrupo','0')">Grupo N&ordm;: 
          <input type="text" name="ngrupo" id="ngrupo" maxlength="2" style="width:50px" onkeypress="return permite(event,'num');"/> 
          [valor entre1 a 10]</td>
        <td colspan="2" title="Seleccionar el tipo de horario" align="center" id="OptVacio" onmouseover="SombreadoCampos('OptVacio','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptVacio','0')">T. Horario:
          <select name="horario" id="horario">
          <option value="">-Escoja-</option>
          <?PHP
          	if($ListaHrs != false){
					foreach ($ListaHrs['resultado'] as $reg){
						echo	'<option value="'.$reg['valor'].'">'.strtoupper($reg['valor']).'</option>';
			 		}
				}
		  ?>
          <!--
          <option value="24">24 Horas</option>
          <option value="R">Regular</option>
          -->
          </select> 
          <font color="#660000">[Seleccione  tipo de horario]</font></td>
        </tr>
        
        <tr id="Line">
        <td colspan="4" height="5" id="OptLine" onmouseover="SombreadoCampos('OptLine','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptLine','0')" bgcolor="#EBEBEB"></td>
        </tr>
        <tr id="OtrosParam" style="display:none;font-family:Verdana, Geneva, sans-serif; font-size:12px">
        <td align="center" id="OptEspecial" onmouseover="SombreadoCampos('OptEspecial','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptEspecial','0')">Especial: <br /><font color="#660000">(Seleccionar mas de uno: ctrl+click)</font></td>
        <td colspan="2" id="OptEspecial2" onmouseover="SombreadoCampos('OptEspecial2','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptEspecial2','0')" align="center">
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
        <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana, Geneva, sans-serif; font-size:10px">
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
        </table>
        -->&nbsp;&lt;- Agregar fila extra seg&uacute;n opci&oacute;n seleccionada.</td>
        </tr>
      <tr>
        <td colspan="4" class="fondoAbajoGris" id="OptAreas3" valign="baseline" onmouseover="SombreadoCampos('OptAreas3','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptAreas3','0')">&nbsp;</td>
      </tr>
      </table>
  </div>
  <br />
  <div align="center" id="DivMensaje" style="display:none; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#F00">Espere porfavor...<image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('loader.gif');?>" border="0" /></div>
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
        <td style="font-size:12px">&nbsp;- <image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('actualiza.png');?>" border="0" width="15px" /> Actualizar: Se realiza nuevamente una consulta segun los datos ya seleccionados para el rol de turno.</td>
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
        <table width="100%" class="bordered"  cellpadding="0" cellspacing="0" align="center">
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
	<td style="font-size:10px;font-family:Verdana" align="right"><a href="?pag=rolturnoPH&opt=back" onclick="javascript: if(!confirm('Esta seguro?')){ return false;}"> <image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('regresar.GIF');?>" border="0" /> REGRESAR</a></td>	
	</tr>
	<tr>  
	<td>
	<!-- OPCIONES DENTRO DE LOS ROLES 
		  ============================	
	-->
	<table width="100%" class="bordeTodalaTabla_2" style="font-size:12px;font-family:Verdana">
	<tr bgcolor="#EBEBEB">
		<?PHP if(isset($P_VerPrint) == FALSE):?>
        <td width="180" id="OptOpcion1" style="width:180px" onmouseover="SombreadoCampos('OptOpcion1','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion1','0')"><!-- javascript: self.location=('?pag=rolturno')-->
		&nbsp;<!--<image name="infoEditar" id="infoEditar" src="<?php $objCMS->imagenURL('disk.png');?>" border="0" /> <a href="#" id="OptSave" onclick="" title="Guardar este rol de turno"> Guardar </a>-->
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
		&nbsp;<image name="ayuda" id="ayuda" src="<?php //$objCMS->imagenURL('actualiza.png');?>" border="0" width="15px" /><a href="javascript: parent.location.reload();" style="" title="Se genera otro rol de turno aleatorio"> Actualizar </a>
		</td>-->
		<?PHP if(isset($P_VerPrint) == true):?>
        <td width="125"  id="OptOpcion3" onmouseover="SombreadoCampos('OptOpcion3','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion3','0')" align="center">
		&nbsp;<!--<image name="infoEditar" id="infoEditar" src="<?php //$objCMS->imagenURL('print.gif');?>" border="0" /> -->
        <?PHP echo $P_ParaPrint;?>
        <!--<a id="OptPrint" href="#" onClick="javascript: window.open('ventanas/911_PrintRolTurnoDespa.php?fechade=<?PHP echo $POSTARR[1]?>&fechaa=<?PHP echo $POSTARR[2]?>&area=<?PHP echo $POSTARR[0]?>&fechahoy=<?PHP echo $POSTARR[3]?>','','status=0,scrollbars=0,width=700,height=400');" title="Guardar este rol de turno"> Imprimir </a>-->
        <!-- if(document.getElementById('OptSave').onclick != TRUE){this.onclick = function(){return false;}}-->
		</td>
        <?PHP endif;?>
		<td width="581"  id="OptOpcion4" onmouseover="SombreadoCampos('OptOpcion4','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion4','0')" style="font-size:14px; font-family:Verdana, Geneva, sans-serif; color:#600"><?PHP echo isset($P_Areas)?$P_Areas:'';?><input type="hidden" id="mantenerArea" name="mantenerArea" value="<?PHP echo $P_Areas?>" />
		  <input type="hidden" name="PDATA" id="PDATA" value="<?PHP echo $P_Data?>" />
		  <input type="hidden" name="PIDDEPTO" id="PIDDEPTO" value="<?PHP echo $PIDDEPTO;?>" />
		  <input type="hidden" name="date" id="date" value="<?PHP echo $date?>"/>
		  <input type="hidden" name="de" id="de" value="<?PHP echo $POST[3]?>"/>
		  <input type="hidden" name="a" id="a" value="<?PHP echo $POST[4]?>"/>
		  <input type="hidden" name="cuantosuser" id="cuantosuser" value="<?PHP echo $POST[2]?>"/>
		  <input type="hidden" name="tabla_tmp_area" id="tabla_tmp_area" value="<?PHP echo isset($NAMETBLTMP)?$NAMETBLTMP:''?>" />
		  <input type="hidden" name="tipo_horario" id="tipo_horario" value="<?PHP echo isset($POST_horario)?$POST_horario:''?>" /></td>
		<td width="149" align="right"  id="OptOpcion5" onmouseover="SombreadoCampos('OptOpcion5','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion5','0')">
		  <input type="submit" name="buttonSalir" id="buttonSalir" value="Salir" class="Estilo_botones" onclick="javascript: if(confirm('Esta seguro?')){ self.location=('?pag=defaultAdmin')}else{return false}" /></td>
		<td align="center" width="113"  id="OptOpcion7" onmouseover="SombreadoCampos('OptOpcion7','1'); this.style.Cursor='pointer'" onmouseout="SombreadoCampos('OptOpcion7','0')"> <image name="ayuda" id="ayuda" src="<?php $objCMS->imagenURL('ayuda2.png');?>" border="0" /> <a href="#" onclick="cambiarDisplay('VerAyuda','true')">Ayuda <image name="iconoInfoGen1" id="iconoInfoGen1" src="<?php $objCMS->imagenURL('ar11-l.gif');?>" border="0" title="Ver la ayuda" /></a></td>
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
          <?PHP echo $P_Spry;?>
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
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1",false,0);
//-->
</script>
