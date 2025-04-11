<?php 
header("Content-Type: text/html;charset=utf-8");
include ( dirname(__FILE__).'/load.php' );

// Rooms en uso + salas de eventos
// $TblBooking  = 'ad_'.$_SESSION['id_user'].'_reservas';

// $date_today =   date('Y-m-d');
// $ObjMante   =   new Mantenimientos();
// $inUser     =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and color='#008000' and activo = 1 and tipo = 'R'",false);
// $reserved   =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and color='#FF0000' and activo = 1 and tipo = 'R'",false);
// $total_rooms=   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'R'",false);
// $sum_total  =   $ObjMante->BuscarLoQueSea('*' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'E'",false);
// $total_event=   $ObjMante->BuscarLoQueSea(' SUM(total_price) as total_price' , $TblBooking ," DATE(fecha_s) >= '".$date_today."' and activo = 1 and tipo = 'E'",'extract');

//$tmoneda    =   $ObjMante->BuscarLoQueSea('*' , 'ad_admin_empresas' ," id_empresa = '".$_SESSION['id_empresa']."'",'extract');
//$moneda     =   $ObjMante->BuscarLoQueSea('*' , 'ad_type_moneda' ," id = '".$tmoneda['tipo_moneda']."'",'extract');

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>
.img-dashboard {
  opacity: 20%;
  margin-top: 2%;
  display: flex;
  justify-content: center;
}
.welcome-title {
  opacity: 50%;
  margin-top: 0%;
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
        
        <div class="row">&nbsp;</div>

        <!-- Logo Message -->
          <div class="row">
            <div class="col-sm-12">

              <?php 

              if($_GET) { 

                get_theView();

              } else {

                get_template_part('home_statistic_data');

                get_template_part('home_charts');

              }

              ?>
              
        </div>
        


        <?php /* ?>
        <!-- ... HTML existente ... -->
        <p>
      This is the first comment.
      <!-- We will put our React component inside this div. -->
      <div class="like_button_container" data-commentid="1"></div>
    </p>

    <p>
      This is the second comment.
      <!-- We will put our React component inside this div. -->
      <div class="like_button_container" data-commentid="2"></div>
    </p>

    <p>
      This is the third comment.
      <!-- We will put our React component inside this div. -->
      <div class="like_button_container" data-commentid="3"></div>
    </p>
  <!-- ... HTML existente ... -->
  <!-- Cargar React. -->
  <!-- Nota: cuando se despliegue, reemplazar "development.js" con "production.min.js". -->
  <!-- <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script> -->
  <!-- Cargamos nuestro componente de React. -->
  <!--src="like_button.js" --><script >
    'use strict';

const e = React.createElement;

class LikeButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { liked: false };
  }

  render() {
    if (this.state.liked) {
      return 'You liked comment number ' + this.props.commentID;
    }

    return e(
      'button',
      { onClick: () => this.setState({ liked: true }) },
      'Like'
    );
  }
}

// Find all DOM containers, and render Like buttons into them.
document.querySelectorAll('.like_button_container')
  .forEach(domContainer => {
    // Read the comment ID from a data-* attribute.
    const commentID = parseInt(domContainer.dataset.commentid, 10);
    const root = ReactDOM.createRoot(domContainer);
    root.render(
      e(LikeButton, { commentID: commentID })
    );
  });
  </script>


<div id="root"></div>

<script type="text/babel">
class Greeting extends React.Component {
    render() {
        return (<p>Hello world Sinclair</p>);
    }
}
ReactDOM.render( <Greeting />, document.getElementById('root'));
</script>

<?php */ ?>

      </div>
      <!-- end: PAGE -->
    </div>
    
    <!-- end: MAIN CONTAINER -->

   <?php get_template_part('footer');?>
   
  </body>
</html>