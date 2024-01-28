<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />


<body onload="$('#cargando_add').hide()">

<div class="row view-container">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="mssg-window"><?=$mssg?></label>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Parámetro</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();"><i class="clip-download-3"></i> Exportar</a>
      </div>
    </div>
    
    

   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i>Administrar Otros Parámetros
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

               <div class="x_content">
               <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
               <div id="list-rows"></div>
              </div>
            </div>
          </div>
       </div>
      </div>
    </div>
  </div>
</div>
</div>

 <div class="clearfix"></div>

<!-- Modal Add Rows -->
<div class="modal fade" id="formulario_nuevo" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Tipo de Horario</h3>
        </div>
         <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div id="mssg-alert" style="color:red;"></div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Formato Horario</td>
                   <td colspan="3">
                    <select id="formato_horario" name="formato_horario">
                      <option value="12">12 horas</option>
                      <option value="24">24 horas</option>
                    </select>
                   </td>
                 </tr>
                 <tr class="formato-24">
                   <td width="20%">Hora desde <span class="symbol required"></span></td>
                   <td width="30%">
                      <input maxlength="50" autofocus="" name="hora_desde_24" type="time" class="form-control" id="hora_desde_24" placeholder="Nombre">
                    </td>
                   <td width="20%">Hora hasta <span class="symbol required"></span></td>
                   <td width="30%">
                    <input maxlength="50" autofocus="" name="hora_hasta_24" type="time" class="form-control" id="hora_hasta_24" placeholder="Nombre">
                  </td>
                 </tr>
                 <tr class="formato-12">
                   <td width="20%">Hora desde <span class="symbol required"></span></td>
                   <td width="30%">
                      <input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" autocomplete="off" autofocus="" name="hora_desde_12" type="text" class="form-control" id="hora_desde_12" placeholder="Ej: 06:00">
                    </td>
                   <td width="20%">Hora hasta <span class="symbol required"></span></td>
                   <td width="30%">
                    <input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" autocomplete="off" autofocus="" name="hora_hasta_12" type="text" class="form-control" id="hora_hasta_12" placeholder="Ej: 2:00">
                  </td>
                 </tr>
                 <tr><td colspan="4" style="color:red" class="text-center"><small><label class="label-formato-12">Ejemplo: [6:00 - 2:00] , [10:00 - 6:00], [8:00 - 8:00]</label> <label class="label-formato-24">Ejemplo: [06:00 - 14:00] , [10:00 - 14:00], [08:00 - 20:00]</label></small></td>
                </tr>
                 <tr>
                   <td>Estado</td>
                   <td colspan="3">
                    <select name="estado_horario"  class="" id="estado_horario">
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
          <input name="agregar_habitacion" type="button" class="btn btn-primary" onClick="addRows()" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- End Add Direcctions -->

<!-- Edit Direcctions -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Tipo Horario</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 <div id="mssg-edit" style="color:red;"></div>
    <table class="table table-bordered table-hover" id="sample-table-4">
      <thead>
      </thead>
      <tbody>
      <tr>
        <td width="30%">Formato Horario</td>
        <td colspan="3">
        <select id="formato_horario_edit" name="formato_horario_edit">
          <option value="12">12 horas</option>
          <option value="24">24 horas</option>
        </select>
        </td>
      </tr>
      <tr class="formato-24">
        <td width="20%">Hora desde <span class="symbol required"></span></td>
        <td width="30%">
          <input maxlength="50" autofocus="" name="hora_desde_edit_24" type="time" class="form-control" id="hora_desde_edit_24" placeholder="Ej: 06:00">
        </td>
        <td width="20%">Hora hasta <span class="symbol required"></span></td>
        <td width="30%">
        <input maxlength="50" autofocus="" name="hora_hasta_edit_24" type="time" class="form-control" id="hora_hasta_edit_24" placeholder="Ej: 14:00">
      </td>
      </tr>
      <tr class="formato-12">
        <td width="20%">Hora desde <span class="symbol required"></span></td>
        <td width="30%">
          <input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" autocomplete="off" autofocus="" name="hora_desde_edit_12" type="text" class="form-control" id="hora_desde_edit_12" placeholder="Ej: 06:00">
        </td>
        <td width="20%">Hora hasta <span class="symbol required"></span></td>
        <td width="30%">
        <input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" autocomplete="off" autofocus="" name="hora_hasta_edit_12" type="text" class="form-control" id="hora_hasta_edit_12" placeholder="Ej: 2:00">
      </td>
      </tr>
      <tr><td colspan="4" style="color:red" class="text-center"><small><label class="label-formato-12">Ejemplo: [6:00 - 2:00] , [10:00 - 6:00], [8:00 - 8:00]</label> <label class="label-formato-24">Ejemplo: [06:00 - 14:00] , [10:00 - 14:00], [08:00 - 20:00]</label></small></td></tr>
      <tr>
        <td>Estado</td>
        <td colspan="3">
        <select name="estado_horario_edit"  class="" id="estado_horario_edit">
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
      <input name="agregar_habitacion" type="button" class="btn btn-primary" onClick="var id_row = $('#id_row').val(); updateRow(id_row)" value="Modificar datos">
</div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Events -->

<?php get_template_part('footer_scripts');?>

<script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>
  
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

/** Select all areas */
$('.formato-24').hide();
$('.label-formato-24').hide();
$("#formato_horario").on("select2:select", function (e) { 
  var select_val = $(e.currentTarget).val();
  if($(this).val()=="12"){
      $('.formato-12').show();
      $('.label-formato-12').show();
      $('.formato-24').hide();
      $('.label-formato-24').hide();
    } else {
      $('.formato-12').hide();
      $('.label-formato-12').hide();
      $('.formato-24').show();
      $('.label-formato-24').show();
    }
});

