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
.select-all-label {
    position: absolute;
    margin-top: 2px;
    margin-left: 5px;
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
      <label id="label-mssg"><?=$mssg?></label>
    </div>

    <div class="container">
      <div class="col-md-7">
        <h4>
          <i class="fa fa-indent"></i> Lista de Asignaturas / Materias 
          <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
        </h4>
      </div>
      <div class="col-md-5 text-right">
      <a data-toggle="modal" data-original-title="Agregar Asignaturas" data-placement="top" class="btn btn-primary tooltips"  role="button" href="#formulario_nuevo">[+] Nuevo</a>
      <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
      <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a>
    </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips" data-content="Editar un registro" data-original-title="Editar" id="add-regular"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar registro</label> &nbsp;
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
                  $sel3 = $ObjMante->BuscarLoQueSea('nombre,apellido',PREFIX.'usuarios','id_usuario='.$datos['teacher_id'],'extract',false);
                  $resultClass = false;
                  $r    = explode(',',$datos['class_id']);
                  $tot  = count($r);
                  for ($i = 0 ; $i < $tot+1; $i++) {
                    if (isset($r[$i])) { 
                      $sel2 = $ObjMante->BuscarLoQueSea('class_name',PREFIX.'class','id='.$r[$i],'extract',false);
                      if($resultClass != false) {
                        $resultClass .=  ', ';
                      }	
                      $resultClass .=  $sel2['class_name'];
                      $resultClass = rtrim($resultClass, ", ");
                    }
                  }
              ?>
              <tr>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo $resultClass?></td>
			        <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php echo $sel3['nombre'].' '.$sel3['apellido'];?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Editar" data-toggle="modal" role="button" href="#form_edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" >  × </button>
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
                   <td width="70%"><input maxlength="50" name="nombre_add" type="text" class="form-control" id="nombre_add" placeholder="Nombre"></td>
                 </tr>

                 <tr>
                   <td width="30%">Clase <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="class_add[]" id="class_add" multiple>
                        <?php 
                          if ($selectClases['resultado']) {
                            foreach ($selectClases['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                    <label class="text-center"> &nbsp; <input type="checkbox" class="select-all-class-options" id="select-all-class" /> <label class="select-all-label cursor" for="select-all-class">Todos</label></label>
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Asignar profesor: <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="teacher_add[]" id="teacher_add" multiple>
                        <?php 
                          if ($selectTeachers['resultado']) {
                            foreach ($selectTeachers['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                            }
                          }
                        ?>
                    </select>
                     <label class="text-center"> &nbsp; <input type="checkbox" class="select-all-prof-options " id="select-all-prof" /> <label class="select-all-label cursor" for="select-all-prof">Todos</label></label>
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
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Asignatura / Materia</h3>
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
        <td width="30%">Nombre <span class="symbol required"></span></td>
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
        <!-- <label class="text-center"> &nbsp; <input type="checkbox" class="select-all-class-edit-options" id="select-all-class-edit" /> <label class="select-all-label cursor" for="select-all-class-edit">Todos</label></label> -->
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
        <!-- <label class="text-center"> &nbsp; <input type="checkbox" class="select-all-prof-edit-options " id="select-all-prof-edit" /> <label class="select-all-label cursor" for="select-all-prof-edit">Todos</label></label> -->
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

<!-- Help Side Bar Modal -->
<!-- 
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button> 
-->

<!-- Assistant Modal -->
<div class="modal fade  come-from-modal right" id="myAssistant" tabindex="-1" role="dialog" aria-labelledby="myAssistant">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >  × </button>
                <h4 class="modal-title" id="myAssistant">Asistente</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
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
//setTimeout(() => {
  $('.mssg-add-modal').hide();
  $('.mssg-edit-modal').hide();
//}, 3000);

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

  if ( nombre == '' || clase == '' || clase == null || teacher == null || teacher == '' || estado == '' ) {
    $(".mssg-add-modal").addClass('alert-danger').removeClass('alert-success').show().html('Los campos con (*) son necesarios');
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
  //console.log(nombre,clase,teacher,estado)

  $.ajax({
    url: route,
    dataType : 'text',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success         : function (response) { 
      if (response == 'ok') {
        $(".mssg-add-modal").removeClass('alert-danger').addClass('alert-success').css('color','#3c763d').show().html('<h5>Se ingreso el registro con éxito.</h5>');
        listAll();
        $("#nombre_add").val('');
        $('#class_add').val();
        $("#class_add").val('').trigger('change')
        $("#teacher_add").val([]).trigger('change')
        $("#estado_add").val('').trigger('change')
      } if (response == 'error') {
        $(".mssg-add-modal").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Ya existe un registro con este mismo nombre.<h5>');
      }
        setTimeout(() => {
          $(".mssg-add-modal").hide();
        }, 3000);
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
      $('#estado_edit').select2('val',response['activo']);
      
      if (response['class_id']!= null && response['class_id']!='' && response['class_id']!='NULL') {
        let arr   = response['class_id'].split (",");
        let keys  = Object.keys(arr).length;
        let r  = "";
        arr.forEach((item,key)=>{
          if (item) {
            r =  arr + ',';
            $('#class_edit').val(arr).change();
          }
        });
      }
      if (response['teacher_id']!= null && response['teacher_id']!='' && response['teacher_id']!='NULL') {
        let arr   = response['teacher_id'].split (",");
        let keys  = Object.keys(arr).length;
        let r  = "";
        arr.forEach((item,key)=>{
          if (item) {
            r =  arr + ',';
            $('#teacher_edit').val(arr).change();
          }
        });
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
$('.btn-edit-asignatura').on('click', ()=>{
  let id          = $('#id_row').val();
  let nombre      = $('#nombre_edit').val();
  let clase       = $('#class_edit').val();
  let teacher     = $('#teacher_edit').val();
  let estado      = $('#estado_edit').val();
  let form_data   = new FormData();

  if ( nombre == '' || clase == '' || clase == null || teacher == null || teacher == '' || estado == '' ) {
    $(".mssg-edit-modal").addClass('alert-danger').removeClass('alert-success').show().html('Los campos con (*) son necesarios');
    setTimeout(() => {
      $('.mssg-edit-modal').hide();
    }, 3000);
    return false
  }

  let route = "app/controllers/asignaturas.php"; 

  let parametros = {
    edit : 1, r2 : nombre, r1 : id, r3:clase, r4: teacher, r5:estado,
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
        $(".mssg-edit-modal").removeClass('alert-danger').addClass('alert-success').show().html('<h5>Los datos fueron actualizados con éxito.</h5>');
        listAll();
        setTimeout(() => {
          $(".mssg-edit-modal").hide();
        }, 4000);
      }
    }
  });
});


/**
 * Delete
 */
function deleteRow ( id ) {
  let route = "app/controllers/asignaturas.php"; 
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      delete : 1,
      id  : id
    },
    dataType        : 'html',
    success         : function (response) { 
      listAll();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}


$(".select-all-class-options, .select-all-prof-options").on('click' , function() {
  if (this.id == 'select-all-class') {
    if ($('.select-all-class-options').is(':checked')) {
      $("#class_add > option").prop("selected","selected");
      $("#class_add").trigger("change");
    } else {
      $("#class_add").val([]).trigger('change')
    }
  }
  if (this.id == 'select-all-prof') {
    if ($('.select-all-prof-options').is(':checked')) {
      $("#teacher_add > option").prop("selected","selected");
      $("#teacher_add").trigger("change");
    } else {
      $("#teacher_add").val([]).trigger('change')
    }
  }
});

$(".select-all-class-options, .select-all-prof-options").on('click' , function() {
  if (this.id == 'select-all-class') {
    if ($('.select-all-class-options').is(':checked')) {
      $("#class_add > option").prop("selected","selected");
      $("#class_add").trigger("change");
    } else {
      $("#class_add").val([]).trigger('change')
    }
  }
  if (this.id == 'select-all-prof') {
    if ($('.select-all-prof-options').is(':checked')) {
      $("#teacher_add > option").prop("selected","selected");
      $("#teacher_add").trigger("change");
    } else {
      $("#teacher_add").val([]).trigger('change')
    }
  }
});


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


$("#class_add").select2({ width: '80%', dropdownCssClass: "bigdrop"});
$("#teacher_add").select2({ width: '80%', dropdownCssClass: "bigdrop"});
$("[name='estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#class_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#teacher_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
