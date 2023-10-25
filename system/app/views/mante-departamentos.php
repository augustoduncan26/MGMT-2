<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

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
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Departamento</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[^] Exportar</a>
      </div>
    </div>
    
    

   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-group"></i>Administrar Departamentos
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

<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Departamento.</h3>
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
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 <tr>
                   <td width="30%">Telefono <span class="symbol"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono"></td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado"  class="form-control" id="estado">
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
<div class="<?php echo "modal fade"; ?>" id="edit_event" tabindex="-1" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?>">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Departamento.</h3>
</div>
<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
 <div class="modal-body" id="contenido_editar">
Cargando contenidos...
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
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  $('.fa-spinner').show();
  var contenido_editor = $('#list-rows')[0];
  let route = "ajax/ajax_list_departamentos.php"; 
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
  let route = "app/controllers/mante-departamentos.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
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

// Add Row
function addRows () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  
  var nombre      = $('#nombre').val();
  var telefono    = $('#telefono').val();
  var estado      = $('#estado').val();

  if ( nombre == '') {
    $("#mssg-alert").html('Los campos con (*) son necesarios');
    $('#nombre').focus();
    return false
  }

  let route = "app/controllers/mante-departamentos.php"; //?add=1&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>";
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
        telefono : telefono,
        estado   : estado,
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
  
      $("#nombre").val('');
      $("#nombre").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Edit Row
function editRow ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var contenido_editor = $('#contenido_editar')[0];

  let route = "ajax/ajax_editar_departamentos.php?id="+id+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
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
      contenido_editor.innerHTML = response;
      listResultTable();
    },
    error           : function (error) {
      console.log(error);
    }
  });

}

// Update Row
function updateRow ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';
  var nombre      = $('#txt_nombre').val();
  var precio      = $('#txt_precio').val();
  var estado      = $('#txt_estado').val();

  let route = "app/controllers/mante-departamentos.php?edit=1&id="+id+"&nombre="+nombre+"&activo="+estado+"&dml=editar&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>";
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
      $("#mssg-edit").html('<uppercase>Los datos fueron actualizados con éxito</uppercase>');
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
        "targets": [3]
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

</script>