<?php
//header("Content-Type: text/html; charset=utf-8");
//header( 'Content-type: text/html; charset=iso-8859-1' );
//include_once("config_pdo.php");

  $ObjMante2	=	new Mantenimientos();

  // Search in planning
  $events     = $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'active=1 and id_empresa='.$_SESSION['id_empresa'],'array');
  // $sql        = "SELECT * FROM ".$P_TablePlanning." Where id_empresa = '".$_SESSION['id_empresa']."' and active = 1";
  // $req        = $connPDO->prepare($sql);
  // $req->execute();
  $events     = $events['resultado'];//$req->fetchAll(PDO::FETCH_ASSOC);

  $date   = date('Y-m-d');

?>

<link rel="stylesheet" href="assets/plugins/jquery-datepicker/jquery-ui.css">
<script src="assets/plugins/jquery-datepicker/jquery-1.12.4.js"></script>
<script src="assets/plugins/jquery-datepicker/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/plugins/FullCalendar/fullcalendar/fullcalendar.css">

<!-- Include Select2 CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" />
<!-- CSS to make Select2 fit in with Bootstrap 3.x -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2-bootstrap.min.css" />
<!-- Include Select2 JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js"></script>

<body>
 
<div class="">
        <h3>Plannings</h3>
          <!-- end: PAGE HEADER -->
          <!-- start: PAGE CONTENT -->
          <div class="row">
            <div class="col-sm-12">
              <!-- start: FULL CALENDAR PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-calendar"></i>Planning
                </div>
                <div class="panel-body">
                  <div class="col-sm-10">
                    <div id='calendar'></div>
                  </div>

                  <div class="col-sm-2">

                  <!-- Row 1 -->

                  <div class="row">
                    <h4>Definición de colores</h4>
                    <div id="event-categories">

                      <div class="event-category label-orange" data-class="label-orange" style="background-color:#FF0000 !important">
                        <i class="fa fa-move"></i>
                        <?php
                          $sql_reservados = $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'id_empresa = '.$_SESSION['id_empresa'].' and color = "#FF0000" and id_user = '.$_SESSION['id_user'].' and (DATE(fecha_s) >= '.$date.') and tipo = "R" and active = 1','array');
                          if ($sql_reservados['total'] > 0){ $data_reservado = $sql_reservados['total'];}else{$data_reservado = 0;}
                          //$sel_reservado   = mysqli_query($link,"Select COUNT(*) as total_reservado From $TblBooking Where id_empresa = '".$_SESSION['id_empresa']."' and color = '#FF0000' and id_user = '".$_SESSION['id_user']."' and (DATE(fecha_s) >= '".$date."') and tipo = 'R' and active = 1");
                          //var_dump($sql_reservados['total']);
                          // if ($sql_reservados['total'] > 0) {
                          //   $data_reservado = $sql_reservados['total'];
                          // } else { 
                          //   $data_reservado=0;
                          // }
                          //if (mysqli_num_rows($sel_reservado)>0) { $data_reservado = mysqli_fetch_array($sel_reservado); }else{$data_reservado['total_reservado']=0;}
                        ?>
                        Reservado (<?php echo $data_reservado?>)
                      </div>
                      <div class="event-category label-green" data-class="label-green" style="background-color:#008000 !important">
                        <i class="fa fa-move"></i>
                        <?php
                        $sql_enuso = $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'id_empresa = '.$_SESSION['id_empresa'].' and color = "#008000" and id_user = '.$_SESSION['id_user'].' and (DATE(fecha_s) >= '.$date.') and tipo = "R" and active = 1','array');
                        if ($sql_enuso['total'] > 0){ $data_enuso = $sql_enuso['total'];}else{$data_enuso = 0;}
                        //$sel_uso   = mysqli_query($link,"Select COUNT(*) as total_uso From $TblBooking Where color = '#008000' and id_user = '".$_SESSION['id_user']."' and (DATE(fecha_s) >= '".$date."') and tipo = 'R' and activo = 1");
                        //if (mysqli_num_rows($sel_uso)>0) { $data_uso = mysqli_fetch_array($sel_uso); }else{$data_uso['total_uso']=0;}
                        ?>
                        En la habitación (<?=$data_enuso?>)
                      </div>

                      <div class="event-category label-yellow" data-class="label-yellow" style="color:#000;background-color:#FFD700 !important">
                        <i class="fa fa-move"></i>
                        <?php
                        $sql_limpieza = $ObjMante2->BuscarLoQueSea('*',PREFIX.'rooms','id_empresa = '.$_SESSION['id_empresa'].' and cleaning = 1 and active = 1','array');
                        if ($sql_limpieza['total'] > 0  ) { $data_limpieza = $sql_limpieza['total'];} else { $data_limpieza = 0;}
                        //$sel_limpieza   = mysqli_query($link,"Select COUNT(*) as total_limpieza From $TblBooking Where color = '#FFD700' and id_user = '".$_SESSION['id_user']."' and DATE(fecha_s) >= '".$date."' and activo = 1");
                        //if (mysqli_num_rows($sel_limpieza)>0) { $data_limpieza = mysqli_fetch_array($sel_limpieza); }else{$data_limpieza['total_limpieza']=0;}
                        ?>
                        En limpieza (<?=$data_limpieza?>) &nbsp;<img src="assets/images/icono_aspirador.png" />
                      </div>

                      <div class="event-category label-purple" data-class="label-purple" style="color:#000;background-color:#FF8C00 !important">
                        <i class="fa fa-move"></i>
                        <?php
                        $sql_limpieza = $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'id_empresa = '.$_SESSION['id_empresa'].' and tipo = "E" and DATE(fecha_s) >= '.$date.' and active = 1','array');
                        if ($sql_limpieza['total'] > 0) {$data_evento = $sql_limpieza['total']; } else { $data_evento = 0;}
                        //$sel_countE   = mysqli_query($link,"Select COUNT(*) as total_e From $TblBooking Where tipo = 'E' and DATE(fecha_s) >= '".$date."' and activo = 1");
                        //if (mysqli_num_rows($sel_countE)>0) { $dataE = mysqli_fetch_array($sel_countE); }else{$dataE['total_e']=0;}
                           
                        ?>
                        Evento Especial (<?=$data_evento;?>)
                      </div>
                    <!--
                      <div class="event-category label-default" data-class="label-default">
                        <i class="fa fa-move"></i>
                        En Limpieza &nbsp;<img src="web/images/icono_aspirador.png" />
                      </div>
                       <div class="checkbox">
                        <label>
                          <input type="checkbox" class="grey" id="drop-remove" />
                          Remove after drop
                        </label>
                      </div> -->
                    </div>
                  </div>
                  
                  <?php
                    $sel_tot = $ObjMante2->BuscarLoQueSea('*',$P_TablePlanning,'id_empresa = '.$_SESSION['id_empresa'],'array');
                    //$sel_tot   = mysqli_query($link,"Select COUNT(*) as totales From $TblBooking Where id_user = '".$_SESSION['id_user']."' and DATE(fecha_e) >= '".$date."' and activo = 1");
                    //if (mysqli_num_rows($sel_tot)>0) { $data_tot = mysqli_fetch_array($sel_tot); }else{$data_tot['totales']=0;}     
                    if ($sel_tot['total'] > 0 ) { $data_tot = $sel_tot['total']; } else { $data_tot = 0 ; }
                    $id_user    = $_SESSION['id_user'];
                    $id_empresa = $_SESSION['id_empresa'];

                    $datosRooms   = $ObjMante->BuscarLoQueSea('*',$P_TROOMS,'id_empresa = '.$_SESSION['id_empresa'].' and active = 1 ORDER BY id DESC LIMIT 7','array');
                    //$sel        = mysqli_query($link,"Select * From $TblRooms Where activo = '1' order by id desc LIMIT 7 ");

                   ?>
                     <div class="row">
                        <h5>Totales: (<?=$data_tot?>)</h5>
                        <div id="event-categories">
                         <?php
                         if ($datosRooms['resultado'] != null) :
                            foreach ($datosRooms['resultado'] as $datoRoom) {
                            //While ( $datos = mysqli_fetch_object($sel) ) {
                              $sel_count  = $ObjMante2->BuscarLoQueSea('COUNT(*) as total_r',$P_TROOMS,'rooms = '.$datoRoom['id'],'extract');
                              var_dump($sel_count['total_r']);
                              //$sel_count   = mysqli_query($link,"Select COUNT(*) as total_r From $TblBooking Where rooms = '".$datos->id."' and DATE(fecha_e) >= '".$date."' and activo = 1");
                              //if (mysqli_num_rows($sel_count)>0) { $dataC = mysqli_fetch_array($sel_count); }else{$dataC['total_r']=0;}
                          ?>
                          <div class="event-category label-default" data-class="label-orange" style="">
                            <i class="fa fa-move"></i>
                            <font size="1"><?=$datoRoom['code']?> (<?php echo $dataC['total_r'];?>)</font>
                          </div>
                          <?php
                            }
                          endif;
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
    


    <!-- 
      MODAL ADD 
    -->
    <div class="modal fade" id="ModalAdd" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="POST" action="?planning">
      
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-edit"></i> Agregar al planning</h4>
        <input type="hidden" name="form-action" id="form-action" value="add">
        </div>
        <div class="modal-body">
        <label id="mssg" style="color:red"></label>
          <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Tipo de Evento</label>
            <div class="col-sm-9">
            <select id="tipo_reserva" name="tipo_reserva" onchange="cambiarEvento()">
              <option value="">Seleccionar</option>
              <option value="R">Reservar Habitación</option>
              <option value="E">Evento Especial</option>
            </select>
              <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Titulo"> -->
            </div>
          </div>
       
       <!-- Evento Especial -->
          <div class="form-group" id="div_titulo" style="display: none">
            <label for="title" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
              <input type="text" id="" name="" autofocus="" autocomplete="off" required="required" class="evento form-control" placeholder="Nombre del Evento">
            </div>
          </div>


        <!-- Reservacion -->
          <div class="form-group" id="div_nombre" style="display: none">
            
            <div class="form-group">

              <label for="title" class="col-sm-3 control-label">Nombre</label>
              <div class="col-sm-9">
                <input type="text" id="" name="" autofocus="" autocomplete="off" required="required" class="reserva form-control" placeholder="Nombre">
              </div>
            </div>

            <div class="form-group">

              <label for="apellido" class="col-sm-3 control-label">Apellido</label>
              <div class="col-sm-9">
                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido">
              </div>
            </div>

            <div class="form-group">

              <label for="email" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" required="required" class="form-control" id="email" placeholder="Email">
              </div>

            </div>

             <div class="form-group">
                <label for="habitacion" class="col-sm-3 control-label">Habitación</label>
                <div class="col-sm-9">
                  <?php 
                  $sqlRooms  = $ObjMante->BuscarLoQueSea('*',$P_TROOMS,'id_empresa = '.$_SESSION['id_empresa'].' and active=1','array');
                  //$sql  = mysqli_query($link,"Select * From ".$TblRooms." Where activo = 1");
                  ?>
                  <select id="habitacion" name="habitacion" required="required" onchange="activarCampos( this )">
                    <option value="">select</option>
                    <?php
                        foreach($sqlRooms['resultado'] as $data) {
                        //while($data = mysqli_fetch_array($sql)) {
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['code']?></option>
                    <?php } ?>
                    
                  </select>
                </div>

             </div>

             <div class="form-group">
                <label for="precio" class="col-sm-3 control-label">Precio</label>
                <div class="col-sm-3">
                  <input type="number" min="1" disabled="disabled" step="0.01" name="precio" class="form-control input-tot_precio" id="precio" placeholder="Precio" value="0">
                </div>

                <label for="tot_personas" class="col-sm-3 control-label">Total Personas</label>
                <div class="col-sm-3">
                  <input type="number" min="1" required="required" max="8" name="tot_personas" class="form-control input-tot_personas" id="tot_personas" placeholder="Total de personas" value="1">
                </div>
             </div>
                
            <!-- Descuento -->
            <div class="form-group">
                <label for="descuento" class="col-sm-3 control-label">Descuento</label>
                <div class="col-sm-3">
                  <input type="number" min="0" disabled="disabled" step="1" name="descuento" class="form-control input-tot_descuento" id="descuento" placeholder="Descuento" value="0">
                </div>
                <label for="descuento" class="col-sm-3 control-label">Total</label>
                <div class="col-sm-3">
                  <input type="number" step="0.01" name="total_pagar" class="form-control" id="total_pagar" placeholder="Total a pagar" >
                </div>

            </div>
             
             <!-- Nacionalidad -->

            <div class="form-group">
             <?php 
              $sqlDatas  = $ObjMante->BuscarLoQueSea('*',$P_TNATIONALITIES,false,'array');
              ?>
             <label for="nacionalidad" class="col-sm-3 control-label">Nacionalidad</label>
              <div class="col-sm-9">
                <select id="nacionalidad" name="nacionalidad">
                  <option value="">select</option>
                  <?php foreach ($sqlDatas['resultado'] as $datos) { ?>
                    <option value="<?php echo $datos['id']; ?>"><?php echo $datos['nacionalidad']; ?></option>
                  <?php } ?>
                  </option>
                </select>
              </div>
             </div>
             
            <!-- Tipo de Documento -->
            <div class="form-group">
            <?php 
              //$sqlDatas  = $ObjMante->BuscarLoQueSea('*',$P_DOCUMENTSTYPE,false,'array');
              //$sql  = mysqli_query($link,"Select * From ad_tipo_documentos");
            ?>
             <label for="documento" class="col-sm-3 control-label">Documento</label>
              <div class="col-sm-3">
                <select required="required" id="documento" name="documento">
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
                <input type="text" name="n_documento" class="form-control" id="n_documento" placeholder="N°Documento">
              </div>
            </div>

            <div class="form-group">
              <label for="observacion" class="col-sm-3 control-label">Observación</label>
              <div class="col-sm-9">
                <textarea name="observacion" class="form-control" rows="2" cols="50" style="width:100%" id="observacion" placeholder="observacion" maxlength="80"></textarea>
                <label>(80 caracteres)</label>
              </div>
            </div>
          </div>


          <div class="form-group">
          <label for="color" class="col-sm-3 control-label">Color</label>
          <div class="col-sm-9">
            <select name="color"id="color">
                    <option value="">Seleccionar</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Reservado</option>      
              <!-- <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option> -->
              <option style="color:#008000;" value="#008000">&#9724; En la habitación</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Limpieza</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Evento Especial</option>
              
              <!-- <option style="color:#000;" value="#000">&#9724; Negro</option> -->
              
            </select>
          </div>
          </div>
          <div class="form-group" style="">
            <label for="start" class="col-sm-3 control-label">Fecha Inicial</label>
            <div class="col-sm-3">
              <input type="text" name="start" class="form-control" id="start" readonly>
            </div>
            <!-- </div>
            <div class="form-group"> -->
            <label for="end" class="col-sm-3 control-label">Fecha Final</label>
            <div class="col-sm-3">
              <input type="text" name="end" class="form-control" id="end" readonly>
              <input type="hidden" name="dias_entre_fecha" id="dias_entre_fecha" readonly>
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
              <option value="">Seleccionar</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Reservado</option>      
              <!-- <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option> -->
              <option style="color:#008000;" value="#008000">&#9724; En la habitación</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Limpieza</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Evento Especial</option>   
              <!-- <option style="color:#000;" value="#000">&#9724; Negro</option> --> 
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

    </div>
    <!-- /.container -->


