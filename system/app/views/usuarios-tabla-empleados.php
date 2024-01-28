<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<!-- <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- <link rel="stylesheet" href="assets/css/styles_datatable.css" /> -->
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
  .modal-xl {
    width: 90%;
   max-width:1350px;
  }
}


</style>

<body>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="limpiarCampos();$('#nombre').focus();">[+] Nuevo Empleado</a>
  <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>

    <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i> Empleados
          </div>
          <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

              <div class="x_content">

			        <div id="table-responsive" class="overflow">
                <table id="tabla-list-empleados" class="table table-striped table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th title="Número de Empleado">#</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                      <th>Email-Sume</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody-table-empleados">
                    <?php
                      if (isset($listEmpleados['resultado'])) {
                        foreach ($listEmpleados['resultado'] as $key => $value) {
                    ?>
                      <tr>
                        <td ><?=$value['nempleado']?></td>
                        <td ><?=$value['nombre']?></td>
                        <td ><?=$value['apaterno']?></td>
                        <td ><?=$value['email1']?></td>
                        <td ><?=$value['email2']?></td>
                        <td class="text-center" style="width:10% !important;">
                          <a class="btn btn-xs btn-teal tooltips" title="Editar" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $value['id']; ?>');"><i class="fa fa-edit"></i></a>
                          <!-- <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $value['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a> -->
                          <a class="btn btn-xs btn-green tooltips"><img name="iconoInfoGen" id="iconoInfoGen" src="assets/image/email_go.png" border="0" title="Agregar correo al usuario"></a>
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
      </div>
    </div>
    </div>
  </div>
</div>

 <div class="clearfix"></div>

 <!-- Edit Row -->
<?php /////////// Editar algo ?>
<div class="modal fade" id="edit_event" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Perfil.</h3>
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
      <td width="70%"><input autofocus="" name="nombre" type="text" class="form-control" id="nombre_edit" placeholder="Nombre" value="">
      <input autofocus="" name="id_row" type="hidden" class="form-control" id="id_row" placeholder="" value="">
      </td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td>
       <select name="estado" id="estado_edit" class="">
         <option value="1" <?php if($data['active'] == 1) { echo 'selected'; } ?>>Activo</option>
         <option value="0" <?php if($data['active'] == 0) { echo 'selected'; } ?>>Inactivo</option>
       </select>
      </td>
    </tr>
  </tbody>
<tfoot>
  <tr><td colspan="2">
   
</td></tr>
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
<!-- End Edit Events -->


<!-- Add Empleado -->
  <div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Perfil</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
            <div id="mssg-alert" style="color:red;"></div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></td>
                   <td width="70%"><input autofocus="" name="nombre_perfil" required="" type="text" class="form-control" id="nombre_perfil" placeholder="Nombre de perfil"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
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
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_perfil" type="button" class="btn btn-primary" id="agregar_perfil" onClick="addPerfil()" value="Guardar datos">                  
        </div>
        </form>                                  
      </div>
    </div>
  </div>
<!-- End Perfil -->


<?php get_template_part('footer_scripts');?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

$('#cargando_add').hide()

// Add
function addPerfil () {

  let nombre      =   $('#nombre_perfil').val();
  let estado      =   $('#estado').val();
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';


  if (nombre.length < 1 ) {
    $("#mssg-alert").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },3000);
      return false
  }

  let route = "app/controllers/configurar-perfiles.php"; 

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      add         : 1,
      id_user     : id_user,
      id_cia      : id_cia,
      nombre      : nombre,
      estado      : estado,
      nocache     : '<?php echo rand(99999,66666)?>',
    },
    dataType        : 'html',
    success         : function (response) { 
      if (response != "Ya existe este registro.") {
        $("#mssg-alert").html(response);
        limpiarCampos ();
        listPerfiles();
      } else {
        $('#mssg-alert').html('<div class="alert alert-danger">'+response+'</div>');
      }
      setTimeout(() => {
        $(".alert-exito").hide();
        $(".alert-danger").hide();
      }, 3000);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// List all
function listPerfiles() {   
  let id_user     = '<?php echo $_SESSION["id_user"]?>';
  let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  let contenido_editor = $('#list-perfiles')[0];
  let route = "app/controllers/configurar-perfiles.php"; 

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
        if (item.active == 0) {
          classSetting = "class='row-yellow-transp'";
          //class="text-center" style="width:10% !important;"
          textActivo   = "Inactivo";
        } else {
          classSetting = "";
          textActivo   = "Activo";
        }
        content += '<tr>';
        content += '<td '+classSetting+'>' + item.id + '</td>';
        content += '<td '+classSetting+'>' + item.name + '</td>';
        content += '<td '+classSetting+'>' + item.created_at + '</td>';
        content += '<td '+classSetting+'>' + textActivo + '</td>';
        content += `<td `+classSetting+`>
        <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('`+item.id+`');"><i class="fa fa-edit"></i></a>
        <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('`+item.id+`'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
        </td>`;
        content += '</tr>';
      });
      $('#tbody-table-perfiles').empty().append(content);
    },
    error           : function (error) {
      console.log(error);
    }
  });
}

// Show Edit Modal
function editRow ( id ) {
let id_user     = '<?php echo $_SESSION["id_user"]?>';
let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
let contenido_editor = $('#contenido_editar')[0];

let route = "app/controllers/configurar-perfiles.php?showEdit=1&id="+id+"&dml=editar&id_cia="+id_cia+"&nocache=<?php echo rand(99999,66666)?>";
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
    $('#nombre_edit').val(response['name']);
    $('#estado_edit').select2('val',response['active']);
    //$('#estado_edit').val(response['active']);
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
var nombre      = $('#nombre_edit').val();
var estado      = $('#estado_edit').val();

if ( nombre == '') {
  $("#mssg-edit").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios</div>');
  setTimeout(()=>{
    $("#mssg-edit").html('').hide();
  },4000);
  return false
}

let route = "app/controllers/configurar-perfiles.php";
$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
    edit  : 1,
    id    : id ,
    nombre : nombre,
    estado  : estado
  },
  dataType        : 'html',
  success         : function (response) { 
    if (response == 'ok') {
      $("#mssg-edit").show().html('<div class="alert alert-success">Los datos fueron actualizados con éxito.</div>');
      setTimeout(()=>{
        $("#mssg-edit").html('').hide();
      },4000);
      limpiarCampos();
      listPerfiles();
    } else {
      console.log(response);
    }
  },
  error           : function (error) {
    console.log(error);
  }
});
}

$(document).ready( function () {
    $('#tabla-list-empleados').DataTable({
      pageLength: 25,
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
          search: '',
          searchPlaceholder: "Buscar",
      },
      columnDefs: 
      [ 
      {
      targets: 5,
      orderable: false
      },{ width: "3%", targets: 0,},{ width: "15%", targets: [1,2,3,4], } ,{ width: "30%", targets: 5, }
    ]
    });
} );

// Clean
function limpiarCampos () {
  $("#nombre_perfil").val('');
}

$("[name='estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>

 </body>
