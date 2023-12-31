<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<style>
  @media (min-width: 768px) {
  .modal-xl {
    width: 90%;
   max-width:1350px;
  }
}
.table>tbody>tr>td { padding: 1px !important;}
.importer-container { display: none;}
</style>
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
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nueva Formula</a>
        <a data-toggle="modal" class="btn btn-default btn-button-importar"  role="button" href="#" ><i class="clip-download-3"></i> Importar</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
      </div>
    </div>

    <!-- Importar CSV -->
    <div class="row importer-container">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" action="?mante-formulas" enctype="multipart/form-data">
            <div class="col-md-12"><h5>Importar formulas</h5></div>
            <div class="col-md-4">
              <input type="file" class="form-control" id="" name="" />
            </div>
            <div class="col-md-4">
              <!-- <input type="submit" class="btn btn-primary" value="Importar Archivo CSV" /> -->
              <button class="btn btn-success">Importar Archivo CSV</button>
            </div>
            <div class="col-md-4">
              dd
            </div>
            </form>
        </div>
        </div>
        
      </div>
    </div>
    
   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-settings"></i>Administrar Formulas
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

               <div class="x_content">
               <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
               <div id="list-rows" style="width:100%;"></div>
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
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Formula</h3>
        </div>
          <form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <div id="mssg-alert" style="color:red;"></div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                <tr>
                  <td style="width:15%">Descripción <span class="symbol required"></td>
                  <td><input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="12" /></td>
                  <td colspan="2"><small>Nombre corto que describa el tipo de formula ó para que área y/o departamento esta dirigido. </small></td>
                </tr>
                 <tr>
                   <td>Áreas <span class="symbol required"></td>
                   <td>
                  <select name="areas[]" id="areas" multiple="multiple">
                      <?php
                        foreach ($listaAreas['resultado'] as $typeData) {
                          echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
                        }
                      ?>
                  </select>
                 <input type="checkbox" class="seleccionar-todas-areas" id="todas-areas-input" > <label for="todas-areas-input" class="cursor">Seleccionar Todas</label>
                 </td>
                 <td colspan="2"></td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado"  class="" id="estado">
                      <option value="1">Activo</option>
                      <option value="0" selected="">Inactivo</option>
                    </select>
                   </td>
                   <td colspan="2" style="width:20%"></td>
                 </tr>
               </tbody>
             </table>
             <p >
             <div class="row">
              <div class="col-md-2 mb-2 cursor cursor-underline add-row-table-formulas"><p>[+] Agregar fila</p></div>
              <div class="col-md-2 mb-2 cursor cursor-underline delete-row-table-formulas"><p>[-] Eliminar fila</p></div>
              <div class="col-md-2"></div>
              <div class="col-md-2"></div>
              <div class="col-md-2"></div>
              <div class="col-md-2 text-right"><!--<strong><?=$monthNameSpanish[$dayOfMonth]. " " .$actualYear?></strong>--></div>
            </div> 
            <p >
             <table class="table table-bordered table-hover" id="table-formulas">
              <thead>
              <tr>
              <?PHP 
              for($i	=	1	;	$i	<	32	;	$i++) {
                echo '<td style="width:40px;height: 20px;" data-orderable="false" label="c'.$i.'" title="Día '.$i.'">D'.$i.'</td>';	
              }
              ?>
              </tr>
              </thead>
            <tbody>
             
              <tr>
              <?PHP 
              for($i	=	1	;	$i	<	32	;	$i++) {
                echo '<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" type="text" data-orderable="false" name="f1" id="f1-'.$i.'" /></td>';	
              }
              ?>
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
<div class="modal fade" id="edit_event" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Formula</h3>
</div>