<!-- Modal Add Room -->
<?php get_view_part ( 'facturacion-nuevo' )?>
<!-- En Add Room -->

<!-- Modal Add Services -->
<?php get_view_part ( 'facturacion-servicio' )?>
<!-- En Add Services -->

<!-- Modal Add Products -->
<?php get_view_part ( 'facturacion-producto' )?>
<!-- En Add Products -->


  <!-- FullCalendar -->
  <script src='assets/js/moment/moment.min.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.min.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/locale/es.js'></script>
  

    <script type="text/javascript">//<![CDATA[

      // var cal = Calendar.setup({
      //     onSelect: function(cal) { cal.hide() },
      //     showTime: true
      // });
      // cal.manageFields("fecha_e_editar", "f_date1", "%Y-%m-%d");
      // cal.manageFields("f_btn2", "f_date2", "%b %e, %Y");
      // cal.manageFields("f_btn3", "f_date3", "%e %B %Y");
      // cal.manageFields("f_btn4", "f_date4", "%A, %e %B, %Y");

    //]]></script>

<script>

$('[class*="input-tot_"]').on('change', (e)=>{
  totalPagar ( $('#precio').val(), false )
});

function guardarReserva () {
  if ($('#tipo_reserva').val() == '') {
    jQuery('#mssg').html('Seleccione tipo de evento');
    jQuery('#mssg').focus();
  }
}

