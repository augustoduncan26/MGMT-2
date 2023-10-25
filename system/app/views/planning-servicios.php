
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />

<script>

// Add room
function addService () {

  var nombre      =   $('#nombre').val();
  var detalle     =   $('#detalle').val();
  var precio      =   $('#precio').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1) {
    $('#mssg-label').html('Estos campos son necesarios.');
    $('#nombre').css({'border-color': '#007AFF'});
    $('#detalle').css({'border-color': '#007AFF'});
    $('#precio').css({'border-color': '#007AFF'});

    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-servicios.php?add=1&detalle="+detalle+"&nombre="+nombre+"&precio="+precio+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) { 
      $('#mssg-label').html(ajax2.responseText);

      listService();
      $('#nombre').val('');
      $('#detalle').val('');
    }
  }

  ajax2.send(null);

}

// Update data of type Service
function updateServicio ( id ) {

  var   nombre        = $('#nombre_editar').val();
  var   detalle       = $('#detalle_editar').val();
  var   precio        = $('#precio_editar').val();
  var   estado        = $('#estado_editar').val();
  var   id            = $('#id_row').val();


    if( nombre == '' || detalle == '') {
    $('#txt_mssg-label').html('Estos campos son necesarios.');
    $('#nombre_editar').css({'border-color': '#007AFF'});
    $('#detalle_editar').css({'border-color': '#007AFF'});

    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-servicios.php?edit=1&nombre="+nombre+"&id="+id+"&estado="+estado+"&detalle="+detalle+"&precio="+precio+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);
      listService();
    }
  }

  ajax2.send(null);

}


// Edit Service
function editServicio ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-booker')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-servicios.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}


// List all Bookers
function listService() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_services.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}

function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-servicios.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listService();
    }
  }

  ajax2.send(null);
}

function limpiar () {

}

</script>

<body onload="listService();">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3>Servicios</h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
    <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Servicio</a>

    <div style="height:10px;"></div>

      <div class="x_content">

        <div id="list-rooms"></div>

      </div>
    </div>
  </div>
</div>

 <div class="clearfix"></div>

<!-- Modal Add Room -->
<?php get_view_part ( 'agregar-servicio' )?>
<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->


<!-- Edit Room -->
  <div class="modal fade" id="edit_servicio" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title">Editar Servicio</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-booker">
        Cargando...
      </div>
       <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_servicio" onClick="var id_row = $('#id_row').val(); updateServicio(id_row)">Modificar</button>
          
      </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->


<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="../assets/js/table-data.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->



<script>
      jQuery(document).ready(function() {
    Main.init();
    FormElements.init();
    //UIElements.init();
    //TableData.init();
    $('#list-table-room').dataTable({aaSorting : [[3, 'asc']]});
  });
    </script>
<script>
// $('#formulario_nuevo').on('hidden.bs.modal', function() {
//   this.modal('show');
// });

$("#list-table-room").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();
</script>

 </body>
