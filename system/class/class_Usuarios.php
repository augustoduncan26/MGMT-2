<?php
/**
 * Usuarios
 */

// namespace class\Usuarios;

class Usuarios
{
    private $exito;
    private $tableUsuarios;
    private $idCia;
    private $idUser;

    public function __construct()
    {
        $this->tableUsuarios = PREFIX.'usuarios';
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
        $where 			= 	'id_cia="'.$this->idCia.'" and id_usuario <> 1';
        $ObjMante       =   new Mantenimientos();
        $this->exito    =   $ObjMante->BuscarLoQueSea('*',$this->tableUsuarios,$where,'array','id_usuario');
        if ($this->exito['total'] > 0) {
            return $this->exito;
        } else {
            return false;    
        }
	}

    /**
     * List all event ASYNC - Table
     */
    public function listAllAsync () {
        $objPermOpc = new permisos();
        $ObjMante   = new Mantenimientos();
        //$ObjEjec    = new ejecutorSQL();
        $where 			= 	'id_cia="'.$this->idCia.'"';
        $listEvents 	=	$ObjMante->BuscarLoQueSea('*',$this->tableUsuarios,$where,'array','name');
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

    public function save ($POST,$FILES) 
	{
        $ObjMante   =   new Mantenimientos();
        $ObjEjec    =   new ejecutorSQL();
        $path 		=  	ROOT_DIR.REPOSITORY."profile_photos/";
        // if (is_dir($path)) {
        //     @chmod($path, 0755);
        // }
		$sql 			=	$ObjMante->BuscarLoQueSea('*',$this->tableUsuarios,'email="'.$POST['user_acceso'].'"','array');

        if (is_dir($path)) {
            @chmod($path, 0755);
        }
        if ($sql['total'] > 0 ) {
            $this->exito	=	'Ya existe este registro.';
        } else {

		if (file_exists(REPOSITORY."profile_photos/")) {
			$this->exito = "The directory ".REPOSITORY."profile_photos/ exists.";
			exit;
		}

		// Insert Photo
		if ($FILES['file']['name']) {
			$rand 			=	rand('1234567890','0987654321');
			$rand2 			=	rand('0987654321','1234567890');
			$image 			= 	getimagesize($FILES['file']['tmp_name']);
			$extension 		=	explode('/',$image['mime']);
			$temp 			= 	explode(".", $FILES['file']['name']);
			$newfilename    =   $this->idCia.'-foto-'.$rand.'-'.date('Y-m-d').'-'.$rand2. '.' . $extension[1];
			$fileTempName 	= 	$FILES['file']['tmp_name'];
			

			// check if there is an error for particular entry in array
			if(!empty($file['error']))  {
				// some error occurred with the file in index $index
				// yield an error here
				echo 'error en foto';
				return false;
			}
		}

		$clave 		=	encrypt_decrypt('encrypt', $POST['clave']);
		$perfilData =	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','id="'.$POST['perfil'].'"');
		$P_Valores 	= 	"'".$POST['user_acceso']."','".$POST['user_acceso']."','".$POST['nombre']."','".$POST['apellido']."','".$this->idCia."','".$POST['director']."','".$POST['principal']."','".$POST['perfil']."','".$perfilData['name']."','".$clave."',NOW(),NOW(),'0','".$POST['estado']."'";
		$ObjEjec->insertarRegistro($this->tableUsuarios, 'usuario,email,nombre,apellido,id_cia,es_director,principal,id_perfil,name_perfil,contrasena,created_at,updated_at,superadmin,activo', $P_Valores);
		
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			move_uploaded_file($fileTempName, $path . $newfilename);
			$clave 		= 	"photo='".$newfilename."'";
			$ObjEjec->actualizarRegistro($clave, $this->tableUsuarios, 'email = "'.$POST['user_acceso'].'"');
		}

		$dataUser 	=	$ObjMante->BuscarLoQueSea('*',$this->tableUsuarios,'email = "'.$POST['user_acceso'].'"','extract');

		// Add permissions
		if ($POST['perfil']) {
			$selPerms 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'permisos','id_cia="'.$this->idCia.'" and id_perfil="'.$POST['perfil'].'"','array');
			if ($selPerms['resultado']) {
				foreach ($selPerms['resultado'] as $key => $perm) {
					if (is_numeric($perm['id_definicion_permiso'])) {
						$P_Campos 		=	'id_user,id_permission,id_cia,created_at';
						$P_Valores 		=	"'".$POST['id']."','".$perm['id_definicion_permiso']."','".$this->idCia."',NOW()";
						$ObjEjec->insertarRegistro(PREFIX.'users_permissions', $P_Campos, $P_Valores);
					}
				}
			}
		}

		// Save Parents Data
		if ($POST['contacto']) {
			$selPerfile 	=	$ObjMante->BuscarLoQueSea('*',PREFIX.'perfiles','name like "%Padre%" or name like "%emergencia%"','extract');
			// Save to table parents
			$P_Valores 		=	"'".$POST['contacto']."','".$selPerfile['id']."','".$dataUser['id']."',NOW(),NOW()";
			$ObjEjec->insertarRegistro(PREFIX.'emergency_contact', 'name,id_perfil,id_students,created_at,updated_at', $P_Valores);
		}

		$this->exito	= 'Se ingreso el registro con éxito';

            if ($POST['enviar_email']) {
                // $Obj		=	new EnviarCorreo();
                $mensaG		=	"<font face=verdana size=1.5 />Hola ".$POST['nombre']."&nbsp;<br /><br />
                                &nbsp;&nbsp;Se ha creado su usuario con éxito.<br><br>
                                &nbsp;&nbsp;Sus datos de acceso son:<br>
                                &nbsp;&nbsp;Nombre de usuario: ".$POST['user_acceso']."<br>			
                                &nbsp;&nbsp;Clave de acceso: ".$POST['clave']."<br>
                                ";
                
                $mail_to_send_to = $POST['user_acceso'];
                $from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
                $subject		 = "Usuario creado";
                //$message		= "\r\n" . "Name: TEST" . "\r\n";
                $headers  = "From: " . strip_tags($from_email) . "\r\n";
                $headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
                $headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail( $mail_to_send_to, $subject, $mensaG, $headers );
                $this->exito	=	'Usuario creado con éxito. <br />';
            }
	    }
        return $this->exito;
	}

    public function update () 
	{
		return true;
	}

    public function delete ($GET) 
	{
        $ObjEjec    =   new ejecutorSQL();
		$ObjEjec->ejecutarSQL("Delete from ".$this->tableUsuarios." Where id = '".$GET['id']."'");
	    $this->exito = '<div class="alert alert-danger">Se elimino el registro con éxito</div>';
        return $this->exito;
	}

    public function saveAssociate () 
	{
		return true;
	}
}


