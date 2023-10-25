
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />


<script>

// Add room
function addCliente () {

  var nombre      =   $('#nombre_cliente').val();
  var telefono    =   $('#telefono_cliente').val();
  var email       =   $('#email_cliente').val();
  var direccion   =   $('#txt_direccion_new').val();
  var estado      =   $('#estado').val();

  var   latitude      = $('#txt_latitude').val();
  var   longitude     = $('#txt_longitude').val();

  if (nombre.length < 1) {
    $('#mssg-label').html('Los campos con (*) necesarios.');
    $('#nombre_cliente').css({'border-color': '#007AFF'});
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-clientes.php?add=1&nombre="+nombre+"&telefono="+telefono+"&email="+email+"&latitude="+latitude+"&longitude="+longitude+"&direccion="+direccion+"&estado="+estado+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#mssg-label').html(ajax2.responseText);
      listClientes();
      $('#nombre_cliente').val('');
      $('#telefono_cliente').val('');
      $('#email_cliente').val('');
      $('#direccion_cliente').val('');
    }
  }

  ajax2.send(null);
}


// Update data of type Room
function updateCliente ( id ) {

  var   nombre        = $('#txt_nombre').val();
  var   telefono      = $('#txt_telefono').val();
  var   email         = $('#txt_email').val();
  var   direccion     = $('#txt_direccion').val();
  var   latitude      = $('#txt_latitude').val();
  var   longitude     = $('#txt_longitude').val();

  var   activo        = $('#txt_activo').val();
  var   id            = $('#id_row').val();

    if( nombre=='') {
    $('#txt_mssg-label').html('Los campos con (*) son necesarios.');
    $('#txt_nombre').css({'border-color': '#007AFF'});
    return false;
  }

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-clientes.php?edit=1&telefono="+telefono+"&nombre="+nombre+"&email="+email+"&latitude="+latitude+"&longitude="+longitude+"&direccion="+direccion+"&id="+id+"&activo="+activo+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#txt_mssg-label').html(ajax2.responseText);
      listClientes();
    }
  }

  ajax2.send(null);

}

// Edit Customer
function editCliente ( id ) {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#show-edit-room')[0];
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_modificar-cliente.php?id="+id+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}


// List Customers
function listClientes() {   

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  $('#cargando_list').show();
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_clientes.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);    
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#cargando_list').hide();
      $('#list-table-room').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}

// Delete row
function deleteRow ( id ) {

    ajax2   = nuevoAjax();
    ajax2.open("GET", "app/controllers/planning-clientes.php?delete=1&id="+id+"&nocache=<?php echo rand(99999,66666)?>",true);
    ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      $('#label-mssg').html(ajax2.responseText);
      listRoom();
    }
  }

  ajax2.send(null);
}


function limpiar () {
  $('#txt_mssg-label').html('');
}

</script>

<body onload="listClientes();">


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
    <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo_cliente" onclick="$('#nombre').focus();">[+] Nuevo Cliente</a>

    <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="clip-calendar"></i>Administrar clientes
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

<!-- Modal Add Room -->
<?php get_view_part ( 'agregar-nuevo-cliente' )?>
<!-- En Add Room -->

<!-- Modal Add Room -->
<?php //get_view_part ( 'modificar-habitacion' )?>
<!-- En Add Room -->

<!-- Edit Room -->
  <div class="modal fade" id="edit_room" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Cliente</h3>
           <label id="txt_mssg-label"></label>
        </div>
      <div class="modal-body" id="show-edit-room">
        Cargando...
      </div>
      <div class="modal-footer">
          <!--<input name="btn_edit_room" type="submit" class="btn btn-success" id="btn_edit_room" onClick="updateRoom('<?=$data->id;?>')" value="Modificar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_edit_room" onClick="var id_row = $('#id_row').val(); updateCliente(id_row)">Modificar datos</button>
          
      </div>
    </div>
  </div>
</div>
<!-- End Edit Room -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        width:  100% !important;
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
.pac-container {
        z-index: 10000 !important;
    }
</style>
<!-- Modal -->
   <div id="myModalMap" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ubicación</h4>
                    </div>
                    <div class="modal-body" id="modal-body">

                        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <div id="map" style="width: 580px; height:400px"></div>
                    </div>
                    <div class="modal-footer" id="modal-footer">

                    </div>
                </div>
            </div>
        </div>


