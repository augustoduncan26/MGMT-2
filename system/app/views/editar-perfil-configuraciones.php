<!-- <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" /> -->
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.css" />

<body onload = "listarUsuarios()">

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3><i class="clip-settings"></i> Configuraciones</h3>
      <div class="clearfix"></div>
      <div class="row" id="label-mssg"><?=$mssg?></div>

      <div class="item form-group row ">
        <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
          <div class="col-sm-2">
              <button class="btn btn-icon btn-block btn-warning box-shadow">
               <i class="fa fa-user"></i>
               [+] Agregar Usuarios 
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
               <!-- <img src="images/ajax-loader.gif" id="cargando_list" /> -->
               <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
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
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Usuariosss</h3>
          <div id="mssg-label"></div>
        </div>
         <form name="add_users" id="add_users" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td>Email</td>
                   <td><input name="email" type="email" required maxlength="50" class="form-control" id="email" placeholder="Email">
                   <label class="color-red">Este será el usuario para entrar al sistema.</label>
                   </td>
                 </tr>
                 <tr>
                   <td width="30%">Nombre</td>
                   <td width="70%"><input autofocus="" name="nombre" required maxlength="40" type="text" class="form-control" id="nombre" placeholder="Nombre Completo"></td>
                 </tr>

                 <tr>
                   <td>Contraseña</td>
                   <td>
                    <input name="contrasena" type="password" maxlength="15" class="form-control" id="contrasena" placeholder="Contraseña">
                    <label class="color-red">La contraseña debe tener entre 6 a 10 caracteres.</label>
                  </td>
                 </tr>

                 <tr>
                   <td>Departamento</td>
                   <td>
                   <select name="deptoModal" class="" id="departamento">
                      <option value=''></option>
                    <?php
                      foreach ($listaDeptos['resultado'] as $key => $depto) {
                          echo "<option value='".$depto['id']."'>".$depto['name']."</option>";
                      }
                    ?> 
                    </select> 
                   <!-- <input name="deptoModal" type="text" maxlength="30" class="form-control" id="depto" placeholder="Departamento"> -->
                  </td>
                 </tr>

                 <tr>
                   <td>Dirección</td>
                   <td>
                    <input name="direccion" type="text" maxlength="100" class="form-control" id="direccion" placeholder="Dirección">
                  </td>
                 </tr>

                 <tr>
                   <td>Telfono</td>
                   <td><input name="telefono" type="text" maxlength="30" class="form-control" id="telefono" placeholder="Teléfono"></td>
                 </tr>

                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado" id="estado" class="">
                      <option value="1">Activo</option>
                      <option value="0" selected>Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" name="btn-agregar-user"  class="btn btn-primary" id="btn-agregar-user" onclick="addUser()">Guardar datos</button>
          
                    
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- End Add user to company -->



