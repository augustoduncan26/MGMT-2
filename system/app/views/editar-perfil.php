<!-- End PNotify -->

 <div class="col-md-12 col-xs-12">

<?php $another_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<div class="x_title">
        <h3> <i class="clip-user-2"></i> Mi Perfil</h3>
        
        <div class="clearfix"></div>
        <label id="label-mssg"><?=$mssg?></label>
        
      </div>
<div class="row">
            <div class="col-sm-12">
              <!-- start: TEXT FIELDS PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="clip-user-2"></i>
                  Mi Perfil
                </div>
                <div class="panel-body">
                  <form id="demo-form2" enctype="multipart/form-data" action="" method="post" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="col-sm-2 control-label">
                        Nombre
                      </label>
                      <div class="col-sm-7">
                        <span class="input-icon">
                          <input type="text" autocomplete="off" required name="full_name" id="full_name" placeholder="Nombre Completo" id="form-field-14" class="form-control" value="<?php echo $datos['nombre']?>">
                          <input type="hidden" id="id_user" name="id_user" value="<?php echo $datos['id_usuario']?>">
                          <i class="fa fa-user"></i> 
                        </span>
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="form-field-7">
                        Usuario
                      </label>
                      <div class="col-sm-7">
                      <span class="input-icon">
                        <input type="email" required autocomplete="off" name="username" id="username" placeholder="Usuario" id="form-field-7" class="form-control" value="<?php echo $datos['usuario']?>">
                        <i class="fa fa-user"></i> 
                      </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="form-field-7">
                      <?php if ($_SESSION['id_user']!=7) {?>
                        <a data-toggle="modal" role="button" style="text-decoration: underline" href="#formulario_nuevo" onClick="document.getElementById('nombre').focus();">Cambiar Contraseña</a>
                      <?php } else { echo ' <a href=#>Cambiar Clave</a>'; } ?>
                      </label>
                      <div class="col-sm-7">
                        <span class="input-icon">
                          <input id="form-field-8" class="form-control tooltips" type="password" data-placement="top" title="" readonly placeholder="Contraseña" data-rel="tooltip" data-original-title="La contraseña debe tener entre 6 a 10 caracteres" value="<?php echo $datos['contrasena']?>">
                        <i class="fa fa-key"></i> 
                      </span>
                      </div>
                      <span class="help-inline col-sm-2 tooltips" data-rel="tooltip" data-original-title="La contraseña debe tener entre 6 a 10 caracteres" data-placement="top"> <i class="fa fa-info-circle"></i> Contraseña (6-10) </span>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">
                        Teléfono
                      </label>
                      <div class="col-sm-7">
                        <span class="input-icon">
                          <input type="text" autocomplete="off" name="telephone" id="telephone" placeholder="Nombre Completo" id="form-field-14" class="form-control" value="<?php echo $datos['telephone']?>">
                          <i class="fa fa-phone"></i> 
                        </span>
                      </div>
                      
                    </div>


                    <div class="form-group">
                      <label class="col-sm-2 control-label">
                        Dirección
                      </label>
                      <div class="col-sm-7">
                        <span class="input-icon">
                          <input type="text" autocomplete="off" name="direcction" id="direcction" placeholder="Nombre Completo" id="form-field-14" class="form-control" value="<?php echo $datos['direcction']?>">
                          <i class="fa fa-map-marker"></i> 
                        </span>
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">
                        Foto de Perfil
                      </label>
                      <div class="col-sm-7">
                        <span class="input-icon">
                          <input id="photo" name="photo" class="date-picker form-control col-md-7 col-xs-12"  type="file" >
                          <i class="fa fa-user"></i> 
                        </span>
                      </div>
                      
                    </div>

                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!--<button class="btn btn-default btn-lg" type="button">Cancel</button>
                           <button class="btn btn-primary" type="reset">Reset</button> -->
                          <?php if ($_SESSION['id_user']!=7) {?><button type="submit" name="btn_actualizar_perfil" class="btn btn-lg btn-primary">Modificar</button><?php } ?>
                        </div>
                      </div>
                  
                  </form>
                </div>
              </div>
              <!-- end: TEXT FIELDS PANEL -->
            </div>
          </div>