function activarCampos () {

if( $('#habitacion').val() != '') { 

  $('#precio').removeAttr('disabled');
  $('#descuento').removeAttr('disabled'); 

  var precio        =   $("#precio")[0]; 
  var room          =   $("#habitacion").val(); 
  var tbl           =   '<?php echo 'rooms'; ?>';

   //mostrar('cargando'); 
   ajax2Z = nuevoAjax();
   ajax2Z.open("GET", "ajax/ajax_buscar_precio.php?hab="+room+"&tbl="+tbl,true);
    
   ajax2Z.onreadystatechange = function() {
       if ( ajax2Z.readyState==4 ) {
          $("#precio").val(ajax2Z.responseText) ;
          totalPagar ( ajax2Z.responseText, false )
       }
   }
   ajax2Z.send(null);


} else { 

  $('#precio').attr('disabled','disabled');
  $('#descuento').attr('disabled','disabled'); 
  $('#precio').val('0');
  $('#descuento').val('0');
} 
}


function activarCamposEdit () {

if( $('#habitacion_edit').val() != '') { 

  //$('#precio_edit').removeAttr('disabled');
  //$('#descuento_edit').removeAttr('disabled'); 

  var precio        =   $("#precio_edit")[0]; 
  var price         =   $("#habitacion_edit").val(); 
  var tbl           =   '<?php echo $TblRooms; ?>';

   //mostrar('cargando'); 
   ajax2Z = nuevoAjax();
   ajax2Z.open("GET", "ajax/ajax_buscar_precio.php?hab="+price+"&tbl="+tbl,true);

   ajax2Z.onreadystatechange = function() {
       if ( ajax2Z.readyState==4 ) {
          $("#precio_edit").val(ajax2Z.responseText) ; 
       }
   }
   ajax2Z.send(null);


} else { 
  alert('No se puede hacer esta acción');
  return false;
  //$('#precio_edit').attr('disabled','disabled');
  //$('#descuento_edit').attr('disabled','disabled'); 
  $('#precio_edit').val('0');
  $('#descuento_edit').val('0');
} 
}

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

