<!-- <body topmargin="0" leftmargin="0">
<div class="contenidos" align="center" id="contenidos">
<iframe src="modules/Caja/index.php?db_name=<?php echo DB_NAME?>&user_id=<?=$_SESSION['id_user']?>&db_host=<?php echo DB_HOST?>&db_user=<?php echo DB_USER?>&db_pass=<?php echo DB_PASS?>" name="contenido" id="contenido" frameborder="0" width="100%" height="1200px"></iframe>
</div>
</body> -->

<!-- Theme style -->
<link href="assets/css/css-caja/plugins/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/css-caja/plugins/dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />

<body onload="">

<div class="contain">

<div class="row">
<p />
	<div class="col-md-12">
        <div class="col-lg-3 col-md-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$selProductos?></h3>

              <p>Productos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="?caja-productos" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?=$selClientes?></h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?caja-clientes" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$totProveedores?></h3>

              <p>Proveedores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="?caja-proveedores" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$totselFacturas?></h3>

              <p>Facturas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="?facturacion" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
  </div>
<!-- /End Row -->

<!-- Next Row -->
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>

<!-- onclick="$('#myModal').modal({'backdrop': 'static'});" -->
  <!-- <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nueva Habitación</a> -->
   <div class="row">
      <div class="col-sm-12">
        
        <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Administrar efectivo 
          </a>
        </div>
       
        <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Cuentas Contables 
          </a>
        </div>

        <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Gastos de Caja 
          </a>
        </div>

        <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Autorizaciones de Gastos 
          </a>
        </div>
       
          <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Transferencias 
          </a>
        </div>
       
          <div class="col-md-3">
          <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
               <i class="glyphicon glyphicon-edit"></i> Usuarios 
          </a>
        </div>
       
     </div>
   </div>

<div class="clearfix"><br /></div>

   <div class="row">
      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-money"></i>Administrar
           </div>
             <div class="panel-body">
              <div class="col-sm-12">
              <div style="height:10px;"></div>

                <div class="x_content">
                <!-- <img src="../../images/ajax-loader.gif" id="cargando_list" /> -->
                <div id="list-rooms"></div>
              </div>
            </div>
          </div>
       </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>

</body>

<script src="assets/css/css-caja/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="assets/css/css-caja/plugins/dist/js/app.min.js" type="text/javascript"></script>

<script src="assets/css/css-caja/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/css/css-caja/plugins/datatables/dataTables.bootstrap.min.js"></script>