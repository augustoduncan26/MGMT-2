
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />

<script>

// Add Category
function addProveedor () {

  var codigo      =   $('#codigo').val();
  var nombre      =   $('#nombre').val();
  var direccion   =   $('#direccion').val();
  var telefono    =   $('#telefono').val();
  var email       =   $('#email').val();
  var fecha_desde =   $('#fecha_desde').val();
  var cuenta_bancaria =   $('#cuenta_bancaria').val();
  var condiciones_pago =   $('#condiciones_pago').val();
  var estado      =   $('#estado').val();

  if (nombre.length < 1 || codigo.length < 1) {
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    $('#codigo').css({'border-color': '#007AFF'});
    $('#nombre').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/caja-proveedores.php?add=1&nombre="+nombre+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      //$('#cargando_add').hide();
      listProveedores();
      $('#nombre').val('');
    }
  }

  ajax2.send(null);

}

// Update data of type Room
function updateCategory ( id ) {

  var   nombre        = $('#txt_nombre').val();
  var   activo        = $('#txt_activo').val();
  var   id            = $('#id_row').val();
  
    if( nombre=='') {
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
  
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/caja-proveedores.php?edit=1&nombre="+nombre+"&id="+id+"&activo="+activo+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);
      listProveedores();
    }
  }

  ajax2.send(null);

}

// Edit Room
function editCategory ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-room')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-proveedores.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      listProveedores()
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}


// List all category
function listProveedores() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_proveedores.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide()
      $('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}


// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/caja-proveedores.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listProveedores();
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


</script>


<link rel="stylesheet" href="assets/plugins/jquery-datepicker/jquery-ui.css">
<script src="assets/plugins/jquery-datepicker/jquery-1.12.4.js"></script>
<script src="assets/plugins/jquery-datepicker/jquery-ui.js"></script>


<body onload="listProveedores();">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Agregar Proveedor</a>
   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-truck"></i>Administrar Proveedores
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

                <div class="x_content">
                <img src="images/ajax-loader.gif" id="cargando_list" />
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

<!-- Modal Add Category -->
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Proveedor</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               <tr>
                   <td width="30%">Código <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="codigo" required="" type="text" class="form-control" id="codigo" placeholder="Código"></td>
                 </tr>
               <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50"  name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                  <tr>
                   <td width="30%">Dirección </td>
                   <td width="70%"><input maxlength="50"  name="direccion"  type="text" class="form-control" id="direccion" placeholder="Dirección"></td>
                 </tr>
                 <tr>
                   <td width="30%">Teléfono </td>
                   <td width="70%"><input maxlength="50"  name="telefono"  type="text" class="form-control" id="telefono" placeholder="Teléfono"></td>
                 </tr>
                 <tr>
                   <td width="30%">Email </td>
                   <td width="70%"><input maxlength="50" name="email"  type="email" class="form-control" id="email" placeholder="Email"></td>
                 </tr>
                 <tr>
                   <td width="30%">Proveedor desde </td>
                   <td width="70%"><input name="fecha_desde"  type="text" class="form-control" id="fecha_desde" placeholder="yyyy-mm-dd"></td>
                 </tr>
                 <tr>
                   <td width="30%">Cuenta bancaria </td>
                   <td width="70%"><input maxlength="50" name="cuenta_bancaria" type="text" class="form-control" id="cuenta_bancaria" placeholder="Cuenta bancaria"></td>
                 </tr>
                 <tr>
                   <td width="30%">Condiciones de pago </td>
                   <td width="70%">
                   <select class="form-control" name="condiciones_pago" id="condiciones_pago">
                      <option value="">-------seleccionar-------</option>
                      <?php
                         $sel_  = mysql_query("Select * From caja_condicion_pago Where activo = 1");
                          while ( $data = mysql_fetch_object($sel_)) {
                      ?>
                      <option value="<?php echo $data->id?>"><?php echo $data->nombre?></option>
                      <?php } ?>
                   </select>
                   <!-- <input maxlength="50" name="condiciones_pago" type="text" class="form-control" id="telefono" placeholder=""></td> -->
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
          <button  type="button" class="btn btn-primary" id="agregar_habitacion" onClick="addProveedor()">Guardar datos</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>

<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Edit Category -->
  <div class="modal fade" id="edit_room" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Categoria</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
       <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateCategory(id_row)">Modificar datos</button>
          
      </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->

<script>$( "#fecha_desde" ).datepicker();$( "#fecha_desde" ).datepicker("option", "dateFormat","yy-mm-dd");</script>

<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="assets/js/table-data.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

<script>

jQuery(document).ready(function() {
    Main.init();
    FormElements.init();
    //FormValidator.init();
    UIElements.init();
    //TableData.init();
  $('#list-table-room').dataTable({aaSorting : [[3, 'asc']]});
});
    </script>
<script>
// $('#formulario_nuevo').on('hidden.bs.modal', function() {
//   this.modal('show');
// });

// $("#list-table-room").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();

// DATE PICKER

//Pass the user selected date format



// $( "#fecha_s_editar" ).datepicker();
// $( "#fecha_s_editar" ).datepicker("option", "dateFormat","yy-mm-dd");

</script>

 </body>
