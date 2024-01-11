// JavaScript Document
// DMC
//function delay(){
//    setTimeout('afterFiveSeconds()',5000)
//}
function RevisarCamposDMC()
         //RevisarCampos()
{
	
	var msg		=	Array();
	var campo	=	Array();
	var total	=	9;
	var i		=	false;
	
	campo[0]	=	document.getElementById("empresa");
	campo[1]	=	document.getElementById("total_formularios");
	campo[2]	=	document.getElementById("num_hasta");
	campo[3]	=	document.getElementById("formaPago");
	campo[4]	=	document.getElementById("estado");
	campo[5]	=	document.getElementById("entidad");
	campo[6]	=	document.getElementById("usuario_compra");
	campo[7]	=	document.getElementById("tasaServicio");
	
	msg[0]		=	"Empresa";
	msg[1]		=	"Total de formularios \n Para que se genere el numero de formulario: hasta";
	msg[2]		=	"Hasta, introduciendo el total de formularios";
	msg[3]		=	"Forma de Pago";
	msg[4]		=	"Estado";
	msg[5]		=	"Entidad";
	msg[6]		=	"Quien comrpa";
	msg[7]		=	"Tasa de Servicio"
	
	for(i=0;i<total;i++)
	{
		if(i == 0 && campo[0].value == '0_0_0')
		{
			alert("Es necesario completar el campo empresa");
			campo[0].value 				=	'';
			campo[0].style.border 		=	'1px solid #BDB737';
			campo[0].style.borderColor	=	"red";
			campo[0].focus();
			return false
		}
		
		if(campo[i].value=="")
		{
			if(i == 2)
			{
				i= (i - 1);
				
			}
			alert("Es necesario completar el campo "+ msg[i]);
			//campo[i].focus();
			
			campo[i].style.border 		=	'1px solid #BDB737';
			campo[i].style.borderColor	=	"red";
			campo[i].focus();
				
			return false;
		}
		
	}
	/*
	var idE		=	'<?php echo $_POST[empresa] ?>';
	var idEnt	=	'<?php echo $_POST[entidad]?>';
	var idT		=	'<?php echo $_POST[tramite]?>';
	var idMt	=	'<?php echo $_POST[monto]?>';
	var totalF	=	'<?php echo $_POST[total_formularios]?>';
	var idTasa	=	'<?php echo $_POST[tasaServicio]?>';
	var idR		=	'<?php echo $_POST[n_recibo]?>';
	alert(idE)
	window.open('frame_print.php?idPrint=1&idE=' +  idE + '&idEnt=' + idEnt + '&idT=' + idT + '&idMt=' + idMt + '&totalF=' + totalF + '&idTasa=' + idTasa + '&idR=' + idR + '', '', 'width=900px,height=400px,scrollbars=yes');
	*/
}
function ResolusionPantalla()
{
	//else 
   	if (screen.width < 1280) 
	{
      var mensaje = '<font color=red> &nbsp;<image name=btnImprimir id=btnImprimir src=image/ar11l-.gif border=0/>Para ver mejor el formulario DMC, su resolución mínima de pantalla debe ser: 1280 X 720. \n <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click <a href=PRESENTACIONES_SIT/CAMBIAR_RESOLUCION.doc>AQUI</a> para ver un instructivo de como cambiar su resolución.</font>';
	  var tu_resolucion = screen.width + " x " + screen.height;//Sexyy.alert("Debe cambiar la resolusion de su pantalla para poder ver este formulario. \n \n Cambie a 1280 X 720 como minimo.") 
	  return (mensaje);
	}
	else
	{
		return "";	
	}
}
	// else 
    //  Sexyy.alert("Grande") 

//}

function vista()
{
	//desaparece el boton
	document.getElementById("btnImprimir").style.display='none'
	//document.getElementById("btnImprimir2").style.display='none'
	//document.getElementById("btnVistaPreliminar").style.display='none'
	//document.getElementById("btnVistaPreliminar2").style.display='none'
	
	var OLECMDID =7 ;
	/* OLECMDID values:
	* 6 - print
	* 7 - print preview
	* 1 - open window
	* 4 - Save As
	*/
	var PROMPT = 1; // 2 DONTPROMPTUSER
	var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
	document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
	WebBrowser1.ExecWB(OLECMDID, PROMPT);
	WebBrowser1.outerHTML = "";
	
	//reaparece el boton
	document.getElementById("btnImprimir").style.display='inline'
	//document.getElementById("btnImprimir2").style.display='inline'
	//document.getElementById("btnVistaPreliminar").style.display='inline'
	//document.getElementById("btnVistaPreliminar2").style.display='inline'
}

