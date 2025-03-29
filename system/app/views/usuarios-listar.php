<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<!-- <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- <link rel="stylesheet" href="assets/css/styles_datatable.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<style>
@media (min-width: 768px) {
  .modal-xl {
    width: 70%;
   max-width:1350px;
  }
}
.dataTables_filter {
  width: 30%;
}
div.dataTables_wrapper div.dataTables_filter input {
      width: 100%;
}
div.dataTables_wrapper div.dataTables_filter label {
  width: 300px !important;
}
</style>

<body>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="limpiarCampos();$('#usuario_acceso').focus();">[+] Nuevo Usuario</a>
  <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
  <a data-toggle="modal" class="btn btn-success"  role="button" href="#"><i class="clip-download-3"></i> Importar</a>
    <div class="row">
      <div class="col-sm-12">
       <div class=""><!-- panel panel-info -->
          <div class="panel-heading">
            <i class="clip-users"></i> Usuarios
          </div>
          <div class="panel-body  table-responsive">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

              <div class="x_content">

			        <div id="table-responsive">
                <table id="tabla-list-usuarios" class="table table-striped table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha creación</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody-table-perfiles">
                    <?php
                      if (isset($listUsers['resultado'])) {
                        foreach ($listUsers['resultado'] as $key => $value) {
                    ?>
                      <tr>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$key+1?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['nombre'].' '.$value['apellido']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['email']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['created_at']?></td>
                          <!-- <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($value['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td> -->
                          <!--'<span class="label label-sm label-success">Activo</span>'-->
                        <td  <?php if($value['activo']==0){?> class="row-yellow-transp" <?php } ?>><?php if($value['activo'] ==1) { echo 'Activo'; } else { echo '<span class="label label-sm label-danger">Inactivo</span>';} ?></td>
                        <td class="text-center" >
                          <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $value['id_usuario']; ?>');"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiarCampos('edit_usuario');showUserPermisos('<?php echo $value['id_usuario']; ?>');"><i class="fa fa-key"></i></a>
                          <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $value['id_usuario']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
                        </td>
                      </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <!-- <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i> -->
              </div>
              
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

  <!-- Edit Row -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?> modal-xl">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Usuario</h3>
</div>

<form name="edit_usuarios" id="edit_usuarios" method="post" action="#SELF" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="alert alert-danger" id="mssg-alert-edit"></div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Usuario de acceso <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <input type="hidden" name="id_row_edit" id="id_row_edit" />  
            <input autofocus="" name="usuario_acceso_edit" disabled required="" type="text" class="form-control" id="usuario_acceso_edit" placeholder="Usuario para entrar al sistema">
          </div>
          <div class="col-md-2 col-sm-3">Contraseña <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <input autofocus="" name="usuario_clave_edit" required="" type="password" maxlength="12" class="form-control" id="usuario_clave_edit" placeholder="Contraseña">
            <small>Ingrese una contraseña si desea cambiarla.</small>
            <!-- <small><input type="checkbox" id="usuario_clave_edit_checkbox" /> <label class="cursor" for="usuario_clave_edit_checkbox">Generación de contraseña automática</label></small> -->
          </div>
        </div>

        <div class="clearfix">&nbsp;</div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Nombre <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_nombre_edit" required="" type="text" class="form-control" id="usuario_nombre_edit" placeholder="Nombre"></div>
          <div class="col-md-2 col-sm-3">Apellido <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_apellido_edit" required="" type="text" class="form-control" id="usuario_apellido_edit" placeholder="Apellido"></div>
        </div>

        <div class="clearfix">&nbsp;</div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Perfil <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <select name="usuario_perfil_edit" id="usuario_perfil_edit">
            <?php
                if (isset($listPerfiles['resultado'])) {
                  echo '<option>seleccionar</option>';
                  foreach ($listPerfiles['resultado'] as $key => $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                  }
                }
            ?>
            </select>
          </div>
          <div class="col-md-2 col-sm-3">Estado <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <select name="usuario_estado_edit" id="usuario_estado_edit" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        
        <div class="clearfix ">&nbsp;</div>
        <hr />
        <div class="row">
          <div class="col-md-12 col-sm-12"><input type="checkbox" name="usuario_principal_edit" id="usuario_principal_edit" /> <i class="clip-user-4"></i> <label for="usuario_principal" class="cursor"> Usuario principal. <small><i>(Usuario principal de la sección, área o departamento.)</i></small></label></div>
          <div class="col-md-12 col-sm-12"><input type="checkbox" name="usuario_director_edit" id="usuario_director_edit" /> <i class="clip-user-5"></i> <label for="usuario_director" class="cursor"> Es el director.<small><i>(Es el director de establecimiento)</i></small></label></div>
          <div class="col-md-12 col-sm-12" style="display: none;"><input type="checkbox" name="enviar_email_edit" id="enviar_email_edit" /> <i class="clip-bubble-4"></i> <label for="enviar_email" class="cursor">Enviar notificación? <small>(Enviar notificación de creación de cuenta por correo.)</small></label></div>
        </div>
      </div>
    <div class="modal-footer">
    <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="agregar_usuario_edit" type="button" class="btn btn-primary" id="agregar_usuario_edit" onClick="var id_row = $('#id_row_edit').val(); updateRow(id_row)" value="Modificar datos">                  
    </div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Events -->

<!-- Add Modal -->
  <div class="modal fade" id="formulario_nuevo" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
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
           <div id="mssg-alert" class="alert"></div>
            <div class="row">
              <div class="col-md-2 col-sm-3">Usuario de acceso <span class="symbol required"> </div>
              <div class="col-md-4 col-sm-3">
                <input autofocus="" name="usuario_acceso" required="" type="email" class="form-control" id="usuario_acceso" placeholder="usuario@ejemplo.com">
                <small id="result_email_validate"></small>
              </div>
              <div class="col-md-2 col-sm-3">Contraseña <span class="symbol required"><br><small class="color-gray">Entre 8 a 16 caracteres</small></div>
              <div class="col-md-4 col-sm-3">
                <input autofocus="" name="usuario_clave" required="" type="password" maxlength="16" class="form-control" id="usuario_clave" placeholder="Contraseña entre 8 a 16 caracteres">
                <small class="color-gray"><input  type="checkbox" name="generar-clave" id="generar-clave" /> Generar Clave</small> 
              </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
              <div class="col-md-2 col-sm-3">Nombre <span class="symbol required"></div>
              <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_nombre" required="" type="text" class="form-control" id="usuario_nombre" placeholder="Nombre"></div>
              <div class="col-md-2 col-sm-3">Apellido <span class="symbol required"></div>
              <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_apellido" required="" type="text" maxlength="12" class="form-control" id="usuario_apellido" placeholder="Apellido"></div>
            </div>
            <div class="clearfix">&nbsp;</div>

            <div class="row">
            <div class="col-md-2 col-sm-3">Perfil <span class="symbol required"></div>
              <div class="col-md-4 col-sm-3">
                <select name="usuario_perfil" id="usuario_perfil">
                <?php
                    if (isset($listPerfiles['resultado'])) {
                      echo "<option></option>";
                      foreach ($listPerfiles['resultado'] as $key => $value) {
                        echo "<option value='".$value['id']."'>".$value['id'].$value['name']."</option>";
                      }
                    }
                ?>
                </select>
              </div>

              <div class="col-md-2 col-sm-3">Estado <!--<span class="symbol required">--></div> 
              <div class="col-md-4 col-sm-3">
                <select name="usuario_estado" id="usuario_estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>

            <div class="clearfix ">&nbsp;</div>
            
            
            <hr />
            <div class="row">
              <div class="col-md-12 col-sm-12"><input type="checkbox" id="usuario_principal" /> <i class="clip-user-4"></i> Usuario principal. <small><i>(Usuario principal de la sección, área o departamento.)</i></small></div>
              <div class="col-md-12 col-sm-12"><input type="checkbox" id="usuario_director" /> <i class="clip-user-5"></i> Es el director.<small><i>(Es el director de establecimiento)</i></small></div>
              <div class="col-md-12 col-sm-12"><input type="checkbox" id="enviar_email" checked /> <i class="clip-bubble-4"></i> Enviar notificación. <small><i>(Enviar notificación de creación de cuenta por correo.)</i></small></div>
            </div>
           </div>
        <div class="modal-footer">
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_usuario" type="button" class="btn btn-primary" id="agregar_usuario" value="Guardar datos">                  
        </div>
        </form>                                  
      </div>
    </div>
  </div>
<!-- End Add Modal -->

<!-- Show Permisos Modal -->
<div class="modal fade" id="user-permission" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Permisos</h3>
          <div id="mssg-label-edit-perm"></div>
      </div>
    <div class="modal-body" id="show-permisos">
        Cargando...
    </div>
    <div class="modal-footer">
      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="permisos_user" type="button" class="btn btn-primary" id="permisos_user" onClick="let id_row_perm = $('#id_row_perm').val(); editUserPermisos(id_row_perm)" value="Modificar datos">
    </div>
    </div>
  </div>
</div>
<!-- End Permisos Modal -->

<?php get_template_part('footer_scripts');?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>


$('#cargando_add').hide();
$('#usuario_area').prop('disabled',true);
$('#usuario_acceso').focus();
// Validate Email
$('#usuario_acceso').on('input', ()=>{
  let res = validate('result_email_validate', 'usuario_acceso');
  console.log(res)
});

$('#mssg-alert').hide();

// $('#agregar-emal').on('click',()=>{
// //$("[name='agregar_usuario']").on('click', ()=>{
//   $('#usuario_email').hide();
// });

$("[name='generar-clave']").on('click', ()=> {
  if ($("[name='generar-clave']").is(':checked')) {
    console.log('Genera clave')
  } else {
    console.log('Clear')
  }
});

// Add User
$("[name='agregar_usuario']").on('click', ()=>{
  let user_acceso =   $('#usuario_acceso').val();
  let estado      =   $('#usuario_estado').val();
  let clave       =   $('#usuario_clave').val();
  let nombre      =   $('#usuario_nombre').val();
  let apellido    =   $('#usuario_apellido').val();
  let perfil      =   $('#usuario_perfil').val();

  let principal   =   "";
  let director    =   "";
  let enviar_email=   "";
  if ($('#usuario_principal').is(':checked')) {
    principal   = 1;
  } else { principal   = 0; }
  if ($('#usuario_director').is(':checked')) {
    director   = 1;
  } else { director  = 0;}
  if ($('#enviar_email').is(':checked')) {
    enviar_email   = 1;
  } else { enviar_email = 0;}

  
  if ($('#result_email_validate').is(':visible')) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Debe ingresar un usuario de acceso válido');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
    return false
  }

  if (user_acceso.length < 1 ||  clave.length < 1 || nombre.length < 1 || apellido.length < 1 || perfil.length < 1) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
      return false
  }

  if (clave.length < 8) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('La Contraseña debe tener mínimo 8 caracteres.');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
      return false
  }

  if (perfil == "") {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Debe seleccionar un perfil');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
    return false
  }

  let route = "app/controllers/usuarios-listar.php"; 

    $.ajax({
      headers: {
        Accept        : "application/json; charset=utf-8",
        "Content-Type": "application/json: charset=utf-8"
      },
      url: route,
      type: "GET",
      data: {
        add             : 1,
        user_acceso     : user_acceso,
        clave           : clave,
        nombre          : nombre,
        apellido        : apellido,
        perfil          : perfil,
        //cargo           : cargo,
        principal       : principal,
        director        : director,
        enviar_email    : enviar_email,
        estado          : estado,
        nocache         : '<?php echo rand(99999,66666)?>',
      },
      dataType        : 'html',
      success         : function (response) { 
        if (response != "Ya existe este registro.") {
          $("#mssg-alert").removeClass('alert-danger').addClass('alert-success').show().html(response);
          //limpiarCampos ();
          //listUsuarios();
        } else {
          $('#mssg-alert').html('<div class="alert alert-danger">'+response+'</div>');
        }
        setTimeout(() => {
          $("#mssg-alert").hide();
          window.location.reload();
        }, 4000);
      },
      error           : function (error) {
        console.log(error);
      }
    });
});
  

// Open Edit Modal
function editRow ( id ) {
  limpiarCampos ();
  $('#agregar_usuario_edit').prop('disabled',true);
  $('#mssg-alert-edit').removeClass('alert-danger').removeClass('alert-success').addClass('alert-info').show().html('Cargando información, por favor espere...');
  let route = "app/controllers/usuarios-listar.php";

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
    nocache   : '<?php echo rand(99999,66666)?>'
  },
  dataType        : 'json',
  success         : function (response) { 

    $('#id_row_edit').val(response['id_usuario']);
    $('#usuario_acceso_edit').val(response['usuario']);
    //$('#usuario_clave_edit').val('11111111');
    $('#usuario_nombre_edit').val(response['nombre']);
    $('#usuario_apellido_edit').val(response['apellido']);
      
    $('#usuario_perfil_edit').val(response['id_perfil']).change();
    $('#usuario_estado_edit').select2('val',response['activo']);
    if (response['is_principal'] == 1) {
      $('#usuario_principal_edit').attr('checked',true)
    }
    if (response['es_director'] == 1) {
      $('#usuario_director_edit').attr('checked',true)
    }

    setTimeout(()=>{
      $('#agregar_usuario_edit').prop('disabled',false);
      $('#usuario_area_edit').val(response['id_area']).change();
      $('#mssg-alert-edit').hide().removeClass('alert-info');
    },1000);
    
  },
  error           : function (error) {
    console.log(error);
  }
});

}