<form name="eventos" id="eeventos" method="post" action="#SELF" enctype="multipart/form-data">
  <div class="modal-body">
  <div id="mssg-edit" style="color:red;"></div>
  <table class="table table-bordered table-hover" id="sample-table-4">
    <thead>
    </thead>
    <tbody>
    <tr>
      <td style="width:15%">Descripción <span class="symbol required"></td>
      <td>
        <input class="form-control" type="text" id="descripcion_edit" name="descripcion_edit" maxlength="12" /><input type="hidden" id="id_row" />
        <input type="hidden" id="total_filas" />
      </td>
      <td colspan="2"><small>Nombre corto que describa el tipo de formula ó para que área y/o departamento esta dirigido. </small></td>
    </tr>
      <tr>
        <td>Áreas <span class="symbol required"></td>
        <td>
      <select name="areas_edit[]" id="areas_edit" multiple="multiple">
          <?php
            foreach ($listaAreas['resultado'] as $typeData) {
              echo '<option value="'.$typeData['id'].'">'.$typeData['name'].'</option> ';
            }
          ?>
      </select>
      <input type="checkbox" class="seleccionar-todas-areas-edit" id="todas-areas-input-edit" > <label for="todas-areas-input-edit" class="cursor">Seleccionar Todas</label>
      </td>
      <td colspan="2"></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td>
        <select name="estado_edit"  class="" id="estado_edit">
          <option value="1">Activo</option>
          <option value="0" selected="">Inactivo</option>
        </select>
        </td>
        <td colspan="2" style="width:20%"></td>
      </tr>
    </tbody>
  </table>
  <p >
  <div class="row">
  <div class="col-md-2 mb-2 cursor cursor-underline add-row-table-formulas-edit"><p>[+] Agregar fila</p></div>
  <div class="col-md-2 mb-2 cursor cursor-underline delete-row-table-formulas-edit"><p>[-] Eliminar fila</p></div>
  <div class="col-md-2"></div>
  <div class="col-md-2"></div>
  <div class="col-md-2"></div>
  <div class="col-md-2 text-right"><!--<strong><?=$monthNameSpanish[$dayOfMonth]. " " .$actualYear?></strong>--></div>
  </div> 
  <p >
  <table class="table table-bordered table-hover" id="table-formulas-edit">
  <thead>
  <tr>
  <?PHP 
  for($i	=	1	;	$i	<	32	;	$i++) {
    echo '<td style="width:40px;height: 20px;" data-orderable="false" label="c'.$i.'" title="Día '.$i.'">D'.$i.'</td>';	
  }
  ?>
  </tr>
  </thead>
  <tbody>
  
  <tr>
  <?PHP 
  for($i	=	1	;	$i	<	32	;	$i++) {
    echo '<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" type="text" data-orderable="false" name="fe1" id="fe1-'.$i.'" /></td>';	
  }
  ?>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="modal-footer">
  <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
  <input name="update_formula" type="button" class="btn btn-primary" onclick="var id_row = $('#id_row').val(); updateRow(id_row)" value="Modificar datos">

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
/** Trigger Importar Formulas */
$('.btn-button-importar').on('click', () => {
  $('.importer-container').toggle();
});

/** Select all areas */
$(".seleccionar-todas-areas").click(function(){
    if($(".seleccionar-todas-areas").is(':checked') ){
        $("#areas > option").prop("selected","selected");
        $("#areas").trigger("change");
    } else {
        $("#areas").val(null).trigger('change');
    }
});

$(".seleccionar-todas-areas-edit").click(function(){
    if($(".seleccionar-todas-areas-edit").is(':checked') ){
        $("#areas_edit > option").prop("selected","selected");
        $("#areas_edit").trigger("change");
    } else {
        $("#areas_edit").val(null).trigger('change');
    }
});

/** Add row to table / Modal Add */
let daysInMonth = '<?php echo ($daysInMonth + 1);?>';
let tbody = $('#table-formulas').children('tbody');
let table = tbody.length ? tbody : $('#table-formulas');
let r     = 1;
$('.add-row-table-formulas').click(function(){
    let tdCol = "";
    let rowCount = $('#table-formulas tr').length;
    for(i	=	1	;	i	<	32	;	i++) {
      tdCol += `<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="f`+rowCount+`" id="f`+rowCount+`-`+i+`" /></td>`;
    }
    table.append(`<tr>`+tdCol+`</tr>`);
});
/** Add row to table / Modal Edit */
$('.add-row-table-formulas-edit').click(function(){
  let daysInMonth = '<?php echo ($daysInMonth + 1);?>';
  let tbody = $('#table-formulas-edit').children('tbody');
  let table = tbody.length ? tbody : $('#table-formulas-edit');
  let tdCol = "";
  let rowCount = $('#table-formulas-edit tr').length;
  for(i	=	1	;	i	<	32	;	i++) {
    tdCol += `<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="fe`+rowCount+`" id="fe`+rowCount+`-`+i+`" /></td>`;
  }
  table.append(`<tr>`+tdCol+`</tr>`);
});

