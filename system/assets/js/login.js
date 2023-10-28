

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

/** Register Event */
$('.btn-register').on('click',(e)=>{
    //e.preventDefault();
    let pass = document.getElementById('password'); //$('#password');

    if ($('#email').val()=="" || $('#full_nombre').val()=="" || $('#password').val()=="" || $('#password_again').val()=="") {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Todos los campos son requeridos.');
        return false;
    }
    if (validateEmail($('#email').val())==false) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Ingrese un email válido.');
        return false;
    }
    if (pass.value.length < 6) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('La contraseña debe tener entre 6 a 10 caracteres.');
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