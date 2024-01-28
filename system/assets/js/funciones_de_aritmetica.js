// FUNCIONES TIPO ARITMETICA
// S.A.D.
// Sistema Asistido para Desarrolladores
// Sinclair Augusto Duncan
// Diciembre 2011
/* En este archivo:
*	- Sumar valores de campo
*/

/*  Funcion EvaluarXs
*	Param: 	- Result	:	Donde quiero el resultado de la suma
			- TotCamp	:	Total de campos
			- NCamp		:	Como se llaman los campos a sumar
			- Id		:	Es la fila en la BD
			
*/
var Evaluar	=	Array('x','6','2','10');			//	Los diferentes valores a evaluar

// EVALUAR X
function EvaluarXs(Result,TotCamp,Id,NCamp,CampoMadre)
 {
	var y				=	0	;	
	var	a				=	0	;
	var PValorX			=	0	;
	var PValor6			=	0	;
	
	var sub_total		=	0	;
	var ValorTotX		=	document.getElementById(Result);
	var ValorTot6		=	"";
	var ValorTot2		=	"";
	var ValorTot10		=	"";
	var CampoOrigen		=	document.getElementById(CampoMadre).value.toLowerCase()	;	

			for(y = 1 ; y <= TotCamp ; y++)
			{
				var CampoA		=	document.getElementById(Id+'-'+NCamp+y);
				if(CampoA.value.toLowerCase() == 'x')
				{
					PValorX	  =	(parseInt(PValorX) + 1);
					//PValor 	+= (parseInt(PValor) + 1);
					//sub_total +=  parseFloat(document.getElementById('valor_' + a).value);
				}
				
				
			}
			
			ValorTotX.value	=	PValorX;			//	Escribir el resultado

	/*
	var objCamp1=document.getElementById(Campo1);
    var objCamp2=document.getElementById(Campo2);
    var objCamp3=document.getElementById(Campo3);

        //Supongamos qe si o si existen los campos... :P
    if ((objCamp1.value!='') && (objCamp2.value!=''))
    {
        objCamp3.value=parseInt(objCamp1.value) + parseInt(objCamp2.value);
    }
	*/
}
// EVALUAR LA CANTIDAD DE TURNO
// Y MOSTRAR EL TOTAL DE EL MISM.
/*	@Param:
			- ResultA	=	Donde quiero enviar el total
			- TotCampA	=	Total de campos hacia abajo
			- IdA		=	Id del campo en la BD
			- NCampA	=	Nombre del campo presionado / clickeado
			- VCampo	=	Valor que contiene el campo
*/

function EvaluarHaciaAbajo(NCampA,TotCampsA,IdA,Mes)
 {//alert(''+Mes)
	var y			=	0	;	
	var	a			=	0	;
	var PValor6		=	0	;
	var PValor2		=	0	;
	var PValor10	=	0	;

	//alert(IdA);				// La fila en la BD (El ID)
	//alert('Ini: '+Fin);		// Para saber de donde empiezan los campos a evaluar
	//alert('Fin: '+Fin);		// Para saber hasta que campo debo evaluar + 1
	var VCampo 		=	document.getElementById(NCampA).value;
	var CampoSplt	=	NCampA.split("-");
	var SplitOtro	=	CampoSplt[1].split("c");
	//alert(SplitOtro[1])
	/* CampoSplt[0]		=	el nombre del id
	*  CampoSplt[1]		=	el nombre de la columna
	*  El campo que debe tener el total, el id tiene como nombre
	*  el siguiente formato:
	*  Hora-Mes-dia Eje.(6-2-21)
	*/
	
	var Fin			=	(parseInt(Mes) * parseInt(TotCampsA))	;
	var Ini			=	(parseInt(Fin) - parseInt(TotCampsA))+1 ;
	//alert(TotCampsA);
	//var CmpRslt6	=	document.getElementById('6-'+Mes+'-'+SplitOtro[1]).name;
		
		for(y = Ini ; y <= Fin ; y++)
		{	
			var CampoEval	=	document.getElementById(y+'-'+CampoSplt[1]);
			//alert(CampoEval.value);
			if(CampoEval.value == 6)
			{
				PValor6	  =	(parseInt(PValor6) + 1);
			}
			if(CampoEval.value == 2)
			{
				PValor2	  =	(parseInt(PValor2) + 1);
			}
			if(CampoEval.value == 10)
			{
				PValor10	  =	(parseInt(PValor10) + 1);
			}
		}
			document.getElementById('6-'+Mes+'-'+SplitOtro[1]).value	=	PValor6 ;
			document.getElementById('2-'+Mes+'-'+SplitOtro[1]).value	=	PValor2 ;
			document.getElementById('10-'+Mes+'-'+SplitOtro[1]).value	=	PValor10 ;
			Fin		=	0;
			Ini		=	0;
			PValor6	=	0;
			PValor2	=	0;
			PValor10=	0;
 }





