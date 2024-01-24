<?php 

header("Content-Type: text/html;charset=utf-8");

include ( dirname(__FILE__).'/load.php' );

// Rooms en uso + salas de eventos
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

?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>
.img-dashboard {
  opacity: 20%;
  margin-top: 10%;
  display: flex;
  justify-content: center;
}
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
                echo '<div class="img-dashboard col-md-12 col-sm-12"><img src="assets/images/template/DC_logo.png" class="circle-img " alt=""></div>';
              }

              ?>
              
        </div>
      </div>
      <!-- end: PAGE -->
    </div>
    
    <!-- end: MAIN CONTAINER -->

   <?php get_template_part('footer');?>
   
  </body>
</html>