function cambiarEvento () {

jQuery('#mssg').html('');

if( $('#tipo_reserva').val() == 'R') { 

  $('.reserva').attr('id', 'title');
  $('.reserva').attr('name', 'title');
  $('.reserva').prop('required', true);
  $('.reserva').focus();

  $('.evento').attr('id', '');
  $('.evento').attr('name', '');
  $('.evento').prop('required', false);

  $('#email').prop('required', true);
  $('#habitacion').prop('required', true);
  $('#tot_personas').prop('required', true);
  $('#documento').prop('required', true);


  $('#div_nombre').show();
  $('#div_titulo').hide(); 

} 

if ( $('#tipo_reserva').val() == 'E' ) {

  $('.evento').attr('id', 'title');
  $('.evento').attr('name', 'title');
  $('.evento').prop('required', true);
  $('.evento').focus();

  $('.reserva').attr('id', '');
  $('.reserva').attr('name', '');
  $('.reserva').prop('required', false);

  $('#email').prop('required', false);
  $('#habitacion').prop('required', false);
  $('#tot_personas').prop('required', false);
  $('#documento').prop('required', false);

  $('#div_nombre').hide();
  $('#div_titulo').show(); 

} 

if ( $('#tipo_reserva').val() == '' ) {

  $('.evento').attr('id', '');
  $('.evento').attr('name', '');
  $('.evento').prop('required', false);

  $('.reserva').attr('id', '');
  $('.reserva').attr('name', '');
  $('.reserva').prop('required', false);

  $('#div_nombre').hide();
  $('#div_titulo').hide(); 

  jQuery('#mssg').html('Seleccione tipo de evento');
}

}

