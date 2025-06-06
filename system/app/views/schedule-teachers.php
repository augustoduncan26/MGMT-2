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

<div class="alert mssg-planner"></div>

<div class="">
      <!-- <h3>Planners</h3> -->
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
            <div class="col-sm-12">
              <!-- start: FULL CALENDAR PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-calendar"></i>Profesor: <?=$_SESSION['username']?>
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
                    <td width="35%"><input maxlength="40" name="titulo_add" type="text" class="form-control" id="titulo_add" placeholder="Título del evento"></td>
                    <td width="15%">Descripción </td>
                    <td width="35%">
                      <input maxlength="100" name="descripcion_add" type="text" class="form-control" id="descripcion_add" placeholder="Descripción">
                      <small class="color-gray">Descripción sobre el evento. </small>
                    </td>
                  </tr>
                  <tr>
                   <td width="15%">Fecha Inicio <span class="symbol required"></span>
                    </td> 
                    <td width="35%">
                      <input type="date" name="start" class="form-control" id="start" readonly>
                      <small class="color-gray">Formato: [mes/dia/año] </small>
                    </td>
                    <td width="15%">Hora Inicio </td>
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
                   <td width="15%">Hora Fin</td>
                   <td width="35%"><input autofocus="" name="event_add_hora_fin" type="time" class="form-control" id="event_add_hora_fin" placeholder="Hora Final"></td>
                </tr>

                 <tr>
                 <td width="15%">Clase
                  </td>
                   <td width="35%">
                    <select name="event_class_add" id="event_class_add" multiple>
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
                   <td width="15%">Perfil
                  </td>
                 <td width="35%">
                    <select name="event_perfil_add[]" id="text_event_perfil_add" multiple style="width: 250px !important;">
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
    
  <!-- Modal (Right) View Informations // Editar -->
  <div class="modal fade  come-from-modal right" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document" style="width: 100%;">
          <div class="modal-content">
          <form class="form-horizontal" method="POST" name="EditDataModal" id="EditDataModal" action="?planning">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                  <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel">
                    <i class="fa fa-calendar"></i><!-- Evento: -->
                    <label class="titulo-evento h4" id="titulo-del-evento"></label></h4>
                    <input type="hidden" name="id" class="form-control" id="id_editar">
                </div>
              <div class="modal-body" style="height: 100% !important">
                
                <!-- Row 1 -->
                <div class="form-group row">
                  <label for="" class="col-sm-3 control-label">Fecha Desde:</label>
                  <div class="col-sm-3 bg-color-gray-transp">
                    <input type="text" name="fecha_desde_editar" required="required" class="form-control" id="fecha_desde_editar" style="border: 0px;" readonly> 
                  </div>
                  <label for="" class="col-sm-3 control-label">Fecha Hasta:</label>
                  <div class="col-sm-3 bg-color-gray-transp">
                    <input type="text" name="fecha_hasta_editar" required="required" class="form-control" id="fecha_hasta_editar" style="border: 0px;" readonly>
                    <input type="hidden" name="id" class="form-control" id="id_editar">
                  </div>
                </div>

                <!-- Row 2 -->
                <div class="form-group row">
                  <label for="" class="col-sm-3 control-label">Hora Inicio:</label>
                  <div class="col-sm-3">
                    <input type="time" name="hora_inicio_editar" required="required" class="form-control" id="hora_inicio_editar" style="border: 0px;"> 
                  </div>
                  <label for="" class="col-sm-3 control-label">Hora Final:</label>
                  <div class="col-sm-3">
                    <input type="time" name="hora_final_editar" required="required" class="form-control" id="hora_final_editar" style="border: 0px;">
                    <input type="hidden" name="id" class="form-control" id="id_editar">
                  </div>
                </div>

                <hr />

                <!-- Row 3 -->
                <div class="form-group row">
                <label for="" class="col-sm-3 control-label">Descripción:</label>
                <div class="col-sm-9"><input type="text" name="descripcion_editar" required="required" class="form-control" id="descripcion_editar" style="border: 0px;"> </div>
                </div>
                <hr />
                <div class="modal-footer text-center">
                  <!-- <label class="text-danger" style="float: left;">&nbsp;&nbsp;<input type="checkbox" name="delete"> <i class="fa fa-trash-o"></i> Eliminar</label> --> 
                  <!-- <button onClick="Javascript: var id = $('#id_editar').val(); window.location.href='?facturacion/idP='+id" type="button" class="btn btn-green" style="margin-left:10px;float: left;"> <i class="fa fa-print"></i> Facturar</button> -->
                  <!--   <a data-toggle="modal" class="btn btn-green"  role="button" href="#facturar_cliente" onclick="$('#nombre').focus();"><i class="fa fa-print"></i> Facturar</a> -->
                  <!-- <a data-toggle="modal" class="btn btn-blue"  role="button" href="#facturar-productos" onclick=""><i class="fa fa-qrcode"></i> Productos</a> -->
                  <!-- <button onClick="#" type="button" class="btn btn-teal ladda-button" style="margin-left:10px;float: left;"> <i class="fa fa-coffee"></i> + Servicios</button> -->
                  <!-- <button type="button" class="btn btn-primary" onClick="guardarDatos()">Modificar</button> -->
                  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> -->
                </div>
              </form>
              </div>
          </div>
      </div>
  </div>

  <!-- </div> -->
  <!-- /.container -->


  <!-- FullCalendar -->
  <script src='assets/js/moment/moment.min.js'></script>
  
  <link rel='stylesheet' href='<?php echo $_ENV['FLD_ASSETS']?>/plugins/FullCalendar/demos/cupertino/jquery-ui.min.css' />


  <?php get_template_part('footer_scripts');?>


  <script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>


