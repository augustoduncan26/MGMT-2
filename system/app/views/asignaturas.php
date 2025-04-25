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
      <label id="label-mssg"><?=$mssg?></label>
    </div>

    <div class="container">
      <div class="col-md-7">
        <h4>
          <i class="fa fa-indent"></i> Lista de Asignaturas / Materias <a data-toggle="modal" data-target="#myAssistant" class="btn btn-xs btn-green tooltips">
          <i class="clip-info" title="Información" ></i></a>
        </h4>
      </div>
      <div class="col-md-5 text-right">
      <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo">[+] Nuevo</a>
      <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
      <a data-toggle="modal" class="btn btn-success"  role="button" href="#"><i class="clip-download-3"></i> Importar</a>
    </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar registro</label> &nbsp;
        <a class="btn btn-xs btn-bricky tooltips"><i class="fa fa-times fa fa-white"></i></a><label class="color-gray">Eliminar registro</label>
      </div>
    </div>
    
<div class="row">
  <div class="col-sm-12">
    <div class="">
      <div class="panel-body">
        <div class="col-sm-12">
          <div style="height:10px;"></div>

        <div class="x_content">
            <div class="table-responsive">
              <table id="list-table-events" class="table table-striped table-bordered table-hover">
              <thead>
              <tr class=""><!-- header-list-table -->
              <!-- <th style="width:10px"><input type="checkbox" /></th> -->
              <th>Nombre</th>
              <th>Clase</th> 
              <th>Profesor</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-assignments">
              <?php
              if ($selectAssig['resultado']){
              foreach ($selectAssig['resultado'] as $datos) {
              ?>
              <tr>
              <!-- <td><input type="checkbox" /></td> -->
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_id']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['teacher_id']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#form_edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
              <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
              </td>
              </tr>
              <?php
              }
              }
              ?>
              <tfoot>
              <tr></tr>
              </tfoot>
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="clearfix"></div>

