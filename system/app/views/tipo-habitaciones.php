<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

<body onload="listRoom();">

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
    <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#mssg-label').html('');$('#mssg-label').hide();$('#nombre').focus();">[+] Nuevo Tipo de Habitación</a>
  <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-checkbox-partial"></i> Administrar tipo de habitación
          </div>
          <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>
              <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
                  <div class="x_content">

                    <div id="list-rooms" class="size-font-in-table"></div>

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
<?php get_view_part ( 'agregar-tipo-habitacion' )?>
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
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Tipo de Habitación</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
      <tfoot>
      <div class="modal-footer">
        <!-- <input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar"> -->
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateRoom(id_row)">Modificar datos</button>
        
    </div>
   </tfoot>
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

function validateFields() {
	var nombre 			   =	$('#nombre').val();
	var codigo 			   =	$('#codigo').val();
	var capacidad 		 =	$('#capacidad').val();
	var capacidad_max  =	$('#capacidad_max').val();
	var estado	 		   =	$('#estado').val();

	if( nombre.length < 1 || codigo.length < 1 || capacidad.length < 1 || capacidad_max.length < 1) {
		return false;
	}
}

// Add room
function addTipoRoom () {
	var nombre 			  =	$('#nombre').val();
	var codigo 			  =	$('#codigo').val();
	var capacidad 		=	$('#capacidad').val();
	var capacidad_max =	$('#capacidad_max').val();
	var estado	 		  =	$('#estado').val();
  $('#mssg-label').show();

	if ( validateFields() == false) {
		$('#mssg-label').html('Los campos con (*) son necesarios');
		return false;
	}

  let route = "app/controllers/tipo-habitaciones.php?add=1&codigo="+codigo+"&nombre="+nombre+"&capacidad="+capacidad+"&capacidad_max="+capacidad_max+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url       : route,
    type      : "GET",
    data      : "",
    dataType  : 'html',
    success   : function (response) { 
      $('#mssg-label').html(response);
    	listRoom();
    	$('#nombre').val('');
    	$('#codigo').val('');
    	$('#capacidad').val('');
    	$('#capacidad_max').val('');
    },
    error           : function (error) {
      console.log(error);
    }
  });


	// ajax2   = nuevoAjax();
  // 	ajax2.open("GET", "app/controllers/tipo-habitaciones.php?add=1&codigo="+codigo+"&nombre="+nombre+"&capacidad="+capacidad+"&capacidad_max="+capacidad_max+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
  // 	ajax2.onreadystatechange=function() {

  //   if (ajax2.readyState==4) {
  //   	$('#mssg-label').html(ajax2.responseText);
  //   	listRoom();
  //   	$('#nombre').val('');
  //   	$('#codigo').val('');
  //   	$('#capacidad').val('');
  //   	$('#capacidad_max').val('');
  //   }
  // }

  // ajax2.send(null);


}

// Update data of type Room
function updateRoom ( id ) {

  var 	nombre 			=	$('#txt_nombre').val();
  var 	codigo 			=	$('#txt_codigo').val();
  var 	capacidad 		=	$('#txt_capacidad').val();
  var 	capacidad_max 	=	$('#txt_capacidad_max').val();
  var 	estado	 		=	$('#txt_activo').val();
  var 	id	 			=	$('#id_row').val();
  //alert("nombre: " +nombre+ " , codigo: " +codigo+ ", capacidad:  " +capacidad+ ", capacidad_max: "+capacidad_max+", estado: "+estado)
  	if( nombre=='' || codigo=='' || capacidad=='' || capacidad_max=='') {
		$('#txt_mssg-label').html('Estos campos son necesarios.');
		$('#txt_nombre').css({'border-color': '#007AFF'});
		$('#txt_codigo').css({'border-color': '#007AFF'});
		$('#txt_capacidad').css({'border-color': '#007AFF'});
		$('#txt_capacidad_max').css({'border-color': '#007AFF'});
		return false;
	}

	ajax2   = nuevoAjax();
  	ajax2.open("GET", "app/controllers/tipo-habitaciones.php?edit=1&codigo="+codigo+"&nombre="+nombre+"&capacidad="+capacidad+"&capacidad_max="+capacidad_max+"&id="+id+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
  	ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
    	$('#txt_mssg-label').html(ajax2.responseText);
    	listRoom();
    	$('#nombre').val('');
    	$('#codigo').val('');
    	$('#capacidad').val('');
    	$('#capacidad_max').val('');
    }
  }

  ajax2.send(null);

}