// Update Row
function updateRow ( id ) {
  let user_acceso =   $('#usuario_acceso_edit').val();
  let estado      =   $('#usuario_estado_edit').val();
  let clave       =   $('#usuario_clave_edit').val();
  let nombre      =   $('#usuario_nombre_edit').val();
  let apellido    =   $('#usuario_apellido_edit').val();

  let perfil      =   $('#usuario_perfil_edit').val();
  //let cargo       =   $('#usuario_cargo').val();
  let principal   =   "";
  let director    =   "";
  let enviar_email=   "";
  if ($('#usuario_principal_edit').is(':checked')) {
    principal   = 1;
  } else { principal   = 0; }
  if ($('#usuario_director_edit').is(':checked')) {
    director   = 1;
  } else { director  = 0;}
  if ($('#enviar_email_edit').is(':checked')) {
    enviar_email   = 1;
  } else { enviar_email = 0;}

  if (user_acceso.length < 1 || nombre.length < 1 || apellido.length < 1 || perfil.length < 1) {
    $("#mssg-alert-edit").show().removeClass('alert-success').addClass('alert-danger').html('Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert-edit").hide();
    },4000);
      return false
  }

  if (clave != "" && clave.length < 8) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('La Contraseña debe tener mínimo 8 caracteres.');
    setTimeout(()=>{
      $("#mssg-alert-edit").hide();
    },4000);
      return false
  }

