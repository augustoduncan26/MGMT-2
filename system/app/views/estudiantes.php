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
      <img src="assets/images/teacher.png" class="icon-teachers" /> Listado de Asignaciones de <?=getPageRealName()?> 
        <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4>
      </div>
      <div class="col-md-5 text-right">
          <a data-toggle="modal" class="btn btn-primary clean-all-inputs"  role="button" href="#formulario_nuevo">[+] Nuevo</a>
          <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
          <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a>
      </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips" title="Editar Información"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar</label> &nbsp;
        <a class="btn btn-green btn-xs btn-teal tooltips" title="Ver Información"><i class="fa fa-search"></i></a> <label class="color-gray">Ver</label> &nbsp;
        <a class="btn btn-xs btn-bricky tooltips" title="Eliminar"><i class="fa fa-times fa fa-white"></i></a><label class="color-gray">Eliminar</label>
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
              <table id="list-table-students" class="table table-striped table-bordered table-hover">
              <thead>
              <tr class="">
              <th>Nombre</th>
              <th>Materia</th> 
              <th>Aula / Clases</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-students">
              <?php
                if ($sqlAssignment ['total'] > 0){
                  foreach ($sqlAssignment['resultado'] as $key => $datos) {
                    $nameStudent   	= $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_usuario = "'.$datos['student_id'].'" and id_cia = '.$id_cia,'extract');
              ?>
              <tr>
              <td  title="Nombre del Profesor" <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$nameStudent['nombre'].'&nbsp;'.$nameStudent['apellido']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['asignment_name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_ini'].' - '.$datos['date_end']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Información" data-toggle="modal" role="button" data-target="#edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>','modal-edit');"><i class="fa fa-edit"></i></a>
              <a class="btn btn-green btn-xs btn-teal tooltips" data-original-title="Ver Información" data-toggle="modal" role="button" data-target="#myEditModal" href="#" onclick="editRow('<?php echo $datos['id']; ?>','modal-info');"><i class="fa fa-search"></i></a>
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
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Asignación de Estudiante</h3>
        </div>
         <form name="form_alumno" id="form_alumno" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div class="alert alert-danger" id="mssg-add"></div>
             <table class="table table-hover" id="table-add-prof">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Estudiante / Alumno <span class="symbol required"></span></td>
                   <td width="70%" colspan="3">
                    <select name="add_alumno[]" id="txt_add_alumno">
                        <?php 
                          if ($selectStudents['resultado']) {
                            echo '<option>seleccionar</option>';
                            foreach ($selectStudents['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                            }
                          }
                        ?>
                    </select></td>
                 </tr>

                 <tr>
                   <td width="30%">Asignaturas / Materias <span class="symbol required"></span></td>
                   <td width="70%" colspan="3">
                    <select name="event_asign_add[]" id="txt_event_asign_add" multiple>
                        <?php 
                          if ($selectAssignment['resultado']) {
                            foreach ($selectAssignment['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                     <lable class="text-center color-gray"> &nbsp; <input type="checkbox" id="select_materias_add" /> <label class="cursor" for="select_materias_add">Todos</label> </lable>
                   </td>
                 </tr>
                 <tr>
                   <td width="30%">Clase / Aulas <span class="symbol required"></span></td>
                   <td width="70%" colspan="3">
                    <select name="event_class_add[]" id="txt_event_class_add" multiple>
                        <?php 
                          if ($selectClases['resultado']) {
                            foreach ($selectClases['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                     <lable class="text-center color-gray"> &nbsp; <input type="checkbox" id="select_classes_add" /> <label class="cursor" for="select_classes_add">Todos</label> </lable>
                   </td>
                 </tr>

                 <tr>
                  <td ><label class="tooltips" data-original-title="Fecha Desde">F. Desde </label><span class="symbol required"></span></td>
                  <td>
                    <input autofocus="" name="date_ini_add" onchange="" type="date" class="form-control" id="date_ini_add" placeholder="Fecha">
                    <small class="color-gray">Formato: [mes/dia/año] </small>
                  </td>
                  <td><label class="tooltips" data-original-title="Fecha Desde">F. Hasta</label> <span class="symbol required"></span></td>
                  <td>
                    <input autofocus="" name="date_end_add" onchange="" type="date" class="form-control" id="date_end_add" placeholder="Fecha">
                    <small class="color-gray">Formato: [mes/dia/año] </small>
                  </td>
                 </tr>

                 <tr>
                   <td>Estado</td>
                   <td colspan="3">
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
          <input name="btn_add" type="button" class="btn btn-primary btn-add-alumno" id="btn_add_action" value="Guardar datos">
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
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Asignación de Estudiante</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 <div class="alert alert-danger" id="mssg-edit"></div>
 <table class="table table-hover" id="table-edit-alumno">
    <thead>
    </thead>
    <tbody>
      <tr>
        <td width="30%">Estudiante / Alumno <span class="symbol required"></span></td>
        <td width="70%" colspan="3">
        <select name="edit_alumno[]" id="txt_edit_alumno">
            <?php 
              if ($selectStudents['resultado']) {
                echo '<option>seleccionar</option>';
                foreach ($selectStudents['resultado'] as $key => $value) {
                  echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                }
              }
            ?>
        </select>
      <input type="hidden" name="id_row" id="id_row" />
      </td>
      </tr>

      <tr>
        <td width="30%">Asignaturas / Materias <span class="symbol required"></span></td>
        <td width="70%" colspan="3">
        <select name="event_asign_edit[]" id="txt_event_asign_edit" multiple>
            <?php 
              if ($selectAssignment['resultado']) {
                foreach ($selectAssignment['resultado'] as $key => $value) {
                  echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
              }
            ?>
        </select>
          <lable class="text-center color-gray"> &nbsp; <input type="checkbox" id="select_materias_edit" /> <label class="cursor" for="select_materias_edit">Todos</label> </lable>
        </td>
      </tr>
      <tr>
        <td width="30%">Clase / Aulas <span class="symbol required"></span></td>
        <td width="70%" colspan="3">
        <select name="event_class_edit[]" id="txt_event_class_edit" multiple>
            <?php 
              if ($selectClases['resultado']) {
                foreach ($selectClases['resultado'] as $key => $value) {
                  echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                }
              }
            ?>
        </select>
          <lable class="text-center color-gray"> &nbsp; <input type="checkbox" id="select_classes_edit" /> <label class="cursor" for="select_classes_edit">Todos</label> </lable>
        </td>
      </tr>

      <tr>
      <td ><label class="tooltips" data-original-title="Fecha Desde">F. Desde</label><span class="symbol required"></span></td>
      <td>
        <input autofocus="" name="date_ini_edit" onchange="" type="date" class="form-control" id="date_ini_edit" placeholder="Fecha">
        <small class="color-gray">Formato: [mes/dia/año] </small>
      </td>
      <td><label class="tooltips" data-original-title="Fecha Desde">F. Hasta</label><span class="symbol required"></span></td>
      <td>
        <input autofocus="" name="date_end_edit" onchange="" type="date" class="form-control" id="date_end_edit" placeholder="Fecha">
        <small class="color-gray">Formato: [mes/dia/año] </small>
      </td>
      </tr>

      <tr>
        <td>Estado</td>
        <td colspan="3">
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
      <input name="edit_aalumno" type="button" class="btn-edit-alumno btn btn-primary" id="edit_alumno" value="Modificar datos">
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Estudiante: <label class="nombre-del-alumno h4"></label></h4>
            </div>
            <div class="modal-body" style="height: 100% !important">
              
              <!-- Row 1 -->
              <div class="row f1" style="font-size: 14px;">
                <!-- section 1 -->
                <div class="col-md-3 flex " style="padding: 5px;">
                  <div class="col-md-12 col-sm-12 ">
                    <img id="blah-photo-user" class="photo-user" style="width: 120px; height: 130px; border-radius: 5px;" src="repositorio/profile_photos/user.png" alt="Foto">
                  </div>
                </div>
                <!-- section 2 -->
                <div class="col-md-9 flex bg-color-gray-transp border-radius" style="padding: 5px;">
                  <div class="col-md-7" style="padding: 1px;">
                    <div class="col-md-12"><i class="fa fa-envelope"></i> <label class="email-del-alumno"></label></div>
                    <div class="col-md-12"><i class="clip-calendar"></i> <label class="cumple-del-alumno"></label></div>
                    <div class="col-md-12"><i class="clip-phone"></i> <label class="telefono-del-alumno"></label></div>
                    <div class="col-md-12"><i class="fa fa-medkit"></i> <label class="tiposangre-del-alumno"></label></div>
                  </div>
                  <div class="col-md-5" style="padding: 1px;">
                    <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-list-2"></i> Clases <label id="total-class-info"> 0 </label></div>
                    <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-indent"></i> Materias <label id="total-assignments-info"> 0 </label></div>
                    <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-users-2"></i> Estudiantes <label id="total-students-info"> 0 </label></div>
                    <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-envelope"></i> Mensajes  <label id="total-message-info"> 0 </label></div>
                  </div>
                </div>
              </div>

              <!-- Row 2 -->
              <hr />
              <div class="row bg-color-yellow-transp" style="padding: 5px;">
                <div class="col-sm-12">
                  <label class="text-clases-info"></label>
                </div>
                <div class="col-sm-12">
                  <label class="text-assignments-info"></label>
                </div>
                <div class="col-sm-12">
                  <label class="text-messages-info"></label>
                </div>
              </div>

              <hr />

              <div class="row">
                <div class="col-md-12 text-right">Print</div>
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
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalImporter"><i class="clip-download-3"></i> Importador</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('footer_scripts');?>

<script>

$('#mssg-edit').hide();

/** 
 * Select All clases or Materias - ADD
 */
$("#select_classes_add").click(function(){
  if($("#select_classes_add").is(':checked') ){
      $("#txt_event_class_add > option").prop("selected","selected");
      $("#txt_event_class_add").trigger("change");
  }else{
      $("#txt_event_class_add > option").removeAttr("selected");
        $("#txt_event_class_add").trigger("change");
  }
});
$("#select_materias_add").click(function(){
  if($("#select_materias_add").is(':checked') ){
      $("#txt_event_asign_add > option").prop("selected","selected");
      $("#txt_event_asign_add").trigger("change");
  }else{
      $("#txt_event_asign_add > option").removeAttr("selected");
        $("#txt_event_asign_add").trigger("change");
  }
});
/** 
 * Select All clases or Materias - EDIT
 */
$("#select_classes_edit").click(function(){
  if($("#select_classes_edit").is(':checked') ){
      $("#txt_event_class_edit > option").prop("selected","selected");
      $("#txt_event_class_edit").trigger("change");
  }else{
      $("#txt_event_class_edit > option").removeAttr("selected");
        $("#txt_event_class_edit").trigger("change");
  }
});
$("#select_materias_edit").click(function(){
  if($("#select_materias_edit").is(':checked') ){
      $("#txt_event_asign_edit > option").prop("selected","selected");
      $("#txt_event_asign_edit").trigger("change");
  }else{
      $("#txt_event_asign_edit > option").removeAttr("selected");
        $("#txt_event_asign_edit").trigger("change");
  }
});

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


/**
 * Add
 */
$('.btn-add-alumno').on('click', ()=>{ 

  let nombre      = $('#txt_add_alumno').val();
  let asign       = $('#txt_event_asign_add').val();
  let classes     = $('#txt_event_class_add').val();
  let dateini     = $('#date_ini_add').val();
  let dateend     = $('#date_end_add').val();
  let estado      = $('#event_estado_add').val();

  if ( nombre == 'seleccionar' || nombre == '' || nombre == null || asign == '' || classes == '' || dateini == '' || dateend == '') { // || asign == '' || classes == '') {
    $("#mssg-add").show().html('<h5>Los campos con (*) son necesarios</h5>');
    setTimeout(() => {
      $("#mssg-add").hide()
      }, 3000);
    return false
  }
  if (evaluarFechas(dateini, dateend) == false) {
    $("#mssg-add").show().html('<h5>La fecha final debe ser mayor o igual a la fecha de inicio</h5>');
    setTimeout(() => {
        $("#mssg-add").hide();
      }, 4000);
    return false
  }

  let route = "app/controllers/estudiantes.php";

  $.ajax({
    url: route,
    type: "POST",
    data: {
      add : 1,
      r1 : nombre,
      r2 : asign,
      r3 : classes,
      r4 : estado,
      r5 : dateini,
      r6 : dateend,
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

      listRows();
      setTimeout(() => {
        $("#mssg-add").removeClass('alert-success').addClass('alert-danger').hide();
      }, 4000);
  
      $("#txt_add_alumno").val('').change();
      $("#txt_event_asign_add").val('').change();
      $("#txt_event_class_add").val('').change();
      $("#date_ini_add").val('');
      $("#date_end_add").val('');
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
const editRow = ( id , tipo ) => {

  if ( tipo == 'modal-info' ) {
    $('.fa-refresh').trigger('click');
    setTimeout(()=>{
      $('.fc-button-month').trigger('click');
    },1000);
  }
 
  if ( tipo == 'modal-edit' ) {
    $("#mssg-edit").removeClass('alert-success').removeClass('alert-danger').addClass('alert-info').show().html('<h5>Cargando información. &nbsp; <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i></h5>');
    $("#table-edit-alumno *").prop('disabled',true);
  }

  let route = "app/controllers/estudiantes.php";
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
      switch (tipo) {
        case 'modal-edit':
          if (response['student_id']!= null && response['student_id']!='' && response['student_id']!='NULL') {
            let arr   = response['student_id'].split (",");
            let keys  = Object.keys(arr).length;
            let r  = "";
            arr.forEach((item,key)=>{
              if (item) {
                r =  arr + ',';
                $('#txt_edit_alumno').val(arr).change();
              }
            });
          }
          if (response['assignment_id']!= null && response['assignment_id']!='' && response['assignment_id']!='NULL') {
            let arr   = response['assignment_id'].split (",");
            let keys  = Object.keys(arr).length;
            let r  = "";
            arr.forEach((item,key)=>{
              if (item) {
                r =  arr + ',';
                $('#txt_event_asign_edit').val(arr).change();
              }
            });
          }
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
          $('#id_row').val(response['id']);
          $('#date_ini_edit').val(response['date_ini']);
          $('#date_end_edit').val(response['date_end']);
          $('#event_estado_edit').val(response['activo']).change();

          setTimeout(() => {
            $("#table-edit-alumno *").prop('disabled',false);
            $("#mssg-edit").hide();
            $("#table-edit-alumno").css('pointer-event','all');
          }, 1000);

        break;

        // Modal Info
        case 'modal-info':
          //console.log(response['resultado'][0]['asignment_name'])
          $('.nombre-del-alumno').html(response['student_name']);
          if (response['photo']=='' || response['photo']==null) {
            $('.photo-user').prop('src', 'repositorio/profile_photos/user.png');
          } else {
            $('.photo-user').prop('src', 'repositorio/profile_photos/' + response['photo']);
          }
          if (response['telefono']=='') { response['telefono'] = '000000000';}
          if (response['tipo_sangre']=='') { response['tipo_sangre'] = '-';}
          $('.email-del-alumno').html(response['email']);
          $('.cumple-del-alumno').html(response['birthday']);
          $('.telefono-del-alumno').html(response['telefono']);
          $('.tiposangre-del-alumno').html(response['tipo_sangre']);
          if (response['asignment_name'] =='') { response['asignment_name'] = 'No posee materias asignadas';}

          $('#total-class-info').html(': ' + response['total_class']);
          $('#total-assignments-info').html(': ' + response['total_assignm']);
          $('#total-message-info').html(': ' + response['total_message']);

          $('.text-clases-info').html(' <strong class="size-20">Aulas / Clases:</strong> &nbsp; ' + response['class_name']);
          $('.text-assignments-info').html(' <strong>Materias:</strong> &nbsp; ' + response['asignment_name']);
          $('.text-messages-info').html(' <strong>Mensajes:</strong> &nbsp; ' + response['messages']);
        break;
      
        default:
        break;
      }
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
$('.btn-edit-alumno').on('click', ()=>{ 
  let id      = $('#id_row').val();
  let nombre      = $('#txt_edit_alumno').val();
  let asign       = $('#txt_event_asign_edit').val();
  let classes     = $('#txt_event_class_edit').val();
  let dateini     = $('#date_ini_edit').val();
  let dateend     = $('#date_end_edit').val();
  let estado      = $('#event_estado_edit').val();

  if ( nombre == 'seleccionar' || nombre == '' || nombre == null || asign == '' || classes == '' || dateini == '' || dateend == '') { // || asign == '' || classes == '') {
    $("#mssg-edit").addClass('alert-danger').show().html('<h5>Los campos con (*) son necesarios</h5>');
    setTimeout(() => {
      $("#mssg-edit").hide()
      }, 3000);
    return false
  }
  if (evaluarFechas(dateini, dateend) == false) {
    $("#mssg-edit").addClass('alert-danger').show().html('<h5>La fecha final debe ser mayor o igual a la fecha de inicio</h5>');
    setTimeout(() => {
        $("#mssg-edit").hide();
      }, 4000);
    return false
  }
  let route = "app/controllers/estudiantes.php"; 

  var parametros = {
    edit : 1, r1 : nombre, r_r : id, r2:asign, r3:classes, r4: dateini, r5: dateend, r6: estado,
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
        $("#mssg-edit").removeClass('alert-danger').removeClass('alert-info').addClass('alert-success').show().html('<h5>Los datos fueron actualizados con éxito.</h5>');
        listRows();
        setTimeout(() => {
          $("#mssg-edit").hide('slow');
          //window.location.reload();
        }, 4000);
      } else {
        $("#mssg-edit").removeClass('alert-success').removeClass('alert-info').addClass('alert-danger').show().html('<h5>No se ha podido actualizar el registro.</h5>');
        console.log(response);
         setTimeout(() => {
          $("#mssg-edit").removeClass('alert-danger').hide();
        }, 4000);
      }
    },
    error: function (e) {
        console.log(e)
    }
  });
});

/**
 * Delete 
 * @param {*} id 
 */
function deleteRow ( id ) {
  let route = "app/controllers/estudiantes.php";
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
        listRows();
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

/** 
 * List All
 */
function listRows() {
let route = "app/controllers/estudiantes.php";
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
    $('#tbody-table-students').empty().append(response);
  },
  error           : function (error) {
    console.log(error);
  }
});
}

// Clean inputs
$('.clean-all-inputs').on('click', ()=>{
  $('#txt_add_alumno').val('').change();
  $('#txt_event_asign_add').val('').change();
  $('#txt_event_class_add').val('').change();
  $('#select_materias_add').prop('checked', false);
  $('#select_classes_add').prop('checked', false);
  $('#date_ini_add').prop('value', false);
  $('#date_end_add').prop('value', false);

  $('#txt_edit_alumno').val('').change();
  $('#txt_event_asign_edit').val('').change();
  $('#txt_event_class_edit').val('').change();
  $('#select_materias_edit').prop('checked', false);
  $('#select_classes_edit').prop('checked', false);
  $('#date_ini_edit').prop('value', false);
  $('#date_end_edit').prop('value', false);
});

// Make some default options
// $("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
// $("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});

$(document).ready( function () {
    $('#list-table-students').DataTable({
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
      },{ width: "15%", targets: 0 },{ width: "18%", targets: 1, } ,{ width: "18%", targets: 2 },{ width: "10%", targets: 3 },{ width: "10%", targets: 4 },{ width: "12%", targets: 5 }
    ]
    });
} );

$("#txt_add_alumno").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_asign_add").select2({ width: '80%', dropdownCssClass: "bigdrop"});
$("#txt_event_class_add").select2({ width: '80%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

$("#txt_edit_alumno").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_event_asign_edit").select2({ width: '80%', dropdownCssClass: "bigdrop"});
$("#txt_event_class_edit").select2({ width: '80%', dropdownCssClass: "bigdrop"});
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
