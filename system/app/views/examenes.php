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
      <h4><i class="clip-calendar-3"></i> Lista de Exámenes</h4>
      </div>
      <div class="col-md-5 text-right">
      <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Exámen</a>
      <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
      <a data-toggle="modal" class="btn btn-success"  role="button" href="#"><i class="clip-download-3"></i> Importar</a>
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
              <th>Clase</th> 
              <th>Fecha</th>
              <th>Hora Inicio</th> 
              <th>Hora Fin</th>
              <th>Estado</th>
              <th></th>
              </tr>
              </thead>
              <tbody>
              <?php
              if ($sel1['resultado']){
              foreach ($sel1['resultado'] as $datos) {
              ?>
              <tr>
              <!-- <td><input type="checkbox" /></td> -->
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['class']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['start_time']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['end_time']?></td>
              <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
              <td class="text-center" style="width:10% !important;">
              <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editEvent('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a>
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
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Evento</h3>
        </div>
         <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div id="mssg-add-eventos" style="color:red;"></div>
             <!-- <img src="images/ajax-loader.gif" id="cargando_add" /> -->
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <div class="alert alert-danger">Todos los campos son necesarios</div>
                 <tr>
                   <td width="30%">Nombre <!--<span class="symbol required"></span>--></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>

                 <tr>
                   <td width="30%">Clase <span class="symbol required"></span></td>
                   <td width="70%">
                    <select name="event_class_add">

                    </select>
                   </td>
                 </tr>

                 <tr>
                   <td width="30%">Fecha [mes/dia/año] <!--<span class="symbol required"></span>--></td> 
                   <td width="70%"><input autofocus="" name="event_add_date" onchange="" type="date" class="form-control" id="event_add_date" placeholder="Fecha"  min="03/06/2025"></td>
                 </tr>

                 <tr>
                   <td width="30%">Hora Inicio <!--<span class="symbol required"></span>--></td>
                   <td width="70%"><input autofocus="" name="event_add_date_ini"  type="time" class="form-control" id="event_add_date_ini" placeholder="Hora de Inicio" ></td>
                 </tr>

                 <tr>
                   <td width="30%">Hora Fin <!--<span class="symbol required"></span>--></td>
                   <td width="70%"><input autofocus="" name="event_add_date_fin" type="time" class="form-control" id="event_add_date_fin" placeholder="Hora Final"></td>
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
          <input name="agregar_habitacion" type="button" class="btn btn-primary" id="agregar_evento" onClick="addEvent()" value="Guardar datos">
          
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
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Evento</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
Cargando contenidos...
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

var today = new Date().toISOString().slice(0, 10);
document.getElementsByName("event_add_date")[0].min = today;

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

// const listEventsResult = () => {
//   var id_user     = '<?php echo $_SESSION["id_user"]?>';
//   var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
//   $('.fa-spinner').show();
//   var contenido_editor = $('#list-events')[0];
//   let route = "ajax/ajax_list_events.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
//   $.ajax({
//     headers: {
//       Accept        : "application/json; charset=utf-8",
//       "Content-Type": "application/json: charset=utf-8"
//     },
//     url: route,
//     type: "GET",
//     data: "",
//     dataType        : 'html',
//     success         : function (response) { 
//       contenido_editor.innerHTML = response;
//       $('.fa-spinner').hide();
//       //loadDataTable()
//     },
//     error           : function (error) {
//       console.log(error);
//     }
//   });
// }

//listEventsResult();

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

// Add Event
function addEvent () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  
  var nombre      = $('#nombre').val();
  var precio      = $('#precio').val();
  var estado      = $('#estado').val();

  if ( nombre == '' || precio.length < 1 ) {
    $("#mssg-add-eventos").html('Los campos con (*) son necesarios');
    $('#nombre').focus();
    return false
  }

  let route = "app/controllers/eventos.php?add=1&nombre="+nombre+"&precio="+precio+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: "",
    dataType        : 'html',
    success         : function (response) { 
      //contenido_editor.innerHTML = response;
      $("#mssg-add-eventos").html(response);
      $('.fa-spinner').hide();
      listEvents();
      setTimeout(() => {
        $(".alert-exito").hide();
        $(".alert-danger").hide();
      }, 3000);
  
      $("#nombre").val('');
      $("#precio").val('');
      $("#nombre").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Edit Event
function editEvent ( id ) {
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
      targets: 6,
      orderable: false
      },{ width: "20%", targets: 0 },{ width: "20%", targets: 1, },{ width: "10%", targets: 2, } ,{ width: "10%", targets: 3 }
    ]
    });
} );


$("[name='event_class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_estado_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
