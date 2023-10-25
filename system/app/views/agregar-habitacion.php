<?php
$ObjMante   = new Mantenimientos();
$typeRooms  = $ObjMante->BuscarLoQueSea('*',PREFIX.'rooms_type','id_empresa = '.$_SESSION['id_empresa'].' and active=1','array');
?>
<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Habitación</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               <tr>
                   <td width="30%">Nombre <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 
                  <tr>
                   <td>Tipo de habitación <span class="symbol required"></td>
                   <td>
                  <select class="form-control" name="tipo" id="tipo">
                      <option value=""> - seleccionar - </option> 
                      <?php
                        foreach ($typeRooms['resultado'] as $typeRoom) {
                          echo '<option value="'.$typeRoom['id'].'">'.$typeRoom['nombre'].'</option> ';
                        }
                      ?>
                  </select>
                   <!-- <input name="pais" type="text" required="" class="form-control" id="pais"  placeholder="País"  ></td> -->
                 </td>
                 </tr>
                 
                 <tr>
                   <td>Total de camas <span class="symbol required"></td>
                   <td><input name="total_beds" type="number" required="" min="1" step="1" class="form-control" id="total_beds" value="1">
                   </td>
                 </tr>
                 <tr>
                   <td>Precio <span class="symbol required"></td>
                   <td><input name="precio" type="number" step="0.01" min="1" required="" class="form-control" id="precio" placeholder="Precio" value="1"></td>
                 </tr>
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <!--<input name="agregar_habitacion" type="submit" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()" value="Agregar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button  type="button" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()">Guardar datos</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>