// EDIT / MOdIFICAR / MOdIFIER
function guardarDatos () {
//window.location.href="?planning";
document.forms["EditDataModal"].submit();
}


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
      //defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
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
          } else { 
            $('#ModalEdit #div_reservar_editar').show();
            $('#ModalEdit #id_editar').val(event.id);
            //$('#ModalEdit #title').show();
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #email').val(event.email);
            $('#ModalEdit #apellido_edit').val(event.apellido);
            $('#ModalEdit #habitacion_edit').val(event.rooms);
            $('#ModalEdit #tot_personas').val(event.totpersons);
            $('#ModalEdit #precio_edit').val(event.precio);
            $('#ModalEdit #descuento_edit').val(event.descuento);
            $('#ModalEdit #nacionalidad_edit').val(event.nacionalidad);
            $('#ModalEdit #documento_edit').val(event.documento);
            $('#ModalEdit #n_documento_edit').val(event.ndocumento);
            $('#ModalEdit #observacion_edit').val(event.observacion);
            $('#ModalEdit #color').val(event.color);
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
      events: [
      <?php 
      if ($event!=null) :
      foreach($events as $event):
        $start  = explode(" ", $event['fecha_e']);
        $end    = explode(" ", $event['fecha_s']);
        $price  = $event['price'];
        $apellido  = $event['last_name'];

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
        // Aqui muestro en el calendario y los muestro
        // en los campos al querer editar la info.
        // ********************************************
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          apellido: '<?php echo $event['last_name']; ?>',
          email: '<?php echo $event['email']; ?>',
          rooms: '<?php echo $event['rooms']; ?>',
          totpersons: '<?php echo $event['total_persons']; ?>',
          precio: '<?php echo $price; ?>',
          descuento: '<?php echo $event['discounts']; ?>',
          nacionalidad: '<?php echo $event['nationality']; ?>',
          documento: '<?php echo $event['type_doc']; ?>',
          ndocumento: '<?php echo $event['number_doc']; ?>',
          observacion: '<?php echo $event['observation']; ?>',
          start: '<?php echo $event['fecha_e']; ?>',
          end: '<?php echo $event['fecha_s']; ?>',
          tipo: '<?php echo $event['tipo']?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; endif; ?>
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
$( "#fecha_e_editar" ).datepicker();
$( "#fecha_e_editar" ).datepicker("option", "dateFormat","yy-mm-dd");


$( "#fecha_s_editar" ).datepicker();
$( "#fecha_s_editar" ).datepicker("option", "dateFormat","yy-mm-dd");

$("#tipo_reserva").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("#habitacion").select2({ width: '100%', dropdownCssClass: "bigdrop" });

$("#nacionalidad").select2({ width: '100%', dropdownCssClass: "bigdrop" });
$("#documento").select2({ width: '100%', dropdownCssClass: "bigdrop" });
$("#color").select2({ width: '100%', dropdownCssClass: "bigdrop" });

</script>

</body>