<!-- Modal Edit -->
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
         <form name="add_users2" id="add_users2" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body" id="contenido_editar">
         <!-- Cargando... -->

         <table class="table table-bordered table-hover" id="sample-table-4">
            <tbody>
            <tr>
            <td width="30%">Nombre completo</td>
            <td width="70%"><input autofocus="" name="txt_nombre" required maxlength="40" type="text" class="form-control" id="txt_nombre" value="<?=$data['nombre']?>" placeholder="Nombre Completo">
            <input type="hidden" name="id_row" id="id_row" value="<?=$data['id_usuario']?>"></td>
            </tr>
            <tr>
            <td>Email</td>
            <td><input name="email" type="email" required maxlength="50" class="form-control" id="txt_email" placeholder="Email" value="<?=$data['email']?>">
            </td>
            </tr>
            <tr>
            <td>Departamento</td>
            <td>
            <select name="deptoEditar" class="" id="txt_depto">
            <option value=''></option>
            <?php
            foreach ($listaDeptos['resultado'] as $key => $depto) {
              echo "<option value='".$depto['id']."'>".$depto['name']."</option>";
            }
            ?> 
            </select>
            <!-- <input name="depto" type="text" maxlength="30" class="form-control" id="txt_depto" placeholder="Departamento" value="<?=$depto['name']?>"> -->
            </td>
            </tr>
            <tr>
            <td>Telfono</td>
            <td><input name="telefono" type="text" maxlength="30" class="form-control" id="txt_telefono" placeholder="Teléfono" value="<?=$data['telephone']?>"></td>
            </tr>

            <tr>
            <td>Dirección</td>
            <td><input name="direccion" type="text" maxlength="100" class="form-control" id="txt_direccion" placeholder="Dirección" value="<?=$data['direcction']?>"></td>
            </tr>

            <tr>
            <td>Cambiar contraseña</td>
            <td><input name="contrasena" type="password" maxlength="100" class="form-control" id="txt_contrasena" placeholder="Contraseña" value="">
            <label style="color:red; size: 10px">Dejar en blanco, si no desea cambiar la contraseña</label></td>
            </tr>

            <tr>
            <td>Estado</td>
            <td>
            <select name="estado" id="txt_estado" class="">
            <option value="1" <?php if($data['activo'] == 1) { echo 'selected';}?>>Activo</option>
            <option value="0" <?php if($data['activo'] == 0) { echo 'selected';}?>>Inactivo</option>
            </select>
            </td>
            </tr>
                            
            </tbody>
          </table>
 
           </div>
        <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" name="btn-agregar-user2"  class="btn btn-primary" id="btn-agregar-user2" onclick="var id_row = $('#id_row').val(); updateUser(id_row);">Guardar datos</button>      
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
                <input class="form-control" type="password" id="actual-password" name="actual-password" title="" placeholder="Contraseña actual" value="">
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
                <input class="form-control" type="password" id="new-password" name="new-password" title="La Contraseña debe tener entre 6 a 10 caracteres." placeholder="Nueva Contraseña" value="">
              
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
                <input class="form-control" type="password" id="repeat-password" name="repeat-password" data-placement="top" title="La Contraseña debe tener entre 6 a 10 caracteres." placeholder="RepetirContraseña" value="">
              
            </span>
            </div>
           
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnUpdatePassword" onclick="">Actualizar contraseña</button>
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
      <form name="clientes-logo" id="clientes-logo" method="post" action="#SELF" enctype="multipart/form-data">
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

<script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>
  

<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.min.js"></script>


</body>
<script src="assets/js/datatable-config.js"></script>
<script>

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

// Add
function addUser () {

  let nombre      =   $('#nombre').val();
  let email       =   $('#email').val();
  let contrasena  =   $('#contrasena').val();
  let telefono    =   $('#telefono').val();
  let depto       =   $('#departamento').val();
  let direccion   =   $('#direccion').val();
  let estado      =   $('#estado').val();

    if (nombre.length < 1  || email.length < 1 || contrasena.length < 1) {
      $('#mssg-label').html('Los campos marcados en rojo son necesarios.');
      $('#departamento').css({'border-color': 'red'});
      $('#nombre').css({'border-color': 'red'});
      $('#email').css({'border-color': 'red'});
      $('#contrasena').css({'border-color': 'red'});
      return false;
    }

    if (depto.length < 1) {
      $('#mssg-label').html('El campo departamento es necesarios.');
      return false;
    }

    if (contrasena.length < 1) {
      $('#mssg-label').html('La contraseña debe tener entre 6 a 10 caracteres.');
      $('#contrasena').css({'border-color': 'red'});
      return false;
    }

    if (validateEmail(email)==false) {
      $('#mssg-label').html('Debe ingresar un email válido.');
      $('#email').css({'border-color': 'red'});
      return false;
    }

    $('#email').css({'border-color': ''});
    $('#nombre').css({'border-color': ''});
    $('#contrasena').css({'border-color': ''});

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/editar-perfil-configuraciones.php?add=1&nombre="+nombre+"&contrasena="+contrasena+"&depto="+depto+"&direccion="+direccion+"&telefono="+telefono+"&email="+email+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      listarUsuarios();
      $('#nombre').val('');
    }
  }

  ajax2.send(null);

}


