<?php
include_once ('../framework.php');
$P_campo	=	trim(isset($_GET['campo'])		?	$_GET['campo']:''); 			//	Lo que quiero editar o modificar el nombre del campo
$P_valorc	=	isset($_GET['valor'])			?	$_GET['valor']:'';				//	Dato a cambiar
$campo		=	trim(isset($_GET['actualizar'])	?	$_GET['actualizar']:'');		//	Nombre del DIV a actualizar
$T_tabla	=	isset($_GET['tabla'])			?	$_GET['tabla']:'';				//	Tabla a usar
$P_vcomodin	=	isset($_GET['vcomodin'])		?	$_GET['vcomodin']:'';			//	Valor del comodin para el WHERE
$P_ncomodin	=	isset($_GET['ncomodin'])		?	$_GET['ncomodin']:'';			//	Nombre del comodin para usar en WHERE
$valor_clave=	isset($_GET['valor_clave'])		?	$_GET['valor_clave']:'';
$QUE		=	isset($_GET['QUE'])				?	$_GET['QUE']:'';				//	Si solo quiero INSERT y NO UPDATE
$GET_id		=	isset($_GET['idCod'])			?	$_GET['idCod']	:'';


//Validar que el en campo de texto se introduzca solo lo permitido
//================================================================
function validaValor($cadena)
{
	// Funcion utilizada para validar el dato a ingresar recibido por GET	
	if(@eregi('^[a-zA-Z0-9._������!�? -+]{1,40}$', $cadena)){ return TRUE;
	}else{ return FALSE;}
}

		if($P_campo !='' && $P_valorc!='')
		{
			//Verificar si se trata del campo Codigo de la tabla personal
			// Actualizo el campo recibido por GET con la informacion que tambien hemos recibido
			
			$sql	=	mysqli_query($link,"UPDATE ".$T_tabla." SET ".$P_campo."='".$P_valorc."' WHERE ".$P_ncomodin."='".$P_vcomodin."'"); // or die(mysql_error());
			
			if(isset($_GET['nemple'])&&$_GET['nemple']==1)
			{
				// ACTUALIZO EL CAMPO ncorto y le pongo el numero del empleado
					$DATO	=	mysqli_fetch_array(mysqli_query($link,'SELECT * FROM usuario WHERE id_usuario ='.$_GET['valor'].''));
					mysqli_query($link,"UPDATE ".$T_tabla." SET ncorto='".$DATO['nempleado']."' WHERE ".$P_ncomodin."='".$P_vcomodin."'"); // or die(mysql_error());
			}
		}
		
//INGRESAR LOS DATOS
//PARA INSERTAR DATOS ASINCRONICAMENTE
//=====================================
	if($QUE == 'SoloInsert')
	{
		$CuantosCampos	=	count($campo);
		$i				=	0;
		$sql			=	mysqli_query($link,"INSERT INTO ".$T_tabla."(".$campo.") values (".$valor.")");
		mysqli_close($link);
	}
// No retorno ninguna respuesta
?>