<div class="clearfix"></div>


<!-- Change Password -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2"> <i class="glyphicon glyphicon-edit"></i> Cambiar contraseña</h4>
      </div>
      <div class="modal-body">
        <label>Todos los datos son necesarios</label>
        <p>
        <div class="row">
          <div class="col-md-12">
            <label>Contraseña actual</label>
            <input type="text" value="">
          </div>
          <div class="col-md-12">
            <label>Nueva contraseña</label>
            <input type="text" value="">
          </div>
          <div class="col-md-12">
            <label>Contraseña</label>
            <input type="text" value="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Actualizar contraseña</button>
      </div>

    </div>
  </div>
</div>
<!-- End Change Password -->


<!-- Change The Password -->
<div class="modal fade " id="formulario_nuevo" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Cambiar Clave</h3>
      </div>
      <div class="modal-body">
        <label id="lbl-mssg" style="color:red">Todos los datos son necesarios</label>
        <p>

        <div class="row">

         <div class="form-group">
            <label class="col-sm-4 control-label" for="form-field-7">
              Contraseña actual
            </label>
            <div class="col-sm-8">
              <span class="input-icon">
                <input class="form-control tooltips" type="password" id="actual-password" name="actual-password" data-placement="top" title="" placeholder="Contraseña actual" data-rel="tooltip" data-original-title="Clave entre 6 a 15 caracteres" value="">
              
            </span>
            </div>
           
          </div>

          <div class="clearfix">&nbsp;</div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="form-field-7">
              Nueva Contraseña
            </label>
            <div class="col-sm-8">
              <span class="input-icon">
                <input class="form-control tooltips" type="password" id="new-password" name="new-password" data-placement="top" title="" placeholder="Nueva Contraseña" data-rel="tooltip" data-original-title="Clave entre 6 a 15 caracteres" value="">
              
            </span>
            </div>
           
          </div>
      <div class="clearfix">&nbsp;</div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="form-field-7">
              Repetir Contraseña
            </label>
            <div class="col-sm-8">
              <span class="input-icon">
                <input class="form-control tooltips" type="password" id="repeat-password" name="repeat-password" data-placement="top" title="" placeholder="RepetirContraseña" data-rel="tooltip" data-original-title="Clave entre 6 a 15 caracteres" value="">
              
            </span>
            </div>
           
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnUpdatePassword" onclick="()">Actualizar contraseña</button>
      </div>
    </div>
  </div>
</div>
<!-- End Change Password -->


<!-- Modal Add User to this Company -->
  <div class="modal fade" id="add_usuarios" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Usuario</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="add_users" id="add_users" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre de usuario</td>
                   <td width="70%"><input autofocus="" name="nombre" required maxlength="40" type="text" class="form-control" id="nombre" placeholder="Nombre Completo"></td>
                 </tr>
                 <tr>
                   <td>Email</td>
                   <td><input name="email" type="email" required maxlength="50" class="form-control" id="email" placeholder="Email">
                   </td>
                 </tr>
                 <tr>
                   <td>Telfono</td>
                   <td><input name="telefono" type="text" maxlength="30" class="form-control" id="telefono" placeholder="Teléfono"></td>
                 </tr>

                 <tr>
                   <td>Dirección</td>
                   <td><input name="direccion" type="text" maxlength="100" class="form-control" id="direccion" placeholder="Dirección"></td>
                 </tr>

                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0" selected>Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <!-- <input class="btn btn-primary"  type="button" name="button2" id="button2" value="Agregar" onClick="javascript: cargarCodigoBarra()" /> -->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" name="btn-agregar-user"  class="btn btn-primary" id="btn-agregar-user" onclick="addUser()">Guardar datos</button>
          
                    
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- End Add user to company -->


