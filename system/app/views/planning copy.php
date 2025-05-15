<style>
@media (min-width: 768px) {
  .modal-xl {
    width: 70%;
    max-width:1350px;
  }
}
.fade {
  overflow:hidden;
}
</style>
<body>

<div class="">
      <!-- <h3>Planners</h3> -->
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
            <div class="col-sm-12">
              <!-- start: FULL CALENDAR PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-calendar"></i>Planners
                  <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                      <i class="fa fa-refresh"></i>
                    </a>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="col-sm-12">
                    <div id='calendar'></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end: FULL CALENDAR PANEL -->
    </div>
    <!-- end: PAGE CONTENT-->
</div>
<!-- Page Content -->
       

<!-- Modal Add -->
<div class="modal fade" id="ModalAdd"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar al Planner</h3>
        </div>
         <form name="add_eventos" id="add_eventos" method="post" action="#SELF">
           <div class="modal-body">
             <div class="alert alert-danger" id="mssg-add-eventos"><h5>Todos los campos son necesarios</h5></div>
             <table class="table table-hover" id="table-eventos">
               <thead>
               </thead>
               <tbody>
                 <tr>
                    <td width="15%">Titulo <span class="symbol required"></span>
                    </td>
                    <td width="35%"><input maxlength="40" name="titulo_add" type="text" class="form-control" id="titulo_add" placeholder="Agregar un Tiítulo"></td>
                    <td width="15%">Tipo de Evento <span class="symbol required"></span></td>
                    <td width="35%">
                    <select required="required" id="tipo_evento" name="tipo_evento">
                      <option value="">seleccione</option>
                      <option value="A">Asignación Especial</option>
                      <option value="E">Evento</option>
                      <option value="X">Exámen</option>
                      <option value="T">Tarea</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                   <td width="15%">Fecha Inicio <span class="symbol required"></span>
                    </td> 
                    <td width="35%">
                      <input type="date" name="start" class="form-control" id="start" readonly>
                      <small class="color-gray">Formato: [mes/dia/año] </small>
                    </td>
                    <td width="15%">Hora Inicio <span class="symbol required"></span>
                  </td>
                    <td width="35%">
                      <input autofocus="" name="event_add_hora_ini"  type="time" class="form-control" id="event_add_hora_ini" placeholder="Hora de Inicio" >
                    </td>
                  </tr>

                 <tr>
                   <td width="15%">Fecha Fin <span class="symbol required"></span>
                  </td> 
                   <td width="35%"><input type="date" name="end" class="form-control" id="end" readonly>
                   <small class="color-gray">Formato: [mes/dia/año] </small>
                  </td>
                   <td width="15%">Hora Fin <span class="symbol required"></span>
                  </td>
                   <td width="35%"><input autofocus="" name="event_add_hora_fin" type="time" class="form-control" id="event_add_hora_fin" placeholder="Hora Final"></td>
                </tr>

                 <tr>
                 <td width="15%">Clase <!--<span class="symbol required"></span>-->
                  </td>
                   <td width="35%">
                    <select name="event_class_add" id="event_class_add" multiple>
                        <!-- <option>seleccionar</option> -->
                        <?php 
                          if ($selectClases['resultado']) {
                            foreach ($selectClases['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['class_name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                    <lable class="color-gray">Seleccionar todos <input type="checkbox" id="select_classes" /> </lable>
                   </td>
                   <td width="15%">Perfil <!--<span class="symbol required"></span>-->
                  </td>
                 <td width="35%">
                    <select name="event_perfil_add[]" id="text_event_perfil_add" multiple style="width: 250px !important;">
                        <!-- <option></option> -->
                        <?php 
                          if ($selectPerfiles['resultado']) {
                            foreach ($selectPerfiles['resultado'] as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                          }
                        ?>
                    </select>
                    <label class="color-gray">Seleccionar todos <input type="checkbox" id="select_perfiles" /> </label>
                   </td>
                 </tr>
                 <tr>
                 <td>Estado</td>
                   <td>
                    <select name="event_estado_add"  class="form-control" id="event_estado_add">
                      <option value="1">Activo</option>
                      <option value="0" selected>Inactivo</option>
                    </select>
                   </td>
                   <td>Definir Color</td>
                   <td>
                   <select name="tipo_color" id="tipo_color">
                   <option style="background-color: #3a87ad;" value="#3a87ad" selected>Default </option>
                    <option style="background-color: rgb(255, 140, 0);" value="#ff8c00">Naranja</option>
                    <option style="background-color:rgba(239, 13, 13, 0.81);" value="#ef0d0d">Rojo</option>
                    <option style="background-color: rgb(255, 140, 187);" value="#ff8cbb">Rosado</option>
                    <option style="background-color:rgba(22, 185, 16, 0.56);" value="#16b910">Verde</option>
                    <option style="background-color:rgb(0, 0, 0);" value="#000000">Negro</option>
                  </select>
                    <small>Este es el color por defecto: </small><small class="color-gray" style="background-color: #3a87ad;">&nbsp;&nbsp;&nbsp;</small>
                   </td>
                 </tr>

               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_evento" type="button" class="btn btn-primary" id="agregar_evento" value="Guardar datos">
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- En Add Modal -->
    
  <!-- Modal (Right) Ver Informacion // Editar -->
  <div class="modal fade  come-from-modal right" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                        <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Profesor: <label class="nombre-del-profesor h4"></label></h4>
                    </div>
                    <div class="modal-body" style="height: 100% !important">
                      <!-- <input name="guardar_data" type="button" class="btn btn-primary float-right" id="guardar_data" onClick="var id_row = $('#id_row').val(); updateEvent(id_row)" value="Modificar datos"> -->
                      
                      <!-- Row 1 -->
                      <div class="row f1" style="font-size: 14px;">
                        <!-- section 1 -->
                        <div class="col-md-3 flex " style="padding: 5px;">
                          <div class="col-md-12 col-sm-12 ">
                            <img id="blah-photo-user" class="photo-user" style="width: 100px; height: 100px" src="repositorio/profile_photos/user.png" alt="Foto">
                          </div>
                        </div>
                        <!-- section 2 -->
                        <div class="col-md-5 flex bg-color-gray-transp border-radius" style="padding: 5px;">
                          <div class="col-md-12"><i class="fa fa-envelope"></i> <label class="email-del-profesor"></label></div>
                          <div class="col-md-12"><i class="clip-calendar"></i> <label class="cumple-del-profesor"></label></div>
                          <div class="col-md-12"><i class="clip-phone"></i> <label class="telefono-del-profesor"></label></div>
                          <div class="col-md-12"><i class="fa fa-medkit"></i> <label class="tiposangre-del-profesor"></label></div>
                        </div>
                        <!-- section 3 -->
                        <div class="col-md-4 flex" style="padding: 5px;">
                          <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-list-2"></i> <a href="#">Clases</a></div>
                          <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-indent"></i> <a href="#">Materias</a></div>
                          <div class="col-md-12 bg-color-purple-transp border-radius"><i class="clip-users-2"></i> <a href="#">Estudiantes</a></div>
                          <div class="col-md-12 bg-color-yellow-transp border-radius"><i class="fa fa-envelope"></i> <a href="#">Asignaciones</a></div>
                        </div>
                      </div>

                      <!-- Row 2 Calendar -->
                      <hr />
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <i class="clip-calendar"></i>
                              Calendar
                              <div class="panel-tools">
                                <!-- <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                                <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a> -->
                                <a class="btn btn-xs btn-link panel-refresh" href="#">
                                  <i class="fa fa-refresh"></i>
                                </a>
                                <!-- <a class="btn btn-xs btn-link panel-expand" href="#">
                                  <i class="fa fa-resize-full"></i>
                                </a>
                                <a class="btn btn-xs btn-link panel-close" href="#">
                                  <i class="fa fa-times"></i>
                                </a> -->
                              </div>
                            </div>
                            <div class="panel-body">
                            <div id='calendar'></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Calendar -->

                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Modificar datos</button>
                    </div> -->
                    <!-- <div class="modal-footer">
                        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                        <input name="guardar_data" type="button" class="btn btn-primary" id="guardar_data" onClick="var id_row = $('#id_row').val(); updateEvent(id_row)" value="Modificar datos">
                  </div> -->
                </div>
            </div>
        </div>   
    
    <!-- Modal EDITAR -->
    <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="POST" name="EditDataModal" id="EditDataModal" action="?planning"><!--editEventTitle.php-->
        <input type="hidden" name="form-action" id="form-action" value="edit">
        <input type="hidden" name="tipo_reserva_edit" id="tipo_reserva_edit" value="">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-edit"></i> Editar</h4>
        </div>
        <div class="modal-body">
        
        <?php //$sql = myysql_qury("select * from ".$TblBooking." Where id = '".."'"); ?>

          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
          </div>
          </div>

          <!-- EDITAR RESERVAR -->

          <div class="form-group" id="div_reservar_editar" style="display: none">

            <div class="form-group">

              <label for="apellido" class="col-sm-2 control-label">Apellido</label>
              <div class="col-sm-4">
                <input type="text" name="apellido_edit" class="form-control" id="apellido_edit" placeholder="Apellido">
              </div>
           

              <label for="email" class="col-sm-1 control-label">Email</label>
              <div class="col-sm-5">
                <input type="email" name="email" required="required" class="form-control" id="email" placeholder="Email">
              </div>

            </div>

             <div class="form-group">
                <label for="habitacion" class="col-sm-2 control-label">Habitación</label>
                <div class="col-sm-4">
                  <?php $sql  = mysqli_query($link,"Select * From ".$TblRooms." Where activo = 1");?>
                  <select id="habitacion_edit" name="habitacion_edit" required="required" class="form-control" onchange="activarCamposEdit( this )">
                    
                    <?php
                        while($data = mysqli_fetch_array($sql)) {
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['codigo']?></option>
                    <?php } ?>
                    
                  </select>
                </div>

                <label for="tot_personas" class="col-sm-3 control-label">Tot. Personas</label>
                <div class="col-sm-3">
                  <input type="number" min="1" required="required" max="8" name="tot_personas" class="form-control" id="tot_personas" placeholder="Total de personas" value="1">
                </div>
             </div>

             <div class="form-group">
                <label for="precio" class="col-sm-2 control-label">Precio</label>
                <div class="col-sm-4">
                  <input type="number" min="1" step="0.01" name="precio_edit" class="form-control" id="precio_edit" placeholder="Precio" value="0">
                </div>

                <label for="descuento" class="col-sm-3 control-label">Descuento</label>
                <div class="col-sm-3">
                  <input type="number" min="0" step="0.01" name="descuento_edit" class="form-control" id="descuento_edit" placeholder="Descuento" value="0">
                </div>
             </div>

             <!-- Nacionalidad -->

             <div class="form-group">
             <?php $sql  = mysqli_query($link,"Select * From ad_pais");?>
             <label for="nacionalidad" class="col-sm-2 control-label">Nacionalidad</label>
              <div class="col-sm-10">
                <select class="form-control" id="nacionalidad_edit" name="nacionalidad_edit">
                  <option value="">select</option>
                  <?php while ($datos = mysqli_fetch_array($sql)) { ?>
                    <option value="<?php echo $datos['id']; ?>"><?php echo sanear_string($datos['pais']); ?></option>
                  <?php } ?>
                  </option>
                </select>
              </div>
             </div>
             
            <!-- Tipo de Documento -->
            <div class="form-group">
            <?php $sql  = mysqli_query($link,"Select * From ad_tipo_documentos");?>
             <label for="documento" class="col-sm-2 control-label">Documento</label>
              <div class="col-sm-4">
                <select required="required" class="form-control" id="documento_edit" name="documento_edit">
                  <option value="">select</option>
                  <option value="DNI">Documento de Identidad</option>
                  <option value="PASS">Pasaporte</option>
                  </option>
                </select>
              </div>
            <!-- </div> -->
 
            <!-- Número de Documento -->
            <!-- <div class="form-group"> -->
              <label for="n_documento" class="col-sm-3 control-label">N° Documento</label>
              <div class="col-sm-3">
                <input type="text" name="n_documento_edit" class="form-control" id="n_documento_edit" placeholder="N°Documento">
              </div>
            </div>

            <div class="form-group">
              <label for="observacion" class="col-sm-2 control-label">Observación</label>
              <div class="col-sm-10">
                <textarea name="observacion_edit" class="form-control" rows="2" cols="50" style="width:100%" id="observacion_edit" placeholder="observacion" maxlength="80"></textarea>
                <label>(80 caracteres)</label>
              </div>
            </div>
          </div>


          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-10">
            <select name="color" class="form-control" id="color">
              <option style="background-color: #3a87ad;" value="#3a87ad" selected>Default </option>
              <option style="background-color: rgb(255, 140, 0);" value="#ff8c00">Naranja</option>
              <option style="background-color:rgba(239, 13, 13, 0.81);" value="#ef0d0d">Rojo</option>
              <option style="background-color: rgb(255, 140, 187);" value="#ff8cbb">Rosado</option>
              <option style="background-color:rgba(22, 185, 16, 0.56);" value="#16b910">Verde</option>
              <option style="background-color:rgb(0, 0, 0);" value="#000000">Negro</option>
            </select>
          </div>
          </div>

          <div class="form-group">

              <label for="" class="col-sm-2 control-label">F. Inicio</label>
              <div class="col-sm-4">
                <input type="text" name="fecha_e_editar" required="required" class="form-control" id="fecha_e_editar" placeholder="">
                
              </div>
          
              <label for="" class="col-sm-2 control-label">F. Final</label>
              <div class="col-sm-4">
                <input type="text" name="fecha_s_editar" required="required" class="form-control" id="fecha_s_editar" placeholder="">
               
              </div>
               <label class="text-danger" style="float: left;">&nbsp;&nbsp;<input type="checkbox" name="delete"> <i class="fa fa-trash-o"></i> Eliminar</label>
            </div>
           <!--  <div class="form-group header-list-table col-sm-12" style="uppercase;font-weight: bold;"> 
            <div class="row">
              <div class="checkbox col-sm-6">
                <label class="text-danger">&nbsp;&nbsp;<input type="checkbox" name="delete"> Eliminar Registro</label>
              </div>
              <div class="checkbox col-sm-6">
                <button onClick="window.location.href='?facturacion/12'" type="button" class="btn btn-default">Facturar</button>
              </div>
           </div>
          </div> -->
          
          <input type="hidden" name="id" class="form-control" id="id_editar">
        
        
        </div>
        <div class="modal-footer">
        <!-- <label class="text-danger" style="float: left;">&nbsp;&nbsp;<input type="checkbox" name="delete"> <i class="fa fa-trash-o"></i> Eliminar</label> --> 
        <button onClick="Javascript: var id = $('#id_editar').val(); window.location.href='?facturacion/idP='+id" type="button" class="btn btn-green" style="margin-left:10px;float: left;"> <i class="fa fa-print"></i> Facturar</button>
      <!--   <a data-toggle="modal" class="btn btn-green"  role="button" href="#facturar_cliente" onclick="$('#nombre').focus();"><i class="fa fa-print"></i> Facturar</a> -->
        <a data-toggle="modal" class="btn btn-blue"  role="button" href="#facturar-productos" onclick=""><i class="fa fa-qrcode"></i> Productos</a>
        <a data-toggle="modal" class="btn btn-teal ladda-button"  role="button" href="#facturar-servicio" onclick=""><i class="fa fa-coffee"></i> Servicios</a>
        <!-- <button onClick="#" type="button" class="btn btn-teal ladda-button" style="margin-left:10px;float: left;"> <i class="fa fa-coffee"></i> + Servicios</button> -->
        <button type="button" class="btn btn-primary" onClick="guardarDatos()">Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        
        </div>
      </form>
      </div>
      </div>
    </div>

  <!-- </div> -->
  <!-- /.container -->


  <!-- FullCalendar -->
  <script src='assets/js/moment/moment.min.js'></script>
  <!-- <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.min.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/locale/es.js'></script> -->
  
  <link rel='stylesheet' href='<?php echo $_ENV['FLD_ASSETS']?>/plugins/FullCalendar/demos/cupertino/jquery-ui.min.css' />


  <?php get_template_part('footer_scripts');?>


  <script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>


<script>
$.fn.modal.Constructor.prototype.enforceFocus = function() {};
$('.result-mssg').hide();
$('#mssg-add-eventos').hide();
$('#mssg-edit-eventos').hide();


$("#select_classes").click(function(){
  if($("#select_classes").is(':checked') ){
      $("#event_class_add > option").prop("selected","selected");
      $("#event_class_add").trigger("change");
  }else{
      $("#event_class_add > option").removeAttr("selected");
        $("#event_class_add").trigger("change");
  }
});

$("#select_perfiles").click(function(){
  if($("#select_perfiles").is(':checked') ){
      $("#text_event_perfil_add > option").prop("selected","selected");
      $("#text_event_perfil_add").trigger("change");
  }else{
      $("#text_event_perfil_add > option").removeAttr("selected");
        $("#text_event_perfil_add").trigger("change");
  }
});
$('[class*="input-tot_"]').on('change', (e)=>{
  totalPagar ( $('#precio').val(), false )
});

// function guardarReserva () {
//   if ($('#tipo_reserva').val() == '') {
//     jQuery('#mssg').html('Seleccione tipo de evento');
//     //jQuery('#mssg').focus();
//   }
// }

// function activarCampos () {

// if( $('#habitacion').val() != '') { 

//   $('#precio').removeAttr('disabled');
//   $('#descuento').removeAttr('disabled'); 

//   var precio        =   $("#precio")[0]; 
//   var room          =   $("#habitacion").val(); 
//   var tbl           =   '<?php echo 'rooms'; ?>';

//    //mostrar('cargando'); 
//    ajax2Z = nuevoAjax();
//    ajax2Z.open("GET", "ajax/ajax_buscar_precio.php?hab="+room+"&tbl="+tbl,true);
    
//    ajax2Z.onreadystatechange = function() {
//        if ( ajax2Z.readyState==4 ) {
//           $("#precio").val(ajax2Z.responseText) ;
//           totalPagar ( ajax2Z.responseText, false )
//        }
//    }
//    ajax2Z.send(null);


// } else { 

//   $('#precio').attr('disabled','disabled');
//   $('#descuento').attr('disabled','disabled'); 
//   $('#precio').val('0');
//   $('#descuento').val('0');
// } 
// }


// function activarCamposEdit () {

// if( $('#habitacion_edit').val() != '') { 

//   //$('#precio_edit').removeAttr('disabled');
//   //$('#descuento_edit').removeAttr('disabled'); 

//   var precio        =   $("#precio_edit")[0]; 
//   var price         =   $("#habitacion_edit").val(); 
//   var tbl           =   '<?php echo $TblRooms; ?>';

//    //mostrar('cargando'); 
//    ajax2Z = nuevoAjax();
//    ajax2Z.open("GET", "ajax/ajax_buscar_precio.php?hab="+price+"&tbl="+tbl,true);

//    ajax2Z.onreadystatechange = function() {
//        if ( ajax2Z.readyState==4 ) {
//           $("#precio_edit").val(ajax2Z.responseText) ; 
//        }
//    }
//    ajax2Z.send(null);


// } else { 
//   alert('No se puede hacer esta acción');
//   return false;
//   //$('#precio_edit').attr('disabled','disabled');
//   //$('#descuento_edit').attr('disabled','disabled'); 
//   $('#precio_edit').val('0');
//   $('#descuento_edit').val('0');
// } 
// }

$('#agregar_evento').on('click', ()=> {
  let titulo  = $('#titulo_add').val();

  if (titulo == '') {
    $('#mssg-add-eventos').show().css('color','#721c24').html('Los campos con (*) son requeridos');
  }
});


// Days between to dates
let betweenTwoDays = () => {
  let result = 0; 
  let fecha1 = moment($('#start').val());
  let fecha2 = moment($('#end').val());
  result = fecha2.diff(fecha1, 'days');
  $('#dias_entre_fecha').val(result);
  return result;
}
// Total Pagar
let totalPagar = ( valPrice,valDescounts ) => {
  let result = 0;
  result = (valPrice*betweenTwoDays());
  //result = (betweenTwoDays()*result);
  $('#total_pagar').val(result.toFixed(2));
}

// function cambiarEvento () {

// jQuery('#mssg').html('');

// if( $('#tipo_reserva').val() == 'R') { 

//   $('.reserva').attr('id', 'title');
//   $('.reserva').attr('name', 'title');
//   $('.reserva').prop('required', true);
//   $('.reserva').focus();

//   $('.evento').attr('id', '');
//   $('.evento').attr('name', '');
//   $('.evento').prop('required', false);

//   $('#email').prop('required', true);
//   $('#habitacion').prop('required', true);
//   $('#tot_personas').prop('required', true);
//   $('#documento').prop('required', true);


//   $('#div_nombre').show();
//   $('#div_titulo').hide(); 

// } 

// if ( $('#tipo_reserva').val() == 'E' ) {

//   $('.evento').attr('id', 'title');
//   $('.evento').attr('name', 'title');
//   $('.evento').prop('required', true);
//   $('.evento').focus();

//   $('.reserva').attr('id', '');
//   $('.reserva').attr('name', '');
//   $('.reserva').prop('required', false);

//   $('#email').prop('required', false);
//   $('#habitacion').prop('required', false);
//   $('#tot_personas').prop('required', false);
//   $('#documento').prop('required', false);

//   $('#div_nombre').hide();
//   $('#div_titulo').show(); 

// } 

// if ( $('#tipo_reserva').val() == '' ) {

//   $('.evento').attr('id', '');
//   $('.evento').attr('name', '');
//   $('.evento').prop('required', false);

//   $('.reserva').attr('id', '');
//   $('.reserva').attr('name', '');
//   $('.reserva').prop('required', false);

//   $('#div_nombre').hide();
//   $('#div_titulo').hide(); 

//   jQuery('#mssg').html('Seleccione tipo de evento');
// }

// }

// EDIT / MOdIFICAR / MOdIFIER
function guardarDatos () {
//window.location.href="?planning";
document.forms["EditDataModal"].submit();
}

  $('.fa-refresh').trigger('click');
  setTimeout(()=>{
    $('.fc-button-agendaWeek').trigger('click');
  },100);

  $(document).ready(function() {
      let date = new Date();
      let yyyy = date.getFullYear().toString();
      let mm   = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
      let dd   = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    jQuery('#calendar').fullCalendar({
      theme: true,
      header: {
        language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
        //right: 'month,basicWeek,basicDay',
      },
      initialView: 'basicWeek',

      //defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        //console.log(start)
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        //element.bind('dblclick', function() {
        element.bind('click', function() {
          // Eventos
          if ( event.tipo == 'E') {
            $('#ModalEdit #div_reservar_editar').hide();
            $('#ModalEdit #id_editar').val(event.id);
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #color').val(event.color);
          // Reservas
          } 
          
            $('#ModalEdit #tipo_reserva_edit').val(event.tipo);
            $('#ModalEdit #fecha_e_editar').val(moment(event.start).format('YYYY-MM-DD'));
            $('#ModalEdit #fecha_s_editar').val(moment(event.end).format('YYYY-MM-DD'));

          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
      <?php 
      //if ($event!=null) :
      
      foreach($events as $event):
        // $start  = explode(" ", $event['fecha_e']);
        // $end    = explode(" ", $event['fecha_s']);
        // $price  = '';//$event['price'];
        // $apellido  = '';//$event['last_name'];

        // if($start[1] == '00:00:00'){
        //   $start = $start[0];
        // }else{
        //   $start = $event['start'];
        // }
        // if($end[1] == '00:00:00'){
        //   $end = $end[0];
        // }else{
        //   $end = $event['end'];
        // }
      ?> 
        { 
        // Aqui muestro en el calendario y los muestro
        // en los campos al querer editar la info.
        // ********************************************
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['name']; ?>',
          //email: '<?php echo $event['email']; ?>',
          start: '<?php echo $event['date_start'].$event['time_start']; ?>',
          end: '<?php echo $event['date_end'].$event['time_end']; ?>',
          tipo: 'E',//'<?php echo $event['tipo']?>',
          //start: '<?php echo $start; ?>',
          //end: '<?php echo $end; ?>',
          color: '<?php echo $event['tipo_color']; ?>',
        },
      <?php endforeach; 
      //endif; ?>
      // {
      //     title: 'Long Event',
      //     start: '2025-05-07T05:00:00',
      //     end: '2025-05-10T05:00:00'
      //   },
      //   {
      //     title: 'Conference',
      //     start: '2025-05-11T05:00:00',
      //     end: '2025-05-12T06:00:00'
      //   },
      ]
    });
    
    function edit(event){
      console.log(event)
      //$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
      //$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
      start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }
      
      id =  event.id;
      //alert(':'+id)
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      
      $.ajax({
       url: 'ajax/editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
        
          if(rep == 'OK'){
            alert('El Evento se ha guardado correctamente');
          }else{
            alert('No se pudo guardar. Inténtalo de nuevo.'); 
          }
        }
      });
    }
    
  });

// DATE PICKER

//Pass the user selected date format
// $( "#fecha_e_editar" ).datepicker();
// $( "#fecha_e_editar" ).datepicker("option", "dateFormat","yy-mm-dd");


// $( "#fecha_s_editar" ).datepicker();
// $( "#fecha_s_editar" ).datepicker("option", "dateFormat","yy-mm-dd");

$("#tipo_evento").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#habitacion").select2({ width: '100%', dropdownCssClass: "bigdrop" });

$("#nacionalidad").select2({ width: '100%', dropdownCssClass: "bigdrop" });
$("#event_estado_add").select2({ width: '100%', dropdownCssClass: "bigdrop" });
$("[name='tipo_color']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='para_grupo']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='event_class_add']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#text_event_perfil_add").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>

</body>
