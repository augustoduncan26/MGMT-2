// FUNCIONES REUTILIZABLES
// *************************

function mostrar ( blo ) {
	//$('#'+ blo).show();
	document.getElementById(blo).style.display = "block";
}

function ocultar ( blo ) {
	//$('#'+blo).hide();
	document.getElementById(blo).style.display="none";
}


const open = (option) => {

}

function selectUseLike ( id ) {
  if ( $('#' + id).is(":checked") ) {
    $('#use-sistem-as').val('rooms');
    $('#use-like').html('Hotel').css('color','red');
  } else { 
    $('#use-sistem-as').val('rooms_bed');
    $('#use-like').html('Hostel').css('color','green');
  }
}
