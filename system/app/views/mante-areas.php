<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

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
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nueva Área</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[^] Exportar</a>
      </div>
    </div>

   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i>Administrar Áreas
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

<div class="modal fade" id="formulario_nuevo"  role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Área</h3>
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
                   <td width="70%" colspan="3"><input maxlength="50" autocomplete="off" autofocus="" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>

                 <tr>
                   <td>Departamento <span class="symbol required"></td>
                   <td colspan="3">
                  <select name="departamento" id="departamento">
                      <option value=""> - seleccionar - </option> 
                      <?php
                        foreach ($typeDeptos['resultado'] as $typeData) {
                          echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
                        }
                      ?>
                  </select>
                 </td>
                 </tr>

                 <tr>
                  <td width="30%">Total Usuarios <span class="symbol required"></span></td>
                  <td width="70%" colspan="3"><input maxlength="50" min="1" value="0" autofocus="" name="total_usuarios" type="number" class="form-control" id="total_usuarios" placeholder="Total Usuarios"></td>
                </tr>

                <tr>
                   <td>Estado</td>
                   <td colspan="3">
                    <select name="estado" id="estado">
                      <option value="1">Activo</option>
                      <option value="0" selected="">Inactivo</option>
                    </select>
                   </td>
                 </tr>

                <tr><td colspan="4">Turnos &nbsp; <small class="color-red">[el valor minimo debe ser 1]</small></td></tr>

                 <tr>
                   <td width="20%">A</td>
                   <td ><input maxlength="50" autofocus="" min="1" value="1" name="turno_a" type="number" class="" id="turno_a" placeholder="Turno A"></td>
                   <td width="20%">B</td>
                   <td ><input maxlength="50" autofocus="" min="1" value="1" name="turno_a" type="number" class="" id="turno_b" placeholder="Turno B"></td>
                  </tr>

                  <tr>
                   <td width="20%">C</td>
                   <td ><input maxlength="50" autofocus="" min="1" value="1" name="turno_c" type="number" class="" id="turno_c" placeholder="Turno C"></td>
                   <td width="20%">D</td>
                   <td ><input maxlength="50" autofocus="" min="1" value="0" name="turno_d" type="number" class="" id="turno_d" placeholder="Turno D"></td>
                  </tr>

                  <tr>
                   <td width="20%">E</td>
                   <td ><input maxlength="50" autofocus="" min="1" value="0" name="turno_e" type="number" class="" id="turno_e" placeholder="Turno E"></td>
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
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Área</h3>
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
      <td width="70%" colspan="3"><input autofocus="" name="txt_nombre" type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?php echo $data['name']; ?>">
      <input autofocus="" name="txt_id_row" type="hidden" class="form-control" id="txt_id_row" placeholder="Nombre" value="">
      </td>
    </tr>

    <tr>
      <td width="30%">Departamento <span class="symbol required"></span></td>
      <td colspan="3">
        <select name="txt_departamento" id="txt_departamento">
            <option value=""> - seleccionar - </option> 
            <?php
              foreach ($typeDeptos['resultado'] as $typeData) {
                  echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
              }
            ?>
        </select>
        </td>
    </tr>

    <tr>
      <td width="30%">Total Usuarios <span class="symbol required"></span></td>
      <td width="70%" colspan="3">
        <input maxlength="50" min="1" value="" autofocus="" name="txt_total_usuarios" type="number" class="form-control" id="txt_total_usuarios" placeholder="Total Usuarios">
      </td>
    </tr>

    <tr>
      <td>Estado:</td>
      <td colspan="3">
       <select name="txt_estado" id="txt_estado">
         <option value="1">Activo</option>
         <option value="0">Inactivo</option>
       </select>
      </td>
    </tr>

    <tr><td colspan="4">Turnos &nbsp; <small class="color-red">[el valor minimo debe ser 1]</small></td></tr>

      <tr>
        <td width="20%">A</td>
        <td ><input maxlength="50" autofocus="" min="1" value="" name="turno_a" type="number" class="" id="txt_turno_a" placeholder="Turno A"></td>
        <td width="20%">B</td>
        <td ><input maxlength="50" autofocus="" min="1" value="" name="turno_a" type="number" class="" id="txt_turno_b" placeholder="Turno B"></td>
      </tr>

      <tr>
        <td width="20%">C</td>
        <td ><input maxlength="50" autofocus="" min="1" value="" name="turno_c" type="number" class="" id="txt_turno_c" placeholder="Turno C"></td>
        <td width="20%">D</td>
        <td ><input maxlength="50" autofocus="" min="0" value="" name="turno_d" type="number" class="" id="txt_turno_d" placeholder="Turno D"></td>
      </tr>

      <tr>
        <td width="20%">E</td>
        <td ><input maxlength="50" autofocus="" min="0" value="" name="turno_e" type="number" class="" id="txt_turno_e" placeholder="Turno E"></td>
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
</div>  <?php //////  Fin de editor ?>
<!-- End Edit Rows -->

<?php get_template_part('footer_scripts');?>

<script src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/r-2.2.2/sc-2.0.0/datatables.min.js"></script>
  
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

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

const listResultTable = () => {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  var contenido_editor = $('#list-rows')[0];
  let route = "ajax/ajax_list_areas.php"; 
  //?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id_user : id_user,
      id_empresa: id_empresa,
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
  let route = "app/controllers/mante-areas.php";
  //?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      delete : 1,
      id     : id,
      nocache: '<?php echo rand(99999,66666)?>',
    },
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

