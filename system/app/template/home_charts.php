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

<div class="row">
    <!-- LEFT PANNEL -->
     <!-- Asistencia -->
    <div class="col-sm-7 flex">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Asistencia
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
    </div>
    <div class="panel-body messages">
        <ul class="messages-list">
            <li class="messages-item">
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
                <!-- Image -->
                <img alt="" src="assets/images/avatar-1.jpg" class="messages-item-avatar">
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


