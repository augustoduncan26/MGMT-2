<?php 
class bitacora{
	
	function bitacora(){
		
		return (true);
	}
	
	
	function registrar($P_descripcion, $P_gestion=false, $P_estatus=false){
		$objCms = new cms();
		$objEjec = new ejecutorSQL();
		$exito = false;
		
		$idUs = $objCms->consultarID();
		
		if (!is_null($idUs)){
			$valGestion = ($P_gestion===false)?"NULL":$P_gestion;
			$valEstatus = ($P_estatus===false)?"NULL":$P_estatus;
			
			$tbl = "bitacora";
			$cmp = "id_gestion, fecha_hora, descripcion, id_usuario, id_estatus";
			$val = "$valGestion, NOW(), '$P_descripcion', $idUs, $valEstatus";
			$exito = $objEjec->insertarRegistro($tbl , $cmp, $val);
		}
		
		return ($exito);
	}
	
	function registrarBitaUser($P_descripcion, $idUs , $P_estatus=false) {
		$objCms = new cms();
		$objEjec = new ejecutorSQL();
		$exito = false;
		
		$idUs = $objCms->consultarID();
		
		if (!is_null($idUs)){
			$valGestion = ($P_gestion===false)?"NULL":$P_gestion;
			$valEstatus = ($P_estatus===false)?"NULL":$P_estatus;
			
			$tbl = "ad_bitacora_acciones_user";
			$cmp = "fecha_hora, descripcion, id_usuario";
			$val = "NOW(), '$P_descripcion', $idUs";
			$exito = $objEjec->insertarRegistro($tbl , $cmp, $val);
		}
		
		return ($exito);
	}
	
	
	function consultar($P_numPag){
		
	}
}
?>