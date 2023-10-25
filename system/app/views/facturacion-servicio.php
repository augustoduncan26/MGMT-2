
<div class="<?php echo "modal fade"; ?>" id="facturar-servicio" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="<?php echo "modal-dialog"; ?>">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
		</button>
		<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Servicios</h3>
		</div>
		<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
		 <div class="modal-body" id="contenido_editar">
			<!-- Cargando... -->
			<!-- <br />
			<h2>: Usuario Demo <i class="clip-user-block"></i></h2>
			<h5 style="color:red">: No cuenta con permisos para ver esta página.</h5> -->
		<?php 
			$sql_serv 	=	mysqli_query($link,"Select * From ad_tipo_servicio Where activo = 1");
		?>	
		<table style="width: 100%" class="table table-striped table-bordered table-hover table-full-width" id="lista-de-servicios">
			<thead>
				<tr>
					<td>Nombre</td>
					<td>Precio</td>
					<td></td>
				</tr>
			</thead>

			<tbody>
			<?php While ( $data = mysqli_fetch_object($sql_serv) ) { ?>
				<tr>
					<td><?php echo $data->name?></td>
					<td><?php echo $data->precio?></td>
					<td><input type="checkbox"></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		</div>
		 <div class="modal-footer">
		      <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
		      <input name="agregar_habitacion" type="button" class="btn btn-primary" id="agregar_evento" onClick="var id_row = $('#id_row').val(); updateEvent(id_row)" value="Agregar">
		</div>
		</form>
		</div>
	</div>
</div> 