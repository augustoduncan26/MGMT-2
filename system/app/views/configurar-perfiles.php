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
                      <!-- <th>Id</th> -->
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
    </div>
  </div>
</div>

 <div class="clearfix"></div>

 <!-- Edit Row -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Perfil.</h3>
</div>

<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 
 <div id="mssg-edit" style="color:red"></div>
                    
 <table class="table table-bordered" id="sample-table-4">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Nombre: <span class="symbol required"></span></td>
      <td width="70%"><input autofocus="" name="nombre" type="text" class="form-control" id="nombre_edit" placeholder="Nombre" value="">
      <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="" value="">
      </td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td>
       <select name="estado" id="estado_edit" class="">
         <option value="1" <?php if($data['activo'] == 1) { echo 'selected'; } ?>>Activo</option>
         <option value="0" <?php if($data['activo'] == 0) { echo 'selected'; } ?>>Inactivo</option>
       </select>
      </td>
    </tr>
  </tbody>
<tfoot>
  <tr><td colspan="2">
   
</td></tr>
</tfoot>
</table>

</div>
 <div class="modal-footer">
      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="agregar_habitacion" type="button" class="btn btn-primary" onClick="var id_row = $('#id_row').val(); updateRow(id_row)" value="Modificar datos">
</div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Events -->


<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Add Modal -->
  <div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Perfil</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
            <div id="mssg-alert" style="color:red;"></div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></td>
                   <td width="70%"><input autofocus="" name="nombre_perfil" required="" type="text" class="form-control" id="nombre_perfil" placeholder="Nombre de perfil"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_perfil" type="button" class="btn btn-primary" id="agregar_perfil" onClick="addPerfil()" value="Guardar datos">                  
        </div>
        </form>                                  
      </div>
    </div>
  </div>
<!-- End Perfil -->

<!-- Show Permisos Modal -->
<div class="modal fade" id="user-permission" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
      <input name="permisos_user" type="button" class="btn btn-primary btn-edit-permissions" id="permisos_user"  value="Modificar datos">
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

$('.result-mssg').hide();
$('#mssg-edt-alert').hide();
$('#mssg-add-alert').hide();
$('#cargando_add').hide()

// Add
function addPerfil () {

  let nombre      =   $('#nombre_perfil').val();
  let estado      =   $('#estado').val();
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';

  if (nombre.length < 1 ) {
    $("#mssg-alert").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },3000);
      return false
  }

  let route = "app/controllers/configurar-perfiles.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      add         : 1,
      id_user     : id_user,
      id_cia      : id_cia,
      nombre      : nombre,
      estado      : estado,
      nocache     : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'html',
    success         : function (response) { 
      if (response != "Ya existe este registro.") {
        $("#mssg-alert").show().html(response);
        limpiarCampos ();
        listPerfiles();
      } else {
        $('#mssg-alert').show().html('<div class="alert alert-danger">'+response+'</div>');
      }
      setTimeout(() => {
        $(".alert-exito").hide();
        $(".alert-danger").hide();
      }, 3000);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// List all
function listPerfiles() {   
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
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
      id_user     : id_user,
      id_cia      : id_cia,
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
          //class="text-center" style="width:10% !important;"
          textActivo   = "Inactivo";
        } else {
          classSetting = "";
          textActivo   = "Activo";
        }
        content += '<tr>';
        //content += '<td style="width:3%" '+classSetting+'>' + item.id + '</td>';
        content += '<td style="width:30%" '+classSetting+'>' + item.name + '</td>';
        content += '<td style="width:10%" '+classSetting+'>' + item.created_at + '</td>';
        content += '<td style="width:10%" '+classSetting+'>' + textActivo + '</td>';
        content += `<td style="width:8%;text-align: center;" `+classSetting+`>
        <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('`+item.id+`');"><i class="fa fa-edit"></i></a>
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

// Show Edit Modal
function editRow ( id ) {
let id_user     = '<?php echo $_SESSION["id_user"]?>';
let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
let contenido_editor = $('#contenido_editar')[0];

let route = "app/controllers/configurar-perfiles.php?showEdit=1&id="+id+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: "",
  dataType        : 'json',
  success         : function (response) { 

    $('#id_row').val(response['id']);
    $('#nombre_edit').val(response['name']);
    $('#estado_edit').select2('val',response['o']);
    //$('#estado_edit').val(response['activo']);
  },
  error           : function (error) {
    console.log(error);
  }
});

}

// Update Row
function updateRow ( id ) {

var id_user     = '<?php echo $_SESSION["id_user"]?>';
var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
var nombre      = $('#nombre_edit').val();
var estado      = $('#estado_edit').val();

if ( nombre == '') {
  $("#mssg-edit").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios</div>');
  setTimeout(()=>{
    $("#mssg-edit").html('').hide();
  },4000);
  return false
}

let route = "app/controllers/configurar-perfiles.php";
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
    nombre : nombre,
    estado  : estado
  },
  dataType        : 'html',
  success         : function (response) { 
    if (response == 'ok') {
      $("#mssg-edit").show().html('<div class="alert alert-success">Los datos fueron actualizados con éxito.</div>');
      setTimeout(()=>{
        $("#mssg-edit").html('').hide();
      },4000);
      limpiarCampos();
      listPerfiles();
    } else {
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

// Clean
function limpiarCampos () {
  $("#nombre_perfil").val('');
}

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

$("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>

 </body>
