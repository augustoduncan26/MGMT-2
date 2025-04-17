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
  /* .modal-xl {
    width: 70%;
   max-width:1350px;
  } */
  .fade {
    overflow:hidden;
  }
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
      <h4><i class="clip-user-5"></i> Asignación de Profesores</h4>
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
    <div class=""><!-- panel panel-default -->
      <!-- <div class="panel-heading">
        <h4><i class="clip-calendar"></i> Administrar Eventos</h4>
      </div> -->
      <div class="panel-body">
        <div class="col-sm-12">
          <div style="height:10px;"></div>

        <div class="x_content">
        <!-- <img src="images/ajax-loader.gif" id="cargando_list" /> -->
        <!-- <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i> -->
            <div class="table-responsive">
              <table id="list-table-events" class="table table-striped table-bordered table-hover">
              <thead>
              <tr class=""><!-- header-list-table -->
              <!-- <th style="width:10px"><input type="checkbox" /></th> -->
              <th>Nombre</th>
              <th>Asignaturas</th> 
              <th>Clases / Salones</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody>
              <?php
              if ($selectTeachers['resultado']){
              foreach ($selectTeachers['resultado'] as $datos) {
              ?>
              <tr>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['subject_i']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_id']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" data-target="#edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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
<div class="modal fade" id="formulario_nuevo"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Asignación de Profesor</h3>
        </div>
         <form name="form_profesores" id="form_profesores" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div class="alert alert-danger" id="mssg-add"></div>
             <table class="table table-hover" id="table-add-prof">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Profesor <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="add_profesor[]" id="txt_add_profesor">
                        <?php 
                          if ($selectProfPerfil['resultado']) {
                            echo '<option></option>';
                            foreach ($selectProfPerfil['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                            }
                          }
                        ?>
                    </select></td>
                 </tr>

                 <tr>
                   <td width="30%">Asignaturas <!--<span class="symbol required"></span>--></td>
                   <td width="70%">
                    <select name="event_subject_add[]" id="txt_event_subject_add" multiple>
                        <?php 
                          if ($selectSubjects['resultado']) {
                            foreach ($selectSubjects['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                   </td>
                 </tr>
                 <tr>
                   <td width="30%">Clases <!--<span class="symbol required"></span>--></td>
                   <td width="70%">
                    <select name="event_class_add[]" id="txt_event_class_add" multiple>
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
                   <td>Estado</td>
                   <td>
                    <select name="event_estado_add"  class="form-control" id="event_estado_add">
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
          <input name="agregar_habitacion" type="button" class="btn btn-primary btn-add-prof" id="agregar_evento" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- En Add Event -->


<!-- Edit Events -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" tabindex="-1" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Profesor</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 <div class="alert alert-danger" id="mssg-edit"></div>
<table class="table table-hover" id="table-edit-prof">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Nombre <span class="symbol required"></span></td>
      <td width="70%"><input maxlength="50" autofocus="" name="add_nombre" type="text" class="form-control" id="add_nombre" placeholder="Nombre"></td>
    </tr>

    <tr>
      <td width="30%">Asignaturas <!--<span class="symbol required"></span>--></td>
      <td width="70%">
      <select name="event_subject_add[]" id="txt_event_subject_add" multiple>
          <?php 
            if ($selectSubjects['resultado']) {
              foreach ($selectSubjects['resultado'] as $key => $value) {
                echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
              }
            }
          ?>
      </select>
      </td>
    </tr>
    <tr>
      <td width="30%">Clases <!--<span class="symbol required"></span>--></td>
      <td width="70%">
      <select name="event_class_add[]" id="txt_event_class_add" multiple>
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
      <td width="30%">Email <span class="symbol required"></span></td>
      <td width="70%"><input name="add_email" type="email" class="form-control" id="add_email" placeholder="Email"></td>
    </tr>

    <tr>
      <td width="30%">Teléfono <!--<span class="symbol required"></span>--></td>
      <td width="70%"><input maxlength="50" name="add_telephone" type="text" class="form-control" id="add_telephone" placeholder="Telefono"></td>
    </tr>

    <tr>
      <td>Estado</td>
      <td>
      <select name="event_estado_edit"  class="form-control" id="event_estado_edit">
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
      <input name="agregar_habitacion" type="button" class="btn btn-primary" id="agregar_evento" onClick="var id_row = $('#id_row').val(); updateEvent(id_row)" value="Modificar datos">
</div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Events -->

<?php get_template_part('footer_scripts');?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

$('#mssg-add').hide();
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

/**
 * Add
 */
$('.btn-add-prof').on('click', ()=>{ 

  let nombre      = $('#txt_add_profesor').val();
  let subject     = $('#txt_event_subject_add').val();
  let classes     = $('#txt_event_class_add').val();
  let estado      = $('#event_estado_add').val();

  if ( nombre == '' || subject == '' || classes == '') {
    $("#mssg-add").show().html('<h5>Los campos con (*) son necesarios</h5>');
    $('#nombre').focus();
    setTimeout(() => {
      $("#mssg-add").hide()
      }, 3000);
    return false
  }

  let route = "app/controllers/profesores.php";

  $.ajax({
    url: route,
    type: "POST",
    data: {
      add : 1,
      r1 : nombre,
      r2 : subject,
      r3 : classes,
      r4 : estado,
    },
    dataType        : 'html',
    beforeSend: function () {
      console.log("Procesando, espere por favor...");
    },
    success         : function (response) { 
      if (response == 'ok') {
        $("#mssg-add").removeClass('alert-danger').addClass('alert-success').css('color','#3c763d').show().html('<h5>Se ingreso el registro con éxito.</h5>');
      } if (response == 'error') {
        $("#mssg-add").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Ya existe un registro con este mismo nombre.<h5>');
      }

      //listEvents();
      setTimeout(() => {
        $("#mssg-add").hide();
      }, 4000);
  
      $("#add_nombre").val('');
      $("#add_email").val('');
      $("#add_telephone").val('');
      $("#txt_event_subject_add").val('');
      $("#txt_event_class_add").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
});

// Edit Event
function editRow ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var contenido_editor = $('#contenido_editar')[0];

  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_editar_evento.php?id="+id+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
      listEvents();
    }
  }

  ajax2.send(null);
}

// Update Event
function updateEvent ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var nombre      = $('#txt_nombre').val();
  var precio      = $('#txt_precio').val();
  var estado      = $('#txt_estado').val();
  ajax3   = nuevoAjax();
  ajax3.open("GET", "app/controllers/eventos.php?edit=1&id="+id+"&precio="+precio+"&nombre="+nombre+"&activo="+estado+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax3.onreadystatechange=function() {

    if (ajax3.readyState==4) {
      //contenido_editor.innerHTML = ajax2.responseText;
      $("#mssg-edit-eventos").html('<uppercase>Los datos fueron actualizados con éxito</uppercase>');
      listEvents();
    }
  }
  ajax3.send(null);
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
      },{ width: "20%", targets: 0 },{ width: "20%", targets: 1, },{ width: "20%", targets: 2, } ,{ width: "10%", targets: 3 },{ width: "8%", targets: 4 }
    ]
    });
} );

$("#txt_add_profesor").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_subject_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_class_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
