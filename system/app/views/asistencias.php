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

.modal-body {
    max-width: 100%;
    overflow-x: auto;
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
       <div class="alert result-mssg"></div>
    </div>

    <div class="container">
      <div class="col-md-7">
        <h4>
        <i class="clip-checkbox"></i> Listado de Asistencia
        <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4> 
      </div>
      <div class="col-md-5 text-right">
        <?php if(in_array('551', $objPermOpc->getRolPermissions($id_rol))) { ?><a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo">[+] Nuevo</a><?php } ?>
        <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
        <!-- <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a> -->
      </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <?php if (in_array('552', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-xs btn-teal tooltips" title="Ver - Editar"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar registro</label><?php } ?>
        <?php if (in_array('553', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-green btn-xs btn-teal tooltips" title="Asistencia"><i class="clip-checkbox"></i></a> <label class="color-gray">Asistencia</label><?php } ?>
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
              <tr class="">
              <th>Materia</th>
              <th>Maestro / Profesor</th> 
              <th>Tot. Asistencia</th> 
              <th>Fecha</th> 
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-eventes">
              <?php
                if ($assignment['resultado']) {
                  foreach ($assignment as $key => $datos) {
              ?>
                  <tr>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$total;?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$total;?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_start']?></td>
                  <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                  <td class="text-center" style="width:10% !important;">
                  
                  <?php if(in_array('552', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-xs btn-teal tooltips" data-original-title="Ver - Editar" data-toggle="modal" data-target="#form_edit_event" role="button" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a><?php } ?>
                  <!-- <?php if(in_array('552', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a><?php } ?> -->
                  <?php if(in_array('553', $objPermOpc->getRolPermissions($id_rol))) { ?><a class="btn btn-green btn-xs btn-teal tooltips" data-original-title="Tomar Asistencia" data-toggle="modal" data-target="#form_edit_event" role="button" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="clip-checkbox"></i></a><?php } ?>
                  
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
<div class="modal fade" id="formulario_nuevo" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" >  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Asignar Materia a Profesor</h3>
        </div>
         <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table  table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <div class="alert alert-danger mssg-add-modal">Todos los campos son necesarios</div>
                 <tr>
                   <td width="30%">Materia <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="class_add" id="class_add">
                      <option></option>
                      <?php 
                        if ($selectAssig['resultado']) {
                          foreach ($selectAssig['resultado'] as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                          }
                        }
                      ?>
                    </select>
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Profesor <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="teacher_add" id="teacher_add">
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
          <button data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_habitacion" type="button" class="btn btn-primary add-event" id="agregar_evento" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- En Add -->


<!-- Edit -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="form_edit_event" tabindex="-1" role="dialog" >
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><!--  aria-hidden="true" -->
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Asignar Materia / Profesor / Maestro</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 <div id="mssg-add-assignaments" style="color:red;"></div>
    <!-- <img src="images/ajax-loader.gif" id="cargando_add" /> -->
    <table class="table  table-hover" id="sample-table-4">
    <thead>
    </thead>
    <tbody>
    <div class="alert alert-danger mssg-edit-modal">Todos los campos son necesarios</div>
      <tr>
        <td width="30%">Materia <span class="symbol required"></span></td>
        <td width="70%"><input maxlength="50" name="nombre_edit" type="text" class="form-control" id="nombre_edit" placeholder="Nombre">
        <input maxlength="50" name="id_row" type="hidden" class="form-control" id="id_row">
      </td>
      </tr>

      <tr>
        <td width="30%">Clase <span class="symbol required"></span></td>
        <td width="70%">
        <select name="class_edit[]" id="class_edit" multiple>
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
        <select name="teacher_edit[]" id="teacher_edit" multiple>
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
            <!-- aria-hidden="true"  -->
      <button data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="agregar_habitacion" type="button" class="btn btn-primary btn-edit-asignatura" id="edit_evento"  value="Modificar datos">
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
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Asistente</h4>
            </div>
            <div class="modal-body" >
                <div class="table-responsive-xxl">          
                        <div class="col-md-10">
                        What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.


                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar -->
<div class="modal fade  come-from-modal right" id="myImporter" role="dialog" aria-labelledby="myModalImporter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalImporter"><i class="clip-download-3"></i> Importador</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<?php get_template_part('footer_scripts');?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

$('.mssg-add-modal').hide('slow');

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
$('#mssg-add-eventos').hide();
$('#mssg-edit-eventos').hide();


/** 
 * Select All clases or Perfiles
 */
$("#select_classes").click(function(){
  if($("#select_classes").is(':checked') ){
      $("#event_class_add > option").prop("selected","selected");
      $("#event_class_add").trigger("change");
  }else{
      $("#event_class_add > option").removeAttr("selected");
        $("#event_class_add").trigger("change");
  }
});
$("#select_perfiles").click(function(){
  if($("#select_perfiles").is(':checked') ){
      $("#text_event_perfil_add > option").prop("selected","selected");
      $("#text_event_perfil_add").trigger("change");
  }else{
      $("#text_event_perfil_add > option").removeAttr("selected");
      $("#text_event_perfil_add").trigger("change");
  }
});
$("#select_classes_edit").click(function(){
  if($("#select_classes_edit").is(':checked') ){
      $("#txt_event_class_edit > option").prop("selected","selected");
      $("#txt_event_class_edit").trigger("change");
  }else{
      $("#txt_event_class_edit > option").removeAttr("selected");
      $("#txt_event_class_edit").trigger("change");
  }
});
$("#select_perfiles_edit").click(function(){
  if($("#select_perfiles_edit").is(':checked') ){
      $("#text_event_perfil_edit > option").prop("selected","selected");
      $("#text_event_perfil_edit").trigger("change");
  }else{
      $("#text_event_perfil_edit > option").removeAttr("selected");
        $("#text_event_perfil_edit").trigger("change");
  }
});

/** 
 * Add
 */
//function addEvent () {
$('#agregar_evento').on('click', ()=> {
  var nombre      = $('#nombre_add').val();
  var clase       = $('#event_class_add').val();
  var dateI       = $('#event_add_date_ini').val();
  var horaI       = $('#event_add_hora_ini').val();
  var dateF       = $('#event_add_date_fin').val();
  var horaF       = $('#event_add_hora_fin').val();
  var estado      = $('#event_estado_add').val();
  let descrip     = $('#descripcion_add').val();
  let tipo_color  = $('#tipo_color_add').val();
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
      r9: perfil,
      r10 : tipo_color,
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
      $("#event_add_date_ini").val('');
      $("#event_add_date_fin").val('');
      $("#descripcion_add").val('');
      $("#event_class_add").val('').change();
      $("#nombre_add").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
});

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

      let hora1 = response['time_start'].split('T');
      let hora2 = response['time_end'].split('T');

      $("#text_event_perfil_edit").trigger('change');
      $('#id_row').val(response['id']);
      $('#nombre_edit').val(response['name']);
      $('#descripcion_edit').val(response['description']);
      $('#event_edit_date_ini').val(response['date_start']);
      $('#event_edit_hora_ini').val(hora1[1]);
      $('#event_edit_date_fin').val(response['date_end']);
      $('#event_edit_hora_fin').val(hora2[1]);
      $('#event_estado_edit').select2('val',response['activo']);
      $('#event_class_edit').select2('val',response['class_id']);
      //$('#tipo_color_edit').select2('val', response['tipo_color']).change();
      $('#tipo_color_edit').val(response['tipo_color']).change();

      if (response['class_id']!= null && response['class_id']!='' && response['class_id']!='NULL') {
        let arr   = response['class_id'].split (",");
        let keys  = Object.keys(arr).length;
        let r  = "";
        arr.forEach((item,key)=>{
          if (item) {
            r =  arr + ',';
            $('#txt_event_class_edit').val(arr).change();
          }
        });
      }

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
  let clase         = $('#txt_event_class_edit').val();
  let estado        = $('#event_estado_edit').val();
  let id            = $('#id_row').val();
  let perfil        = $('#text_event_perfil_edit').val();
  let tipo_color    = $('#tipo_color_edit').val();

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
    edit : 1, r1 : nombre, r_r : id, r2:descrip, r3: dateI, r4: horaI, r5: dateF, r6: horaF, r7 : clase, r8:estado, r9:perfil, r10: tipo_color,
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
      targets: 5,
      orderable: false
      },{ width: "20%", targets: 0 },{ width: "20%", targets: 1 },{ width: "8%", targets: 2, },{ width: "10%", targets: 3, } ,{ width: "10%", targets: 4 },{ width: "8%", targets: 5 }
    ]
    });
} );


function goToTopPage(){
  //jQuery('.go-top').on('click', ()=> {
      jQuery('html, #add_eventos').animate({scrollTop: '0px'}, 'slow');
  //});
}

$("[name='class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='teacher_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});


// $("#text_event_perfil_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("#text_event_perfil_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("#txt_event_class_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='event_class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"}); // , dropdownParent: $("#formulario_nuevo")});
// $("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});// , dropdownParent: $("#formulario_nuevo")});
// $("[name='event_class_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='event_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='tipo_color_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
// $("[name='tipo_color_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