let route = "app/controllers/usuarios-listar.php";
$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
    edit      : 1,
    id        : id ,
    nombre    : nombre,
    apellido  : apellido,
    perfil    : perfil,
    clave     : clave,
    estado    : estado
  },
  dataType        : 'html',
  success         : function (response) { 
    if (response == 'ok') {
      $("#mssg-alert-edit").removeClass('alert-danger').addClass('alert-success').show().html('Los datos fueron actualizados con éxito. La página se actualizara en breve.');

      //limpiarCampos();
      setTimeout(()=>{
        $("#mssg-alert-edit").removeClass('alert-success').html('').hide();
        window.location.reload()
      },3000);    
      //listUsuarios();
    } else {
      console.log(response);
    }
  },
  error           : function (error) {
    console.log(error);
  }
});
}

// Edit Permisos
function editUserPermisos ( idParam ) {
  
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_cia"]?>';
  var id_         = idParam; //$('#id_row').val();

  var datas       = new Array();

  // Capturar los valores que seleccionan
  $("input:checkbox:checked").each(function() {
      datas.push($(this).val());
  });

  var editperm    = 1;
  var form_data   =   new FormData();

  form_data.append('editperm' , editperm);
  form_data.append('valores', datas);
  form_data.append('id_', id_);

$.ajax({
      url: 'app/controllers/usuarios-listar.php', // point to server-side PHP script 
      dataType: 'text', // what to expect back from the PHP script
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function (response) {
        if (response == 1) {
          $('#mssg-label-edit-perm').html('<div class="alert alert-success">Se actualizo el registro con éxito, Se actualizará la página automáticamente.</div>');
          setTimeout(()=>{
            $('#mssg-label-edit-perm').html('')
            window.location.reload();
          },3000)
        }
      },
      error: function (response) {
      }
  });
}

