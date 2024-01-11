// JavaScript Document
// Autor : Augusto Duncan
//         aduncan@aaeepp.gob.pa
/*		   2009, Rep. Panamá
  - Definir que tipo de caracteres
	se permiten en el campo de texto
  - Revisar campos -> Verificar datos de campos, que no esten en blanco (seccion: RegistraCobros)
  - Mostrar y Ocultar filas , tablas , textos , etc...
  - Tipo de cursor.
  - Crear campos de manera Dinmica.
  
	<!--
	##^---------------------------------------------^
	##												=
	##   SISTEMA INTEGRADO DE TRAMITES ( SIT )		=
	##   SINCLAIR AUGUSTO DUNCAN - WEB-PROGRAMMER	=
	##   MAYO - AGOSTO 2009							=
    ##   CORREO:	augustoduncan26@hotmail.com		=
    ##   CORREO:	augustoduncan26@yahoo.com		=
	##	 Panama										=
	##^---------------------------------------------^
	##
	##
	##
	##
 #======#
 -->
*/

function permite(elEvento, permitidos) {
  // Variables que definen los caracteres permitidos
  var numeros 				= 	"0123456789";
  var numeros_esp			= 	" 0123456789:";
  var caracteres 			= 	"abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres 	= 	numeros + caracteres;
  var numeros_puntos		=	"0123456789.";
  var numeros_coma_puntos	=	",0123456789.";
  var pformula				=	"xXcChHvVtTaAsSgGlLADMeEfFiIoOpPuU" + numeros;
 
  // Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num':	//SOLO NUMEROS
      permitidos = numeros;
      break;
    
	case 'car':
      permitidos = caracteres;
      break;
    
	case 'num_car':
      permitidos = numeros_caracteres;
      break;
	
	case 'num_p':
      permitidos = numeros_puntos;
      break;
	  
	case 'num_coma_p':
      permitidos = numeros_coma_puntos;
      break;
	
	case 'numeros_esp':
		permitidos = numeros_esp;
      break;
	
	case 'pform':
		permitidos = pformula;
      break;
	
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  return permitidos.indexOf(caracter) != -1;
}

// ********************************
// Validar lo que se escribe	  *
// en el control				  *
//*********************************
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    //patron =/[A-Za-z\s]/; // 4
    patron = /[0-9-:\s]/;
	te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 

//REVISAR CAMPOS DE LA SECCION RegistrarCobros
//================================================
function RevisarCampos()
         //RevisarCampos()
{
	
	var msg		=	Array();
	var campo	=	Array();
	var total	=	5;
	var i		=	false;
	
	campo[0]	=	document.getElementById("formaPago");
	campo[1]	=	document.getElementById("estado");
	campo[2]	=	document.getElementById("entidad");
	campo[3]	=	document.getElementById("empresa");
	campo[4]	=	document.getElementById("tasaServicio");
	
	msg[0]		=	"Forma de Pago";
	msg[1]		=	"Estado";
	msg[2]		=	"Entidad";
	msg[3]		=	"Empresa";
	msg[4]		=	"Tasa de Servicio";
	
	for(i=0;i<total;i++)
	{
		if(campo[i].value=="")
		{
			alert("Es necesario completar el campo "+ msg[i]);
			//campo[i].focus();
			campo[i].style.border 		=	'1px solid #BDB737';
			campo[i].style.borderColor	=	"red";
			campo[i].focus();
			return false;
		}
		
	}
	
	
}
//===========================================================================
//===========================================================================

//REVISAR CAMPOS DE LA SECCION Cobros DMC
//=======================================
//Dehabilitar controles
function desactivar(control,opcion) {
	//alert(control)
	var opcion	= new Array();
	if(document.getElementById('total_formularios').value > 0)
	{
	if(opcion == 1)
	{
		opcion = 'true';
	}else
	{
		opcion = 'false';
	}
	document.getElementById(control).disabled = opcion;
	return true;
	}
}


//REVISAR QUE INTRODUZCAN VALOR DECIMALES CORRECTAMENTE
//======================================================
function checkDecimals(fieldName, fieldValue) 
{
	var decallowed  = 	2;  		//Cantidad de decimales permitidos
	var fieldName	=	fieldName;
	var fieldValue	=	fieldValue;//document.getElementById(fieldName).value;
	
	if (isNaN(fieldValue)) { // || fieldValue == ""
		//alert(fieldName)
		document.getElementById(fieldName).style.border 		=	'1px solid #BDB737';
		document.getElementById(fieldName).style.borderColor	=	'red';
		document.getElementById(fieldName).focus();
		document.getElementById(fieldName).value				=	'';
		document.getElementById('dhtmltooltip').style.visibility = 'visible'
		//alert("OJO! No has introducido un numero. Vuelve a intentarlo");
		fieldName.select();
		fieldName.focus();
	}
	else {
	if (fieldValue.indexOf('.') == -1) fieldValue += ".";
	dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);
	
	if (dectext.length > decallowed)
	{
		//alert ("OJO!! Introduce un numero con " + decallowed + " decimales.  Intentalo de nuevo.");
		fieldName.select();
		fieldName.focus();
	}
	else
	{
		//alert ("OK!! Numero correcto.");
		document.getElementById(fieldName).style.borderColor		=	'#FFFFFF';
		//document.getElementById('dhtmltooltip').style.visibility 	=	'hidden'
		//document.getElementById('autosuma').disabled = false
		return true;
	}
	}
}
//====================================================
//VER Y OCULTAR TABLAS - FILAS - TEXTOS - ETC...
//====================================================