// Edit Room
function editRoom ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-room')[0];

  let route = "ajax/ajax_modificar-tipo-habitacion.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url       : route,
    type      : "GET",
    data      : "",
    dataType  : 'html',
    success   : function (response) { 
      contenido_editor.innerHTML = response;
    },
    error           : function (error) {
      console.log(error);
    }
  });


  // ajax2   = nuevoAjax();
  // ajax2.open("GET", "ajax/ajax_modificar-tipo-habitacion.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  // ajax2.onreadystatechange=function() {

  //   if (ajax2.readyState==4) {
  //     contenido_editor.innerHTML = ajax2.responseText;
  //   }
  // }
  // ajax2.send(null);

}


// List all room
function listRoom() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show();

  let route = "ajax/ajax_list_type_room.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url       : route,
    type      : "GET",
    data      : "",
    dataType  : 'html',
    success   : function (response) { 
      contenido_editor.innerHTML = response;
      loadDataTable();
      $('.fa-spinner').hide();
    },
    error           : function (error) {
      console.log(error);
    }
  });


  // ajax1   = nuevoAjax();
  // ajax1.open("GET", "ajax/ajax_list_type_room.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  // ajax1.onreadystatechange=function() {

  //   if (ajax1.readyState==4) {
  //     contenido_editor.innerHTML = ajax1.responseText;
  //     loadDataTable();
  //     $('.fa-spinner').hide();
  //     //$('#cargando_list').hide();
  //     //$('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
  //   }
  // }

  // ajax1.send(null);
}


function deleteRow ( id ) {

  let route = "app/controllers/tipo-habitaciones.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url       : route,
    type      : "GET",
    data      : "",
    dataType  : 'html',
    success   : function (response) { 
      $('html, body').animate({scrollTop: '0px'},'slow');
      $('#label-mssg').html(response);
      listRoom();
      if ($('.alert-danger').is(':visible')) {
        setTimeout(() => {
          $('.alert-danger').html('');
          $('.alert-danger').hide();
        }, 4000);
      }
    },
    error           : function (error) {
      console.log(error);
    }
  });

  //   ajax2   = nuevoAjax();
  //   ajax2.open("GET", "app/controllers/tipo-habitaciones.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
  //   ajax2.onreadystatechange=function() {

  //   if (ajax2.readyState==4) {
  //     $('#label-mssg').html(ajax2.responseText);
  //     listRoom();
  //     if ($('.alert-danger').is(':visible')) {
  //       setTimeout(() => {
  //         $('.alert-danger').html('');
  //         $('.alert-danger').hide();
  //       }, 4000);
  //     }
  //   }
  // }

  // ajax2.send(null);

}


// let loadDataTable = () => {
// setTimeout(() => {
//   //$(document).ajaxStop(function() { 
//     $("#list-table-room").dataTable().fnDestroy();
//     let table = $('#list-table-room').DataTable({
//         // columnDefs: [
//         //     { width: "40%", targets: 6 }
//         // ],
//         // fixedColumns: true,
//         "columnDefs": [{
//         "orderable": false,
//         "targets": [5]
//         }],
//         language: {
//           "decimal": "",
//           "emptyTable": "No hay información",
//           "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//           "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
//           "infoFiltered": "(Filtrado de _MAX_ total registros)",
//           "infoPostFix": "",
//           "thousands": ",",
//           "lengthMenu": "Mostrar _MENU_ registros",
//           "loadingRecords": "Cargando...",
//           "processing": "Procesando...",
//           "search": "",
//           "searchPlaceholder": "Buscar",
//           "zeroRecords": "Sin resultados encontrados",
//           "paginate": {
//               "first": "Primero",
//               "last": "Ultimo",
//               "next": "Siguiente",
//               "previous": "Anterior"
//           }
//         },
//         //fixedHeader: true,
//         order: [0, 'desc'],
//         dom: "<'row'<'col-sm-12 col-md-6'f>" +
//         "<'col-sm-12 col-md-6'<'row m-0 float-right'<'col-md-auto'l>>>>" +
//         "<'row'<'col-sm-12'tr>>" +
//         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
//         lengthMenu: [20, 30, 50, 100, 500],
//         processing: "Procesando...",
//         "zeroRecords": "No se encontraron resultados",
//         "emptyTable": "Ningún dato disponible en esta tabla",
//         "search": "Buscar:",
//         "infoThousands": ",",
//         "loadingRecords": "Cargando...",
//         "paginate": {
//             "first": "Primero",
//             "last": "Último",
//             "next": "Siguiente",
//             "previous": "Anterior"
//         },
//     //});
// });
// }, 300);
// };

jQuery(document).ready(function() {
  //   Main.init();
  //   FormElements.init();
  //   //FormValidator.init();
  //   UIElements.init();
  //   //TableData.init();
  // //TableData.init();
  // $('#list-table-room').dataTable({aaSorting : [[3, 'asc']]});
});
 //$("#list-table-room").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();
</script>
<script id='name-table' src="assets/js/datatable-design.js?name=rooms"></script>
