/*
*	Archivo: ingreso_sin_recargar
*	Con este archivo mitigo los botones de Actualizar la Data de un Formulario
*	realizando la actualizacion desde el mismo momento que se cambie el dato
*	en el campo de texto, y que salga del focus el puntero.
*	Derechos Reservados: (pa que, no lo se)
*	SAD: Sinclair Augusto Duncan 2010.
*/
//Parametro de tipo aleatorio: Para matar el cahe del IExplore
var aleatorio=Math.random();

//La clasica funcion de AJAX. (nada nuevo por cierto)
function nuevoAjax()
{ 
	/* Como todo y como siempre en este tipo de t�cnicas
	creo el objeto AJAX. 
	*/
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		// por supuesto el mejor navegador del mundo se llama FIREFOX.
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objeto AJAX para IE 
			// para acordarme del pobre IExplorer
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
} 
// Sirve para eliminar los espacios
// los espacios que se encuentren al principio
// y los que se encuentren al final. (De igual manera lo estoy 
//									  haciendo en PHP)
function eliminaEspacios(cadena)
{
	// Funcion que equivale a trim en PHP
	var x	=	0, y	=	cadena.length-1;
	while(cadena.charAt(x)==" ") x++;	
	while(cadena.charAt(y)==" ") y--;	
	return cadena.substr(x, y-x+1);
}
// Funcion: guarda el registro
// Cuando se quiere llenar la informaci�n de un coolaborador nuevo.
// A la verdad no se si utilizarla, ya que tambien esta echa de otro modo
// en PHP.
function GuardarNuevoReg(Campo, N_tabla, Comodin)
{
	return false;	
}
//Funcion que ayuda a guardar data.
//Guarda los datos de los campos que esten en blanco
//del registro que se este solicitando para ver.
//====================================================
/*
	Parametros:
	NControl		=	Nombre del control = Guardar
	ValorControl	=	Valor que contiene en el momento el control /Campo en donde voy a guardar la informacion
	N_tabla			=	Nombre de la tabla en la que se debe guardar la informacion
	NComodin		=	Nombre del campo clave y/o comodin
	ValorComodin	=	Valor a compara para el registro clave o comodin
*/
function GuardarDataAct(NControl, ValorControl , N_tabla, ValorComodin, NComodin)
{	
	//Revisar que el control no este en blanco
	var valorInput	=	document.getElementById(ValorControl).value;
	var divError	=	document.getElementById("error");
	alert(ValorControl)
	// Elimino todos los espacios en blanco al principio y al final de la cadena
	valorInput		=	eliminaEspacios(valorInput);
	//valorInput	=	valorInput;
	// Valido con una expresion regular el contenido de lo que el usuario ingresa
	var reg	=/(^[a-zA-Z0-9,._������!�? -]{1,40}$)/;
	
	if(valorInput == '' || !reg.test(valorInput))
	{
		var divError		=	document.getElementById("error");
		divError.innerHTML	=	"<font color=red size=3 face=Verdana>Debe introducir datos en el campo de texto</font>"
	}
	else
	{//alert(NComodin)
		// Si no hay error oculto el div (por si se mostraba)
		divError.style.display	=	"none";
		mostrandoInput			=	false;
		
		document.getElementById(ValorControl).innerHTML=valorInput;
		//alert(Comodin);
		// Creo objeto AJAX y envio peticion al servidor
		var ajax=nuevoAjax();
		ajax.open("GET", "ajax/ajax_ingreso_sin_recargar_proceso.php?dato="+valorInput+"&nocache="+aleatorio+"&actualizar="+ValorControl+"&tabla="+N_Tabla+"&campo_clave="+NComodin+"&clave="+ValorComodin+"&QUE="+NControl, true);
		ajax.send(null);
	}
}

