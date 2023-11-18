
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<!-- <link rel="stylesheet" href="assets/css/modal-style.css" type="text/css" /> -->
<script>

// Add User
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
    ajax2.open("GET", "app/controllers/configurar-usuarios.php?add=1&nombre="+nombre+"&direccion="+direccion+"&telefono="+telefono+"&email="+email+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      listUsers();
      $('#nombre').val('');
    }
  }

  ajax2.send(null);
}

// Edit Event
function editUser ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var contenido_editor = $('#edit-user-content')[0];

  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_editar_user_company.php?all=1&id="+id+"&edit=1&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
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
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_email').css({'border-color': '#007AFF'});
    return false;
  }

  ajax3   = nuevoAjax();
  ajax3.open("GET", "app/controllers/configurar-usuarios.php?edit=1&id="+id+"&email="+email+"&telefono="+telefono+"&direccion="+direccion+"&nombre="+nombre+"&activo="+estado+"&contrasena="+contrasena+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax3.onreadystatechange=function() {

    if (ajax3.readyState==4) {
      //contenido_editor.innerHTML = ajax2.responseText;
      listUsers();
      $("#txt_mssg-label").html('<uppercase>Los datos fueron actualizados con éxito</uppercase>');
      
    }
  }

  ajax3.send(null);
}

// List all room
function listUsers() {   

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rows')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_users.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide()
      $('#list-table-users').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
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
function editUserPermisos ( id ) {
    
    var id_user     = '<?php echo $_SESSION["id_user"]?>';
    var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
    var id_         = $('#id_row').val();

    var datas       = new Array();
    //$('html, body').animate({scrollTop: '0px'}, 'slow');
    // Capturar los valores que seleccionan
    $("input:checkbox:checked").each(function() {
      
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


function limpiar () {
  $('#mssg-label-edit-perm').html('');
}
</script>

<body onload="listUsers();">

<!-- <a id="totop" name="totop"></a> -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Usuario</a>

    <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-user-plus"></i>Usuarios
          </div>
          <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

              <div class="x_content">
              <!-- <img src="images/ajax-loader.gif" id="cargando_list" /> -->
              <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
              <div id="list-rows"></div>
              
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


<!-- Modal Edit User Info -->
<div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Usuario</h3>
         <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="edit-user-content">
        Cargando...
      </div>
      <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="editar_el_usuario" type="button" class="btn btn-primary" id="editar_el_usuario" onClick="var id_row = $('#id_row').val(); updateUser(id_row)" value="Modificar datos">
    </div>
    </div>
  </div>
</div>
<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Modal New User -->
  <div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Usuario</h3>
           <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre</td>
                   <td width="70%"><input autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre Completo"></td>
                 </tr>
                <!--   <tr>
                   <td>Usuario:</td>
                   <td><input name="usuario" type="text" required="" class="form-control" id="usuario"  placeholder="Usuario de acceso"  ></td>
                 </td>
                 </tr> -->
                 
                 <tr>
                   <td>Email</td>
                   <td><input name="email" type="email" required="" class="form-control" id="email" placeholder="Email">
                   </td>
                 </tr>
                 <tr>
                   <td>Telfono:</td>
                   <td><input name="telefono" type="text" class="form-control" id="telefono" placeholder="Teléfono"></td>
                 </tr>

                 <tr>
                   <td>Dirección</td>
                   <td><input name="direccion" type="text" class="form-control" id="direccion" placeholder="Dirección"></td>
                 </tr>

                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0" selected="">Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_habitacion" type="submit" class="btn btn-primary" id="agregar_usuario" onClick="addUser()" value="Guardar datos">
                
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- End New User -->


<!-- Show Permisos -->
<div class="modal fade" id="user-permission" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;overflow: auto !important;">
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


<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="../assets/js/table-data.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->


<script>

    jQuery(document).ready(function() {
        //Main.init();
        TableData.init();
      });
     //$('#list-table-users').dataTable({aaSorting : [[3, 'asc']]});
     $('#table_permisos').dataTable({aaSorting : [[0, 'asc']]});
</script>

 </body>
