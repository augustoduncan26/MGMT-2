<?php
include_once ( dirname(dirname(__DIR__)) . '/framework.php');
$ObjMante   =   new Mantenimientos();
$ObjEjec    =   new ejecutorSQL();
$id_user 	=	$_SESSION['id_user'];
$id_cia 	=	$_SESSION['id_cia'];
$P_Tabla 	=	PREFIX.'users';

$DataUser   = $ObjMante->BuscarLoQueSea('AES_DECRYPT(contrasena,"toga") as clave_actual,email,nombre',PREFIX.'users','id_usuario = "'.$id_user.'"','extract');

if (isset($_POST['btn-modificar-clave'])) {
    if ($DataUser['clave_actual']==$_POST['clave_actual']) {
        $P_condicion=	" id_usuario = '".$id_user."'";
        $P_ValoresA	=	"contrasena =AES_ENCRYPT('".$_POST['clave_nueva']."','toga')"; 
        $updA 		=	$ObjEjec->actualizarRegistro($P_ValoresA, PREFIX.'users', $P_condicion);
        if($updA == 1){
            $mensaG			=	"<font face=verdana size=1.5 />Hola ".$DataUser['nombre']."&nbsp;<br /><br />
            &nbsp;&nbsp;Sus datos de acceso fueron actualizados.<br><br>
            &nbsp;&nbsp;Esto son tus datos de acceso:<br>
            &nbsp;&nbsp;Nombre de usuario: ".$DataUser['email']."<br>			
            &nbsp;&nbsp;Contraseña: ".$_POST['clave_nueva']."<br><br />
            <br />
            Derechos Reservados ".date('Y')."
            ";
            sendAnEmail ($mensaG,$DataUser['email'],$_ENV['MAIL_FROM_ADDRESS'],"Contraseña actualizada.");
            // $ObjEjec->insertarRegistro(PREFIX.'users', $P_Campos, $P_Valores);
            // $mail_to_send_to = $DataUser['email'];
            // $from_email 	 = $_ENV['MAIL_FROM_ADDRESS'];
            // $subject		 = "Contraseña actualizada.";
            // $headers  = "From: " . strip_tags($from_email) . "\r\n";
            // $headers .= "Reply-To: " . strip_tags($_ENV["MAIL_USERNAME"]) . "\r\n";
            // $headers .= "BCC: ".$_ENV["MAIL_BBC"]."\r\n";
            // $headers .= "MIME-Version: 1.0\r\n";
            // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            // $a = mail( $mail_to_send_to, $subject, $mensaG, $headers );
            //echo '<div class="alert alert-success">Se ha creado el registro con éxito. <br />Se envó un email al usuario creado, con sus datos de acceso.</div>';
            $mssg = 'ok';
        } else {
            $mssg = 'error';
        }
    } else {
        $mssg = "no";
    }
}