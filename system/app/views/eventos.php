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
        <h4>
        <i class="clip-calendar"></i> Lista de Eventos 
        <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4> 
      </div>
      <div class="col-md-5 text-right">
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo</a>
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
      <!-- panel panel-default -->
      <!-- <div class="panel-heading">
        <h4><i class="clip-calendar"></i> Administrar Eventos</h4>
      </div> -->
      <div class="panel-body">
        <div class="col-sm-12">
          <div style="height:10px;"></div>

        <div class="x_content">
        <!-- <img src="images/ajax-loader.gif" id="cargando_list" /> -->
            <div class="table-responsive">
              <table id="list-table-events" class="table table-striped table-bordered table-hover">
              <thead>
              <tr class=""><!-- header-list-table -->
              <!-- <th style="width:10px"><input type="checkbox" /></th> -->
              <th>Nombre</th>
              <th>Clase</th> 
              <th>Fecha Inicio</th>
              <th>Hora Inicio</th> 
              <th>Fecha Fin</th>
              <th>Hora Fin</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-eventes">
              <?php
                if ($selectEventos['resultado']){
                  foreach ($selectEventos['resultado'] as $datos) {
                    $sel2 = $ObjMante->BuscarLoQueSea('class_name',PREFIX.'class','id='.$datos['class_id'],'extract');
              ?>
                  <tr>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo isset($sel2['class_name']) ? $sel2['class_name'] : '- - - - -';?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_start']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_start']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_end']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_end']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                  <td class="text-center" style="width:10% !important;">
                  <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" title="Editar este registro" data-toggle="modal" data-target="#form_edit_event" role="button" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" title="Eliminar este registro" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
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
<div class="modal fade" id="formulario_nuevo"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Evento</h3>
        </div>
         <form name="add_eventos" id="add_eventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <!-- <div id="mssg-add-eventos" style="color:red;"></div> -->
             <!-- <img src="images/ajax-loader.gif" id="cargando_add" /> -->
             <div class="alert alert-danger" id="mssg-add-eventos"><h5>Todos los campos son necesarios</h5></div>
             <table class="table table-hover" id="table-eventos">
               <thead>
               </thead>
               <tbody>
                 <tr>
                    <td width="15%">Nombre <span class="symbol required"></span>
                    <br />
                    <small class="color-gray">Introduzca un nombre descriptivo para el evento. </small>
                    </td>
                    <td width="35%"><input maxlength="40" name="nombre_add" type="text" class="form-control" id="nombre_add" placeholder="Nombre"></td>
                    <td width="15%">Detalle <br />
                    <small class="color-gray">Introduzca un detalle sobre el evento. </small>
                    </td>
                    <td width="35%"><input maxlength="100" name="descripcion_add" type="text" class="form-control" id="descripcion_add" placeholder="Descripción"></td>
                  </tr>
                  <tr>
                   <td width="15%">Fecha Inicio <span class="symbol required"></span>
                    <br />
                    <small class="color-gray">Formato: [mes/dia/año] </small>
                    </td> 
                    <td width="35%"><input autofocus="" name="event_add_date_ini" onchange="" type="date" class="form-control" id="event_add_date_ini" placeholder="Fecha"></td>
                    <td width="15%">Hora Inicio <!--<span class="symbol required"></span>-->
                    <br />
                    <small class="color-gray">Este campo no es obligatorio. </small>
                  </td>
                    <td width="35%"><input autofocus="" name="event_add_hora_ini"  type="time" class="form-control" id="event_add_hora_ini" placeholder="Hora de Inicio" ></td>
                  </tr>

                 <tr>
                   <td width="15%">Fecha Fin <span class="symbol required"></span>
                   <br />
                   <small class="color-gray">Formato: [mes/dia/año] </small>
                  </td> 
                   <td width="35%"><input autofocus="" name="event_add_date_fin" onchange="" type="date" class="form-control" id="event_add_date_fin" placeholder="Fecha"></td>
                   <td width="15%">Hora Fin <!--<span class="symbol required"></span>-->
                   <br />
                   <small class="color-gray">Este campo no es obligatorio. </small>
                  </td>
                   <td width="35%"><input autofocus="" name="event_add_hora_fin" type="time" class="form-control" id="event_add_hora_fin" placeholder="Hora Final"></td>
                </tr>

                 <tr>
                 <td width="15%">Clase <!--<span class="symbol required"></span>-->
                  <br />
                  <small class="color-gray">Seleccione una clase si desea mostrarles este evento. </small>
                  </td>
                   <td width="35%">
                    <select name="event_class_add" id="event_class_add">
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
                   <td width="15%">Perfil <!--<span class="symbol required"></span>-->
                  <br />
                  <small class="color-gray">Seleccione uno o varios perfiles, si desea que puedan ver este evento. </small>
                  </td>
                 <td width="35%">
                    <select name="event_perfil_add[]" id="text_event_perfil_add" multiple>
                        <option></option>
                        <?php 
                          if ($selectPerfiles['resultado']) {
                            foreach ($selectPerfiles['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
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
                      <option value="0" selected>Inactivo</option>
                    </select>
                   </td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                 </tr>

               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_evento" type="button" class="btn btn-primary" id="agregar_evento" onClick="addEvent()" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- En Add Event -->


<!-- Edit Modal -->
<div class="modal fade" id="form_edit_event" role="dialog">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Evento</h3>
</div>
<form name="add_eventos" id="add_eventos" method="post" action="#SELF" enctype="multipart/form-data">
      <div class="modal-body">
        <!-- <div id="mssg-add-eventos" style="color:red;"></div> -->
        <table class="table table-hover" id="table-eventos-edit">
          <thead>
          </thead>
          <tbody>
          <div class="alert alert-danger" id="mssg-edit-eventos"><h5>Todos los campos son necesarios</h5></div>
            <tr>
              <td width="15%">Nombre <span class="symbol required"></span>
              <br />
                    <small class="color-gray">Introduzca un nombre descriptivo para el evento. </small>
            </td>
              <td width="35%"><input maxlength="40" name="nombre_edit" type="text" class="form-control" id="nombre_edit" placeholder="Nombre">
              <input name="id_row" type="hidden" class="form-control" id="id_row" placeholder="Nombre"></td>
              <td width="15%">Descripción <br />
              <small class="color-gray">Introduzca un detalle sobre el evento. </small>
              </td>
              <td width="35%"><input maxlength="100" name="descripcion_edit" type="text" class="form-control" id="descripcion_edit" placeholder="Descripción"></td>
            </tr>
            <tr>
              <td width="15%">Fecha Inicio <span class="symbol required"></span>
              <br />
              <small class="color-gray">Formato: [mes/dia/año] </small>
              </td> 
              <td width="35%"><input autofocus="" name="event_edit_date_ini" onchange="" type="date" class="form-control" id="event_edit_date_ini" placeholder="Fecha"></td>
              <td width="15%">Hora Inicio <!--<span class="symbol required"></span>--></td>
              <td width="35%"><input autofocus="" name="event_edit_hora_ini"  type="time" class="form-control" id="event_edit_hora_ini" placeholder="Hora de Inicio" ></td>
            </tr>

            <tr>
              <td width="15%">Fecha Fin <span class="symbol required"></span>
              <br />
              <small class="color-gray">Formato: [mes/dia/año] </small>
            </td> 
              <td width="35%"><input autofocus="" name="event_edit_date_fin" onchange="" type="date" class="form-control" id="event_edit_date_fin" placeholder="Fecha"></td>
              <td width="15%">Hora Fin <!--<span class="symbol required"></span>--></td>
              <td width="35%"><input autofocus="" name="event_edit_hora_fin" type="time" class="form-control" id="event_edit_hora_fin" placeholder="Hora Final"></td>
          </tr>

            <tr>
            <td width="15%">Clase <!--<span class="symbol required"></span>-->
            <br />
            <small class="color-gray">Seleccione una clase si desea mostrarles este evento. </small>
          </td>
              <td width="35%">
              <select name="event_class_edit" id="event_class_edit" class="">
                <option value="">seleccionar</option>
                  <?php 
                    if ($selectClases['resultado']) {
                      foreach ($selectClases['resultado'] as $key => $value) {
                        echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                      }
                    }
                  ?>
              </select>
              </td>
              <td width="15%">Perfil <!--<span class="symbol required"></span>-->
                  <br />
                  <small class="color-gray">Seleccione uno o varios perfiles, si desea que puedan ver este evento. </small>
                  </td>
                 <td width="35%">
                    <select name="event_perfil_edit[]" id="text_event_perfil_edit" multiple>
                        <option></option>
                        <?php 
                          if ($selectPerfiles['resultado']) {
                            foreach ($selectPerfiles['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
  <div class="modal-footer">
    <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
    <input name="edit_evento" type="button" class="btn btn-primary btn-edit-evento" id="edit_evento" value="Modificar datos">
    
  </div>
</form>
</div>
</div>
</div>
<!-- End Edit Events -->


<div class="modal fade  come-from-modal right" id="myAssistant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel">Ayuda</h4>
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

$('.result-mssg').hide();
$('#mssg-add-eventos').hide();
$('#mssg-edit-eventos').hide();

var today = new Date().toISOString().slice(0, 10);
document.getElementsByName("event_add_date_ini")[0].min = today;

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
 * Add
 */
function addEvent () {
  var nombre      = $('#nombre_add').val();
  var clase       = $('#event_class_add').val();
  var dateI       = $('#event_add_date_ini').val();
  var horaI       = $('#event_add_hora_ini').val();
  var dateF       = $('#event_add_date_fin').val();
  var horaF       = $('#event_add_hora_fin').val();
  var estado      = $('#event_estado_add').val();
  let descrip     = $('#descripcion_add').val();
  let perfil      = $('#text_event_perfil_add').val();

  if ( nombre == '' || dateI == '' || dateF == '') {
    $("#mssg-add-eventos").show().html('<h5>Los campos con (*) son necesarios</h5>');
    $('#nombre').focus();
    setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 3000);
    return false
  }

  if (evaluarFechas(dateI, dateF) == false) {
    $("#mssg-add-eventos").show().html('<h5>La fecha final debe ser mayor o igual a la fecha de inicio</h5>');
    $('#nombre').focus();
    setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 4000);
    return false
  }

  let route = "app/controllers/eventos.php";
  $.ajax({
    url: route,
    type: "post",
    data: {
      add : 1,
      r1 : nombre,
      r2 : clase,
      r3 : dateI,
      r4 : horaI,
      r5 : dateF,
      r6 : horaF,
      r7 : estado,
      r8 : descrip,
      r9:perfil,
    },
    dataType : 'html',
    beforeSend: function () {
      console.log("Procesando, espere por favor...");
    },
    success         : function (response) { 
      if (response == 'ok') {
        $("#mssg-add-eventos").removeClass('alert-danger').addClass('alert-success').css('color','#3c763d').show().html('<h5>Se ingreso el registro con éxito.</h5>');
      } if (response == 'error') {
        $("#mssg-add-eventos").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Ya existe un registro con este mismo nombre.<h5>');
      }

      listEvents();
      setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 4000);
  
      $("#nombre_add").val('');
      $("#descripcion_add").val('');
      $("#event_class_add").val('');
      $("#nombre_add").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

/**
 * Open Edit Modal
 * @param {*} id  
 */
function editRow ( id ) {
  let contenido_editor = $('#contenido_editar')[0];
  
  $("#mssg-edit-eventos").removeClass('alert-success').removeClass('alert-danger').addClass('alert-info').show().html('<h5>Cargando información. &nbsp; <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i></h5>');
  $("#table-eventos-edit *").prop('disabled',true);
  let route = "app/controllers/eventos.php";
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

      $("#text_event_perfil_edit").trigger('change');
      $('#id_row').val(response['id']);
      $('#nombre_edit').val(response['name']);
      $('#descripcion_edit').val(response['description']);
      $('#event_edit_date_ini').val(response['date_start']);
      $('#event_edit_hora_ini').val(response['time_start']);
      $('#event_edit_date_fin').val(response['date_end']);
      $('#event_edit_hora_fin').val(response['time_end']);
      $('#event_estado_edit').select2('val',response['activo']);
      $('#event_class_edit').select2('val',response['class_id']);

      
      if (response['perfil_id']!= null && response['perfil_id']!='' && response['perfil_id']!='NULL') {
        let arr   = response['perfil_id'].split (",");
        let keys  = Object.keys(arr).length;
        let r  = "";
        arr.forEach((item,key)=>{
          if (item) {
            r =  arr + ',';
            $('#text_event_perfil_edit').val(arr).change();
          }
        });
      }
      
      setTimeout(() => {
        $("#table-eventos-edit *").prop('disabled',false);
        $("#mssg-edit-eventos").hide();
        $("#table-eventos-edit").css('pointer-event','all');
      }, 1000);
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
$('.btn-edit-evento').on('click', ()=>{ 
  let nombre        = $('#nombre_edit').val();
  let descrip       = $('#descripcion_edit').val();
  let dateI         = $('#event_edit_date_ini').val();
  let horaI         = $('#event_edit_hora_ini').val();
  let dateF         = $('#event_edit_date_fin').val();
  let horaF         = $('#event_edit_hora_fin').val();
  let clase         = $('#event_class_edit').val();
  let estado        = $('#event_estado_edit').val();
  let id            = $('#id_row').val();
  let perfil        = $('#text_event_perfil_edit').val();

  // console.log(perfil);
  //  return false

  if (nombre == "" || dateI == "" || dateF == "") {
    $("#mssg-edit-eventos").removeClass('alert-success').removeClass('alert-info').addClass('alert-danger').show().html('<h5>Los campos con (*) son necesarios.</h5>');
    setTimeout(() => {
      $("#mssg-edit-eventos").hide();
    }, 4000);
  }
  let route = "app/controllers/eventos.php"; 

  var parametros = {
    edit : 1, r1 : nombre, r_r : id, r2:descrip, r3: dateI, r4: horaI, r5: dateF, r6: horaF, r7 : clase, r8:estado, r9:perfil,
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

        $("#mssg-edit-eventos").removeClass('alert-danger').removeClass('alert-info').addClass('alert-success').show().html('<h5>Los datos fueron actualizados con éxito.</h5>');
        listEvents();
        setTimeout(() => {
          $("#mssg-edit-eventos").hide();
          //window.location.reload();
        }, 4000);
      }
    },
    error: function (e) {
        console.log(e)
    }
  });
});

/** 
 * List All
 */
function listEvents() {
let route = "app/controllers/eventos.php";
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
    $('#tbody-table-eventes').empty().append(response);
  },
  error           : function (error) {
    console.log(error);
  }
});
}

/**
 * Delete 
 * @param {*} id 
 */
function deleteRow ( id ) {
  let route = "app/controllers/eventos.php";
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
        listEvents();
        setTimeout(() => {
          $(".result-mssg").hide();
          //window.location.reload();
        }, 4000);
      }
    },
    error: function (e) {
        console.log(e)
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


/** 
 * Datatable
 */
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
      targets: 7,
      orderable: false
      },{ width: "20%", targets: 0 },{ width: "20%", targets: 1, },{ width: "10%", targets: 2, } ,{ width: "10%", targets: 3 },{ width: "10%", targets: 4 },{ width: "10%", targets: 5 },{ width: "10%", targets: 6 },{ width: "8%", targets: 7 }
    ]
    });
} );

// $('.close').on('click', ()=>{
//   window.location.reload();
// });
// $('.btn-danger').on('click', ()=>{
//   window.location.reload();
// });

function goToTopPage(){
  //jQuery('.go-top').on('click', ()=> {
      jQuery('html, #add_eventos').animate({scrollTop: '0px'}, 'slow');
  //});
}

$("#text_event_perfil_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#text_event_perfil_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"}); // , dropdownParent: $("#formulario_nuevo")});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});// , dropdownParent: $("#formulario_nuevo")});
$("[name='event_class_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
