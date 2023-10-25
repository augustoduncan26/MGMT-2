<div class="<?php echo "modal fade"; ?>" id="facturar-productos" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="<?php echo "modal-dialog"; ?>">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
		</button>
		<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Productos</h3>
		</div>
		<form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
		 <div class="modal-body" id="contenido_editar">

		<?php 
			$sql_serv 	=	mysqli_query($link,"Select * From fact_products Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1");
		?>	
		<table style="width: 100%" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr>
				    <td>Foto</td>
					<td>Nombre</td>
					<td>Descripción</td>
					<td>Precio</td>
					<td></td>
				</tr>
			</thead>

			<tbody>
			<?php While ( $data = mysqli_fetch_object($sql_serv) ) { ?>
				<tr>
					<td width="100px" <?php if($datos->activo==0){?> class="row-yellow-transp  text-center" <?php } else { ?> class=" text-center" <?php } ?>>
		          <?php if ($datos->image == '') { $datos->image = 'nodisponible.png'; } 
		              //echo isset($datos->image)?$datos->image:'---';?>
		                
		          <img src="images/products-images/<?=$datos->image?>" border="1" style="width: 50px; height: 50px">
		          
		          </td>
					<td><?php echo $data->name?></td>
					<td><?php echo $data->description?></td>
					<td><?php echo $data->price_out?></td>
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