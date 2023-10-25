
<!-- <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" /> -->
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />

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
    ajax2.open("GET", "app/controllers/editar-perfil-configuraciones.php?add=1&nombre="+nombre+"&direccion="+direccion+"&telefono="+telefono+"&email="+email+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      //$('#cargando_add').hide();
      listarUsuarios();
      $('#nombre').val('');
    }
  }

  ajax2.send(null);

}


// Edit Event
function editUser ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var contenido_editor = $('#contenido_editar')[0];

  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_editar_user_company.php?id="+id+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}

// Update Event
function updateUser ( id ) {
  
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var nombre      = $('#txt_nombre').val();
  var email       = $('#txt_email').val();
  var telefono    = $('#txt_telefono').val();
  var direccion   = $('#txt_direccion').val();
  var contrasena  = $('#txt_contrasena').val();
  var estado      = $('#txt_estado').val();

  if (nombre.length < 1  || email.length < 1) {
    $('#mssg-label-edit').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_email').css({'border-color': '#007AFF'});
    return false;
  }

  ajax3   = nuevoAjax();
  ajax3.open("GET", "app/controllers/editar-perfil-configuraciones.php?edit=1&id="+id+"&email="+email+"&telefono="+telefono+"&direccion="+direccion+"&nombre="+nombre+"&activo="+estado+"&contrasena="+contrasena+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax3.onreadystatechange=function() {

    if (ajax3.readyState==4) {
      //contenido_editor.innerHTML = ajax2.responseText;
      listarUsuarios();
      $("#mssg-label-edit").html('<uppercase>Los datos fueron actualizados con éxito</uppercase>');
      
    }
  }

  ajax3.send(null);
}


// Listar Usuarios de la Cia
function listarUsuarios () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-users')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_company_users.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide()
      $('#list-table-users').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}


// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/editar-perfil-configuraciones.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listarUsuarios();
    }
  }

  ajax2.send(null);
}


// Show Permisos
function showUserPermisos ( id ) {

    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
    var contenido_editor = $('#show-permisos')[0];

    //$('#cargando_list').show()
    ajax1   = nuevoAjax();
    ajax1.open("GET", "ajax/ajax_list_users_permisos.php?id_user="+id_user+"&id="+id+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
    ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
     // $('#cargando_list').hide()
      //$('#table_permisos').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);

}

// Edit Permisos
function editUserPermisos ( idParam ) {
    
    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
    var id_         = idParam; //$('#id_row').val();

    var datas       = new Array();

    // Capturar los valores que seleccionan
    $("input:checkbox:checked").each(function() {
      // alert($(this).val());
      datas.push($(this).val());
    });
    
    if ( datas == '') {
      $('#mssg-label-edit-perm').html('No ha seleccionado ningun permiso.');
      return false
    }

    var editperm    = 1;
    var form_data   =   new FormData();

    form_data.append('editperm' , editperm);
    form_data.append('permisos', permisos);
    form_data.append('valores', datas);
    form_data.append('id_', id_);

  $.ajax({
        url: 'app/controllers/configurar-usuarios.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
          $('#mssg-label-edit-perm').html(response);
        },
        error: function (response) {
        }
    });
}

// Clean inputs file
function limpiar () {

  $('#mssg-label').html('');
  $('#txt_mssg-label').html('');
  $('#mssg-label-edit').html('');
  $('#mssg-label-edit-perm').html('');
}


</script>
<!-- End PNotify -->

<body onload = "listarUsuarios()">

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3><i class="clip-settings"></i> Configuraciones</h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
      

      <div class="item form-group row ">
        <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
          <div class="col-sm-2">
              <button class="btn btn-icon btn-block btn-warning box-shadow">
               <i class="fa fa-user"></i>
               [+] Usuarios 
            </button>
          </div>
        </a>

        <!-- <a data-toggle="modal" role="button" href="#list-users" onClick="listarUsuarios()">
          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="fa fa-group"></i>
              Lista de Usuarios 
            </button>
          </div>
        </a> -->

          <a data-toggle="modal" role="button" href="#logo-empresa" onClick="">
          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="fa fa-picture-o"></i>
              Logo de Empresa
            </button>
          </div>
          </a>

          <a data-toggle="modal" role="button" href="#copia-respaldo" onClick="">
          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="clip-data"></i>
              Copia de Respaldo
            </button>
          </div>
          </a>



         <!--  <div class="col-md-3 col-sm-3 col-xs-6">
            <a  data-toggle="modal" role="button" href="#add_usuarios" onClick=""><i class="fa fa-user"></i> Agregar Usuarios</a>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="modal" role="button" href="#list-users" onClick=""><i class="fa fa-group"></i> Lista de Usuarios</a>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="modal" role="button" href="#" onClick=""><i class="clip-pictures"></i> Logo de Empresa</a>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="modal" role="button" href="#" onClick=""><i class="clip-data"></i> Copia de Respaldo</a>
          </div> -->

        </div>

        <div class="clearfix"></div>

    </div>

<br />
<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->

   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-group"></i>Lista de Usuarios
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

               <div class="x_content">
               <img src="images/ajax-loader.gif" id="cargando_list" />
               <div id="list-users"  ></div>
              </div>
            </div>
          </div>
       </div>
      </div>
    </div>

  </div>
</div>
</div>

 <div class="clearfix"></div>

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
                   <td width="30%">Nombre completo</td>
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



<!-- Modal Edit User -->
  <div class="modal fade" id="edit_usuarios" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Usuario</h3>
          <label id="mssg-label-edit"></label>
        </div>
         <form name="add_users" id="add_users" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body" id="contenido_editar">
         Cargando...
           <!--   <table class="table table-bordered table-hover" id="sample-table-4">
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
             </table> -->
           </div>
        <div class="modal-footer">
          <!-- <input class="btn btn-primary"  type="button" name="button2" id="button2" value="Agregar" onClick="javascript: cargarCodigoBarra()" /> -->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" name="btn-agregar-user"  class="btn btn-primary" id="btn-agregar-user" onclick="var id_row = $('#id_row').val(); updateUser(id_row);">Guardar datos</button>
          
                    
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- End Edit User -->


<!-- Change The Password -->
<div class="modal fade " id="formulario_nuevo" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Cambiar Clave</h4>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnUpdatePassword" onclick="()">Actualizar contraseña</button>
      </div>
    </div>
  </div>
</div>
<!-- End Change Password -->


<!-- Change Password -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Cambiar contraseña</h4>
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


<!-- Show Permisos -->
<div class="modal fade" id="user-permission" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Permisos</h3>
          <label id="mssg-label-edit-perm"></label>
      </div>
    <div class="modal-body" id="show-permisos">
        Cargando...
    </div>
    <div class="modal-footer">
      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="permisos_user" type="button" class="btn btn-primary" id="permisos_user" onClick="var id_row = $('#id_row').val(); editUserPermisos(id_row)" value="Modificar datos">
    </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->


<!-- Modal List Cia User -->
<!-- Modal Add user to company -->
<!-- <div class="modal fade" id="list-users" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display: none;">
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
</div> -->

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
         <div id="list-of-usersssssss">
         <!-- Cargando... -->
         <?php get_noPermission() ?>
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
         <div id="list-of-userssssssssssssss">
         <!-- Cargando... -->
         <?php get_noPermission() ?>
         </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal List Cia User -->




<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="assets/js/table-data.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

<script>
jQuery(document).ready(function() {
    //Main.init();
});
 //$('#list-table-users').dataTable({aaSorting : [[3, 'asc']]});

// $("#list-table-events").modal({"backdrop": "static"});
    </script>

</body>