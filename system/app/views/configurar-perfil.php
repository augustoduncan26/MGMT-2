
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />

<script>

$('#cargando_add').hide()

// Add
function addPerfil () {

  var nombre      =   $('#nombre_perfil').val();
  var id_perfil   =   $('#id_perfil').val();
  var estado      =   $('#estado').val();


  if (nombre.length < 1 || id_perfil.length < 1) {
    $('#mssg-label').html('Estos campos son necesarios.');
    $('#nombre_perfil').css({'border-color': '#007AFF'});
    $('#id_perfil').css({'border-color': '#007AFF'});
    return false;
  }
    $('#cargando_add').show();
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/configurar-perfil.php?add=1&nombre="+nombre+"&idperfil="+id_perfil+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      listPerfiles();
      $('#cargando_add').hide();
      $('#nombre_perfil').val('');
      $('#id_perfil').val('');
    }
  }

  ajax2.send(null);
}

// Edit Room
function editPerfil ( id ) {
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


// List all room
function listPerfiles() {   

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_perfiles.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide()
      $('#list-table-users').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}


</script>

<body onload="listPerfiles();">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Perfil</a>

    <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i> Perfiles
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

<!-- Modal Edit  -->

<div class="modal fade" id="edit_perfil" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title">Editar Perfil</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
       <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateRoom(id_row)">Modificar</button>
          
      </div>
    </div>
  </div>
</div>
<!-- En Edit -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Add Perfil -->
  <div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
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
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre</td>
                   <td width="70%"><input autofocus="" name="nombre_perfil" required="" type="text" class="form-control" id="nombre_perfil" placeholder="Nombre Perfil"></td>
                 </tr>
                 
                 <tr>
                   <td>ID Perfil</td>
                   <td><input name="id_perfil" type="number" class="form-control" id="id_perfil" min="1" max="99" placeholder="ID Perfil" value="1"></td>
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
    //FormValidator.init();
    UIElements.init();
    //TableData.init();
    $('#list-table-users').dataTable({aaSorting : [[3, 'asc']]});
    });

    //$("#list-table-events").modal({"backdrop": "static"});
</script>

 </body>