// $(".seleccionar-todas-areas-2").click(function(){
//     if($(".seleccionar-todas-areas-2").is(':checked') ){
//         $("#txt_areas > option").prop("selected","selected");
//         $("#txt_areas").trigger("change");
//     } else {
//         $("#txt_areas").val(null).trigger('change');
//     }
// });


/** List rows */
const listResultTable = () => {
  var id_user   = '<?php echo $_SESSION["id_user"]?>';
  var id_cia    = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  var contenido_editor = $('#list-rows')[0];
  let route = "ajax/ajax_list_tipos_horarios.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id_user : id_user,
      id_cia  : id_cia,
    },
    dataType        : 'html',
    success         : function (response) { 
      contenido_editor.innerHTML = response;
      $('.fa-spinner').hide();
      loadDataTable()
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

listResultTable();

// Add Row
function addRows () {
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  
  //let nombre      = $('#tipo_nombre').val();
  let formato     = $('#formato_horario').val();
  let hora_desde12  = $('#hora_desde_12').val();
  let hora_hasta12  = $('#hora_hasta_12').val();
  let hora_desde24  = $('#hora_desde_24').val();
  let hora_hasta24  = $('#hora_hasta_24').val();
  let estado      = $('#estado_horario').val();
  let hora_desde;
  let hora_hasta;

 
  // if ( nombre == '') {
  //   $("#mssg-alert").show().html('Los campos con (*) son necesarios');
  //   return false
  // }

  if ( formato=='12') {
    if (hora_desde12 == '' || hora_hasta12 == '') {
      $("#mssg-alert").html('Los campos con (*) son necesarios');
      return false
    } else {
      hora_desde = hora_desde12;
      hora_hasta = hora_hasta12;
    }
  }
  if ( formato=='24') {
    if (hora_desde24 == '' || hora_hasta24 == '') {
      $("#mssg-alert").show().html('Los campos con (*) son necesarios');
      return false
    } else {
      hora_desde = hora_desde24;
      hora_hasta = hora_hasta24;
    }
  }

  let route = "app/controllers/mante-tipos-horarios.php"; //?add=1&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
        add       : 1,
        formato   : formato,
        hora_desde: hora_desde,
        hora_hasta: hora_hasta,
        estado    : estado
    },
    dataType        : 'html',
    success         : function (response) { 
      $("#mssg-alert").html(response);
      $('.fa-spinner').hide();
      listResultTable();
      setTimeout(() => {
        $("#mssg-alert").hide();
        //$(".alert-danger").hide();
      }, 3000);
  
      if (formato=='12') {
        $("#hora_desde_12").val('');
        $("#hora_hasta_12").val('');
      }
      if (formato=='24') {
        $("#hora_desde_24").val('');
        $("#hora_hasta_24").val('');
      }
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Show Edit Modal
function editRow ( id ) {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  var contenido_editor = $('#contenido_editar')[0];

  let route = "app/controllers/mante-tipos-horarios.php?showEdit=1&id="+id+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: "",
    dataType        : 'json',
    success         : function (response) { 
      $('#tipo_nombre_edit').select2('val',response['grupo']);
      $('#hora_desde_edit').val(response['hora_desde']);
      $('#hora_hasta_edit').val(response['hora_hasta']);
      $('#id_row').val(response['id']);
      //$('#departamento_horario_edit').select2('val',response['id_depto']);
      //$('#area_horario_edit').select2('val',response['id_area']);
      $('#estado_horario_edit').val(response['active']);
    },
    error           : function (error) {
      console.log(error);
    }
  });

}

// Update Row
function updateRow ( id ) {
  
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  var grupo       = $('#grupo_horario_edit').val();
  var hora_desde  = $('#hora_desde_edit').val();
  var hora_hasta  = $('#hora_hasta_edit').val();
  var id_depto    = $('#departamento_horario_edit').val();
  var id_area     = $('#area_horario_edit').val();
  var estado      = $('#estado_horario_edit').val();

  let route = "app/controllers/mante-tipos-horarios.php?edit=1&id="+id+"&grupo="+grupo+"&hora_desde="+hora_desde+"&hora_hasta="+hora_hasta+"&id_depto="+id_depto+"&id_area="+id_area+"&activo="+estado+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
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
      if (response == 'OK') {
        $("#mssg-edit").html('<div class="alert alert-success">Los datos fueron actualizados con éxito.</div>');
        listResultTable();
      }
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Delete Row
function deleteRow ( id ) {
  let route = "app/controllers/mante-tipos-horarios.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
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
        $('html, body').animate({scrollTop: '0px'},'slow');
        //$('.mssg-window').show().html("Se ha eliminado el registros con éxito.");
        listResultTable();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Make some default options
//$("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
//$("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});

//$(document).ajaxStop(function() { 
let loadDataTable = () => {
setTimeout(() => {
    $("#list-table-direcciones").dataTable().fnDestroy();
    $('#list-table-direcciones').DataTable({
        // columnDefs: [
        //     { width: "2%", targets: 0 }
        // ],
        // fixedColumns: true,
        "columnDefs": [{
        "orderable": false,
        "targets": [4]
        }],
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
        "infoFiltered": "(Filtrado de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "searchPlaceholder": "Buscar",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
        order: [0, 'desc'],
        dom: "<'row'<'col-sm-12 col-md-6'f>" +
        "<'col-sm-12 col-md-6'<'row m-0 float-right'<'col-md-auto'l>>>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [20, 30, 50, 100, 500],
        processing: "Procesando...",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
    });
});
}

$("[name='grupo_horario']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='departamento_horario']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='area_horario']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_horario']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='formato_horario']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='grupo_horario_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='departamento_horario_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#areas").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_horario_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>