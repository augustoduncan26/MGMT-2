<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<style>
@media (min-width: 768px) {
  .dataTables_filter {
  width: 30%;
  /* text-align:justify !important; */
  /* margin-right: -20px !important; */
  }
  div.dataTables_wrapper div.dataTables_filter input {
    width: 98%;
  }
  div.dataTables_wrapper div.dataTables_filter label {
  width: 300px !important;
  }
  .modal-xl {
    width: 70%;
    max-width:1350px;
  }
}
.fade {
  overflow:hidden;
}
</style>

<body>

<div class="row view-container">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <div class="alert result-mssg"></div>
    </div>
    
    <div class="container">
      <div class="col-md-7">
        <h4><i class="clip-list-2"></i> Lista de Perfiles</h4>
      </div>
      <div class="col-md-5 text-right">
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#usuario_acceso').val('');$('#usuario_acceso').focus();">[+] Nuevo Perfil</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
        <a data-toggle="modal" class="btn btn-success"  role="button" href="#"><i class="clip-download-3"></i> Importar</a>
      </div>
  </div>
  
    <div class="row">
      <div class="col-sm-12">
      <div class=""><!-- panel panel-default -->
          <!-- <div class="panel-heading">
            <h4><i class="clip-calendar"></i> Administrar Perfiles</h4>
          </div> -->
          <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

              <div class="x_content">
			        <div class="table-responsive">
                <table id="tabla-list-perfiles" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody-table-perfiles">
                    <?php
                      if (isset($listPerfiles['resultado'])) {
                        foreach ($listPerfiles['resultado'] as $key => $value) {
                    ?>
                      <tr>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['name']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['description']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($value['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                        <td class="text-center">
                          <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $value['id']; ?>');"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiarCampos('edit_usuario');showUserPermisos('<?php echo $value['id']; ?>');"><i class="fa fa-key"></i></a>
                          <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $value['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
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

 <div class="clearfix"></div>

<!-- Add Modal -->
  <div class="modal fade" id="formulario_nuevo" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Perfil / Rol</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
            <div class="alert alert-danger" id="mssg-add-alert"><h5>Los campos con (*) son necesarios</h5></div>
             <table class="table table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="40%">Nombre <span class="symbol required">
                    <br /><small class="color-gray">Este campo es requerido.</small>
                   </td>
                   <td width="60%"><input maxlength="30" name="nombre_add" required="" type="text" class="form-control" id="nombre_add" placeholder="Nombre de perfil o rol"></td>
                 </tr>
                 <tr>
                   <td width="40%">Descripción <span class="symbol required">
                    <br /><small class="color-gray">Escriba una descripción respecto a este perfil. Este campo es requerido.</small>
                   </td>
                   <td width="60%"><input minlength="10" maxlength="50" name="descripcion_add" required="" type="text" class="form-control" id="descripcion_add" placeholder="Descripción del perfil o rol"></td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado_add" id="estado_add" class="form-control">
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
          <input name="agregar_perfil" type="button" class="btn btn-primary btn-add-role" id="agregar_perfil"  value="Guardar datos">                  
        </div>
        </form>                                  
      </div>
    </div>
  </div>
<!-- End Perfil -->

 <!-- Edit Modal -->
 <div class="modal fade" id="edit_event" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Perfil.</h3>
      </div>
      <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
        <div class="modal-body" id="contenido_editar">
        <!-- <div id="mssg-edit" style="color:red"></div> -->
        <div class="alert alert-danger" id="mssg-edit-alert"></div>      
        <table class="table table-hover" id="sample-table-4">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td width="40%">Nombre <span class="symbol required">
              <br /><small class="color-gray">Este campo es requerido.</small>
              </td>
              <td width="60%">
                <input maxlength="30" name="nombre_edit" required="" type="text" class="form-control" id="nombre_edit" placeholder="Nombre de perfil o rol">
                <input name="id_row" type="hidden" class="form-control" id="id_row">
              </td>
            </tr>
            <tr>
              <td width="40%">Descripción <span class="symbol required">
              <br /><small class="color-gray">Escriba una descripción respecto a este perfil. Este campo es requerido.</small>
              </td>
              <td width="60%"><input minlength="10" maxlength="50" name="descripcion_edit" required="" type="text" class="form-control" id="descripcion_edit" placeholder="Descripción del perfil o rol"></td>
            </tr>
            <tr>
              <td>Estado</td>
              <td>
              <select name="estado_edit" id="estado_edit" class="form-control">
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
          <input name="agregar_habitacion" type="button" class="btn btn-primary" onClick="var id_row = $('#id_row').val(); updateRow(id_row)" value="Modificar datos">
        </div>
        </form>
    </div>
  </div>
</div>
<!-- End Edit Events -->


<!-- Show Permisos Modal -->
<div class="modal fade" id="user-permission" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Permisos</h3>
          <div class="alert" id="mssg-label-edit-perm"></div>
      </div>
    <div class="modal-body" id="show-permisos">
        Cargando...
    </div>
    <div class="modal-footer">
      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="permisos_user" type="button" class="btn btn-primary btn-edit-permissions" id="permisos_user" value="Modificar datos">
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
$('#mssg-label-edit-perm').hide();
$('.result-mssg').hide();
$('#mssg-edit-alert').hide();
$('#mssg-add-alert').hide();
$('#cargando_add').hide()

/** 
 * Add
 */
$('.btn-add-role').on('click', ()=>{
  let nombre      =   $('#nombre_add').val();
  let descrip     =   $('#descripcion_add').val();
  let estado      =   $('#estado_add').val();

  if (nombre.length < 1  || descrip.length < 1) {
    $("#mssg-add-alert").show().removeClass('alert-success').addClass('alert-danger').html('<h5>Los campos con (*) son necesarios.</h5>');
    setTimeout(()=>{
      $("#mssg-add-alert").hide();
    },3000);
      return false
  }

  let route = "app/controllers/configurar-perfiles.php"; 

  $.ajax({
    // headers: {
    //   Accept        : "application/json; charset=utf-8",
    //   "Content-Type": "application/json: charset=utf-8"
    // },
    url: route,
    type: "POST",
    data: {
      add : 1,
      r1  : nombre,
      r2  : descrip,
      r3  : estado,
      nocache : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'html',
    success         : function (response) {
      switch (response) {
        case 'Ya existe este registro.':
          $("#mssg-add-alert").show().html(response);
          limpiarCampos ();
          listPerfiles();
        break;
        case 'okay':
          $('#mssg-add-alert').removeClass('alert-danger').addClass('alert-success').show().html('<h5>Se ingreso el registro con éxito</h5>');
          limpiarCampos ();
          listPerfiles();
        break;
        case 'error':
          $('#mssg-add-alert').removeClass('alert-success').addClass('alert-danger').show().html('<h5>Hubo un error al intentar ingresar el registro.</h5>');
          limpiarCampos ();
          listPerfiles();
        break;
      }
      setTimeout(() => {
        $('#mssg-add-alert').hide();
      }, 3000);
    },
    error           : function (error) {
      console.log(error);
    }
  });
});

/** 
 * List all
 */
function listPerfiles() {
  let contenido_editor = $('#list-perfiles')[0];
  let route = "app/controllers/configurar-perfiles.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      all         : 1,
      nocache     : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'json',
    success         : function (response) { 
      let arr     = response;
      let keys    = Object.keys(arr).length;
      let r       = "";
      let content = '';
      let classSetting   = '';
      arr.forEach((item,key)=>{
        if (item.activo == 0) {
          classSetting = "class='row-yellow-transp'";
          textActivo   = "Inactivo";
        } else {
          classSetting = "";
          textActivo   = "Activo";
        }
        content += '<tr>';
        content += '<td style="width:25%" '+classSetting+'>' + item.name + '</td>';
        content += '<td style="width:25%" '+classSetting+'>' + item.description + '</td>';
        content += '<td style="width:15%" '+classSetting+'>' + textActivo + '</td>';
        content += `<td style="width:15%;text-align: center;" `+classSetting+`>
        <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('`+item.id+`');"><i class="fa fa-edit"></i></a>
        <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiarCampos('edit_usuario');showUserPermisos('`+item.id+`');"><i class="fa fa-key"></i></a>
        <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('`+item.id+`'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
        </td>`;
        content += '</tr>';
      });
      $('#tbody-table-perfiles').empty().append(content);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

/** 
 * Show Edit Modal
*/
function editRow ( id ) {
let contenido_editor = $('#contenido_editar')[0];

let route = "app/controllers/configurar-perfiles.php";
$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
    showEdit:1,
    id : id
  },
  dataType        : 'json',
  success         : function (response) { 

    $('#id_row').val(response['id']);
    $('#nombre_edit').val(response['name']);
    $('#descripcion_edit').val(response['description']);
    $('#estado_edit').select2('val',response['activo']);
  },
  error           : function (error) {
    console.log(error);
  }
});

}

/**
 * Update
 * @param {*} id  
*/
function updateRow ( id ) {
var nombre      = $('#nombre_edit').val();
var descrip     = $('#descripcion_edit').val();
var estado      = $('#estado_edit').val();

if ( nombre == '' || descrip == '') {
  $("#mssg-edit-alert").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Los campos con (*) son necesarios</h5>');
  setTimeout(()=>{
    $("#mssg-edit-alert").html('').hide();
  },4000);
  return false
}

let route = "app/controllers/configurar-perfiles.php";
$.ajax({
  url: route,
  type: "POST",
  data: {
    edit  : 1,
    id : id ,
    r1 : nombre,
    r2 : descrip,
    r3 : estado
  },
  dataType        : 'html',
  success         : function (response) { 
    if (response == 'ok') {
      $("#mssg-edit-alert").removeClass('alert-danger').addClass('alert-success').show().html('<h5>Los datos fueron actualizados con éxito.</h5>');
      setTimeout(()=>{
        $("#mssg-edit-alert").html('').hide();
      },4000);
      limpiarCampos();
      listPerfiles();
    } else {
      $("#mssg-edit-alert").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Hubo un error al intentar ingresar el registro.</h5>');
      console.log(response);
    }
  },
  error           : function (error) {
    console.log(error);
  }
});
}


/**
 * Show Permisos
*/ 
function showUserPermisos ( id ) {
var contenido_editor = $('#show-permisos')[0];
let route = 'ajax/ajax_list_perfiles_permisos.php';
$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
    edit  : 1,
    id    : id ,
  },
  dataType        : 'html',
  success         : function (response) { 
    contenido_editor.innerHTML = response;
  },
  error           : function (error) {
    console.log(error);
  }
});
}

/**
 * Edit Permisos
 * @param {*} idParam  
 */
$('.btn-edit-permissions').on('click', () => {
//function editUserPermisos ( idParam ) {
  var id_         = $('#id_row_perm').val(); //idParam;
  var datas       = new Array();

  // Capturar los valores que seleccionan
  $("input:checkbox:checked").each(function() {
    datas.push($(this).val());
  });

  var editperm    = 1;
  var form_data   =  new FormData();

  form_data.append('editperm' , editperm);
  form_data.append('permisos', permisos);
  form_data.append('valores', datas);
  form_data.append('id_', id_);

$.ajax({
      url: 'app/controllers/configurar-perfiles.php',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function (response) {
        console.log(response)
        $('#mssg-label-edit-perm').show().css('color','#0f5132').addClass('alert-success').removeClass('alert-danger').html('<h5>'+response+'</h5>');
        setTimeout(()=>{$('#mssg-label-edit-perm').hide('slow')},3000)
      },
      error: function (response) {
      }
  });
//}
});


/**
 * Delete 
 * @param {*} id 
 */
function deleteRow ( id ) {
  let route = "app/controllers/configurar-perfiles.php";
  let parametros = {
    id : id,
    delete : 1
  }
  $.ajax({
    data: parametros,
    url:   route,
    type:  'post',
    dataType : 'html',
    beforeSend: function () {
      console.log("Procesando, espere por favor...");
    },
    success:  function (response) {
      if (response == 'ok') {
        $(".result-mssg").removeClass('alert-danger').removeClass('alert-info').addClass('alert-success').show().html('<h5>Los datos fueron eliminados con éxito.</h5>');
        listPerfiles();
        setTimeout(() => {
          $(".result-mssg").hide();
          window.location.reload();
        }, 3000);
      }
    },
    error: function (e) {
        console.log(e)
    }
  });
}

/**
 * Datatable
 */
$(document).ready( function () {
    $('#tabla-list-perfiles').DataTable({
      pageLength: 25,
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
          search: '',
          searchPlaceholder: "Buscar",
      },
      order: [[0, 'asc']],
      columnDefs: 
      [
        {
        targets: 3,
        orderable: false
      }, { width: "25%", targets: 0 } ,{ width: "25%", targets: 1 } , { width: "15%", targets: 2 } , { width: "15%", targets: 3 } 
      ]
    });
} );

$('.close').on('click', ()=>{
  window.location.reload();
});
$('.btn-danger').on('click', ()=>{
  window.location.reload();
});

/** 
 * Clean
 */
const limpiarCampos = () => {
  $("#nombre_add").val('');
  $("#descripcion_add").val('');
  $("#nombre_edit").val('');
  $("#descripcion_edit").val('');
}

$("[name='estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

/**
 * Tildar / Destildar checks 
 * @param {*} source  
*/
function toggle(source) {
  let checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i] != source) {
      checkboxes[i].checked = source.checked;
    }
  }
  if($('.select-all').html() == 'Tildar Todos') { $('.select-all').html('Destildar Todos')} else { $('.select-all').html('Tildar Todos')}
}

</script>

 </body>
