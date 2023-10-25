<?php

	$P_Tabla 	=  	$TblRooms;
	$P_Valores 	= 	" codigo = '".$_POST['nombre']."', tipo_habita = '".$_POST['tipo']."', price = '".$_POST['precio']."', total_beds = '".$_POST['total_beds']."', cleaning = '".$_POST['cleaning']."', activo = '".$_POST['activo']."'";
	$P_condicion=	" id = '".$_POST['id']."'";
	$resultOpe  =  	$Objsql->actualizarRegistro($P_Valores, $P_Tabla, $P_condicion);
	echo 	'Se actualizo el registro con éxito';
