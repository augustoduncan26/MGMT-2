<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<!-- <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- <link rel="stylesheet" href="assets/css/styles_datatable.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<style>
.dataTables_filter {
  width: 30%;
}
div.dataTables_wrapper div.dataTables_filter input {
      width: 98%;
}
div.dataTables_wrapper div.dataTables_filter label {
  width: 300px !important;
}
</style>

<body>
	
<div class="">
<h3></h3>

 <div class="clearfix"></div>
 <label id="label-mssg"><?=$mssg?></label>
<!--  <div class="ln_solid"></div> -->

<a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#mssg-label').text('');$('#nombre').focus();">[+] Nuevo Permiso</a>
<a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>	
<br />
  <!-- end: PAGE HEADER -->
  <!-- start: PAGE CONTENT -->
  <div class="row">
    <div class="col-sm-12">
      <!-- start: CONFIGURAR PERMISOS -->
      <div class=""><!-- panel panel-default -->
        <div class="panel-heading">
          <i class="clip-settings"></i>Permisos
          </div>
	         <div class="panel-body">
           <div class="col-sm-12">
              <div style="height:10px;"></div>

              <div class="x_content">
            <div id="table-responsive" style="overflow:auto;width:100%">
                <table id="tabla-list-permisos" class="table table-striped table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th>Nombre Permiso</th>
                      <th>Permiso</th>
                      <th>Permiso Padre</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody-table-permisos">
                    <?php
                      if (isset($listPermisos['resultado'])) {
                        foreach ($listPermisos['resultado'] as $key => $value) {
                    ?>
                      <tr>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['nombre']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['permiso']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['permiso_padre']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($value['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                        <td class="text-center" style="width:10% !important;">
                          <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_permiso" onclick="editRow('<?php echo $value['id']; ?>');"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deletePermiso('<?php echo $value['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
                        </td>
                      </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <!-- <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i> -->
              </div>
              
              </div>
              </div>
		      </div>
      </div>
      <!-- end: CONFIGURAR PERMISOS -->
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
          <div id="mssg-label"></div>
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


<?php /////////// Edit Row ?>
<div class="<?php echo "modal fade"; ?>" id="edit_permiso" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
    <div class="modal-content ">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
    &times;
    </button>
    <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Permiso</h3>
    <div id="txt_mssg-label"></div>
    </div>
    <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
     <div class="modal-body" id="contenido_editar">
     <table class="table table-bordered table-hover" id="sample-table-4">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td width="30%">Nombre <span class="symbol required"></span></td>
            <td width="70%"><input maxlength="50" autofocus="" name="nombre_permiso_editar" required="" type="text" class="form-control" id="nombre_permiso_editar" placeholder="Nombre Permiso">
            <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="" value=""></td>
          </tr>
          <tr>
            <td>Permiso padre <span class="symbol required"></td>
            <td><input name="permiso_padre_editar" type="number" required="" min="1" step="1" class="form-control" id="permiso_padre_editar" value="1" placeholder="Número de permiso">
            </td>
          </tr>
          <tr>
            <td>Permiso <span class="symbol required"></td>
            <td><input name="permiso_editar" type="number" required="" min="1" step="1" class="form-control" id="permiso_editar" value="1" placeholder="Número de permiso">
            </td>
          </tr>
          <tr>
            <td>Estado</td>
            <td>
            <select name="estado_editar" id="estado_editar" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            </td>
          </tr>
                                
        </tbody>
      </table>
    </div>
     <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_habitacion" type="button" class="btn btn-primary" id="editar_permiso" onClick="var id_row = $('#id_row').val(); updatePermiso(id_row)" value="Modificar datos">
    </div>
    </form>
    </div>
  </div>
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Modal -->



<?php get_template_part('footer_scripts');?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

// Show Add Modal
function addPermiso () {

  var nombre      =   $('#nombre_permiso').val();
  var permiso      =   $('#permiso').val();
  var permiso_padre = $('#permiso_padre').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1 || permiso.length < 1 || permiso_padre.length < 1) {
    $('#mssg-label').show()
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    setTimeout(()=>{ $('#mssg-label').hide();},4000);
    $('#nombre_permiso').css({'border-color': '#007AFF'});
    $('#permiso').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?add=1&permiso="+permiso+"&permiso_padre="+permiso_padre+"&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').show();
      $('#mssg-label').html(ajax2.responseText);
      setTimeout(()=>{ $('#mssg-label').hide();},4000);
      listPermisos();
      $('#nombre_permiso').val('');
      $('#permiso').val('');
      $('#permiso_padre').val('');
    }
  }

  ajax2.send(null);

}

// Show Edit Modal
function editRow ( id ) {
$('.alert-success').hide();
let id_user     = '<?php echo $_SESSION["id_user"]?>';
let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
let contenido_editor = $('#contenido_editar')[0];

let route = "app/controllers/configurar-permisos.php?showEdit=1&id="+id+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
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
      $('#id_row').val(response['id']);
      $('#nombre_permiso_editar').val(response['nombre']);
      $('#permiso_padre_editar').val(response['permiso_padre']);
      $('#permiso_editar').val(response['permiso']);
      $('#estado_editar').select2('val',response['activo']);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Update
function updatePermiso ( id ) {

  var   nombre        = $('#nombre_permiso_editar').val();
  var   permiso_padre = $('#permiso_padre_editar').val();
  var   permiso       = $('#permiso_editar').val();
  var   activo        = $('#estado_editar').val();
  var   id            = $('#id_row').val();

  if( nombre=='' || permiso=='' || permiso_padre=='') {
    $('#txt_mssg-label').show();
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    setTimeout(()=>{ $('#txt_mssg-label').hide();},4000);
    $('#txt_nombre').css({'border-color': '#007AFF'});
    $('#txt_permiso').css({'border-color': '#007AFF'});
    $('#txt_permiso_padre').css({'border-color': '#007AFF'});
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?edit=1&permiso="+permiso+"&permiso_padre="+permiso_padre+"&activo="+activo+"&nombre="+nombre+"&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').show();
      $('#txt_mssg-label').html(ajax2.responseText);
      setTimeout(()=>{ $('#txt_mssg-label').hide();},4000);
      listPermisos();
    }
  }

  ajax2.send(null);

}

// List all
function listPermisos() {   
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  let contenido_editor = $('#list-permisos')[0];
  let route = "app/controllers/configurar-permisos.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id_user     : id_user,
      id_cia      : id_cia,
      all         : 1,
      nocache     : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'json',
    success         : function (response) { 

      let arr     = response;
      let keys    = Object.keys(arr).length;
      let r       = "";
      let content = '';
      let classSetting   = '';
      arr.forEach((item,key)=>{
        if (item.activo == 0) {
          classSetting = "class='row-yellow-transp'";
          textActivo   = "Inactivo";
        } else {
          classSetting = "";
          textActivo   = "Activo";
        }
        content += '<tr>';
        content += '<td style="width:40%" '+classSetting+'>' + item.nombre + '</td>';
        content += '<td style="width:10%" '+classSetting+'>' + item.permiso + '</td>';
        content += '<td style="width:10%" '+classSetting+'>' + item.permiso_padre + '</td>';
        content += '<td style="width:10%" '+classSetting+'>' + textActivo + '</td>';
        content += `<td style="width:10%;text-align: center;" `+classSetting+`>
        <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_permiso" onclick="editRow('`+item.id+`');"><i class="fa fa-edit"></i></a>
        <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deletePermiso('`+item.id+`'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
        </td>`;
        content += '</tr>';
      });
      $('#tbody-table-permisos').empty().append(content);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}


// Delete
function deletePermiso ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-permisos.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      setTimeout(()=>{
        $('#label-mssg').html('');
      },4000);
      listPermisos();
    }
  }

  ajax2.send(null);
}

$(document).ready( function () {
    $('#tabla-list-permisos').DataTable({
      pageLength: 25,
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
          search: '',
          searchPlaceholder: "Buscar",
      },
      order: [[2, 'asc']],
      columnDefs: 
      [{
      targets: 4,
      orderable: false
      },{ width: "30%", targets: 0,},{ width: "10%", targets: 1}, {width: "10%", targets: 2, }, {width: "10%", targets: 3, }, {width: "15%", targets: 4, }]
    });
} );

function limpiar () {
  $('#label-mssg').html('');
  $('#nombre_permiso').val('');
  $('#permiso').val('');
  $('#permiso_padre').val('');
  $('#txt_permiso_padre').val('');
  $('#txt_mssg-label').html('');
  $('#mssg-label').html('');
}

$("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado_editar']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>
