/*
	FUNCIONES REFERENTES A VENTANAS
	- En este archivo se encuentran algunas funciones referentes a las ventanas.
	1 - direccionarPagina = URL: Direccion a la que se decea redireccionar, se espera 5 segundo antes de hacer el reenvio
	2 - direccionarPagina_Tiempo
		= URL
		= segundos
	3 - abrirPopup
		= URL
		= nomWin
	4 - etc
	SAD FRAMEWORK
	Sistema Asistido para Desarrolladores
	Sinclair Augusto Duncan
*/	
//REDIRECCIONAR PAGINA
//URL = Página a donde se quiere redireccionar
//=============================
function direccionarPagina(URL){
	
	setTimeout ("location.href = '" + URL +"';", 5000);
	
	return (true);
}

function direccionarPagina_Tiempo(URL, segundos){
	
	setTimeout ("location.href = '" + URL +"';", (segundos * 1000));
	
	return (true);
}
//ABRIR VENTANA TIPO POP-UP
//==========================
function abrirPopup(URL, nomWin){
	open(URL, nomWin, 'toolbars=no, scrollbars=no, resizable=yes, menubar=0 ,width=700,height=600');  	
	
	return (true);
}

function crearVentanaEspera(){
	// precargando imagenes
	Loading = new Image();
	Loading.src = 'image/ajax-loader.gif';
	
	Fondo = new Image();
	Fondo.src = 'image/overlay.png';
	
	var arrayPageSize = getPageSize();
	var overlay = document.createElement('div');
	var ventanita = document.createElement('div');
	var imagen = document.createElement('img');
	var texto = document.createTextNode('Procesando ...');
	
	//seteando imagen
	imagen.src = 'image/ajax-loader.gif';
	//imagen.alt = ' Procesando ...';
	imagen.align = 'middle';
	
	//agregando elementos a ventanita
	ventanita.appendChild(imagen);
	ventanita.appendChild(texto);
	
	// agregando ventanita 
	overlay.appendChild(ventanita);
	
	// Seteando overlay
	overlay.id = 'FRAMEWORK_loadingWindow';
	overlay.className = 'loadingWindow';
	overlay.style.height = (arrayPageSize[1] + 'px');
	overlay.style.display = 'block';
	
	document.body.appendChild(overlay);
}

function cerrarVentanaEspera(){
	var elemVentana = document.getElementById('FRAMEWORK_loadingWindow');
	document.body.removeChild(elemVentana);
}

//
// getPageScroll()
// Returns array with x,y page scroll values.
// Core code from - quirksmode.org
//
function getPageScroll(){

	var yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}

	arrayPageScroll = new Array('',yScroll) 
	return arrayPageScroll;
}



//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}

function centrar() { 
	iz=(screen.width-document.body.clientWidth) / 2; 
	de=(screen.height-document.body.clientHeight) / 2; 
	moveTo(iz,de); 
}

//ABRIR VENTANA DE APARIENCIA SUAVE
//=================================================
function VisorVentana(Pagina, Titulo ,Tamanyo, Full , Tipo){ 
	//	  Parametros utilizados:
	//1 - Pagina con variables para abrir
	//2 - Titulo para la ventana
	//3 - Ancho de la Pantalla
	//4 - Alto de la Pantalla
	//5 - Full = Abrir la pantalla completamente. (Si se da valor a este parámetro
	//6 - Tipo: Si quiero abrirlo como: div , iframe , ajax
	//	  Entonces no toman efectos: (Width no Height)
	if(Tamanyo!='')
	{
		ajaxwin=dhtmlwindow.open("googlebox", Tipo, Pagina , Titulo, Tamanyo + ",left=300px,top=100px,resize=1,scrolling=1,center=1","recal");			
	}
	else
	{
		ajaxwin=dhtmlwindow.open("ajaxbox", Tipo, Pagina , Titulo, "width=450px,height=300px,left=300px,top=100px,resize=1,scrolling=1,center=1","recal");		
	}
	//ajaxwin.onclose=function(){return window.confirm("Close window 3?")} //Run custom code when window is about to be closed
	
	
}
