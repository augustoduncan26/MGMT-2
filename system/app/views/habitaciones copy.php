<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<style>
div.dataTables_wrapper div.dataTables_filter { text-align: left !important; }
table.dataTable.nowrap th, table.dataTable.nowrap td { white-space: normal !important;} 
div#list-table-rooms_length.dataTables_length { width: 50% !important;}
.dataTables_filter { float: left !important; }
.dataTables_length { float: right !important; }
.dataTables_length label {  margin: 0px 20px 0px 0px !important; width: 90% !important; display: flex; justify-content: flex-end;}
.dataTables_length select { margin-left: 10px; margin-right: 10px}
div.dataTables_wrapper div.dataTables_filter input { width: 300px !important; }
td.details-control { text-align: center; cursor: pointer;}
tr.shown td.details-control { text-align: center; background-color: white !important;}
</style>

<body onload="$('#cargando_add').hide()">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nueva Habitación</a>
   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-checkbox-partial"></i>Administrar Habitacions
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

                <div class="x_content">
                <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
                <div id="list-rooms"></div>
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

<!-- Modal Add Room -->
<?php get_view_part ( 'agregar-habitacion' )?>
<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Edit Room -->
  <div class="modal fade" id="edit_room" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Habitación</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
       <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateRoom(id_row)">Modificar datos</button>
          
      </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->

<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- <script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="assets/js/table-data.js"></script> -->
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>


    <script>
// List all room
function listRoom() {

var id_user     = '<?php echo $_SESSION["id_user"]?>';
var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

var contenido_editor = $('#list-rooms')[0];
$('.fa-spinner').show()
ajax1   = nuevoAjax();
ajax1.open("GET", "ajax/ajax_list_room.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
ajax1.onreadystatechange=function() {

  if (ajax1.readyState==4) {
    contenido_editor.innerHTML = ajax1.responseText;
    $('.fa-spinner').hide();
    $('#list-table-rooms').dataTable({aaSorting : [[0, 'desc']]});
  }
}

ajax1.send(null);
}

// Add room
function addRoom () {

  var nombre      =   $('#nombre').val();
  var tipo        =   $('#tipo').val();
  var total_beds  =   $('#total_beds').val();
  var precio      =   $('#precio').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1 || tipo.length < 1 || total_beds < 1 || precio.length < 1 ) {
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    $('#nombre').css({'border-color': '#007AFF'});
    $('#tipo').css({'border-color': '#007AFF'});
    $('#total_beds').css({'border-color': '#007AFF'});
    $('#precio').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/habitaciones.php?add=1&tipo="+tipo+"&nombre="+nombre+"&total_beds="+total_beds+"&precio="+precio+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      //$('#cargando_add').hide();
      listRoom();
      $('#nombre').val('');
      $('#tipo').val('');
      $('#total_beds').val('');
      $('#precio').val('');
    }
  }

  ajax2.send(null);

}

// Update data of type Room
function updateRoom ( id ) {

  var   nombre        = $('#txt_nombre').val();
  var   tipo          = $('#txt_tipo').val();
  var   total_beds    = $('#txt_total_beds').val();
  var   precio        = $('#txt_precio').val();
  var   activo        = $('#txt_activo').val();
  var   cleaning      = $('#txt_cleaning').val();
  var   id            = $('#id_row').val();
  //alert("nombre: " +nombre+ " , codigo: " +codigo+ ", capacidad:  " +capacidad+ ", capacidad_max: "+capacidad_max+", estado: "+estado)
    if( nombre=='' || tipo=='' || total_beds=='' || precio=='') {
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_tipo').css({'border-color': '#007AFF'});
    $('#txt_total_beds').css({'border-color': '#007AFF'});
    $('#txt_precio').css({'border-color': '#007AFF'});
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/habitaciones.php?edit=1&tipo="+tipo+"&nombre="+nombre+"&total_beds="+total_beds+"&precio="+precio+"&cleaning="+cleaning+"&id="+id+"&activo="+activo+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);
      listRoom();
    }
  }

  ajax2.send(null);

}

// Edit Room
function editRoom ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-room')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-habitacion.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}

listRoom();

// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/habitaciones.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listRoom();
    }
  }

  ajax2.send(null);
}

function limpiar () { 
  $('#mssg-label').html('');
  $('#txt_mssg-label').html('');
}

// Make some default options
$("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
$("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});


$(document).ajaxStop(function() { 
    $("#list-table-rooms").dataTable().fnDestroy();
    $('#list-table-rooms').DataTable({
        // columnDefs: [
        //     { width: "40%", targets: 6 }
        // ],
        // fixedColumns: true,
        "columnDefs": [{
        "orderable": false,
        "targets": 3
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
        lengthMenu: [10, 50, 100, 500, 1000],
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
//$("#list-table-events").modal({"backdrop": "static"});
jQuery(document).ready(function() {
    //Main.init();
    //FormElements.init();
    //FormValidator.init();
    //UIElements.init();
    //TableData.init();
  //$('#list-table-rooms').dataTable({aaSorting : [[3, 'asc']]});
});
</script>

 </body>
