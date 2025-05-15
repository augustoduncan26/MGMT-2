// FUNCIONES REUTILIZABLES
// *************************

function goToTopPage () {
  $("html, body").animate({
    scrollTop: 0
  }, "slow");
  //e.preventDefault();
}
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
    //$result.css('color', 'green');
    $result.hide();
  } else{
    $result.show();
    $result.text(email + ' no es válido.');
    $result.css('color', '#721c24');
  }
  return false;
}

// const validateSignUpEmail = (email) => {
//   let route = "login.php";
//   $.ajax({
//       headers: {
//           Accept        : "application/json; charset=utf-8",
//           "Content-Type": "application/json: charset=utf-8"
//       },
//       url: route,
//       type: "GET",
//       data: {
//           showEdit  : 1,
//           r1        : email,
//           check     : 'check'
//       },
//       dataType        : 'json',
//       success         : function (response) {
//           if (response['result']==1) {
//               return false;
//           }
//       },
//       error           : function (error) {
//           console.log(error);
//           return false;
//       }
//   });
// }
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

/**
 * Evaluar si la fecha final es mayor que
 * la fecha de inicio
 * @param {*} dateI 
 * @param {*} dateF 
 * @returns 
 */
const evaluarFechas = (dateI, dateF) => {
  //Formato MES/DIA/AÑO
  var primera = Date.parse(dateI); //01 de Octubre del 2013
  var segunda = Date.parse(dateF); //03 de Octubre del 2013
  
  if (primera == segunda){
      return true;
  } else if (primera > segunda) {
      return false;
  } else{
      return true;
  }
}
