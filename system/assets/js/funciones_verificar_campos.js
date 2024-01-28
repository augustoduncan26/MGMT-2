// JavaScript Document
/*
	FUNCIONES PARA VALIDAR CAMPOS
	 -> SAD : Sisitema Asistido para Desarrolladores
	 -> SAD : Sinclair Augusto Duncan
*/
function RevisarDataCrearUsuario(pagina)
{
	var mensaje = new Array();
	var nombre  = new Array();
	var error   = new Array();
		error[1]= "Ingrese una direccion de correo valida (ejemplo@dominio.com)";
	var formulario	=	document.form1
	var total	=	0;
	var DivReq	= null;
	var CampoReq= null;
	var y = 0;
	var n = 0;
	//==============================================
	// PANTALLA DE CREAR USUARIOS DEL SISTEMA      =
	//==============================================
	if( pagina == 'CrearUsuarios')
	{
		 
		if(formulario.USR_chkGenerarContrasena.checked == true)
		{
			 mensaje[0]	=	"Usuario de acceso";
			 //mensaje[1]	=	"Contrase&ntilde;a";
			 //mensaje[2]	=	"Verificar Contrase&ntilde;a";
			 mensaje[1]	=	"Nomobre";
			 mensaje[2]	=	"Apellido";
			 mensaje[3]	=	"Correo Electr&oacute;nico";
			 mensaje[4]	=	"Departamento";
			 mensaje[5]	=	"&Aacute;rea";
			 
			 //Mensajes a mostrar segun nombre de campos
			 //=========================================
			 nombre[0]	=	formulario.usuario;
			 //nombre[1]	=	formulario.clave;
			 //nombre[2]	=	formulario.clave_verif;
			 nombre[1]	=	formulario.nombre;
			 nombre[2]	=	formulario.apellido;
			 nombre[3]	=	formulario.mail;
			 nombre[4]	=	formulario.departamento;
			 nombre[5]	=	formulario.area;
			
			 DivReq		=	"requisitos0";
			 CampoReq	=	"CampoFalta1";
			 total		=	6;
		}
		else
		{
		
			 mensaje[0]	=	"Usuario de acceso";
			 mensaje[1]	=	"Contrase&ntilde;a";
			 mensaje[2]	=	"Verificar Contrase&ntilde;a";
			 mensaje[3]	=	"Nomobre";
			 mensaje[4]	=	"Apellido";
			 mensaje[5]	=	"Correo Electr&oacute;nico";
			 mensaje[6]	=	"Departamento";
			 mensaje[7]	=	"&Aacute;rea";
			 
			 //Mensajes a mostrar segun nombre de campos
			 //=========================================
			 nombre[0]	=	formulario.usuario;
			 nombre[1]	=	formulario.clave;
			 nombre[2]	=	formulario.clave_verif;
			 nombre[3]	=	formulario.nombre;
			 nombre[4]	=	formulario.apellido;
			 nombre[5]	=	formulario.mail;
			 nombre[6]	=	formulario.departamento;
			 nombre[7]	=	formulario.area;
			
			 DivReq		=	"requisitos0";
			 CampoReq	=	"CampoFalta1";
			 total		=	8;
		}
		//VALIDAR CORREO ELECTRONICO
		//==========================
		
			 var s = formulario.mail.value;
			 var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
					
			if (!filter.test(s)){ 
				//Sexyy.alert(error[1]);
				document.getElementById(DivReq).style.display	=	'block'
				formulario.mail.style.border 		=	'1px solid #BDB737';
				formulario.mail.style.borderColor	=	"red";
				formulario.mail.focus();
			 	return (false);
			} 
			
		
	}
	//====================================================
	//
	//====================================================
	// RUTINA COMUN PARA CUALQUIER PAGINA                =
	//====================================================
	for(i=0;i<total;i++)
	 {
		nombre[i].style.border 		=	'1px solid #BDB737';
		
		if (nombre[i].value.length == 0)//if (nombre[i].value.length == 0)
		{
			n++;
			//Sexyy.alert('Falta: ' + mensaje[i] );
			document.getElementById(DivReq).style.display	=	'block'
			//document.getElementById(CampoReq).style.border	='1px solid #fff';
			
			//document.getElementById(CampoReq).value	= 'Falta: ' + mensaje[i].toUpperCase();//.split(/\n/).join("<br />")
			
			nombre[i].style.border 		=	'1px solid #BDB737';
			nombre[i].style.borderColor	=	'red';
			nombre[i].focus();
			return (false);

		}
		
	 }
	 //====================================================
}