/**
 * Datatable
 */
$(document).ready( function () {
    $('#tabla-list-usuarios').DataTable({
      pageLength: 25,
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
          search: '',
          searchPlaceholder: "Buscar",
      },
      columnDefs: 
      [ 
        {
          targets: 5,
          orderable: false
        },{ width: "3%", targets: 0, }, { width: "15%", targets: 1 } , { width: "15%", targets: 2 } , { width: "15%", targets: 3 } , { width: "8%", targets: 4 } , { width: "10%", targets: 5 } 
      ]
    });
} );

/**
 * Show Permisos
*/ 
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
}
}

ajax1.send(null);

}

// Clean
function limpiarCampos (form = false) {
  if (form == 'add_usuario') {
    $("#usuario_acceso").val('');
    $("#usuario_clave").val('');
    $("#usuario_nombre").val('');
    $("#usuario_apellido").val('');
  }
  

  // $("#usuario_acceso_edit").val('');
  // $("#usuario_clave_edit").val('');
  // $("#usuario_nombre_edit").val('');
  // $("#usuario_apellido_edit").val('');

  // //$("#usuario_email").select2('val','');
  // $("#usuario_email").val('');//.change();

  // $("#usuario_depto").select2('val','');
  // $("#usuario_depto").val('').change();

  // $("#usuario_perfil").select2('val','');
  // $("#usuario_perfil").val('').change();

  // //$('#usuario_email_edit').select2('val','');
  // $('#usuario_email_edit').val('');//.change();
}

$("[name='usuario_estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='usuario_depto']").select2({width: '100%', dropdownCssClass: "bigdrop"});
// $("#usuario_area").select2({width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_perfil']").select2({width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='usuario_depto_edit']").select2({width: '100%', dropdownCssClass: "bigdrop"});
// $("#usuario_area_edit").select2({width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_perfil_edit']").select2({width: '100%', dropdownCssClass: "bigdrop"});

</script>

 </body>
