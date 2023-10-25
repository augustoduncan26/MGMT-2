<?php

?>


<div class="modal fade" id="facturar_cliente" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header header-list-table">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title ">Nueva Factura</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">

           <div class="row">
           		<div class="form-group">
           			<label class="col-sm-2"> Cliente</label>
           			<div class="col-sm-10"><input type="text" class="form-control" name=""></div>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="form-group">
           			<label class="col-sm-2"> Email</label>
           			<div class="col-sm-4"><input type="text" class="form-control" name=""></div>
           			<label class="col-sm-2"> Fecha</label>
           			<div class="col-sm-4"><input type="text" class="form-control" name="" value="<?php echo date('Y-m-d')?>"></div>
				</div>
           </div>
           <br />
           <table border="1" style="width:100%">
           	<tr>
           		<td> &nbsp;N°</td>
           		<td> &nbsp;Descripción</td>
           		<td> &nbsp;Precio</td>
           		<td> &nbsp;Total</td>
           	</tr>

           	<?php
           		// Mostrar todos los productos a facturar
           	?>
           </table>
             <!-- <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               	 <tr>
                   <td width="30%">Cliente:</td>
                   <td width="70%"><input autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 
                  <tr>
                   <td>Email:</td>
                   <td><input name="email" type="email" required="" class="form-control" id="email"  placeholder="Email"  ></td>
                 </tr>

                 <tr>
                   <td>Fecha</td>
                   <td><input name="fecha" type="text" required="" class="form-control" id="fecha"  placeholder="Fecha"  ></td>
                 </tr>

               </tbody>
             </table>-->
           </div> 
        <div class="modal-footer">
          <!--<input name="agregar_habitacion" type="submit" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()" value="Agregar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button  type="button" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()"><i class="fa fa-print"></i> Imprimir</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>
