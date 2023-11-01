<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.css" />
<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/fontawesome6.4.2-web/css/all.min.css">

<body>
<div class="row view-container">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

    <div class="x_title">
      <h3></h3>
      <div class="clearfix"></div>
      <label id="mssg-window"><?=$mssg?></label>
    </div>

    <!-- <div class="row">
      <div class="col-lg-12">
        <a data-toggle="modal" class="btn btn-primary"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[+] Nuevo Departamento</a>
        <a data-toggle="modal" class="btn btn-info"  role="button" href="#formulario_nuevo" onclick="$('#nombre').focus();">[^] Exportar</a>
      </div>
    </div> -->

    <!-- <h3>Roles de Turnos</h3> -->
    <div class="row">
        <div class="col-sm-12">
            <!-- start: ROLES DE TURNOS PANEL -->
            <div class="panel panel-default">
                <div class="panel-heading">
                <i class="fa fa-calendar"></i>Roles de Turnis
                </div>
                <div class="row">
                    <br />
                    
                    <div class="col-md-12 text-right"><i class="fa-solid fa-circle-info"></i> Info  &nbsp; </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <div class="row">
                                <div class="col-md-12"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                Seleccionar Área
                                    <select name="area_rol" id="area_rol" class="">
                                    <option></option>
                                    <?php 
                                        foreach ($sqlAreas["resultado"] as $key => $value) {
                                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                Total de Usuarios<input class="form-control" type="number" min="1" value="1" name="users_rol" id="users_rol" ></div>
                                <div class="col-md-4">
                                    Fecha<input class="form-control" type="date" name="date_rol" id="date_rol" ></div>
                            </div>

                            <div class="clearfix">&nbsp;</div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                <button name="btn-generar-rol" class="btn btn-primary" >Generar Rol de Turno</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                
                <div class="clearfix">&nbsp;</div>

                <div class="row rol-turno-generated">
                    <div class="col-md-12">
                        <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
                        <br />
                    </div>
                </div>

            </div>
           
        </div>
    </div>
</div>
</div>

<script>

  $('[name="btn-generar-rol"]').on('click',(e)=>{
    e.preventDefault();
    console.log(e.target.form[1].value)
    console.log(e.target.form[2].value)
    console.log(e.target.form[3].value)
  });

//   $("[name='area_rol']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>

<?php get_template_part('footer_scripts');?>