<!--
<form name="hijos" id="hijos" method="post" action="#SELF" enctype="multipart/form-data">
  <input type="hidden" name="id_colegio" value="<?php echo $id_colegio; ?>">
  <div class="modal-body">
  <table class="table table-bordered table-hover" id="sample-table-4">
  <thead>
  </thead>
  <tbody>
  <tr>
  <td nowrap="nowrap"  >N° de Venta</td>
  <td colspan="2"><input name="venta" class="form-control"  ></td>
  </tr>
  <tr>
  <td width="187">Fecha de carga</td>
  <td width="159"   ><input style="width:120px" value="<?php echo $fechadehoysimple; ?>" name="fecha_carga" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" id="fecha_carga" > </td>
  <td width="452"   >
  <div class="input-group input-append bootstrap-timepicker">
  <input  name="hora_carga" class="form-control time-picker">
  <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
  </div>
  </td>
  </tr>  

  <td nowrap="nowrap"  >Despachante de aduana</td>
  <td colspan="2"    ><select name="despachante" class="form-control" ><?php $b=mysql_query("select * from despachante_aduana order by nombre"); while ($s=mysql_fetch_array($b)) { ?><option value="<?php echo $s[0]; ?>"><? echo $s[nombre]; ?></option><? } ?></select></td>
  </tr> 
  <tr>
  <td nowrap="nowrap"  >Destino / Sanitario</td>
  <td colspan="2"><input name="destino" class="form-control" id="destino" ></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Exportador</td>
  <td colspan="2"><? $busco_exp=mysql_query("select * from exportador order by nombre"); 
  while ($saco_exp=mysql_fetch_array($busco_exp)) {  ?><label><input  type="checkbox" name="exportador[<? echo $saco_exp[0]; ?>]" >  <? echo $saco_exp[nombre]; ?></label> &nbsp; &nbsp; <?php } ?></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >P.E. N°</td>
  <td colspan="2"><input name="pe" class="form-control"></td>
  </tr>           
  <tr>
  <td nowrap="nowrap"  >Precinto de Aduana</td>
  <td colspan="2"><input name="precinto" class="form-control"></td>
  </tr>  
  <tr>
  <td nowrap="nowrap"  >Vapor</td>
  <td colspan="2"><input name="vapor" class="form-control"  ></td>
  </tr>

  <tr>
  <td nowrap="nowrap"  >Consolida en</td>
  <td colspan="2"    ><select name="consolida_en" class="form-control" ><?php $b=mysql_query("select * from consolida_en order by nombre"); while ($s=mysql_fetch_array($b)) { ?><option value="<?php echo $s[0]; ?>"><?php echo $s['nombre']; ?></option><?php } ?></select></td>
  </tr> 

  <tr>           
  <tr>
  <td nowrap="nowrap"  >Entrega Full</td>
  <td colspan="2"    ><select name="entrega_full" class="form-control" ><?php $b=mysql_query("select * from entrega_full order by nombre"); while ($s=mysql_fetch_array($b)) { ?><option value="<?php echo $s[0]; ?>"><?php echo $s['nombre']; ?></option><?php } ?></select></td>
  </tr> 

  <tr>
  <td nowrap="nowrap"  >Transporte Terrestre</td>
  <td colspan="2"    ><select name="transporte_terrestre" class="form-control" ><?php $b=mysql_query("select * from transporte_terrestre order by nombre"); while ($s=mysql_fetch_array($b)) { ?><option value="<?php echo $s[0]; ?>"><?php echo $s['nombre']; ?></option><?php } ?></select></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Datos del Chofer</td>
  <td colspan="2"><input name="chofer" class="form-control" id="chofer" ></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Datos del Camion</td>
  <td colspan="2"><input name="camion" class="form-control" id="camion" ></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Depósito Destino</td>
  <td colspan="2"    ><select name="deposito" class="form-control" ><?php $b=mysql_query("select * from deposito order by nombre"); while ($s=mysql_fetch_array($b)) { ?><option value="<?php echo $s[0]; ?>"><?php echo $s['nombre']; ?></option><?php } ?></select></td>
  </tr> 



  <tr>
  <td nowrap="nowrap"  >Alertas</td>
  <td colspan="2"><?php $busco_usuarios=mysql_query("select * from alertas order by nombre"); 
  while ($saco_usuarios=mysql_fetch_array($busco_usuarios)) {  ?><label><input  type="checkbox" name="alertar[<?php echo $saco_usuarios[0]; ?>]" >  <?php echo $saco_usuarios['nombre']; ?></label> &nbsp; &nbsp; <?php } ?></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Comentarios</td>
  <td colspan="2"><input name="comentarios" class="form-control" id="comentarios" ></td>
  </tr>
  <tr>
  <td nowrap="nowrap"  >Comentario Destacado</td>
  <td colspan="2"><input name="comentario_destacado" class="form-control" id="comentario_destacado" ></td>
  </tr>

  </tbody>
  </table>

  </div>
  <div class="modal-footer">
  <input  name="crear_orden" type="submit" class="btn btn-success" id="crear_orden" value="Crear orden de carga">
  <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">Cerrar</button>

  </div>