//Muestra y Guarda las modificaciones segun registro
//que se seleccione.
//=====================================================
function cargaDatos(idDiv, idInput, N_Tabla, VComodin,NComodin,PagMadre)
{
	var valorInput	=	document.getElementById(idInput).value;
	var divError	=	document.getElementById("error");
	
	// Elimino todos los espacios en blanco al principio y al final de la cadena
	valorInput=eliminaEspacios(valorInput);
	//valorInput	=	valorInput;
	
	// Valido con una expresion regular el contenido de lo que el usuario ingresa
	var reg	=/(^[a-zA-Z0-9,()._������!�? -:]{1,40}$)/;
	
	if(!reg.test(valorInput)) 
	{ 
		// Si hay error muestro el div que contiene el error
		divError.innerHTML="<font color=red size=3 face=Verdana>El texto ingresado no es v&aacute;lido</font>";
		document.getElementById(idDiv).value = '';

		document.getElementById(idDiv).focus();
		Sexyy.alert('Debe ingresar un valor en el campo remarcado con rojo para poder continuar.');
		//document.getElementById().focus();
		divError.style.display="block";
	}
	else
	{
		// Si no hay error oculto el div (por si se mostraba)
		divError.style.display="none";
		mostrandoInput=false;
		document.getElementById(idDiv).innerHTML=valorInput;
		//var CampoSplit		=	idInput.split("_");
		//alert(CampoSplit[1]);
		//alert("UPDATE "+ N_Tabla+ " SET "+idInput+"="+valorInput+" WHERE "+NComodin+"="+VComodin+"")
		/*
		//var CampoSplit		=	idInput.split("-");
		//var CampoSplit2		=	VComodin.split("-");	//NOMBRE DE LOS COMODINES
		//var CampoSplit3		=	NComodin.split("-");	//VALORES DE LOS COMODINES
		//alert(CampoSplit3[0]);		//	Valor del campo
		//var wer				=	"UPDATE "+ N_Tabla+ " SET "+CampoSplit2[1]+"='"+valorInput+"' WHERE "+CampoSplit2[0]+"='"+idInput+"'";
		*/
		// Creo objeto AJAX y envio peticion al servidor
		var ajax=nuevoAjax();
			//alert(idDiv);
			//alert(valorInput)
			ajax.open("POST", "ajax/ajax_ingreso_sin_recargar_proceso.php?campo="+idInput+"&valor="+valorInput+"&nocache="+aleatorio+"&actualizar="+idDiv+"&tabla="+N_Tabla+"&vcomodin="+VComodin+"&ncomodin="+NComodin, true);
			//var wer				=	"UPDATE "+ N_Tabla+ " SET "+idInput+"='"+valorInput+"' WHERE "+NComodin+"='"+VComodin+"'";
			//alert(wer);
			//Esto es por si cambian el codigo del empleado
		//}
		ajax.send(null);
	}
	/*
	if(idDiv == 'provincia')
	{
			
	}
	*/
}

var mostrandoInput=false;
/*Funcion utilizada para crear controles de formularios
  Lista de las que se creean:
						1. TextBox
 Parametros: 	
 			   idDiv 	= 	nombre del Div que se crea para mostrar la data
               idInput	=	Para mantener un control de nonbre y que no choque con el nombre verdadero del ID
			   N_Tabla	=	Nombre de la tabla a consultar o modificar
			   Comodin  =	Valor para comparar / WHERE
			   NComodin	=	Nombre del campo a comparar / WHERE
			   Psize	=	Tama�o del control
			   PagMadre	=	Pagina en donde se esta utilizando el control
*/
function creaInput(idDiv, idInput, N_Tabla, Comodin, NComodin, Psize, PagMadre)
{
	/* Funcion encargada de cambiar el texto comun de la fila por un campo que conserve
	el valor que tenia ese campo */
	var divError=document.getElementById("error");
	/* Solo mostramos el input si ya no esta siendo mostrado y si ademas el div del error no esta en pantalla */
	//var alerta	=	alert(idDiv)
	if(!mostrandoInput && divError.style.display!="block")
	{
		//alert(idInput)
		// Obtenemos el div contenedor del futuro input
		var divContenedor=document.getElementById(idDiv);
		// Creamos el input
		divContenedor.innerHTML="<input type='text'  onclick='' style='border:1px solid red;width:"+Psize+"px' onBlur='cargaDatos(\""+idDiv+"\",\""+idInput+"\",\""+N_Tabla+"\",\""+Comodin+"\",\""+NComodin+"\",\""+PagMadre+"\")' value='"+divContenedor.innerHTML+"' id='"+idInput+"' maxlength='100' size='40'>";

		// Colocamos el cursor en el input creado
		document.getElementById(idInput).focus();
		//document.getElementById(IDcontrol).focus();
		// Establecemos a true la variable para especificar que hay un input en pantalla y no se debe crear otro hasta que este se oculte
		mostrandoInput=true;
	}
}

