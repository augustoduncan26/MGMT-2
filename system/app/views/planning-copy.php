<?php

 // Search in table
  $sql = "SELECT id, title, fecha_e, fecha_s, color FROM $TblBooking";
  $req = $connPDO->prepare($sql);
  $req->execute();
  $events = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Bootstrap Core CSS 
    <link href="../../FullCalendar/css/bootstrap.min.css" rel="stylesheet">-->
  
  <!-- FullCalendar 
  <link href='../../FullCalendar/css/fullcalendar.css' rel='stylesheet' />-->

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        
    }
  #calendar {
    max-width: 800px;
  }
  .col-centered{
    float: none;
    margin: 0 auto;
  }
    </style>

<body>

<script>

  function guardarReserva () {
    
  }

</script>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="">
        <h3>Planning</h3>
          <!-- end: PAGE HEADER -->
          <!-- start: PAGE CONTENT -->
          <div class="row">
            <div class="col-sm-12">
              <!-- start: FULL CALENDAR PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-calendar"></i>
                  Planning
                  <!-- <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                      <i class="fa fa-wrench"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                      <i class="fa fa-refresh"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-expand" href="#">
                      <i class="fa fa-resize-full"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-close" href="#">
                      <i class="fa fa-times"></i>
                    </a>
                  </div> -->
                </div>
                <div class="panel-body">
                  <div class="col-sm-10">
                    <div id='calendar'></div>
                  </div>

                  <div class="col-sm-2">

                  <!-- Row 1 -->

                  <div class="row">
                    <h4>Huéspedes</h4>
                    <div id="event-categories">

                      <div class="event-category label-orange" data-class="label-orange" style="cursor: pointer;">
                        <i class="fa fa-move"></i>
                        Reservación
                      </div>
                      <div class="event-category label-green" data-class="label-green">
                        <i class="fa fa-move"></i>
                        En la habitación
                      </div>

                      <div class="event-category label-yellow" data-class="label-yellow">
                        <i class="fa fa-move"></i>
                        Entrada (Check-In)
                      </div>

                      <div class="event-category label-purple" data-class="label-purple">
                        <i class="fa fa-move"></i>
                        Salida (Check-Out)
                      </div>

                      <div class="event-category label-default" data-class="label-default">
                        <i class="fa fa-move"></i>
                        En Limpieza &nbsp;<img src="web/images/icono_aspirador.png" />
                      </div>
                      <!-- <div class="checkbox">
                        <label>
                          <input type="checkbox" class="grey" id="drop-remove" />
                          Remove after drop
                        </label>
                      </div> -->
                    </div>
                  </div>

                   <?php

                    $id_user    = $_SESSION['id_user'];
                    $id_empresa = $_SESSION['id_empresa'];

                    $sel        = mysql_query("Select * From ad_eventos");

                   ?>
                    <!-- <div class="row">
                        <h4>Eventos</h4>
                        <div id="event-categories">
                         <?php
                            While ( $datos = mysql_fetch_object($sel) ) {
                          ?>
                          <div class="event-category label-orange" data-class="label-orange" style="cursor: pointer;">
                            <i class="fa fa-move"></i>
                            <?=$datos->nombre?>
                          </div>
                          <?php
                            }
                         ?>
                        </div>
                    </div> -->

                      <!-- <iframe name="iframe" src="ajax/ajax_habitaciones.php" ></iframe> -->

                  </div>

                </div>
              </div>
              <!-- end: FULL CALENDAR PANEL -->
            </div>
          </div>
          <!-- end: PAGE CONTENT-->
        </div>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- <h1>FullCalendar PHP MySQL</h1>
                <p class="lead">Completa con rutas de archivo predefinidas que no tendrás que cambiar!</p> -->
                <div class="col-sm-10">
                    <div id='calendar'></div>
                  </div>
            </div>
      
        </div>
        <!-- /.row -->
    
    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="POST" action="?planning/">
      
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar al planning</h4>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
          </div>
          </div>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-10">
            <select name="color" class="form-control" id="color">
                    <option value="">Seleccionar</option>
              <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
              <option style="color:#008000;" value="#008000">&#9724; Verde</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
              <option style="color:#000;" value="#000">&#9724; Negro</option>
              
            </select>
          </div>
          </div>
          <div class="form-group">
          <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
          <div class="col-sm-10">
            <input type="text" name="start" class="form-control" id="start" readonly>
          </div>
          </div>
          <div class="form-group">
          <label for="end" class="col-sm-2 control-label">Fecha Final</label>
          <div class="col-sm-10">
            <input type="text" name="end" class="form-control" id="end" readonly>
          </div>
          </div>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" onClick="javascript: guardarReserva()">Guardar</button>
        </div>
      </form>
      </div>
      </div>
    </div>
    
    
    
    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="POST" action="?planning/"><!--editEventTitle.php-->
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
          </div>
          </div>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-10">
            <select name="color" class="form-control" id="color">
              <option value="">Seleccionar</option>
              <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
              <option style="color:#008000;" value="#008000">&#9724; Verde</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
              <option style="color:#000;" value="#000">&#9724; Negro</option>
              
            </select>
          </div>
          </div>
            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
              <label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
              </div>
            </div>
          </div>
          
          <input type="hidden" name="id" class="form-control" id="id">
        
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
      </div>
    </div>

    </div>
    <!-- /.container -->


    <!-- jQuery Version 1.11.1 -->
    <script src="../assets/plugins/FullCalendar/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/plugins/FullCalendar/js/bootstrap.min.js"></script>
  
  <!-- FullCalendar -->
  <script src='../assets/plugins/FullCalendar/js/moment.min.js'></script>
  <script src='../assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.min.js'></script>
  <script src='../assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.js'></script>
  <script src='../assets/plugins/FullCalendar/js/fullcalendar/locale/es.js'></script>
  
  
  <script>

  $(document).ready(function() {

    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    jQuery('#calendar').fullCalendar({
      header: {
         language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay',

      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
      <?php foreach($events as $event): 
      
        $start = explode(" ", $event['fecha_e']);
        $end = explode(" ", $event['fecha_s']);
        if($start[1] == '00:00:00'){
          $start = $start[0];
        }else{
          $start = $event['start'];
        }
        if($end[1] == '00:00:00'){
          $end = $end[0];
        }else{
          $end = $event['end'];
        }
      ?>
        {
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; ?>
      ]
    });
    
    function edit(event){
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }
      
      id =  event.id;
      
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      
      $.ajax({
       url: 'editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
          if(rep == 'OK'){
            alert('Evento se ha guardado correctamente');
          }else{
            alert('No se pudo guardar. Inténtalo de nuevo.'); 
          }
        }
      });
    }
    
  });

</script>

</body>
