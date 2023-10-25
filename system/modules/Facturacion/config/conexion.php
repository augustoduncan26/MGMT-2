<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	# conectare la base de datos #
    include ('../../../config.php'); 
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
