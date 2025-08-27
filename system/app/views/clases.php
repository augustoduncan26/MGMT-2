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
      <label id="label-mssg"><?=$mssg?></label>
    </div>

    <div class="container">
      <div class="col-md-7">
      <h4><i class="clip-list-2"></i> 
      <img src="assets/images/teacher.png" class="icon-teachers" />
      Lista de Clases
    <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
  </h4>
      </div>
      <div class="col-md-5 text-right">
      <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="limpiarCampos('add_clase');  ">[+] Nueva Clase</a>
      <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
      <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a>
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
              <tr class="">
              <th>Nombre</th>
              <th>Capacidad</th> 
              <th>Grado</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody id="tbody-table-clases">
                <?php
                  if ($selectAll['resultado']){
                    foreach ($selectAll['resultado'] as $datos) {
                      $userName     = $ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_usuario = "'.$datos['supervisor_id'].'" and id_cia = '.$id_cia,'extract');
                ?>
                    <tr>
                    <!-- <td><input type="checkbox" /></td> -->
                    <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class_name']?></td>
                    <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['capacity']?></td>
                    <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['grade'].' &deg;'?></td>
                    <!-- <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$userName['nombre'].' '.$userName['apellido']?></td> -->
                    <!-- <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['end_time']?></td> -->
                    <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                    <td class="text-center">
                    <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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
<div class="modal fade" id="formulario_nuevo" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" >  × </button><!-- aria-hidden="true"-->
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Clase</h3>
        </div>
         <form name="clases" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table  table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <div class="alert alert-danger mssg-add-clases">Todos los campos son necesarios</div>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre_add" type="text" class="form-control" id="nombre_add" placeholder="Nombre"></td>
                 </tr>

                 <tr>
                   <td width="30%">Capacidad <span class="symbol required"></span><br />
                    <small class="color-gray">Representa la cantidad de estudiantes que pueden pertenecer a esta clase.</small>
                  </td>
                   <td width="70%">
                   <input autofocus="" name="event_add_capacity" onchange="" type="number" class="form-control" id="event_add_capacity" pattern="[09]" onkeyup="if(value<0 || value==0) value=1;" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="Capacidad" step="1"  min="1" max="100" value="1">
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Grado <span class="symbol required"></span><br />
                   <small class="color-gray">Representa el nivel o grado.</small>
                  </td> 
                   <td width="70%">
                    <input autofocus="" name="event_add_grade" onchange="" type="number" class="form-control" id="event_add_grade" pattern="[09]" onkeyup="if(value<0 || value==0) value=1;" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="Grado" step="1"  min="1" max="100" value="1">
                    
                  </td>
                 </tr>

                 <tr class="hide">
                   <td width="30%">Maestro / Profesor <span class="symbol required"></span></td>
                   <td width="70%">
                   <select name="event_add_supervisor" id="event_add_supervisor">
                      <?php
                        if($selecUsers['resultado']){
                              echo '<option></option>';
                          foreach ($selecUsers['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id_usuario'].'">'.$value['nombre'].' '.$value['apellido'].'</option>';
                          }
                        }
                      ?>
                   </select>
                   <!-- <input autofocus="" name="event_add_supervisor"  type="text" class="form-control" id="event_add_supervisor" placeholder="Supervisor" maxlength="50" >-->
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
          <input type="button" class="btn btn-primary btn-add-class" id="agregar_clase" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- End Modal Add -->


<!-- Edit Modal -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Clase</h3>
</div>
      <form name="clases" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table  table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <div class="alert alert-danger mssg-edit-clases">Todos los campos son necesarios</div>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre_edit" type="text" class="form-control" id="nombre_edit" placeholder="Nombre">
                   <input maxlength="50" autofocus="" name="id_row" type="hidden" class="form-control" id="id_row"></td>
                 </tr>

                 <tr>
                   <td width="30%">Capacidad <span class="symbol required"></span>
                  </td>
                   <td width="70%">
                    <input autofocus="" name="event_edit_capacity" onchange="" type="number" class="form-control" id="event_edit_capacity" pattern="[09]" onkeyup="if(value<0 || value==0) value=1;" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="Capacidad" step="1"  min="1" max="100" value="1">
                    <small class="color-gray">Cantidad de personas que pueden pertenecer a esta clase.</small>
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Grado <span class="symbol required"></span></td> 
                   <td width="70%">
                    <input autofocus="" name="event_edit_grade" onchange="" type="number" class="form-control" id="event_edit_grade" pattern="[09]" onkeyup="if(value<0 || value==0) value=1;" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="Grado" step="1"  min="1" max="100" value="1">
                    <small class="color-gray">Representa el nivel o grado.</small>
                  </td>
                 </tr>

                 <tr class="hide">
                   <td width="30%">Profesor / Supervisor <span class="symbol required"></span></td>
                   <td width="70%">
                   <select name="event_edit_supervisor" id="event_edit_supervisor">
                      <?php
                        if($selecUsers['resultado']){
                              echo '<option></option>';
                          foreach ($selecUsers['resultado'] as $key => $value) {
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
          <input type="button" class="btn btn-primary btn-edit-class" id="modificar_clase" value="Modificar Datos">
          
        </div>
      </form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Modal -->

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

<!-- Assistant -->
<div class="modal fade  come-from-modal right" id="myAssistant" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Asistentess</h4>
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
 * Add
 */
$('.btn-add-class').on('click', ()=>{  
  let nombre      = $('#nombre_add').val();
  //let supervisor  = $('#event_add_supervisor').val();
  let cantidad    = $('#event_add_capacity').val();
  let grade       = $('#event_add_grade').val();
  let estado      = $('#event_estado_add').val();

  if ( nombre == '') {
    $(".mssg-add-clases").removeClass('alert-success').addClass('alert-danger').show().html('Los campos con (*) son necesarios.');
    //$('#nombre').focus();
    setTimeout(()=>{
      $(".mssg-add-clases").hide();
    },4000)
    return false
  }

  let route = "app/controllers/clases.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      add   : 1,
      nombre  : nombre,
      cantidad : cantidad,
      grado : grade,
      //superv: supervisor,
      estado: estado,
      cache : '<?php echo rand(99999,66666)?>'
    },
    dataType        : 'html',
    success         : function (response) { 
      
    if (response != "Ya existe este registro.") {
        $(".mssg-add-clases").removeClass('alert-danger').addClass('alert-success').show().html(response);
        console.log(response)
        limpiarCampos ();
        listClasses();
      } else {
        $('.mssg-add-clases').removeClass('alert-success').addClass('alert-danger').show().html(response);
      }
      setTimeout(() => {
        $(".mssg-add-clases").hide();
        //window.location.reload();
      }, 4000);
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
  let route = "app/controllers/clases.php";
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
      $('#nombre_edit').val(response['class_name']);
      $('#event_estado_edit').select2('val',response['activo']);
      $('#event_edit_capacity').val(response['capacity']);
      $('#event_edit_grade').val(response['grade']);
      $('#event_edit_supervisor').select2('val',response['supervisor_id']);
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


/** 
 * List All
 */
function listClasses() {

  let route = "app/controllers/clases.php";

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
      $('#tbody-table-clases').empty().append(response);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

/**
 * Delete
 */
function deleteRow ( id ) {
  let route = "app/controllers/clases.php"; 
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      del : 1,
      id  : id
    },
    dataType        : 'html',
    success         : function (response) { 
      $('#tbody-table-clases').empty().append(response);
      listClasses();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

/**
 * Datatable
 */
  $(document).ready( function () {
      $('#list-table-events').DataTable({
        pageLength: 25,
        "searching": true,              // Input Box Search
        "paging": true,                 // Ver Mostrar Paginas
        "info": true, 
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
        },{ width: "20%", targets: 0 },{ width: "10%", targets: 1, },{ width: "10%", targets: 2, } ,{ width: "10%", targets: 3 },{ width: "10%", targets: 4 }
      ]
      });
  } ); 


$('.close').on('click', ()=>{
  window.location.reload();
});
$('.btn-danger').on('click', ()=>{
  window.location.reload();
});


// Clean
function limpiarCampos (form = false) {

switch (form) {
  case 'add_clase':
    $("#nombre_add").val('');
  break;
  case "usuario_listar":
  default:
    break;
}
}

$("[name='event_class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_add_supervisor']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_edit_supervisor']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
