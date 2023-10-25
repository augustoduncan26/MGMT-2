<?php

$P_Tabla 		=	"caja_category";

if ($_SESSION['id_empresa'] == 1 || $_SESSION['id_empresa'] == 2) {

  $selCat     = mysql_query("Select * From ".$P_Tabla." Where activo = 1")or die(mysql_error());

} else {
  
  $selCat     = mysql_query("Select * From ".$P_Tabla." Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1");

}
?>
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>

// Add Category
function addProductos () {

  var codigo_barra   =   $('#codigo_barra').val();
  var cantidad       =   $('#cantidad').val();
  var descripcion    =   $('#descripcion').val();
  var categoria      =   $('#categoria').val();
  var stock_minimo   =   $('#stock_minimo').val();
  var precio_costo   =   $('#precio_costo').val();
  var precio_venta   =   $('#precio_venta').val();
  var estado      	 =   $('#estado').val();
  var imagen         =   $('#product_image').prop('files')[0];

  var   id_empresa    = "<?php echo $_SESSION['id_empresa'];?>";
  
  var nuevo_nombre    = id_empresa +'-'+imagen;

  if (descripcion.length < 1 || categoria.length < 1 || precio_venta.length < 1 || stock_minimo.length < 1 || precio_costo.length < 1) {
    $('#mssg-label').html('Los campos con (*) son necesarios.');
    $('#nombre').css({'border-color': '#007AFF'});
    return false;
  }
    //$('#cargando_add').show()
    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/caja-productos.php?add=1&cantidad="+cantidad+"&imagen="+nuevo_nombre+"&precio_venta="+precio_venta+"&codigo_barra="+codigo_barra+"&precio_costo="+precio_costo+"&stock_minimo="+stock_minimo+"&categoria="+categoria+"&descripcion="+descripcion+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      listProducts();
      uploadPhoto ( false , nuevo_nombre );
      $('#descripcion').val('');
      $('#categoria').val('');
      $('#cantidad').val('');
      $('#stock_minimo').val('');
      $('#precio_costo').val('');
      $('#precio_venta').val('');

      $('#product_image').attr('src', false);
      $('#image_preview').attr('src', false);
      $('#product_image').val('');
      $('#image_preview').val('');
    }
  }

  ajax2.send(null);

}

//Update Product data
// function UpdateProduct2 ( id ) {

//   var form_data   =   new FormData();
//   var   codigo_barra  = $('#txt_barcode').val();
//   var   descripcion   = $('#txt_descripcion').val();
//   var   categoria     = $('#txt_categoria').val();
//   var   cantidad      = $('#txt_cantidad').val();
//   var   stock_minimo  = $('#txt_stock_minimo').val();
//   var   precio_costo  = $('#txt_precio_costo').val();
//   var   precio_venta  = $('#txt_precio_venta').val();
//   var   estado        = $('#txt_estado').val();
//   var   id            = $('#id_row').val();
//   var   edit          = 1;
//   var   imagen        = $('#txt_product_image').prop('files')[0];


//   if( descripcion =='' || categoria =='' || cantidad == '' || stock_minimo == '' || precio_costo == '' || precio_venta == '') {

//       $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
//       $('#txt_descripcion').css({'border-color': '#007AFF'});
//       $('#txt_categoria').css({'border-color': '#007AFF'});
//       $('#txt_cantidad').css({'border-color': '#007AFF'});
//       $('#txt_stock_minimo').css({'border-color': '#007AFF'});
//       $('#txt_precio_costo').css({'border-color': '#007AFF'});
//       $('#txt_precio_venta').css({'border-color': '#007AFF'});
  
//     return false;
//   }

//       //mostrar('cargando_1'); 
//       form_data.append('codigo_barra', codigo_barra);
//       form_data.append('descripcion', descripcion);
//       form_data.append('categoria', categoria);
//       form_data.append('cantidad', cantidad);
//       form_data.append('stock_minimo', stock_minimo);
//       form_data.append('precio_costo', precio_costo);
//       form_data.append('precio_venta', precio_venta);
//       form_data.append('estado', estado);
//       form_data.append('edit', edit);

//       form_data.append('file', imagen);
//       form_data.append('id', id);

//       $.ajax({
//       url: 'app/controllers/caja-productos.php?', 
//       dataType: 'text', // what to expect back from the PHP script
//       cache: false,
//       contentType: false,
//       processData: false,
//       data: form_data,
//       type: 'post',
//       success: function (response) {
//         $('#txt_mssg-label').html(response);
//         listProducts();
//       },
//         error: function (response) {
//             $('#txt_mssg-label').html('<font color:#ff0000e6>'+ response + '</font>'); // display error response from the PHP script
//         }

//       });

