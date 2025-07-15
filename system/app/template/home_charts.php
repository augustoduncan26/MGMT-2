<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   	= new Mantenimientos();
$ObjEjec    	= new ejecutorSQL();
$id_rol     	= $_SESSION["id_rol"];
$id_user    	= $_SESSION["id_user"];
$id_cia 		= $_SESSION['id_cia'];
$email 			= $_SESSION['email'];
$username 		= $_SESSION['username'];
$P_tabla   		= PREFIX.'usuarios';

$evensLists 	= $ObjMante->BuscarLoQueSea('*',PREFIX.'events','activo=1','array');
$totalStudents 	= $ObjMante->BuscarLoQueSea('*',$P_tabla,'id_perfil=2',false);
$totalParents 	= $ObjMante->BuscarLoQueSea('*',$P_tabla,'id_perfil=1',false);

?>
<script src="assets/js/Chart.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->

<div class="row">
    <!-- LEFT PANNEL -->
     <!-- Asistencia -->
    <div class="col-sm-7 flex">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Asistencia
                <!-- <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                </div> -->
            </div>
            <div class="panel-body">
                <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
        </div>

<!-- Mensajes -->
<!-- start: INBOX PANEL -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-envelope-o"></i>
        Mensajes
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
    <div class="panel-body messages">
        <ul class="messages-list">
            <!-- <li class="messages-search">
                <form action="#" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search messages...">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li> -->
            <li class="messages-item">
                <!-- <span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span> -->
                <!-- Image -->
                <img alt="" src="assets/images/avatar-1.jpg" class="messages-item-avatar">
                <!-- From -->
                <span class="messages-item-from">Peter Clark</span>
                <!-- Date -->
                <div class="messages-item-time">
                    <span class="text">10:23 PM</span>
                </div>
                <!-- Subject -->
                <span class="messages-item-subject">Lorem ipsumdolor sit amet ...</span>
                <!-- Message -->
                <span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
            </li>
            <li class="messages-item">
                <!-- <span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span> -->
                <!-- Image -->
                <img alt="" src="assets/images/avatar-2.jpg" class="messages-item-avatar">
                <!-- From -->
                <span class="messages-item-from">Jhon Doe</span>
                <!-- Date -->
                <div class="messages-item-time">
                    <span class="text">10:23 PM</span>
                </div>
                <!-- Subject -->
                <span class="messages-item-subject">Lorem ipsumdolor sit amet ...</span>
                <!-- Message -->
                <span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
            </li>
            <li class="messages-item">
                <!-- <span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span> -->
                <!-- Image -->
                <img alt="" src="assets/images/avatar-1.jpg" class="messages-item-avatar">
                <!-- From -->
                <span class="messages-item-from">Peter Clark</span>
                <!-- Date -->
                <div class="messages-item-time">
                    <span class="text">10:23 PM</span>
                </div>
                <!-- Subject -->
                <span class="messages-item-subject">Lorem ipsumdolor sit amet ...</span>
                <!-- Message -->
                <span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
            </li>
        </ul>
    </div>
</div>
<!-- end: INBOX PANEL -->