<script>

$.fn.modal.Constructor.prototype.enforceFocus = function() {};
$('.result-mssg').hide();
$('#mssg-add-eventos').hide();
$('#mssg-edit-eventos').hide();
$('.mssg-planner').hide();


/** 
 * Select All clases or Perfiles
 */
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

// $('[class*="input-tot_"]').on('change', (e)=>{
//   totalPagar ( $('#precio').val(), false )
// });

/**
 * Add
 */
$('#agregar_evento').on('click', ()=> {
  let nombre    = $('#titulo_add').val();
  let descrip   = $('#descripcion_add').val();
  let dateI     = $('#start').val();
  let dateF     = $('#end').val();
  let horaI     = $('#event_add_hora_ini').val();
  let horaF     = $('#event_add_hora_fin').val();
  let clase     = $('#event_class_add').val();
  let perfil    = $('#text_event_perfil_add').val();
  let tipo_color= $('#tipo_color').val();
  let estado    = $('#event_estado_add').val();

  if ( nombre == '' || dateI == '' || dateF == '') {
    $("#mssg-add-eventos").show().css('color','#721c24').html('<h5>Los campos con (*) son necesarios</h5>');
    $('#nombre').focus();
    setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 3000);
    return false
  }

  if (evaluarFechas(dateI, dateF) == false) {
    $("#mssg-add-eventos").show().html('<h5>La fecha final debe ser mayor o igual a la fecha de inicio</h5>');
    $('#nombre').focus();
    setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 4000);
    return false
  }

  let route = "app/controllers/planning.php";
  $.ajax({
    url: route,
    type: "post",
    data: {
      add : 1,
      r1 : nombre,
      r2 : clase,
      r3 : dateI,
      r4 : horaI,
      r5 : dateF,
      r6 : horaF,
      r7 : estado,
      r8 : descrip,
      r9: perfil,
      r10 : tipo_color,
    },
    dataType : 'html',
    beforeSend: function () {
      console.log("Procesando, espere por favor...");
    },
    success         : function (response) { 
      if (response == 'ok') {
        $("#mssg-add-eventos").removeClass('alert-danger').addClass('alert-success').css('color','#3c763d').show().html('<h5>Se ingreso el registro con éxito.</h5>');
      } if (response == 'error') {
        $("#mssg-add-eventos").removeClass('alert-success').addClass('alert-danger').show().html('<h5>Ya existe un registro con este mismo nombre.<h5>');
      }
      setTimeout(() => {
        $("#mssg-add-eventos").hide();
      }, 4000);
  
      $("#nombre_add").val('');
      $("#event_add_date_ini").val('');
      $("#event_add_date_fin").val('');
      $("#descripcion_add").val('');
      $("#event_class_add").val('').change();
      $("#nombre_add").focus();
    },
    error           : function (error) {
      console.log(error);
    }
  });

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


