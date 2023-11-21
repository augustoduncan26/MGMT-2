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
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nueva Zona</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[^] Exportar</a>
      </div>
    </div>
    
   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i>Administrar Zonas
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
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Zonas.</h3>
        </div>
         <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div id="mssg-alert" style="color:red;"></div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%">
                    <input maxlength="50" autofocus="" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre" autocomplete="off">
                  </td>
                 </tr>
                 <tr>
                   <td>Departamento <span class="symbol required"></td>
                   <td colspan="3">
                  <select name="departamento" id="departamento">
                      <option value=""> - seleccionar - </option> 
                      <?php
                        foreach ($listaDeptos['resultado'] as $typeData) {
                          echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
                        }
                      ?>
                  </select>
                 </td>
                 </tr>
                 <tr>
                   <td>Áreas <span class="symbol required"></td>
                   <td colspan="3">
                  <select name="areas[]" id="areas" multiple="multiple">
                      <?php
                        foreach ($listaAreas['resultado'] as $typeData) {
                          echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
                        }
                      ?>
                  </select>
                 <input type="checkbox" class="seleccionar-todas-areas" id="todas-areas-input" > <label for="todas-areas-input" class="cursor">Seleccionar Todas</label>
                 </td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado"  class="" id="estado">
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
<!-- End Add Row -->

<!-- Edit Row -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Zona</h3>
</div>

<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
 
 <div id="mssg-edit" style="color:red"></div>

 <table class="table table-bordered" id="sample-table-4">
  <thead>
  </thead>
  <tbody>
    <tr>
      <td width="30%">Nombre: <span class="symbol required"></span></td>
      <td width="70%"><input autofocus="" name="nombre" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="" autocomplete="off">
      <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="Nombre" value="">
      </td>
    </tr>
    <tr>
      <td>Departamento <span class="symbol required"></td>
      <td colspan="3">
    <select name="txt_departamento" id="txt_departamento">
        <option value=""> - seleccionar - </option> 
        <?php
          foreach ($listaDeptos['resultado'] as $typeData) {
            echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
          }
        ?>
    </select>
    </td>
    </tr>
    <tr>
      <td>Áreas <span class="symbol required"></td>
      <td colspan="3">
    <select name="areas[]" id="txt_areas" multiple="multiple">
        <?php
          foreach ($listaAreas['resultado'] as $typeData) {
            echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
          }
        ?>
    </select>
    <input type="checkbox" class="seleccionar-todas-areas-2" id="todas-areas-input-2" > <label for="todas-areas-input-2" class="cursor">Seleccionar Todas</label>
    </td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td>
       <select name="estado" id="txt_estado" class="">
         <option value="1">Activo</option>
         <option value="0">Inactivo</option>
       </select>
      </td>
    </tr>
  </tbody>
<tfoot>
</tfoot>
</table>

</div>
 <div class="modal-footer">
      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="agregar_habitacion" type="button" class="btn btn-primary" onClick="var id_row = $('#id_row').val(); updateRow(id_row)" value="Modificar datos">
</div>
</form>
</div>
</div>
</div>  
<?php //////  Fin de editor ?>

<?php get_template_part('footer_scripts');?>

<script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>
  
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

/** Select all areas */
$(".seleccionar-todas-areas").click(function(){
    if($(".seleccionar-todas-areas").is(':checked') ){
        $("#areas > option").prop("selected","selected");
        $("#areas").trigger("change");
    } else {
        $("#areas").val(null).trigger('change');
    }
});

$(".seleccionar-todas-areas-2").click(function(){
    if($(".seleccionar-todas-areas-2").is(':checked') ){
        $("#txt_areas > option").prop("selected","selected");
        $("#txt_areas").trigger("change");
    } else {
        $("#txt_areas").val(null).trigger('change');
    }
});

/** List Results */
const listResultTable = () => {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  var contenido_editor = $('#list-rows')[0];
  let route = "ajax/ajax_list_zonas.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id_user     : id_user,
      id_empresa  : id_cia,
      nocache     : '<?php echo rand(99999,66666)?>',
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

// Delete Row
function deleteRow ( id ) {
  let route = "app/controllers/mante-zonas.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
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
        listResultTable();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Add Row
function addRows () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  
  var nombre      = $('#nombre').val();
  var departamento= $('#departamento').val();
  var areas       = $('#areas').val();
  var estado      = $('#estado').val();

  if ( nombre == '' || departamento == '' || areas == '') {
    $("#mssg-alert").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    $('#nombre').focus();
    setTimeout(()=>{$("#mssg-alert").hide();},3000);
    return false
  }

  let route = "app/controllers/mante-zonas.php";

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
        add      : 1,
        nombre   : nombre,
        depto    : departamento,
        areas    : areas,
        estado   : estado,
    },
    dataType        : 'html',
    success         : function (response) { 
      $("#mssg-alert").show().html(response);
      $('.fa-spinner').hide();
      listResultTable();
      setTimeout(() => {
        $(".alert-exito").hide();
        $(".alert-danger").hide();
        $("#mssg-alert").hide();
      }, 3000);
  
      $("#areas").val(null).trigger('change');
      $("#departamento").val(null).trigger('change');
      $(".seleccionar-todas-areas").prop('checked',false);
      $("#nombre").val('');
      $("#nombre").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Show Edit Modal
function editRow ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia  = '<?php echo $_SESSION["id_cia"]?>';
  var contenido_editor = $('#contenido_editar')[0];
  $("#mssg-edit").html('');
  let route = "app/controllers/mante-zonas.php";

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
      id_cia    : id_cia,
      nocache   : "<?php echo rand(99999,66666)?>",
    },
    dataType        : 'json',
    success         : function (response) { 
      let arr   = response['id_area'].split (",");
      let keys  = Object.keys(arr).length;
      let r  = "";
      arr.forEach((item,key)=>{
        if (item) {
          r =  arr + ',';
          $('#txt_areas').val(arr).change();
        }
      });
      
      //let vls = r.slice(0, -1);

      $('#txt_nombre').val(response['name']);
      $('#id_row').val(response['id']);
      $('#txt_departamento').val(response['id_depto']).change();
      $('#txt_estado').select2('val',response['active']);
     
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
  var nombre      = $('#txt_nombre').val();
  var depto       = $('#txt_departamento').val();
  let areas       = $('#txt_areas').val();
  var estado      = $('#txt_estado').val();
  $('#mssg-edit').css({'width':'100%'})

  if ( nombre == "") {
    $("#mssg-edit").show();
    $("#mssg-edit").html('El campo nombre es requerido.');
    setTimeout(()=>{$("#mssg-edit").hide();},3000);
    return false;
  }

  let route = "app/controllers/mante-zonas.php";
  //?edit=1&id="+id+"&nombre="+nombre+"&areas="+areas+"&depto="+depto+"&activo="+estado+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id  : id,
      nombre  : nombre,
      areas   : areas,
      depto   : depto,
      activo  : estado,
      edit    : 1,
      nocache : '<?php echo rand(99999,66666)?>', 
    },
    dataType        : 'html',
    success         : function (response) { 
      $("#mssg-edit").show();
      if (response == "ok") {
        $("#mssg-edit").html('<div class="alert alert-success">Los datos fueron actualizados con éxito</div>');
      } else {
        $("#mssg-edit").html('<div class="alert alert-danger">No se ha podido actualizar los datos.</div>');
      }
      setTimeout(()=>{$("#mssg-edit").hide();},3000);
      listResultTable();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

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
        "targets": [5]
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

$("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#areas").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='txt_departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_areas").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>