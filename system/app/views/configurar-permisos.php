<?php
   //echo $_REQUEST['c'] = 'inline';
?>
<?php /* ?>
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="../assets/plugins/select2/select2.css">
		<link rel="stylesheet" href="../assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css">
		<link rel="stylesheet" href="../assets/plugins/x-editable/css/bootstrap-editable.css">
		<link rel="stylesheet" href="../assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap.css">
		<link rel="stylesheet" href="../assets/plugins/jquery-address/address.css">
		<link rel="stylesheet" href="../assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css">
		<link rel="stylesheet" href="../assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<?php */ ?>

<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

<body onload="listPermisos()">
	
<div class="">
<h3></h3>

 <div class="clearfix"></div>
 <label id="label-mssg"><?=$mssg?></label>
<!--  <div class="ln_solid"></div> -->

<a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Permiso</a>	
<br />
  <!-- end: PAGE HEADER -->
  <!-- start: PAGE CONTENT -->
  <div class="row">
    <div class="col-sm-12">
      <!-- start: FULL CALENDAR PANEL -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="clip-settings"></i>Permisos
          </div>
	         <div class="panel-body">
            <br />
           <!-- <img src="images/ajax-loader.gif" id="cargando_list" /> -->
           <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
			     <div id="list-rooms"></div>
		    </div>
      </div>
      <!-- end: FULL CALENDAR PANEL -->
    </div>
  </div>
  <!-- end: PAGE CONTENT-->
</div>
<!-- End Permisos -->


<!-- Modal Add Permission -->
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Permiso</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre_permiso" required="" type="text" class="form-control" id="nombre_permiso" placeholder="Nombre Permiso"></td>
                 </tr>
                 <tr>
                   <td>Permiso padre <span class="symbol required"></td>
                   <td><input name="permiso_padre" type="number" required="" min="1" step="1" class="form-control" id="permiso_padre" value="1" placeholder="Número de permiso">
                   </td>
                 </tr>
                 <tr>
                   <td>Permiso <span class="symbol required"></td>
                   <td><input name="permiso" type="number" required="" min="1" step="1" class="form-control" id="permiso" value="1" placeholder="Número de permiso">
                   </td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <!--<input name="agregar_habitacion" type="submit" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()" value="Agregar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button  type="button" class="btn btn-primary" id="agregar_permisos" onClick="addPermiso()">Guardar datos</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- /End Modal Add -->


<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_permiso" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="<?php echo "modal-dialog "; ?>">
    <div class="modal-content ">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
    &times;
    </button>
    <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Permiso</h3>
    <label id="txt_mssg-label"></label>
    </div>
    <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
     <div class="modal-body" id="contenido_editar">
    Cargando ...
    </div>
     <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_habitacion" type="button" class="btn btn-primary" id="editar_permiso" onClick="var id_row = $('#id_row').val(); updatePermiso(id_row)" value="Modificar datos">
    </div>
    </form>
    </div>
  </div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Room -->


<?php get_template_part('footer_scripts');?>


    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="../assets/js/table-data.js"></script> -->
    <script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>
   
    <script src="assets/js/datatable-config.js"></script>

 </body>

 <script>

$(function(){
  
   //defaults
   $.fn.editable.defaults.url = '/post'; 
 var c = window.location.href.match(/c=inline/i) ? 'inline' : 'popup';
            $.fn.editable.defaults.mode = c === 'inline' ? 'inline' : 'popup';

    //enable / disable
   $('#enable').click(function() {
       $('#user .editable').editable('toggleDisabled');
   });    
    
    //editables 
    $('#username').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'username',
           title: 'Enter username'
    });
    
    $('#firstname').editable({
        validate: function(value) {
           if($.trim(value) == '') return 'This field is required';
        }
    });
  });


// Add Permiso
function addPermiso () {

  var nombre      =   $('#nombre_permiso').val();
  var permiso      =   $('#permiso').val();
  var permiso_padre = $('#permiso_padre').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1 || permiso.length < 1 || permiso_padre.length < 1) {
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    $('#nombre_permiso').css({'border-color': '#007AFF'});
    $('#permiso').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?add=1&permiso="+permiso+"&permiso_padre="+permiso_padre+"&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      //$('#cargando_add').hide();
      listPermisos();
      $('#nombre_permiso').val('');
      $('#permiso').val('');
      $('#permiso_padre').val('');
    }
  }

  ajax2.send(null);

}

// Update data of type Room
function updatePermiso ( id ) {

  var   nombre        = $('#txt_nombre').val();
  var   permiso_padre = $('#txt_permiso_padre').val();
  var   permiso       = $('#txt_permiso').val();
  var   activo        = $('#txt_estado').val();
  var   id            = $('#id_row').val();

  if( nombre=='' || permiso=='' || permiso_padre=='') {
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_permiso').css({'border-color': '#007AFF'});
    $('#txt_permiso_padre').css({'border-color': '#007AFF'});
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?edit=1&permiso="+permiso+"&permiso_padre="+permiso_padre+"&activo="+activo+"&nombre="+nombre+"&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);
      listPermisos();
    }
  }

  ajax2.send(null);

}

// Edit Permiso
function editPermiso ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#contenido_editar')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-permiso.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}


// List permisos
function listPermisos() {   

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_permisos.php?id_user="+id_user+"&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>",true);    
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide()
      //$('#list-table-permisos').dataTable({aaSorting : [[0, 'asc']]});
      let setting = [];
      setting['ordering'] = 1;
      setting['orderingFormat'] = 'asc';
      setting['notorder'] = [4];
      setting['totalpages'] = [20, 30, 50, 100, 250];
      loadDataTable('list-table-permisos',setting);
    }
  }

  ajax1.send(null);
}

// Delete row
function deletePermiso ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listPermisos();
    }
  }

  ajax2.send(null);
}

function limpiar () {
  $('#label-mssg').html('');
  $('#nombre_permiso').val('');
  $('#permiso').val('');
  $('#permiso_padre').val('');
  $('#txt_permiso_padre').val('');
  $('#txt_mssg-label').html('');
  $('#mssg-label').html('');
}

</script>
