<?php 

header("Content-Type: text/html;charset=utf-8");

include ( dirname(__FILE__).'/load.php' );

// Habitaciones en uso + salas de eventos
$_SESSION['id_user'] = 6;
$TblBooking  = 'ad_'.$_SESSION['id_user'].'_reservas';

$date_today =   date('Y-m-d');
$ObjMante   =   new Mantenimientos();
$inUser     =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and color='#008000' and activo = 1 and tipo = 'R'",false);
$reserved   =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and color='#FF0000' and activo = 1 and tipo = 'R'",false);
$total_rooms=   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'R'",false);
$sum_total  =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'E'",false);
$total_event=   $ObjMante->BuscarLoQueSea(' SUM(total_price) as total_price' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'E'",'extract');

$tmoneda    =   $ObjMante->BuscarLoQueSea('*' , 'ad_admin_empresas' ," id_empresa = '".$_SESSION['id_empresa']."'",'extract');
$moneda     =   $ObjMante->BuscarLoQueSea('*' , 'ad_type_moneda' ," id = '".$tmoneda['tipo_moneda']."'",'extract');

//get_template_part('load') ;
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>
  /* .sub-menu {
		padding: 0px 0px 0px 20px;
		z-index: 999;
		background-color: white !important;
		width: 100%;
		border-radius: 0px 0px 5px 5px;
		border-style: groove;
	} */
</style>
<?php get_template_part('header');?>


    <!-- start: HEADER -->
    <?php get_template_part('top_menu');?>
    <!-- end: HEADER -->

 <!-- start: BODY -->
  <body>
  


    <!-- start: MAIN CONTAINER -->
    <div class="main-container">

      <div class="navbar-content">


        <!-- start: SIDEBAR -->
        <?php get_template_part('left_menu');?>
        <!-- end: SIDEBAR -->


      </div>


      <!-- start: PAGE -->
      <div class="main-content">
        <!-- start: PANEL CONFIGURATION MODAL FORM -->
       
        <!-- /.modal -->


        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container" style="background-color: #fff !important">
          <!-- start: PAGE HEADER -->
          <div class="row">
            <div class="col-sm-12">

              <?php 

              if($_GET) { 
                get_theView();
              } else { 

              ?>
              <!-- start: STYLE SELECTOR BOX -->
              <?php //get_template_part('style_selector');?>
              <!-- end: STYLE SELECTOR BOX -->



              <!-- start: PAGE TITLE & BREADCRUMB -->
              <!-- SITE MAP & Searching input -->
              <!--
              <ol class="breadcrumb">
                <li>
                  <i class="clip-home-3"></i>
                  <a href="#">
                    Home
                  </a>
                </li>
                <li class="active">
                  Dashboard
                </li>
                <li class="search-box">
                  <form class="sidebar-search">
                    <div class="form-group">
                      <input type="text" placeholder="Start Searching...">
                      <button class="submit">
                        <i class="clip-search-3"></i>
                      </button>
                    </div>
                  </form>
                </li>
              </ol>
              -->
              <!-- End Site Map & Searching input -->
              
        <div class="row top_tiles hide">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                <div class="tile-stats text-center" >
                  <h3 class="col-md-12 color-blanco" style="float: left;"  onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''">Ingresos</h3>
                  <div class="count large-fsize"><i class=" fa fa-usd" style="font-size: 25px; color: black"></i> <?php echo '42,723.41';//echo isset($inUser['total'])?$inUser['total']:0;?></div>
                  <p>Total de Ingresos del Mes.</p>
                <!--  <div class="icon"><i onmouseover="this.style.color='red'" onmouseout="this.style.color=''" class="fa fa-check"></i></div>
                  <div class="count large-fsize"><?php echo isset($inUser['total'])?$inUser['total']:0;?></div>
                  <h3 onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''">En Uso</h3>
                  <p>Total de habitaciones en uso.</p>
                -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats text-center">
                  <h3 class="col-md-12 color-blanco" style="float: left;"  onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''">Gastos</h3>
                  <div class="count large-fsize"><i class=" fa fa-usd" style="font-size: 25px; color: black"></i> <?php echo '31,723.00';//echo isset($inUser['total'])?$inUser['total']:0;?></div>
                  <p>Total de Gastos del Mes.</p>
                <!--
                  <div class="icon"><i onmouseover="this.style.color='red'" onmouseout="this.style.color=''" class="fa fa-info-circle"></i></div>
                  <div class="count large-fsize"><?php echo isset($reserved['total'])?$reserved['total']:0?></div>
                  <h3 onmouseover="this.style.color='red'" onmouseout="this.style.color=''">Reservadas</h3>
                  <p>Total de reservas.</p>
                -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats text-center">

                  <h3 class="col-md-12 color-blanco" style="float: left;"  onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''">Totales Brutos</h3>
                  <div class="count large-fsize"><i class=" fa fa-usd" style="font-size: 25px; color: black"></i> <?php echo '16,544.41';//echo isset($inUser['total'])?$inUser['total']:0;?></div>
                  <p>Totales Brutos del Mes Corriente</p>
                  
                <!-- 
                  <div class="icon"><i onmouseover="this.style.color='red'" onmouseout="this.style.color=''" class="fa fa-signal"></i></div>
                  <div class="count large-fsize"><?php echo $moneda['symbol']; echo isset($total_event['total_price'])?number_format($total_event['total_price'],2):0;?></div>
                  <h3 onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''"><?php echo formato_mes(date('m'))?></h3>
                  <p>Total de importe de este mes</p>
                -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats text-center">
                  <h3 onmouseover="this.style.color='red'" onmouseout="this.style.color=''">Total Eventos</h3>
                  <div class="count large-fsize" id="total_habitaciones"><?php echo isset($total_rooms['total'])?$total_rooms['total']:0?></div>
                  <p>Total de eventos.</p>
                </div>
              </div>
            </div>

              <div class="page-header">
               
              </div>
              <!-- end: PAGE TITLE & BREADCRUMB -->

<!-- STATISTICS -->
          <!-- <div class="row">
            <div class="col-sm-7">
              <div class="row space12">
                <ul class="mini-stats col-sm-12">
                  <li class="col-sm-4">
                    <div class="sparkline_bar_good">
                      <span>3,5,9,8,13,11,14</span>+10%
                    </div>
                    <div class="values">
                      <strong>18304</strong>
                      Visits
                    </div>
                  </li>
                  <li class="col-sm-4">
                    <div class="sparkline_bar_neutral">
                      <span>20,15,18,14,10,12,15,20</span>0%
                    </div>
                    <div class="values">
                      <strong>3833</strong>
                      Unique Visitors
                    </div>
                  </li>
                  <li class="col-sm-4">
                    <div class="sparkline_bar_bad">
                      <span>4,6,10,8,12,21,11</span>+50%
                    </div>
                    <div class="values">
                      <strong>18304</strong>
                      Pageviews
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="row space12">
                <div class="col-sm-6">
                  <div class="easy-pie-chart">
                    <span class="bounce number" data-percent="44"> <span class="percent">44</span> </span>
                    <div class="label-chart">
                      Bounce Rate
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="easy-pie-chart">
                    <span class="cpu number" data-percent="82"> <span class="percent">82</span> </span>
                    <div class="label-chart">
                      New Visits
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

         <?php } ?>

         </div>
     </div>


          <!-- end: PAGE HEADER -->


          <!-- THE PAGE CONTENT -->
          <!-- start: PAGE CONTENT -->
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="heading">
                  <i class="clip-user-4 circle-icon circle-green"></i>
                  <h2>Manage Users</h2>
                </div>
                <div class="content">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                </div>
                <a class="view-more" href="#">
                  View More <i class="clip-arrow-right-2"></i>
                </a>
              </div>
            </div>
          </div> -->
      <?php if (GET()[0] == "") { ?>    
          <!-- Graphics -->
          <!-- <div class="row">
            <div class="col-sm-7">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="clip-stats"></i>
                  Estadísticas
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
                    <div id="placeholder-h1" class="flot-placeholder"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="clip-stats"></i>
                      Estadística por país
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
                        <div id="placeholder-h2" class="flot-placeholder"></div>
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
                      Estadística por país
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
                        <div id="placeholder-h3" class="flot-placeholder"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="row">
            <div class="col-md-7">
             <div class="panel panel-default">
              <div id="map" style="width:100%;height:500px"></div>
              </div>
              <script>
              function myMap() {
                var mapCanvas = document.getElementById("map");
                var mapOptions = {
                  center: new google.maps.LatLng(45.434046,12.340284),
                  zoom:18,
                  mapTypeId:google.maps.MapTypeId.HYBRID
                };
                var map = new google.maps.Map(mapCanvas,mapOptions);
                map.setTilt(100);
              }
              </script>

              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNSOh0FeaM4ZFdWEGB_O44DcAIWiZFV4Y&callback=myMap"></script>
              
              <! --
              To use this code on your website, get a free API key from Google.
              Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
              -- >
            </div> -->

             <!-- <div class="col-md-5">
            <p>Calificaciones / Evaluaciones</p>
              <div class="">
                <span class="rating"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></span>
              </div>
          </div>  -->
          
         
          <!-- Users (Edit,Share,Remove) & To Do -->
          <!-- <div class="row">
            <div class="col-sm-7">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="clip-users-2"></i>
                  Users
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
                <div class="panel-body panel-scroll" style="height:300px">
                  <table class="table table-striped table-hover" id="sample-table-1">
                    <thead>
                      <tr>
                        <th class="center">Photo</th>
                        <th>Full Name</th>
                        <th class="hidden-xs">Email</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="center"><img src="../assets/images/avatar-1.jpg" alt="image"/></td>
                        <td>Peter Clark</td>
                        <td class="hidden-xs">
                        <a href="#" rel="nofollow" target="_blank">
                          peter@example.com
                        </a></td>
                        <td class="center">
                        <div>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                              <i class="fa fa-cog"></i> <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-edit"></i> Edit
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-share"></i> Share
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-times"></i> Remove
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div></td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-2.jpg" alt="image"/></td>
                        <td>Nicole Bell</td>
                        <td class="hidden-xs">
                        <a href="#" rel="nofollow" target="_blank">
                          nicole@example.com
                        </a></td>
                        <td class="center">
                        <div>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                              <i class="fa fa-cog"></i> <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-edit"></i> Edit
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-share"></i> Share
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-times"></i> Remove
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div></td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-3.jpg" alt="image"/></td>
                        <td>Steven Thompson</td>
                        <td class="hidden-xs">
                        <a href="#" rel="nofollow" target="_blank">
                          steven@example.com
                        </a></td>
                        <td class="center">
                        <div>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                              <i class="fa fa-cog"></i> <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-edit"></i> Edit
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-share"></i> Share
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-times"></i> Remove
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div></td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-5.jpg" alt="image"/></td>
                        <td>Kenneth Ross</td>
                        <td class="hidden-xs">
                        <a href="#" rel="nofollow" target="_blank">
                          kenneth@example.com
                        </a></td>
                        <td class="center">
                        <div>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                              <i class="fa fa-cog"></i> <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-edit"></i> Edit
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-share"></i> Share
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-times"></i> Remove
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div></td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-4.jpg" alt="image"/></td>
                        <td>Ella Patterson</td>
                        <td class="hidden-xs">
                        <a href="#" rel="nofollow" target="_blank">
                          ella@example.com
                        </a></td>
                        <td class="center">
                        <div>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                              <i class="fa fa-cog"></i> <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-edit"></i> Edit
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-share"></i> Share
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <i class="fa fa-times"></i> Remove
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="clip-checkbox"></i>
                  To Do
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
                <div class="panel-body panel-scroll" style="height:300px">
                  <ul class="todo">
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                        <span class="label label-danger" style="opacity: 1;"> today</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                        <span class="label label-danger" style="opacity: 1;"> today</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> Hire developers</span>
                        <span class="label label-warning"> tommorow</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc">Staff Meeting</span>
                        <span class="label label-warning"> tommorow</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> New frontend layout</span>
                        <span class="label label-success"> this week</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> Hire developers</span>
                        <span class="label label-success"> this week</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> New frontend layout</span>
                        <span class="label label-info"> this month</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> Hire developers</span>
                        <span class="label label-info"> this month</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                        <span class="label label-danger" style="opacity: 1;"> today</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                        <span class="label label-danger" style="opacity: 1;"> today</span>
                      </a>
                    </li>
                    <li>
                      <a class="todo-actions" href="javascript:void(0)">
                        <i class="fa fa-square-o"></i>
                        <span class="desc"> Hire developers</span>
                        <span class="label label-warning"> tommorow</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div> -->

          <!-- THE CALENDAR -->
           <!-- <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
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
                  <div id='calendar'></div>
                </div>
              </div>
            </div> -->


            <!-- <div class="col-sm-5">
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="clip-bubble-4"></i>
                      Chats
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
                    <div class="panel-body panel-scroll" style="height:460px">
                      <ol class="discussion">
                        <li class="other">
                          <div class="avatar">
                            <img alt="" src="assets/images/avatar-4.jpg">
                          </div>
                          <div class="messages">
                            <p>
                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>
                            <span class="time"> Timothy • 51 min </span>
                          </div>
                        </li>
                        <li class="self">
                          <div class="avatar">
                            <img alt="" src="assets/images/avatar-1.jpg">
                          </div>
                          <div class="messages">
                            <p>
                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>
                            <span class="time"> 37 mins </span>
                          </div>
                        </li>
                        <li class="other">
                          <div class="avatar">
                            <img alt="" src="assets/images/avatar-3.jpg">
                          </div>
                          <div class="messages">
                            <p>
                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>
                          </div>
                        </li>
                        <li class="self">
                          <div class="avatar">
                            <img alt="" src="assets/images/avatar-1.jpg">
                          </div>
                          <div class="messages">
                            <p>
                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>
                          </div>
                        </li>
                        <li class="other">
                          <div class="avatar">
                            <img alt="" src="assets/images/avatar-4.jpg">
                          </div>
                          <div class="messages">
                            <p>
                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>
                          </div>
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="chat-form">
                    <div class="input-group">
                      <input type="text" class="form-control input-mask-date" placeholder="Type a message here...">
                      <span class="input-group-btn">
                        <button class="btn btn-teal" type="button">
                          <i class="fa fa-check"></i>
                        </button> </span>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <?php } ?> 

          </div> 

          <!-- end: PAGE CONTENT-->
          <!-- END THE PAGE CONTENT -->
        </div>
      </div>
      <!-- end: PAGE -->
    </div>
    <!-- end: MAIN CONTAINER -->
  <?php //include ( dirname(__FILE__) .'/footer.php'); ?>

   <?php get_template_part('footer');?>
   
  </body>
</html>