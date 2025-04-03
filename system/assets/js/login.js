

// function validateEmail($email) {
//   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//   return emailReg.test( $email );
// }
// const validateEmailLogin = (email) => {
//     return email.match(
//       /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
//     );
//   };

// Validate Email
$('#email').on('input', ()=>{
    let res = validate('alert-mssg-register', 'email');
    if (res==false) {
        $('.alert-mssg-register').removeClass('alert-success').removeClass('alert-info').addClass('alert-danger');
        setTimeout(()=>{
            $('.alert-mssg-register').hide();
          },4000);
    }
    //console.log(res)
  });

/** Register Event */
$('.btn-register').on('click',(e)=>{
    //e.preventDefault();
    let pass = document.getElementById('password'); //$('#password');

    if ($('#email').val()=="" || $('#full_nombre').val()=="" || $('#password').val()=="" || $('#password_again').val()=="") {
        $('.alert-mssg-register').removeClass('alert-success').removeClass('alert-info').addClass('alert-danger').show().html('Todos los campos son requeridos.');
        return false;
    }
    // let res = validate('alert-mssg-register', 'email');
    // console.log(res)
    if (validateEmail($('#email').val())==false) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Ingrese un email válido.');
        return false;
    }
    if (pass.value.length < 8) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('La contraseña debe tener entre 8 a 16 caracteres.');
        return false;
    }
    if ($('#password').val() !== $('#password_again').val()) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Las contraseñas no coinciden, intentelo nuevamente.');
        return false;
    } else {
        $( "#registerUserForm").submit();
    }
});


var runLoginButtons = function () {
    $('.forgot').bind('click', function () {
        $('.box-login').hide();
        $('.box-forgot').show();
    });
    $('.register').bind('click', function () {
        $('.box-login').hide();
        $('.box-register').show();
    });
    $('.go-back').click(function () {
        $('.box-login').show();
        $('.box-forgot').hide();
        $('.box-register').hide();
    });
};