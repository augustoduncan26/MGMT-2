<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/DataTables/media/css/DT_bootstrap.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo $_ENV['FLD_ASSETS']?>/css/styles_datatable.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />

<!-- <script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/SpryAssets/SpryTabbedPanels_RolTurnoDespa.js" type="text/javascript"></script>
<link href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/SpryAssets/SpryTabbedPanels_RolTurnoDespa.css" rel="stylesheet" type="text/css" /> -->

<style>
    .fa-spinner {display: none;}
    .alert  {display: none;}
    /* .roles-container { display: none;} */
</style>

<body>
<div class="row view-container">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3>Roles de Turnos</h3>
        <!-- <div class="clearfix"></div>
        <label id="mssg-window"><?=$mssg?></label> -->
      </div>
    </div>

  <!-- ROLES DE TURNOS CONTAINER -->
  <?php if ($showRolAuto==FALSE) { ?>
    <div class="row">
        <div class="col-sm-12">
            <!-- start: ROLES DE TURNOS PANEL -->
            <div class="panel panel-default">
                <div class="panel-heading">
                <i class="fa fa-calendar"></i>Roles de Turnis
                </div>
                
                <div class="clearfix">&nbsp;</div> 

                <div class="container">

                  <div class="alert alert-info"></div>

                  <form action="?roles-turnos" class="form-container-rol" method="post">
                    
                  <!-- Row 1 -->
                  <div class="col-md-6 col-sm-6">Departamento:
                  <select class="select-departamento" name="select-departamento">
                  <option value="">seleccionar</option>
                  <?php 
                  foreach ($sqlDeptos['resultado'] as $key => $value) {
                    if (isset($_POST['select-departamento']) && $_POST['select-departamento']==$value['id']) {
                      echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                    } else {
                      echo "<option value='".$value['id']."'>".$value['name']."</option>";
                    }
                  }
                  ?>
                  </select>
                  </div>
                  <div class="col-md-6 col-sm-6">Área:
                  <select class="select-areas[]" id="select-areas[]" name="select-areas" ><!-- multiple -->
                    <?php 
                      if (isset($listaAreasPost)) {
                        foreach ($listaAreasPost['resultado'] as $key => $value) {
                          if (isset($_POST['select-areas']) && $_POST['select-areas']==$value['id']) {
                            echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                          } else {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                  </div>

                  <div class="col-md-12 col-sm-12">&nbsp;</div>

                  <!-- Row 2 -->
                  <div class="col-md-3 col-sm-3">
                  Total de usuario:
                  <input class="form-control" min="1" name="cuantos" id="cuantos" value="<?php if (isset($_POST['cuantos'])) { echo $_POST['cuantos']; } else { echo 1; }?>" type="number" />
                  </div>
                  <div class="col-md-3 col-sm-3">Fecha desde
                  <select class="form-control select-fecha-desde" name="select-fecha-desde" id="select-fecha-desde" >
                    <option value="">seleccionar</option>
                    <?php
                      foreach ($monthsSelect as $key => $value) {
                        if (isset($_POST['select-fecha-desde']) && $_POST['select-fecha-desde']==$value) {
                          echo '<option value="'.$value.'" selected>'.$key.'</option>';
                        } else {
                          echo '<option value="'.$value.'">'.$key.'</option>';
                        }
                      }
                    ?>
                  </select>
                  </div>
                  <div class="col-md-3 col-sm-3">Fecha hasta
                  <select class="form-control select-fecha-hasta" name="select-fecha-hasta" id="select-fecha-hasta" >
                  <option value="">seleccionar</option>
                  <?php
                      foreach ($monthsSelect as $key => $value) {
                        if (isset($_POST['select-fecha-hasta']) && $_POST['select-fecha-hasta']==$value) {
                          echo '<option value="'.$value.'" selected>'.$key.'</option>';
                        } else {
                          echo '<option value="'.$value.'">'.$key.'</option>';
                        }
                      }
                    ?>
                  </select>
                  </div>
                  <div class="col-md-3 col-sm-3">Año
                  <select class="form-control select-year" name="select-year" id="select-year">
                  <option value="">seleccionar</option>
                  <?php
                    for ($i=date('Y'); $i < date('Y')+6; $i++) { 
                      if (date('Y')==$i || (isset($_POST['select-year']) &&  $_POST['select-year']==$i)) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                      } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                    }
                  ?>
                  </select>
                  </select>
                  </div>

                  <!-- Row 3 -->
                  <div class="col-md-12 col-sm-12">&nbsp;</div>
                  
                  

                </div>

                <!-- Buttons -->
                  <div class="row">
                    <div class="container">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                      <small>Generar Rol de Turno Automáticamente</small>
                      <br>
                      <button name="btn-generar-rol-auto" class="btn btn-primary" >Rol de Turno - Automático</button>
                    </div>
                    <div class="col-md-3">
                    <small>Generar Rol de Turno Manualmente</small>
                    <br>
                    <button name="btn-generar-rol-manual" class="btn btn-primary" <?=$disableBtnMan?>>Rol de Turno - Manual</button>
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="container">
                    <div class="col-md-12 col-sm-12">
                      <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
                    </div>
                  </div>

                    <div class="col-md-12 col-sm-12">&nbsp;</div>
                  </div>
                  </form>
            </div>
        </div>
    </div>
<!-- End: ROLES DE TURNOS CONTAINER -->

 </div>
</div>

<div class="clearfix">&nbsp;</div>

<?php } ?>


<!--- TAB PANNEL -->
<?php if ($showRolAuto==TRUE) { ?>
  <hr />
<div class="row" style="width:100%;overflow:auto;">
  <div class='col-md-4 col-sm-4'>Departamento: <?=$P_Depto['name']?><input type="hidden" name="select-departamento-b" id="select-departamento-b" value="<?=$_POST['select-departamento']?>" /></div>
  <div class='col-md-4 col-sm-4'>Área: <?=$P_Area['name']?><input type="hidden" name="select-areas-b" id="select-areas-b" value="<?=$_POST['select-areas']?>" /></div>
  <div class='col-md-4 col-sm-4'>Fecha: <?=$MESES[$_POST['select-fecha-desde']]?> - <?=$MESES[$_POST['select-fecha-hasta']]?> - <?=$_POST['select-year']?>
    <input type="hidden" name="select-fecha-desde-b" id="select-fecha-desde-b" value="<?=$_POST['select-fecha-desde']?>" />
    <input type="hidden" name="select-fecha-hasta-b" id="select-fecha-hasta-b" value="<?=$_POST['select-fecha-hasta']?>" />
    <input type="hidden" name="select-year-b" id="select-year-b" value="<?=$_POST['select-year']?>" />
  </div>
  <div class="clearfix">&nbsp;</div>
  <div class='col-md-4 col-sm-4 col-md-offset-8'><button name="btn-guardar-rol-auto" class="btn btn-success btn-guardar-rol col-md-4 col-sm-12" style="margin-left: 0px;" >Guardar</button> &nbsp; <button name="btn-cancel-rol-auto" class="btn btn-default btn-cancelar-rol col-md-4" onclick="cancelRolAuto()" >Cancelar</button></div>
</div>

<ul class="nav nav-tabs">
    <?php
      echo $tabs_li;
    ?>
    <!-- <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
  </ul>

  <div class="tab-content">
    <?=$horario?>
    <!-- <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div> -->
  </div>

</div>
<?php } ?>
<!--- END TAB PANNEL -->

<div class="roles-container-primary table-responsive"><!-- style="width:100%;overflow:auto;" -->
  
<?php //if ($showRolAuto==TRUE) { ?>
    <div class="row rol-turno-generated">
      <div class="col-md-12">
      <i class="fas fa-spin fa-spinner fa-spinner-tbl-rec" style="position: absolute;"></i>
      <br />

      <div class="roles-container table-responsive" style="width:100%;overflow:auto;display:none;">
      <div class='col-md-12 col-sm-12'><hr><h5><?=$textHorarios?></h5></div>
      <div class='col-md-4 col-sm-4'><button name="btn-guardar-rol-auto" class="btn btn-success btn-guardar-rol" style="margin-left: 0px;" >Guardar</button> &nbsp; <button name="btn-cancel-rol-auto" class="btn btn-default btn-cancelar-rol" onclick="cancelRolAuto()" >Cancelar</button></div>
      <div class='col-md-4 col-sm-4'><h5>Área: <?=$areaName['name']?></h5></div>
      <div class='col-md-4 col-sm-4'><h5>Fecha: <?=$monthName[$splitDate[1]] . ' '.$splitDate[0]; ?></h5></div>

        <table style='width:100%' class='table-bordered table-hover' id='table-rol-turnos'>
        <!-- HEADERS -->
        <tr>
        <td style="width:500px;">Usuarios</td>
        <?php
        for ($i = 1 ; $i < $daysInMonth+1 ; $i++) {
        echo '<td style="width:500px;height: 20px;" data-orderable="false" label="c'.$i.'" title="Día '.$i.'">D'.$i.'</td>';
        }
        ?>
        </tr>
        <!-- ROWS -->
        <?php
        for ($x = 0; $x < $users; $x++) {
        echo  '<tr class="f-'.($x+1).'">
        <td>
        <select id="select-'.($x+1).'" style="width:100px" class="select selectpicker user-select-"'.($x+1).'">
        <option></option>
        '.$list.'
        </select>';
        for ($i = 1 ; $i < $daysInMonth+1 ; $i++) {
        echo '
        </td><td><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="'.($x+1).'-c'.($i).'" id="'.($x+1).'-c'.($i).'" /></td>';
        }
        echo '</tr>';
        }
        ?>
        </table>

      <div class="clearfix">&nbsp;</div>

      </div>

    </div>
    </div>

    <div class="clearfix">&nbsp;</div>

  <?php //} ?>
</div>

<?php get_template_part('footer_scripts');?>


<script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

<script>

/** Cancel Rol Mannual */
const cancelRolManual = () => {
    $('.roles-container').empty();
    $('[name="btn-generar-rol-auto"]').prop('disabled', false);
    subirTopLista();
}
/** Cancel Rol Automatico */
const cancelRolAuto = () => {
    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    let area        = $("#area_rol").val();
    let date_from   = $("#date_from").val();
    let year_from   = $("#year_from").val();
    let route       = "app/controllers/roles-turnos.php";

    $.ajax({
        headers : {
            Accept        : "application/json; charset=utf-8",
            "Content-Type": "application/json: charset=utf-8"
        },
        url : route,
        type: "GET",
        data : {
            cancel      : 'rolback',
            id_user     : id_user,
            id_cia      : id_cia,
            area        : area,
            date_from   : date_from,
            year_from   : year_from,
            nocache     : "<?php echo rand(99999,66666); ?>"
        },
        dataType     : 'json',
        success      : function (response) { 
            $('html, body').animate({scrollTop: '0px'},'slow');
            if (response == 1) {
                $("#users_rol").val('1');
                $("#area_rol").val(null).trigger('change');
                $("#date_from").val(null).trigger('change');
                $("#year_from").val(null).trigger('change');
                $('.roles-container').empty();
                $('[name="btn-generar-rol-auto"]').prop('disabled', false);
                //form-container-rol
                //$('.form-container-rol').submit();
                window.location.href = '?roles-turnos';
                //window.location.reload();
            }
        },
        error        : function (error) {
        console.log(error);
        }
    });
}

/** Manual Button */
$('[name="btn-generar-rol-manual"]').on('click',(e)=>{
    e.preventDefault();
    
    // Params
    let id_user         = '<?php echo $_SESSION["id_user"]?>';
    let id_cia          = '<?php echo $_SESSION["id_cia"]?>';
    let depto           = $('.select-departamento').val(); //$("#select-departamento").val(); //$('[name="select-areas"]').select2('data'); //$('.select-departamento').val();
    let area            = $('.select-areas').val(); //$("#select-areas").val(); //$('.select-areas').val();
    let areaNameSelected= $('[name="select-areas"]').select2('data');
    let users           = $('#cuantos').val();
    let date_from       = $('#select-fecha-desde').val();
    let date_to         = $('#select-fecha-hasta').val();
    let year            = $('#select-year').val();
    let totalMonthDays  = daysInMonth(date_from,year);
    let dateText        = "";

    let monthName           = {'1':'Enero','2':'Febrero','3':'Marzo','4':'Abril','5':'Mayo','6':'Junio','7':'Julio','8':'Agosto','9':'Septiembre','10':'Octubre','11':'Noviembre','12':'Diciembre'};

    // console.log(monthName[date_from]);
    // Validate 
    if (depto == "" || area == "" || users == "" || date_from == "" || date_to == "" || year == "") {
        $('.alert').show().removeClass('alert-info').addClass('alert-danger').html('Todos los campos son requeridos.');
            setTimeout(()=>{
                $('.alert').hide();
            },4000);
        return false;
    }
    if (date_from > date_to) {
      $('.alert').show().removeClass('alert-info').addClass('alert-danger').html('Debe seleccione una fecha correcta.');
            setTimeout(()=>{
                $('.alert').hide();
            },4000);
        return false;
    }

    if (date_from == date_to) {
      dateText = monthName[date_from]
    } else if (date_from != date_to) {
      dateText = monthName[date_from] + ' - ' + monthName[date_to];
    }

    $('[name="btn-generar-rol-auto"]').prop('disabled', true);

    // Go to div container
    gotToElementPage($('.roles-container'));

    let trHTML  = false;
    $('.roles-container').empty();
    $('.fa-spinner').show();

    let listUsers = '<?=$list?>';
    //console.log(listUsers)

    trHTML =` 
    <hr />
    <br />
    <div class='col-md-6 col-sm-6'><button name="btn-generar-rol-auto" class="btn btn-success" >Guardar</button> &nbsp; <button name="btn-cancel-rol-manual" class="btn btn-default btn-cancelar-rol" onclick="cancelRolManual()" >Cancelar</button></div>
    <div class='col-md-3 col-sm-3'>Área: `+areaNameSelected[0].text+`</div>
    <div class='col-md-3 col-sm-3'>Fecha: `+dateText+ ` , `+ year +` </div>`;
    trHTML += `<div class="table-responsive" style="width:100% !important;overflow:auto;"><table style='width:100%' class='table-bordered table-hover' id='table-rol-manual'>`;
    trHTML += `<tr>`;
    trHTML += `<td width='150px'>Usuarios</td>`;

    for (i = 1 ; i < totalMonthDays+1 ; i++) {
        trHTML+= `<td style="width:40px;height: 20px;" data-orderable="false" label="c`+i+`" title="Día `+i+`">D`+i+`</td>`;
    }
    trHTML += `</tr>`;
    let rowCount = $('#table-rol-manual tr').length;

    // Rows: Users selector
    for (x = 0; x < users; x++) {
        trHTML +=`<tr class='f-`+(x+1)+`'>`;
        trHTML +=`
            <td>
            <select style='
            top: 100%;
            z-index: 1000;
            min-width: 100%;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.25rem;' 
            data-role="select-dropdown" id='select-`+(x+1)+`' style='width:100%' class='select selectpicker select-users user-select-`+(x+1)+`'>
            <option></option>
            `+listUsers+`
            </select>
            </td>`;
        // Columns: Days
        for (i = 1 ; i < totalMonthDays+1 ; i++) {
            trHTML+= `<td><input maxlength="5" oninput="this.value=this.value.replace(/[^0-9:x]/g,\'\');" autocomplete="off" style="width:38px;height: 20px; font-size:11px; color:black" data-orderable="false" name="`+(x+1)+`-c`+(i)+`" id="`+(x+1)+`-c`+(i)+`" /></td>`;
        }
        trHTML +=`</tr>`;
    }
    
    trHTML += `</table></div><br /><br /><div class="clearfix">&nbsp;</div>`;
    $('.roles-container').show();
    $('.roles-container').append(trHTML);
    $('.fa-spinner').hide();

});

/** Automatic Button */
$('[name="btn-generar-rol-auto"]').on('click',(e)=>{
    // Params
    let id_user     = '<?php echo $_SESSION["id_user"]?>';
    let id_cia      = '<?php echo $_SESSION["id_cia"]?>';
    let depto       = $('.select-departamento').val(); //$("#select-departamento").val(); //$('[name="select-areas"]').select2('data'); //$('.select-departamento').val();
    let area        = $('.select-areas').val(); //$("#select-areas").val(); //$('.select-areas').val();
    let users       = $('#cuantos').val();
    let date_from   = $('#select-fecha-desde').val();
    let date_to     = $('#select-fecha-hasta').val();

    console.log(date_from)

    // Validate 
    if (depto == "" || area == "" || users == "" || date_from == "") {
        $('.alert').show();
        $('.alert').removeClass('alert-info').addClass('alert-danger').html('Todos los campos son requeridos');
            setTimeout(()=>{
                $('.alert').hide();
            },4000);
        return false;
    }

    // $('[name="btn-generar-rol-manual"]').prop('disabled', true);

    // let route       = "ajax/ajax_generate_rolturno.php";
    // $('.fa-spinner').show();
    
    // $.ajax({
    //     headers : {
    //         Accept        : "application/json; charset=utf-8",
    //         "Content-Type": "application/json: charset=utf-8"
    //     },
    //     url : route,
    //     type: "GET",
    //     data : {
    //         generate: 1,
    //         id_user : id_user,
    //         id_cia  : id_cia,
    //         area    : area,
    //         users   : users,
    //         date_from: date_from,
    //         //date_to  : date_to,
    //         nocache  : "<?php echo rand(99999,66666); ?>"
    //     },
    //     dataType     : 'html',
    //     success      : function (response) { 
    //         $('html, body').animate({scrollTop: '0px'},'slow');
    //         //listResultTable();
    //     },
    //     error        : function (error) {
    //     console.log(error);
    //     }
    // });
});

/** Save Rol de Turnos */
$('.btn-guardar-rol').on('click',()=>{
 
  let filas     = [];
  let rowCount  = $('#table-formulas tr').length;

  for (i = 0 ; i < 32; i++) {
    for (y=1;y<rowCount;y++) {
      if($("#f"+y+"-"+i).val()==""){
        $("#mssg-alert").show().html('<div class="alert alert-danger">Debe agregar como mínimo una fila para la formula');
        setTimeout(()=>{
          $("#mssg-alert").hide();
        },3000);
        return false
      }
    }
  }
});



/** Select departamento */
$('.select-departamento').on('change',()=>{
  let idDepto = $('.select-departamento').val();
  
  let route = "app/controllers/roles-turnos.php";
  $.ajax({
    headers: {
    Accept        : "application/json; charset=utf-8",
    "Content-Type": "application/json: charset=utf-8"
  },
  url: route,
  type: "GET",
  data: {
      search   : 1,
      depto    : idDepto,
  },
  dataType      : 'json',
  success       : function (response) { 

    let arr = response; 
    $("[name='select-areas']").empty().trigger('change');

    if (arr) {
      $("[name='select-areas']").append('<option>seleccionar</option>');
      arr.forEach((item,key)=>{
        $("[name='select-areas']").append("<option value='"+item.id+"'>"+item.name+"</option>");
      });
    }
    $("[name='select-areas']").trigger('change');
  },
  error         : function (error) { 
    console.log(error);
  }
  });
});

  $('.select-departamento').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-areas').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-fecha-desde').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-fecha-hasta').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $('.select-year').select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $("[name='area_rol']").select2({ width: '100%', dropdownCssClass: "bigdrop"});
  $("[name='select-areas']").select2({ width: '100%', dropdownCssClass: "bigdrop"});

/**
 * Some Operations
 */
const  daysInMonth = (month,year) => {
  return new Date(year, month, 0).getDate();
}
// Go to Top page
const subirTopLista = () => {
	jQuery('html, body').animate({scrollTop: '0px'}, 'slow');
}
// Go to specific area
const gotToElementPage = (element) => {
  jQuery('html, body').animate({scrollTop: '200px'}, 'slow');
}
/** Evitar Refresh */
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
$(document).ready(function(){
    $(document).on("keydown", disableF5);
});

let showAutomatico = "<?=$showRolAuto?>";
if (showAutomatico) {
  subirTopLista();
}
</script>
