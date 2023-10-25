<?php
//$ObjMante = new Mantenimientos();
//$sql_     = $ObjMante->BuscarLoQueSea('*',PREFIX.'bookers','active=1','array');
//$sql  = mysql_query("Select * From ad_bookers Where activo = 1");
?>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<script src="assets/plugins/select2/select2.min.js"></script>

<div class="modal fade" id="formulario_nuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Agencia</h3>
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
                   <td width="70%"><input autofocus="" name="nombre" required="" type="text" class="form-control" id="nombre" placeholder="Nombre"></td>
                 </tr>
                 <tr>
                   <td width="30%">Porcentaje </span></td>
                   <td width="70%"><input autofocus="" name="porcentaje" required="" type="number" step="0.01" min="1" class="form-control" id="porcentaje" placeholder="Porcentage" value="0"></td>
                 </tr>
                 <tr>
                   <td>Estado:</td>
                   <td>
                    <select name="estado" id="estado" class="">
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
           <button  type="button" class="btn btn-primary" id="agregar_habitacion" onClick="addBooker()">Guardar datos</button>
                     
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<script>$("#estado").select2({ width: '100%', dropdownCssClass: "bigdrop"});</script>