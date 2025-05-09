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
      <img src="assets/images/teacher.png" class="icon-teachers" /> Listado de <?=getPageRealName()?> 
        <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4>
      </div>
      <div class="col-md-5 text-right">
        <!-- <a data-toggle="modal" class="btn btn-primary "  role="button" href="#formulario_nuevo">[+] Nuevo</a> -->
        <!-- <div class=""> -->
          <a data-toggle="modal" class="col-md-5 btn btn-primary btn-exportar float-right"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
        <!-- </div> -->
        <!-- <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a> -->
      </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips" title="Ver Información"><i class="fa fa-search"></i></a> <label class="color-gray">Ver Información</label> &nbsp;
        <!-- <a class="btn btn-xs btn-bricky tooltips" title="Eliminar"><i class="fa fa-times fa fa-white"></i></a><label class="color-gray">Eliminar registro</label> -->
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
              <table id="list-table-teachers" class="table table-striped table-bordered table-hover">
              <thead>
              <tr class="">
              <th title="Nombre del Profesor">Nombre</th>
              <th>Email</th>
              <th>Materia</th> 
              <th>Clases / Salones</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-teachers">
              <?php
                if ($selectTeachers['resultado']){
                  foreach ($selectTeachers['resultado'] as $datos) {
                    $subjects     = $ObjMante->BuscarLoQueSea('*',PREFIX.'associate_teacher_subjects','teacher_id="'.$datos['id_usuario'].'" and id_cia = '.$id_cia,'array');
                    $classes      = $ObjMante->BuscarLoQueSea('*',PREFIX.'class','supervisor_id="'.$datos['id_usuario'].'" and id_cia = '.$id_cia,'array');
                    
                    $resultClass    = false;
                    $resultSubjects = false;

                    if ($subjects['resultado']) {
                      foreach ($subjects['resultado'] as $data) {
                        if($resultSubjects != false) {
                          $resultSubjects .=  ', ';
                        }	
                        $resultSubjects .= $data['class_name'];
                        $resultSubjects = rtrim($resultSubjects, ", ");
                      }
                    }

                    if ($classes['resultado']) {
                      foreach ($classes['resultado'] as $data) {
                        if($resultClass != false) {
                          $resultClass .=  ', ';
                        }	
                        $resultClass .= $data['class_name'];
                        $resultClass = rtrim($resultClass, ", ");
                      }
                    }
                    if (empty($resultClass)) { $resultClass = '- - - -';}
                    if (empty($resultSubjects)) { $resultSubjects = '- - - -';}
              ?>
              <tr>
              <td  title="Nombre del Profesor" <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['nombre']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['email']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$resultSubjects?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$resultClass?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Información" data-toggle="modal" role="button" data-target="#myEditModal" href="#" onclick="editRow('<?php echo $datos['id_usuario']; ?>');"><i class="fa fa-search"></i></a>
              <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
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
</div>  
<?php //////  Fin de editor ?>
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
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- Modal (Right) Ver Informacion // Editar -->
<div class="modal fade  come-from-modal right" id="myEditModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Profesor: <label class="nombre-del-profesor h4"></label></h4>
            </div>
            <div class="modal-body" style="height: 100% !important">
              <!-- <input name="guardar_data" type="button" class="btn btn-primary float-right" id="guardar_data" onClick="var id_row = $('#id_row').val(); updateEvent(id_row)" value="Modificar datos"> -->
              
              <!-- Row 1 -->
              <div class="row f1" style="font-size: 14px;">
                <!-- section 1 -->
                <div class="col-md-3 flex " style="padding: 5px;">
                  <div class="col-md-12 col-sm-12 ">
                    <img id="blah-photo-user" class="photo-user" style="width: 100px; height: 100px" src="repositorio/profile_photos/user.png" alt="Foto">
                  </div>
                </div>
                <!-- section 2 -->
                <div class="col-md-5 flex bg-color-gray-transp border-radius" style="padding: 5px;">
                  <div class="col-md-12"><i class="fa fa-envelope"></i> <label class="email-del-profesor"></label></div>
                  <div class="col-md-12"><i class="clip-calendar"></i> <label class="cumple-del-profesor"></label></div>
                  <div class="col-md-12"><i class="clip-phone"></i> <label class="telefono-del-profesor"></label></div>
                  <div class="col-md-12"><i class="fa fa-medkit"></i> <label class="tiposangre-del-profesor"></label></div>
                </div>
                <!-- section 3 -->
                <div class="col-md-4 flex" style="padding: 5px;">
                  <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-list-2"></i> <a href="#">Clases</a></div>
                  <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-indent"></i> <a href="#">Materias</a></div>
                  <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-users-2"></i> <a href="#">Estudiantes</a></div>
                  <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-envelope"></i> <a href="#">Asignaciones</a></div>
                </div>
              </div>

              <!-- Row 2 Calendar -->
              <hr />
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="clip-calendar"></i>
                      Calendar
                      <div class="panel-tools">
                        <!-- <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a> -->
                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                          <i class="fa fa-refresh"></i>
                        </a>
                      </div>
                    </div>
                    <div class="panel-body">
                    <div id='calendar'></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Calendar -->

            </div>
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
        </div>
    </div>
</div>

<?php get_template_part('footer_scripts');?>


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
const editRow = ( id ) => {
  $('.fa-refresh').trigger('click');
  setTimeout(()=>{
    $('.fc-button-month').trigger('click');
  },1000);
  $("#mssg-edit-eventos").removeClass('alert-success').removeClass('alert-danger').addClass('alert-info').show().html('<h5>Cargando información. &nbsp; <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i></h5>');
  $("#table-eventos-edit *").prop('disabled',true);
  let route = "app/controllers/profesores.php";
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
      $('.nombre-del-profesor').html(response['nombre']);
      if (response['photo']=='' || response['photo']==null) {
        $('.photo-user').prop('src', 'repositorio/profile_photos/user.png');
      } else {
        $('.photo-user').prop('src', 'repositorio/profile_photos/' + response['photo']);
      }
      $('.email-del-profesor').html(response['email']);
      $('.cumple-del-profesor').html(response['birthday']);
      $('.telefono-del-profesor').html(response['telefono']);
      $('.tiposangre-del-profesor').html(response['tipo_sangre']);
      // $("#text_event_perfil_edit").trigger('change');
      // $('#id_row').val(response['id']);
      // $('#nombre_edit').val(response['name']);
      // $('#descripcion_edit').val(response['description']);
      // $('#event_edit_date_ini').val(response['date_start']);
      // $('#event_edit_hora_ini').val(response['time_start']);
      // $('#event_edit_date_fin').val(response['date_end']);
      // $('#event_edit_hora_fin').val(response['time_end']);
      // $('#event_estado_edit').select2('val',response['activo']);
      // $('#event_class_edit').select2('val',response['class_id']);

      
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
      targets: 5,
      orderable: false
      },{ width: "15%", targets: 0 },{ width: "15%", targets: 1, },{ width: "15%", targets: 2, } ,{ width: "15%", targets: 3 },{ width: "8%", targets: 4 }
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


jQuery('#calendar').fullCalendar({
      header: {
        language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay',

      },
      //defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        //element.bind('dblclick', function() {
        element.bind('click', function() {
          // Eventos
          if ( event.tipo == 'E') {
            $('#ModalEdit #div_reservar_editar').hide();
            $('#ModalEdit #id_editar').val(event.id);
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #color').val(event.color);
          // Reservas
          } else { 
            $('#ModalEdit #div_reservar_editar').show();
            $('#ModalEdit #id_editar').val(event.id);
            //$('#ModalEdit #title').show();
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #email').val(event.email);
            $('#ModalEdit #apellido_edit').val(event.apellido);
            $('#ModalEdit #habitacion_edit').val(event.rooms);
            $('#ModalEdit #tot_personas').val(event.totpersons);
            $('#ModalEdit #precio_edit').val(event.precio);
            $('#ModalEdit #descuento_edit').val(event.descuento);
            $('#ModalEdit #nacionalidad_edit').val(event.nacionalidad);
            $('#ModalEdit #documento_edit').val(event.documento);
            $('#ModalEdit #n_documento_edit').val(event.ndocumento);
            $('#ModalEdit #observacion_edit').val(event.observacion);
            $('#ModalEdit #color').val(event.color);
          }
            $('#ModalEdit #tipo_reserva_edit').val(event.tipo);
            $('#ModalEdit #fecha_e_editar').val(moment(event.start).format('YYYY-MM-DD'));
            $('#ModalEdit #fecha_s_editar').val(moment(event.end).format('YYYY-MM-DD'));

          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
      <?php 
      if ($event!=null) :
      foreach($events as $event):
        $start  = explode(" ", $event['fecha_e']);
        $end    = explode(" ", $event['fecha_s']);
        $price  = $event['price'];
        $apellido  = $event['last_name'];

        if($start[1] == '00:00:00'){
          $start = $start[0];
        }else{
          $start = $event['start'];
        }
        if($end[1] == '00:00:00'){
          $end = $end[0];
        }else{
          $end = $event['end'];
        }
      ?> 
        { 
        // Aqui muestro en el calendario y los muestro
        // en los campos al querer editar la info.
        // ********************************************
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          apellido: '<?php echo $event['last_name']; ?>',
          email: '<?php echo $event['email']; ?>',
          rooms: '<?php echo $event['rooms']; ?>',
          totpersons: '<?php echo $event['total_persons']; ?>',
          precio: '<?php echo $price; ?>',
          descuento: '<?php echo $event['discounts']; ?>',
          nacionalidad: '<?php echo $event['nationality']; ?>',
          documento: '<?php echo $event['type_doc']; ?>',
          ndocumento: '<?php echo $event['number_doc']; ?>',
          observacion: '<?php echo $event['observation']; ?>',
          start: '<?php echo $event['fecha_e']; ?>',
          end: '<?php echo $event['fecha_s']; ?>',
          tipo: '<?php echo $event['tipo']?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; endif; ?>
      ]
    });
</script>
