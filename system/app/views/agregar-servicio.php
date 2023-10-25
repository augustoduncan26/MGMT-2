<?php

$sql  = mysql_query("Select * From ad_bookers Where activo = 1");
?>

<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title">Agregar Servicio</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               <tr>
                   <td width="30%">Nombre:</td>
                   <td width="70%"><input autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 <tr>
                   <td width="30%" valign="top">Detalle:</td>
                   <td width="70%"><textarea id="detalle" class="form-control" name="detalle" row="2" col="5" ></textarea></td>
                 </tr>
                 <tr>
                   <td width="30%">Precio:</td>
                   <td width="70%"><input autofocus="" name="precio" type="number" step="1" min="1" required="" class="form-control" id="precio" placeholder="Precio" value="1"></td>
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
          <!--<input name="agregar_habitacion" type="submit" class="btn btn-primary" id="agregar_habitacion" onClick="addRoom()" value="Agregar">-->
          
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
           <button  type="button" class="btn btn-primary" id="agregar_servicio" onClick="addService()">Agregar</button>
                     
        </div>
              </form>                                  
      </div>
    </div>
  </div>
