<?php

class fecha{
	
	var $salid			=	false;
	

	function fecha(){
		
	}

	
	function fecha_pan($P_cad, $P_visualizarHora=true){

		$salid			=	FALSE;
		
		$arrFechaComp = explode(" ", $P_cad);
		
		$arrFecha = explode("-", $arrFechaComp[0]);
		
		$anio = $arrFecha[0];
		$mes  = $arrFecha[1];
		$dia  = $arrFecha[2];
		
		$salid .= $dia;
		
		switch ($mes){
		case '01' :	$salid .= "-Ene";
			break;
			
		case '02' :	$salid .= "-Feb";
			break;
			
		case '03' :	$salid .= "-Mar";
			break;			
			
		case '04' :	$salid .= "-Abr";
			break;
			
		case '05' :	$salid .= "-May";
			break;						
			
		case '06' :	$salid .= "-Jun";
			break;
			
		case '07' :	$salid .= "-Jul";
			break;
			
		case '08' :	$salid .= "-Ago";
			break;
			
		case '09' :	$salid .= "-Sep";
			break;
			
		case '10' :	$salid .= "-Oct";
			break;
			
		case '11' :	$salid .= "-Nov";
			break;
			
		case '12' :	$salid .= "-Dic";
			break;
		}
		
		$salid .= "-".$anio;
		
		if ($P_visualizarHora){
			$salid .= " ".$arrFechaComp[1];
		}		
		
		return ($salid);
		
	}// Metodo fecha_esp
	
	function fecha_carta($P_cad){

		$salid		=	false;
		
		$arrFechaComp = explode(" ", $P_cad);
		
		$arrFecha = explode("-", $arrFechaComp[0]);
		
		$anio = $arrFecha[0];
		$mes = $arrFecha[1];
		$dia = $arrFecha[2];
		
		$salid .= $dia." de ";
		
		switch ($mes){
		case '01' :	$salid .= "enero";
			break;
			
		case '02' :	$salid .= "febrero";
			break;
			
		case '03' :	$salid .= "marzo";
			break;			
			
		case '04' :	$salid .= "abril";
			break;
			
		case '05' :	$salid .= "mayo";
			break;						
			
		case '06' :	$salid .= "junio";
			break;
			
		case '07' :	$salid .= "julio";
			break;
			
		case '08' :	$salid .= "agosto";
			break;
			
		case '09' :	$salid .= "septiembre";
			break;
			
		case '10' :	$salid .= "octubre";
			break;
			
		case '11' :	$salid .= "noviembre";
			break;
			
		case '12' :	$salid .= "diciembre";
			break;
		}
		
		$salid .= " de ".$anio;	
		
		return ($salid);
		
	}// Metodo fecha_esp
	

	function hora_pan($P_cad){
		$aHora = explode(":", $P_cad);
		
		$salid = ($aHora[0]>12) 
			? $aHora[0]-12 .":". $aHora[1] ." p.m."
			: $aHora[0] .":". $aHora[1] ." a.m.";
		
		return $salid;
	}
	
	function esBisiesto($P_anio){
		if (($P_anio%4==0 AND $P_anio%100!=0 )OR $P_anio%400==0){
			$exito = true;
		}
		else{
			$exito = false;
		}
		
		return ($exito);
	}
	
	function fecha_fin_mes($P_mes, $P_anio=false){
		$result = false;
		
		$numMes = intval($P_mes);
		$bisiesto = 0;
		
		if ( $P_anio != false ){
			if ($this->esBisiesto($P_anio)){
				$bisiesto = 1;
			}
		}
		
		if (($numMes > 0 AND $numMes < 13)){
			switch ($numMes){
				case 1: 
						$result = 31; 
						break;
				
				case 2: 
						$result = 28 + $bisiesto; 
						break;
				
				case 3: 
						$result = 31; 
						break;
				
				case 4: 
						$result = 30; 
						break;
				
				case 5: 
						$result = 31; 
						break;
				
				case 6: 
						$result = 30; 
						break;
				
				case 7: 
						$result = 31; 
						break;
				
				case 8: 
						$result = 31; 
						break;
				
				case 9: 
						$result = 30; 
						break;
				
				case 10: 
						$result = 31; 
						break;
				
				case 11: 
						$result = 30; 
						break;
				
				case 12: 
						$result = 31; 
						break;				
			}	
			
			return ($result);
		}	
		
	}

