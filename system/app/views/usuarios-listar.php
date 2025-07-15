<style>
@media (min-width: 768px) {
  .dataTables_filter {
  width: 30%;
  /* text-align:justify !important; */
  /* margin-right: -20px !important; */
  }
  div.dataTables_wrapper div.dataTables_filter input {
    width: 98%;
  }
  div.dataTables_wrapper div.dataTables_filter label {
  width: 200px !important;
  }
  .modal-xl {
    width: 70%;
    max-width:1350px;
  }
}
.fade {
  overflow:hidden;
}

.modal-body {
    max-width: 100%;
    overflow-x: auto;
}


.tabla-loader {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
  display: none; /* Oculto por defecto */
}
</style>

<body>

<!-- Message Exportar -->
<div class="alert alert-block alert-info fade in hide messg-exportar-process">
  <button data-dismiss="alert" class="close btn-cancelar-exportar" type="button"> × </button>
  <p><h4 class="alert-heading mssg-label-exportar"> Esta seguro de querer exportar todos los <?=getPageRealName()?>? </h4></p>
  <p>
    <a href="#" class="btn btn-primary btn-acept-exportar"> Aceptar </a>
    <a href="#" class="btn btn-danger btn-cancelar-exportar"> Cancelar </a>
  </p>
</div>

