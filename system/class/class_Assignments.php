<?php

//use Symfony\Component\HttpFoundation\Request;

/**
 * Assignments
 */

// namespace class\Assignments;

class Assignments
{
    private $exito;
    private $tableAssignment;
    private $idCia;
    private $idUser;

    public function __construct()
    {
        $this->tableAssignment = PREFIX.'assoc_teacher_assignment';
        $this->idCia    = $_SESSION['id_cia'];
        $this->idUser   = $_SESSION['id_user'];
        $this->exito    = '';
    }

    /**
     * list All Assignments
     * @return $sqlAssignment
     */
    public function listAssignments () {
        $ObjMante      =    new Mantenimientos();
        $sqlAssignment =    $ObjMante->BuscarLoQueSea('*', $this->tableAssignment,'id_cia = '.$this->idCia,'array');
        
        if ($sqlAssignment['total'] > 0) {
        $r = false;
        $r2 = false;
            foreach ($sqlAssignment['resultado'] as $key => $value) {
                // Assignments
                $asign_names = [];
                $explAss = explode(',',$value['assignment_id']);
                foreach ($explAss as $assId) {
                    $a = $ObjMante->BuscarLoQueSea('*', PREFIX.'assignment', 'id = '.$assId, 'extract');
                    if ($a) {
                        $asign_names[] = $a['name'];
                    }
                }
                $sqlAssignment['resultado'][$key]['asignment_name'] = implode(', ', $asign_names);

                // Class
                $class_names = [];
                $explClass = explode(',', $value['class_id']);
                foreach ($explClass as $classId) {
                    $b = $ObjMante->BuscarLoQueSea('*', PREFIX.'class', 'id = '.$classId, 'extract');
                    if ($b) {
                        $class_names[] = $b['class_name'];
                    }
                }
                $sqlAssignment['resultado'][$key]['class_name'] = implode(', ', $class_names);
            }
        }
        if ($sqlAssignment['total']>0) {
            $this->exito = $sqlAssignment;
        } else{
           $this->exito = null; 
        }
        return $this->exito;
    }

    /**
     * list All Assignments
     * @param $id
     * @return $sqlAssignment
     */
    public function listAssignmentsById ( $id ) {
        $ObjMante   =   new Mantenimientos();
        $data       =   $ObjMante->BuscarLoQueSea('*',$this->tableAssignment,'id="'.$id.'" and id_cia = '.$this->idCia,'extract');
        $userInfo 	=   $ObjMante->BuscarLoQueSea('nombre,apellido,email,birthday,photo,telefono,tipo_sangre,genero,direccion',PREFIX.'usuarios','id_usuario="'.$data['teacher_id'].'" and id_cia = '.$this->idCia,'extract');
        
        $datos 		=	array('nombre','apellido','email','birthday','photo','telefono','tipo_sangre','genero','direccion');

        foreach ($datos as $key => $value) {
            $data[$datos[$key]] = $userInfo[$value];
        }
       
        // Assignments
        $asign_names    = [];
        $total_assignm  = 0;
        $explAss = explode(',', $data['assignment_id']);
        foreach ($explAss as $assId) {
            $a = $ObjMante->BuscarLoQueSea('*', PREFIX.'assignment', 'id = '.$assId, 'extract');
            if ($a) {
                $total_assignm = $total_assignm + 1;
                $asign_names[] = $a['name'];
            }
        }
        $data['asignment_name'] = implode(', ', $asign_names);
        $data['total_assignm'] = $total_assignm;

        // Class
        $class_names    = [];
        $total_class    = 0;
        $explClass = explode(',', $data['class_id']);
        foreach ($explClass as $classId) {
            $b = $ObjMante->BuscarLoQueSea('*', PREFIX.'class', 'id = '.$classId, 'extract');
            if ($b) {
                $total_class = $total_class + 1;
                $class_names[] = $b['class_name'];
            }
        }
        $data['class_name'] = implode(', ', $class_names);
        $data['total_class'] = $total_class;

        // Messages
        $data['messages'] = 'No posee mensajes.';
        $data['total_message'] = '0';


        $this->exito = $data;
        return $this->exito;
    }