	function fechaHoy(){
		$dia=date("l");
		if ($dia=="Monday") $dia="Lunes";
		if ($dia=="Tuesday") $dia="Martes";
		if ($dia=="Wednesday") $dia="Mi&eacute;rcoles";
		if ($dia=="Thursday") $dia="Jueves";
		if ($dia=="Friday") $dia="Viernes";
		if ($dia=="Saturday") $dia="S&aacute;bado";
		if ($dia=="Sunday") $dia="Domingo";
		
		// Obtenemos el n&uacute;mero del d&iacute;a
		$dia2=date("d");
		
		// Obtenemos y traducimos el nombre del mes
		$mes=date("F");
		
		$idiom = cms::consultarIdiomaActivo(); 
		
		if ($idiom=="ES"){
			
			if ($mes=="January") 
			$mes="Enero";
			
			if ($mes=="February") 
			$mes="Febrero";
			
			if ($mes=="March") 
			$mes="Marzo";
			
			if ($mes=="April") 
			$mes="Abril";
			
			if ($mes == "May") 
			$mes="Mayo";
			
			if ($mes=="June") 
			$mes="Junio";
			
			if ($mes=="July") 
			$mes="Julio";
			
			if ($mes=="August") 
			$mes="Agosto";
			
			if ($mes=="September") 
			$mes="Septiembre";
			
			if ($mes=="October") 
			$mes="Octubre";
			
			if ($mes=="November") 
			$mes="Noviembre";
			
			if ($mes=="December") 
			$mes="Diciembre";
		}		
		
		// Obtenemos el a&ntilde;o
		$ano=date("Y");
		
		// Imprimimos la fecha completa
		if ($idiom == "EN")
		return $mes." ".$dia2.", ".$ano;
		else
		return $dia .", ".$dia2." de ".$mes." de ".$ano;
	}
	
	function parseFecha($P_fecha){
		$arrFecha = explode("/", $P_fecha);
		
		return($arrFecha[2]."-".$arrFecha[1]."-".$arrFecha[0]);
	}
	
	function anioActual(){
		return(date("Y"));
	}
	