function cambiarDisplay(id,image1, image2) {
  if (!document.getElementById) return false;
	  	fila 	=	 document.getElementById(id);
	  	//img		=	 document.getElementById(image);
  
  if (fila.style.display != "none") 
  {
    	fila.style.display = "none"; //ocultar fila 
		document.getElementById(image1).style.display = "";
		document.getElementById(image2).style.display = "none";
  }
  else
  {
    	fila.style.display = ""; //mostrar fila 
		//img.style.display = "";
		document.getElementById(image2).style.display = "";
  		document.getElementById(image1).style.display = "none";
  } 
}
//FIN
//=====================================================

//BAJA BARRA DE MENU 3%
function BajarBarra(id,image)
{
	 //style="height:3%"
	 if (!document.getElementById) return false;
	  	fila 	=	 document.getElementById(id);
	  	img		=	 document.getElementById(image);
  
  if (fila.style.height != "2%") 
  {
    	fila.style.height = "2%"; //ocultar fila 
		document.getElementById('iconoInfoGen1').style.display = "";
		document.getElementById('iconoInfoGen2').style.display = "none";
  }
  else
  {
    	fila.style.height = "5%"; //mostrar fila 
		//img.style.display = "";
		document.getElementById('iconoInfoGen2').style.display = "";
  		document.getElementById('iconoInfoGen1').style.display = "none";
  } 
	 
}

//========= TIPO DE CURSOR ============================
function tipo_de_cursor(r){
	var c= r;
	if(c==1){
		document.body.style.cursor = "pointer";		
	}else if(c==2){
		document.body.style.cursor = "";	
	}

}
//===================== FIN ==========================



//===== AGREGAR CAMPOS DE FORMULARIOS ========
//============================================

var indiceFilaFormulario=1;
// PARAMETROS
/*
	Campo	=	tipo de objeto que deseo (campo de text , text area , file)
	Nombre	=	nombre de la tabla
	nControl=	nombre control del primer campo
*/
function addPerson(Campo,Nombre, nControl){
	
	var DibCampo	= Campo;
	
	
 	myNewRow = document.getElementById(Nombre).insertRow(-1); 
 	myNewRow.id=indiceFilaFormulario;
	myNewCell=myNewRow.insertCell(-1);
	
	var nuevoSelect="";
/*
 nuevoSelect+="<td> <select name='sala["+indiceFilaFormulario+"]' >";
 nuevoSelect+="<option value='1'>sala 1</option> ";
 nuevoSelect+="<option value='2'>sala 2</option> ";
 nuevoSelect+="<option value='3'>sala 3</option> ";
 nuevoSelect+="</select></td>";
 */
 //SEGUN TIPO DE CONTROL QUE QUIERA INCLUIR
 //========================================
 
 switch(DibCampo)
 {
	case 'text':
		//nuevoSelect = "<input type='text' name='Ent_" + indiceFilaFormulario + "' id='Ent_" + indiceFilaFormulario + "'/>";
		nuevoSelect	=	"<input size='40'  type='text' name='"+nControl+"_"+indiceFilaFormulario+"'>&nbsp;<input type='button' style='width:80px' class='Estilo_botones'  value='Eliminar' onclick='removePerson(this)'>";
	break;
	
	case 'area':
		nuevoSelect = "<textarea name='req_" + indiceFilaFormulario + "' cols='90' rows='2'></textarea>";
	break;
	
	case 'file':
		nuevoSelect = "<input type='file' name='file_" + indiceFilaFormulario + "' id='file'>&nbsp;<input type='button' style='width:80px' class='Estilo_botones'  value='Eliminar' onclick='removePerson(this)'>";
	break;
	
	default:
	//Esta seccion supuestamente sera para la seccion de tramite nuevo
		if(indiceFilaFormulario <= DibCampo){
			//nuevoSelect = "<input type='text' name='Ent_" + indiceFilaFormulario + "' id='Ent_" + indiceFilaFormulario + "'/>";
			nuevoSelect	=	"<input style='width:500px'  type='text' name='Persona_"+indiceFilaFormulario+"'>&nbsp;<input type='button' style='width:80px' class='Estilo_botones'  value='Eliminar' onclick='removePerson(this); Restarindice()'> (Debe introducir un nombre en este campo)";
			
		}
		if(indiceFilaFormulario == DibCampo){
			document.getElementById('agregar_camppos').disabled = true
		}
	break;
 }
	
	myNewCell.innerHTML =	nuevoSelect;
	myNewCell=myNewRow.insertCell(-1);
	//Saber cuantos campos se desea ingresar
	myNewCell.innerHTML =	"<input type='hidden' name='tot' value='" + indiceFilaFormulario + "'>";
 	myNewCell=myNewRow.insertCell(-1);
 	/*myNewCell.innerHTML="<td><input  type='text' name='equipo["+indiceFilaFormulario+"]'></td>";
 	myNewCell=myNewRow.insertCell(-1);
	*/
	if(DibCampo == 'area'){
 		myNewCell.innerHTML =	"<td align='left'><input type='button' style='width:80px' class='Estilo_botones'  value='Eliminar' onclick='removePerson(this)'></td>";
		
	}
 	indiceFilaFormulario++;
}
function Restarindice()
{
	var cuanto;
	cuanto = indiceFilaFormulario--;
	cuanto = (cuanto) - 1;
	//alert(cuanto)
	document.getElementById('agregar_camppos').disabled = false
}