function imprime()
{
	//desaparece el boton
	document.getElementById("btnImprimir").style.display='none'
	//document.getElementById("btnImprimir2").style.display='none'
	document.getElementById("btnVistaPreliminar").style.display='none'
	document.getElementById("btnVistaPreliminar2").style.display='none'
	//se imprime la pagina
	window.print()
	//reaparece el boton
	document.getElementById("btnImprimir").style.display='inline'
	document.getElementById("btnImprimir2").style.display='inline'
	document.getElementById("btnVistaPreliminar").style.display='inline'
	document.getElementById("btnVistaPreliminar2").style.display='inline'
}

var ayuda	=	'<br><br> Haga click en Ayuda <image name=btnImprimir id=btnImprimir src=image/ar11-l.gif border=0/>&nbsp;&nbsp;para conocer el proceso.';


function RevisalosDatos()
{
	if(!confirm('Esta seguro de esta acción? \n\n\n Si presiona Aceptar, ya no podra hacer cambios a este formulario \n\n\n No cierre el formulario que se abrira ya que es para imprimir el formulario DMC'))
     {
      	return false
     }
      else 
     { 
					if(document.getElementById('radio1').checked == true && document.getElementById('entrada').value == '')
					{
						Sexyy.alert('Debe introducir un valor en el campo de texo entrada')
            			return false
					}
				
					if(document.getElementById('radio2').checked == true  && document.getElementById('salida').value == '')
					{
						Sexyy.alert('Debe introducir un valor en el campo de texo salida')
            			return false
					}
				
					if(document.getElementById('radio3').checked == true  && document.getElementById('traspaso').value == '')
					{
						Sexyy.alert('Debe introducir un valor en el campo de texo traspaso')
            			return false
					}
					if(document.getElementById('radio1').checked == false && document.getElementById('radio2').checked == false && document.getElementById('radio3').checked == false)
					{
						Sexyy.alert('Debe Seleccionar una de las tres opciones: (Entrada , Salida ó Traspaso).' + ayuda)
            			return false
					}
				if(document.getElementById('cia_import').value == '' || document.getElementById('cia_export').value == '')
                {
                	Sexyy.alert('Debe introducir la Compañía Importadora y Exportadora')
            		return false
                }
                else
                {
					if(document.getElementById('numero_factura').value == "")
					{
						Sexyy.alert('Debe ingresar el Nº de Factura' + ayuda)
						document.getElementById('numero_factura').style.border 		=	'1px solid #BDB737';
						document.getElementById('numero_factura').style.borderColor	=	"red";
						document.getElementById('numero_factura').focus();
            			return false
					}
					
					if(document.getElementById('cant_0').value == "")
					{
						Sexyy.alert('Debe introducir como mínimo un registro en: cant. , clase , descripción etc...');
						document.getElementById('cant_0').style.border 		=	'1px solid #BDB737';
						document.getElementById('cant_0').style.borderColor	=	"red";
						document.getElementById('cant_0').focus();
            			return false
					}
					else
					{
						
						//if((document.getElementById('cant_20').value == "" || document.getElementById('cant_20').value == 0) && (document.getElementById('cant_40').value == "" || document.getElementById('cant_40').value == 0) && (document.getElementById('hq').value == "" || document.getElementById('hq').value == 0) && (document.getElementById('frozen').value == "" || document.getElementById('frozen').value == 0))
						if((document.getElementById('cant_20').value == "" ) && (document.getElementById('cant_40').value == "") && (document.getElementById('hq').value == "") && (document.getElementById('frozen').value == ""))
						{
							Sexyy.alert('Debe introducir un valor dentro de "CONTENEDOR"');
							return false
						}
						else
						{
							//var num_form	=	document.getElementById('num_form').value;
							document.generar_dmc.submit(); 
							imprime();
							//window.open('pdf/Formulario_DMC.php?num_form=' + num_form +'','','screenX=20,screenY=100');
						}
					}
		}
     }	
}