<!-- Modal List Cia User -->
<!-- Modal Add user to company -->
<div class="modal fade" id="list-users" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Lista de Usuarios</h3>
      </div>
      <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
        <div class="modal-body">
         <div id="list-of-users">
         Cargando...
         </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal List Cia User -->


<!-- Modal Subir Logo -->
<div class="modal fade" id="logo-empresa" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h3 class="modal-title">Subir Logo</h3>
      </div>
      <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
        <div class="modal-body">
         <div id="list-of-users">
         Cargando...
         </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal List Cia User -->


<!-- Modal BackUp - Copia de respaldo -->
<div class="modal fade" id="copia-respaldo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h3 class="modal-title">Copia de Respaldo</h3>
      </div>
      <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
        <div class="modal-body">
         <div id="list-of-users">
         Cargando...
         </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal List Cia User -->

<?php get_noPermission() ?>


<?php //get_template_part('footer_scripts');?>

<script>


// Add Category
function addUser () {

  var nombre      =   $('#nombre').val();
  var email       =   $('#email').val();
  var telefono    =   $('#telefono').val();
  var direccion   =   $('#direccion').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1  || email.length < 1) {
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    $('#nombre').css({'border-color': '#007AFF'});
    $('#email').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/editar-perfil.php?add=1&nombre="+nombre+"&direccion="+direccion+"&telefono="+telefono+"&email="+email+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      //$('#cargando_add').hide();
      listCategory();
      $('#nombre').val('');
    }
  }

  ajax2.send(null);

}

// Listar Usuarios de la Cia
function listarUsuarios () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-of-users')[0];
  //$('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_company_users.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      //$('#cargando_list').hide()
      $('#list-table-users').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}



function verifyActualPasswd () {

    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
    var actualpasswd   = $('input[name=actual-password]').val();
    var newpasswd   = $('input[name=new-password]').val();

    var contenido_editor = $('#lbl-mssg')[0];

    ajax1   = nuevoAjax();
    ajax1.open("GET", "ajax/ajax_change_passwd.php?id_user="+id_user+"&actualpasswd="+actualpasswd+"&que=verifyP&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    ajax1.onreadystatechange=function() {

      if (ajax1.readyState==4) {
        contenido_editor.innerHTML = ajax1.responseText;
      }
    }

    ajax1.send(null);
}

 function ChangePasswd () {
    
    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
    var newpasswd   = $('input[name=new-password]').val();

    var contenido_editor = $('#lbl-mssg')[0];

    ajax1   = nuevoAjax();
    ajax1.open("GET", "ajax/ajax_change_passwd.php?id_user="+id_user+"&newpassword="+ newpasswd +"&que=changeP&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    ajax1.onreadystatechange=function() {

      if (ajax1.readyState==4) {
        contenido_editor.innerHTML = ajax1.responseText;
      }
    }

    ajax1.send(null);
 }


$( document ).ready(function() {
 
    $( "#btnUpdatePassword" ).click(function( event ) {
 
       var pass = $('input[name=new-password]').val();
       var repass = $('input[name=repeat-password]').val();

      if ( !$('#new-password').val() || !$('#repeat-password').val() || !$('#actual-password').val()) {
           $('#lbl-mssg').html('<font color="red">Existen campos vacios</font>');
         } else {

        //if (verifyActualPasswd ()) {

          if ( pass != repass ) {
            //$('#new-password').addClass('has-error');
            //$('#repeat-password').addClass('has-error');

            $('#lbl-mssg').html('<font color="red">LAS CLAVES SON DIFERENTES</font>');
            //$('#btnUpdatePassword').attr('type','button');
            //$('#new-password').focus();

            return false;
          } else { 

            ChangePasswd();
            //$('#lbl-mssg').html('<font color="red">Ha cambiado su contraseña con éxito</font>');
            $('#btnUpdatePassword').attr('type', 'submit'); 
          }
      }
 
    });
 
});


</script>