function removePerson(obj){ 
 var oTr = obj;
 while(oTr.nodeName.toLowerCase()!='tr'){
  oTr=oTr.parentNode;
 }
 var root = oTr.parentNode;
 root.removeChild(oTr);
}
//=========================== FIN =========================

//TRABAJAR CON CHECK BOX

//MOSTRAR LA ACCION CHECKED AL PASAR EL CURSOR
function eventos_check(evento)
{
	
	var eval_vento	=	evento;
	var xx 			= 	document.getElementById("select_all")
	
	alert(eval_evento)
	switch(eval_vento)
	{
		case 1:
			xx.checked = true;
		break;
		
		case 2:
			xx.checked = false;
		break;
		
	}
	
	//accion.checked = true;
}
//OCULTAR Y MOSTRAR OPCION DE ADJUNTAR ARCHIVOS
// EN:
//		Actualizacion de Informacion de la Empresa
//		Detalle del Tramite
function ocultar(n,nombre)
{
	var v	= n;
	if(v==0)
	{
		document.getElementById(nombre).style.display='none';
	}
	else
	{
		document.getElementById(nombre).style.display='block';
	}

}

//REVISAR CORREOS ELECTRONICOS
//==============================
function RevisarCorreo(CAMPO)
{
	var control	=	CAMPO
	var s = document.getElementById(control).value;
	var error = new Array();
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	error[1]= "Ingrese una direccion de correo valida (ejemplo@dominio.com)";			
	
	if (!filter.test(s)){ 
		Sexyy.alert(error[1]);
		document.getElementById(control).style.border 		=	'1px solid #BDB737';
		document.getElementById(control).style.borderColor	=	"red";
		document.getElementById(control).focus();
		return (false);
	}
	else
	{
		return true;	
	}
}


//========================================
// SOMBREADO POR CAMPOS
//========================================
function SombreadoCampos(campo,opcion,total)
{
	//===========================================
	//PARA CUALQUIER CAMPO DENTRO DEL SISTEMA
	//===========================================
	switch(opcion)
	{
		case '1':
			document.getElementById(campo).style.backgroundColor	=	'#E8FFE8'
			document.getElementById(campo).style.border				=	'1px solid red'; // #BDB737'
			document.getElementById(campo).style.cursor				=	'hand'
			
		break;
		
		case '0':
			document.getElementById(campo).style.backgroundColor	=	''
			document.getElementById(campo).style.border				=	''
			document.getElementById(campo).style.cursor				=	''
			//document.getElementById(campo).style.background			=	'none';
		break;
		
		//==============================================
		//	CASO ESPECIAL - > PARA REGISTRO DE EMPRESA
		//==============================================
	
		case 'Tab':
			document.getElementById(campo).style.backgroundColor	=	'#E8FFE8'
			document.getElementById(campo).style.border				=	'1px solid red'
			document.getElementById(campo).style.cursor				=	'hand'	
			
			for(h = 1; h < total+1 ; h++)
			{
				if('Tab'+h != campo)
				{//alert(total)
					var TabCampo	=	'Tab'+h;
					document.getElementById(TabCampo).style.backgroundColor	=	''
					document.getElementById(TabCampo).style.border				=	'';//'solid 1px #999'
					document.getElementById(TabCampo).style.cursor				=	''	
				}
			}
		break;
		
		
		// OTRA FORMA DE HACERLO
		
		case 'Tabb':
			document.getElementById(campo).style.backgroundColor	=	'#E8FFE8'
			document.getElementById(campo).style.border				=	'1px solid red'
			document.getElementById(campo).style.cursor				=	'hand'	
			
			//var n		=	campo;
			
			for(h = 1; h < total+1 ; h++)
			{
				if('Tabb'+h != campo)
				{
					var TabCampo	=	'Tabb'+h;
					document.getElementById(TabCampo).style.backgroundColor		=	''
					document.getElementById(TabCampo).style.border				=	'';//'solid 1px #999'
					document.getElementById(TabCampo).style.cursor				=	''	
				}
			}
		break;
		
	}
	
}

