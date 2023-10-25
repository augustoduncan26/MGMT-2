
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


<script>

function objetoAjax(){
  var xmlhttp=false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
      }
  }

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}


$("#roomname").click({
  alert('ClickMe');
})




// Get rooms name
function getRoomsName () {
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

        myarray = [];
        myarray.push($(".group_id").val());
        $.ajax({
            type: "GET",
            url: "ajax/ajax_list_user_room.php?id_user="+id_user+"&id_empresa="+id_empresa,
            data: 'group_id=' + myarray.join(),
            success: function(data) {
              alert(data)
                form.find("input[name='category']").append(data);
            }
        });
        //return false;

}

getRoomsName

function listRoom() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  //var contenido_editor = $("#list_room")[0];//document.getElementById("list_room");

  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_user_room.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      alert(ajax1.responseText)
      //form.find("input[name='category']").innerHTML = ajax1.responseText;
    }
  }

  ajax1.send(null);
}

//listRoom();


</script>
<style type="text/css" media="screen">
  .embed-container {
    position: relative;
    padding-bottom: 100%;
    /*padding-bottom: 56.25%;*/
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}
</style>
  <!-- start: BODY -->
  <body>



    <!-- start: MAIN CONTAINER -->
    <!-- start: PAGE -->

        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
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



                    <!-- Row 2 -->
                    <!-- <div id="list_rooms"></div> -->
                   <?php

                    $id_user    = $_SESSION['id_user'];
                    $id_empresa = $_SESSION['id_empresa'];

                    // if ($id_user == 1 || $id_user == 2) {
                    //   $sel        = mysql_query("Select * From ad_eventos");
                    // } else {
                    //   $sel        = mysql_query("Select * From ad_".$id_user."_habitaciones");
                    // }

                    $sel        = mysql_query("Select * From ad_eventos");

                   ?>
                    <div class="row">
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
                    </div>

                      <!-- <iframe name="iframe" src="ajax/ajax_habitaciones.php" ></iframe> -->

                  </div>

                </div>
              </div>
              <!-- end: FULL CALENDAR PANEL -->
            </div>
          </div>
          <!-- end: PAGE CONTENT-->
        </div>

      <!-- end: PAGE -->

    <!-- end: MAIN CONTAINER -->

<!-- Modal Eventos -->
    <div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title">Reservación. <?php echo $_GET['title']?></h4>
        <label id="mssg-label"></label>
      </div>

      <!-- Aqui llamo al archivo: form-calendar.js-->
          <div class="modal-body"></div> 
      <!-- -->
      
      <div class="" style="padding: 20px;">
          
        <!-- <div class="row">
          <div class="col-md-6 form-group">
            <label>Seleccionar:</label>
            <div>
              <select id="seleccione" class="form-control">
                <option value="E">Evento</option>
                <option value="R" selected>Reservación</option>
              </select>
            </div>
          </div>
        </div> -->

        <div class="row">
         <!--  <div class="col-md-6 form-group">
            <label>Fecha de Llegada</label>
            <div><input type="text" name="fecha_llegada" id="fecha_llegada" class="form-control" value=""></div>
          </div>

          <div class="col-md-6 form-group">
            <label>Fecha de Salida</label>
            <div><input type="text" name="fecha_salida" id="fecha_salida" class="form-control"></div>
          </div>
      -->
        <div class="col-md-6 form-group">
            <label>Habitación</label>
            <div><input type="text" name="" id="" class="form-control"></div>
          </div>

          <div class="col-md-6 form-group">
            <label>Total de Personas</label>
            <div><input type="text" name="" id="" class="form-control"></div>
          </div>
          
        </div>

        <div class="row">
  
          <div class="col-md-6 form-group">
            <label>Nombre</label>
            <div><input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" required /></div>
          </div>

           <div class="col-md-6 form-group">
            <label>Apellido</label>
            <div><input type="text" class="form-control" /></div>
          </div>

          <div class="col-md-6 form-group">
            <label>Email</label>
            <div><input type="text" class="form-control" /></div>
          </div>

           <div class="col-md-6 form-group">
            <label>Nacionalidad</label>
            <div><input type="text" class="form-control" /></div>
          </div>

           <div class="col-md-6 form-group">
            <label>Tipo de Documento</label>
            <div><input type="text" class="form-control" /></div>
          </div>

          <div class="col-md-6 form-group">
            <label>Número de Documento</label>
            <div><input type="text" class="form-control" /></div>
          </div>


        </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" data-dismiss="modal" class="btn btn-light-grey">
          Cerrar
        </button>
        <button type="button" class="btn btn-danger remove-event no-display">
          <i class='fa fa-trash-o'></i> Eliminar
        </button>

        <button type='submit' onClick="javascript: guardarReserva()" class='btn btn-primary save-event'><!-- save-event -->
          <i class='fa fa-check'></i> Guardar.
        </button>
        
      </div>
    </div>
<!-- End Modal -->

    <?php get_template_part('footer_scripts');?>

    <!-- start: MAIN JAVASCRIPTS -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <script src="assets/plugins/excanvas.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script src="../assets/plugins/blockUI/jquery.blockUI.js"></script>
    <script src="../assets/plugins/iCheck/jquery.icheck.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/less/less-1.5.0.min.js"></script>
    <script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->

    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="../assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
    <script src="../assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="../assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <script src="../assets/js/form-calendar.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <script>
      jQuery(document).ready(function() {
        //Main.init();
        Calendar.init();
      });
    </script>
  </body>
  <!-- end: BODY -->