// Show edit Event Modal
function editUser ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  var contenido_editor = $('#contenido_editar')[0];
  $('#mssg-label-edit').hide();
  
  let route = "app/controllers/editar-perfil-configuraciones.php";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      showEdit  : 1,
      id        : id,
      id_cia    : id_cia,
      nocache : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'json',
    success         : function (response) { 

      $('#txt_nombre').val(response['nombre']);
      $('#txt_email').val(response['email']);
      $('#txt_depto').select2('val',response['id_depto']);
      $('#txt_telefono').val(response['telephone']);
      $('#txt_direccion').val(response['direcction']);
      $('#txt_estado').select2('val',response['activo']);
      $('#id_row').val(response['id_usuario']);
      // console.log(response)

      listarUsuarios();
      $("#mssg-label-edit").html('<uppercase>Los datos fueron actualizados con éxito.</uppercase>');
      
    },
    error           : function (error) {
      console.log(error);
    }
  });


}

// Update Event
function updateUser ( id ) {
  
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var nombre      = $('#txt_nombre').val();
  var email       = $('#txt_email').val();
  var telefono    = $('#txt_telefono').val();
  var depto       = $('#txt_depto').val();
  var direccion   = $('#txt_direccion').val();
  var contrasena  = $('#txt_contrasena').val();
  var estado      = $('#txt_estado').val();
  $('#mssg-label-edit').css({'width':'100%'})

  if (nombre.length < 1  || email.length < 1) {
    $('#mssg-label-edit').html('Los campos con (*) son requerido.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_email').css({'border-color': '#007AFF'});
    return false;
  }

  if ($('#txt_depto').val() == "" || $('#txt_depto').val() == null) {
    $('#mssg-label-edit').show();
    $('#mssg-label-edit').html('<div class="alert alert-danger">El campo departamento es requerido.</div>');
    return false;
  }

  if (contrasena !="" && contrasena.length < 6) {
    $('#mssg-label-edit').html('La contraseña debe tener entre 6 a 10 caracteres.');
    $('#txt_contrasena').css({'border-color': '#007AFF'});
    return false;
  }

  let route = "app/controllers/editar-perfil-configuraciones.php";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      edit    : 1,
      id      : id,
      email   : email,
      telefono: telefono,
      direccion:direccion,
      depto   : depto,
      nombre  : nombre,
      activo  : estado,
      contrasena:contrasena,
      id_empresa  : id_empresa,
      nocache : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'html',
    success         : function (response) { 
      $('#mssg-label-edit').show();
      listarUsuarios();
      $("#mssg-label-edit").html('<div class="alert alert-success">Los datos fueron actualizados con éxito.</div>');
      
    },
    error           : function (error) {
      console.log(error);
    }
  });
}


/** List User */
const listarUsuarios = () => {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';

  var contenido_editor = $('#list-users')[0];
  $('#cargando_list').show();
  let route = "ajax/ajax_list_company_users.php";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id_user : id_user,
      id_cia  : id_cia,
      nocache : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'html',
    success         : function (response) { 
      contenido_editor.innerHTML = response;
      $('.fa-spinner').hide();
      let setting = [];
      setting['ordering'] = 0;
      setting['notorder'] = [5];
      setting['totalpages'] = [20, 30, 50, 100, 250];
      loadDataTable('list-table-users',setting);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}


// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/editar-perfil-configuraciones.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      setTimeout(()=>{
        $('#label-mssg').html('');
      },4000);
      listarUsuarios();
    }
  }

  ajax2.send(null);
}


// Show Permisos
function showUserPermisos ( id ) {

    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    var contenido_editor = $('#show-permisos')[0];

    //$('#cargando_list').show()
    ajax1   = nuevoAjax();
    ajax1.open("GET", "ajax/ajax_list_users_permisos.php?id_user="+id_user+"&id="+id+"&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>",true);    
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

 $("[name='deptoEditar']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
 $("[name='deptoModal']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
 $("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>
<!-- End PNotify -->