	function contarDiasLaborables ($cuantosDias, $fechaInicial=""){
		
		
		if ($fechaInicial == ""){
			$temp = getdate();
			$fechaInicial = $temp['year']."-".$temp['mon']."-".$temp['mday'];
		}
		
		$temp = explode("-", $fechaInicial);
		
		$contadorDiasActivos = 0;
		$contadorDias = 1;
		$inicialTimeStamp = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]); 
		while ($contadorDiasActivos < $cuantosDias){
			$actTimeStamp = $inicialTimeStamp + ($contadorDias * 24 * 60 * 60);
			
			$arrFecha = getdate($actTimeStamp);
			
			if ($arrFecha['wday'] != 0 AND $arrFecha['wday'] != 6 ){
				$contadorDiasActivos++;
			}
			
			$contadorDias++;
		}
		
		$contadorDias--;
		
		$temp = getdate($inicialTimeStamp + ($contadorDias * 24 * 60 * 60));
		
		return ($temp['year']."-".$temp['mon']."-".$temp['mday']);
	}
	
	function consultarHora(){
		return (strftime("%I:%M ").date(a));
	}
	
	//Calcula el numero de dia de un mes
	function UltimoDia($anho,$mes){ 
   	if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) { 
       	$dias_febrero = 29; 
   	} else { 
       	$dias_febrero = 28; 
   	} 
   switch($mes) { 
   
       case '01': return 31; break; 
       case '02': return $dias_febrero; break; 
       case '03': return 31; break; 
       case '04': return 30; break; 
       case '05': return 31; break; 
       case '06': return 30; break; 
       case '07': return 31; break; 
       case '08': return 31; break; 
       case '09': return 30; break; 
       case '10': return 31; break; 
       case '11': return 30; break; 
       case '12': return 31; break; 
   } 
   
}	
	
	function diasEntreFechas($fechainicio, $fechafin){
    	return ((strtotime($fechafin)-strtotime($fechainicio))/86400);
	}
	
	function resta_fechas($fecha1,$fecha2, $absoluto = true){
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
		

		list($a�o1,$mes1,$dia1)=explode("/",$fecha1);
		

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
		

		$Res1	=	explode("-",$fecha1);
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
		

		$Res2	=	explode("-",$fecha2);	

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
		

		$Res3	=	explode("-",$fecha2);	
		$dif = mktime(0,0,0,$Res1[1],$Res1[2],$Res1[0]) - mktime(0,0,0,$Res3[1],$Res3[2],$Res3[0]);
		
		
		
		$dif = $dif / (60*60*24);
		
		$dif = ($absoluto)?abs($dif):$dif; 
		$ndias=floor($dif);

		return($ndias);

	}


	function resta_fechas_neg($fecha1,$fecha2, $absoluto = true){
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
		

		list($año1,$mes1,$dia1)=explode("/",$fecha1);
		

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
		

		list($año1,$mes1,$dia1)=explode("-",$fecha1);
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
		

		list($año2,$mes2,$dia2)=explode("/",$fecha2);
		

		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
		

		$Res3	=explode("-",$fecha2);
		$dif = mktime(0,0,0,$Res3[1],$Res3[2],$Res3[0]) - mktime(0,0,0,$Res3[1],$Res3[2],$Res3[0]);
		
		
		
		$dif = $dif / (60*60*24);
		
		$ndias=floor($dif);
		

		return($ndias);
		

	}

	function Fecha_Corriente($dia , $mes=false , $anyo=false)
	{
		$unidades	=	array('cero','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve');
		$mesTexto	=	array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
		$prefijo	=	array('ce','dieci','veinte y','treinta y');
		$combina10	=	array('','once','doce','trece','catorce','quince');
		$comb_diez	=	array(9=>'nueve',10=>'diez',20=>'veinte',30=>'treinta',40=>'cuarenta',50=>'cincuenta',80=>'ochenta',90=>'noventa');
	
		
		
		switch($dia)
		{
			case '01':
				$dia	=	'uno';
				break;
			case '02':
				$dia	=	'dos';
				break;
			case '03':
				$dia	=	'tres';
				break;
			case '04':
				$dia	=	'cuatro';
				break;
			case '05':
				$dia	=	'cinco';
				break;
			case '06':
				$dia	=	'seis';
				break;
			case '07':
				$dia	=	'siete';
				break;
			case '08':
				$dia	=	'ocho';
				break;
			case '09':
				$dia	=	'nueve';
				break;
		}
		if($dia < 10)
		{
			 $dia	=	$unidades[$dia]	;	
		}
		else
		{
			$primernuemero = substr($dia,-2,1)	;
			$segundonumero = substr($dia,-1)	;
			
			switch($primernuemero)
			{
				case 1:
					switch($segundonumero)
					{
						case 0:
							$dia	=	'diez';
						break;
						case 1:
							$dia	=	'once';
						break;
						case 2:
							$dia	=	'doce';
						break;
						case 3:
							$dia	=	'trece';
						break;
						case 4:
							$dia	=	'catorce';
						break;
						case 5:
							$dia	=	'quince';
						break;
						case 6:
							$dia	=	'diez y seis';
						break;
						case 7:
							$dia	=	'diez y siete';
						break;
						case 8:
							$dia	=	'diez y ocho';
						break;
						case 9:
							$dia	=	'diez y nueve';
						break;
					}
				break;
				
				case 2:
						switch($segundonumero)
						{
						case 0:
							$dia	=	'veinte';
						break;
						case 1:
							$dia	=	'veinte y uno';
						break;
						case 2:
							$dia	=	'veinte y dos';
						break;
						case 3:
							$dia	=	'veinte y tres';
						break;
						case 4:
							$dia	=	'veinte y cuatro';
						break;
						case 5:
							$dia	=	'veinte y cinco';
						break;
						case 6:
							$dia	=	'veinte y seis';
						break;
						case 7:
							$dia	=	'veinte y siete';
						break;
						case 8:
							$dia	=	'veinte y ocho';
						break;
						case 9:
							$dia	=	'veinte y nueve';
						break;
						}
						
				break;
				case 3:
						switch($segundonumero)
						{
						case 0:
							$dia	=	'treinta';
						break;
						case 1:
							$dia	=	'treinta y uno';
						break;
						}
				break;
			}
		}
		
		$mes		=	$mesTexto[$mes];
		
		$dosmil		=	substr($anyo,-4,3);
		$digitoanyo	=	substr($anyo,-1);
		if($dosmil == 200)
		{
			$anyo	=	'dos mil '.$unidades[$digitoanyo];
		}
		else
		{
			$dosmil		=	substr($anyo,-4,2);	
			$digitoanyo	=	substr($anyo,-2);
			
			if($dosmil == 20)
			{
				$anyo	=	'dos mil '.$comb_diez[9];
				
			}
		}

		$fecha_texto	=	$dia.'('.date("d").') de '.$mes.' del '.$anyo.' '.date("Y");
		return($fecha_texto);
	}


	public function NombreDelDia($P_mes , $P_dia , $P_anyo)
	{
		$arrDias 	= 	array('','Lunes','Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado','Domingo');
		$fecha 		= 	mktime(0, 0, 0, $P_mes  , $P_dia, $P_anyo); //0,0,0,mes,dia,a�o
		$dia 		= 	date("N",$fecha);
		return $arrDias[$dia];  
	}

	
	function dia_semana ($dia, $mes, $ano){
    	$dias = array('Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado');
	    return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
	}
	
	function MysqlFecha() {
		
		$date = getDate();
		
		foreach($date as $item=>$value) {
			if ($value < 10)
			$date[$item] = "0".$value;
		}
		return ($date['year']."-".$date['mon']."-".$date['mday']);
		
	}
	

	function SumarHoras($HorayMin , $Add_hora = false , $Add_mint = false )
	{

		$Hrs 	= 	explode(':', $HorayMin);
		
		$hora2	=	date("H:i", mktime($Hrs[0]+$Add_hora, $Hrs[1]+$Add_mint, 0));
		return $hora2;
	
	}
	

	function NuevaFecha()
	{
		$MES_HOY		=	date('m');			
		$ANYO			=	date("Y");
		$MES_EXPL1		=	substr($MES_HOY,0,1);
		$MES_EXPL2		=	substr($MES_HOY,1,1);
		
		if($MES_EXPL1[0]=='0'):					
			
			$MES_HOY	=	$MES_EXPL2[0]-1;
			
			if(strlen($MES_HOY)==1)
			{
				$MES_HOY	= '0'.$MES_HOY;	
			}
			
			if($MES_HOY == 0):					
				$MES_HOY	=	12;				
				$ANYO		=	date('Y')-1;	
			endif;
		;else:
			$MES_HOY	=	$MES_HOY-1;
		endif;
		
		$NUEVA_FECHA	=	date($ANYO.'-'.$MES_HOY."-25");
		
		return $NUEVA_FECHA;
		
	}
	

	function DevolverFechasEntreDos($fechaInicio, $fechaFin)
	{
		$arrayFechas	=	array();
		$fechaMostrar 	= 	$fechaInicio;
	
		while(strtotime($fechaMostrar) <= strtotime($fechaFin)) {
		$arrayFechas[]	=	$fechaMostrar;
		$fechaMostrar 	= 	date("Y-m-d", strtotime($fechaMostrar . " + 1 day"));
	}
	
	return $arrayFechas;
	}

	function SumarDiasAFecha($fecha,$dia)
	{
		$fechamasdiasdespues = date('Y-m-d',strtotime('+'.$dia.' days', strtotime($fecha)));
		
		return $fechamasdiasdespues;
	}

	function RestarDiasAFecha($fecha,$dia)
	{
		$fechamasdiasdespues = date('Y-m-d',strtotime('-'.$dia.' days', strtotime($fecha)));
		
		return $fechamasdiasdespues;
	}
	
	
}
