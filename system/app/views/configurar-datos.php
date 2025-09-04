<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<script src="assets/plugins/select2/select2.min.js"></script>

<script>
  
  function selectUseLike ( id ) {
    if ( $('#' + id).is(":checked") ) {
      $('#use-sistem-as').val('rooms');
      $('#use-like').html('Hotel').css('color','red');
    } else { 
      $('#use-sistem-as').val('rooms_bed');
      $('#use-like').html('Hostel').css('color','green');
    }
  }

  

</script>
<!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- form input mask -->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h3>Configurar Empresa</h3>
      <div class="clearfix"></div>
      <label id="label-mssg"><?=$mssg?></label>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" method="post" action="">
        
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de Empresa <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="name_cia" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name_cia" placeholder="Nombre de Empresa" required="required" type="text" value="<?=$DatosUser['name_cia']?>">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Dirección <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="direcction" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="direcction" placeholder="Dirección" required="required" type="text" value="<?=$DatosUser['direcction']?>">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Teléfono
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="telephone" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="telephone" placeholder="Teléfono" type="text" value="<?=$DatosUser['telephone']?>">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" data-validate-words="2" name="email" placeholder="Email" readonly type="email" value="<?=$DatosUser['email']?>">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Moneda <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="moneda" id="moneda" class="">
            <?php
            foreach ($sel_moneda['resultado'] as $data) {
              //while ( $data = mysqli_fetch_object($sel_moneda)) {
                if ($data['id'] == $DatosUser['tipo_moneda']) {
            ?>
              <option value="<?php echo $data['id']?>" selected ><?php echo $data['type_name']?></option>
            <?php } else { ?>  
              <option value="<?php echo $data['id']?>"><?php echo $data['type_name']?></option>
            <?php
                }
              }
            ?>
            </select>
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Idioma <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="idioma" id="idioma" class="">
              <option value="es" <?php if($DatosUser['idioma']=='es'){ echo 'selected';}?>>Español</option>
              <option value="ing" <?php if($DatosUser['idioma']=='ing'){ echo 'selected';}?>>Ingles</option>
            </select>
          </div>
        </div>


      <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
          <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
          <button type="submit" class="btn btn-primary" name="btn-modificar">Modificar</button>
        </div>
      </div>

     </form>
        
      <div class="clearfix"></div>
      
      <div class="ln_solid"></div>

       <h3>Otras Configuraciones</h3>

       <div class="clearfix"></div>
     
        <div class="item form-group ">
        <a  data-toggle="modal" role="button" href="#add_usuarios" onClick="">
          <div class="col-sm-2">
              <button class="btn btn-icon btn-block btn-warning box-shadow">
               <i class="fa fa-user"></i>
               [+] Usuarios 
            </button>
          </div>
        </a>

        <a data-toggle="modal" role="button" href="#list-users" onClick="">
          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="fa fa-group"></i>
              Lista de Usuarios 
            </button>
          </div>
        </a>


          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="fa fa-picture-o"></i>
              Logo de Empresa
            </button>
          </div>

          <div class="col-sm-2">
            <button class="btn btn-icon btn-block btn-warning box-shadow">
              <i class="clip-data"></i>
              Copia de Respaldo
            </button>
          </div>

        </div>
     
    </div>
  </div>
</div>


<!-- Modal Add user to company -->
  <div class="modal fade" id="add_usuarios" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title">Agregar Usuario</h3>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
            <div id="mssg-add-users" style="color:red;">Los campos con (*) son obligatorios</div>
             <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>
                 <tr>
                   <td width="30%">Nombre <span class='symbol required'></span></td>
                   <td width="70%"><input autofocus="" name="nombre" required maxlength="40" type="text" class="form-control" id="nombre" placeholder="Nombre Completo"></td>
                 </tr>
                  <!-- <tr>
                   <td>Usuario:</td>
                   <td><input name="usuario" type="text" required maxlength="15" class="form-control" id="usuario"  placeholder="Usuario de acceso"  ></td>
                 </td>
                 </tr> -->
                 
                 <tr>
                   <td>Email <span class='symbol required'></span></td>
                   <td><input name="email" type="email" required maxlength="50" class="form-control" id="email" placeholder="Email">
                   </td>
                 </tr>
                 <tr>
                   <td>Contraseña <span class='symbol required'></span></td>
                   <td><input name="password" type="password" required maxlength="30" class="form-control" id="password" placeholder="Contraseña"></td>
                 </tr>

                 <tr>
                   <td>Dirección:</td>
                   <td><input name="direccion" type="text" maxlength="100" class="form-control" id="direccion" placeholder="Dirección"></td>
                 </tr>

                 <tr>
                   <td>Estado:</td>
                   <td>
                    <select name="estado" id="estado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0" selected>Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
           </div>
        <div class="modal-footer">
          <!-- <input class="btn btn-primary"  type="button" name="button2" id="button2" value="Agregar" onClick="javascript: cargarCodigoBarra()" /> -->
          <input type="submit" name="btn-agregar-user"  class="btn btn-primary" id="btn-agregar-user" value="Agregar">
          <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    
        </div>
              </form>                                  
      </div>
    </div>
  </div>
<!-- End Add user to company -->


<!-- Modal List Cia User -->
<!-- Modal Add user to company -->
<div class="modal fade" id="list-users" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h3 class="modal-title">Lista de Usuarios</h3>
      </div>
      <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
        <div class="modal-body">
         <div id="list-of-users">
         Cargando...
         </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal List Cia User -->


<script src="../vendors/switchery/dist/switchery.min.js"></script>

<script>
  $("[name='moneda']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $("[name='idioma']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>
