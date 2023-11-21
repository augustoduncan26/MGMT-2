<?php
	include_once ( dirname(dirname(__DIR__)) . '../../framework.php');
    $ObjMante   = new Mantenimientos();
    $ObjEjec    = new ejecutorSQL();
    
    $id_user    = $_SESSION["id_user"];
    $id_cia  	= $_SESSION['id_cia'];
    $email 		= $_SESSION['email'];
    $username 	= $_SESSION['username'];
    
	# conectare la base de datos #
    //include ('../../../config.php'); 
    //$con=@mysqli_connect(DB_HOST2, DB_USER2, DB_PASS2, DB_NAME2);
    
    define("DB_HOST_2"  ,   $host_db);      // Host
    define("DB_USER_2"  ,   $usuario_db);
    define("DB_PASS_2"  ,   $pass_db);
    define("DB_NAME_2"  ,   $base_db);

    $con =@mysqli_connect(DB_HOST_2, DB_USER_2, DB_PASS_2, DB_NAME_2);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    } else {} 
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

?>