// EDIT / MOdIFICAR / MOdIFIER
function guardarDatos () {
//window.location.href="?planning";
document.forms["EditDataModal"].submit();
}


setTimeout(()=>{
  $('.fa-refresh').trigger('click');
  //$('.fc-button-agendaWeek').trigger('click');
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
      //initialView: 'month',
      //initialView: 'basicWeek',
      //defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: false,
      eventLimit: true,
      selectable: false,
      selectHelper: true,
      select: function(start, end) {
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('click', function() {
          //$('#ModalEdit #div_reservar_editar').hide();
          $('#ModalEdit #id_editar').val(event.id);
          $('#ModalEdit #titulo-del-evento').html(event.title);
          $('#ModalEdit #color').val(event.color);

          let hora1 = event.hora_inicio.split('T');
          let hora2 = event.hora_final.split('T');
          
          $('#ModalEdit #tipo_reserva_edit').val(event.tipo);
          $('#ModalEdit #fecha_desde_editar').val(moment(event.start).format('YYYY-MM-DD'));
          $('#ModalEdit #fecha_hasta_editar').val(moment(event.end).format('YYYY-MM-DD'));
          $('#ModalEdit #hora_inicio_editar').val(hora1[1]);
          $('#ModalEdit #hora_final_editar').val(hora2[1]);

          if (event.descripcion!='') {
            $('#ModalEdit #descripcion_editar').val(event.descripcion);
          } else {
            $('#ModalEdit #descripcion_editar').val('- - - - -');
          }

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
      if (!empty($events)) {
      foreach($events as $event):
      ?> 
        { 
        // Aqui muestro en el calendario y los muestro
        // en los campos al querer editar la info.
        // ********************************************
          id:     '<?php echo $event['id']; ?>',
          title:  '<?php echo $event['name']; ?>',
          start:  '<?php echo $event['date_start'].$event['time_start']; ?>',
          end:    '<?php echo $event['date_end'].$event['time_end']; ?>',
          hora_inicio:  '<?php echo $event['time_start']?>',
          hora_final:   '<?php echo $event['time_end']?>',
          descripcion:  '<?php echo $event['description']; ?>',
          color:  '<?php echo $event['tipo_color']; ?>',
          allDay: false,
        },
      <?php endforeach; } ?>
      // Examples
      // {
      //     title: 'Long Event',
      //     start: '2025-05-07T05:00:00',
      //     end: '2025-05-10T05:00:00'
      //   },
      //   {
      //     title: 'Conference',
      //     start: '2025-05-15T08:00:00',
      //     end: '2025-05-12T10:00:00'
      //   },
      ]
    });
    
    function edit(event){
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
       url: 'app/controllers/planning.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
        
          if(rep == 'OK'){
            $('.mssg-planner').show().removeClass('alert-danger').addClass('alert-success').html('<h4>El evento se ha actualizado correctamente.</h4>'); 
            setTimeout(()=>{ 
              $('.mssg-planner').hide('slow');
              $('.fa-refresh').trigger('click'); 
            },3000);
            
            goToTopPage();

          }else{
            $('.mssg-planner').show().removeClass('alert-success').addClass('alert-danger').html('<h4>No se ha podido actualizado el evento.</h4>');
            setTimeout(()=>{ $('.mssg-planner').hide('slow'); window.location.reload() },3000);
          }
        }
      });
    }
    
  });
/** 
 * Datepicker
 */
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