    /**
     * Save
     * @param $POST
     * @return $exito
     */
    public function save ($POST) {
        $ObjMante   =   new Mantenimientos();
        $ObjEjec    =   new ejecutorSQL();

		$sql 		=	$ObjMante->BuscarLoQueSea('*',$this->tableAssignment,'id_cia="'.$this->idCia.'" and teacher_id = "'.$POST['r1'].'"','array');

        if ($sql['total'] > 0 ) {
            $this->exito = 'error';
        } else {
            $asignArr = false;
            $classesArr = false;

            if ($POST['r2']) {
                foreach ($POST['r2'] as $key => $value) {
                    if($asignArr != '') {
                        $asignArr .=  ',';
                    }	
                    $asignArr		.=	 $value;
                }
            }

            if ($POST['r3']) {
                foreach ($POST['r3'] as $key => $value) {
                    if($classesArr != '') {
                        $classesArr .=  ',';
                    }	
                    $classesArr		.=	 $value;
                }
            }

            $teacher_name 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_cia="'.$this->idCia.'" and id_usuario = "'.$POST['r1'].'"','extract');
            $tName 			= 	$teacher_name['nombre']. ' ' .$teacher_name['apellido'];

            $P_Campos 		=	'id_cia,teacher_id,teacher_name,assignment_id,class_id,date_ini,date_end,created_at,activo';
            $P_Valores 		=	"'".$this->idCia."','".$POST['r1']."','".$tName."','".$asignArr."','".$classesArr."','".$POST['r5']."','".$POST['r6']."',NOW(),'".$POST['r4']."'";
            $ObjEjec->insertarRegistro($this->tableAssignment, $P_Campos, $P_Valores);
            $this->exito = "ok";
        }
        return $this->exito;
	}

    /**
     * Update
     * @pram $POST
     * @return $exito
     */
    public function update ($POST)  {
        $ObjEjec    = new ejecutorSQL();
        $ObjMante   = new Mantenimientos();
		$asignArr   = false;
        $classesArr = false;
        if ($POST['r2']) {
            foreach ($POST['r2'] as $key => $value) {
                if($asignArr != '') {
                    $asignArr .=  ',';
                }	
                $asignArr		.=	 $value;
            }
        }

        if ($POST['r3']) {
            foreach ($POST['r3'] as $key => $value) {
                if($classesArr != '') {
                    $classesArr .=  ',';
                }	
                $classesArr		.=	 $value;
            }
        }

        $teacher_name 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'usuarios','id_cia="'.$this->idCia.'" and id_usuario = "'.$POST['r1'].'"','extract');
        $tName 			= 	$teacher_name['nombre']. ' ' .$teacher_name['apellido'];

        $P_Valores = "teacher_id='".$POST['r1']."', teacher_name = '".$tName."', assignment_id='".$asignArr."', class_id='".$classesArr."', date_ini='".$POST['r4']."', date_end='".$POST['r5']."', activo='".$POST['r6']."'";
        $l = $ObjEjec->actualizarRegistro($P_Valores,$this->tableAssignment, 'id = "'.$POST['r_r'].'"');
        if($l == 1){
            $this->exito = 'ok';
        } else {
            $this->exito = $l;
        }
        return $this->exito;
	}

    /**
     * Delete 
     * @param $id
     * @return $exito
     */
    public function delete ( $id ) {
        $ObjEjec    =   new ejecutorSQL();
        $r = $ObjEjec->ejecutarSQL("Delete from ".$this->tableAssignment." Where id = '".$id."' and id_cia='".$this->idCia."'");
        if ($r == 1) {
            $this->exito = 'ok';
        } else {
            $this->exito = 'error';
        }
		return $this->exito;
	}

    public function showAll () {
        $listAll 	=	$this->listAssignments();
        if ($listAll['total'] > 0) {
            foreach ($listAll['resultado'] as $key => $datos) {
        ?>
            <tr>
            <td  title="Nombre del Profesor" <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['teacher_name'];?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=isset($datos['asignment_name'])?$datos['asignment_name']:'';?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=isset($datos['class_name'])?$datos['class_name']:''?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?=$datos['date_ini'].' - '.$datos['date_end']?></td>
            <td <?php if($datos['activo']==0) { echo 'class="row-yellow-transp"'; } ?>><?php if($datos['activo'] ==1) { echo 'Activo'; } else { echo '<label style="color:red">Inactivo</label>';} ?></td>
            <td class="text-center">
            <a class="btn btn-xs btn-teal tooltips" data-original-title="Ver Información" data-toggle="modal" role="button" data-target="#edit_event" href="#" onclick="editRow('<?php echo $datos['id']; ?>','modal-edit');"><i class="fa fa-edit"></i></a>
            <a class="btn btn-green btn-xs btn-teal tooltips" data-original-title="Ver Información" data-toggle="modal" role="button" data-target="#myEditModal" href="#" onclick="editRow('<?php echo $datos['id']; ?>','modal-info');"><i class="fa fa-search"></i></a>
            <a class="btn btn-xs btn-bricky tooltips" data-original-title="Eliminar" href="Javascript:void(0);" onclick="if (confirm('Está seguro que desea eliminar este registro?')) { deleteRow('<?php echo $datos['id']; ?>'); } else { return false; }"><i class="fa fa-times fa fa-white"></i></a>
            </td>
            </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="6" class="text-center">Ningún dato disponible en esta tabla</td></tr>';
        }
    }

    public function saveAssociate () 
	{
		return true;
	}
}


