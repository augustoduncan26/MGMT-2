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
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Tipo de Habitación</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre <span class="symbol required"></td>
                   <td width="70%"><input autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 <tr>
                   <td width="30%">Codigo <span class="symbol required"></td>
                   <td width="70%"><input autofocus="" name="codigo" required="" type="text" class="form-control" id="codigo" style="text-transform: uppercase;" maxlength="5" placeholder="Código"></td>
                 </tr>
                 <tr>
                   <td>Capacidad <span class="symbol required"></td>
                   <td><input name="capacidad" type="number" step="1" min="1" required="" class="form-control" id="capacidad" placeholder="Capacidad"></td>
                 </tr>
                 <tr>
                   <td>Capacidad Max <span class="symbol required"></td>
                   <td><input name="capacidad_max" type="number" step="1" min="1" required="" class="form-control" id="capacidad_max" placeholder="Capacidad Maxima"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
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
          <!--<input name="agregar_tipo_habitacion" type="submit" class="btn btn-success" id="agregar_tipo_habitacion" onClick="addTipoRoom()" value="Agregar">-->
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <button type="button" class="btn btn-primary" id="agregar_tipo_habitacion" onClick="addTipoRoom()">Guardar datos</button>
          
                    
        </div>
              </form>                                  
      </div>
    </div>
  </div>