//Grabar los datos para ser visto luego
function GrabarDatos()
{
	var msg		=	Array();
	var campo	=	Array();
	var total	=	8;
	var i		=	false;
	var	error	=	0;
	
	
	if(document.getElementById('radio1').checked == true && document.getElementById('entrada').value == '')
	{
		error++ ;
		//Sexyy.alert('Debe introducir un valor en el campo de texo entrada')
        //return false
	}
	if(document.getElementById('radio2').checked == true  && document.getElementById('salida').value == '')
	{
		//Sexyy.alert('Debe introducir un valor en el campo de texo salida')
        //return false
		error++;
		
	}
				
	if(document.getElementById('radio3').checked == true && document.getElementById('traspaso').value == '')
	{
		//Sexyy.alert('Debe introducir un valor en el campo de texo traspaso')
        //return false
		error++;
	}
	if(document.getElementById('radio1').checked == false && document.getElementById('radio2').checked == false && document.getElementById('radio3').checked == false)
	{
		Sexyy.alert('Debe Seleccionar una de las tres opciones (Entrada , Salida ó Traspaso) para poder guardar el formulario. ' + ayuda)
    	return false
	}
	
	//alert("nla nla: " + error)
	
	campo[0]		=	document.getElementById('cia_import');
	campo[1]		=	document.getElementById('cia_export');
	campo[2]		=	document.getElementById('cant_0');
	campo[3]		=	document.getElementById('clase_0');
	campo[4]		=	document.getElementById('descripcion_0');
	campo[5]		=	document.getElementById('peso_0');
	campo[6]		=	document.getElementById('valor_0');
	campo[7]		=	document.getElementById('numero_factura');
	
	msg[0]			=	"CIA. Importadora";
	msg[1]			=	"CIA. Exportadora";
	msg[2]			=	"Bultos: Cantidad";
	msg[3]			=	"Bultos: Clase";
	msg[4]			=	"Descripción del Artículo";
	msg[5]			=	"Peso Bruto";
	msg[6]			=	"Valor en: ?";
	msg[7]			=	"Nº Factura";
	
	for(i=0;i<total;i++)
	{
		if(campo[i].value=="")
		{
			Sexyy.alert("Es necesario completar el campo: "+ msg[i] + ayuda)
			//campo[i].focus();
			
			campo[i].style.border 		=	'1px solid #BDB737';
			campo[i].style.borderColor	=	"red";
			campo[i].focus();
				
			return false;
		}
		
	}
	
	if(error > 0)
	{
		Sexyy.alert('Debe seleccionar entre (Entrada , Salida ó Traspaso) , para poder guardar el formulario. ' + ayuda)
    	return false;
	}
	else
	{
		//var form	=	'<?echo $_GET[form]?>';
		//var id		=	'<?echo $_GET[id]?>';
		//window.self.location= ('?pag=generarDMC&form=' + form + '&id=' + id + '&110=L&id_dn=<?php echo $_GET[id_dn]?>&110');
		return true	
	}
	
	
}

//ARITMETICA EN TOTAL_FOB, FLTE , SEGURO, OTROS_GASTOS Y TOTAL CIF
function TotalesDMC(campo)
{
	var comodin_sumar;
	var total		=	document.getElementById(campo).value;
	var comodin_sumar 	= 	'';
	var sub_total	=	0;
	var total_cif	=	0;
	switch(campo)
	{
		case 'total_fob':
			for(a = 0 ; a < 10 ; a++){
				if(document.getElementById('valor_' + a).value != '')
				{
					sub_total +=  parseFloat(document.getElementById('valor_' + a).value);
					document.getElementById('autosuma').disabled = true
				}
			}
		
			comodin_sumar	=	sub_total;
			total_cif		=	(comodin_sumar + parseFloat(document.getElementById('flete').value) + parseFloat(document.getElementById('seguro').value) + parseFloat(document.getElementById('otros_gastos').value));
			
		break;
	}
	//alert(comodin_sumar)+
	document.getElementById('total_fob').value	=	comodin_sumar.toFixed(2);	
	//document.getElementById(campo).value		=	comodin_sumar.toFixed(2);		//CAMPO 
	document.getElementById('total_cif').value	=	total_cif.toFixed(2);			//CAMPO TOTAL CIF
}

//VER Y OCULTAR MENSAJES
	function Ver_Mensajes(contenedor , mensaje)
	{
				document.getElementById(contenedor).value = mensaje;
	}