<div class="row view-container">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
       <div class="alert result-mssg"></div>
    </div>

    <div class="container">
      <div class="col-md-7">
      <h4>
        <i class="clip-list-2"></i> Lista de Usuarios
      <button data-original-title="Asistente en línea" data-content="Click para ver el asistente" data-placement="right" data-toggle="modal"  data-trigger="hover" class="btn open-assistant btn-xs btn-green tooltips"><i class="clip-info"></i></button>
      </h4>
      </div>
      <div class="col-md-5 text-right">
        <?php if(in_array('51', $objPermOpc->getRolPermissions($id_rol))) { ?><a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo">[+] Nuevo</a><?php } ?>
        <a data-toggle="modal" class="btn btn-info btn-exportar"  role="button" href="#"><i class="clip-upload-3"></i> Exportar</a>
        <!-- <a data-toggle="modal" class="btn btn-success"  role="button" href="#myImporter"><i class="clip-download-3"></i> Importar</a> -->
      </div>
    </div>

    <div class="container text-rigth">
      <div class="clearfix col-md-6"></div>
      <div class="col-md-6 text-right">
        <a class="btn btn-xs btn-teal tooltips"><i class="fa fa-edit"></i></a> <label class="color-gray">Editar registro</label> &nbsp;
        <a class="btn btn-xs btn-bricky tooltips"><i class="fa fa-times fa fa-white"></i></a><label class="color-gray">Eliminar registro</label>
      </div>
    </div>

<div class="row">
  <div class="col-sm-12">
    <div class="">
      <div class="panel-body">
        <div class="col-sm-12">
          <div style="height:10px;"></div>

          <form method="post" id="filter_form">
          <div class="row">
            <div class="col-md-3">
              <span>Perfil</span>
              <select class="form-control" name="perfil_select_filter" id="perfil_select_filter">
                <?php 
                  if ($listPerfiles['resultado']) {
                    echo "<option>Todos</option>";
                    foreach ($listPerfiles['resultado'] as $key => $value) {
                      echo "<option value='".$value['id']."'>".$value['name']."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            
            <div class="col-md-2">
              <span>Buscar</span>
              <button id="searchButton" class="btn btn-primary form-control"><i class="fas fa-search"></i></button>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
          </div>
          </form>

           <div class="clearfix">&nbsp;</div>

              <div class="x_content">
			        <div class="table-responsive">
                <div id="loader" class="tabla-loader">
                  <div class="spinner-border text-primary" role="status"></div>
                </div>

                <table id="tabla-list-usuarios" class="table table-striped table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha creación</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody-table-perfiles">
                    <?php
                      if (isset($listUsers['resultado'])) {
                        foreach ($listUsers['resultado'] as $key => $value) {
                    ?>
                      <tr>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['nombre'].' '.$value['apellido']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['email']?></td>
                        <td <?php if($value['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$value['created_at']?></td>
                        <td  <?php if($value['activo']==0){?> class="row-yellow-transp" <?php } ?>><?php if($value['activo'] ==1) { echo 'Activo'; } else { echo '<span class="label label-sm label-danger">Inactivo</span>';} ?></td>
                        <td class="text-center" >
                          <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Detalle" data-toggle="modal" role="button" href="#edit_event" onclick="editRow('<?php echo $value['id_usuario']; ?>');"><i class="fa fa-edit"></i></a>
                          <!-- <a class="btn btn-xs btn-green " data-original-title="Permisos" data-toggle="modal" role="button" href="#user-permission" onclick="limpiarCampos('edit_usuario');showUserPermisos('<?php echo $value['id_usuario']; ?>');"><i class="fa fa-key"></i></a> -->
                          <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $value['id_usuario']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
                        </td>
                      </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <!-- <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i> -->
              </div>
              
              </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

 <div class="clearfix"></div>

  <!-- Edit Modal -->
<?php /////////// Editar algo ?>
<div class="<?php echo "modal fade"; ?>" id="edit_event" role="dialog" aria-hidden="true">
<div class="<?php echo "modal-dialog"; ?> modal-xl">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Editar Usuario</h3>
</div>

<form name="edit_usuarios" id="edit_usuarios" method="post" action="#SELF" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="alert alert-danger" id="mssg-alert-edit"></div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Usuario de acceso <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <input type="hidden" name="id_row_edit" id="id_row_edit" />  
            <input autofocus="" name="usuario_acceso_edit" disabled required="" type="text" class="form-control" id="usuario_acceso_edit" placeholder="Usuario para entrar al sistema">
          </div>
          <div class="col-md-2 col-sm-3">Contraseña <!--<span class="symbol required">--></div>
          <div class="col-md-4 col-sm-3">
            <input autofocus="" name="usuario_clave_edit" required="" type="password" maxlength="12" class="form-control" id="usuario_clave_edit" placeholder="Contraseña">
            <small class="color-gray">Ingrese una contraseña si desea cambiarla.</small>
            <!-- <small><input type="checkbox" id="usuario_clave_edit_checkbox" /> <label class="cursor" for="usuario_clave_edit_checkbox">Generación de contraseña automática</label></small> -->
          </div>
        </div>

        <div class="clearfix">&nbsp;</div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Nombre <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_nombre_edit" required="" type="text" class="form-control" id="usuario_nombre_edit" placeholder="Nombre"></div>
          <div class="col-md-2 col-sm-3">Apellido <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_apellido_edit" required="" type="text" class="form-control" id="usuario_apellido_edit" placeholder="Apellido"></div>
        </div>

        <div class="clearfix">&nbsp;</div>

          <div class="row">
          <div class="col-md-2 col-sm-3">F. de Cumpleaño <!--<span class="symbol required">--></div>
            <div class="col-md-4 col-sm-3">
            <input autofocus="" name="cumple_edit" required="" type="date" class="form-control" id="cumple_edit" placeholder="">
            </div>

            <div class="col-md-2 col-sm-3">Contacto <span class="symbol required"></div> 
            <div class="col-md-4 col-sm-3">
            <input autofocus="" name="contacto_edit" required="" type="text" class="form-control" id="contacto_edit" placeholder="">
            </div>
          </div>

          <div class="clearfix">&nbsp;</div>

        <div class="row">
          <div class="col-md-2 col-sm-3">Telefono </div>
          <div class="col-md-4 col-sm-3">
            <input type="text" class="form-control" maxlength="30" name="usuario_telefono_edit" id="usuario_telefono_edit" />
          </div>
          <div class="col-md-2 col-sm-3">Tipo de Sangre </div>
          <div class="col-md-4 col-sm-3">
            <input type="text" class="form-control" maxlength="30" name="usuario_tiposangre_edit" id="usuario_tiposangre_edit" />
          </div>
        </div>

          <div class="clearfix ">&nbsp;</div>

            <div class="row">
              <div class="col-md-2 col-sm-3">Genero </div>
              <div class="col-md-4 col-sm-3">
              <select name="usuario_genero_edit" id="usuario_genero_edit" class="form-control">
                  <option value="">seleccionar</option>
                  <option value="femenino">Femenino</option>
                  <option value="masculino">Masculino</option>
                </select>
              </div>
              <div class="col-md-2 col-sm-3">Dirección </div>
              <div class="col-md-4 col-sm-3">
                <textarea maxlength="100" name="usuario_direccion_edit" id="usuario_direccion_edit" class="form-control"></textarea>
              </div>
            </div>


        <div class="clearfix">&nbsp;</div>
        
        <div class="row">
          <div class="col-md-2 col-sm-3">Perfil <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <select name="usuario_perfil_edit" id="usuario_perfil_edit">
            <?php
                if (isset($listPerfiles['resultado'])) {
                  echo '<option>seleccionar</option>';
                  foreach ($listPerfiles['resultado'] as $key => $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                  }
                }
            ?>
            </select>
          </div>
          <div class="col-md-2 col-sm-3">Estado <span class="symbol required"></div>
          <div class="col-md-4 col-sm-3">
            <select name="usuario_estado_edit" id="usuario_estado_edit" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        
        <div class="clearfix ">&nbsp;</div>
        <hr />
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="col-md-12 col-sm-12"><input type="checkbox" name="usuario_principal_edit" id="usuario_principal_edit" /> <i class="clip-user-4"></i> <label for="usuario_principal" class="cursor"> Usuario principal. <small><i>(Usuario principal del área.)</i></small></label></div>
            <div class="col-md-12 col-sm-12"><input type="checkbox" name="usuario_director_edit" id="usuario_director_edit" /> <i class="clip-user-5"></i> <label for="usuario_director" class="cursor"> Es el director.<small><i>(Es el director del colegio.)</i></small></label></div>
            <div class="col-md-12 col-sm-12" style="display: none;"><input type="checkbox" name="enviar_email_edit" id="enviar_email_edit" /> <i class="clip-bubble-4"></i> <label for="enviar_email" class="cursor">Enviar notificación? <small>(Enviar notificación de creación de cuenta por correo.)</small></label></div>
          </div>
          
          <div class="col-md-2 col-sm-3">
            <small class="color-gray">Foto de Perfil</small>
            <br />
            <img id="blah" style="width: 100px; height: 100px" src="" alt="" />
          </div>

          <div class="col-md-4 col-sm-4">Actualizar Foto 
          <input autofocus="" name="photo_edit" required="" type="file" class="form-control" id="photo_edit" placeholder="">
          </div>
          
        </div>
      </div>
    <div class="modal-footer">
    <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
      <input name="agregar_usuario_edit" type="button" class="btn btn-primary btn-update-row" id="agregar_usuario_edit" value="Modificar datos">               
    </div>
</form>
</div>
</div>
</div>  <?php //////  Fin de editor ?>
<!-- Edit Modal -->

<!-- Add Modal -->
  <div class="modal fade" id="formulario_nuevo" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
          <h3 class="modal-title"> <i class="glyphicon glyphicon-edit"></i> Agregar Usuario</h3>
          <label id="mssg-label"></label>
        </div>
         <form name="clientes" id="clientes" method="post" action="#SELF" enctype="multipart/form-data">
           <div class="modal-body">
            
          <!-- NAV TAB -->
          <ul class="nav nav-tabs menu-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item cursor" role="presentation">
              <a class="nav-link active info-personal" onclick="navtablinkclick('info-personal')" style="border-radius: 3px 0 0 0 !important;" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Información Personal</a>
            </li>
            <li class="nav-item cursor" role="presentation">
              <a class="nav-link info-assignment" onclick="navtablinkclick('info-assignment')" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Asignaturas</a>
            </li>
            <li class="nav-item cursor" role="presentation">
              <a class="nav-link info-attendance" onclick="navtablinkclick('info-attendance')" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Asistencias</a>
            </li>
          </ul>

          <div class="clearfix">&nbsp;</div>

           <div id="info-personal" class="tabs-contents">
            <div id="mssg-alert" class="alert"></div>
            <div class="row">
              <div class="col-md-2 col-sm-3">Usuario de acceso <span class="symbol required"> </div>
              <div class="col-md-4 col-sm-3">
                <input autofocus="" name="usuario_acceso" required="" type="email" class="form-control" id="usuario_acceso" placeholder="usuario@ejemplo.com">
                <small id="result_email_validate"></small>
              </div>
              <div class="col-md-2 col-sm-3">Contraseña <span class="symbol required"><br><small class="color-gray">Entre 8 a 16 caracteres</small></div>
              <div class="col-md-4 col-sm-3">
                <input autofocus="" name="usuario_clave" required="" type="password" maxlength="16" class="form-control" id="usuario_clave" placeholder="Contraseña entre 8 a 16 caracteres">
                <small class="color-gray"><input  type="checkbox" name="generar-clave" id="generar-clave" /> Generar Clave</small> 
              </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
              <div class="col-md-2 col-sm-3">Nombre <span class="symbol required"></div>
              <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_nombre" required="" type="text" maxlength="25" minlength="3" class="form-control" id="usuario_nombre" placeholder="Nombre"></div>
              <div class="col-md-2 col-sm-3">Apellido <span class="symbol required"></div>
              <div class="col-md-4 col-sm-3"><input autofocus="" name="usuario_apellido" required="" type="text" maxlength="25" minlength="5" class="form-control" id="usuario_apellido" placeholder="Apellido"></div>
            </div>

            
            <div class="clearfix">&nbsp;</div>

            <div class="row">
            <div class="col-md-2 col-sm-3">F. de Cumpleaño <!--<span class="symbol required">--></div>
              <div class="col-md-4 col-sm-3">
              <input autofocus="" name="cumple_add" required="" type="date" class="form-control" id="cumple_add" >
              </div>

              <div class="col-md-2 col-sm-3">Contácto <span class="symbol required"></div> 
              <div class="col-md-4 col-sm-3">
              <input name="contacto" required="" placeholder="Contácto de Emergencia" maxlength="50" type="text" class="form-control" id="contacto">
              </div>
            </div>

            <div class="clearfix">&nbsp;</div>

            <div class="row">
              <div class="col-md-2 col-sm-3">Telefono </div>
              <div class="col-md-4 col-sm-3">
                <input type="text" class="form-control" maxlength="30" name="usuario_telefono_add" id="usuario_telefono_add" />
              </div>
              <div class="col-md-2 col-sm-3">Tipo de Sangre </div>
              <div class="col-md-4 col-sm-3">
                <select class="form-control" name="usuario_tiposangre_add" id="usuario_tiposangre_add" >
                  <option></option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
                <!-- <input type="text" class="form-control" maxlength="30" name="usuario_tiposangre_add" id="usuario_tiposangre_add" /> -->
              </div>
            </div>
            <div class="clearfix ">&nbsp;</div>

            <div class="row">
              <div class="col-md-2 col-sm-3">Genero </div>
              <div class="col-md-4 col-sm-3">
              <select name="usuario_genero" id="usuario_genero" class="form-control">
                  <option value="">seleccionar</option>
                  <option value="femenino">Femenino</option>
                  <option value="masculino">Masculino</option>
                  <option value="otro">Otro</option>
                </select>
              </div>
              <div class="col-md-2 col-sm-3">Dirección </div>
              <div class="col-md-4 col-sm-3">
                <textarea maxlength="100" name="usuario_direccion" id="usuario_direccion" class="form-control"></textarea>
              </div>
            </div>

            <div class="clearfix">&nbsp;</div>

            <div class="row">
              <div class="col-md-2 col-sm-3">Perfil <span class="symbol required"></div>
                <div class="col-md-4 col-sm-3">
                  <select name="usuario_perfil" id="usuario_perfil">
                  <?php
                      if (isset($listPerfiles['resultado'])) {
                        echo "<option></option>";
                        foreach ($listPerfiles['resultado'] as $key => $value) {
                          echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                      }
                  ?>
                  </select>
                </div>

              <div class="col-md-2 col-sm-3">Estado <!--<span class="symbol required">--></div> 
              <div class="col-md-4 col-sm-3">
                <select name="usuario_estado" id="usuario_estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0" selected>Inactivo</option>
                </select>
              </div>
            </div>

            <div class="clearfix ">&nbsp;</div>
            
            
            <hr />
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12 col-sm-12"><input type="checkbox" id="usuario_principal" /> <i class="clip-user-4"></i> Usuario principal. <small><i>(Usuario principal de la sección, área o departamento.)</i></small></div>
                <div class="col-md-12 col-sm-12"><input type="checkbox" id="usuario_director" /> <i class="clip-user-5"></i> Es el director.<small><i>(Es el director del establecimiento)</i></small></div>
                <div class="col-md-12 col-sm-12"><input type="checkbox" id="enviar_email" checked /> <i class="clip-bubble-4"></i> Enviar notificación. <small><i>(Enviar notificación de creación de cuenta por correo.)</i></small></div>
              </div>
              <div class="col-md-6">
                <div class="col-md-4 col-sm-4">Foto <!--<span class="symbol required">--></div> 
                <div class="col-md-8 col-sm-8">
                <input autofocus="" name="photo_add" required="" type="file" class="form-control" id="photo_add">
              </div>
              </div>
              
            </div>
           </div>

           <div id="info-assignment" class="tabs-contents">Asignaturas</div>

           <div id="info-attendance" class="tabs-contents">Asistencias</div>


           </div>
        <div class="modal-footer">
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
          <input name="agregar_usuario" type="button" class="btn btn-primary" id="agregar_usuario" value="Guardar datos">                  
        </div>
        </form>                                  
      </div>
    </div>
  </div>
<!-- End Add Modal -->


<!-- Assistant -->
<div class="modal fade  come-from-modal right" id="myAssistant" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalLabel"><i class="clip-info"></i> Asistente</h4>
            </div>
            <div class="modal-body" >
                <div class="table-responsive-xxl">          
                        <div class="col-md-10">
                        What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.


                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar -->
<div class="modal fade  come-from-modal right" id="myImporter" role="dialog" aria-labelledby="myModalImporter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">  × </button>
                <h4 class="modal-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" id="myModalImporter"><i class="clip-download-3"></i> Importador</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>


<!-- <div id="loader" style="display:none; text-align: center;">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden">Cargando...</span>
  </div>
</div> -->

<?php get_template_part('footer_scripts');?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>
/** 
 * Open Asistant Modal 
*/
$('.open-assistant').on('click', ()=>{
  $('#myAssistant').modal('show'); 
});

/** Btn Exportar */
$('.btn-exportar').on('click', ()=>{
  if ($('.messg-exportar-process').is(':visible')) {
    $('.messg-exportar-process').removeClass('hide');
  } else {
    $('.messg-exportar-process').removeClass('hide').fadeIn('slow');
  }
});
/** 
 * Acept Exportar
 */
$('.btn-acept-exportar').on('click',()=>{
  $('.btn-acept-exportar').prop('disabled',true).css("pointer-events", "none").css("color","gray");
  $('.btn-cancelar-exportar').prop('disabled',true).css("pointer-events", "none").css("color","gray");
  $('.mssg-label-exportar').html('Estamos exportando los datos, espere por favor... <img src="assets/images/loading.gif" id="cargando_list" />');
  console.log('Procesando Exportar')
});



$('#cargando_add').hide();
$('#usuario_area').prop('disabled',true);
$('#usuario_acceso').focus();
// Validate Email
$('#usuario_acceso').on('input', ()=>{
  let res = validate('result_email_validate', 'usuario_acceso');
  console.log(res)
});

$('.result-mssg').hide();
$('#mssg-alert').hide();

$("[name='generar-clave']").on('click', ()=> {
  if ($("[name='generar-clave']").is(':checked')) {
    console.log('Genera clave')
  } else {
    console.log('Clear')
  }
});

/**
 * Add
 */
$("[name='agregar_usuario']").on('click', ()=>{
  let user_acceso =   $('#usuario_acceso').val();
  let estado      =   $('#usuario_estado').val();
  let clave       =   $('#usuario_clave').val();
  let nombre      =   $('#usuario_nombre').val();
  let genero      =   $('#usuario_genero').val();
  let contacto    =   $('#contacto').val();
  let direccion   =   $('#usuario_direccion').val();
  let apellido    =   $('#usuario_apellido').val();
  let telef       =   $('#usuario_telefono_add').val();
  let tiposangre  =   $('#usuario_tiposangre_add').val();
  let perfil      =   $('#usuario_perfil').val();
  let birthday    =   $('#cumple_edit').val();
  let photo       =   $('#photo_add').prop('files')[0]; //$('#photo_add').val();

  let principal   =   "";
  let director    =   "";
  let enviar_email=   "";
  if ($('#usuario_principal').is(':checked')) {
    principal   = 1;
  } else { principal   = 0; }
  if ($('#usuario_director').is(':checked')) {
    director   = 1;
  } else { director  = 0;}
  if ($('#enviar_email').is(':checked')) {
    enviar_email   = 1;
  } else { enviar_email = 0;}

  
  if ($('#result_email_validate').is(':visible')) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Debe ingresar un usuario de acceso válido');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
    return false
  }

  if (user_acceso.length < 1 ||  clave.length < 1 || nombre.length < 1 || apellido.length < 1 || perfil.length < 1 || contacto.length < 1) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
      return false
  }

  if (clave.length < 8) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('La Contraseña debe tener mínimo 8 caracteres.');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
      return false
  }

  if (perfil == "") {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('Debe seleccionar un perfil');
    setTimeout(()=>{
      $("#mssg-alert").hide();
    },4000);
    return false
  }

  let route = "app/controllers/usuarios-listar.php"; 

  var form_data   =   new FormData();
  form_data.append('add', 1);
  form_data.append('user_acceso', user_acceso);
  form_data.append('clave', clave);
  form_data.append('nombre', nombre);
  form_data.append('genero', genero);
  form_data.append('contacto', contacto);
  form_data.append('direccion', direccion);
  form_data.append('apellido', apellido);
  form_data.append('perfil', perfil);
  form_data.append('telefono', telef);
  form_data.append('tiposangre', tiposangre);
  form_data.append('birthday', birthday);
  form_data.append('file', photo);
  form_data.append('principal', principal);
  form_data.append('director', director);
  form_data.append('enviar_email', enviar_email);
  form_data.append('estado', estado);

  $.ajax({
    // headers: {
    //   Accept        : "application/json; charset=utf-8",
    //   "Content-Type": "application/json: charset=utf-8"
    // },
    url: route,
    type: "POST",
    data: form_data,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    success         : function (response) { 
      if (response != "Ya existe este registro.") {
        $("#mssg-alert").removeClass('alert-danger').addClass('alert-success').show().html(response);
      } else {
        $('#mssg-alert').removeClass('alert-success').addClass('alert-danger').show().html(response);
      }
      setTimeout(() => {
        $("#mssg-alert").hide();
        window.location.reload();
      }, 4000);
    },
    error           : function (error) {
      console.log(error);
    }
  });
});
  

/** 
 * Open Edit Modal
 * @param {*} id 
 */
function editRow ( id ) {
  limpiarCampos ();
  $("#blah").attr("src",'');
  $("#edit_usuarios *").prop('disabled',true);
  $("#mssg-alert-edit").removeClass('alert-success').removeClass('alert-danger').addClass('alert-info').show().html('<h5>Cargando información. &nbsp; <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i></h5>');
  let route = "app/controllers/usuarios-listar.php";

$.ajax({
  headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
    showEdit  : 1,
    id        : id,
    nocache   : '<?php echo rand(99999,66666)?>'
  },
  dataType        : 'json',
  success         : function (response) {
    
    $('#id_row_edit').val(response['id_usuario']);
    $('#usuario_acceso_edit').val(response['usuario']);
    $('#usuario_telefono_edit').val(response['telefono']);
    $('#usuario_direccion_edit').val(response['direccion']);
    $('#usuario_tiposangre_edit').val(response['tipo_sangre']);
    $('#usuario_nombre_edit').val(response['nombre']);
    $('#usuario_apellido_edit').val(response['apellido']);
    $('#cumple_edit').val(response['birthday']);
    if (response['photo']) {
      $("#blah").attr("src",'repositorio/profile_photos/'+response['photo']);
    } else {
      $("#blah").attr("src",'repositorio/profile_photos/user.png');
    }

    $('#usuario_perfil_edit').val(response['id_perfil']).change();
    $('#usuario_genero_edit').val(response['genero']).change();
    $('#usuario_estado_edit').select2('val',response['activo']);
    if (response['is_principal'] == 1) {
      $('#usuario_principal_edit').attr('checked',true)
    }
    if (response['es_director'] == 1) {
      $('#usuario_director_edit').attr('checked',true)
    }

    setTimeout(()=>{
      //$("#edit_usuarios").find("*").prop("disabled", false);
      $("#edit_usuarios *").prop('disabled',false);
      $('#agregar_usuario_edit').prop('disabled',false);
      $('#usuario_area_edit').val(response['id_area']).change();
      $('#mssg-alert-edit').hide().removeClass('alert-info');
    },1000);
    
  },
  error           : function (error) {
    console.log(error);
  }
});

}

/**
 * Update
 * @param {*} id  
*/
$('.btn-update-row').on('click', () => {
  let id          =   $('#id_row_edit').val();
  let user_acceso =   $('#usuario_acceso_edit').val();
  let estado      =   $('#usuario_estado_edit').val();
  let clave       =   $('#usuario_clave_edit').val();
  let nombre      =   $('#usuario_nombre_edit').val();
  let genero      =   $('#usuario_genero_edit').val();
  let direccion   =   $('#usuario_direccion_edit').val();
  let apellido    =   $('#usuario_apellido_edit').val();
  let birthday    =   $('#cumple_edit').val();
  let telefono    =   $('#usuario_telefono_edit').val();
  let tiposangre  =   $('#usuario_tiposangre_edit').val();
  let photo       =   $('#photo_edit').prop('files')[0]; //$('#photo_add').val();

  let perfil      =   $('#usuario_perfil_edit').val();
  let principal   =   "";
  let director    =   "";
  let enviar_email=   "";

  if ($('#usuario_principal_edit').is(':checked')) {
    principal   = 1;
  } else { principal   = 0; }
  if ($('#usuario_director_edit').is(':checked')) {
    director   = 1;
  } else { director  = 0;}
  if ($('#enviar_email_edit').is(':checked')) {
    enviar_email   = 1;
  } else { enviar_email = 0;}

  if (user_acceso.length < 1 || nombre.length < 1 || apellido.length < 1 || perfil.length < 1) {
    $("#mssg-alert-edit").show().removeClass('alert-success').addClass('alert-danger').html('Los campos con (*) son necesarios');
    setTimeout(()=>{
      $("#mssg-alert-edit").hide();
    },4000);
      return false
  }

  if (clave != "" && clave.length < 8) {
    $("#mssg-alert").show().removeClass('alert-success').addClass('alert-danger').html('La Contraseña debe tener mínimo 8 caracteres.');
    setTimeout(()=>{
      $("#mssg-alert-edit").hide();
    },4000);
      return false
  }

if ( photo == undefined || photo == 'undefined' ) {
  photo = '';
}


let route = "app/controllers/usuarios-listar.php";
var form_data   =   new FormData();
form_data.append('edit', 1);
form_data.append('id', id);
form_data.append('clave', clave);
form_data.append('nombre', nombre);
form_data.append('genero', genero);
form_data.append('direccion', direccion);
form_data.append('apellido', apellido);
form_data.append('perfil', perfil);
form_data.append('birthday', birthday);
form_data.append('telefono', telefono);
form_data.append('tiposangre', tiposangre);
form_data.append('file', photo);
form_data.append('estado', estado);

$.ajax({
  // headers: {
  //   Accept        : "application/json; charset=utf-8",
  //   "Content-Type": "application/json: charset=utf-8"
  // },
  url: route,
  type: "POST",
  data: form_data,
  dataType: 'text',
  cache: false,
  contentType: false,
  processData: false,
  success         : function (response) { 
    if (response == 'ok') {
      $("#mssg-alert-edit").removeClass('alert-warning').removeClass('alert-danger').addClass('alert-success').show().html('Los datos fueron actualizados con éxito. La página se actualizara en breve.');

      //limpiarCampos();
      setTimeout(()=>{
        $("#mssg-alert-edit").removeClass('alert-warning').removeClass('alert-success').html('').hide();
        window.location.reload()
      },3000);    
      //listUsuarios();
    } else {
      console.log(response);
    }
  },
  error           : function (error) {
    console.log(error);
  }
});
//}
});

/**
 * Edit Permisos
 */
function editUserPermisos ( idParam ) {
  
  var id_user     = '<?php echo $_SESSION["id_user"]?>';
  var id_empresa  = '<?php echo $_SESSION["id_cia"]?>';
  var id_         = idParam; //$('#id_row').val();

  var datas       = new Array();

  // Capturar los valores que seleccionan
  $("input:checkbox:checked").each(function() {
      datas.push($(this).val());
  });

  var editperm    = 1;
  var form_data   =   new FormData();

  form_data.append('editperm' , editperm);
  form_data.append('valores', datas);
  form_data.append('id_', id_);

$.ajax({
      url: 'app/controllers/usuarios-listar.php', // point to server-side PHP script 
      dataType: 'text', // what to expect back from the PHP script
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function (response) {
        if (response == 1) {
          $('#mssg-label-edit-perm').html('<div class="alert alert-success">Se actualizo el registro con éxito, Se actualizará la página automáticamente.</div>');
          setTimeout(()=>{
            $('#mssg-label-edit-perm').html('')
            window.location.reload();
          },3000)
        }
      },
      error: function (response) {
      }
  });
}

function deleteRow () {
  
}

/**
 * Datatable
 */
$(document).ready( function () {
    $('#loader').show();
    $('#tabla-list-usuarios').DataTable({
      lengthMenu: [10, 25, 50, 75, 100],
      order: [0, 'desc'],
      processing: true,
      // serverSide: true,
      responsive: true,
      pageLength: 25,
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
          search: '',
          searchPlaceholder: "Buscar",
      },
      initComplete: function () {
        setTimeout(() => {
          $('#loader').hide();
        }, 300); // muestra el loader por 300ms aunque sea
      },
      columnDefs: 
      [ 
        {
          targets: 4,
          orderable: false
        }, 
        { width: "15%", targets: 0 } , 
        { width: "15%", targets: 1 } , 
        { width: "15%", targets: 2 } , 
        { width: "8%", targets: 3 } , 
        { width: "10%", targets: 4 } 
      ],
        drawCallback: function () {
        // if (!$('#searchButton').length) {
        //   $("#tabla-list-usuarios_filter").append(
        //     `<button id="searchButton" class="btn btn-primary" style="margin-left:10px;"><i class="fas fa-search"></i></button>`
        //   );
        // }
        
        // $('#searchButton').on('click', function () {
        //     $('#filter_form').submit();
        //  });

        }
    });
});


/**
 * Search and brind specific filter
 */
$('#searchButton').on('click', function (e) {
    e.preventDefault();
    $('#loader').show();
    let perfil = $('#perfil_select_filter').val();
    let route = 
    $.ajax({
      url: 'app/controllers/usuarios-listar.php', // point to server-side PHP script 
      dataType: 'html',
      data: {
        r1  : 'query',
        r2  : perfil,
      },
      type: 'post',
      success: function (response) {
         setTimeout(() => {
          $('#loader').hide();
        }, 300); // muestra el loader por 300ms aunque sea
        $('#tbody-table-perfiles').empty().append(response);
      },
      error: function (response) {
      }
    });
});


// Clean
function limpiarCampos (form = false) {

  switch (form) {
    case 'add_usuario':
      $("#usuario_acceso").val('');
      $("#usuario_clave").val('');
      $("#usuario_nombre").val('');
      $("#usuario_apellido").val('');
    break;
    case "usuario_listar":
      $("#result_email_validate").html('');
      $("#usuario_acceso").val('');
    default:
      break;
  }
}

$('.tabs-contents').hide();
$('#info-personal').show();

const navtablinkclick = (name) => {
  $('.nav-link').removeClass('active');
  $('.'+name).addClass('active');
  var x = document.getElementsByClassName("tabs-contents");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(name).style.display = "block"; 
}

$("[name='perfil_select_filter']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

$("[name='usuario_estado']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_perfil']").select2({width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_estado_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_perfil_edit']").select2({width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_genero']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_genero_edit']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
$("[name='usuario_tiposangre_add']").select2({width:'100%', dropdownCssClass:"bigdrop"});

</script>

 </body>