<!-- Finanza -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Finanza
                <!-- <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                </div> -->
            </div>
            <div class="panel-body">
                <canvas id="line-chart" width="800" height="450"></canvas>
            </div>
        </div>

        
           
    </div>
    <!-- END LEFT PANNEL -->

    <!-- RIGHT PANNEL -->
     <!-- Estudiantes -->
    <div class="col-sm-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Estudiantes
                <!-- <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                </div> -->
            </div>
            <div class="panel-body">
                <canvas id="doughnut-chart" width="800" height="450">
                <p>Hello Fallback World</p>
                </canvas>
            </div>
        </div>


        <!-- Eventos -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-checkbox"></i>
                Eventos
                <!-- <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-xs btn-link panel-close" href="#"><i class="fa fa-times"></i></a>
                </div> -->
            </div>
            <div class="panel-body panel-scroll ps-container" style="height:300px">
                <ul class="todo">
                    <?php
                        foreach ($evensLists['resultado'] as $key => $value) {
                            $date = explode(' ',$value['created_at']);
                    ?>
                    <li>
                        <a class="todo-actions" href="javascript:void(0)">
                            <i class="fa fa-square-o"></i>
                            <span class="desc" style="opacity: 1; text-decoration: none;"><?=$value['name']?></span>
                            <span class="label label-success" style="opacity: 1;"> <?=$date[0]?></span>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 448px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 300px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 214px;"></div></div></div>
        </div>

        <!-- Calendar -->
        <!-- <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-calendar"></i>
                Calendar
                <div class="panel-tools">
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
                </div>
            </div>
            <div class="panel-body">
                <div id="calendar" class="fc fc-ltr"><table class="fc-header" style="width:100%"><tbody><tr><td class="fc-header-left"><span class="fc-button fc-button-prev fc-state-default fc-corner-left" unselectable="on"><i class="fa fa-chevron-left"></i></span><span class="fc-button fc-button-next fc-state-default fc-corner-right" unselectable="on"><i class="fa fa-chevron-right"></i></span><span class="fc-header-space"></span><span class="fc-button fc-button-today fc-state-default fc-corner-left fc-corner-right fc-state-disabled" unselectable="on">Hoy</span></td><td class="fc-header-center"><span class="fc-header-title"><h2>Marzo 2025</h2></span></td><td class="fc-header-right"><span class="fc-button fc-button-month fc-state-default fc-corner-left fc-state-active" unselectable="on">mes</span><span class="fc-button fc-button-agendaWeek fc-state-default" unselectable="on">semana</span><span class="fc-button fc-button-agendaDay fc-state-default fc-corner-right" unselectable="on">día</span></td></tr></tbody></table><div class="fc-content" style="position: relative; min-height: 1px;"><div class="fc-view fc-view-month fc-grid" style="position: relative; min-height: 1px;" unselectable="on"><div style="position:absolute;z-index:8;top:0;left:0"><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end label-default" style="position: absolute; z-index: 8; left: 549px; width: 79px; top: 46px;"><div class="fc-event-inner"><span class="fc-event-title">Meeting with Boss..</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start label-teal" style="position: absolute; z-index: 8; left: 367px; width: 265px; top: 197px;"><div class="fc-event-inner"><span class="fc-event-title">Bootstrap Seminar</span></div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end label-green" style="position: absolute; z-index: 8; left: 549px; width: 79px; top: 221px;"><div class="fc-event-inner"><span class="fc-event-time">12p</span><span class="fc-event-title">Lunch with Nicole</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-end label-teal" style="position: absolute; z-index: 8; left: 0px; width: 84px; top: 288px;"><div class="fc-event-inner"><span class="fc-event-title">Bootstrap Seminar</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div></div><table class="fc-border-separate" style="width:100%" cellspacing="0"><thead><tr class="fc-first fc-last"><th class="fc-day-header fc-sun fc-widget-header fc-first" style="width: 91px;">Do</th><th class="fc-day-header fc-mon fc-widget-header" style="width: 91px;">Lu</th><th class="fc-day-header fc-tue fc-widget-header" style="width: 91px;">Ma</th><th class="fc-day-header fc-wed fc-widget-header" style="width: 91px;">Mi</th><th class="fc-day-header fc-thu fc-widget-header" style="width: 91px;">Ju</th><th class="fc-day-header fc-fri fc-widget-header" style="width: 91px;">Vi</th><th class="fc-day-header fc-sat fc-widget-header fc-last">Sa</th></tr></thead><tbody><tr class="fc-week fc-first"><td class="fc-day fc-sun fc-widget-content fc-other-month fc-first" data-date="2025-02-23"><div style="min-height: 75px;"><div class="fc-day-number">23</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-other-month" data-date="2025-02-24"><div><div class="fc-day-number">24</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-other-month" data-date="2025-02-25"><div><div class="fc-day-number">25</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-other-month" data-date="2025-02-26"><div><div class="fc-day-number">26</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-other-month" data-date="2025-02-27"><div><div class="fc-day-number">27</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-other-month" data-date="2025-02-28"><div><div class="fc-day-number">28</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-last" data-date="2025-03-01"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-first" data-date="2025-03-02"><div style="min-height: 74px;"><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content" data-date="2025-03-03"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content" data-date="2025-03-04"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content" data-date="2025-03-05"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content" data-date="2025-03-06"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content" data-date="2025-03-07"><div><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-last" data-date="2025-03-08"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-first" data-date="2025-03-09"><div style="min-height: 74px;"><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content" data-date="2025-03-10"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content" data-date="2025-03-11"><div><div class="fc-day-number">11</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content" data-date="2025-03-12"><div><div class="fc-day-number">12</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content" data-date="2025-03-13"><div><div class="fc-day-number">13</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content" data-date="2025-03-14"><div><div class="fc-day-number">14</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-last" data-date="2025-03-15"><div><div class="fc-day-number">15</div><div class="fc-day-content"><div style="position: relative; height: 65px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-first" data-date="2025-03-16"><div style="min-height: 74px;"><div class="fc-day-number">16</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content" data-date="2025-03-17"><div><div class="fc-day-number">17</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-today fc-state-highlight" data-date="2025-03-18"><div><div class="fc-day-number">18</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content" data-date="2025-03-19"><div><div class="fc-day-number">19</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content" data-date="2025-03-20"><div><div class="fc-day-number">20</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content" data-date="2025-03-21"><div><div class="fc-day-number">21</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-last" data-date="2025-03-22"><div><div class="fc-day-number">22</div><div class="fc-day-content"><div style="position: relative; height: 41px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-first" data-date="2025-03-23"><div style="min-height: 74px;"><div class="fc-day-number">23</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content" data-date="2025-03-24"><div><div class="fc-day-number">24</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content" data-date="2025-03-25"><div><div class="fc-day-number">25</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content" data-date="2025-03-26"><div><div class="fc-day-number">26</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content" data-date="2025-03-27"><div><div class="fc-day-number">27</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content" data-date="2025-03-28"><div><div class="fc-day-number">28</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-last" data-date="2025-03-29"><div><div class="fc-day-number">29</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr><tr class="fc-week fc-last"><td class="fc-day fc-sun fc-widget-content fc-first" data-date="2025-03-30"><div style="min-height: 73px;"><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content" data-date="2025-03-31"><div><div class="fc-day-number">31</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-other-month" data-date="2025-04-01"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-other-month" data-date="2025-04-02"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-other-month" data-date="2025-04-03"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-other-month" data-date="2025-04-04"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-other-month fc-last" data-date="2025-04-05"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr></tbody></table></div></div></div>
            </div>
        </div> -->
        <!-- End Calendar --> 

    </div>
    <!-- END RIGHT PANNEL -->

</div>
<!-- END ORW -->





<script>
// Bar chart
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            ],
    borderWidth: 1,
          //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});

