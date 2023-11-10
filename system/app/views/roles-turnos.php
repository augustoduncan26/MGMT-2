<!-- <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" /> -->
<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/fontawesome6.4.2-web/css/all.min.css">

<link rel="stylesheet" href="assets/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.css" />


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
                                <div class="col-md-12">
                                    <div class="alert"></div>
                                </div>
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
                                <div class="col-md-2">
                                    Fecha desde<input class="form-control" type="month" name="date_from" id="date_from" value="<?=date('Y-m')?>">
                                </div>
                                <div class="col-md-2">
                                    Fecha hasta<input class="form-control" type="month" name="date_to" id="date_to" min="<?=date('Y-m')?>" value="<?=date('Y-m')?>">
                                </div>
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

                        <div class="roles-container">
                            
                        </div>
                    
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
    
    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    let area        = e.target.form['area_rol'].value;
    let users       = e.target.form['users_rol'].value;
    let date_from   = e.target.form['date_from'].value;
    let date_to     = e.target.form['date_to'].value;

    if (area == "" || users == "") {
        $('.alert').show();
        $('.alert').addClass('alert-danger').html('Todos los campos son requeridos');
        setTimeout(()=>{
            $('.alert').hide();
        },4000);
        return false;
    }

    let route       = "ajax/ajax_generate_rolturno.php";

    $.ajax({
        headers : {
            Accept        : "application/json; charset=utf-8",
            "Content-Type": "application/json: charset=utf-8"
        },
        url : route,
        type: "GET",
        data : {
            generate: 1,
            id_user : id_user,
            id_cia  : id_cia,
            area    : area,
            users   : users,
            date_from: date_from,
            date_to  : date_to,
            nocache  : "<?php echo rand(99999,66666); ?>"
        },

    });
  });

//   $("[name='area_rol']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>

<?php get_template_part('footer_scripts');?>

<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2.min.js"></script>

<script>
    $("[name='area_rol']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
</script>