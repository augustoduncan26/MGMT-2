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

/**
 * Validate an Email
 * @param {*} email 
 * @returns 
 */
const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};
const validate = (resultInput, emailInput) => {
  const $result = $('#'+resultInput);
  const email = $('#'+emailInput).val();
  $result.text('');

  if(validateEmail(email)){
    $result.text(email + ' es válido.');
    $result.css('color', 'green');
    $result.hide();
  } else{
    $result.show();
    $result.text(email + ' no es válido.');
    $result.css('color', 'red');
  }
  return false;
}
// End: Validate Email

function selectUseLike ( id ) {
  if ( $('#' + id).is(":checked") ) {
    $('#use-sistem-as').val('rooms');
    $('#use-like').html('Hotel').css('color','red');
  } else { 
    $('#use-sistem-as').val('rooms_bed');
    $('#use-like').html('Hostel').css('color','green');
  }
}