<!-- Modal Add -->
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Asignatura / Materia</h3>
        </div>
         <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table  table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <div class="alert alert-danger mssg-add-modal">Todos los campos son necesarios</div>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre_add" type="text" class="form-control" id="nombre_add" placeholder="Nombre"></td>
                 </tr>

                 <tr>
                   <td width="30%">Clase <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="class_add" id="class_add">
                    <option></option>
                        <?php 
                          if ($selectClases['resultado']) {
                            foreach ($selectClases['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Asignar profesor: <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="teacher_add" id="teacher_add" multiple>
                    <option></option>
                        <?php 
                          if ($selectTeachers['resultado']) {
                            foreach ($selectTeachers['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                            }
                          }
                        ?>
                    </select>
                   </td>
                 </tr>
                 
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado_add"  class="form-control" id="estado_add">
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
          <input name="agregar_habitacion" type="button" class="btn btn-primary add-event" id="agregar_evento" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- En Add -->


<!-- Edit -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="form_edit_event" tabindex="-1" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Evento</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 <div id="mssg-add-assignaments" style="color:red;"></div>
    <!-- <img src="images/ajax-loader.gif" id="cargando_add" /> -->
    <table class="table  table-hover" id="sample-table-4">
    <thead>
    </thead>
    <tbody>
    <div class="alert alert-danger mssg-add-modal">Todos los campos son necesarios</div>
      <tr>
        <td width="30%">Nombre <span class="symbol required"></span></td>
        <td width="70%"><input maxlength="50" autofocus="" name="nombre_edit" type="text" class="form-control" id="nombre_edit" placeholder="Nombre">
        <input maxlength="50" autofocus="" name="id_row" type="hidden" class="form-control" id="id_row">
      </td>
      </tr>

      <tr>
        <td width="30%">Clase <span class="symbol required"></span></td>
        <td width="70%">
        <select name="class_edit" id="class_edit">
        <option></option>
            <?php 
              if ($selectClases['resultado']) {
                foreach ($selectClases['resultado'] as $key => $value) {
                  echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                }
              }
            ?>
        </select>
        </td>
      </tr>

      <tr>
        <td width="30%">Asignar profesor: <span class="symbol required"></span></td>
        <td width="70%">
        <select name="teacher_edit" id="teacher_edit" multiple>
        <option></option>
            <?php 
              if ($selectTeachers['resultado']) {
                foreach ($selectTeachers['resultado'] as $key => $value) {
                  echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                }
              }
            ?>
        </select>
        </td>
      </tr>
      
      <tr>
        <td>Estado</td>
        <td>
        <select name="estado_edit"  class="form-control" id="estado_edit">
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
      <input name="agregar_habitacion" type="button" class="btn btn-primary btn-edit-asignatura" id="edit_evento"  value="Modificar datos">
</div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Events -->

<!-- Help Side Bar Modal -->
<!-- 
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button> 
-->

<!-- Assistant Modal -->
<div class="modal fade  come-from-modal right" id="myAssistant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" id="myModalLabel">Ayuda</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<!-- //Assistant Modal -->
<!-- container -->

<?php get_template_part('footer_scripts');?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>
setTimeout(() => {
  $('.mssg-add-modal').hide();
}, 3000);

// var today = new Date().toISOString().slice(0, 10);
// document.getElementsByName("event_add_date")[0].min = today;

// Hacer toggle el: Left Menu
var runNavigationToggler = function () {
    $('.navigation-toggler').bind('click', function () {
        if (!$('body').hasClass('navigation-small')) {
            $('body').addClass('navigation-small');
        } else {
            $('body').removeClass('navigation-small');
        };
    });
};
runNavigationToggler();

/** 
 * List All
 */
function listAll() {
let route = "app/controllers/asignaturas.php";
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
  dataType        : 'html',
  success         : function (response) { 
    $('#tbody-table-assignments').empty().append(response);
  },
  error           : function (error) {
    console.log(error);
  }
});
}

/**
 * Add
 */
$('.add-event').on('click', ()=>{
  let nombre      = $('#nombre_add').val();
  let clase       = $('#class_add').val();
  let teacher     = $('#teacher_add').val();
  let estado      = $('#estado_add').val();
  let form_data   = new FormData();

  if ( nombre == '' || clase == '' || teacher == '' || estado == '' ) {
    $(".mssg-add-modal").html('Los campos con (*) son necesarios');
    setTimeout(() => {
      $('.mssg-add-modal').hide();
    }, 3000);
    return false
  }

  form_data.append('add' , 1);
  form_data.append('r1' , nombre);
  form_data.append('r2', clase);
  form_data.append('r3', teacher);
  form_data.append('r4', estado);

  let route = "app/controllers/asignaturas.php"; 
  console.log(nombre,clase,teacher,estado)

  $.ajax({
    url: route,
    dataType : 'text',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success         : function (response) { 
      $(".mssg-add-modal").removeClass('alert-danger').addClass('alert-success').show().html(response);
      setTimeout(() => {
        $(".mssg-add-modal").hide();
      }, 3000);
      $("#nombre_add").val('');
      $('#class_add').val();
      $('#teacher_add').val();
      $("#precio").val('');
      $("#nombre_add").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
});

/** 
 * Open Edit Modal
 */
function editRow ( id ) {
let contenido_editor = $('#contenido_editar')[0];
$('.mssg-edit-clases').hide();
  let route = "app/controllers/asignaturas.php";
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
      dml       : 'edit'
    },
    dataType        : 'json',
    success         : function (response) {
      $('#id_row').val(response['id']);
      $('#nombre_edit').val(response['name']);
      $('#class_edit').select2('val',response['class_id']);
      $('#teacher_edit').select2('val',response['teacher_id']);
      $('#estado_edit').select2('val',response['activo']);
      // $('#teacher_edit').val(response['capacity']);
      // $('#class_edit').val(response['grade']);
      // $('#event_edit_supervisor').select2('val',response['supervisor_id']);
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
$('.btn-edit-class').on('click', ()=>{ 
//function updateEvent ( id ) {
  let nombre        = $('#nombre_edit').val();
  let cantidad      = $('#event_edit_capacity').val();
  let grado         = $('#event_edit_grade').val();
  let superv        = $('#event_edit_supervisor').val();
  let estado        = $('#event_estado_edit').val();
  let id            = $('#id_row').val();

  let route = "app/controllers/clases.php"; 

var parametros = {
  edit : 1, nombre : nombre, id : id, superv:superv, cantidad: cantidad, grado: grado, estado:estado,
};

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
        
        jQuery('html, body').animate({scrollTop: '0px'}, 'slow');

        $(".mssg-edit-clases").removeClass('alert-danger').addClass('alert-success').show().html('<h5>Los datos fueron actualizados con éxito.</h5>');
        listClasses();
        setTimeout(() => {
          $(".mssg-edit-clases").hide();
          //window.location.reload();
        }, 4000);
      }
    }
  });
});

// Edit Event
// function editRow ( id ) {
//   var id_user     = '<?php echo $_SESSION["id_user"]?>';
//   var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
//   var contenido_editor = $('#contenido_editar')[0];

//   ajax2   = nuevoAjax();
//   ajax2.open("GET", "ajax/ajax_editar_evento.php?id="+id+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
//   ajax2.onreadystatechange=function() {

//     if (ajax2.readyState==4) {
//       contenido_editor.innerHTML = ajax2.responseText;
//       listEvents();
//     }
//   }

//   ajax2.send(null);
// }

// Update Event
// function updateEvent ( id ) {
//   var id_user     = '<?php echo $_SESSION["id_user"]?>';
//   var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
//   var nombre      = $('#txt_nombre').val();
//   var precio      = $('#txt_precio').val();
//   var estado      = $('#txt_estado').val();
//   ajax3   = nuevoAjax();
//   ajax3.open("GET", "app/controllers/eventos.php?edit=1&id="+id+"&precio="+precio+"&nombre="+nombre+"&activo="+estado+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
//   ajax3.onreadystatechange=function() {

//     if (ajax3.readyState==4) {
//       //contenido_editor.innerHTML = ajax2.responseText;
//       $("#mssg-edit-eventos").html('<uppercase>Los datos fueron actualizados con éxito</uppercase>');
//       listEvents();
//     }
//   }
//   ajax3.send(null);
// }

// Delete Event
function deleteRow ( id ) {
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/eventos.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {
    if (ajax2.readyState==4) {
      $('html, body').animate({scrollTop: '0px'},'slow');
      $('#label-mssg').html(ajax2.responseText);
      listEvents();
      if ($('.alert-danger').is(':visible')) {
        setTimeout(() => {
          $('.alert-danger').html('');
          $('.alert-danger').hide();
        }, 4000);
      }
    }
  }
  ajax2.send(null);
}

// List Events
function listEvents() {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  $('#cargando_list').show()
  var contenido_editor = $('#list-events')[0];
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_events.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide();
      //loadDataTable();
    }
  }

  ajax1.send(null);
}

// Clean
function limpiar () {
  $("#nombre").val('');
  $("#precio").val('');
  $("#txt_nombre").val('');
  $("#txt_precio").val('');
  $('#mssg-edit-eventos').html('');
}

// Make some default options
$("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
$("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});



$(document).ready( function () {
    $('#list-table-events').DataTable({
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
      targets: 4,
      orderable: false
      },{ width: "20%", targets: 0 },{ width: "20%", targets: 1, },{ width: "20%", targets: 2, } ,{ width: "10%", targets: 3 },{ width: "10%", targets: 4 }
    ]
    });
} );


$("[name='class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='teacher_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='class_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='teacher_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>