//DAR EFECTO AL CONTROL PARA QUE DE EL ASPECTO DE GUARDADO
//===================================================
function BlocCampo(Nombre) //,Tabla,codigo
{
	if(document.getElementById(Nombre).value !='')
	{
		document.getElementById(Nombre).style.backgroundColor 	= 	'#EAEAEA';
		document.getElementById(Nombre).style.color			  	= 	'#666'//'#666';
		document.getElementById(Nombre).style.border 			=	'1px solid #BDB737';
		var reg	=/(^[a-zA-Z0-9,+._������!�? -]{1,40}$)/;
	}
	else
	{
		//Aqui debo crear una opcion/funcion que vuelva 
		//el campo tal cual estaba al principio
		document.getElementById(Nombre).style.border 			=	'';//;'1px solid #BDB737';
	}
}
//AL HACER CLICK
//===============
function FunOnclicK(Nombre)
{
	//document.getElementById(Nombre).style.backgroundColor = '';	
	if(document.getElementById(Nombre).value =='')
	{
		document.getElementById(Nombre).style.border 			=	'1px solid #BDB737';
	}else{
		document.getElementById(Nombre).style.border 			=	'1px solid red';
		document.getElementById(Nombre).style.color			  	= 	'#000'//'#666';
		document.getElementById(Nombre).style.backgroundColor 	= 	'';	
	}
}

//OCULTAR EL CONTROL
//==================
function OcultarMe(Nombre)
{	//alert('s');
	//document.getElementById(Nombre).style.visibility = 'hidden';
	document.getElementById(Nombre).style.display = 'none';
}

//GUARDAR DE MANERA MAS RAPIDA
//SIN TANTO CODIGO / SOLO PARA CASOS ESPECIALES
//===============================================
/* Parametros:
*		-	
*/
function GuardadoRapido(NCampo,NTabla,ValorComodin,NComodin)
{	
	var ajax=nuevoAjax();
	//PRE-HOSPITALARIA
	//CTRO.DESPACHO
	if(NTabla == '911_rolturn_desp_tmp_2' || NTabla == 'PREH' || NTabla == 'DESP')
	{	
		if(NTabla == 'PREH' || NTabla == 'DESP'){
			NTabla	=	document.getElementById('tabla_tmp_area').value;
		} 
		var datoValor		=	document.getElementById(ValorComodin+'-'+NCampo).value.toLowerCase();
		
	}
	else if(NTabla == '911_rolturn_desp')
	{	
			var dato		=	document.getElementById(ValorComodin+'-'+NCampo).value;
			datoValor		=	false;
			ajax.open("GET", "../ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+dato+"&nocache="+aleatorio+"&campo="+NCampo+"&tabla="+NTabla+"&vcomodin="+ValorComodin+"&ncomodin="+NComodin, true);
			ajax.send(null);
			
	}
	else if(NTabla == '911_rolturn_preh')
	{	
			var dato		=	document.getElementById(ValorComodin+'-'+NCampo).value;
			datoValor		=	false;
			ajax.open("GET", "../ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+dato+"&nocache="+aleatorio+"&campo="+NCampo+"&tabla="+NTabla+"&vcomodin="+ValorComodin+"&ncomodin="+NComodin, true);
			ajax.send(null);
			
	}
	else{
		
		var datoValor	=	document.getElementById(NCampo).value.toLowerCase();
	}
	
	if(datoValor!='')
	{ 
		ajax.open("GET", "ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+datoValor+"&nocache="+aleatorio+"&campo="+NCampo+"&tabla="+NTabla+"&vcomodin="+ValorComodin+"&ncomodin="+NComodin, true);
		ajax.send(null);
	}
}

function OtroGuardadoRapido(NCampo2,NTabla2,ValorComodin2,NComodin2)
{	//alert(ValorComodin2);
	var ajax=nuevoAjax();
	var CampoSplit3		=	NCampo2.split("-");
		var datoValor2	=	document.getElementById(NCampo2).value;
	
	if(NTabla2 == '911_rolturn_desp')
	{//alert('n')
			ajax.open("GET", "../ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+datoValor2+"&nocache="+aleatorio+"&campo="+CampoSplit3[0]+"&tabla="+NTabla2+"&vcomodin="+ValorComodin2+"&nemple=1&ncomodin="+NComodin2, true);
			ajax.send(null);
			datoValor2		=	false;
			
	}
	else if(NTabla2 == '911_rolturn_preh')
	{
			ajax.open("GET", "../ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+datoValor2+"&nocache="+aleatorio+"&campo="+CampoSplit3[0]+"&tabla="+NTabla2+"&vcomodin="+ValorComodin2+"&nemple=1&ncomodin="+NComodin2, true);
			ajax.send(null);
			datoValor2		=	false;
			
	}
	else
	{
		if(datoValor2)
		{  
			if(NTabla2 == 'PREH' || NTabla2 == 'DESP'){
				NTabla2	=	document.getElementById('tabla_tmp_area').value;
			}//alert(NTabla2)
			ajax.open("GET", "ajax/ajax_ingreso_sin_recargar_proceso.php?valor="+datoValor2+"&nocache="+aleatorio+"&campo="+CampoSplit3[0]+"&tabla="+NTabla2+"&vcomodin="+ValorComodin2+"&nemple=1&ncomodin="+NComodin2, true);
			ajax.send(null);
		}
	}
}