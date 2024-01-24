
<!-- Switchery -->
    <!-- <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet"> -->
<!-- End: Switchery -->

<style>
  @media (min-width: 768px) {
  .modal-xl {
    width: 70%;
   max-width:1350px;
  }
}

</style>
<!-- form input mask -->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h3>Cambiar Contraseña</h3>
      <div class="clearfix"></div>
      <!-- <label id="label-mssg"></label> -->
      <div class="alert alert-danger"><?=$mssg?></div>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" method="post" action="?usuarios-cambiar-clave">
      <!-- <form id="form1" name="form1" method="post" action="?usuarios-cambiar-clave"> -->
        <div class="item form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">Contraseña actual <span class='symbol required'></span>
          </label>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <input id="name_cia" class="form-control col-md-7 col-xs-12" data-validate-length-range="10" data-validate-words="2" name="clave_actual" placeholder="Contraseña actual" required="required" type="password" value="">
            <!-- onkeyup="javascript:
            if(muestra_seguridad_clave(this.value, this.form)>75) {
                document.getElementById('btn-modificar-clave').disabled=false;
                document.getElementById('ejemplo_input').style.display	=	'block';
                document.getElementById('ejemplo_input').innerHTML		=	'<font size=2><img width=20px height=20px src=image/ok.jpg border=0 /> Es una contrase&ntilde;a segura.</font>';
            } else {
                document.getElementById('btn-modificar-clave').disabled='disabled';
                document.getElementById('ejemplo_input').style.display	=	'block';
                document.getElementById('ejemplo_input').innerHTML		=	'La clave debe tener: letras, numeros y/o un caracter <br /> Debe tener de 8 a 10 caracteres.';
            }
            " -->
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">Nueva contraseña <span class='symbol required'></span></label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input id="clave_nueva" class="form-control col-md-7 col-xs-12" name="clave_nueva" placeholder="Nueva contraseña" required="required" type="password" value=""
            onkeyup="javascript:
            if(muestra_seguridad_clave(this.value, this.form) > 75) {
                // document.getElementById('Accion_CambiarClave').disabled=false;
                 document.getElementById('new_clave').style.display	=	'block';
                  document.getElementById('new_clave').innerHTML		=	'<font size=2><img width=20px height=20px src=assets/image/ok.jpg border=0 /> Es una contrase&ntilde;a segura.</font>';
              } else {
                  // document.getElementById('Accion_CambiarClave').disabled='disabled';
                  document.getElementById('new_clave').style.display	=	'block';
                  document.getElementById('new_clave').innerHTML		=	'Debe tener: Mínimo una letra mayúscula, numeros. Y entre 6 a 10 caracteres.';
                }
              "
            >
          </div>
          <div class="col-md-4"><div id="new_clave" class="bordered" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color:#F00; display:none;" align="center"></div></div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">Repetir contraseña <span class='symbol required'></span>
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input id="repetir_clave" class="form-control col-md-7 col-xs-12" name="repetir_clave" placeholder="Repetir contraseña" required="required" type="password" value="">
          </div>
          <div class="col-md-4"><div id="new_repetir_clave" class="bordered" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color:#F00; display:none;" align="center"></div></div>
        </div>

      <div class="form-group">
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">
          <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
          <button type="submit" class="btn btn-primary form-control" name="btn-modificar-clave">Cambiar contraseña</button>
        </div>
        <div class="col-md-4">&nbsp;</div>
      </div>

      <div class="row">
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-4"><i class="clip-info"></i> <a data-toggle="modal" href="#add_usuarios" role="button">Como crear contraseñas seguras.</a></div>
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">La constraseña debe tener entre 6 a 10 caracteres. Debe tener por lo menos 1 letra mayúscula, letras y números.</div>
      </div>
     </form>
        
      <div class="clearfix"></div>
      
      <div class="ln_solid"></div>
     
    </div>
  </div>
</div>


<!-- Modal: Contraseñas seguras -->
  <div class="modal fade" id="add_usuarios" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title">Como crear contraseña seguras</h3>
        </div>
           <div class="modal-body">
            <embed src="repositorio/contrasena.pdf" frameborder="0" width="100%" height="100%">
            <!-- <iframe src="repositorio/contrasena.pdf" width="100%" height="100%" frameBorder="0"></iframe> -->
           </div>
        <!-- <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">Cerrar</button>          
        </div>-->
      </div>
    </div>
  </div>
<!-- End: Contraseñas seguras -->

<script>
$(".alert").hide();
$("[name='btn-modificar-clave']").on('click',()=>{
    if ($("[name='clave_actual']").val()=="" || $("[name='clave_nueva']").val()=="" || $("[name='repetir_clave']").val()=="") {
        $(".alert").removeClass('alert-success').html('Los campos con * son requeridos.').show();
        setTimeout(()=>{ $(".alert").hide();},4000);
        return false;
    }
    if ($("[name='clave_nueva']").val()!=$("[name='repetir_clave']").val()) {
        $(".alert").removeClass('alert-success').html('No cohincide la constraseña.').show();
        setTimeout(()=>{ $(".alert").hide();},4000);
        return false;
    }
    if ($("[name='clave_nueva']").val().length < 6 || $("[name='repetir_clave']").val().length < 6) {
        $(".alert").removeClass('alert-success').html('La constraseñas deben tener entre 6 a 10 caracteres.').show();
        setTimeout(()=>{ $(".alert").hide();},4000);
        return false;
    }
});

let numeros = "0123456789";
let letras  = "abcdefghyjklmnñopqrstuvwxyz";
let letras_mayusculas = "ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";


/** Seguridad clave */
function seguridad_clave(clave){
	var seguridad = 0;
	if (clave.length!=0){
		if (tiene_numeros(clave) && tiene_letras(clave)){
			seguridad += 30;
		}
		if (tiene_minusculas(clave) && tiene_mayusculas(clave)){
			seguridad += 30;
		}
		if (clave.length >= 4 && clave.length <= 5){
			seguridad += 10;
		}else{
			if (clave.length >= 6 && clave.length <= 8){
				seguridad += 30;
			}else{
				if (clave.length > 8){
					seguridad += 40;
				}
			}
		}
	}
	return seguridad;				
}	

const tiene_numeros = (texto) => {
   for(i=0; i<texto.length; i++){
      if (numeros.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
} 

const tiene_letras = (texto) => {
   texto = texto.toLowerCase();
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
} 

const tiene_minusculas = (texto) => {
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
} 

/** Check if string contain Uppercase Letters */
const tiene_mayusculas = (texto) => {
   for(i=0; i<texto.length; i++){
      if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
} 

const muestra_seguridad_clave = (clave,formulario) => {
  
	seguridad=seguridad_clave(clave);
  console.log(seguridad)
	//formulario.seguridad.value=seguridad;
	return seguridad;
}

/** Check if string contain an Uppercase Letter */
const containsUppercase = (str) => {
  return /[A-Z]/.test(str);
}
//   $("[name='moneda']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
//   $("[name='idioma']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>