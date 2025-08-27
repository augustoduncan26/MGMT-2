<?php
/**
 * Events
 */


class Events
{
    private $exito;
    private $tableEvents;
    private $idCia;
    private $idUser;

    public function __construct()
    {
        $this->tableEvents = PREFIX.'events';
        $this->idCia    = $_SESSION['id_cia'];
        $this->idUser   = $_SESSION['id_user'];
        $this->exito    = '';
    }

    /**
     * List all events
     * @return $this->exito
     */
    public function list () 
	{
        $ObjMante       =   new Mantenimientos();
        $this->exito    =   $ObjMante->BuscarLoQueSea('*',$this->tableEvents,'id_cia = '.$this->idCia,'array');
        if ($this->exito['total'] > 0) {
            return $this->exito;
        } else {
            return false;    
        }
	}

    /**
     * List all event ASYNC - Table
     */
    public function listAll () {
        $objPermOpc = new permisos();
        $ObjMante   = new Mantenimientos();
        //$ObjEjec    = new ejecutorSQL();
        $where 			= 	'id_cia="'.$this->idCia.'"';
        $listEvents 	=	$ObjMante->BuscarLoQueSea('*',$this->tableEvents,$where,'array','name');
        $resultClass    =   false;
        if ($listEvents['total'] > 0) {
            foreach ($listEvents['resultado'] as $key => $datos) {
                if ($datos['class_id']) {
                    $expl = explode(',',$datos['class_id']);
                    $tot  = count($expl);
                    if ($tot > 1) {
                    for ($i=0;$i<$tot;$i++) { 
                        $classes   = $ObjMante->BuscarLoQueSea('class_name,grade',PREFIX.'class','id='.$expl[$i],'extract');
                        if ($classes) {
                        $resultClass .= $classes['class_name'].' '.$classes['grade'].'&deg;,';
                        }
                    }
                    $resultClass = rtrim($resultClass, ", ");
                    } else {
                    $classes    = $ObjMante->BuscarLoQueSea('class_name,grade',PREFIX.'class','id='.$datos['class_id'],'extract');
                    $resultClass= $classes['class_name'].' '.$classes['grade'].'&deg;';
                    }
                }
                
                if (empty($resultClass)) { $resultClass = '- - - -';}

        ?>
            <tr>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['name']?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$resultClass;?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_start']?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_start']?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_end']?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['time_end']?></td>
                <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
                <td class="text-center" style="width:10% !important;">
                <?php if(in_array('52', $objPermOpc->getRolPermissions($_SESSION["id_rol"]))) { ?><a class="btn btn-xs btn-teal tooltips" title="Editar este registro" data-original-title="Ver Detalle" data-toggle="modal" role="button" data-target="#form_edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>');"><i class="fa fa-edit"></i></a><?php } ?>
                <?php if(in_array('53', $objPermOpc->getRolPermissions($_SESSION["id_rol"]))) { ?><a class="btn btn-xs btn-bricky tooltips" title="Eliminar este registro" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a><?php } ?>
                </td>
            </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="8" class="text-center">Ningún dato disponible en esta tabla</td></tr>';
        }
    }

    public function save ($POST) 
	{
        $ObjMante   = new Mantenimientos();
        $ObjEjec    = new ejecutorSQL();
		$sql 		= $ObjMante->BuscarLoQueSea('*',$this->tableEvents,'id_cia="'.$this->idCia.'" and name = "'.$POST['r1'].'"','array');
        if ($POST['r2'] =='') { $POST['r2'] = 0;}
        if ($POST['r9'] =='') { $POST['r9'] = 0;}
        if ($POST['r4'] =='') { $POST['r4'] = '00:00';}
        if ($POST['r6'] =='') { $POST['r6'] = '00:00';}

        if ($sql['total'] > 0 ) {
            echo 'error';
        } else {

            $classArr = false;
            if ($POST['r2']) {
                foreach ($POST['r2'] as $key => $value) {
                    if($classArr != '') {
                        $classArr .=  ',';
                    }	
                    $classArr		.=	 $value;
                }
            }

            $perfilArr = false;
            if ($POST['r9']) {
                foreach ($POST['r9'] as $key => $value) {
                    if($perfilArr != '') {
                        $perfilArr .=  ',';
                    }	
                    $perfilArr		.=	 $value;
                }
            }
            $P_Campos 	=	'id_cia,name,date_start,time_start,date_end,time_end,class_id,perfil_id,description,tipo_color,created_at,activo';
            $P_Valores 	=	"'".$this->idCia."','".$POST['r1']."','".$POST['r3']."','T".$POST['r4']."','".$POST['r5']."','T".$POST['r6']."','".$classArr."','".$perfilArr."','".$POST['r8']."','".$POST['r10']."',NOW(),'".$POST['r7']."'";
            $ObjEjec->insertarRegistro($this->tableEvents, $P_Campos, $P_Valores);
            $this->exito = "ok";
        }
        return $this->exito;
	}

    public function update () 
	{
		return true;
	}

    public function delete () 
	{
		return true;
	}

    public function saveAssociate () 
	{
		return true;
	}
}