// Doughnut Chart
new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});

// Line Chart
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
    datasets: [{ 
        data: [86,114,106,106,107,111,133,221,783,2478],
        label: "Africa",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [282,350,411,502,635,809,947,1402,3700,5267],
        label: "Asia",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [168,170,178,190,203,276,408,547,675,734],
        label: "Europe",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [40,20,10,16,24,38,74,167,508,784],
        label: "Latin America",
        borderColor: "#e8c3b9",
        fill: false
      }, { 
        data: [6,3,2,2,7,26,82,172,312,433],
        label: "North America",
        borderColor: "#c45850",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});
</script>

<?php /*  ?>
<div class="row">
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Site Visits
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-close" href="#">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="flot-medium-container">
                    <div id="placeholder-h1" class="flot-placeholder" style="padding: 0px; position: relative;">
                        <canvas class="flot-base" width="1274" height="720" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 637px; height: 360px;"></canvas>
                        <div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                            <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px; display: block;">
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 42px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 84px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 125px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 167px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 205px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 247px; text-align: center;">12</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 289px; text-align: center;">14</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 330px; text-align: center;">16</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 372px; text-align: center;">18</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 414px; text-align: center;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 456px; text-align: center;">22</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 497px; text-align: center;">24</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 539px; text-align: center;">26</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 581px; text-align: center;">28</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 39px; top: 343px; left: 623px; text-align: center;">30</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 330px; left: 13px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 304px; left: 6px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 279px; left: 6px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 254px; left: 6px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 228px; left: 6px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 6px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 178px; left: 6px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 152px; left: 6px; text-align: right;">70</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 127px; left: 6px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 102px; left: 6px; text-align: right;">90</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 76px; left: 0px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 51px; left: 0px; text-align: right;">110</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 26px; left: 0px; text-align: right;">120</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 0px; text-align: right;">130</div></div></div><canvas class="flot-overlay" width="1274" height="720" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 637px; height: 360px;"></canvas><div class="legend"><div style="position: absolute; width: 106px; height: 38px; top: 14px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;right:13px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(209,38,16);overflow:hidden"></div></div></td><td class="legendLabel">Hab. Simple</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(55,183,243);overflow:hidden"></div></div></td><td class="legendLabel">Hab. Matrimonial</td></tr></tbody></table></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="clip-pie"></i>
                        Acquisition
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-mini-container">
                            <div id="placeholder-h2" class="flot-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" width="876" height="270" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 438px; height: 135px;"></canvas><canvas class="flot-overlay" width="876" height="270" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 438px; height: 135px;"></canvas><div class="pieLabelBackground" style="position: absolute; width: 40px; height: 38px; top: 10.5px; left: 263px; background-color: rgb(203, 75, 75); opacity: 0.8;"></div><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 10.5px; left: 263px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series3<br>22%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40px; height: 38px; top: 75px; left: 283px; background-color: rgb(77, 167, 77); opacity: 0.8;"></div><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 75px; left: 283px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series4<br>23%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40px; height: 38px; top: 96.5px; left: 173px; background-color: rgb(189, 155, 51); opacity: 0.8;"></div><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 96.5px; left: 173px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series6<br>17%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40px; height: 38px; top: 45px; left: 100px; background-color: rgb(140, 172, 198); opacity: 0.8;"></div><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 45px; left: 100px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series7<br>27%</div></span><div class="pieLabelBackground" style="position: absolute; width: 31px; height: 38px; top: 1.5px; left: 171.5px; background-color: rgb(153, 153, 153); opacity: 0.8;"></div><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 1.5px; left: 171.5px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Other<br>10%</div></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="clip-bars"></i>
                        Pageviews real-time
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-mini-container">
                            <div id="placeholder-h3" class="flot-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" width="876" height="270" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 438px; height: 135px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 118px; left: 14px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 88px; left: 7px; text-align: right;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 59px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 30px; left: 7px; text-align: right;">75</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">100</div></div></div><canvas class="flot-overlay" width="876" height="270" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 438px; height: 135px;"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php */ ?>

<?php //get_template_part('footer_scripts');?>


<!-- <link rel="stylesheet" href="assets/plugins/jquery-datepicker/jquery-ui.css">
<script src="assets/plugins/jquery-datepicker/jquery-1.12.4.js"></script>
<script src="assets/plugins/jquery-datepicker/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/plugins/FullCalendar/fullcalendar/fullcalendar.css"> -->



<!-- FullCalendar -->
<!-- <script src='assets/js/moment/moment.min.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.min.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.js'></script>
  <script src='assets/plugins/FullCalendar/js/fullcalendar/locale/es.js'></script> -->

