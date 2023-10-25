<?php
	//session_start();
?>
	<?php //include("Facturacion/head.php");?>

   <body>
	<?php
	//include("Facturacion/navbar.php");
	?>  
<script>

// List all room
function listFacturas() {

  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_empresa"]?>';

  var contenido_editor = $('#list-rooms')[0];
  ajax1   = nuevoAjax();
  ajax1.open("GET", "ajax/ajax_list_facturas.php?id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax1.onreadystatechange=function() {

    if (ajax1.readyState==4) {
      contenido_editor.innerHTML = ajax1.responseText;
      $('#list-table-facturas').dataTable({aaSorting : [[0, 'desc']]});
    }
  }

  ajax1.send(null);
}
</script>

<body onload="listFacturas();">

<!-- Modal Add Room -->
<?php get_view_part ( 'facturacion-nuevo' )?>
<!-- En Add Room -->


<div class="">
        <h3>Facturación</h3>
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#facturar_cliente" onclick="$('#nombre').focus();">[+] Nueva Factura</a>		
          <!-- end: PAGE HEADER -->
          <!-- start: PAGE CONTENT -->
          <div class="row">
            <div class="col-sm-12">
              <!-- start: FULL CALENDAR PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="clip-file-2"></i>Facturación
                </div>

					
                <div class="panel-body">
                  <div class="col-sm-12">
                    
					<div id="list-rooms"></div>

                  </div>
                </div>
              </div>

              <!-- end: FULL CALENDAR PANEL -->
            </div>
          </div>
          <!-- end: PAGE CONTENT-->
        </div>

	<?php /*?>
    <div class="container">

		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Facturas</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente o # de factura</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del cliente o # de factura" onkeyup='load(1);'>
							</div>
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<?php */ ?>

	<hr>
	<?php
	//include("footer.php");
	?>
<!-- 	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script> -->

<?php get_template_part('footer_scripts');?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
    <script src="../assets/js/table-data.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->



<script>
      jQuery(document).ready(function() {
    Main.init();
    FormElements.init();
    //UIElements.init();
    //TableData.init();
    $('#list-table-facturas').dataTable({aaSorting : [[3, 'asc']]});
  });
    </script>
<script>
$('#formulario_nuevo').on('hidden.bs.modal', function() {
  this.modal('show');
});

$("#list-table-facturas").modal({"backdrop": "static"});
  // $('#list-table-room').DataTable();
</script>

 </body>

