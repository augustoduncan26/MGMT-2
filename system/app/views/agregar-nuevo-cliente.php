<?php

//$sql  = mysql_query("Select * From ad_tipo_habitacion Where activo = 1");
?>

<div class="modal fade" id="formulario_nuevo_cliente" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar nuevo cliente</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
               <tr>
                   <td width="30%">Nombre </td>
                   <td width="70%"><input autofocus="" name="nombre_cliente" required="" type="text" class="form-control" id="nombre_cliente" placeholder="Nombre"></td>
                 </tr>
                 
                  <tr>
                   <td>Teléfono</td>
                   <td><input name="telefono_cliente" type="text" class="form-control" id="telefono_cliente"  placeholder="Teléfono"  ></td>
                 </td>
                 </tr>
                 
                 <tr>
                   <td>Email</td>
                   <td><input name="email_cliente" type="email" class="form-control" id="email_cliente" placeholder="Email">
                   </td>
                 </tr>
                 <tr>
                   <td>Dirección &nbsp; <a id="geoImg" href="#" style="border-radius: 50px;" class="btn btn-info" data-toggle="modal" data-target="#myModalMap"><img src="images/geoicon.svg" width="16" height="16" ></a></td>
                   <td>
                  <input type="hidden" id="txt_latitude_new" value=""><input type="hidden" id="txt_longitude_new" value="">
                   <textarea class="form-control" id="txt_direccion_new" name="txt_direccion_new" maxlength="255"></textarea></td>
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
          <button  type="button" class="btn btn-primary" id="agregar_cliente" onClick="addCliente()">Guardar datos</button>        
        </div>
              </form>                                  
      </div>
    </div>
  </div>