// Add Row
function addRows () {
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_empresa  = '<?php echo $_SESSION["id_cia"]?>';
  
  let nombre      = $('#nombre').val();
  let departamento= $('#departamento').val();
  let total_usuarios= $('#total_usuarios').val();
  let turno_a    = $('#turno_a').val();
  let turno_b    = $('#turno_b').val();
  let turno_c    = $('#turno_c').val();
  let turno_d    = $('#turno_d').val();
  let turno_e    = $('#turno_e').val();
  let estado      = $('#estado').val();

  if ( nombre == '' || departamento == '' || total_usuarios == '') {
    $("#mssg-alert").html('Los campos con (*) son necesarios');
    $('#nombre').focus();
    return false
  }

  let route = "app/controllers/mante-areas.php"; //?add=1&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
        add       : 1,
        nombre    : nombre,
        departamento : departamento,
        total_usuarios : total_usuarios,
        turno_a   : turno_a,
        turno_b   : turno_b,
        turno_c   : turno_c,
        turno_d   : turno_d,
        turno_e   : turno_e,
        estado    : estado,
    },
    dataType        : 'html',
    success         : function (response) { 
      $("#mssg-alert").html(response);
      $('.fa-spinner').hide();
      listResultTable();
      setTimeout(() => {
        $(".alert-exito").hide();
        $(".alert-danger").hide();
      }, 3000);
  
      //$('#estado').val(null).trigger('change');
      $('#departamento').val(null).trigger('change');
      $("#turno_a").val('1');
      $("#turno_b").val('1');
      $("#turno_c").val('1');
      $("#total_usuarios").val('3');
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
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  var contenido_editor = $('#contenido_editar')[0];

  let route = "app/controllers/mante-areas.php?showEdit=1&id="+id+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
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
      $('#grupo_horario_edit').select2('val',response['grupo']);
      $('#txt_total_usuarios').val(response['users']);
      $('#txt_nombre').val(response['name']);
      $('#txt_id_row').val(response['id']);
      //$('#txt_departamento').select2('val',response['id_depto']);
      $('#txt_departamento').val(response['id_depto']).trigger('change');
      $('#area_horario_edit').select2('val',response['id_area']);
      $('#txt_estado').val(response['active']).trigger('change');
      $('#txt_turno_a').val(response['turn_a']);
      $('#txt_turno_b').val(response['turn_b']);
      $('#txt_turno_c').val(response['turn_c']);
      $('#txt_turno_d').val(response['turn_d']);
      $('#txt_turno_e').val(response['turn_e']);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Update Row
function updateRow ( id ) {
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_empresa  = '<?php echo $_SESSION["id_cia"]?>';
  let nombre      = $('#txt_nombre').val();
  let depto       = $('#txt_departamento').val();
  let total_usuarios= $('#txt_total_usuarios').val();
  let turno_a    = $('#txt_turno_a').val();
  let turno_b    = $('#txt_turno_b').val();
  let turno_c    = $('#txt_turno_c').val();
  let turno_d    = $('#txt_turno_d').val();
  let turno_e    = $('#txt_turno_e').val();
  let estado      = $('#txt_estado').val();
  let id_row      = $('#txt_id_row').val();

  if (depto == "" || depto == null || nombre == "") {
    $("#mssg-edit").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    setTimeout(()=>{$("#mssg-edit").hide();},3000);
    return false;
  }
  let route = "app/controllers/mante-areas.php";
  //?edit=1&id="+id+"&nombre="+nombre+"&activo="+estado+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      edit      : 1,
      id_row    : id_row,
      nombre    : nombre,
      depto     : depto,
      total_usuarios : total_usuarios,
      turno_a   : turno_a,
      turno_b   : turno_b,
      turno_c   : turno_c,
      turno_d   : turno_d,
      turno_e   : turno_e,
      activo    : estado,
    },
    dataType        : 'html',
    success         : function (response) {
      $("#mssg-edit").show().html(response);
      setTimeout(()=>{$("#mssg-edit").hide()},3000);
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
        "targets": [10]
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

$("[name='departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='txt_estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='txt_departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

$('#turno_a , #turno_b , #turno_c , #turno_d , #turno_e').on('change', ()=>{
  sumTurnos();
});
$('#txt_turno_a , #txt_turno_b , #txt_turno_c , #txt_turno_d , #txt_turno_e').on('change', ()=>{
  sumTurnos();
});

const sumTurnos = (val) => {
  let resultado = 0;
  if ($('#turno_a').val()!="") {
    let sum = (Number($('#turno_a').val()) + Number($('#turno_b').val()) + Number($('#turno_c').val()) + Number($('#turno_d').val()) + Number($('#turno_e').val()));
    $('#total_usuarios').val(sum);
  }
  if ($('#txt_turno_a').val()!="") {
    let sum2 = (Number($('#txt_turno_a').val()) + Number($('#txt_turno_b').val()) + Number($('#txt_turno_c').val()) + Number($('#txt_turno_d').val()) + Number($('#txt_turno_e').val()));
    //let total= (Number($('#txt_total_usuarios').val()) + sum2);
    $('#txt_total_usuarios').val(sum2);
  }
}

sumTurnos();
</script>