/** Delete row from table / Modal Add */
$('.delete-row-table-formulas').click(function(){
    let rowCount = $('#table-formulas tr').length;
    if (rowCount > 2 ) {
      $('#table-formulas tr:last').remove();
    }
});
/** Delete row from table / Modal Edit */
$('.delete-row-table-formulas-edit').click(function(){
  let totalFilasEdit  = $('#total_filas').val();
  let rowCountEdit    = $('#table-formulas-edit tr').length;
  if (totalFilasEdit != (rowCountEdit) ) {
    $('#table-formulas-edit tr:last').remove();
  }
})

/** List Results */
const listResultTable = () => {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_cia      = '<?php echo $_SESSION["id_cia"]?>';
  $('.fa-spinner').show();
  var contenido_editor = $('#list-rows')[0];
  let route = "ajax/ajax_list_formulas.php"; 

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
  let route = "app/controllers/mante-formulas.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>";
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
  
  let descripcion = $('#descripcion').val();
  let areas       = $('#areas').val();
  let estado      = $('#estado').val();
  let f1          = $('#f1').val();
  let f2          = $('#f2').val();
  let f3          = $('#f3').val();
  let f4          = $('#f4').val();
  let f5          = $('#f5').val();

  if ( descripcion == '' || areas == '') {
    $("#mssg-alert").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },3000);
      return false
  }

  if (f1 == '' || f2 == '' || f3 == '' || f4 == '' || f5 == '') {
    $("#mssg-alert").show().html('<div class="alert alert-danger">Debe agregar como mínimo una fila para la formula');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },3000);
      return false
  }

  let filas     = [];
  let rowCount  = $('#table-formulas tr').length;

  for (i = 0 ; i < 32; i++) {
    for (y=1;y<rowCount;y++) {
      if($("#f"+y+"-"+i).val()==""){
        $("#mssg-alert").show().html('<div class="alert alert-danger">Debe agregar como mínimo una fila para la formula');
        setTimeout(()=>{
          $("#mssg-alert").hide();
        },3000);
        return false
      }
    }
  }

  for (i = 1; i < 32; i++) {
    for (y=1;y<rowCount;y++) {
      filas.push($("#f"+y+"-"+i).val());
    }
  }

  let route = "app/controllers/mante-formulas.php";

  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
        add           : 1,
        descripcion   : descripcion,
        areas         : areas,
        filas         : filas,
        tot_filas     : (rowCount-1),
        estado        : estado,
    },
    dataType        : 'html',
    success         : function (response) { 
      $('.fa-spinner').hide();
      if (response == "EXISTE") {
        $("#mssg-alert").show().html('<div class="alert alert-danger">Ya existe un registro con este nombre de descripción.</div>');
        setTimeout(() => {
          $(".alert-exito").hide();
          $(".alert-danger").hide();
          $("#mssg-alert").hide();
        }, 3000);
      } else {
        $("#mssg-alert").show().html(response);
        listResultTable();
        setTimeout(() => {
          $(".alert-exito").hide();
          $(".alert-danger").hide();
          $("#mssg-alert").hide();
        }, 3000);

        $("input[id^='f']").val('');
        $("#areas").val(null).trigger('change');
        $("#departamento").val(null).trigger('change');
        $(".seleccionar-todas-areas").prop('checked',false);
        $("#nombre").val('');
        $("#nombre").focus();
      }
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
  let route = "app/controllers/mante-formulas.php";

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

    let numF = 0;
    let tbody = $('#table-formulas-edit').children('tbody');
    let table = tbody.length ? tbody : $('#table-formulas-edit');
    numF = response.data_formulas['total'];
    
    $("input[id^='f']").val('');
    $('#table-formulas-edit tr:last').remove();

    if (numF > 1) {
      $('#table-formulas-edit tbody tr').remove();
      for (x = 0 ; x < numF; x++) {
        
        let tdCol2 = "";
        let rowCount = $('#table-formulas-edit tr').length;
        
        for(i	=	1	;	i	<	32	;	i++) {
          tdCol2 += `<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="fe`+rowCount+`" id="fe`+rowCount+`-`+i+`" value="`+response.data_formulas.resultado[x]['c'+i]+`" /></td>`;
        }

        table.append(`<tr>`+tdCol2+`</tr>`);

      }
    } else {
      $('#table-formulas-edit tbody tr').remove();
      let tdCol3 = "";
      let rowCount = $('#table-formulas-edit tr').length;
      for(i	=	1	;	i	<	32	;	i++) {
        tdCol3 += `<td ><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="fe`+rowCount+`" id="fe`+rowCount+`-`+i+`" value="`+response.data_formulas.resultado[0]['c'+i]+`" /></td>`;
      }
      table.append(`<tr>`+tdCol3+`</tr>`);
    }

      let arr   = response.data['id_area'].split (",");
      let keys  = Object.keys(arr).length;
      let r  = "";
      arr.forEach((item,key)=>{
        if (item) {
          r =  arr + ',';
          $('#areas_edit').val(arr).change();
        }
      });
      
      numF = 0;
      $('#total_filas').val(response.data_formulas['total']+1);
      $('#descripcion_edit').val(response.data['descripcion']);
      $('#id_row').val(response.data['id']);
      $('#estado_edit').select2('val',response.data['active']);
     
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
  var descripcion = $('#descripcion_edit').val();
  //var depto       = $('#txt_departamento').val();
  let areas       = $('#areas_edit').val();
  var estado      = $('#estado_edit').val();
  $('#mssg-edit').css({'width':'100%'})

  if ( descripcion == '' || areas == '') {
    $("#mssg-edit").show().html('<div class="alert alert-danger">Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-edit").hide();
    },3000);
      return false
  }

  let filas     = [];
  let rowCount  = $('#table-formulas-edit tr').length;

  for (i = 1 ; i < 32; i++) {
    for (y=1;y<rowCount;y++) {
      //console.log($("#fe"+y+"-"+i).val());
      //console.log(y,i)
      if($("#fe"+y+"-"+i).val()==""){
        
        $("#mssg-edit").show().html('<div class="alert alert-danger">Debe agregar como mínimo una fila para la formula');
        setTimeout(()=>{
          $("#mssg-edit").hide();
        },3000);
        return false
      }
    }
  }

    for (y=1;y<rowCount;y++) {
      for (i = 1; i < 32; i++) {
      filas.push($("#fe"+y+"-"+i).val());
    }
  }

  let route = "app/controllers/mante-formulas.php";
  $.ajax({
    headers: {
      Accept        : "application/json; charset=utf-8",
      "Content-Type": "application/json: charset=utf-8"
    },
    url: route,
    type: "GET",
    data: {
      id  : id,
      descripcion  : descripcion,
      areas       : areas,
      filas       : filas,
      tot_filas   : (rowCount-1),
      estado      : estado,
      edit        : 1,
      nocache     : '<?php echo rand(99999,66666)?>', 
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


// Make some default options
//$("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
//$("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});

//$(document).ajaxStop(function() { 
let loadDataTable = () => {
setTimeout(() => {
    $("#list-table-formulas").dataTable().fnDestroy();
    $('#list-table-formulas').DataTable({
        // columnDefs: [
        //     { width: "2%", targets: 0 }
        // ],
        // fixedColumns: true,
        "columnDefs": [{
        "orderable": false,
        "targets": [34]
        }],
        "scrollX": true,
        "scrollY": 400,
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
$("[name='estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#areas").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#areas_edit").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#horarios").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#grupo").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#tipo_horario").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='txt_departamento']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#txt_areas").select2({ width: '100%', dropdownCssClass: "bigdrop"});

</script>