</form>
  -->            

<script>
// This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
            var map;

            function initAutocomplete() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.8688, lng: 151.2195},
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();
                    
                    if (places.length == 0) {
                        return;
                    }
                    
                     for (var i = 0, place; place = places[i]; i++) {

                          $('#txt_latitude').val(place.geometry.location.lat());
                          $('#txt_longitude').val(place.geometry.location.lng());
                          //alert("latitude: "+place.geometry.location.lat()+" longitude: "+place.geometry.location.lng());
                     };


                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });

                    map.fitBounds(bounds);

                });
            }
//alert(map.getCurrentPosition())

// Save Geolocation
$('#myModalMap').on('hidden.bs.modal', function () {

  //if ( $('#txt_direccion').val() !='') { direccion = $('#txt_direccion').val() } else { direccion = $('#txt_direccion_new').val() } 
  
  if ( $( "#txt_direccion" ).length > 0 ) {
 
    $('#txt_direccion').val($('#pac-input').val());
 
  } else {
    $('#txt_direccion_new').val($('#pac-input').val());
  }

  
});



$("#myModalMap").on("shown.bs.modal", function () {

    //$('#pac-input').val($('#txt_direccion').val());
    //$('#pac-input').trigger('click');
    if ( $('#txt_latitude').val() !='') { lat = $('#txt_latitude').val() } else { lat = $('#txt_latitude_new').val() } 
    if ( $('#txt_longitude').val() !='') { long = $('#txt_longitude').val() } else { long = $('#txt_longitude_new').val() } 
    if ( $('#txt_direccion').val() !='') { direccion = $('#txt_direccion').val() } else { direccion = $('#txt_direccion_new').val() } 
    
    
    $('#pac-input').val(direccion);
    $('#pac-container').trigger('click');
    $('#pac-input').trigger('click');

    
    if ( lat != '' && lat != undefined && long != '' && long != undefined) {

      currCenter  = new google.maps.LatLng(lat,long);
      var marker = new google.maps.Marker({
          position: currCenter,
          map: map,
          zoom: 15,
          title: 'Hello World!'
        });

      
      google.maps.event.trigger(map, 'resize');map.setCenter(currCenter);
      //map.setCenter(new google.maps.LatLng(lat,long));
      
    } else { 

      google.maps.event.trigger(map, 'resize');
      map.setCenter(new google.maps.LatLng(-34.6154611,-58.5733847));
    }

});



    </script>
<!--   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdR4ykS2MG9YvMrYsJo29_xgYYuMZlOPc&libraries=places&callback=initAutocomplete"
         async defer></script>
-->

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm8g595l3ushI1n1dp4uDlR9cXk1S0nxQ&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
    //UIElements.init();
    TableData.init();
    $('#list-table-room').dataTable({
      aaSorting : [[3, 'asc']],
      responsive: true
    });
    //$('#example').DataTable();
  });
    </script>
<script>
// $('#formulario_nuevo').on('hidden.bs.modal', function() {
//   this.modal('show');
// });

// $("#list-table-room").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();
</script>

 </body>