// }
// Update data of type Room
function updateProduct ( id ) {

  var   codigo_barra  = $('#txt_codigo_barra').val();
  var   descripcion   = $('#txt_descripcion').val();
  var   categoria     = $('#txt_categoria').val();
  var   cantidad      = $('#txt_cantidad').val();
  var   stock_minimo  = $('#txt_stock_minimo').val();
  var   precio_costo  = $('#txt_precio_costo').val();
  var   precio_venta  = $('#txt_precio_venta').val();
  var   estado        = $('#txt_estado').val();
  var   id            = id ;
  //var   imagen         =   $('#txt_product_image').prop('files')[0];
  var   imagen         =   $('#txt_product_image').val();
  var   id_empresa    = "<?php echo $_SESSION['id_empresa'];?>";
  
  var nuevo_nombre    = id_empresa +'-'+imagen;

    if( descripcion =='' || categoria =='' || cantidad == '' || stock_minimo == '' || precio_costo == '' || precio_venta == '') {

      $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
      $('#txt_descripcion').css({'border-color': '#007AFF'});
      $('#txt_categoria').css({'border-color': '#007AFF'});
      $('#txt_cantidad').css({'border-color': '#007AFF'});
      $('#txt_stock_minimo').css({'border-color': '#007AFF'});
      $('#txt_precio_costo').css({'border-color': '#007AFF'});
      $('#txt_precio_venta').css({'border-color': '#007AFF'});
  
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("POST", "app/controllers/caja-productos.php?edit=1&cantidad="+cantidad+"&precio_venta="+precio_venta+"&imagen="+nuevo_nombre+"&codigo_barra="+codigo_barra+"&precio_costo="+precio_costo+"&stock_minimo="+stock_minimo+"&categoria="+categoria+"&descripcion="+descripcion+"&id="+id+"&activo="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);

      if ( imagen !='' ) { 
        uploadPhoto( id , false);
      }

      $('#image_preview').attr('src','images/products-images/');
      listProducts();
    }
  }

  ajax2.send(null);

}



/// Subir fotos dependiendo de la opcion
function uploadPhoto ( id , name ) {

var file   = $('#txt_product_image').prop('files')[0];
//var file  = la_foto.files[0];

var data = new FormData();

data.append('id', id);

if ( name !='' ) { data.append('la_foto', name); } else { data.append('la_foto',file); }

$.ajax({
  url: "ajax/ajax_subir_foto_productos.php",
  type: "post",
  dataType: "html",
  contentType: false,
  data: data,
  cache: false,
  processData: false
})
  .done(function(res){
    $('#txt_mssg-label').html(res);
    listProducts();
  });
}

// Edit Room
function editProduct ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-room')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-productos.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      //listProducts()
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}


// List all category
function listProducts() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show()
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_products.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide();
      $('#list-table-products').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}


// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/caja-productos.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listProducts();
    }
  }

  ajax2.send(null);
}

// Preview Image Upload
function readURL( input ) {
// Logo

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#timage_preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }

}

// Preview Logo
jQuery("#txt_product_image").change(function() {
  readURL(this);
});

function limpiar () { 
  $('#mssg-label').html('');
  $('#txt_mssg-label').html('');
}

// Make some default options
$("#txt_precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});
$("#precio").change(function(){this.value = parseFloat(this.value).toFixed(2);});


</script>

<body onload="listProducts();">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Agregar Producto</a>
   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-qrcode"></i>Administrar Productos
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

<!-- Modal Add Product -->
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Producto</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>

                <tr>
                   <td width="30%">Código</td>
                   <td width="70%"><input maxlength="50" autofocus="" name="codigo_barra" type="text" class="form-control" id="codigo_barra" placeholder="Codigo de Barra del Producto"></td>
                 </tr>

               	<tr>
                   <td width="30%">Descripción <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="descripcion" required="" type="text" class="form-control" id="descripcion" placeholder="Descripción"></td>
                 </tr>

                 <tr>
                   <td width="30%">Categoría <span class="symbol required"></span></td>
                   <td width="70%">
                   <select name="categoria" id="categoria" required="" class="form-control">
						        <option value="">-----seleccionar-----</option>
                   		<?php 
                          while ($dataCat = mysql_fetch_object($selCat)) {
                          	echo '<option value="'.$dataCat->id.'">'.$dataCat->name.'</option>';
                          }
                   		?>
                   </select>
                   </td>
                 </tr>
                 <tr>
                 	<td>Imagen</td>
                 	<td>
                 		<input type='file' id="product_image" />
  						<img id="image_preview" style="width: 100px; height: 100px; margin-left: 100px" src="#" alt="" />
                 	</td>
                 </tr>

				<tr>
                   <td width="30%">Cantidad <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="11" autofocus="" name="cantidad" required="" type="number" min="1" step="1" class="form-control" id="cantidad" placeholder="Cantidad"></td>
                 </tr>
                 <tr>
                   <td width="30%">Stock Mínimo <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="stock_minimo" required="" type="number" min="1" step="1" class="form-control" id="stock_minimo" placeholder="Stock Mínimo"></td>
                 </tr>

                 <tr>
                   <td width="30%">Precio Compra<span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="precio_costo" required="" type="number" min="1" step="1" class="form-control" id="precio_costo" placeholder="Precio Costo"></td>
                 </tr>

                 <tr>
                   <td width="30%">Precio Venta <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="precio_venta" required="" type="number" min="1" step="1" class="form-control" id="precio_venta" placeholder="Precio Venta"></td>
                 </tr>

                 <!-- <tr>
                   <td width="30%">Descripción <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="descripcion" required="" type="text" class="form-control" id="descripcion" placeholder="Descripción"></td>
                 </tr> -->
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
          <button  type="button" class="btn btn-primary" id="agregar_habitacion" onClick="addProductos()">Guardar datos</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>

<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Edit Product -->
  <div class="modal fade" id="edit_room" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Producto</h3>
          <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
       <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateProduct(id_row)">Modificar datos</button>
          
      </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->

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
    TableData.init();
  $('#list-table-products').dataTable({aaSorting : [[3, 'asc']]});
});
    </script>
<script>

// Preview Image Upload
function readURL( input ) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#image_preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}


// Preview Logo
jQuery("#product_image").change(function() {
  readURL(this);
});

// Preview Logo
jQuery("#txt_product_image").change(function() {
  readURL(this);
});



$("#list-table-room").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();
</script>

 </body>
