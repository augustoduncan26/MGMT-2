/**  Validate Email */
$('#email').on('input', ()=>{
    let res = validate('alert-mssg-register', 'email');
    if (res==false) {
        $('.alert-mssg-register').removeClass('alert-success').removeClass('alert-info').addClass('alert-danger');
        setTimeout(()=>{
            $('.alert-mssg-register').hide();
          },4000);
    }
  });

/** Sign Up Event */
$('.btn-register').on('click',(e)=>{

    let pass = document.getElementById('password');
    let error = 0;

    if ($('#email').val()=="" || $('#full_nombre').val()=="" || $('#password').val()=="" || $('#password_again').val()=="") {
        $('.alert-mssg-register').removeClass('alert-success').removeClass('alert-info').addClass('alert-danger').show().html('Todos los campos son requeridos.');
        return false;
    }
    // Validate email
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
    }
    if($('#agree_check').is(":checked") == false){
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Debe aceptar los terminos y servicios de privacidad.');
        preventSubmitForm();
        return false;
    }
    if (validateSignUpEmail($('#email').val())==false) {
        $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Este email ya se encuentra en uso.');
        e.preventDefault();
        return false;
    }
     else {
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

const preventSubmitForm = () => {
    const form = document.getElementById('registerUserForm');
        form.addEventListener('submit', function(event) {
        event.preventDefault();
        // Add any other logic you want to execute before stopping the submission
        console.log('Form submission stopped!');
        return false;
    });
}
const validateSignUpEmail = (email) => {
    let route = "login.php";
    $.ajax({
        headers: {
            Accept        : "application/json; charset=utf-8",
            "Content-Type": "application/json: charset=utf-8"
        },
        url: route,
        type: "GET",
        data: {
            showEdit  : 1,
            r1        : email,
            check     : 'check'
        },
        dataType        : 'text',
        success         : function (response) {
            if (response==1) {
                $('.alert-mssg-register').removeClass('alert-info').addClass('alert-danger').show().html('Este email ya se encuentra en uso.');
                return false;
            }
        },
        error           : function (error) {
            console.log(error);
            return false;
        }
    });
}