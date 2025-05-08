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

<!-- Message Exportar -->
<div class="alert alert-block alert-info fade in hide messg-exportar-process">
  <button data-dismiss="alert" class="close btn-cancelar-exportar" type="button"> × </button>
  <p><h4 class="alert-heading mssg-label-exportar"> Esta seguro de querer exportar todos los <?=getPageRealName()?>? </h4></p>
  <p>
    <a href="#" class="btn btn-primary btn-acept-exportar"> Aceptar </a>
    <a href="#" class="btn btn-danger btn-cancelar-exportar"> Cancelar </a>
  </p>
</div>

<div class="row view-container">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <!-- <label id="label-mssg"><?=$mssg?></label> -->
      <div class="alert result-mssg"></div>
    </div>

    <div class="container">
      <div class="col-md-7">
      <h4>
      <img src="assets/images/teacher.png" class="icon-teachers" /> Asignación de Profesores 
        <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4>
      </div>
      <div class="col-md-5 text-right">
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo">[+] Nuevo</a>
        <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
        <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a>
      </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips" title="Ver - Editar"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar registro</label> &nbsp;
        <a class="btn btn-xs btn-bricky tooltips" title="Eliminar"><i class="fa fa-times fa fa-white"></i></a><label class="color-gray">Eliminar registro</label>
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
              <table id="list-table-teachers" class="table table-striped table-bordered table-hover">
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
              <tbody id="tbody-table-teachers">
              <?php
                if ($selectTeachers['resultado']){
                  foreach ($selectTeachers['resultado'] as $datos) {
              ?>
              <tr>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['teacher_name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['subject_i']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_id']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver - Editar" data-toggle="modal" role="button" data-target="#edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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
                            echo '<option>seleccionar</option>';
                            foreach ($selectProfPerfil['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                            }
                          }
                        ?>
                    </select></td>
                 </tr>

                 <tr>
                   <td width="30%">Asignaturas / Materias <!--<span class="symbol required"></span>--></td>
                   <td width="70%">
                    <select name="event_asign_add[]" id="txt_event_asign_add" multiple>
                        <?php 
                          if ($selectAssignment['resultado']) {
                            foreach ($selectAssignment['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
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
 <table class="table table-hover" id="table-add-prof">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Profesor <span class="symbol required"></span></td>
      <td width="70%">
      <select name="edit_profesor[]" id="txt_edit_profesor">
          <?php 
            if ($selectProfPerfil['resultado']) {
              echo '<option>seleccionar</option>';
              foreach ($selectProfPerfil['resultado'] as $key => $value) {
                echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
              }
            }
          ?>
      </select></td>
    </tr>

    <tr>
      <td width="30%">Asignaturas / Materias <!--<span class="symbol required"></span>--></td>
      <td width="70%">
      <select name="event_subject_edit[]" id="txt_event_subject_edit" multiple>
          <?php 
            if ($selectSubjects['resultado']) {
              foreach ($selectSubjects['resultado'] as $key => $value) {
                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
              }
            }
          ?>
      </select>
      </td>
    </tr>
    <tr>
      <td width="30%">Clases <!--<span class="symbol required"></span>--></td>
      <td width="70%">
      <select name="event_class_edit[]" id="txt_event_class_edit" multiple>
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


<!-- Assistant -->
<div class="modal fade  come-from-modal right" id="myAssistant" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Ayuda</h4>
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

<!-- Importar -->
<div class="modal fade  come-from-modal right" id="myImporter" role="dialog" aria-labelledby="myModalImporter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalImporter"><i class="clip-download-3"></i> Importador</h4>
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

<?php get_template_part('footer_scripts');?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>
/** 
 * Open Asistant Modal 
*/
$('.open-assistant').on('click', ()=>{
  $('#myAssistant').modal('show'); 
});

/** Btn Exportar */
$('.btn-exportar').on('click', ()=>{
  if ($('.messg-exportar-process').is(':visible')) {
    $('.messg-exportar-process').removeClass('hide');
  } else {
    $('.messg-exportar-process').removeClass('hide').fadeIn('slow');
  }
});
/** 
 * Acept Exportar
 */
$('.btn-acept-exportar').on('click',()=>{
  $('.btn-acept-exportar').prop('disabled',true).css("pointer-events", "none").css("color","gray");
  $('.btn-cancelar-exportar').prop('disabled',true).css("pointer-events", "none").css("color","gray");
  $('.mssg-label-exportar').html('Estamos exportando los datos, espere por favor... <img src="assets/images/loading.gif" id="cargando_list" />');
  console.log('Procesando Exportar')
});

$('.result-mssg').hide();
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
  let asign       = $('#txt_event_asign_add').val();
  let classes     = $('#txt_event_class_add').val();
  let estado      = $('#event_estado_add').val();

  if ( nombre == 'seleccionar' || nombre == '') { // || asign == '' || classes == '') {
    $("#mssg-add").show().html('<h5>Los campos con (*) son necesarios</h5>');
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
      r2 : asign,
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
      $("#txt_event_asign_add").val('');
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
const listEvents = () => {
  let route = "app/controllers/profesores.php";
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
      $('#tbody-table-teachers').empty().append(response);
    },
    error           : function (error) {
      console.log(error);
    }
  });
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
    $('#list-table-teachers').DataTable({
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
$("#txt_event_asign_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_class_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

$("#txt_edit_profesor").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_asign_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_class_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>
