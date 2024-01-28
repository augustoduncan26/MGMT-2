// JavaScript Document
/*
	Funciones para pagina
	SAD FRAMEWORK
	Sistema Asistido para Desarrolladores
	Sinclair Augusto Duncan
	2009 - futuro
	que incluyen:
	- Crear, Guardar una coockie en la PC del usuario
	- Aumentar el texto de la página
	- Resolucion de pantalla
	- etc...
*/

function tamFuente (nivel, elem) {  
     var elemento = document.getElementById(elem)  
     elemento.className = "nivel"+nivel;  
 }  