// JavaScript Document
/*
	Funciones para campos
	SAD FRAMEWORK
	Sistema Asistido para Desarrolladores
	Sinclair Augusto Duncan
	2009 - futuro
	que incluyen:
	- Bloquear , Desbloquear
	- Sumar ó totalizar
	- etc...
*/

// UNA DE LAS MANERAS DIRECTAS PARA SUMAR VALORES
// SUMAR LOS CAMPOS Y LUEGO PONER EL TOTAL DONDE SE NECESITA
/*	Parametros:
	campo	=	Es el campo en donde quiero el total sumado
	Tot		=	Es el total de campos que estoy sumando
	NCampo	=	Son los nombres de los campos a sumar, (los nombres de los campos empiezan con 
														el mismo nombre solo que lo difieren de un valor
														numerico separados por un underscore ( _ )
*/
function P_Totales(CampoSalida, Tot, NCampo)
{
	var comodin_sumar 	= 	0;
	var sub_total		=	0;
	var total_cif		=	0;
	var totalCampos		=	(parseInt(Tot) + 1);
	var totalSalida		=	0;
	var Salida			=	0;
	//alert(Tot)

			for(a = 1 ; a < totalCampos ; a++){
				if(document.getElementById(NCampo+'_'+a).value != '')
				{
					sub_total +=  parseFloat(document.getElementById(NCampo+'_'+a).value);
				}
			}
			comodin_sumar	=	sub_total;
			Salida			=	comodin_sumar.toFixed(2);
			document.getElementById(CampoSalida).value = Salida;
}


//Escribir el total en el campo especifico
function EscribirTotal()
{
	var num_actual	=	  document.getElementById('num_desde').value;
	var cuantos_nec	=	  document.getElementById('total_formularios').value;
	var num_hasta	=	  (parseInt(num_actual) + parseInt(cuantos_nec) - 1);
					
    document.getElementById('num_hasta').value = num_hasta//split(/\n/).join("<br />");
    //document.getElementById('nombreComercial').value += ' ' + document.getElementById('apellido').value.split(/\n/).join("<br />");
    document.getElementById('monto').value	= 0;
	document.getElementById('monto').value	=	parseInt(document.getElementById('total_formularios').value) * parseInt(document.getElementById('monto_guardado').value)
				  
}
/*
	DESACTIVAR:
	==========
	Avtiva y Desactiva cualquier control de formulario
	Parametros: 
	Tot		=	Es el total de campos que estoy sumando
	NCampo	=	Son los nombres de los campos a sumar, (los nombres de los campos empiezan con 
														el mismo nombre solo que lo difieren de un valor
														numerico separados por un underscore ( _ )
	
*/
function DesActivar(NCampo , Tot){
	
	if(Event	==	0)
	{
		Event		=	1;
		for(i = 0 ; i < Tot ; i++)
		{
			document.getElementById(NCampo+'_'+i).disabled =false;	
		}
	}
	else
	{
		Event		=	0;
		for(i = 0 ; i < Tot ; i++)
		{
			document.getElementById(NCampo+'_'+i).disabled =true;		
		}	
	}
}





